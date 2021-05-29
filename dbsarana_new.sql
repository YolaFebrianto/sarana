-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2021 at 02:05 PM
-- Server version: 5.6.25
-- PHP Version: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbsarana`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblbarang`
--

CREATE TABLE IF NOT EXISTS `tblbarang` (
  `id_barang` int(11) NOT NULL,
  `tanggal_masuk` date DEFAULT NULL,
  `kode_barang` varchar(50) DEFAULT NULL,
  `nama_barang` varchar(200) NOT NULL,
  `lokasi_barang` varchar(200) DEFAULT NULL,
  `jumlah_barang` int(11) DEFAULT NULL,
  `kondisi_barang` varchar(200) DEFAULT NULL,
  `jenis_barang` varchar(200) DEFAULT NULL,
  `sumber_dana` varchar(200) DEFAULT NULL,
  `keterangan` text,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 COMMENT='Data Barang\r\n0 diinput staff, 1 divalidasi waka, 2 ditolak waka, 3 divalidasi kasek';

--
-- Dumping data for table `tblbarang`
--

INSERT INTO `tblbarang` (`id_barang`, `tanggal_masuk`, `kode_barang`, `nama_barang`, `lokasi_barang`, `jumlah_barang`, `kondisi_barang`, `jenis_barang`, `sumber_dana`, `keterangan`, `status`) VALUES
(1, '2021-03-07', 'BRG-001', 'Barang Masuk / Tunggu', 'Tunggu', 1, 'Baik', 'Baru', 'BPOPP', 'kosong	', 0),
(2, '2021-03-30', 'BRG-002', 'Barang Divalidasi Waka', 'Validasi waka', 2, 'Kurang Baik', 'Bekas', 'Direktorat', 'Barang Bagus', 1),
(3, '2021-03-07', 'BRG-003', 'Barang Ditolak Waka', 'Ditolak waka', 3, 'Kurang Baik', 'Bekas', 'BPUPP', 'Barang sisa', 2),
(4, '2021-03-07', 'BRG-004', 'Barang Disetujui', 'Setuju', 4, 'Baik', 'Baru', 'BOS', 'kondisi bagus', 3),
(6, '2021-03-10', 'BRG-006', 'Barang cob', 'Gudang 1', 2, 'Kurang Baik', 'Bekas', 'BOS', 'Kacau', 3),
(7, '2021-03-25', 'BRG-007', 'barang tes', 'tunggu', 1, 'Baik', 'Baru', 'BPOPP', 'tes', 0),
(8, '2021-03-19', 'BRG-008', 'tes', 'Gudang 1', 3, 'Kurang Baik', 'Bekas', 'BPOPP', 'tes barang', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblkelola`
--

CREATE TABLE IF NOT EXISTS `tblkelola` (
  `id_kelola` int(11) NOT NULL,
  `id_pengguna` int(11) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `status` enum('Masuk','Ditolak','Divalidasi','Disetujui') DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblkelola`
--

INSERT INTO `tblkelola` (`id_kelola`, `id_pengguna`, `id_barang`, `tanggal`, `status`) VALUES
(5, 2, 6, '2021-04-27 10:02:36', 'Masuk'),
(6, 3, 6, '2021-04-27 10:05:40', 'Ditolak'),
(7, 3, 6, '2021-04-27 10:06:43', 'Masuk'),
(8, 3, 6, '2021-04-27 10:06:55', 'Divalidasi'),
(9, 4, 6, '2021-04-27 10:07:17', 'Disetujui');

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE IF NOT EXISTS `tbluser` (
  `id_pengguna` int(11) NOT NULL,
  `full_name` varchar(200) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `level` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COMMENT='User';

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`id_pengguna`, `full_name`, `username`, `password`, `status`, `level`) VALUES
(1, 'Admin', 'admin', '827ccb0eea8a706c4c34a16891f84e7b', 1, 0),
(2, 'Staff', 'staff', '202cb962ac59075b964b07152d234b70', 1, 3),
(3, 'Waka Sarpras', 'waka', '250cf8b51c773f3f8dc8b4be867a9a02', 1, 2),
(4, 'Kepala Sekolah', 'kasek', '68053af2923e00204c3ca7c6a3150cf7', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblbarang`
--
ALTER TABLE `tblbarang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `tblkelola`
--
ALTER TABLE `tblkelola`
  ADD PRIMARY KEY (`id_kelola`);

--
-- Indexes for table `tbluser`
--
ALTER TABLE `tbluser`
  ADD PRIMARY KEY (`id_pengguna`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblbarang`
--
ALTER TABLE `tblbarang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tblkelola`
--
ALTER TABLE `tblkelola`
  MODIFY `id_kelola` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
