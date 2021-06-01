<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class HasilUjiMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hasil_uji', function (Blueprint $table) {
            $table->id();
            $table->integer('id_kabupaten');
            $table->text('waktu');
            $table->text('jumlah_kejadian');
            $table->text('fuzzifikasi');
            $table->text('Peramalan');
            $table->double('mape',22,10);
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
        Schema::dropIfExists('hasil_uji');
    }
}
