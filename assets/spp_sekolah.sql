-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2024 at 12:31 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spp_sekolah`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(5) NOT NULL,
  `role` varchar(10) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `namalengkap` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `role`, `username`, `password`, `namalengkap`) VALUES
(1, 'admin', 'admin', 'admin', 'Hari Aspriyono'),
(2, 'admin', 'admin1', 'admin1', 'Agus Susanto'),
(3, 'siswa', 'user', 'user', 'Hari Aspriyono');

-- --------------------------------------------------------

--
-- Stand-in structure for view `detail_siswa`
-- (See below for the actual view)
--
CREATE TABLE `detail_siswa` (
`nis` varchar(20)
,`nama_siswa` varchar(100)
,`kelas_jurusan` varchar(50)
,`tahun_ajaran` varchar(50)
,`biaya` int(12)
);

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` int(11) NOT NULL,
  `kelas_jurusan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `kelas_jurusan`) VALUES
(1, 'Rekayasa Perangkat Lunak'),
(2, 'Teknik Komputer Jaringan'),
(3, 'Teknik Elektro'),
(4, 'Multimedia'),
(5, 'Seni Lukis'),
(6, 'Perhotelan'),
(7, 'Tata Boga'),
(8, 'Design Interior');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` int(11) NOT NULL,
  `nis` varchar(20) NOT NULL,
  `nama_siswa` varchar(100) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `id_tahun_ajaran` int(11) NOT NULL,
  `id_biaya_antrian` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `nis`, `nama_siswa`, `id_kelas`, `id_tahun_ajaran`, `id_biaya_antrian`) VALUES
(1, '1212', 'Helisma', 8, 5, 5),
(2, '1313', 'Putri', 4, 5, NULL),
(3, '1414', 'Kurnia', 6, 5, NULL),
(4, '1515', 'Kadek', 1, 5, NULL),
(5, '1616', 'Komang', 5, 5, NULL),
(6, '1717', 'Wayan', 7, 5, NULL),
(7, '1818', 'Ketut', 3, 5, NULL),
(8, '1919', 'Nyoman', 2, 5, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `spp`
--

CREATE TABLE `spp` (
  `id` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `jatuh_tempo` date DEFAULT curdate(),
  `tgl_bayar` date DEFAULT curdate(),
  `jumlah` int(20) NOT NULL,
  `ket` varchar(50) DEFAULT NULL,
  `id_admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tahun_ajaran`
--

CREATE TABLE `tahun_ajaran` (
  `id` int(11) NOT NULL,
  `tahun_ajaran` varchar(50) NOT NULL,
  `biaya` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tahun_ajaran`
--

INSERT INTO `tahun_ajaran` (`id`, `tahun_ajaran`, `biaya`) VALUES
(1, '2019/2020', 450000),
(2, '2020/2021', 500000),
(3, '2021/2022', 500000),
(4, '2022/2023', 500000),
(5, '2023/2024', 500000),
(6, '2024/2025', 500000);

-- --------------------------------------------------------

--
-- Structure for view `detail_siswa`
--
DROP TABLE IF EXISTS `detail_siswa`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `detail_siswa`  AS SELECT `siswa`.`nis` AS `nis`, `siswa`.`nama_siswa` AS `nama_siswa`, `kelas`.`kelas_jurusan` AS `kelas_jurusan`, `tahun_ajaran`.`tahun_ajaran` AS `tahun_ajaran`, `tahun_ajaran`.`biaya` AS `biaya` FROM ((`siswa` join `kelas` on(`siswa`.`id_kelas` = `kelas`.`id`)) join `tahun_ajaran` on(`siswa`.`id_tahun_ajaran` = `tahun_ajaran`.`id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`),
  ADD KEY `id_kelas` (`id_kelas`),
  ADD KEY `id_tahun_ajaran` (`id_tahun_ajaran`),
  ADD KEY `fk_biaya_antrian` (`id_biaya_antrian`);

--
-- Indexes for table `spp`
--
ALTER TABLE `spp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_siswa` (`id_siswa`),
  ADD KEY `id_admin` (`id_admin`);

--
-- Indexes for table `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `spp`
--
ALTER TABLE `spp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `fk_biaya_antrian` FOREIGN KEY (`id_biaya_antrian`) REFERENCES `tahun_ajaran` (`id`),
  ADD CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id`),
  ADD CONSTRAINT `siswa_ibfk_2` FOREIGN KEY (`id_tahun_ajaran`) REFERENCES `tahun_ajaran` (`id`);

--
-- Constraints for table `spp`
--
ALTER TABLE `spp`
  ADD CONSTRAINT `spp_ibfk_1` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`),
  ADD CONSTRAINT `spp_ibfk_2` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
