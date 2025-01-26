<?php
session_start();
include '../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $gambar = $_FILES['gambar']['name'];
    $ukuran = $_FILES['gambar']['size'];
    $tipe_file = $_FILES['gambar']['type'];
    $tmp = $_FILES['gambar']['tmp_name'];
    $likes = $_POST['likes'];
    $namaAuthor = $_POST['namaAuthor'];
    $deskripsiAuthor = $_POST['deskripsiAuthor'];
    $create_at = date('Y-m-d H:i:s');

    $path = "../../images/" . $gambar;

    // Validasi tipe file
    if ($tipe_file == "image/jpeg" || $tipe_file == "image/png") {
        // Validasi ukuran file
        if ($ukuran <= 3000000) { // Maksimal 3MB
            if (move_uploaded_file($tmp, $path)) {
                try {
                    // Menggunakan prepared statement untuk menyimpan data
                    $query = $db->prepare("INSERT INTO artikel (title, content, namaGambar, tipeGambar, ukuranGambar, likes, create_at, namaAuthor, deskripsiAuthor) VALUES (:title, :content, :gambar, :tipe, :ukuran, :likes, :create_at, :namaAuthor, :deskripsiAuthor)");
                    $query->bindParam(':title', $title);
                    $query->bindParam(':content', $content);
                    $query->bindParam(':gambar', $gambar);
                    $query->bindParam(':tipe', $tipe_file);
                    $query->bindParam(':ukuran', $ukuran);
                    $query->bindParam(':likes', $likes);
                    $query->bindParam(':create_at', $create_at);
                    $query->bindParam(':namaAuthor', $namaAuthor);
                    $query->bindParam(':deskripsiAuthor', $deskripsiAuthor);

                    if ($query->execute()) {
                        echo "<script>
                            alert('Data berhasil ditambahkan');
                            window.location.href = '../views/kelola-konten.php';
                        </script>";
                        exit;
                    } else {
                        echo "<script>alert('Data gagal ditambahkan');</script>";
                    }
                } catch (PDOException $e) {
                    echo "<script>alert('Terjadi kesalahan: " . $e->getMessage() . "');</script>";
                }
            } else {
                echo "<script>alert('Gambar gagal diupload');</script>";
            }
        } else {
            $message = "Maaf, ukuran gambar tidak boleh lebih dari 3MB.";
            echo "<script>alert('$message');</script>";
            header("Location: ../views/kelola-konten.php?message=" . urlencode($message));
            exit;
        }
    } else {
        $message = "Maaf, tipe gambar harus JPG / JPEG / PNG.";
        echo "<script>alert('$message');</script>";
        header("Location: ../views/kelola-konten.php?message=" . urlencode($message));
        exit;
    }
} else {
    echo "<script>alert('Data tidak boleh kosong');</script>";
}
?>
