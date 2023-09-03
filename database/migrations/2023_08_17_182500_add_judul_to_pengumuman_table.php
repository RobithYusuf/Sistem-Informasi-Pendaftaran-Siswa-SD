<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddJudulToPengumumanTable extends Migration
{
    public function up()
    {
        Schema::table('pengumuman', function (Blueprint $table) {
            $table->string('judul_pengumuman')->nullable();
        });
    }

    public function down()
    {
        Schema::table('pengumuman', function (Blueprint $table) {
            $table->dropColumn('judul_pengumuman');
        });
    }
};
