<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\KeranjangPeminjamanController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PemilikController;
use App\Http\Controllers\AdminController;

Route::get('/', [BarangController::class, 'welcomeCard'])->name('welcome');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/notifikasi/{id}/read', [NotifikasiController::class, 'markAsRead'])->name('notifikasi.markAsRead');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');
    Route::get('/peminjaman/riwayat', [PeminjamanController::class, 'riwayat'])->name('peminjaman.riwayat');
    Route::post('/peminjaman/{id}/setujui', [PeminjamanController::class, 'setujui'])->name('peminjaman.setujui');
    Route::post('/peminjaman/{id}/tolak', [PeminjamanController::class, 'tolak'])->name('peminjaman.tolak');
    Route::post('/peminjaman/{peminjaman}/konfirmasi-pengembalian', [PeminjamanController::class, 'konfirmasiPengembalian'])->name('peminjaman.konfirmasi-pengembalian');
    Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');
    Route::get('/barang/table', [BarangController::class, 'getTableData'])->name('barang.table');
    Route::post('/barang', [BarangController::class, 'store'])->name('barang.store');
    Route::get('/barang/{barang}/edit', [BarangController::class, 'edit'])->name('barang.edit');
    Route::put('/barang/{barang}', [BarangController::class, 'update'])->name('barang.update');
    Route::delete('/barang/{barang}', [BarangController::class, 'destroy'])->name('barang.destroy');
    Route::get('/notifikasi', [NotifikasiController::class, 'adminIndex'])->name('notifikasi.index');
    Route::get('/notifikasi/create', [NotifikasiController::class, 'createMessage'])->name('notifikasi.create');
    Route::post('/notifikasi/store', [NotifikasiController::class, 'storeMessage'])->name('notifikasi.store-message');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
});

Route::middleware(['auth', 'role:pemilik-medunes|pemilik-sparka|pemilik-facetro|pemilik-silab|pemilik-lms|pemilik-remosto'])->prefix('pemilik')->name('pemilik.')->group(function () {
    Route::get('/dashboard', [PemilikController::class, 'index'])->name('dashboard');
    Route::post('/barang', [PemilikController::class, 'store'])->name('barang.store');
    Route::patch('/barang/{barang}/toggle-borrow', [PemilikController::class, 'toggleBorrow'])->name('barang.toggle-borrow');
    Route::get('/barang/{barang}/edit', [PemilikController::class, 'edit'])->name('barang.edit');
    Route::put('/barang/{barang}', [PemilikController::class, 'update'])->name('barang.update');
    Route::delete('/barang/{barang}', [PemilikController::class, 'destroy'])->name('barang.destroy');
});

Route::middleware(['auth', 'role:peminjam'])->prefix('peminjam')->name('peminjam.')->group(function () {
    Route::get('/dashboard', [BarangController::class, 'showCard'])->name('dashboard');
    Route::get('/keranjang', [KeranjangPeminjamanController::class, 'index'])->name('keranjang.index');
    Route::post('/keranjang/tambah', [KeranjangPeminjamanController::class, 'tambah'])->name('keranjang.tambah');
    Route::delete('/keranjang/hapus/{id}', [KeranjangPeminjamanController::class, 'hapus'])->name('keranjang.hapus');
    Route::post('/keranjang/finalisasi', [KeranjangPeminjamanController::class, 'finalisasi'])->name('keranjang.finalisasi');
    Route::post('/peminjaman/ajukan', [PeminjamanController::class, 'ajukan'])->name('peminjaman.ajukan');
    Route::get('/riwayat-peminjaman', [PeminjamanController::class, 'riwayatPeminjam'])->name('peminjaman.riwayat');
    Route::get('/barang-dipinjam', [PeminjamanController::class, 'dipinjam'])->name('peminjaman.pengembalian');
    Route::get('/notifikasi', [NotifikasiController::class, 'index'])->name('notifikasi.index');
    Route::get('riwayat/{tab}', [PeminjamanController::class, 'getRiwayatContent'])->name('riwayat.content');
});


require __DIR__.'/auth.php';