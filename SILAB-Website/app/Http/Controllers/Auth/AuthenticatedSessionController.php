<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

    $request->session()->regenerate();

    // Dapatkan pengguna yang sedang login
    $user = Auth::user();

    // Periksa peran pengguna dan arahkan ke dashboard yang sesuai
    if ($user->role === 'admin') {
        return redirect()->intended(route('admin.dashboard'));
    } elseif ($user->role === 'peminjam') {
        return redirect()->intended(route('peminjam.dashboard'));
    } elseif ($user->role === 'pemilik') {
        return redirect()->intended(route('pemilik.dashboard'));
    }

    // Default redirect jika role tidak dikenali
    return redirect()->intended(route('/'), 302, ['role' => $user->role]);

    // return redirect()->intended(route('dashboard'));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
