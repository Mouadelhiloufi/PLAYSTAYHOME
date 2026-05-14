<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ChatController;
use App\Http\Controllers\Api\ConsoleController;
use App\Http\Controllers\Api\CouponController;
use App\Http\Controllers\Api\GameController;
use App\Http\Controllers\Api\ManetteController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\ReservationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/consoles', [ConsoleController::class, 'index']);
Route::get('/consoles/{id}/reserved-dates', [ConsoleController::class, 'reservedDates']);
Route::get('/consoles/{console}', [ConsoleController::class, 'show']);

Route::get('/manettes/available', [ManetteController::class, 'listAvailableManettes']);
Route::get('/manettes', [ManetteController::class, 'index']);
Route::post('/manettes', [ManetteController::class, 'addManette']);
Route::patch('/manettes/{id}/status', [ManetteController::class, 'updateStatus']);
Route::delete('/manettes/{id}', [ManetteController::class, 'removeController']);

Route::get('/games', [GameController::class, 'index']);
Route::get('/games/{game}', [GameController::class, 'show']);

Route::post('/reservations/calculate', [ReservationController::class, 'calculate']);
Route::post('/reservations', [ReservationController::class, 'store']);

Route::middleware('auth:sanctum')->group(function () {
Route::post('/logout', [AuthController::class, 'logout']);
Route::get('/user', fn(Request $request) => $request->user());
Route::post('/user/update', [AuthController::class, 'updateProfile']);
    
    
    
    
    
Route::get('/coupons', [CouponController::class, 'index']);
Route::get('/coupons/{coupon}', [CouponController::class, 'show']);
Route::post('/coupons/validate', [CouponController::class, 'validate']);
    
Route::get('/chat/{userId}', [ChatController::class, 'index']);
Route::post('/chat/{userId}', [ChatController::class, 'store']);

Route::get('/notifications', [NotificationController::class, 'index']);
// Route::post('/notifications', [NotificationController::class, 'store']);
Route::patch('/notifications/{id}/read', [NotificationController::class, 'markAsRead']);
    
    // routes de reservation

    

    Route::get('/reservations', [ReservationController::class, 'index']);
    Route::get('/reservations/{reservation}', [ReservationController::class, 'show']);
    Route::put('/reservations/{reservation}/cancel', [ReservationController::class, 'cancel']);

    Route::middleware('admin')->group(function () {
        Route::get('/users', [AuthController::class, 'index']);
        Route::get('/admin/stats/monthly-revenue', [ReservationController::class, 'monthlyRevenue']);
        Route::patch('/admin/reservations/{reservation}/accept', [ReservationController::class, 'accept']);
        Route::patch('/admin/reservations/{reservation}/refuse', [ReservationController::class, 'refuse']);
        Route::post('/consoles', [ConsoleController::class, 'store']);
        Route::put('/consoles/{console}', [ConsoleController::class, 'update']);
        Route::put('/consoles/{console}/games', [ConsoleController::class, 'syncGames']);
        Route::delete('/consoles/{console}', [ConsoleController::class, 'destroy']);
        
        Route::post('/games', [GameController::class, 'store']);
        Route::put('/games/{game}', [GameController::class, 'update']);
        Route::delete('/games/{game}', [GameController::class, 'destroy']);
        
        Route::post('/coupons', [CouponController::class, 'store']);
        Route::put('/coupons/{coupon}', [CouponController::class, 'update']);
        Route::delete('/coupons/{coupon}', [CouponController::class, 'destroy']);
    });
});
