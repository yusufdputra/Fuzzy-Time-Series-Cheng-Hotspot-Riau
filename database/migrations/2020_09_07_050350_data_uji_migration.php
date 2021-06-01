<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DataUjiMigration extends Migration
{
    public function up()
    {
        Schema::create('data_uji', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_transform');
            $table->double('normalisasi',22,10);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_uji');
    }
}
