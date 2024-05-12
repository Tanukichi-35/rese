<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
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
            'rate' => 'required|integer|between:1,5',
            'comment' => 'string|max:400',
        ];
    }


    public function messages()
    {
        return [
            'rate.required' => '評価レートを入力してください',
            'rate.integer' => '評価レートは数字の1～5で入力してください',
            'rate.between' => '評価レートは数字の1～5で入力してください',
            'comment.string' => '口コミは文字列で入力してください',
            'comment.max' => '人数を入力してください',
        ];
    }
}
