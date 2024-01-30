-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Jan 2024 pada 08.58
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `easyparkir`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `k_keluar`
--

CREATE TABLE `k_keluar` (
  `plat_no` varchar(12) DEFAULT NULL,
  `waktu_masuk` datetime DEFAULT NULL,
  `waktu_keluar` datetime DEFAULT NULL,
  `merk` char(1) DEFAULT NULL,
  `ket` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `k_masuk`
--

CREATE TABLE `k_masuk` (
  `plat_no` varchar(12) NOT NULL,
  `waktu_masuk` datetime DEFAULT NULL,
  `merk` char(1) NOT NULL,
  `ket` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `k_masuk`
--

INSERT INTO `k_masuk` (`plat_no`, `waktu_masuk`, `merk`, `ket`) VALUES
('e 1231 pap', '2024-01-30 14:47:32', '2', '65b8a9a4aeaf9.jpg'),
('E 1234 PAK', '2024-01-30 14:46:04', '1', '65b8a9493078f.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `username` varchar(16) DEFAULT NULL,
  `password` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`username`, `password`) VALUES
('admin', '$2y$10$2qPCR8ny5nU1FQcyPpvu1eS1eJvw9rjsgeUXjvt6rbjYK3olcchUS');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `k_keluar`
--
ALTER TABLE `k_keluar`
  ADD UNIQUE KEY `waktu_masuk` (`waktu_masuk`),
  ADD UNIQUE KEY `waktu_keluar` (`waktu_keluar`),
  ADD KEY `plat_no` (`plat_no`);

--
-- Indeks untuk tabel `k_masuk`
--
ALTER TABLE `k_masuk`
  ADD PRIMARY KEY (`plat_no`),
  ADD UNIQUE KEY `waktu_masuk` (`waktu_masuk`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `k_keluar`
--
ALTER TABLE `k_keluar`
  ADD CONSTRAINT `k_keluar_ibfk_1` FOREIGN KEY (`plat_no`) REFERENCES `k_masuk` (`plat_no`),
  ADD CONSTRAINT `k_keluar_ibfk_2` FOREIGN KEY (`waktu_masuk`) REFERENCES `k_masuk` (`waktu_masuk`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
