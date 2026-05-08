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
        'kondisi',
        'stok',
        'gambar'
    ];

    // Relasi ke peminjaman (1 alat bisa banyak peminjaman)
    public function peminjams()
    {
        return $this->hasMany(Peminjam::class, 'alat_id', 'id_alat');
    }
}
?>