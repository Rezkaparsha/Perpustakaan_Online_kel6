<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'pengguna') {
  header("Location: ../auth/v_login.php?msg=Akses ditolak");
  exit;
}

include_once "../../template/navbar_pengguna.php";
include_once "../../model/m_buku.php";

$bukuModel = new m_buku();
$daftarBuku = $bukuModel->tampil_buku();
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Dashboard Pengguna</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f4f7fc;
      font-family: 'Segoe UI', sans-serif;
    }

    .card {
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .cover-img {
      height: 200px;
      object-fit: cover;
      border-radius: 8px;
    }
  </style>
</head>

<body>

  <div class="container mt-4">
    <h3 class="mb-4">📚 Selamat datang di Perpustakaan Online</h3>

    <div class="row">
      <?php if (!empty($daftarBuku)) : ?>
        <?php foreach ($daftarBuku as $buku) : ?>
          <div class="col-md-4 mb-4">
            <div class="card p-3">
              <?php if ($buku->cover): ?>
                <img src="../../uploads/cover/<?= $buku->cover ?>" class="cover-img mb-3" alt="Cover Buku">
              <?php else: ?>
                <div class="text-muted mb-3 text-center">📕 Tidak ada cover</div>
              <?php endif; ?>

              <h5><?= htmlspecialchars($buku->judul) ?></h5>
              <p class="mb-1"><strong>Penulis:</strong> <?= htmlspecialchars($buku->penulis) ?></p>
              <p class="mb-1"><strong>Penerbit:</strong> <?= htmlspecialchars($buku->penerbit) ?></p>
              <p class="mb-3"><strong>Tahun:</strong> <?= htmlspecialchars($buku->tahun_terbit) ?></p>

              <?php if ($buku->file_pdf): ?>
                <a href="../../uploads/buku/<?= $buku->file_pdf ?>" target="_blank" class="btn btn-primary w-100">📖 Baca Buku</a>
              <?php else: ?>
                <button class="btn btn-secondary w-100" disabled>PDF belum tersedia</button>
              <?php endif; ?>
            </div>
          </div>
        <?php endforeach ?>
      <?php else : ?>
        <div class="col-12 text-center text-muted">
          <p>Belum ada buku tersedia.</p>
        </div>
      <?php endif ?>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>