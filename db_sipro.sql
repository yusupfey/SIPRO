-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Agu 2020 pada 06.14
-- Versi server: 10.4.13-MariaDB
-- Versi PHP: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sipro`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `akses`
--

CREATE TABLE `akses` (
  `id_akses` int(11) NOT NULL,
  `akses` varchar(55) NOT NULL,
  `redirec` varchar(55) NOT NULL,
  `url` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `akses`
--

INSERT INTO `akses` (`id_akses`, `akses`, `redirec`, `url`) VALUES
(1, 'admin', 'Halaman Admin', 'Dashboard'),
(2, 'user1', 'Halaman User', 'Home/profil'),
(3, 'user2', 'Halaman Admin', 'Dashboard');

-- --------------------------------------------------------

--
-- Struktur dari tabel `booking`
--

CREATE TABLE `booking` (
  `id_booking` int(11) NOT NULL,
  `user` varchar(11) NOT NULL,
  `id` varchar(11) NOT NULL,
  `tgl` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `claster`
--

CREATE TABLE `claster` (
  `id_claster` varchar(11) NOT NULL,
  `id_perumahan` varchar(11) NOT NULL,
  `claster` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `claster`
--

INSERT INTO `claster` (`id_claster`, `id_perumahan`, `claster`) VALUES
('CL000001', 'PRU0000001', 'Bukit Hijau'),
('CL000002', 'PRU0000004', 'Sakura'),
('CL000003', 'PRU0000006', 'Bodiaola'),
('CL000004', 'PRU0000004', 'Samosir'),
('CL000005', 'PRU0000001', 'Var verde'),
('CL000006', 'PRU0000001', 'Bukit Teletabies');

-- --------------------------------------------------------

--
-- Struktur dari tabel `contract`
--

CREATE TABLE `contract` (
  `id` int(11) NOT NULL,
  `id_user` varchar(11) NOT NULL,
  `tanggal` date NOT NULL,
  `masa_aktif` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `contract`
--

INSERT INTO `contract` (`id`, `id_user`, `tanggal`, `masa_aktif`) VALUES
(1, 'U014', '2020-07-13', '2020-10-13'),
(2, 'U003', '2020-06-01', '2020-08-01'),
(3, 'U004', '2020-07-16', '2021-02-16'),
(4, 'U016', '2020-07-23', '2020-10-23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `histori_transaksi`
--

CREATE TABLE `histori_transaksi` (
  `id_user` varchar(11) NOT NULL,
  `paket` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `histori_transaksi`
--

INSERT INTO `histori_transaksi` (`id_user`, `paket`, `tanggal`, `keterangan`) VALUES
('U001', 1, '2020-03-22', 'Transaksi Telah Di Konfirmasi'),
('U003', 3, '2020-03-22', 'Transaksi Telah Di Konfirmasi'),
('U006', 2, '2020-03-22', 'Transaksi Telah Di Konfirmasi'),
('U005', 1, '2020-03-23', 'Transaksi Telah Di Konfirmasi'),
('U004', 3, '2020-03-24', 'Transaksi Telah Di Konfirmasi'),
('U007', 2, '2020-03-26', 'Transaksi Telah Di Konfirmasi'),
('U011', 2, '2020-04-02', 'Transaksi Telah Di Konfirmasi'),
('U012', 1, '2020-04-15', 'Transaksi Telah Di Konfirmasi'),
('U012', 2, '2020-04-15', 'Transaksi Telah Di Konfirmasi'),
('U013', 1, '2020-04-15', 'Transaksi Telah Di Konfirmasi'),
('U014', 1, '2020-07-14', 'Transaksi Telah Di Konfirmasi'),
('U004', 2, '2020-07-16', 'Transaksi Telah Di Konfirmasi'),
('U016', 1, '2020-07-23', 'Transaksi Telah Di Konfirmasi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `history_penjualan`
--

CREATE TABLE `history_penjualan` (
  `id` int(11) NOT NULL,
  `id_user` varchar(11) NOT NULL,
  `id_perum` varchar(11) NOT NULL,
  `tgl_booking` date NOT NULL,
  `tgl_jual` date NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `history_penjualan`
--

INSERT INTO `history_penjualan` (`id`, `id_user`, `id_perum`, `tgl_booking`, `tgl_jual`, `keterangan`) VALUES
(12, 'U008', 'PRH0000001', '2020-07-31', '2020-07-31', 'Terjual');

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_user`
--

CREATE TABLE `log_user` (
  `id_log` int(11) NOT NULL,
  `id_user` varchar(11) NOT NULL,
  `username` varchar(55) NOT NULL,
  `password` varchar(55) NOT NULL,
  `id_akses` int(11) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `log_user`
--

INSERT INTO `log_user` (`id_log`, `id_user`, `username`, `password`, `id_akses`, `status`) VALUES
(1, 'U001', 'yollanda', '81dc9bdb52d04dc20036dbd8313ed055', 3, 1),
(3, 'U002', 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, 1),
(4, 'U003', 'yusup', '202cb962ac59075b964b07152d234b70', 3, 1),
(5, 'U004', 'linda', '202cb962ac59075b964b07152d234b70', 3, 1),
(6, 'U005', 'tompi', '202cb962ac59075b964b07152d234b70', 3, 1),
(7, 'U006', 'Milea', '202cb962ac59075b964b07152d234b70', 2, 1),
(8, 'U007', 'ahmad', '202cb962ac59075b964b07152d234b70', 3, 1),
(9, 'U008', 'dania', '202cb962ac59075b964b07152d234b70', 2, 1),
(10, 'U009', 'johan', '202cb962ac59075b964b07152d234b70', 2, 1),
(12, 'U011', 'veronica', '202cb962ac59075b964b07152d234b70', 3, 1),
(14, 'U013', 'ubuy', '202cb962ac59075b964b07152d234b70', 3, 1),
(15, 'U014', 'Julaiha', '202cb962ac59075b964b07152d234b70', 2, 1),
(17, 'U015', 'tania', '202cb962ac59075b964b07152d234b70', 2, 1),
(18, 'U016', 'dika', '202cb962ac59075b964b07152d234b70', 2, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `lokasi_rumah`
--

CREATE TABLE `lokasi_rumah` (
  `id_unit` varchar(16) NOT NULL,
  `prov` varchar(11) NOT NULL,
  `kota` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `lokasi_rumah`
--

INSERT INTO `lokasi_rumah` (`id_unit`, `prov`, `kota`) VALUES
('PRH0000012', '31', '3172'),
('PRH0000013', '32', '3201'),
('PRH0000014', '14', '1401'),
('PRH0000015', '32', '3271'),
('PRH0000011', '32', '3273'),
('PRH0000015', '32', '3201');

-- --------------------------------------------------------

--
-- Struktur dari tabel `notif`
--

CREATE TABLE `notif` (
  `id` int(11) NOT NULL,
  `id_user` varchar(11) NOT NULL,
  `user_tujuan` varchar(11) NOT NULL,
  `requerst` text NOT NULL,
  `icon` text NOT NULL,
  `url` varchar(55) NOT NULL,
  `tgl` date NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `notif`
--

INSERT INTO `notif` (`id`, `id_user`, `user_tujuan`, `requerst`, `icon`, `url`, `tgl`, `status`) VALUES
(1, 'U010', 'U008', 'Booking Rumah', 'fa fa-handshake', 'Act/ActBooking', '2020-04-14', 1),
(2, 'U008', 'U010', 'Bookingan dibatalkan', 'fa fa-ban', 'Act/ActBooking', '2020-04-14', 1),
(3, 'U003', 'U010', 'Bookingan dibatalkan', 'fa fa-ban', 'Act/ActBooking', '2020-04-14', 1),
(4, 'U008', 'U010', 'Booking Rumah', 'fa fa-handshake', 'Act/ActBooking', '2020-04-14', 1),
(5, 'U010', 'U008', 'Bookingan dibatalkan', 'fa fa-ban', 'Act/ActBooking', '2020-04-14', 1),
(6, 'U012', '', 'Permintaan Akses Untuk Jual Perumahan', 'fa-bell', 'Dashboard/notification', '2020-04-14', 1),
(7, 'U012', '', 'Permintaan Akses Untuk Jual Perumahan', 'fa-bell', 'Dashboard/notification', '2020-04-14', 1),
(8, 'U012', '', 'Telah mengirim struck pemesanan', 'fa-donate', 'Dashboard/pemesanan', '2020-04-14', 1),
(9, 'U013', '', 'Permintaan Akses Untuk Jual Perumahan', 'fa-bell', 'Dashboard/notification', '2020-04-14', 1),
(10, 'U013', '', 'Telah mengirim struck pemesanan', 'fa-donate', 'Dashboard/pemesanan', '2020-04-14', 1),
(11, 'U002', 'U013', 'Data anda telah dikonfirmasi', 'fa-check-circle', 'Home/profil', '2020-04-14', 1),
(12, 'U010', 'U003', 'Booking Rumah', 'fa fa-handshake', 'Act/ActBooking', '2020-04-15', 1),
(13, 'U014', '', 'Permintaan Akses Untuk Jual Perumahan', 'fa-bell', 'Dashboard/notification', '2020-04-15', 1),
(14, 'U014', '', 'Telah mengirim struck pemesanan', 'fa-donate', 'Dashboard/pemesanan', '2020-04-15', 1),
(15, 'U002', 'U014', 'Pembayaran gagal. silahkan upload kembali struk pembayaran yang terbaru', 'exclamation', 'Home/profil', '2020-04-15', 1),
(16, 'U014', '', 'Telah mengirim struck pemesanan', 'fa-donate', 'Dashboard/pemesanan', '2020-04-15', 1),
(17, 'U002', 'U014', 'Pembayaran gagal. silahkan upload kembali struk pembayaran yang terbaru', 'exclamation', 'Home/profil', '2020-04-15', 1),
(18, 'U014', '', 'Telah mengirim struck pemesanan', 'fa-donate', 'Dashboard/pemesanan', '2020-04-15', 1),
(19, 'U010', 'U008', 'Booking Rumah', 'fa fa-handshake', 'Act/ActBooking', '2020-04-16', 1),
(20, 'U008', 'U010', 'Bookingan dibatalkan', 'fa fa-ban', 'Act/ActBooking', '2020-04-16', 0),
(21, 'U010', 'U008', 'Booking Rumah', 'fa fa-handshake', 'Act/ActBooking', '2020-04-16', 1),
(22, 'U008', 'U004', 'Booking Rumah', 'fa fa-handshake', 'Act/ActBooking', '2020-04-16', 1),
(23, 'U004', 'U003', 'Booking Rumah', 'fa fa-handshake', 'Act/ActBooking', '2020-06-09', 1),
(24, 'U015', 'U008', 'Booking Rumah', 'fa fa-handshake', 'Act/ActBooking', '2020-06-13', 1),
(25, 'U016', '', 'Permintaan Akses Untuk Jual Perumahan', 'fa-bell', 'Dashboard/notification', '2020-07-13', 1),
(26, 'U016', '', 'Telah mengirim struck pemesanan', 'fa-donate', 'Dashboard/pemesanan', '2020-07-13', 1),
(27, 'U002', 'U016', 'Pembayaran gagal. silahkan upload kembali struk pembayaran yang terbaru dan benar', 'exclamation', 'Home/profil', '2020-07-13', 1),
(28, 'U002', 'U014', 'Data anda telah dikonfirmasi', 'fa-check-circle', 'Home/profil', '2020-07-13', 1),
(29, 'U002', 'U014', 'Data anda telah dikonfirmasi', 'fa-check-circle', 'Home/profil', '2020-07-13', 1),
(30, 'U002', 'U014', 'Data anda telah dikonfirmasi', 'fa-check-circle', 'Home/profil', '2020-07-13', 1),
(31, 'U004', '', 'Permintaan Akses Untuk Jual Perumahan', 'fa-bell', 'Dashboard/notification', '2020-07-16', 1),
(32, 'U004', '', 'Telah mengirim struck pemesanan', 'fa-donate', 'Dashboard/pemesanan', '2020-07-16', 1),
(33, 'U002', 'U004', 'Data anda telah dikonfirmasi', 'fa-check-circle', 'Home/profil', '2020-07-16', 1),
(34, 'U004', 'U003', 'Booking Rumah', 'fa fa-handshake', 'Act/ActBooking', '2020-07-23', 1),
(35, 'U003', 'U004', 'Bookingan dibatalkan', 'fa fa-ban', 'Act/ActBooking', '2020-07-23', 1),
(36, 'U008', 'U015', 'Bookingan dibatalkan', 'fa fa-ban', 'Act/ActBooking', '2020-07-23', 1),
(37, 'U016', '', 'Telah mengirim struck pemesanan', 'fa-donate', 'Dashboard/pemesanan', '2020-07-23', 1),
(38, 'U002', 'U016', 'Data anda telah dikonfirmasi', 'fa-check-circle', 'Home/profil', '2020-07-23', 1),
(39, 'U003', 'U004', 'Bookingan dibatalkan', 'fa fa-ban', 'Act/ActBooking', '2020-07-30', 1),
(40, 'U004', 'U008', 'Bookingan dibatalkan', 'fa fa-ban', 'Act/ActBooking', '2020-07-30', 1),
(41, 'U008', 'U003', 'Booking Rumah', 'fa fa-handshake', 'Act/ActBooking', '2020-07-30', 1),
(42, 'U003', 'U008', 'Bookingan dibatalkan', 'fa fa-ban', 'Act/ActBooking', '2020-07-30', 1),
(43, 'U008', 'U003', 'Booking Rumah', 'fa fa-handshake', 'Act/ActBooking', '2020-07-31', 1),
(44, 'U003', 'U008', 'Bookingan dibatalkan', 'fa fa-ban', 'Act/ActBooking', '2020-07-31', 1),
(45, 'U008', 'U003', 'Booking Rumah', 'fa fa-handshake', 'Act/ActBooking', '2020-07-31', 1),
(46, 'U003', 'U008', 'Bookingan dibatalkan', 'fa fa-ban', 'Act/ActBooking', '2020-07-31', 1),
(47, 'U008', 'U003', 'Booking Rumah', 'fa fa-handshake', 'Act/ActBooking', '2020-07-31', 1),
(48, 'U003', 'U008', 'Bookingan dibatalkan', 'fa fa-ban', 'Act/ActBooking', '2020-07-31', 1),
(49, 'U008', 'U003', 'Booking Rumah', 'fa fa-handshake', 'Act/ActBooking', '2020-07-31', 1),
(50, 'U008', 'U003', 'Booking Rumah', 'fa fa-handshake', 'Act/ActBooking', '2020-07-31', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `paket`
--

CREATE TABLE `paket` (
  `id_paket` int(11) NOT NULL,
  `nominal` double NOT NULL,
  `jml` int(11) NOT NULL,
  `keterangan` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `paket`
--

INSERT INTO `paket` (`id_paket`, `nominal`, `jml`, `keterangan`) VALUES
(1, 300000, 3, 'bulan'),
(2, 700000, 7, 'bulan'),
(3, 1000000, 1, 'tahun');

-- --------------------------------------------------------

--
-- Struktur dari tabel `payment`
--

CREATE TABLE `payment` (
  `id_payment` int(11) NOT NULL,
  `id_user` varchar(11) NOT NULL,
  `id_paket` int(11) NOT NULL,
  `tgl` date NOT NULL,
  `pic` varchar(200) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Trigger `payment`
--
DELIMITER $$
CREATE TRIGGER `delete_log` AFTER DELETE ON `payment` FOR EACH ROW insert into histori_transaksi values(old.id_user,old.id_paket,now(),"Transaksi Telah Di Konfirmasi")
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `perum`
--

CREATE TABLE `perum` (
  `id_perum` varchar(11) NOT NULL,
  `id_user` varchar(11) NOT NULL,
  `id_perumahan` varchar(11) NOT NULL,
  `id_claster` varchar(11) NOT NULL,
  `type` varchar(128) NOT NULL,
  `uk_rumah` varchar(55) NOT NULL,
  `harga` double NOT NULL,
  `cicilan` varchar(11) NOT NULL,
  `titik_koordinat` varchar(55) NOT NULL,
  `deskripsi` text NOT NULL,
  `alamat` text NOT NULL,
  `pic` text NOT NULL,
  `kategori` varchar(55) NOT NULL,
  `status` varchar(1) NOT NULL,
  `keterangan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `perum`
--

INSERT INTO `perum` (`id_perum`, `id_user`, `id_perumahan`, `id_claster`, `type`, `uk_rumah`, `harga`, `cicilan`, `titik_koordinat`, `deskripsi`, `alamat`, `pic`, `kategori`, `status`, `keterangan`) VALUES
('PRH0000001', 'U003', 'PRU0000001', 'CL000001', 'Type Perumahan', 'Luas bangunan 36 m² x Luas tanah 90 m²', 79000000, '1800000', '', 'Deskripsi\r\nOver Credit Murah Meriah 79jt Perumahan Citra Indah, Ciputra Cileungsi\r\nOver credit murah meriah 79jt masih original tipe 36/90 perumahan citra indah, timur cibubur, ciputra cileungsi\r\n\r\nOver credit\r\nCicilan 1.8jt per bulan\r\nSisa 12 tahun dari 19 tahun\r\nTidak perlu akad. Cocok untuk anda yang wirausaha, kesulitan KPR karena BI checking, tidak ingin repot mengurus administrasi bank.', 'Jl. Raya cileungsi KM 22, cileungsi jonggol - Bogor\r\nPerumahan citra indah ciputra cileungsi', '1596126145.jpeg', 'perum', '1', 1),
('PRH0000005', 'U003', 'PRU0000001', 'CL000001', 'Type Perumahan', '38 m² x 105 m²', 59000000, '2800000', '', 'Over Credit Rumah Masih Original Tipe Perumahan Citra Indah\r\nOver credit rumah masih original tipe 38/105 perumahan citra indah, timur cibubur, ciputra cileungsi\r\n\r\n\r\nOver credit 59jt\r\nCicilan 2.6jt per bulan\r\nSisa kpr 19 tahun\r\nTidak perlu akad. Cocok untuk anda yang wirausaha, bermasalah di BI checking, tidak ingin repot mengurus administrasi bank.', 'Jl. Raya cileungsi KM 22, cileungsi jonggol - Bogor\r\nPerumahan citra indah ciputra cileungsi', '1596126850.jpg', 'perum', '0', 0),
('PRH0000006', 'U004', 'PRU0000004', 'CL000002', 'Type Unit/210', 'Bangunan 30 m2 x Lahan 72m2', 399000000, '2800000', '', 'Alasan Harus Memiliki Perumahan Grand Mekarsari Residence\r\n\r\n\r\nSyarat pengajuan KPR yang sangat mudah dan cepat.\r\nCicilan Ringan Mulai Rp. 2 Jutaan*\r\nKawasan yang hijau dan asri untuk hunian sekaligus cocok untuk investasi.\r\nLokasi strategis (depan Taman Buah Mekarsari, Water Kingdom, Giant).\r\nAkses mudah (LRT, Exit Tol Cibubur, Exit Tol Cimanggis - Cibitung).\r\nFasilitas lengkap (Club House, Kolam Renang, Food Court).\r\n\r\n\r\nGrand Mekarsari Residence menawarkan 2 tipe hunian cluster, yaitu :\r\n\r\n\r\n\r\nCluster HuckleBerry : Tipe 45/98, dan Tipe 60/98 (2 Lantai)\r\nCluster LimeBerry : Tipe 30/72 (New Type), Tipe 30/60, Tipe 30/72, Tipe 36/72, Tipe 54/72 (2 Lantai)\r\n \r\n\r\nFasilitas yang tersedia dalam perumahan Grand Mekarsari Residence, antara lain :\r\n\r\n \r\n\r\nClub House\r\nKolam Renang\r\n24 Hours Security\r\nJogging Track\r\nChildren Playground\r\nFood & Beverage (on progress)\r\n \r\n\r\nFasilitas di sekitar perumahan Grand Mekarsari Residence, antara lain :\r\n\r\n \r\n\r\nTaman Buah Mekarsari\r\nWater Kingdom\r\nMall dan Giant\r\nRumah Sakit\r\nBus APTB\r\nTrans Studio Cibubur', 'Jalan Raya Jonggol – Cileungsi, Mekarsari,', '1596130180.jpg', 'perum', '0', 0),
('PRH0000007', 'U011', 'PRU0000006', 'CL000003', 'Type chines', '40x30 m', 300000000, '2000000', '', 'Rumah Bertemakan Chines untuk cocok untuk anda wahai orang orang sipit', 'jl kuningan no.12 perumahan sanvertigo claster bodiaola no.2', '4_-Kampung-Naga.jpg', 'perum', '0', 0),
('PRH0000010', 'U003', 'PRU0000001', 'CL000005', 'Type Perumahan', '50m x50 m', 89000000, '2500000', '', 'Dijual rumah milik sendiri di Citra Indah City Bukit Widelia, alasan jual karena mutasi keluar kota. ( PNS)\r\nBoleh NEGO mas? Boleh banget nego aja sampai puas baru rumah dilepas...enak bukan. Oh ya rumah ini punya saya sendiri lho.\r\nIni bagian dari Perumahan Grup Ciputra lho ..keren kan ?\r\nFasilitas komplek:\r\nPOM Bensin ( Di dlm Komplek )\r\nRSUD Cileungsi -/+ 1,5 km\r\nRS Permata Jonggol -/+ 1,5 km\r\nWater Boom di dlm komplek\r\nPasar Segar Citra Indah City\r\nSD SMP SMA Cikal Harapan di komplek\r\nSDN Citra Indah di komplek\r\nFasilitas Rmh:\r\nPAM\r\nTelepon\r\nGarasi\r\nCarport\r\nGarden\r\nBelakang masih ada sisa 6x 10 m\r\n\r\nUdara sekitar segar, terlihat area pegunungan wilayah sekelilingnya jalan komplek lebar bisa buat joging,\r\n\r\nbersepeda, ada taman luas untuk warga dan gazebo', 'Jl. Raya cileungsi KM 22, cileungsi jonggol - Bogor\r\nPerumahan citra indah ciputra cileungsi', '1596127326.jpg', 'perum', '0', 0),
('PRH0000011', 'U004', '', '', 'Rumah Pribadi', ' 250 m2 x 232 m2', 2795000060, ' ', '', 'Luas Tanah: 250 m2\r\nLuas Bangunan: 232 m2\r\nKamar Tidur: 5 + 1\r\nKamar Mandi: 4 + 1\r\nLantai: 2\r\nGarasi: 1 Mobil\r\nCarport: 1 Mobil\r\nHadap: Utara\r\nListrik: 2200 Watt\r\nSumber Air: PAM + air tanah\r\nSHM', 'gegerkalong wetan kota bandung', '1596129765.jpg', 'Rumah', '0', 0),
('PRH0000014', 'U003', 'PRU0000001', 'CL000001', 'Type Perumahan', '38 m² x 105 m²', 59000000, '2800000', '', 'Over Credit Rumah Masih Original Tipe Perumahan Citra Indah Over credit rumah masih original tipe 38/105 perumahan citra indah, timur cibubur, ciputra cileungsi Over credit 59jt Cicilan 2.6jt per bulan Sisa kpr 19 tahun Tidak perlu akad. Cocok untuk anda yang wirausaha, bermasalah di BI checking, tidak ingin repot mengurus administrasi bank.', 'Jl. Raya cileungsi KM 22, cileungsi jonggol - Bogor Perumahan citra indah ciputra cileungsi', '1596127452.jpg', 'perum', '0', 0),
('PRH0000015', 'U008', '', '', 'Rumah Pribadi', 'Luas bangunan 36 m² x Luas tanah 90 m²', 5800000000, '', '', 'DAPATKAN BONUS & PROMONYA SPESIAL DI BULAN INI ,,\r\nRumah murah berkualitas di perumahan villa ciomas indah,,spesial promo cukup 15 jt sudah tanpa biaya apapun lagi ,,,\r\nHarga cuma 360 jt 100% bangunan baru\r\nLt :60\r\nLb : 45\r\nAir : PAM\r\nListrik : 900 watt\r\nKamar tidur 2\r\nKamar mandi 1\r\nCarport 1\r\nDapur\r\nRuang makan\r\nRuang tamu\r\nTeras\r\nYukk buruan booking sebelum sold ,,lokasi sangat strategis ,,,\r\n', 'Villa Ciomas Indah Jl. Raya Ciomas  Ciomas', '1596176552.jpg', 'Rumah', '0', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `perumahan`
--

CREATE TABLE `perumahan` (
  `id_perumahan` varchar(11) NOT NULL,
  `id_user` varchar(11) NOT NULL,
  `nm_perumahan` varchar(120) NOT NULL,
  `titik_coridinat` text NOT NULL,
  `id_prov` int(11) NOT NULL,
  `id_kota` int(11) NOT NULL,
  `alamat_lengkap` text NOT NULL,
  `pic` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `perumahan`
--

INSERT INTO `perumahan` (`id_perumahan`, `id_user`, `nm_perumahan`, `titik_coridinat`, `id_prov`, `id_kota`, `alamat_lengkap`, `pic`) VALUES
('PRU0000001', 'U003', 'Citra Indah City', 'https://goo.gl/maps/fUZ5ypTnZCHskhmd7', 32, 3201, 'Jl. Transyogi cileungsi-jonggol, no.10', '1596125888.jpg'),
('PRU0000003', 'U005', 'Gria Marselina', '', 32, 3271, 'jl. raya alternatif jonggol- cianjur, kp. jemblung, desa jemblung kecamatan cariu', 'LP3i-College-1.jpg'),
('PRU0000004', 'U004', 'Grand Mekarsari', 'https://goo.gl/maps/5V8wsEMebMPNtkv1A', 32, 3271, 'Jalan Raya Jonggol – Cileungsi, Mekarsari,', '1596127906.jpg'),
('PRU0000005', 'U007', 'indah sentosa', '', 32, 3271, 'jl. Asia Bogor no.12', 'dsc05579.jpg'),
('PRU0000006', 'U011', 'sanvertigo', '', 32, 3212, 'jl. kuuningan no.12 kec. sidomulyo kab. kuningan\r\n', 'default.png'),
('PRU0000008', 'U013', 'Yogyakarta Permai', '', 34, 3404, 'jl. merdeka no.31, desa mengguwoharjo kecamatan sutejo , DIY yogyakarta', 'default.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` varchar(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `notel` varchar(16) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pic` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nama`, `alamat`, `notel`, `email`, `pic`) VALUES
('U001', 'Yolannda saputri', 'jl. soekarno hata jakarta pusat', '08990382938', 'yola@gmail.com', 'default.png'),
('U002', 'admin', '', '', '', 'default.png'),
('U003', 'yusup', 'jl. selawangi jakarta pusat', '628784657464', 'yusup.ferdiansyah08@gmail.com', '1586959022.png'),
('U004', 'Linda Wati', 'kp.pasir kalong desa. pasirkalong, kecamatan tanjungsari', '6289234829343', 'lindabee@gmail.com', '1591679996.jpg'),
('U005', 'tompi', 'jl. sultan yusup ferdiansyah no 1', '08782783728', 'tompy@gmial.com', 'default.png'),
('U006', 'Milea sumardini', 'kp. nyengcle desa selawangi kecamatan tanjungsari kabupaten bogor', '08782783728', 'mile@gmail.com', 'default.png'),
('U007', 'Ahmad Heryawan', 'jl. diponerogo jakarta barat', '0879378378', 'aher@gmail.com', 'default.png'),
('U008', 'dania alianda', 'jl.suta soma semarang barat', '628938948384', 'dania@gmail.com', '1594875701.jpg'),
('U009', 'Johan Santoso', 'jl. ahmasa sih', '6289811223333', 'jo@gmail.com', 'default.png'),
('U011', 'veronica', 'jl. apa aja', '08984983848', 'veronica@gmail.com', 'default.png'),
('U013', 'ubuy sitompuel', 'jl mangga besar surabaya', '6289747837483', 'ubuy@gmail.com', 'default.png'),
('U014', 'Julaiha Sri Wulandari', 'jl. setiabudi raya pekalongan\r\n', '6289234829348', 'jujul@gmail.com', 'default.png'),
('U015', 'Tania sumarni', 'jl. legok jambue\r\n', '6289234829334', 'tania@gmail.cpm', '1586958663.png'),
('U016', 'dika', 'jl sutasoma malang', '62824515454', 'dka@gmail.com', '1594622534.png');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `akses`
--
ALTER TABLE `akses`
  ADD PRIMARY KEY (`id_akses`);

--
-- Indeks untuk tabel `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id_booking`),
  ADD KEY `id_rumah` (`id`),
  ADD KEY `user` (`user`),
  ADD KEY `id` (`id`);

--
-- Indeks untuk tabel `claster`
--
ALTER TABLE `claster`
  ADD PRIMARY KEY (`id_claster`),
  ADD KEY `id_perumahan` (`id_perumahan`);

--
-- Indeks untuk tabel `contract`
--
ALTER TABLE `contract`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `histori_transaksi`
--
ALTER TABLE `histori_transaksi`
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `history_penjualan`
--
ALTER TABLE `history_penjualan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `log_user`
--
ALTER TABLE `log_user`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_akses` (`id_akses`),
  ADD KEY `id_akses_2` (`id_akses`);

--
-- Indeks untuk tabel `notif`
--
ALTER TABLE `notif`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `paket`
--
ALTER TABLE `paket`
  ADD PRIMARY KEY (`id_paket`);

--
-- Indeks untuk tabel `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id_payment`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_paket` (`id_paket`);

--
-- Indeks untuk tabel `perum`
--
ALTER TABLE `perum`
  ADD PRIMARY KEY (`id_perum`),
  ADD KEY `id_perumahan` (`id_perumahan`,`id_claster`),
  ADD KEY `id_claster` (`id_claster`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `perumahan`
--
ALTER TABLE `perumahan`
  ADD PRIMARY KEY (`id_perumahan`),
  ADD KEY `id_claster` (`id_prov`,`id_kota`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `akses`
--
ALTER TABLE `akses`
  MODIFY `id_akses` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `booking`
--
ALTER TABLE `booking`
  MODIFY `id_booking` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `contract`
--
ALTER TABLE `contract`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `history_penjualan`
--
ALTER TABLE `history_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `log_user`
--
ALTER TABLE `log_user`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `notif`
--
ALTER TABLE `notif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT untuk tabel `paket`
--
ALTER TABLE `paket`
  MODIFY `id_paket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `payment`
--
ALTER TABLE `payment`
  MODIFY `id_payment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`id`) REFERENCES `perum` (`id_perum`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `claster`
--
ALTER TABLE `claster`
  ADD CONSTRAINT `claster_ibfk_1` FOREIGN KEY (`id_perumahan`) REFERENCES `perumahan` (`id_perumahan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `log_user`
--
ALTER TABLE `log_user`
  ADD CONSTRAINT `log_user_ibfk_1` FOREIGN KEY (`id_akses`) REFERENCES `akses` (`id_akses`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `log_user_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payment_ibfk_2` FOREIGN KEY (`id_paket`) REFERENCES `paket` (`id_paket`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `perum`
--
ALTER TABLE `perum`
  ADD CONSTRAINT `perum_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `perumahan`
--
ALTER TABLE `perumahan`
  ADD CONSTRAINT `perumahan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
