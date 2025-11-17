<?php
include "config.php";

// Jika Edit Mode
$editData = null;
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $q = $conn->query("SELECT * FROM candidates WHERE id = $id");
    $editData = $q->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Add Candidate</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

<style>
body {
    background: #f7f2e9;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.container-box {
    background: #fff;
    border-radius: 20px;
    padding: 30px;
    margin-top: 20px;
    margin-bottom: 20px;
    border: 2px solid #f0d7bd;
}

.label-title {
    font-weight: 600;
    color: #6c3b16;
}

.form-control, .form-select {
    border-radius: 10px;
    border: 2px solid #e6b48c !important;
}

.upload-box {
    border: 2px dashed #e6b48c;
    border-radius: 15px;
    padding: 30px;
    text-align: center;
    cursor: pointer;
    transition: 0.3s;
}
.upload-box:hover {
    background: #fff7ef;
}

#previewImg {
    width: 180px;
    height: 180px;
    object-fit: cover;
    border-radius: 15px;
    border: 3px solid #e6b48c;
    display: none;
    margin-top: 10px;
}

.actions {
    display: flex;
    justify-content: center;
    gap: 120px;
}

.btn-cancel {
    padding: 10px 25px;
    border: 2px solid #c45a09;
    color: #c45a09;
    background: transparent;
    border-radius: 50px;
    font-weight: bold;
}

.btn-cancel:hover {
    background: rgba(196, 90, 9, 0.08);
}

.btn-submit {
    background: #b04b0f;
    color: white;
    padding: 10px 25px;
    border-radius: 50px;
    font-weight: bold;
}

.btn-submit:hover {
    background: #8d3c0c;
}
</style>

</head>
<body>

<div class="container col-lg-7">
    <div class="container-box">

        <h3 class="fw-bold mb-4">
            <?= $editData ? "Edit Candidate" : "Add Candidate" ?>
        </h3>

        <form action="save-candidate.php" method="POST" enctype="multipart/form-data">

            <!-- Hidden ID for edit -->
            <?php if ($editData): ?>
                <input type="hidden" name="id" value="<?= $editData['id'] ?>">
            <?php endif; ?>

            <div class="row mb-3">
                <div class="col-md-4 label-title">Urutan Kandidat :</div>
                <div class="col-md-8">
                    <input type="number" name="urutan_kandidat" class="form-control"
                           value="<?= $editData['urutan_kandidat'] ?? '' ?>" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 label-title">Nama Kandidat :</div>
                <div class="col-md-8">
                    <input type="text" name="nama_kandidat" class="form-control"
                           value="<?= $editData['nama_kandidat'] ?? '' ?>" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 label-title">Jenis Kandidat :</div>
                <div class="col-md-8 d-flex gap-3 mt-2">
                    <label><input type="radio" name="jenis_kandidat" value="Ketua"
                        <?= isset($editData['jenis_kandidat']) && $editData['jenis_kandidat']=="Ketua" ? "checked" : "" ?> required> Ketua</label>

                    <label><input type="radio" name="jenis_kandidat" value="Wakil Ketua"
                        <?= isset($editData['jenis_kandidat']) && $editData['jenis_kandidat']=="Wakil Ketua" ? "checked" : "" ?>> Wakil Ketua</label>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 label-title">Visi :</div>
                <div class="col-md-8">
                    <input type="text" name="visi" class="form-control"
                           value="<?= $editData['visi'] ?? '' ?>" required>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-4 label-title">Misi :</div>
                <div class="col-md-8">
                    <textarea name="misi" class="form-control" rows="3" required><?= $editData['misi'] ?? '' ?></textarea>
                </div>
            </div>

            <!-- Upload Foto -->
            <div class="mb-4">
                <label class="label-title mb-2">Upload Foto :</label>

                <div class="upload-box" onclick="document.getElementById('fotoInput').click()">
                    <i class="fa-solid fa-upload fs-2" style="color:#b04b0f;"></i>
                    <p class="mt-2">Upload foto maksimal 10MB</p>
                </div>

                <input type="file" id="fotoInput" name="foto" accept="image/*" class="d-none">

                <img id="previewImg"
                     src="<?= $editData && $editData['foto'] ? 'uploads/'.$editData['foto'] : '' ?>"
                     style="<?= $editData && $editData['foto'] ? 'display:block;' : 'display:none;' ?>">
            </div>

            <div class="actions">
                <a href="candidate-data.php" class="btn btn-cancel">CANCEL</a>
                <button class="btn btn-submit">
                    <?= $editData ? "UPDATE" : "UPLOAD" ?>
                </button>
            </div>

        </form>

    </div>
</div>


<script>
// Preview Image
document.getElementById('fotoInput').addEventListener('change', function(e){
    const img = document.getElementById('previewImg');
    img.src = URL.createObjectURL(e.target.files[0]);
    img.style.display = "block";
});
</script>

</body>
</html>