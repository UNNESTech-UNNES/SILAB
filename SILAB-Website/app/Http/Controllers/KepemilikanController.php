<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PermintaanKepemilikan;
use App\Models\TipeKepemilikan;
use Illuminate\Support\Facades\Auth;

class KepemilikanController extends Controller
{
    public function showForm()
    {
        $tipeKepemilikan = TipeKepemilikan::all();
        return view('peminjam.dashboard', compact('tipeKepemilikan'));
    }

    public function ajukan(Request $request)
    {
        $request->validate([
            'tipe_kepemilikan' => 'required|exists:tipe_kepemilikans,id',
        ]);

        PermintaanKepemilikan::create([
            'user_id' => Auth::id(), // Menggunakan Auth::id() untuk mendapatkan ID pengguna
            'tipe_kepemilikan_id' => $request->tipe_kepemilikan,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('status', 'Permintaan kepemilikan Anda telah diajukan.');
    }

    public function kelola()
    {
        $permintaan = PermintaanKepemilikan::where('status', 'pending')->get();
        return view('admin.dashboard', compact('permintaan'));
    }

    public function setujui($id)
    {
        $request = PermintaanKepemilikan::find($id);
        if ($request->status == 'pending') {
            $request->update(['status' => 'approved']);
            $request->user->tipeKepemilikan()->attach($request->tipe_kepemilikan_id);
        }

        return redirect()->back()->with('status', 'Permintaan telah disetujui.');
    }

    public function tolak($id)
    {
        $request = PermintaanKepemilikan::find($id);
        if ($request->status == 'pending') {
            $request->update(['status' => 'rejected']);
        }

        return redirect()->back()->with('status', 'Permintaan telah ditolak.');
    }
}