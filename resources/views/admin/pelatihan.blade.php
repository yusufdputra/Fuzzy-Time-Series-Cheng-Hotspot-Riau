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
        <form action="" role="form" id="formLatih">

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

            <div class="col-auto mb-1">
              <div class="input-group row">
                <div class="col-auto">
                  <div class="input-daterange input-group" id="date-range">
                    <input type="text" name="start_time" class="form-control datepicker-autoclose-modal-year" placeholder="YYYY" id="start_time" required autocomplete="off">
                    <input type="text" name="end_time" class="form-control datepicker-autoclose-modal-year" placeholder="YYYY" id="end_time" required autocomplete="off">
                  </div>
                </div>
              </div>
            </div>

            <div class="col-auto">

              <a href="#" onclick="do_latih()" class="btn btn-success waves-effect waves-light">Latih</a>
            </div>

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
                <a href="#flr-g" data-toggle="tab" aria-expanded="false" class="nav-link">
                  FLR & FLRG
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
                <a href="#hasil" data-toggle="tab" aria-expanded="false" class="nav-link">
                  Peramalan
                </a>
              </li>
              <li class="nav-item">
                <a href="#rmse" data-toggle="tab" aria-expanded="false" class="nav-link">
                  RMSE
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
                              <span class="arrow"></span>
                              <span class="timeline-icon bg-danger"><i class="mdi mdi-circle"></i></span>
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
                              <span class="arrow"></span>
                              <span class="timeline-icon bg-success"><i class="mdi mdi-circle"></i></span>
                              <h4 class="text-success">Distribusi Himpunan Semesta</h4>
                              <ol class="text-muted">
                                <li>Rentang <i>(Range)</i></li>
                                <p id="nilai_R">R = 0</p>

                                <li>Banyak Interval Kelas</li>
                                <p id="nilai_K">K = 0</p>

                                <li>Lebar Interval</li>
                                <p id="nilai_I">I = 0</p>

                                <li>Nilai tengah</li>
                              </ol>


                            </div>
                          </div>
                        </div>
                      </article>


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