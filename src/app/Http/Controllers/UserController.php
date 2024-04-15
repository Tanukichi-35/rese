<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    // 管理者 //

    // ユーザー一覧ページを表示
    public function users(){
        // 全てのユーザーを取得
        $users = User::Paginate(10);

        return view('admin.users', compact('users'));
    }
}
