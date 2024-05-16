<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoresRequest extends FormRequest
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
            'names.*' => 'required | string | max:50',
            'area_ids.*' => 'required | integer | min:2',
            'genre_ids.*' => 'required | integer | min:2',
            'descriptions.*' => 'required | string | max:400',
            'imageURLs.*' => 'required',
            'images.*' => 'mimes:jpg,jpeg,png',
        ];
    }

    public function messages()
    {
        return [
            'names.*.required' => '店舗名が空のデータが存在します。',
            'names.*.string' => '店舗名は文字列で入力してください。',
            'names.*.max' => '店舗名の最大文字数は50文字です。',
            'area_ids.*.required' => '地域が空のデータが存在します。',
            'area_ids.*.integer' => '地域IDは数値で数値で指定してください',
            'area_ids.*.min' => '地域にその他が選択されているデータがあります',
            'genre_ids.*.required' => 'ジャンルが空のデータが存在します。',
            'genre_ids.*.integer' => 'ジャンルIDは数値で数値で指定してください',
            'genre_ids.*.min' => 'ジャンルにその他が選択されているデータがあります',
            'descriptions.*.required' => '店舗詳細が空のデータが存在します。',
            'descriptions.*.string' => '店舗詳細は文字列で入力してください。',
            'descriptions.*.max' => '店舗詳細の最大文字数は400文字です。',
            'imageURLs.*.required' => '画像が設定されていないデータが存在します。',
            'images.*.mimes' => 'アップロード可能なファイルの拡張子は"jpg,jpeg,png"です',
        ];
    }
}
