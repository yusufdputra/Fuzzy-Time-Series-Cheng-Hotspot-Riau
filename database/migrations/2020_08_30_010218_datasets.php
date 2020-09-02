<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Datasets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datasets', function (Blueprint $table) {
            $table->id();
            $table->string('lintang');
            $table->string('bujur');
            $table->date('tanggal');
            $table->time('jam');
            $table->integer('kepercayaan');
            $table->string('satelit');
            $table->string('kecamatan');
            $table->integer('id_kabupaten');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('datasets');
    }
}
