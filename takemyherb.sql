-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2021 at 05:25 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `takemyherb`
--

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id_keranjang` int(11) NOT NULL,
  `tgl` datetime DEFAULT current_timestamp(),
  `id_user` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `keranjang`
--

INSERT INTO `keranjang` (`id_keranjang`, `tgl`, `id_user`, `id_produk`) VALUES
(1, '2021-12-08 11:05:17', 3, 1),
(2, '2021-12-08 11:05:32', 3, 5),
(3, '2021-12-08 11:05:43', 6, 7),
(4, '2021-12-08 11:05:50', 5, 4),
(5, '2021-12-08 11:05:59', 4, 10);

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id_pemesanan` int(11) NOT NULL,
  `tgl_pemesanan` datetime DEFAULT current_timestamp(),
  `id_user` int(11) DEFAULT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `total_harga` int(11) DEFAULT NULL,
  `alamat_pengiriman` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pemesanan`
--

INSERT INTO `pemesanan` (`id_pemesanan`, `tgl_pemesanan`, `id_user`, `id_produk`, `quantity`, `total_harga`, `alamat_pengiriman`) VALUES
(1, '2021-12-08 11:09:35', 3, 1, 2, 30000, 'Jl Melati nO 2'),
(2, '2021-12-08 11:21:53', 6, 7, 2, 30000, 'jln unud '),
(3, '2021-12-08 11:56:19', 5, 21, 2, 60000, 'jl. kevin space'),
(4, '2021-12-08 11:58:30', 4, 22, 2, 50000, 'jl. dewata 90'),
(5, '2021-12-08 11:59:12', 6, 16, 2, 70000, 'jln Mengkudu 289');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(100) DEFAULT NULL,
  `manfaat` varchar(200) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `deskripsi` varchar(500) DEFAULT NULL,
  `tgl_ditambahkan` datetime DEFAULT current_timestamp(),
  `stok` int(11) DEFAULT NULL,
  `foto` char(100) DEFAULT NULL,
  `tipe` enum('Benih','Bibit','Alat','Pupuk') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `manfaat`, `harga`, `deskripsi`, `tgl_ditambahkan`, `stok`, `foto`, `tipe`) VALUES
(1, 'Tanaman Kemangi', 'pencernaan', 15000, 'Mengurangi stres oksidatif. Daun kemangi memiliki senyawa antioksidan yang sangat penting untuk melawan radikal bebas dalam tubuh.\r\nMenjaga kesehatan hati.\r\nMelindungi kulit dari penuaan.\r\nMenurunkan gula darah tinggi.', '2021-08-12 00:00:00', 10, '1 kemangi', 'Benih'),
(2, 'Tanaman Jeruk Nipis', 'antibodi', 10000, 'jeruk nipis berkhasiat untuk menghilangkan sumbatan vital energi, obat batuk, peluruh dahak (mukolitik), peluruh kencing (diuretik) dan keringat, serta membantu proses pencernaan.', '2021-08-13 00:00:00', 10, '2 jeruk nipis', 'Benih'),
(3, 'Tanaman Ketumbar', 'pencernaan', 25000, 'Menurunkan risiko penyakit jantung. ...\r\nMenurunkan gula darah. ...\r\nMeredakan nyeri dan migrain. ...\r\nMembantu melawan infeksi bakteri dan jamur. ...\r\nMengurangi risiko kanker. ...\r\n5 Jenis Herbal dan Rempah yang Ternyata Baik untuk Kesehatan Otak.\r\n6 Rempah-Rempah yang Bisa Jadi Bahan Pengganti Garam.', '2021-08-14 00:00:00', 10, '3 ketumbar', 'Benih'),
(4, 'Tanaman Mint', 'pencernaan, nyeri otot', 15000, 'Daunnya dimanfaatkan untuk Mengatasi Gangguan Pencernaan.\r\nMeredakan Sindrom Iritasi Usus Besar.\r\nMeningkatkan Sistem Kekebalan Tubuh.\r\nMeningkatkan Fungsi Otak.\r\nMenurunkan Berat Badan.', '2021-08-15 00:00:00', 10, '4 mint', 'Benih'),
(5, 'tanaman eucalyptus', 'antioksidan', 20000, 'Meredakan batuk, pilek, dan bronkitis. ...\r\nMeringankan asma dan sinusitis. ...\r\nMengurangi nyeri sendi. ...\r\nMengatasi bau mulut dan mengurangi plak gigi. ...\r\nMeredakan sakit kepala. ...\r\n6. Menjaga kesehatan rambut dan kulit kepala.', '2021-08-16 00:00:00', 10, '5 bibit eucalyptus', 'Benih'),
(6, 'Tanaman temu kunci', 'pencernaan', 10000, 'Meredakan batuk kering. Temu kunci telah dijadikan sebagai obat tradisional untuk meredakan batuk kering. ...\r\nMeningkatkan kualitas sperma. ...\r\nMenangkal radikal bebas. ...\r\nMencegah kanker payudara. ...\r\nMenjaga kesehatan pencernaan. ...\r\n6. Berpotensi mencegah dan menyembuhkan COVID-19.', '2021-08-17 00:00:00', 10, '6 temukunci', 'Benih'),
(7, 'Tanaman jahe', 'pernafasan', 15000, 'Memperlancar Pernafasan\r\nObat Masuk Angin\r\nMeredakan Migrain\r\nObat Batuk\r\nObat Kecantikan', '2021-08-18 00:00:00', 10, '7 jahe', 'Benih'),
(8, 'Tanaman jintan', 'peradangan', 12000, 'Mengobati Peradangan\r\nMenjaga Kadar Gula dalam Darah\r\nObat Kolesterol\r\nObat Hipertensi atau Darah Tinggi\r\nMencegah Kanker\r\nMenjaga Kesehatan Hati', '2021-08-19 00:00:00', 10, '8 jintan', 'Benih'),
(9, 'Tanaman kapulaga', 'pencernaan, pernafasan', 17000, 'Menurunkan Berat Badan\r\nMengatasi Kejang Usus\r\nMengobati Sakit Perut\r\nObat Batuk\r\nObat Bronkitis\r\nObat pada Saluran Urinase', '2021-08-20 00:00:00', 10, '9 kapulaga', 'Benih'),
(10, 'Tanaman lidah buaya', 'kulit', 18000, 'Mempercepat Penyembuhan Luka\r\nMelembabkan Kulit\r\nMeredakan Batuk\r\nMengobati Sembelit\r\nMenurunkan Tekanan Darah Tinggi\r\nMenurunkan Asam Lambung', '2021-08-21 00:00:00', 10, '10 lidah buaya', 'Benih'),
(11, 'Tanaman kunyit', 'antibodi, pencernaan', 15000, 'Meningkatkan Imunitas Tubuh\r\nMencegah dan Mengobati Kanker\r\nMemperlancar Pencernaan\r\nObat Alzheimer\r\nMengobati Diabetes\r\nMerawat Sistem Pernapasan', '2021-08-22 00:00:00', 10, '11 kunyit', 'Benih'),
(12, 'Tanaman kencur', 'pernafasan', 15000, 'Meredakan Flu dan Batuk\r\nMemperlancar Saluran Pernafasan\r\nMencegah Kanker\r\nMengobati Kencing Batu\r\nMengobati Diare\r\nMeningkatan Nafsu Makan', '2021-08-23 00:00:00', 10, '12 kencur', 'Benih'),
(13, 'Tanaman lengkuas', 'pernafasan', 10000, 'Mencegah Kanker\r\nMenurunkan Kolesterol\r\nMengobati Gangguan Pernapasan\r\nMeredakan Nyeri Sendi\r\nMeningkatkan Kesuburan bagi Laki-laki', '2021-08-24 00:00:00', 10, '13 lengkuas', 'Benih'),
(14, 'Tanaman Kayu manis', 'pencernaan, pernafasan', 20000, 'Pereda Diare\r\nPereda Flu\r\nPereda Darah Tinggi\r\nObat Bronkitis', '2021-08-25 00:00:00', 10, '14 kayu manis', 'Benih'),
(15, 'Tanaman temulawak', 'pencernaan', 15000, 'Meningkatkan Fungsi Pencernaan\r\nPencegah Kanker\r\nMencegah Peradangan', '2021-08-26 00:00:00', 10, '15 temulawak', 'Benih'),
(16, 'Tanaman Mengkudu', 'Pencernaan', 35000, 'Pencegah Radang Usus dan Lambung\r\nMembunuh Bakteri Jahat\r\nMelancarkan peredaran darah', '2021-08-27 00:00:00', 10, '16 mengkudu', 'Benih'),
(17, 'Tanaman Seledri', 'pencernaan, pernafasan', 15000, 'Obat Rematik\r\nObat Asma\r\nMemperlancar Pencernaan\r\nMenurunkan Tekanan Darah', '2021-08-28 00:00:00', 10, '17 seledri', 'Bibit'),
(18, 'Tanaman Lemon', 'antibodi', 50000, 'Vitamin C\r\nVitamin B\r\nMencegah Kanker\r\nImunitas', '2021-08-29 00:00:00', 10, '18 lemon', 'Bibit'),
(19, 'Tanaman sereh', 'antioksidan', 20000, 'Detoks\r\nAntioksidan', '2021-08-30 00:00:00', 10, '19 sereh', 'Bibit'),
(20, 'Tanaman Manggis', 'Antibodi', 75000, 'Meningkatkan Kekebalan Tubuh\r\nMencegah Kanker', '2021-08-31 00:00:00', 10, '20 manggis', 'Bibit'),
(21, 'Tanaman Mahkota Dewa', 'Tekanan darah tinggi', 30000, 'Semuanya berperan dalam mencegah berbagai penyakit seperti tekanan darah tinggi hingga penyakit jantung.', '2021-09-01 00:00:00', 10, '21 mahkota dewa', 'Bibit'),
(22, 'Tanaman Kumis Kucing', 'pernafasan', 25000, 'Membantu masalah pernapasan. ...\r\nMenurunkan kadar gula dalam darah. ...\r\nMenurunkan tekanan darah. ...\r\nMengobati infeksi saluran kemih dan batu ginjal. ...\r\nAntiinflamasi. ...\r\n6. Detoks. ...\r\n7. Meningkatkan daya ingat.', '2021-09-02 00:00:00', 10, '22 kumis kucing', 'Bibit'),
(23, 'Tanaman Sambiloto', 'kulit', 20000, 'Sambiloto berkhasiat sebagai obat demam, obat penyakit kulit, obat kencing manis, obat radang telinga, dan obat masuk angin', '2021-09-03 00:00:00', 10, '23 sambiloto', 'Bibit'),
(24, 'Tanaman kejibeling', 'antioksidan', 30000, 'Kecibeling digunakan sebagai anti diabetes, diuretik, antisipilis, antioksidan, dan antimikroba, dan laksatif. Kecibeling juga diketahui mengandung polifenol, katekin, kafeina, tanin, dan vitamin.', '2021-09-04 00:00:00', 10, '24 kejibeling', 'Bibit'),
(25, 'pupuk kandang kambing organik', 'menyuburkan tanaman.', 13000, '- Dapat di pakai langsung untuk tanaman dengan menggunakan pot.\r\n- (Tapi kalau di pakai langsung 1 karung ini boros dan masih pekat).\r\n- Lebih mantap olahan nya di campur dengan Sekam Bakar dan Cocopeat.', '2021-12-08 12:02:54', 10, '25 pupuk organik', 'Pupuk'),
(26, 'Pupuk / Nutrisi Hidroponik', 'Mengandung unsur hara lengkap baik unsur makro ( N, P, K, Ca, Mg, dan S ) dan unsur mikro ( Fe, Mn, B, Zn, Cu, dan Mo ) bagi tanaman untuk menghasilkan kualitas dan kuantitas produksi yang optimal.\r\nM', 17000, 'Selain untuk hidroponik, pupuk juga dapat digunakan sebagai pupuk kocor pada media tanah dan media lainnya\r\nJenis tanaman : Selada, pakchoi, bayam, kangkung, kubis, sawi, seledri, herba, buncis, kacang panjang, bawang, dll', '2021-12-08 12:05:57', 10, '26 pupuk hidroponik', 'Pupuk'),
(27, 'Pupuk Hayati', 'Mycogrow adalah pupuk hayati yang mengandung spora dan propagul hidup mikoriza yang bersimbiosis mutualisme (saling menguntungkan) dengan perakaran tanaman . Mycogrow responsif pada tanaman kehutanan,', 30000, '- Meningkatkan struktur akar\r\n- Meningkatkan penyerapan unsur hara terutama fosfor, nitrogen, dan unsur mikro.\r\n- Meningkatkan toleransi tanaman terhadap cekaman lingkungan (tanah masam, kekeringan, dan lainya)\r\n- Meningkatkan resistensi tanaman terhadap cekaman phatogen', '2021-12-08 12:09:49', 10, '27 pupuk hayati', 'Pupuk'),
(28, 'SARUNG TANGAN BERLAPIS KARET', 'sarung tangan ini terbuat dari bahan nylon yang di lapisi dengan karet polyurethane di bagian telapak tangan dan jari.', 15000, 'Sarung tangan ini dapat di gunakan di bidang,bangunan,besi,kaca,pertanian,dan bisa di gunakan bagi pengendara motor,dan pesepeda,sarung tangan ini jg bisa lho di pakai babang kurir,krna tdk licin saat memegang handphone', '2021-12-08 12:13:38', 10, '28 sarung tangan', 'Alat'),
(29, 'Sabit Rumput', 'Harga sesuai kualitas,,, mohon kerja samanya untuk mensuport para pengrajin dengan ulasan positif bintang lima...', 20000, 'Bahan baja tipis...\r\nSangat cocok dipakai untuk padi, rumput dll', '2021-12-08 12:15:42', 10, '29 sabit rumput', 'Alat');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `id_review` int(11) NOT NULL,
  `tgl_review` datetime DEFAULT current_timestamp(),
  `id_user` int(11) DEFAULT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `ulasan` varchar(500) DEFAULT NULL,
  `reply` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`id_review`, `tgl_review`, `id_user`, `id_produk`, `ulasan`, `reply`) VALUES
(1, '2021-12-08 11:02:57', 3, 1, 'Sangat bermanfaat bagi tubuh', 'keren banget'),
(2, '2021-12-08 11:04:07', 5, 14, 'nice, sangat berkhasiat membantu meringankan beban hidup', NULL),
(3, '2021-12-08 11:04:41', 3, 9, 'good job dalam memberikan tanaman yang bagus untuk kesehatan kita semua.', NULL),
(5, '2021-12-08 11:59:54', 4, 4, 'tanamannya sangat bagus', 'great'),
(6, '2021-12-08 12:00:33', 6, 4, 'sangat menyegarkan ruangan', 'reply');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(100) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(40) DEFAULT NULL,
  `hp` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `email`, `username`, `password`, `hp`) VALUES
(3, 'ananta', 'anantaw81@gmail.com', 'anantaw81', '202cb962ac59075b964b07152d234b70', '089541096532'),
(4, 'test', 'test@test.com', 'test', '098f6bcd4621d373cade4e832627b4f6', '0895'),
(5, 'kevin', 'kevin@homealone.com', 'kevin', '202cb962ac59075b964b07152d234b70', '123'),
(6, 'basisdata', 'basisdata@gmail.com', 'basisdata', '202cb962ac59075b964b07152d234b70', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_keranjang`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id_pemesanan`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id_review`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id_pemesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `id_review` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD CONSTRAINT `keranjang_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `keranjang_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`);

--
-- Constraints for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD CONSTRAINT `pemesanan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `pemesanan_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
