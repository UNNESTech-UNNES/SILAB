<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeranjangPeminjaman extends Model
{
    use HasFactory;

    protected $table = 'keranjang_peminjaman';

    protected $fillable = [
        'user_id',
        'kode_barang',
        'nama_barang',
        'letak_barang',
        'jumlah',
    ];

    // Relasi ke model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
