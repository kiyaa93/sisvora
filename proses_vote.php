<?php
session_start();
include 'config.php';

// Cek login
if (!isset($_SESSION['user_id'])) {
    header("Location: login_user.php");
    exit();
}

// Cek method POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: vote.php");
    exit();
}

// Ambil data dari form
$nis = $_POST['nis'] ?? '';
$voter_name = $_POST['voter_name'] ?? '';
$candidate_name = $_POST['candidate_name'] ?? '';
$verification_code = $_POST['verification_code'] ?? '';
$location = $_POST['location'] ?? '';

// Validasi data
if (empty($nis) || empty($candidate_name) || empty($verification_code)) {
    $_SESSION['error'] = "Data tidak lengkap!";
    header("Location: vote.php");
    exit();
}

// Mulai transaction
mysqli_begin_transaction($conn);

try {
    // 1. Cek apakah data voter sudah ada di voters_admin
    $check_query = "SELECT * FROM voters_admin WHERE nis = ? FOR UPDATE";
    $stmt_check = mysqli_prepare($conn, $check_query);
    mysqli_stmt_bind_param($stmt_check, "s", $nis);
    mysqli_stmt_execute($stmt_check);
    $result_check = mysqli_stmt_get_result($stmt_check);
    $voter = mysqli_fetch_assoc($result_check);

    if ($voter) {
        // Jika sudah ada, cek status
        if ($voter['status'] === 'Voted') {
            throw new Exception("You have already voted!");
        }
        
        // Update data voting
        $update_query = "UPDATE voters_admin 
                        SET status = 'Voted',
                            candidate_name = ?,
                            verification_code = ?,
                            vote_time = NOW(),
                            vote_location = ?
                        WHERE nis = ?";
        $stmt_update = mysqli_prepare($conn, $update_query);
        mysqli_stmt_bind_param($stmt_update, "ssss", $candidate_name, $verification_code, $location, $nis);
        
        if (!mysqli_stmt_execute($stmt_update)) {
            throw new Exception("Failed to update vote!");
        }
    } else {
        // Jika belum ada, insert data baru
        $insert_query = "INSERT INTO voters_admin 
                        (voter_id, nama, nis, status, candidate_name, verification_code, vote_time, vote_location) 
                        VALUES (?, ?, ?, 'Voted', ?, ?, NOW(), ?)";
        
        // Generate voter_id
        $voter_id = 'V' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
        
        $stmt_insert = mysqli_prepare($conn, $insert_query);
        mysqli_stmt_bind_param($stmt_insert, "ssssss", $voter_id, $voter_name, $nis, $candidate_name, $verification_code, $location);
        
        if (!mysqli_stmt_execute($stmt_insert)) {
            throw new Exception("Failed to save vote!");
        }
    }
    
    // Commit transaction
    mysqli_commit($conn);
    
    // Set session untuk bukti voting
    $_SESSION['vote_success'] = true;
    $_SESSION['voted_candidate'] = $candidate_name;
    $_SESSION['verification_code'] = $verification_code;
    $_SESSION['vote_time'] = date('d M Y, H:i') . ' WIB';
    $_SESSION['voter_nis'] = $nis;
    
    // Redirect ke halaman bukti
    header("Location: bukti.php");
    exit();
    
} catch (Exception $e) {
    // Rollback jika error
    mysqli_rollback($conn);
    $_SESSION['error'] = $e->getMessage();
    header("Location: vote.php");
    exit();
}
?>