-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 15 Des 2019 pada 16.35
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `2017_rizka`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `alat_berat`
--

CREATE TABLE `alat_berat` (
  `id` int(11) NOT NULL,
  `kd_tipe` varchar(30) DEFAULT NULL,
  `nama_alber` varchar(30) DEFAULT NULL,
  `merk` varchar(30) DEFAULT NULL,
  `harga_sewa` int(11) DEFAULT NULL,
  `satuan` varchar(30) DEFAULT NULL,
  `foto` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `alat_berat`
--

INSERT INTO `alat_berat` (`id`, `kd_tipe`, `nama_alber`, `merk`, `harga_sewa`, `satuan`, `foto`) VALUES
(3, 'AB-001', 'Excava 200', 'Pindad', 6720000, 'Hari', NULL),
(4, 'AB-002', 'sadsa', 'dasd', 11, 'sdas', NULL);

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
(411, 'pendapatan sewa', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `daftar_pajak`
--

CREATE TABLE `daftar_pajak` (
  `id` int(11) NOT NULL,
  `kd_penyewaan` varchar(30) DEFAULT NULL,
  `kd_pelanggan` varchar(30) DEFAULT NULL,
  `jml_kendaraan` int(11) DEFAULT NULL,
  `nominal_pajak` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_penyewaan`
--

CREATE TABLE `detail_penyewaan` (
  `id` int(11) NOT NULL,
  `kd_penyewaan` varchar(30) DEFAULT NULL,
  `kd_pegawai` varchar(30) DEFAULT NULL,
  `kd_pelanggan` varchar(30) DEFAULT NULL,
  `kd_alat_berat` varchar(30) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `subtotal` int(11) DEFAULT NULL,
  `lama_penyewaan` int(11) DEFAULT NULL,
  `tgl_expired` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_penyewaan`
--

INSERT INTO `detail_penyewaan` (`id`, `kd_penyewaan`, `kd_pegawai`, `kd_pelanggan`, `kd_alat_berat`, `harga`, `subtotal`, `lama_penyewaan`, `tgl_expired`) VALUES
(21, 'PNY-001', '1', 'PLG-001', 'AB-001', 6720000, 100800000, 15, '2019-12-31');

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
(13, '411', '2019-12-15', 100800000, 'kredit');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `id` int(11) NOT NULL,
  `kd_pegawai` varchar(30) DEFAULT NULL,
  `nama_pegawai` varchar(30) DEFAULT NULL,
  `alamat` varchar(300) DEFAULT NULL,
  `no_telp` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`id`, `kd_pegawai`, `nama_pegawai`, `alamat`, `no_telp`) VALUES
(1, 'SPR-001', 'Topik', 'Antapani', '087675786876'),
(2, 'SPR-002', 'Bohim', 'Sidolig', '0989889494'),
(3, '1', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(11) NOT NULL,
  `kd_pelanggan` varchar(30) DEFAULT NULL,
  `nama_pelanggan` varchar(30) DEFAULT NULL,
  `alamat` varchar(300) DEFAULT NULL,
  `no_telp` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `kd_pelanggan`, `nama_pelanggan`, `alamat`, `no_telp`) VALUES
(1, 'PLG-001', 'Rijul', 'cidurian', '0890809343');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penyewaan`
--

CREATE TABLE `penyewaan` (
  `id` int(11) NOT NULL,
  `kd_penyewaan` varchar(30) DEFAULT NULL,
  `tgl_penyewaan` date DEFAULT NULL,
  `tgl_expired` date DEFAULT NULL,
  `nominal` int(11) DEFAULT NULL,
  `jml_bayar` int(11) DEFAULT NULL,
  `sisa` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `penyewaan`
--

INSERT INTO `penyewaan` (`id`, `kd_penyewaan`, `tgl_penyewaan`, `tgl_expired`, `nominal`, `jml_bayar`, `sisa`, `status`) VALUES
(6, 'PNY-001', '2019-12-15', '2019-12-31', 100800000, 50400000, 50400000, 2);

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
('yuni', 29, 'yuni', 'yuni@gmail.com', 'default.jpg', '$2y$10$nsSHnaOywXLjHOP4icMPl.Wye9TwXbZQZLxZwE9iW3xtXjcLxgS1e', 2, 1, 1576252245);

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
(23, 2, 6),
(24, 2, 2),
(26, 2, 5),
(27, 1, 2);

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
(1, 'admin'),
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
(1, 1, 'Hak Akses', 'admin/role', 'fa fa-lock', 1),
(3, 4, 'Profil', 'user', 'fa fa-user', 1),
(6, 5, 'Chart Of Account', 'master_data/coa', 'fa fa-book', 1),
(7, 5, 'Alat Berat', 'master_data/alat_berat', 'fa fa-cog', 1),
(8, 5, 'Pegawai', 'master_data/pegawai', 'fa fa-users', 1),
(9, 5, 'Pelanggan', 'master_data/pelanggan', 'fa fa-users', 1),
(10, 6, 'Penyewaan', 'transaksi/penyewaan_alber', 'fa fa-credit-card', 1),
(11, 7, 'Jurnal', 'laporan/lihat_jurnal', 'fa fa-file-o', 1),
(12, 7, 'Buku Besar', 'laporan/buku_besar', 'fa fa-book', 1);

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
-- Indeks untuk tabel `alat_berat`
--
ALTER TABLE `alat_berat`
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
-- Indeks untuk tabel `detail_penyewaan`
--
ALTER TABLE `detail_penyewaan`
  ADD PRIMARY KEY (`id`);

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
-- Indeks untuk tabel `penyewaan`
--
ALTER TABLE `penyewaan`
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
-- AUTO_INCREMENT untuk tabel `alat_berat`
--
ALTER TABLE `alat_berat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `daftar_pajak`
--
ALTER TABLE `daftar_pajak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `detail_penyewaan`
--
ALTER TABLE `detail_penyewaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `jurnal`
--
ALTER TABLE `jurnal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `penyewaan`
--
ALTER TABLE `penyewaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
