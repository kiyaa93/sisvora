<?php
require "config.php";

$first = "Fathur";
$middle = "";
$last = "A.";
$nis = "123456";
$birthday = "2007-02-15";
$contact = "0812345678";
$email = "fathur@example.com";
$password = "password123";

// Hash password
$hash = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO login_user (first_name, middle_name, last_name, nis, birthday, contact, email, password)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ssssssss", $first, $middle, $last, $nis, $birthday, $contact, $email, $hash);

if (mysqli_stmt_execute($stmt)) {
    echo "User berhasil ditambahkan!";
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
