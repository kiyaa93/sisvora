<?php
include 'config.php';

if (!isset($_GET['id'])) {
    echo json_encode(["status" => "error", "message" => "No ID provided"]);
    exit();
}

$id = intval($_GET['id']);

$query = $conn->prepare("SELECT * FROM candidates_admin WHERE id = ?");
$query->bind_param("i", $id);
$query->execute();

$result = $query->get_result();
$data = $result->fetch_assoc();

if (!$data) {
    echo json_encode(["status" => "error", "message" => "Candidate not found"]);
    exit();
}

// BALIKKAN DATA DALAM FORMAT JSON
echo json_encode([
    "status"       => "success",
    "id"           => $data["id"],
    "nama_ketua"   => $data["nama_ketua"],
    "foto_ketua"   => $data["foto_ketua"],
    "nama_wakil"   => $data["nama_wakil"],
    "foto_wakil"   => $data["foto_wakil"],
    "visi"         => $data["visi"],
    "misi"         => nl2br($data["misi"]) // biar linebreak muncul
]);

?>
