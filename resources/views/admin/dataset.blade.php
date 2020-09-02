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

          <div class="button-list">
            <a href="#hapus-modal" data-animation="sign" data-plugin="custommodal" data-overlaySpeed="100" data-overlayColor="#36404a" class="btn btn-danger waves-effect waves-light">Hapus</a>
            <a href="#import-modal" data-animation="sign" data-plugin="custommodal" data-overlaySpeed="100" data-overlayColor="#36404a" class="btn btn-success waves-effect waves-light">Import</a>
          </div>
        </div>
        <p class="header-title font-16 mt-3">
          Data: {{$date_select->selected_date}}
        </p>
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
                <a href="#seleksi" data-toggle="tab" aria-expanded="true" class="nav-link">
                  Seleksi Data
                </a>
              </li>
              <li class="nav-item">
                <a href="#transformasi" data-toggle="tab" aria-expanded="false" class="nav-link">
                  Transformasi Data
                </a>
              </li>
              <li class="nav-item">
                <a href="#normalisasi" data-toggle="tab" aria-expanded="false" class="nav-link">
                  Normalisasi Data
                </a>
              </li>
            </ul>

            <div class="tab-content">
              <div role="tabpanel" class="tab-pane fade show active" id="datasets">
                <div class="table-responsive">


                  <table class="responsive-datatable text-center table table-bordered table-bordered dt-responsive nowrap" cellspacing="0" width="100%">

                    <thead>
                      <tr>
                        <th>No.</th>
                        <th>Lintang</th>
                        <th>Bujur</th>
                        <th>Waktu Kejadian</th>
                        <th>Kepercayaan (%)</th>
                        <th>Satelit</th>
                        <th>Kecamatan</th>
                        <th>Kabupaten</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($datasets as $index=> $da)
                      <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$da->lintang}}</td>
                        <td>{{$da->bujur}}</td>
                        <td>{{date_format (new DateTime($da->tanggal), 'd-F-Y')}} {{$da->jam}}</td>
                        <td>{{$da->kepercayaan}}</td>
                        <td>{{$da->satelit}}</td>
                        <td>{{$da->kecamatan}}</td>
                        <td>{{$da->kabupaten}}</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
              <div role="tabpanel" class="tab-pane fade" id="seleksi">
                <div class=" table-responsive">


                  <input type="hidden" id="i_date" name="i_date" value="{{$date_select->selected_date}}">
                  <button onclick="preprocessing()" class="btn btn-primary waves-effect waves-light btn-sm m-b-10 ">Transform Data</button>

                  

                  <table class="responsive-datatable text-center table table-bordered table-bordered dt-responsive nowrap" cellspacing="0" width="100%">

                    <thead>
                      <tr>
                        <th>No.</th>
                        <th>Waktu Kejadian</th>
                        <th>Kabupaten</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($datasets as $index=> $da)
                      <tr>
                        <td>{{$index+1}}</td>
                        <td>{{date_format (new DateTime($da->tanggal), 'd-F-Y')}}</td>
                        <td>{{$da->kabupaten}}</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
              <div role="tabpanel" class="tab-pane fade" id="transformasi">
                <div class=" table-responsive">
                  <table class="responsive-datatable text-center table table-bordered table-bordered dt-responsive nowrap" cellspacing="0" width="100%">

                    <thead>
                      <tr>
                        <th>No.</th>
                        <th>Waktu</th>
                        <th>Kabupaten</th>
                        <th>Jumlah Kejadian</th>
                      </tr>
                    </thead>


                    <tbody id="dataset_row">
                      @foreach ($data_transform as $index => $ds)
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
              <div role="tabpanel" class="tab-pane fade" id="normalisasi">
                <div class=" table-responsive">
                  <table class="responsive-datatable text-center table table-bordered table-bordered dt-responsive nowrap" cellspacing="0" width="100%">

                    <thead>
                      <tr>
                        <th>No.</th>
                        <th>Waktu</th>
                        <th>Kabupaten</th>
                        <th>Jumlah Kejadian</th>
                      </tr>
                    </thead>


                    <tbody id="dataset_row">
                      @foreach ($data_transform as $index => $ds)
                      <?php
                      $dateObj   = DateTime::createFromFormat('!m', $ds->bulan);
                      $monthName = $dateObj->format('F')
                      ?>

                      <tr>

                        <td>{{$index+1}}</td>
                        <td>{{$monthName}}-{{$ds->tahun}} </td>
                        <td>{{$ds->kabupaten}}</td>
                        <td>{{$ds->normalisasi}}</td>
                      </tr>
                      @endforeach




                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div><!-- end col -->

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