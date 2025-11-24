<?php
session_start();
include 'config.php';

// Wajib ada session NIS
if (!isset($_SESSION['voter_nis'])) {
    echo json_encode(["status" => "error", "message" => "Session hilang. Login ulang."]);
    exit;
}

$nis = $_SESSION['voter_nis'];
$candidateID = $_POST['candidate_id'];
$electionID = 1;

// Ambil voter ID dari tabel voters_admin
$q = $conn->prepare("SELECT id, status FROM voters_admin WHERE nis = ?");
$q->bind_param("s", $nis);
$q->execute();
$voter = $q->get_result()->fetch_assoc();

if (!$voter) {
    echo json_encode(["status" => "error", "message" => "Data pemilih tidak ditemukan"]);
    exit;
}

$voterID = $voter['id'];

// Cek kalau sudah vote
if ($voter['status'] === "Voted") {
    echo json_encode(["status" => "error", "message" => "Anda sudah voting"]);
    exit;
}

// Insert vote ke DB
$save = $conn->prepare("
    INSERT INTO votes_admin (voter_id, candidate_id, election_id)
    VALUES (?, ?, ?)
");
$save->bind_param("iii", $voterID, $candidateID, $electionID);

if ($save->execute()) {

    // Update status voter
    $up = $conn->prepare("
        UPDATE voters_admin
        SET status='Voted', voted_at=NOW()
        WHERE id = ?
    ");
    $up->bind_param("i", $voterID);
    $up->execute();

    echo json_encode(["status" => "success"]);

} else {
    echo json_encode(["status" => "error", "message" => "Gagal menyimpan vote"]);
}
?>
