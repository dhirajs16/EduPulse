<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateFeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $feeId = $this->route('fee'); // assumes route model binding or id parameter named 'fee'

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('fees', 'name')->ignore($this->route('fee') ?? $this->fee),
            ],
            'description' => 'nullable|string|max:1000',
            'grade_id' => 'required|exists:grades,id',
            'amount' => 'required|numeric|min:0',
            'year' => 'required|digits:4|integer|min:1900|max:' . (date('Y') + 2),
            'month' => 'required|integer|min:1|max:12',
            'grade_id' => 'required|exists:grades,id',
        ];
    }
}
