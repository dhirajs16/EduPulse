<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\User;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get first five student users from users table
        $studentUsers = User::where('user_type', 'student')->take(5)->get();

        $studentsData = [
            [
                'avatar' => 'defaults/default_avatar.png',
                'first_name' => 'Ram',
                'middle_name' => null,
                'last_name' => 'Sharma',
                'date_of_birth' => '2005-04-15',
                'address' => 'Kathmandu',
                'city' => 'Kathmandu',
                'country' => 'Nepal',
                'postal_code' => '44600',
                'father_name' => 'Hari Prasad Sharma',
                'mother_name' => 'Sita Sharma',
                'guardian_name' => 'Hari Sharma',
                'guardian_contact' => '9800000001',
                'relationship_with_guardian' => 'Father',
                'grade_id' => 23,
            ],
            [
                'avatar' => 'defaults/default_avatar.png',
                'first_name' => 'Sita',
                'middle_name' => null,
                'last_name' => 'Devi',
                'date_of_birth' => '2006-06-18',
                'address' => 'Pokhara',
                'city' => 'Pokhara',
                'country' => 'Nepal',
                'postal_code' => '33700',
                'father_name' => 'Gopal Devi',
                'mother_name' => 'Kamala Devi',
                'guardian_name' => 'Gopal Devi',
                'guardian_contact' => '9800000002',
                'relationship_with_guardian' => 'Father',
                'grade_id' => 24,
            ],
            [
                'avatar' => 'defaults/default_avatar.png',
                'first_name' => 'Bipin',
                'middle_name' => null,
                'last_name' => 'Kumal',
                'date_of_birth' => '2005-12-02',
                'address' => 'Biratnagar',
                'city' => 'Biratnagar',
                'country' => 'Nepal',
                'postal_code' => '56700',
                'father_name' => 'Ram Kumar Kumal',
                'mother_name' => 'Sita Kumal',
                'guardian_name' => 'Ram Kumar Kumal',
                'guardian_contact' => '9800000003',
                'relationship_with_guardian' => 'Father',
                'grade_id' => 24,
            ],
            [
                'avatar' => 'defaults/default_avatar.png',
                'first_name' => 'Asha',
                'middle_name' => null,
                'last_name' => 'Magar',
                'date_of_birth' => '2006-01-22',
                'address' => 'Lalitpur',
                'city' => 'Lalitpur',
                'country' => 'Nepal',
                'postal_code' => '44700',
                'father_name' => 'Dhan Bahadur Magar',
                'mother_name' => 'Gita Magar',
                'guardian_name' => 'Dhan Bahadur Magar',
                'guardian_contact' => '9800000004',
                'relationship_with_guardian' => 'Father',
                'grade_id' => 23,
            ],
            [
                'avatar' => 'defaults/default_avatar.png',
                'first_name' => 'Binod',
                'middle_name' => null,
                'last_name' => 'Thapa',
                'date_of_birth' => '2005-09-10',
                'address' => 'Hetauda',
                'city' => 'Hetauda',
                'country' => 'Nepal',
                'postal_code' => '44100',
                'father_name' => 'Ram Thapa',
                'mother_name' => 'Laxmi Thapa',
                'guardian_name' => 'Ram Thapa',
                'guardian_contact' => '9800000005',
                'relationship_with_guardian' => 'Father',
                'grade_id' => 24,
            ],
        ];

        foreach ($studentsData as $index => $student) {
            Student::create([
                'avatar' => $student['avatar'],
                'first_name' => $student['first_name'],
                'middle_name' => $student['middle_name'],
                'last_name' => $student['last_name'],
                'date_of_birth' => $student['date_of_birth'],
                'address' => $student['address'],
                'city' => $student['city'],
                'country' => $student['country'],
                'postal_code' => $student['postal_code'],
                'father_name' => $student['father_name'],
                'mother_name' => $student['mother_name'],
                'guardian_name' => $student['guardian_name'],
                'guardian_contact' => $student['guardian_contact'],
                'relationship_with_guardian' => $student['relationship_with_guardian'],
                'user_id' => $studentUsers[$index]->id,
                'grade_id' => $student['grade_id'],
            ]);
        }
    }
}
