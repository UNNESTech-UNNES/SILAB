<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Barang;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjamanList = Peminjaman::where('status', 'menunggu persetujuan')->get();
        $barangDipinjam = Peminjaman::where('status', 'disetujui')
            ->orderBy('tanggal_pengembalian', 'asc')
            ->get();
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
        $riwayatBarang = Peminjaman::where('status', 'selesai')
            ->orderBy('updated_at', 'desc')
            ->get();
        return view('admin.peminjaman.riwayat', compact('riwayatBarang'));
    }

    public function riwayatPeminjam()
    {
        // Mengambil semua riwayat peminjaman user yang sedang login
        $riwayatPeminjaman = Peminjaman::where('user_id', Auth::id())
                                      ->orderBy('created_at', 'desc')
                                      ->get();

        // Mengambil peminjaman yang sedang berlangsung
        $sedangDipinjam = Peminjaman::where('user_id', Auth::id())
                                   ->whereIn('status', ['disetujui', 'dipinjam'])
                                   ->orderBy('tanggal_pengembalian', 'asc')
                                   ->get();

        // Mengambil riwayat peminjaman yang sudah selesai
        $riwayatSelesai = Peminjaman::where('user_id', Auth::id())
                                   ->where('status', 'selesai')
                                   ->orderBy('created_at', 'desc')
                                   ->get();

        return view('peminjam.riwayat', compact(
            'riwayatPeminjaman',
            'sedangDipinjam',
            'riwayatSelesai'
        ));
    }

    public function dipinjam()
    {
        return view('peminjam.pengembalian');
    }

    public function konfirmasiPengembalian(Peminjaman $peminjaman)
    {
        // Update status peminjaman
        $peminjaman->update([
            'status' => 'selesai',
            'tanggal_dikembalikan' => now()
        ]);
        
        // Update status barang menjadi tersedia
        Barang::where('kode_barang', $peminjaman->kode_barang)
              ->update(['status' => 'tersedia']);

        return redirect()->route('admin.peminjaman.index')
            ->with('success', 'Pengembalian barang berhasil dikonfirmasi');
    }
}