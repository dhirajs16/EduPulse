<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TimeTableSeeder extends Seeder
{
    public function run(): void
    {
        $gradeId = 24; // grade 10 A

        // Define period times (1 hour each, starting from 09:30, skip 12:30-13:00 for lunch)
        $periodTimes = [
            ['start_time' => '09:30:00', 'end_time' => '10:30:00'],
            ['start_time' => '10:30:00', 'end_time' => '11:30:00'],
            ['start_time' => '11:30:00', 'end_time' => '12:30:00'],
            // Lunch break: 12:30 - 13:00
            ['start_time' => '13:00:00', 'end_time' => '14:00:00'],
            ['start_time' => '14:00:00', 'end_time' => '15:00:00'],
            ['start_time' => '15:00:00', 'end_time' => '16:00:00'],
        ];

        // Define weekly schedule: day => array of [teacher_id, subject_id]
        $schedule = [
            'Sunday' => [
                ['teacher_id' => 1, 'subject_id' => 1],
                ['teacher_id' => 1, 'subject_id' => 10],
                ['teacher_id' => 2, 'subject_id' => 2],
                ['teacher_id' => 3, 'subject_id' => 3],
                ['teacher_id' => 4, 'subject_id' => 4],
                ['teacher_id' => 5, 'subject_id' => 5],
            ],
            'Monday' => [
                ['teacher_id' => 1, 'subject_id' => 10],
                ['teacher_id' => 2, 'subject_id' => 2],
                ['teacher_id' => 3, 'subject_id' => 3],
                ['teacher_id' => 1, 'subject_id' => 1],
                ['teacher_id' => 4, 'subject_id' => 4],
                ['teacher_id' => 5, 'subject_id' => 5],
            ],
            'Tuesday' => [
                ['teacher_id' => 1, 'subject_id' => 1],
                ['teacher_id' => 3, 'subject_id' => 3],
                ['teacher_id' => 5, 'subject_id' => 5],
                ['teacher_id' => 4, 'subject_id' => 4],
                ['teacher_id' => 1, 'subject_id' => 10],
                // If you want only 5 periods, remove the last one from periodTimes or here
                ['teacher_id' => 2, 'subject_id' => 2],
            ],
            'Wednesday' => [
                ['teacher_id' => 1, 'subject_id' => 10],
                ['teacher_id' => 2, 'subject_id' => 2],
                ['teacher_id' => 5, 'subject_id' => 5],
                ['teacher_id' => 1, 'subject_id' => 1],
                ['teacher_id' => 4, 'subject_id' => 4],
                ['teacher_id' => 3, 'subject_id' => 3],
            ],
            'Thursday' => [
                ['teacher_id' => 3, 'subject_id' => 3],
                ['teacher_id' => 1, 'subject_id' => 1],
                ['teacher_id' => 5, 'subject_id' => 5],
                ['teacher_id' => 1, 'subject_id' => 10],
                ['teacher_id' => 4, 'subject_id' => 4],
                ['teacher_id' => 2, 'subject_id' => 2],
            ],
            'Friday' => [
                ['teacher_id' => 1, 'subject_id' => 1],
                ['teacher_id' => 2, 'subject_id' => 2],
                ['teacher_id' => 3, 'subject_id' => 3],
                ['teacher_id' => 4, 'subject_id' => 4],
                ['teacher_id' => 5, 'subject_id' => 5],
                ['teacher_id' => 1, 'subject_id' => 10],
            ],
        ];

        foreach ($schedule as $day => $periods) {
            foreach ($periods as $i => $period) {
                // Skip if there are more subjects than period times
                if (!isset($periodTimes[$i])) {
                    continue;
                }
                DB::table('time_tables')->insert([
                    'grade_id' => $gradeId,
                    'teacher_id' => $period['teacher_id'],
                    'subject_id' => $period['subject_id'],
                    'day' => $day,
                    'start_time' => $periodTimes[$i]['start_time'],
                    'end_time' => $periodTimes[$i]['end_time'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
