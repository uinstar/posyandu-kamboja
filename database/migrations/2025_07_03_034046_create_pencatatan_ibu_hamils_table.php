<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pencatatan_ibu_hamils', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ibu_hamil_id')
                ->constrained('ibu_hamil')
                ->onDelete('cascade');

            $table->date('tanggal');
            $table->integer('usia_kehamilan'); // minggu
            $table->float('berat_badan');
            $table->float('tinggi_badan');
            $table->float('lingkar_lengan')->nullable();
            $table->string('tekanan_darah', 10)->nullable();
            $table->enum('tablet_tambah_darah', ['Ya', 'Tidak'])->nullable();
            $table->enum('kelas_ibu_hamil', ['Ya', 'Tidak'])->nullable();
            $table->text('gejala_sakit')->nullable();
            $table->text('saran')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pencatatan_ibu_hamils');
    }
};
