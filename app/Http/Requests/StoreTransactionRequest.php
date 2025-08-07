<?php

namespace App\Http\Requests;

use App\Models\Fee;
use App\Models\Transaction;
use Illuminate\Foundation\Http\FormRequest;

class StoreTransactionRequest extends FormRequest
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
            if (Transaction::where('student_id', $this->student_id)->where('fee_id', $this->fee_id)->exists()) {

                // dd(floatVal(Fee::find($this->fee_id)->amount));
                if (floatVal($this->amount_paid) === floatVal(Fee::find($this->fee_id)->amount)) {
                    $validator->errors()->add('amount_paid', 'The amount is already paid.');
                }

                $validator->errors()->add('fee_id', 'This Transaction record already exists for the selected student and fee.');
            }

            if (floatVal($this->amount_paid) > floatVal(Fee::find($this->fee_id)->amount)) {
                $validator->errors()->add('amount_paid', 'The amount exceeds the fee amount.');
            }
        });
    }
}
