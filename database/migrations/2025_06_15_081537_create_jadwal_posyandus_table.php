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
            Schema::create('jadwal_posyandu', function (Blueprint $table) {
        $table->id();
        $table->date('tanggal');
        $table->string('hari');
        $table->time('waktu');
        $table->string('lokasi');
        $table->string('jenis_kegiatan');
        $table->timestamps();
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_posyandus');
    }
};
