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
            try {
                // Assuming session user retrieval
                $user = $request->session()->get('user');
                if (!$user) {
                    return response()->json(['error' => 'User not authenticated'], 401);
                }
        
                // Validate the request
                $validated = $request->validate([
                    'username' => 'required|string',
                    'book_code' => 'required|string|max:36',
                ]);
        
                // $countBookRented = RentLog::where('username', $validated['username'])->count();
                // if ($countBookRented >= 3) {
                //     return response()->json(['error' => 'Dilarang meminjam buku lebih dari 3 kali'], 403);
                // }

                // $rentLog = new RentLog();
                // $rentLog->book_code = $validated['book_code'];
                // $rentLog->username = $validated['username'];
                // $rentLog->rent_date = Carbon::now();
                // $rentLog->save();
        
                // return response()->json(['success' => 'Book rented successfully']);
                // return redirect("../invoice/" . $validated['book_code']);
                return response()->json(['redirect' => true, 'url' => url("/invoice/" . $validated['book_code'])]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
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

    public function update_status_denda(Request $request, string $username) {
        $data = json_decode($request->input('data'), true); // Decode the JSON data
        dd($data); // For debugging
    
        foreach ($data as $item) {
            $book_code = $item['book_code'];
            $dateDay = Carbon::now()->addDays(3);
            $rentLog = RentLog::where('username', $username)
                              ->where('book_code', $book_code)
                              ->where('return_date', '<', $dateDay->toDateTimeString());
    
            $logData = $rentLog->get(['id', 'book_code']);
    
            RentLog::whereIn('id', $logData->pluck('id'))->update(['status' => 1]);
    
            Book::where('book_code', $book_code)->update(['status' => 1]);
        }
    }

    public function update_status_buku(string $book_code, string $username) {
        $rents = RentLog::where('book_code', $book_code)->where('username', $username)->whereNull('rent_date')->first();

        if (!$rents) {
            return redirect()->back()->withErrors("Book not found");
        }

        $rent_date = Carbon::now();

        $return_date = $rent_date->copy()->addDays(3);

        $rents->update([
            'rent_date'=> $rent_date,
            'return_date'=> $return_date
        ]);

        Book::where('book_code', $book_code)->update(['status' => 1]);

        return redirect()->back()->with('status', 'status buku sukses diupdate');
    }
    
}
