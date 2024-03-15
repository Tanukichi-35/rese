<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use Auth;

class ReviewController extends Controller
{
    // レビューを投稿
    public function submit(Request $request){
      if(Auth::user()) {
        $user_id = Auth::user()->id;
        $store_id = $request->store_id;
        if(Review::checkReview($user_id, $store_id)){
          return redirect('/detail/'.$store_id)->with('message','既にレビューを投稿済みです。');
        }
        else{
          // 新しくレビューアイテムを作成
          Review::create([
            'user_id' => $user_id,
            'store_id' => $store_id,
            'rate' => $request->rate,
            'comment' => $request->comment,
          ]);
        }

        // 画面を更新
        return redirect('/detail/'.$store_id)->with('message','レビューを投稿いただきありがとうございます。');
      }
    }
 }
