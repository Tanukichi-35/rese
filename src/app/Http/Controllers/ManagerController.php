<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ManagerRequest;
use App\Http\Requests\PasswordRequest;
use App\Models\Manager;
use Auth;
use Hash;

class ManagerController extends Controller
{
    // ログインページの表示
    public function entrance()
    {
        return view('manager.login');
    }

    // ログイン処理
    public function login(LoginRequest $request)
    {
        $credentials = $request->only(['email', 'password']);

        // ログイン処理
        if (Auth::guard('managers')->attempt($credentials)) {
            // ログイン成功
            return redirect()->route('manager.stores');
        }

        // ログイン失敗
        return back()->with('failure', 'メールアドレス、あるいはパスワードが間違っています。');
    }

    // ログアウト処理
    public function logout(Request $request)
    {
        Auth::guard('managers')->logout();
        $request->session()->regenerateToken();

        // ログインページにリダイレクト
        return redirect()->route('manager.login');
    }

    // 店舗代表者情報ページの表示
    public function info()
    {
        // ログインユーザーの取得
        $manager = Auth::guard('managers')->user();

        return view('manager.info', compact('manager'));
    }

    // 店舗代表者一覧ページを表示
    public function managers()
    {
        // 全ての店舗代表者を取得
        $managers = Manager::Paginate(10);

        return view('admin.managers', compact('managers'));
    }

    // 店舗代表者の新規登録ページを表示
    public function register()
    {
        return view('admin.managerRegister');
    }

    // 店舗代表者の登録
    public function create(ManagerRequest $request)
    {

        // 店舗代表者を登録
        Manager::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // 画面を更新
        // return redirect()->route('admin.managers');
        $message = '新しく店舗代表者を登録しました';
        return redirect()->route('admin.managers')->with(compact('message'));
    }

    // 店舗代表者情報の更新ページの表示
    public function edit($manager_id)
    {
        // IDが一致する店舗代表者を取得
        $manager = Manager::find($manager_id);

        if (is_null($manager)) {
            $error = '店舗代表者情報が見つかりません';
            return redirect()->route('manager.stores')->with(compact('error'));
        }
        return view('admin.managerEditor', compact('manager'));
    }

    // 店舗代表者情報の更新
    // public function restore(Request $request){
    public function restore(ManagerRequest $request)
    {
        if (Auth::guard('admins')->check()) {         // 管理者権限
            // 該当店舗代表者の取得
            $manager = Manager::find($request->id);
            $routeName = 'admin.managers';
        } else if (Auth::guard('managers')->check()) {  // 店舗代表者権限
            // ログインユーザーの取得
            $manager = Auth::guard('managers')->user();
            $routeName = 'manager.info';
        }

        // 店舗代表者情報の更新
        $manager->update([
            'name' => !is_null($request->name) ? $request->name : $manager->name,
            'email' => !is_null($request->email) ? $request->email : $manager->email,
        ]);

        // 画面を更新
        $message = '登録情報を更新しました';
        return redirect()->route($routeName)->with(compact('message'));
    }

    // パスワードの変更ページを表示
    public function password()
    {
        // ログインユーザーの取得
        $manager = Auth::guard('managers')->user();
        // dd($manager);

        return view('manager.password', compact('manager'));
    }

    // パスワードの更新
    public function passwordRestore(PasswordRequest $request)
    {
        $manager = Manager::find($request->id);

        if (!Hash::check($request->oldPassword, $manager->password)) {
            return back()->with('failure', '元のパスワードが一致しません');
        }

        if ($request->password != $request->confirmPassword) {
            return back()->with('failure', '確認用パスワードが一致しません');
        }

        // パスワードの更新
        $manager->update([
            'password' => Hash::make($request->password)
        ]);

        // 画面を更新
        $message = 'パスワードを更新しました';
        return redirect()->route('manager.info')->with(compact('message'));
    }

    // 店舗代表者の削除
    public function destroy(Request $request)
    {
        $manager = Manager::find($request->id);
        $manager->delete();

        // 画面を更新
        $error = '登録情報を削除しました';
        return redirect()->route('admin.managers')->with(compact('error'));
    }

    // 店舗代表者の一括削除
    public function BatchDestroy(Request $request)
    {
        foreach (Manager::all() as $manager) {
            if (!is_null($request->input($manager->id))) {
                $manager->delete();
            }
        };

        // 画面を更新
        $error = '登録情報を削除しました';
        return redirect()->route('admin.managers')->with(compact('error'));
    }
}
