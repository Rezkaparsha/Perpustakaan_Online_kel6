<?php
session_start();

// Hancurkan semua data sesi saat ini
session_unset();
session_destroy();

// Variabel untuk menyimpan pesan
$pesan_logout = "Anda berhasil keluar dari akun. Anda akan diarahkan ke halaman login.";
// Anti cache supaya tombol back tidak bisa buka halaman lama
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1
header("Pragma: no-cache"); // HTTP 1.0
header("Expires: 0"); // Proxies
?>
<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Logout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil Logout!',
                text: '<?php echo $pesan_logout; ?>',
                showConfirmButton: false,
                timer: 2000
            }).then(() => {
                // Setelah popup ditutup, alihkan pengguna ke halaman index.php
                window.location.href = "v_login.php";
            });
        });
    </script>

</body>

</html>