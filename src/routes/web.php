<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservationController;

Route::get('/', function () {
    return view('welcome');
});

// カレンダー表示画面
Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');

// 特定の日付の時間枠表示画面
Route::get('/reservations/{date}', [ReservationController::class, 'show'])->name('reservations.show');

Route::middleware([
    'auth:sanctum',
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
