<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];

    // Storeモデルとの紐づけ
    public function store(){
        return $this->hasMany('App\Models\Store');
    }
}
