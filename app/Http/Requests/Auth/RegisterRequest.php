<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => ['required', 'max:20'],
            'email' => ['required', 'email',  ],
            'password' => ['required',  'min:8', 'confirmed'],
            'password_confirmation' => ['required',  'min:8'],
        ];
    }



    public function messages(): array
    {
        return [
            'name.required' => 'お名前を入力してください。',
            'name.max' => '名前は20文字以内で入力してください。',
            'email.required' => 'メールアドレスを入力してください。',
            'email.email' => 'メールアドレスの形式が正しくありません。',
            'password.required' => 'パスワードは必須です。',
            'password.min' => 'パスワードは8文字以上でなければなりません。',
            'password.confirmed' => 'パスワード確認が一致しません。',
        ];




    }




    }



