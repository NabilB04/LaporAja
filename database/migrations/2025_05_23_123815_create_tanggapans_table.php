<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tanggapan', function (Blueprint $table) {
            $table->id('tanggapan_id');
            $table->unsignedBigInteger('pengaduan_id');
            $table->unsignedBigInteger('admin_id');
            $table->text('isi_tanggapan');
            $table->string('foto_tanggapan')->nullable();
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('pengaduan_id')->references('pengaduan_id')->on('pengaduan')->onDelete('cascade');
            $table->foreign('admin_id')->references('admin_id')->on('admin')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tanggapan');
    }
};
