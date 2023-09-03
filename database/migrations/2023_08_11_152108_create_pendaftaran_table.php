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
        Schema::create('pendaftaran', function (Blueprint $table) {
            $table->id();
            $table->string('nik', 25)->unique();
            $table->string('nama', 50);
            $table->string('jenis_kelamin', 25);
            $table->string('agama', 50);
            $table->string('tempat_lahir', 50);
            $table->date('tanggal_lahir');
            $table->text('alamat');
            $table->integer('jumlah_saudara');
            $table->integer('anak_ke');
            $table->string('nama_wali', 50);
            $table->string('email', 55);
            $table->string('no_hp', 50);
            $table->string('pekerjaan_wali', 55)->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftaran');
    }
};
