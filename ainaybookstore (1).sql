-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 10, 2026 at 07:45 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ainaybookstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `email`, `password`) VALUES
(1, 'admin@gmail.com', 'admin@gmail.com', '0192023a7bbd73250516f069df18b500');

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id` int NOT NULL,
  `kategori_id` int DEFAULT NULL,
  `judul` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `penulis` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `penerbit` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `harga` int NOT NULL,
  `stok` int NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `deskripsi` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id`, `kategori_id`, `judul`, `penulis`, `penerbit`, `harga`, `stok`, `gambar`, `deskripsi`) VALUES
(1, 1, 'Laskar Pelangi', 'Andrea Hirata', 'Bentang', 89000, 20, 'laskar.jpg', 'mengangkat kisah nyata tentang perjuangan 10 anak dari keluarga kurang mampu di Pulau Belitung yang bersekolah di SD Muhammadiyah dengan fasilitas sangat terbatas. Nama \"Laskar Pelangi\" diberikan oleh guru mereka karena kegemaran anak-anak tersebut pada keindahan alam'),
(3, 3, 'Matematika SMA', 'Kemendikbud', 'Kemendikbud', 75000, 50, 'mtk.jpg', 'ilmu tentang pola, bilangan, ruang, dan struktur abstrak. Bidang ini menggunakan logika dan penalaran untuk mengkaji besaran, perubahan, serta bentuk.'),
(4, 1, 'Laut Bercerita', 'Leila S. Chudori', 'KPG', 89000, 18, 'laut.jpg', 'Buku ini berkisah tentang kekejaman rezim Orde Baru, penculikan aktivis mahasiswa pada 1998, serta duka mendalam keluarga yang ditinggalkan.'),
(5, 1, 'Bumi', 'Tere Liye', 'Gramedia', 92000, 25, 'bumi.jpg', ' Cerita berpusat pada Raib, seorang remaja berusia 15 tahun yang tampak seperti anak pada umumnya, kecuali satu rahasia besar: ia memiliki kemampuan untuk menghilang hanya dengan menutup wajahnya menggunakan kedua tangan. Petualangannya dimulai ketika ia bertemu dua temannya di sekolah, yakni Seli (yang dapat mengeluarkan petir/energi listrik) dan Ali (anak jenius yang kritis). Ketiganya terseret ke dalam petualangan melintasi dunia paralel, seperti Klan Bulan dan klan lainnya, untuk menghadapi ancaman makhluk dari dimensi lain. Buku ini merupakan pembuka dari serial best-seller Bumi.'),
(6, 1, 'Dilan 1990', 'Pidi Baiq', 'Pastel Books', 85000, 15, 'dilan.jpg', ' Novel ini menceritakan kisah cinta masa SMA antara Milea (siswi pindahan dari Jakarta) dan Dilan (panglima geng motor yang unik di Bandung) berlatar tahun 1990. Cara Dilan mendekati Milea sangat tidak biasa dan jauh dari kesan romantis standar—mulai dari meramal Milea akan menjadi pacarnya, mengirimkan hadiah berupa tebak-tebakan, hingga puisi-puisi sederhana yang ikonik. Di balik kenakalannya sebagai anggota geng motor, Dilan memiliki perhatian dan kepribadian yang membuat Milea luluh dan mengenang masa-masa tersebut sebagai kisah yang sangat manis'),
(7, 1, 'Negeri 5 Menara', 'Ahmad Fuadi', 'Gramedia', 90000, 22, 'negeri5menara.jpg', 'Novel yang diangkat dari kisah nyata ini bercerita tentang Alif Fikri, seorang pemuda asal Minangkabau yang awalnya terpaksa menuruti keinginan ibunya untuk masuk ke sebuah pesantren di Jawa Timur, yaitu Pondok Madani (PM). Di sana, ia bertemu dengan lima santri lain dari berbagai daerah yang kemudian menjadi sahabat karibnya (dikenal sebagai sahibul menara). Di bawah bayang-bayang menara masjid pondok, mereka berenam diikat oleh mantra sakti \"Man Jadda Wajada\" (siapa yang bersungguh-sungguh akan sukses), yang pada akhirnya mengantarkan mereka mewujudkan impian menjelajah benua Eropa, Asia, Afrika, dan Amerika'),
(8, 2, 'Atomic Habits', 'James Clear', 'Penguin', 98000, 20, 'book atomic.jpg', ' Buku ini menjelaskan bagaimana perubahan kecil yang dilakukan secara konsisten dapat menghasilkan dampak yang luar biasa'),
(9, 2, 'Filosofi Teras', 'Henry Manampiring', 'Kompas', 95000, 18, 'book filosofi.jpg', ' Buku ini adalah pengantar filsafat Stoa (Stoicism) Yunani-Romawi kuno yang disesuaikan dengan kehidupan sehari-hari masyarakat modern'),
(10, 3, 'Biologi SMA', 'Kemendikbud', 'Kemendikbud', 76000, 30, 'biologi.jpg', 'Buku ini adalah media pembelajaran akademik untuk siswa sekolah menengah atas.'),
(11, 4, 'Si Kancil', 'Tim BIP', 'BIP', 55000, 35, 'kancil.jpg', 'Buku ini adalah sastra fiksi berupa cerita rakyat atau fabel anak-anak.'),
(12, 4, 'Cerita 25 Nabi', 'Syaamil Kids', 'Syaamil', 68000, 30, '25nabi.jpg', 'Kisah 25 Nabi untuk anak.'),
(13, 4, 'Belajar Huruf & Angka', 'Yudhistira', 'Yudhistira', 50000, 45, 'hurufangka.jpg', 'Belajar huruf dan angka.'),
(14, 5, 'One Piece Vol. 2', 'Eiichiro Oda', 'Elex Media', 60000, 30, 'onepiece2.jpg', 'Setelah berhasil merekrut pendekar pedang Roronoa Zoro, Monkey D. Luffy melanjutkan perjalanannya untuk mencari seorang navigator. Di volume ini, petualangan mereka berlanjut ke Orange Town, di mana Luffy harus berhadapan dengan kelompok bajak laut musuh yang dipimpin oleh kapten sirkus bertubuh aneh, Buggy si Badut. Dalam situasi yang cukup terperangkap dan pelik, Luffy bersama Zoro harus bertarung melawan anak buah Buggy (seperti Mohji dan Cabaji) serta menghadapi serangan meriam bola maut dari Buggy demi menyelamatkan kota dan warga setempat.'),
(15, 5, 'Naruto Vol. 1', 'Masashi Kishimoto', 'Elex Media', 58000, 28, 'naruto.jpg', 'Cerita bermula di Desa Konohagakure (Desa Daun Tersembunyi), memperkenalkan seorang anak laki-laki periang, hiperaktif, dan sering berbuat onar bernama Naruto Uzumaki. Naruto memiliki rahasia besar di dalam tubuhnya, yaitu monster rubah ekor sembilan (Kyuubi) yang disegel sejak ia lahir, yang membuat warga desa menjauhinya. Impian terbesar Naruto adalah menjadi seorang Hokage (pemimpin dan ninja terkuat di desanya) agar ia diakui oleh penduduk. Di volume pertama ini, Naruto berjuang lulus dari Akademi Ninja, mempelajari teknik terlarang Kage Bunshin (teknik bayangan kembar) demi menyelamatkan guru tercandanya, Iruka, dan akhirnya resmi memulai langkah awal perjalanannya sebagai seorang Genin'),
(16, 5, 'Doraemon Vol. 1', 'Fujiko F. Fujio', 'Elex Media', 50000, 35, 'doraemon.jpg', 'Nobita, seorang anak laki-laki pemalas, bodoh dalam pelajaran, dan sering di-bully oleh teman-temannya, Gian dan Suneo.Suatu hari, kehidupan Nobita berubah drastis saat sesosok makhluk biru mirip kucing tanpa telinga bernama Doraemon muncul dari laci mejanya. Doraemon dikirim dari masa depan oleh cicit Nobita, Sewashi, untuk membantu memperbaiki masa depan Nobita yang suram. Di volume ini, berbagai petualangan komikal dimulai lewat alat-alat canggih dari kantong ajaib Doraemon yang sering kali disalahgunakan oleh Nobita hingga menimbulkan kekacauan lucu'),
(17, 5, 'Detective Conan Vol. 1', 'Gosho Aoyama', 'Elex Media', 62000, 19, 'conan.jpg', 'Suatu malam, saat berkunjung ke taman bermain, Shinichi memergoki transaksi mencurigakan dari sebuah sindikat misterius berbusana serba hitam. Akibatnya, ia tertangkap dan dipaksa meminum racun eksperimen baru. Alih-alih tewas, racun tersebut justru mengubah tubuh fisiknya menyusut menjadi anak-anak berusia 7 tahun. Demi menyembunyikan identitas dan memburu sindikat hitam tersebut, ia menyamar dengan nama Conan Edogawa dan tinggal bersama teman masa kecilnya, Ran Mouri, serta ayahnya yang seorang detektif swasta pemalas, Kogoro Mouri.');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int NOT NULL,
  `nama_kategori` varchar(100) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama_kategori`) VALUES
(1, 'Novel'),
(2, 'Bisnis'),
(3, 'Pendidikan'),
(4, 'Anak'),
(5, 'Komik');

-- --------------------------------------------------------

--
-- Table structure for table `pesan`
--

CREATE TABLE `pesan` (
  `id_pesan` int NOT NULL,
  `id_user` int DEFAULT NULL,
  `nama` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `pesan` text COLLATE utf8mb4_general_ci NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pesan`
--

INSERT INTO `pesan` (`id_pesan`, `id_user`, `nama`, `email`, `pesan`, `tanggal`) VALUES
(1, NULL, 'aini', 'nurainihaniazzahra@gmail.com', 'HAI HALO OKE ', '2026-08-20 03:34:28'),
(2, NULL, 'roraa', 'roraoke@gmail.com', 'baguss, buku nya lengkap rekomen bgtt pokokkkknyaaa', '2026-08-20 03:39:40'),
(3, NULL, 'desta', 'destaoke@gmail.com', 'buku nya lengkap', '2026-11-09 12:40:54'),
(4, NULL, 'aini', 'nurainihaniazzahra@gmail.com', 'haloooo', '2026-11-10 06:21:23');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` int NOT NULL,
  `id_user` int NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_general_ci NOT NULL,
  `telepon` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `metode_pembayaran` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `total` int NOT NULL,
  `status` varchar(30) COLLATE utf8mb4_general_ci DEFAULT 'Menunggu',
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `bukti_pembayaran` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id_pesanan`, `id_user`, `nama`, `alamat`, `telepon`, `metode_pembayaran`, `total`, `status`, `tanggal`, `bukti_pembayaran`) VALUES
(22, 2, 'puff', 'jl keamanan', '0864213467890', 'Transfer Bank', 89000, 'Menunggu', '2026-08-09 12:43:50', NULL),
(23, 2, 'farah', 'jl.ciplak', '089876543', 'E-Wallet', 85000, 'Selesai', '2026-08-18 23:53:52', NULL),
(24, 2, 'aini', 'jl.ciplak', '08987654321', 'Transfer Bank', 89000, 'Menunggu', '2026-11-06 06:49:39', 'bukti_1793947779_6aed7883717a7.jpg'),
(25, 2, 'aini', 'jl.tebet', '08987654321', 'COD', 62000, 'Dikirim', '2026-11-09 03:43:51', ''),
(26, 2, 'aini', 'jl.tebet', '08987654321', 'Transfer Bank', 50000, 'Menunggu', '2026-11-10 00:26:42', 'bukti_1794270402_6af264c244388.jpeg'),
(27, 2, 'NURAINI HANNY AZZAHRA', 'jl.tebet', '08987654321', 'Transfer Bank', 60000, 'Menunggu', '2026-11-10 01:30:44', 'bukti_1794274244_6af273c4d2351.jpeg'),
(28, 6, 'putra', 'jl.ciplak', '08987654321', 'Transfer Bank', 89000, 'Menunggu', '2026-11-10 03:02:05', 'bukti_1794279725_6af2892d58d67.jpeg'),
(29, 2, 'aini', 'jl.tebet', '08987654321', 'COD', 50000, 'Menunggu', '2026-11-10 06:28:25', ''),
(30, 2, 'aini', 'jl.tebet', '08987654321', 'E-Wallet', 58000, 'Menunggu', '2026-11-10 07:40:30', 'bukti_1794296430_6af2ca6e97431.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan_detail`
--

CREATE TABLE `pesanan_detail` (
  `id_detail` int NOT NULL,
  `id_pesanan` int NOT NULL,
  `id_buku` int NOT NULL,
  `jumlah` int NOT NULL,
  `harga` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pesanan_detail`
--

INSERT INTO `pesanan_detail` (`id_detail`, `id_pesanan`, `id_buku`, `jumlah`, `harga`) VALUES
(1, 22, 1, 1, 89000),
(2, 23, 6, 1, 85000),
(3, 24, 1, 1, 89000),
(4, 25, 17, 1, 62000),
(5, 26, 16, 1, 50000),
(6, 27, 14, 1, 60000),
(7, 28, 4, 1, 89000),
(8, 29, 16, 1, 50000),
(9, 30, 15, 1, 58000);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `role` enum('admin','user') COLLATE utf8mb4_general_ci DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `password`, `role`) VALUES
(2, 'aini', 'nurainihaniazzahra@gmail.com', '$2y$10$MEKEtNCrlJs1L/hBi4fqreOVPDxu76Vh3m.cthzupeIz0./JI8Zmm', 'user'),
(3, 'dimas', 'dimasrafaaqil.@gmailcom', '$2y$10$2N4saMNuM4NugAXzE.hLbOe6kHfgCWZGmE8trgjYpEh6yW.bLVM5G', 'user'),
(4, 'ajda', 'ajdasyafiq25@gmail.com', '$2y$10$jPXlaLcbYxK0Nlem1JkGXe3zzu01CB0p8wnZBIlcKii.Bwz4nzX9a', 'user'),
(5, 'admin', 'admin@gmail.com', '$2y$10$hFfWJsVclXWt22D.V190suW.RmX8wY4nGnOLOgBJO5aqe0quydooO', 'user'),
(6, 'putra', 'putraoke@gmail.com', '$2y$10$ASIYFm6400PsT.VO9PVXg.U1IiWv1Flrioq9.BGEaYAF4GXDHgJ9y', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_kategori` (`kategori_id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesan`
--
ALTER TABLE `pesan`
  ADD PRIMARY KEY (`id_pesan`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`);

--
-- Indexes for table `pesanan_detail`
--
ALTER TABLE `pesanan_detail`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pesan`
--
ALTER TABLE `pesan`
  MODIFY `id_pesan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_pesanan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `pesanan_detail`
--
ALTER TABLE `pesanan_detail`
  MODIFY `id_detail` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `fk_kategori` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
