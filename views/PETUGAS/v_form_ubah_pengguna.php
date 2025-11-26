<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'petugas') {
    header("Location: ../auth/v_login.php?msg=Akses ditolak");
    exit;
}
?>


<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Form Update User</title>
  <link rel="stylesheet" href="../assets/form_ubah.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

  <div class="form-container">
    <h2>Form Edit User</h2>
   <form action="/PERPUSTAKAAN_kel6/controller/c_user.php?aksi=update" method="POST">
      <div class="form-grid">
        <div class="left-column">
          <input type="hidden" name="id_user" value="<?= $user->id_user ?>">

          <label>Username:</label>
          <input type="text" name="username" value="<?= $user->username ?>" required>

          <label>Email:</label>
          <input type="email" id="email" name="email" value="<?= $user->email ?>" required>

          <label>Password:</label>
          <input type="password" name="password" placeholder="biarkan kosong bila tidak mau diubah">

          <label>Role:</label>
          <input type="text" name="role" value="<?= $user->role ?>" readonly>
        </div>
      </div>

      <div class="submit-button text-center mt-4">
        <button type="submit">Update</button>
      </div>
    </form>
  </div>

</body>

</html>