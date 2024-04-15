<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Auth;

class AdminController extends Controller
{
    // ログインページの表示
    public function entrance(){
        return view('admin.login');
    }

    // ログイン処理
    public function login(LoginRequest $request){
        $credentials = $request->only(['email', 'password']);

        // ログイン処理
        if (Auth::guard('admins')->attempt($credentials)) {
            // ログイン成功
            return redirect()->route('admin.users');
        }

        // ログイン失敗
        return back()->with('failure' , 'メールアドレス、あるいはパスワードが間違っています。');
    }

    // ログアウト処理
    public function logout(Request $request){
        Auth::guard('admins')->logout();
        $request->session()->regenerateToken();

        // ログインページにリダイレクト
        return redirect()->route('admin.login');
    }
}
