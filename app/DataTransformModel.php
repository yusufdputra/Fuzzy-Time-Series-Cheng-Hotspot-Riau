<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataTransformModel extends Model
{
    protected $table = 'transformasi_data';

    protected $fillable = ['bulan','tahun', 'id_kabupaten', 'jumlah_kejadian', 'normalisasi'];
}
