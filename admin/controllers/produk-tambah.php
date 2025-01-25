<!DOCTYPE html>
<html>
    <?php include '../component/head.php'; ?>
    <body class="skin-blue">
        <div class="wrapper">
        
        <?php include '../component/header.php'; ?>
        <?php include '../component/side-bar.php'; ?>

        <div class="content-wrapper">
            <section class="content-header">
                <h1>Kelola Konten</h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Kelola Konten</li>
                </ol>
            </section>

            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Data Produk</h3>
                            </div>
                            <div class="box-body">
                                <form role="form" action="produk-tambah-validasi.php" method="post" enctype="multipart/form-data">
                                    <!-- Input Nama Produk -->
                                    <div class="form-group">
                                        <label for="nama">Nama</label>
                                        <input type="text" name="nama" class="form-control" 
                                               placeholder="Masukkan Nama Produk" 
                                               maxlength="100" required />
                                    </div>

                                    <!-- Input Deskripsi -->
                                    <div class="form-group">
                                        <label for="deskripsi">Deskripsi</label>
                                        <textarea name="deskripsi" class="form-control" rows="3" 
                                                  placeholder="Masukkan Deskripsi Produk" 
                                                  maxlength="500" required></textarea>
                                    </div>

                                    <!-- Input Gambar -->
                                    <div class="form-group">
                                        <label for="gambar">Input Gambar</label>
                                        <input type="file" id="gambar" name="gambar" 
                                               accept="image/jpeg, image/png" required>
                                        <p class="help-block">Format yang diperbolehkan: .png, .jpg, .jpeg (Maks. 2MB)</p>
                                    </div>

                                    <!-- Tombol Submit -->
                                    <div class="box-footer">
                                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <?php include '../component/footer.php'; ?>
        </div>
    </body>
</html>
