<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use App\Models\KeranjangPeminjaman;
use Illuminate\Support\Facades\Auth;

class KeranjangPeminjamanController extends Controller
{
    public function index()
    {
        $keranjangItems = KeranjangPeminjaman::where('user_id', Auth::id())->with('barang')->get();
        return view('peminjam.keranjang', compact('keranjangItems'));
    }

    public function tambah(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string',
            'letak_barang' => 'required|string',
            'jumlah' => 'required|integer|min:1',
        ]);

        $barangTersedia = Barang::where('nama_barang', $request->nama_barang)
                               ->where('letak_barang', $request->letak_barang)
                               ->where('status', 'tersedia')
                               ->count();

        if ($barangTersedia < $request->jumlah) {
            return response()->json([
                'success' => false,
                'message' => 'Jumlah barang tidak tersedia'
            ], 400);
        }

        // Ambil barang yang akan dipinjam
        $barangs = Barang::where('nama_barang', $request->nama_barang)
                         ->where('letak_barang', $request->letak_barang)
                         ->where('status', 'tersedia')
                         ->limit($request->jumlah)
                         ->get();

        foreach ($barangs as $barang) {
            $barang->update(['status' => 'dipinjam']);
            
            KeranjangPeminjaman::create([
                'user_id' => Auth::id(),
                'kode_barang' => $barang->kode_barang,
                'nama_barang' => $barang->nama_barang,
                'letak_barang' => $barang->letak_barang,
                'jumlah' => 1,
            ]);
        }

        $cartCount = KeranjangPeminjaman::where('user_id', Auth::id())->count();

        return response()->json([
            'success' => true,
            'message' => 'Barang ditambahkan ke keranjang',
            'cartCount' => $cartCount
        ]);
    }

    public function hapus($id)
    {
        // Temukan item keranjang berdasarkan ID
        $keranjangItem = KeranjangPeminjaman::findOrFail($id);

        // Ubah status barang kembali ke tersedia
        Barang::where('kode_barang', $keranjangItem->kode_barang)
              ->update(['status' => 'tersedia']);

        // Hapus item dari keranjang
        $keranjangItem->delete();

        return redirect()->route('peminjam.keranjang.index')->with('success', 'Barang dihapus dari keranjang dan status dikembalikan ke tersedia.');
    }

    public function finalisasi(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'nomor_handphone' => 'required|string|max:15',
            'surat_tugas' => 'required|mimes:jpeg,png,jpg,pdf,doc,docx|max:2048',
            'tanggal_dipinjam' => 'required|date',
            'tanggal_dikembalikan' => 'required|date|after_or_equal:tanggal_dipinjam',
        ]);

        $path = $request->file('surat_tugas')->store('surat_tugas', 'public');

        $keranjangItems = KeranjangPeminjaman::where('user_id', Auth::id())->get();

        foreach ($keranjangItems as $item) {
            Peminjaman::create([
                'user_id' => Auth::id(),
                'kode_barang' => $item->kode_barang,
                'nama_barang' => $item->nama_barang,
                'letak_barang' => $item->letak_barang,
                'nama_peminjam' => $request->nama,
                'alamat_peminjam' => $request->alamat,
                'nomor_handphone' => $request->nomor_handphone,
                'surat_tugas' => $path,
                'tanggal_peminjaman' => $request->tanggal_dipinjam,
                'tanggal_pengembalian' => $request->tanggal_dikembalikan,
                'status' => 'menunggu persetujuan',
            ]);    

            $item->delete();
        }

        return redirect()->route('peminjam.dashboard')->with('success', 'Peminjaman berhasil diajukan.');
    }
}