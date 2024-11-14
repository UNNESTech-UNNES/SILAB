<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserAccessController extends Controller {
    public function index() {
        $users = User::all(); // Ambil semua pengguna
        return view('admin.users.index', compact('users'));
    }

    public function toggleActive($id) {
        $user = User::findOrFail($id);
        $user->is_active = !$user->is_active; // Toggle status
        $user->save();

        return redirect()->back()->with('success', 'Status pengguna berhasil diubah');
    }

    public function updatePermissions(Request $request, $id) {
        $user = User::findOrFail($id);
        $user->permissions = json_encode($request->input('permissions'));
        $user->save();

        return redirect()->back()->with('success', 'Izin pengguna berhasil diperbarui');
    }
}