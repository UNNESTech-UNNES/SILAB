<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

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

    private function getBarangData($search = null, $filter = null)
    {
        $query = DB::table('barangs')
            ->select(
                'nama_barang',
                'letak_barang',
                DB::raw('MIN(gambar) as gambar'),
                DB::raw('COUNT(*) as total'),
                DB::raw('SUM(CASE WHEN status != "dipinjam" OR status IS NULL THEN 1 ELSE 0 END) as available_quantity')
            )
            ->groupBy('nama_barang', 'letak_barang');

        // Terapkan filter pencarian jika ada
        if (!empty($search)) {
            $query->where('nama_barang', 'like', '%' . $search . '%');
        }

        // Terapkan filter ruangan jika ada
        if (!empty($filter)) {
            $query->where('letak_barang', $filter);
        }

        return $query->get();
    }

    public function showCard(Request $request)
    {
        $search = $request->get('search');
        $filter = $request->get('filter');
        
        $barangs = $this->getBarangData($search, $filter);

        if ($request->ajax()) {
            // Render partial view untuk AJAX request
            return view('components.barang-items', ['barangs' => $barangs])->render();
        }

        return view('peminjam.dashboard', ['barangs' => $barangs]);
    }

    public function welcomeCard(Request $request)
    {
        $search = $request->get('search');
        $filter = $request->get('filter');
        
        $barangs = $this->getBarangData($search, $filter);

        if ($request->ajax()) {
            // Render partial view untuk AJAX request
            return view('components.barang-items', ['barangs' => $barangs])->render();
        }

        return view('welcome', ['barangs' => $barangs]);
    }
}