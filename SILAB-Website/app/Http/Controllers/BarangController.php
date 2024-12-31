<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = Barang::query();
            $perPage = $request->get('per_page', 10);

            // Filter berdasarkan pencarian
            if ($request->filled('search')) {
                $query->where(function($q) use ($request) {
                    $q->where('nama_barang', 'like', '%' . $request->search . '%')
                      ->orWhere('kode_barang', 'like', '%' . $request->search . '%');
                });
            }

            // Filter lainnya
            if ($request->filled('filter_letak')) {
                $query->where('letak_barang', $request->filter_letak);
            }
            if ($request->filled('filter_jenis')) {
                $query->where('jenis_barang', $request->filter_jenis);
            }
            if ($request->filled('filter_kondisi')) {
                $query->where('kondisi_barang', $request->filter_kondisi);
            }

            // $barang = $query->paginate($perPage)->withQueryString();
            $letakBarang = Barang::select('letak_barang')->distinct()->get();
            $jenisBarang = Barang::select('jenis_barang')->distinct()->get();
            $kondisiBarang = Barang::select('kondisi_barang')->distinct()->get();

            if ($request->ajax()) {
                return view('admin.barang.table-partial', compact('barang'));
            }

            return view('admin.barang.index', compact('barang', 'letakBarang', 'jenisBarang', 'kondisiBarang'));

        } catch (\Exception $e) {
            Log::error('Error in BarangController@index: ' . $e->getMessage());
            
            if ($request->ajax()) {
                return response()->json([
                    'error' => 'Terjadi kesalahan saat memuat data'
                ], 500);
            }
            
            return back()->with('error', 'Terjadi kesalahan saat memuat data');
        }
    }

    public function create()
    {
        return view('admin.barang.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama_barang' => 'required',
                'jenis_barang' => 'required',
                'letak_barang' => 'required',
                'kondisi_barang' => 'required',
                'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'jumlah' => 'required|integer|min:1'
            ]);

            // Generate kode barang
            $namaPrefix = strtoupper(substr(preg_replace('/[^a-zA-Z0-9]/', '', $request->nama_barang), 0, 3));
            $jenisPrefix = strtoupper(substr(preg_replace('/[^a-zA-Z0-9]/', '', $request->jenis_barang), 0, 3));
            
            // Mendapatkan nomor urut terakhir untuk kode barang dengan prefix yang sama
            $lastBarang = Barang::where('kode_barang', 'like', $namaPrefix . '-' . $jenisPrefix . '-' . $request->letak_barang . '-%')
                ->orderBy('kode_barang', 'desc')
                ->first();

            $newNumber = $lastBarang ? (int)substr($lastBarang->kode_barang, strrpos($lastBarang->kode_barang, '-') + 1) + 1 : 1;

            // Upload gambar sekali saja
            $gambarPath = $request->file('gambar')->store('barang', 'public');

            // Buat barang sesuai jumlah yang diminta
            for ($i = 0; $i < $request->jumlah; $i++) {
                $kodeBarang = $namaPrefix . '-' . $jenisPrefix . '-' . $request->letak_barang . '-' . ($newNumber + $i);
                
                Barang::create([
                    'kode_barang' => strtoupper($kodeBarang),
                    'nama_barang' => $request->nama_barang,
                    'jenis_barang' => $request->jenis_barang,
                    'letak_barang' => $request->letak_barang,
                    'kondisi_barang' => $request->kondisi_barang,
                    'gambar' => $gambarPath,
                    'status' => 'tersedia',
                    'can_borrowed' => true
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Barang berhasil ditambahkan'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan barang: ' . $e->getMessage()
            ], 500);
        }
    }

    public function show(Barang $barang)
    {
        return view('admin.barang.show', compact('barang'));
    }

    public function destroy(Barang $barang)
    {
        try {
            $barang->delete();
            return response()->json([
                'success' => true,
                'message' => 'Barang berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus barang'
            ], 500);
        }
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

    public function edit(Barang $barang)
    {
        try {
            return response()->json([
                'success' => true,
                'barang' => $barang
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memuat data barang'
            ], 500);
        }
    }

    public function update(Request $request, Barang $barang)
    {
        try {
            $request->validate([
                'nama_barang' => 'required',
                'jenis_barang' => 'required',
                'letak_barang' => 'required',
                'kondisi_barang' => 'required',
                'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            $data = $request->only([
                'nama_barang', 
                'jenis_barang', 
                'letak_barang', 
                'kondisi_barang'
            ]);
            
            if ($request->hasFile('gambar')) {
                if ($barang->gambar) {
                    Storage::disk('public')->delete($barang->gambar);
                }
                $data['gambar'] = $request->file('gambar')->store('barang', 'public');
            }

            $barang->update($data);

            return response()->json([
                'success' => true,
                'message' => 'Barang berhasil diperbarui'
            ]);
        } catch (\Exception $e) {
            Log::error('Error updating barang: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui barang: ' . $e->getMessage()
            ], 500);
        }
    }
}