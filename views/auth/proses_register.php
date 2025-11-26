<?php
session_start();
include "../../model/m_user.php";

$user = new m_user();

$username = $_POST['username'];
$email    = $_POST['email'];
$password = $_POST['password'];

// Cek apakah username sudah dipakai
$cek_username = $user->login_by_username_or_email($username);

if ($cek_username) {
    header("Location: v_register.php?msg=Username sudah digunakan!");
    exit;
}
$cek_email = $user->login_by_username_or_email($email);

if ($cek_email) {
    header("Location: v_register.php?msg= email sudah digunakan!");
    exit;
}

$hasil = $user->tambah_data($username, $email, $password, "pengguna");

if ($hasil) {
    header("Location: v_login.php?msg=Registrasi berhasil! Silakan login.");
} else {
    header("Location: v_register.php?msg=Registrasi gagal.");
}
