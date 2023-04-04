-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Apr 2023 pada 23.15
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ailab`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_barang`
--

CREATE TABLE `tb_barang` (
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `merek` varchar(255) NOT NULL,
  `stok` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_barang`
--

INSERT INTO `tb_barang` (`id_barang`, `nama_barang`, `merek`, `stok`, `status`) VALUES
(56, 'Motor', 'Merek', '5', 1),
(59, 'Servo', 'nomerek', '1', 1),
(60, 'Servo', 'MG', '3', 1),
(62, 'servo', 'm-g', '2', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_chekout`
--

CREATE TABLE `tb_chekout` (
  `id_chekout` int(11) NOT NULL,
  `id_barang` varchar(100) NOT NULL,
  `kd_barang` varchar(1000) NOT NULL,
  `nama_mahasiswa` varchar(1000) NOT NULL,
  `nama_barang` varchar(1000) NOT NULL,
  `merek` varchar(1000) NOT NULL,
  `kuantiti` varchar(10) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_chekout`
--

INSERT INTO `tb_chekout` (`id_chekout`, `id_barang`, `kd_barang`, `nama_mahasiswa`, `nama_barang`, `merek`, `kuantiti`, `status`) VALUES
(1, '56,60,59,62', 'barang31,barang75,barang95,barang54,barang43,barang3,barang45,barang24,barang14,barang89', 'user', 'Motor,Servo,Servo,servo', 'Merek,MG,nomerek,m-g', '4,3,1,2', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_inventaris`
--

CREATE TABLE `tb_inventaris` (
  `id_inventaris` int(11) NOT NULL,
  `id_barang` varchar(100) NOT NULL,
  `kd_barang` varchar(100) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `merek` varchar(255) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_inventaris`
--

INSERT INTO `tb_inventaris` (`id_inventaris`, `id_barang`, `kd_barang`, `nama_barang`, `merek`, `status`) VALUES
(27, '56', 'barang6', 'Motor', 'Merek', '1'),
(28, '56', 'barang31', 'Motor', 'Merek', '1'),
(29, '56', 'barang75', 'Motor', 'Merek', '1'),
(30, '56', 'barang95', 'Motor', 'Merek', '1'),
(31, '56', 'barang54', 'Motor', 'Merek', '1'),
(32, '60', 'barang43', 'Servo', 'MG', '1'),
(33, '60', 'barang3', 'Servo', 'MG', '1'),
(34, '62', 'barang14', 'servo', 'm-g', '1'),
(35, '62', 'barang89', 'servo', 'm-g', '1'),
(36, '60', 'barang45', 'Servo', 'MG', '1'),
(37, '59', 'barang24', 'Servo', 'nomerek', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_mahasiswa`
--

CREATE TABLE `tb_mahasiswa` (
  `id_mahasiswa` int(11) NOT NULL,
  `id_rfid` varchar(255) NOT NULL,
  `nama_mahasiswa` varchar(255) NOT NULL,
  `nrp` varchar(255) NOT NULL,
  `kelas` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_mahasiswa`
--

INSERT INTO `tb_mahasiswa` (`id_mahasiswa`, `id_rfid`, `nama_mahasiswa`, `nrp`, `kelas`, `email`, `pass`) VALUES
(10, '123', 'user', '0921040046', '4b', 'adirahmad607@gmail.com', 'ee11cbb19052e40b07aac0ca060c23ee');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_teknisi`
--

CREATE TABLE `tb_teknisi` (
  `id_teknisi` int(11) NOT NULL,
  `nama_teknisi` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(500) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_teknisi`
--

INSERT INTO `tb_teknisi` (`id_teknisi`, `nama_teknisi`, `email`, `pass`, `status`) VALUES
(1, 'admin', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', '1');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indeks untuk tabel `tb_chekout`
--
ALTER TABLE `tb_chekout`
  ADD PRIMARY KEY (`id_chekout`);

--
-- Indeks untuk tabel `tb_inventaris`
--
ALTER TABLE `tb_inventaris`
  ADD PRIMARY KEY (`id_inventaris`);

--
-- Indeks untuk tabel `tb_mahasiswa`
--
ALTER TABLE `tb_mahasiswa`
  ADD PRIMARY KEY (`id_mahasiswa`);

--
-- Indeks untuk tabel `tb_teknisi`
--
ALTER TABLE `tb_teknisi`
  ADD PRIMARY KEY (`id_teknisi`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_barang`
--
ALTER TABLE `tb_barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT untuk tabel `tb_chekout`
--
ALTER TABLE `tb_chekout`
  MODIFY `id_chekout` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_inventaris`
--
ALTER TABLE `tb_inventaris`
  MODIFY `id_inventaris` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT untuk tabel `tb_mahasiswa`
--
ALTER TABLE `tb_mahasiswa`
  MODIFY `id_mahasiswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `tb_teknisi`
--
ALTER TABLE `tb_teknisi`
  MODIFY `id_teknisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
