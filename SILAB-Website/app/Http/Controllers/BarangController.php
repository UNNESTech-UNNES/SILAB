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
        $query = Barang::query();

        if ($request->filled('search')) {
            $query->where('nama_barang', 'like', '%' . $request->search . '%')
                  ->orWhere('kode_barang', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('filter_letak')) {
            $query->where('letak_barang', $request->filter_letak);
        }

        if ($request->filled('filter_jenis')) {
            $query->where('jenis_barang', $request->filter_jenis);
        }

        if ($request->filled('filter_kondisi')) {
            $query->where('kondisi_barang', $request->filter_kondisi);
        }

        $barang = $query->get();
        $letakBarang = Barang::select('letak_barang')->distinct()->get();
        $jenisBarang = Barang::select('jenis_barang')->distinct()->get();
        $kondisiBarang = Barang::select('kondisi_barang')->distinct()->get();

        if ($request->ajax()) {
            return view('admin.barang.table-partial', compact('barang'));
        }

        return view('admin.barang.index', compact('barang', 'letakBarang', 'jenisBarang', 'kondisiBarang'));
    }

    public function create()
    {
        return view('admin.barang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'jenis_barang' => 'required',
            'letak_barang' => 'required',
            'kondisi_barang' => 'required',
            'jumlah' => 'required|integer|min:1',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Simpan gambar jika ada
        $path = $request->file('gambar') ? $request->file('gambar')->store('barang', 'public') : null;

        // Generate kode barang
        $kodePrefix = substr($request->nama_barang, 0, 3) . '-' . substr($request->jenis_barang, 0, 3);
        $lastBarang = Barang::where('kode_barang', 'like', $kodePrefix . '%')->latest()->first();
        $newNumber = $lastBarang ? (int)substr($lastBarang->kode_barang, -1) + 1 : 1;

        // Buat barang sesuai jumlah yang diminta
        for ($i = 0; $i < $request->jumlah; $i++) {
            $kodeBarang = $kodePrefix . '-' . $request->letak_barang . '-' . ($newNumber + $i);
            
            Barang::create([
                'kode_barang' => $kodeBarang,
                'nama_barang' => $request->nama_barang,
                'jenis_barang' => $request->jenis_barang,
                'letak_barang' => $request->letak_barang,
                'kondisi_barang' => $request->kondisi_barang,
                'gambar' => $path,
                'status' => 'tersedia',
                'can_borrowed' => true
            ]);
        }

        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('admin.barang.index')->with('success', 'Barang berhasil ditambahkan');
    }

    public function show(Barang $barang)
    {
        return view('admin.barang.show', compact('barang'));
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
        $query = DB::table('barangs')
            ->where('can_borrowed', true);

        // Filter berdasarkan role pemilik
        if (Auth::check()) {
            $userRoles = Auth::user()->roles->pluck('name');
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
            $userRoles = Auth::user()->roles->pluck('name');
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

    public function getTableData(Request $request)
    {
        $query = Barang::query();

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('nama_barang', 'like', '%' . $request->search . '%')
                  ->orWhere('kode_barang', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('filter_letak')) {
            $query->where('letak_barang', $request->filter_letak);
        }

        if ($request->filled('filter_jenis')) {
            $query->where('jenis_barang', $request->filter_jenis);
        }

        if ($request->filled('filter_kondisi')) {
            $query->where('kondisi_barang', $request->filter_kondisi);
        }

        $barang = $query->get();
        return view('admin.barang.table-partial', compact('barang'));
    }

    public function getEditForm(Barang $barang)
    {
        return view('admin.barang.edit-form', compact('barang'));
    }

    public function updateAjax(Request $request, Barang $barang)
    {
        $request->validate([
            'nama_barang' => 'required',
            'jenis_barang' => 'required',
            'letak_barang' => 'required',
            'kondisi_barang' => 'required',
        ]);

        $data = $request->only(['nama_barang', 'jenis_barang', 'letak_barang', 'kondisi_barang']);
        
        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('barang', 'public');
            $data['gambar'] = $path;
        }

        $barang->update($data);

        return response()->json(['success' => true]);
    }
}