-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2025 at 05:17 PM
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
(1, '192.168.1.1', '2025-01-01 03:00:00'),
(2, '192.168.1.2', '2025-01-01 04:00:00'),
(3, '192.168.1.3', '2025-01-02 05:00:00'),
(4, '192.168.1.4', '2025-01-04 10:47:57'),
(5, '192.168.1.5', '2025-01-04 10:47:57'),
(6, '192.168.1.6', '2025-01-24 10:47:57'),
(7, '192.168.1.7', '2025-01-24 10:47:57'),
(8, '192.168.1.8', '2025-01-24 10:47:57'),
(9, '192.168.1.9', '2025-01-24 10:47:57'),
(10, '192.168.1.10', '2025-01-24 10:47:57'),
(11, '::1', '2025-01-25 15:46:20');

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
(2, 'B30 Solar Industri', 'Pencampuran 30% Biodiesel dengan 70% bahan bakar minyak jenis Solar, yang menghasilkan produk Biosolar B30.', 'image/png', 154643, 'RIS-product.png'),
(3, 'B35 High Speed Diesel', 'Pencampuran 35 persen minyak sawit dan 65 persen solar. Tujuan dari program peluncuran ini adalah untuk meningkatkan pasokan supply energi secara berkelanjutan. Selain itu, keberadaannya juga sebagai ', 'image/png', 154643, 'RIS-product.png'),
(4, 'Pertamina DEX', 'Bahan bakar untuk mesin diesel yang memiliki angka cetane tertinggi dibandingkan produk lainnya yaitu 53. Dengan menggunakan pertamina dex banyak manfaat yang didapatkan yaitu meningkatkan daya mesin,', 'image/png', 154643, 'RIS-product.png'),
(5, 'MFO (Marine Fuel Oil)', 'Merupakan salah satu jenis bahan bakar dari proses residu destilasi minyak bakar. Sifat dari MFO yaitu stabilitas, kekentalan, korosifitas, kebersihan, dan keselamatan.', 'image/png', 154643, 'RIS-product.png'),
(6, 'Euro 5', 'Merupakan jenis bahan bakar standar emisi yang ditetapkan oleh Uni Eropa untuk kendaraan bermotor, termasuk yang menggunakan solar industri. Standar emisi Euro 5 merupakan standar emisi yang berlaku s', 'image/png', 154643, 'RIS-product.png');

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
-- Indexes for table `produk`
--
ALTER TABLE `produk`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
