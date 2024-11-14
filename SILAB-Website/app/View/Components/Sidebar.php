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
            'icon' => 'fas fa-tachometer-alt'
        ],
        [
            'name' => 'Inventaris Barang',
            'route' => 'admin.barang.index',
            'icon' => 'fas fa-box'
        ],
        [
            'name' => 'Peminjaman',
            'route' => 'profile.edit',
            'icon' => 'fas fa-handshake',
            'children' => [
                [
                    'name' => 'Peminjaman Baru',
                    'route' => 'admin.peminjaman.index',
                    'icon' => 'fas fa-plus'
                ],
                [
                    'name' => 'Riwayat Peminjaman',
                    'route' => 'admin.peminjaman.index',
                    'icon' => 'fas fa-history'
                ]
            ]
        ],
        [
            'name' => 'Manajemen User',
            'route' => 'admin.peminjaman.index',
            'icon' => 'fas fa-users',
        ]
    ];

    return view('layouts.sidebar', compact('menus'));
}
}
