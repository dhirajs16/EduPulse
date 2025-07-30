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
            'fee_type_id' => 'required|exists:fee_types,id',
            'grade_id' => 'required|exists:grades,id',
            'amount' => 'required|numeric|min:0',
            'year' => 'required|digits:4|integer|min:1900|max:' . (date('Y') + 5),
            'month' => 'required|integer|min:1|max:12',
            // Unique constraint ignoring current record for combination
            'fee_type_id' => [
                'required',
                'exists:fee_types,id',
                Rule::unique('fees')->where(function ($query) {
                    return $query->where('grade_id', $this->input('grade_id'))
                                 ->where('year', $this->input('year'))
                                 ->where('month', $this->input('month'));
                })->ignore($feeId),
            ],
            'grade_id' => 'required|exists:grades,id',
        ];
    }
}
