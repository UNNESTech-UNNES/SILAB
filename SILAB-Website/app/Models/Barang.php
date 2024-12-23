<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $fillable = [
        'nama_barang',
        'jenis_barang',
        'letak_barang',
        'gambar',
        'kode_barang',
        'kondisi_barang',
        'status',
        'can_borrowed',
    ];

    protected $casts = [
        'can_borrowed' => 'boolean',
    ];

    public function scopeTersedia($query)
    {
        return $query->where('status', 'tersedia');
    }
    
    public function scopeForRole($query, $role)
    {
        if (str_contains($role, 'peminjam-')) {
            $jenis = strtoupper(str_replace('peminjam-', '', $role));
            return $query->where('jenis_barang', $jenis);
        }
        return $query;
    }

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class);
    }
}
