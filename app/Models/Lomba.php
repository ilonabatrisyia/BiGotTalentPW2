<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lomba extends Model
{
    // 1. Mengizinkan kolom diisi data
    protected $fillable = ['nama_lomba', 'deskripsi'];

    // 2. Relasi ke tabel Pendaftaran
    public function pendaftarans()
    {
        return $this->hasMany(Pendaftaran::class);
    }
}
