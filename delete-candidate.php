<?php
session_start();

require_once 'db.php';

if (empty($_GET['id'])) {
    $_SESSION['error'] = "ID kandidat tidak valid";
    header('Location: candidate-data.php');
    exit;
}

$id = (int)$_GET['id'];

try {
    // Ambil data kandidat untuk mendapatkan nama file foto
    $stmt = $pdo->prepare("SELECT nama_kandidat, foto FROM candidates_admin WHERE id = ?");
    $stmt->execute([$id]);
    $row = $stmt->fetch();

    if ($row) {
        $nama = $row['nama_kandidat'];
        $foto = $row['foto'];
        
        // Hapus file foto jika ada
        if (!empty($foto)) {
            $filePath = __DIR__ . '/uploads/' . $foto;
            if (file_exists($filePath)) {
                @unlink($filePath);
            }
        }

        // Hapus data dari database
        $stmtDel = $pdo->prepare("DELETE FROM candidates_admin WHERE id = ?");
        $stmtDel->execute([$id]);
        
        $_SESSION['success'] = "Kandidat '$nama' berhasil dihapus";
    } else {
        $_SESSION['error'] = "Kandidat tidak ditemukan";
    }
    
} catch(PDOException $e) {
    $_SESSION['error'] = "Error: " . $e->getMessage();
}

header('Location: candidate-data.php');
exit;
?>