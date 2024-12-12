<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BarangController;

Route::prefix('v1')->group(function () {
    // Auth Routes
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    
    // Protected Routes
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('user', [AuthController::class, 'user']);
        Route::post('logout', [AuthController::class, 'logout']);
        
        // Barang Routes
        Route::get('barang', [BarangController::class, 'index']);
        Route::get('barang/{barang}', [BarangController::class, 'show']);
    });
});
