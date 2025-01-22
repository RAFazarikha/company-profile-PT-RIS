<?php
    session_start();
    include '../../koneksi/koneksi.php';
    
    if(isset($_POST['submit'])){
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $deskripsi = $_POST['deskripsi'];
        $gambar = $_FILES['gambar']['name'];
        $ukuran = $_FILES['gambar']['size'];
        $tipe_file = $_FILES['gambar']['type'];
        $tmp = $_FILES['gambar']['tmp_name'];

        $path = "../../images/".$gambar;

        if ($tipe_file == "image/jpeg" || $tipe_file == "image/png") {
            if ($ukuran <= 3000000) { // Maksimal 3MB
                if (move_uploaded_file($tmp, $path)) {
                    $query = mysqli_query($connect, "UPDATE produk SET namaProduk = '$nama', deskripsi = '$deskripsi', tipe = '$tipe_file', ukuran = '$ukuran', namaGambar = '$gambar' WHERE id = '$id'");

                    if ($query) {
                        echo "<script>
                            alert('Data berhasil diubah');
                            window.location.href = 'kelola-konten.php';
                        </script>";
                        exit;
                    } else {
                        echo "<script>alert('Data gagal diubah');</script>";
                    }
                } else {
                    echo "<script>alert('Gambar gagal diupload');</script>";
                }
            } else {
                $message = "Maaf, Ukuran gambar yang diupload tidak boleh lebih dari 3MB";
                echo "<script>alert('$message');</script>";
                header("Location: kelola-konten.php?message=" . urlencode($message));
                exit;
            }
        } else {
            $message = "Maaf, Tipe gambar yang diupload harus JPG / JPEG / PNG.";
            echo "<script>alert('$message');</script>";
            header("Location: kelola-konten.php?message=" . urlencode($message));
            exit;
        }
    } else {
        echo "<script>alert('Data tidak boleh kosong');</script>";
    }
?>