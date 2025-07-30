<?php

namespace App\Http\Requests;

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
            'fee_type_id' => 'required|exists:fee_types,id',
            'grade_id' => 'required|exists:grades,id',
            'amount' => 'required|numeric|min:0',
            'year' => 'required|digits:4|integer|min:1900|max:' . (date('Y') + 5),
            'month' => 'required|integer|min:1|max:12',
        ];
    }

    public function messages()
    {
        return [
            'month.min' => 'Month must be between 1 and 12.',
            'month.max' => 'Month must be between 1 and 12.',
        ];
    }
}
