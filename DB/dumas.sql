-- phpMyAdmin SQL Dump

-- version 5.2.1

-- https://www.phpmyadmin.net/

--

-- Host: 127.0.0.1

-- Generation Time: Sep 15, 2023 at 10:00 AM

-- Server version: 10.4.28-MariaDB

-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

START TRANSACTION;

SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */

;

/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */

;

/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */

;

/*!40101 SET NAMES utf8mb4 */

;

--

-- Database: `dumas`

--

-- --------------------------------------------------------

--

-- Table structure for table `masyarakat`

--

CREATE TABLE
    `masyarakat` (
        `id` int(11) NOT NULL,
        `nik` char(16) NOT NULL,
        `nama` varchar(35) NOT NULL,
        `username` varchar(35) NOT NULL,
        `password` varchar(255) NOT NULL,
        `telp` varchar(13) NOT NULL
    ) ENGINE = InnoDB DEFAULT CHARSET = latin1 COLLATE = latin1_swedish_ci;

--

-- Dumping data for table `masyarakat`

--

INSERT INTO
    `masyarakat` (
        `id`,
        `nik`,
        `nama`,
        `username`,
        `password`,
        `telp`
    )
VALUES (
        3,
        '1111111111111111',
        'Radja Admiral',
        'radja',
        '123',
        '081111111111'
    ), (
        5,
        '2222222222222222',
        'Admiral Radja',
        'admiral',
        '123',
        '082222222222'
    );

-- --------------------------------------------------------

--

-- Table structure for table `pengaduan`

--

CREATE TABLE
    `pengaduan` (
        `id_pengaduan` int(11) NOT NULL,
        `tgl_pengaduan` date NOT NULL DEFAULT current_timestamp(),
        `nik` char(16) NOT NULL,
        `isi_laporan` text NOT NULL,
        `foto` varchar(255) NOT NULL,
        `status` enum('0', '1', '2') CHARACTER SET latin1 COLLATE latin1_swedish_nopad_ci NOT NULL
    ) ENGINE = InnoDB DEFAULT CHARSET = latin1 COLLATE = latin1_swedish_ci;

--

-- Dumping data for table `pengaduan`

--

INSERT INTO
    `pengaduan` (
        `id_pengaduan`,
        `tgl_pengaduan`,
        `nik`,
        `isi_laporan`,
        `foto`,
        `status`
    )
VALUES (
        10,
        '2023-09-15',
        '1111111111111111',
        'OSHI GW CAKEP BGT BJIRRRRR',
        '1694764631_f35acd15e4977f6ade7a.png',
        '1'
    ), (
        11,
        '2023-09-15',
        '1111111111111111',
        'yg ini jga',
        '1694751361_6857c0a2f6ea63bff1ac.png',
        '1'
    );

-- --------------------------------------------------------

--

-- Table structure for table `petugas`

--

CREATE TABLE
    `petugas` (
        `id_petugas` int(11) NOT NULL,
        `nama_petugas` varchar(35) NOT NULL,
        `username` varchar(25) NOT NULL,
        `password` varchar(32) NOT NULL,
        `telp` varchar(13) NOT NULL,
        `level` enum('admin', 'petugas') NOT NULL
    ) ENGINE = InnoDB DEFAULT CHARSET = latin1 COLLATE = latin1_swedish_ci;

--

-- Dumping data for table `petugas`

--

INSERT INTO
    `petugas` (
        `id_petugas`,
        `nama_petugas`,
        `username`,
        `password`,
        `telp`,
        `level`
    )
VALUES (
        1,
        'Admin',
        'admin',
        '123',
        '089999999999',
        'admin'
    ), (
        2,
        'Petugas',
        'petugas',
        '123',
        '082222222222',
        'petugas'
    );

-- --------------------------------------------------------

--

-- Table structure for table `tanggapan`

--

CREATE TABLE
    `tanggapan` (
        `id_tanggapan` int(11) NOT NULL,
        `id_pengaduan` int(11) NOT NULL,
        `tgl_tanggapan` date NOT NULL DEFAULT current_timestamp(),
        `tanggapan` text NOT NULL,
        `id_petugas` int(11) NOT NULL,
        `status` enum('0', '1', '2') NOT NULL
    ) ENGINE = InnoDB DEFAULT CHARSET = latin1 COLLATE = latin1_swedish_ci;

--

-- Dumping data for table `tanggapan`

--

INSERT INTO
    `tanggapan` (
        `id_tanggapan`,
        `id_pengaduan`,
        `tgl_tanggapan`,
        `tanggapan`,
        `id_petugas`,
        `status`
    )
VALUES (
        669,
        10,
        '2023-09-15',
        'bacot',
        1,
        '2'
    ), (
        670,
        11,
        '2023-09-15',
        'haluuu',
        1,
        '2'
    );

--

-- Indexes for dumped tables

--

--

-- Indexes for table `masyarakat`

--

ALTER TABLE `masyarakat`
ADD PRIMARY KEY (`id`),
ADD KEY `nik` (`nik`);

--

-- Indexes for table `pengaduan`

--

ALTER TABLE `pengaduan`
ADD
    PRIMARY KEY (`id_pengaduan`),
ADD KEY `nik` (`nik`);

--

-- Indexes for table `petugas`

--

ALTER TABLE `petugas` ADD PRIMARY KEY (`id_petugas`);

--

-- Indexes for table `tanggapan`

--

ALTER TABLE `tanggapan`
ADD
    PRIMARY KEY (`id_tanggapan`),
ADD
    KEY `id_pengaduan` (`id_pengaduan`),
ADD
    KEY `id_petugas` (`id_petugas`);

--

-- AUTO_INCREMENT for dumped tables

--

--

-- AUTO_INCREMENT for table `masyarakat`

--

ALTER TABLE
    `masyarakat` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 6;

--

-- AUTO_INCREMENT for table `pengaduan`

--

ALTER TABLE
    `pengaduan` MODIFY `id_pengaduan` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 12;

--

-- AUTO_INCREMENT for table `petugas`

--

ALTER TABLE
    `petugas` MODIFY `id_petugas` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 3;

--

-- AUTO_INCREMENT for table `tanggapan`

--

ALTER TABLE
    `tanggapan` MODIFY `id_tanggapan` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 671;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */

;

/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */

;

/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */

;