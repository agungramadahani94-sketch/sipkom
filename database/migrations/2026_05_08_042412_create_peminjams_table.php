<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('peminjams', function (Blueprint $table) {
            $table->id('id_peminjam');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_alat');
            $table->date('tgl_pinjam');
            $table->date('tgl_pengembalian')->nullable();
            $table->enum('status', ['menunggu', 'dipinjam', 'ditolak', 'kembali'])->default('menunggu');
            $table->text('catatan_admin')->nullable(); 
            $table->timestamps();

            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
            $table->foreign('id_alat')->references('id_alat')->on('alatlabs')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peminjams');
    }
};