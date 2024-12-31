<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BarangController;
use App\Http\Controllers\API\PeminjamanController;

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
        Route::get('barang/{kode_barang}', [BarangController::class, 'show']);
        
        // Peminjaman Routes
        Route::get('peminjaman', [PeminjamanController::class, 'index']);
        Route::post('peminjaman', [PeminjamanController::class, 'store']);
        Route::get('peminjaman/riwayat', [PeminjamanController::class, 'riwayat']);
        Route::get('peminjaman/aktif', [PeminjamanController::class, 'getPeminjamanAktif']);
    });
});