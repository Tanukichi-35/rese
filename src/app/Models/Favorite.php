<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'store_id',
        'number',
    ];

    // お気に入りアイテムの取得
    public static function getFavorite(int $user_id, int $store_id){
      return Favorite::where("user_id", '=', $user_id)->where("store_id", '=', $store_id)->first();
    }

    // お気に入りアイテムの取得
    public static function checkFavorite(int $user_id, int $store_id){
      return Favorite::where("user_id", '=', $user_id)->where("store_id", '=', $store_id)->exists();
    }
}
