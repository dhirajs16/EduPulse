<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGradeTeacherRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $gradeTeacherId = $this->route('grade_teacher'); // route param name

        return [
            'grade_id' => ['required', 'exists:grades,id'],
            'teacher_id' => ['required', 'exists:teachers,id'],
            'subject_id' => ['required', 'exists:subjects,id'],
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $exists = \App\Models\GradeTeacher::where('grade_id', $this->grade_id)
                ->where('teacher_id', $this->teacher_id)
                ->where('subject_id', $this->subject_id)
                ->where('id', '<>', $this->route('grade_teacher')) // exclude current record
                ->exists();

            if ($exists) {
                $validator->errors()->add('teacher_id', 'This teacher is already assigned to this grade and subject.');
            }
        });
    }
}
