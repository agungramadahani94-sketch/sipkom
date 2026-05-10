<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pengembalian extends Model
{
    protected $table = 'pengembalians';
    protected $fillable = [
        'id_peminjaman',
        'tanggal_pengembalian',
        'denda',
    ];

    public function peminjaman()
    {
        return $this->belongsTo(peminjamans::class, 'id_peminjaman');
    }
}
