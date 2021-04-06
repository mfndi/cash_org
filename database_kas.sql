-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 06, 2021 at 02:34 PM
-- Server version: 10.3.25-MariaDB-0ubuntu0.20.04.1
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `database_kas`
--

-- --------------------------------------------------------

--
-- Table structure for table `cash_anggota`
--

CREATE TABLE `cash_anggota` (
  `id_anggota` int(11) NOT NULL,
  `nama_anggota` varchar(255) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `ponsel_anggota` bigint(20) NOT NULL,
  `email_anggota` varchar(100) NOT NULL,
  `alamat_anggota` varchar(500) NOT NULL,
  `code_uniq` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cash_anggota`
--

INSERT INTO `cash_anggota` (`id_anggota`, `nama_anggota`, `tgl_lahir`, `ponsel_anggota`, `email_anggota`, `alamat_anggota`, `code_uniq`) VALUES
(32, 'Bastian', '2021-04-06', 82121211212, 'bastian@jancok.com', 'jauh banget pokok nya', '6c2639837c1965f0c6c21aa65eed5efc'),
(33, 'Park Jink Cok', '2021-04-06', 323123123, 'parkjinkcok@gmail.com', 'gatau dimana', 'c41632077e16dfe717ef6c7c302d3851'),
(34, 'CJ Andreass jancok', '2021-04-13', 423123123, 'jancok@gmail.com', 'CJ CITY', '15ba2169b4accaa0e13aa4fe8eea71d0'),
(35, 'Daniel Jancok', '2021-04-06', 2313123123, 'jancok@gmail.com', 'nggatau dimana alamat nya', 'ea686be25060303d36b1a30aac2995ab'),
(36, 'Ericontol', '2021-04-06', 544534234, 'jacnu2@gmail.com', 'jancuk', '461ee9f62459ce89adbb0b5375ea097c');

-- --------------------------------------------------------

--
-- Table structure for table `cash_catatan`
--

CREATE TABLE `cash_catatan` (
  `id` int(11) NOT NULL,
  `catatan` varchar(255) NOT NULL,
  `nominal_uang` int(100) NOT NULL,
  `tanggal` date NOT NULL,
  `code_uniq` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cash_catatan`
--

INSERT INTO `cash_catatan` (`id`, `catatan`, `nominal_uang`, `tanggal`, `code_uniq`) VALUES
(24, 'Bayar tempat ngumpul', 50000, '2021-04-06', '1f421ddcaa2eed82da974a13b32f2509'),
(25, 'Bayar Makan member', 200000, '2021-04-06', 'f667573eadca3e9638ead2504421ead0');

-- --------------------------------------------------------

--
-- Table structure for table `cash_masuk`
--

CREATE TABLE `cash_masuk` (
  `id` int(11) NOT NULL,
  `bayar_anggota` varchar(255) NOT NULL,
  `nominal_cash` int(100) NOT NULL,
  `ket_pembayaran` varchar(255) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `code_uniq` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cash_masuk`
--

INSERT INTO `cash_masuk` (`id`, `bayar_anggota`, `nominal_cash`, `ket_pembayaran`, `tgl_masuk`, `code_uniq`) VALUES
(28, 'Ericontol', 50000, 'bayar transfer bank\r\n', '2021-04-06', '0fd878d7479ad0e2f18d1b9e634b25b5'),
(29, 'Daniel Jancok', 100000, 'cash', '2021-04-06', '700f106ca17dafc33998de380d5f0946'),
(30, 'CJ Andreass jancok', 200000, 'ovo', '2021-04-06', '303745e099178e657adaf2f96480c4aa'),
(31, 'Park Jink Cok', 200000, 'bayar pake daun', '2021-04-06', 'd44ed1fbff51bd0a10896fa1194fe45e'),
(32, 'Bastian', 100000, 'bayar pake gopay', '2021-04-06', '0390a8964a10e84e5337f674c73cc52f');

-- --------------------------------------------------------

--
-- Table structure for table `cash_user`
--

CREATE TABLE `cash_user` (
  `id` int(11) NOT NULL,
  `nama_awal` varchar(255) NOT NULL,
  `nama_akhir` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `level_user` varchar(255) NOT NULL,
  `passwd` varchar(255) NOT NULL,
  `code_uniq` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cash_user`
--

INSERT INTO `cash_user` (`id`, `nama_awal`, `nama_akhir`, `email`, `level_user`, `passwd`, `code_uniq`) VALUES
(7, 'Muhamad', 'Efendi', 'efendi@gmail.com', 'Admin', '$2y$10$BssS51cSSgiq2DYPoat4RO03Gfn4bB1bv30gRAQEImZRPKZiv5wDW', '912c23e0b7b721cd85c481f64b15e0a8'),
(15, 'Epen', 'Keren Banget', 'epen@epen', 'Moderator', '$2y$10$BxE/vhWA4B4OYxRrwVYA0utSl3JVmJ5f89R19oftAJe/nxdMKue0a', 'e98d26da3ad9380d104c0e694eb21da2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cash_anggota`
--
ALTER TABLE `cash_anggota`
  ADD PRIMARY KEY (`id_anggota`);

--
-- Indexes for table `cash_catatan`
--
ALTER TABLE `cash_catatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cash_masuk`
--
ALTER TABLE `cash_masuk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cash_user`
--
ALTER TABLE `cash_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cash_anggota`
--
ALTER TABLE `cash_anggota`
  MODIFY `id_anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `cash_catatan`
--
ALTER TABLE `cash_catatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `cash_masuk`
--
ALTER TABLE `cash_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `cash_user`
--
ALTER TABLE `cash_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
