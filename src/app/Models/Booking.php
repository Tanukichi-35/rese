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
        'number',
    ];

    public function getTimes{
        $time = datetime();
        $times = ["17:00"]
        array_push($times,"17:30");
        return [
            "foo" => "bar",
            "bar" => "foo",
        ];
    }
}
