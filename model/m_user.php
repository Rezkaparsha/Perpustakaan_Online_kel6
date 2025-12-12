<?php
include_once "m_koneksi.php";

class m_user
{
    private $conn;

    public function __construct()
    {
        $db = new m_koneksi();
        $this->conn = $db->koneksi;
    }

    // Ambil semua data user
    public function tampil_data()
    {
        $sql = "SELECT * FROM user ORDER BY id_user DESC";
        $result = mysqli_query($this->conn, $sql);

        $data = [];
        if ($result) {
            while ($row = mysqli_fetch_object($result)) {
                $data[] = $row;
            }
        }
        return $data;
    }

    // Ambil user by id
    public function tampil_data_by_id($id)
    {
        $id = mysqli_real_escape_string($this->conn, $id);
        $sql = "SELECT * FROM user WHERE id_user = '$id'";
        $result = mysqli_query($this->conn, $sql);
        return $result ? mysqli_fetch_object($result) : null;
    }

    // Tambah pengguna baru
    public function tambah_data($username, $email, $password, $role)
    {
        $username = mysqli_real_escape_string($this->conn, $username);
        $email    = mysqli_real_escape_string($this->conn, $email);
        $role     = mysqli_real_escape_string($this->conn, $role);

        $hashed = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO user (username, email, password, role)
                VALUES ('$username', '$email', '$hashed', '$role')";

        return mysqli_query($this->conn, $sql);
    }

    // Edit user
    public function ubah_data($id, $username, $email, $role, $password = null)
    {
        $id       = mysqli_real_escape_string($this->conn, $id);
        $username = mysqli_real_escape_string($this->conn, $username);
        $email    = mysqli_real_escape_string($this->conn, $email);
        $role     = mysqli_real_escape_string($this->conn, $role);

        if ($password) {
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $sql = "UPDATE user 
                    SET username='$username', email='$email', role='$role', password='$hashed' 
                    WHERE id_user='$id'";
        } else {
            $sql = "UPDATE user 
                    SET username='$username', email='$email', role='$role' 
                    WHERE id_user='$id'";
        }

        return mysqli_query($this->conn, $sql);
    }

    // Hapus user
    public function hapus_data($id)
    {
        $id = mysqli_real_escape_string($this->conn, $id);
        $sql = "DELETE FROM user WHERE id_user='$id'";
        return mysqli_query($this->conn, $sql);
    }

    // Login (dipakai proses_login)
    public function login_by_username_or_email($login)
    {
        $login = mysqli_real_escape_string($this->conn, $login);
        $sql = "SELECT * FROM user WHERE username='$login' OR email='$login'";
        $result = mysqli_query($this->conn, $sql);
        return $result ? mysqli_fetch_object($result) : null;
    }
}
