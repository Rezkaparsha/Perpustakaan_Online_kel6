<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$page = $_GET['page'] ?? 'login';
$role = $_SESSION['role'] ?? 'guest';

/* ================= HALAMAN TANPA LOGIN ================= */
if ($page === 'login') {
    include __DIR__ . "/views/auth/v_login.php";
    exit;
}

if ($page === 'login_process') {
    include __DIR__ . "/controller/c_auth.php";
    exit;
}

if ($page === 'register') {
    include __DIR__ . "/views/auth/v_register.php";
    exit;
}

if ($page === 'register_process') {
    include __DIR__ . "/controller/c_auth.php";
    exit;
}

if ($page === 'logout') {
    session_destroy();
    header("Location: index.php?page=login");
    exit;
}

/* ================= PETUGAS ================= */
if ($role === 'petugas') {

    if ($page === 'dashboard') {
        include __DIR__ . "/views/PETUGAS/v_dasbord_petugas.php";
        exit;
    }

    if ($page === 'pengguna') {
        include __DIR__ . "/views/PETUGAS/v_daftar_pengguna.php";
        exit;
    }

    if ($page === 'tambah_pengguna') {
        include __DIR__ . "/views/PETUGAS/v_form_tambah_pengguna.php";
        exit;
    }

    if ($page === 'edit_pengguna') {
        include __DIR__ . "/controller/c_user.php";
        exit;
    }

    if ($page === 'pengguna_process') {
        include __DIR__ . "/controller/c_user.php";
        exit;
    }

     if ($page === 'buku') {
        include __DIR__. "/views/PETUGAS/v_daftar_buku.php";
        exit;
    }

    if ($page === 'tambah_buku') {
        include __DIR__ . "/views/PETUGAS/v_tambah_buku.php";
        exit;
    }

    if ($page === 'ubah_buku') {
        include __DIR__ . "/views/PETUGAS/v_ubah_buku.php";
        exit;
    }

    // ✅ PROSES BUKU
    if ($page === 'buku_process') {
        include __DIR__ . "/controller/c_buku.php";
        exit;
    }
}


/* ================= PENGGUNA ================= */
if ($role === 'pengguna') {

    if ($page === 'dashboard') {
        include __DIR__ . "/views/PENGGUNA/v_dasbord_pengguna.php";
        exit;
    }

    if ($page === 'profil') {
        include __DIR__ . "/views/PENGGUNA/profil_pengguna.php";
        exit;
    }

    if ($page === 'pengguna_process') {
        include __DIR__ . "/controller/c_user.php";
        exit;
    }
}

/* ================= DEFAULT ================= */
if (!isset($_SESSION['role'])) {
    header("Location: index.php?page=login");
    exit;
} else {
    if ($_SESSION['role'] === 'petugas') {
        header("Location: index.php?page=dashboard");
        exit;
    } else {
        header("Location: index.php?page=dashboard");
        exit;
    }
}