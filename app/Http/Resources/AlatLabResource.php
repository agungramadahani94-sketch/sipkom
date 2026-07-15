<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AlatLabResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id_alat'    => $this->id_alat,
            'nama_alat'  => $this->nama_alat,
            'kategori'   => $this->kategori,
            'kondisi'    => $this->kondisi,
            'stok'       => $this->stok,
            'gambar'     => $this->gambar ? asset('storage/' . $this->gambar) : null,
            'created_at' => $this->created_at,
        ];
    }
}   