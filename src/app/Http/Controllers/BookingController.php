<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BookingRequest;
use App\Models\Store;
use App\Models\Booking;
use Auth;

class BookingController extends Controller
{
    // 予約の作成
    public function booking(BookingRequest $request){
        // 予約アイテムの作成
        Booking::create([
            'user_id' => Auth::user()->id,
            'store_id' => $request->store_id,
            'date' => $request->date,
            'time' => Store::getHour($request->time),
            'number' => $request->number,
        ]);

        // 画面を更新
        return redirect()->route('done');
    }

    // 予約の完了
    public function done(){
        // 画面を更新
        return view('done');
    }

    // 予約の変更
    public function restore(Request $request){
        $booking = Booking::find($request->id);
        $booking->update([
            'date' => $request->date,
            'time' => Store::getHour($request->time),
            'number' => $request->number,
        ]);

        // 画面を更新
        return view('restore');
    }

    // 予約の削除
    public function delete(Request $request){
        $booking = Booking::find($request->id);
        $booking->delete();

        return redirect('/mypage');
    }
}
