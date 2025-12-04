<?php
include 'koneksi.php';

// Data admin baru
$username_baru = 'bakuljeruk';
$password_baru = '180808';

// Enkripsi password menggunakan MD5
$password_md5 = md5($password_baru);

// Cek apakah username sudah ada
$query_cek = "SELECT * FROM admin WHERE username = '$username_baru'";
$result_cek = mysqli_query($koneksi, $query_cek);

if (!$result_cek) {
    die("Error: Tabel 'admin' kemungkinan tidak ada. Silakan buat tabel 'admin' terlebih dahulu dengan kolom 'username' dan 'password'.");
}

if (mysqli_num_rows($result_cek) > 0) {
    // Jika username sudah ada, update passwordnya
    $query_update = "UPDATE admin SET password = '$password_md5' WHERE username = '$username_baru'";
    if (mysqli_query($koneksi, $query_update)) {
        echo "<h2>Berhasil!</h2>";
        echo "Password untuk username '<b>{$username_baru}</b>' berhasil diupdate.<br>";
        echo "Silakan login dengan: <br>Username: <b>{$username_baru}</b><br>Password: <b>{$password_baru}</b><br>";
    } else {
        echo "Error updating record: " . mysqli_error($koneksi);
    }
} else {
    // Jika username belum ada, buat user baru
    $query_insert = "INSERT INTO admin (username, password) VALUES ('$username_baru', '$password_md5')";
    if (mysqli_query($koneksi, $query_insert)) {
        echo "<h2>Berhasil!</h2>";
        echo "User admin baru '<b>{$username_baru}</b>' berhasil dibuat.<br>";
        echo "Silakan login dengan: <br>Username: <b>{$username_baru}</b><br>Password: <b>{$password_baru}</b><br>";
    } else {
        echo "Error: " . $query_insert . "<br>" . mysqli_error($koneksi);
    }
}

mysqli_close($koneksi);

echo "<br><p style='color:red;'><b>PENTING:</b> Segera hapus file ini (<code>buat_admin_baru.php</code>) dari server Anda setelah selesai demi keamanan.</p>";
?>
