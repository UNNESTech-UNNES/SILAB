<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Notifikasi extends Model
{
    use HasFactory;
    
    protected $table = 'notifikasi';

    protected $fillable = [
        'user_id', 
        'type', // auto/custom
        'message', 
        'is_read',
        'related_model_type', // tipe model terkait (peminjaman)
        'related_model_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Fungsi untuk mengirim notifikasi otomatis
    public static function kirimNotifikasiOtomatis($peminjaman)
    {
        // Logika untuk mengirim notifikasi otomatis
        $tanggalPengembalian = Carbon::parse($peminjaman->tanggal_pengembalian);
        if (Carbon::now()->diffInDays($tanggalPengembalian) == 1) {
            self::create([
                'user_id' => $peminjaman->user_id,
                'type' => 'auto',
                'message' => 'Pengembalian barang H-1',
                'related_model_type' => 'Peminjaman',
                'related_model_id' => $peminjaman->id
            ]);
        }
    }

    // Fungsi untuk mengirim notifikasi custom
    public static function kirimNotifikasiCustom($userId, $pesan)
    {
        // Logika untuk mengirim notifikasi custom
        self::create([
            'user_id' => $userId,
            'type' => 'custom',
            'message' => $pesan,
            'related_model_type' => null,
            'related_model_id' => null
        ]);
    }
}