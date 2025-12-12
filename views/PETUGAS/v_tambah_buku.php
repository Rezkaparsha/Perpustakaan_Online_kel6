<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Hanya petugas yang boleh akses
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'petugas') {
    header("Location: /PERPUSTAKAAN_kel6/index.php?page=login&msg=Akses ditolak. Silakan login sebagai petugas.");
    exit;
}

// Navbar petugas
include_once __DIR__ . "/../../template/navbar_petugas.php";
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
    <h3 class="mb-4">➕ Tambah Buku</h3>

    <!-- Form tambah buku -->
    <form method="POST" action="/PERPUSTAKAAN_kel6/controller/c_buku.php?aksi=tambah" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">Judul</label>
            <input type="text" name="judul" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Penulis</label>
            <input type="text" name="penulis" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Penerbit</label>
            <input type="text" name="penerbit" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Tahun Terbit</label>
            <input type="number" name="tahun_terbit" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Cover</label>
            <input type="file" name="cover" class="form-control" accept="image/*" required>
        </div>
        <div class="mb-3">
            <label class="form-label">File PDF</label>
            <input type="file" name="file_pdf" class="form-control" accept="application/pdf" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="/PERPUSTAKAAN_kel6/index.php?page=buku" class="btn btn-secondary">Batal</a>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
