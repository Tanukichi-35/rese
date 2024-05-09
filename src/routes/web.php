<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\StripeController;

include __DIR__ . '/admin.php';
include __DIR__ . '/manager.php';

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// 飲食店一覧ページを表示
Route::get('/', [
    StoreController::class, 'index'
]);

// 飲食店のソートを実行
Route::get('/sort', [
    StoreController::class, 'sort'
]);

// 飲食店の検索を実行
Route::get('/search', [
    StoreController::class, 'search'
]);

// 飲食店の詳細ページを表示
Route::get('/detail/{store_id}', [
    StoreController::class, 'showDetail'
]);

// お気に入り追加
Route::post('/favoriteOn', [
    FavoriteController::class, 'create'
]);

// お気に入り削除
Route::post('/favoriteOff', [
    FavoriteController::class, 'destroy'
]);

// 会員認証
Route::middleware('verified')->group(function () {

    // サンクスページを表示
    Route::get('/thanks', [
        AuthController::class, 'thanks'
    ]);

    // マイページを表示
    Route::get('/mypage', [
        AuthController::class, 'mypage'
    ])->name('mypage');;

    // 予約を作成
    Route::post('/booking', [
        BookingController::class, 'create'
    ]);

    // 予約完了ページを表示
    Route::get('/done', [
        BookingController::class, 'done'
    ])->name('done');

    // 予約の変更ページを表示
    Route::get('/booking/restore/{booking_uuid}', [
        AuthController::class, 'edit'
    ]);

    // 予約を変更
    Route::post('/booking/restore', [
        BookingController::class, 'restore'
    ]);

    // 予約を削除
    Route::delete('/booking/delete', [
        BookingController::class, 'destroy'
    ]);

    // レビューを投稿
    Route::post('/review', [
        ReviewController::class, 'create'
    ]);

    // 決済
    Route::post('/charge',[
        StripeController::class, 'charge'
    ])->name('stripe.charge');
});