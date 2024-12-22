<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemilikController extends Controller
{
    public function index(Request $request)
    {
        // Dapatkan jenis pemilik dari role user
        $jenis = null;
        if (Auth::check()) {
            $userRoles = Auth::user()->getRoleNames();
            foreach ($userRoles as $role) {
                if (str_contains($role, 'pemilik-')) {
                    $jenis = strtoupper(str_replace('pemilik-', '', $role));
                    break;
                }
            }
        }

        // Query dasar
        $query = Barang::where('jenis_barang', $jenis);

        // Pencarian berdasarkan nama barang
        if ($request->filled('search')) {
            $query->where('nama_barang', 'like', '%' . $request->search . '%');
        }

        // Filter berdasarkan letak_barang
        if ($request->filled('filterLetak')) {
            $query->where('letak_barang', $request->filterLetak);
        }

        // Ambil data
        $barangs = $query->orderBy('nama_barang')->get();
        $title = "Dashboard Pemilik " . $jenis;

        // Untuk dropdown filter
        $letakBarang = Barang::where('jenis_barang', $jenis)
                            ->select('letak_barang')
                            ->distinct()
                            ->get();

        if ($request->ajax()) {
            return view('pemilik.table-partial', compact('barangs'))->render();
        }
        
        return view('pemilik.dashboard', compact('barangs', 'title', 'letakBarang'));
    }
}