<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ManagerRequest;
use App\Http\Requests\StoreRequest;
use App\Models\User;
use App\Models\Manager;
use App\Models\Store;
use Auth;
use FileIO;

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

    // ユーザー一覧ページを表示
    public function users(){
        // 全てのユーザーを取得
        $users = User::Paginate(10);

        return view('admin.users', compact('users'));
    }

    // 店舗代表者一覧ページを表示
    public function managers(){
        // 全ての店舗代表者を取得
        $managers = Manager::Paginate(10);

        return view('admin.managers', compact('managers'));
    }

    // 店舗代表者の新規登録ページを表示
    public function managerRegister(){
        return view('admin.managerRegister');
    }

    // 店舗代表者の登録
    public function managerCreate(ManagerRequest $request){

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

    // 店舗代表者の削除
    public function managerBatchDestroy(Request $request){
        foreach (Manager::all() as $manager) {
            if(!is_null($request->input($manager->id))){
                $manager->delete();
            }
        };

        // 画面を更新
        // return redirect()->route('admin.managers');
        $message = '登録情報を削除しました';
        return redirect()->route('admin.managers')->with(compact('message'));
    }

    // 店舗代表者情報の更新ページの表示
    public function managerEdit($manager_id){
        // IDが一致する店舗代表者を取得
        $manager = Manager::find($manager_id);

        return view('admin.managerEditer', compact('manager'));
    }

    // 店舗代表者情報の更新
    public function managerRestore(Request $request){
        $manager = Manager::find($request->id);

        // 店舗代表者情報の更新
        $manager->update([
            'name' => !is_null($request->name)?$request->name:$manager->name,
            'email' => !is_null($request->email)?$request->email:$manager->email,
        ]);

        // 画面を更新
        // return redirect()->route('admin.managers');
        $message = '登録情報を更新しました';
        return redirect()->route('admin.managers')->with(compact('message'));
    }

    // 店舗代表者の削除
    public function managerDestroy(Request $request){
        $manager = Manager::find($request->id);
        $manager->delete();

        // 画面を更新
        //return redirect()->route('admin.managers');
        $message = '登録情報を削除しました';
        return redirect()->route('admin.managers')->with(compact('message'));
    }

    // 店舗一覧ページを表示
    public function stores(){
        // 全ての店舗を取得
        $stores = Store::Paginate(10);

        return view('admin.stores', compact('stores'));
    }
}
