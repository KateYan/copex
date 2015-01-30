-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 30, 2015 at 08:37 PM
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
  `cid` int(5) NOT NULL,
  `userOrderStart` varchar(100) NOT NULL,
  `userOrderEnd` varchar(100) NOT NULL,
  `userPickupStart` varchar(100) NOT NULL,
  `userPickupEnd` varchar(100) NOT NULL,
  `vipOrderStart` varchar(100) NOT NULL,
  `vipOrderEnd` varchar(100) NOT NULL,
  `vipPickupStart` varchar(100) NOT NULL,
  `vipPickupEnd` varchar(100) NOT NULL,
  PRIMARY KEY (`BasicID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=107 ;

--
-- Dumping data for table `basic`
--

INSERT INTO `basic` (`BasicID`, `cid`, `userOrderStart`, `userOrderEnd`, `userPickupStart`, `userPickupEnd`, `vipOrderStart`, `vipOrderEnd`, `vipPickupStart`, `vipPickupEnd`) VALUES
(101, 10001, '13:00:00', '23:59:59', '11:30:00', '13:30:00', '13:00:00', '06:00:00', '11:30:00', '13:30:00'),
(102, 10004, '13:00:00', '23:59:59', '11:30:00', '13:00:00', '13:00:00', '06:00:00', '11:30:00', '13:30:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
