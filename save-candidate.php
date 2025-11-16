<?php
include "config.php";

// Cek apakah mode Edit
$isEdit = isset($_POST['id']) && !empty($_POST['id']);
$id = $isEdit ? (int)$_POST['id'] : null;

// Ambil data form
$nama = $_POST['nama_kandidat'];
$urutan = $_POST['urutan_kandidat'];
$jenis = $_POST['jenis_kandidat'];
$visi = $_POST['visi'];
$misi = $_POST['misi'];

$fotoBaru = null;


// =========================
//   HANDLE UPLOAD FOTO
// =========================
if (!empty($_FILES['foto']['name'])) {

    $file = $_FILES['foto'];
    $maxSize = 10 * 1024 * 1024; // 10 MB

    // Validasi ukuran
    if ($file['size'] > $maxSize) {
        die("Ukuran foto melebihi 10MB!");
    }

    // Validasi ekstensi
    $allowed = ['jpg','jpeg','png','webp'];
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, $allowed)) {
        die("Format foto tidak didukung!");
    }

    // Generate nama file baru
    $fotoBaru = time() . "_" . rand(1000, 9999) . "." . $ext;

    move_uploaded_file($file['tmp_name'], __DIR__ . "/uploads/" . $fotoBaru);

    // Hapus foto lama jika edit
    if ($isEdit) {
        $cek = $conn->query("SELECT foto FROM candidates WHERE id = $id")->fetch_assoc();

        if (!empty($cek['foto'])) {
            $old = __DIR__ . "/uploads/" . $cek['foto'];
            if (file_exists($old)) unlink($old);
        }
    }
}


// =========================
//     INSERT NEW DATA
// =========================
if (!$isEdit) {

    $stmt = $conn->prepare("
        INSERT INTO candidates (nama_kandidat, urutan_kandidat, jenis_kandidat, visi, misi, foto)
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

    header("Location: candidate-data.php?msg=Kandidat berhasil ditambahkan");
    exit;
}


// =========================
//        UPDATE DATA
// =========================
else {

    // Jika tidak upload foto baru → pakai foto lama
    if (!$fotoBaru) {
        $old = $conn->query("SELECT foto FROM candidates WHERE id = $id")->fetch_assoc();
        $fotoBaru = $old['foto'];
    }

    $stmt = $conn->prepare("
        UPDATE candidates SET 
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

    header("Location: candidate-data.php?msg=Kandidat berhasil diperbarui");
    exit;
}

?>