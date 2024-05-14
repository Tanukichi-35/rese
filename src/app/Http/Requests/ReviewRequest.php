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
            'comment' => 'required|string|max:400',
            'images' => 'max:5',
            'images.*' => 'max:1024|mimes:jpg,jpeg,png'
        ];
    }


    public function messages()
    {
        return [
            'rate.required' => '評価レートを入力してください',
            'rate.integer' => '評価レートは数字の1～5で入力してください',
            'rate.between' => '評価レートは数字の1～5で入力してください',
            'comment.required' => '口コミを入力してください',
            'comment.string' => '口コミは文字列で入力してください',
            'comment.max' => '口コミは400文字以内で入力してください',
            'images.max' => 'アップロード可能な画像は最大5枚です',
            'images.*.max' => 'アップロード可能な画像のサイズは最大1MBです',
            'images.*.mimes' => 'アップロード可能なファイルの拡張子は"jpg,jpeg,png"です',
        ];
    }
}
