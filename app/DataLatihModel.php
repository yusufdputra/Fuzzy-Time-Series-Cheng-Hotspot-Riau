<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataLatihModel extends Model
{
    protected $table = 'data_latih';

    protected $fillable = ['id','id_transform','normalisasi'];
}
