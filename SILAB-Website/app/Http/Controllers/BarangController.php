<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
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
            'jumlah' => 'required|integer|min:1',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $path = $request->file('gambar') ? $request->file('gambar')->store('images', 'public') : null;

        // Loop sebanyak jumlah yang diinginkan
        for ($i = 0; $i < $request->jumlah; $i++) {
            // Simpan data barang
            $barang = Barang::create([
                'nama_barang' => $request->nama_barang,
                'jenis_barang' => $request->jenis_barang,
                'letak_barang' => $request->letak_barang,
                'gambar' => $path,
                'kondisi_barang' => $request->kondisi_barang,
                'status' => 'tersedia'
            ]);

            // Generate kode barang unik
            $kode_barang = substr($request->nama_barang, 0, 3) . '-' . 
                        substr($request->jenis_barang, 0, 3) . '-' . 
                        substr($request->letak_barang, 0, 3) . '-' . 
                        $barang->id;

            // Update kode barang
            $barang->update([
                'kode_barang' => strtoupper($kode_barang),
            ]);
        }

        return redirect()->route('admin.barang.index')
            ->with('success', $request->jumlah . ' barang berhasil ditambahkan.');
    }

    public function show(Barang $barang)
    {
        return view('admin.barang.show', compact('barang'));
    }

    public function edit(Barang $barang)
    {
        return view('admin.barang.edit', compact('barang'));
    }

    public function update(Request $request, $id) {
        // Validasi data
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'jenis_barang' => 'required|string|max:255',
            'letak_barang' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Temukan barang berdasarkan ID
        $barang = Barang::findOrFail($id);
    
        // Update data barang
        $barang->nama_barang = $request->nama_barang;
        $barang->jenis_barang = $request->jenis_barang;
        $barang->letak_barang = $request->letak_barang;
    
        // Cek jika ada gambar yang diupload
        if ($request->hasFile('gambar')) {
            // Proses upload gambar
            $path = $request->file('gambar')->store('images', 'public');
            $barang->gambar = $path;
        }
    
        // Simpan perubahan
        $barang->save();
    
        // Redirect atau kembali dengan pesan sukses
        return redirect()->route('admin.barang.index')->with('success', 'Barang berhasil diperbarui.');
    }

    public function destroy(Barang $barang)
    {
        $barang->delete();
        return redirect()->route('admin.barang.index')->with('success', 'Barang berhasil dihapus.');
    }

    private function getBarangData($search = null, $filter = null)
    {
        $query = DB::table('barangs');

        // Filter berdasarkan role pemilik
        if (Auth::check()) {
            $userRoles = Auth::user()->getRoleNames();
            foreach ($userRoles as $role) {
                if (str_contains($role, 'pemilik-')) {
                    $jenis = strtoupper(str_replace('pemilik-', '', $role));
                    $query->where('jenis_barang', $jenis);
                    break;
                }
            }
        }

        $query->select(
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

    public function showCardPemilik(Request $request)
    {
        $search = $request->get('search');
        $filter = $request->get('filter');
        
        $barangs = $this->getBarangData($search, $filter);

        if (Auth::check()) {
            $userRoles = Auth::user()->getRoleNames();
            foreach ($userRoles as $role) {
                if (str_contains($role, 'pemilik-')) {
                    $jenis = strtoupper(str_replace('pemilik-', '', $role));
                    $title = "Dashboard Pemilik " . $jenis;
                    break;
                }
            }
        }

        if ($request->ajax()) {
            return view('components.barang-items', ['barangs' => $barangs])->render();
        }
        
            return view('pemilik.dashboard', compact('barangs', 'title'));
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