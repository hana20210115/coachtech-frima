<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:20',
            'postcode' => 'required|max:8|regex:/^\d{3}-\d{4}$/',
            'address' => 'required|max:255',
            'image' => 'nullable|image|mimes:jpeg,png',
        ];
    }
    public function messages()
    {
    return [
        'postcode.regex' => '郵便番号はハイフンを含めた形式（例: 123-4567）で入力してください。',
        'name.required' => 'お名前を入力してください。',
        'address.required' => '住所を入力してください。',
    ];
}
}