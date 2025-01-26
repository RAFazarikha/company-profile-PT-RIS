<?php
session_start();
include '../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    try {
        $id = $_GET['id'];

        // Hapus komentar yang memiliki idArtikel sama dengan id artikel yang akan dihapus
        $queryHapusKomentar = $db->prepare("DELETE FROM coment WHERE idArtikel = :id");
        $queryHapusKomentar->bindParam(':id', $id, PDO::PARAM_INT);

        // Eksekusi query untuk menghapus data komentar
        $queryHapusKomentar->execute();

        // Hapus artikel
        $queryHapusArtikel = $db->prepare("DELETE FROM artikel WHERE id = :id");
        $queryHapusArtikel->bindParam(':id', $id, PDO::PARAM_INT);

        if ($queryHapusArtikel->execute()) {
            echo "<script>
                alert('Data berhasil dihapus');
                window.location.href = '../views/kelola-konten.php';
            </script>";
            exit;
        } else {
            echo "<script>alert('Data gagal dihapus');</script>";
        }
    } catch (PDOException $e) {
        // Menangani error PDO
        echo "<script>alert('Terjadi kesalahan: " . $e->getMessage() . "');</script>";
    }
} else {
    echo "<script>alert('Permintaan tidak valid atau data tidak lengkap');</script>";
}
?>
