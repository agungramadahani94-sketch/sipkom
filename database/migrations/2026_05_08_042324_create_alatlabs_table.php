<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('alatlabs', function (Blueprint $table) {
            $table->id('id_alat');
            $table->string('nama_alat');
            $table->string('kategori');
            $table->enum('kondisi', ['baik', 'rusak', 'diperbaiki'])->default('baik');
            $table->integer('stok');
            $table->string('gambar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alatlabs');
    }
};
