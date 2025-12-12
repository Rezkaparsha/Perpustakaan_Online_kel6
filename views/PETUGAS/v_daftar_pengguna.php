<?php

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'petugas') {
  header("Location: /PERPUSTAKAAN_kel6/views/auth/v_login.php?msg=Akses ditolak");
  exit;
}

include_once "./template/navbar_petugas.php";
include_once "./model/m_user.php";

$userModel = new m_user();
$users = $userModel->tampil_data();
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Daftar User</title>
  <link rel="stylesheet" href="../assets/daftar_user.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <div class="container mt-4">
    <h4>📋 Daftar User</h4>
    <a href="v_form_tambah_pengguna.php" class="btn btn-primary mb-3">+ Tambah Pengguna</a>

    <table class="table table-bordered table-striped">
      <thead class="text-center">
        <tr>
          <th>No</th>
          <th>Username</th>
          <th>Email</th>
          <th>Role</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($users)) : ?>
          <?php $no = 1;
          foreach ($users as $data) : ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= htmlspecialchars($data->username) ?></td>
              <td><?= htmlspecialchars($data->email) ?></td>
              <td><?= htmlspecialchars($data->role) ?></td>
              <td>
                <a href="/PERPUSTAKAAN_kel6/controller/c_user.php?aksi=edit&id_user=<?= $data->id_user ?>" class="btn btn-warning btn-sm">Edit</a>
                <a href="/PERPUSTAKAAN_kel6/controller/c_user.php?aksi=hapus&id_user=<?= $data->id_user ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus user ini?')">Hapus</a>
              </td>
            </tr>
          <?php endforeach ?>
        <?php else : ?>
          <tr>
            <td colspan="5" class="text-center text-muted">Belum ada data user.</td>
          </tr>
        <?php endif ?>
      </tbody>
    </table>
  </div>
</body>

</html>