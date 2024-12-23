<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjaman = Peminjaman::where('user_id', auth()->id)
                               ->where('status', 'menunggu persetujuan')
                               ->get();

        return response()->json([
            'success' => true,
            'data' => $peminjaman
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_barang' => 'required',
            'nama_peminjam' => 'required',
            'alamat_peminjam' => 'required',
            'nomor_handphone' => 'required',
            'tanggal_peminjaman' => 'required|date',
            'tanggal_pengembalian' => 'required|date|after:tanggal_peminjaman'
        ]);

        $barang = Barang::where('kode_barang', $request->kode_barang)
                       ->where('status', 'tersedia')
                       ->first();

        if (!$barang) {
            return response()->json([
                'success' => false,
                'message' => 'Barang tidak tersedia'
            ], 400);
        }

        $peminjaman = Peminjaman::create([
            'user_id' => Auth::user()->id,
            'kode_barang' => $barang->kode_barang,
            'nama_barang' => $barang->nama_barang,
            'letak_barang' => $barang->letak_barang,
            'nama_peminjam' => $request->nama_peminjam,
            'alamat_peminjam' => $request->alamat_peminjam,
            'nomor_handphone' => $request->nomor_handphone,
            'tanggal_peminjaman' => $request->tanggal_peminjaman,
            'tanggal_pengembalian' => $request->tanggal_pengembalian,
            'status' => 'menunggu persetujuan'
        ]);

        $barang->update(['status' => 'dipinjam']);

        return response()->json([
            'success' => true,
            'message' => 'Peminjaman berhasil diajukan',
            'data' => $peminjaman
        ]);
    }

    public function riwayat()
    {
        $riwayat = Peminjaman::where('user_id', Auth::user()->id)->get();

        return response()->json([
            'success' => true,
            'data' => $riwayat
        ]);
    }
} 