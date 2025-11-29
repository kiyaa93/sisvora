<?php
include "config.php";

// Cek Edit atau Insert
$isEdit = isset($_POST['id']) && !empty($_POST['id']);
$id = $isEdit ? (int)$_POST['id'] : null;

$urutan = $_POST['urutan_kandidat'];
$nama_ketua = $_POST['nama_ketua'];
$nama_wakil = $_POST['nama_wakil'];
$visi = $_POST['visi'];
$misi = $_POST['misi'];

// Prepare filename variable
$fotoKetuaBaru = null;
$fotoWakilBaru = null;

$maxSize = 10 * 1024 * 1024; // 10MB
$allowedExt = ['jpg', 'jpeg', 'png', 'webp'];

// === Upload Foto Ketua ===
if (!empty($_FILES['foto_ketua']['name'])) {
    $file = $_FILES['foto_ketua'];
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

    if ($file['size'] > $maxSize) die("Ukuran foto ketua melebihi 10MB!");
    if (!in_array($ext, $allowedExt)) die("Format foto ketua tidak didukung!");

    $fotoKetuaBaru = "ketua_" . time() . "_" . rand(1000, 9999) . "." . $ext;

    move_uploaded_file($file['tmp_name'], __DIR__ . "/uploads/" . $fotoKetuaBaru);

    // Hapus foto lama (edit)
    if ($isEdit) {
        $cek = $conn->query("SELECT foto_ketua FROM candidates_admin WHERE id = $id")->fetch_assoc();
        if ($cek && $cek['foto_ketua']) {
            $old = __DIR__ . "/uploads/" . $cek['foto_ketua'];
            if (file_exists($old)) unlink($old);
        }
    }
}

// === Upload Foto Wakil ===
if (!empty($_FILES['foto_wakil']['name'])) {
    $file = $_FILES['foto_wakil'];
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

    if ($file['size'] > $maxSize) die("Ukuran foto wakil melebihi 10MB!");
    if (!in_array($ext, $allowedExt)) die("Format foto wakil tidak didukung!");

    $fotoWakilBaru = "wakil_" . time() . "_" . rand(1000, 9999) . "." . $ext;

    move_uploaded_file($file['tmp_name'], __DIR__ . "/uploads/" . $fotoWakilBaru);

    // Hapus foto lama (edit)
    if ($isEdit) {
        $cek = $conn->query("SELECT foto_wakil FROM candidates_admin WHERE id = $id")->fetch_assoc();
        if ($cek && $cek['foto_wakil']) {
            $old = __DIR__ . "/uploads/" . $cek['foto_wakil'];
            if (file_exists($old)) unlink($old);
        }
    }
}

// =========================
// INSERT DATA BARU
// =========================
if (!$isEdit) {

    $stmt = $conn->prepare("
        INSERT INTO candidates_admin
        (urutan_kandidat, nama_ketua, nama_wakil, visi, misi, foto_ketua, foto_wakil)
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ");

    $stmt->bind_param("issssss",
        $urutan,
        $nama_ketua,
        $nama_wakil,
        $visi,
        $misi,
        $fotoKetuaBaru,
        $fotoWakilBaru
    );

    $stmt->execute();

    header("Location: candidate-data.php?msg=added");
    exit;
}

// =========================
// UPDATE DATA
// =========================
else {

    // Ambil foto lama jika tidak upload baru
    if (!$fotoKetuaBaru) {
        $getOld = $conn->query("SELECT foto_ketua FROM candidates_admin WHERE id = $id")->fetch_assoc();
        $fotoKetuaBaru = $getOld['foto_ketua'];
    }

    if (!$fotoWakilBaru) {
        $getOld = $conn->query("SELECT foto_wakil FROM candidates_admin WHERE id = $id")->fetch_assoc();
        $fotoWakilBaru = $getOld['foto_wakil'];
    }

    $stmt = $conn->prepare("
        UPDATE candidates_admin SET
            urutan_kandidat = ?,
            nama_ketua = ?,
            nama_wakil = ?,
            visi = ?,
            misi = ?,
            foto_ketua = ?,
            foto_wakil = ?
        WHERE id = ?
    ");

    $stmt->bind_param("issssssi",
        $urutan,
        $nama_ketua,
        $nama_wakil,
        $visi,
        $misi,
        $fotoKetuaBaru,
        $fotoWakilBaru,
        $id
    );

    $stmt->execute();

    header("Location: candidate-data.php?msg=updated&id=$id");
    exit;
}
