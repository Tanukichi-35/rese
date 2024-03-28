<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ReviewController;

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

// 飲食店の検索を実行
Route::get('/search', [
    StoreController::class, 'search'
]);

// お気に入り追加
Route::post('/favoriteOn', [
    FavoriteController::class, 'favoriteOn'
]);

// お気に入り削除
Route::post('/favoriteOff', [
    FavoriteController::class, 'favoriteOff'
]);

// 飲食店の詳細ページを表示
Route::get('/detail/{store_id}', [
    StoreController::class, 'showDetail'
]);

// 会員認証
Route::middleware('verified')->group(function () {

    // マイページを表示
    Route::get('/mypage', [
        AuthController::class, 'mypage'
    ])->name('mypage');;

    // 予約を作成
    Route::post('/booking', [
        BookingController::class, 'booking'
    ]);

    // 予約完了ページを表示
    Route::get('/done', [
        BookingController::class, 'done'
    ])->name('done');

    // 予約の変更ページを表示
    Route::get('/booking/restore/{booking_id}', [
        AuthController::class, 'edit'
    ]);

    // 予約を変更
    Route::post('/booking/restore', [
        BookingController::class, 'restore'
    ]);

    // 予約を削除
    Route::post('/booking/delete', [
        BookingController::class, 'delete'
    ]);

    // レビューを投稿
    Route::post('/submit-review', [
        ReviewController::class, 'submit'
    ]);
});