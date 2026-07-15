<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AlatLab;

class AlatLabSeeder extends Seeder
{
    public function run(): void
    {
        AlatLab::create(['nama_alat' => 'Keyboard Mechanical', 'kategori' => 'Input Device', 'kondisi' => 'baik', 'stok' => 20]);
        AlatLab::create(['nama_alat' => 'Mouse Logitech', 'kategori' => 'Input Device', 'kondisi' => 'baik', 'stok' => 30]);
        AlatLab::create(['nama_alat' => 'Monitor LG 24 Inch', 'kategori' => 'Output Device', 'kondisi' => 'baik', 'stok' => 15]);
        AlatLab::create(['nama_alat' => 'CPU Intel Core i5', 'kategori' => 'Processing Device', 'kondisi' => 'baik', 'stok' => 10]);
        AlatLab::create(['nama_alat' => 'Printer Epson L3210', 'kategori' => 'Output Device', 'kondisi' => 'baik', 'stok' => 5]);
        AlatLab::create(['nama_alat' => 'Scanner Canon LiDE 300', 'kategori' => 'Input Device', 'kondisi' => 'baik', 'stok' => 3]);
        AlatLab::create(['nama_alat' => 'Proyektor Epson X05', 'kategori' => 'Output Device', 'kondisi' => 'diperbaiki', 'stok' => 2]);
        AlatLab::create(['nama_alat' => 'Webcam Logitech C270', 'kategori' => 'Input Device', 'kondisi' => 'baik', 'stok' => 15]);
        AlatLab::create(['nama_alat' => 'Headset Gaming Fantech', 'kategori' => 'Input Device', 'kondisi' => 'baik', 'stok' => 4]);
        AlatLab::create(['nama_alat' => 'Switch Hub 24 Port', 'kategori' => 'Network Device', 'kondisi' => 'baik', 'stok' => 6]);
    }
}
