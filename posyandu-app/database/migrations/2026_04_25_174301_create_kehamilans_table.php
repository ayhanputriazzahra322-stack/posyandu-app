<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kehamilans', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->id();

            $table->unsignedBigInteger('ibu_id');
            $table->string('usia_kehamilan');
            $table->text('keterangan')->nullable();
            $table->date('tanggal');

            $table->timestamps();

            $table->foreign('ibu_id')
                ->references('id')
                ->on('ibus')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('kehamilans');
    }
};