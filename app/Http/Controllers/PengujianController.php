<?php

namespace App\Http\Controllers;

use App\DataUjiModel;
use App\PelatihanModel;
use App\PengujianModel;
use Illuminate\Http\Request;

class PengujianController extends Controller
{
    public function UjiAjax($id_kab)
    {
        //cek data latih di DB
        // $q_uji = DataUjiModel::where('id_kabupaten', $id_kab)
        //     ->join('transformasi_data', 'data_uji.id_transform', '=', 'transformasi_data.id')
        //     ->first();;
        $data = get_dataUji($id_kab);
        if ($data) {
            try {
                //cek datalatih di DB
                //get data latih
                $data_latih = PelatihanModel::where('id_kabupaten', $id_kab)->get();
                if ($data_latih) {
                    //get datasets pengujian

                    //conver ke dalam bentuk data yang dibutuhkan python
                    $time = [];
                    $normalisasi = [];
                    $aktual = [];
                    
                    foreach ($data as $v) {
                        $time[] = $v->bulan . "-" . $v->tahun;
                        $normalisasi[] = $v->normalisasi;
                        $aktual[] = $v->jumlah_kejadian;
                    }
                    
                    $batas_atas = [];
                    $nilai_peramalan = [];
                    foreach ($data_latih as $key => $v) {
                        $batas_atas[] = unserialize($v->batas_atas);
                        $nilai_peramalan[] = unserialize($v->nilai_peramalan);
                      
                    }
                   

                    return cheng_py_uji($id_kab, $time, $normalisasi, $batas_atas, $nilai_peramalan, $aktual);
                } else {
                    $msg = 'Data latih Kabupaten yang dipilih tidak tersedia. Silahkan lakukan pelatihan pada data terlebih dahulu!';
                    return $data_latih;
                }
            } catch (\Throwable $th) {
                $msg = 'Data uji Kabupaten yang dipilih tidak tersedia. Silahkan lakukan normalisasi pada data terlebih dahulu!';
                return $msg;
            }
        } else {
            $msg = 'Data uji Kabupaten yang dipilih tidak tersedia. Silahkan lakukan normalisasi pada data terlebih dahulu!';
            return $msg;
        }
    }
}
