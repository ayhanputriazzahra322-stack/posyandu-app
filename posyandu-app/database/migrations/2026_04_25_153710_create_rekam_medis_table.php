<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('rekam_medis', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->id();

            $table->unsignedBigInteger('pasien_id');
            $table->unsignedBigInteger('dokter_id');

            $table->text('keluhan')->nullable();
            $table->text('diagnosa')->nullable();
            $table->text('tindakan')->nullable();

            $table->date('tanggal')->nullable();

            // 🔥 TAMBAHAN WAJIB (biar riwayat obat jalan)
            $table->unsignedBigInteger('obat_id')->nullable();
            $table->integer('qty')->nullable();
            $table->integer('harga')->nullable();
            $table->integer('total')->nullable();
            $table->string('metode')->nullable();

            $table->timestamps();

            // FOREIGN KEY
            $table->foreign('pasien_id')
                ->references('id')
                ->on('pasiens')
                ->onDelete('cascade');

            $table->foreign('dokter_id')
                ->references('id')
                ->on('dokters')
                ->onDelete('cascade');

            $table->foreign('obat_id')
                ->references('id')
                ->on('obats')
                ->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('rekam_medis');
    }
};