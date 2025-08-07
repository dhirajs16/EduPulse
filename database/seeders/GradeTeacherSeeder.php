<?php

namespace Database\Seeders;

use App\Models\GradeTeacher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GradeTeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        GradeTeacher::insert(
            [
                [
                    'grade_id' => 24,
                    'teacher_id' => 2,
                    'subject_id' => 2,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'grade_id' => 24,
                    'teacher_id' => 1,
                    'subject_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'grade_id' => 24,
                    'teacher_id' => 1,
                    'subject_id' => 10,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'grade_id' => 24,
                    'teacher_id' => 3,
                    'subject_id' => 3,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'grade_id' => 24,
                    'teacher_id' => 1,
                    'subject_id' => 10,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'grade_id' => 24,
                    'teacher_id' => 1,
                    'subject_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'grade_id' => 24,
                    'teacher_id' => 4,
                    'subject_id' => 4,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'grade_id' => 24,
                    'teacher_id' => 5,
                    'subject_id' => 5,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'grade_id' => 23,
                    'teacher_id' => 1,
                    'subject_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'grade_id' => 23,
                    'teacher_id' => 1,
                    'subject_id' => 10,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'grade_id' => 23,
                    'teacher_id' => 3,
                    'subject_id' => 3,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'grade_id' => 22,
                    'teacher_id' => 1,
                    'subject_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],

            ]
        );
    }
}
