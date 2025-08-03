<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Adjust authorization rules as needed
        return true;
    }

    public function rules(): array
    {
        $userId = $this->route('user');

        return [
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($userId)],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'user_type' => ['required', Rule::in(['student', 'teacher'])],
            'email_verified_at' => ['nullable', 'date'],
        ];
    }
}
