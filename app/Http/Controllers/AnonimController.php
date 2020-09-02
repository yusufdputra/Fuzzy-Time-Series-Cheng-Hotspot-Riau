<?php

namespace App\Http\Controllers;

use App\DatasetModel;
use App\DataActualModel;
use App\KabupatenModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AnonimController extends Controller
{
    //login proses

    //
    public function index()
    {
        //ambil data kabupaten
        $kabupaten_row = KabupatenModel::all();

        return view('layout/index', ['kabupaten_row' => $kabupaten_row]);
    }

    // public function peramalan()
    // {
    //     return view('anonim/peramalan');
    // }


}
