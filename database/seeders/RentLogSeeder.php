<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class RentLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Contoh data users dan books yang akan dihubungkan
        $books = DB::table('books')->pluck('book_code');
        $users = DB::table('users')->pluck('username');

        foreach ($users as $user) {
            foreach ($books as $book) {
                DB::table('rent_logs')->insert([
                    'username' => $user,
                    'book_code' => $book,
                    'rent_date' => Carbon::now(),
                    'return_date' => Carbon::now(),
                    'actual_return_date' => Carbon::now(),
                ]);
            }
        }
    }
}
