<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:20'],
            'email' => ['required', 'email'], 
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required', 'string', 'min:8'],
        ], [
            'name.required' => 'お名前を入力してください。',
            'name.max' => '名前は20文字以内で入力してください。',
            'email.required' => 'メールアドレスを入力してください。',
            'email.email' => 'メールアドレスの形式が正しくありません。',
            'password.required' => 'パスワードは必須です。',
            'password.min' => 'パスワードは8文字以上でなければなりません。',
            'password.confirmed' => 'パスワード確認が一致しません。',
            'password_confirmation.required' => '確認用パスワードを入力してください。',
            'password_confirmation.min' => '確認用パスワードは8文字以上でなければなりません。',
        ])->validate();

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }
}