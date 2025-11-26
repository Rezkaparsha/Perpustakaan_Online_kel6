<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Ubah Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f2f6fc;
            font-family: 'Segoe UI', sans-serif;
        }

        .container {
            margin-top: 40px;
            max-width: 700px;
        }

        .card {
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        }

        img {
            max-height: 200px;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="card p-4">
            <h3 class="text-center mb-4">✏️ Ubah Buku</h3>

            <form method="POST" action="/PERPUSTAKAAN_kel6/controller/c_buku.php?aksi=update" enctype="multipart/form-data">
                <input type="hidden" name="id_buku" value="<?= $buku->id_buku ?>">
                <input type="hidden" name="cover_lama" value="<?= $buku->cover ?>">
                <input type="hidden" name="pdf_lama" value="<?= $buku->file_pdf ?>">

                <!-- Judul, Penulis, Penerbit, Tahun -->
                <div class="mb-3">
                    <label>Judul</label>
                    <input type="text" name="judul" class="form-control" value="<?= $buku->judul ?>" required>
                </div>
                <div class="mb-3">
                    <label>Penulis</label>
                    <input type="text" name="penulis" class="form-control" value="<?= $buku->penulis ?>" required>
                </div>
                <div class="mb-3">
                    <label>Penerbit</label>
                    <input type="text" name="penerbit" class="form-control" value="<?= $buku->penerbit ?>" required>
                </div>
                <div class="mb-3">
                    <label>Tahun Terbit</label>
                    <input type="number" name="tahun_terbit" class="form-control" value="<?= $buku->tahun_terbit ?>" required>
                </div>
              
                <div class="mb-3">
                    <label>Ganti Cover</label>
                    <input type="file" name="cover_lama" class="form-control" accept="image/*">
                </div>
                <div class="mb-3">
                    <label>Ganti File PDF</label>
                    <input type="file" name="file_pdf" class="form-control" accept="application/pdf">
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>

</body>

</html>