<?php
session_start();
include 'config/database.php';

if (isset($_POST['like'])) {
    $id = $_POST['like'];

    try {
        // Cek apakah sudah ada data like untuk artikel ini
        $query = $db->prepare("SELECT likes FROM artikel WHERE id = :id");
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            // Tambah like
            $totalLike = $result['likes'] + 1;

            // Update jumlah like di database
            $updateQuery = $db->prepare("UPDATE artikel SET likes = :total_like WHERE id = :id");
            $updateQuery->bindParam(':total_like', $totalLike, PDO::PARAM_INT);
            $updateQuery->bindParam(':id', $id, PDO::PARAM_INT);
            $updateQuery->execute();
        }

        // Redirect kembali ke halaman sebelumnya
        header("Location: single-blog.php?id=" . $id); // Ganti dengan halaman yang sesuai
        exit;
    } catch (PDOException $e) {
        echo "Terjadi kesalahan: " . $e->getMessage();
    }
}
?>
