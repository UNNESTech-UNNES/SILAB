<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Sidebar extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
{
    $menus = [
        [
            'name' => 'Dashboard',
            'route' => 'admin.dashboard',
            'icon' => 'fas fa-box'
        ],
        [
            'name' => 'Inventaris Barang',
            'route' => 'admin.inventaris',
            'icon' => 'fas fa-box'
        ],
        [
            'name' => 'Peminjaman',
            'route' => 'profile.edit',
            'icon' => 'fas fa-hand-holding-hand',
            'children' => [ // Menambahkan submenu
                [
                    'name' => 'Peminjaman Baru',
                    'route' => 'admin.barangDipinjam',
                    'icon' => 'fas fa-plus'
                ],
                [
                    'name' => 'Riwayat Peminjaman',
                    'route' => 'admin.riwayatPeminjaman',
                    'icon' => 'fas fa-history'
                ]
            ]
        ],
        [
            'name' => 'Profil',
            'route' => 'profile.edit',
            'icon' => 'fas fa-user',
        ]
    ];

    return view('layouts.sidebar', compact('menus'));
}
}
