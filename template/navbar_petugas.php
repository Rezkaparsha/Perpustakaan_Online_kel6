<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

$role = $_SESSION['role'] ?? 'guest';
$active = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      padding-top: 70px;
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Perpustakaan Online</a>

      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#menu">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="offcanvas offcanvas-end text-bg-dark" id="menu">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title">Menu Petugas</h5>
          <button class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
        </div>

        <div class="offcanvas-body">
          <ul class="navbar-nav">

            <?php if ($role == 'petugas'): ?>

              <li class="nav-item">
                <a class="nav-link <?= ($active == 'v_dasbord_petugas.php') ? 'active' : '' ?>"
                  href="../PETUGAS/v_dasbord_petugas.php">Dashboard</a>
              </li>

              <li class="nav-item">
                <a class="nav-link <?= ($active == 'v_daftar_buku.php') ? 'active' : '' ?>"
                  href="../PETUGAS/v_daftar_buku.php">Daftar Buku</a>
              </li>

              <li class="nav-item">
                <a class="nav-link <?= ($active == 'v_daftar_pengguna.php') ? 'active' : '' ?>"
                  href="../PETUGAS/v_daftar_pengguna.php">Daftar Pengguna</a>
              </li>

              <li class="nav-item">
                <a class="nav-link <?= ($active == 'v_form_tambah_pengguna.php') ? 'active' : '' ?>"
                  href="../PETUGAS/v_form_tambah_pengguna.php">Tambah Pengguna</a>
              </li>

              <li class="nav-item">
                <a class="nav-link text-danger" href="../auth/v_logout.php">Logout</a>
              </li>

            <?php else: ?>
              <!-- Jika bukan petugas -->
              <li class="nav-item">
                <a class="nav-link" href="../views/auth/v_login.php">Login</a>
              </li>
            <?php endif; ?>

          </ul>
        </div>
      </div>
    </div>
  </nav>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>