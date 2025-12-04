<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Jeruk Peras Premium</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background-color: #FDFEFE;
        }
        .login-container {
            display: flex;
            min-height: 100vh;
        }
        .login-image-panel {
            flex: 1;
            background: url('assets/img/foto jeruk5.avif') no-repeat center center;
            background-size: cover;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
        }
        .login-image-panel::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to top, rgba(230, 126, 34, 0.7), rgba(44, 62, 80, 0.8));
        }
        .login-image-content {
            position: relative;
            z-index: 2;
        }
        .login-image-content h1 {
            font-weight: 700;
            font-size: 2.5rem;
        }
        .login-form-panel {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
        }
        .login-form-container {
            max-width: 400px;
            width: 100%;
        }
        .form-control {
            border-radius: 8px;
            border: 1px solid #D5D8DC;
            padding: 0.75rem 1rem;
            padding-left: 2.5rem;
        }
        .form-control:focus {
            border-color: #E67E22;
            box-shadow: 0 0 0 0.2rem rgba(230, 126, 34, 0.25);
        }
        .input-group-text {
            background-color: transparent;
            border: none;
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            z-index: 5;
            color: #AEB6BF;
        }
        .btn-login {
            background-color: #E67E22;
            border-color: #E67E22;
            color: white;
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        .btn-login:hover {
            background-color: #D35400;
            border-color: #D35400;
        }
        @media (max-width: 991.98px) {
            .login-image-panel {
                display: none;
            }
            .login-form-panel {
                flex-basis: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-image-panel">
            <div class="login-image-content">
                <i class="fas fa-lemon fa-3x mb-3"></i>
                <h1 class="mb-3">Jeruk Peras Premium</h1>
                <p>Manajemen Pesanan</p>
            </div>
        </div>
        <div class="login-form-panel">
            <div class="login-form-container">
                <h2 class="fw-bold mb-2 text-center">Admin Login</h2>
                <p class="text-muted mb-4 text-center">Selamat datang kembali!</p>

                <?php
                if (isset($_GET['pesan'])) {
                    $alert_class = 'alert-warning';
                    $message = '';
                    if ($_GET['pesan'] == "gagal") {
                        $alert_class = 'alert-danger';
                        $message = 'Login gagal! Username atau password salah.';
                    } else if ($_GET['pesan'] == "logout") {
                        $alert_class = 'alert-success';
                        $message = 'Anda telah berhasil logout.';
                    } else if ($_GET['pesan'] == "belum_login") {
                        $message = 'Anda harus login untuk mengakses halaman admin.';
                    }
                    if ($message) {
                        echo "<div class='alert {$alert_class} text-center'>{$message}</div>";
                    }
                }
                ?>

                <form action="admin/proses_login.php" method="post">
                    <div class="mb-3 position-relative">
                        <label for="username" class="form-label">Username</label>
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-4 position-relative">
                        <label for="password" class="form-label">Password</label>
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-login">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
