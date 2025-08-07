<?php

namespace App\Http\Requests;

use App\Models\Fee;
use App\Models\Transaction;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTransactionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'student_id' => 'required|exists:students,id',
            'fee_id' => 'required|exists:fees,id',
            'amount_paid' => 'required|numeric|min:0',
            'payment_date' => 'required|date|after_or_equal:today',
            'notes' => 'nullable|string|max:1000',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            
            if (floatVal($this->amount_paid) > floatVal(Fee::find($this->fee_id)->amount)) {
                $validator->errors()->add('amount_paid', 'The amount exceeds the fee amount.');
            }
        });
    }
}
