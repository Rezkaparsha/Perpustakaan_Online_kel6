<?php

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'petugas') {
  header("Location: ../../views/auth/v_login.php?msg=Akses ditolak. Silakan login sebagai petugas.");
  exit;
}

include_once __DIR__ . "/../../template/navbar_petugas.php";
include_once __DIR__ . "/../../model/m_buku.php";
include_once __DIR__ . "/../../model/m_user.php";

if (class_exists('m_buku') && class_exists('m_user')) {
  $bukuModel = new m_buku();
  $userModel = new m_user();

  // ambil semua data lalu hitung
  $allBuku = $bukuModel->tampil_buku();
  $allUsers = $userModel->tampil_data();
} else {
  $allBuku = [];
  $allUsers = [];
}

$totalBuku = is_array($allBuku) ? count($allBuku) : 0;
$totalPengguna = is_array($allUsers) ? count($allUsers) : 0;

?>
<!doctype html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard Petugas - Perpustakaan Online</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  <style>
    :root {
      --primary: #0d6efd;
      --secondary: #6c757d;
      --success: #198754;
      --info: #0dcaf0;
      --bg-light: #f1f5f9;
      /* Warna latar belakang yang lebih terang */
    }

    body {
      padding-top: 90px;
      background: var(--bg-light);
      font-family: 'Inter', sans-serif;
    }

    .card-quick {
      border-radius: 16px;
      /* Lebih membulat */
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      /* Bayangan yang lebih dalam */
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      overflow: hidden;
      border: none;
    }

    .card-quick:hover {
      transform: translateY(-5px);
      box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
    }

    .card-stat-book {
      background-color: #e0f2fe;
      color: var(--primary);
    }

    /* Warna biru muda */
    .card-stat-user {
      background-color: #d1fae5;
      color: var(--success);
    }

    /* Warna hijau muda */

    .stat-num {
      font-size: 3rem;
      /* Angka yang lebih besar */
      font-weight: 800;
      line-height: 1;
    }

    .stat-label {
      font-size: 1rem;
      font-weight: 500;
      opacity: 0.8;
      margin-top: 5px;
    }

    .small-note {
      font-size: 0.9rem;
      color: #4b5563;
    }

    .icon-large {
      font-size: 3.5rem;
      opacity: 0.2;
    }

    pre {
      background: #e2e8f0;
      padding: 1rem;
      border-radius: 8px;
      white-space: pre-wrap;
      word-wrap: break-word;
      border: 1px solid #cbd5e1;
      font-size: 0.85rem;
    }

    code {
      color: var(--primary);
      background-color: #eef2ff;
      padding: 2px 5px;
      border-radius: 4px;
    }

    .list-group-item:last-child {
      border-bottom: none;
    }
  </style>
</head>

<body>

  <div class="container">
    <div class="row mb-5">
      <div class="col-12">
        <h2 class="fw-bolder text-dark">Dashboard Petugas</h2>
        <p class="small-note">Selamat datang kembali, <strong><?= htmlspecialchars($_SESSION['username'] ?? 'Petugas') ?></strong>. Ringkasan operasional perpustakaan:</p>
      </div>
    </div>

    <!-- KARTU RINGKASAN DATA -->
    <div class="row g-4 mb-5">

      <!-- Kartu Total Buku -->
      <div class="col-lg-4 col-md-6">
        <div class="card card-quick p-4 card-stat-book">
          <div class="d-flex justify-content-between align-items-start">
            <div>
              <div class="stat-num text-primary"><?= $totalBuku ?></div>
              <div class="stat-label text-primary">Total Buku Tersedia</div>
            </div>
            <i class="fas fa-book-open icon-large text-primary"></i>
          </div>
          <div class="mt-3 pt-3 border-top border-primary border-opacity-25">
            <a href="v_daftar_buku.php" class="text-primary fw-medium text-decoration-none d-block">
              Kelola Daftar Buku <i class="fas fa-arrow-right fa-sm ms-1"></i>
            </a>
          </div>
        </div>
      </div>

      <!-- Kartu Total Pengguna -->
      <div class="col-lg-4 col-md-6">
        <div class="card card-quick p-4 card-stat-user">
          <div class="d-flex justify-content-between align-items-start">
            <div>
              <div class="stat-num text-success"><?= $totalPengguna ?></div>
              <div class="stat-label text-success">Total Akun Pengguna</div>
            </div>
            <i class="fas fa-users icon-large text-success"></i>
          </div>
          <div class="mt-3 pt-3 border-top border-success border-opacity-25">
            <a href="v_daftar_pengguna.php" class="text-success fw-medium text-decoration-none d-block">
              Kelola Daftar Pengguna <i class="fas fa-arrow-right fa-sm ms-1"></i>
            </a>
          </div>
        </div>
      </div>

      <!-- Kartu Tindakan Cepat -->
      <div class="col-lg-4 col-md-12">
        <div class="card card-quick p-4 bg-white">
          <h5 class="mb-3 text-dark fw-bold">Tindakan Cepat</h5>
          <a href="v_tambah_buku.php" class="btn btn-primary btn-lg w-100 mb-2 shadow-sm d-flex align-items-center justify-content-center">
            <i class="fas fa-plus me-2"></i> Tambah Buku Baru
          </a>
          <a href="v_form_tambah_pengguna.php" class="btn btn-outline-secondary btn-lg w-100 d-flex align-items-center justify-content-center">
            <i class="fas fa-user-plus me-2"></i> Tambah Pengguna Baru
          </a>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>