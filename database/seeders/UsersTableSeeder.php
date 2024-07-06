<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'username' => 'jhon',
                'password' => Hash::make('password123'),
                'phone' => 1234567890,
                'address' => '123 Main St',
                'status' => true,
                'role_id' => 1,
            ],
            [
                'username' => 'adam',
                'password' => Hash::make('password456'),
                'phone' => 9876543210,
                'address' => '456 Elm St',
                'status' => false,
                'role_id' => 2,
            ],
        ]);
    }
}
