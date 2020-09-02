<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DatasetModel extends Model
{
    protected $table = 'datasets';

    protected $fillable = ['bujur','lintang','tanggal', 'jam','kepercayaan','satelit','kecamatan', 'id_kabupaten'];
   
}
