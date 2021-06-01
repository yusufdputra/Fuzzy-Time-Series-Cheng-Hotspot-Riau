<?php

namespace App\Http\Controllers;

use App\DataLatihModel;
use App\DatasetModel;
use App\DataTransformModel;
use Illuminate\Http\Request;

class PelatihanController extends Controller
{
    public function LatihAjax($id_kab)
    {
        //cek data latih di DB
        $q_latih = DataLatihModel::where('id_kabupaten', $id_kab)
            ->join('transformasi_data', 'data_latih.id_transform', '=', 'transformasi_data.id')
            ->first();

        if ($q_latih) {
            try {
                $data = get_dataLatih($id_kab);
                //conver ke dalam bentuk data yang dibutuhkan python
                $time = [];
                $normalisasi = [];
                foreach ($data as $v) {
                    $time[] = $v->bulan . "-" . $v->tahun;
                    $normalisasi[] = $v->normalisasi;
                }
                return cheng_py_latih($id_kab, $time, $normalisasi);
            } catch (\Throwable $th) {
                $msg = 'Data latih Kabupaten yang dipilih tidak tersedia. Silahkan lakukan pelatihan pada data terlebih dahulu!';
                return $msg;
            }
        } else {
            $msg = 'Data latih Kabupaten yang dipilih tidak tersedia. Silahkan lakukan pelatihan pada data terlebih dahulu!';
            return $msg;
        }
    }
}
