<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subjects = [
            [
                'code' => 'MATH101',
                'name' => 'Maths',
                'description' => 'Basic mathematics covering arithmetic, algebra, and geometry.',
                'type' => 'core',
                'credit_hours' => 4,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'ENG101',
                'name' => 'English',
                'description' => 'English language and literature.',
                'type' => 'core',
                'credit_hours' => 4,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'NEP101',
                'name' => 'Nepali',
                'description' => 'Study of Nepali language and literature.',
                'type' => 'core',
                'credit_hours' => 3,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'GRAM101',
                'name' => 'Grammar',
                'description' => 'Study of grammar rules for various languages.',
                'type' => 'elective',
                'credit_hours' => 2,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'SOC101',
                'name' => 'Social Studies',
                'description' => 'Introduction to history, geography, and civics.',
                'type' => 'core',
                'credit_hours' => 3,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'SCI101',
                'name' => 'Science',
                'description' => 'Basic physics, chemistry, and biology concepts.',
                'type' => 'core',
                'credit_hours' => 4,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'GK101',
                'name' => 'General Knowledge',
                'description' => 'Awareness of current affairs and general information.',
                'type' => 'elective',
                'credit_hours' => 2,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'HLT101',
                'name' => 'Health',
                'description' => 'Basic health education and hygiene.',
                'type' => 'elective',
                'credit_hours' => 2,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'ACC101',
                'name' => 'Accounts',
                'description' => 'Fundamentals of accounting and bookkeeping.',
                'type' => 'core',
                'credit_hours' => 3,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'OMATH101',
                'name' => 'Optional Maths',
                'description' => 'Advanced topics in mathematics for interested students.',
                'type' => 'elective',
                'credit_hours' => 4,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('subjects')->insert($subjects);
    }
}
