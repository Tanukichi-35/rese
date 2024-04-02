<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ManagerRequest;
use App\Http\Requests\PasswordRequest;
use App\Http\Requests\StoreRequest;
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
    public function entrance(){
        return view('manager.login');
    }

    // ログイン処理
    public function login(LoginRequest $request){
        $credentials = $request->only(['email', 'password']);

        // ログイン処理
        if (Auth::guard('managers')->attempt($credentials)) {
            // ログイン成功
            return redirect()->route('manager.stores');
        }

        // ログイン失敗
        return back()->with('failure' , 'メールアドレス、あるいはパスワードが間違っています。');
    }

    // ログアウト処理
    public function logout(Request $request){
        Auth::guard('managers')->logout();
        $request->session()->regenerateToken();

        // ログインページにリダイレクト
        return redirect()->route('manager.login');
    }

    // 店舗代表者情報ページの表示
    public function info(){
        // ログインユーザーの取得
        $manager = Auth::guard('managers')->user();

        return view('manager.info', compact('manager'));
    }

    // 店舗代表者情報の更新
    public function infoRestore(ManagerRequest $request){
        // ログインユーザーの取得
        $manager = Auth::guard('managers')->user();

        // 店舗代表者情報の更新
        $manager->update([
            'name' => !is_null($request->name)?$request->name:$manager->name,
            'email' => !is_null($request->email)?$request->email:$manager->email,
        ]);

        // 画面を更新
        // return redirect()->route('manager.info');
        $message = '登録情報を更新しました';
        return redirect()->route('manager.info')->with(compact('message'));
    }

    // パスワードの変更ページを表示
    public function password(){
        // ログインユーザーの取得
        $manager = Auth::guard('managers')->user();
        // dd($manager);

        return view('manager.password', compact('manager'));
    }

    // パスワードの更新
    public function passwordRestore(PasswordRequest $request){
        $manager = Manager::find($request->id);

        if(!Hash::check($request->oldPassword, $manager->password)){
            return back()->with('failure' , '元のパスワードが一致しません');
        }

        if($request->password != $request->confirmPassword){
            return back()->with('failure' , '確認用パスワードが一致しません');
        }

        // パスワードの更新
        $manager->update([
            'password' => Hash::make($request->password)
        ]);

        // 画面を更新
        // return redirect()->route('manager.info');
        // return view('manager.info', compact('manager'))->with('message' , 'パスワードを更新しました。');
        $message = 'パスワードを更新しました';
        return redirect()->route('manager.info')->with(compact('message'));
    }

    // 店舗一覧ページを表示
    public function stores(){
        // 担当店舗を取得
        $manager = Auth::guard('managers')->user();
        $stores = Store::Where('manager_id', '=', $manager->id)->Paginate(10);

        return view('manager.stores', compact('stores'));
    }

    // 店舗の新規登録ページを表示
    public function storeRegister(){
        return view('manager.storeRegister');
    }

    // 店舗の登録
    public function storeCreate(StoreRequest $request){
        // 画像をアップロード
        $imagePath = null;
        if(!is_null($request->file('image'))){
            $imagePath = FileIO::uploadImageFile($request->file('image'));
        }

        // 店舗を登録
        $store = Store::create([
            'name' => $request->name,
            'manager_id' => $request->manager_id,
            'area_id' => $request->area_id,
            'genre_id' => $request->genre_id,
            'description' => $request->description,
            'imageURL' => $imagePath
        ]);

        // 画面を更新
        // return redirect()->route('manager.stores');
        $message = '新しく店舗を登録しました';
        return redirect()->route('manager.stores')->with(compact('message'));
    }

    // 店舗の削除
    public function storeBatchDestroy(Request $request){
        foreach (Store::all() as $store) {
            if(!is_null($request->input($store->id))){
                $store->delete();
            }
        };

        // 画面を更新
        // return redirect()->route('manager.stores');
        $message = '登録情報を削除しました';
        return redirect()->route('manager.stores')->with(compact('message'));
    }

    // 店舗情報の更新ページの表示
    public function storeEdit($store_id){
        // IDが一致する飲食店を取得
        $store = Store::find($store_id);

        return view('manager.storeEditer', compact('store'));
    }

    // 店舗情報の更新
    public function storeRestore(StoreRequest $request){
        $store = Store::find($request->id);

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
            'genre_id' => $request->genre_id,
            'description' => !is_null($request->description)?$request->description:$store->description,
            'imageURL' => $imagePath
        ]);

        // 画面を更新
        // return redirect()->route('manager.stores');
        // return back()->withInput();
        $message = '登録情報を更新しました';
        return redirect()->route('manager.stores')->with(compact('message'));
    }

    // 店舗の削除
    public function storeDestroy(Request $request){
        $store = Store::find($request->id);
        $store->delete();

        // 画面を更新
        // return redirect()->route('manager.stores');
        $message = '登録情報を削除しました';
        return redirect()->route('manager.stores')->with(compact('message'));
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

    // QRコードの読み取りページを表示
    public function readQR(){
        return view('manager.readQR');
    }

    // QRコード内容から予約情報のステータスを更新
    public function checkQR(Request $request){
        // dd($request->uuid);
        $booking = Booking::Where('uuid', '=', $request->uuid)->first();
        $booking->update([
            'status' => $booking->status + 2
        ]);

        return view('manager.confirm');
    }

    // QRコードのデータ(uuid)から予約データを取得
    public function getQRData(Request $request){
        $booking = Booking::Where('uuid', '=', $request->uuid)->first();
        if(is_null($booking)){
            return 'failure';
        }
        else if($booking->store->manager != Auth::guard('managers')->user()){
            return 'mismatch';
        }
        else if($booking->status >= 2){
            return 'done';
        }
        return response()->json([
            'store' => $booking->store->name,
            'user' => $booking->user->name,
            'date' => $booking->date,
            'time' => substr($booking->time, 0, -3),
            'number' => $booking->number.'名',
        ]);
    }
}
