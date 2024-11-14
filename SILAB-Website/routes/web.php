<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\KeranjangPeminjamanController;

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
    Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');
    Route::post('/peminjaman/setujui/{id}', [PeminjamanController::class, 'setujui'])->name('peminjaman.setujui');
    Route::post('/peminjaman/tolak/{id}', [PeminjamanController::class, 'tolak'])->name('peminjaman.tolak');
    
    Route::resource('barang', BarangController::class);
});

Route::middleware(['auth', 'role:pemilik'])->prefix('pemilik')->name('pemilik.')->group(function () {
    Route::get('/dashboard', [HomeController::class, 'indexPemilik'])->name('dashboard');
});

Route::middleware(['auth', 'role:peminjam'])->prefix('peminjam')->name('peminjam.')->group(function () {
    Route::get('/dashboard', [BarangController::class, 'showCard'])->name('dashboard');
    Route::get('/keranjang', [KeranjangPeminjamanController::class, 'index'])->name('keranjang.index');
    Route::post('/keranjang/tambah', [KeranjangPeminjamanController::class, 'tambah'])->name('keranjang.tambah');
    Route::delete('/keranjang/hapus/{id}', [KeranjangPeminjamanController::class, 'hapus'])->name('keranjang.hapus');
    Route::post('/keranjang/finalisasi', [KeranjangPeminjamanController::class, 'finalisasi'])->name('keranjang.finalisasi');
    Route::post('/peminjaman/ajukan', [PeminjamanController::class, 'ajukan'])->name('peminjaman.ajukan');
    Route::get('/riwayat-peminjaman', [PeminjamanController::class, 'riwayat'])->name('peminjaman.riwayat');
});

require __DIR__.'/auth.php';