@extends('layout/master')

@section('title', 'Dashboard')

@section('container')
<div class="container-fluid">

  <!-- Page-Title -->
  <div class="row">
    <div class="col-sm-12">
      <h4 class="page-title">Peramalan Titik Api Provinsi Riau</h4>
    </div>
  </div>

  <!-- end page title end breadcrumb -->

  <div class="card-box">
    <div class="row">
      <div class="col-lg-5">

        <div class="form-row align-items-center ">

          <div class="col-8">
            <div class="input-group row">
              <div class="col-sm-12">
                <div class="input-group">

                  <select id="selected_kabupaten" required class="form-control">
                    <option disabled selected>Pilih Kabupaten</option>
                    @foreach ($kabupaten_row AS $kr)

                    <option value="{{$kr->id}}">{{$kr->kabupaten}}</option>
                    @endforeach

                  </select>
                </div><!-- input-group -->
              </div>
            </div>
          </div>

          <!-- <div class="col-2">
            <a onclick="peramalan()" class="btn btn-success waves-effect waves-light ">Peramalan</a>
          </div> -->
        </div>

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




      <div class="col-lg-6  m-t-20 ">
        <div class=" table-responsive">
          <table id="responsive-datatable" class=" table table-bordered table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>No.</th>
                <th>Waktu</th>
                <th>Nilai Aktual</th>
                <th>Nilai Peralaman</th>
              </tr>
            </thead>
            <tbody id="dataset_row">
            </tbody>
          </table>
        </div>
      </div>

      <div class="col-lg-6 m-t-20 ">
      <h4 class="header-title m-t-0"><i>Root Mean Square Deviation</i> (RMSE) : <span id="mape"></span></h4>
        <canvas id="lineChart-fts" width="300" height="300"></canvas>
      </div>

    </div>
  </div>


</div>

@endsection