<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlatLab extends Model
{
    protected $table = 'alatlabs';
    protected $primaryKey = 'id_alat';

    protected $fillable = [
        'nama_alat',
        'kategori',
        'stok',
        'kondisi',
        'gambar',
    ];

    public function peminjaman()
    {
        return $this->hasMany(Peminjam::class, 'id_alat', 'id_alat');
    }
}