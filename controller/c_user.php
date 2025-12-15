<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . "/../model/m_user.php";
$userModel = new m_user();

$aksi = $_GET['aksi'] ?? '';
$base = "index.php";

/* ================= TAMBAH USER ================= */
if ($aksi === 'tambah') {

    $userModel->tambah_data(
        $_POST['username'],
        $_POST['email'],
        $_POST['password'],
        $_POST['role']
    );

    header("Location: $base?page=pengguna");
    exit;
}

/* ================= EDIT USER (AMBIL DATA) ================= */
if ($aksi === 'edit') {

    $id = $_GET['id_user'];
    $user = $userModel->get_user_by_id($id);

    if (!$user) {
        header("Location: $base?page=pengguna");
        exit;
    }

    include __DIR__ . "/../views/PETUGAS/v_form_ubah_pengguna.php";
    exit;
}

/* ================= UPDATE USER ================= */
if ($aksi === 'update') {

    if (empty($_POST['password'])) {
        $userModel->update_user_no_password(
            $_POST['id_user'],
            $_POST['username'],
            $_POST['email'],
            $_POST['role']
        );
    } else {
        $userModel->update_user(
            $_POST['id_user'],
            $_POST['username'],
            $_POST['email'],
            $_POST['password'],
            $_POST['role']
        );
    }

    header("Location: $base?page=pengguna");
    exit;
}

/* ================= HAPUS USER ================= */
if ($aksi === 'hapus') {

    $userModel->hapus_user($_GET['id_user']);
    header("Location: $base?page=pengguna");
    exit;
}

/* ================= UPDATE PROFIL ================= */
if ($aksi === 'update_profil') {

    if (empty($_POST['password'])) {
        $userModel->update_user_no_password(
            $_POST['id_user'],
            $_POST['username'],
            $_POST['email'],
            $_SESSION['role']
        );
    } else {
        $userModel->update_user(
            $_POST['id_user'],
            $_POST['username'],
            $_POST['email'],
            $_POST['password'],
            $_SESSION['role']
        );
    }

    $_SESSION['username'] = $_POST['username'];
    header("Location: $base?page=profil");
    exit;
}