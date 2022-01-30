-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 14, 2021 at 11:48 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tb_ldkom`
--

-- --------------------------------------------------------

--
-- Table structure for table `absen`
--

CREATE TABLE `absen` (
  `tanggal` date NOT NULL,
  `no_anggota` varchar(100) NOT NULL,
  `jam_masuk` time DEFAULT NULL,
  `jam_keluar` time DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `absen`
--

INSERT INTO `absen` (`tanggal`, `no_anggota`, `jam_masuk`, `jam_keluar`, `keterangan`) VALUES
('2021-07-22', 'LDKOM.07.01', '07:22:46', '16:02:46', 'Hadir'),
('2021-08-11', 'LDKOM.07.01', '07:20:00', '16:00:00', 'Hadir'),
('2021-08-11', 'LDKOM.07.11', NULL, NULL, 'Sakit'),
('2021-08-12', 'LDKOM.07.03', '07:35:00', '16:00:00', 'Terlambat'),
('2021-08-12', 'LDKOM.07.05', NULL, NULL, 'Sakit'),
('2021-08-12', 'LDKOM.07.11', NULL, NULL, 'Izin'),
('2021-08-13', 'LDKOM.07.03', NULL, NULL, 'Tidak Hadir'),
('2021-08-13', 'LDKOM.07.07', '07:40:00', '16:00:00', 'Terlambat'),
('2021-08-13', 'LDKOM.07.10', NULL, NULL, 'Tidak Hadir'),
('2021-08-13', 'LDKOM.07.11', NULL, NULL, 'Izin'),
('2021-08-16', 'LDKOM.07.04', NULL, NULL, 'Sakit'),
('2021-08-16', 'LDKOM.07.07', '07:35:00', '16:00:00', 'Terlambat'),
('2021-08-16', 'LDKOM.07.09', NULL, NULL, 'Izin');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `kode_hari` varchar(100) NOT NULL,
  `hari` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`kode_hari`, `hari`) VALUES
('1', 'Senin'),
('2', 'Selasa'),
('3', 'Rabu'),
('4', 'Kamis'),
('5', 'Jumat');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_user`
--

CREATE TABLE `jadwal_user` (
  `kode_hari` varchar(100) NOT NULL,
  `no_anggota` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jadwal_user`
--

INSERT INTO `jadwal_user` (`kode_hari`, `no_anggota`) VALUES
('1', 'LDKOM.07.04'),
('1', 'LDKOM.07.07'),
('1', 'LDKOM.07.09'),
('2', 'LDKOM.07.01'),
('2', 'LDKOM.07.05'),
('2', 'LDKOM.07.07'),
('3', 'LDKOM.07.01'),
('3', 'LDKOM.07.03'),
('3', 'LDKOM.07.08'),
('3', 'LDKOM.07.09'),
('4', 'LDKOM.07.03'),
('4', 'LDKOM.07.05'),
('4', 'LDKOM.07.11'),
('5', 'LDKOM.07.03'),
('5', 'LDKOM.07.07'),
('5', 'LDKOM.07.10'),
('5', 'LDKOM.07.11');

-- --------------------------------------------------------

--
-- Table structure for table `tamu`
--

CREATE TABLE `tamu` (
  `id` int(11) NOT NULL,
  `nim` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `waktu_kedatangan` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `tujuan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tamu`
--

INSERT INTO `tamu` (`id`, `nim`, `nama`, `waktu_kedatangan`, `tujuan`) VALUES
(21, '1911523003', 'Andi', '2020-08-13 15:43:15', 'Praktikum Dasar-Dasar Pemrograman'),
(22, '2011521001', 'Joni', '2020-08-14 02:13:06', 'Praktikum Struktur Data dan Algoritma'),
(23, '1811522002', 'Ned', '2021-08-14 02:13:33', 'Praktikum Bahasa Pemrograman Lanjut'),
(24, '1911522003', 'Bima', '2021-07-14 02:13:59', 'Praktikum Pemrograman Web'),
(25, '1711521001', 'Sultan', '2019-08-14 02:14:23', 'Praktikum Dasar-Dasar Pemrograman'),
(26, '2011523003', 'Joey', '2019-08-14 02:14:52', 'Praktikum Struktur Data dan Algoritma'),
(27, '1811523002', 'Modric', '2021-08-14 02:15:11', 'Praktikum Pemrograman Web'),
(28, '1911521010', 'Zoro', '2021-08-14 02:15:39', 'Praktikum Struktur Data dan Algoritma'),
(29, '1911522010', 'Kanye', '2021-07-14 02:16:02', 'Praktikum Pemrograman Web'),
(30, '1911521011', 'Snoop Dogg', '2021-07-14 02:18:00', 'Praktikum Struktur Data dan Algoritma'),
(31, '2011522020', 'Ali', '2021-07-14 02:18:24', 'Praktikum Bahasa Pemrograman Lanjut'),
(32, '1911523030', 'Yuu', '2021-08-14 02:18:43', 'Praktikum Dasar-Dasar Pemrograman'),
(33, '1911522002', 'Ari', '2021-08-14 09:16:30', 'Praktikum Dasar-Dasar Pemrograman');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `no_anggota` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`no_anggota`, `nama`, `password`, `role`, `foto`) VALUES
('LDKOM.07.01', 'Robert', '$2y$10$lN9el6.Ix6zZuhCFFwXMOuf3OYhysKDP1QTZkcJhZwAF9.NX4gdl6', 'Asisten', 'default.jpg'),
('LDKOM.07.02', 'Young', '$2y$10$hY/B0h8WesYUnB32kL7L.exSWHnDNgrWceynt8QUNQzEJiUYhMsOG', 'Asisten', 'default.jpg'),
('LDKOM.07.03', 'Bryson', '$2y$10$bdE3f0CVEGLkpAfLUYJtTe88XiFi18Y5uI5ANgHBWWr82Ejk385li', 'Asisten', 'default.jpg'),
('LDKOM.07.04', 'Jarad', '$2y$10$7viq2MEYQ2nD64PIiIZsL.tQNvfLF6DAG1k/Ims1GymZEpshryhce', 'Asisten', 'default.jpg'),
('LDKOM.07.05', 'Marshal', '$2y$10$9yv87ZdHMkvbwEo2gF7CR.75/AS6FyVB7b64WZNgufUvCUwH9pnsO', 'Asisten', 'default.jpg'),
('LDKOM.07.06', 'Abdullah', '$2y$10$6.YOv3Y1RJP8tDUYTh/czuZKCc4Wf7yQ/UfDJsdGtDCheDOp3grVC', 'Asisten', 'default.jpg'),
('LDKOM.07.07', 'Untung Jamari', '$2y$10$keqECUwZ33Nt2acN2j0a5.KRfEgH8LXdWtLoNhxE8DW4Nys1/AbIe', 'Asisten', 'add-cross-delete-exit-remove-icon-674507.png'),
('LDKOM.07.08', 'Aminah', '$2y$10$gTGF1bJQq60wUulz9DNNTOvHKRfH7S949jUv/yF5P8mMdbwmG5cH6', 'Asisten', 'default.jpg'),
('LDKOM.07.09', 'Ginda Teguh Imani', '$2y$10$fNnJga6Qn5a2WfQqfviawuAUML9pTumhMmIuOxN5tXPRvCb3M/5fa', 'Asisten', 'default.jpg'),
('LDKOM.07.10', 'Lucy', '$2y$10$tuf5LFKaPTNr6c/OBviChO5GFUeRIVHVkPdAMMpGbgSEo8bAOfpbi', 'Asisten', 'default.jpg'),
('LDKOM.07.11', 'Stephen', '$2y$10$r7lS6PTU8STG.to5rTXnDemcqKtEGaXBMKobMv6Hpp.hsHwjq2rma', 'Asisten', 'default.jpg'),
('LDKOM.08.01', 'Ari', '$2y$10$G9si4KxtMdqvU0NGk7eZFOZVqJ9lIBzI51SFfRxXv4rv/o0TG4rPG', 'Asisten', 'default.jpg'),
('LDKOM.K', 'Haris Suryamen', '$2y$10$Axb/hZuTqlobqxSAq4nWaumKQefO6FNyixionrVX9F3/y81/.kVTa', 'Kepala Ldkom', 'orangtamvan.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absen`
--
ALTER TABLE `absen`
  ADD PRIMARY KEY (`tanggal`,`no_anggota`),
  ADD KEY `absen_ibfk_1` (`no_anggota`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`kode_hari`);

--
-- Indexes for table `jadwal_user`
--
ALTER TABLE `jadwal_user`
  ADD PRIMARY KEY (`kode_hari`,`no_anggota`),
  ADD KEY `jadwal_user_ibfk_2` (`no_anggota`);

--
-- Indexes for table `tamu`
--
ALTER TABLE `tamu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`no_anggota`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tamu`
--
ALTER TABLE `tamu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absen`
--
ALTER TABLE `absen`
  ADD CONSTRAINT `absen_ibfk_1` FOREIGN KEY (`no_anggota`) REFERENCES `user` (`no_anggota`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jadwal_user`
--
ALTER TABLE `jadwal_user`
  ADD CONSTRAINT `jadwal_user_ibfk_1` FOREIGN KEY (`kode_hari`) REFERENCES `jadwal` (`kode_hari`),
  ADD CONSTRAINT `jadwal_user_ibfk_2` FOREIGN KEY (`no_anggota`) REFERENCES `user` (`no_anggota`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
