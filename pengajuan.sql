-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Nov 2019 pada 21.25
-- Versi server: 10.3.16-MariaDB
-- Versi PHP: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sipeg`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengajuan`
--

CREATE TABLE `pengajuan` (
  `NIP_BARU` varchar(30) NOT NULL,
  `NIK` varchar(30) NOT NULL,
  `jenis_kp` enum('Reguler','Fungsional','Struktural') NOT NULL,
  `status_pengajuan` enum('Dalam Proses','Tolak','Terima') NOT NULL,
  `sk_pns` varchar(100) NOT NULL,
  `sk_cpns` varchar(100) NOT NULL,
  `sk_kp_terakhir` varchar(100) NOT NULL,
  `ppk_1thn_terakhir` varchar(100) NOT NULL,
  `sk_pangkat_terakhir` varchar(100) NOT NULL,
  `sk_jabatan_lama` varchar(100) NOT NULL,
  `sk_jabatan_baru` varchar(100) NOT NULL,
  `id_pengajuan` int(11) NOT NULL,
  `copy_pak` varchar(100) NOT NULL,
  `copy_pendidikan_baru` varchar(100) NOT NULL,
  `alasan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengajuan`
--

INSERT INTO `pengajuan` (`NIP_BARU`, `NIK`, `jenis_kp`, `status_pengajuan`, `sk_pns`, `sk_cpns`, `sk_kp_terakhir`, `ppk_1thn_terakhir`, `sk_pangkat_terakhir`, `sk_jabatan_lama`, `sk_jabatan_baru`, `id_pengajuan`, `copy_pak`, `copy_pendidikan_baru`, `alasan`) VALUES
('195808021985052001000', '195808021985052001000', 'Reguler', 'Tolak', '195808021985052001000_sk_pns.pdf', '195808021985052001000_sk_cpns.pdf', '195808021985052001000_sk_kp_terakhir.pdf', '195808021985052001000_ppk_1tahun_terakhir.pdf', '195808021985052001000_sk_pangkat_terakhir.pdf', '', '', 18, '195808021985052001000_copy_PAK.pdf', '195808021985052001000_copy_pendidikan_baru.pdf', 'silahkan lengkapi data'),
('195808021985052001000', '195808021985052001000', 'Fungsional', 'Tolak', '', '', '', '195808021985052001000_ppk_1tahun_terakhir.pdf', '195808021985052001000_sk_pangkat_terakhir.pdf', '', '', 19, '195808021985052001000_copy_PAK.pdf', '195808021985052001000_copy_pendidikan_baru.pdf', 'ya, coba lagi'),
('195808021985052001000', '195808021985052001000', 'Struktural', 'Terima', '195808021985052001000_sk_pns.pdf', '195808021985052001000_sk_cpns.pdf', '195808021985052001000_sk_kp_terakhir.pdf', '195808021985052001000_ppk_1tahun_terakhir.pdf', '195808021985052001000_sk_pangkat_terakhir.pdf', '', '195808021985052001000_sk_jabatan_baru.pdf', 35, '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `pengajuan`
--
ALTER TABLE `pengajuan`
  ADD PRIMARY KEY (`id_pengajuan`,`NIK`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `pengajuan`
--
ALTER TABLE `pengajuan`
  MODIFY `id_pengajuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
