<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_pemesan = mysqli_real_escape_string($koneksi, $_POST['nama_pemesan']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $ukuran = mysqli_real_escape_string($koneksi, $_POST['ukuran']);
    $jumlah = (int)$_POST['jumlah'];
    
    $topping_list = [];
    if (!empty($_POST['topping'])) {
        foreach ($_POST['topping'] as $topping) {
            $topping_list[] = mysqli_real_escape_string($koneksi, $topping);
        }
    }
    $toppings_str = implode(', ', $topping_list);

    // Kalkulasi ulang total harga di server untuk keamanan
    $harga_satuan = 0;
    if ($ukuran == 'Medium') {
        $harga_satuan = 5000;
    } elseif ($ukuran == 'Large') {
        $harga_satuan = 8000;
    }

    $harga_topping = 0;
    if (in_array('Oreo', $topping_list)) $harga_topping += 2000;
    if (in_array('Keju', $topping_list)) $harga_topping += 3000;
    if (in_array('Coklat', $topping_list)) $harga_topping += 2000;

    $total_harga = ($harga_satuan + $harga_topping) * $jumlah;
    $status = "Menunggu Konfirmasi";

    $query = "INSERT INTO pesanan (nama_pemesan, alamat, ukuran, topping, jumlah, total_harga, status) VALUES (?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "ssssids", $nama_pemesan, $alamat, $ukuran, $toppings_str, $jumlah, $total_harga, $status);
    
    if (mysqli_stmt_execute($stmt)) {
        $last_id = mysqli_insert_id($koneksi);
        header("Location: status_pesanan.php?id=" . $last_id);
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($koneksi);
} else {
    header("Location: index.php");
}
?>