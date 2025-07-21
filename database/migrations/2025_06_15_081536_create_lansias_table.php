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
        Schema::create('lansia', function (Blueprint $table) {
        $table->id();
        $table->string('nama');
        $table->string('nik')->unique();
        $table->string('jenis_kelamin');
        $table->integer('usia');
        $table->string('alamat');
        $table->float('gula_darah_terakhir');
        $table->json('riwayat_gula_darah')->nullable();
        $table->string('status_kesehatan');
        $table->text('catatan_kebutuhan')->nullable();
        $table->timestamps();
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lansias');
    }
};
