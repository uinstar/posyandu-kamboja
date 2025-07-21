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
       Schema::create('ibu_hamil', function (Blueprint $table) {
        $table->id();
        $table->string('nama');
        $table->string('alamat');
        $table->date('tanggal_lahir');
        $table->string('no_telepon');
        $table->string('nama_suami')->nullable();
        $table->integer('usia_kandungan');
        $table->date('perkiraan_lahir');
        $table->string('status_kesehatan');
        $table->text('catatan_medis')->nullable();
        $table->timestamps();
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ibu_hamils');
    }
};
