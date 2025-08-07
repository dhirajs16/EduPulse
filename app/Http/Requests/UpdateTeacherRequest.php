<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTeacherRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $teacherId = $this->route('teacher');

        return [
            'avatar' => ['nullable', 'image', 'max:2048'],
            'prefix' => ['required', 'string', 'max:55'],
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'in:male,female,other'],
            'date_of_birth' => ['nullable', 'date', 'before:' . now()->subYears(15)->toDateString()],
            'nid' => ['nullable', 'string', 'max:255'],
            'contact' => ['nullable', 'string', 'max:255'],
            'personal_email' => ['nullable', 'email', Rule::unique('teachers', 'personal_email')->ignore($teacherId)],
            'address' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:255'],
            'country' => ['nullable', 'string', 'max:255'],
            'postal_code' => ['nullable', 'string', 'max:255'],
            'salary' => ['nullable', 'numeric'],
            'joining_date' => ['nullable', 'date'],
            'qualification' => ['nullable', 'string', 'max:255'],


            'user_id' => ['required', 'exists:teachers,user_id'],

            // 'grade_subjects' => ['nullable', 'array'],
            // 'grade_subjects.*.grade_id' => ['required', 'exists:grades,id'],
            // 'grade_subjects.*.subject_id' => ['required', 'exists:subjects,id'],
        ];
    }
}
