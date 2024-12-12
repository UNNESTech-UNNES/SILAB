<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index(Request $request)
    {
        $query = Barang::query();

        // Filter berdasarkan role user
        if ($request->user()->hasRole('pemilik-medunes')) {
            $query->where('jenis_barang', 'MEDUNES');
        } // tambahkan kondisi untuk role lainnya

        // Filter pencarian
        if ($request->has('search')) {
            $query->where('nama_barang', 'like', '%' . $request->search . '%');
        }

        $barangs = $query->get();

        return response()->json([
            'success' => true,
            'data' => $barangs
        ]);
    }

    public function show(Barang $barang)
    {
        return response()->json([
            'success' => true,
            'data' => $barang
        ]);
    }
}