<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class alatlab extends Model
{
  protected $table = 'alatlabs';
    protected $primaryKey = 'id_alat';

    protected $fillable = [
        'nama_alat',
        'kategori',
        'stok',
        'kondisi',
        'gambar'
    ];
}
