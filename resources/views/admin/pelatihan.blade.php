@extends('layout/master')

@section('title', 'Dashboard')

@section('container')
<div class="container-fluid">

  <!-- Page-Title -->
  <div class="row">
    <div class="col-sm-12">
      <h4 class="page-title">Pelatihan Metode <i>Fuzzy Time Series Cheng</i> Titik Api Provinsi Riau</h4>
    </div>
  </div>

  <!-- end page title end breadcrumb -->

  <div class="card-box">
    <div class="row">
      <div class="col-lg-12">
        <form class="form-inline" role="form" id="formLatih">

          <div class="form-row align-items-center ">

            <div class="col-auto mb-1">
              <div class="input-group row">
                <div class="col-sm-12">
                  <div class="input-group">
                    <select id="selected_kabupaten_latih" required class="form-control">
                      <option disabled selected>Pilih Kabupaten</option>
                      @foreach ($kabupaten_row AS $kr)
                      <option value="{{$kr->id}}">{{$kr->kabupaten}}</option>
                      @endforeach
                    </select>
                  </div><!-- input-group -->
                </div>
              </div>
            </div>



            <div class="col-auto">

              <a href="#" onclick="do_latih()" class="btn btn-success waves-effect waves-light">Latih</a>
            </div>
            <!-- <div class="col-auto ajax-loader">
              <img id="" src="adminto/images/ajax-loader.gif" style="width: 15%;" alt="loading">
            </div> -->
            <!-- loading -->
            <!-- <div id="loader" class="position-absolute" style="z-index: 99; width: 100%;">
              <div class="d-flex justify-content-center">
                <img src="adminto/images/ajax-loader.gif" alt="loading">
              </div>
            </div> -->

          </div>
        </form>

      </div>


      <div class="col-lg-12">
        <!-- notifikasi form validasi -->
        @if ($errors->has('file'))
        <div class="alert alert-danger">
          <div>{{$errors->first('file')}}</div>
        </div>
        @endif


        @if ($success = Session::get('success'))
        <div class="alert alert-success">
          <div>{{$success}}</div>
        </div>
        @endif

        @if ($error = Session::get('error'))
        <div class="alert alert-danger">
          <div>{{$error}}</div>
        </div>
        @endif
      </div>


      <div class="col-12">

        <div class="row">

          <div class="col-xl-12 mt-md-3">

            <ul class="nav nav-tabs nav-justified">
              <li class="nav-item">
                <a href="#datasets" data-toggle="tab" aria-expanded="false" class="nav-link active">
                  Datasets
                </a>
              </li>
              <li class="nav-item">
                <a href="#semesta" data-toggle="tab" aria-expanded="true" class="nav-link">
                  Himpunan Semesta
                </a>
              </li>
              <li class="nav-item">
                <a href="#fuzzy" data-toggle="tab" aria-expanded="false" class="nav-link">
                  Himpunan Fuzzy
                </a>
              </li>
              <li class="nav-item">
                <a href="#fuzzifikasi" data-toggle="tab" aria-expanded="false" class="nav-link">
                  Fuzzifikasi
                </a>
              </li>
              <li class="nav-item">
                <a href="#fl" data-toggle="tab" aria-expanded="false" class="nav-link">
                  <i>Fuzzy Relationship</i>
                </a>
              </li>
              <li class="nav-item">
                <a href="#pembobotan" data-toggle="tab" aria-expanded="false" class="nav-link">
                  Pembobotan
                </a>
              </li>
              <li class="nav-item">
                <a href="#defuzzifikasi" data-toggle="tab" aria-expanded="false" class="nav-link">
                  Defuzzifikasi
                </a>
              </li>
              <li class="nav-item">
                <a href="#peramalan" data-toggle="tab" aria-expanded="false" class="nav-link">
                  Peramalan
                </a>
              </li>

            </ul>



            <div class="tab-content">
              <div role="tabpanel" class="tab-pane fade show active" id="datasets">
                <div class="table-responsive">


                  <table class="text-center table table-bordered table-bordered dt-responsive nowrap" cellspacing="0" width="100%">

                    <thead>
                      <tr>
                        <th>No.</th>
                        <th>Waktu</th>
                        <th>Jumlah Kejadian (Normalisasi)</th>
                      </tr>
                    </thead>


                    <tbody id="dataset_row">
                      <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>

                    </tbody>

                  </table>
                </div>
              </div>

              <div role="tabpanel" class="tab-pane fade show " id="semesta">
                <div class="row ml-3">
                  <div class="col-sm-12 ">
                    <div class="timeline">

                      <article class="timeline-item " style="display: block !important;">
                        <div class="timeline-desk">
                          <div class="panel">

                            <div class="panel-body">

                              <h4 class="text-danger"><i>Universe of discourse</i> (U) </h4>
                              <p class="timeline-date text-muted"><small>Menghitung nilai U dengan mencari nilai minimum dan maksimum dari datasets </small></p>
                              <p id="nilai_u">U = [0 , 0]</p>
                            </div>
                          </div>
                        </div>
                      </article>
                      <article class="timeline-item " style="display: block !important;">
                        <div class="timeline-desk">
                          <div class="panel">
                            <div class="panel-body">

                              <h4 class="text-success">Distribusi Himpunan Semesta</h4>
                              <ol class="text-muted">
                                <li>Rentang <i>(Range)</i></li>
                                <p id="nilai_R">R = 0</p>

                                <li>Banyak Interval Kelas</li>
                                <p id="nilai_K">K = 0</p>

                                <li>Lebar Interval</li>
                                <p id="nilai_I">I = 0</p>

                                <li>Nilai Batas Kelas</li>
                                <div class=" table-responsive">
                                  <table class=" text-center table table-bordered table-bordered dt-responsive nowrap" cellspacing="0" width="100%" style="color:black !important">
                                    <thead>
                                      <tr>
                                        <th></th>
                                        <th>Batas Bawah</th>
                                        <th>Batas Atas</th>
                                        <th>Nilai Tengah (m<sub>i</sub>)</th>
                                        <th>Frekuensi Kejadian</th>
                                      </tr>
                                    </thead>
                                    <tbody id="tabel_nilai_batas_kelas1">

                                      <tr>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                      </tr>

                                    </tbody>
                                  </table>
                                </div>
                              </ol>


                            </div>
                          </div>
                        </div>
                      </article>

                      <article class="timeline-item " style="display: block !important;">
                        <div class="timeline-desk">
                          <div class="panel">
                            <div class="panel-body">

                              <h4 class="text-primary">Membagi Himpunan Semesta</h4>
                              <p class="timeline-date text-muted"><small>Pembagian himpunan yang memiliki frekuensi tinggi menjadi 2 interval dengan lebar interval yang sama, sehingga diperoleh interval yang lebih kecil. </small></p>
                              <div class=" table-responsive">
                                <table class="text-center table table-bordered table-bordered dt-responsive nowrap" cellspacing="0" width="100%" style="color:black !important">
                                  <thead>
                                    <tr>
                                      <th></th>
                                      <th>Batas Bawah</th>
                                      <th>Batas Atas</th>
                                      <th>Nilai Tengah (m<sub>i</sub>)</th>

                                    </tr>
                                  </thead>
                                  <tbody id="tabel_nilai_batas_kelas2">

                                    <tr>
                                      <td>-</td>
                                      <td>-</td>
                                      <td>-</td>
                                      <td>-</td>

                                    </tr>

                                  </tbody>
                                </table>
                              </div>



                            </div>
                          </div>
                        </div>
                      </article>


                    </div>
                  </div>
                </div>
              </div>

              <div role="tabpanel" class="tab-pane fade show " id="fuzzy">
                <div class="row ">
                  <div class="col-lg-7 ">
                    <div>
                      <div class="timeline">
                        <article class="timeline-item " style="display: block !important;">
                          <div class="timeline-desk">
                            <div class="panel">
                              <div class="panel-body">
                                <h4 class="text-danger">Mendefinisikan Himpunan Fuzzy</h4>
                                <p>&nbsp</p>
                                <div class="row">
                                  <div class="col-12">
                                    <div class="row" id="hori-matriks_h_fuzzy">
                                      <div class="row col-auto">
                                        <div class="col-auto ">
                                          <div class="input-group-prepend mb-2">
                                            <div class="input-group-text page-link" style=" width:45px !important">&nbsp</div>
                                          </div>
                                        </div>
                                        <div class="col-auto ">
                                          <div class="input-group-prepend mb-2">
                                            <div class="input-group-text page-link" style=" width:45px !important">A1</div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-auto mr-2">
                                    <div id="verti-matriks_h_fuzzy">
                                      <div class="row">
                                        <div class="col-auto ">
                                          <div class="input-group-prepend mb-2">
                                            <div class="input-group-text page-link" style=" width:45px !important">A1</div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-auto">
                                    <div id="matriks_h_fuzzy">

                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                        </article>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-5 ">
                    <div>
                      <div class="timeline">
                        <article class="timeline-item " style="display: block !important;">
                          <div class="timeline-desk">
                            <div class="panel">
                              <div class="panel-body">
                                <h4 class="text-success">Nilai Linguistik Himpunan Fuzzy</h4>
                                <p>&nbsp</p>
                                <div class="table-responsive">
                                  <table class="text-center table table-bordered table-bordered dt-responsive nowrap" cellspacing="0" width="100%">

                                    <thead>
                                      <tr>
                                        <th>Fuzzifikasi</th>
                                        <th>Nilai Linguistik</th>
                                      </tr>
                                    </thead>
                                    <tbody id="tabel_linguistik">
                                      <tr>
                                        <td>-</td>
                                        <td>-</td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                        </article>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div role="tabpanel" class="tab-pane fade show" id="fuzzifikasi">
                <div class="table-responsive">


                  <table class="text-center table table-bordered table-bordered dt-responsive nowrap" cellspacing="0" width="100%">

                    <thead>
                      <tr>
                        <th>No.</th>
                        <th>Waktu</th>
                        <th>Jumlah Kejadian (Normalisasi)</th>
                        <th>Fuzzifikasi</th>
                      </tr>
                    </thead>


                    <tbody id="tabel_fuzzifikasi">
                      <tr>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                      </tr>

                    </tbody>

                  </table>
                </div>
              </div>

              <div role="tabpanel" class="tab-pane fade show" id="fl">
                <div class="table-responsive">
                  <table class="text-center table table-bordered table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th>No.</th>
                        <th>Waktu</th>
                        <th>Jumlah Kejadian (Normalisasi)</th>
                        <th>FLR</th>
                        <th>FLRG</th>
                      </tr>
                    </thead>
                    <tbody id="tabel_fl">
                      <tr>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                      </tr>

                    </tbody>

                  </table>
                </div>
              </div>

              <div role="tabpanel" class="tab-pane fade show" id="pembobotan">
                <div class="row ">
                  <div class="col-lg-6 ">
                    <div>
                      <div class="timeline">
                        <article class="timeline-item " style="display: block !important;">
                          <div class="timeline-desk">
                            <div class="panel">
                              <div class="panel-body">
                                <h4 class="text-danger">Matrik Pembobot (W)</h4>
                                <p class="timeline-date text-muted"><small>Bobot relasi FLR diberikan pada urutan dan perulangan yang sama sehingga diperoleh </small></p>
                                <div id="matriks_pembobot">
                                  <div class="row col-auto">
                                    <div class="col-auto ">
                                      <div class="input-group-prepend mb-2">
                                        <div class="input-group-text page-link" style=" width:45px; color:black !important">0</div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                        </article>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6  overflow-auto ">
                    <div>
                      <div class="timeline">
                        <article class="timeline-item " style="display: block !important;">
                          <div class="timeline-desk">
                            <div class="panel">
                              <div class="panel-body">
                                <h4 class="text-success">Matriks Bobot Terstandarisasi (W*)</h4>
                                <p class="timeline-date text-muted"><small>matriks pembobot ditransfer dalam bentuk matriks pembobot terstandarisasi </small></p>
                                <div id="matriks_terstandarisasi">
                                  <div class="row col-auto">
                                    <div class="col-auto ">
                                      <div class="input-group-prepend mb-2">
                                        <div class="input-group-text page-link" style=" width:45px; color:black !important">0</div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                        </article>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div role="tabpanel" class="tab-pane fade show " id="defuzzifikasi">
                <div class="row">
                  <div class="col-12">
                    <div class="table-responsive">
                      <table class="text-center table table-bordered table-bordered dt-responsive nowrap" cellspacing="0" width="100%">

                        <thead>
                          <tr>
                            <th><i>Group</i></th>
                            <th>Fuzzifikasi</th>
                            <th>Nilai Peramalan</th>
                          </tr>
                        </thead>
                        <tbody id="tabel_defuzzifikasi">
                          <tr>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>

                          </tr>

                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>

              </div>

              <div role="tabpanel" class="tab-pane fade show" id="peramalan">
                <div class="row">
                  <div class="col-lg-6">
                    <div class="table-responsive">
                      <table class="text-center table table-bordered table-bordered dt-responsive nowrap" cellspacing="0" width="100%">

                        <thead>
                          <tr>
                            <th>No.</th>
                            <th>Waktu</th>
                            <th>Jumlah Kejadian</th>
                            <th>Fuzzifikasi</th>
                            <th>Peramalan</th>
                          </tr>
                        </thead>


                        <tbody id="tabel_peramalan">
                          <tr>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                          </tr>

                        </tbody>

                      </table>
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <h4 class="header-title m-t-0"> Grafik Perbandingan Data Aktual & Hasil Peramalan Titik Api: </h4>
                    <div id="chartContent">
                      <canvas id="lineChart-fts" width="300" height="200"></canvas>
                    </div>

                  </div>
                </div>
              </div>


            </div>
          </div><!-- end col -->

        </div>
      </div>





      <!-- 
      <div class="col-lg-6 m-t-20 ">
        <h4 class="header-title m-t-0"><i>Root Mean Square Deviation</i> (RMSE) : <span id="mape"></span></h4>
        <canvas id="lineChart-fts" width="300" height="300"></canvas>
      </div> -->

    </div>
  </div>


</div>

@endsection