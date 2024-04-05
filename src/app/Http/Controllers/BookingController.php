<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
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
        $booking = Booking::create([
            'uuid' => (string) Str::uuid(),
            'user_id' => Auth::user()->id,
            'store_id' => $request->store_id,
            'date' => $request->date,
            'time' => Store::getHour($request->time),
            'number' => $request->number,
            'payment' => $request->number * $request->fee,
            'status' => 0,
        ]);
        // dd($booking);

        $payment = $request->number * $request->fee;

        // 画面を更新
        // return view('done', compact('payment'));
        return redirect()->route('done')->with(compact('booking'));
    }

    // 予約の完了
    public function done(){
        return view('done');
    }

    // 予約の変更
    public function restore(Request $request){
        $booking = Booking::find($request->id);
        $booking->update([
            'date' => $request->date,
            'time' => Store::getHour($request->time),
            'number' => $request->number,
            'payment' => $request->number * $request->fee,
        ]);

        // 画面を更新
        // return view('restore');
         $message = '予約を変更しました';
        return redirect()->route('mypage')->with(compact('message'));
    }

    // 予約の削除
    public function delete(Request $request){
        $booking = Booking::find($request->id);
        $booking->delete();

        // return redirect('/mypage');
         $message = '予約をキャンセルしました';
        return redirect()->route('mypage')->with(compact('message'));
   }
}
