<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Hanya petugas yang boleh akses
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'petugas') {
    header("Location: /PERPUSTAKAAN_kel6/index.php?page=login&msg=Akses ditolak. Silakan login sebagai petugas.");
    exit;
}

// Pastikan variabel $user sudah dikirim dari controller c_user.php (aksi=edit)
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Form Update User</title>
  <link rel="stylesheet" href="/PERPUSTAKAAN_kel6/assets/form_ubah.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-5">
    <div class="form-container card shadow p-4">
      <h2 class="mb-4 text-center">✏️ Form Edit User</h2>
      <form action="/PERPUSTAKAAN_kel6/controller/c_user.php?aksi=update" method="POST">
        <input type="hidden" name="id_user" value="<?= htmlspecialchars($user->id_user) ?>">

        <div class="mb-3">
          <label class="form-label">Username:</label>
          <input type="text" name="username" class="form-control" value="<?= htmlspecialchars($user->username) ?>" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Email:</label>
          <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($user->email) ?>" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Password:</label>
          <input type="password" name="password" class="form-control" placeholder="Biarkan kosong bila tidak mau diubah">
        </div>

        <div class="mb-3">
          <label class="form-label">Role:</label>
          <input type="text" name="role" class="form-control" value="<?= htmlspecialchars($user->role) ?>" readonly>
        </div>

        <div class="text-center mt-4">
          <button type="submit" class="btn btn-success">Update</button>
          <a href="/PERPUSTAKAAN_kel6/index.php?page=pengguna" class="btn btn-secondary">Batal</a>
        </div>
      </form>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
