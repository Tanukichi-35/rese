<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
  use HasFactory;
  protected $fillable = [
    'name',
  ];

  // Storeモデルとの紐づけ
  public function stores()
  {
    return $this->hasMany('App\Models\Store');
  }

  // 名前からIDを取得
  public static function getID(string $name)
  {
    $genre = self::where('name', $name)->first();
    if ($genre)
      return $genre->id;
    else
      return 1;
  }
}
