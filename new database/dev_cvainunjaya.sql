-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Jun 2020 pada 01.31
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
(3, 'AB-001', 'Excava 200', 1, 'Pindad', 6820000, 0, 200000, NULL, 0),
(5, 'AB-002', 'Dump Truck', 2, 'dump dump', 10000000, 20000000, 0, NULL, 0);

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
(114, 'Pajak Dibayar Dimuka', 1),
(211, 'Utang Sewa', 2),
(411, 'pendapatan sewa', 4),
(511, 'Beban Gaji', 5);

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
(1, 259400, 6);

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
(1, 200000, 20, 1),
(2, 400000, 20, 2),
(3, 4200000, 20, 3),
(4, 0, 0, 4),
(5, 600000, 20, 5),
(6, 500000, 25, 6);

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
(2, 'JB-002', 'DUMP TRUCK'),
(4, 'JB-003', 'mole');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jurnal`
--

CREATE TABLE `jurnal` (
  `id` int(11) NOT NULL,
  `kode_akun` varchar(30) DEFAULT NULL,
  `tgl_jurnal` date DEFAULT NULL,
  `nominal` int(11) DEFAULT NULL,
  `posisi_dr_cr` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jurnal`
--

INSERT INTO `jurnal` (`id`, `kode_akun`, `tgl_jurnal`, `nominal`, `posisi_dr_cr`) VALUES
(1, '111', '2019-12-14', 332160000, 'debit'),
(2, '411', '2019-12-14', 332160000, 'kredit'),
(3, '111', '2019-12-14', 62280000, 'debit'),
(4, '411', '2019-12-14', 62280000, 'kredit'),
(5, '111', '2019-12-15', 51900000, 'debit'),
(6, '112', '2019-12-15', 51900000, 'debit'),
(7, '411', '2019-12-15', 103800000, 'kredit'),
(8, '111', '2019-12-15', 0, 'debit'),
(9, '112', '2019-12-15', 0, 'debit'),
(10, '411', '2019-12-15', 0, 'kredit'),
(11, '111', '2019-12-15', 50400000, 'debit'),
(12, '112', '2019-12-15', 50400000, 'debit'),
(13, '411', '2019-12-15', 100800000, 'kredit'),
(14, '111', '2019-12-15', 3360000, 'debit'),
(15, '112', '2019-12-15', 3360000, 'debit'),
(16, '411', '2019-12-15', 6720000, 'kredit'),
(17, '111', '2019-12-15', 700039, 'debit'),
(18, '112', '2019-12-15', 700039, 'debit'),
(19, '411', '2019-12-15', 1400077, 'kredit'),
(20, '111', '2019-12-15', 62280000, 'debit'),
(21, '411', '2019-12-15', 62280000, 'kredit'),
(22, '111', '2019-12-16', 10380000, 'debit'),
(23, '112', '2019-12-16', 10380000, 'debit'),
(24, '411', '2019-12-16', 20760000, 'kredit'),
(25, '111', '2020-03-04', 2000000, 'debit'),
(26, '112', '2020-03-04', 184840000, 'debit'),
(27, '411', '2020-03-04', 186840000, 'kredit'),
(28, '115', '2020-06-10', 10000000, 'debit'),
(29, '118', '2020-06-10', 4074400, 'debit'),
(30, '111', '2020-06-10', 14074400, 'kredit'),
(31, '115', '2020-06-10', 4074400, 'debit'),
(32, '118', '2020-06-10', 0, 'debit'),
(33, '111', '2020-06-10', 14074400, 'kredit'),
(34, '111', '2020-06-10', 20739936, 'debit'),
(35, '117', '2020-06-10', 423264, 'debit'),
(36, '411', '2020-06-10', 21163200, 'kredit');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `id` int(11) NOT NULL,
  `kd_pegawai` varchar(30) DEFAULT NULL,
  `nama_pegawai` varchar(30) DEFAULT NULL,
  `no_telp` varchar(12) DEFAULT NULL,
  `alamat` varchar(15) DEFAULT NULL,
  `status_sopir` int(1) NOT NULL,
  `biaya` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`id`, `kd_pegawai`, `nama_pegawai`, `no_telp`, `alamat`, `status_sopir`, `biaya`) VALUES
(1, 'SPR-001', 'Topik', '087675786876', NULL, 0, 0),
(2, 'SPR-002', 'Bohim', '0989889494', NULL, 0, 200000),
(4, 'SPR-003', 'Asril', '08814539943', NULL, 0, 0),
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
(1, 'PNY-001', 3, 1, 2, 6920000, 6920000, 0, 1, '2020-05-31 19:34:59', '2020-05-31 17:00:00', '2020-05-31', '2020-06-01', 36),
(2, 'PNY-002', 3, 1, 2, 13840000, 13840000, 0, 1, '2020-06-10 00:37:42', '2020-06-11 17:00:00', '2020-06-10', '2020-06-12', 38),
(3, 'PNY-003', 3, 1, 2, 148142400, 0, 0, 0, '2020-06-10 01:11:16', NULL, '2020-06-09', '2020-06-30', 38),
(4, 'PNY-004', 3, 1, 1, 13708800, 0, 0, 0, '2020-06-10 02:44:52', NULL, '2020-06-09', '2020-06-11', 37),
(5, 'PNY-005', 3, 1, 2, 21163200, 21163200, 0, 1, '2020-06-10 03:13:46', '2020-06-09 17:00:00', '2020-06-09', '2020-06-12', 37),
(6, 'PNY-006', 3, 1, 5, 14074400, 4074400, 0, 0, '2020-06-10 15:13:08', '2020-06-10 17:00:00', '2020-06-10', '2020-06-12', 38);

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
(6, 2, 10000, 65000);

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
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `daftar_pemasukan_pegawai`
--
ALTER TABLE `daftar_pemasukan_pegawai`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `biaya_operasional`
--
ALTER TABLE `biaya_operasional`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `daftar_pajak`
--
ALTER TABLE `daftar_pajak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `daftar_pemasukan_pegawai`
--
ALTER TABLE `daftar_pemasukan_pegawai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `jenis_alat_berat`
--
ALTER TABLE `jenis_alat_berat`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `jurnal`
--
ALTER TABLE `jurnal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
