<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$role = $_SESSION['role'] ?? 'guest';
$page = $_GET['page'] ?? '';
?>
<nav class="navbar navbar-dark bg-dark fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Perpustakaan Online</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#menuPetugas">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-end text-bg-dark" id="menuPetugas">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title">Menu Petugas</h5>
        <button class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav">
          <?php if ($role === 'petugas'): ?>
            <li class="nav-item">
              <a class="nav-link <?= ($page == 'dashboard_petugas') ? 'active' : '' ?>"
                 href="/PERPUSTAKAAN_kel6/index.php?page=dashboard_petugas">Dashboard</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?= ($page == 'buku') ? 'active' : '' ?>"
                 href="/PERPUSTAKAAN_kel6/index.php?page=buku">Daftar Buku</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?= ($page == 'pengguna') ? 'active' : '' ?>"
                 href="/PERPUSTAKAAN_kel6/index.php?page=pengguna">Daftar Pengguna</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?= ($page == 'tambah_pengguna') ? 'active' : '' ?>"
                 href="/PERPUSTAKAAN_kel6/index.php?page=tambah_pengguna">Tambah Pengguna</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-danger" href="/PERPUSTAKAAN_kel6/index.php?page=logout">Logout</a>
            </li>
          <?php else: ?>
            <li class="nav-item">
              <a class="nav-link" href="/PERPUSTAKAAN_kel6/index.php?page=login">Login</a>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </div>
</nav>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
