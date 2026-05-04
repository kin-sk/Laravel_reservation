<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\AdminReservationController;

Route::get('/', function () {
    return view('welcome');
});

// カレンダー表示画面
Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');

// 予約確認画面
Route::post('/reservations/confirm', [ReservationController::class, 'confirm'])
    ->middleware('auth')
    ->name('reservations.confirm');

// 予約完了画面
Route::post('/reservations', [ReservationController::class, 'store'])
    ->middleware('auth')
    ->name('reservations.store');

// 予約成功画面（GET）
Route::get('/reservations/success', [ReservationController::class, 'success'])
    ->name('reservations.success');

// 特定の日付の時間枠表示画面
Route::get('/reservations/{date}', [ReservationController::class, 'show'])
    ->where('date', '\d{4}-\d{2}-\d{2}')
    ->name('reservations.show');

// ログイン済みのユーザーの予約確認画面
Route::get('/mypage', [ReservationController::class, 'mypage'])
    ->middleware('auth')
    ->name('mypage');


Route::middleware([
    'auth:sanctum',
    'verified',
])->group(function () {
    // もともとの dashboard の記述を消して、以下のようにリダイレクトさせる
    Route::get('/dashboard', function () {
        return redirect()->route('reservations.index');
    });
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/reservations', [AdminReservationController::class, 'index'])
        ->name('admin.reservations.index');
});