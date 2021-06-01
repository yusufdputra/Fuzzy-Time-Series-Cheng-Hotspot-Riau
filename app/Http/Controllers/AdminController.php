<?php

namespace App\Http\Controllers;

use App\KabupatenModel;
use App\DatasetModel;
use Illuminate\Support\Facades\Session;
use App\Imports\DataActualImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{


    public function pelatihan()
    {
        //ambil data kabupaten
        $kabupaten_row = KabupatenModel::all();

        return view('admin/pelatihan', ['kabupaten_row' => $kabupaten_row]);
    }

    public function pengujian()
    {
        //ambil data kabupaten
        $kabupaten_row = KabupatenModel::all();

        return view('admin/pengujian', ['kabupaten_row' => $kabupaten_row]);
    }

    public function import(Request $request)
    {

        //validasi format
        $this->validate($request, [
            'file' => 'required|mimes:xls,xlsx'
        ]);

        //get file excel
        $file = $request->file('file');

        //membuat nama file unik
        $nama_file = rand() . $file->getClientOriginalName();

        //upload ke folder file_data didalam folder public
        $file->move('file_data', $nama_file);

        //import data
        Excel::import(new DataActualImport, public_path('/file_data/' . $nama_file));

        //notifikasi dg session
        Session::flash('success', 'Data berhasil diimport!');

        //alihkan halaman kembali
        return redirect('/data');
    }
}
