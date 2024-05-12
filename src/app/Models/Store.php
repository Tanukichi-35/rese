<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Favorite;
use Auth;
use DateTime;

class Store extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'manager_id',
        'area_id',
        'genre_id',
        'description',
        'imageURL',
    ];

    // Managerモデルとの紐づけ
    public function manager()
    {
        return $this->belongsTo('App\Models\Manager');
    }

    // Bookingモデルとの紐づけ
    public function bookings()
    {
        return $this->hasMany('App\Models\Booking');
    }

    // Favoriteモデルとの紐づけ
    public function favorites()
    {
        return $this->hasMany('App\Models\Favorite');
    }

    // Reviewモデルとの紐づけ
    public function reviews()
    {
        return $this->hasMany('App\Models\Review');
    }

    // Areaモデルとの紐づけ
    public function area()
    {
        return $this->belongsTo('App\Models\Area');
    }

    // Genreモデルとの紐づけ
    public function genre()
    {
        return $this->belongsTo('App\Models\Genre');
    }

    // お気に入りステータスの確認
    public function checkFavorite()
    {
        if (Auth::user()) {
            return Favorite::checkFavorite(Auth::user()->id, $this->id);
        } else {
            return Favorite::checkFavorite(0, $this->id);
        }
    }

    // 営業時間の取得
    public function getHours()
    {
        $time = new DateTime("17:00");
        $hours = [
            "1" => $time->format("H:i"),
        ];
        for ($i = 2; $i <= 9; $i++) {
            $hours[$i] = $time->modify("+30 minutes")->format("H:i");
        }

        return $hours;
    }

    // インデックスから予約時間の取得
    public static function getHour(int $index)
    {
        $time = new DateTime("17:00");
        for ($i = 1; $i < $index; $i++) {
            $time->modify("+30 minutes");
        }

        return $time;
    }

    // 人数の取得
    public function getNumbers()
    {
        $numbers = [
            "1" => "1人",
        ];
        for ($i = 2; $i <= 10; $i++) {
            $numbers[$i] = $i . "人";
        }

        return $numbers;
    }

    // 地域で検索
    public function scopeAreaSearch($query, $area_id)
    {
        if (!empty($area_id) || $area_id != 0) {
            $query->where('area_id', $area_id);
        }
    }

    // ジャンルで検索
    public function scopeGenreSearch($query, $genre_id)
    {
        if (!empty($genre_id) || $genre_id != 0) {
            $query->where('genre_id', $genre_id);
        }
    }

    // 店名で検索
    public function scopeStoreSearch($query, $store_name)
    {
        if (!empty($store_name)) {
            $query->where('name', "like", "%" . $store_name . "%");
        }
    }
}
