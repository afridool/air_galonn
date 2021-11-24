-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2021 at 07:13 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `air_galon`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `email`) VALUES
(2, 'admin', 'admin', 'admin@email.com');

-- --------------------------------------------------------

--
-- Table structure for table `depot_galon`
--

CREATE TABLE `depot_galon` (
  `nama_galon` varchar(100) NOT NULL,
  `nama_depot` varchar(100) NOT NULL,
  `harga_isi_ulang` varchar(100) NOT NULL,
  `harga_galon_baru` varchar(100) NOT NULL,
  `lokasi_depot` varchar(100) NOT NULL,
  `no_hp` varchar(100) NOT NULL,
  `id_galon` varchar(100) NOT NULL,
  `alamat_depot` varchar(100) NOT NULL,
  `latitude` varchar(100) NOT NULL,
  `longitude` varchar(100) NOT NULL,
  `gambar_depot` varchar(100) NOT NULL,
  `pemilik` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `depot_galon`
--

INSERT INTO `depot_galon` (`nama_galon`, `nama_depot`, `harga_isi_ulang`, `harga_galon_baru`, `lokasi_depot`, `no_hp`, `id_galon`, `alamat_depot`, `latitude`, `longitude`, `gambar_depot`, `pemilik`, `username`, `password`) VALUES
('Air Galon Abu Gaza', 'Depot Air Galon Abu Gaza', '3000', '45000', 'Bina Widya', '0812345678', 'DPT003', 'Jl. Merak Sakti, Kec. Bina Widya, Kota Pekanbaru', '0.4685935', '101.3886644', '783118.jpeg', 'Deky', 'Deky', 'Deky'),
('Air Minum Comando Group', 'Depot Air Minum Comando Group', '3500', '35000', 'Marpoyan Damai', '081345678909', 'DPT004', 'Jl. Kaharuddin Nasution, Kec. Marpoyan Damai, Kota Pekanbaru', '0.12345789', '2345678', '498774.jpeg', 'Zulfahmi', 'Zulfahmi', '123456'),
('Air Galon Bahari', 'Depot Air Minum Galon Bahari', '3000', '40000', 'Marpoyan Damai', '081312435687', 'DPT005', 'Jl. Pahlawan Kerja No.30, Kec. Marpoyan Damai, Kota Pekanbaru', '0.145678', '1436789', '128030.jpeg', 'Bahari', 'Bahari', '1234'),
('Air Minum Galon Iwin', 'Depot Air Minum Galon Iwin', '3000', '25000', 'Bina Widya', '082390437170 ', 'DPT006', 'JL Kutilang Sakti. Gg Paris. Kel Simpang Baru Kec Bina Widya Kota Pekanbaru', '0.4724327', '101.3899404', '407228.png', 'Iwin', 'iwin', 'iwin');

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id_keranjang` varchar(100) NOT NULL,
  `id_galon` varchar(100) NOT NULL,
  `id_user` int(11) NOT NULL,
  `keranjang_isi_ulang` varchar(100) NOT NULL,
  `keranjang_galon_baru` varchar(100) NOT NULL,
  `total_pembayaran_keranjang` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pesanan_galon`
--

CREATE TABLE `pesanan_galon` (
  `jumlah_isi_ulang` varchar(100) NOT NULL,
  `jumlah_galon_baru` varchar(100) NOT NULL,
  `kode_pesanan` int(100) NOT NULL,
  `total_pembayaran` varchar(100) NOT NULL,
  `metode_pembayaran` varchar(100) NOT NULL,
  `status_pesanan` varchar(100) NOT NULL,
  `id_galon` varchar(100) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pesanan_galon`
--

INSERT INTO `pesanan_galon` (`jumlah_isi_ulang`, `jumlah_galon_baru`, `kode_pesanan`, `total_pembayaran`, `metode_pembayaran`, `status_pesanan`, `id_galon`, `id_user`) VALUES
('8', '4', 5, '205000', 'Rekening', 'Sedang Diproses', 'DPT003', 6),
('4', '3', 6, '133000', 'Rekening', 'Sedang Diproses', 'DPT005', 6),
('1', '1', 9, '44000', 'Cash On Delivery', 'Sedang Diproses', 'DPT005', 8),
('0', '1', 14, '46000', 'Rekening', 'Sedang Diproses', 'DPT003', 8),
('0', '1', 15, '36000', 'Rekening', 'Sedang Diproses', 'DPT004', 8),
('1', '0', 16, '4000', 'Rekening', 'Sedang Diproses', 'DPT005', 8),
('1', '0', 17, '4000', 'Rekening', 'Sedang Diproses', 'DPT006', 8);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_hp` varchar(30) NOT NULL,
  `alamat` text NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis_kelamin` varchar(100) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `kecamatan` varchar(100) NOT NULL,
  `kelurahan` varchar(100) NOT NULL,
  `no_rekening` varchar(100) NOT NULL,
  `nama_rekening` varchar(100) NOT NULL,
  `nama_bank` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `email`, `no_hp`, `alamat`, `nama`, `jenis_kelamin`, `tgl_lahir`, `gambar`, `kecamatan`, `kelurahan`, `no_rekening`, `nama_rekening`, `nama_bank`) VALUES
(6, 'mhmd_ikhsan', '234', 'mhd.ikhsan@gmail.com', '082286461431', 'Jalan Kubang Raya Gg. Suadara Pekanbaru, Riau ', 'Muhammad Ikhsan', 'Laki-laki', '1996-08-24', '162121.jpg', 'Tuah Madani', 'Tuah Madani', '1019765483', 'Muhmmad Ikhsan', 'BNI'),
(7, 'Harpin_Asrori', 'harpin123', 'achmad_harpin@gamail.com', '08127620140', 'Jalan Garuda Sakti KM 2, Pekanbaru', 'Achamd Harpin Asrori', 'Laki-laki', '2021-07-09', '-', 'Bina Widya', 'Simpang Baru', '1019765483', 'Harpin', 'BNI'),
(8, 'Afridol_A', '123456', 'Afridol@gmail.com', '082176854763', 'Jalan Kutilang Sakti, Pekanbaru', 'Afridol', 'Laki-laki', '1996-04-12', '764121.jpeg', 'Bina Widya', 'Simpang Baru', '201976548387623', 'Afridol', 'BRI');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `depot_galon`
--
ALTER TABLE `depot_galon`
  ADD PRIMARY KEY (`id_galon`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_keranjang`),
  ADD KEY `FK_IDgalon_keranjang` (`id_galon`),
  ADD KEY `FK_IDUser_iser` (`id_user`);

--
-- Indexes for table `pesanan_galon`
--
ALTER TABLE `pesanan_galon`
  ADD PRIMARY KEY (`kode_pesanan`),
  ADD KEY `FK_IDUser` (`id_user`),
  ADD KEY `FK_IDGalon` (`id_galon`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pesanan_galon`
--
ALTER TABLE `pesanan_galon`
  MODIFY `kode_pesanan` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD CONSTRAINT `FK_IDUser_iser` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `FK_IDgalon_keranjang` FOREIGN KEY (`id_galon`) REFERENCES `depot_galon` (`id_galon`);

--
-- Constraints for table `pesanan_galon`
--
ALTER TABLE `pesanan_galon`
  ADD CONSTRAINT `FK_IDGalon` FOREIGN KEY (`id_galon`) REFERENCES `depot_galon` (`id_galon`),
  ADD CONSTRAINT `FK_IDUser` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
