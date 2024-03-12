<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\Favorite;
use Auth;

class FavoriteController extends Controller
{
    // お気に入り追加
    public function favoriteOn(Request $request){
      if(Auth::user()) {
        // 新しくお気に入りアイテムを作成
        Favorite::create([
          'user_id' => Auth::user()->id,
          'store_id' => $request->store_id,
        ]);
      }
      else {
        session([Store::find($request->store_id)->name => true]);
      }

      // 画面を更新
      if(strpos($_SERVER['HTTP_REFERER'],'mypage') === false){
        return redirect('/')->withInput();
      }
      else{
        return redirect('/mypage')->withInput();
      }
    }

    // お気に入り削除
    public function favoriteOff(Request $request){
      if(Auth::user()){
        // 該当のお気に入りアイテムを削除
        $favorite = Favorite::getFavorite(Auth::user()->id, $request->store_id);
        $favorite->delete();
      }
      else {
        session()->forget(Store::find($request->store_id)->name);
      }

      // 画面を更新
      if(strpos($_SERVER['HTTP_REFERER'],'mypage') === false){
        return redirect('/')->withInput();
      }
      else{
        return redirect('/mypage')->withInput();
      }
    }
}
