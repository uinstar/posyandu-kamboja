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
        Schema::create('pendaftaran_peserta', function (Blueprint $table) {
        $table->id();
        $table->string('kategori'); // Balita / Ibu Hamil / Lansia
        $table->json('data_tambahan')->nullable(); // untuk menyimpan data dinamis tergantung kategori
        $table->string('status')->default('pending'); // pending / disetujui / ditolak
        $table->timestamps();
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftaran_pesertas');
    }
};
