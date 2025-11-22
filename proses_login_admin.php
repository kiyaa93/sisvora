<?php
session_start();
require "config.php";

// Cek apakah form mengirim data
if (!isset($_POST['adminID']) || !isset($_POST['adminPass'])) {
    die("Form tidak mengirim data!");
}

$adminID = mysqli_real_escape_string($conn, $_POST['adminID']);
$password = $_POST['adminPass'];

$sql = "SELECT * FROM login_admin WHERE adminID = '$adminID'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);

    // Verifikasi hash
    if (password_verify($password, $row['adminPass'])) {
        $_SESSION['adminID'] = $row['adminID'];
        header("Location: dashboard.php");
        exit;
    } else {
        echo "Password salah!";
    }
} else {
    echo "Admin ID tidak ditemukan!";
}
