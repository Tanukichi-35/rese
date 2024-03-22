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
            'oldPassword' => 'required',
            'password' => 'required',
            'confirmPassword' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'oldPassword.required' => '元のパスワードを入力してください',
            'password.required' => 'パスワードを入力してください',
            'confirmPassword.required' => '確認のパスワードを入力してください',
        ];
    }
}
