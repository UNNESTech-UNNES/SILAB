<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {  // Role admin dan peminjam
        Role::updateOrCreate(['name' => 'admin']);
        Role::updateOrCreate(['name' => 'peminjam']);
        // Role untuk setiap jenis pemilik
        Role::updateOrCreate(['name' => 'pemilik-medunes']);
        Role::updateOrCreate(['name' => 'pemilik-sparka']);
        Role::updateOrCreate(['name' => 'pemilik-facetro']);
        Role::updateOrCreate(['name' => 'pemilik-silab']);
        Role::updateOrCreate(['name' => 'pemilik-lms']);
        Role::updateOrCreate(['name' => 'pemilik-sentis']);
        Role::updateOrCreate(['name' => 'pemilik-melodi']);
        Role::updateOrCreate(['name' => 'pemilik-umum']);
    }
}