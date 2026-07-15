<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('peminjams', function (Blueprint $table) {
            $table->index('status');
            $table->index('tgl_pengembalian');
        });
    }

    public function down(): void
    {
        Schema::table('peminjams', function (Blueprint $table) {
            $table->dropIndex(['peminjams_status_index']);
            $table->dropIndex(['peminjams_tgl_pengembalian_index']);
        });
    }
};