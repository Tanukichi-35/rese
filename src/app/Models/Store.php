<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Favorite;
use Auth;
use DateTime;

class Store extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'user_id',
        'area_id',
        'category_id',
        'description',
        'imageURL',
    ];

    // Userモデルとの紐づけ
    public function user(){
        return $this->hasOne('App\Models\User');
    }

    // Areaモデルとの紐づけ
    public function area(){
        return $this->belongsTo('App\Models\Area');
    }

    // Categoryモデルとの紐づけ
    public function category(){
        return $this->belongsTo('App\Models\Category');
    }

    // Area名の取得
    public function getArea(){
        return Store::find($this->area_id)->area->name;
    }

    // Category名の取得
    public function getCategory(){
        return Store::find($this->category_id)->category->name;
    }

    // お気に入りステータスの確認
    public function checkFavorite(){
        return Favorite::checkFavorite(Auth::user()->id, $this->id);
    }

    // 営業時間の取得
    public function getHours(){
        $time = new DateTime("17:00");
        $hours = [
            "1" => $time->format("H:i"),
        ];
        for ($i = 2; $i <= 9; $i++) { 
            $hours[$i] = $time->modify("+30 minutes")->format("H:i");
        }

        return $hours;
    }

    // 人数の取得
    public function getNumbers(){
        $numbers = [
            "1" => "1人",
        ];
        for ($i = 2; $i <= 10; $i++) { 
            $numbers[$i] = $i."人";
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

    // カテゴリーで検索
    public function scopeCategorySearch($query, $category_id)
    {
        if (!empty($category_id) || $category_id != 0) {
            $query->where('category_id', $category_id);
        }
    }

    // 店名で検索
    public function scopeStoreSearch($query, $store_name)
    {
        if (!empty($store_name)) {
            $query->where('name', "like", "%".$store_name."%");
        }
    }
}
