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
                                <h3 class="box-title">Data Artikel</h3>
                            </div>
                            <div class="box-body">
                                <form role="form" action="artikel-tambah-validasi.php" method="post" enctype="multipart/form-data">
                                    <!-- Input Title -->
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input type="text" name="title" class="form-control" 
                                               placeholder="Masukkan Judul Artikel" 
                                               maxlength="255" required />
                                    </div>

                                    <!-- Input Content -->
                                    <div class="form-group">
                                        <label for="content">Content</label>
                                        <textarea name="content" class="form-control" rows="5" 
                                                placeholder="Masukkan Konten Artikel" 
                                                required></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="gambar">Input Gambar</label>
                                        <input type="file" id="gambar" name="gambar" 
                                                accept="image/jpeg, image/png" required>
                                        <p class="help-block">Format yang diperbolehkan: .png, .jpg, .jpeg (Maks. 2MB)</p>
                                    </div>

                                    <!-- Hidden Input for Likes -->
                                    <input type="hidden" name="likes" value="0">

                                    <!-- Input Author -->
                                    <div class="form-group">
                                        <label for="namaAuthor">Author</label>
                                        <input type="text" name="namaAuthor" class="form-control" 
                                                placeholder="Masukkan Nama Penulis Artikel" 
                                                maxlength="255" required />
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="deskripsiAuthor">Description Author</label>
                                        <textarea name="deskripsiAuthor" class="form-control" rows="5" 
                                                placeholder="Masukkan Konten Artikel" 
                                                required></textarea>
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
