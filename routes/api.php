<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| Here is where you can register API routes for your application.
| These routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|--------------------------------------------------------------------------
*/

// 🧾 Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// 🔒 Protected routes (require token)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::prefix('flight')->group(function () {
    Route::get('/', [App\Http\Controllers\FlightController::class, 'index']);
    Route::get('/{id}', [App\Http\Controllers\FlightController::class, 'show']);
    Route::put('/{id}', [App\Http\Controllers\FlightController::class, 'update']);
    Route::delete('/{id}', [App\Http\Controllers\FlightController::class, 'destroy']);
});
Route::prefix('ticket')->group(function () {
    Route::get('/', [App\Http\Controllers\TicketController::class, 'index']);
    Route::post('/', [App\Http\Controllers\TicketController::class, 'store']);
    Route::put('/{id}', [App\Http\Controllers\TicketController::class, 'update']);
    Route::delete('/{id}', [App\Http\Controllers\TicketController::class, 'destroy']);
});
