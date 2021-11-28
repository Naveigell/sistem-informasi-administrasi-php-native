-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2021 at 04:06 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbadministrasi`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_mos`
--

CREATE TABLE `tb_mos` (
  `SiteId` bigint(255) UNSIGNED NOT NULL,
  `SiteName` varchar(100) NOT NULL,
  `SiteType` varchar(100) NOT NULL,
  `PicOnSite` varchar(50) NOT NULL,
  `NoTelpPic` varchar(20) NOT NULL,
  `PenanggungJawabVendor` varchar(255) NOT NULL,
  `TocoName` varchar(100) NOT NULL,
  `Sow` varchar(100) NOT NULL,
  `UploadFotoMaterial` varchar(100) NOT NULL,
  `UploadFotoPicOnSite` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pr`
--

CREATE TABLE `tb_pr` (
  `SiteId` bigint(255) UNSIGNED NOT NULL,
  `SiteName` varchar(100) NOT NULL,
  `BandType` varchar(50) NOT NULL,
  `DetailSow` varchar(255) NOT NULL,
  `DetailEQP` varchar(255) NOT NULL,
  `SiteType` varchar(50) NOT NULL,
  `TanggalSubmit` timestamp NOT NULL DEFAULT current_timestamp(),
  `TanggalApproved` timestamp NOT NULL DEFAULT current_timestamp(),
  `UploadFilePR` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_sa`
--

CREATE TABLE `tb_sa` (
  `SiteId` bigint(255) UNSIGNED NOT NULL,
  `SiteName` varchar(100) NOT NULL,
  `BandType` varchar(100) NOT NULL,
  `DetailSow` varchar(255) NOT NULL,
  `SiteConfig` varchar(100) NOT NULL,
  `BTSType` varchar(50) NOT NULL,
  `PONumber` varchar(100) NOT NULL,
  `SiteType` varchar(100) NOT NULL,
  `TanggalSubmit` timestamp NOT NULL DEFAULT current_timestamp(),
  `TanggalApproved` timestamp NOT NULL DEFAULT current_timestamp(),
  `UploadFileSA` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_sir`
--

CREATE TABLE `tb_sir` (
  `SiteId` bigint(255) UNSIGNED NOT NULL,
  `SiteName` varchar(100) NOT NULL,
  `BandType` varchar(100) NOT NULL,
  `DetailSow` varchar(255) NOT NULL,
  `SiteConfig` varchar(100) NOT NULL,
  `BTSType` varchar(50) NOT NULL,
  `PONumber` varchar(100) NOT NULL,
  `SiteType` varchar(100) NOT NULL,
  `TanggalAudit` timestamp NOT NULL DEFAULT current_timestamp(),
  `TanggalSubmit` timestamp NOT NULL DEFAULT current_timestamp(),
  `TanggalApproved` timestamp NOT NULL DEFAULT current_timestamp(),
  `UploadFileSA` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_site_integrasi`
--

CREATE TABLE `tb_site_integrasi` (
  `SiteId` bigint(255) UNSIGNED NOT NULL,
  `SiteName` varchar(100) NOT NULL,
  `Sow` varchar(100) NOT NULL,
  `BandType` varchar(50) NOT NULL,
  `BTSType` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_site_verify`
--

CREATE TABLE `tb_site_verify` (
  `SiteId` bigint(255) UNSIGNED NOT NULL,
  `SiteName` varchar(100) NOT NULL,
  `TocoName` varchar(100) NOT NULL,
  `Sow` varchar(100) NOT NULL,
  `UploadFotoCobmetTerbuka` varchar(255) NOT NULL,
  `ViewAntemna` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `Id` int(100) NOT NULL,
  `Nama` varchar(100) NOT NULL,
  `User` varchar(100) NOT NULL,
  `Pass` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `NoHp` varchar(20) NOT NULL,
  `Level` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`Id`, `Nama`, `User`, `Pass`, `Email`, `NoHp`, `Level`) VALUES
(1, 'TEGUH', 'teguh', 'b59c67bf196a4758191e42f76670ceba', 'TeguhSupriyanto37@gmail.com', '082236861420', 'PM'),
(7, 'Ocoh', 'ocoh', '81dc9bdb52d04dc20036dbd8313ed055', 'pramono.pramono.ext@nokia.com', '11111111', 'PM'),
(10, 'Ocoh', 'ocoh', '81dc9bdb52d04dc20036dbd8313ed055', 'pramono.pramono.ext@nokia.com', '11111111', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_mos`
--
ALTER TABLE `tb_mos`
  ADD PRIMARY KEY (`SiteId`);

--
-- Indexes for table `tb_pr`
--
ALTER TABLE `tb_pr`
  ADD PRIMARY KEY (`SiteId`);

--
-- Indexes for table `tb_sa`
--
ALTER TABLE `tb_sa`
  ADD PRIMARY KEY (`SiteId`);

--
-- Indexes for table `tb_sir`
--
ALTER TABLE `tb_sir`
  ADD PRIMARY KEY (`SiteId`);

--
-- Indexes for table `tb_site_integrasi`
--
ALTER TABLE `tb_site_integrasi`
  ADD PRIMARY KEY (`SiteId`);

--
-- Indexes for table `tb_site_verify`
--
ALTER TABLE `tb_site_verify`
  ADD PRIMARY KEY (`SiteId`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_mos`
--
ALTER TABLE `tb_mos`
  MODIFY `SiteId` bigint(255) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_pr`
--
ALTER TABLE `tb_pr`
  MODIFY `SiteId` bigint(255) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_sa`
--
ALTER TABLE `tb_sa`
  MODIFY `SiteId` bigint(255) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_sir`
--
ALTER TABLE `tb_sir`
  MODIFY `SiteId` bigint(255) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_site_integrasi`
--
ALTER TABLE `tb_site_integrasi`
  MODIFY `SiteId` bigint(255) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_site_verify`
--
ALTER TABLE `tb_site_verify`
  MODIFY `SiteId` bigint(255) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `Id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
