<?php
//get data set

use App\DataTransformModel;
use App\DatasetModel;
use Dotenv\Result\Result;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;


//ambil data set
function get_datasets($date)
{
  return DatasetModel::where('tanggal', 'like', '%' . $date . '%')
    ->join('kabupaten', 'datasets.id_kabupaten', '=', 'kabupaten.id')
    ->get();
}

//ambil data transformasi
function get_data_transformasi($date)
{
  return DataTransformModel::where('bulan', '=', date('m', strtotime($date)))
    ->where('tahun', '=', date('Y', strtotime($date)))
    ->join('kabupaten', 'transformasi_data.id_kabupaten', '=', 'kabupaten.id')
    ->get();
}

function get_data_set_peramalan($id, $start, $end)
{
  return DataTransformModel::where('id_kabupaten', '=', $id)
    ->whereBetween('tahun', [$start, $end])
    ->orderBy('tahun')
    ->orderBy('bulan')
    ->get();
}

function cheng_py_latih($time, $normalisasi)
{

  $normalisasi_ = json_encode($normalisasi);

  $py = shell_exec('C:\xampp\htdocs\fts_riau\app\cheng-latih.py 2>&1 "'.$normalisasi_.'"');

  $peramalan = json_decode($py);

 //return waktu, nilai aktual, nilai peramalan, nilai avg_mape
  return array($time, $normalisasi, $peramalan[0][0], $peramalan[0][1]);
}
