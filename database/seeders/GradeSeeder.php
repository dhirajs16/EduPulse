<?php

namespace Database\Seeders;

use App\Models\Grade;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $grades = [
            // Initial classes with 3 sections (A, B, C)
            ['name' => 'Nursery A'], ['name' => 'Nursery B'], ['name' => 'Nursery C'],
            ['name' => 'LKG A'], ['name' => 'LKG B'], ['name' => 'LKG C'],
            ['name' => 'UKG A'], ['name' => 'UKG B'], ['name' => 'UKG C'],

            // Classes 1-5 with 2 sections (A, B)
            ['name' => '1 A'], ['name' => '1 B'],
            ['name' => '2 A'], ['name' => '2 B'],
            ['name' => '3 A'], ['name' => '3 B'],
            ['name' => '4 A'], ['name' => '4 B'],
            ['name' => '5 A'], ['name' => '5 B'],

            // Classes 6-10 with 1 section (A)
            ['name' => '6 A'],
            ['name' => '7 A'],
            ['name' => '8 A'],
            ['name' => '9 A'],
            ['name' => '10 A'],
        ];

        Grade::insert($grades);
    }
}
