<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\RentLog;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

        $title = $validate['title'];
        
        $book = new Book;
        $book->title = $title;
        $book->status = $validate['status'];
        $book->slug = Str::slug(strtolower($title));
        $book->cover = 'images/'.$imageName;
        $book->description = $validate['description'];

        $book->save();

        $book->categories()->attach($request->category);
        


        return redirect('book-table')->with('status', 'The book has been added');
    }

    public function index_update_book(Request $request, string $book_code) {
        $book = Book::where('book_code', '=', $book_code)->first();
        // Category::where('book_code', '=', $book_code)->first();

        if ( !$book ) {
            // redirect ke halaman create atau update buku 
            return redirect("http://127.0.0.1:8000/dashboard/buku")->withErrors('book not found in database');
        }

        $category = $book->categories()->get();

        if ( !$category ) {
            // redirect ke halaman create atau update buku 
            return redirect("http://127.0.0.1:8000/dashboard/buku/edit-book/" . $book_code)->withErrors('categories not found in database');
        }

        $url = $request->fullUrl();

        $parsed_path_url = parse_url($url)['path'];

        $segments = explode('/', trim($parsed_path_url, '/'));

        $result = [];

        foreach ($segments as $index => $segment) {
            $result['segment' . ($index + 1)] = $segment;
        }

        // dd($book->book_code);

        $categories = Category::all();

        $books = [];

        return view("admin.dashboard", ['book' => $book, 'result' => $result, 'books' => $books, 'category' => $category, 'categories' => $categories]);
    }

    public function book_upload(Request $request) {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            // 'status' => 'required|boolean',
            'cover' => 'image|mimes:jpeg,png,jpg|max:2048',
            // 'book_file' => 'file|mimes:pdf,doc,docx,epub|max:10240'
        ]);
    
        $coverFilePath = null;
        $bookFilePath = null;
    
        if ($request->hasFile('cover')) {
            $cover = $request->file('cover');
            $coverFilePath = 'covers/' . time() . '_' . $cover->getClientOriginalName();
            $cover->move(public_path('covers'), $coverFilePath);
        }

        $title = $validated['title'];

        $uuid = Str::uuid()->toString();
    
        $book = new Book;
        $book->book_code = $uuid;
        $book->title = $title;
        $book->slug = Str::slug(strtolower($title));
        $book->description = $validated['description'];
        $book->status = 1;
        $book->cover = $coverFilePath;
        // $book->book_file = $bookFilePath;

        $book->save();

        if ($request->has('category')) {
            // dd($request->category);
            DB::table('book_categories')->insert([
                'book_code' => $book->book_code,
                'category_id' => $request->category
            ]);
        }



    
        return response()->json(['message' => 'Book uploaded successfully'], 200);
    }    

    public function update_book(Request $request, string $book_code) {
        $book = Book::where("book_code", "=", $book_code)->first();

        if ( $book == null ) {
            return redirect("../../books")->withErrors("book not found in database");
        }

        // dd($request->all());

        $validated = $request->validate([
            // 'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            // 'book_code' => 'required|uuid',
            'description' => 'required|string|max:255',
            // 'status' => 'required|boolean',
            'cover' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('cover')) {
            $cover = $request->file('cover');
            $filePath = 'covers/';

            // ganti nama
            $fileName = time() . '_' . $cover->getClientOriginalName();
            // pindahkan file gambar
            $cover->move(public_path($filePath), $fileName);
    
            // Set the book cover path
            $book->cover = $filePath . $fileName;
        }

        $book->book_code = $book_code;
        $book->title = $validated['title'];
        $book->description = $validated['description'];
        $book->status = 1;

        $book->save();

        // dd($request->category);

        // $book->categories()->attach($request->category);
        if ($request->has('category')) {
            DB::table('book_categories')
            ->where('book_code', $book->book_code)
            ->update([
                'category_id' => $request->category
            ]);
        }

        return redirect("../../dashboard/buku");
    }

    public function book_list_rented() {
        $books = Book::all()->where('status', '=', 1);

        if (count($books) == 0) {
            // return
        }

        // return view();
    }

    // public function list_user() {
    //     User::all();
    // }

    public function dashboard(Request $request, $section) {
        error_log('knt: ' . $request->fullUrl());
        $url = $request->fullUrl();
    
        $parsed_path_url = parse_url($url);
        $parsed_path_url = isset($parsed_path_url['path']) ? $parsed_path_url['path'] : '';
    
        $segments = explode('/', trim($parsed_path_url, '/'));
    
        $result = [];
    
        foreach ($segments as $index => $segment) {
            $result['segment' . ($index + 1)] = $segment;
        }
    
        $books = [];
    
        if (in_array('buku', $result)) {
            $category_id = $request->query('category');
            $search = $request->query('search');
            
            error_log($category_id);
    
            if ($category_id && empty($search)) {
                $books = Book::leftJoin('book_categories', 'books.book_code', '=', 'book_categories.book_code')
                    ->where('book_categories.category_id', $category_id)
                    ->get();
            } else if (empty($category_id) && $search) {
                $books = Book::where('title', 'like', '%' . $search . '%')->get();
            } else if ($search && $category_id) {
                $books = Book::leftJoin('book_categories', 'books.book_code', '=', 'book_categories.book_code')
                    ->where('book_categories.category_id', $category_id)
                    ->where('title', 'like', '%' . $search . '%')
                    ->get();
            } else {
                $books = Book::all();
            }
        }
    
        if (in_array('denda', $result)) {
            $currTimeSec = Carbon::now()->toDateTimeString();

            $dateDay = Carbon::now()->addDays(3);

            // dd($currTimeSec);

            $logs = RentLog::whereNull('actual_return_date')->get(['id', 'return_date']);

            $forfeit_id = [];
            foreach ($logs as $log) {
                if ($log->return_date < $dateDay->toDateTimeString()) {
                    $forfeit_id[] = $log->id;
                }
            }

            // dd($forfeit_id);

            $forfeit_users = RentLog::whereIn('id', $forfeit_id)
            ->distinct('username')
            ->pluck('username');

            // dd($forfeit_users);

            $users = User::whereIn('username', $forfeit_users)->get(['username', 'phone']);

            // dd($forfeit_id);

            // $books = RentLog::where('id', $forfeit_id)->get(['book_code']);
            
            // Book::whereget();

            $arr = [];
            foreach ($users as $user) {
                foreach ($forfeit_id as $id) {
                    if (RentLog::where('id', $id)->where('username', $user->username)->where('return_date', '<', $dateDay->toDateTimeString())->exists()) {
                        if (!isset($arr[$user->username])) {
                            $arr[$user->username] = [];
                        }
                        $book_code = RentLog::where('id', $id)->value('book_code');
                        $book = Book::where('book_code', $book_code)->get();
                        $arr[$user->username][] = $book; // Add the id to the array for this username
                    }
                }
            }

            // dd($arr);

            // $forfeit_users = User::join('rent_logs', 'users.username', '=', 'rent_logs.username')
            //     ->where('rent_logs.return_date', '>', $currTimeSec)
            //     ->select('users.*')
            //     ->distinct()
            //     ->get();


        }
    
        return view('admin/dashboard', ['result' => $result, 'section' => $section, 'books' => $books, 'arrs' => $arr, 'users' => $users]);
    }
    
    public function view_book_warning() {
        $currTimeSec = Carbon::now()->toDateTimeString();

        $dateDay = Carbon::now()->addDays(3);

        // dd($currTimeSec);

        $logs = RentLog::whereNull('actual_return_date')->get(['id', 'return_date']);

        $forfeit_id = [];
        foreach ($logs as $log) {
            if ($log->return_date < $dateDay->toDateTimeString()) {
                $forfeit_id[] = $log->id;
            }
        }

        // dd($forfeit_id);

        $forfeit_users = RentLog::whereIn('id', $forfeit_id)
        ->distinct('username')
        ->pluck('username');

        // dd($forfeit_users);

        $users = User::whereIn('username', $forfeit_users)->get(['username', 'phone']);

        // dd($forfeit_id);

        // $books = RentLog::where('id', $forfeit_id)->get(['book_code']);
        
        // Book::whereget();

        $arr = [];
        foreach ($users as $user) {
            foreach ($forfeit_id as $id) {
                if (RentLog::where('id', $id)->where('username', $user->username)->where('return_date', '<', $dateDay->toDateTimeString())->exists()) {
                    if (!isset($arr[$user->username])) {
                        $arr[$user->username] = [];
                    }
                    $book_code = RentLog::where('id', $id)->value('book_code');
                    $book = Book::where('book_code', $book_code)->get();
                    $arr[$user->username][] = $book; // Add the id to the array for this username
                }
            }
        }
        return response()->json(['message' => $arr], 200);
    }
}