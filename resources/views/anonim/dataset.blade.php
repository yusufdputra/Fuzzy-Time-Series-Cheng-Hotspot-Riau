@extends('layout/master')

@section('title', 'Dashboard')

@section('container')
<div class="container-fluid">

  <!-- Page-Title -->
  <div class="row">
    <div class="col-sm-12">
      <h4 class="page-title">Data Titik Api Provinsi Riau</h4>
    </div>
  </div>

  <!-- end page title end breadcrumb -->

  <div class="card-box">
    <div class="row">
      <div class="col-lg-12">

        <div class="form-row align-items-center">

          <div class="col-4">
            <form method="get" action="selected_date" enctype="multipart/form-data">
              <div class="input-group row">

                <div class="col-sm-12">
                  <div class="input-group">
                    <input type="text" name="selected_date" class="form-control" placeholder="Pilih Bulan dan Tahun" id="datepicker-autoclose" required autocomplete="off">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-invers btn-trans waves-effect waves-light" type="button">Cari</button>
                    </div>
                  </div><!-- input-group -->
                </div>



              </div>
            </form>
          </div>
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




      <div class="col-lg-6 m-t-20 ">
        <div class=" table-responsive">

          <p class="header-title font-16 ">
            Data Actual Pada: {{$date_select->selected_date}}
          </p>
          

          <table id="responsive-datatable" class=" table table-bordered table-bordered dt-responsive nowrap" cellspacing="0" width="100%">

            <thead>
              <tr>
                <th>No.</th>
                <th>Waktu Kejadian</th>
                <th>Kabupaten</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($data_actual as $index=> $da)
              <tr>
                <td>{{$index+1}}</td>
                <td>{{date_format (new DateTime($da->tanggal), 'd-F-Y')}} {{$da->jam}}</td>
                <td>{{$da->kabupaten}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>


      <div class="col-lg-6 m-t-20 ">
        <div class=" table-responsive">

          <p class="header-title font-16 ">
            Data Set Pada: {{$date_select->selected_date}}
          </p>
         


          <table id="responsive-datatable2" class="table table-bordered table-bordered dt-responsive nowrap" cellspacing="0" width="100%">

            <thead>
              <tr>
                <th>No.</th>
                <th>Waktu</th>
                <th>Kabupaten</th>
                <th>Kejadian</th>

              </tr>
            </thead>


            <tbody id="dataset_row">
              @foreach ($data_set as $index => $ds)
              <?php 
              $dateObj   = DateTime::createFromFormat('!m', $ds->bulan);
              $monthName = $dateObj->format('F') 
              ?>

              <tr>

                <td>{{$index+1}}</td>
                <td>{{$monthName}}-{{$ds->tahun}} </td>
                <td>{{$ds->kabupaten}}</td>
                <td>{{$ds->jumlah_kejadian}}</td>
              </tr>
              @endforeach




            </tbody>
          </table>
        </div>
      </div>









    </div>
  </div>


  <!-- Modal Import-->
  <div id="import-modal" class="modal-demo">
    <button type="button" class="close" onclick="Custombox.close();">
      <span>&times;</span><span class="sr-only">Close</span>
    </button>
    <div class="custom-modal-text">
      <div class="text-center">
        <h4 class="text-uppercase font-bold mb-0">Import Data</h4>
      </div>
      <div class="p-20">
        <form action="import" method="POST" enctype="multipart/form-data">
          <div class="input-group">
            {{csrf_field()}}

            <input type="file" name="file" class="dropify" />

          </div>
          <div class="form-group text-center m-t-30">
            <div class="col-xs-12">
              <button class="btn btn-success btn-block btn-xs waves-effect waves-light" type="submit">Import</button>
            </div>
          </div>
        </form>

      </div>
    </div>
  </div>

  <!-- Modal Hapus data-->
  <div id="hapus-modal" class="modal-demo">
    <button type="button" class="close" onclick="Custombox.close();">
      <span>&times;</span><span class="sr-only">Close</span>
    </button>
    <div class="custom-modal-text">
      <div class="text-center">
        <h4 class="text-uppercase font-bold mb-0">Hapus Data</h4>
      </div>
      <div class="p-20">
        <form action="remove_data" method="POST" enctype="multipart/form-data">
          <p class="text-muted m-b-15 font-13">
            Silahkan pilih bulan yang ingin dihapus!
          </p>
          <div class="input-group">
            {{csrf_field()}}

            <input type="text" name="selected_date_remove" class="form-control" placeholder="Pilih Bulan dan Tahun" id="datepicker-autoclose-modal" required autocomplete="off">

          </div>
          <div class="form-group text-center m-t-30">
            <div class="col-xs-12">
              <button class="btn btn-danger btn-block btn-xs waves-effect waves-light" type="submit">Hapus</button>
            </div>
          </div>
        </form>

      </div>
    </div>
  </div>


  @endsection