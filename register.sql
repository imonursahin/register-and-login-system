-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 08, 2021 at 11:11 AM
-- Server version: 8.0.17
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `register`
--

-- --------------------------------------------------------

--
-- Table structure for table `400432_tbl_kayitlar`
--

CREATE TABLE `400432_tbl_kayitlar` (
  `id` int(11) NOT NULL,
  `ad` varchar(250) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `soyad` varchar(250) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `email` varchar(250) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `sifre` varchar(50) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `resim_url` text CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `durum` int(5) NOT NULL,
  `kod` varchar(250) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `400432_tbl_nbaslik`
--

CREATE TABLE `400432_tbl_nbaslik` (
  `baslikID` int(11) NOT NULL,
  `baslik` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL,
  `detayID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Dumping data for table `400432_tbl_nbaslik`
--

INSERT INTO `400432_tbl_nbaslik` (`baslikID`, `baslik`, `detayID`) VALUES
(51, '1baslik', NULL),
(52, '2baslik', 39);

-- --------------------------------------------------------

--
-- Table structure for table `400432_tbl_ndetay`
--

CREATE TABLE `400432_tbl_ndetay` (
  `detayID` int(11) NOT NULL,
  `detay` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Dumping data for table `400432_tbl_ndetay`
--

INSERT INTO `400432_tbl_ndetay` (`detayID`, `detay`) VALUES
(38, '2detay'),
(39, 'testdetay');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `400432_tbl_kayitlar`
--
ALTER TABLE `400432_tbl_kayitlar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `400432_tbl_nbaslik`
--
ALTER TABLE `400432_tbl_nbaslik`
  ADD PRIMARY KEY (`baslikID`),
  ADD KEY `detayID` (`detayID`);

--
-- Indexes for table `400432_tbl_ndetay`
--
ALTER TABLE `400432_tbl_ndetay`
  ADD PRIMARY KEY (`detayID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `400432_tbl_kayitlar`
--
ALTER TABLE `400432_tbl_kayitlar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `400432_tbl_nbaslik`
--
ALTER TABLE `400432_tbl_nbaslik`
  MODIFY `baslikID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `400432_tbl_ndetay`
--
ALTER TABLE `400432_tbl_ndetay`
  MODIFY `detayID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `400432_tbl_nbaslik`
--
ALTER TABLE `400432_tbl_nbaslik`
  ADD CONSTRAINT `400432_tbl_nbaslik_ibfk_1` FOREIGN KEY (`detayID`) REFERENCES `400432_tbl_ndetay` (`detayID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
