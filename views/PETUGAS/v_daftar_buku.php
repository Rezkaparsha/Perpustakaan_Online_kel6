<?php
// Pastikan session sudah berjalan dan hanya petugas yang boleh mengakses
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'petugas') {
    // Sesuaikan path jika berbeda
    header("Location: ../../views/auth/v_login.php?msg=Akses ditolak. Silakan login sebagai petugas.");
    exit;
}

// include navbar petugas
include_once __DIR__ . "/../../template/navbar_petugas.php";

// include model untuk mengambil data
include_once __DIR__ . "/../../model/m_buku.php";


if (class_exists('m_buku')) {
    $bukuModel = new m_buku();
    // Ambil semua data buku
    $daftarBuku = $bukuModel->tampil_buku();
} else {
    $daftarBuku = [];
}

?>
<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Buku - Perpustakaan Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        :root {
            --primary: #007bff;
            /* Warna biru primer yang lebih kuat */
            --secondary: #6c757d;
            --bg-light: #f8f9fa;
            /* Latar belakang sangat terang */
        }

        body {
            padding-top: 90px;
            background: var(--bg-light);
            font-family: 'Inter', sans-serif;
        }

        .card-table {
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            /* Bayangan lebih jelas */
            border: none;
            overflow: hidden;
        }

        .table-responsive {
            /* Hapus radius di sini, biarkan di card-table */
            border: none;
        }

        .table {
            margin-bottom: 0;
        }

        .table thead th {
            background-color: var(--primary);
            color: white;
            font-weight: 600;
            vertical-align: middle;
            /* Padding lebih kecil */
            padding: 0.8rem 0.75rem;
        }

        .table tbody tr td {
            vertical-align: middle;
        }

        .table-hover tbody tr:hover {
            background-color: #e9ecef;
            /* Warna hover abu-abu terang */
            transition: background-color 0.2s ease;
        }

        .action-btn {
            /* Menggunakan d-block dan w-100 untuk membuat tombol sejajar vertikal dan penuh */
            margin: 4px 0;
            /* Tambahkan sedikit margin vertikal */
            padding: 0.5rem 0.75rem;
            border-radius: 8px;
            font-size: 0.85rem;
            display: inline-block;
            /* Kembali ke inline-block agar sejajar horizontal */
            margin-right: 5px;
            /* Tambahkan sedikit jarak antar tombol */
        }

        /* Pastikan tombol terakhir tidak memiliki margin kanan */
        .action-btn:last-child {
            margin-right: 0;
        }

        .small-text {
            font-size: 0.9rem;
        }

        .cover-img {
            width: 60px;
            /* Ukuran cover yang lebih proporsional */
            height: 90px;
            object-fit: cover;
            border-radius: 4px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .cover-placeholder {
            width: 60px;
            height: 90px;
            background-color: #dee2e6;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--secondary);
            font-size: 1.5rem;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        /* Style untuk pesan "Tidak Ada Data" */
        .no-data {
            background-color: white;
            border-radius: 16px;
            padding: 3rem;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            margin-top: 2rem;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row mb-4 align-items-center">
            <div class="col-md-8">
                <h2 class="fw-bolder text-dark"><i class="fas fa-book-reader me-2 text-primary"></i> Kelola Koleksi Buku</h2>
                <p class="small-text text-muted">Daftar lengkap semua buku digital yang tersedia di perpustakaan.</p>
            </div>
            <div class="col-md-4 text-md-end">
                <!-- Tombol Tambah Buku -->
                <a href="v_tambah_buku.php" class="btn btn-primary btn-lg shadow-sm">
                    <i class="fas fa-plus me-2"></i> Tambah Buku
                </a>
            </div>
        </div>

        <!-- Kontainer Tabel -->
        <div class="card card-table">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th style="width: 5%;">No</th>
                            <th style="width: 8%;">Cover</th>
                            <th style="width: 30%;">Judul Buku</th>
                            <th style="width: 15%;">Penulis</th>
                            <th style="width: 15%;">Penerbit & Tahun</th>
                            <th style="width: 27%;">Aksi</th> <!-- Lebar kolom aksi disesuaikan sedikit lebih lebar untuk 3 tombol -->
                        </tr>
                    </thead>

                    <tbody>
                        <?php if (!empty($daftarBuku) && is_array($daftarBuku)): ?>
                            <?php $no = 1;
                            foreach ($daftarBuku as $buku):
                                // Mengamankan ID dan data
                                $id_buku = htmlspecialchars($buku->id_buku ?? '');
                                $judul = htmlspecialchars($buku->judul ?? 'Tidak Ada Judul');
                                $penulis = htmlspecialchars($buku->penulis ?? '-');
                                $penerbit = htmlspecialchars($buku->penerbit ?? '-');
                                $tahun = htmlspecialchars($buku->tahun_terbit ?? '-');
                                $cover_file = htmlspecialchars($buku->cover ?? '');
                            ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td>
                                        <?php if ($cover_file): ?>
                                            <img src="../../uploads/cover/<?= $cover_file ?>"
                                                class="cover-img"
                                                alt="Cover <?= $judul ?>"
                                                onerror="this.onerror=null;this.src='https://placehold.co/60x90/D1E7FF/007bff?text=NO+COVER'">
                                        <?php else: ?>
                                            <div class="cover-placeholder"><i class="fas fa-image"></i></div>
                                        <?php endif; ?>
                                    </td>
                                    <td class="fw-medium text-dark"><?= $judul ?></td>
                                    <td><?= $penulis ?></td>
                                    <td class="small-text text-muted"><?= $penerbit ?><br> (<?= $tahun ?>)</td>

                                    <td>
                                        <!-- Tombol Baca (Mengarah ke View) -->
                                        <a href="../../uploads/buku/<?= $buku->file_pdf ?>" target="_blank" class="btn btn-info action-btn text-white" title="Lihat/Baca Buku">
                                            <i class="fas fa-eye me-1"></i> Baca
                                        </a>
                                        <!-- Tombol Edit (DIKEMBALIKAN ke Controller sesuai logika awal) -->
                                        <a href="../../controller/c_buku.php?aksi=edit&id_buku=<?= $id_buku ?>" class="btn btn-warning action-btn text-dark" title="Edit Data">
                                            <i class="fas fa-edit me-1"></i> Edit
                                        </a>
                                        <!-- Tombol Hapus (Tetap mengarah ke Controller) -->
                                        <a onclick="return confirm('Apakah Anda yakin ingin menghapus buku <?= $judul ?>? Tindakan ini tidak dapat dibatalkan.');"
                                            href="../../controller/c_buku.php?aksi=hapus&id_buku=<?= $id_buku ?>"
                                            class="btn btn-danger action-btn"
                                            title="Hapus Buku">
                                            <i class="fas fa-trash-alt me-1"></i> Hapus
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        <?php else: ?>
                            <!-- Pesan jika tidak ada data -->
                            <tr>
                                <td colspan="6" class="p-5">
                                    <div class="no-data">
                                        <i class="fas fa-box-open fa-3x mb-3 text-secondary"></i>
                                        <h5 class="fw-bold">Belum ada buku dalam koleksi ini.</h5>
                                        <p class="text-muted">Silakan tambahkan buku pertama Anda untuk mulai mengelola perpustakaan.</p>
                                        <a href="v_tambah_buku.php" class="btn btn-primary mt-2"><i class="fas fa-plus me-1"></i> Tambah Buku Sekarang</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>

            <?php if (!empty($daftarBuku) && is_array($daftarBuku)) : ?>
                <!-- Footer tabel, untuk menunjukkan jumlah total data -->
                <div class="card-footer bg-white text-end small-text text-muted py-3">
                    Total data buku: <?= count($daftarBuku) ?>
                </div>
            <?php endif; ?>

        </div>

        <!-- Footer untuk ruang di bawah -->
        <div class="py-4"></div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>