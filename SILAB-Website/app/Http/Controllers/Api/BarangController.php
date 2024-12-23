<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index(Request $request)
    {
        $barang = Barang::when($request->search, function($query, $search) {
                return $query->where('nama_barang', 'like', "%{$search}%")
                           ->orWhere('kode_barang', 'like', "%{$search}%");
            })
            ->where('status', 'tersedia')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $barang
        ]);
    }

    public function show($kode_barang)
    {
        $barang = Barang::where('kode_barang', $kode_barang)->first();
        
        if (!$barang) {
            return response()->json([
                'success' => false,
                'message' => 'Barang tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $barang
        ]);
    }
}