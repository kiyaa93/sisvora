<?php
// config.php - Koneksi Database menggunakan MySQLi
$host = 'localhost';
$dbname = 'sisvora_db';
$username = 'root';
$password = '';

// Koneksi MySQLi
$conn = new mysqli($host, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}

// Set charset UTF-8
$conn->set_charset("utf8mb4");
?>