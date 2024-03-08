<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'level'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Storeモデルとの紐づけ
    public function store(){
        return $this->hasOne('App\Models\Store');
    }

    // Bookingモデルとの紐づけ
    public function bookings(){
        return $this->hasMany('App\Models\Booking');
    }

    // Favoriteモデルとの紐づけ
    public function favorites(){
        return $this->hasMany('App\Models\Favorite');
    }

    // Reviewモデルとの紐づけ
    public function reviews(){
        return $this->hasMany('App\Models\Review');
    }

    // お気に入りの店の取得
    public function favoriteStores(){
        $favorites = $this->favorites;
        for ($i=0; $i < $favorites->count(); $i++) { 
            $stores[$i] = $favorites[$i]->store;
        }
        return $stores;
    }
}
