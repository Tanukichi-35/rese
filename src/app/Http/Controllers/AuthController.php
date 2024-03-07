<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;

class AuthController extends Controller
{
    // 飲食店一覧ページを表示
    public function index(){
        // 全ての飲食店を取得
        $stores = Store::All();
        return view('index', compact('stores'));
    }
}
