<?php
session_start();
require "config.php";

$adminID = $_POST['adminID'];
$password = $_POST['adminPass'];

$sql = "SELECT * FROM login_admin WHERE adminID = '$adminID'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);

    // cek password hash
    if (password_verify($password, $row['adminPass'])) {

        // set session
        $_SESSION['adminID'] = $row['adminID'];

        header("Location: dashboard.php");
        exit;
    } else {
        echo "Password salah!";
    }
} else {
    echo "Admin ID tidak ditemukan!";
}
?>
