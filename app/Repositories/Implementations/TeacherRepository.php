<?php

namespace App\Repositories\Implementations;

use App\Models\GradeTeacher;
use App\Models\Teacher;
use App\Repositories\Interfaces\TeacherRepositoryInterface;

class TeacherRepository implements TeacherRepositoryInterface
{
    public function all()
    {
        // Load grades and subjects via grade_teachers pivot relation
        // We'll eager load the pivot data so we have subjects with grades
        return Teacher::with(['grades', 'subjects'])->get();
    }

    public function find($id)
    {
        return Teacher::with(['grades', 'subjects'])->findOrFail($id);
    }

    public function create(array $data)
    {
        // Extract subjects, grades & their pivot relations from input if exist
        // But since subjects and grades connect through grade_teachers with pivot,
        // We handle them after creation

        // Create Teacher model first
        $teacher = Teacher::create($data);

        // Sync pivot table 'grade_teachers' records - but because pivot involves 3 ids,
        // we must handle via GradeTeacher model or raw insertion.

        // Here we expect $data['grade_subjects'] as array of arrays ['grade_id'=>x, 'subject_id'=>y]
        if (isset($data['grade_subjects']) && is_array($data['grade_subjects'])) {
            // Save grade_subject pivot entries
            foreach ($data['grade_subjects'] as $entry) {
                $teacher->grades()->attach($entry['grade_id']);
                // Note: 'grade_teachers' pivot table includes subject_id as well, so we need to insert to pivot manually:
                GradeTeacher::insert([
                    'teacher_id' => $teacher->id,
                    'grade_id' => $entry['grade_id'],
                    'subject_id' => $entry['subject_id'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        return $teacher;
    }

    public function update($id, array $data)
    {
        $teacher = $this->find($id);

        $teacher->update($data);

        // Sync grade_subject pivot entries similarly as in create

        if (isset($data['grade_subjects']) && is_array($data['grade_subjects'])) {
            // Remove old pivot data for this teacher
            GradeTeacher::where('teacher_id', $id)->delete();

            // Insert fresh
            foreach ($data['grade_subjects'] as $entry) {
                GradeTeacher::insert([
                    'teacher_id' => $id,
                    'grade_id' => $entry['grade_id'],
                    'subject_id' => $entry['subject_id'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        return $teacher;
    }

    public function delete($id)
    {
        // Delete pivot entries first
        GradeTeacher::where('teacher_id', $id)->delete();
        return Teacher::destroy($id);
    }
}
