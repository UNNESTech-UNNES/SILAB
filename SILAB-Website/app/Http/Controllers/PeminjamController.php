<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipeKepemilikan;

class PeminjamController extends Controller
{
    public function dashboard()
    {
        $tipeKepemilikan = TipeKepemilikan::all();
        return view('peminjam.dashboard', compact('tipeKepemilikan'));
    }
}