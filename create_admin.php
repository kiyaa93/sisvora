<?php
require "config.php";

$adminID = "admin_sisvora"; // bebas ganti
$plainPass = "votingbest"; // password baru

$hash = password_hash($plainPass, PASSWORD_DEFAULT);

$sql = "INSERT INTO login_admin (adminID, adminPass) VALUES ('$adminID', '$hash')";

if (mysqli_query($conn, $sql)) {
    echo "Admin berhasil dibuat!<br>";
    echo "Username: $adminID<br>";
    echo "Password: $plainPass<br>";
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
