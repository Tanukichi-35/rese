<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'name' => 'required | string | max:255',
            'manager_id' => 'required',
            'area_id' => 'required',
            'genre_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '店舗名を入力してください。'
            'name.string' => '店舗名は文字列で入力してください。'
            'name.max' => '店舗名の最大文字数は255文字です。'
            'manager_id.required' => '店舗代表者が設定されていません。',
            'area_id.required' => '地域を入力してください。',
            'genre_id.required' => 'ジャンルを入力してください。',
            'cost.required' => '料金が入力されていません。',
            'status.required' => 'ステータスが入力されていません。',
        ];
    }
}
