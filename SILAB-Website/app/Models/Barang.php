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
    ];

    public function scopeTersedia($query)
    {
        return $query->where('status', 'tersedia');
    }
}