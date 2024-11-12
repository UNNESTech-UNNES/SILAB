<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipeKepemilikan extends Model
{
    use HasFactory;

    protected $fillable = ['nama'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'pemilik_tipe_kepemilikans');
    }
}
