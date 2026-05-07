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
        
        'image'    => ['nullable', 'image', 'mimes:jpeg,png'],
        'name'     => ['required',  'max:20'],
        'postcode' => ['required',  'regex:/^[0-9]{3}-[0-9]{4}$/'],
        'address'=> ['required' ],
    ];
    }
    public function messages()
    {
    return [

        'postcode.required' => '郵便番号を入力してください。',
        'postcode.regex' => '郵便番号はハイフンを含めた形式（例: 123-4567）で入力してください。',
        'name.required' => 'お名前を入力してください。',
        'address.required' => '住所を入力してください。',
    ];
}
}