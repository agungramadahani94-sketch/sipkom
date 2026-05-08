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
        Schema::create('pengembalians', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_peminjams');
            $table->date('tgl_pengembalian');
            $table->integer('denda')->default(0);
            $table->string('status')->default('belum dikembalikan, sedang dipinjam, sudah dikembalikan');
            $table->timestamps();

            // Relasi
            $table->foreign('id_peminjams')->references('id')->on('peminjams')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengembalians');
    }
};
