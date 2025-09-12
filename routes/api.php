<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\ForgotPasswordController;
use App\Http\Controllers\API\DriverController;
use App\Http\Controllers\API\SettingsController;
use App\Http\Controllers\API\StoreController;
use App\Http\Controllers\API\UsersController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\TransactionController;
use App\Http\Controllers\API\TreeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| These routes are loaded by the RouteServiceProvider within a group
| which is assigned the "api" middleware group.
*/

// Default user route (for testing token)
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Auth
Route::controller(RegisterController::class)->group(function () {
    Route::post('login', 'login');
});
Route::middleware('auth:sanctum')->post('/logout', [RegisterController::class, 'logout']);

// Forgot Password
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetCode']);
Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword']);

// Drivers (example public route)
Route::get('/drivers', [DriverController::class, 'index']);

// Account Settings (requires authentication)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/account', [SettingsController::class, 'profile']);
    Route::post('/account/password', [SettingsController::class, 'updatePassword']);
    Route::delete('/account', [SettingsController::class, 'deleteAccount']);
});

