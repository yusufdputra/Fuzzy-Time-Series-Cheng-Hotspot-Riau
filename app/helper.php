<?php
//get data set

use App\data_sets;
use App\DataLatihModel;
use App\DataUjiModel;
use App\DataTransformModel;
use App\PelatihanModel;
use App\PengujianModel;
use App\DatasetModel;
use Dotenv\Result\Result;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;


//ambil data set

function get_datasets_kab($kab)
{
  return data_sets::where('kabupaten', $kab)
    ->get();
}


// function get_datasets($date)
// {
//   return DatasetModel::where('tanggal', 'like', '%' . $date . '%')
//     ->join('kabupaten', 'datasets.id_kabupaten', '=', 'kabupaten.id')
//     ->get();
// }

// //ambil data transformasi
// function get_data_transformasi($date)
// {
//   return DataTransformModel::where('bulan', '=', date('m', strtotime($date)))
//     ->where('tahun', '=', date('Y', strtotime($date)))
//     ->join('kabupaten', 'transformasi_data.id_kabupaten', '=', 'kabupaten.id')
//     ->get();
// }

// //get dataset by id kab
// function get_dataset_byID($id)
// {
//   return DataTransformModel::where('id_kabupaten', '=', $id)
//     ->orderBy('tahun')
//     ->orderBy('bulan')
//     ->get();
// }

// //get dataset by id kab and jenis
// function get_dataLatih($id_kab)
// {
//   return DataLatihModel::where('id_kabupaten', '=', $id_kab)
//     ->join('transformasi_data', 'data_latih.id_transform', '=', 'transformasi_data.id')
//     ->orderBy('tahun')
//     ->orderBy('bulan')
//     ->get();
// }

// function get_dataUji($id_kab)
// {
//   return DataUjiModel::where('id_kabupaten', '=', $id_kab)
//     ->join('transformasi_data', 'data_uji.id_transform', '=', 'transformasi_data.id')
//     ->orderBy('tahun')
//     ->orderBy('bulan')
//     ->get();
// }


// function get_data_set_peramalan($id, $start, $end)
// {
//   return DataTransformModel::where('id_kabupaten', '=', $id)
//     ->whereBetween('tahun', [$start, $end])
//     ->orderBy('tahun')
//     ->orderBy('bulan')
//     ->get();
// }

// function cheng_py_latih($id_kab, $time, $normalisasi)
// {

//   $normalisasi_ = json_encode($normalisasi);

//   //call py
//   $py = shell_exec('C:\xampp\htdocs\fts_riau\app\cheng-latih.py 2>&1 "' . $normalisasi_ . '"');

//   $peramalan = json_decode($py);

//   //simpan ke database untuk data uji
//   // semua batas atas & nilai peramalan
//   $get_batas_atas = $peramalan->new_nilai_batas_kelas->batas_atas;
//   $get_nilai_peramalan = $peramalan->defuzzifikasi;
//   $get_linguistik = $peramalan->nilai_linguistik;

//   // cek dari db
//   $get_latih = PelatihanModel::where('id_kabupaten', $id_kab)->first();
//   if ($get_latih) { // update jika ada record sebulumnya
//     PelatihanModel::where('id_kabupaten', $id_kab)
//       ->update([
//         'batas_atas' => serialize($get_batas_atas),
//         'nilai_peramalan' => serialize($get_nilai_peramalan),
//         'linguistik' => serialize($get_linguistik)
//       ]);
//   } else { // insert new record
//     PelatihanModel::insert([
//       'id_kabupaten' => $id_kab,
//       'batas_atas' => serialize($get_batas_atas),
//       'nilai_peramalan' => serialize($get_nilai_peramalan),
//       'linguistik' => serialize($get_linguistik)
//     ]);
//   }

//   //return 
//   //  1. waktu, 
//   //  2. nilai aktual, 
//   //  3. nilai peramalan, 
//   //  4. nilai konstanta, 
//   //  5. nilai batas kelas, 
//   //  6. nilai batas kelas setelah dibagi
//   return array($time, $normalisasi, $peramalan);
// }

// function cheng_py_uji($id_kab, $time, $normalisasi,  $batas_atas, $nilai_peramalan, $nilai_aktual)
// {

//   $normalisasi_ = json_encode($normalisasi);
//   $batas_atas_ = json_encode($batas_atas);
//   $nilai_peramalan_ = json_encode($nilai_peramalan);
 

//   //call py
//   $py = shell_exec('C:\xampp\htdocs\fts_riau\app\cheng-uji.py 2>&1 "' . $normalisasi_ . '" "' . $batas_atas_ . '" "' . $nilai_peramalan_ . '"');

//   $peramalan = json_decode($py);

//   //simpan ke database untuk data uji
//   // semua batas atas & nilai peramalan
//   $get_waktu = $time;
//   $get_kejadian = $normalisasi;
//   $get_peramalan = $peramalan->prediksi;
//   $get_fuzzifikasi = $peramalan->fuzzifikasi;
//   $get_mape = $peramalan->mape;


//   // cek dari db
//   $get_uji = PengujianModel::where('id_kabupaten', $id_kab)->first();
//   if ($get_uji) { // update jika ada record sebulumnya
//     PengujianModel::where('id_kabupaten', $id_kab)
//       ->update([
//         'waktu' => serialize($get_waktu),
//         'nilai_aktual' => serialize($nilai_aktual),
//         'jumlah_kejadian' => serialize($get_kejadian),
//         'fuzzifikasi' => serialize($get_fuzzifikasi),
//         'Peramalan' => serialize($get_peramalan),
//         'mape' => $get_mape
//       ]);
//   } else { // insert new record
//     PengujianModel::insert([
//       'id_kabupaten' => $id_kab,
//       'waktu' => serialize($get_waktu),
//       'jumlah_kejadian' => serialize($get_kejadian),
//       'fuzzifikasi' => serialize($get_fuzzifikasi),
//       'Peramalan' => serialize($get_peramalan),
//       'mape' => $get_mape
//     ]);
//   }

//   //return 
//   //  1. waktu, 
//   //  2. nilai aktual, 
//   //  3. nilai peramalan, 
//   //  4. nilai konstanta, 
//   //  5. nilai batas kelas, 
//   //  6. nilai batas kelas setelah dibagi
//   return array($batas_atas);
// }

function cheng_py($kab_select)
{

  //call py
  $py = shell_exec('C:\xampp\htdocs\fts_riau\app\cheng-forcas.py 2>&1 "' . $kab_select . '"');

  $peramalan = json_decode($py);

  return array($peramalan);
}
