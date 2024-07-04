<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\RentLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReaderController extends Controller
{
    public function index() {
        // return view();
    }

    public function books_rent_list() {
        $user = Auth::user();

        // $books_rented = DB::table('rent_logs')->where('username = ?', $user)->whereNull('actual_return_date')->get(['book_id', 'username', 'rent_date', 'return_date']);
        $books_rented = DB::table('rent_logs')->where('username = ?', $user)->get(['book_id', 'username', 'rent_date', 'return_date']);

        $lists_id = [];
        $books_list = [];

        if (!empty($books_rented)) {
            foreach ($books_rented as $books) {
                $lists_id = array_push($lists_id, $books->book_id);
            }
            $books = Book::whereIn('book_code', $lists_id)->get(['book_name', 'slug']);

            // add two attribute book_rented and books
        }

        return view("", ['books' => $books_list]);
    }

    public function show_all_books(Request $request) {

        $books = [];
        if ($request->search) {
            $books = Book::where('title', 'like', '%' . $request->search . '%')->get();
        } 
        // else if ($request->categories) {

        // } else {
            
        // }

        $books = Book::all()->where('status', "=", 1);

        if (!$books) {
            return redirect("/")->withErrors('no books found');
        }

        return view("", ["books" => $books]);
    }

    public function detail_book(string $book_slug) {
        $target = Book::where('slug', '=', $book_slug);

        if(!$target->first()) {
            return redirect(".")->withErrors('path url for book not found');
        }

        return view("", ['book' => $target]);
    }

    public function invoice(Request $request, String $book_code) {
        $user = $request->session()->get('user');
            if (!$user) {
                return response()->json(['error' => 'User not authenticated'], 401);
            }

        $book = RentLog::where("book_code", "=", $book_code)->where("username", "=", $user)->whereNull("rent_date")->first();

        $data = Book::where("book_code", "=", $book_code)->first();

        $user = User::where("username", "=", $user["username"])->first();
        
        $title = $data->title;

        if(empty($book)) {
            dd($book);
        }

        return view('invoice_dashboard', ['book' => $book, 'title' => $title, 'user' => $user]);
    }
}
