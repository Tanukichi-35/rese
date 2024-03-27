<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MailController;

/*
|--------------------------------------------------------------------------
| Web Routes
|（管理者用）--------------------------------------------------------------------------
|
*/

// ログインページの表示
Route::get('/admin/login', [
    AdminController::class, 'entrance'
])->name('admin.login');

// ログイン
Route::post('/admin/login', [
    AdminController::class, 'login'
]);

// 管理者認証
Route::prefix('admin')->middleware('auth.admins:admins')->group(function () {

    // ログアウト
    Route::post('logout', [
        AdminController::class, 'logout'
    ]);

    // ユーザー一覧ページを開く
    Route::get('users', [
        AdminController::class, 'users'
    ])->name('admin.users');

    // // ユーザーの作成
    // Route::post('user/create', [
    //     AdminController::class, 'userCreate'
    // ]);

    // // ユーザーの一括削除
    // Route::delete('user/batchDelete', [
    //     AdminController::class, 'userBatchDestroy'
    // ]);

    // // ユーザー情報の更新
    // Route::post('user/edit', [
    //     AdminController::class, 'userRestore'
    // ]);

    // // ユーザーの削除
    // Route::delete('user/delete', [
    //     AdminController::class, 'userDestroy'
    // ]);

    // 店舗代表者一覧ページを開く
    Route::get('managers', [
        AdminController::class, 'managers'
    ])->name('admin.managers');

    // 店舗代表者の新規登録ページを表示
    Route::get('manager/register', [
        AdminController::class, 'managerRegister'
    ]);

    // 店舗代表者の登録
    Route::post('manager/register', [
        AdminController::class, 'managerCreate'
    ]);

    // 店舗代表者の一括削除
    Route::delete('manager/batchDelete', [
        AdminController::class, 'managerBatchDestroy'
    ]);

    // 店舗代表者情報の更新ページの表示
    Route::get('manager/edit/{manager_id}', [
        AdminController::class, 'managerEdit'
    ]);

    // 店舗代表者情報の更新
    Route::post('manager/edit', [
        AdminController::class, 'managerRestore'
    ]);

    // 店舗代表者の削除
    Route::delete('manager/delete', [
        AdminController::class, 'managerDestroy'
    ]);

    // 店舗一覧ページを表示
    Route::get('stores', [
        AdminController::class, 'stores'
    ])->name('admin.stores');

    // 店舗の新規登録ページを表示
    Route::get('store/register', [
        AdminController::class, 'storeRegister'
    ]);

    // 店舗の登録
    Route::post('store/register', [
        AdminController::class, 'storeCreate'
    ]);

    // 店舗の一括削除
    Route::delete('store/batchDelete', [
        AdminController::class, 'storeBatchDestroy'
    ]);

    // 店舗情報の更新ページの表示
    Route::get('store/edit/{store_id}', [
        AdminController::class, 'storeEdit'
    ]);

    // 店舗情報の更新
    Route::post('store/edit', [
        AdminController::class, 'storeRestore'
    ]);

    // 店舗の削除
    Route::delete('store/delete', [
        AdminController::class, 'storeDestroy'
    ]);

    // お知らせメール送信フォームの表示
    Route::get('mail', [
        MailController::class, 'mail'
    ])->name('admin.mail');

    // お知らせメールを送信
    Route::post('mail', [
        MailController::class, 'send'
    ]);
});