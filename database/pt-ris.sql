-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 24, 2025 at 11:55 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pt-ris`
--

-- --------------------------------------------------------

--
-- Table structure for table `kontak`
--

CREATE TABLE `kontak` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pesan` text NOT NULL,
  `status` enum('masuk','terbaca','selesai') DEFAULT 'masuk',
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kontak`
--

INSERT INTO `kontak` (`id`, `nama`, `email`, `pesan`, `status`, `timestamp`) VALUES
(1, 'John Doe', 'johndoe@example.com', 'Tanya tentang produk X', 'masuk', '2025-01-24 03:00:00'),
(2, 'Jane Smith', 'janesmith@example.com', 'Butuh bantuan untuk pemesanan', 'masuk', '2025-01-24 03:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `pengunjung`
--

CREATE TABLE `pengunjung` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengunjung`
--

INSERT INTO `pengunjung` (`id`, `ip_address`, `timestamp`) VALUES
(1, '192.168.1.1', '2025-01-24 03:00:00'),
(2, '192.168.1.2', '2025-01-24 04:00:00'),
(3, '192.168.1.3', '2025-01-24 05:00:00'),
(4, '192.168.1.4', '2025-01-24 10:47:57'),
(5, '192.168.1.5', '2025-01-24 10:47:57'),
(6, '192.168.1.6', '2025-01-24 10:47:57'),
(7, '192.168.1.7', '2025-01-24 10:47:57'),
(8, '192.168.1.8', '2025-01-24 10:47:57'),
(9, '192.168.1.9', '2025-01-24 10:47:57'),
(10, '192.168.1.10', '2025-01-24 10:47:57');

-- --------------------------------------------------------

--
-- Table structure for table `permintaan_bantuan`
--

CREATE TABLE `permintaan_bantuan` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `permintaan` text NOT NULL,
  `status` enum('pending','selesai','ditolak') DEFAULT 'pending',
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permintaan_bantuan`
--

INSERT INTO `permintaan_bantuan` (`id`, `nama`, `permintaan`, `status`, `timestamp`) VALUES
(1, 'John Doe', 'Minta bantuan untuk pembatalan pesanan', 'pending', '2025-01-24 03:00:00'),
(2, 'Jane Smith', 'Tanya tentang status pengiriman', 'pending', '2025-01-24 03:15:00');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `namaProduk` varchar(100) NOT NULL,
  `deskripsi` varchar(200) NOT NULL,
  `tipe` varchar(255) DEFAULT NULL,
  `ukuran` int(11) DEFAULT NULL,
  `namaGambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `namaProduk`, `deskripsi`, `tipe`, `ukuran`, `namaGambar`) VALUES
(2, 'PERTAMAX', 'MAX', 'image/png', 412971, 'RIS-product.png'),
(3, 'PERTAMAX', 'MAX', 'image/png', 154643, 'RIS-product.png'),
(4, 'PERTAMAX', 'MAX', 'image/png', 154643, 'RIS-product.png');

-- --------------------------------------------------------

--
-- Table structure for table `testimoni`
--

CREATE TABLE `testimoni` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `testimoni` text NOT NULL,
  `status` enum('positif','negatif','netral') DEFAULT 'positif',
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `testimoni`
--

INSERT INTO `testimoni` (`id`, `nama`, `testimoni`, `status`, `timestamp`) VALUES
(1, 'John Doe', 'Produk ini sangat bagus!', 'positif', '2025-01-24 03:00:00'),
(2, 'Jane Smith', 'Kualitasnya cukup memuaskan', 'positif', '2025-01-24 03:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` enum('admin') NOT NULL DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin@teknoonline.id', '$2y$10$HpxLwq/Qe0jKjulzX.QeAOl.VizpwLczUXo92f03giCaTR/.JVTma', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kontak`
--
ALTER TABLE `kontak`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengunjung`
--
ALTER TABLE `pengunjung`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permintaan_bantuan`
--
ALTER TABLE `permintaan_bantuan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimoni`
--
ALTER TABLE `testimoni`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kontak`
--
ALTER TABLE `kontak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pengunjung`
--
ALTER TABLE `pengunjung`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `permintaan_bantuan`
--
ALTER TABLE `permintaan_bantuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `testimoni`
--
ALTER TABLE `testimoni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
