<?php
    session_start();
    include '../../koneksi/koneksi.php';
?>

<!DOCTYPE html>
<html>
    <?php include 'component/head.php'; ?>
    <body class="skin-blue">
        <div class="wrapper">
        
        <?php include 'component/header.php'; ?>
        <!-- Left side column. contains the logo and sidebar -->
        <?php include 'component/side-bar.php'; ?>

        <!-- Right side column. Contains the navbar and content of the page -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
            <h1>
                Kelola Konten
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Kelola Konten</li>
            </ol>
            </section>

            <!-- Main content -->
            <section class="content">
            <div class="row">
                <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Data Produk</h3>
                        <a href="produk-tambah.php" class="btn btn-primary pull-right">Tambah</a>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                    <table id="tabel-produk" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Produk</th>
                                <th>Deskripsi</th>
                                <th>Gambar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no = 1;
                                $query = mysqli_query($connect, "SELECT * FROM produk");
                                while ($row = mysqli_fetch_assoc($query)) {
                            ?>
                                <tr>
                                    <td style="width: 4%;">
                                        <?php echo $no++; ?>
                                    </td>
                                    <td style="width: 15%;">
                                        <?php echo $row['namaProduk']; ?>
                                    </td>
                                    <td style="width: 36%;">
                                        <?php echo $row['deskripsi']; ?>
                                    </td>
                                    <td style="width: 32%;">
                                        <img src="../../images/<?php echo $row['namaGambar']; ?>" alt="gambar" width="100">
                                    </td>
                                    <td style="width: 13%;">
                                        <a href="produk-edit.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Edit</a>
                                        <a href="produk-hapus.php?id=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">Hapus</a>
                                    </td>
                                </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Nama Produk</th>
                                <th>Deskripsi</th>
                                <th>Gambar</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                    </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
                </div><!-- /.col -->
            </div><!-- /.row -->
            </section><!-- /.content -->
        </div><!-- /.content-wrapper -->
        <footer class="main-footer">
            <div class="pull-right hidden-xs">
            <b>Version</b> 2.0
            </div>
            <strong>Copyright &copy; 2014-2015 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights reserved.
        </footer>
        </div><!-- ./wrapper -->

        <!-- jQuery 2.1.3 -->
        <script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
        <!-- Bootstrap 3.3.2 JS -->
        <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- DATA TABES SCRIPT -->
        <script src="plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <!-- SlimScroll -->
        <script src="plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <!-- FastClick -->
        <script src='plugins/fastclick/fastclick.min.js'></script>
        <!-- AdminLTE App -->
        <script src="dist/js/app.min.js" type="text/javascript"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="dist/js/demo.js" type="text/javascript"></script>
        <!-- page script -->
        <script type="text/javascript">
        $(function () {
            $("#tabel-produk").dataTable();
            $('#example2').dataTable({
            "bPaginate": true,
            "bLengthChange": false,
            "bFilter": false,
            "bSort": true,
            "bInfo": true,
            "bAutoWidth": false
            });
        });
        </script>

    </body>
</html>
