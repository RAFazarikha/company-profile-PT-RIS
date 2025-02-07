/*
SQLyog Community v13.2.0 (64 bit)
MySQL - 8.0.30 : Database - pt-ris
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`pt-ris` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `pt-ris`;

/*Table structure for table `artikel` */

DROP TABLE IF EXISTS `artikel`;

CREATE TABLE `artikel` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `namaGambar` varchar(255) DEFAULT NULL,
  `tipeGambar` varchar(50) DEFAULT NULL,
  `ukuranGambar` int DEFAULT NULL,
  `likes` int DEFAULT '0',
  `create_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `namaAuthor` varchar(255) DEFAULT NULL,
  `deskripsiAuthor` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `artikel` */

insert  into `artikel`(`id`,`title`,`content`,`namaGambar`,`tipeGambar`,`ukuranGambar`,`likes`,`create_at`,`namaAuthor`,`deskripsiAuthor`) values 
(3,'Harga Minyak Naik','Kenaikan harga minyak merupakan fenomena ekonomi yang sering kali memengaruhi berbagai sektor kehidupan. Harga minyak naik biasanya terjadi akibat kombinasi dari beberapa faktor, seperti peningkatan permintaan global, penurunan produksi oleh negara-negara produsen minyak, ketegangan geopolitik, dan gangguan pada rantai pasok.','RIS-image1.png','image/png',581875,0,'2025-01-26 12:46:59','Rakha','Seorang mahasiswa S1');

/*Table structure for table `coment` */

DROP TABLE IF EXISTS `coment`;

CREATE TABLE `coment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `komentar` text NOT NULL,
  `create_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `idArtikel` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idArtikel` (`idArtikel`),
  CONSTRAINT `coment_ibfk_1` FOREIGN KEY (`idArtikel`) REFERENCES `artikel` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `coment` */

insert  into `coment`(`id`,`nama`,`email`,`komentar`,`create_at`,`idArtikel`) values 
(2,'Sabil','sabiluddin@gmail.com','Berita yang menarik','2025-01-26 12:50:04',3);

/*Table structure for table `kontak` */

DROP TABLE IF EXISTS `kontak`;

CREATE TABLE `kontak` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `pesan` text COLLATE utf8mb4_general_ci NOT NULL,
  `status` enum('masuk','terbaca','selesai') COLLATE utf8mb4_general_ci DEFAULT 'masuk',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `kontak` */

insert  into `kontak`(`id`,`nama`,`email`,`pesan`,`status`,`timestamp`) values 
(1,'John Doe','johndoe@example.com','Tanya tentang produk X','masuk','2025-01-24 10:00:00'),
(2,'Jane Smith','janesmith@example.com','Butuh bantuan untuk pemesanan','masuk','2025-01-24 10:30:00');

/*Table structure for table `pengunjung` */

DROP TABLE IF EXISTS `pengunjung`;

CREATE TABLE `pengunjung` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pengunjung` */

insert  into `pengunjung`(`id`,`ip_address`,`timestamp`) values 
(1,'192.168.1.1','2025-01-01 10:00:00'),
(2,'192.168.1.2','2025-01-01 11:00:00'),
(3,'192.168.1.3','2025-01-02 12:00:00'),
(4,'192.168.1.4','2025-01-04 17:47:57'),
(5,'192.168.1.5','2025-01-04 17:47:57'),
(6,'192.168.1.6','2025-01-24 17:47:57'),
(7,'192.168.1.7','2025-01-24 17:47:57'),
(8,'192.168.1.8','2025-01-24 17:47:57'),
(9,'192.168.1.9','2025-01-24 17:47:57'),
(10,'192.168.1.10','2025-01-24 17:47:57'),
(11,'::1','2025-01-25 22:46:20'),
(12,'127.0.0.1','2025-01-26 07:12:06'),
(13,'127.0.0.1','2025-01-27 20:38:50'),
(14,'127.0.0.1','2025-01-30 19:37:19'),
(15,'127.0.0.1','2025-02-07 18:12:14');

/*Table structure for table `produk` */

DROP TABLE IF EXISTS `produk`;

CREATE TABLE `produk` (
  `id` int NOT NULL AUTO_INCREMENT,
  `namaProduk` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `deskripsi` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `tipe` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ukuran` int DEFAULT NULL,
  `namaGambar` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `produk` */

insert  into `produk`(`id`,`namaProduk`,`deskripsi`,`tipe`,`ukuran`,`namaGambar`) values 
(3,'B35 High Speed Diesel','Pencampuran 35 persen minyak sawit dan 65 persen solar. Tujuan dari program peluncuran ini adalah untuk meningkatkan pasokan supply energi secara berkelanjutan. Selain itu, keberadaannya juga sebagai ','image/png',154643,'RIS-product.png'),
(4,'Pertamina DEX','Bahan bakar untuk mesin diesel yang memiliki angka cetane tertinggi dibandingkan produk lainnya yaitu 53. Dengan menggunakan pertamina dex banyak manfaat yang didapatkan yaitu meningkatkan daya mesin,','image/png',154643,'RIS-product.png'),
(5,'MFO (Marine Fuel Oil)','Merupakan salah satu jenis bahan bakar dari proses residu destilasi minyak bakar. Sifat dari MFO yaitu stabilitas, kekentalan, korosifitas, kebersihan, dan keselamatan.','image/png',154643,'RIS-product.png'),
(6,'Euro 5','Merupakan jenis bahan bakar standar emisi yang ditetapkan oleh Uni Eropa untuk kendaraan bermotor, termasuk yang menggunakan solar industri. Standar emisi Euro 5 merupakan standar emisi yang berlaku s','image/png',154643,'RIS-product-1.png'),
(7,'B30 Solar Industri','Pencampuran 30% Biodiesel dengan 70% bahan bakar minyak jenis Solar, yang menghasilkan produk Biosolar 830.','image/png',154643,'RIS-product-1.png');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `role` enum('admin') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'admin',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`username`,`password`,`role`) values 
(1,'admin@teknoonline.id','$2y$10$HpxLwq/Qe0jKjulzX.QeAOl.VizpwLczUXo92f03giCaTR/.JVTma','admin');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
