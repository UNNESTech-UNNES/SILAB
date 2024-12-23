<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman';

    protected $fillable = [
        'user_id',
        'kode_barang',
        'nama_barang',
        'letak_barang',
        'nama_peminjam',
        'alamat_peminjam',
        'nomor_handphone',
        'surat_tugas',
        'tanggal_peminjaman',
        'tanggal_pengembalian',
        'status',
    ];

    public function showBarang()
    {
        $barang = Barang::all();
        return view('admin.users.index', compact('barang'));
    }
    // Relasi ke model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Status peminjaman (disetujui, ditolak, dll)
    public function scopeMenungguPersetujuan($query)
    {
        return $query->where('status', 'menunggu persetujuan');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'kode_barang', 'kode_barang');
    }
}