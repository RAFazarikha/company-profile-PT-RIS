

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
                            <form role="form" action="produk-tambah-validasi.php" method="post" enctype="multipart/form-data">
                                <!-- text input -->
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama Produk" required/>
                                </div>

                                <!-- textarea -->
                                <div class="form-group">
                                    <label for="deskripsi">Deskripsi</label>
                                    <textarea name="deskripsi" class="form-control" rows="3" placeholder="Masukkan Deskripsi Produk" required></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="gambar">Input Gambar</label>
                                    <input type="file" id="gambar" name="gambar" accept="image/*" required>
                                    <p class="help-block">.png .jpg .jpeg (Maks. 2MB)</p>
                                </div>

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
        <?php include 'component/footer.php'; ?>
        </div><!-- ./wrapper -->

        

    </body>
</html>
