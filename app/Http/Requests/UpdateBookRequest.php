<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Modify as per authorization needs
    }

    public function rules(): array
    {
        $bookId = $this->route('book');

        return [
            'title' => 'required|string|max:255',
            'isbn' => [
                'required',
                'string',
                'max:255',
                Rule::unique('books', 'isbn')->ignore($bookId),
            ],
            'cover_image' => 'nullable|string|max:255',
            'publication_year' => 'nullable|integer|min:0',
            'publisher' => 'nullable|string|max:255',
            'total_copies' => 'nullable|integer|min:1',
            'available_copies' => 'nullable|integer|min:0',
            'category_name' => 'nullable|string|max:255',
        ];
    }
}
