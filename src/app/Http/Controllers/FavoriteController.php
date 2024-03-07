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
      // 新しくお気に入りアイテムを作成
      Favorite::create([
        'user_id' => Auth::user()->id,
        'store_id' => $request->store_id,
      ]);

      // 画面を更新
      return redirect('/')->withInput();
    }

    // お気に入り削除
    public function favoriteOff(Request $request){
      // 該当のお気に入りアイテムを削除
      $favorite = Favorite::getFavorite(Auth::user()->id, $request->store_id);
      $favorite->delete(); 

      // 画面を更新
      return redirect('/')->withInput();
    }
}
