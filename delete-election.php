<?php
require 'db.php';

$id = $_POST['id'];

mysqli_query($conn, "DELETE FROM elections WHERE id = '$id'");
header("Location: election-settings.php?msg=Election deleted!");
?>