<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Jika sudah login, arahkan sesuai role
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] === 'petugas') {
        header("Location: /PERPUSTAKAAN_kel6/index.php?page=dashboard_petugas");
    } elseif ($_SESSION['role'] === 'pengguna') {
        header("Location: /PERPUSTAKAAN_kel6/index.php?page=dashboard_pengguna");
    }
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Daftar Akun</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(135deg, #74ebd5 0%, #9face6 100%);
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      margin: 0;
    }
    .login-card {
      background: #fff;
      padding: 40px;
      border-radius: 15px;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
      width: 100%;
      max-width: 450px;
      animation: fadeIn 1s ease-in-out;
    }
    .login-title {
      text-align: center;
      font-weight: bold;
      margin-bottom: 25px;
      color: #007BFF;
    }
    .form-control { border-radius: 8px; padding-left: 40px; }
    .input-icon { position: relative; }
    .input-icon i { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #888; }
    .btn-success {
      background: linear-gradient(135deg, #28a745, #218838);
      border: none;
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .btn-success:hover { transform: translateY(-2px); box-shadow: 0 6px 15px rgba(0,0,0,0.2); }
  </style>
</head>
<body>
  <div class="login-card">
    <h3 class="login-title">📝 Daftar Akun Baru</h3>
    <?php if (!empty($_GET['msg'])): ?>
      <div class="alert alert-danger text-center"><?= htmlspecialchars($_GET['msg']); ?></div>
    <?php endif; ?>
    <form action="index.php?page=register_process&aksi=register" method="POST">
      <div class="input-icon mb-3">
        <i class="fa fa-user"></i>
        <input type="text" name="username" class="form-control" placeholder="Username" required>
      </div>
      <div class="input-icon mb-3">
        <i class="fa fa-envelope"></i>
        <input type="email" name="email" class="form-control" placeholder="Email" required>
      </div>
      <div class="input-icon mb-3">
        <i class="fa fa-lock"></i>
        <input type="password" name="password" class="form-control" placeholder="Password" required>
      </div>
      <button type="submit" class="btn btn-success w-100">Daftar</button>
    </form>
    <div class="text-center mt-3">
      <small>Sudah punya akun? <a href="/PERPUSTAKAAN_kel6/index.php?page=login">Login di sini</a></small>
    </div>
  </div>
</body>
</html>
