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
            'name' => 'required | string | max:50',
            'area_id' => 'required',
            'genre_id' => 'required',
            'description' => 'required | string | max:400',
            'image' => 'required | mimes:jpg,jpeg,png',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '店舗名を入力してください。',
            'name.string' => '店舗名は文字列で入力してください。',
            'name.max' => '店舗名の最大文字数は50文字です。',
            'area_id.required' => '地域を入力してください。',
            'genre_id.required' => 'ジャンルを入力してください。',
            'description.required' => '店舗詳細を入力してください。',
            'description.string' => '店舗詳細は文字列で入力してください。',
            'description.max' => '店舗詳細の最大文字数は400文字です。',
            'image.required' => '画像を設定してください。',
            'image.mimes' => 'アップロード可能なファイルの拡張子は"jpg,jpeg,png"です',
        ];
    }
}
