<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PeminjamController;
use App\Http\Controllers\KepemilikanController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [HomeController::class, 'indexAdmin'])->name('dashboard');
    Route::get('/dashboard', [KepemilikanController::class, 'kelola'])->name('dashboard');
    
    Route::resource('barang', BarangController::class);
    
    // Rute tambahan untuk BarangController
    Route::get('/barang-dipinjam', [BarangController::class, 'barangDipinjam'])->name('barangDipinjam');
    Route::get('/riwayat-peminjaman', [BarangController::class, 'riwayatPeminjaman'])->name('riwayatPeminjaman');

    // Rute untuk mengelola permintaan kepemilikan
    Route::post('/setujui-permintaan/{id}', [KepemilikanController::class, 'setujui'])->name('kepemilikan.setujui');
    Route::post('/tolak-permintaan/{id}', [KepemilikanController::class, 'tolak'])->name('kepemilikan.tolak');
});

Route::middleware(['auth', 'role:pemilik'])->prefix('pemilik')->name('pemilik.')->group(function () {
    Route::get('/dashboard', [HomeController::class, 'indexPemilik'])->name('dashboard');
    
    // Rute lain untuk pemilik
});

Route::middleware(['auth', 'role:peminjam'])->prefix('peminjam')->name('peminjam.')->group(function () {
    // Route::get('/dashboard', [HomeController::class, 'indexPeminjam'])->name('dashboard');

    Route::get('/dashboard', [PeminjamController::class, 'dashboard'])->name('dashboard');
    Route::get('/ajukan-kepemilikan', [KepemilikanController::class, 'showForm'])->name('kepemilikan.form');
    Route::post('/ajukan-kepemilikan', [KepemilikanController::class, 'ajukan'])->name('kepemilikan.ajukan');

    Route::get('/ganti-ke-pemilik', [UserController::class, 'gantiKePemilik'])->name('ganti.ke.pemilik');
});

require __DIR__.'/auth.php';
