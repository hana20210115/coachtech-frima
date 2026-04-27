<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExhibitionRequest extends FormRequest
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
            'name'         => ['required'],
            'description'  => ['required''max:255'],
            'image'        => ['required', 'image', 'mimes:jpeg,png'],
            'category_ids' => ['required', 'array'], 
            'condition_id' => ['required'], 
            'price'        => ['required', 'integer', 'min:0'],
        ];
    }


    public function messages(): array
    {
        return [
            'name.required'         => '商品名を入力してください',
            'description.required'  => '商品の説明を入力してください',
            'description.max'       => '商品説明は255文字以内で入力してください',
            'image.required'        => '商品画像をアップロードしてください',
            'image.mimes'           => '画像形式は .jpeg または .png を選択してください',
            'category_ids.required' => 'カテゴリーを選択してください',
            'condition_id.required' => '商品の状態を選択してください',
            'price.required'        => '商品価格を入力してください',
            'price.integer'         => '数値で入力してください',
            'price.min'             => '0円以上で入力してください',
        ];
    }
}
