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
                            </div><!-- /.box-header -->
                            <div class="box-body">
                            <form role="form" action="produk-edit-validasi.php" method="post" enctype="multipart/form-data">
                                <?php
                                    $id = $_GET['id'];
                                    $query = mysqli_query($connect, "SELECT * FROM produk WHERE id = '$id'");
                                    while($row = mysqli_fetch_assoc($query)){
                                ?>
                                <!-- text input -->
                                <div class="form-group">
                                    <input type="text" name="id" value="<?php echo $row['id'] ?>" hidden/>
                                    <label for="nama">Nama</label>
                                    <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama Produk" value="<?php echo $row['namaProduk'] ?>" required/>
                                </div>

                                <!-- textarea -->
                                <div class="form-group">
                                    <label for="deskripsi">Deskripsi</label>
                                    <textarea name="deskripsi" class="form-control" rows="3" placeholder="Masukkan Deskripsi Produk" required><?php echo $row['deskripsi'] ?></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="gambar">Input Gambar</label>
                                    <input type="file" id="gambar" name="gambar" accept="image/*" required>
                                    <p class="help-block">.png .jpg .jpeg (Maks. 2MB)</p>
                                    <p>File sebelumnya: <?php echo $row['namaGambar']; ?></p>
                                    <img src="../../images/<?php echo $row['namaGambar']; ?>" alt="Gambar Produk" width="150">
                                </div>

                                <?php } ?>
                                <div class="box-footer">
                                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                </div>

                            </form>
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

        

    </body>
</html>
