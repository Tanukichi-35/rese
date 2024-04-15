<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Manager;
use Auth;

class ManagerRequest extends FormRequest
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
        // 編集中のデータは重複チェックから外す
        if(is_null($this->id))
            $manager = Auth::guard('managers')->user();
        else
            $manager = Manager::find($this->id);
        
        if(is_null($manager)){
            return [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:managers,email',
                'password' => 'required|string|max:255',
            ];
        }
        else{
            return [
                'name' => 'required|string|max:255',
                'email' => ['required','string','email','max:255','unique:managers,email,'.$manager->email.',email'],
                'password' => 'required|string|max:255',
            ];
        }
    }

    public function messages()
    {
        return [
            'name.required' => '氏名を入力してください',
            'name.string' => '氏名は文字列で入力してください',
            'name.max' => '氏名は255文字以内です',
            'email.required' => 'メールアドレスを入力してください',
            'email.string' => 'メールアドレスは文字列で入力してください',
            'email.email' => '有効なメールアドレス形式を入力してください',
            'email.unique' => '登録済みのメールアドレスです',
            'email.max' => 'メールアドレスは255文字以内です',
            'password.required' => 'パスワードを入力してください',
            'password.string' => 'パスワードは文字列で入力してください',
            'password.max' => 'パスワードは255文字以内です',
        ];
    }
}
