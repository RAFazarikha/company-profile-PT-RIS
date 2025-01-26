<?php
session_start();
include 'config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $idArtikel = $_POST['idArtikel'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $komentar = $_POST['komentar'];
    $create_at = date('Y-m-d H:i:s');

                try {
                    // Menggunakan prepared statement untuk menyimpan data
                    $query = $db->prepare("INSERT INTO coment (nama, email, komentar, create_at, idArtikel) VALUES (:nama, :email, :komentar, :create_at, :idArtikel)");
                    $query->bindParam(':nama', $nama);
                    $query->bindParam(':email', $email);
                    $query->bindParam(':komentar', $komentar);
                    $query->bindParam(':create_at', $create_at);
                    $query->bindParam(':idArtikel', $idArtikel);

                    if ($query->execute()) {
                        echo "<script>
                            alert('Komentar berhasil ditambahkan');
                            window.location.href = 'single-blog.php?id=" . $idArtikel . "';
                        </script>";
                        exit;
                    } else {
                        echo "<script>alert('komentar gagal ditambahkan');</script>";
                    }
                } catch (PDOException $e) {
                    echo "<script>alert('Terjadi kesalahan: " . $e->getMessage() . "');</script>";
                }

} else {
    echo "<script>alert('Komentar tidak boleh kosong');</script>";
}
?>
