<?php
session_start();
include 'config.php';

// Pastikan session ada
if (!isset($_SESSION['voter_nis'])) {
    echo json_encode(["status" => "error", "message" => "Session hilang, silakan login ulang"]);
    exit;
}

$nis = $_SESSION['voter_nis'];
$candidateID = intval($_POST['candidate_id']);
$electionID = 1;

// Ambil data voter
$q = $conn->prepare("SELECT id, status FROM voters_admin WHERE nis = ?");
$q->bind_param("s", $nis);
$q->execute();
$voter = $q->get_result()->fetch_assoc();

if (!$voter) {
    echo json_encode(["status" => "error", "message" => "Data pemilih tidak ditemukan"]);
    exit;
}

$voterID = $voter['id'];

// Cek apakah sudah voting
if ($voter['status'] === "Voted") {
    echo json_encode(["status" => "error", "message" => "Anda sudah vote"]);
    exit;
}

// Cek validasi kandidat
$checkC = $conn->prepare("SELECT id FROM candidates_admin WHERE id = ?");
$checkC->bind_param("i", $candidateID);
$checkC->execute();
if ($checkC->get_result()->num_rows === 0) {
    echo json_encode(["status" => "error", "message" => "Kandidat tidak valid"]);
    exit;
}

// Simpan vote
$save = $conn->prepare("
    INSERT INTO votes_admin (voter_id, candidate_id, election_id)
    VALUES (?, ?, ?)
");
$save->bind_param("iii", $voterID, $candidateID, $electionID);

if ($save->execute()) {

    $up = $conn->prepare("
        UPDATE voters_admin 
        SET status='Voted', voted_at=NOW() 
        WHERE id = ? LIMIT 1
    ");
    $up->bind_param("i", $voterID);
    $up->execute();

    echo json_encode(["status" => "success"]);

} else {
    echo json_encode(["status" => "error", "message" => "Gagal menyimpan vote"]);
}
?>
