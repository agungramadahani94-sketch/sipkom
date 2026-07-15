<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjam extends Model
{
    protected $table = 'peminjams';

    protected $primaryKey = 'id_peminjam';


    protected $fillable = [
        'id_user',
        'id_alat',
        'tgl_pinjam',
        'tgl_pengembalian',
        'status',
        'catatan_admin',
    ];

    public function alat()
    {
        return $this->belongsTo(AlatLab::class, 'id_alat', 'id_alat');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function peminjaman()
    {
        return $this->hasMany(Peminjam::class, 'id_alat', 'id_alat');
    }
}
