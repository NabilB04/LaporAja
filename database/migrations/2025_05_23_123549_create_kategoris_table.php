<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kategori', function (Blueprint $table) {
            $table->id('kategori_id');
            $table->string('nama_kategori');
        });
    }

    public function down()
    {
        Schema::dropIfExists('kategori');
    }
};

