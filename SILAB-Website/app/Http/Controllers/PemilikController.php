<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PemilikController extends Controller
{
    public function index(Request $request)
    {
        $jenis = $this->getJenisPemilik();
        
        // Query dasar - tambahkan where jenis_barang
        $query = Barang::where('jenis_barang', $jenis);

        // Filter pencarian
        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('nama_barang', 'like', '%' . $request->search . '%')
                  ->orWhere('kode_barang', 'like', '%' . $request->search . '%');
            });
        }

        // Filter lokasi
        if ($request->filterLetak) {
            $query->where('letak_barang', $request->filterLetak);
        }

        // Filter status
        if ($request->status) {
            $query->where('status', $request->status);
        }

        $barangs = $query->get();
        
        // Data untuk barang yang sedang dipinjam
        $barangDipinjam = Peminjaman::whereIn('kode_barang', $barangs->pluck('kode_barang'))
                                   ->whereIn('status', ['disetujui', 'dipinjam'])
                                   ->with('barang') // Eager load barang
                                   ->orderBy('tanggal_pengembalian', 'asc')
                                   ->get();

        $title = "Dashboard Pemilik " . strtoupper($jenis);
        $letakBarang = Barang::where('jenis_barang', $jenis)
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
            'jumlah' => 'required|integer|min:1',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $jenis = $this->getJenisPemilik();
        $path = $request->file('gambar')->store('barang', 'public');
        
        // Generate kode barang
        $namaPrefix = strtoupper(substr(preg_replace('/[^a-zA-Z0-9]/', '', $request->nama_barang), 0, 3));
        $jenisPrefix = strtoupper(substr(preg_replace('/[^a-zA-Z0-9]/', '', $jenis), 0, 3));
        
        // Mendapatkan nomor urut terakhir untuk kode barang dengan prefix yang sama
        $lastBarang = Barang::where('kode_barang', 'like', $namaPrefix . '-' . $jenisPrefix . '-%')
            ->orderBy('kode_barang', 'desc')
            ->first();

        $newNumber = $lastBarang ? (int)substr($lastBarang->kode_barang, strrpos($lastBarang->kode_barang, '-') + 1) + 1 : 1;

        // Buat barang sesuai jumlah yang diminta
        for ($i = 0; $i < $request->jumlah; $i++) {
            $kodeBarang = $namaPrefix . '-' . $jenisPrefix . '-' . $request->letak_barang . '-' . ($newNumber + $i);
            
            Barang::create([
                'kode_barang' => $kodeBarang,
                'nama_barang' => $request->nama_barang,
                'jenis_barang' => $jenis,
                'letak_barang' => $request->letak_barang,
                'gambar' => $path,
                'status' => 'tersedia',
                'can_borrowed' => true
            ]);
        }

        return redirect()->back()->with('success', 'Barang berhasil ditambahkan');
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

    public function edit(Barang $barang)
    {
        return response()->json([
            'success' => true,
            'barang' => $barang
        ]);
    }

    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'nama_barang' => 'required',
            'letak_barang' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = [
            'nama_barang' => $request->nama_barang,
            'letak_barang' => $request->letak_barang,
        ];

        if ($request->hasFile('gambar')) {
            // Simpan gambar baru terlebih dahulu
            $newPath = $request->file('gambar')->store('barang', 'public');
            
            // Jika berhasil upload gambar baru, baru hapus yang lama
            if ($newPath && $barang->gambar) {
                Storage::disk('public')->delete($barang->gambar);
            }
            
            $data['gambar'] = $newPath;
        }

        $barang->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Barang berhasil diperbarui',
            'barang' => $barang
        ]);
    }

    public function destroy(Barang $barang)
    {
        if ($barang->status === 'dipinjam') {
            return response()->json([
                'success' => false,
                'message' => 'Barang sedang dipinjam dan tidak dapat dihapus'
            ], 400);
        }

        if ($barang->gambar && Storage::disk('public')->exists($barang->gambar)) {
            Storage::disk('public')->delete($barang->gambar);
        }

        $barang->delete();

        return response()->json([
            'success' => true,
            'message' => 'Barang berhasil dihapus'
        ]);
    }
}