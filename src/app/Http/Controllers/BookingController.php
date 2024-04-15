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
    public function create(BookingRequest $request){
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
         $message = '予約を変更しました';
        return redirect()->route('mypage')->with(compact('message'));
    }

    // 予約の削除
    public function destroy(Request $request){
        $booking = Booking::find($request->id);
        $booking->delete();

         $message = '予約をキャンセルしました';
        return redirect()->route('mypage')->with(compact('message'));
    }

    // 予約一覧ページを表示
    public function bookings($store_id){
        // 当該店舗の予約を取得
        $store = Auth::guard('managers')->user()->stores->find($store_id);
        if(is_null($store)){
            $error = '店舗情報が見つかりません';
            return redirect()->route('manager.stores')->with(compact('error'));
        }

        $bookings = Booking::Where('store_id', '=', $store->id)->Paginate(10);

        return view('manager.bookings', compact('store', 'bookings'));
    }

    // QRコードの読み取りページを表示
    public function readQR(){
        return view('manager.readQR');
    }

    // QRコード内容から予約情報のステータスを更新
    public function checkQR(Request $request){
        $booking = Booking::getBooking($request->uuid);
        $booking->update([
            'status' => $booking->status + 2
        ]);

        return view('manager.confirm');
    }

    // QRコードのデータ(uuid)から予約データを取得
    public function getQRData(Request $request){
        $booking = Booking::getBooking($request->uuid);
        if(is_null($booking)){
            return 'failure';
        }
        else if($booking->store->manager != Auth::guard('managers')->user()){
            return 'mismatch';
        }
        else if($booking->isVisited()){
            return 'done';
        }
        return response()->json([
            'store' => $booking->store->name,
            'user' => $booking->user->name,
            'date' => $booking->date,
            'time' => substr($booking->time, 0, -3),
            'number' => $booking->number.'名',
            'isCheckout' => $booking->isCheckout(),
        ]);
    }
}
