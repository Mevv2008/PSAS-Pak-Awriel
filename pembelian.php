<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Es Jeruk Peras Premium</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
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
        .navbar-brand {
            font-weight: 600;
        }
        .card {
            border: 1px solid #EAEDED;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.07);
            overflow: hidden;
        }
        #main-product-image {
            border-radius: 15px;
            transition: transform 0.3s ease-in-out;
        }
        .product-gallery img {
            border: 2px solid transparent;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .product-gallery img:hover, .product-gallery img.active {
            border-color: #E67E22;
            transform: scale(1.05);
        }
        .form-label {
            font-weight: 500;
            color: #566573;
        }
        .form-control {
            border-radius: 8px;
            border: 1px solid #D5D8DC;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .form-control:focus {
            border-color: #E67E22;
            box-shadow: 0 0 0 0.2rem rgba(230, 126, 34, 0.25);
        }
        .form-check-input:checked {
            background-color: #E67E22;
            border-color: #E67E22;
        }
        .total-price-section {
            border-top: 1px dashed #D5D8DC;
            padding-top: 1.5rem;
        }
        #total_harga {
            color: #27AE60;
            font-weight: 700;
        }
        .btn-order {
            background-color: #E67E22;
            border-color: #E67E22;
            color: white;
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(230, 126, 34, 0.4);
        }
        .btn-order:hover {
            background-color: #D35400;
            border-color: #D35400;
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(230, 126, 34, 0.5);
        }
        .footer-custom {
            background-color: #2C3E50;
            color: #BDC3C7;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="index.php"><i class="fas fa-lemon"></i> Jeruk Peras Premium</a>
        </div>
    </nav>

    <div class="container my-5">
        <div class="card p-lg-5 p-4">
            <div class="row g-5">
                <div class="col-lg-6">
                    <div class="mb-4">
                        <img src="assets/img/foto jeruk.avif" class="img-fluid w-100" alt="Es Jeruk Peras" id="main-product-image">
                    </div>
                    <div class="row gx-3 product-gallery">
                        <div class="col-3"><img src="assets/img/foto jeruk.avif" class="img-fluid active" onclick="changeImage(this)"></div>
                        <div class="col-3"><img src="assets/img/foto jeruk2.avif" class="img-fluid" onclick="changeImage(this)"></div>
                        <div class="col-3"><img src="assets/img/foto jeruk3.avif" class="img-fluid" onclick="changeImage(this)"></div>
                        <div class="col-3"><img src="assets/img/foto jeruk4.avif" class="img-fluid" onclick="changeImage(this)"></div>
                    </div>
                </div>

                <div class="col-lg-6 d-flex flex-column">
                    <h2 class="fw-bold mb-2">Pesan Kesegaran Premium</h2>
                    <p class="text-muted mb-4">Dibuat dari jeruk Valencia pilihan yang diperas saat Anda memesan, menjanjikan kesegaran tak tertandingi.</p>
                    
                    <?php
                    if (isset($_GET['status']) && $_GET['status'] == 'sukses') {
                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Pesanan Terkirim!</strong> Terima kasih telah memilih kami.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                              </div>';
                    }
                    ?>

                    <form action="proses_pesanan.php" method="POST" onchange="calculateTotal()" class="d-flex flex-column h-100">
                        <div class="mb-3">
                            <label for="nama_pemesan" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama_pemesan" name="nama_pemesan" required>
                        </div>

                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat Pengiriman</label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="2" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Pilih Ukuran</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="ukuran" id="ukuran_m" value="Medium" data-price="5000" checked>
                                <label class="form-check-label" for="ukuran_m">Medium (M) - Rp 5.000</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="ukuran" id="ukuran_l" value="Large" data-price="8000">
                                <label class="form-check-label" for="ukuran_l">Large (L) - Rp 8.000</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="jumlah" class="form-label">Jumlah</label>
                                <input type="number" class="form-control" id="jumlah" name="jumlah" value="1" min="1" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Pilihan Topping Premium</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" value="Oreo" id="topping_oreo" name="topping[]" data-price="2000">
                                    <label class="form-check-label" for="topping_oreo">Oreo Crumbs</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" value="Keju" id="topping_keju" name="topping[]" data-price="3000">
                                    <label class="form-check-label" for="topping_keju">Keju Cheddar</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" value="Coklat" id="topping_coklat" name="topping[]" data-price="2000">
                                    <label class="form-check-label" for="topping_coklat">Choco Chips</label>
                                </div>
                            </div>
                        </div>

                        <div class="mt-auto">
                            <div class="total-price-section d-flex justify-content-between align-items-center mb-4">
                                <h4 class="fw-normal mb-0">Total Pembayaran:</h4>
                                <h2 id="total_harga" class="fw-bold mb-0">Rp 5.000</h2>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-order btn-lg"><i class="fas fa-shopping-cart me-2"></i> Pesan Sekarang</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer-custom text-center py-4 mt-5">
        <div class="container">
            <p class="mb-0">&copy; 2025 Jeruk Peras Premium. Crafted with love.</p>
        </div>
    </footer>

    <script>
        function calculateTotal() {
            const selectedSize = document.querySelector('input[name="ukuran"]:checked');
            const hargaSatuan = selectedSize ? parseInt(selectedSize.dataset.price) : 0;
            
            const jumlah = parseInt(document.getElementById('jumlah').value) || 0;
            let totalHarga = hargaSatuan * jumlah;

            const toppings = document.querySelectorAll('input[name="topping[]"]:checked');
            toppings.forEach(topping => {
                totalHarga += parseInt(topping.dataset.price) * jumlah;
            });

            document.getElementById('total_harga').innerText = 'Rp ' + totalHarga.toLocaleString('id-ID');
        }

        function changeImage(element) {
            document.getElementById('main-product-image').src = element.src;
            
            // Handle active state for gallery
            document.querySelectorAll('.product-gallery img').forEach(img => img.classList.remove('active'));
            element.classList.add('active');
        }
        
        // Initial calculation on page load
        document.addEventListener('DOMContentLoaded', calculateTotal);
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
