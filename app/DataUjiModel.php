<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataUjiModel extends Model
{
    protected $table = 'data_uji';

    protected $fillable = ['id','id_transform', 'normalisasi'];
}
