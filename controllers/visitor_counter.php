<?php
require 'config/database.php';

function getUserIP() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        return $_SERVER['REMOTE_ADDR'];
    }
}

$ip_address = getUserIP();
$date_today = date('Y-m-d');

// Periksa apakah IP sudah tercatat hari ini
$query_check = $db->prepare("SELECT id FROM pengunjung WHERE ip_address = :ip_address AND DATE(timestamp) = :date_today");
$query_check->execute(['ip_address' => $ip_address, 'date_today' => $date_today]);

if ($query_check->rowCount() == 0) {
    $query_insert = $db->prepare("INSERT INTO pengunjung (ip_address) VALUES (:ip_address)");
    $query_insert->execute(['ip_address' => $ip_address]);
}
?>
