<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function gantiKePemilik()
    {
        $user = Auth::user();

        if ($user instanceof User && $user->bisa_jadi_pemilik) {
            $user->role = 'pemilik';
            $user->save();

            return redirect()->route('pemilik.dashboard');
        }

        return redirect()->back()->with('error', 'Anda tidak diizinkan untuk menjadi pemilik.');
    }
}

