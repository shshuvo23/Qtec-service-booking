<?php

use App\Http\Controllers\Api\AdminBookingController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\ServiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['jwt.auth'])->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // Customer Routes
    Route::get('/services', [ServiceController::class, 'index']);
    Route::post('/bookings-store', [BookingController::class, 'store']);
    Route::get('/bookings', [BookingController::class, 'index']);

    // Admin Routes
    Route::post('/services-create', [ServiceController::class, 'store']);
    Route::put('/services-update/{id}', [ServiceController::class, 'update']);
    Route::delete('/services-delete/{id}', [ServiceController::class, 'destroy']);
    Route::get('/admin/bookings', [AdminBookingController::class, 'index']);
});
