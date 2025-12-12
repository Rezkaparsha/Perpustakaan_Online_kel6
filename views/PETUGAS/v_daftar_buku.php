<?php
// Pastikan session sudah berjalan dan hanya petugas yang boleh mengakses
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'petugas') {
    header("Location: /PERPUSTAKAAN_kel6/index.php?page=login&msg=Akses ditolak. Silakan login sebagai petugas.");
    exit;
}

// include navbar petugas
include_once __DIR__ . "/../../template/navbar_petugas.php";

// include model untuk mengambil data
include_once __DIR__ . "/../../model/m_buku.php";

$bukuModel = new m_buku();
$daftarBuku = $bukuModel->tampil_buku();
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Daftar Buku - Perpustakaan Online</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  <style>
    body { padding-top:90px; background:#f8f9fa; font-family:'Inter',sans-serif; }
    .cover-img { width:60px; height:90px; object-fit:cover; border-radius:4px; box-shadow:0 2px 5px rgba(0,0,0,0.1); }
    .cover-placeholder { width:60px; height:90px; background:#dee2e6; border-radius:4px; display:flex; align-items:center; justify-content:center; color:#6c757d; font-size:1.5rem; }
    .action-btn { margin:4px 5px 4px 0; padding:0.5rem 0.75rem; border-radius:8px; font-size:0.85rem; }
  </style>
</head>
<body>
<div class="container">
  <div class="row mb-4 align-items-center">
    <div class="col-md-8">
      <h2 class="fw-bolder text-dark"><i class="fas fa-book-reader me-2 text-primary"></i> Kelola Koleksi Buku</h2>
      <p class="small text-muted">Daftar lengkap semua buku digital yang tersedia di perpustakaan.</p>
    </div>
    <div class="col-md-4 text-md-end">
      <a href="/PERPUSTAKAAN_kel6/index.php?page=tambah_buku" class="btn btn-primary btn-lg shadow-sm">
        <i class="fas fa-plus me-2"></i> Tambah Buku
      </a>
    </div>
  </div>

  <div class="card">
    <div class="table-responsive">
      <table class="table table-hover align-middle">
        <thead class="table-primary">
          <tr>
            <th>No</th>
            <th>Cover</th>
            <th>Judul Buku</th>
            <th>Penulis</th>
            <th>Penerbit & Tahun</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($daftarBuku)): ?>
            <?php $no=1; foreach ($daftarBuku as $buku): ?>
              <tr>
                <td><?= $no++ ?></td>
                <td>
                  <?php if (!empty($buku->cover)): ?>
                    <img src="/PERPUSTAKAAN_kel6/uploads/cover/<?= htmlspecialchars($buku->cover) ?>"
                         class="cover-img"
                         alt="Cover <?= htmlspecialchars($buku->judul) ?>"
                         onerror="this.onerror=null;this.src='https://placehold.co/60x90/D1E7FF/007bff?text=NO+COVER'">
                  <?php else: ?>
                    <div class="cover-placeholder"><i class="fas fa-image"></i></div>
                  <?php endif; ?>
                </td>
                <td><?= htmlspecialchars($buku->judul) ?></td>
                <td><?= htmlspecialchars($buku->penulis) ?></td>
                <td><?= htmlspecialchars($buku->penerbit) ?> (<?= htmlspecialchars($buku->tahun_terbit) ?>)</td>
                <td>
                  <?php if (!empty($buku->file_pdf)): ?>
                    <a href="/PERPUSTAKAAN_kel6/uploads/buku/<?= htmlspecialchars($buku->file_pdf) ?>" target="_blank"
                       class="btn btn-info action-btn text-white"><i class="fas fa-eye"></i> Baca</a>
                  <?php else: ?>
                    <button class="btn btn-secondary action-btn" disabled><i class="fas fa-ban"></i> Tidak ada PDF</button>
                  <?php endif; ?>
                  <a href="/PERPUSTAKAAN_kel6/controller/c_buku.php?aksi=edit&id_buku=<?= $buku->id_buku ?>"
                     class="btn btn-warning action-btn text-dark"><i class="fas fa-edit"></i> Edit</a>
                  <a href="/PERPUSTAKAAN_kel6/controller/c_buku.php?aksi=hapus&id_buku=<?= $buku->id_buku ?>"
                     onclick="return confirm('Apakah Anda yakin ingin menghapus buku ini?');"
                     class="btn btn-danger action-btn"><i class="fas fa-trash-alt"></i> Hapus</a>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="6" class="text-center p-5">
                <div class="text-muted">Belum ada buku dalam koleksi ini.</div>
              </td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
    <?php if (!empty($daftarBuku)): ?>
      <div class="card-footer text-end small text-muted">
        Total data buku: <?= count($daftarBuku) ?>
      </div>
    <?php endif; ?>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
