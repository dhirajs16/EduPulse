<?php

namespace App\Http\Requests;

use App\Models\Fee;
use Illuminate\Foundation\Http\FormRequest;

class StoreFeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'grade_id' => 'required|exists:grades,id',
            'amount' => 'required|numeric|min:0',
            'year' => 'required|digits:4|integer|min:1900|max:' . (date('Y') + 2),
            'month' => 'required|integer|min:1|max:12',
        ];
    }

    public function messages()
    {
        return [
            'month.min' => 'Month must be between Jan and Dec.',
            'month.max' => 'Month must be between Jan and Dec.',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (Fee::where('name', $this->name)
            ->where('grade_id', $this->grade_id)
            ->where('year', $this->year)
            ->where('month', $this->month)
            ->exists()) {
                $validator->errors()->add('name', 'A fee entry with the same name, grade, year, and month already exists.');
            }
        });
    }
}
