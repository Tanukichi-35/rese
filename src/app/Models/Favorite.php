<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Store;

class Favorite extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'store_id',
        'number',
    ];

    // Userモデルとの紐づけ
    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    // Storeモデルとの紐づけ
    public function store(){
        return $this->belongsTo('App\Models\Store');
    }

    // お気に入りアイテムの取得
    public static function getFavorite(int $user_id, int $store_id){
      return Favorite::where("user_id", '=', $user_id)->where("store_id", '=', $store_id)->first();
    }

    // お気に入りステータスの確認
    public static function checkFavorite(int $user_id, int $store_id){
      if($user_id == 0){
        return session()->has(Store::find($store_id)->name);
      }
      else{
        return Favorite::where("user_id", '=', $user_id)->where("store_id", '=', $store_id)->exists();
      }
    }
}
