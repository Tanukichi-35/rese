<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\FavoriteController;

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

Route::middleware('verified')->group(function () {
    Route::get('/', [AuthController::class, 'index']);
});

Route::get('/search', [
    StoreController::class, 'search'
]);

Route::post('/favorite-on', [
    FavoriteController::class, 'favoriteOn'
]);

Route::post('/favorite-off', [
    FavoriteController::class, 'favoriteOff'
]);

Route::get('/detail/{store_id}', [
    StoreController::class, 'showDetail'
]);