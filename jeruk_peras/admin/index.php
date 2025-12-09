<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("location:../login.php?pesan=belum_login");
    exit;
}
include '../koneksi.php';

// Dashboard Stats
$query_today_orders = "SELECT COUNT(*) as total FROM pesanan WHERE DATE(tanggal_pesan) = CURDATE()";
$result_today_orders = mysqli_query($koneksi, $query_today_orders);
$today_orders = mysqli_fetch_assoc($result_today_orders)['total'];

$query_today_revenue = "SELECT SUM(total_harga) as revenue FROM pesanan WHERE DATE(tanggal_pesan) = CURDATE() AND status NOT IN ('Dibatalkan')";
$result_today_revenue = mysqli_query($koneksi, $query_today_revenue);
$revenue_data = mysqli_fetch_assoc($result_today_revenue);
$today_revenue = $revenue_data['revenue'] ? $revenue_data['revenue'] : 0;

$query_pending_orders = "SELECT COUNT(*) as pending FROM pesanan WHERE status = 'Menunggu Konfirmasi'";
$result_pending_orders = mysqli_query($koneksi, $query_pending_orders);
$pending_orders = mysqli_fetch_assoc($result_pending_orders)['pending'];

// Filtering Logic
$filter_status = isset($_GET['status']) ? $_GET['status'] : 'Semua';
$where_clause = '';
if ($filter_status != 'Semua') {
    $where_clause = "WHERE status = '" . mysqli_real_escape_string($koneksi, $filter_status) . "'";
}

$query_pesanan = "SELECT * FROM pesanan $where_clause ORDER BY tanggal_pesan DESC";
$result_pesanan = mysqli_query($koneksi, $query_pesanan);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Pesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Poppins', sans-serif;
        }
        .navbar-custom {
            background-color: #343a40;
        }
        .stat-card {
            border-radius: 10px;
            color: white;
            padding: 20px;
        }
        .stat-card .stat-icon {
            font-size: 3rem;
            opacity: 0.8;
        }
        .order-card {
            border: 1px solid #e11616ff;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }
        .order-card-header {
            background-color: #eeff00ff;
            border-bottom: 1px solid #0dff05ff;
            font-weight: 600;
        }
        .filter-btn-group .btn {
            border-radius: 20px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="#"><i class="fas fa-store"></i> Admin Jeruk Peras</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <!-- Stats Cards -->
        <div class="row mb-4 g-3">
            <div class="col-md-4">
                <div class="stat-card bg-primary">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5>Pesanan Hari Ini</h5>
                            <h2 class="fw-bold"><?php echo $today_orders; ?></h2>
                        </div>
                        <i class="fas fa-box-open stat-icon"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card bg-success">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5>Pendapatan Hari Ini</h5>
                            <h2 class="fw-bold">Rp <?php echo number_format($today_revenue, 0, ',', '.'); ?></h2>
                        </div>
                        <i class="fas fa-dollar-sign stat-icon"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card bg-warning text-dark">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5>Perlu Diproses</h5>
                            <h2 class="fw-bold"><?php echo $pending_orders; ?></h2>
                        </div>
                        <i class="fas fa-hourglass-half stat-icon"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order List -->
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white">
                <div class="d-flex flex-wrap justify-content-between align-items-center">
                    <h4 class="mb-0 fw-bold">Daftar Pesanan</h4>
                    <div class="filter-btn-group btn-group mt-2 mt-md-0" role="group">
                        <a href="?status=Semua" class="btn btn-sm <?php echo $filter_status == 'Semua' ? 'btn-dark' : 'btn-outline-secondary'; ?>">Semua</a>
                        <a href="?status=Menunggu Konfirmasi" class="btn btn-sm <?php echo $filter_status == 'Menunggu Konfirmasi' ? 'btn-warning text-dark' : 'btn-outline-warning'; ?>">Menunggu Konfirmasi</a>
                        <a href="?status=Diproses" class="btn btn-sm <?php echo $filter_status == 'Diproses' ? 'btn-info' : 'btn-outline-info'; ?>">Diproses</a>
                        <a href="?status=Selesai" class="btn btn-sm <?php echo $filter_status == 'Selesai' ? 'btn-success' : 'btn-outline-success'; ?>">Selesai</a>
                        <a href="?status=Dibatalkan" class="btn btn-sm <?php echo $filter_status == 'Dibatalkan' ? 'btn-danger' : 'btn-outline-danger'; ?>">Dibatalkan</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <?php if (isset($_GET['update_status']) && $_GET['update_status'] == 'sukses'): ?>
                    <div class="alert alert-success alert-dismissible fade show">Status pesanan berhasil diperbarui!
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <?php if (mysqli_num_rows($result_pesanan) > 0): ?>
                    <?php while ($data = mysqli_fetch_assoc($result_pesanan)): ?>
                        <div class="order-card">
                            <div class="order-card-header p-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span>Pesanan #<?php echo $data['id']; ?></span>
                                    <span class="text-muted time-ago" data-timestamp="<?php echo $data['tanggal_pesan']; ?>"></span>
                                </div>
                            </div>
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5><strong><?php echo htmlspecialchars($data['nama_pemesan']); ?></strong></h5>
                                        <p class="text-muted mb-2"><i class="fas fa-map-marker-alt me-2"></i><?php echo htmlspecialchars($data['alamat']); ?></p>
                                        <p><strong><i class="fas fa-shopping-bag me-2"></i>Detail Pesanan:</strong></p>
                                        <ul class="list-unstyled ms-3">
                                            <li><strong>Ukuran:</strong> <?php echo htmlspecialchars($data['ukuran']); ?></li>
                                            <li><strong>Jumlah:</strong> <?php echo htmlspecialchars($data['jumlah']); ?></li>
                                            <li><strong>Topping:</strong> <?php echo htmlspecialchars($data['topping'] ? $data['topping'] : '-'); ?></li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6 border-start">
                                        <div class="d-flex flex-column justify-content-between h-100">
                                            <div>
                                                <p class="mb-2"><strong>Total Harga:</strong> <span class="fs-5 fw-bold text-success">Rp <?php echo number_format($data['total_harga'], 0, ',', '.'); ?></span></p>
                                                <p class="mb-2"><strong>Status:</strong>
                                                    <?php
                                                    $status = htmlspecialchars($data['status']);
                                                    $badge_map = ['Menunggu Konfirmasi' => 'bg-warning text-dark', 'Diterima' => 'bg-primary', 'Diproses' => 'bg-info text-dark', 'Selesai' => 'bg-success', 'Dibatalkan' => 'bg-danger'];
                                                    $badge_class = $badge_map[$status] ?? 'bg-secondary';
                                                    echo "<span class='badge {$badge_class}'>{$status}</span>";
                                                    ?>
                                                </p>
                                            </div>
                                            <?php if ($data['status'] != 'Selesai' && $data['status'] != 'Dibatalkan'): ?>
                                            <form action="update_status.php" method="POST" class="d-flex mt-3">
                                                <input type="hidden" name="id_pesanan" value="<?php echo $data['id']; ?>">
                                                <select name="status_baru" class="form-select form-select-sm me-2">
                                                    <?php if ($data['status'] == 'Menunggu Konfirmasi'): ?>
                                                        <option value="Diproses">Konfirmasi & Proses</option>
                                                    <?php elseif ($data['status'] == 'Diproses'): ?>
                                                        <option value="Selesai">Selesai</option>
                                                    <?php endif; ?>
                                                    <option value="Dibatalkan">Dibatalkan</option>
                                                </select>
                                                <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                            </form>
                                            <?php else: ?>
                                                <p class="text-muted mt-3 mb-0">Tidak ada aksi lebih lanjut.</p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="text-center p-5">
                        <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                        <p class="text-muted">Tidak ada pesanan dengan status "<?php echo htmlspecialchars($filter_status); ?>".</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Time Ago Functionality
        function timeSince(date) {
            const seconds = Math.floor((new Date() - date) / 1000);
            let interval = seconds / 31536000;
            if (interval > 1) return Math.floor(interval) + " tahun lalu";
            interval = seconds / 2592000;
            if (interval > 1) return Math.floor(interval) + " bulan lalu";
            interval = seconds / 86400;
            if (interval > 1) return Math.floor(interval) + " hari lalu";
            interval = seconds / 3600;
            if (interval > 1) return Math.floor(interval) + " jam lalu";
            interval = seconds / 60;
            if (interval > 1) return Math.floor(interval) + " menit lalu";
            return Math.floor(seconds) + " detik lalu";
        }

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.time-ago').forEach(function(element) {
                const timestamp = element.getAttribute('data-timestamp');
                // Convert MySQL datetime (YYYY-MM-DD HH:MM:SS) to a format JS Date can parse
                const jsDate = new Date(timestamp.replace(' ', 'T'));
                element.textContent = timeSince(jsDate);
            });
        });
    </script>
</body>
</html>