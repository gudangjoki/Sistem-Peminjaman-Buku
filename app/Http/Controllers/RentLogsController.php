<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\RentLog;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RentLogsController extends Controller
{
    public function index() {
        // $rents = Book::leftJoin("rent_logs")->get([
        //     'books.title',
        //     'rent_logs.username',
        //     'rent_logs.rent_date',
        //     'rent_logs.return_date'
        // ]);

        $rents = RentLog::all();
        return view("", ['rents' => $rents]);
    }

    public function borrow_book(Request $request) {

        if (!Auth::check()) {
            // return redirect();
        }

        // cek apakah user sudah meminjam buku lebih dari 3

        $user = Auth::user();

        $count_book_rented = count(Book::where('username')->get(['book_code']));

        if ($count_book_rented > 3) {
            // return redirect()->withError('user forbidden to borrow more than 3 books');
        }

        $validated = $request->validate([
            'book_code' => 'required|uuid|max:36',
        ]);

        $currTimeInSec = strftime(time().now());

        $book = new Book;
        $book->book_code = $validated['book_code'];
        $book->rent_date = $currTimeInSec;

        $return_date = $currTimeInSec + (3 * 24 * 60 * 60); 
        $date_conversion = date("Y-m-d H:i:s", $return_date);
        $book->return_date = $date_conversion;


        $book->users()->attach($user->username);
    }

    public function return_book(string $id_book) {

        $user = Auth::user();

        $book_returned = Book::where("book_code", "=", $id_book);

        // update status rent log book in column actual_return_date
        $book_returned->users()->updateExistingPivot($user, array('actual_return_date' => time().now()));
        // change status book

        $book_returned->update(['status' => 1]);
        return redirect();
    }

    // cek user yang denda
    public function user_forfeit() {
        $users = User::all();

        $currTimeSec = Carbon::now();
        $currDateTime = $currTimeSec->toDateTimeString();

        $forfeit_users = $users->books()->where(['books.return_date' > $currTimeSec])->get();

        dd($forfeit_users);

        // foreach ($forfeit_users->book_code as $book) {

        // }

        return view('', ['users' => $forfeit_users]);
    }

    public function log_rent_book(string $book_code) {
        $books_info = Book::leftJoin('rent_logs')->where('book_id', '=', $book_code)->get();
        
        $logRent = [];
        foreach ($books_info as $book_rented) {
            if (!empty($book_rented->actual_return_date)) {
                $logRent = array_push($logRent, $book_rented);
            }
        }

        return view("", ['logs_book' => $logRent]);
    }
}
