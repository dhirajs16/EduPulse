<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
            'email' => 'user1@example.com',
            'password' => bcrypt('12345678'),
            'user_type' => 'student',
            ],
            [
            'email' => 'user2@example.com',
            'password' => bcrypt('12345678'),
            'user_type' => 'student',
            ],
            [
            'email' => 'user3@example.com',
            'password' => bcrypt('12345678'),
            'user_type' => 'student',
            ],
            [
            'email' => 'user4@example.com',
            'password' => bcrypt('12345678'),
            'user_type' => 'student',
            ],
            [
            'email' => 'user5@example.com',
            'password' => bcrypt('12345678'),
            'user_type' => 'student',
            ],
        ]);
    }
}
