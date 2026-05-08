<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('obat_rekam_medis', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->id();

            // FOREIGN KEY
            $table->unsignedBigInteger('rekam_medis_id');
            $table->unsignedBigInteger('obat_id');

            // DATA
            $table->integer('qty');
            $table->integer('harga');

            $table->timestamps();
        });

        // RELASI (dibuat setelah table jadi)
        Schema::table('obat_rekam_medis', function (Blueprint $table) {

            $table->foreign('rekam_medis_id')
                ->references('id')
                ->on('rekam_medis') // pastikan ini sesuai nama tabel kamu
                ->onDelete('cascade');

            $table->foreign('obat_id')
                ->references('id')
                ->on('obats') // ✅ karena kamu pakai plural
                ->onDelete('cascade');

        });
    }

    public function down()
    {
        Schema::dropIfExists('obat_rekam_medis');
    }
};