<?php

use App\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'AnonimController@index');

Route::get('forecasting/{kab}', 'DataController@forecasting');


// Route::get('pelatihan', 'AdminController@pelatihan');

// Route::get('pengujian', 'AdminController@pengujian');

// Route::get('/data', 'DataController@DataSelect');

// Route::get('normalisasi-latih', 'DataController@normalisasiDataLatih');

// Route::get('normalisasi-uji', 'DataController@normalisasiDataUji');

// Route::get('/peramalan', 'AnonimController@peramalan');

// Route::get('/register', 'AuthController@register');

// Route::get('/logout', 'AuthController@logout');

// //Route::get('kabupaten_selected/{id}', 'DataController@DataSetPeramalanAjax');


// Route::get('latihAjax/{id_kab}', 'PelatihanController@LatihAjax');

// Route::get('UjiAjax/{id_kab}', 'PengujianController@UjiAjax');

// Route::get('preprocessing_data/{date}', 'DataController@DataSetAjax');

// Route::get('data_aktual/{id_kab}', 'DataController@DataAktualAjax');

// Route::get('normalisasi_ajax/{id}/{start}/{end}/{jenis}', 'NormalisasiController@normalisasi_ajax');

// Route::get('normalisasi_data_ajax/{id}/{jenis}', 'DataController@normalisasi_data_ajax');

// Route::get('selected_date', 'DataController@DataSelect');

// Route::post('loginPost', 'AuthController@loginPost');

// Route::post('import', 'AdminController@import');

// Route::post('remove_data', 'DataController@remove_data');
