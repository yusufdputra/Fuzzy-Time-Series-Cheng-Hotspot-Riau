@extends('layout/master')

@section('title', 'Dashboard')

@section('container')
<div class="container-fluid">

  <!-- Page-Title -->
  <div class="row">
    <div class="col-sm-12">
      <h4 class="page-title">Normalisasi Data {{$jenis}} Titik Api Provinsi Riau</h4>
    </div>
  </div>

  <!-- end page title end breadcrumb -->

  <div class="card-box">
    <div class="row">
      <div class="col-auto">
        <form class="form-inline">

          <div class="form-row align-items-center ">

            <div class="col-auto mb-1">
              <div class="input-group row">
                <div class="col-sm-12">
                  <div class="input-group">
                  <input type="hidden" name="jenis_data" value="{{$jenis}}" id="jenis_data">

                    <select id="selected_kabupaten_norm" required class="form-control">
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


            <div class="col-auto mb-1">
              <a onclick="do_normalisasi('{{$jenis}}')" class="btn btn-success waves-effect waves-light ">Normalisasi</a>
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




      <div class="col-12 m-t-20 ">
        <div class=" table-responsive">
          <table class="responsive-datatable text-center table table-bordered table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>No.</th>
                <th>Waktu</th>
                <th>Jumlah Kejadian</th>
                <th>Normalisasi Jumlah Kejadian</th>
              </tr>
            </thead>
            <tbody id="dataset_row">

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


</div>

@endsection