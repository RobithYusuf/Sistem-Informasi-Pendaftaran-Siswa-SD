<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('informasi', function (Blueprint $table) {
            $table->id();
            $table->string('judul_informasi', 55);
            $table->text('detail');
            $table->text('tanggal');
            $table->date('tanggal_mulai')->nullable();  // Untuk periode pendaftaran (tanggal mulai)
            $table->date('tanggal_selesai')->nullable();  // Untuk periode pendaftaran (tanggal akhir)
            $table->date('tanggal_pengumuman')->nullable();
            $table->date('tanggal_daftar_ulang')->nullable();
            $table->timestamps();
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('informasi');
    }
};
