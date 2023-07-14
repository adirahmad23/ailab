-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 15 Jul 2023 pada 00.43
-- Versi server: 10.5.19-MariaDB-cll-lve
-- Versi PHP: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cyberpin_ailab`
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
(2, 'Avometer', 'Deko', '0', 1),
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
(36, '2', '9', '87008DF7E3', 24, 'Adi Rahmad Ramadhan', 'Avometer', 'Deko', '1', '0');

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
(9, '2', '87008DF7E3', 'Avometer', 'Deko', '0', '0'),
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
(1, '0A001ADDF6', 'YOGA CATUR SETIAWAN', '0919040041', 'to 8b', 'yogasetiawan@student.ppns.ac.id', '769334b5ce94e93027b8d36ead3f1918'),
(2, '090039216E', 'WAHYU DARMAWAN', '0919040063', 'to 8b', 'wahyudarmawan@student.ppns.ac.id', '34df521eba42a6d1d72957e967b9019e'),
(3, '090030C719', 'Tsabita Ihsania', '0919040045', 'to 8b', 'tsabitaihsania@student.ppns.ac.id', '06b86ef5e0c643841bc312e08374a499'),
(4, '09002CDCC4', 'RIZA ADI NUGROHO', '0919040060', 'to 8b', '', 'd84e8674f82130ac44221c0e63e2d2fd'),
(5, '55006D9068', 'DIMAS ADITYA PRABOWO', '0919040066', 'to 8b', '', '26d87fd6a78ef070493440956dc519a7'),
(6, '09002A38EC', 'MOCHAMMAD FACRIS IRGI FAHREZI', '0919040037', 'to 8b', '', '8c96375589099f826729f52c45c2d88e'),
(7, '09002F72E8', 'DIMAS BAYU SANTOSA', '0919040036', 'to 8b', '', 'ce0444fe77a69bcf9ad6dac2bc373225'),
(8, '09002D2581', 'BAGUS DIAN FEBRIANTO', '0919040058', 'to 8b', '', '933581da31666da0a3cf3621631fae18'),
(9, '0A001ADDF3', 'RICHO', '0919040040', 'to 8b', '', '206f51bf948149ecbf4d1263f00129d3'),
(10, '08009278E8', 'VINCA VANNYA PUTRI SETIAWAN', '0919040044', 'to 8b', '', '0f6b0d8d34abee931768749cca76ac6a'),
(11, '08009278E2', ' ANISA FITRI SANTOSA', '0919040043', 'to 8b', '', '6088a1ca099c180782ac617ba0ec799a'),
(12, '0A001ADA97', 'FAKHRUL ROMADHON', '0919040042', 'to 8b', 'fakhrulromadhon7@gmail.com', '82c8b59bf6eb9b9556ccbf4264b84629'),
(13, '09002D253F', ' ANANDA SAKINATA PRASTIWI', '0919040061', 'to 8b', '', '1565185aa818aad592081e8abf7c1422'),
(14, '0A001ADDF7', 'FIQROTIN NUR ASITA', '0919040054', 'to 8b', '', 'f34b97a65b12d9162dead2fdb5ed526a'),
(15, '0A001ADA9A', 'FRANSISKA TRI WIDIA', '0919040053', 'to 8b', '', '99399f57cf8766dfe821e14ed7f34052'),
(16, '09002FC0A2', 'MUHAMMAD IZZUL HAJ', '0919040047', 'to 8b', '', '37daf4300999ba03a4254fd912881401'),
(17, '0A001ADA98', 'ACHMAD AGUS EKO BUDIMAN', '0919040055', 'to 8b', '', '3481ca541210de9f99dd3f6f9aa06e1c'),
(18, '09002D2597', 'MUHAMMAD TEGAR HAFIZH', '0919040050', 'to 8b', '', 'ecf3c6dbfc64567c1f3055b000558cd3'),
(19, '09002FA850', 'MONICA DWI ARTANTI', '0919040039', 'to 8b', '', '80aa383913eee5af7348706405227a0e'),
(20, '09002FE66B', 'MUKHAMMAD JAMALUDIN', '0919040048', 'to 8b', '', 'ad8a5fd19f68ec4115a670f6351ba044'),
(21, '090023BAD9', 'ABD. HAFIZH ABYAN FARUQ', '0919040051', 'to 8b', '', '64d5a10f8fb5cbb2ead199584e5c5139'),
(22, '09002D2532', 'RENDY RIZKANANDA', '0919040062', 'to 8b', '', '35e629161210ecfa5b7dc1349e0f9e43'),
(23, '09002FA853', 'MOH. FARRAS RAIHAN', '0919040057', 'to 8b', '', '0a1032bdf69e781814de7c427f5581fe'),
(24, '87008DF7E3', 'Adi Rahmad Ramadhan', '0921040046', 'TO 4B', 'adirahmad607@gmail.com', 'ee11cbb19052e40b07aac0ca060c23ee'),
(25, '870052782A', 'WISNU SUKMA WARDANI', '0920040080', 'T0 6B', '', 'd617cebe7990ba88dc9b36deea124c13'),
(26, '09003920B7', 'RIFQI NUR ABYAN', '0919040065', 'to 8b', '', '962842241f80bd728caf2321acb5b7ab'),
(27, '090055C041', 'VIKY ALDIANTO', '0919040067', 'to 8b', '', '1d7fa7e5acea16adea8eb3576a117cf5'),
(28, '09002D258A', 'RAYZA FEBRINA ARYUNITA', '0919040052', 'to 8b', '', '8ac34d323d0fa598144f04afadac8841'),
(29, '09002FBFD4', 'VIKRI RAHMAD HIDAYAT', '0919040046', 'to 8b', '', 'd082902d8dbd73581e6b5352d6a97a78'),
(30, '55006DF912', 'DIAN ALMANDO NURCAHYO', '0919040034', 'to 8b', '', '5c1e9efc01f797a200c6f70ed930f21e'),
(31, '09002FE2D2', 'VANDY ACHMAD', '0919040056', 'to 8b', '', '313e881c26d4c804e60f5000bad454ce'),
(32, '09002FA855', 'ALDIANTO EKA RAHARDI', '0919040035', 'to 8b', '', '54f377a41c3b19e415c64e47fa8ba61f'),
(33, '0900392076', 'MUHAMMAD REZA PAHLEVI', '0919040064', 'to 8b', '', '5dd76ab2f540288749cf9a0b24eff0d3'),
(34, '09002FA851', 'MOHAMMAD IRFAK HIDAYAT', '0919040038', 'to 8b', '', 'e266fd98a1daa2e3616eac935ed199a8'),
(35, '090023FB27', 'ZULFIKAR ARYA HAMID', '0919040027', 'to 8a', '', '1e422428cd0a59d2ba4f80bce1d60775'),
(36, '0A0017AD0A', 'MUHAMMAD AFREZA', '0919040026', 'to 8a', '', '599208eb0cb6db87ebb777d9a3c2b693'),
(37, '09002F72EA', 'MARSHELLENO KENNIGIAN HARIANTO', '0919040033', 'to 8a', '', 'ffc5fdfdec135c011a51f0d061ba8983'),
(40, '0900980C54', 'MUHAMMAD HASYIM', '0919040005', 'to 8a', 'z@gmail.com', 'ecbb5940b8637688953d78ac37e8d608'),
(41, '0A0016B1A3', 'SATRIO RIHA ABDILAH', '0919040009', 'to 8a', 'z@gmail.com', '3df02d1e96d56522a48fd3ec52f91b1a'),
(42, '0A0016B1A2', 'ALAM JUANG ANANTA', '0919040010', 'to 8a', 'z@gmail.com', 'a829eaf15b82b7f9632774369cf02821'),
(43, '0A0016B1A6', 'FAIQ AZHAR TAQIYUDDIN', '0919040011', 'to 8a', 'z@gmail.com', 'cdbbe75dc2146cd0469b0470047747f2'),
(44, '09003A00B5', 'MOCHAMMAD RIFKY REYVANSYAH', '0919040013', 'to 8a', 'z@gmail.com', 'e2bee85229b11a8f83ce7baeb186f9e1'),
(45, '090097F4C4', 'MOHAMMAD ISYHADUNNABA AL Q', '0919040015', 'to 8a', 'z@gmail.com', '50336daf3e89c2fa287461a270cdcb15'),
(46, '030065B5C8', 'OKTY DIAN PERMATASARI', '0919040017', 'to 8a', 'z@gmail.com', '3e17b9a5347253dca43ee6d0956a064b'),
(47, '090097F661', 'DHANAR HARYO KUSUMA', '0919040019', 'to 8a', 'z@gmail.com', '4ba07bf0539c8f77cd00896860faba61'),
(48, '0900982695', 'RINI INDRAWATI', '0919040021', 'to 8a', 'z@gmail.com', '31caf0168fdd9a03b2a10f7dd748451f'),
(49, '090098276A', 'MUHAMMAD TAUFIQ RAHMAN', '0919040022', 'to 8a', 'z@gmail.com', '5370eb02c32bed045a70af444d0f1bf2'),
(50, '04009F30BC', 'GALIH AJI SASONGKO', '0919040024', 'to 8a', 'z@gmail.com', '22d8140c139d81a66e89cded8cf0aaac'),
(51, '09003A0182', 'M. FAHMI FAUZI', '0919040029', 'to 8a', 'z@gmail.com', '5ec38358ad4def6efb7491b86a41ca17'),
(52, '09003A00E2', 'ADELIA PUSPITASARI', '0919040030', 'to 8a', 'z@gmail.com', 'cc05323080d4574c9ab3205b97acdbe0'),
(53, '09003A00B7', 'ANGGIE OKTAVIA PUTRI', '0919040032', 'to 8a', 'z@gmail.com', '7097ade74ed8fb4a9e3697a0e3d4488f'),
(54, '09003A0184', 'FAIZ ROMADLONI', '0919040014', 'to 8a', 'z@gmail.com', 'fa6f6c7875cac5301157e4bd58d3bd7b'),
(58, '090097F780', 'DAVA RAFIURRAZAK', '0919040023', 'to 8a', 'z@gmail.com', 'c569482818ad82ae575409fb85c84870'),
(59, '0A001C7113', 'MUIZ LIDINILLAH', '0919040006', 'to 8a', 'z@gmail.com', 'ed05e622642dad8773739076097fc2b9');

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
  `tgl_pinjam` varchar(200) NOT NULL,
  `tgl_batas_kembali` varchar(200) NOT NULL,
  `tgl_kembali` varchar(200) NOT NULL,
  `status` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_peminjaman`
--

INSERT INTO `tb_peminjaman` (`id_pinjam`, `id_mahasiswa`, `id_rfid`, `nama_mahasiswa`, `kd_barang`, `nama_barang`, `merek`, `kuantiti`, `tgl_pinjam`, `tgl_batas_kembali`, `tgl_kembali`, `status`) VALUES
(12, 24, '87008DF7E3', 'Adi Rahmad Ramadhan', '87008DF7E3', 'Avometer', 'Deko', '1', '11 Juli 2023', '14 Juli 2023', '', '2');

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
-- Struktur dari tabel `tb_prosespinjam`
--

CREATE TABLE `tb_prosespinjam` (
  `id_prosespinjam` int(11) NOT NULL,
  `id_pinjam` int(11) NOT NULL,
  `id_rfid` varchar(255) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `kd_barang` varchar(255) NOT NULL,
  `id_teknisi` varchar(255) NOT NULL
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
(1, 'admin', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', '1'),
(2, 'teknisi', 'teknisi@gmail.com', '21232f297a57a5a743894a0e4a801fc3', '0');

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
-- Indeks untuk tabel `tb_prosespinjam`
--
ALTER TABLE `tb_prosespinjam`
  ADD PRIMARY KEY (`id_prosespinjam`);

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
  MODIFY `id_chekout` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT untuk tabel `tb_inventaris`
--
ALTER TABLE `tb_inventaris`
  MODIFY `id_inventaris` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `tb_mahasiswa`
--
ALTER TABLE `tb_mahasiswa`
  MODIFY `id_mahasiswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT untuk tabel `tb_peminjaman`
--
ALTER TABLE `tb_peminjaman`
  MODIFY `id_pinjam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `tb_pengembalian`
--
ALTER TABLE `tb_pengembalian`
  MODIFY `id_kembali` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT untuk tabel `tb_prosespinjam`
--
ALTER TABLE `tb_prosespinjam`
  MODIFY `id_prosespinjam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tb_teknisi`
--
ALTER TABLE `tb_teknisi`
  MODIFY `id_teknisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
