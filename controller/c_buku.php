<?php
include_once "../model/m_buku.php";

$bukuModel = new m_buku();

// Ambil aksi dari URL
$aksi = $_GET['aksi'] ?? '';

// ----------------- TAMPILKAN SEMUA BUKU -----------------
if ($aksi === "") {
    $buku = $bukuModel->tampil_buku();
    return;
}

// ----------------- TAMBAH BUKU -----------------
if ($aksi === "tambah") {
    $judul      = $_POST['judul'];
    $penulis    = $_POST['penulis'];
    $penerbit   = $_POST['penerbit'];
    $tahun      = $_POST['tahun_terbit'];

    // Upload Cover
    $cover = null;
    if (!empty($_FILES['cover']['name'])) {
        $timestamp = time();
        $coverName = str_replace(" ", "_", $_FILES['cover']['name']);
        $cover = $timestamp . "_" . $coverName;
        $targetCover = __DIR__ . "/../uploads/cover/" . $cover;

        if (!move_uploaded_file($_FILES['cover']['tmp_name'], $targetCover)) {
            echo "<script>alert('Upload cover gagal.'); window.location='/PERPUSTAKAAN_kel6/index.php?page=buku';</script>";
            exit;
        }
    }

    // Upload PDF
    $file_pdf = null;
    if (!empty($_FILES['file_pdf']['name'])) {
        $timestamp = time();
        $pdfName = str_replace(" ", "_", $_FILES['file_pdf']['name']);
        $file_pdf = $timestamp . "_" . $pdfName;
        $targetPDF = __DIR__ . "/../uploads/buku/" . $file_pdf;

        if (!move_uploaded_file($_FILES['file_pdf']['tmp_name'], $targetPDF)) {
            echo "<script>alert('Upload PDF gagal.'); window.location='/PERPUSTAKAAN_kel6/index.php?page=buku';</script>";
            exit;
        }
    }

    // Simpan ke database
    $bukuModel->tambah_buku($judul, $penulis, $penerbit, $tahun, $cover, $file_pdf);

    echo "<script>alert('Buku berhasil ditambahkan!'); window.location='/PERPUSTAKAAN_kel6/index.php?page=buku';</script>";
    exit;
}

// ----------------- EDIT BUKU -----------------
if ($aksi === "edit") {
    $id = $_GET['id_buku'];
    $buku = $bukuModel->get_buku_by_id($id);

    include "../views/PETUGAS/v_ubah_buku.php";
    exit;
}

// ----------------- UPDATE BUKU -----------------
if ($aksi === "update") {
    $id         = $_POST['id_buku'];
    $judul      = $_POST['judul'];
    $penulis    = $_POST['penulis'];
    $penerbit   = $_POST['penerbit'];
    $tahun      = $_POST['tahun_terbit'];

    // COVER
    $cover = $_POST['cover_lama'] ?? null;
    if (!empty($_FILES['cover']['name'])) {
        $timestamp = time();
        $coverName = str_replace(" ", "_", $_FILES['cover']['name']);
        $coverBaru = $timestamp . "_" . $coverName;
        $targetCover = __DIR__ . "/../uploads/cover/" . $coverBaru;

        if (move_uploaded_file($_FILES['cover']['tmp_name'], $targetCover)) {
            $cover = $coverBaru;
        } else {
            echo "<script>alert('Upload cover gagal.'); window.location='/PERPUSTAKAAN_kel6/index.php?page=buku';</script>";
            exit;
        }
    }

    // PDF
    $file_pdf = $_POST['pdf_lama'] ?? null;
    if (!empty($_FILES['file_pdf']['name'])) {
        $timestamp = time();
        $pdfName = str_replace(" ", "_", $_FILES['file_pdf']['name']);
        $pdfBaru = $timestamp . "_" . $pdfName;
        $targetPDF = __DIR__ . "/../uploads/buku/" . $pdfBaru;

        if (move_uploaded_file($_FILES['file_pdf']['tmp_name'], $targetPDF)) {
            $file_pdf = $pdfBaru;
        } else {
            echo "<script>alert('Upload PDF gagal.'); window.location='/PERPUSTAKAAN_kel6/index.php?page=buku';</script>";
            exit;
        }
    }

    // UPDATE
    $bukuModel->ubah_buku($id, $judul, $penulis, $penerbit, $tahun, $cover, $file_pdf);

    echo "<script>alert('Buku berhasil diupdate!'); window.location='/PERPUSTAKAAN_kel6/index.php?page=buku';</script>";
    exit;
}

// ----------------- HAPUS BUKU -----------------
if ($aksi === "hapus") {
    $id = $_GET['id_buku'];
    $bukuModel->hapus_buku($id);

    echo "<script>alert('Buku berhasil dihapus!'); window.location='/PERPUSTAKAAN_kel6/index.php?page=buku';</script>";
    exit;
}
?>