<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('jurusan', function (Blueprint $table) {
            $table->id('id_jurusan');
            $table->string('nama_jurusan');
            $table->string('akreditasi');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('jurusan');
    }
};