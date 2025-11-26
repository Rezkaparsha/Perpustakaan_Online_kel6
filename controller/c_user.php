<?php
include_once __DIR__ . "/../model/m_user.php";

$userModel = new m_user();

//Tampilkan semua data pengguna (dipakai oleh v_daftar_pengguna.php)
if (!isset($_GET['aksi'])) {
    $users = $userModel->tampil_data();
    return;
}

// Tambah pengguna
if ($_GET['aksi'] == "tambah") {
    $username = $_POST['username'];
    $email    = $_POST['email'];
    $password = $_POST['password'];
    $role     = $_POST['role'];

    $result = $userModel->tambah_data($username, $email, $password, $role);

    echo "<script>alert('" . ($result ? "Pengguna berhasil ditambahkan" : "Gagal menambah pengguna") . "');
          window.location='/PERPUSTAKAAN_kel6/views/PETUGAS/v_daftar_pengguna.php';</script>";
    exit;
}

// Edit pengguna 
if ($_GET['aksi'] == "edit") {
    if (!isset($_GET['id_user'])) {
        echo "<script>alert('ID pengguna tidak ditemukan');
              window.location='/PERPUSTAKAAN_kel6/views/PETUGAS/v_daftar_pengguna.php';</script>";
        exit;
    }

    $id_user = $_GET['id_user'];
    $user = $userModel->tampil_data_by_id($id_user);

    include __DIR__ . "/../views/PETUGAS/v_form_ubah_pengguna.php";
    exit;
}

//  Update pengguna
if ($_GET['aksi'] == "update") {
    $id_user  = $_POST['id_user'];
    $username = $_POST['username'];
    $email    = $_POST['email'];
    $role     = $_POST['role'];
    $password = !empty($_POST['password']) ? $_POST['password'] : null;

    $result = $userModel->ubah_data($id_user, $username, $email, $role, $password);

    echo "<script>alert('Data " . ($result ? "berhasil" : "gagal") . " diubah');
          window.location='/PERPUSTAKAAN_kel6/views/PETUGAS/v_daftar_pengguna.php';</script>";
    exit;
}

//  Hapus pengguna
if ($_GET['aksi'] == "hapus") {
    if (!isset($_GET['id_user'])) {
        echo "<script>alert('ID pengguna tidak ditemukan');
              window.location='/PERPUSTAKAAN_kel6/views/PETUGAS/v_daftar_pengguna.php';</script>";
        exit;
    }

    $id_user = $_GET['id_user'];
    $result = $userModel->hapus_data($id_user);

    echo "<script>alert('Pengguna " . ($result ? "berhasil" : "gagal") . " dihapus');
          window.location='/PERPUSTAKAAN_kel6/views/PETUGAS/v_daftar_pengguna.php';</script>";
    exit;
}

// Update profil pengguna (khusus pengguna login)
if ($_GET['aksi'] == "update_profil") {
    $id_user  = $_POST['id_user'];
    $username = $_POST['username'];
    $email    = $_POST['email'];
    $password = !empty($_POST['password']) ? $_POST['password'] : null;

    // Role tidak diubah karena tetap "pengguna"
    $result = $userModel->ubah_data($id_user, $username, $email, 'pengguna', $password);

    echo "<script>alert('Profil berhasil diperbarui');
          window.location='/PERPUSTAKAAN_kel6/views/PENGGUNA/dasbord_pengguna.php';</script>";
    exit;
}
