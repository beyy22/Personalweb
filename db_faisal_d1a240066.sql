-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Jul 2025 pada 21.34
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_faisal_d1a240066`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_about`
--

CREATE TABLE `tbl_about` (
  `id_about` int(11) NOT NULL,
  `about` text NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telepon` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_about`
--

INSERT INTO `tbl_about` (`id_about`, `about`, `foto`, `email`, `telepon`, `created_at`) VALUES
(1, 'Halo! Nama saya Faisal Mahfuzh Afrizal, seorang mahasiswa yang tertarik di dunia teknologi, khususnya dalam pengembangan aplikasi dan sistem informasi. Saya suka belajar hal-hal baru, terutama yang berkaitan dengan coding, desain web, dan bagaimana teknologi bisa mempermudah kehidupan sehari-hari.\r\n\r\nSaat ini saya sedang fokus mendalami dasar-dasar pemrograman dan pengembangan web, baik di sisi front-end (tampilan) maupun back-end (logika & database). Tujuan saya sederhana: bisa menciptakan solusi digital yang bermanfaat bagi orang banyak.\r\n\r\nDi waktu senggang, saya suka eksplorasi UI/UX design, menulis artikel teknologi, dan kadang-kadang ngoprek proyek iseng buat latihan. Saya percaya bahwa setiap baris kode adalah bagian dari perjalanan menuju karya yang lebih besar.\r\n\r\nTerima kasih sudah mengunjungi website ini — semoga apa yang saya bagikan bisa bermanfaat!', 'profile_68680bb7468c2.jpg', 'faisalafrzll@gmail.com', '0852-2195-2795', '2025-07-04 17:13:27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_artikel`
--

CREATE TABLE `tbl_artikel` (
  `id_artikel` int(11) NOT NULL,
  `nama_artikel` varchar(255) NOT NULL,
  `isi_artikel` text NOT NULL,
  `gambar` varchar(100) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `penulis` varchar(100) DEFAULT NULL,
  `id_kategori` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_artikel`
--

INSERT INTO `tbl_artikel` (`id_artikel`, `nama_artikel`, `isi_artikel`, `gambar`, `tanggal`, `penulis`, `id_kategori`) VALUES
(6, 'Front-End vs Back-End: Apa Bedanya?', 'Dalam dunia web development, ada dua bagian utama: Front-End dan Back-End. Keduanya saling melengkapi, tapi punya fokus kerja yang berbeda.\r\n\r\n🔸 Front-End (Tampilan Depan)\r\nFront-end adalah bagian yang langsung dilihat dan digunakan oleh pengguna. Mulai dari desain website, tombol, warna, hingga interaksi halaman.\r\n\r\nTeknologi yang digunakan:\r\nHTML, CSS, JavaScript, dan framework seperti React atau Vue.\r\n\r\nTugas utama:\r\n\r\nMembuat tampilan yang menarik dan responsif\r\n\r\nMengatur interaksi pengguna (klik, input, dsb.)\r\n\r\n🔸 Back-End (Mesin di Belakang)\r\nBack-end adalah bagian yang tidak terlihat oleh pengguna, tapi menjalankan logika, proses data, dan berhubungan dengan database.\r\n\r\nTeknologi yang digunakan:\r\nNode.js, PHP, Python, Java, serta database seperti MySQL atau MongoDB.\r\n\r\nTugas utama:\r\n\r\nMengelola data, autentikasi, dan server\r\n\r\nMenyediakan API dan menghubungkan ke front-end\r\n\r\nKesimpulan\r\nFront-end = tampilan\r\nBack-end = logika & data\r\nKeduanya harus bekerja sama agar sebuah website bisa berjalan dengan baik.', 'img_6868213d2b4b84.99572497.png', '2025-07-03', NULL, NULL),
(7, 'Logika Pemrograman: Fondasi Utama Sebelum Ngoding', 'Sebelum bisa bikin aplikasi keren, hal paling penting yang harus dipahami adalah logika pemrograman. Logika ini membantu kita menyusun langkah-langkah berpikir secara terstruktur untuk menyelesaikan masalah lewat kode.\r\n\r\nKenapa penting? Karena komputer hanya mengeksekusi instruksi sesuai urutan. Tanpa logika yang benar, hasil program bisa salah meskipun tidak error.\r\n\r\nContoh sederhana:\r\nKalau usia ≥ 17, tampilkan “Dewasa”, kalau tidak, tampilkan “Anak-anak”.\r\nItu logika dasar — bisa ditulis dalam bahasa apapun.\r\n\r\nTips melatih logika:\r\n\r\nBiasakan bikin flowchart atau pseudocode.\r\n\r\nCoba latihan soal di HackerRank atau Codewars.\r\n\r\nJangan langsung ngoding, pahami dulu masalahnya.\r\n\r\nLogika itu fondasi. Kalau sudah kuat, belajar bahasa apapun jadi lebih mudah!', 'img_6868209e8de9a9.94287737.png', '2025-07-02', NULL, NULL),
(12, 'Menjadi Software Engineer: Antara Kode, Logika, dan Solusi', 'Di balik setiap aplikasi yang kita gunakan, dari media sosial hingga layanan perbankan digital, ada sosok yang disebut Software Engineer. Mereka adalah arsitek digital yang merancang, membangun, dan memelihara sistem perangkat lunak agar berjalan dengan baik dan efisien.\r\n\r\nApa Itu Software Engineer?\r\nSoftware Engineer adalah seseorang yang menerapkan prinsip-prinsip rekayasa perangkat lunak untuk merancang, mengembangkan, menguji, dan memelihara sistem aplikasi. Mereka bukan hanya menulis kode, tapi juga memahami kebutuhan pengguna dan merancang solusi teknis yang tepat.\r\n\r\nTugas Utama Seorang Software Engineer\r\n\r\nMenganalisis kebutuhan sistem dari klien atau pengguna.\r\n\r\nMerancang struktur program atau sistem.\r\n\r\nMengembangkan aplikasi berbasis web, mobile, maupun desktop.\r\n\r\nMelakukan pengujian (testing) dan perbaikan (debugging).\r\n\r\nBerkolaborasi dengan tim lain seperti UI/UX, QA, dan project manager.\r\n\r\nSkill yang Dibutuhkan\r\nUntuk menjadi Software Engineer yang andal, seseorang harus menguasai:\r\n\r\nBahasa pemrograman seperti JavaScript, Python, Java, atau C++.\r\n\r\nPemahaman algoritma dan struktur data.\r\n\r\nKonsep OOP (Object-Oriented Programming).\r\n\r\nTools seperti Git, database (SQL/NoSQL), serta framework sesuai kebutuhan proyek.\r\n\r\nMengapa Profesi Ini Penting?\r\nSoftware Engineer memegang peran krusial dalam transformasi digital. Mereka menciptakan solusi digital yang memudahkan hidup manusia, mengotomatisasi pekerjaan, dan meningkatkan efisiensi berbagai sektor — mulai dari kesehatan, pendidikan, hingga bisnis.\r\n\r\nKesimpulan\r\nMenjadi Software Engineer bukan hanya soal menulis baris-baris kode, tetapi bagaimana memecahkan masalah menggunakan logika dan kreativitas. Di era digital ini, peran mereka semakin dibutuhkan dan dihargai. Jika kamu suka tantangan, berpikir logis, dan ingin menciptakan sesuatu yang berguna untuk banyak orang, maka profesi ini patut kamu pertimbangkan.\r\n\r\n', 'img_68681f3abcee81.82764676.png', '2025-07-03', NULL, NULL),
(26, 'Apa Itu Sistem Informasi dan Mengapa Penting di Era Digital?', 'Sistem informasi bukan cuma soal komputer, tapi bagaimana data diolah menjadi informasi yang bermanfaat. Di era digital, hampir semua hal — dari belanja online hingga layanan pemerintah — bergantung pada sistem informasi. Dalam artikel ini, saya akan menjelaskan secara sederhana bagaimana sistem ini bekerja dan mengapa kita semua perlu mengenalnya, bahkan meskipun bukan dari jurusan IT.', 'img_68681e5ca5d4e7.82981099.png', '2025-07-04', NULL, NULL),
(27, 'Apa Itu Web Apps dan Kenapa Banyak Digunakan?', 'Web App atau Web Application adalah aplikasi yang diakses melalui browser tanpa harus diunduh dulu. Contohnya seperti Google Docs, Instagram Web, atau e-commerce favorit kamu.\r\n\r\n🔍 Ciri-Ciri Web App:\r\nDiakses lewat browser (Chrome, Firefox, Safari)\r\n\r\nTidak perlu install (cukup buka link)\r\n\r\nBisa diakses dari berbagai perangkat\r\n\r\nBiasanya terhubung ke internet dan database\r\n\r\n🤔 Apa Bedanya dengan Website Biasa?\r\nWebsite cenderung statis, isinya hanya informasi.\r\n\r\nWeb App lebih interaktif: pengguna bisa login, mengisi form, mengedit data, dsb.\r\n\r\n🧠 Teknologi di Baliknya:\r\nFront-end: HTML, CSS, JavaScript, React, Vue\r\n\r\nBack-end: Node.js, Laravel, Django, database\r\n\r\nAPI: untuk komunikasi antara front-end dan back-end\r\n\r\n🚀 Keuntungan Web App:\r\nMudah diakses kapan saja\r\n\r\nBisa update otomatis tanpa install ulang\r\n\r\nCocok untuk bisnis digital dan layanan publik', 'img_686821d4ddf181.10267531.png', '2025-07-04', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_gallery`
--

CREATE TABLE `tbl_gallery` (
  `id_gallery` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_gallery`
--

INSERT INTO `tbl_gallery` (`id_gallery`, `judul`, `foto`) VALUES
(8, 'Portfolio Pertama Saya', 'Screenshot 2025-02-14 175657.png'),
(10, 'MAKRAB 2024-2025', 'IMG_2141.jpg'),
(11, 'MABIM 2024-2025', 'IMG-20240913-WA0027.jpg'),
(12, 'BATIK DAY', 'IMG-20241002-WA0119.jpg'),
(13, 'Cosplay dlu ah', 'WhatsApp Image 2025-06-24 at 15.10.38_de221580.jpg'),
(14, 'JUARA ML!!', 'IMG-20241130-WA0032.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kontak`
--

CREATE TABLE `tbl_kontak` (
  `id_kontak` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `pesan` text DEFAULT NULL,
  `balasan` text DEFAULT NULL,
  `tanggal` datetime DEFAULT current_timestamp(),
  `status` enum('baru','dibaca','dibalas') DEFAULT 'baru'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_kontak`
--

INSERT INTO `tbl_kontak` (`id_kontak`, `nama`, `email`, `pesan`, `balasan`, `tanggal`, `status`) VALUES
(11, 'faisal', 'faisalafrzll@gmail.com', 'cek cek cek', 'ter cek cek', '2025-07-03 09:36:42', 'dibalas'),
(12, 'faisal', 'faisalma968@gmail.com', 'hai hai hai\r\n', 'iya say hi', '2025-07-03 09:39:40', 'dibalas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` enum('admin','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `username`, `password`, `level`) VALUES
(2, 'faisal', 'f4668288fdbf9773dd9779d412942905', 'user'),
(3, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
(6, 'sibeyy', '7f8f91cc378947a1451308c8ba83c1d9', 'user');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_about`
--
ALTER TABLE `tbl_about`
  ADD PRIMARY KEY (`id_about`);

--
-- Indeks untuk tabel `tbl_artikel`
--
ALTER TABLE `tbl_artikel`
  ADD PRIMARY KEY (`id_artikel`);

--
-- Indeks untuk tabel `tbl_gallery`
--
ALTER TABLE `tbl_gallery`
  ADD PRIMARY KEY (`id_gallery`);

--
-- Indeks untuk tabel `tbl_kontak`
--
ALTER TABLE `tbl_kontak`
  ADD PRIMARY KEY (`id_kontak`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_about`
--
ALTER TABLE `tbl_about`
  MODIFY `id_about` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_artikel`
--
ALTER TABLE `tbl_artikel`
  MODIFY `id_artikel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `tbl_gallery`
--
ALTER TABLE `tbl_gallery`
  MODIFY `id_gallery` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `tbl_kontak`
--
ALTER TABLE `tbl_kontak`
  MODIFY `id_kontak` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
