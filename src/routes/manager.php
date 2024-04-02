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

    // // 店舗ページを表示
    // Route::get('store', [
    //     ManagerController::class, 'store'
    // ])->name('manager.storeInfo');

    // // 店舗情報の更新
    // Route::post('store/edit', [
    //     ManagerController::class, 'storeRestore'
    // ]);

    // 店舗代表者情報ページを表示
    Route::get('info', [
        ManagerController::class, 'info'
    ])->name('manager.info');

    // 店舗代表者情報の更新
    Route::post('info/edit', [
        ManagerController::class, 'infoRestore'
    ]);

    // パスワードの変更ページを表示
    Route::get('password', [
        ManagerController::class, 'password'
    ])->name('manager.password');

    // パスワードの更新
    Route::post('password/edit', [
        ManagerController::class, 'passwordRestore'
    ]);

    // 店舗一覧ページを表示
    Route::get('stores', [
        ManagerController::class, 'stores'
    ])->name('manager.stores');

    // 店舗の新規登録ページを表示
    Route::get('store/register', [
        ManagerController::class, 'storeRegister'
    ]);

    // 店舗の登録
    Route::post('store/register', [
        ManagerController::class, 'storeCreate'
    ]);

    // 店舗の一括削除
    Route::delete('store/batchDelete', [
        ManagerController::class, 'storeBatchDestroy'
    ]);

    // 店舗情報の更新ページの表示
    Route::get('store/edit/{store_id}', [
        ManagerController::class, 'storeEdit'
    ]);

    // 店舗情報の更新
    Route::post('store/edit', [
        ManagerController::class, 'storeRestore'
    ]);

    // 店舗の削除
    Route::delete('store/delete', [
        ManagerController::class, 'storeDestroy'
    ]);

    // 予約一覧ページを表示
    Route::get('bookings', [
        ManagerController::class, 'bookings'
    ])->name('manager.bookings');

    // レビュー一覧ページを表示
    Route::get('reviews', [
        ManagerController::class, 'reviews'
    ])->name('manager.reviews');

    // QRコードの読み取りページを表示
    Route::get('qr', [
        ManagerController::class, 'readQR'
    ])->name('manager.readQR');

    // QRコードの処理
    Route::post('qr', [
        ManagerController::class, 'checkQR'
    ]);

    // QRコードの読み取りページを表示
    Route::post('getQRData', [
        ManagerController::class, 'getQRData'
    ]);
});