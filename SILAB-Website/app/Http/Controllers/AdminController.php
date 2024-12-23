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
                $peminjaman->sisa_hari = round(Carbon::parse($peminjaman->tanggal_pengembalian)->diffInDays(now(), false));
                return $peminjaman;
            })
            ->sortBy('sisa_hari');

        // Data untuk grafik barang terpopuler
        $popularItems = DB::table('peminjaman')
            ->select('nama_barang', DB::raw('COUNT(*) as total_peminjaman'))
            ->whereIn('status', ['disetujui', 'selesai'])
            ->groupBy('nama_barang')
            ->orderByDesc('total_peminjaman')
            ->limit(10)
            ->get();

        // Data untuk grafik timeline
        $timelinePeminjaman = DB::table('peminjaman')
            ->select(
                DB::raw('DATE(tanggal_peminjaman) as tanggal'),
                DB::raw('COUNT(*) as jumlah_peminjaman')
            )
            ->where('status', 'disetujui')
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get()
            ->map(function($item) {
                return [
                    'tanggal' => Carbon::parse($item->tanggal)->format('d M Y'),
                    'jumlah_peminjaman' => $item->jumlah_peminjaman
                ];
            });

        return view('admin.dashboard', compact(
            'rekapBarang',
            'segeraKembali',
            'popularItems',
            'timelinePeminjaman'
        ));
    }

    public function riwayat()
    {
        $riwayatBarang = Peminjaman::where('status', 'selesai')
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('admin.peminjaman.riwayat', compact('riwayatBarang'));
    }
} 