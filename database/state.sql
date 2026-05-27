-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 18, 2024 at 01:18 PM
-- Server version: 5.7.19
-- PHP Version: 7.1.9

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
-- Table structure for table `state`
--

DROP TABLE IF EXISTS `state`;
CREATE TABLE IF NOT EXISTS `state` (
  `state_id` int(11) NOT NULL AUTO_INCREMENT,
  `state` varchar(50) NOT NULL,
  `emailid` text NOT NULL,
  `branch_id` varchar(11) NOT NULL,
  PRIMARY KEY (`state_id`),
  UNIQUE KEY `state` (`state`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`state_id`, `state`, `emailid`, `branch_id`) VALUES
(1, 'Maharashtra', '', '10'),
(2, 'Andaman and Nicobar Islands', '', '15'),
(3, 'Andhra Pradesh', '', '1'),
(4, 'Arunachal Pradesh', '', '2'),
(5, 'Assam', '', '2'),
(6, 'Bihar', '', '3'),
(7, 'Chhattisgarh', '', '4'),
(8, 'Dadra and Nagar Haveli', '', '6'),
(9, 'Daman & Diu', '', '6'),
(10, 'Delhi', '', '5'),
(11, 'Goa', '', '10'),
(12, 'Gujarat', '', '6'),
(13, 'Chandigarh', '', '13'),
(14, 'Haryana', '', '13'),
(15, 'Himachal Pradesh', '', '13'),
(16, 'Uttaranchal', '', '16'),
(17, 'Jammu and Kashmir', '', '13'),
(18, 'Jharkhand', '', '7'),
(19, 'Karnataka', '', '8'),
(20, 'Kerala', '', '9'),
(21, 'Lakshadweep', '', '15'),
(22, 'Madhya Pradesh', '', '11'),
(23, 'Manipur', '', '2'),
(24, 'Meghalaya', '', '2'),
(25, 'Mizoram', '', '2'),
(26, 'Nagaland', '', '2'),
(27, 'Orissa', '', '12'),
(28, 'Pondicherry', '', '15'),
(29, 'Punjab', '', '13'),
(30, 'Rajasthan', '', '14'),
(31, 'Sikkim', '', '17'),
(32, 'West Bengal', '', '17'),
(33, 'Tamil Nadu', '', '15'),
(34, 'Tripura', '', '2'),
(35, 'Uttar Pradesh', '', '16'),
(36, 'Uttarakhand', '', '16'),
(37, 'Telangana', '', '1');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
