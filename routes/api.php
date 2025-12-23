<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\TicketController;

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
    Route::get('/', [FlightController::class, 'index']);
    Route::get('/{id}', [FlightController::class, 'show']);
    Route::put('/{id}', [FlightController::class, 'update']);
    Route::delete('/{id}', [FlightController::class, 'destroy']);
});
Route::prefix('ticket')->group(function () {
    Route::get('/', [TicketController::class, 'index']);
    Route::post('/show/{id}', [TicketController::class, 'show']);
    Route::delete('/{id}', [TicketController::class, 'destroy']);
});
