<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PeminjamResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id_peminjam' => $this->id_peminjam,
            'user' => [
                'id_user' => $this->user->id_user ?? null,
                'nama'    => $this->user->nama ?? null,
            ],
            'alat' => [
                'id_alat'   => $this->alat->id_alat ?? null,
                'nama_alat' => $this->alat->nama_alat ?? null,
            ],
            'tgl_pinjam'       => $this->tgl_pinjam,
            'tgl_pengembalian' => $this->tgl_pengembalian,
            'status'           => $this->status,
            'catatan_admin'    => $this->catatan_admin,
        ];
    }
}   