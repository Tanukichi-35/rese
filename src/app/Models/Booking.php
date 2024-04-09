<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'uuid',
        'user_id',
        'store_id',
        'date',
        'time',
        'number',
        'payment',
        'status',
    ];

    // Userモデルとの紐づけ
    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    // Storeモデルとの紐づけ
    public function store(){
        return $this->belongsTo('App\Models\Store');
    }

    // uuidの一致する予約を取得
    public static function getBooking($uuid){
        return self::Where('uuid', '=', $uuid)->first();
    }

    // 決済済？
    public function isCheckout(){
        return $this->status % 2 != 0;
    }

    // 来店済？
    public function isVisited(){
        return $this->status >= 2;
    }
}
