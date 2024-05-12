<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Store;

class Review extends Model
{
  use HasFactory;
  protected $fillable = [
    'user_id',
    'store_id',
    'rate',
    'comment',
  ];

  // Userモデルとの紐づけ
  public function user()
  {
    return $this->belongsTo('App\Models\User');
  }

  // Storeモデルとの紐づけ
  public function store()
  {
    return $this->belongsTo('App\Models\Store');
  }

  // ReviewImageモデルとの紐づけ
  public function reviewImages()
  {
    return $this->hasMany('App\Models\ReviewImage');
  }

  // 口コミアイテムの取得
  public static function getReview(int $user_id, int $store_id)
  {
    return Review::where("user_id", '=', $user_id)->where("store_id", '=', $store_id)->first();
  }

  // 口コミステータスの確認
  public static function checkReview(int $user_id, int $store_id)
  {
    if ($user_id == 0) {
      return session()->has(Store::find($store_id)->name);
    } else {
      return Review::where("user_id", '=', $user_id)->where("store_id", '=', $store_id)->exists();
    }
  }
}
