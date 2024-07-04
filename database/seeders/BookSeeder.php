<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('books')->insert([
            [
                'book_code' => Str::uuid(),
                'title' => 'Book One',
                'slug' => 'book-one',
                'description' => 'Description for Book One',
                'cover' => 'cover1.jpg',
                'status' => true,
            ],
            [
                'book_code' => Str::uuid(),
                'title' => 'Book Two',
                'slug' => 'book-two',
                'description' => 'Description for Book Two',
                'cover' => 'cover2.jpg',
                'status' => true,
            ],
            [
                'book_code' => Str::uuid(),
                'title' => 'Book Three',
                'slug' => 'book-three',
                'description' => 'Description for Book Three',
                'cover' => 'cover3.jpg',
                'status' => false,
            ],
            // Add more books as needed
        ]);
    }
}
