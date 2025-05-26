<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pengaduan', function (Blueprint $table) {
            $table->id('pengaduan_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('kategori_id');
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->unsignedBigInteger('status_id');
            $table->string('judul');
            $table->text('deskripsi');
            $table->string('lokasi');
            $table->string('foto_bukti')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('warga_id')->on('warga')->onDelete('cascade');
            $table->foreign('kategori_id')->references('kategori_id')->on('kategori');
            $table->foreign('admin_id')->references('admin_id')->on('admin')->onDelete('set null');
            $table->foreign('status_id')->references('status_id')->on('status_pengaduan');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pengaduan');
    }
};
