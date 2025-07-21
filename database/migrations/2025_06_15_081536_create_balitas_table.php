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
        Schema::create('balita', function (Blueprint $table) {
        $table->id();
        $table->string('nama');
        $table->date('tanggal_lahir');
        $table->float('berat_badan');
        $table->float('tinggi_badan');
        $table->float('lila');
        $table->float('lk');
        $table->string('status_gizi');
        $table->json('imunisasi')->nullable();
        $table->json('riwayat_penimbangan')->nullable();
        $table->string('nama_orang_tua');
        $table->text('catatan_kesehatan')->nullable();
        $table->timestamps();
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('balitas');
    }
};
