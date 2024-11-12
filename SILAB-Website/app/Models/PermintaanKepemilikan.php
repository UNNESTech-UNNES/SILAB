<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermintaanKepemilikan extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'tipe_kepemilikan_id', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tipeKepemilikan()
    {
        return $this->belongsTo(TipeKepemilikan::class);
    }
}
