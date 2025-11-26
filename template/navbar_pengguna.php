<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$role = $_SESSION['role'] ?? 'guest';
$active = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding-top: 70px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-dark bg-primary fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Perpustakaan Online</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#menuUser">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="offcanvas offcanvas-end text-bg-primary" id="menuUser">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title">Menu Pengguna</h5>
                    <button class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
                </div>

                <div class="offcanvas-body">

                    <ul class="navbar-nav">

                        <?php if ($role == 'pengguna'): ?>

                            <li class="nav-item">
                                <a class="nav-link <?= ($active == 'v_dashboard_pengguna.php') ? 'active' : '' ?>"
                                    href="../PENGGUNA/dasbord_pengguna.php">Dashboard</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link <?= ($active == 'profil_pengguna.php') ? 'active' : '' ?>"
                                    href="../PENGGUNA/profil_pengguna.php">Edit Profil</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link text-danger" href="../auth/v_logout.php">Logout</a>
                            </li>

                        <?php else: ?>
                            <li class="nav-item">
                                <a class="nav-link" href="../../auth/v_login.php">Login</a>
                            </li>
                        <?php endif; ?>

                    </ul>

                </div>
            </div>
        </div>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>