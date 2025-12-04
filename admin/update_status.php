<?php
session_start();
if ($_SESSION['status'] != "login") {
    header("location:../login.php?pesan=belum_login");
}
include '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_pesanan = (int)$_POST['id_pesanan'];
    $status_baru = mysqli_real_escape_string($koneksi, $_POST['status_baru']);

    $query = "UPDATE pesanan SET status = ? WHERE id = ?";
    
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "si", $status_baru, $id_pesanan);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: index.php?update_status=sukses");
    } else {
        echo "Error updating record: " . mysqli_error($koneksi);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($koneksi);
} else {
    header("Location: index.php");
}
?>