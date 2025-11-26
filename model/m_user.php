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

    //  Ambil semua data user
    public function tampil_data()
    {
        $result = mysqli_query($this->conn, "SELECT * FROM user ORDER BY id_user DESC");

        $data = [];
        while ($row = mysqli_fetch_object($result)) {
            $data[] = $row;
        }
        return $data;
    }

    //  Ambil user by id
    public function tampil_data_by_id($id)
    {
        $result = mysqli_query($this->conn, "SELECT * FROM user WHERE id_user = '$id'");
        return mysqli_fetch_object($result);
    }

    //  Tambah pengguna baru
    public function tambah_data($username, $email, $password, $role)
    {

        $hashed = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO user (username, email, password, role)
                  VALUES ('$username', '$email', '$hashed', '$role')";

        return mysqli_query($this->conn, $query);
    }

    // Edit user
    public function ubah_data($id, $username, $email, $role, $password = null)
    {

        if ($password) {
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $query = "UPDATE user SET   username='$username', email='$email', role='$role', password='$hashed'   WHERE id_user='$id'";
        } else {
            $query = "UPDATE user SET 
                        username='$username',
                        email='$email',
                        role='$role'
                      WHERE id_user='$id'";
        }

        return mysqli_query($this->conn, $query);
    }

    // Hapus user
    public function hapus_data($id)
    {
        return mysqli_query($this->conn, "DELETE FROM user WHERE id_user='$id'");
    }

    //  Login (dipakai proses_login)
    public function login_by_username_or_email($login)
    {
        $login = mysqli_real_escape_string($this->conn, $login);
        $query = "SELECT * FROM user WHERE username='$login' OR email='$login'";
        $result = mysqli_query($this->conn, $query);
        return mysqli_fetch_object($result);
    }
}
