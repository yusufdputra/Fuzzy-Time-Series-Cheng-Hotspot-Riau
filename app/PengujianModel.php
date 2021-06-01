<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PengujianModel extends Model
{
    protected $table = 'hasil_uji';

    protected $fillable = ['id','id_kabupaten','jumlah_kejadian', 'fuzzifikasi', 'Peramalan', 'mape'];
}
