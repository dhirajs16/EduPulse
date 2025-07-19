<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:225'],
            'avatar'=> ['nullable', 'image', 'max:2000'],
            'email' => ['required', 'string', 'email', 'max:225', 'unique:users,email,'.$this->user()->id],
            'country' => ['required', 'string', 'max:225'],
            'city' => ['nullable', 'string', 'max:225'],
            'address' => ['nullable', 'string', 'max:225'],
        ];
    }
}
