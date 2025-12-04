<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang Di Jeruk Peras Premium</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Poppins', sans-serif;
        }
        .hero-section {
            height: 100vh;
            background: url('assets/img/foto jeruk3.avif') no-repeat center center;
            background-size: cover;
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
        }
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.6);
        }
        .hero-content {
            position: relative;
            z-index: 2;
        }
        .hero-content h1 {
            font-weight: 700;
            font-size: 3.5rem;
            text-shadow: 0 2px 4px rgba(0,0,0,0.5);
        }
        .hero-content p {
            font-size: 1.25rem;
            font-weight: 300;
            max-width: 600px;
            margin: 1rem auto 2rem;
        }
        .btn-order-now {
            background-color: #E67E22;
            border-color: #E67E22;
            color: white;
            font-weight: 600;
            padding: 0.8rem 2.5rem;
            border-radius: 50px;
            transition: all 0.3s ease;
            font-size: 1.1rem;
        }
        .btn-order-now:hover {
            background-color: #D35400;
            border-color: #D35400;
            transform: scale(1.05);
        }
        .admin-login-link {
            position: absolute;
            bottom: 20px;
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            transition: color 0.3s ease;
        }
        .admin-login-link:hover {
            color: white;
        }
    </style>
</head>
<body>
    <div class="hero-section">
        <div class="hero-content px-3">
            <i class="fas fa-lemon fa-3x mb-4"></i>
            <h1 class="mb-3">Kesegaran Premium, Langsung Untuk Anda</h1>
            <p>Nikmati es jeruk peras murni yang dibuat dari buah pilihan terbaik, setiap saat.</p>
            <a href="pembelian.php" class="btn btn-order-now">Pesan Sekarang</a>
        </div>
        <a href="login.php" class="admin-login-link">Masuk sebagai Admin</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
