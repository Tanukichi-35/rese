<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ManagerRequest;
use App\Http\Requests\PasswordRequest;
use App\Models\Manager;
use App\Models\Store;
use App\Models\Booking;
use App\Models\Review;
use Auth;
use Hash;
use FileIO;

class ManagerController extends Controller
{
    // ログインページの表示
    public function entrance()
    {
        return view('manager.login');
    }

    // ログイン処理
    public function login(ManagerRequest $request)
    {
        $credentials = $request->only(['email', 'password']);

        // ログイン処理
        if (Auth::guard('managers')->attempt($credentials)) {
            // ログイン成功
            return redirect()->route('manager.store');
        }

        // ログイン失敗
        return back()->with('failure' , 'メールアドレス、あるいはパスワードが間違っています。');
    }

    // ログアウト処理
    public function logout(Request $request)
    {
        Auth::guard('managers')->logout();
        $request->session()->regenerateToken();

        // ログインページにリダイレクト
        return redirect()->route('manager.login');
    }

    // 店舗ページを表示
    public function store(){
        // 店舗情報を取得
        $store = Auth::guard('managers')->user()->store;

        return view('manager.store', compact('store'));
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
        return redirect()->route('manager.store');
    }

    // パスワードの変更ページを表示
    public function password(){
        // 店舗代表者情報を取得
        $manager = Auth::guard('managers')->user();
        // dd($manager);

        return view('manager.password', compact('manager'));
    }

    // パスワードの更新
    public function passwordRestore(PasswordRequest $request){
        $manager = Manager::find($request->id);
        // dd(Hash::check("passwore", Hash::make("passwore")));

        if(!Hash::check($request->oldPassword, $manager->password)){
            return back()->with('failure' , 'パスワードが間違っています');
        }

        if($request->password != $request->confirmPassword){
            return back()->with('failure' , '確認用パスワードが一致しません');
        }

        // パスワードの更新
        $manager->update([
            'password' => Hash::make($request->password)
        ]);

        // 画面を更新
        return redirect()->route('manager.store');
    }

    // 予約一覧ページを表示
    public function bookings(){
        // 当該店舗の予約を取得
        $store = Auth::guard('managers')->user()->store;
        $bookings = Booking::Where('store_id', '=', $store->id)->Paginate(10);

        return view('manager.bookings', compact('bookings'));
    }

    // レビュー一覧ページを表示
    public function reviews(){
        // 当該店舗のレビューを取得
        $store = Auth::guard('managers')->user()->store;
        $reviews = Review::Where('store_id', '=', $store->id)->Paginate(10);

        return view('manager.reviews', compact('reviews'));
    }
}
