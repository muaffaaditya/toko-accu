-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2025 at 01:53 PM
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
-- Database: `accu`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(3, 'aditya', '$2y$10$iixPjrd1mBa2C6OLrTjGWeJhDxAAZ/TEMdMH6NU34N7EX/OVfbteC');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `kode_customer` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `telp` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`kode_customer`, `nama`, `email`, `username`, `password`, `telp`) VALUES
('C0005', 'muaffaaditya88@gmail.com', 'muaffaaditya88@gmail.com', 'aditya', '$2y$10$81wTwUJyvI5qREHs2H94/eKl3bVGFnZKHOed5euqlxzjQakqdTtZ2', 'aditya'),
('C0006', 'muaffaaditya88@gmail.com', 'muaffaaditya88@gmail.com', 'Muaffa Aditya', '$2y$10$bMgw2tqjH4FoBLN8Gu/dVO.CS96sa038K96ZEfP6YyPIw05ub.WvG', 'aditya'),
('C0007', 'Nadziroh', '3130023042@student.unusa.ac.id', 'juleha', '$2y$10$qGBbD53FMgzo9qMB7oZmo.F16JGM1bIBEA8pXAtXK8MbsEhvtW2eq', '081249771960'),
('C0008', 'Muaffa Aditya', 'aditbehh04@gmail.com', 'sidoarjo', '$2y$10$uluZ2V0C9HJgc/YCxJQzkeu7ANZsfhQGc97QIa0hlssc/utoa9SGq', '081249771960');

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id_keranjang` int(11) NOT NULL,
  `kode_customer` varchar(100) NOT NULL,
  `kode_produk` varchar(100) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `qty` int(11) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `keranjang`
--

INSERT INTO `keranjang` (`id_keranjang`, `kode_customer`, `kode_produk`, `nama_produk`, `qty`, `harga`) VALUES
(148, 'C0007', 'P0005', 'Roti ', 1, 7000);

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id_pemesanan` int(11) NOT NULL,
  `invoice` varchar(30) DEFAULT NULL,
  `kode_customer` varchar(20) DEFAULT NULL,
  `provinsi` varchar(100) DEFAULT NULL,
  `kota` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `kode_pos` varchar(10) DEFAULT NULL,
  `kode_produk` varchar(20) DEFAULT NULL,
  `nama_produk` varchar(100) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `bukti_bayar` varchar(100) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'Pesanan Baru',
  `status_lanjutan` varchar(30) DEFAULT NULL,
  `pesanan_diterima` tinyint(1) DEFAULT 0,
  `alasan_batal` text DEFAULT NULL,
  `tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pemesanan`
--

INSERT INTO `pemesanan` (`id_pemesanan`, `invoice`, `kode_customer`, `provinsi`, `kota`, `alamat`, `kode_pos`, `kode_produk`, `nama_produk`, `qty`, `harga`, `gambar`, `bukti_bayar`, `status`, `status_lanjutan`, `pesanan_diterima`, `alasan_batal`, `tanggal`) VALUES
(26, 'INV20250506164305', 'C0007', '', 'Jl. Rajawali No.12 Rt.006 Rw.003 Punggul, kec, Gedangan kab, Sidoarjo, jawa timur 64432', '', '', 'P0105', 'calculator', 1, 7000, NULL, '681a1ff916fe6.png', '', '', 0, NULL, '2025-05-06'),
(28, 'INV20250508072513', 'C0008', '', 'a`', '', '', '1102', 'Amoxicillin ', 1, 9000, NULL, '681c40399816b.png', 'Ditolak', 'Selesai', 0, 'a', '2025-05-08'),
(29, 'INV20250508072513', 'C0008', '', 'a`', '', '', '1103', 'juleha', 1, 8000, NULL, '681c40399816b.png', 'Ditolak', 'Selesai', 0, NULL, '2025-05-08'),
(30, 'INV20250513172659', 'C0008', '', 'Jl. Rajawali No.12 Rt.006 Rw.003 Punggul, kec, Gedangan kab, Sidoarjo', '', '', 'P0006', 'edwed', 1, 10000, NULL, '682364c3303f5.jpg', 'Diterima', 'Selesai', 1, NULL, '2025-05-13'),
(31, 'INV20250519095729', 'C0008', '', 'Jl. Rajawali No.12 Rt.006 Rw.003 Punggul, kec, Gedangan kab, Sidoarjo', '', '', '1102', 'Amoxicillin ', 1, 9000, NULL, '682ae4697153c.png', 'Diterima', 'Selesai', 1, NULL, '2025-05-19');

-- --------------------------------------------------------

--
-- Table structure for table `pengaturan`
--

CREATE TABLE `pengaturan` (
  `nama` varchar(100) NOT NULL,
  `value` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengaturan`
--

INSERT INTO `pengaturan` (`nama`, `value`) VALUES
('foto benner', 'banner_1746540610.png');

-- --------------------------------------------------------

--
-- Table structure for table `produk_kapal`
--

CREATE TABLE `produk_kapal` (
  `kode_produk` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `image` text NOT NULL,
  `deskripsi` text NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk_kapal`
--

INSERT INTO `produk_kapal` (`kode_produk`, `nama`, `image`, `deskripsi`, `harga`) VALUES
('P0001', 'Amoxicillin ', '682ae0e044ec7.png', 'accu\r\n			', 12000),
('P0003', 'Amoxicillin ', '682ae12b975c1.png', 'obat\r\n			', 80000),
('P0004', 'Amoxicillin ', '682ae173341a4.png', 'obat', 80000),
('P0005', 'Amoxicillin ', '682ae1c20ff88.png', 'obat\r\n			', 80000);

-- --------------------------------------------------------

--
-- Table structure for table `produk_mobil`
--

CREATE TABLE `produk_mobil` (
  `kode_produk` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `image` text NOT NULL,
  `deskripsi` text NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk_mobil`
--

INSERT INTO `produk_mobil` (`kode_produk`, `nama`, `image`, `deskripsi`, `harga`) VALUES
('1102', 'Amoxicillin ', '680a1ffb402a0.png', 'obat\r\n			', 9000),
('1103', 'juleha', '680a200e1d804.png', 'kkkk\r\n			', 8000),
('P0104', 'Amoxicillin ', '680a3a83e55ff.png', 'obat panas\r\n			', 12000),
('P0105', 'calculator', '68188c6463bd2.png', 'alat hitung\r\n			', 7000);

-- --------------------------------------------------------

--
-- Table structure for table `produk_motor`
--

CREATE TABLE `produk_motor` (
  `kode_produk` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `image` text NOT NULL,
  `deskripsi` text NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk_motor`
--

INSERT INTO `produk_motor` (`kode_produk`, `nama`, `image`, `deskripsi`, `harga`) VALUES
('1003', 'Muaffa Aditya', '680a1fab3f3f5.png', 'ORANG\r\n			', 40000),
('1004', 'gambar', '680a5bc8bc4bb.png', 'pp\r\n			', 5000),
('1005', 'Roti ', '680b7e25bf2a0.png', 'makanan', 7000),
('P076', 'edwed', '68188c4a106a8.png', 'baju\r\n			', 10000);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`kode_customer`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_keranjang`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id_pemesanan`);

--
-- Indexes for table `pengaturan`
--
ALTER TABLE `pengaturan`
  ADD PRIMARY KEY (`nama`);

--
-- Indexes for table `produk_mobil`
--
ALTER TABLE `produk_mobil`
  ADD PRIMARY KEY (`kode_produk`);

--
-- Indexes for table `produk_motor`
--
ALTER TABLE `produk_motor`
  ADD PRIMARY KEY (`kode_produk`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;

--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id_pemesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
