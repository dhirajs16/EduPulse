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
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'prefix' => 'required|string|max:10',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|in:male,female,other',
            'date_of_birth' => 'nullable|date',
            'nid' => 'nullable|string|max:100',
            'contact' => 'nullable|string|max:50',
            'personal_email' => 'nullable|email|unique:teachers,personal_email',
            'address' => 'nullable|string|max:500',
            'city' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:20',
            'salary' => 'nullable|numeric|min:0',
            'joining_date' => 'nullable|date',
            'qualification' => 'nullable|string|max:255',
            'user_id' => 'required|exists:users,id',
        ];
    }
}
