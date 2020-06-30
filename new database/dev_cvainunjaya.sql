-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Jun 2020 pada 09.28
-- Versi server: 10.4.6-MariaDB
-- Versi PHP: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dev_cvainunjaya`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `alamat_pegawai`
--

CREATE TABLE `alamat_pegawai` (
  `id` int(11) NOT NULL,
  `pegawai_id` int(11) DEFAULT NULL,
  `alamat` varchar(500) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `alamat_pegawai`
--

INSERT INTO `alamat_pegawai` (`id`, `pegawai_id`, `alamat`, `status`) VALUES
(1, 2, 'jalan kenangan', 1),
(2, 2, 'jalan Indah', 9),
(3, 2, 'jalan Permai', 9);

-- --------------------------------------------------------

--
-- Struktur dari tabel `alat_berat`
--

CREATE TABLE `alat_berat` (
  `id` int(11) NOT NULL,
  `kd_tipe` varchar(30) DEFAULT NULL,
  `nama_alber` varchar(30) DEFAULT NULL,
  `jenis_id` int(11) NOT NULL,
  `merk` varchar(30) DEFAULT NULL,
  `harga_sewa` int(11) DEFAULT NULL,
  `harga_sewa_khusus` int(11) NOT NULL DEFAULT 0,
  `biaya_sopir` int(11) DEFAULT 0,
  `foto` varchar(300) DEFAULT NULL,
  `status` int(11) DEFAULT 0 COMMENT '0 => tersedia, 1 => Digunakan'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `alat_berat`
--

INSERT INTO `alat_berat` (`id`, `kd_tipe`, `nama_alber`, `jenis_id`, `merk`, `harga_sewa`, `harga_sewa_khusus`, `biaya_sopir`, `foto`, `status`) VALUES
(3, 'AB-001', 'Excava 200', 1, 'Pindad', 300000, 0, 200000, NULL, 0),
(5, 'AB-002', 'Dump Truck', 2, 'dump dump', 10000000, 20000000, 0, NULL, 0),
(6, 'AB-003', 'Tank', 2, 'dump dump', 300000, 0, 0, NULL, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `biaya_operasional`
--

CREATE TABLE `biaya_operasional` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `harga` int(11) DEFAULT 0,
  `satuan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `biaya_operasional`
--

INSERT INTO `biaya_operasional` (`id`, `nama`, `harga`, `satuan`) VALUES
(1, 'Bensin 10 Liter Solar', 55000, 'Liter'),
(2, 'Sparepart Tambahan', 10000, 'pcs');

-- --------------------------------------------------------

--
-- Struktur dari tabel `coa`
--

CREATE TABLE `coa` (
  `kode_akun` int(11) NOT NULL,
  `nama_akun` varchar(30) DEFAULT NULL,
  `header_akun` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `coa`
--

INSERT INTO `coa` (`kode_akun`, `nama_akun`, `header_akun`) VALUES
(111, 'Kas', 1),
(112, 'piutang', 1),
(113, 'perlengkapan', 1),
(114, 'PPh Pasal 23', 1),
(211, 'Utang Sewa', 2),
(411, 'pendapatan sewa', 4),
(511, 'Beban Gaji', 5),
(512, 'Beban Makan', 5),
(513, 'Beban Pemeliharaan', 5),
(514, 'Beban BBM', 5),
(515, 'Beban Listrik dan Air', 5),
(516, 'Beban Telepon', 5),
(517, 'Beban Perlengkapan Kantor', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `daftar_pajak`
--

CREATE TABLE `daftar_pajak` (
  `id` int(11) NOT NULL,
  `nominal_pajak` int(11) DEFAULT NULL,
  `transaksi_id` int(11) DEFAULT NULL COMMENT 'FK nya Transaksi Sewa'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `daftar_pajak`
--

INSERT INTO `daftar_pajak` (`id`, `nominal_pajak`, `transaksi_id`) VALUES
(10, 286400, 16),
(11, 698900, 17),
(12, 286400, 18),
(13, 511400, 19),
(14, 336400, 20),
(15, 323900, 21),
(16, 261400, 22),
(17, 150000, 23),
(18, 1680000, 24),
(19, 3360000, 25),
(20, 3360000, 26),
(21, 3360000, 27),
(22, 3360000, 28),
(23, 3360000, 30),
(24, 3360000, 34),
(25, 3360000, 35),
(26, 3360000, 36),
(27, 3360000, 37);

-- --------------------------------------------------------

--
-- Struktur dari tabel `daftar_pemasukan_pegawai`
--

CREATE TABLE `daftar_pemasukan_pegawai` (
  `id` int(11) NOT NULL,
  `nominal` int(11) DEFAULT 0,
  `persen` int(11) NOT NULL DEFAULT 0,
  `transaksi_id` int(11) DEFAULT NULL COMMENT 'FK nya Transaksi Sewa'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `daftar_pemasukan_pegawai`
--

INSERT INTO `daftar_pemasukan_pegawai` (`id`, `nominal`, `persen`, `transaksi_id`) VALUES
(15, 600000, 25, 16),
(16, 2250000, 25, 17),
(17, 600000, 25, 18),
(18, 1500000, 25, 19),
(19, 800000, 25, 20),
(20, 750000, 25, 21),
(21, 500000, 25, 22),
(22, 600000, 25, 23),
(23, 6000000, 25, 24),
(24, 12000000, 25, 25),
(25, 12000000, 25, 26),
(26, 12000000, 25, 27),
(27, 12000000, 25, 28),
(28, 12000000, 25, 30),
(29, 12000000, 25, 34),
(30, 12000000, 25, 35),
(31, 12000000, 25, 36),
(32, 12000000, 25, 37);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_alat_berat`
--

CREATE TABLE `jenis_alat_berat` (
  `id_jenis` int(11) NOT NULL,
  `kode_jenis` varchar(56) NOT NULL,
  `jenis` varchar(56) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jenis_alat_berat`
--

INSERT INTO `jenis_alat_berat` (`id_jenis`, `kode_jenis`, `jenis`) VALUES
(1, 'JB-001', 'EXCAVATOR'),
(2, 'JB-002', 'DUMP TRUCK');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jurnal`
--

CREATE TABLE `jurnal` (
  `id` int(11) NOT NULL,
  `kode_akun` int(11) DEFAULT NULL,
  `tgl_jurnal` date DEFAULT NULL,
  `nominal` int(11) DEFAULT NULL,
  `posisi_dr_cr` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jurnal`
--

INSERT INTO `jurnal` (`id`, `kode_akun`, `tgl_jurnal`, `nominal`, `posisi_dr_cr`) VALUES
(26, 112, '2020-03-04', 184840000, 'debit'),
(27, 411, '2020-03-04', 186840000, 'kredit'),
(28, 115, '2020-06-10', 10000000, 'debit'),
(29, 118, '2020-06-10', 4074400, 'debit'),
(30, 111, '2020-06-10', 14074400, 'kredit'),
(31, 115, '2020-06-10', 4074400, 'debit'),
(32, 118, '2020-06-10', 0, 'debit'),
(33, 111, '2020-06-10', 14074400, 'kredit'),
(34, 111, '2020-06-10', 20739936, 'debit'),
(35, 117, '2020-06-10', 423264, 'debit'),
(36, 411, '2020-06-10', 21163200, 'kredit'),
(37, 111, '2020-06-24', 20346400, 'debit'),
(38, 114, '2020-06-24', 20346400, 'debit'),
(39, 411, '2020-06-24', 20346400, 'kredit'),
(40, 211, '2020-06-24', -20346400, 'kredit'),
(41, 111, '2020-06-24', 41556400, 'debit'),
(42, 114, '2020-06-24', 41556400, 'debit'),
(43, 411, '2020-06-24', 41556400, 'kredit'),
(44, 211, '2020-06-24', 41556400, 'kredit'),
(45, 111, '2020-06-24', 41556400, 'debit'),
(46, 114, '2020-06-24', 41556400, 'debit'),
(47, 411, '2020-06-24', 41556400, 'kredit'),
(48, 211, '2020-06-24', 41556400, 'kredit'),
(49, 111, '2020-06-24', 41556400, 'debit'),
(50, 114, '2020-06-24', 41556400, 'debit'),
(51, 411, '2020-06-24', 41556400, 'kredit'),
(52, 211, '2020-06-24', 41556400, 'kredit'),
(53, 515, '2020-06-29', 300000, 'debit'),
(54, 111, '2020-06-29', 300000, 'kredit'),
(55, 515, '2020-06-29', 200000000, 'debit'),
(56, 111, '2020-06-29', 200000000, 'kredit'),
(57, 514, '2020-06-29', 100000, 'debit'),
(58, 111, '2020-06-29', 100000, 'kredit'),
(59, 111, '2020-06-30', 62910400, 'debit'),
(60, 114, '2020-06-30', 62910400, 'debit'),
(61, 411, '2020-06-30', 62910400, 'kredit'),
(62, 211, '2020-06-30', 62910400, 'kredit'),
(63, 111, '2020-06-30', 20340400, 'debit'),
(64, 114, '2020-06-30', 20340400, 'debit'),
(65, 411, '2020-06-30', 20340400, 'kredit'),
(66, 211, '2020-06-30', 20340400, 'kredit'),
(67, 111, '2020-06-30', 21340400, 'debit'),
(68, 114, '2020-06-30', 21340400, 'debit'),
(69, 411, '2020-06-30', 21340400, 'kredit'),
(70, 211, '2020-06-30', 21340400, 'kredit'),
(71, 111, '2020-06-30', 21795592, 'debit'),
(72, 114, '2020-06-30', 444808, 'debit'),
(73, 411, '2020-06-30', 22240400, 'kredit'),
(74, 111, '2020-06-30', 59529120, 'debit'),
(75, 114, '2020-06-30', 1214880, 'debit'),
(76, 411, '2020-06-30', 60744000, 'kredit'),
(77, 111, '2020-06-30', 7448392, 'debit'),
(78, 114, '2020-06-30', 152008, 'debit'),
(79, 411, '2020-06-30', 7600400, 'kredit'),
(80, 111, '2020-06-30', 21060592, 'debit'),
(81, 114, '2020-06-30', 429808, 'debit'),
(82, 411, '2020-06-30', 21490400, 'kredit'),
(83, 111, '2020-06-30', 27793192, 'debit'),
(84, 114, '2020-06-30', 567208, 'debit'),
(85, 411, '2020-06-30', 28360400, 'kredit'),
(86, 111, '2020-06-30', 15008700, 'debit'),
(87, 114, '2020-06-30', 306300, 'debit'),
(88, 411, '2020-06-30', 15315000, 'kredit'),
(89, 111, '2020-06-30', 29885100, 'debit'),
(90, 114, '2020-06-30', 609900, 'debit'),
(91, 411, '2020-06-30', 30495000, 'kredit'),
(92, 111, '2020-06-30', 29885100, 'debit'),
(93, 411, '2020-06-30', 29495000, 'kredit'),
(94, 111, '2020-06-30', 14887400, 'debit'),
(95, 112, '2020-06-30', 15247600, 'debit'),
(96, 114, '2020-06-30', 360000, 'debit'),
(97, 411, '2020-06-30', 30495000, 'kredit'),
(98, 111, '2020-06-30', 14942550, 'debit'),
(99, 112, '2020-06-30', 15247500, 'debit'),
(100, 114, '2020-06-30', 304950, 'debit'),
(101, 411, '2020-06-30', 30495000, 'kredit'),
(102, 111, '2020-06-30', 14942550, 'debit'),
(103, 112, '2020-06-30', 15247500, 'debit'),
(104, 114, '2020-06-30', 304950, 'debit'),
(105, 411, '2020-06-30', 30495000, 'kredit'),
(106, 111, '2020-06-30', 14942550, 'debit'),
(107, 112, '2020-06-30', 15247500, 'debit'),
(108, 114, '2020-06-30', 304950, 'debit'),
(109, 411, '2020-06-30', 30495000, 'kredit'),
(110, 111, '2020-06-30', 14942550, 'debit'),
(111, 112, '2020-06-30', 15247500, 'debit'),
(112, 114, '2020-06-30', 304950, 'debit'),
(113, 411, '2020-06-30', 30495000, 'kredit'),
(114, 111, '2020-06-30', 14942550, 'debit'),
(115, 112, '2020-06-30', 15247500, 'debit'),
(116, 114, '2020-06-30', 304950, 'debit'),
(117, 411, '2020-06-30', 30495000, 'kredit'),
(118, 111, '2020-06-30', 14942550, 'debit'),
(119, 112, '2020-06-30', 15247500, 'debit'),
(120, 114, '2020-06-30', 304950, 'debit'),
(121, 411, '2020-06-30', 30495000, 'kredit'),
(122, 111, '2020-06-30', 14942550, 'debit'),
(123, 112, '2020-06-30', 15247500, 'debit'),
(124, 114, '2020-06-30', 304950, 'debit'),
(125, 411, '2020-06-30', 30495000, 'kredit'),
(126, 111, '2020-06-30', 14942550, 'debit'),
(127, 112, '2020-06-30', 15247500, 'debit'),
(128, 114, '2020-06-30', 304950, 'debit'),
(129, 411, '2020-06-30', 30495000, 'kredit'),
(130, 111, '2020-06-30', 14942550, 'debit'),
(131, 112, '2020-06-30', 15247500, 'debit'),
(132, 114, '2020-06-30', 304950, 'debit'),
(133, 411, '2020-06-30', 30495000, 'kredit'),
(134, 111, '2020-06-30', 14942550, 'debit'),
(135, 112, '2020-06-30', 15247500, 'debit'),
(136, 114, '2020-06-30', 304950, 'debit'),
(137, 411, '2020-06-30', 30495000, 'kredit'),
(138, 111, '2020-06-30', 29885100, 'debit'),
(139, 112, '2020-06-30', 15247600, 'kredit'),
(140, 111, '2020-06-30', 15247500, 'debit'),
(141, 112, '2020-06-30', 15247500, 'kredit');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `id` int(11) NOT NULL,
  `kd_pegawai` varchar(30) DEFAULT NULL,
  `nama_pegawai` varchar(30) DEFAULT NULL,
  `no_telp` varchar(128) DEFAULT NULL,
  `alamat` varchar(15) DEFAULT NULL,
  `status_sopir` int(1) NOT NULL,
  `biaya` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`id`, `kd_pegawai`, `nama_pegawai`, `no_telp`, `alamat`, `status_sopir`, `biaya`) VALUES
(2, 'SPR-002', 'Bohim', '0989889494', NULL, 0, 200000),
(4, 'SPR-003', 'Asril', '123123123, 34234, 4354354', 'sadsd', 1, 200000),
(5, 'SPR-004', 'Bon', '098341234', NULL, 0, 250000),
(6, 'SPR-001', 'Topik', '087675786876', 'sadsad', 0, 500000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(11) NOT NULL,
  `kd_pelanggan` varchar(30) DEFAULT NULL,
  `nama_pelanggan` varchar(30) DEFAULT NULL,
  `alamat` varchar(300) DEFAULT NULL,
  `no_telp` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `kd_pelanggan`, `nama_pelanggan`, `alamat`, `no_telp`) VALUES
(1, 'PLG-001', 'Rijul', 'cidurian', '08814539943, 0890809343');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengaturan`
--

CREATE TABLE `pengaturan` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `isi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `pengaturan`
--

INSERT INTO `pengaturan` (`id`, `nama`, `isi`) VALUES
(1, 'sejarah', 'perusahaan ini berdiri sejak blablabla'),
(2, 'kontak', 'hubungi 08878787878787'),
(3, 'persen_operasional_sopir', '90');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `alat_berat_id` int(11) DEFAULT NULL,
  `biaya_operasional_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id`, `alat_berat_id`, `biaya_operasional_id`) VALUES
(1, 3, 1),
(2, 3, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `kd_penyewaan` varchar(30) DEFAULT NULL,
  `alat_berat_id` int(11) DEFAULT NULL,
  `pelanggan_id` int(11) DEFAULT NULL COMMENT 'FK nya customer / pelanggan',
  `pegawai_id` int(11) DEFAULT NULL COMMENT 'FK nya Supir / pegawai',
  `nominal` int(11) NOT NULL,
  `jml_bayar` int(11) NOT NULL,
  `sisa` int(11) NOT NULL,
  `status` tinyint(4) DEFAULT 0 COMMENT '0 => ‘Belum Lunas’,  1 => ‘Lunas’',
  `tgl_transaksi` datetime DEFAULT current_timestamp(),
  `tgl_pelunasan` timestamp NULL DEFAULT NULL,
  `tgl_mulai` date DEFAULT NULL,
  `tgl_berakhir` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL COMMENT 'FK nya user Admin yang input data'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id`, `kd_penyewaan`, `alat_berat_id`, `pelanggan_id`, `pegawai_id`, `nominal`, `jml_bayar`, `sisa`, `status`, `tgl_transaksi`, `tgl_pelunasan`, `tgl_mulai`, `tgl_berakhir`, `user_id`) VALUES
(16, 'PNY-001', 3, 1, 2, 144000, 1000000, -856000, 0, '2020-06-29 13:12:35', NULL, '2020-06-29', '2020-07-02', 38),
(17, 'PNY-002', 3, 1, 5, 63910400, 62910400, 0, 0, '2020-06-29 13:15:11', '2020-06-29 17:00:00', '2020-06-29', '2020-07-08', 38),
(18, 'PNY-003', 3, 1, 4, 21340400, 21340400, 0, 0, '2020-06-30 10:18:15', '2020-06-29 17:00:00', '2020-06-30', '2020-07-03', 38),
(19, 'PNY-004', 3, 1, 6, 22240400, 21240400, 0, 1, '2020-06-30 10:26:10', '2020-06-29 17:00:00', '2020-06-30', '2020-07-03', 38),
(20, 'PNY-005', 3, 1, 4, 28360400, 27360400, 0, 1, '2020-06-30 10:34:26', '2020-06-29 17:00:00', '2020-06-30', '2020-07-04', 38),
(21, 'PNY-006', 3, 1, 5, 21490400, 20490400, 0, 1, '2020-06-30 10:46:05', '2020-06-29 17:00:00', '2020-06-30', '2020-07-03', 38),
(22, 'PNY-007', 3, 1, 6, 7600400, 6600400, 0, 1, '2020-06-30 10:51:33', '2020-06-29 17:00:00', '2020-06-30', '2020-07-01', 38),
(23, 'PNY-008', 5, 1, 2, 60744000, 59744000, 0, 1, '2020-06-30 10:54:50', '2020-06-29 17:00:00', '2020-06-30', '2020-07-03', 38),
(24, 'PNY-009', 6, 1, 4, 15315000, 14315000, 0, 1, '2020-06-30 11:48:52', '2020-06-29 17:00:00', '2020-06-30', '2020-08-29', 38),
(25, 'PNY-010', 6, 1, 4, 30495000, 29495000, 0, 1, '2020-06-30 12:00:49', '2020-06-29 17:00:00', '2020-06-30', '2020-08-29', 38),
(26, 'PNY-011', 6, 1, 4, 30495000, 29495000, 0, 1, '2020-06-30 12:26:42', '2020-06-29 17:00:00', '2020-06-30', '2020-08-29', 38),
(27, 'PNY-012', 6, 1, 4, 30495000, 15247600, 0, 1, '2020-06-30 12:55:26', '2020-06-29 17:00:00', '2020-06-30', '2020-08-29', 38),
(28, 'PNY-013', 6, 1, 4, 30495000, 15247500, 0, 1, '2020-06-30 13:02:14', '2020-06-29 17:00:00', '2020-06-30', '2020-08-29', 38),
(29, 'PNY-014', 6, 1, 4, 30495000, 15247500, 15247500, 0, '2020-06-30 13:05:58', NULL, '2020-06-30', '2020-08-29', 38),
(30, 'PNY-014', 6, 1, 4, 30495000, 15247500, 15247500, 0, '2020-06-30 13:06:17', NULL, '2020-06-30', '2020-08-29', 38),
(31, 'PNY-015', 6, 1, 4, 30495000, 15247500, 15247500, 0, '2020-06-30 13:12:40', NULL, '2020-06-30', '2020-08-29', 38),
(32, 'PNY-015', 6, 1, 4, 30495000, 15247500, 15247500, 0, '2020-06-30 13:13:44', NULL, '2020-06-30', '2020-08-29', 38),
(33, 'PNY-015', 6, 1, 4, 30495000, 15247500, 15247500, 0, '2020-06-30 13:14:26', NULL, '2020-06-30', '2020-08-29', 38),
(34, 'PNY-015', 6, 1, 4, 30495000, 15247500, 15247500, 0, '2020-06-30 13:14:46', NULL, '2020-06-30', '2020-08-29', 38),
(35, 'PNY-015', 6, 1, 4, 30495000, 15247500, 15247500, 0, '2020-06-30 13:14:57', NULL, '2020-06-30', '2020-08-29', 38),
(36, 'PNY-016', 6, 1, 4, 30495000, 15247500, 15247500, 0, '2020-06-30 13:18:06', NULL, '2020-06-30', '2020-08-29', 38),
(37, 'PNY-017', 6, 1, 4, 30495000, 15247500, 15247500, 0, '2020-06-30 13:30:49', NULL, '2020-06-30', '2020-08-29', 38);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_biaya_tambahan`
--

CREATE TABLE `transaksi_biaya_tambahan` (
  `transaksi_id` int(11) NOT NULL,
  `id_biaya_tambahan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_detail`
--

CREATE TABLE `transaksi_detail` (
  `transaksi_id` int(30) DEFAULT NULL,
  `biaya_operasional_id` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transaksi_detail`
--

INSERT INTO `transaksi_detail` (`transaksi_id`, `biaya_operasional_id`, `harga`, `total`) VALUES
(1, 1, 55000, 55000),
(1, 2, 10000, 65000),
(2, 1, 55000, 55000),
(3, 1, 55000, 55000),
(3, 2, 10000, 65000),
(4, 1, 55000, 55000),
(5, 1, 55000, 55000),
(5, 2, 10000, 65000),
(6, 1, 55000, 55000),
(6, 2, 10000, 65000),
(7, 1, 55000, 55000),
(7, 2, 10000, 65000),
(8, 1, 55000, 55000),
(8, 2, 10000, 65000),
(9, 1, 55000, 55000),
(9, 2, 10000, 65000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_detail_new`
--

CREATE TABLE `transaksi_detail_new` (
  `transaksi_id` int(30) DEFAULT NULL,
  `id_alat_berat` int(11) DEFAULT NULL,
  `id_pegawai` int(11) DEFAULT NULL,
  `jml` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_detail_tambahan`
--

CREATE TABLE `transaksi_detail_tambahan` (
  `id_transaksi` int(56) NOT NULL,
  `jumlah` int(56) NOT NULL,
  `harga` int(56) NOT NULL,
  `total` int(56) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transaksi_detail_tambahan`
--

INSERT INTO `transaksi_detail_tambahan` (`id_transaksi`, `jumlah`, `harga`, `total`) VALUES
(11, 1, 9000, 9000),
(12, 10, 12000, 120000),
(13, 10, 12500, 125000),
(14, 12, 9900, 118800),
(15, 12, 12000, 144000),
(16, 12, 12000, 144000),
(17, 12, 12000, 144000),
(18, 12, 12000, 144000),
(19, 12, 12000, 144000),
(20, 12, 12000, 144000),
(21, 12, 12000, 144000),
(22, 12, 12000, 144000),
(23, 12, 12000, 144000),
(24, 15, 9000, 135000),
(25, 15, 9000, 135000),
(26, 15, 9000, 135000),
(27, 15, 9000, 135000),
(28, 15, 9000, 135000),
(30, 15, 9000, 135000),
(34, 15, 9000, 135000),
(35, 15, 9000, 135000),
(36, 15, 9000, 135000),
(37, 15, 9000, 135000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_new`
--

CREATE TABLE `transaksi_new` (
  `id` int(11) NOT NULL,
  `kd_penyewaan` varchar(30) DEFAULT NULL,
  `pelanggan_id` int(11) DEFAULT NULL COMMENT 'FK nya customer / pelanggan',
  `status` tinyint(4) DEFAULT 0 COMMENT '0 => ‘Belum Lunas’,  1 => ‘Lunas’',
  `tgl_mulai` date DEFAULT NULL,
  `tgl_berakhir` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL COMMENT 'FK nya user Admin yang input data'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `transaksi_new`
--

INSERT INTO `transaksi_new` (`id`, `kd_penyewaan`, `pelanggan_id`, `status`, `tgl_mulai`, `tgl_berakhir`, `user_id`) VALUES
(1, '123', NULL, 0, NULL, NULL, NULL),
(2, 'PNY-001', 1, 0, '2020-05-31', '2020-05-31', 36);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_pengeluaran`
--

CREATE TABLE `transaksi_pengeluaran` (
  `id` int(11) NOT NULL,
  `alat_berat_id` int(11) DEFAULT NULL COMMENT 'FKnya Alat_berat',
  `nominal` int(11) NOT NULL DEFAULT 0,
  `deskripsi` text DEFAULT NULL,
  `tgl_pengeluaran` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_id` int(11) DEFAULT NULL COMMENT 'FKnya User admin yang input data'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `transaksi_pengeluaran`
--

INSERT INTO `transaksi_pengeluaran` (`id`, `alat_berat_id`, `nominal`, `deskripsi`, `tgl_pengeluaran`, `user_id`) VALUES
(1, 3, 200000, 'Perbaikan Oli', '2020-05-30 17:00:00', NULL),
(2, 3, 39000, 'Gani casing', '2020-06-09 17:00:00', NULL),
(3, 3, 500000, 'sd', '2020-06-16 17:00:00', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_pengeluaran2`
--

CREATE TABLE `transaksi_pengeluaran2` (
  `id` int(11) NOT NULL,
  `jenis_pengeluaran` varchar(56) NOT NULL,
  `nominal` int(56) NOT NULL,
  `deskripsi` varchar(128) NOT NULL,
  `tgl_pengeluaran` date NOT NULL,
  `user_id` int(20) DEFAULT NULL,
  `id_coa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transaksi_pengeluaran2`
--

INSERT INTO `transaksi_pengeluaran2` (`id`, `jenis_pengeluaran`, `nominal`, `deskripsi`, `tgl_pengeluaran`, `user_id`, `id_coa`) VALUES
(2, 'Pegawai', 300000, 'air dan listrik', '2020-06-29', NULL, 515),
(3, 'Pegawai', 200000, 'sd', '2020-06-29', NULL, 515),
(4, 'Alat berat', 100000, 'sds', '2020-06-29', NULL, 514);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `username` varchar(30) DEFAULT NULL,
  `id_user` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`username`, `id_user`, `name`, `email`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
('reza', 25, 'Reza Karsini', 'reza@gmail.com', 'default.jpg', '$2y$10$7QCu0z9/QbOabH0BmtuBbOefkI.aqg9tElrNfMI9qeNRMeBJZU51u', 1, 1, 1574297115),
('pelanggan', 28, 'pelanggan', 'pelanggan@gmail.com', 'default.jpg', '$2y$10$HoSDCaPRIrnUUHdg1ZdfEOQ7Wc.42aStaU7n4E7Nn8Fyzwcqy1X1O', 3, 1, 1575291139),
('yuni', 29, 'yuni', 'yuni@gmail.com', 'default.jpg', '$2y$10$nsSHnaOywXLjHOP4icMPl.Wye9TwXbZQZLxZwE9iW3xtXjcLxgS1e', 2, 1, 1576252245),
('asmar', 30, 'Asmar Basta', 'asmasr@gmail.com', 'default.jpg', '$2y$10$BqQcic5UuwA.j7sAOPG57OpcUWqRZFKV3MSJ1eA7eYhtN1P8i1doy', 2, 1, 1576450498),
('reski', 31, 'Reski', 'reski@gmail.com', 'default.jpg', '$2y$10$l/UWwrZD81OJiX49pdA4m.Cu.G9FXI1COhMUHjFPvbj59xqq6LjeW', 2, 1, 1576460481),
('dep01', 32, 'diaz', 'diaz@yahoo.com', 'default.jpg', '$2y$10$blkVf9VYF5rlH3Ux/72fEu4qi3w6oqcy1XM3ghc0WwtG42qTpRmBK', 2, 1, 1589005141),
('dep01', 33, 'diaz', 'diazerlanggaputra@ymail.com', 'default.jpg', '$2y$10$oJZntWL2KObKgbMmBH6SlO76DvUqjRGR2sVU0Xqm8aZK/U12tJQeq', 2, 1, 1589286999),
('aku', 36, 'Aku Sayang Mamah', 'aku@gmail.com', 'default.jpg', '$2y$10$BbExPVSOMVPZ7khqFTpg1uLJC2XcVNCh6.jb05o5JJxHe25lvI.eG', 2, 1, 1589658623),
('bon', 37, 'Asril Hamka', 'arieflow02@gmail.com', 'default.jpg', '$2y$10$0mXi.WtaGbmVFRngY6.4cO98uw68cKO/3xChozmn9Q/XdVNvn/1aG', 2, 1, 1591509856),
('alek', 38, 'Alek', 'aleka@gmail.com', 'default.jpg', '$2y$10$GHFEbsHTB.yFPJdxXyloH.Q/WFZgI47l.zyk/xl0eAxL0bh13FI.O', 1, 1, 1591510305);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(6, 1, 3),
(10, 1, 4),
(19, 1, 7),
(20, 1, 6),
(21, 2, 4),
(23, 2, 7),
(27, 1, 2),
(28, 1, 5),
(29, 2, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'admin'),
(2, 'dashboard'),
(3, 'menu'),
(4, 'user'),
(5, 'master_data'),
(6, 'Transaksi'),
(7, 'Laporan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'accounting'),
(2, 'pemilik'),
(3, 'pelanggan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(3, 4, 'Profile', 'index.php/profile', 'fa fa-user', 1),
(6, 5, 'Chart Of Account', 'index.php/master_data/coa', 'fa fa-book', 1),
(7, 5, 'Alat Berat', 'index.php/master_data/alat_berat', 'fa fa-cog', 1),
(8, 5, 'Pegawai', 'index.php/master_data/pegawai', 'fa fa-users', 1),
(9, 5, 'Pelanggan', 'index.php/master_data/pelanggan', 'fa fa-users', 1),
(10, 6, 'Penyewaan', 'index.php/transaksi/penyewaan_alber', 'fa fa-credit-card', 1),
(11, 7, 'Jurnal', 'index.php/laporan/lihat_jurnal', 'fa fa-file-o', 1),
(12, 7, 'Buku Besar', 'index.php/laporan/buku_besar', 'fa fa-book', 1),
(13, 6, 'Transaksi Pengeluaran', 'index.php/transaksi/pengeluaran', 'fa fa-credit-card', 1),
(14, 5, 'Jenis Alat Berat', 'index.php/master_data/jenis_alat_berat', 'fa fa-cog', 1),
(15, 7, 'Daftar Pajak', 'index.php/laporan/daftar_pajak', 'fa fa-book', 1),
(16, 2, 'Dashboard', 'index.php/dashboard', 'fa fa-home', 1),
(17, 7, 'Laba rugi', 'index.php/laporan/laba_rugi', 'fa fa-book', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `token` varchar(500) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_token`
--

INSERT INTO `user_token` (`id`, `email`, `token`, `date_created`) VALUES
(24, 'taniyayulia51@gmail.com', '2932817c630e75cd29cd68baa4a08ee5', 1568988820),
(25, 'admin@gmail.com', 'a1c3fb08e92241bfd56b7a1c5d796dd9', 1569166263);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `alamat_pegawai`
--
ALTER TABLE `alamat_pegawai`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `alat_berat`
--
ALTER TABLE `alat_berat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jenis_id` (`jenis_id`);

--
-- Indeks untuk tabel `biaya_operasional`
--
ALTER TABLE `biaya_operasional`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `coa`
--
ALTER TABLE `coa`
  ADD PRIMARY KEY (`kode_akun`);

--
-- Indeks untuk tabel `daftar_pajak`
--
ALTER TABLE `daftar_pajak`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaksi_id` (`transaksi_id`);

--
-- Indeks untuk tabel `daftar_pemasukan_pegawai`
--
ALTER TABLE `daftar_pemasukan_pegawai`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaksi_id` (`transaksi_id`);

--
-- Indeks untuk tabel `jenis_alat_berat`
--
ALTER TABLE `jenis_alat_berat`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indeks untuk tabel `jurnal`
--
ALTER TABLE `jurnal`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pengaturan`
--
ALTER TABLE `pengaturan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `alat_berat_id` (`alat_berat_id`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `alat_berat_id` (`alat_berat_id`),
  ADD KEY `pegawai_id` (`pegawai_id`),
  ADD KEY `pelanggan_id` (`pelanggan_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `transaksi_biaya_tambahan`
--
ALTER TABLE `transaksi_biaya_tambahan`
  ADD PRIMARY KEY (`transaksi_id`);

--
-- Indeks untuk tabel `transaksi_new`
--
ALTER TABLE `transaksi_new`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi_pengeluaran`
--
ALTER TABLE `transaksi_pengeluaran`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi_pengeluaran2`
--
ALTER TABLE `transaksi_pengeluaran2`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_coa` (`id_coa`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `alamat_pegawai`
--
ALTER TABLE `alamat_pegawai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `alat_berat`
--
ALTER TABLE `alat_berat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `biaya_operasional`
--
ALTER TABLE `biaya_operasional`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `daftar_pajak`
--
ALTER TABLE `daftar_pajak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `daftar_pemasukan_pegawai`
--
ALTER TABLE `daftar_pemasukan_pegawai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `jenis_alat_berat`
--
ALTER TABLE `jenis_alat_berat`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `jurnal`
--
ALTER TABLE `jurnal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `pengaturan`
--
ALTER TABLE `pengaturan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT untuk tabel `transaksi_new`
--
ALTER TABLE `transaksi_new`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `transaksi_pengeluaran`
--
ALTER TABLE `transaksi_pengeluaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `transaksi_pengeluaran2`
--
ALTER TABLE `transaksi_pengeluaran2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `alat_berat`
--
ALTER TABLE `alat_berat`
  ADD CONSTRAINT `alat_berat_ibfk_1` FOREIGN KEY (`jenis_id`) REFERENCES `jenis_alat_berat` (`id_jenis`);

--
-- Ketidakleluasaan untuk tabel `daftar_pajak`
--
ALTER TABLE `daftar_pajak`
  ADD CONSTRAINT `daftar_pajak_ibfk_1` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`);

--
-- Ketidakleluasaan untuk tabel `daftar_pemasukan_pegawai`
--
ALTER TABLE `daftar_pemasukan_pegawai`
  ADD CONSTRAINT `daftar_pemasukan_pegawai_ibfk_1` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`);

--
-- Ketidakleluasaan untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`alat_berat_id`) REFERENCES `alat_berat` (`id`);

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`alat_berat_id`) REFERENCES `alat_berat` (`id`),
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`pegawai_id`) REFERENCES `pegawai` (`id`),
  ADD CONSTRAINT `transaksi_ibfk_3` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggan` (`id`),
  ADD CONSTRAINT `transaksi_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `transaksi_pengeluaran2`
--
ALTER TABLE `transaksi_pengeluaran2`
  ADD CONSTRAINT `transaksi_pengeluaran2_ibfk_1` FOREIGN KEY (`id_coa`) REFERENCES `coa` (`kode_akun`),
  ADD CONSTRAINT `transaksi_pengeluaran2_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
