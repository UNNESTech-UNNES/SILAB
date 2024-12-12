<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        Permission::firstOrCreate(['name' => 'create-peminjaman']);
        Permission::firstOrCreate(['name' => 'edit-peminjaman']);
        Permission::firstOrCreate(['name' => 'delete-peminjaman']);
        // tambahkan permission lainnya
    }
}