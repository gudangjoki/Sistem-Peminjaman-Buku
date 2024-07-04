<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BookCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan Anda memiliki data untuk tabel books dan categories
        $books = DB::table('books')->pluck('book_code');
        $categories = DB::table('categories')->pluck('id');

        // Insert data ke tabel book_categories
        foreach ($books as $book) {
            foreach ($categories as $category) {
                DB::table('book_categories')->insert([
                    'book_code' => $book,
                    'category_id' => $category,
                ]);
            }
        }
    }
}
