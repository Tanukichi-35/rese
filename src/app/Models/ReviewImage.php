<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewImage extends Model
{
  use HasFactory;
  protected $fillable = [
    'review_id',
    'imageURL',
  ];

  // Reviewモデルとの紐づけ
  public function review()
  {
    return $this->belongsTo('App\Models\Review');
  }
}
