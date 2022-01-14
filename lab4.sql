-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 16, 2021 at 02:20 AM
-- Server version: 8.0.21
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lab4`
--

-- --------------------------------------------------------

--
-- Table structure for table `userslab4`
--

DROP TABLE IF EXISTS `userslab4`;
CREATE TABLE IF NOT EXISTS `userslab4` (
  `compid` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `accesslevel` varchar(255) NOT NULL,
  `frozen` varchar(1) NOT NULL,
  PRIMARY KEY (`compid`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `userslab4`
--

INSERT INTO `userslab4` (`compid`, `username`, `password`, `accesslevel`, `frozen`) VALUES
(1, 'mem1', 'mem1', 'member', 'N'),
(2, 'mem2', 'mem2', 'member', 'Y'),
(3, 'edit1', 'edit1', 'editor', 'N'),
(4, 'edit2', 'edit2', 'editor', 'N'),
(5, 'admin1', 'admin1', 'admin', 'N'),
(6, 'admin2', 'admin2', 'admin', 'N');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
