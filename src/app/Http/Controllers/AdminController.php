<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Requests\AdminRequest;
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
    public function login(AdminRequest $request){
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

    // // ユーザーの作成
    // public function userCreate(Request $request){
    //     // dd($request);
    //     User::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => Hash::make($request->email)
    //     ]);

    //     // 画面を更新
    //     return redirect()->route('admin.users');
    // }

    // // ユーザーの削除
    // public function userBatchDestroy(Request $request){
    //     foreach (User::all() as $user) {
    //         if(!is_null($request->input($user->id))){
    //             $user->delete();
    //         }
    //     };

    //     // 画面を更新
    //     return redirect()->route('admin.users');
    // }

    // // ユーザー情報の更新
    // public function userRestore(Request $request){
    //     // dd($request);
    //     $user = User::find($request->id);
    //     // dd($user);
    //     $user->update([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //     ]);

    //     // 画面を更新
    //     return redirect()->route('admin.users');
    // }

    // // ユーザーの削除
    // public function userDestroy(Request $request){
    //     $user = User::find($request->id);
    //     $user->delete();

    //     // 画面を更新
    //     return redirect()->route('admin.users');
    // }

    // 店舗一覧ページを表示
    public function stores(){
        // 全ての店舗を取得
        $stores = Store::Paginate(10);

        return view('admin.stores', compact('stores'));
    }

    // 店舗の新規登録ページを表示
    public function storeRegister(){
        return view('admin.storeRegister');
    }

    // 店舗の登録
    public function storeCreate(StoreRequest $request){
        // dd($request);

        // 画像をアップロード
        $imagePath = FileIO::uploadImageFile($request->file('image'));
        // $imagePath = $this->uploadFile($request->file('image'));
        // dd(basename($imagePath));

        // 店舗を登録
        $store = Store::create([
            'name' => $request->name,
            'area_id' => $request->area_id,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'imageURL' => $imagePath
        ]);

        // 店舗代表者を登録
        Manager::create([
            'name' => $request->manager_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'store_id' => $store->id
        ]);

        // 画面を更新
        return redirect()->route('admin.stores');
    }

    // 店舗および店舗代表者の削除
    public function storeBatchDestroy(Request $request){
        foreach (Store::all() as $store) {
            if(!is_null($request->input($store->id))){
                $store->manager->delete();
                $store->delete();
            }
        };

        // 画面を更新
        return redirect()->route('admin.stores');
    }

    // 店舗情報の更新ページの表示
    public function storeEdit($store_id){
        // IDが一致する飲食店を取得
        $store = Store::find($store_id);

        return view('admin.storeEdit', compact('store'));
    }

    // 店舗情報の更新
    public function storeRestore(Request $request){
        $store = Store::find($request->id);
        // dd(!is_null($request->manager_name));

        // 画像をアップロード
        $imagePath = $store->imageURL;
        if(!is_null($request->file('image'))){
            FileIO::deleteImageFile($store->imageURL);
            $imagePath = FileIO::uploadImageFile($request->file('image'));
        }

        // 店舗情報の更新
        $store->update([
            'name' => !is_null($request->name)?$request->name:$store->name,
            'area_id' => $request->area_id,
            'category_id' => $request->category_id,
            'description' => !is_null($request->description)?$request->description:$store->description,
            'imageURL' => $imagePath
        ]);

        // 店舗代表者情報の更新
        $store->manager->update([
            'name' => !is_null($request->manager_name)?$request->manager_name:$store->manager->name,
            'email' => !is_null($request->email)?$request->email:$store->manager->email,
        ]);

        // 画面を更新
        return redirect()->route('admin.stores');
    }

    // 店舗および店舗代表者の削除
    public function storeDestroy(Request $request){
        $store = Store::find($request->id);
        $store->manager->delete();
        $store->delete();

        // 画面を更新
        return redirect()->route('admin.stores');
    }

    // // ファイルをアップロード
    // public static function uploadFile(UploadedFile $file){
    //     // storeImageディレクトリを作成し画像を保存
    //     $dirName = 'storeImages';
    //     $fileName = $file->store('public/' . $dirName);
    //     return 'storage/' . $dirName . '/' . basename($fileName);
    // }
}
