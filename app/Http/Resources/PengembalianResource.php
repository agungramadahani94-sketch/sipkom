<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PengembalianResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'              => $this->id,
            'peminjam_id'     => $this->peminjam_id,
            'nama_peminjam'   => $this->peminjam->user->nama ?? null,
            'nama_alat'       => $this->peminjam->alat->nama_alat ?? null,
            'tanggal_kembali' => $this->tanggal_kembali,
            'status'          => $this->status,
        ];
    }
}