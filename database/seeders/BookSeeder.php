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
                'title' => 'Reckless (The Powerless Trilogy)',
                'slug' => 'book-one',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem quam beatae eligendi velit et eveniet saepe nemo sed sunt nulla.', 
                'cover' => 'covers/1.jpg',
                'status' => true,
            ],
            [
                'book_code' => Str::uuid(),
                'title' => 'The Women: A Novel',
                'slug' => 'book-two',
                'description' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Praesentium quaerat tenetur enim expedita animi quos!',
                'cover' => 'covers/2.jpg',
                'status' => true,
            ],
            [
                'book_code' => Str::uuid(),
                'title' => 'The Housemaid Is Watching',
                'slug' => 'book-three',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit', 
                'cover' => 'covers/3.jpg',
                'status' => false,
            ],
            [
                'book_code' => Str::uuid(),
                'title' => 'All the Colors of the Dark',
                'slug' => 'book',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit', 
                'cover' => 'covers/4.png',
                'status' => false,
            ],
        ]);
    }
}
