<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('perPage', 10);
        $barang = Barang::paginate($perPage);
    
        $query = Barang::query();

        // Pencarian berdasarkan nama barang
        if ($request->filled('search')) {
            $query->where('nama_barang', 'like', '%' . $request->search . '%');
        }

        // Filter berdasarkan letak_barang
        if ($request->filled('filter_letak')) {
            $query->where('letak_barang', $request->filter_letak);
        }

        // Filter berdasarkan jenis_barang
        if ($request->filled('filter_jenis')) {
            $query->where('jenis_barang', $request->filter_jenis);
        }

        // Filter berdasarkan kondisi_barang
        if ($request->filled('filter_kondisi')) {
            $query->where('kondisi_barang', $request->filter_kondisi);
        }

        $barang = $query->paginate($perPage);

        // Ambil semua letak dan jenis untuk dropdown filter
        $letakBarang = Barang::select('letak_barang')->distinct()->get();
        $jenisBarang = Barang::select('jenis_barang')->distinct()->get();
        $kondisiBarang = Barang::select('kondisi_barang')->distinct()->get();

        return view('admin.barang.index', compact('barang', 'letakBarang', 'jenisBarang', 'kondisiBarang'));
    }

    public function create()
    {
        return view('admin.barang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'jenis_barang' => 'required|string|max:255',
            'letak_barang' => 'required|string|max:255',
            'kondisi_barang' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $path = $request->file('gambar') ? $request->file('gambar')->store('images', 'public') : null;

        // Simpan data barang tanpa kode_barang
        $barang = Barang::create([
            'nama_barang' => $request->nama_barang,
            'jenis_barang' => $request->jenis_barang,
            'letak_barang' => $request->letak_barang,
            'gambar' => $path,
            'kondisi_barang' => $request->kondisi_barang,
        ]);

        // Buat kode_barang dengan menggabungkan id
        $kode_barang = substr($request->nama_barang, 0, 3) . '-' . 
                    substr($request->jenis_barang, 0, 3) . '-' . 
                    substr($request->letak_barang, 0, 3) . '-' . 
                    $barang->id;

        // Perbarui barang dengan kode_barang
        $barang->update([
            'kode_barang' => strtoupper($kode_barang),
        ]);

        return redirect()->route('admin.barang.index')->with('success', 'Barang berhasil ditambahkan.');
    }

    public function show(Barang $barang)
    {
        return view('admin.barang.show', compact('barang'));
    }

    public function edit(Barang $barang)
    {
        return view('admin.barang.edit', compact('barang'));
    }

    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'jenis_barang' => 'required|string|max:255',
            'letak_barang' => 'required|string|max:255',
            'kondisi_barang' => 'required|string|max:255', // Tambahkan validasi kondisi_barang
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($barang->gambar) {
                Storage::disk('public')->delete($barang->gambar);
            }
            $path = $request->file('gambar')->store('images', 'public');
            $barang->gambar = $path;
        }
    
        // Membuat kode barang unik dengan id
        $kode_barang = substr($request->nama_barang, 0, 3) . '-' . 
                    substr($request->jenis_barang, 0, 3) . '-' . 
                    substr($request->letak_barang, 0, 3) . '-' . 
                    $barang->id;
    
        $barang->update([
            'nama_barang' => $request->nama_barang,
            'jenis_barang' => $request->jenis_barang,
            'letak_barang' => $request->letak_barang,
            'kondisi_barang' => $request->kondisi_barang,
            'kode_barang' => strtoupper($kode_barang), // Menambahkan kode barang dengan id
        ]);
    
        return redirect()->route('admin.barang.index')->with('success', 'Barang berhasil diperbarui.');
    }

    public function destroy(Barang $barang)
    {
        $barang->delete();
        return redirect()->route('admin.barang.index')->with('success', 'Barang berhasil dihapus.');
    }
    public function barangDipinjam()
    {
        // Logika untuk menampilkan barang yang dipinjam
        return view('admin.barang.barangDipinjam');
    }

    public function riwayatPeminjaman()
    {
        // Logika untuk menampilkan riwayat peminjaman
        return view('admin.barang.riwayatPeminjaman');
    }
}