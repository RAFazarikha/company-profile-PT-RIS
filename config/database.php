<?php
    try {
        // Konfigurasi database
        $host = 'localhost';       // Host server
        $dbname = 'pt-ris';    // Nama database
        $username = 'root';        // Username database
        $password = '';            // Password database

        // Membuat koneksi database menggunakan PDO
        $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);

        // Mengatur mode error PDO
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        // Menampilkan pesan error jika koneksi gagal
        die("Koneksi database gagal: " . $e->getMessage());
    }
?>
