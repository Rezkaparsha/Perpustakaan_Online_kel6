<?php
// ================= SESSION =================
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ================= LOAD MODEL =================
require_once __DIR__ . "/../model/m_user.php";

class c_auth {

    private $model;

    public function __construct() {
        $this->model = new m_user();
    }

    // ================= LOGIN =================
    public function login($login, $password) {

        if (empty($login) || empty($password)) {
            return "Data login tidak lengkap!";
        }

        $user = $this->model->login_by_username_or_email($login);

        if (!$user) {
            return "Username atau Email tidak ditemukan!";
        }

        if (!password_verify($password, $user->password)) {
            return "Password salah!";
        }

        // SIMPAN SESSION
        $_SESSION['id_user']  = $user->id_user;
        $_SESSION['username'] = $user->username;
        $_SESSION['role']     = $user->role;

        return "success";
    }

    // ================= REGISTER =================
    public function register($username, $email, $password) {

        if (empty($username) || empty($email) || empty($password)) {
            return "Data tidak lengkap!";
        }

        $cekUser  = $this->model->login_by_username_or_email($username);
        $cekEmail = $this->model->login_by_username_or_email($email);

        if ($cekUser) {
            return "Username sudah dipakai!";
        }

        if ($cekEmail) {
            return "Email sudah dipakai!";
        }

        $query = $this->model->tambah_data($username, $email, $password, "pengguna");

        return $query ? "success" : "Gagal mendaftar!";
    }

    // ================= LOGOUT =================
    public function logout() {
        session_unset();
        session_destroy();

        header("Location: /PERPUSTAKAAN_kel6/index.php?page=login&msg=Anda sudah logout");
        exit;
    }
}

// ===================================================
// ================== HANDLER LOGIN ==================
// ===================================================
if (isset($_GET['aksi']) && $_GET['aksi'] === "login") {

    $auth = new c_auth();

    $login    = $_POST['login'] ?? '';
    $password = $_POST['password'] ?? '';

    $result = $auth->login($login, $password);

    if ($result === "success") {

        if ($_SESSION['role'] === 'petugas') {
            header("Location: /PERPUSTAKAAN_kel6/index.php?page=dashboard_petugas");
        } else {
            header("Location: /PERPUSTAKAAN_kel6/index.php?page=dashboard_pengguna");
        }
        exit;

    } else {
        header("Location: /PERPUSTAKAAN_kel6/index.php?page=login&msg=" . urlencode($result));
        exit;
    }
}

// ===================================================
// ================= HANDLER REGISTER =================
// ===================================================
if (isset($_GET['aksi']) && $_GET['aksi'] === "register") {

    $auth = new c_auth();

    $username = $_POST['username'] ?? '';
    $email    = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $result = $auth->register($username, $email, $password);

    if ($result === "success") {
        header("Location: /PERPUSTAKAAN_kel6/index.php?page=login&msg=Registrasi berhasil, silakan login");
    } else {
        header("Location: /PERPUSTAKAAN_kel6/index.php?page=register&msg=" . urlencode($result));
    }
    exit;
}
