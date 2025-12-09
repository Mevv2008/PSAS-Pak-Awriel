-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Des 2025 pada 04.41
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jeruk_peras`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3'),
(2, 'bakuljeruk', 'f8167e4dd375212cb012973fb4d780dd');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan`
--

CREATE TABLE `pesanan` (
  `id` int(11) NOT NULL,
  `nama_pemesan` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `ukuran` varchar(50) NOT NULL,
  `topping` varchar(255) DEFAULT NULL,
  `jumlah` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Diterima',
  `tanggal_pesan` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pesanan`
--

INSERT INTO `pesanan` (`id`, `nama_pemesan`, `alamat`, `ukuran`, `topping`, `jumlah`, `total_harga`, `status`, `tanggal_pesan`) VALUES
(1, 'meva', '', '', 'Oreo, Keju, Coklat', 2, 24000, 'Selesai', '2025-09-10 01:48:26'),
(2, 'meva', '', '', '', 3, 15000, 'Selesai', '2025-10-15 00:20:58'),
(3, 'jati', '', '', 'Oreo', 1, 7000, 'Selesai', '2025-10-15 01:23:46'),
(4, 'jati', '', '', 'Oreo', 1, 7000, 'Selesai', '2025-10-15 01:25:30'),
(5, 'asik', 'banjarnegara ', '', 'Oreo', 4, 28000, 'Dibatalkan', '2025-10-15 01:36:08'),
(6, 'mm', 'rejasa', '', 'Coklat', 1, 7000, 'Diterima', '2025-10-15 03:17:43'),
(7, 'mm', 'r', '', '', 1, 5000, 'Menunggu Konfirmasi', '2025-10-15 03:19:43'),
(8, 'mm', 'r', '', '', 1, 5000, 'Menunggu Konfirmasi', '2025-10-15 03:28:40'),
(9, 'mm', 'r', '', '', 1, 5000, 'Menunggu Konfirmasi', '2025-10-15 03:31:14'),
(10, 'm', 'p', 'Large', 'Oreo, Keju', 1, 13000, 'Selesai', '2025-10-15 03:35:34'),
(11, ' gf', 'f', 'Medium', '', 1, 5000, 'Menunggu Konfirmasi', '2025-10-15 03:54:10');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
