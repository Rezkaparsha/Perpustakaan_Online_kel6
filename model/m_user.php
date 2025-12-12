<?php
include_once "m_koneksi.php";

class m_user {
    private $conn;

    public function __construct() {
        $db = new m_koneksi();
        $this->conn = $db->koneksi;
    }

    // ----------------- AMBIL SEMUA DATA USER -----------------
    public function tampil_data() {
        $query = "SELECT * FROM user ORDER BY id_user DESC";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $data = [];
        while ($row = mysqli_fetch_object($result)) {
            $data[] = $row;
        }
        return $data;
    }

    // ----------------- AMBIL USER BERDASARKAN ID -----------------
    public function get_user_by_id($id_user) {
        $query = "SELECT * FROM user WHERE id_user = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $id_user);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_object($result);
    }

    // ----------------- TAMBAH USER BARU -----------------
    public function tambah_data($username, $email, $password, $role) {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO user (username, email, password, role) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "ssss", $username, $email, $hashed, $role);
        return mysqli_stmt_execute($stmt);
    }

    // ----------------- UPDATE USER -----------------
    public function update_user($id_user, $username, $email, $password, $role) {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $query = "UPDATE user SET username=?, email=?, password=?, role=? WHERE id_user=?";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "ssssi", $username, $email, $hashed, $role, $id_user);
        return mysqli_stmt_execute($stmt);
    }

    // ----------------- UPDATE USER TANPA PASSWORD -----------------
    public function update_user_no_password($id_user, $username, $email, $role) {
        $query = "UPDATE user SET username=?, email=?, role=? WHERE id_user=?";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "sssi", $username, $email, $role, $id_user);
        return mysqli_stmt_execute($stmt);
    }

    // ----------------- HAPUS USER -----------------
    public function hapus_user($id_user) {
        $query = "DELETE FROM user WHERE id_user=?";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $id_user);
        return mysqli_stmt_execute($stmt);
    }

    // ----------------- LOGIN -----------------
    public function login_by_username_or_email($login) {
        $query = "SELECT * FROM user WHERE username=? OR email=?";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "ss", $login, $login);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_object($result);
    }
}
