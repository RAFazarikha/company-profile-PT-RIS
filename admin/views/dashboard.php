<?php
  session_start();
  if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
      header("Location: ../login.php");
      exit();
  }

  require '../../config/database.php';
// Ambil data pengunjung hari ini
  $query_total_pengunjung = $db->query("SELECT COUNT(*) as total_pengunjung FROM pengunjung ");
  $row_total_pengunjung = $query_total_pengunjung->fetch(PDO::FETCH_ASSOC);
  $pengunjung = $row_total_pengunjung['total_pengunjung'];

  // Ambil data pengunjung hari ini
  $query_pengunjung = $db->query("SELECT COUNT(*) as pengunjung FROM pengunjung WHERE DATE(timestamp) = CURDATE()");
  $row_pengunjung = $query_pengunjung->fetch(PDO::FETCH_ASSOC);
  $pengunjung_hari_ini = $row_pengunjung['pengunjung'];

  // Ambil data form kontak masuk
  $query_form_kontak = $db->query("SELECT COUNT(*) as total_form_kontak FROM kontak WHERE status = 'masuk'");
  $row_form_kontak = $query_form_kontak->fetch(PDO::FETCH_ASSOC);
  $form_kontak_masuk = $row_form_kontak['total_form_kontak'];

   // Ambil data testimoni positif
   $query_testimoni = $db->query("SELECT COUNT(*) as total_testimoni FROM testimoni WHERE status = 'positif'");
   $row_testimoni = $query_testimoni->fetch(PDO::FETCH_ASSOC);
   $testimoni_positif = $row_testimoni['total_testimoni'];

   // Ambil data permintaan bantuan
   $query_bantuan = $db->query("SELECT COUNT(*) as total_bantuan FROM permintaan_bantuan WHERE status = 'pending'");
   $row_bantuan = $query_bantuan->fetch(PDO::FETCH_ASSOC);
   $permintaan_bantuan = $row_bantuan['total_bantuan'];

   // Ambil data pengunjung per bulan untuk grafik
   $query_grafik = $db->query("SELECT MONTH(timestamp) as bulan, COUNT(*) as total_pengunjung FROM pengunjung GROUP BY MONTH(timestamp)");
   $grafik_pengunjung = [];
   $bulan = [];
   while ($row_grafik = $query_grafik->fetch(PDO::FETCH_ASSOC)) {
       $bulan[] = $row_grafik['bulan'];
       $grafik_pengunjung[] = $row_grafik['total_pengunjung'];
   }
?>

<!DOCTYPE html>
<html>
  <?php include '../component/head.php'; ?>
  <body class="skin-blue">
    <div class="wrapper">
      
      <?php include '../component/header.php'; ?>
      <?php include '../component/side-bar.php'; ?>

      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
            <small>Version 2.0</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Ringkasan Statistik -->
          <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="ion ion-ios-people-outline"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Total Pengunjung</span>
                  <span class="info-box-number"><?php echo $pengunjung; ?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->

            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="ion ion-ios-people-outline"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Pengunjung Hari Ini</span>
                  <span class="info-box-number"><?php echo $pengunjung_hari_ini; ?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-green"><i class="ion ion-ios-paper-outline"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Form Kontak Masuk</span>
                  <span class="info-box-number"><?php echo $form_kontak_masuk; ?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->

            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="ion ion-ios-star-outline"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Testimoni Positif</span>
                  <span class="info-box-number"><?php echo $testimoni_positif; ?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->

            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-red"><i class="ion ion-ios-help-outline"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Permintaan Bantuan</span>
                  <span class="info-box-number"><?php echo $permintaan_bantuan; ?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
          </div><!-- /.row -->

          <!-- Grafik Pengunjung -->
          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Grafik Pengunjung</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <!-- <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
                  </div>
                </div>
                <div class="box-body">
                  <canvas id="visitorChart" height="180"></canvas>
                </div>
              </div>
            </div>
          </div>

          <!-- Notifikasi Terbaru -->
          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Notifikasi Terbaru</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <!-- <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
                  </div>
                </div>
                <div class="box-body">
                  <ul class="list-group">
                    <li class="list-group-item">Permintaan informasi dari <strong>John Doe</strong> - <em>10 menit yang lalu</em></li>
                    <li class="list-group-item">Form kontak baru dari <strong>Jane Smith</strong> - <em>30 menit yang lalu</em></li>
                    <li class="list-group-item">Pengajuan kerjasama dari <strong>PT ABC</strong> - <em>1 jam yang lalu</em></li>
                    <li class="list-group-item">Testimoni baru dari <strong>Customer</strong> - <em>2 jam yang lalu</em></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <?php include '../component/footer.php'; ?>

    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.3 -->
    <script src="../plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='../plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/app.min.js" type="text/javascript"></script>
    <!-- Sparkline -->
    <script src="../plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
    <!-- jvectormap -->
    <script src="../plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
    <script src="../plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
    <!-- daterangepicker -->
    <script src="../plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <!-- datepicker -->
    <script src="../plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="../plugins/iCheck/icheck.min.js"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="../plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- ChartJS 2.9.3 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>

    <!-- Skrip untuk Grafik Pengunjung -->
    <script>
    var ctx = document.getElementById('visitorChart').getContext('2d');
    var visitorChart = new Chart(ctx, {
        type: 'line', // Jenis grafik (line chart)
        data: {
            labels: <?php echo json_encode($bulan); ?>, // Label bulan
            datasets: [{
                label: 'Pengunjung',
                data: <?php echo json_encode($grafik_pengunjung); ?>, // Data pengunjung
                backgroundColor: 'rgba(75, 192, 192, 0.2)', // Warna latar belakang grafik
                borderColor: 'rgba(75, 192, 192, 1)', // Warna border grafik
                borderWidth: 1, // Ketebalan border
                fill: true // Mengisi area di bawah garis
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true // Mulai dari nol pada sumbu Y
                    }
                }]
            },
            responsive: true, // Membuat grafik responsif
            maintainAspectRatio: false, // Membuat aspek rasio grafik bisa berubah
        }
    });
    </script>

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="../dist/js/pages/dashboard2.js" type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js" type="text/javascript"></script>

  </body>
</html>