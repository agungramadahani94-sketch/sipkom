<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class peminjam extends Model
{
    protected $table = 'peminjams';

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'alat_id',
        'tgl_pinjam',
        'tgl_pengembalian',
    ];

    public function alat()
    {
        return $this->belongsTo(AlatLab::class, 'alat_id', 'id_alat');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
