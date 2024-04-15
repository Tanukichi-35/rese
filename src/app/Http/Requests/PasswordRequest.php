<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'oldPassword' => 'required|string|max:255',
            'password' => 'required|string|max:255',
            'confirmPassword' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'oldPassword.required' => '元のパスワードを入力してください',
            'oldPassword.string' => '元のパスワードは文字列で入力してください',
            'oldPassword.max' => '元のパスワードは255文字以内です',
            'password.required' => 'パスワードを入力してください',
            'password.string' => 'パスワードは文字列で入力してください',
            'password.max' => 'パスワードは255文字以内です',
            'confirmPassword.required' => '確認のパスワードを入力してください',
            'confirmPassword.string' => '確認のパスワードは文字列で入力してください',
            'confirmPassword.max' => '確認のパスワードは255文字以内です',
        ];
    }
}
