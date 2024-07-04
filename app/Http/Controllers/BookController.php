<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class BookController extends Controller
{
    //
    public function index(Request $request, $section) {
        $categories = Category::all();

        $category_id = $request->query('category');
        $search = $request->query('search');

        error_log($category_id);

        if ($category_id && empty($search)) {
            $books = Book::leftJoin('book_categories', 'books.book_code', '=', 'book_categories.book_code')
            ->where('book_categories.category_id', $category_id)
            ->get();

            error_log($books);

        } else if (empty($category_id) && $search) {
            $books = Book::where('title', 'like', '%' . $search . '%')->get();
        }
        
        else if ($search && $category_id){
            $books = Book::leftJoin('book_categories', 'books.book_code', '=', 'book_categories.book_code')->where('book_categories.category_id', $category_id)->where('title', 'like', '%' . $search . '%')->get();
        }   

        else {
            $books = Book::all();
        }

        $count_books_active = Book::all()->where('status', '=', 1)->count();
        $user_active = User::all()->where('status', '=', 1)->count();

        if ($request->session()->get('key')) {
            $user = $request->session()->get('key');
            dd($user);
        }

        // $request->session()->put('user', [
        //     'username' => $username,
        //     'role_id' => $role_user->role_id
        // ]);
        // dd($count_books_active);
        error_log('knt: ' . $request->fullUrl());
        $url = $request->fullUrl();

        $parsed_path_url = parse_url($url)['path'];

        $segments = explode('/', trim($parsed_path_url, '/'));

        $result = [];

        foreach ($segments as $index => $segment) {
            $result['segment' . ($index + 1)] = $segment;
        }
        
        // dd($result);
        
        
        return view('dashboard', ['result' => $result, 'section' => $section, 'books' => $books, 'categories' => $categories, 'count_books' => $count_books_active, 'total_user' => $user_active]);
    }

    public function book_detail(Request $request, string $book_code) {
        if ($request->session()->get('user')) {
            $user = $request->session()->get('user');
            // dd($user);
        }

        error_log('knt: ' . $request->fullUrl());
        $url = $request->fullUrl();

        $parsed_path_url = parse_url($url)['path'];

        $segments = explode('/', trim($parsed_path_url, '/'));

        $result = [];

        foreach ($segments as $index => $segment) {
            $result['segment' . ($index + 1)] = $segment;
        }

        $book = Book::where('book_code', '=', $book_code)->first();
        if(empty($book)) {
            return view('not_found');
        }
        return view('dashboard', ['book' => $book, 'result' => $result]);
    }
}
