<?php
session_start();

// Jika sudah login → arahkan kembali
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'petugas') {
        header("Location: ../PETUGAS/v_dasbord_petugas.php");
    } else {
        header("Location: ../PENGGUNA/dasbord_pengguna.php");
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/login.css">
</head>
<style>
    body {
        background: linear-gradient(to right, #4facfe, #00f2fe);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .login-card {
        border-radius: 15px;
        box-shadow: 0 4px 25px rgba(0, 0, 0, 0.1);
        background: white;
        padding: 2rem;
        max-width: 400px;
        width: 100%;
    }

    .login-title {
        font-weight: bold;
        text-align: center;
        margin-bottom: 1rem;
    }

    .form-control:focus {
        border-color: #4facfe;
        box-shadow: 0 0 5px rgba(79, 172, 254, 0.5);
    }

    .btn-primary {
        background: #4facfe;
        border: none;
    }

    .btn-primary:hover {
        background: #3b8efc;
    }
</style>

<body>

    <div class="login-card">
        <h3 class="login-title">📚 Login</h3>

        <?php if (!empty($_GET['msg'])): ?>
            <div class="alert alert-danger text-center"><?= $_GET['msg']; ?></div>
        <?php endif; ?>

        <form method="POST" action="proses_login.php">
            <div class="mb-3">
                <label class="form-label">Username atau email </label>
                <input type="text" name="login" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>

        <div class="text-center mt-3">
            <small>Belum punya akun? <a href="v_register.php">Daftar di sini</a></small>
        </div>
    </div>

</body>

</html>