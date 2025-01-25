<?php
session_start();
include '../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    try {
        $id = $_GET['id'];

        // Persiapan query dengan prepared statements untuk keamanan
        $query = $db->prepare("DELETE FROM produk WHERE id = :id");
        $query->bindParam(':id', $id, PDO::PARAM_INT);

        if ($query->execute()) {
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
