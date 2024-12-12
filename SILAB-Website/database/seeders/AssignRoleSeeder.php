<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AssignRoleSeeder extends Seeder
{
    public function run()
    {
        // Assign role admin ke user pertama (biasanya superadmin)
        $adminUser = User::first();
        if ($adminUser) {
            $adminUser->assignRole('admin');
        }
        
        // Assign role peminjam ke user lainnya
        $otherUsers = User::where('id', '!=', $adminUser->id)->get();
        foreach ($otherUsers as $user) {
            $user->assignRole('peminjam');
        }
    }
}