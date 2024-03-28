<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;

class StoreController extends Controller
{
    // 飲食店一覧ページを表示
    public function index(){
        // 全ての飲食店を取得
        $stores = Store::All();

        return view('index', compact('stores'));
    }

    // 飲食店詳細ページを表示
    public function showDetail($store_id){
        // IDが一致する飲食店を取得
        $store = Store::find($store_id);
        // 飲食店のレビューを取得
        $reviews = $store->reviews;

        return view('detail', compact('store', 'reviews'));
    }

    // 飲食店の検索を実施
    public function search(Request $request){
        $stores = Store::with('area')->AreaSearch($request->area_id)->GenreSearch($request->genre_id)->StoreSearch($request->store_name)->get();

        return view('index', compact('stores', 'request'));
    }
}
