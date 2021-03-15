-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 11, 2021 at 10:39 AM
-- Server version: 10.3.27-MariaDB-cll-lve
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
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

CREATE TABLE `tblbarang` (
  `no` int(11) NOT NULL,
  `tanggal_masuk` date DEFAULT NULL,
  `kode_barang` varchar(50) DEFAULT NULL,
  `nama_barang` varchar(200) NOT NULL,
  `lokasi_barang` varchar(200) DEFAULT NULL,
  `jumlah_barang` int(11) DEFAULT NULL,
  `kondisi_barang` varchar(200) DEFAULT NULL,
  `jenis_barang` varchar(200) DEFAULT NULL,
  `sumber_dana` varchar(200) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Data Barang\r\n0 diinput staff, 1 divalidasi waka, 2 ditolak waka, 3 divalidasi kasek';

--
-- Dumping data for table `tblbarang`
--

INSERT INTO `tblbarang` (`no`, `tanggal_masuk`, `kode_barang`, `nama_barang`, `lokasi_barang`, `jumlah_barang`, `kondisi_barang`, `jenis_barang`, `sumber_dana`, `keterangan`, `status`) VALUES
(1, '2021-03-09', 'BRG-001', 'Barang Masuk / Tunggu', 'Tunggu', 1, 'Baik', 'Baru', 'Direktorat', 'kosong	', 3),
(2, '2021-03-07', 'BRG-002', 'Barang Divalidasi Waka', 'Validasi waka', 2, 'Baik', 'Baru', 'Direktorat', 'Barang Bagus', 1),
(3, '2021-03-07', 'BRG-003', 'Barang Ditolak Waka', 'Ditolak waka', 3, 'Kurang Baik', 'Bekas', 'BPUPP', 'Barang sisa', 2),
(4, '2021-03-07', 'BRG-004', 'Barang Disetujui', 'Setuju', 4, 'Baik', 'Baru', 'BOS', 'kondisi bagus', 3),
(5, '2021-03-09', 'BRG-04', 'Kursi', 'Kelas XII-RPL 1', 50, 'Baik', 'Baru', 'BOS', '', 3),
(6, '2021-03-09', 'BRG-005', 'Meja', 'Kelas XII-RPL 1', 2, 'Baik', 'Baru', 'Direktorat', '', 3),
(7, '2021-03-09', 'BRG-007', 'Barang coba2', 'Gudang Baru', 2, 'Kurang Baik', 'Bekas', 'BPUPP', 'Kurang Baik', 2),
(8, '2021-03-10', 'BRG-008', 'Papan Tulis', 'Ruang BK', 7, 'Baik', 'Bekas', 'Dana Masyarakat', 'Barang baru', 1),
(9, '2021-03-10', 'BRG-009', 'Proyektor', 'Ruang Guru', 3, 'Baik', 'Baru', 'Direktorat', 'Merek Panasonic', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE `tbluser` (
  `id` int(11) NOT NULL,
  `full_name` varchar(200) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `level` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='User';

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`id`, `full_name`, `username`, `password`, `status`, `level`) VALUES
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
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `tbluser`
--
ALTER TABLE `tbluser`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblbarang`
--
ALTER TABLE `tblbarang`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
