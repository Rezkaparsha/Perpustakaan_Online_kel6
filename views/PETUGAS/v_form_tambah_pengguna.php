<?php
include_once __DIR__ . "/../../template/navbar_petugas.php";
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Form Tambah Pengguna</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../../assets/form_tambah.css">
<style>
    * {
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f2f2f2;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      margin: 0;
      padding-top: 70px;
    }

    .form-container {
      background-color: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 6px 20px rgba(0,0,0,0.1);
      width: 100%;
      max-width: 800px;
    }

    h2 {
      text-align: center;
      margin-bottom: 25px;
      color: #333;
    }

    .form-grid {
      display: flex;
      gap: 30px;
      flex-wrap: wrap;
    }

    .left-column, .right-column {
      flex: 1;
      min-width: 300px;
    }

    label {
      display: block;
      margin-bottom: 6px;
      color: #333;
      font-weight: 500;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"],
    input[type="date"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 16px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 14px;
    }

    .radio-group {
      display: flex;
      gap: 20px;
      margin-bottom: 16px;
    }

    input[type="radio"] {
      width: auto;
      margin-right: 6px;
    }

    .submit-button {
      text-align: center;
      margin-top: 30px;
    }

    button {
      background-color: #007BFF;
      color: white;
      padding: 12px 30px;
      font-size: 16px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    button:hover {
      background-color: #0056b3;
    }

    @media (max-width: 700px) {
      .form-grid {
        flex-direction: column;
      }
    }
</style>
</head>
<body>
  <div class="form-container">
    <h2>Form Tambah Pengguna</h2>
    <!-- Arahkan ke index.php agar routing bisa jalan -->
    <form method="POST" action="index.php?page=pengguna_process&aksi=tambah">
      <div class="form-grid">
        <div class="left-column">
          <input type="text" name="id_user" hidden>

          <label for="username">Username:</label>
          <input type="text" id="username" name="username" required>

          <label for="email">Email:</label>
          <input type="email" id="email" name="email" required>

          <label for="password">Password:</label>
          <input type="password" id="password" name="password" required>

          <label for="role">Role:</label>
          <input type="text" id="role" name="role" value="pengguna" readonly>
        </div>
      </div>
      <div class="submit-button">
        <button type="submit">Daftar</button>
      </div>
    </form>
  </div>
</body>
</html>
