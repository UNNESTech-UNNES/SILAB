<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function barangDipinjam()
    {
        // Logika untuk menampilkan barang yang dipinjam
        return view('admin.barang.barangDipinjam');
    }

    public function inventaris()
    {
        // Logika untuk menampilkan inventaris
        return view('admin.barang.inventaris');
    }

    public function riwayatPeminjaman()
    {
        // Logika untuk menampilkan riwayat peminjaman
        return view('admin.barang.riwayatPeminjaman');
    }
}