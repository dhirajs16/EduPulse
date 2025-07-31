<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'code' => 'required|string|max:50|unique:subjects,code',
            'name' => 'required|string|max:255|unique:subjects,name',
            'description' => 'nullable|string',
            'type' => 'required|in:core,elective',
            'credit_hours' => 'required|integer|min:0',
            'status' => 'required|in:active,inactive',
        ];
    }
}
