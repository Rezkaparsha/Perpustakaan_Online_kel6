<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . "/../model/m_user.php";

class c_auth {
    private $model;

    public function __construct() {
        $this->model = new m_user();
    }

    public function login($login, $password) {
        $user = $this->model->login_by_username_or_email($login);
        if (!$user) return "Username atau Email tidak ditemukan!";
        if (!password_verify($password, $user->password)) return "Password salah!";

        $_SESSION['id_user']   = $user->id_user;
        $_SESSION['username']  = $user->username;
        $_SESSION['role']      = $user->role;

        return "success";
    }

    public function register($username, $email, $password) {
        $cekUser  = $this->model->login_by_username_or_email($username);
        $cekEmail = $this->model->login_by_username_or_email($email);
        if ($cekUser) return "Username sudah dipakai!";
        if ($cekEmail) return "Email sudah dipakai!";

        $query = $this->model->tambah_data($username, $email, $password, "pengguna");
        return $query ? "success" : "gagal";
    }

    public function logout() {
        session_destroy();
        header("Location: /PERPUSTAKAAN_kel6/index.php?page=login&msg=Anda sudah logout");
        exit;
    }
}

// Handler login
if (isset($_GET['aksi']) && $_GET['aksi'] === "login") {
    $auth = new c_auth();
    $result = $auth->login($_POST['login'], $_POST['password']);

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
