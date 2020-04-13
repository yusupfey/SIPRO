-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 13 Apr 2020 pada 08.01
-- Versi Server: 5.6.21
-- PHP Version: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_sipro`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `akses`
--

CREATE TABLE IF NOT EXISTS `akses` (
`id_akses` int(11) NOT NULL,
  `akses` varchar(55) NOT NULL,
  `redirec` varchar(55) NOT NULL,
  `url` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

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

CREATE TABLE IF NOT EXISTS `booking` (
`id_booking` int(11) NOT NULL,
  `user` varchar(11) NOT NULL,
  `id` varchar(11) NOT NULL,
  `tgl` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `booking`
--

INSERT INTO `booking` (`id_booking`, `user`, `id`, `tgl`) VALUES
(4, 'U010', 'PRH0000002', '2020-03-28'),
(6, 'U010', 'PRH0000005', '2020-04-01'),
(7, 'U008', 'PRH0000004', '2020-04-02'),
(8, 'U004', 'PRH0000008', '2020-04-02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cart`
--

CREATE TABLE IF NOT EXISTS `cart` (
  `id_cart` varchar(11) NOT NULL,
  `id_booking` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `claster`
--

CREATE TABLE IF NOT EXISTS `claster` (
  `id_claster` varchar(11) NOT NULL,
  `id_perumahan` varchar(11) NOT NULL,
  `claster` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `claster`
--

INSERT INTO `claster` (`id_claster`, `id_perumahan`, `claster`) VALUES
('CL0000001', 'PRU0000001', 'Bukit Hijau'),
('CL000002', 'PRU0000004', 'Sakura'),
('CL000003', 'PRU0000006', 'Bodiaola'),
('CL000004', 'PRU0000004', 'Samosir');

-- --------------------------------------------------------

--
-- Struktur dari tabel `histori_transaksi`
--

CREATE TABLE IF NOT EXISTS `histori_transaksi` (
  `id_user` varchar(11) NOT NULL,
  `paket` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `histori_transaksi`
--

INSERT INTO `histori_transaksi` (`id_user`, `paket`, `tanggal`, `keterangan`) VALUES
('U001', 1, '2020-03-22', 'Konfirmasi transaksi'),
('U003', 3, '2020-03-22', 'Konfirmasi transaksi'),
('U006', 2, '2020-03-22', 'Konfirmasi transaksi'),
('U005', 1, '2020-03-23', 'Konfirmasi transaksi'),
('U004', 3, '2020-03-24', 'Konfirmasi transaksi'),
('U007', 2, '2020-03-26', 'Konfirmasi transaksi'),
('U011', 2, '2020-04-02', 'Konfirmasi transaksi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kota`
--

CREATE TABLE IF NOT EXISTS `kota` (
`id_kota` int(11) NOT NULL,
  `id_prov` int(11) NOT NULL,
  `kota` varchar(128) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kota`
--

INSERT INTO `kota` (`id_kota`, `id_prov`, `kota`) VALUES
(1, 2, 'Padang'),
(2, 1, 'Bogor'),
(3, 3, 'Diy Yogyakarta'),
(4, 4, 'Ancol');

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_user`
--

CREATE TABLE IF NOT EXISTS `log_user` (
`id_log` int(11) NOT NULL,
  `id_user` varchar(11) NOT NULL,
  `username` varchar(55) NOT NULL,
  `password` varchar(55) NOT NULL,
  `id_akses` int(11) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `log_user`
--

INSERT INTO `log_user` (`id_log`, `id_user`, `username`, `password`, `id_akses`, `status`) VALUES
(1, 'U001', 'yollanda', '81dc9bdb52d04dc20036dbd8313ed055', 3, 1),
(3, 'U002', 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, 1),
(4, 'U003', 'yusup', '202cb962ac59075b964b07152d234b70', 3, 1),
(5, 'U004', 'linda', '202cb962ac59075b964b07152d234b70', 3, 1),
(6, 'U005', 'tompi', '202cb962ac59075b964b07152d234b70', 3, 1),
(7, 'U006', 'Milea', '202cb962ac59075b964b07152d234b70', 3, 1),
(8, 'U007', 'ahmad', '202cb962ac59075b964b07152d234b70', 3, 1),
(9, 'U008', 'dania', '202cb962ac59075b964b07152d234b70', 2, 1),
(10, 'U009', 'johan', '202cb962ac59075b964b07152d234b70', 2, 1),
(11, 'U010', 'dadang', '202cb962ac59075b964b07152d234b70', 2, 1),
(12, 'U011', 'veronica', '202cb962ac59075b964b07152d234b70', 3, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `lokasi`
--

CREATE TABLE IF NOT EXISTS `lokasi` (
`lokasi_id` int(11) NOT NULL,
  `lat` varchar(20) NOT NULL DEFAULT '0',
  `long` varchar(20) NOT NULL DEFAULT '0',
  `alamat` text NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `lokasi`
--

INSERT INTO `lokasi` (`lokasi_id`, `lat`, `long`, `alamat`) VALUES
(1, '-6.917464', '107.619123', 'Bandung'),
(2, '-6.225014', '106.900447', 'Jakarta'),
(3, '-6.402484', '106.794241', 'Depok'),
(1, '-6.917464', '107.619123', 'Bandung'),
(2, '-6.225014', '106.900447', 'Jakarta'),
(3, '-6.402484', '106.794241', 'Depok');

-- --------------------------------------------------------

--
-- Struktur dari tabel `notif`
--

CREATE TABLE IF NOT EXISTS `notif` (
`id` int(11) NOT NULL,
  `id_user` varchar(11) NOT NULL,
  `requerst` text NOT NULL,
  `icon` text NOT NULL,
  `url` varchar(55) NOT NULL,
  `tgl` date NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `notif`
--

INSERT INTO `notif` (`id`, `id_user`, `requerst`, `icon`, `url`, `tgl`, `status`) VALUES
(3, 'U001', 'Permintaan Akses Untuk Jual Perumahan', 'fa-bell', 'Dashboard/notification', '2020-03-19', 1),
(8, 'U003', 'Permintaan Akses Untuk Jual Perumahan', 'fa-bell', 'Dashboard/notification', '2020-03-20', 1),
(11, 'U003', 'Telah mengirim struck pemesanan', 'fa-donate', 'Dashboard/pemesanan', '2020-03-20', 1),
(12, 'U001', 'Telah mengirim struck pemesanan', 'fa-donate', 'Dashboard/pemesanan', '2020-03-21', 1),
(13, 'U005', 'Permintaan Akses Untuk Jual Perumahan', 'fa-bell', 'Dashboard/notification', '2020-03-21', 1),
(14, 'U005', 'Telah mengirim struck pemesanan', 'fa-donate', 'Dashboard/pemesanan', '2020-03-21', 1),
(15, 'U006', 'Permintaan Akses Untuk Jual Perumahan', 'fa-bell', 'Dashboard/notification', '2020-03-22', 1),
(16, 'U006', 'Telah mengirim struck pemesanan', 'fa-donate', 'Dashboard/pemesanan', '2020-03-22', 1),
(17, 'U005', 'Permintaan Akses Untuk Jual Perumahan', 'fa-bell', 'Dashboard/notification', '2020-03-23', 1),
(18, 'U005', 'Telah mengirim struck pemesanan', 'fa-donate', 'Dashboard/pemesanan', '2020-03-23', 1),
(19, 'U004', 'Permintaan Akses Untuk Jual Perumahan', 'fa-bell', 'Dashboard/notification', '2020-03-23', 1),
(20, 'U004', 'Telah mengirim struck pemesanan', 'fa-donate', 'Dashboard/pemesanan', '2020-03-23', 1),
(21, 'U007', 'Permintaan Akses Untuk Jual Perumahan', 'fa-bell', 'Dashboard/notification', '2020-03-26', 1),
(22, 'U007', 'Telah mengirim struck pemesanan', 'fa-donate', 'Dashboard/pemesanan', '2020-03-26', 1),
(23, 'U008', 'Booking Rumah', 'fa fa-handshake', 'Act/ActBooking', '2020-03-28', 0),
(25, 'U003', 'Booking Rumah', 'fa fa-handshake', 'Act/ActBooking', '2020-04-01', 0),
(26, 'U011', 'Permintaan Akses Untuk Jual Perumahan', 'fa-bell', 'Dashboard/notification', '2020-04-02', 1),
(27, 'U011', 'Telah mengirim struck pemesanan', 'fa-donate', 'Dashboard/pemesanan', '2020-04-02', 1),
(28, 'U004', 'Booking Rumah', 'fa fa-handshake', 'Act/ActBooking', '2020-04-02', 0),
(29, 'U010', 'Booking Rumah', 'fa fa-handshake', 'Act/ActBooking', '2020-04-02', 0),
(30, 'U003', 'Bookingan dibatalkan', 'fa fa-ban', 'Act/ActBooking', '2020-04-11', 0),
(31, 'U003', 'Bookingan dibatalkan', 'fa fa-ban', 'Act/ActBooking', '2020-04-11', 0),
(32, 'U003', 'Bookingan dibatalkan', 'fa fa-ban', 'Act/ActBooking', '2020-04-11', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `paket`
--

CREATE TABLE IF NOT EXISTS `paket` (
`id_paket` int(11) NOT NULL,
  `nominal` double NOT NULL,
  `keterangan` varchar(55) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `paket`
--

INSERT INTO `paket` (`id_paket`, `nominal`, `keterangan`) VALUES
(1, 300000, '3 bulan'),
(2, 700000, '7 bulan'),
(3, 1000000, '1 tahun');

-- --------------------------------------------------------

--
-- Struktur dari tabel `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
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
DELIMITER //
CREATE TRIGGER `delete_log` AFTER DELETE ON `payment`
 FOR EACH ROW insert into histori_transaksi values(old.id_user,old.id_paket,now(),"Konfirmasi transaksi")
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pazzle`
--

CREATE TABLE IF NOT EXISTS `pazzle` (
  `id` int(11) DEFAULT NULL,
  `pic` text NOT NULL,
  `urutan` int(11) NOT NULL,
  `position` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `perum`
--

CREATE TABLE IF NOT EXISTS `perum` (
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
  `status` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `perum`
--

INSERT INTO `perum` (`id_perum`, `id_user`, `id_perumahan`, `id_claster`, `type`, `uk_rumah`, `harga`, `cicilan`, `titik_koordinat`, `deskripsi`, `alamat`, `pic`, `kategori`, `status`) VALUES
('PRH0000001', 'U003', 'PRU0000001', 'CL0000001', 'Type a', '10 x 20 m', 200000000, '3000000', '', 'Rumah ini memiliki ruangan 10x20m memiliki halaman yang luas, parkiran luas dan memiliki uang yang nyaman', 'citra indah cluster bukit hijau', 'c08c3d3a07370e57ec4455b137c977ae--induction-heating-tigers.jpg', 'perum', '0'),
('PRH0000002', 'U008', '', '', 'Rumah Pribadi', '40x60 ml', 200000000, '', '', 'Rumah murah meriah berada di samping jalan dekat dari pusat keramaian', 'kp. cisaat desa. ciomas kec.ciomas', 'auto-2583303_1280.jpg', 'Rumah', '1'),
('PRH0000003', 'U008', '', '', 'Rumah Pribadi', '50x50 m', 400000000000, '', '', 'Rumah pribadi dekat dengan pusat keramaian, memiliki halaman yang luas dam juga memiliki kolam renang', 'jl. iwayan gusti ngurahray no.12 jakarta timur', 'th.jpg', 'Rumah', '0'),
('PRH0000004', 'U004', '', '', 'Rumah Pribadi', '50x50 m', 400000000000, '', '', 'Rumah indah memiliki parkiran luas, sejuk dan nyaman, dekat dengan stadion gelora bungkarno', 'Komplek Gelora bungkarno  Senayan, Jakarta pusat', 'pic3.jpg', 'Rumah', '1'),
('PRH0000005', 'U003', 'PRU0000001', 'CL0000001', 'Type b', '50x50 m', 400000000000, '3000000', '', 'Perumahan Citra indah clauster bukit hijau. memiliki tema rumah pegunungan suasana sejuk. parkiran luas, dan 2 lantai', 'Perumahan Citra Indah Komplek a, Clauster Bukit hijau no.2', 'pic11.jpg', 'perum', '1'),
('PRH0000006', 'U004', 'PRU0000004', 'CL000002', 'Type Japaneses', '30x30 ml', 400000000000, '3000000', '', 'Rumah memiliki Rasa negeri sakura jepang', 'jl. minangkabau no.12 Minang city cluster Sakura no.12', 'pic2.jpg', 'perum', '0'),
('PRH0000007', 'U011', 'PRU0000006', 'CL000003', 'Type chines', '40x30 m', 300000000, '2000000', '', 'Rumah Bertemakan Chines untuk cocok untuk anda wahai orang orang sipit', 'jl kuningan no.12 perumahan sanvertigo claster bodiaola no.2', '4_-Kampung-Naga.jpg', 'perum', '0'),
('PRH0000008', 'U010', '', '', 'Rumah Pribadi', '40x30 m', 300000000, '3000000', '', 'Rumah Dekat dengan Gunung galunggung, memiliki 3 kolam ikan dan 1 kolam renang di jual karena butuh uang buat beli rumah yang lebih bagus lagi ', 'jalan raya galunggung Tasikmalaya km/43', 'gunung-galunggung_(1).jpg', 'Rumah', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `perumahan`
--

CREATE TABLE IF NOT EXISTS `perumahan` (
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
('PRU0000001', 'U003', 'Citra Indah City', 'https://goo.gl/maps/fUZ5ypTnZCHskhmd7', 1, 2, 'Jl. Transyogi cileungsi-jonggol, no.10', 'doodle___strawberry_shortcut_by_piccandle-d6q5js5.jpg'),
('PRU0000002', 'U006', '', '', 0, 0, '', 'default.png'),
('PRU0000003', 'U005', 'Gria Marselina', '', 1, 2, 'jl. raya alternatif jonggol- cianjur, kp. jemblung, desa jemblung kecamatan cariu', 'LOGOSIPRO.png'),
('PRU0000004', 'U004', 'Grand Mekarsari', 'https://goo.gl/maps/5V8wsEMebMPNtkv1A', 1, 2, 'jl. trasyogi cileungsi-jonggol', 'default.png'),
('PRU0000005', 'U007', 'indah sentosa', '', 1, 2, 'jl. Asia Bogor no.12', 'default.png'),
('PRU0000006', 'U011', 'sanvertigo', '', 1, 2, 'jl. kuuningan no.12 kec. sidomulyo kab. kuningan\r\n', 'default.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `provinsi`
--

CREATE TABLE IF NOT EXISTS `provinsi` (
`id_prov` int(11) NOT NULL,
  `provinsi` varchar(128) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `provinsi`
--

INSERT INTO `provinsi` (`id_prov`, `provinsi`) VALUES
(1, 'Jawa Barat'),
(2, 'Sumatra Barat'),
(3, 'Jawa Tengah'),
(4, 'DKI Jakarta');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rumah`
--

CREATE TABLE IF NOT EXISTS `rumah` (
  `id_rumah` varchar(11) NOT NULL,
  `id_user` varchar(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `uk_rumah` varchar(55) NOT NULL,
  `harga` double NOT NULL,
  `titik_koordinat` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL,
  `alamat` text NOT NULL,
  `pic` text NOT NULL,
  `status` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `rumah`
--

INSERT INTO `rumah` (`id_rumah`, `id_user`, `type`, `uk_rumah`, `harga`, `titik_koordinat`, `deskripsi`, `alamat`, `pic`, `status`) VALUES
('R001', 'U001', 'Rumah Pribadi', '10 x 20 m', 200000000, '', 'Clauster rosalinda no.5 Memiliki 2 kamar 4 pintu yang cocok untuk keluarga anda', 'kp. cyber crime rt.09/01 kec.Himalaya kab. Wonderwomen', 'default.jpg', 'Belum Diboking');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE IF NOT EXISTS `user` (
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
('U003', 'yusup', 'jl. selawangi jakarta pusat', '123', 'yusup.ferdiansyah08@gmail.com', 'default.png'),
('U004', 'Linda Wati', 'kp.pasir kalong desa. pasirkalong, kecamatan tanjungsari', '08923482934', 'lindabee@gmail.com', 'default.png'),
('U005', 'tompi', 'jl. sultan yusup ferdiansyah no 1', '08782783728', 'tompy@gmial.com', 'default.png'),
('U006', 'Milea sumardini', 'kp. nyengcle desa selawangi kecamatan tanjungsari kabupaten bogor', '08782783728', 'mile@gmail.com', 'default.png'),
('U007', 'Ahmad Heryawan', 'jl. diponerogo jakarta barat', '0879378378', 'aher@gmail.com', ''),
('U008', 'dania alianda', 'jl.suta soma semarang barat', '08938948384', 'dania@gmail.com', ''),
('U009', '', '', '', 'jo@gmail.com', ''),
('U010', 'dadang saputra', 'jalan asiap aprika bandung dong', '08923482934', 'dadang@gmial.com', ''),
('U011', 'veronica', 'jl. apa aja', '08984983848', 'veronica@gmail.com', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akses`
--
ALTER TABLE `akses`
 ADD PRIMARY KEY (`id_akses`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
 ADD PRIMARY KEY (`id_booking`), ADD KEY `id_rumah` (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
 ADD PRIMARY KEY (`id_cart`), ADD KEY `id_booking` (`id_booking`);

--
-- Indexes for table `claster`
--
ALTER TABLE `claster`
 ADD PRIMARY KEY (`id_claster`), ADD KEY `id_perumahan` (`id_perumahan`);

--
-- Indexes for table `kota`
--
ALTER TABLE `kota`
 ADD PRIMARY KEY (`id_kota`), ADD KEY `id_prov` (`id_prov`);

--
-- Indexes for table `log_user`
--
ALTER TABLE `log_user`
 ADD PRIMARY KEY (`id_log`), ADD KEY `id_user` (`id_user`), ADD KEY `id_akses` (`id_akses`), ADD KEY `id_akses_2` (`id_akses`);

--
-- Indexes for table `lokasi`
--
ALTER TABLE `lokasi`
 ADD KEY `lokasi_id` (`lokasi_id`);

--
-- Indexes for table `notif`
--
ALTER TABLE `notif`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paket`
--
ALTER TABLE `paket`
 ADD PRIMARY KEY (`id_paket`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
 ADD PRIMARY KEY (`id_payment`), ADD KEY `id_user` (`id_user`), ADD KEY `id_paket` (`id_paket`);

--
-- Indexes for table `perum`
--
ALTER TABLE `perum`
 ADD PRIMARY KEY (`id_perum`), ADD KEY `id_perumahan` (`id_perumahan`,`id_claster`), ADD KEY `id_claster` (`id_claster`);

--
-- Indexes for table `perumahan`
--
ALTER TABLE `perumahan`
 ADD PRIMARY KEY (`id_perumahan`), ADD KEY `id_claster` (`id_prov`,`id_kota`), ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `provinsi`
--
ALTER TABLE `provinsi`
 ADD PRIMARY KEY (`id_prov`);

--
-- Indexes for table `rumah`
--
ALTER TABLE `rumah`
 ADD PRIMARY KEY (`id_rumah`), ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akses`
--
ALTER TABLE `akses`
MODIFY `id_akses` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
MODIFY `id_booking` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `kota`
--
ALTER TABLE `kota`
MODIFY `id_kota` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `log_user`
--
ALTER TABLE `log_user`
MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `lokasi`
--
ALTER TABLE `lokasi`
MODIFY `lokasi_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `notif`
--
ALTER TABLE `notif`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `paket`
--
ALTER TABLE `paket`
MODIFY `id_paket` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
MODIFY `id_payment` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `provinsi`
--
ALTER TABLE `provinsi`
MODIFY `id_prov` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `claster`
--
ALTER TABLE `claster`
ADD CONSTRAINT `claster_ibfk_1` FOREIGN KEY (`id_perumahan`) REFERENCES `perumahan` (`id_perumahan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kota`
--
ALTER TABLE `kota`
ADD CONSTRAINT `kota_ibfk_1` FOREIGN KEY (`id_prov`) REFERENCES `provinsi` (`id_prov`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Ketidakleluasaan untuk tabel `perumahan`
--
ALTER TABLE `perumahan`
ADD CONSTRAINT `perumahan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `rumah`
--
ALTER TABLE `rumah`
ADD CONSTRAINT `rumah_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
