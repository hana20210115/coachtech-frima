<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'postcode' => ['required', 'string', 'regex:/^[0-9]{3}-[0-9]{4}$/'],
            'address'  => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'postcode.required' => '郵便番号を入力してください',
            'postcode.regex'    => '郵便番号はハイフンを含めた8文字（例：123-4567）で入力してください',
            'address.required'  => '住所を入力してください',
        ];
    }
}