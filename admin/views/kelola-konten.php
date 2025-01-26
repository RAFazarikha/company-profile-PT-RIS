<?php
    session_start();
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
        header("Location: ../login.php");
        exit();
    }

    require '../../config/database.php';
?>

<!DOCTYPE html>
<html>
    <?php include '../component/head.php'; ?>
    <body class="skin-blue">
        <div class="wrapper">
        
        <?php include '../component/header.php'; ?>
        <!-- Left side column. contains the logo and sidebar -->
        <?php include '../component/side-bar.php'; ?>

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
                    <!-- Data Produk -->
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Data Produk</h3>
                            <a href="../controllers/produk-tambah.php" class="btn btn-primary pull-right">Tambah</a>
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

                                    try {
                                        $query = $db->query("SELECT * FROM produk");
                                        $no = 1;

                                        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                        <tr>
                                            <td style="width: 4%;">
                                                <?php echo $no++; ?>
                                            </td>
                                            <td style="width: 15%;">
                                                <?php echo htmlspecialchars($row['namaProduk']); ?>
                                            </td>
                                            <td style="width: 36%;">
                                                <?php echo htmlspecialchars($row['deskripsi']); ?>
                                            </td>
                                            <td style="width: 32%;">
                                                <img src="../../images/<?php echo htmlspecialchars($row['namaGambar']); ?>" alt="gambar" width="100">
                                            </td>
                                            <td style="width: 13%;">
                                                <a href="../controllers/produk-edit.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Edit</a>
                                                <a href="../controllers/produk-hapus.php?id=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">Hapus</a>
                                            </td>
                                        </tr>
                                    <?php
                                        }
                                    } catch (PDOException $e) {
                                        echo "<tr><td colspan='5'>Error: " . $e->getMessage() . "</td></tr>";
                                    }
                                    ?>
                                </tbody>
                                <!-- <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Produk</th>
                                        <th>Deskripsi</th>
                                        <th>Gambar</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot> -->
                            </table>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->

                    <!-- Data Blog -->
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Data Artikel</h3>
                            <a href="../controllers/artikel-tambah.php" class="btn btn-primary pull-right">Tambah</a>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <table id="tabel-artikel" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul Artikel</th>
                                        <th>Isi Artikel</th>
                                        <th>Gambar</th>
                                        <th>Detail</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    try {
                                        $query = $db->query("SELECT * FROM artikel");
                                        $no = 1;

                                        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                        <tr>
                                            <td style="width: 4%;">
                                                <?php echo $no++; ?>
                                            </td>
                                            <td style="width: 10%;">
                                                <?php echo htmlspecialchars($row['title']); ?>
                                            </td>
                                            <td style="width: 36%;">
                                                <?php echo htmlspecialchars($row['content']); ?>
                                            </td>
                                            <td style="width: 27%;">
                                                <img src="../../images/<?php echo htmlspecialchars($row['namaGambar']); ?>" alt="gambar" width="100">
                                            </td>
                                            <td style="width: 10%;">
                                                By <?php 
                                                echo htmlspecialchars($row['namaAuthor']); ?> Created at <?php echo htmlspecialchars($row['create_at']); ?>
                                            </td>
                                            <td style="width: 13%;">
                                                <a href="../controllers/artikel-edit.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Edit</a>
                                                <a href="../controllers/artikel-hapus.php?id=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus artikel ini?');">Hapus</a>
                                            </td>
                                        </tr>
                                    <?php
                                        }
                                    } catch (PDOException $e) {
                                        echo "<tr><td colspan='5'>Error: " . $e->getMessage() . "</td></tr>";
                                    }
                                    ?>
                                </tbody>
                                <!-- <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Produk</th>
                                        <th>Deskripsi</th>
                                        <th>Gambar</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot> -->
                            </table>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->


                    <!-- Data Coment -->
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Komentar Masuk</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <table id="tabel-komen" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul Artikel</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Komentar</th>
                                        <th>Detail</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    try {
                                        $query = $db->query("SELECT * FROM coment");
                                        $no = 1;

                                        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                        <tr>
                                            <td style="width: 4%;">
                                                <?php echo $no++; ?>
                                            </td>
                                            <td style="width: 15%;">
                                                <?php 
                                                    $query2 = $db->prepare("SELECT title FROM artikel WHERE id = :id");
                                                    $query2->bindParam(':id', $row['idArtikel']);
                                                    $query2->execute();
                                                    $row2 = $query2->fetch(PDO::FETCH_ASSOC);
                                                    echo htmlspecialchars($row2['title']); ?>
                                            </td>
                                            <td style="width: 10%;">
                                                <?php echo htmlspecialchars($row['nama']); ?>
                                            </td>
                                            <td style="width: 16%;">
                                                <?php echo htmlspecialchars($row['email']); ?>
                                            </td>
                                            <td style="width: 30%;">
                                                <?php echo htmlspecialchars($row['komentar']); ?>
                                            </td>
                                            <td style="width: 15%;">
                                                Created at <?php echo htmlspecialchars($row['create_at']); ?>
                                            </td>
                                            <td style="width: 10%;">
                                                <a href="../controllers/komentar-hapus.php?id=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus komentar ini?');">Hapus</a>
                                            </td>
                                        </tr>
                                    <?php
                                        }
                                    } catch (PDOException $e) {
                                        echo "<tr><td colspan='5'>Error: " . $e->getMessage() . "</td></tr>";
                                    }
                                    ?>
                                </tbody>
                                <!-- <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Produk</th>
                                        <th>Deskripsi</th>
                                        <th>Gambar</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot> -->
                            </table>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->


                </div><!-- /.col -->
            </div><!-- /.row -->
            </section><!-- /.content -->
        </div><!-- /.content-wrapper -->
        <?php include '../component/footer.php'; ?>
        </div><!-- ./wrapper -->

        <!-- jQuery 2.1.3 -->
        <script src="../plugins/jQuery/jQuery-2.1.3.min.js"></script>
        <!-- Bootstrap 3.3.2 JS -->
        <script src="../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- DATA TABES SCRIPT -->
        <script src="../plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="../plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <!-- SlimScroll -->
        <script src="../plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <!-- FastClick -->
        <script src='../plugins/fastclick/fastclick.min.js'></script>
        <!-- AdminLTE App -->
        <script src="../dist/js/app.min.js" type="text/javascript"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="../dist/js/demo.js" type="text/javascript"></script>
        <!-- page script -->
        <script type="text/javascript">
        $(function () {
            $("#tabel-produk").dataTable();
            $("#tabel-artikel").dataTable();
            $("#tabel-komen").dataTable();
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
        <!-- AdminLTE for demo purposes -->
        <script src="../dist/js/demo.js" type="text/javascript"></script>
    </body>
</html>
