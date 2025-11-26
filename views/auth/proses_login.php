<?php
session_start();
include "../../model/m_user.php";

$user = new m_user();

$login = $_POST['login'];
$password = $_POST['password'];

// ambil data user dari database
$data = $user->login_by_username_or_email($login);

if (!$data) {
    header("Location: v_login.php?msg=Username tidak ditemukan");
    exit;
}

// cek password
if (!password_verify($password, $data->password)) {
    header("Location: v_login.php?msg=Password salah");
    exit;
}

// jika login sukses
$_SESSION['id_user'] = $data->id_user;
$_SESSION['username'] = $data->username;
$_SESSION['role'] = $data->role;

// arahkan sesuai role
if ($data->role == 'petugas') {
    header("Location: ../PETUGAS/v_dasbord_petugas.php");
} else {
    header("Location: ../PENGGUNA/dasbord_pengguna.php");
}
exit;
