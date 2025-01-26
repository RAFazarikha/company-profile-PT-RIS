<?php
session_start();
include '../../config/database.php';

if (isset($_POST['submit'])) {
    try {
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $deskripsi = $_POST['deskripsi'];
        $gambar = $_FILES['gambar']['name'];
        $ukuran = $_FILES['gambar']['size'];
        $tipe_file = $_FILES['gambar']['type'];
        $tmp = $_FILES['gambar']['tmp_name'];

        $path = "../../images/" . $gambar;

        // Validasi tipe file
        if ($tipe_file == "image/jpeg" || $tipe_file == "image/png") {
            // Validasi ukuran file
            if ($ukuran <= 3000000) { // Maksimal 3MB
                // Pindahkan file ke folder tujuan
                if (move_uploaded_file($tmp, $path)) {
                    // Update data ke database menggunakan prepared statements
                    $query = $db->prepare("UPDATE produk 
                                           SET namaProduk = :nama, 
                                               deskripsi = :deskripsi, 
                                               tipe = :tipe_file, 
                                               ukuran = :ukuran, 
                                               namaGambar = :namaGambar 
                                           WHERE id = :id");
                    $query->bindParam(':nama', $nama);
                    $query->bindParam(':deskripsi', $deskripsi);
                    $query->bindParam(':tipe_file', $tipe_file);
                    $query->bindParam(':ukuran', $ukuran);
                    $query->bindParam(':namaGambar', $gambar);
                    $query->bindParam(':id', $id);

                    if ($query->execute()) {
                        echo "<script>
                            alert('Data berhasil diubah');
                            window.location.href = '../views/kelola-konten.php';
                        </script>";
                        exit;
                    } else {
                        echo "<script>alert('Data gagal diubah');</script>";
                    }
                } else {
                    echo "<script>alert('Gambar gagal diupload');</script>";
                }
            } else {
                $message = "Maaf, ukuran gambar yang diupload tidak boleh lebih dari 3MB.";
                echo "<script>alert('$message');</script>";
                header("Location: ../views/kelola-konten.php?message=" . urlencode($message));
                exit;
            }
        } else {
            $message = "Maaf, tipe gambar yang diupload harus JPG / JPEG / PNG.";
            echo "<script>alert('$message');</script>";
            header("Location: ../views/kelola-konten.php?message=" . urlencode($message));
            exit;
        }
    } catch (PDOException $e) {
        // Menangani error PDO
        echo "<script>alert('Terjadi kesalahan: " . $e->getMessage() . "');</script>";
    }
} else {
    echo "<script>alert('Data tidak boleh kosong');</script>";
}
?>
