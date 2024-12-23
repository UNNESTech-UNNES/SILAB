<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemilikController extends Controller
{
    public function index(Request $request)
    {
        $jenis = $this->getJenisPemilik();
        
        // Query dasar - tambahkan where jenis_barang
        $query = Barang::where('jenis_barang', strtoupper($jenis));

        // Filter pencarian
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('nama_barang', 'like', '%' . $request->search . '%')
                  ->orWhere('kode_barang', 'like', '%' . $request->search . '%');
            });
        }

        // Filter lokasi
        if ($request->filled('filterLetak')) {
            $query->where('letak_barang', $request->filterLetak);
        }

        // Filter status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $barangs = $query->orderBy('nama_barang')->get();
        
        // Data untuk barang yang sedang dipinjam
        $barangDipinjam = Peminjaman::whereIn('kode_barang', $barangs->pluck('kode_barang'))
                                   ->where('status', 'disetujui')
                                   ->get();

        $title = "Dashboard Pemilik " . strtoupper($jenis);
        $letakBarang = Barang::where('jenis_barang', strtoupper($jenis))
                            ->select('letak_barang')
                            ->distinct()
                            ->get();

        if ($request->ajax()) {
            return view('pemilik.table-partial', compact('barangs'));
        }
        
        return view('pemilik.dashboard', compact('barangs', 'barangDipinjam', 'title', 'letakBarang'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'letak_barang' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $jenis = $this->getJenisPemilik();
        $path = $request->file('gambar')->store('barang', 'public');
        
        // Generate kode barang
        $kodePrefix = substr($request->nama_barang, 0, 3) . '-' . substr($jenis, 0, 3);
        $lastBarang = Barang::where('kode_barang', 'like', $kodePrefix . '%')->latest()->first();
        $newNumber = $lastBarang ? (int)substr($lastBarang->kode_barang, -1) + 1 : 1;
        $kodeBarang = $kodePrefix . '-' . $request->letak_barang . '-' . $newNumber;

        Barang::create([
            'kode_barang' => $kodeBarang,
            'nama_barang' => $request->nama_barang,
            'letak_barang' => $request->letak_barang,
            'jenis_barang' => $jenis,
            'gambar' => $path,
            'status' => 'tersedia'
        ]);

        return redirect()->route('pemilik.dashboard')->with('success', 'Barang berhasil ditambahkan');
    }

    private function getJenisPemilik()
    {
        if (Auth::check()) {
            $userRoles = Auth::user()->roles->pluck('name');
            foreach ($userRoles as $role) {
                if (str_contains($role, 'pemilik-')) {
                    return strtoupper(str_replace('pemilik-', '', $role));
                }
            }
        }
        return null;
    }

    public function toggleBorrow(Barang $barang)
    {
        $barang->update([
            'can_borrowed' => !$barang->can_borrowed
        ]);

        return response()->json([
            'success' => true,
            'can_borrowed' => $barang->can_borrowed
        ]);
    }
}