/*
Navicat MySQL Data Transfer

Source Server         : zombi-host
Source Server Version : 100410
Source Host           : localhost:3306
Source Database       : dev_cvainunjaya

Target Server Type    : MYSQL
Target Server Version : 100410
File Encoding         : 65001

Date: 2020-05-31 21:19:38
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for alamat_pegawai
-- ----------------------------
DROP TABLE IF EXISTS `alamat_pegawai`;
CREATE TABLE `alamat_pegawai` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pegawai_id` int(11) DEFAULT NULL,
  `alamat` varchar(500) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of alamat_pegawai
-- ----------------------------
INSERT INTO `alamat_pegawai` VALUES ('1', '2', 'jalan kenangan', '1');
INSERT INTO `alamat_pegawai` VALUES ('2', '2', 'jalan Indah', '9');
INSERT INTO `alamat_pegawai` VALUES ('3', '2', 'jalan Permai', '9');

-- ----------------------------
-- Table structure for alat_berat
-- ----------------------------
DROP TABLE IF EXISTS `alat_berat`;
CREATE TABLE `alat_berat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kd_tipe` varchar(30) DEFAULT NULL,
  `nama_alber` varchar(30) DEFAULT NULL,
  `merk` varchar(30) DEFAULT NULL,
  `harga_sewa` int(11) DEFAULT NULL,
  `harga_sewa_khusus` int(11) NOT NULL DEFAULT 0,
  `biaya_sopir` int(11) DEFAULT 0,
  `foto` varchar(300) DEFAULT NULL,
  `status` int(11) DEFAULT 0 COMMENT '0 => tersedia, 1 => Digunakan',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of alat_berat
-- ----------------------------
INSERT INTO `alat_berat` VALUES ('3', 'AB-001', 'Excava 200', 'Pindad', '6720000', '0', '200000', null, '0');

-- ----------------------------
-- Table structure for biaya_operasional
-- ----------------------------
DROP TABLE IF EXISTS `biaya_operasional`;
CREATE TABLE `biaya_operasional` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `harga` int(11) DEFAULT 0,
  `satuan` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of biaya_operasional
-- ----------------------------
INSERT INTO `biaya_operasional` VALUES ('1', 'Bensin 10 Liter Solar', '55000', 'Liter');
INSERT INTO `biaya_operasional` VALUES ('2', 'Sparepart Tambahan', '10000', 'pcs');

-- ----------------------------
-- Table structure for coa
-- ----------------------------
DROP TABLE IF EXISTS `coa`;
CREATE TABLE `coa` (
  `kode_akun` int(11) NOT NULL,
  `nama_akun` varchar(30) DEFAULT NULL,
  `header_akun` int(11) DEFAULT NULL,
  PRIMARY KEY (`kode_akun`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of coa
-- ----------------------------
INSERT INTO `coa` VALUES ('111', 'Kas', '1');
INSERT INTO `coa` VALUES ('112', 'piutang', '1');
INSERT INTO `coa` VALUES ('113', 'perlengkapan', '1');
INSERT INTO `coa` VALUES ('411', 'pendapatan sewa', '4');
INSERT INTO `coa` VALUES ('511', 'Beban Gaji', '5');

-- ----------------------------
-- Table structure for daftar_pajak
-- ----------------------------
DROP TABLE IF EXISTS `daftar_pajak`;
CREATE TABLE `daftar_pajak` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nominal_pajak` int(11) DEFAULT NULL,
  `transaksi_id` int(11) DEFAULT NULL COMMENT 'FK nya Transaksi Sewa',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of daftar_pajak
-- ----------------------------

-- ----------------------------
-- Table structure for daftar_pemasukan_pegawai
-- ----------------------------
DROP TABLE IF EXISTS `daftar_pemasukan_pegawai`;
CREATE TABLE `daftar_pemasukan_pegawai` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nominal` int(11) DEFAULT 0,
  `persen` int(11) NOT NULL DEFAULT 0,
  `transaksi_id` int(11) DEFAULT NULL COMMENT 'FK nya Transaksi Sewa',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of daftar_pemasukan_pegawai
-- ----------------------------
INSERT INTO `daftar_pemasukan_pegawai` VALUES ('1', '200000', '20', '1');

-- ----------------------------
-- Table structure for jurnal
-- ----------------------------
DROP TABLE IF EXISTS `jurnal`;
CREATE TABLE `jurnal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_akun` varchar(30) DEFAULT NULL,
  `tgl_jurnal` date DEFAULT NULL,
  `nominal` int(11) DEFAULT NULL,
  `posisi_dr_cr` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of jurnal
-- ----------------------------
INSERT INTO `jurnal` VALUES ('1', '111', '2019-12-14', '332160000', 'debit');
INSERT INTO `jurnal` VALUES ('2', '411', '2019-12-14', '332160000', 'kredit');
INSERT INTO `jurnal` VALUES ('3', '111', '2019-12-14', '62280000', 'debit');
INSERT INTO `jurnal` VALUES ('4', '411', '2019-12-14', '62280000', 'kredit');
INSERT INTO `jurnal` VALUES ('5', '111', '2019-12-15', '51900000', 'debit');
INSERT INTO `jurnal` VALUES ('6', '112', '2019-12-15', '51900000', 'debit');
INSERT INTO `jurnal` VALUES ('7', '411', '2019-12-15', '103800000', 'kredit');
INSERT INTO `jurnal` VALUES ('8', '111', '2019-12-15', '0', 'debit');
INSERT INTO `jurnal` VALUES ('9', '112', '2019-12-15', '0', 'debit');
INSERT INTO `jurnal` VALUES ('10', '411', '2019-12-15', '0', 'kredit');
INSERT INTO `jurnal` VALUES ('11', '111', '2019-12-15', '50400000', 'debit');
INSERT INTO `jurnal` VALUES ('12', '112', '2019-12-15', '50400000', 'debit');
INSERT INTO `jurnal` VALUES ('13', '411', '2019-12-15', '100800000', 'kredit');
INSERT INTO `jurnal` VALUES ('14', '111', '2019-12-15', '3360000', 'debit');
INSERT INTO `jurnal` VALUES ('15', '112', '2019-12-15', '3360000', 'debit');
INSERT INTO `jurnal` VALUES ('16', '411', '2019-12-15', '6720000', 'kredit');
INSERT INTO `jurnal` VALUES ('17', '111', '2019-12-15', '700039', 'debit');
INSERT INTO `jurnal` VALUES ('18', '112', '2019-12-15', '700039', 'debit');
INSERT INTO `jurnal` VALUES ('19', '411', '2019-12-15', '1400077', 'kredit');
INSERT INTO `jurnal` VALUES ('20', '111', '2019-12-15', '62280000', 'debit');
INSERT INTO `jurnal` VALUES ('21', '411', '2019-12-15', '62280000', 'kredit');
INSERT INTO `jurnal` VALUES ('22', '111', '2019-12-16', '10380000', 'debit');
INSERT INTO `jurnal` VALUES ('23', '112', '2019-12-16', '10380000', 'debit');
INSERT INTO `jurnal` VALUES ('24', '411', '2019-12-16', '20760000', 'kredit');
INSERT INTO `jurnal` VALUES ('25', '111', '2020-03-04', '2000000', 'debit');
INSERT INTO `jurnal` VALUES ('26', '112', '2020-03-04', '184840000', 'debit');
INSERT INTO `jurnal` VALUES ('27', '411', '2020-03-04', '186840000', 'kredit');

-- ----------------------------
-- Table structure for pegawai
-- ----------------------------
DROP TABLE IF EXISTS `pegawai`;
CREATE TABLE `pegawai` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kd_pegawai` varchar(30) DEFAULT NULL,
  `nama_pegawai` varchar(30) DEFAULT NULL,
  `no_telp` varchar(12) DEFAULT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `status_sopir` int(1) NOT NULL,
  `biaya` int(5) NOT NULL,
  `pajak` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of pegawai
-- ----------------------------
INSERT INTO `pegawai` VALUES ('1', 'SPR-001', 'Topik', '087675786876', null, '1', '0', '0');
INSERT INTO `pegawai` VALUES ('2', 'SPR-002', 'Bohim', '0989889494', null, '0', '200000', '20');

-- ----------------------------
-- Table structure for pelanggan
-- ----------------------------
DROP TABLE IF EXISTS `pelanggan`;
CREATE TABLE `pelanggan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kd_pelanggan` varchar(30) DEFAULT NULL,
  `nama_pelanggan` varchar(30) DEFAULT NULL,
  `alamat` varchar(300) DEFAULT NULL,
  `no_telp` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of pelanggan
-- ----------------------------
INSERT INTO `pelanggan` VALUES ('1', 'PLG-001', 'Rijul', 'cidurian', '0890809343');

-- ----------------------------
-- Table structure for pengaturan
-- ----------------------------
DROP TABLE IF EXISTS `pengaturan`;
CREATE TABLE `pengaturan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `isi` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pengaturan
-- ----------------------------
INSERT INTO `pengaturan` VALUES ('1', 'sejarah', 'perusahaan ini berdiri sejak blablabla');
INSERT INTO `pengaturan` VALUES ('2', 'kontak', 'hubungi 08878787878787');
INSERT INTO `pengaturan` VALUES ('3', 'persen_operasional_sopir', '90');

-- ----------------------------
-- Table structure for produk
-- ----------------------------
DROP TABLE IF EXISTS `produk`;
CREATE TABLE `produk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alat_berat_id` int(11) DEFAULT NULL,
  `biaya_operasional_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of produk
-- ----------------------------
INSERT INTO `produk` VALUES ('1', '3', '1');
INSERT INTO `produk` VALUES ('2', '3', '2');

-- ----------------------------
-- Table structure for transaksi
-- ----------------------------
DROP TABLE IF EXISTS `transaksi`;
CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `user_id` int(11) DEFAULT NULL COMMENT 'FK nya user Admin yang input data',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of transaksi
-- ----------------------------
INSERT INTO `transaksi` VALUES ('1', 'PNY-001', '3', '1', '2', '6920000', '0', '0', '0', '2020-05-31 19:34:59', '2020-05-31 00:00:00', '2020-05-31', '2020-06-01', '36');

-- ----------------------------
-- Table structure for transaksi_biaya_tambahan
-- ----------------------------
DROP TABLE IF EXISTS `transaksi_biaya_tambahan`;
CREATE TABLE `transaksi_biaya_tambahan` (
  `transaksi_id` int(11) NOT NULL,
  `id_biaya_tambahan` int(11) DEFAULT NULL,
  PRIMARY KEY (`transaksi_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of transaksi_biaya_tambahan
-- ----------------------------

-- ----------------------------
-- Table structure for transaksi_detail
-- ----------------------------
DROP TABLE IF EXISTS `transaksi_detail`;
CREATE TABLE `transaksi_detail` (
  `transaksi_id` int(30) DEFAULT NULL,
  `biaya_operasional_id` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of transaksi_detail
-- ----------------------------
INSERT INTO `transaksi_detail` VALUES ('1', '1', '55000', '55000');
INSERT INTO `transaksi_detail` VALUES ('1', '2', '10000', '65000');

-- ----------------------------
-- Table structure for transaksi_detail_new
-- ----------------------------
DROP TABLE IF EXISTS `transaksi_detail_new`;
CREATE TABLE `transaksi_detail_new` (
  `transaksi_id` int(30) DEFAULT NULL,
  `id_alat_berat` int(11) DEFAULT NULL,
  `id_pegawai` int(11) DEFAULT NULL,
  `jml` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of transaksi_detail_new
-- ----------------------------

-- ----------------------------
-- Table structure for transaksi_new
-- ----------------------------
DROP TABLE IF EXISTS `transaksi_new`;
CREATE TABLE `transaksi_new` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kd_penyewaan` varchar(30) DEFAULT NULL,
  `pelanggan_id` int(11) DEFAULT NULL COMMENT 'FK nya customer / pelanggan',
  `status` tinyint(4) DEFAULT 0 COMMENT '0 => ‘Belum Lunas’,  1 => ‘Lunas’',
  `tgl_mulai` date DEFAULT NULL,
  `tgl_berakhir` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL COMMENT 'FK nya user Admin yang input data',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of transaksi_new
-- ----------------------------
INSERT INTO `transaksi_new` VALUES ('1', '123', null, '0', null, null, null);
INSERT INTO `transaksi_new` VALUES ('2', 'PNY-001', '1', '0', '2020-05-31', '2020-05-31', '36');

-- ----------------------------
-- Table structure for transaksi_pengeluaran
-- ----------------------------
DROP TABLE IF EXISTS `transaksi_pengeluaran`;
CREATE TABLE `transaksi_pengeluaran` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alat_berat_id` int(11) DEFAULT NULL COMMENT 'FKnya Alat_berat',
  `nominal` int(11) NOT NULL DEFAULT 0,
  `deskripsi` text DEFAULT NULL,
  `tgl_pengeluaran` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_id` int(11) DEFAULT NULL COMMENT 'FKnya User admin yang input data',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of transaksi_pengeluaran
-- ----------------------------
INSERT INTO `transaksi_pengeluaran` VALUES ('1', '3', '200000', 'Perbaikan Oli', '2020-05-31 00:00:00', null);

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `username` varchar(30) DEFAULT NULL,
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('reza', '25', 'Reza Karsini', 'reza@gmail.com', 'default.jpg', '$2y$10$7QCu0z9/QbOabH0BmtuBbOefkI.aqg9tElrNfMI9qeNRMeBJZU51u', '1', '1', '1574297115');
INSERT INTO `user` VALUES ('pelanggan', '28', 'pelanggan', 'pelanggan@gmail.com', 'default.jpg', '$2y$10$HoSDCaPRIrnUUHdg1ZdfEOQ7Wc.42aStaU7n4E7Nn8Fyzwcqy1X1O', '3', '1', '1575291139');
INSERT INTO `user` VALUES ('yuni', '29', 'yuni', 'yuni@gmail.com', 'default.jpg', '$2y$10$nsSHnaOywXLjHOP4icMPl.Wye9TwXbZQZLxZwE9iW3xtXjcLxgS1e', '2', '1', '1576252245');
INSERT INTO `user` VALUES ('asmar', '30', 'Asmar Basta', 'asmasr@gmail.com', 'default.jpg', '$2y$10$BqQcic5UuwA.j7sAOPG57OpcUWqRZFKV3MSJ1eA7eYhtN1P8i1doy', '2', '1', '1576450498');
INSERT INTO `user` VALUES ('reski', '31', 'Reski', 'reski@gmail.com', 'default.jpg', '$2y$10$l/UWwrZD81OJiX49pdA4m.Cu.G9FXI1COhMUHjFPvbj59xqq6LjeW', '2', '1', '1576460481');
INSERT INTO `user` VALUES ('dep01', '32', 'diaz', 'diaz@yahoo.com', 'default.jpg', '$2y$10$blkVf9VYF5rlH3Ux/72fEu4qi3w6oqcy1XM3ghc0WwtG42qTpRmBK', '2', '1', '1589005141');
INSERT INTO `user` VALUES ('dep01', '33', 'diaz', 'diazerlanggaputra@ymail.com', 'default.jpg', '$2y$10$oJZntWL2KObKgbMmBH6SlO76DvUqjRGR2sVU0Xqm8aZK/U12tJQeq', '2', '1', '1589286999');
INSERT INTO `user` VALUES ('aku', '36', 'Aku Sayang Mamah', 'aku@gmail.com', 'default.jpg', '$2y$10$BbExPVSOMVPZ7khqFTpg1uLJC2XcVNCh6.jb05o5JJxHe25lvI.eG', '2', '1', '1589658623');

-- ----------------------------
-- Table structure for user_access_menu
-- ----------------------------
DROP TABLE IF EXISTS `user_access_menu`;
CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user_access_menu
-- ----------------------------
INSERT INTO `user_access_menu` VALUES ('1', '1', '1');
INSERT INTO `user_access_menu` VALUES ('6', '1', '3');
INSERT INTO `user_access_menu` VALUES ('10', '1', '4');
INSERT INTO `user_access_menu` VALUES ('19', '1', '7');
INSERT INTO `user_access_menu` VALUES ('20', '1', '6');
INSERT INTO `user_access_menu` VALUES ('21', '2', '4');
INSERT INTO `user_access_menu` VALUES ('23', '2', '6');
INSERT INTO `user_access_menu` VALUES ('24', '2', '2');
INSERT INTO `user_access_menu` VALUES ('26', '2', '5');
INSERT INTO `user_access_menu` VALUES ('27', '1', '2');

-- ----------------------------
-- Table structure for user_menu
-- ----------------------------
DROP TABLE IF EXISTS `user_menu`;
CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user_menu
-- ----------------------------
INSERT INTO `user_menu` VALUES ('1', 'admin');
INSERT INTO `user_menu` VALUES ('2', 'dashboard');
INSERT INTO `user_menu` VALUES ('3', 'menu');
INSERT INTO `user_menu` VALUES ('4', 'user');
INSERT INTO `user_menu` VALUES ('5', 'master_data');
INSERT INTO `user_menu` VALUES ('6', 'Transaksi');
INSERT INTO `user_menu` VALUES ('7', 'Laporan');

-- ----------------------------
-- Table structure for user_role
-- ----------------------------
DROP TABLE IF EXISTS `user_role`;
CREATE TABLE `user_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user_role
-- ----------------------------
INSERT INTO `user_role` VALUES ('1', 'admin');
INSERT INTO `user_role` VALUES ('2', 'pemilik');
INSERT INTO `user_role` VALUES ('3', 'pelanggan');

-- ----------------------------
-- Table structure for user_sub_menu
-- ----------------------------
DROP TABLE IF EXISTS `user_sub_menu`;
CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user_sub_menu
-- ----------------------------
INSERT INTO `user_sub_menu` VALUES ('1', '1', 'Hak Akses', 'index.php/admin/role', 'fa fa-lock', '1');
INSERT INTO `user_sub_menu` VALUES ('3', '4', 'Profil', 'index.php/master_data/profil', 'fa fa-user', '1');
INSERT INTO `user_sub_menu` VALUES ('6', '5', 'Chart Of Account', 'index.php/master_data/coa', 'fa fa-book', '1');
INSERT INTO `user_sub_menu` VALUES ('7', '5', 'Alat Berat', 'index.php/master_data/alat_berat', 'fa fa-cog', '1');
INSERT INTO `user_sub_menu` VALUES ('8', '5', 'Pegawai', 'index.php/master_data/pegawai', 'fa fa-users', '1');
INSERT INTO `user_sub_menu` VALUES ('9', '5', 'Pelanggan', 'index.php/master_data/pelanggan', 'fa fa-users', '1');
INSERT INTO `user_sub_menu` VALUES ('10', '6', 'Penyewaan', 'index.php/transaksi/penyewaan_alber', 'fa fa-credit-card', '1');
INSERT INTO `user_sub_menu` VALUES ('11', '7', 'Jurnal', 'index.php/laporan/lihat_jurnal', 'fa fa-file-o', '1');
INSERT INTO `user_sub_menu` VALUES ('12', '7', 'Buku Besar', 'index.php/laporan/buku_besar', 'fa fa-book', '1');
INSERT INTO `user_sub_menu` VALUES ('13', '6', 'Transaksi Pengeluaran', 'index.php/transaksi/pengeluaran', 'fa fa-credit-card', '1');

-- ----------------------------
-- Table structure for user_token
-- ----------------------------
DROP TABLE IF EXISTS `user_token`;
CREATE TABLE `user_token` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(128) NOT NULL,
  `token` varchar(500) NOT NULL,
  `date_created` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user_token
-- ----------------------------
INSERT INTO `user_token` VALUES ('24', 'taniyayulia51@gmail.com', '2932817c630e75cd29cd68baa4a08ee5', '1568988820');
INSERT INTO `user_token` VALUES ('25', 'admin@gmail.com', 'a1c3fb08e92241bfd56b7a1c5d796dd9', '1569166263');
SET FOREIGN_KEY_CHECKS=1;
