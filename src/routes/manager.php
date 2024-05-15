<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\BookingController;

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

    // 店舗代表者情報ページを表示
    Route::get('info', [
        ManagerController::class, 'info'
    ])->name('manager.info');

    // 店舗代表者情報の更新
    Route::post('info/edit', [
        ManagerController::class, 'restore'
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
        StoreController::class, 'stores'
    ])->name('manager.stores');

    // 店舗の新規登録ページを表示
    Route::get('store/register', [
        StoreController::class, 'register'
    ]);

    // 店舗の登録
    Route::post('store/register', [
        StoreController::class, 'create'
    ]);

    // 店舗データのインポートページの表示
    Route::get('store/import', [
        StoreController::class, 'import'
    ])->name('import');

    // 店舗データのインポート
    Route::post('store/import', [
        StoreController::class, 'importData'
    ]);

    // インポートデータの表示
    Route::get('store/load', [
        StoreController::class, 'showImportData'
    ])->name('load');

    // 店舗データをファイルから読込
    Route::post('store/load', [
        StoreController::class, 'load'
    ]);

    // 店舗の一括削除
    Route::delete('store/batchDelete', [
        StoreController::class, 'batchDestroy'
    ]);

    // 店舗情報の更新ページの表示
    Route::get('store/edit/{store_id}', [
        StoreController::class, 'edit'
    ]);

    // 店舗情報の更新
    Route::post('store/edit', [
        StoreController::class, 'restore'
    ]);

    // 店舗の削除
    Route::delete('store/delete', [
        StoreController::class, 'destroy'
    ]);

    // 予約一覧ページを表示
    Route::get('bookings/{store_id}', [
        BookingController::class, 'bookings'
    ]);

    // QRコードの読み取りページを表示
    Route::get('qr', [
        BookingController::class, 'readQR'
    ])->name('manager.readQR');

    // QRコードの処理
    Route::post('qr', [
        BookingController::class, 'checkQR'
    ]);

    // QRコードの読み取りページを表示
    Route::post('getQRData', [
        BookingController::class, 'getQRData'
    ]);
});
