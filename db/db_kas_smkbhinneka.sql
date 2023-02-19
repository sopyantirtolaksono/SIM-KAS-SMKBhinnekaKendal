-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2021 at 02:57 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kas_smkbhinneka`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_akun`
--

CREATE TABLE `tbl_akun` (
  `id_akun` int(11) NOT NULL,
  `tipe_akun` varchar(255) NOT NULL,
  `nama_akun` varchar(255) NOT NULL,
  `debet` int(255) NOT NULL,
  `kredit` int(255) NOT NULL,
  `debet_awal` int(255) NOT NULL,
  `kredit_awal` int(255) NOT NULL,
  `status_saldo` varchar(255) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_akun`
--

INSERT INTO `tbl_akun` (`id_akun`, `tipe_akun`, `nama_akun`, `debet`, `kredit`, `debet_awal`, `kredit_awal`, `status_saldo`, `tanggal`) VALUES
(32, 'pendapatan', 'spi', 0, 13500000, 0, 5000000, 'kredit', '2021-09-28'),
(33, 'pendapatan', 'spp', 0, 900000, 0, 500000, 'kredit', '2021-10-11'),
(34, 'biaya operasional', 'biaya internet', 1500000, 0, 1000000, 0, 'debet', '2021-10-17'),
(35, 'biaya operasional', 'biaya transportasi', 1750000, 0, 500000, 0, 'debet', '2021-10-25'),
(36, 'aktiva lancar', 'kas', 7000000, 0, 5000000, 0, 'debet', '2021-09-01'),
(38, 'pendapatan lainnya', 'bantuan pemerintah', 0, 15000000, 0, 15000000, 'kredit', '2021-12-01');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pendapatan`
--

CREATE TABLE `tbl_pendapatan` (
  `id_pendapatan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_akun` int(11) NOT NULL,
  `kode_transaksi` varchar(255) NOT NULL,
  `tanggal_pendapatan` date NOT NULL,
  `nama_akun` varchar(255) NOT NULL,
  `keterangan` text NOT NULL,
  `debet` int(255) NOT NULL,
  `kredit` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pengeluaran`
--

CREATE TABLE `tbl_pengeluaran` (
  `id_pengeluaran` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_akun` int(11) NOT NULL,
  `kode_transaksi` varchar(255) NOT NULL,
  `tanggal_pengeluaran` date NOT NULL,
  `nama_akun` varchar(255) NOT NULL,
  `keterangan` text NOT NULL,
  `debet` int(255) NOT NULL,
  `kredit` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(255) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL DEFAULT 'default.png'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `username`, `password`, `nama_lengkap`, `jenis_kelamin`, `jabatan`, `gambar`) VALUES
(1, '@andypur', '$2y$10$LmSTfdBbn9xzamhOnsSj2OXpKPYpWtxYtF2hqtK8s/THHT9ek18..', 'Andy Purnomo', 'laki-laki', 'kepala sekolah', 'default.png'),
(2, '@dina', '$2y$10$/Tv9r9dbwbBAF4MCU6kENeh7uqaej./3zgUFv4pg7HtYQthASJBn6', 'Dina Rebo', 'perempuan', 'bendahara', 'default.png'),
(3, '@gungun', '$2y$10$I6xkEBqm8D12nzR4YWgfOuj4fMQyQni4W89/EJGJEZKB11TaYfa7O', 'Pak Gunawan', 'laki-laki', 'pimpinan', 'default.png'),
(4, '@rebo', '$2y$10$bOWv10/OAjuaz1KD/VkHiOiQYSbSMgZ176F8YCYeW6kBJn2Q6CXgy', 'Pak Rebo', 'laki-laki', 'pimpinan', 'default.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_akun`
--
ALTER TABLE `tbl_akun`
  ADD PRIMARY KEY (`id_akun`),
  ADD KEY `nama_akun` (`nama_akun`);

--
-- Indexes for table `tbl_pendapatan`
--
ALTER TABLE `tbl_pendapatan`
  ADD PRIMARY KEY (`id_pendapatan`),
  ADD KEY `id_akun` (`id_akun`),
  ADD KEY `nama_akun` (`nama_akun`);

--
-- Indexes for table `tbl_pengeluaran`
--
ALTER TABLE `tbl_pengeluaran`
  ADD PRIMARY KEY (`id_pengeluaran`),
  ADD KEY `id_akun` (`id_akun`),
  ADD KEY `nama_akun` (`nama_akun`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_akun`
--
ALTER TABLE `tbl_akun`
  MODIFY `id_akun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `tbl_pendapatan`
--
ALTER TABLE `tbl_pendapatan`
  MODIFY `id_pendapatan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_pengeluaran`
--
ALTER TABLE `tbl_pengeluaran`
  MODIFY `id_pengeluaran` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_pendapatan`
--
ALTER TABLE `tbl_pendapatan`
  ADD CONSTRAINT `tbl_pendapatan_ibfk_1` FOREIGN KEY (`id_akun`) REFERENCES `tbl_akun` (`id_akun`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_pendapatan_ibfk_3` FOREIGN KEY (`nama_akun`) REFERENCES `tbl_akun` (`nama_akun`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_pengeluaran`
--
ALTER TABLE `tbl_pengeluaran`
  ADD CONSTRAINT `tbl_pengeluaran_ibfk_1` FOREIGN KEY (`id_akun`) REFERENCES `tbl_akun` (`id_akun`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_pengeluaran_ibfk_2` FOREIGN KEY (`nama_akun`) REFERENCES `tbl_akun` (`nama_akun`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
