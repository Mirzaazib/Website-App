-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 07 Nov 2019 pada 09.49
-- Versi Server: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbahp`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `analisa_alternatif`
--

CREATE TABLE `analisa_alternatif` (
  `alternatif_pertama` varchar(4) NOT NULL,
  `nilai_analisa_alternatif` double NOT NULL,
  `hasil_analisa_alternatif` double NOT NULL,
  `alternatif_kedua` varchar(4) NOT NULL,
  `id_kriteria` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `analisa_alternatif`
--

INSERT INTO `analisa_alternatif` (`alternatif_pertama`, `nilai_analisa_alternatif`, `hasil_analisa_alternatif`, `alternatif_kedua`, `id_kriteria`) VALUES
('A1', 1, 0.57142857142857, 'A1', 'C1'),
('A1', 1, 0.63157894736842, 'A1', 'C2'),
('A1', 1, 0.14285714285714, 'A1', 'C3'),
('A1', 1, 0.54545454545455, 'A1', 'C4'),
('A1', 1, 0.33333333333333, 'A1', 'C5'),
('A1', 4, 0.57142857142857, 'A2', 'C1'),
('A1', 3, 0.66666666666667, 'A2', 'C2'),
('A1', 0.25, 0.14285714285714, 'A2', 'C3'),
('A1', 3, 0.5, 'A2', 'C4'),
('A1', 1, 0.33333333333333, 'A2', 'C5'),
('A1', 2, 0.57142857142857, 'A3', 'C1'),
('A1', 4, 0.57142857142857, 'A3', 'C2'),
('A1', 0.5, 0.14285714285714, 'A3', 'C3'),
('A1', 2, 0.57142857142857, 'A3', 'C4'),
('A1', 1, 0.33333333333333, 'A3', 'C5'),
('A2', 0.25, 0.14285714285714, 'A1', 'C1'),
('A2', 0.33333333333333, 0.21052631578947, 'A1', 'C2'),
('A2', 4, 0.57142857142857, 'A1', 'C3'),
('A2', 0.33333333333333, 0.18181818181818, 'A1', 'C4'),
('A2', 1, 0.33333333333333, 'A1', 'C5'),
('A2', 1, 0.14285714285714, 'A2', 'C1'),
('A2', 1, 0.22222222222222, 'A2', 'C2'),
('A2', 1, 0.57142857142857, 'A2', 'C3'),
('A2', 1, 0.16666666666667, 'A2', 'C4'),
('A2', 1, 0.33333333333333, 'A2', 'C5'),
('A2', 0.5, 0.14285714285714, 'A3', 'C1'),
('A2', 2, 0.28571428571429, 'A3', 'C2'),
('A2', 2, 0.57142857142857, 'A3', 'C3'),
('A2', 0.5, 0.14285714285714, 'A3', 'C4'),
('A2', 1, 0.33333333333333, 'A3', 'C5'),
('A3', 0.5, 0.28571428571429, 'A1', 'C1'),
('A3', 0.25, 0.15789473684211, 'A1', 'C2'),
('A3', 2, 0.28571428571429, 'A1', 'C3'),
('A3', 0.5, 0.27272727272727, 'A1', 'C4'),
('A3', 1, 0.33333333333333, 'A1', 'C5'),
('A3', 2, 0.28571428571429, 'A2', 'C1'),
('A3', 0.5, 0.11111111111111, 'A2', 'C2'),
('A3', 0.5, 0.28571428571429, 'A2', 'C3'),
('A3', 2, 0.33333333333333, 'A2', 'C4'),
('A3', 1, 0.33333333333333, 'A2', 'C5'),
('A3', 1, 0.28571428571429, 'A3', 'C1'),
('A3', 1, 0.14285714285714, 'A3', 'C2'),
('A3', 1, 0.28571428571429, 'A3', 'C3'),
('A3', 1, 0.28571428571429, 'A3', 'C4'),
('A3', 1, 0.33333333333333, 'A3', 'C5');

-- --------------------------------------------------------

--
-- Struktur dari tabel `analisa_kriteria`
--

CREATE TABLE `analisa_kriteria` (
  `kriteria_pertama` varchar(2) NOT NULL,
  `nilai_analisa_kriteria` double NOT NULL,
  `hasil_analisa_kriteria` double NOT NULL,
  `kriteria_kedua` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `analisa_kriteria`
--

INSERT INTO `analisa_kriteria` (`kriteria_pertama`, `nilai_analisa_kriteria`, `hasil_analisa_kriteria`, `kriteria_kedua`) VALUES
('C1', 1, 0.11764705882353, 'C1'),
('C1', 1, 0.10526315789474, 'C2'),
('C1', 1, 0.12765957446809, 'C3'),
('C1', 2, 0.15384615384615, 'C4'),
('C1', 0.2, 0.11111111111111, 'C5'),
('C2', 1, 0.11764705882353, 'C1'),
('C2', 1, 0.10526315789474, 'C2'),
('C2', 0.5, 0.063829787234043, 'C3'),
('C2', 2, 0.15384615384615, 'C4'),
('C2', 0.2, 0.11111111111111, 'C5'),
('C3', 1, 0.11764705882353, 'C1'),
('C3', 2, 0.21052631578947, 'C2'),
('C3', 1, 0.12765957446809, 'C3'),
('C3', 3, 0.23076923076923, 'C4'),
('C3', 0.2, 0.11111111111111, 'C5'),
('C4', 0.5, 0.058823529411765, 'C1'),
('C4', 0.5, 0.052631578947368, 'C2'),
('C4', 0.33333333333333, 0.042553191489361, 'C3'),
('C4', 1, 0.076923076923077, 'C4'),
('C4', 0.2, 0.11111111111111, 'C5'),
('C5', 5, 0.58823529411765, 'C1'),
('C5', 5, 0.52631578947368, 'C2'),
('C5', 5, 0.63829787234043, 'C3'),
('C5', 5, 0.38461538461538, 'C4'),
('C5', 1, 0.55555555555556, 'C5');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_alternatif`
--

CREATE TABLE `data_alternatif` (
  `id_alternatif` varchar(4) NOT NULL,
  `lokasi` varchar(20) NOT NULL,
  `keterangan` text NOT NULL,
  `hasil_akhir` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `data_alternatif`
--

INSERT INTO `data_alternatif` (`id_alternatif`, `lokasi`, `keterangan`, `hasil_akhir`) VALUES
('A1', 'Lokasi A', 'Marakash PUP Bekasi', 0.37830820837926804),
('A2', 'Lokasi B', 'Grand Galaxy City Bekasi', 0.325917301296806),
('A3', 'Lokasi C', 'Duta Harapan Bekasi', 0.295774490323926);

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_kriteria`
--

CREATE TABLE `data_kriteria` (
  `id_kriteria` varchar(3) NOT NULL,
  `nama_kriteria` varchar(20) NOT NULL,
  `jumlah_kriteria` double NOT NULL,
  `bobot_kriteria` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `data_kriteria`
--

INSERT INTO `data_kriteria` (`id_kriteria`, `nama_kriteria`, `jumlah_kriteria`, `bobot_kriteria`) VALUES
('C1', 'Biaya', 8.5, 0.12310541122872398),
('C2', 'Populasi', 9.5, 0.11033945378191459),
('C3', 'Akses', 7.83333333333333, 0.159542658192286),
('C4', 'Kompetitor', 13, 0.06840849757653619),
('C5', 'Perijinan', 1.8, 0.53860397922054);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jumlah_alternatif_kriteria`
--

CREATE TABLE `jumlah_alternatif_kriteria` (
  `id_alternatif` varchar(4) NOT NULL,
  `id_kriteria` varchar(3) NOT NULL,
  `jumlah_alt_kri` double NOT NULL,
  `skor_alt_kri` double NOT NULL,
  `hasil_alt_kri` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jumlah_alternatif_kriteria`
--

INSERT INTO `jumlah_alternatif_kriteria` (`id_alternatif`, `id_kriteria`, `jumlah_alt_kri`, `skor_alt_kri`, `hasil_alt_kri`) VALUES
('A1', 'C1', 1.75, 0.57142857142857, 0.070345949273556),
('A1', 'C2', 1.58333333333333, 0.6232247284878866, 0.068766276124735),
('A1', 'C3', 7, 0.14285714285714, 0.022791808313183),
('A1', 'C4', 1.83333333333333, 0.5389610389610399, 0.036869514927614),
('A1', 'C5', 3, 0.33333333333333, 0.17953465974018),
('A2', 'C1', 7, 0.14285714285714, 0.017586487318389),
('A2', 'C2', 4.5, 0.23948760790866, 0.026424931844179),
('A2', 'C3', 1.75, 0.57142857142857, 0.091167233252735),
('A2', 'C4', 6, 0.16378066378066333, 0.011203989141323),
('A2', 'C5', 3, 0.33333333333333, 0.17953465974018),
('A3', 'C1', 3.5, 0.28571428571429, 0.035172974636779),
('A3', 'C2', 7, 0.13728766360345335, 0.015148245813),
('A3', 'C3', 3.5, 0.28571428571429, 0.045583616626368),
('A3', 'C4', 3.5, 0.29725829725829667, 0.020334993507599),
('A3', 'C5', 3, 0.33333333333333, 0.17953465974018);

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai`
--

CREATE TABLE `nilai` (
  `id_nilai` int(2) NOT NULL,
  `jum_nilai` double NOT NULL,
  `ket_nilai` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `nilai`
--

INSERT INTO `nilai` (`id_nilai`, `jum_nilai`, `ket_nilai`) VALUES
(2, 9, 'Mutlak sangat penting dari'),
(3, 8, 'Mendekati mutlak dari'),
(8, 7, 'Sangat penting dari'),
(9, 6, 'Mendekati sangat penting dari'),
(10, 5, 'Lebih penting dari'),
(11, 4, 'Mendekati lebih penting dari'),
(12, 3, 'Sedikit lebih penting dari'),
(13, 2, 'Mendekati sedikit lebih penting dari'),
(14, 1, 'Sama penting dengan'),
(15, 0.5, '1 bagi mendekati sedikit lebih penting dari'),
(16, 0.3333, '1 bagi sedikit lebih penting dari'),
(17, 0.25, '1 bagi mendekati lebih penting dari'),
(18, 0.2, '1 bagi lebih penting dari'),
(19, 0.1667, '1 bagi mendekati sangat penting dari'),
(20, 0.1428, '1 bagi sangat penting dari'),
(21, 0.125, '1 bagi mendekati mutlak dari'),
(22, 0.1111, '1 bagi mutlak sangat penting dari');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_pengguna` varchar(6) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `role` enum('Admin','Member') NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `foto` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_pengguna`, `nama`, `role`, `username`, `password`, `foto`) VALUES
('USR001', 'mirza azib', 'Admin', 'mirzaazib', '078a1fea1066d3da38b49690c39844d7', 'foto.jpg'),
('USR002', 'budi setyo', 'Member', 'budiaja', '078a1fea1066d3da38b49690c39844d7', ''),
('USR003', 'cobaa', 'Member', 'cobaa', '7e6750a177bdb38d67980de28a884681', ''),
('USR004', 'testing', 'Member', 'testing', 'ae2b1fca515949e5d54fb22b8ed95575', ''),
('USR005', 'asdasdasd', 'Member', 'asdsadasd', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'foto.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `analisa_alternatif`
--
ALTER TABLE `analisa_alternatif`
  ADD PRIMARY KEY (`alternatif_pertama`,`alternatif_kedua`,`id_kriteria`),
  ADD KEY `alternatif_kedua` (`alternatif_kedua`),
  ADD KEY `id_kriteria` (`id_kriteria`);

--
-- Indexes for table `analisa_kriteria`
--
ALTER TABLE `analisa_kriteria`
  ADD PRIMARY KEY (`kriteria_pertama`,`kriteria_kedua`),
  ADD KEY `kriteria_kedua` (`kriteria_kedua`);

--
-- Indexes for table `data_alternatif`
--
ALTER TABLE `data_alternatif`
  ADD PRIMARY KEY (`id_alternatif`);

--
-- Indexes for table `data_kriteria`
--
ALTER TABLE `data_kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `jumlah_alternatif_kriteria`
--
ALTER TABLE `jumlah_alternatif_kriteria`
  ADD PRIMARY KEY (`id_alternatif`,`id_kriteria`),
  ADD KEY `id_kriteria` (`id_kriteria`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id_nilai`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_pengguna`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id_nilai` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `analisa_alternatif`
--
ALTER TABLE `analisa_alternatif`
  ADD CONSTRAINT `analisa_alternatif_ibfk_1` FOREIGN KEY (`alternatif_pertama`) REFERENCES `data_alternatif` (`id_alternatif`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `analisa_alternatif_ibfk_2` FOREIGN KEY (`alternatif_kedua`) REFERENCES `data_alternatif` (`id_alternatif`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `analisa_alternatif_ibfk_3` FOREIGN KEY (`id_kriteria`) REFERENCES `data_kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `analisa_kriteria`
--
ALTER TABLE `analisa_kriteria`
  ADD CONSTRAINT `analisa_kriteria_ibfk_1` FOREIGN KEY (`kriteria_pertama`) REFERENCES `data_kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `analisa_kriteria_ibfk_2` FOREIGN KEY (`kriteria_kedua`) REFERENCES `data_kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `jumlah_alternatif_kriteria`
--
ALTER TABLE `jumlah_alternatif_kriteria`
  ADD CONSTRAINT `jumlah_alternatif_kriteria_ibfk_1` FOREIGN KEY (`id_alternatif`) REFERENCES `data_alternatif` (`id_alternatif`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jumlah_alternatif_kriteria_ibfk_2` FOREIGN KEY (`id_kriteria`) REFERENCES `data_kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
