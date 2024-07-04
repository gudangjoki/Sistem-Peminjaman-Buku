<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Technology'],
            ['name' => 'Health'],
            ['name' => 'Science'],
            ['name' => 'Sports'],
            ['name' => 'Education'],
        ];

        DB::table('categories')->insert($categories);
    }
}
