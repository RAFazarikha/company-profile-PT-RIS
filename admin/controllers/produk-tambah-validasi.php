<?php
    session_start();
    include '../../config/database.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
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
                    $query = mysqli_query($connect, "INSERT INTO produk (namaProduk, deskripsi, tipe, ukuran, namaGambar) 
                        VALUES ('$nama', '$deskripsi', '$tipe_file', '$ukuran', '$gambar')");

                    if ($query) {
                        echo "<script>
                            alert('Data berhasil ditambahkan');
                            window.location.href = '../views/kelola-konten.php';
                        </script>";
                        exit;
                    } else {
                        echo "<script>alert('Data gagal ditambahkan');</script>";
                    }
                } else {
                    echo "<script>alert('Gambar gagal diupload');</script>";
                }
            } else {
                $message = "Maaf, Ukuran gambar yang diupload tidak boleh lebih dari 3MB";
                echo "<script>alert('$message');</script>";
                header("Location: ../views/kelola-konten.php?message=" . urlencode($message));
                exit;
            }
        } else {
            $message = "Maaf, Tipe gambar yang diupload harus JPG / JPEG / PNG.";
            echo "<script>alert('$message');</script>";
            header("Location: ../views/kelola-konten.php?message=" . urlencode($message));
            exit;
        }
    } else {
        echo "<script>alert('Data tidak boleh kosong');</script>";
    }
?>
