-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Des 2025 pada 06.40
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
-- Database: `perpustakaan_kel6`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(11) NOT NULL,
  `judul` varchar(50) NOT NULL,
  `penulis` varchar(100) NOT NULL,
  `penerbit` varchar(100) NOT NULL,
  `tahun_terbit` year(4) NOT NULL,
  `cover` varchar(100) NOT NULL,
  `file_pdf` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`id_buku`, `judul`, `penulis`, `penerbit`, `tahun_terbit`, `cover`, `file_pdf`) VALUES
(1, 'Dia Adalah Dilanku Tahun 1990 (Dilan 1990)', 'pidi baiq', 'Pastel Books', '2014', '1763946677_cover.jpg', '1763946677_buku.pdf'),
(2, 'Dia Adalah Dilanku Tahun 1991 (Dilan 1991)', 'pidi baiq', 'Pastel Books', '2015', '1763946592_cover.jpg', '1763946592_buku.pdf'),
(4, 'milea: Suara dari Dilan', 'pidi baiq', 'Pastel books', '2016', '1763956315_cover.jpg', '1763956315_buku.pdf'),
(5, 'Ancika: Dia yang Bersamaku Tahun 1995', 'Pidi Baiq', 'Pastel Books', '2021', '1763946631_cover.jpg', '1763988980_Ancika.pdf'),
(7, 'Malin Kundang: Si Anak Durhaka', 'A.A. Navis', 'Balai Pustaka', '1960', '1763946719_cover.jpg', '1763988946_Malin_Kundang_.pdf'),
(8, 'Dongeng Teladan dari Nusantara', 'Redaksi Pelangi', 'Pelangi Mizan', '2018', '1763946739_cover.jpg', '1763988903_DONGENG_TELADAN.pdf'),
(9, 'Kancil dan Buaya', 'Ririn Astutiningrum', 'Bhuana Ilmu Populer', '2018', '1763984933_Kancil_dan_buaya.jpg', 'kancil_dan_buaya.pdf'),
(10, 'Bandung Lautan Api', 'A. Sobana Hardjasaputra', 'Balai Pustaka', '1995', '1763946776_cover.jpg', '1763988104_Bandung_Lautan_Api.pdf'),
(15, 'Laskar pelangi', 'Andrea Hirata', 'Bentang Pustaka', '2005', '1763985082_laskar_pelangi.jpg', '1613240554837.pdf'),
(16, 'Dark Psychology', 'JAMES WILIAMS', ' James W. Williams', '2019', '1763988851_cover-dark-psychology.jpg', '1763988851_8.__Dark_Psychology.pdf');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` enum('petugas','pengguna') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `email`, `password`, `role`) VALUES
(1, 'fajar', 'fajar@gmail.com', '$2y$10$9P93GGP7M5e6zqHiRp.FJO1q42irilkbR9A3IxUsx9Qb99Mas4KUW', 'pengguna'),
(2, 'rezka', 'rezka@gmail.com', '$2y$10$w/XT6RyaQqNmkl9Gq8BJi.WtMDtcb9lX7anJe920o2/U4u1ujDj2O', 'petugas'),
(3, 'parsha', 'parsha@gmail.com', '$2y$10$I9dpgaHEJoY/kZdpFHmgDesQo.EN.1VyVC8cYdBmI1M82I4yJICgm', 'petugas'),
(4, 'Aqeela', 'aqeela@gmail.com', '$2y$10$ilBHSbakmtr0Fa7G3Xya0eMKGGN6xYZjGQx6gwefQ3KN/PDUdTG82', 'petugas'),
(5, 'reyhan', 'reyhanur@gmail.com', '$2y$10$71MfPQ8enE5bsn86aGCkWOgxhZSpUSbfbl3XYquxl00K/A0KQ23Bm', 'pengguna'),
(6, 'ilman', 'ilman@gmail.com', '$2y$10$GRZSJxoNynsBtTRIpezSRu3zgN2SvhUDseNBQ6KPQgCf9ZxGHePBW', 'pengguna'),
(7, 'rizky', 'rizky@gmail.com', '$2y$10$LblRMgM22geGbzc3h5ldDOoYFRwrYWvH4z0DIfp8DuR0bs2iKMHFi', 'pengguna'),
(8, 'keisha', 'keisha@gmail.com', '$2y$10$guEqXXKaF2s7ACC6z0EBaOTEp.pZQYzRDqz6wU85T22aegHNnQO36', 'pengguna'),
(9, 'siti nur', 'siti@gmail.com', '$2y$10$AtwLBTar6GO/ZlUDWH25VOERnfolLdfEiEnLIXuLLEeJutcQkUrp6', 'pengguna'),
(10, 'Bintang', 'bintang@gmail.com', '$2y$10$/bpV5Yo3CnI3GojZjiKO5.8SnmXVrgV0vhQq1DKBGIlLc2GkQ8RmW', 'pengguna'),
(21, 'qodri', 'qodri@gmail.com', '$2y$10$5oBELlu0FQIxlOAxqEZzNO9dtMeMOefu02lz8oaJM3kOgKaJ22eQK', 'pengguna'),
(22, 'syifa', 'syifa@gmail.com', '$2y$10$2yk0.L3j/QaF/pYxnO7cN.KxfmibnXWeCs.h8x93.Xz9rzEFJawqi', 'petugas'),
(23, 'test', 'test@gmail.com', '$2y$10$C1h8TzeQE3Pw2pnq/aUqrOtJSho3.V.rDshjDQYiMl5GPQ4j5cBiW', 'pengguna'),
(25, 'nazla', 'hehe@gmail.com', '$2y$10$pZxpJlLhZf749QLrdasmo.orPRt4fYpaX1K29pBhj83xGSy5jBw86', 'pengguna'),
(26, 'rizal1', 'rizal@gmail.com', '$2y$10$D7LKBGk1W8tdt9ECD/gBK.KVe1bdcfV/UHY75cnFLP3jfMszOzF/W', 'pengguna'),
(28, 'jarjit singh', 'jarjit@gmail.com', '$2y$10$z9Yt7PgFppd2dFNfvzJv/.plqLkLsAzOXNTS5yzqAHIBMvvVxKvGi', 'pengguna'),
(30, 'galih', 'galih@gmail.com', '$2y$10$VoKw54RpUzYJYbro0e.Iruls02Taa1W5eTolXsxBj/DfklZlqK7Zi', 'pengguna'),
(31, 'tes', 'tes1@gmail.com', '$2y$10$/Z6tEMUCfuDHkirpIVnV1OI3oeZSjZprax7D3./hzOxBc3E0iYvBm', 'petugas');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
