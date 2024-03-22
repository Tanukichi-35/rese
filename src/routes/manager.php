<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ManagerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|（店舗代表者用）--------------------------------------------------------------------------
|
*/

// ログインページの表示
Route::get('/manager/login', [
    ManagerController::class, 'entrance'
])->name('manager.login');

// ログイン
Route::post('/manager/login', [
    ManagerController::class, 'login'
]);

// 店舗代表者認証
Route::prefix('manager')->middleware('auth.managers:managers')->group(function () {

    // ログアウト
    Route::post('logout', [
        ManagerController::class, 'logout'
    ]);

    // 店舗ページを表示
    Route::get('store', [
        ManagerController::class, 'store'
    ])->name('manager.store');

    // 店舗情報の更新
    Route::post('store/edit', [
        ManagerController::class, 'storeRestore'
    ]);

    // パスワードの変更ページを表示
    Route::get('password', [
        ManagerController::class, 'password'
    ])->name('manager.password');

    // パスワードの更新
    Route::post('password/edit', [
        ManagerController::class, 'passwordRestore'
    ]);

    // 予約一覧ページを表示
    Route::get('bookings', [
        ManagerController::class, 'bookings'
    ])->name('manager.bookings');

    // レビュー一覧ページを表示
    Route::get('reviews', [
        ManagerController::class, 'reviews'
    ])->name('manager.reviews');
});