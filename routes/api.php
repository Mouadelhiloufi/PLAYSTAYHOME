<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ChatController;
use App\Http\Controllers\Api\ConsoleController;
use App\Http\Controllers\Api\CouponController;
use App\Http\Controllers\Api\GameController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', fn(Request $request) => $request->user());
    
    Route::get('/consoles', [ConsoleController::class, 'index']);
    Route::get('/consoles/{console}', [ConsoleController::class, 'show']);
    
    Route::get('/games', [GameController::class, 'index']);
    Route::get('/games/{game}', [GameController::class, 'show']);
    
    Route::get('/coupons', [CouponController::class, 'index']);
    Route::get('/coupons/{coupon}', [CouponController::class, 'show']);
    Route::post('/coupons/validate', [CouponController::class, 'validate']);
    
    Route::get('/chat/{userId}', [ChatController::class, 'index']);
    Route::post('/chat/{userId}', [ChatController::class, 'store']);
    
    Route::middleware('admin')->group(function () {
        Route::post('/consoles', [ConsoleController::class, 'store']);
        Route::put('/consoles/{console}', [ConsoleController::class, 'update']);
        Route::delete('/consoles/{console}', [ConsoleController::class, 'destroy']);
        
        Route::post('/games', [GameController::class, 'store']);
        Route::put('/games/{game}', [GameController::class, 'update']);
        Route::delete('/games/{game}', [GameController::class, 'destroy']);
        
        Route::post('/coupons', [CouponController::class, 'store']);
        Route::put('/coupons/{coupon}', [CouponController::class, 'update']);
        Route::delete('/coupons/{coupon}', [CouponController::class, 'destroy']);
    });
});
