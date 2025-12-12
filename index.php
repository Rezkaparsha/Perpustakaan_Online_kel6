<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$page = $_GET['page'] ?? 'home';
$role = $_SESSION['role'] ?? 'guest';

// ----------------- HALAMAN TANPA LOGIN -----------------
if ($page === 'login') {
    include "views/auth/v_login.php";
    exit;
}

if ($page === 'login_process') {
    include "controller/c_auth.php";
    exit;
}

if ($page === 'register') {
    include "views/auth/v_register.php";
    exit;
}

if ($page === 'logout') {
    session_destroy();
    header("Location: /PERPUSTAKAAN_kel6/index.php?page=login&msg=Anda sudah logout");
    exit;
}

// ----------------- HALAMAN PETUGAS -----------------
if ($role === 'petugas') {
    if ($page === 'dashboard_petugas') { include "views/PETUGAS/v_dasbord_petugas.php"; exit; }
    if ($page === 'buku') { include "views/PETUGAS/v_daftar_buku.php"; exit; }
    if ($page === 'tambah_buku') { include "views/PETUGAS/v_tambah_buku.php"; exit; }
    if ($page === 'ubah_buku') { include "views/PETUGAS/v_ubah_buku.php"; exit; }
    if ($page === 'pengguna') { include "views/PETUGAS/v_daftar_pengguna.php"; exit; }
    if ($page === 'tambah_pengguna') { include "views/PETUGAS/v_form_tambah_pengguna.php"; exit; }
}

// ----------------- HALAMAN PENGGUNA -----------------
if ($role === 'pengguna') {
    if ($page === 'dashboard_pengguna') { include "views/PENGGUNA/v_dasbord_pengguna.php"; exit; }
    if ($page === 'profil') { include "views/PENGGUNA/profil_pengguna.php"; exit; }
    if ($page === 'baca') { include "views/PENGGUNA/v_baca_buku.php"; exit; }
}

// ----------------- HALAMAN DEFAULT -----------------
include "views/auth/v_login.php";
exit;
?>
