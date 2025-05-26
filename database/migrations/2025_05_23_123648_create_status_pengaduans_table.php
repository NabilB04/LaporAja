<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('status_pengaduan', function (Blueprint $table) {
            $table->id('status_id');
            $table->string('nama_status');
        });
    }

    public function down()
    {
        Schema::dropIfExists('status_pengaduan');
    }
};
