<?php

namespace Database\Seeders;

use App\Models\Syllabus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SyllabusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $syllabi = [
            [
                'grade_id' => 24,
                'subject_id' => 6,
                'chapter_number' => 1,
                'title' => 'Scientific Learning',
                'sub_topics' => 'Variables and its types, Importance of control variable, Differences between fundamental unit and derived units, Analysis of equation',
                'credit_hours' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'grade_id' => 24,
                'subject_id' => 6,
                'chapter_number' => 2,
                'title' => 'Classification of Organism',
                'sub_topics' => 'Concept of five kingdom system, Characteristics of phylum/division of Plantae & Animalia, Classification of angiosperm up to class, Classification of vertebrate up to class, Relation between organic evolution and classification',
                'credit_hours' => 8,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'grade_id' => 24,
                'subject_id' => 6,
                'chapter_number' => 3,
                'title' => 'Life cycle of Honey bee',
                'sub_topics' => 'Types of honey bee, Life cycle, Importance of honey and honey bee',
                'credit_hours' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'grade_id' => 24,
                'subject_id' => 6,
                'chapter_number' => 4,
                'title' => 'Nature and the Environment',
                'sub_topics' => 'Climate change – Introduction, causes and effects, Preventive measures, Endangered animals and conservation, Rare plants and conservation, Medicinal plants and conservation',
                'credit_hours' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'grade_id' => 24,
                'subject_id' => 6,
                'chapter_number' => 5,
                'title' => 'Force and Motion',
                'sub_topics' => 'Concept of Gravitation, Acceleration due to gravity and relation from Earth center to surface, Gravitational force and weight calculation, Free fall and application',
                'credit_hours' => 8,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'grade_id' => 24,
                'subject_id' => 6,
                'chapter_number' => 6,
                'title' => 'Pressure',
                'sub_topics' => "Pascal's Law and applications, Concept of upthrust in liquid and gas, Archimedes principle and applications",
                'credit_hours' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'grade_id' => 24,
                'subject_id' => 6,
                'chapter_number' => 7,
                'title' => 'Heat',
                'sub_topics' => 'Thermal energy introduction, Molecular movement effects on volume, Anomalous expansion of water and its importance',
                'credit_hours' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        Syllabus::insert($syllabi);
    }
}
