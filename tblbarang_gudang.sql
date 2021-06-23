-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.25 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table dbsarana.tblbarang_gudang
CREATE TABLE IF NOT EXISTS `tblbarang_gudang` (
  `id_barang_gudang` int(11) NOT NULL AUTO_INCREMENT,
  `id_barang` int(11) NOT NULL,
  `tanggal_masuk_gudang` date DEFAULT NULL,
  `kode_barang` varchar(50) DEFAULT NULL,
  `jumlah_barang` int(11) DEFAULT '0',
  `kondisi_barang` varchar(200) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_barang_gudang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Data Barang di Gudang\r\n0 barang gudang, 1 barang rusak';

-- Dumping data for table dbsarana.tblbarang_gudang: ~0 rows (approximately)
/*!40000 ALTER TABLE `tblbarang_gudang` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblbarang_gudang` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
