<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        $permissions = Permission::all();
        
        return view('admin.users.edit', compact('user', 'roles', 'permissions'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|string|exists:roles,name'
        ]);
    
        // Hapus semua role yang ada
        $user->roles()->detach();
        
        // Assign role baru
        $user->assignRole($request->role);
        
        return redirect()->route('admin.users.index')
            ->with('success', 'Role user berhasil diperbarui');
        
        // Sync permissions
        if($request->has('permissions')) {
            $user->syncPermissions($request->permissions);
        } else {
            $user->syncPermissions([]);
        }
        
        return redirect()->route('admin.users.index')
            ->with('success', 'Role user berhasil diperbarui');
    }
}



