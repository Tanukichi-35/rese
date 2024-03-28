<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'store_id',
        'date',
        'time',
        'number',
        'cost',
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
}
