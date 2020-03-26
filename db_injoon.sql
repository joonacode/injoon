-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 26, 2020 at 12:39 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_injoon`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_best_seller`
--

CREATE TABLE `tb_best_seller` (
  `bs_id` int(11) NOT NULL,
  `masakan_id` int(11) NOT NULL,
  `jumlah_jual` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_best_seller`
--

INSERT INTO `tb_best_seller` (`bs_id`, `masakan_id`, `jumlah_jual`) VALUES
(1, 1, 0),
(2, 2, 0),
(3, 3, 0),
(4, 4, 2),
(5, 5, 2),
(6, 6, 14),
(7, 7, 0),
(8, 16, 2),
(9, 19, 0),
(10, 20, 9),
(11, 21, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_detail_order`
--

CREATE TABLE `tb_detail_order` (
  `dorder_id` int(11) NOT NULL,
  `check_available` int(11) NOT NULL,
  `order_id` varchar(50) NOT NULL,
  `masakan_id` int(11) NOT NULL,
  `dorder_keterangan` text DEFAULT NULL,
  `dorder_jumlah` int(11) NOT NULL,
  `dorder_hartot` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `dorder_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_detail_order`
--

INSERT INTO `tb_detail_order` (`dorder_id`, `check_available`, `order_id`, `masakan_id`, `dorder_keterangan`, `dorder_jumlah`, `dorder_hartot`, `user_id`, `dorder_status`) VALUES
(79, 1, 'ORD0001', 20, '', 2, 30000, 15, 1),
(80, 2, 'ORD0002', 20, '', 5, 75000, 15, 1),
(81, 2, 'ORD0002', 16, '', 2, 4000, 15, 1),
(82, 2, 'ORD0002', 21, '', 1, 42500, 15, 1),
(83, 2, 'ORD0002', 6, '', 10, 180000, 15, 1),
(84, 2, 'ORD0002', 5, '', 2, 10000, 15, 1),
(85, 3, 'ORD0003', 20, '', 1, 15000, 15, 1),
(88, 4, 'ORD0004', 6, 'Jangan pake sambel', 2, 18000, 15, 1),
(89, 4, 'ORD0004', 4, 'Awkwkwk', 1, 20000, 15, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori`
--

CREATE TABLE `tb_kategori` (
  `kategori_id` int(11) NOT NULL,
  `kategori_nama` longtext CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kategori`
--

INSERT INTO `tb_kategori` (`kategori_id`, `kategori_nama`) VALUES
(1, 'Makanan'),
(2, 'Minuman'),
(3, 'Desert');

-- --------------------------------------------------------

--
-- Table structure for table `tb_masakan`
--

CREATE TABLE `tb_masakan` (
  `masakan_id` int(11) NOT NULL,
  `masakan_nama` varchar(100) NOT NULL,
  `masakan_ds` int(11) NOT NULL,
  `masakan_hsd` int(11) NOT NULL,
  `masakan_diskon` int(11) NOT NULL,
  `masakan_harga` int(11) NOT NULL,
  `masakan_deskripsi` text DEFAULT NULL,
  `kategori_id` int(11) NOT NULL,
  `masakan_gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_masakan`
--

INSERT INTO `tb_masakan` (`masakan_id`, `masakan_nama`, `masakan_ds`, `masakan_hsd`, `masakan_diskon`, `masakan_harga`, `masakan_deskripsi`, `kategori_id`, `masakan_gambar`) VALUES
(1, 'Ice Banana', 0, 100000, 0, 100000, 'asdasd', 3, 'default.png'),
(2, 'Puding', 0, 15000, 0, 15000, '-', 3, 'default.png'),
(3, 'Ice Oreo', 0, 5000, 0, 5000, '-', 3, 'default.png'),
(4, 'Jus Mangga', 0, 20000, 0, 20000, '-', 2, '1583589240_InJoon_lily-banse--YHSwy6uqvk-unsplash.jpg'),
(5, 'Jus Alpukat', 0, 5000, 0, 5000, '-', 2, '1582594013_InJoon_thought-catalog-9aOswReDKPo-unsplash.jpg'),
(6, 'Mie Ayam Baso Ceker', 1, 18000, 50, 9000, '-', 1, '1583589220_InJoon_lidye-1Shk_PkNkNw-unsplash.jpg'),
(7, 'Baso Ceker', 0, 15000, 0, 15000, '-', 1, '1582593963_InJoon_dan-gold-4_jhDO54BYg-unsplash.jpg'),
(16, 'Basreng', 0, 2000, 0, 2000, 'asd', 1, '1582593927_InJoon_anna-pelzer-IGfIGP5ONV0-unsplash.jpg'),
(19, 'Cek Data', 1, 50000, 10, 45000, 'asd', 3, 'default.png'),
(20, 'Es Serut', 0, 15000, 0, 15000, 'asdasd', 3, '1583589501_InJoon_image.jpg'),
(21, 'Kecap Bango', 1, 85000, 69, 26350, 'sdfsd', 3, 'default.png');

-- --------------------------------------------------------

--
-- Table structure for table `tb_meja`
--

CREATE TABLE `tb_meja` (
  `meja_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_meja`
--

INSERT INTO `tb_meja` (`meja_id`, `status`) VALUES
(1, 0),
(2, 0),
(3, 0),
(4, 0),
(5, 0),
(6, 0),
(7, 0),
(8, 0),
(9, 0),
(10, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_order`
--

CREATE TABLE `tb_order` (
  `order_id` varchar(50) NOT NULL,
  `order_meja` int(11) NOT NULL,
  `order_tanggal` int(11) NOT NULL,
  `order_nganTanggal` varchar(128) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_keterangan` text DEFAULT NULL,
  `order_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_order`
--

INSERT INTO `tb_order` (`order_id`, `order_meja`, `order_tanggal`, `order_nganTanggal`, `user_id`, `order_keterangan`, `order_status`) VALUES
('ORD0001', 2, 1583585823, '07-03-2020', 15, '', '1'),
('ORD0002', 6, 1583586689, '07-03-2020', 15, '', '1'),
('ORD0003', 2, 1583594954, '07-03-2020', 15, '', '1'),
('ORD0004', 3, 1585221873, '26-03-2020', 15, 'Cepet yak', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengaturan`
--

CREATE TABLE `tb_pengaturan` (
  `pengaturan_id` int(11) NOT NULL,
  `pengaturan_headerWebsite` varchar(128) NOT NULL,
  `pengaturan_deskripsiWebsite` text NOT NULL,
  `pengaturan_tentang` text NOT NULL,
  `pengaturan_footer` varchar(128) NOT NULL,
  `pengaturan_logo` varchar(255) NOT NULL,
  `pengaturan_favicon` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pengaturan`
--

INSERT INTO `tb_pengaturan` (`pengaturan_id`, `pengaturan_headerWebsite`, `pengaturan_deskripsiWebsite`, `pengaturan_tentang`, `pengaturan_footer`, `pengaturan_logo`, `pengaturan_favicon`) VALUES
(1, 'Injoon Restaurant', 'Restaurant kelas atas dengan harga\r\nkelas bawah. Menyediakan berbagai\r\nhidangan local lezat dan menarik.', 'Injoon restaurant didirikan pada tanggal 12 Desember 2012 pukul 12.00. Injoon restaurant didirikan oleh dua orang chef terkenal yaitu iin dan joona. Nama Injoon restaurant diambil dari gabungan nama iin dan joona yang artinya itu restoran iin dan joona. Injoon restaurant telah dikenal oleh masyarakat sebagai restoran dengan tempat mewah tetapi mempunyai harga murah, tidak aneh bila setiap hari dipadati pembeli.', 'Copyright Â© 2020 Injoon Restaurant | Template By JoonaCode', '1583560085_InJoon_logo.png', '1583560085_InJoon_favicon.ico');

-- --------------------------------------------------------

--
-- Table structure for table `tb_role`
--

CREATE TABLE `tb_role` (
  `role_id` int(11) NOT NULL,
  `role_nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_role`
--

INSERT INTO `tb_role` (`role_id`, `role_nama`) VALUES
(1, 'Manager'),
(2, 'Admin'),
(3, 'Waiter'),
(4, 'Kasir'),
(5, 'Pelanggan');

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `transaksi_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `order_id` varchar(50) NOT NULL,
  `transaksi_tanggal` int(11) NOT NULL,
  `transaksi_nganTanggal` varchar(50) NOT NULL,
  `transaksi_hartot` int(11) NOT NULL,
  `transaksi_diskon` int(11) NOT NULL,
  `transaksi_totbar` int(11) NOT NULL,
  `transaksi_uang` int(11) NOT NULL,
  `transaksi_kembalian` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`transaksi_id`, `user_id`, `order_id`, `transaksi_tanggal`, `transaksi_nganTanggal`, `transaksi_hartot`, `transaksi_diskon`, `transaksi_totbar`, `transaksi_uang`, `transaksi_kembalian`) VALUES
(10, 0, 'ORD0001', 1583586631, '07-03-2020', 30000, 0, 30000, 40000, 10000),
(11, 0, 'ORD0002', 1583586800, '07-03-2020', 311500, 10, 280350, 300000, 19650),
(12, 0, 'ORD0003', 1583594980, '07-03-2020', 15000, 0, 15000, 15000, 0),
(13, 21, 'ORD0004', 1585221911, '26-03-2020', 38000, 10, 34200, 50000, 15800);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `user_id` int(11) NOT NULL,
  `user_nama` varchar(100) NOT NULL,
  `user_telp` varchar(50) NOT NULL,
  `user_username` varchar(100) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_alamat` text NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_password_show` varchar(100) NOT NULL,
  `user_join` varchar(50) NOT NULL,
  `user_foto` varchar(255) NOT NULL,
  `role_id` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`user_id`, `user_nama`, `user_telp`, `user_username`, `user_email`, `user_alamat`, `user_password`, `user_password_show`, `user_join`, `user_foto`, `role_id`) VALUES
(15, 'Cep Guna Widodo', '1234', 'cep', 'cep@gmail.com', 'Kp Jelekong RT01/04 Kec Baleendah Kab Bandung', '$2y$10$ZMHIrolBA0rrcH/FSshUs.Kle2wkBzj6/bY.oJ7KbVmb8ejNrFO7.', 'asd', '1582517621', '1583593834_InJoon_IMG_20190928_201230_739.jpg', '2'),
(16, 'Rizal Pratama', '087822402343', 'rizal', 'rial@gmail.com', '', '$2y$10$l35HVvAbiwZ.eoll4Tx3IeD2IbRwwJTmtORVK1pSylSYCGS9EQlK6', 'asd', '1582690436', 'default.png', '4'),
(17, 'Ilham Alvin S', '09238723', 'alvin', 'alvin@gmail.com', '', '$2y$10$nr8kZ61GLwpzPS7s1CfaaOhzl4U74737BzqBVjAtcxDZXwY5iDrgK', 'asd', '1582690463', 'default.png', '3'),
(18, 'Alyssa', '088765654', 'alyssa', 'alyssa@gmail.com', 'Ny Citys', '$2y$10$7UD9TZxOifiNNJVdoPRk9eEgPov3eNTwkWOUXB5Ixka4Bh9MLA6uu', 'asd', '1582896958', '1583595638_InJoon_1583595612_InJoon_default.png', '1'),
(21, 'Budi', '098923', 'budi', 'budi@budi.com', 'asdasd', '$2y$10$nX09shuqYibKKSs6YxuHgOUuBc81amYCUEcvSsmxp/FIoz9kXsMAe', 'asd', '1583595132', '1583595612_InJoon_default.png', '5'),
(22, 'Ayra', '08182240340', 'aira', 'aira@gmail.co', 'asdasd', '$2y$10$9uI9hHTz1n0D.tRt4OishO2HfOlFfpUy3yftPyH.8ZDb1Z0LVpA8.', 'asd', '1585222377', '1585222377_InJoon_1.png', '5');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_best_seller`
--
ALTER TABLE `tb_best_seller`
  ADD PRIMARY KEY (`bs_id`);

--
-- Indexes for table `tb_detail_order`
--
ALTER TABLE `tb_detail_order`
  ADD PRIMARY KEY (`dorder_id`);

--
-- Indexes for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Indexes for table `tb_masakan`
--
ALTER TABLE `tb_masakan`
  ADD PRIMARY KEY (`masakan_id`);

--
-- Indexes for table `tb_meja`
--
ALTER TABLE `tb_meja`
  ADD PRIMARY KEY (`meja_id`);

--
-- Indexes for table `tb_order`
--
ALTER TABLE `tb_order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `tb_pengaturan`
--
ALTER TABLE `tb_pengaturan`
  ADD PRIMARY KEY (`pengaturan_id`);

--
-- Indexes for table `tb_role`
--
ALTER TABLE `tb_role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`transaksi_id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_best_seller`
--
ALTER TABLE `tb_best_seller`
  MODIFY `bs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tb_detail_order`
--
ALTER TABLE `tb_detail_order`
  MODIFY `dorder_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  MODIFY `kategori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tb_masakan`
--
ALTER TABLE `tb_masakan`
  MODIFY `masakan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tb_meja`
--
ALTER TABLE `tb_meja`
  MODIFY `meja_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_pengaturan`
--
ALTER TABLE `tb_pengaturan`
  MODIFY `pengaturan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_role`
--
ALTER TABLE `tb_role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `transaksi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
