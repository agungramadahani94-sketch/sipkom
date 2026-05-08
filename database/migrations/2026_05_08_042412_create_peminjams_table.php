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
        Schema::create('peminjams', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('alat_id');
            $table->date('tgl_pinjam');
            $table->date('tgl_pengembalian')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id_user')->on('users');
            $table->foreign('alat_id')->references('id_alat')->on('alatlabs');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjams');
    }
};
