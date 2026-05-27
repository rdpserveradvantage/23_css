-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 19, 2025 at 08:01 AM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `esurv`
--

-- --------------------------------------------------------

--
-- Table structure for table `delegation_sites`
--

DROP TABLE IF EXISTS `delegation_sites`;
CREATE TABLE IF NOT EXISTS `delegation_sites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `terminal` varchar(20) DEFAULT NULL,
  `SN` varchar(255) NOT NULL,
  `ATMID` varchar(255) NOT NULL,
  `Bank` varchar(255) NOT NULL,
  `DVRIP` varchar(255) NOT NULL,
  `Customer` varchar(255) NOT NULL,
  `Zone` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `SN` (`SN`,`ATMID`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delegation_sites`
--

INSERT INTO `delegation_sites` (`id`, `terminal`, `SN`, `ATMID`, `Bank`, `DVRIP`, `Customer`, `Zone`) VALUES
(1, '192.168.100.56', '2893', 'SPCPS756', 'ICICI', '10.109.10.150', 'Hitachi', 'West'),
(2, '192.168.100.56', '2894', 'KAHAO008', 'Yes Bank', '172.55.21.246', 'Hitachi', 'South'),
(3, '192.168.100.56', '2895', 'N2287300', 'PNB', '10.109.11.120', 'Hitachi', 'North'),
(4, '192.168.100.51', '2529', 'P3ENOD47', 'HDFC', '172.51.8.83', 'Euronet', 'East'),
(5, '192.168.100.51', '227', 'P1ECDL07', 'HDFC', '172.51.9.235', 'Euronet', 'North');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
