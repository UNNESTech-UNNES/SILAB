<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotifikasiController extends Controller
{
    // Menampilkan notifikasi untuk peminjam
    public function index()
    {
        $notifikasi = Notifikasi::where('user_id', Auth::user()->id)->get();
        return view('peminjam.notifikasi', compact('notifikasi'));
    }

    // Menampilkan halaman pengaturan notifikasi untuk admin
    public function adminIndex()
    {
        $notifikasi = Notifikasi::all();
        return view('admin.notifikasi.index', compact('notifikasi'));
    }

    // Mengubah status notifikasi menjadi terbaca
    public function markAsRead($id)
    {
        $notifikasi = Notifikasi::find($id);
        $notifikasi->is_read = true;
        $notifikasi->save();

        return redirect()->back();
    }

    // Menampilkan form kirim pesan
    public function createMessage()
    {
        // Mengambil semua user yang memiliki role 'peminjam'
        $users = \App\Models\User::role('peminjam')->get();
        return view('admin.notifikasi.create', compact('users'));
    }

    // Menyimpan pesan notifikasi
    public function storeMessage(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'message' => 'required|string'
        ]);

        Notifikasi::kirimNotifikasiCustom($request->user_id, $request->message);

        return redirect()->route('admin.notifikasi.index')->with('success', 'Pesan berhasil dikirim');
    }
}