-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Jun 2023 pada 14.10
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 7.4.33

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_barang`
--

INSERT INTO `tb_barang` (`id_barang`, `nama_barang`, `merek`, `stok`, `status`) VALUES
(1, 'Motor', 'PG', '2', 1),
(2, 'Avometer', 'Deko', '1', 1),
(3, 'Servo', 'MG', '2', 1),
(4, 'Motor 1', 'MG', '0', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_chekout`
--

CREATE TABLE `tb_chekout` (
  `id_chekout` int(11) NOT NULL,
  `id_barang` varchar(100) NOT NULL,
  `id_inventaris` varchar(1000) NOT NULL,
  `kd_barang` varchar(1000) NOT NULL,
  `id_mahasiswa` int(11) NOT NULL,
  `nama_mahasiswa` varchar(1000) NOT NULL,
  `nama_barang` varchar(1000) NOT NULL,
  `merek` varchar(1000) NOT NULL,
  `kuantiti` varchar(10) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_chekout`
--

INSERT INTO `tb_chekout` (`id_chekout`, `id_barang`, `id_inventaris`, `kd_barang`, `id_mahasiswa`, `nama_mahasiswa`, `nama_barang`, `merek`, `kuantiti`, `status`) VALUES
(1, '1', '8', '130070055D', 13, 'Adi Rahmad Ramadhan', 'Motor', 'PG', '1', '0'),
(2, '2', '9', '1300704660', 13, 'Adi Rahmad Ramadhan', 'Avometer', 'Deko', '1', '0'),
(3, '2', '9', '1300704660', 13, 'Adi Rahmad Ramadhan', 'Avometer', 'Deko', '1', '0'),
(4, '1', '8,11', '130070055D,130070111C', 13, 'Adi Rahmad Ramadhan', 'Motor', 'PG', '2', '0'),
(5, '1', '8,11', '130070055D,130070111C', 13, 'Adi Rahmad Ramadhan', 'Motor', 'PG', '2', '0'),
(6, '2,1,3', '9,8,11,10,12', '1300704660,130070055D,130070111C,13006FED5D,13006FE83C', 13, 'Adi Rahmad Ramadhan', 'Avometer,Motor,Servo', 'Deko,PG,MG', '1,2,2', '0'),
(7, '2', '9', '1300704660', 13, 'Adi Rahmad Ramadhan', 'Avometer', 'Deko', '1', '0'),
(8, '1', '8,11', '130070055D,130070111C', 13, 'Adi Rahmad Ramadhan', 'Motor', 'PG', '2', '0'),
(9, '2', '9', '1300704660', 14, 'Tester ', 'Avometer', 'Deko', '1', '0'),
(10, '2,1,3', '9,8,11,10,12', '1300704660,130070055D,130070111C,13006FED5D,13006FE83C', 14, 'Tester ', 'Avometer,Motor,Servo', 'Deko,PG,MG', '1,2,2', '0'),
(11, '2', '9', '1300704660', 14, 'Tester ', 'Avometer', 'Deko', '1', '0'),
(12, '1,2', '8,11,9', '130070055D,130070111C,1300704660', 14, 'Tester ', 'Motor,Avometer', 'PG,Deko', '2,1', '0'),
(13, '1', '8,11', '130070055D,130070111C', 14, 'Tester ', 'Motor', 'PG', '2', '0'),
(14, '1', '8,11', '130070055D,130070111C', 14, 'Tester ', 'Motor', 'PG', '2', '0');

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
  `status` varchar(100) NOT NULL,
  `proses` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_inventaris`
--

INSERT INTO `tb_inventaris` (`id_inventaris`, `id_barang`, `kd_barang`, `nama_barang`, `merek`, `status`, `proses`) VALUES
(8, '1', '130070055D', 'Motor', 'PG', '1', '1'),
(9, '2', '1300704660', 'Avometer', 'Deko', '1', '1'),
(10, '3', '13006FED5D', 'Servo', 'MG', '1', '1'),
(11, '1', '130070111C', 'Motor', 'PG', '1', '1'),
(12, '3', '13006FE83C', 'Servo', 'MG', '1', '1');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_mahasiswa`
--

INSERT INTO `tb_mahasiswa` (`id_mahasiswa`, `id_rfid`, `nama_mahasiswa`, `nrp`, `kelas`, `email`, `pass`) VALUES
(13, '130070055D', 'Adi Rahmad Ramadhan', '0921040046', 'TO4B', 'adirahmad607@gmail.com', 'ee11cbb19052e40b07aac0ca060c23ee'),
(14, '130070055B', 'Tester ', '0921040047', 'TO4b', 'adirahmad607@gmail.com', 'ee11cbb19052e40b07aac0ca060c23ee'),
(15, '130070055G', 'Tanpa Input Pass', '0921040048', 'TO4b', 'adirahmad607@gmail.com', '3467d47ce6e585b47ad5288db75b94bb');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_peminjaman`
--

CREATE TABLE `tb_peminjaman` (
  `id_pinjam` int(11) NOT NULL,
  `id_mahasiswa` int(11) NOT NULL,
  `id_rfid` varchar(200) NOT NULL,
  `nama_mahasiswa` varchar(255) NOT NULL,
  `kd_barang` varchar(100) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `merek` varchar(255) NOT NULL,
  `kuantiti` varchar(255) NOT NULL,
  `status` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengembalian`
--

CREATE TABLE `tb_pengembalian` (
  `id_kembali` int(11) NOT NULL,
  `id_pinjam` int(11) NOT NULL,
  `id_rfid` varchar(255) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `kd_barang` varchar(255) NOT NULL,
  `id_teknisi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Indeks untuk tabel `tb_peminjaman`
--
ALTER TABLE `tb_peminjaman`
  ADD PRIMARY KEY (`id_pinjam`);

--
-- Indeks untuk tabel `tb_pengembalian`
--
ALTER TABLE `tb_pengembalian`
  ADD PRIMARY KEY (`id_kembali`);

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
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_chekout`
--
ALTER TABLE `tb_chekout`
  MODIFY `id_chekout` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `tb_inventaris`
--
ALTER TABLE `tb_inventaris`
  MODIFY `id_inventaris` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `tb_mahasiswa`
--
ALTER TABLE `tb_mahasiswa`
  MODIFY `id_mahasiswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `tb_peminjaman`
--
ALTER TABLE `tb_peminjaman`
  MODIFY `id_pinjam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tb_pengembalian`
--
ALTER TABLE `tb_pengembalian`
  MODIFY `id_kembali` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT untuk tabel `tb_teknisi`
--
ALTER TABLE `tb_teknisi`
  MODIFY `id_teknisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
