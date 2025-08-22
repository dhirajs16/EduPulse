<?php

namespace Database\Seeders;

use App\Models\Syllabus;
use App\Models\Teacher;
use App\Models\TimeTable;
use App\Models\User;
use Database\Seeders\AdminSeeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Type\Time;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'email' => 'ram@gmail.com',
        //     'password' => bcrypt('12345678')
        // ]);

        $this->call([
            UserSeeder::class,
            GradeSeeder::class,
            RolePermissionSeeder::class,
            AdminSeeder::class,
            SubjectSeeder::class,
            StudentSeeder::class,
            TeacherSeeder::class,
            GradeTeacherSeeder::class,
            TimeTableSeeder::class,
            SyllabusSeeder::class,
        ]);
    }
}
