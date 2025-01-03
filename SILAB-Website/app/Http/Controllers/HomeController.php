<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function indexAdmin()
    {
        $rekapBarang = Barang::select(
            'nama_barang',
            'letak_barang',
            DB::raw('count(*) as total'),
            DB::raw('sum(case when status = "tersedia" then 1 else 0 end) as tersedia'),
            DB::raw('sum(case when status = "dipinjam" then 1 else 0 end) as dipinjam')
        )
        ->groupBy('nama_barang', 'letak_barang')
        ->get();

        // Barang yang harus segera dikembalikan
        $segeraKembali = Peminjaman::where('status', 'disetujui')
            ->get()
            ->map(function ($peminjaman) {
                $peminjaman->sisa_hari = Carbon::parse($peminjaman->tanggal_pengembalian)->diffInDays(now());
                return $peminjaman;
            })
            ->sortBy('sisa_hari');

        return view('admin.dashboard', compact('rekapBarang', 'segeraKembali'));
    }

    public function indexPemilik()
    {
        return view('pemilik.dashboard');
    }

    public function indexPeminjam()
    {
        return view('peminjam.dashboard');
    }
}
