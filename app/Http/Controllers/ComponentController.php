<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class ComponentController extends Controller
{
    public function index_add_book(Request $request) {
        $categories = Category::all();

        $url = $request->fullUrl();

        $parsed_path_url = parse_url($url)['path'];

        $segments = explode('/', trim($parsed_path_url, '/'));

        $result = [];

        foreach ($segments as $index => $segment) {
            $result['segment' . ($index + 1)] = $segment;
        }

        // dd($result);

        $category_id = $request->query('category');
        $search = $request->query('search');

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

        

        return view("admin.dashboard", ["books" => $books, "categories" => $categories, 'result' => $result ]);
    }

    public function index_edit_book() {
        return view("admin.edit_book");
    }

    // public function index_edit_book() {
    //     return view("admin.edit_book");
    // }

    public function index_histori_user() {
        return view("histori");
    }
}
