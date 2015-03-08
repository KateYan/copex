-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 08, 2015 at 04:43 AM
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
-- Table structure for table `pickupplace`
--

CREATE TABLE IF NOT EXISTS `pickupplace` (
  `placeID` int(5) NOT NULL AUTO_INCREMENT,
  `cid` int(5) NOT NULL,
  `placeName` varchar(100) NOT NULL,
  `placeAddr` varchar(100) NOT NULL,
  PRIMARY KEY (`placeID`),
  KEY `cid` (`cid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20012 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pickupplace`
--
ALTER TABLE `pickupplace`
  ADD CONSTRAINT `belong_campus` FOREIGN KEY (`cid`) REFERENCES `campus` (`cid`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
