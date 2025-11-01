-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 25, 2025 at 12:12 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dignet`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `nama_lengkap` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`, `nama_lengkap`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator'),
('123', '202cb962ac59075b964b07152d234b70', '123');

-- --------------------------------------------------------

--
-- Table structure for table `basis_pengetahuan`
--

CREATE TABLE `basis_pengetahuan` (
  `kode_pengetahuan` int NOT NULL,
  `kode_repair` int NOT NULL,
  `kode_incident` int NOT NULL,
  `mb` double(11,1) NOT NULL,
  `md` double(11,1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `basis_pengetahuan`
-- Aturan IF-THEN untuk diagnosis gangguan IndiHome
-- Format: IF gejala (incident) THEN gangguan (repair) {MB, MD}
--

INSERT INTO `basis_pengetahuan` (`kode_pengetahuan`, `kode_repair`, `kode_incident`, `mb`, `md`) VALUES
(121, 4, 6, 0.5, 0.2),
(122, 11, 7, 0.6, 0.2),
(123, 17, 7, 0.7, 0.1),
(124, 1, 8, 0.8, 0.1),
(125, 15, 8, 0.7, 0.1),
(126, 1, 9, 0.8, 0.2),
(127, 16, 9, 0.7, 0.1),
(128, 1, 10, 0.8, 0.2),
(129, 16, 10, 0.8, 0.1),
(130, 1, 11, 0.9, 0.1),
(131, 10, 11, 0.8, 0.1),
(132, 9, 12, 0.6, 0.2),
(133, 10, 13, 0.9, 0.1),
(134, 9, 14, 0.9, 0.1),
(105, 2, 1, 0.8, 0.2),
(120, 14, 6, 0.7, 0.2),
(119, 3, 5, 0.6, 0.2),
(118, 11, 5, 0.7, 0.1),
(117, 1, 5, 0.8, 0.2),
(116, 4, 4, 0.8, 0.2),
(115, 2, 4, 0.8, 0.1),
(114, 15, 4, 0.8, 0.2),
(113, 3, 3, 0.8, 0.2),
(112, 12, 3, 0.7, 0.2),
(111, 1, 3, 0.9, 0.1),
(110, 12, 2, 0.6, 0.2),
(109, 11, 2, 0.7, 0.1),
(108, 1, 2, 0.8, 0.2),
(107, 4, 1, 0.4, 0.1),
(106, 1, 1, 0.7, 0.1);

-- --------------------------------------------------------

--
-- Table structure for table `hasil`
--

CREATE TABLE `hasil` (
  `id_hasil` int NOT NULL,
  `tanggal` varchar(50) NOT NULL DEFAULT '0',
  `repair` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `incident` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `hasil_id` int NOT NULL,
  `hasil_nilai` varchar(16) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hasil`
-- Riwayat diagnosis pengguna sistem
--

INSERT INTO `hasil` (`id_hasil`, `tanggal`, `repair`, `incident`, `hasil_id`, `hasil_nilai`) VALUES
(350, '2025-08-25 12:29:23', 'a:1:{i:10;s:6:\"0.8000\";}', 'a:1:{i:13;s:1:\"1\";}', 10, '0.8000'),
(351, '2025-08-25 12:29:32', 'a:2:{i:17;s:6:\"0.6000\";i:11;s:6:\"0.4000\";}', 'a:1:{i:7;s:1:\"1\";}', 17, '0.6000'),
(349, '2025-08-25 12:23:06', 'a:4:{i:9;s:6:\"0.8000\";i:1;s:6:\"0.6000\";i:2;s:6:\"0.6000\";i:4;s:6:\"0.3000\";}', 'a:2:{i:1;s:1:\"1\";i:14;s:1:\"1\";}', 9, '0.8000'),
(347, '2025-08-25 12:11:24', 'a:5:{i:1;s:6:\"0.8400\";i:2;s:6:\"0.6000\";i:11;s:6:\"0.6000\";i:12;s:6:\"0.4000\";i:4;s:6:\"0.3000\";}', 'a:2:{i:1;s:1:\"1\";i:2;s:1:\"1\";}', 1, '0.8400'),
(348, '2025-08-25 12:22:58', 'a:3:{i:1;s:6:\"0.6000\";i:2;s:6:\"0.6000\";i:4;s:6:\"0.3000\";}', 'a:1:{i:1;s:1:\"1\";}', 1, '0.6000');

-- --------------------------------------------------------

--
-- Table structure for table `incident`
--

CREATE TABLE `incident` (
  `kode_incident` int NOT NULL,
  `nama_incident` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `incident`
-- Daftar gejala gangguan IndiHome
--

INSERT INTO `incident` (`kode_incident`, `nama_incident`) VALUES
(14, 'Remote STB error'),
(13, 'STB TV rusak'),
(12, 'UseeTV error saat digunakan'),
(11, 'UseeTV blank hitam'),
(10, 'UseeTV muncul kode error 1901 (Kesalahan pada stb)'),
(9, 'UseeTV muncul kode error 1305'),
(8, 'UseeTV muncul kode error 1302'),
(7, 'Internet lambat'),
(6, 'ONU offline'),
(5, 'Lampu indikator internet pada ONU berkedip'),
(4, 'Lampu indikator telepon pada ONU padam'),
(3, 'Lampu indikator PON pada ONU berwarna merah'),
(1, 'Telepon tidak dapat digunakan'),
(2, 'Internet tidak terhubung');

-- --------------------------------------------------------

--
-- Table structure for table `kondisi`
--

CREATE TABLE `kondisi` (
  `id` int NOT NULL,
  `kondisi` varchar(64) NOT NULL,
  `ket` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kondisi`
-- Tingkat kepastian user terhadap gejala
--

INSERT INTO `kondisi` (`id`, `kondisi`, `ket`) VALUES
(1, 'Pasti ya', ''),
(2, 'Hampir pasti ya', ''),
(3, 'Kemungkinan besar ya', ''),
(4, 'Mungkin ya', ''),
(5, 'Tidak tahu', ''),
(6, 'Mungkin tidak', ''),
(7, 'Kemungkinan besar tidak', ''),
(8, 'Hampir pasti tidak', ''),
(9, 'Pasti tidak', '');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `kode_post` int NOT NULL,
  `nama_post` varchar(50) NOT NULL,
  `det_post` varchar(15000) NOT NULL,
  `srn_post` varchar(15000) NOT NULL,
  `gambar` varchar(500) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `repair`
--

CREATE TABLE `repair` (
  `kode_repair` int NOT NULL,
  `nama_repair` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `det_repair` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `srn_repair` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `gambar` varchar(500) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `repair`
-- Daftar jenis gangguan IndiHome dan saran penanganan
--

INSERT INTO `repair` (`kode_repair`, `nama_repair`, `det_repair`, `srn_repair`, `gambar`) VALUES
(8, 'Ganti Patchcord', 'Ganti Patchcord', 'Ganti Patchcord', 'Ganti Patchcord'),
(9, 'Ganti Remote', 'Ganti Remote', 'Ganti Remote', 'Ganti Remote'),
(10, 'Ganti STB', 'Ganti STB', 'Ganti STB', 'Ganti STB'),
(11, 'Restart ONT', 'Restart ONT', 'Restart ONT', 'Restart ONT'),
(12, 'Revisi IKR', 'Revisi IKR', 'Revisi IKR', 'Revisi IKR'),
(13, 'Revisi ODP', 'Revisi ODP', 'Revisi ODP', 'Revisi ODP'),
(14, 'Revisi Sambung DC', 'Revisi Sambung DC', 'Revisi Sambung DC', 'Revisi Sambung DC'),
(15, 'Setting Ulang ONT', 'Setting Ulang ONT', 'Setting Ulang ONT', 'Setting Ulang ONT'),
(16, 'Setting Ulang STB', 'Setting Ulang STB', 'Setting Ulang STB', 'Setting Ulang STB'),
(17, 'Update Profile', 'Update Profile', 'Update Profile', 'Update Profile'),
(6, 'Ganti Kabel UTP RJ45', 'Ganti Kabel UTP RJ45', 'Ganti Kabel UTP RJ45', 'Ganti Kabel UTP RJ45'),
(7, 'Ganti ONT', 'Ganti ONT', 'Ganti ONT', 'Ganti ONT'),
(5, 'Ganti Adaptor Power Modem', 'Ganti Adaptor Power Modem', 'Ganti Adaptor Power Modem', 'Ganti Adaptor Power Modem'),
(4, 'Ganti Adaptor di ODP', 'Ganti Adaptor di ODP', 'Ganti Adaptor di ODP', 'Ganti Adaptor di ODP'),
(1, 'Create Ulang ONT', 'Create Ulang ONT', 'Create Ulang ONT', 'Create Ulang ONT'),
(2, 'Create Voice', 'Create Voice', 'Create Voice', 'Create Voice'),
(3, 'Ex Gamas FO Putus', 'Ex Gamas FO Putus', 'Ex Gamas FO Putus', 'Ex Gamas FO Putus');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `basis_pengetahuan`
--
ALTER TABLE `basis_pengetahuan`
  ADD PRIMARY KEY (`kode_pengetahuan`);

--
-- Indexes for table `hasil`
--
ALTER TABLE `hasil`
  ADD PRIMARY KEY (`id_hasil`);

--
-- Indexes for table `incident`
--
ALTER TABLE `incident`
  ADD PRIMARY KEY (`kode_incident`) USING BTREE;

--
-- Indexes for table `kondisi`
--
ALTER TABLE `kondisi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`kode_post`);

--
-- Indexes for table `repair`
--
ALTER TABLE `repair`
  ADD PRIMARY KEY (`kode_repair`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `basis_pengetahuan`
--
ALTER TABLE `basis_pengetahuan`
  MODIFY `kode_pengetahuan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT for table `hasil`
--
ALTER TABLE `hasil`
  MODIFY `id_hasil` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=352;

--
-- AUTO_INCREMENT for table `incident`
--
ALTER TABLE `incident`
  MODIFY `kode_incident` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `kondisi`
--
ALTER TABLE `kondisi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `kode_post` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `repair`
--
ALTER TABLE `repair`
  MODIFY `kode_repair` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
