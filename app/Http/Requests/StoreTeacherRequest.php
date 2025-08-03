<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTeacherRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'avatar' => ['nullable', 'string', 'max:255'],
            'prefix' => ['required', 'string', 'max:55'],
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'in:male,female,other'],
            'date_of_birth' => ['nullable', 'date'],
            'nid' => ['nullable', 'string', 'max:255'],
            'contact' => ['nullable', 'string', 'max:255'],
            'personal_email' => ['nullable', 'email', 'unique:teachers,personal_email'],
            'address' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:255'],
            'country' => ['nullable', 'string', 'max:255'],
            'postal_code' => ['nullable', 'string', 'max:255'],
            'salary' => ['nullable', 'numeric'],
            'joining_date' => ['nullable', 'date'],
            'qualification' => ['nullable', 'string', 'max:255'],

            'user_id' => ['required', 'exists:users,id'],

            // grade_subjects is array of arrays like [['grade_id' => 1, 'subject_id' => 2], ...]
            'grade_subjects' => ['nullable', 'array'],
            'grade_subjects.*.grade_id' => ['required', 'exists:grades,id'],
            'grade_subjects.*.subject_id' => ['required', 'exists:subjects,id'],
        ];
    }
}
