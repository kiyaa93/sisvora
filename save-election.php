<?php
require "db.php";

$name   = $_POST['election_name'];
$period = $_POST['period'];
$start  = $_POST['start_time'];
$end    = $_POST['end_time'];
$status = $_POST['status'];

$query = "INSERT INTO elections (election_name, period, start_time, end_time, status) 
          VALUES ('$name', '$period', '$start', '$end', '$status')";

if(mysqli_query($conn, $query)) {
    header("Location: election-settings.php?msg=Election added successfully!");
} else {
    echo "Failed: " . mysqli_error($conn);
}
?>