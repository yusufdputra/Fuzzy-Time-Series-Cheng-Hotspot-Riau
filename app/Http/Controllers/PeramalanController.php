<?php

namespace App\Http\Controllers;

use App\DatasetModel;
use Illuminate\Http\Request;

class PeramalanController extends Controller
{
    public function LatihAjax($id_kab, $start_time, $end_time)
    {
        //cek data tahun di DB
        $q_start = DatasetModel::where('tanggal', 'like', $start_time . '%')->first();
        $q_end = DatasetModel::where('tanggal', 'like', $end_time . '%')->first();

        if ($q_start && $q_end) {

            $data = get_data_set_peramalan($id_kab, $start_time, $end_time);
            //conver ke dalam bentuk data yang dibutuhkan python
            $time = [];
            $normalisasi = [];
            foreach ($data as $v) {
                $time[] = $v->bulan . "-" . $v->tahun;
                $normalisasi[] = $v->normalisasi;
            }


            return cheng_py_latih($time, $normalisasi);

        } else if ($q_start == null) {
            return "Data " . $start_time . " tidak tersedia";
        } else if ($q_end == null) {
            return "Data " . $end_time . " tidak tersedia";
        }
    }
}
