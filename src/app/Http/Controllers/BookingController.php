<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\Booking;
use Auth;

class BookingController extends Controller
{
    // 予約の作成
    public function booking(Request $request){
        // 予約アイテムの作成
        Booking::create([
            'user_id' => Auth::user()->id,
            'store_id' => $request->store_id,
            'date' => $request->date,
            'time' => Store::getHour($request->time),
            'number' => $request->number,
        ]);

        // 画面を更新
        return view('done');
    }

    // 予約の変更
    public function restoreBooking(Request $request){
        return view('restore');
    }
}
