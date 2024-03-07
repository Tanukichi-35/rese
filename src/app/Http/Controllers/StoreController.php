<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;

class StoreController extends Controller
{
    // ユーザー別勤怠ページを表示
    public function showDetail($store_id){
        // ユーザーIDが一致するユーザーを取得
        $store = Store::find($store_id);

        return view('detail', compact('store'));
    }

    public function search(Request $request){
        $stores = Store::with('area')->AreaSearch($request->area_id)->CategorySearch($request->category_id)->StoreSearch($request->store_name)->get();

        return view('index', compact('stores', 'request'));

        // $response = response()->view('admin', compact('contacts', 'categories', 'request'));
        // $response->cookie('search_keyword', $request->Keyword, 3);
        // $response->cookie('search_gender', $request->gender, 3);
        // $response->cookie('search_category_id', $request->category_id, 3);
        // $response->cookie('search_date', $request->date, 3);

        // return $response;
    }
}
