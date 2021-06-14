<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <title>Peramalan Titik Api Provinsi Riau - FTS CHENG</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
  <meta content="Coderthemes" name="author" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />




  <!-- App favicon -->
  <link rel="shortcut icon" href="adminto/images/favicon.ico">

  <!-- Notification css (Toastr) -->
  <link href="adminto/plugins/toastr/toastr.min.css" rel="stylesheet" type="text/css" />

  <!-- App css -->
  <link href="adminto/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="adminto/css/icons.css" rel="stylesheet" type="text/css" />
  <link href="adminto/css/style.css" rel="stylesheet" type="text/css" />

  <!-- loading -->
  <link href="adminto/css/loading.css" rel="stylesheet" type="text/css" />

  <script src="adminto/js/modernizr.min.js"></script>

  <!-- Custom box css -->
  <link href="adminto/plugins/custombox/dist/custombox.min.css" rel="stylesheet">

  <!-- Plugins css-->
  <link href="adminto/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
  <!-- DataTables -->
  <link href="adminto/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
  <link href="adminto/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
  <!-- Responsive datatable examples -->
  <link href="adminto/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

  <link href="adminto/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
  <!-- form Uploads -->
  <link href="adminto/plugins/fileuploads/css/dropify.min.css" rel="stylesheet" type="text/css" />
  @toastr_css

</head>

<body>

  <!-- Navigation Bar-->
  <header id="topnav">
    <div class="topbar-main">
      <div class="container-fluid">

        <!-- Logo container-->
        <div class="logo">
          <!-- Text Logo -->
          <!--<a href="index.html" class="logo">-->
          <!--<span class="logo-small"><i class="mdi mdi-radar"></i></span>-->
          <!--<span class="logo-large"><i class="mdi mdi-radar"></i> Adminto</span>-->
          <!--</a>-->
          <!-- Image Logo -->
          <a href="{{'/'}}" class="logo">

            <img src="adminto/images/logo-sm.png" alt="" height="26" class="logo-small">
            <img src="adminto/images/logo1.png" alt="" height="24" class="logo-large">
          </a>
        </div>
        <!-- End Logo container-->

        <div class="menu-extras topbar-custom">

          <ul class="list-unstyled topbar-right-menu float-right mb-0">

            <li class="menu-item">
              <!-- Mobile menu toggle-->
              <a class="navbar-toggle nav-link">
                <div class="lines">
                  <span></span>
                  <span></span>
                  <span></span>
                </div>
              </a>
              <!-- End mobile menu toggle-->
            </li>



            <li class="dropdown notification-list">
              <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <img src="adminto/images/users/avatar-1.png" alt="user" class="rounded-circle">
              </a>
              <!-- <div class="dropdown-menu dropdown-menu-right profile-dropdown ">

                  @if(Session::get('status_login') == 1)
                  <a href="{{'logout'}}" class="dropdown-item notify-item">
                    <i class="ti-power-off m-r-5"></i> Logout
                    @endif
                    @if(Session::get('status_login') == 0)
                    <a href="#login-modal" data-animation="sign" data-plugin="custommodal" data-overlaySpeed="100" data-overlayColor="#36404a" class="dropdown-item notify-item">
                      <i class="ti-power-off m-r-5"></i> Login

                    </a>
                    @endif
                  </a>




                </div> -->
            </li>

          </ul>
        </div>

        <!-- End Notification bar -->
        <!-- end menu-extras -->

        <div class="clearfix"></div>

      </div> <!-- end container -->
    </div>
    <!-- end topbar-main -->

    <div class="navbar-custom">
      <div class="container-fluid">
        <div id="navigation">
          <!-- Navigation Menu-->

          <ul class="navigation-menu">
            <li class="has-submenu">
              <a href="{{'/'}}"><i class="mdi mdi-view-dashboard"></i> <span> Dashboard </span> </a>
            </li>

            @if(Session::get('status_login') == 1)
            <li class="has-submenu">
              <a href="#"><i class="mdi mdi-layers"></i> <span>Data </span> </a>
              <ul class="submenu ">
                <li><a href="{{'data'}}">Datasets</a></li>
                <li class="has-submenu">
                  <a href="#">Normalisasi Data</a>
                  <ul class="submenu" style="left:195px !important">
                    <li>
                      <a href="{{'normalisasi-latih'}}">Pelatihan</a>
                    </li>
                    <li>
                      <a href="{{'normalisasi-uji'}}">Pengujian</a>
                    </li>
                  </ul>
                </li>
              </ul>
            </li>
            <li class="has-submenu">
              <a href="#"><i class="mdi mdi-calculator"></i> <span>FTS Cheng </span> </a>
              <ul class="submenu">
                <li><a href="{{'pelatihan'}}">Pelatihan</a></li>
                <li><a href="{{'pengujian'}}">Pengujian</a></li>
              </ul>
            </li>
            @endif

            </a>



          </ul>
          <!-- End navigation menu -->
        </div> <!-- end #navigation -->
      </div> <!-- end container -->
    </div> <!-- end navbar-custom -->
  </header>
  <!-- End Navigation Bar-->

  <!-- Modal -->
  <div id="login-modal" class="modal-demo">
    <button type="button" class="close" onclick="Custombox.close();">
      <span>&times;</span><span class="sr-only">Close</span>
    </button>

    <div class="custom-modal-text">

      <div class="text-center">
        <h4 class="text-uppercase font-bold mb-0">Sign In</h4>
      </div>
      <div class="p-20">

        @if(\Session::has('alert'))
        <div class="alert alert-danger">
          <div>{{Session::get('alert')}}</div>
        </div>
        @endif
        @if(\Session::has('alert-success'))
        <div class="alert alert-success">
          <div>{{Session::get('alert-success')}}</div>
        </div>
        @endif

        <input id="title" type="hidden" class="input-large form-control" value="Login berhasil" placeholder="Enter a title ..." />

        <form class="form-horizontal m-t-20" action="{{'loginPost'}}" method="POST">
          {{csrf_field()}}
          <div class="form-group">
            <div class="col-xs-12">
              <input class="form-control" type="text" name="email_l" required="" placeholder="Email">
            </div>
          </div>

          <div class="form-group">
            <div class="col-xs-12">
              <input class="form-control" type="password" name="password_l" required="" placeholder="Password">
            </div>
          </div>



          <div class="form-group text-center m-t-30">
            <div class="col-xs-12">
              <button class="btn btn-custom btn-bordred btn-block waves-effect waves-light" type="submit">Log In</button>
            </div>
          </div>


        </form>

      </div>
    </div>

  </div>


  <div class="wrapper">
    @yield('container')

  </div>
  <!-- end wrapper -->


  <!-- Footer -->
  <footer class="footer">
    <div class="container">
      <div class="row">
        <div class="col-12 text-center">
          Peramalan Titik Panas Provinsi Riau Menggunakan Metode Cheng - Yusuf Dwi Putra
        </div>
      </div>
    </div>
  </footer>
  <!-- End Footer -->

  @jquery
  @toastr_js
  @toastr_render

  <!-- jQuery  -->
  <script src="adminto/js/jquery.min.js"></script>
  <script src="adminto/js/popper.min.js"></script>
  <script src="adminto/js/bootstrap.min.js"></script>
  <script src="adminto/js/waves.js"></script>
  <script src="adminto/js/jquery.slimscroll.js"></script>

  <!-- App js -->
  <script src="adminto/js/jquery.core.js"></script>
  <script src="adminto/js/jquery.app.js"></script>
  <script src="adminto/plugins/custombox/dist/custombox.min.js"></script>
  <script src="adminto/plugins/custombox/dist/legacy.min.js"></script>

  <!-- Toastr js -->
  <script src="adminto/plugins/toastr/toastr.min.js"></script>

  <!-- Plugins Js -->
  <script src="adminto/plugins/select2/js/select2.min.js" type="text/javascript"></script>

  <!-- Required datatable js -->
  <script src="adminto/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="adminto/plugins/datatables/dataTables.bootstrap4.min.js"></script>

  <script src="adminto/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
  <!-- file uploads js -->
  <script src="adminto/plugins/fileuploads/js/dropify.min.js"></script>

  <!-- Chart JS -->
  <script src="adminto/plugins/chart.js/Chart.bundle.min.js"></script>
  <script src="adminto/pages/jquery.chartjs.init.js"></script>

  <!-- image size auto -->
  <script src="adminto/js/imageMapResizer.min.js"></script>


  <script type="text/javascript">
    // Date Picker
    jQuery('#datepicker').datepicker();
    jQuery('#datepicker-autoclose').datepicker({
      autoclose: true,
      todayHighlight: true,
      format: "yyyy-mm",
      startView: "months",
      minViewMode: "months"
    });

    jQuery('#datepicker-autoclose-modal').datepicker({
      autoclose: true,
      todayHighlight: true,
      format: "yyyy-mm",
      startView: "months",
      minViewMode: "months"
    });

    jQuery('.datepicker-autoclose-modal-year').datepicker({
      autoclose: true,
      todayHighlight: true,
      format: "yyyy",
      startView: "years",
      minViewMode: "years"
    });

    jQuery('#date-range').datepicker({
      toggleActive: true
    });

    // Select2
    $(".select2").select2();

    // Default Datatable
    $('#datatable').DataTable();

    // Responsive Datatable
    $('.responsive-datatable').DataTable();

    function clearChart(id_chart) {
      event.preventDefault();
      var parent = document.getElementById('chartContent')
      var child = document.getElementById(id_chart)
      parent.removeChild(child);
      parent.innerHTML = '<canvas id="' + id_chart + '" width="300" height="200"></canvas>';
      return;
    }

    function renderChart(data, labels, id_chart) {
      var ctx = document.getElementById(id_chart).getContext("2d")
      var myChart = new Chart(ctx, {

        type: 'line',
        data: {
          labels: labels,
          datasets: [{
            label: 'Nilai Aktual',
            data: data,
            borderColor: 'rgba(91, 105, 188, 1)',
            backgroundColor: 'rgba(91, 105, 188, 0.1)',
          }],
        },
      });
    }

    // $(document).ready(function() {
    //   $('#selected_kabupaten_norm').on('change', function(e) {
    //     var jenis = document.getElementById('jenis_data').value;
    //     var id = e.target.value;
    //     $('#dataset_row').html("");
    //     $.get('{{url("normalisasi_data_ajax")}}/' + id + '/' + jenis, function(data) {
    //       console.log(data)
    //       $.each(data, function(index, element) {
    //         //set untuk tabel
    //         const bulan = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    //         var format = bulan[element.bulan - 1] + "-" + element.tahun
    //         $('#dataset_row').append("<tr><td>" + (index + 1) + "</td><td>" + format + "</td><td>" + element.jumlah_kejadian + "</td><td>" + element.normalisasi + "</td></tr>");
    //       })
    //     })
    //   })
    // })

    // function do_preprocessing() {
    //   var date = document.getElementById('i_date').value;
    //   $('#dataset_row').html("");
    //   $.ajax({
    //     url: '{{url("preprocessing_data")}}/' + date,
    //     type: 'GET',
    //     dataType: 'json',
    //     success: 'success',
    //     success: function(data) {
    //       toastr.success('Sukses melakukan transformasi data!')
    //       $.each(data, function(index, element) {
    //         //set untuk tabel
    //         const bulan = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    //         var format = bulan[element.bulan - 1] + "-" + element.tahun
    //         $('#dataset_row').append("<tr><td>" + (index + 1) + "</td><td>" + format + "</td><td>" + element.kabupaten + "</td><td>" + element.jumlah_kejadian + "</td></tr>");
    //       })
    //     },
    //     error: function(data) {
    //       toastr.error('Gagal melakukan transformasi data!')
    //     }
    //   })
    // }


    // function do_normalisasi(jenis) {
    //   var id_kab = document.getElementById('selected_kabupaten_norm').value;
    //   var start_time = document.getElementById('start_time').value;
    //   var end_time = document.getElementById('end_time').value;

    //   if (id_kab != "Pilih Kabupaten" && start_time != '' && end_time != '') {

    //     $('#dataset_row').html("");
    //     $.ajax({
    //       url: '{{url("normalisasi_ajax")}}/' + id_kab + '/' + start_time + '/' + end_time + '/' + jenis,
    //       type: 'GET',
    //       dataType: 'json',
    //       success: 'success',
    //       success: function(data) {

    //         toastr.success('Sukses melakukan normalisasi data!')
    //         $.each(data, function(index, element) {
    //           //set untuk tabel
    //           const bulan = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    //           var format = bulan[element.bulan - 1] + "-" + element.tahun
    //           $('#dataset_row').append("<tr><td>" + (index + 1) + "</td><td>" + format + "</td><td>" + element.jumlah_kejadian + "</td><td>" + element.normalisasi + "</td></tr>");
    //         });
    //       },
    //       error: function(data) {
    //         toastr.error('Gagal melakukan normalisasi data!')
    //       }
    //     })
    //   } else {
    //     toastr.info('Silahkan isi data terlebih dahulu!')
    //   }

    // }

    // function do_latih() {

    //   var id_kab = document.getElementById('selected_kabupaten_latih').value;
    //   id_chart = "lineChart-fts"

    //   if (id_kab != "Pilih Kabupaten") {

    //     $('#dataset_row').html("");
    //     $('#nilai_u').html("");
    //     $('#nilai_R').html("");
    //     $('#nilai_K').html("");
    //     $('#nilai_I').html("");
    //     $('#tabel_nilai_batas_kelas1').html("");
    //     $('#tabel_nilai_batas_kelas2').html("");
    //     $('#tabel_fuzzifikasi').html("");
    //     $('#tabel_fl').html("");
    //     $('#tabel_pembobot').html("");
    //     $('#tabel_defuzzifikasi').html("");
    //     $('#tabel_peramalan').html("");
    //     $('#lineChart-fts').html("");
    //     $('#matriks_pembobot').html("")
    //     $('#matriks_terstandarisasi').html("")
    //     $('#matriks_h_fuzzy').html("")
    //     $('#hori-matriks_h_fuzzy').html("")
    //     $('#verti-matriks_h_fuzzy').html("")
    //     $('#tabel_linguistik').html("")
    //     clearChart(id_chart)


    //     $.ajax({
    //       url: '{{url("latihAjax")}}/' + id_kab,
    //       type: 'GET',
    //       dataType: 'json',
    //       success: 'success',

    //       success: function(data) {
    //         toastr.success('Sukses melakukan pelatihan data!')

    //         $('#nilai_u').append("U = [" + data[2]['konstanta']['minimum'] + " , " + data[2]['konstanta']['maximum'] + "]") //nilai minimum, dan maximum 
    //         $('#nilai_R').append("R = " + data[2]['konstanta']['R']) //nilai R
    //         $('#nilai_K').append("K = " + data[2]['konstanta']['K']) //nilai K
    //         $('#nilai_I').append("I = " + data[2]['konstanta']['I']) //nilai I 
    //         // $('#mape').append(parseFloat(data[3]))
    //         //set untuk chart
    //         var data_ = [];
    //         data_.push(data[1]); // data actual
    //         data_.push(data[2]['prediksi']); // data prediksi

    //         var labels = data[0];

    //         renderChart(data_, labels, id_chart);
    //         // print datasets
    //         $.each(data[0], function(index, element) {

    //           //set untuk tabel
    //           var time = (data[0][index])
    //           const bulan = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    //           $('#dataset_row').append(
    //             "<tr><td>" + (index + 1) + "</td><td>" + time + "</td><td>" + data[1][index] + "</td></tr>"
    //           );

    //         });

    //         // himpunan semesta 1
    //         $.each(data[2]['nilai_batas_kelas']['batas_bawah'], function(index, element) {

    //           $('#tabel_nilai_batas_kelas1').append(
    //             "<tr><td> U" + (index + 1) + "</td><td>" + data[2]['nilai_batas_kelas']['batas_bawah'][index] + "</td><td>" + data[2]['nilai_batas_kelas']['batas_atas'][index] + "</td><td>" + data[2]['nilai_batas_kelas']['nilai_tengah'][index] + "</td><td>" + data[2]['nilai_batas_kelas']['frekuensi'][index] + "</td></tr>"
    //           )
    //         })

    //         // himpunan semesta kondisi 2
    //         $.each(data[2]['new_nilai_batas_kelas']['batas_bawah'], function(index, element) {
    //           $('#tabel_nilai_batas_kelas2').append(
    //             "<tr><td> U" + (index + 1) + "</td><td>" + data[2]['new_nilai_batas_kelas']['batas_bawah'][index] + "</td><td>" + data[2]['new_nilai_batas_kelas']['batas_atas'][index] + "</td><td>" + data[2]['new_nilai_batas_kelas']['nilai_tengah'][index] + "</td></tr>"
    //           )
    //         })

    //         // Mendefinisikan Himpunan Fuzzy
    //         // bagi array 1 dimensi menjadi 2 dimensi 
    //         var row_w = data[2]['new_nilai_batas_kelas']['batas_bawah'] // get jumlah baris matriks

    //         var matriks_fuzzy = data[2]['himpunan_fuzzy'] // get data matriks
    //         var matriks_fuzzy_new = [],
    //           i, k;
    //         for (i = 0, k = -1; i < matriks_fuzzy.length; i++) {
    //           if (i % row_w.length === 0) {
    //             k++;
    //             matriks_fuzzy_new[k] = [];
    //           }
    //           matriks_fuzzy_new[k].push(matriks_fuzzy[i]);
    //         }

    //         // Mendefinisikan Himpunan Fuzzy
    //         // bentuk value horizontal title
    //         for (let i = 0; i < matriks_fuzzy_new[0].length + 1; i++) {
    //           $('#hori-matriks_h_fuzzy').append('<div class="row col-auto"><div class="input-group-prepend mb-2 mr-2"><div class="input-group-text page-link"  style=" width:45px; font-size:10px; !important">A' + i + '</div></div></div>')
    //         }
    //         for (let i = 0; i < matriks_fuzzy_new[0].length; i++) {
    //           $('#verti-matriks_h_fuzzy').append('<div class="row"><div class="input-group-prepend mb-2"><div class="input-group-text page-link" style=" width:45px; font-size:10px; !important">A' + (i + 1) + '</div></div></div>')
    //         }
    //         //bentuk value dalam matriks
    //         var am_fuzzy = [],
    //           l
    //         for (let j = 0; j < (matriks_fuzzy_new[0].length); j++) {
    //           for (let k = 0; k < (matriks_fuzzy_new[0].length); k++) {
    //             if (k % matriks_fuzzy_new[0].length === 0) {
    //               am_fuzzy[j] = []
    //             }
    //             am_fuzzy[j][k] = ('<div class="row"><div class="input-group-prepend mb-2 mr-3"><div class=" input-group-text page-link " style=" width:45px; font-size:10px; color:black !important">' + matriks_fuzzy_new[j][k] + '</div></div>')
    //           }
    //         }
    //         for (let i = 0; i < matriks_fuzzy_new[0].length; i++) {
    //           $('#matriks_h_fuzzy').append('<div class="row col-auto">' + am_fuzzy[i] + '</div>')
    //         }

    //         // Nilai Linguistik
    //         $.each(data[2]['defuzzifikasi'], function(index, element) {
    //           $('#tabel_linguistik').append(
    //             "<tr><td>A" + (index + 1) + "</td><td>" + data[2]['nilai_linguistik'][index] + "</td></tr>"
    //           );
    //         });

    //         // fuzzifikasi
    //         $.each(data[0], function(index, element) {

    //           var time = (data[0][index])

    //           $('#tabel_fuzzifikasi').append(
    //             "<tr><td>" + (index + 1) + "</td><td>" + time + "</td><td>" + data[1][index] + "</td><td>" + data[2]['fuzzifikasi'][index] + "</td></tr>"
    //           );
    //         });

    //         // FL
    //         $.each(data[0], function(index, element) {
    //           var time = (data[0][index])

    //           $('#tabel_fl').append(
    //             "<tr><td>" + (index + 1) + "</td><td>" + time + "</td><td>" + data[1][index] + "</td><td>" + data[2]['flr'][index] + "</td><td>" + data[2]['flrg'][index] + "</td></tr>"
    //           );
    //         });

    //         // matriks pembobot
    //         // bagi array 1 dimensi menjadi 2 dimensi 

    //         var matriks_pembobot = data[2]['matriks_pembobot'] // get data matriks
    //         var matriks_pembobot_new = [],
    //           i, k;
    //         for (i = 0, k = -1; i < matriks_pembobot.length; i++) {
    //           if (i % row_w.length === 0) {
    //             k++;
    //             matriks_pembobot_new[k] = [];
    //           }
    //           matriks_pembobot_new[k].push(matriks_pembobot[i]);
    //         }

    //         // Pembobotan
    //         var am_pembobotan = []
    //         for (let j = 0; j < matriks_pembobot_new[0].length; j++) {
    //           for (let k = 0; k < matriks_pembobot_new[0].length; k++) {
    //             if (k % matriks_pembobot_new[0].length === 0) {
    //               am_pembobotan[j] = []
    //             }
    //             am_pembobotan[j][k] = ('<div class="row"><div class="input-group-prepend mb-2 mr-3"><div class=" input-group-text page-link " style=" width:45px; font-size:10px; color:black !important">' + matriks_pembobot_new[j][k] + '</div></div>')
    //           }
    //         }
    //         for (let i = 0; i < matriks_pembobot_new[0].length; i++) {
    //           $('#matriks_pembobot').append('<div class="row col-auto">' + am_pembobotan[i] + '</div>')
    //         }

    //         // matriks Terstandarisasi
    //         // bagi array 1 dimensi menjadi 2 dimensi 
    //         var matriks_terstandarisasi = data[2]['matriks_terstandarisasi'] // get data matriks
    //         var matriks_terstandarisasi_new = [],
    //           i, k;
    //         for (i = 0, k = -1; i < matriks_terstandarisasi.length; i++) {
    //           if (i % row_w.length === 0) {
    //             k++;
    //             matriks_terstandarisasi_new[k] = [];
    //           }
    //           matriks_terstandarisasi_new[k].push(matriks_terstandarisasi[i]);
    //         }

    //         // Pembobotan terstandarisasi
    //         var am_standarisasi = []
    //         for (let j = 0; j < matriks_terstandarisasi_new[0].length; j++) {
    //           for (let k = 0; k < matriks_terstandarisasi_new[0].length; k++) {
    //             if (k % matriks_terstandarisasi_new[0].length === 0) {
    //               am_standarisasi[j] = []
    //             }
    //             am_standarisasi[j][k] = ('<div class="row"><div class="input-group-prepend mb-2 mr-3"><div class=" input-group-text page-link " style=" width:45px; font-size:10px;  color:black !important">' + (matriks_terstandarisasi_new[j][k]).toFixed(2) + '</div></div>')
    //           }
    //         }
    //         for (let i = 0; i < matriks_pembobot_new[0].length; i++) {
    //           $('#matriks_terstandarisasi').append('<div class="row col-auto">' + am_standarisasi[i] + '</div>')
    //         }



    //         // Defuzzifikasi
    //         $.each(data[2]['defuzzifikasi'], function(index, element) {
    //           $('#tabel_defuzzifikasi').append(
    //             "<tr><td>G" + (index + 1) + "</td><td>A" + (index + 1) + "</td><td>" + data[2]['defuzzifikasi'][index] + "</td></tr>"
    //           );
    //         });
    //         // Peramalan
    //         $.each(data[0], function(index, element) {
    //           //set untuk tabel
    //           var time = (data[0][index])
    //           $('#tabel_peramalan').append(
    //             "<tr><td>" + (index + 1) + "</td><td>" + time + "</td><td>" + data[1][index] + "</td><td>" + data[2]['fuzzifikasi'][index] + "</td><td>" + data[2]['prediksi'][index] + "</td></tr>"
    //           );
    //         });
    //       },
    //       error: function(data) {
    //         toastr.error('Gagal melakukan pelatihan data! ' + data['responseText'])
    //       }
    //     })
    //   } else {
    //     toastr.info('Silahkan isi data terlebih dahulu!')
    //   }
    // }

    // function do_pengujian() {

    //   var id_kab = document.getElementById('selected_kabupaten_latih').value;
    //   id_chart = "lineChart-fts-pengujian"

    //   if (id_kab != "Pilih Kabupaten") {
    //     $('#tabel_pengujian').html("");
    //     $('#lineChart-fts-pengujian').html("");
    //     $('#nilai_mape').html("");
    //     clearChart(id_chart)

    //     $.ajax({
    //       url: '{{url("UjiAjax")}}/' + id_kab,
    //       type: 'GET',
    //       dataType: 'json',
    //       success: 'success',

    //       success: function(data) {
    //         // console.log(data)
    //         toastr.success('Sukses melakukan pengujian data!')
    //         $('#nilai_mape').append(data[2]['mape']) //nilai rmse

    //         //set untuk chart
    //         var data_ = [];
    //         data_.push(data[1]); // data actual
    //         data_.push(data[2]['prediksi']); // data prediksi
    //         var labels = data[0];
    //         renderChart(data_, labels, id_chart);
    //         //Pengujian
    //         $.each(data[0], function(index, element) {
    //           //set untuk tabel
    //           var time = (data[0][index])
    //           $('#tabel_pengujian').append(
    //             "<tr><td>" + (index + 1) + "</td><td>" + time + "</td><td>" + data[1][index] + "</td><td>" + data[2]['fuzzifikasi'][index] + "</td><td>" + data[2]['prediksi'][index] + "</td></tr>"
    //           );
    //         });
    //       },
    //       error: function(data) {

    //         toastr.error('Gagal melakukan pengujian data! ' + data['responseText'])
    //       }
    //     })
    //   } else {
    //     toastr.info('Silahkan isi data terlebih dahulu!')
    //   }
    // }
  </script>

  <script type="text/javascript">
    $('.dropify').dropify({
      messages: {
        'default': 'Drag and drop a file here or click',
        'replace': 'Drag and drop or click to replace',
        'remove': 'Remove',
        'error': 'Ooops, something wrong appended.'
      },
      error: {
        'fileSize': 'The file size is too big (1M max).'
      }
    });
  </script>

  <script type="text/javascript">
    function do_forecasting() {

      var kab = document.getElementById('selected_kabupaten_forecast').value;
      id_chart = "lineChart_aktual"

      if (kab != "Pilih Kabupaten" && kab != null) {
        $('#loading_page').html("");
        $('#loading_page').append('<div class="loading"></div>');
        $('#lineChart_aktual').html("");
        $('#angka_peramalan').html("");
        $('#badge_linguistik').html("");
        clearChart(id_chart)

        $.ajax({

          url: '{{url("forecasting")}}/' + kab,
          type: 'GET',
          dataType: 'json',
          success: 'success',

          success: function(data) {
            $('#loading_page').html("");
            toastr.success('Sukses melakukan peramalan!')


            //set untuk chart
            var data_ = data[0]['n_per_time']; // data actual
            var labels = data[0]['time'];
            renderChart(data_, labels, id_chart);

            //set untuk peramalan 
            $('#angka_peramalan').append(((Math.round(data[0]['prediksi_next'])) - 1))
            $('#badge_linguistik').append(data[0]['fuzzy_prediksi_next'])
          },
          error: function(data) {
            $('#loading_page').html("");
            toastr.error('Gagal melakukan peramalan! ')
          }
        })


      } else {
        toastr.error('Gagal melakukan peramalan! Pilih Kabupaten!')
      }

    }
    $(document).ready(function() {
      $('map').imageMapResize();
    })

    $("map.area").hover(function() {
      $(this).fadeOut(100);
      $(this).fadeIn(500);
    });

    $("area").click(function(e) {
      var id_kab = e.target.alt;
      var id_chart = 'lineChart-aktual'
      id_chart = "lineChart_aktual"
      clearChart(id_chart)
      $('#loading_page').html("");
      $('#loading_page').append('<div class="loading"></div>');
      $('#lineChart_aktual').html("");
      $('#angka_peramalan').html("");
      $('#badge_linguistik').html("");
      clearChart(id_chart)
      $.ajax({
        url: '{{url("forecasting")}}/' + id_kab,
        type: 'GET',
        dataType: 'json',
        success: 'success',

        success: function(data) {
          $('#loading_page').html("");
          toastr.success('Sukses melakukan peramalan!')
          console.log(data)

          //set untuk chart
          var data_ = data[0]['n_per_time']; // data actual
          var labels = data[0]['time'];
          renderChart(data_, labels, id_chart);

          //set untuk peramalan 
          $('#angka_peramalan').append(((Math.round(data[0]['prediksi_next'])) - 1))
          $('#badge_linguistik').append(data[0]['fuzzy_prediksi_next'])
        },
        error: function(data) {
          toastr.error('Gagal memanggil data')
        }
      })
    });
  </script>

</body>

</html>