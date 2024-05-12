<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\ReviewController;

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
        UserController::class, 'users'
    ])->name('admin.users');

    // 店舗代表者一覧ページを開く
    Route::get('managers', [
        ManagerController::class, 'managers'
    ])->name('admin.managers');

    // 店舗代表者の新規登録ページを表示
    Route::get('manager/register', [
        ManagerController::class, 'register'
    ]);

    // 店舗代表者の登録
    Route::post('manager/register', [
        ManagerController::class, 'create'
    ]);

    // 店舗代表者の一括削除
    Route::delete('manager/batchDelete', [
        ManagerController::class, 'batchDestroy'
    ]);

    // 店舗代表者情報の更新ページの表示
    Route::get('manager/edit/{manager_id}', [
        ManagerController::class, 'edit'
    ]);

    // 店舗代表者情報の更新
    Route::post('manager/edit', [
        ManagerController::class, 'restore'
    ]);

    // 店舗代表者の削除
    Route::delete('manager/delete', [
        ManagerController::class, 'destroy'
    ]);

    // 店舗一覧ページを表示
    Route::get('stores', [
        StoreController::class, 'stores'
    ])->name('admin.stores');

    // 口コミ一覧ページを表示
    Route::get('reviews', [
        ReviewController::class, 'reviews'
    ])->name('admin.reviews');

    // 口コミを削除
    Route::delete('/review/delete', [
        ReviewController::class, 'destroy'
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