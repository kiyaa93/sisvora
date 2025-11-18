<?php
include "config.php";

$isEdit = isset($_POST['id']) && !empty($_POST['id']);
$id = $isEdit ? (int)$_POST['id'] : null;

$nama = $_POST['nama_kandidat'];
$urutan = $_POST['urutan_kandidat'];
$jenis = $_POST['jenis_kandidat'];
$visi = $_POST['visi'];
$misi = $_POST['misi'];

$fotoBaru = null;

// Upload foto
if (!empty($_FILES['foto']['name'])) {

    $file = $_FILES['foto'];
    $maxSize = 10 * 1024 * 1024;

    if ($file['size'] > $maxSize) die("Ukuran foto melebihi 10MB!");

    $allowed = ['jpg','jpeg','png','webp'];
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, $allowed)) die("Format tidak didukung");

    $fotoBaru = time() . "_" . rand(1000,9999) . "." . $ext;

    move_uploaded_file($file['tmp_name'], __DIR__."/uploads/".$fotoBaru);

    // Hapus foto lama jika edit
    if ($isEdit) {
        $cek = $conn->query("SELECT foto FROM candidates_admin WHERE id = $id")->fetch_assoc();
        if ($cek && $cek['foto']) {
            $old = __DIR__."/uploads/".$cek['foto'];
            if (file_exists($old)) unlink($old);
        }
    }
}

// INSERT
if (!$isEdit) {

    $stmt = $conn->prepare("
        INSERT INTO candidates_admin
        (nama_kandidat, urutan_kandidat, jenis_kandidat, visi, misi, foto)
        VALUES (?, ?, ?, ?, ?, ?)
    ");

    $stmt->bind_param("sissss",
        $nama,
        $urutan,
        $jenis,
        $visi,
        $misi,
        $fotoBaru
    );

    $stmt->execute();

    header("Location: candidate-data.php?msg=added");
    exit;
}

// UPDATE
else {

    if (!$fotoBaru) {
        $old = $conn->query("SELECT foto FROM candidates_admin WHERE id=$id")->fetch_assoc();
        $fotoBaru = $old['foto'];
    }

    $stmt = $conn->prepare("
        UPDATE candidates_admin SET
            nama_kandidat = ?,
            urutan_kandidat = ?,
            jenis_kandidat = ?,
            visi = ?,
            misi = ?,
            foto = ?
        WHERE id = ?
    ");

    $stmt->bind_param("sissssi",
        $nama,
        $urutan,
        $jenis,
        $visi,
        $misi,
        $fotoBaru,
        $id
    );

    $stmt->execute();

    $newID = $stmt->insert_id;

    header("Location: candidate-data.php?id=$newID&msg=added");
    exit;

}
