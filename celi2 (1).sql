-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 14 Jan 2023 pada 08.17
-- Versi server: 5.7.33
-- Versi PHP: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `celi2`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_barang`
--

CREATE TABLE `tbl_barang` (
  `id_barang` varchar(11) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `merk` varchar(100) DEFAULT NULL,
  `lokasi` int(11) NOT NULL,
  `jenis` int(11) NOT NULL,
  `stok_barang` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_barang`
--

INSERT INTO `tbl_barang` (`id_barang`, `nama_barang`, `merk`, `lokasi`, `jenis`, `stok_barang`) VALUES
('1212', 'OLT', 'ZTE', 2, 2, 25),
('6284', 'Fiber Optic', NULL, 1, 1, 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_lokasi`
--

CREATE TABLE `tbl_lokasi` (
  `id_lokasi` int(11) NOT NULL,
  `nama_lokasi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_lokasi`
--

INSERT INTO `tbl_lokasi` (`id_lokasi`, `nama_lokasi`) VALUES
(1, 'RAK 3'),
(2, 'RAK 2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_suply`
--

CREATE TABLE `tbl_suply` (
  `id_suply` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `stok` int(10) NOT NULL,
  `waktu_suply` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_suply`
--

INSERT INTO `tbl_suply` (`id_suply`, `id_barang`, `stok`, `waktu_suply`) VALUES
(1, 6284, 10, '2023-01-14'),
(2, 1, 10, '2023-01-14'),
(3, 6284, 10, '2023-01-14'),
(4, 1212, 100, '2023-01-14');

--
-- Trigger `tbl_suply`
--
DELIMITER $$
CREATE TRIGGER `TG_STOKUPDATE_BELI` AFTER INSERT ON `tbl_suply` FOR EACH ROW BEGIN
 UPDATE tbl_barang SET stok_barang=stok_barang+NEW.stok
 WHERE id_barang=NEW.id_barang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_transaksi`
--

CREATE TABLE `tbl_transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `stok` int(10) NOT NULL,
  `waktu_transaksi` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_transaksi`
--

INSERT INTO `tbl_transaksi` (`id_transaksi`, `id_barang`, `stok`, `waktu_transaksi`) VALUES
(1, 123, 10, '2023-01-14'),
(2, 6284, 5, '2023-01-14'),
(3, 1212, 75, '2023-01-14');

--
-- Trigger `tbl_transaksi`
--
DELIMITER $$
CREATE TRIGGER `TG_STOKUPDATE_JUAL` AFTER INSERT ON `tbl_transaksi` FOR EACH ROW BEGIN
 UPDATE tbl_barang SET stok_barang=stok_barang-NEW.stok
 WHERE id_barang=NEW.id_barang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `jenis_kelamin` varchar(50) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `level` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `nama`, `alamat`, `jenis_kelamin`, `username`, `password`, `level`) VALUES
(1, 'Fajar', 'medan', 'Laki-Laki', 'master', 'eb0a191797624dd3a48fa681d3061212', 2);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_barang`
--
ALTER TABLE `tbl_barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indeks untuk tabel `tbl_lokasi`
--
ALTER TABLE `tbl_lokasi`
  ADD PRIMARY KEY (`id_lokasi`);

--
-- Indeks untuk tabel `tbl_suply`
--
ALTER TABLE `tbl_suply`
  ADD PRIMARY KEY (`id_suply`);

--
-- Indeks untuk tabel `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indeks untuk tabel `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_lokasi`
--
ALTER TABLE `tbl_lokasi`
  MODIFY `id_lokasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbl_suply`
--
ALTER TABLE `tbl_suply`
  MODIFY `id_suply` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
