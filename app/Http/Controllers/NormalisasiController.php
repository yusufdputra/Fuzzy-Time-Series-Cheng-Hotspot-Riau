<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTransformModel;

class NormalisasiController extends Controller
{
    public function normalisasi_ajax($id)
    {
        $datasets = get_data_set_peramalan($id);

        //lakukan normalisasi
        // Xn=(x0-xmin)/(xmax-xmin )
        // 
        // Keterangan:
        // Xn = nilai baru pada variable x
        // X0 = nilai lama pada variable x
        // Xmin = nilai minimum pada datasets
        // Xmax = nilai maksimum pada datasets

        $Xmin = DataTransformModel::where('id_kabupaten', '=', $id)
        ->min('jumlah_kejadian');

        $Xmax = DataTransformModel::where('id_kabupaten', '=', $id)
        ->max('jumlah_kejadian');

        foreach ($datasets as $key => $v) {

            $X0 = $v->jumlah_kejadian;
            $Xn = ($X0-$Xmin)/($Xmax-$Xmin);
            DataTransformModel::where('id', '=', $v->id)
                ->update([
                'normalisasi' => $Xn
                ])
            ;
           
        }
        $new_datasets = get_data_set_peramalan($id);

        return $new_datasets;
    }
}
