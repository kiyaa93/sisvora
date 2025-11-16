<?php
// db.php
declare(strict_types=1);

define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'sisvora_db');
define('DB_USER', 'root');
define('DB_PASS', ''); // set password jika ada
define('DB_CHARSET', 'utf8mb4');

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
    $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
} catch (PDOException $e) {
    // Jangan tampilkan error detail di production
    echo "Koneksi database gagal: " . htmlspecialchars($e->getMessage());
    exit;
}