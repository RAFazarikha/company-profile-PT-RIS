<?php
    // Redirect ke halaman login jika belum login
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }

    // Jika sudah login, redirect ke dashboard berdasarkan peran
    if ($_SESSION['role'] === 'admin') {
        header("Location: views/dashboard.php");
    } exit();
?>
