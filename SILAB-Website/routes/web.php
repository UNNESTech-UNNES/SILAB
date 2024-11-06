<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BarangController;
use Illuminate\Support\Facades\Route;

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
    
    Route::resource('barang', BarangController::class);

    // Rute tambahan untuk BarangController
    Route::get('/barang-dipinjam', [BarangController::class, 'barangDipinjam'])->name('barangDipinjam');
    Route::get('/inventaris', [BarangController::class, 'inventaris'])->name('inventaris');
    Route::get('/riwayat-peminjaman', [BarangController::class, 'riwayatPeminjaman'])->name('riwayatPeminjaman');
});

Route::middleware(['auth', 'role:pemilik'])->prefix('pemilik')->name('pemilik.')->group(function () {
    Route::get('/dashboard', [HomeController::class, 'indexPemilik'])->name('dashboard');
    // Rute lain untuk pemilik
});

Route::middleware(['auth', 'role:peminjam'])->prefix('peminjam')->name('peminjam.')->group(function () {
    Route::get('/dashboard', [HomeController::class, 'indexPeminjam'])->name('dashboard');
    // Rute lain untuk peminjam
});

require __DIR__.'/auth.php';
