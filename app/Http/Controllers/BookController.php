<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BookController extends Controller
{
    //
    public function index(Request $request) {
        $categories = Category::all();

        $category_id = $request->category_id;

        if ($request->category) {
            $books = Book::leftJoin('book_categories', function($join) {
                $join->on('books.book_code', '=', 'book_categories.book_id');
            })
            ->where('book_categories.category_id', $request->category)
            ->get();

        } else if($request->search || $request->category){
            $books = Book::where('category_id', $category_id)->orWhere('title', 'like', '%' . $request->search . '%')->get();
        }

        else {
            $books = Book::all();
        }

        $count_books = Book::all()->count();
        $user_active = User::all()->where('status', '=', 1)->count();

        if (Session::has('user')) {
            $user = Session::get('user');
            dd($user);
        }

        // $request->session()->put('user', [
        //     'username' => $username,
        //     'role_id' => $role_user->role_id
        // ]);
        
        return view('dashboard', ['books' => $books, 'categories' => $categories, 'count_books' => $count_books, 'total_user' => $user_active]);
    }


}
