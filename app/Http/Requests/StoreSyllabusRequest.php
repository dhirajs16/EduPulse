<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreSyllabusRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Adjust authorization if needed
        return true;
    }

    public function rules(): array
    {
        return [
            'grade_id' => ['required', 'exists:grades,id'],
            'subject_id' => ['required', 'exists:subjects,id'],
            'chapter_number' => [
                'required', 'integer', 'min:1',
                Rule::unique('syllabi')->where(function ($query) {
                    return $query->where('grade_id', $this->input('grade_id'))
                                 ->where('subject_id', $this->input('subject_id'));
                }),
            ],
            'title' => ['required', 'string', 'max:255'],
            'sub_topics' => ['required', 'string'],
            'credit_hours' => ['required', 'integer', 'min:0'],
        ];
    }
}
