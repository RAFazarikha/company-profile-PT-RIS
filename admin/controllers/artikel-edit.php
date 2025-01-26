<?php
session_start();
include '../../config/database.php';

?>

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
                                <form role="form" action="artikel-edit-validasi.php" method="post" enctype="multipart/form-data">
                                <?php
                                try {
                                    $id = $_GET['id'];
                                    $query = $db->prepare("SELECT * FROM artikel WHERE id = :id");
                                    $query->bindParam(':id', $id, PDO::PARAM_INT);
                                    $query->execute();

                                    if ($query->rowCount() > 0) {
                                        $row = $query->fetch(PDO::FETCH_ASSOC);
                                ?>    
                                <!-- Input Title -->
                                    <div class="form-group">
                                        <input type="text" name="id" value="<?php echo htmlspecialchars($row['id']); ?>" hidden/>
                                        <label for="title">Title</label>
                                        <input type="text" name="title" class="form-control" placeholder="Masukkan Judul Artikel" maxlength="255" value="<?php echo htmlspecialchars($row['title']) ?>" required />
                                    </div>

                                    <!-- Input Content -->
                                    <div class="form-group">
                                        <label for="content">Content</label>
                                        <textarea name="content" class="form-control" rows="5" 
                                                placeholder="Masukkan Konten Artikel" 
                                                required><?php echo htmlspecialchars($row['content']) ?></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="gambar">Input Gambar</label>
                                        <input type="file" id="gambar" name="gambar" accept="image/*" required>
                                        <p class="help-block">.png .jpg .jpeg (Maks. 2MB)</p>
                                        <p>File sebelumnya: <?php echo htmlspecialchars($row['namaGambar']); ?></p>
                                        <img src="../../images/<?php echo htmlspecialchars($row['namaGambar']); ?>" alt="Gambar Produk" width="150">
                                    </div>

                                    <!-- Hidden Input for Likes -->
                                    <input type="hidden" name="likes" value="<?php echo htmlspecialchars($row['likes']) ?>">

                                    <!-- Input Author -->
                                    <div class="form-group">
                                        <label for="namaAuthor">Author</label>
                                        <input type="text" name="namaAuthor" class="form-control" placeholder="Masukkan Nama Penulis Artikel" maxlength="255" value="<?php echo htmlspecialchars($row['namaAuthor']) ?>" required />
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="deskripsiAuthor">Description Author</label>
                                        <textarea name="deskripsiAuthor" class="form-control" rows="5" placeholder="Masukkan Konten Artikel" required><?php echo htmlspecialchars($row['deskripsiAuthor']) ?></textarea>
                                    </div>

                                    <!-- Tombol Submit -->
                                    <div class="box-footer">
                                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                <?php 
                                    } else {
                                        echo "<p>Data artikel tidak ditemukan.</p>";
                                    }
                                } catch (PDOException $e) {
                                    echo "<p>Error: " . $e->getMessage() . "</p>";
                                }
                                ?>
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
