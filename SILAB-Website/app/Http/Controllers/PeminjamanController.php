<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Barang;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjamanList = Peminjaman::where('status', 'menunggu persetujuan')->get();
        $barangDipinjam = Peminjaman::where('status', 'disetujui')->get();
        return view('admin.peminjaman.index', compact('peminjamanList', 'barangDipinjam'));
    }

    public function setujui($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->update([
            'status' => 'disetujui',
            'tanggal_disetujui' => now(),
        ]);

        return redirect()->route('admin.peminjaman.index')->with('success', 'Peminjaman disetujui.');
    }

    public function tolak($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->update(['status' => 'ditolak']);

        // Ubah status barang kembali ke tersedia
        Barang::where('kode_barang', $peminjaman->kode_barang)
              ->update(['status' => 'tersedia']);

        return redirect()->route('admin.peminjaman.index')->with('success', 'Peminjaman ditolak.');
    }

    public function riwayat()
    {
        $riwayatBarang = Peminjaman::all();
        return view('admin.peminjaman.riwayat', compact('riwayatBarang'));
    }

    public function riwayatPeminjam()
    {
        $riwayatPeminjam = Peminjaman::all();
        return view('peminjam.riwayat', compact('riwayatPeminjam'));
    }

    public function dipinjam()
    {
        return view('peminjam.pengembalian');
    }
}