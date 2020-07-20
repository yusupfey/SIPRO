-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 17 Jul 2020 pada 13.58
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

--
-- Dumping data untuk tabel `booking`
--

INSERT INTO `booking` (`id_booking`, `user`, `id`, `tgl`) VALUES
(20, 'U008', 'PRH0000006', '2020-04-16'),
(21, 'U004', 'PRH0000001', '2020-06-09'),
(22, 'U015', 'PRH0000003', '2020-06-13');

--
-- Trigger `booking`
--
DELIMITER $$
CREATE TRIGGER `act_boking` AFTER DELETE ON `booking` FOR EACH ROW insert into history_penjualan values('',old.user,old.id,old.tgl,now(),"Terjual")
$$
DELIMITER ;

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
(3, 'U004', '2020-07-16', '2021-02-16');

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
('U004', 2, '2020-07-16', 'Transaksi Telah Di Konfirmasi');

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
(3, 'U011', 'PRH0000005', '2020-04-15', '2020-04-16', 'Terjual'),
(4, 'U015', 'PRH0000002', '2020-04-16', '2020-04-16', 'Terjual');

--
-- Trigger `history_penjualan`
--
DELIMITER $$
CREATE TRIGGER `actperumboking` AFTER INSERT ON `history_penjualan` FOR EACH ROW update perum set perum.keterangan = "1" where perum.id_perum = new.id_perum
$$
DELIMITER ;

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
(7, 'U006', 'Milea', '202cb962ac59075b964b07152d234b70', 2, 0),
(8, 'U007', 'ahmad', '202cb962ac59075b964b07152d234b70', 3, 1),
(9, 'U008', 'dania', '202cb962ac59075b964b07152d234b70', 2, 1),
(10, 'U009', 'johan', '202cb962ac59075b964b07152d234b70', 2, 1),
(12, 'U011', 'veronica', '202cb962ac59075b964b07152d234b70', 3, 1),
(14, 'U013', 'ubuy', '202cb962ac59075b964b07152d234b70', 3, 1),
(15, 'U014', 'Julaiha', '202cb962ac59075b964b07152d234b70', 3, 1),
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
('PRH0000014', '14', '1401');

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
(28, 'U002', 'U014', 'Data anda telah dikonfirmasi', 'fa-check-circle', 'Home/profil', '2020-07-13', 0),
(29, 'U002', 'U014', 'Data anda telah dikonfirmasi', 'fa-check-circle', 'Home/profil', '2020-07-13', 0),
(30, 'U002', 'U014', 'Data anda telah dikonfirmasi', 'fa-check-circle', 'Home/profil', '2020-07-13', 0),
(31, 'U004', '', 'Permintaan Akses Untuk Jual Perumahan', 'fa-bell', 'Dashboard/notification', '2020-07-16', 1),
(32, 'U004', '', 'Telah mengirim struck pemesanan', 'fa-donate', 'Dashboard/pemesanan', '2020-07-16', 1),
(33, 'U002', 'U004', 'Data anda telah dikonfirmasi', 'fa-check-circle', 'Home/profil', '2020-07-16', 1);

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
-- Dumping data untuk tabel `payment`
--

INSERT INTO `payment` (`id_payment`, `id_user`, `id_paket`, `tgl`, `pic`, `status`) VALUES
(5, 'U016', 1, '2020-07-13', '1594622188.png', 0);

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
('PRH0000001', 'U003', 'PRU0000001', 'CL000001', 'Type a', '10 x 20 m', 200000000, '3000000', '', 'Rumah ini memiliki ruangan 10x20m memiliki halaman yang luas, parkiran luas dan memiliki uang yang nyaman', 'citra indah cluster bukit hijau', '1586959561.jpg', 'perum', '1', 0),
('PRH0000002', 'U008', '', '', 'Rumah Pribadi', '40x60 ml', 200000000, '', '', 'Rumah murah meriah berada di samping jalan dekat dari pusat keramaian', 'kp. cisaat desa. ciomas kec.ciomas', 'auto-2583303_1280.jpg', 'Rumah', '1', 1),
('PRH0000003', 'U008', '', '', 'Rumah Pribadi', '50x50 m', 400000000000, '', '', 'Rumah pribadi dekat dengan pusat keramaian, memiliki halaman yang luas dam juga memiliki kolam renang', 'jl. iwayan gusti ngurahray no.12 jakarta timur', '1586959990.JPG', 'Rumah', '1', 0),
('PRH0000004', 'U004', '', '', 'Rumah Pribadi', '50x50 m', 400000000000, '', '', 'Rumah indah memiliki parkiran luas, sejuk dan nyaman, dekat dengan stadion gelora bungkarno', 'Komplek Gelora bungkarno  Senayan, Jakarta pusat', 'pic3.jpg', 'Rumah', '0', 0),
('PRH0000005', 'U003', 'PRU0000001', 'CL000001', 'Type b', '50x50 m', 400000000000, '3000000', '', 'Perumahan Citra indah clauster bukit hijau. memiliki tema rumah pegunungan suasana sejuk. parkiran luas, dan 2 lantai', 'Perumahan Citra Indah Komplek a, Clauster Bukit hijau no.2', 'pic11.jpg', 'perum', '1', 1),
('PRH0000006', 'U004', 'PRU0000004', 'CL000002', 'Type Japaneses', '30x30 ml', 400000000000, '3000000', '', 'Rumah memiliki Rasa negeri sakura jepang', 'jl. minangkabau no.12 Minang city cluster Sakura no.12', 'pic2.jpg', 'perum', '1', 0),
('PRH0000007', 'U011', 'PRU0000006', 'CL000003', 'Type chines', '40x30 m', 300000000, '2000000', '', 'Rumah Bertemakan Chines untuk cocok untuk anda wahai orang orang sipit', 'jl kuningan no.12 perumahan sanvertigo claster bodiaola no.2', '4_-Kampung-Naga.jpg', 'perum', '0', 0),
('PRH0000009', 'U006', 'PRU0000002', 'CL000005', 'Type Japaneses', '30x30 ml', 300000000, '2000000', '', 'asdf', 'asdf', 'default.png', 'perum', '0', 0),
('PRH0000010', 'U003', 'PRU0000001', 'CL000005', 'Type America Latin', '50x50 m', 300000000, '20000001', '', 'Rumah memiliki banyak segalanya yang membuat anda betah', 'Citra indah cluster val verder ', '1586959477.png', 'perum', '0', 0),
('PRH0000011', 'U004', '', '', 'Rumah Pribadi', '50x50 m', 300000000, '2000000', '', 'Rumah dengan cirihas pedesaan diyakini membuat anda betah serius', 'jl. sultan lembang kota bandung', '1586959864.png', 'Rumah', '0', 0),
('PRH0000012', 'U003', '', '', 'Rumah Pribadi', '50x50 m', 300000000, '3000000', '', 'rumah yang sangat keren sekalli dekat dengan tol dengan mall dan dengan taman kota', 'jl. cawang km.42 dibawah tol jagorawi jakarta timur', '1592023973.jpg', 'Rumah', '0', 0),
('PRH0000013', 'U008', '', '', 'Rumah Pribadi', '50x50 m', 300000000, '3000000', '', 'wey ini aku kasi karena kamu telah menjadi penang dari undian sipro', 'jl jawabaran bogor', '1594960665.jpg', 'Rumah', '0', 0);

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
('PRU0000001', 'U003', 'Citra Indah City', 'https://goo.gl/maps/fUZ5ypTnZCHskhmd7', 32, 3201, 'Jl. Transyogi cileungsi-jonggol, no.10', '1586959194.png'),
('PRU0000003', 'U005', 'Gria Marselina', '', 32, 3271, 'jl. raya alternatif jonggol- cianjur, kp. jemblung, desa jemblung kecamatan cariu', 'LP3i-College-1.jpg'),
('PRU0000004', 'U004', 'Grand Mekarsari', 'https://goo.gl/maps/5V8wsEMebMPNtkv1A', 32, 3271, 'jl. trasyogi cileungsi-jonggol', 'istockphoto-817240836-612x612.jpg'),
('PRU0000005', 'U007', 'indah sentosa', '', 32, 3271, 'jl. Asia Bogor no.12', 'dsc05579.jpg'),
('PRU0000006', 'U011', 'sanvertigo', '', 32, 3212, 'jl. kuuningan no.12 kec. sidomulyo kab. kuningan\r\n', 'default.png'),
('PRU0000008', 'U013', 'Yogyakarta Permai', '', 34, 3404, 'jl. merdeka no.31, desa mengguwoharjo kecamatan sutejo , DIY yogyakarta', 'default.png'),
('PRU0000009', 'U014', '', '', 0, 0, '', '1594921712.jpg'),
('PRU0000010', 'U004', '', '', 0, 0, '', 'default.png');

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
  MODIFY `id_booking` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `contract`
--
ALTER TABLE `contract`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `history_penjualan`
--
ALTER TABLE `history_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `log_user`
--
ALTER TABLE `log_user`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `notif`
--
ALTER TABLE `notif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

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
