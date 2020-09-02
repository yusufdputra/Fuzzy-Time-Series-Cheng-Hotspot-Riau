<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TransformasiData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transformasi_data', function (Blueprint $table) {
            $table->id();
          
            $table->string('bulan');
            $table->year('tahun');
            $table->integer('id_kabupaten');
            $table->integer('jumlah_kejadian');
            $table->double('normalisasi',22,10);
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
        Schema::dropIfExists('transformasi_data');
    }
}
