<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;
use Auth;

class AuthController extends Controller
{
    // // 飲食店一覧ページを表示
    // public function index(){
    //     // 全ての飲食店を取得
    //     $stores = Store::All();

    //     return view('index', compact('stores'));
    // }

    // マイページを表示
    public function mypage(){
        $user = Auth::user();
        // 予約情報を取得
        $bookings = $user->bookings;
        // お気に入り店を取得
        $stores = $user->favoriteStores();

        return view('mypage', compact('user','bookings', 'stores'));
    }
}
