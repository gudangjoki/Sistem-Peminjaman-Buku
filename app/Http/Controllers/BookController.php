<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use App\Models\RentLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    //
    public function index(Request $request) {
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
        $logs = [];

        foreach ($segments as $index => $segment) {
            $result['segment' . ($index + 1)] = $segment;
        }
        
        // dd($result);
        if (in_array('histori', $result)) {
            $logs = RentLog::select('rent_logs.id', 'rent_logs.username', 'rent_logs.book_code', 'rent_logs.rent_date', 'rent_logs.return_date', 'rent_logs.actual_return_date', 'books.title', 'books.cover')
            ->where('rent_logs.username',  $request->session()->get('user'))
            ->join('books', 'rent_logs.book_code', '=', 'books.book_code')
            ->orderBy('rent_logs.rent_date', 'desc') 
            ->get();
            // dd($logs);
        }
        
        return view('dashboard', ['result' => $result, 'books' => $books, 'categories' => $categories, 'count_books' => $count_books_active, 'total_user' => $user_active, 'logs'=>$logs]);
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
        return view('dashboard', ['book' => $book, 'result' => $result, 'user' => $user]);
    }
    public function updateStatus(Request $request)
    {
        $invoiceId = $request->id;

        // dd($bookId);
        $rentLog = RentLog::find($invoiceId);

        // dd($rentLog->book_code);

        $book = Book::where('book_code', $rentLog->book_code)->update(['status' => 1]);

        // dd($book->return_date);
        // dd(Carbon::now());
        if ($rentLog && $book) {
            // Update the status of the book
            $rentLog->actual_return_date = Carbon::now(); // or whatever status you want to set
            $rentLog->save();
            return response()->json(['success' => true, 'message' => 'Book status updated successfully']);
        } else {
            return response()->json(['success' => false, 'message' => 'Book not found']);
        }
    }
}
