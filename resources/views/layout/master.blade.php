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
              <div class="dropdown-menu dropdown-menu-right profile-dropdown ">

                @if(Session::get('status_login') == 1)
                <a href="{{'logout'}}" class="dropdown-item notify-item">
                  <i class="ti-power-off m-r-5"></i> Logout
                  @endif
                  @if(Session::get('status_login') == 0)
                  <a href="#login-modal" data-animation="sign" data-plugin="custommodal" data-overlaySpeed="100" data-overlayColor="#36404a" class="dropdown-item notify-item">
                    <i class="ti-power-off m-r-5"></i> Login
                    @endif
                  </a>
                </a>




              </div>
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

            <!-- <li class="has-submenu">
              <a href="{{'data'}}"><i class="mdi mdi-layers"></i> <span>Data </span> </a>
            </li> -->

            <li class="has-submenu">
              <a href="#"><i class="mdi mdi-layers"></i> <span>Data </span> </a>
              <ul class="submenu">
                <li><a href="{{'data'}}">Datasets</a></li>
                <li><a href="{{'normalisasi'}}">Normalisasi Data</a></li>
              </ul>
            </li>




            @if(Session::get('status_login') == 1)
            <li class="has-submenu">
              <a href="#"><i class="mdi mdi-calculator"></i> <span>FTS Cheng </span> </a>
              <ul class="submenu">
                <li><a href="{{'pelatihan'}}">Pelatihan</a></li>
                <li><a href="{{'/'}}">Pengujian</a></li>
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
          Peramalan Titik Api Provinsi Riau Menggunakan Metode Cheng - Yusuf Dwi Putra
        </div>
      </div>
    </div>
  </footer>
  <!-- End Footer -->



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

    jQuery('.datepicker-autoclose-modal').datepicker({
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

    function renderChart(data, labels) {
      var ctx = document.getElementById("lineChart-fts").getContext("2d");

      var myChart = new Chart(ctx, {

        type: 'line',
        data: {
          labels: labels,
          datasets: [{
              label: 'Nilai Actual',
              data: data[0],
              borderColor: 'rgba(91, 105, 188, 1)',
              backgroundColor: 'rgba(91, 105, 188, 0.1)',
            },
            {
              label: 'Nilai Peramalan',
              data: data[1],
              borderColor: 'rgba(16, 196, 105, 1)',
              backgroundColor: 'rgba(16, 196, 105, 0.1)',
            }
          ],

        },

      });

    }

    $(document).ready(function() {
      $('#selected_kabupaten_norm').on('change', function(e) {
        var id = e.target.value;
        $('#dataset_row').html("");
        $.get('{{url("normalisasi_data_ajax")}}/' + id, function(data) {
          console.log(data)
          $.each(data, function(index, element) {
            //set untuk tabel
            const bulan = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
            var format = bulan[element.bulan - 1] + "-" + element.tahun
            $('#dataset_row').append("<tr><td>" + (index + 1) + "</td><td>" + format + "</td><td>" + element.jumlah_kejadian + "</td><td>" + element.normalisasi + "</td></tr>");
          })
        })

      })
    })

    function do_normalisasi() {
      var id = document.getElementById('selected_kabupaten_norm').value;
      $('#dataset_row').html("");
      $.get('{{url("normalisasi_ajax")}}/' + id, function(data) {
        console.log(data)
        $.each(data, function(index, element) {
          //set untuk tabel
          const bulan = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
          var format = bulan[element.bulan - 1] + "-" + element.tahun
          $('#dataset_row').append("<tr><td>" + (index + 1) + "</td><td>" + format + "</td><td>" + element.jumlah_kejadian + "</td><td>" + element.normalisasi + "</td></tr>");
        })
      })
    }

    function do_latih() {

      var id_kab = document.getElementById('selected_kabupaten_latih').value;
      var start_time = document.getElementById('start_time').value;
      var end_time = document.getElementById('end_time').value;

      if (id_kab != "Pilih Kabupaten" && start_time != '' && end_time != '') {
        $('#dataset_row').html("");
        $('#nilai_u').html("");
        $('#nilai_R').html("");
        $('#nilai_K').html("");
        $('#nilai_I').html("");
        $('#mape').html("");
        $.get('{{url("latihAjax")}}/' + id_kab + '/' + start_time + '/' + end_time, function(data) {

          console.log(id_kab);
          console.log(data);




          // $('#nilai_u').append("U = [" + data[3][0] + " , " + data[3][1] + "]") //nilai minimum, dan maximum 
          // $('#nilai_R').append("R = " + data[3][2]) //nilai minimum, dan maximum 
          // $('#nilai_K').append("K = " + data[3][3]) //nilai K
          // $('#nilai_I').append("I = " + data[3][4]) //nilai I 

          // $('#mape').append(parseFloat(data[3]))
          // $.each(data[0], function(index, element) {

          //   //set untuk tabel
          //   var format = (data[0][index])
          //   const bulan = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
          //   $('#dataset_row').append(
          //     "<tr><td>" + (index + 1) + "</td><td>" + format + "</td><td>" + data[1][index] + "</td></tr>"
          //   );


          //   // //set untuk chart
          //   // var data_ = [];
          //   // data_.push(data[1]); // data actual
          //   // data_.push(data[2]); // data prediksi
          //   // var labels = data[0];
          //   // renderChart(data_, labels);

          // });
        });
      } else {
        console.log("kosong")
      }



    }


    $(document).ready(function() {
      //renderChart(0, 0) //set 0 pada load halaman peramalan awal
      $('#do_latih').on('click', function(e) {
        e.preventDefault();
        console.log("sda")
      });

    });
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


</body>

</html>