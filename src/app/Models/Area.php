<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
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
        $area = self::where('name', $name)->first();
        if ($area)
            return $area->id;
        else
            return 1;
    }
}
