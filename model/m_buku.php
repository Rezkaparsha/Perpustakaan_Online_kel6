<?php
include_once "m_koneksi.php";

class m_buku
{
    private $conn;

    public function __construct()
    {
        $db = new m_koneksi();
        $this->conn = $db->koneksi;
    }
    //  Ambil semua data buku
    public function tampil_buku()
    {
        $query = "SELECT * FROM buku ORDER BY id_buku DESC";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $data = [];
        while ($row = mysqli_fetch_object($result)) {
            $data[] = $row;
        }
        return $data;
    }

    // Ambil buku berdasarkan ID
    public function get_buku_by_id($id_buku)
    {
        $query = "SELECT * FROM buku WHERE id_buku = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $id_buku);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_object($result);
    }

    // Tambah buku baru
    public function tambah_buku($judul, $penulis, $penerbit, $tahun_terbit, $cover, $file_pdf)
    {
        $query = "INSERT INTO buku (judul, penulis, penerbit, tahun_terbit, cover, file_pdf)
                  VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "ssssss", $judul, $penulis, $penerbit, $tahun_terbit, $cover, $file_pdf);
        return mysqli_stmt_execute($stmt);
    }

    //  Update data buku
    public function ubah_buku($id_buku, $judul, $penulis, $penerbit, $tahun_terbit, $cover = null, $file_pdf = null)
    {
        if ($cover === null && $file_pdf === null) {
            $query = "UPDATE buku SET judul=?, penulis=?, penerbit=?, tahun_terbit=? WHERE id_buku=?";
            $stmt = mysqli_prepare($this->conn, $query);
            mysqli_stmt_bind_param($stmt, "ssssi", $judul, $penulis, $penerbit, $tahun_terbit, $id_buku);
        } elseif ($cover !== null && $file_pdf === null) {
            $query = "UPDATE buku SET judul=?, penulis=?, penerbit=?, tahun_terbit=?, cover=? WHERE id_buku=?";
            $stmt = mysqli_prepare($this->conn, $query);
            mysqli_stmt_bind_param($stmt, "sssssi", $judul, $penulis, $penerbit, $tahun_terbit, $cover, $id_buku);
        } elseif ($cover === null && $file_pdf !== null) {
            $query = "UPDATE buku SET judul=?, penulis=?, penerbit=?, tahun_terbit=?, file_pdf=? WHERE id_buku=?";
            $stmt = mysqli_prepare($this->conn, $query);
            mysqli_stmt_bind_param($stmt, "sssssi", $judul, $penulis, $penerbit, $tahun_terbit, $file_pdf, $id_buku);
        } else {
            $query = "UPDATE buku SET judul=?, penulis=?, penerbit=?, tahun_terbit=?, cover=?, file_pdf=? WHERE id_buku=?";
            $stmt = mysqli_prepare($this->conn, $query);
            mysqli_stmt_bind_param($stmt, "ssssssi", $judul, $penulis, $penerbit, $tahun_terbit, $cover, $file_pdf, $id_buku);
        }

        return mysqli_stmt_execute($stmt);
    }

    //  Hapus buku
    public function hapus_buku($id_buku)
    {
        $query = "DELETE FROM buku WHERE id_buku = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $id_buku);
        return mysqli_stmt_execute($stmt);
    }

    //  Hitung total buku
    public function total_buku()
    {
        $query = "SELECT COUNT(*) AS total FROM buku";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        return $row['total'];
    }
}
