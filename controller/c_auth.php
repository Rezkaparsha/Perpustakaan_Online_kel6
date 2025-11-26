<?php
session_start();
require_once "../PERPUSTAKAAN_kel6/model/m_user.php";

class c_auth
{

    private $model;

    public function __construct()
    {
        $this->model = new m_user();
    }


    // LOGIN (username atau email)
    public function login($login, $password)
    {
        // login bisa berupa username atau email
        $user = $this->model->login_by_username_or_email($login);

        if (!$user) {
            return "Username atau Email tidak ditemukan!";
        }

        if (!password_verify($password, $user->password)) {
            return "Password salah!";
        }

        // Jika berhasil → simpan session
        $_SESSION['id_user']   = $user->id_user;
        $_SESSION['username']  = $user->username;
        $_SESSION['role']      = $user->role;

        return "success";
    }


    // REGISTER
    public function register($username, $email, $password)
    {
        // Cek apakah username atau email sudah dipakai
        $cekUser  = $this->model->login_by_username_or_email($username);
        $cekEmail = $this->model->login_by_username_or_email($email);

        if ($cekUser) {
            return "Username sudah dipakai!";
        }
        if ($cekEmail) {
            return "Email sudah dipakai!";
        }

        $query = $this->model->tambah_data($username, $email, $password, "pengguna");

        return $query ? "success" : "gagal";
    }


    // LOGOUT
    public function logout()
    {
        session_destroy();
        header("Location: ../auth/v_login.php");
        exit;
    }
}
