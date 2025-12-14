<?php
// Aktifkan error reporting untuk debug (sementara)
ini_set('display_errors', 1);
error_reporting(E_ALL);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$page = $_GET['page'] ?? 'home';
$role = $_SESSION['role'] ?? 'guest';

// ----------------- HALAMAN TANPA LOGIN -----------------
if ($page === 'login') {
    include __DIR__ . "/views/auth/v_login.php";
    exit;
}

if ($page === 'login_process') {
    include __DIR__ . "/controller/c_auth.php"; // handle aksi=login
    exit;
}

if ($page === 'register') {
    include __DIR__ . "/views/auth/v_register.php";
    exit;
}

if ($page === 'register_process') {
    include __DIR__ . "/controller/c_auth.php"; // handle aksi=register
    exit;
}

if ($page === 'logout') {
    if (session_status() === PHP_SESSION_ACTIVE) {
        session_unset();   // hapus semua variabel session
        session_destroy(); // hancurkan session
    }
    header("Location: index.php?page=login&msg=Anda sudah logout");
    exit;
}


// ----------------- HALAMAN PETUGAS -----------------
if ($role === 'petugas') {
    if ($page === 'dashboard_petugas') { include __DIR__ . "/views/PETUGAS/v_dasbord_petugas.php"; exit; }
    if ($page === 'buku') { include __DIR__ . "/views/PETUGAS/v_daftar_buku.php"; exit; }
    if ($page === 'tambah_buku') { include __DIR__ . "/views/PETUGAS/v_tambah_buku.php"; exit; }
    if ($page === 'ubah_buku') { include __DIR__ . "/views/PETUGAS/v_ubah_buku.php"; exit; }
    if ($page === 'pengguna') { include __DIR__ . "/views/PETUGAS/v_daftar_pengguna.php"; exit; }
    if ($page === 'tambah_pengguna') { include __DIR__ . "/views/PETUGAS/v_form_tambah_pengguna.php"; exit; }
    if ($page === 'ubah_pengguna') { include __DIR__ . "/views/PETUGAS/v_form_ubah_pengguna.php"; exit; }
}

// ----------------- HALAMAN PENGGUNA -----------------
if ($role === 'pengguna') {
    if ($page === 'dashboard_pengguna') { include __DIR__ . "/views/PENGGUNA/v_dasbord_pengguna.php"; exit; }
    if ($page === 'profil') { include __DIR__ . "/views/PENGGUNA/profil_pengguna.php"; exit; }
    if ($page === 'baca') { include __DIR__ . "/views/PENGGUNA/v_baca_buku.php"; exit; }
}

// ----------------- HALAMAN DEFAULT -----------------
include __DIR__ . "/views/auth/v_login.php";
exit;
