<?php
include 'koneksi.php';
$pesanan = null;
if (isset($_GET['id'])) {
    $id_pesanan = (int)$_GET['id'];
    $query = "SELECT * FROM pesanan WHERE id = ?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "i", $id_pesanan);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if ($result && mysqli_num_rows($result) > 0) {
        $pesanan = mysqli_fetch_assoc($result);
    }
    mysqli_stmt_close($stmt);
}

// Status logic for progress bar
$status_levels = [
    'Menunggu Konfirmasi' => 1,
    'Diproses' => 2,
    'Selesai' => 3,
    'Dibatalkan' => -1
];
if ($pesanan) {
    if (isset($status_levels[$pesanan['status']])) {
        $current_level = $status_levels[$pesanan['status']];
    } else {
        $current_level = 0;
    }
} else {
    $current_level = 0;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Pesanan Anda - Jeruk Peras Premium</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #FDFEFE;
            font-family: 'Poppins', sans-serif;
            color: #34495E;
        }
        .navbar-custom {
            background-color: #2C3E50;
            box-shadow: 0 2px 15px rgba(0,0,0,0.1);
        }
        .card {
            border: 1px solid #EAEDED;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.07);
        }
        .btn-order {
            background-color: #E67E22;
            border-color: #E67E22;
            color: white;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-order:hover {
            background-color: #D35400;
            border-color: #D35400;
        }
        .footer-custom {
            background-color: #2C3E50;
            color: #BDC3C7;
        }
        /* Progress Tracker */
        .progress-tracker {
            display: flex;
            justify-content: space-between;
            position: relative;
        }
        .progress-tracker::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 3px;
            background-color: #EAEDED;
            transform: translateY(-50%);
            z-index: 1;
        }
        .progress-bar-custom {
            position: absolute;
            top: 50%;
            left: 0;
            height: 3px;
            background-color: #27AE60;
            transform: translateY(-50%);
            z-index: 2;
            transition: width 0.5s ease;
        }
        .progress-step {
            position: relative;
            z-index: 3;
            text-align: center;
        }
        .progress-step-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #EAEDED;
            color: #AEB6BF;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
            border: 3px solid #EAEDED;
            transition: all 0.4s ease;
        }
        .progress-step.active .progress-step-icon {
            background-color: #27AE60;
            color: white;
            border-color: #27AE60;
        }
        .progress-step.completed .progress-step-icon {
            background-color: #27AE60;
            color: white;
            border-color: #27AE60;
        }
        .progress-step-label {
            font-size: 0.85rem;
            font-weight: 500;
            color: #AEB6BF;
        }
        .progress-step.active .progress-step-label, .progress-step.completed .progress-step-label {
            color: #34495E;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php"><i class="fas fa-lemon"></i> Jeruk Peras Premium</a>
        </div>
    </nav>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <?php if ($pesanan): ?>
                <div class="card p-4 p-lg-5">
                    <div class="text-center mb-4">
                        <h2 class="fw-bold">Terima Kasih, <?php echo htmlspecialchars($pesanan['nama_pemesan']); ?>!</h2>
                        <p class="text-muted">Status pesanan Anda dengan ID #<?php echo $pesanan['id']; ?> ada di bawah ini.</p>
                    </div>

                    <?php if ($current_level != -1): ?>
                    <div class="mb-5">
                        <div class="progress-tracker">
                            <div class="progress-bar-custom" style="width: <?php echo ($current_level - 1) * 50; ?>%;"></div>
                            <div class="progress-step <?php echo ($current_level >= 1) ? 'completed' : ''; echo ($current_level == 1) ? ' active' : ''; ?>">
                                <div class="progress-step-icon"><i class="fas fa-receipt"></i></div>
                                <div class="progress-step-label">Menunggu Konfirmasi</div>
                            </div>
                            <div class="progress-step <?php echo ($current_level >= 2) ? 'completed' : ''; echo ($current_level == 2) ? ' active' : ''; ?>">
                                <div class="progress-step-icon"><i class="fas fa-cogs"></i></div>
                                <div class="progress-step-label">Diproses</div>
                            </div>
                            <div class="progress-step <?php echo ($current_level >= 3) ? 'completed' : ''; ?>">
                                <div class="progress-step-icon"><i class="fas fa-check-circle"></i></div>
                                <div class="progress-step-label">Selesai</div>
                            </div>
                        </div>
                    </div>
                    <?php else: ?>
                    <div class="text-center mb-5">
                        <div style="font-size: 3rem; color: #E74C3C;"><i class="fas fa-times-circle"></i></div>
                        <h4 class="mt-3">Pesanan Dibatalkan</h4>
                    </div>
                    <?php endif; ?>

                    <h5 class="mb-3 fw-semibold">Detail Pesanan</h5>
                    <div class="row gy-3">
                        <div class="col-md-6">
                            <p class="mb-1"><strong>Nama:</strong></p>
                            <p class="text-muted"><?php echo htmlspecialchars($pesanan['nama_pemesan']); ?></p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-1"><strong>Alamat Pengiriman:</strong></p>
                            <p class="text-muted"><?php echo htmlspecialchars($pesanan['alamat']); ?></p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-1"><strong>Detail Item:</strong></p>
                            <p class="text-muted"><?php echo htmlspecialchars($pesanan['jumlah']); ?>x Jeruk Peras (<?php echo htmlspecialchars($pesanan['ukuran']); ?>)</p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-1"><strong>Topping:</strong></p>
                            <p class="text-muted"><?php echo htmlspecialchars($pesanan['topping'] ? $pesanan['topping'] : '-'); ?></p>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="fw-semibold mb-0">Total Pembayaran:</h5>
                        <h4 class="fw-bold text-success mb-0">Rp <?php echo number_format($pesanan['total_harga'], 0, ',', '.'); ?></h4>
                    </div>

                    <div class="text-center mt-5">
                        <p class="text-muted small">Halaman ini akan refresh otomatis. Tidak perlu dimuat ulang.</p>
                        <a href="index.php" class="btn btn-order mt-2">Buat Pesanan Baru</a>
                    </div>
                </div>
                <?php else: ?>
                <div class="card p-5 text-center">
                    <div style="font-size: 3rem; color: #E74C3C;"><i class="fas fa-search"></i></div>
                    <h4 class="mt-3 fw-bold">Pesanan Tidak Ditemukan</h4>
                    <p class="text-muted">Maaf, kami tidak dapat menemukan detail untuk ID pesanan ini.</p>
                    <a href="index.php" class="btn btn-order mt-3">Kembali ke Halaman Utama</a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <footer class="footer-custom text-center py-4 mt-5">
        <div class="container">
            <p class="mb-0">&copy; 2025 Jeruk Peras Premium. Crafted with love.</p>
        </div>
    </footer>

    <script>
        // Refresh halaman setiap 15 detik jika status belum final
        setTimeout(function() {
            const currentStatus = "<?php echo $pesanan ? $pesanan['status'] : ''; ?>";
            if (currentStatus && currentStatus !== 'Selesai' && currentStatus !== 'Dibatalkan') {
                location.reload();
            }
        }, 15000);
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>