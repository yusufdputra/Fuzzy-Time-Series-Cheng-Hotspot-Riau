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

Route::get('pelatihan', 'AdminController@pelatihan');


Route::get('/data', 'DataController@DataSelect');

Route::get('/normalisasi', 'DataController@normalisasiData');

Route::get('/peramalan', 'AnonimController@peramalan');

Route::get('/register', 'AuthController@register');

Route::get('/logout', 'AuthController@logout');

//Route::get('kabupaten_selected/{id}', 'DataController@DataSetPeramalanAjax');

Route::get('latihAjax/{id_kab}/{start}/{end}', 'PeramalanController@LatihAjax');

Route::get('preprocessing_data/{date}', 'DataController@DataSetAjax');

Route::get('normalisasi_ajax/{id}', 'NormalisasiController@normalisasi_ajax');

Route::get('normalisasi_data_ajax/{id}', 'DataController@normalisasi_data_ajax');

Route::get('selected_date', 'DataController@DataSelect');

Route::post('loginPost', 'AuthController@loginPost');

Route::post('import', 'AdminController@import');

Route::post('remove_data', 'DataController@remove_data');
