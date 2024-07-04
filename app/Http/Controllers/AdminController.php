<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function index() {
        // return view()
    }

    public function unconfirmed_user() {
        $users = User::where("confirmed", "=", 0)->get();
        
        return view("", ['users' => $users]);
    }

    public function approve_user(string $username) {
        $updated = User::where("username", "=", $username)->update(['confirmed', 1]);

        if (!$updated) {
            return redirect("/")->withErrors("failed to update user data");
        }

        return redirect(".");
    }

    public function add_book_category(Request $request) {
        $category = new Category;

        $category->name = $request->category_name;

        $category->save();

        return redirect("/");
    }

    public function store_book(Request $request) {
        $validate = $request->validate([
            // 'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'status' => 'required|boolean',
            'cover' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        
        $uuid = Str::uuid()->toString();
        $imageName = $uuid.'.'.$request->cover->extension();
        $request->cover->move(public_path('images'), $imageName);
        
        $book = new Book;
        $book->title = $validate['title'];
        $book->status = $validate['status'];
        $book->cover = 'images/'.$imageName;
        $book->description = $validate['description'];

        $book->categories()->attach($request->category);
        
        $book->save();

        return redirect('book-table')->with('status', 'The book has been added');
    }

    public function index_update_book(string $book_code) {
        $book = Book::findOrFail($book_code);
        // Category::where('book_code', '=', $book_code)->first();

        $book_data = $book->categories()->get();

        if ( !$book || !$book_data ) {
            // redirect ke halaman create atau update buku 
            return redirect("")->withErrors('book not found in database');
        }

        return view("update.book", ['book' => $book_data]);
    }

    # fungsi untuk 
    public function update_book(Request $request, string $book_code) {
        $result = Book::where("book_code", "=", $book_code)->first();

        if ( $result == null ) {
            return redirect()->withErrors("book not found in database");
        }

        $validated = $request->validate([
            // 'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'status' => 'required|boolean',
            'cover' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);



        $book = Book::find(1);

        $book->title = $validated['title'];
        $book->cover = $validated['cover'];
        $book->description = $validated['description'];
        $book->status = $validated['status'];

        $book->categories()->attach($request->category);

        $book->save();

        return redirect();
    }

    public function book_list_rented() {
        $books = Book::all()->where('status', '=', 1);

        if (count($books) == 0) {
            // return
        }

        // return view();
    }

    public function list_user() {
        User::all();
    }
    public function dashboard(Request $request, $section) {
        error_log('knt: ' . $request->fullUrl());
        $url = $request->fullUrl();

        $parsed_path_url = parse_url($url)['path'];

        $segments = explode('/', trim($parsed_path_url, '/'));

        $result = [];

        foreach ($segments as $index => $segment) {
            $result['segment' . ($index + 1)] = $segment;
        }
        return view('admin/dashboard',['result' => $result, 'section' => $section]);
    }
}
