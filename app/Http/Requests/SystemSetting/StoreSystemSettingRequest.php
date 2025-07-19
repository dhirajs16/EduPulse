<?php

namespace App\Http\Requests\SystemSetting;

use Illuminate\Foundation\Http\FormRequest;

class StoreSystemSettingRequest extends FormRequest
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
            'key'         => ['required', 'string', 'max:100', 'unique:system_settings,key'],
            'value'       => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'status'      => ['nullable', 'integer', 'in:0,1,2'],
            'code'        => ['nullable', 'integer'],
        ];
    }
}
