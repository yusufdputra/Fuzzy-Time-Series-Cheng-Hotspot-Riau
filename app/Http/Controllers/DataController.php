<?php

namespace App\Http\Controllers;

use App\DataTransformModel;
use App\DatasetModel;
use App\KabupatenModel;
use DataSet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Kabupaten;

class DataController extends Controller
{


    public function forecasting($kab_select)
    {
        
        try {
           
            return cheng_py($kab_select);

        } catch (\Throwable $th) {
            $msg = 'Data Kabupaten yang dipilih tidak tersedia! ';
            return $msg;
        }
    }



    // public function DataSelect(Request $date)
    // {
    //     if ($date->selected_date == null) {

    //         //ambil dataset
    //         $datasets = get_datasets($date);

    //         //ambil data transformasi
    //         $data_transform = get_data_transformasi($date);
    //     } else {

    //         //ambil dataset
    //         $datasets = get_datasets($date->selected_date);

    //         //ambil data transformasi
    //         $data_transform = get_data_transformasi($date->selected_date);
    //     }
    //     if (Session::get('status_login') == 0) { // jika bukan admin
    //         return view('anonim/dataset', ['datasets' => $datasets, 'date_select' => $date, 'data_transform' => $data_transform]);
    //     } else { // jika admin

    //         return view('admin/dataset', ['datasets' => $datasets, 'date_select' => $date, 'data_transform' => $data_transform]);
    //     }
    // }

    // public function DataAktualAjax($id_kab)
    // {
    //     $data_aktual = [];
    //     $data = DataTransformModel::select('bulan', 'tahun', 'jumlah_kejadian')
    //         ->where('id_kabupaten', $id_kab)
    //         ->orderBy('tahun')
    //         ->orderBy('bulan')
    //         ->get();
    //     foreach ($data as $key => $v) {
    //         $data_aktual[0][$key] = $v->bulan . '-' . $v->tahun;
    //         $data_aktual[1][$key] = $v->jumlah_kejadian;
    //     }

    //     return $data_aktual;
    // }

    // public function DataSetAjax($date)
    // {
    //     //ambil dataset
    //     $cek_data = DatasetModel::where('tanggal', 'like', '%' . $date . '%')->first();
    //     if ($cek_data == null) {
    //         //toastr()->error('Data tidak ditemukan');
    //     } else {
    //         try {
    //             //get bulan
    //             $bulan = date('m', strtotime($date));
    //             //get tahun
    //             $tahun = date('Y', strtotime($date));
    //             //jika ada data set yang lama, maka hapus dulu seluruh data berdasarkan waktu. karena data akan di set ulang
    //             $set_already = DataTransformModel::where('bulan', '=', $bulan)
    //                 ->where('tahun', '=', $tahun)
    //                 ->get();
    //             if ($set_already) {
    //                 DataTransformModel::where('bulan', '=', $bulan)
    //                     ->where('tahun', '=', $tahun)
    //                     ->delete();
    //             }
    //             //ambil dataset dan hitung jumlah kejadian
    //             //DATE_FORMAT(tanggal, '%Y-%m') tanggal,
    //             $datasets = DatasetModel::selectRaw("COUNT(id) jumlah_kejadian, id_kabupaten")
    //                 ->where('tanggal', 'like', '%' . $date . '%')
    //                 ->groupBy('id_kabupaten')
    //                 ->get();

    //             $id_recorded = [];
    //             //simpan ke dataset
    //             foreach ($datasets as $key => $v) {
    //                 $id_recorded[$key] = $v->id_kabupaten;

    //                 DataTransformModel::insert([
    //                     'bulan' => $bulan,
    //                     'tahun' => $tahun,
    //                     'id_kabupaten' => $v->id_kabupaten,
    //                     'jumlah_kejadian' => $v->jumlah_kejadian,
    //                     'created_at' => now(),
    //                     'updated_at' => now()
    //                 ]);
    //             }

    //             //jika pada periode tertentu data kabupaten tidak ada kejadian titik api
    //             //maka jumlah kejadian bernilai set 0

    //             $no_record = KabupatenModel::select('id')
    //                 ->whereNotIn('id', $id_recorded)
    //                 ->get();

    //             //simpan ke dataset bernilai 0
    //             foreach ($no_record as $key => $v) {

    //                 DataTransformModel::insert([
    //                     'bulan' => $bulan,
    //                     'tahun' => $tahun,
    //                     'id_kabupaten' => $v->id,
    //                     'jumlah_kejadian' => 0,
    //                     'created_at' => now(),
    //                     'updated_at' => now()
    //                 ]);
    //             }
    //             //get data transform
    //             $data_transform = DataTransformModel::select('*')
    //                 ->where('bulan', '=', $bulan)
    //                 ->where('tahun', '=', $tahun)
    //                 ->join('kabupaten', 'transformasi_data.id_kabupaten', '=', 'kabupaten.id')
    //                 ->get();

    //             return $data_transform;
    //         } catch (\Throwable $th) {
    //         }
    //     }
    // }

    // public function normalisasiDataLatih()
    // {
    //     //ambil data kabupaten
    //     $kabupaten_row = KabupatenModel::all();
    //     if (Session::get('status_login') == 0) { // jika bukan admin
    //         return view('/',);
    //     } else { // jika admin
    //         return view('admin/normalisasi', ['datasets' => null, 'kabupaten_row' => $kabupaten_row, 'jenis' => 'Latih']);
    //     }
    // }

    // public function normalisasiDataUji()
    // {
    //     //ambil data kabupaten
    //     $kabupaten_row = KabupatenModel::all();
    //     if (Session::get('status_login') == 0) { // jika bukan admin
    //         return view('/',);
    //     } else { // jika admin
    //         return view('admin/normalisasi', ['datasets' => null, 'kabupaten_row' => $kabupaten_row, 'jenis' => 'Uji']);
    //     }
    // }

    // public function normalisasi_data_ajax($id, $jenis)
    // {
    //     if ($jenis == 'Latih') {
    //         $datasets = get_dataLatih($id);
    //     } else {
    //         $datasets = get_dataUji($id);
    //     }
    //     return $datasets;
    // }

    // public function remove_data(Request $request)
    // {
    //     $date = $request->selected_date_remove;
    //     try {
    //         $query = DatasetModel::where('tanggal', 'like', '%' . $date . '%')->delete();

    //         //notifikasi dg session
    //         if ($query) {
    //             Session::flash('success', 'Data berhasil dihapus!');
    //         } else {
    //             Session::flash('error', 'Data Gagal dihapus!');
    //         }
    //     } catch (\Throwable $th) {
    //         //throw $th;
    //     }
    //     $datasets = get_datasets($date);

    //     $data_transform = get_data_transformasi($date);
    //     return view('admin/dataset', ['datasets' => $datasets, 'date_select' => $request, 'data_transform' => $data_transform]);
    // }

    // public function DataSetPeramalanAjax($id)
    // {
    //     if ($id == 0) {
    //         $data_set = DatasetModel::all();
    //     }else {
    //         $data_set = get_data_set_peramalan($id);
    //     }
    //     return $data_set;
    // }
}
