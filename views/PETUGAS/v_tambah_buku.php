<?php

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'petugas') {
    header("Location: ../auth/v_login.php");
    exit;
}

include_once "./template/navbar_petugas.php";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h3>➕ Tambah Buku</h3>

    <form method="POST" action="../../controller/c_buku.php?aksi=tambah" enctype="multipart/form-data">
    <div class="mb-3">
        <label>Judul</label>
        <input type="text" name="judul" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Penulis</label>
        <input type="text" name="penulis" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Penerbit</label>
        <input type="text" name="penerbit" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Tahun Terbit</label>
        <input type="number" name="tahun_terbit" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Cover</label>
        <input type="file" name="cover" class="form-control" accept="image/*" required>
    </div>
    <div class="mb-3">
        <label>File PDF</label>
        <input type="file" name="file_pdf" class="form-control" accept="application/pdf" required>
    </div>
    <button type="submit" class="btn btn-success">Simpan</button>
</form>
</div>
</body>
</html>
