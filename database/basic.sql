-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 08, 2015 at 04:52 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `copex`
--

-- --------------------------------------------------------

--
-- Table structure for table `basic`
--

CREATE TABLE IF NOT EXISTS `basic` (
  `BasicID` int(3) NOT NULL AUTO_INCREMENT,
  `cid` int(5) DEFAULT NULL,
  `placeID` int(5) DEFAULT NULL,
  `userOrderStart` varchar(100) DEFAULT NULL,
  `userOrderEnd` varchar(100) DEFAULT NULL,
  `userPickupStart` varchar(100) DEFAULT NULL,
  `userPickupEnd` varchar(100) DEFAULT NULL,
  `vipOrderStart` varchar(100) DEFAULT NULL,
  `vipOrderEnd` varchar(100) DEFAULT NULL,
  `vipPickupStart` varchar(100) DEFAULT NULL,
  `vipPickupEnd` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`BasicID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=114 ;

--
-- Dumping data for table `basic`
--

INSERT INTO `basic` (`BasicID`, `cid`, `placeID`, `userOrderStart`, `userOrderEnd`, `userPickupStart`, `userPickupEnd`, `vipOrderStart`, `vipOrderEnd`, `vipPickupStart`, `vipPickupEnd`) VALUES
(101, 10001, NULL, '13:00:00', '23:59:59', '11:30:00', '13:30:00', '13:00:00', '06:00:00', '11:30:00', '13:30:00'),
(102, 10004, NULL, '13:00:00', '23:59:59', '12:00:00', '13:30:00', '13:00:00', '06:00:00', '12:00:00', '13:30:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
