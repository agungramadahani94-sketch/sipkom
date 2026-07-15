<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    protected $table = 'pengembalians';

    protected $fillable = [
        'peminjam_id',
        'tanggal_kembali',
        'status',
    ];

    public function peminjam()
    {
        return $this->belongsTo(Peminjam::class, 'peminjam_id', 'id_peminjam');
    }
}