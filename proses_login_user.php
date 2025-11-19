<?php
session_start();
require "config.php";

// Cek apakah form mengirim data
if (!isset($_POST['nis']) || !isset($_POST['password'])) {
    die("Form tidak lengkap!");
}

$nis = trim($_POST['nis']);
$password = $_POST['password'];

// Ambil data user berdasarkan NIS
$query = "SELECT * FROM login_user WHERE nis = ? LIMIT 1";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "s", $nis);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($row = mysqli_fetch_assoc($result)) {

    // Cek password hash
    if (password_verify($password, $row['password'])) {

        // Regenerate session ID
        session_regenerate_id(true);

        // Simpan data user ke session
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user_nis'] = $row['nis'];
        $_SESSION['user_name'] = $row['first_name'] . " " . $row['last_name'];

        // Redirect ke dashboard user
        header("Location: dashboarduser.php");
        exit;

    } else {
        echo "Password salah!";
    }

} else {
    echo "NIS tidak ditemukan!";
}
?>
