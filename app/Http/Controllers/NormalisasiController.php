<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTransformModel;
use App\DataLatihModel;
use App\DataUjiModel;
use App\DatasetModel;

class NormalisasiController extends Controller
{
    public function normalisasi_ajax($id, $start_time, $end_time, $jenis)
    {
        //cek data tahun di DB
        $q_start = DatasetModel::where('tanggal', 'like', $start_time . '%')->first();
        $q_end = DatasetModel::where('tanggal', 'like', $end_time . '%')->first();

        if ($q_start && $q_end) {
            $datasets = get_data_set_peramalan($id, $start_time, $end_time);
            if ($jenis == 'Latih') {
                DataLatihModel::where('id_kabupaten', $id)
                    ->join('transformasi_data', 'data_latih.id_transform', '=', 'transformasi_data.id')
                    ->delete();
            } else {
                DataUjiModel::where('id_kabupaten', $id)
                    ->join('transformasi_data', 'data_uji.id_transform', '=', 'transformasi_data.id')
                    ->delete();
            }
            //lakukan normalisasi
            // Xn=(x0-xmin)/(xmax-xmin )
            // Keterangan:
            // Xn = nilai baru pada variable x
            // X0 = nilai lama pada variable x
            // Xmin = nilai minimum pada datasets
            // Xmax = nilai maksimum pada datasets
            $Xmin = DataTransformModel::where('id_kabupaten', '=', $id)
                ->whereBetween('tahun', [$start_time, $end_time])
                ->min('jumlah_kejadian');

            $Xmax = DataTransformModel::where('id_kabupaten', '=', $id)
                ->whereBetween('tahun', [$start_time, $end_time])
                ->max('jumlah_kejadian');

            foreach ($datasets as $key => $v) {
                $X0 = $v->jumlah_kejadian;
                // $Xn = ($X0 - $Xmin) / ($Xmax - $Xmin);
                
                if ($jenis == 'Latih') {
                    $Xn = log10(1+$X0);
                    DataLatihModel::insert([
                        'id_transform' => $v->id,
                        'normalisasi' => $Xn
                    ]);
                }else{
                    $Xn = log10(2+$X0);
                    DataUjiModel::insert([
                        'id_transform' => $v->id,
                        'normalisasi' => $Xn
                    ]);
                }
                
            }
            if ($jenis == 'Latih') {
                $new_datasets = get_dataLatih($id);
            }else{
                $new_datasets = get_dataUji($id);
            }
             
            // $new_datasets = get_data_set_peramalan($id, $start_time, $end_time);

            return $new_datasets;
        } else if ($q_start == null) {
            return "Data " . $start_time . " tidak tersedia";
        } else if ($q_end == null) {
            return "Data " . $end_time . " tidak tersedia";
        }
    }
}
