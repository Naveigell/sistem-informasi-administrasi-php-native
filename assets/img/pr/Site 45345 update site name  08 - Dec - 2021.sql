-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2021 at 06:01 AM
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

--
-- Dumping data for table `tb_mos`
--

INSERT INTO `tb_mos` (`SiteId`, `SiteName`, `SiteType`, `PicOnSite`, `NoTelpPic`, `PenanggungJawabVendor`, `TocoName`, `Sow`, `UploadFotoMaterial`, `UploadFotoPicOnSite`) VALUES
(12, 'qwereqwr', 'qwerwqer', 'wqerweqr', 'wqerwre', 'qwerewqr', 'qwereqwr', '324234', '84352904122021022210.png', '49118010220220211204.png');

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

--
-- Dumping data for table `tb_pr`
--

INSERT INTO `tb_pr` (`SiteId`, `SiteName`, `BandType`, `DetailSow`, `DetailEQP`, `SiteType`, `TanggalSubmit`, `TanggalApproved`, `UploadFilePR`) VALUES
(3, 'ASDFKJASDF', 'ALFJDAKSFJ', 'LAKDJSLKAJSF', 'jsakljdf', 'lkfsjklsdf', '2021-12-14 16:00:00', '2021-12-22 16:00:00', '34690304122021061344.docx');

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

--
-- Dumping data for table `tb_sa`
--

INSERT INTO `tb_sa` (`SiteId`, `SiteName`, `BandType`, `DetailSow`, `SiteConfig`, `BTSType`, `PONumber`, `SiteType`, `TanggalSubmit`, `TanggalApproved`, `UploadFileSA`) VALUES
(2, 'update site name ', 'update band type', 'update detail', 'update config', 'update bts', 'update po', 'update site type', '2021-12-02 16:00:00', '2021-12-20 16:00:00', '36664305122021081926.xlsx'),
(3, 'sdafasdf', 'kjashdlkfdsa', 'ljaskdfj', 'COnfigigigii', 'BTSKSJKSJ', 'Popopopopopo', 'dfsgsdfg', '2021-12-06 16:00:00', '2021-12-09 16:00:00', '86516605122021073513.xlsx');

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

--
-- Dumping data for table `tb_sir`
--

INSERT INTO `tb_sir` (`SiteId`, `SiteName`, `BandType`, `DetailSow`, `SiteConfig`, `BTSType`, `PONumber`, `SiteType`, `TanggalAudit`, `TanggalSubmit`, `TanggalApproved`, `UploadFileSA`) VALUES
(2, 'update site name ', 'update band type', 'update detail', 'update config', 'update bts', 'update po', 'update site type', '2021-12-08 16:00:00', '2021-12-10 16:00:00', '2021-12-29 16:00:00', '18604605122021082445.xlsx'),
(3, 'sdafasdf', 'kjashdlkfdsa', 'ljaskdfj', '1111111111111', '111111111111', 'Popopopopopo', 'tewetr', '2021-12-08 16:00:00', '2021-12-10 16:00:00', '2021-12-29 16:00:00', '75649905122021081211.xlsx');

-- --------------------------------------------------------

--
-- Table structure for table `tb_site_integrasi`
--

CREATE TABLE `tb_site_integrasi` (
  `SiteId` bigint(255) UNSIGNED NOT NULL,
  `SiteName` varchar(100) NOT NULL,
  `Sow` varchar(100) NOT NULL,
  `BandType` varchar(50) NOT NULL,
  `BTSType` varchar(50) NOT NULL,
  `SiteConfig` varchar(100) NOT NULL,
  `EnginerId` varchar(100) NOT NULL,
  `EnginerName` varchar(100) NOT NULL,
  `IntegratorName` varchar(100) NOT NULL,
  `NoHpIntegrator` varchar(20) NOT NULL
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
  `UploadFotoCabinet` varchar(255) NOT NULL,
  `ViewAntenaRUU` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_site_verify`
--

INSERT INTO `tb_site_verify` (`SiteId`, `SiteName`, `TocoName`, `Sow`, `UploadFotoCabinet`, `ViewAntenaRUU`) VALUES
(3, 'sdasdafdfsa', 'tesasdfasdfsda', 'tsasddsaffa', '13913705122021092807.jpg', 'dfgsdgsadfasdfdasf');

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
(7, 'Ocoh', 'ocoh', '81dc9bdb52d04dc20036dbd8313ed055', 'pramono.pramono.ext@nokia.com', '11111111', 'PM'),
(10, 'Ocoh', 'ocoh', '81dc9bdb52d04dc20036dbd8313ed055', 'pramono.pramono.ext@nokia.com', '11111111', 'Admin'),
(11, '', '', '', '', '', '');

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
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `Id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
