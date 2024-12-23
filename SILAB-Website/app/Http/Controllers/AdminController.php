<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Rekapitulasi barang
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
                $peminjaman->sisa_hari = floor(Carbon::parse($peminjaman->tanggal_pengembalian)->diffInDays(now(), false));
                return $peminjaman;
            })
            ->sortBy('sisa_hari');

        return view('admin.dashboard', compact('rekapBarang', 'segeraKembali'));
    }
} 