<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DataLatihMigration extends Migration
{
    public function up()
    {
        Schema::create('data_latih', function (Blueprint $table) {
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
        Schema::dropIfExists('data_latih');
    }
}
