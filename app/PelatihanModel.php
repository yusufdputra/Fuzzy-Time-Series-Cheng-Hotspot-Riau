<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PelatihanModel extends Model
{
    protected $table = 'hasil_latih';

    protected $fillable = ['id','id_kabupaten','batas_atas', 'nilai_peramalan', 'linguistik'];
}
