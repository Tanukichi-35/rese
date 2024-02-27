<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // 打刻ページを表示
    public function index(){
        // ログイン中のユーザーを取得
        $user = Auth::user();
        return view('index', compact('user'));
    }
}
