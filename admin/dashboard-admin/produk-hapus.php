<?php
    session_start();
    include '../../koneksi/koneksi.php';

    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = mysqli_query($connect, "DELETE FROM produk WHERE id = '$id'");

        if ($query) {
            echo "<script>
                alert('Data berhasil dihapus');
                window.location.href = 'kelola-konten.php';
            </script>";
            exit;
        } else {
            echo "<script>alert('Data gagal dihapus');</script>";
        }
    } else {
        echo "<script>alert('Data tidak boleh kosong');</script>";
    }
?>