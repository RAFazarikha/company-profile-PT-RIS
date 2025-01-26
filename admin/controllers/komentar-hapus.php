<?php
session_start();
include '../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    try {
        $id = $_GET['id'];

        // Hapus komentar yang memiliki idArtikel sama dengan id artikel yang akan dihapus
        $queryHapusKomentar = $db->prepare("DELETE FROM coment WHERE id = :id");
        $queryHapusKomentar->bindParam(':id', $id, PDO::PARAM_INT);

        if ($queryHapusKomentar->execute()) {
            echo "<script>
                alert('Komentar berhasil dihapus');
                window.location.href = '../views/kelola-konten.php';
            </script>";
            exit;
        } else {
            echo "<script>alert('Komentar gagal dihapus');</script>";
        }
    } catch (PDOException $e) {
        // Menangani error PDO
        echo "<script>alert('Terjadi kesalahan: " . $e->getMessage() . "');</script>";
    }
} else {
    echo "<script>alert('Permintaan tidak valid atau data tidak lengkap');</script>";
}
?>
