-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2014 at 08:33 PM
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
-- Table structure for table `basicrule`
--

CREATE TABLE IF NOT EXISTS `basicrule` (
  `ruleid` int(5) NOT NULL AUTO_INCREMENT,
  `rulename` varchar(20) NOT NULL,
  `timestart` time NOT NULL,
  `timeend` time NOT NULL,
  `date` date NOT NULL,
  `risvip` tinyint(1) NOT NULL,
  PRIMARY KEY (`ruleid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16182 ;

--
-- Dumping data for table `basicrule`
--

INSERT INTO `basicrule` (`ruleid`, `rulename`, `timestart`, `timeend`, `date`, `risvip`) VALUES
(16180, 'pickupTime', '11:30:00', '13:30:00', '2014-12-11', 0),
(16181, 'vipPickupTime', '11:00:00', '14:00:00', '2014-12-11', 1);

-- --------------------------------------------------------

--
-- Table structure for table `campus`
--

CREATE TABLE IF NOT EXISTS `campus` (
  `cid` int(5) NOT NULL AUTO_INCREMENT,
  `cname` varchar(20) NOT NULL,
  `caddr` varchar(30) NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10005 ;

--
-- Dumping data for table `campus`
--

INSERT INTO `campus` (`cid`, `cname`, `caddr`) VALUES
(10001, 'UTSC', '312 King Street'),
(10002, 'UTM', '789 Queen Street'),
(10003, 'UTSG', '102 Bay Street'),
(10004, 'YouK', '789 York Road');

-- --------------------------------------------------------

--
-- Table structure for table `coperationline`
--

CREATE TABLE IF NOT EXISTS `coperationline` (
  `lineid` int(5) NOT NULL AUTO_INCREMENT,
  `cid` int(5) NOT NULL,
  `did` int(5) NOT NULL,
  PRIMARY KEY (`lineid`),
  KEY `cid` (`cid`,`did`),
  KEY `did` (`did`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10007 ;

--
-- Dumping data for table `coperationline`
--

INSERT INTO `coperationline` (`lineid`, `cid`, `did`) VALUES
(10004, 10001, 10002),
(10001, 10002, 10001),
(10002, 10003, 10001),
(10006, 10003, 10002),
(10005, 10004, 10001);

-- --------------------------------------------------------

--
-- Table structure for table `dailymenu`
--

CREATE TABLE IF NOT EXISTS `dailymenu` (
  `mid` int(5) NOT NULL AUTO_INCREMENT,
  `cid` int(5) DEFAULT NULL,
  `mdate` date NOT NULL,
  `mstatus` tinyint(1) NOT NULL,
  PRIMARY KEY (`mid`),
  KEY `cid` (`cid`),
  KEY `mdate` (`mdate`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10013 ;

--
-- Dumping data for table `dailymenu`
--

INSERT INTO `dailymenu` (`mid`, `cid`, `mdate`, `mstatus`) VALUES
(10001, 10001, '2014-12-03', 0),
(10002, 10002, '2014-12-03', 0),
(10003, 10003, '2014-12-03', 0),
(10004, 10004, '2014-12-03', 0),
(10005, 10001, '2014-12-09', 1),
(10006, 10002, '2014-12-09', 1),
(10007, 10001, '2014-12-05', 0),
(10008, 10002, '2014-12-05', 0),
(10009, 10003, '2014-12-05', 0),
(10010, 10004, '2014-12-05', 0),
(10011, 10003, '2014-12-09', 1),
(10012, 10004, '2014-12-09', 1);

-- --------------------------------------------------------

--
-- Table structure for table `diner`
--

CREATE TABLE IF NOT EXISTS `diner` (
  `did` int(5) NOT NULL AUTO_INCREMENT,
  `dname` varchar(30) NOT NULL,
  `daddr` varchar(30) NOT NULL,
  `demail` varchar(25) NOT NULL,
  `dphone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`did`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10003 ;

--
-- Dumping data for table `diner`
--

INSERT INTO `diner` (`did`, `dname`, `daddr`, `demail`, `dphone`) VALUES
(10001, 'T&T', '', 'tt123@gmail.com', '647-310-6789'),
(10002, 'benben resturaunt', '', 'benben@hotmail.com', '647-123-4567');

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE IF NOT EXISTS `food` (
  `fid` int(5) NOT NULL AUTO_INCREMENT,
  `did` int(5) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `fdes` varchar(50) DEFAULT NULL,
  `fprice` float NOT NULL,
  `fpicture` varchar(60) NOT NULL,
  PRIMARY KEY (`fid`),
  KEY `did` (`did`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10005 ;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`fid`, `did`, `fname`, `fdes`, `fprice`, `fpicture`) VALUES
(10001, 10001, '红烧鸭子', NULL, 19.99, '../../css/images/1_04img01.jpg'),
(10002, 10002, '干锅排骨', NULL, 6.99, '../../css/images/3_03img01.jpg'),
(10003, 10001, '蜜辣烤翅', NULL, 6.99, '../../css/images/1_04img02.jpg'),
(10004, 10002, '清蒸鲤鱼', NULL, 9.99, '../../css/images/4_03img02.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `menuitem`
--

CREATE TABLE IF NOT EXISTS `menuitem` (
  `mitemid` int(5) NOT NULL AUTO_INCREMENT,
  `fid` int(5) DEFAULT NULL,
  `mid` int(5) NOT NULL,
  `isrecomd` tinyint(4) NOT NULL COMMENT 'recommend or not',
  PRIMARY KEY (`mitemid`),
  KEY `fid` (`fid`,`mid`),
  KEY `mid` (`mid`),
  KEY `mid_2` (`mid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10043 ;

--
-- Dumping data for table `menuitem`
--

INSERT INTO `menuitem` (`mitemid`, `fid`, `mid`, `isrecomd`) VALUES
(10001, 10001, 10001, 1),
(10004, 10004, 10002, 1),
(10005, 10003, 10002, 0),
(10006, 10003, 10001, 0),
(10007, 10002, 10002, 0),
(10010, 10003, 10001, 0),
(10011, 10002, 10003, 1),
(10012, 10003, 10003, 0),
(10013, 10004, 10003, 0),
(10014, 10002, 10004, 1),
(10015, 10001, 10004, 0),
(10016, 10003, 10004, 0),
(10017, 10001, 10007, 1),
(10018, 10002, 10007, 0),
(10019, 10004, 10007, 0),
(10020, 10002, 10008, 1),
(10021, 10003, 10008, 0),
(10022, 10003, 10008, 0),
(10023, 10001, 10009, 1),
(10024, 10002, 10009, 0),
(10025, 10003, 10009, 0),
(10026, 10004, 10010, 1),
(10027, 10003, 10010, 0),
(10028, 10002, 10010, 0),
(10029, 10001, 10011, 1),
(10032, 10002, 10011, 0),
(10033, 10003, 10011, 0),
(10034, 10003, 10012, 1),
(10035, 10004, 10012, 0),
(10036, 10001, 10012, 0),
(10037, 10002, 10005, 1),
(10038, 10003, 10005, 0),
(10039, 10004, 10005, 0),
(10040, 10004, 10006, 1),
(10041, 10001, 10006, 0),
(10042, 10003, 10006, 0);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE IF NOT EXISTS `order` (
  `oid` int(7) NOT NULL AUTO_INCREMENT,
  `uid` int(5) DEFAULT NULL,
  `cid` int(5) NOT NULL,
  `odate` date NOT NULL,
  `ostatus` tinyint(1) DEFAULT '0',
  `oispaid` tinyint(1) DEFAULT '0',
  `totalcost` float DEFAULT '0',
  PRIMARY KEY (`oid`),
  KEY `uid` (`uid`),
  KEY `cid` (`cid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2753519 ;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`oid`, `uid`, `cid`, `odate`, `ostatus`, `oispaid`, `totalcost`) VALUES
(10001, 10001, 0, '2014-11-30', 1, 1, 43.98),
(10002, 10168, 0, '2014-12-07', 0, 0, 0),
(10003, 10168, 0, '2014-12-07', 0, 0, 0),
(10014, 10168, 0, '2014-12-07', 0, 0, NULL),
(10015, 10168, 0, '2014-12-07', 0, 0, NULL),
(10057, 10178, 0, '2014-12-08', 0, 0, 9.99),
(2753468, 10156, 0, '2014-12-08', 0, 0, 9.99),
(2753473, 10178, 0, '2014-12-08', 0, 0, 9.99),
(2753474, 10178, 0, '2014-12-08', 0, 0, 9.99),
(2753475, 10178, 0, '2014-12-08', 0, 0, 9.99),
(2753476, 10178, 0, '2014-12-08', 0, 0, 9.99),
(2753477, 10178, 0, '2014-12-08', 0, 0, 9.99),
(2753478, 10178, 0, '2014-12-08', 0, 0, 9.99),
(2753479, 10178, 0, '2014-12-08', 0, 0, 6.99),
(2753480, 10178, 0, '2014-12-08', 0, 0, 6.99),
(2753481, 10178, 0, '2014-12-08', 0, 0, 19.99),
(2753482, 10178, 0, '2014-12-08', 0, 0, 9.99),
(2753483, 10180, 10002, '2014-12-09', 0, 0, 9.99),
(2753484, 10180, 10002, '2014-12-09', 0, 0, 9.99),
(2753485, 10180, 10002, '2014-12-09', 0, 0, 9.99),
(2753486, 10180, 10002, '2014-12-09', 0, 0, 9.99),
(2753487, 10180, 10002, '2014-12-09', 0, 0, 9.99),
(2753488, 10180, 10002, '2014-12-09', 0, 0, 9.99),
(2753489, 10180, 10002, '2014-12-09', 0, 0, 9.99),
(2753490, 10181, 10002, '2014-12-09', 0, 0, 6.99),
(2753491, 10182, 10004, '2014-12-09', 0, 0, 9.99),
(2753492, 10182, 10004, '2014-12-09', 0, 0, 9.99),
(2753493, 10182, 10004, '2014-12-09', 0, 0, 6.99),
(2753494, 10183, 10003, '2014-12-09', 0, 0, 0),
(2753495, 10183, 10003, '2014-12-09', 0, 0, 6.99),
(2753496, 10183, 10003, '2014-12-09', 0, 0, 6.99),
(2753497, 10184, 10003, '2014-12-09', 0, 0, 19.99),
(2753498, 10185, 10003, '2014-12-10', 0, 0, 6.99),
(2753499, 10185, 10004, '2014-12-10', 0, NULL, 40.96),
(2753500, 10185, 10004, '2014-12-10', 0, NULL, 40.96),
(2753501, 10185, 10004, '2014-12-10', 0, NULL, 40.96),
(2753502, 10185, 10004, '2014-12-10', 0, NULL, 40.96),
(2753503, 10185, 10004, '2014-12-10', 0, NULL, 40.96),
(2753504, 10185, 10004, '2014-12-10', 0, NULL, 40.96),
(2753505, 10185, 10004, '2014-12-10', 0, 1, 40.96),
(2753506, 10185, 10004, '2014-12-10', 0, 1, 40.96),
(2753507, 10185, 10004, '2014-12-10', 0, 1, 40.96),
(2753508, 10185, 10004, '2014-12-10', 0, 1, 40.96),
(2753509, 10185, 10004, '2014-12-10', 0, 1, 40.96),
(2753510, 10185, 10004, '2014-12-10', 0, 1, 40.96),
(2753511, 10185, 10004, '2014-12-10', 0, 1, 40.96),
(2753512, 10185, 10004, '2014-12-10', 0, 1, 40.96),
(2753513, 10185, 10004, '2014-12-10', 0, 1, 40.96),
(2753514, 10186, 10002, '2014-12-10', 0, 0, 0),
(2753515, 10195, 10003, '2014-12-10', 0, 0, 6.99),
(2753516, 10185, 10004, '2014-12-11', 0, 1, 40.96),
(2753517, 10185, 10004, '2014-12-11', 0, 1, 40.96),
(2753518, 10185, 10004, '2014-12-11', 0, 1, 40.96);

-- --------------------------------------------------------

--
-- Table structure for table `orderitem`
--

CREATE TABLE IF NOT EXISTS `orderitem` (
  `oitemid` int(5) NOT NULL AUTO_INCREMENT,
  `oid` int(5) NOT NULL,
  `dishid` int(5) NOT NULL,
  `dishtype` tinyint(1) NOT NULL,
  PRIMARY KEY (`oitemid`),
  KEY `oid` (`oid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10117 ;

--
-- Dumping data for table `orderitem`
--

INSERT INTO `orderitem` (`oitemid`, `oid`, `dishid`, `dishtype`) VALUES
(10012, 10014, 10004, 0),
(10013, 10015, 10004, 0),
(10028, 10057, 10004, 0),
(10033, 2753473, 10004, 0),
(10034, 2753474, 10004, 0),
(10035, 2753475, 10004, 0),
(10036, 2753476, 10004, 0),
(10037, 2753477, 10004, 0),
(10038, 2753478, 10004, 0),
(10039, 2753479, 10003, 0),
(10040, 2753480, 10003, 0),
(10041, 2753481, 10001, 0),
(10042, 2753482, 10004, 0),
(10043, 2753483, 10004, 0),
(10044, 2753484, 10004, 0),
(10045, 2753485, 10004, 0),
(10046, 2753486, 10004, 0),
(10047, 2753487, 10004, 0),
(10048, 2753488, 10004, 0),
(10049, 2753489, 10004, 0),
(10050, 2753490, 10003, 0),
(10051, 2753491, 10004, 0),
(10052, 2753492, 10004, 0),
(10053, 2753493, 10003, 0),
(10054, 2753495, 10002, 0),
(10055, 2753496, 10003, 0),
(10056, 2753497, 10001, 0),
(10057, 2753498, 10003, 0),
(10058, 2753502, 10003, 0),
(10059, 2753502, 10003, 0),
(10060, 2753502, 10001, 0),
(10061, 2753503, 10003, 0),
(10062, 2753503, 10003, 0),
(10063, 2753503, 10001, 0),
(10064, 2753504, 10003, 0),
(10065, 2753504, 10003, 0),
(10066, 2753504, 10001, 0),
(10067, 2753504, 50001, 1),
(10068, 2753505, 10003, 0),
(10069, 2753505, 10003, 0),
(10070, 2753505, 10001, 0),
(10071, 2753505, 50001, 1),
(10072, 2753506, 10003, 0),
(10073, 2753506, 10003, 0),
(10074, 2753506, 10001, 0),
(10075, 2753506, 50001, 1),
(10076, 2753507, 10003, 0),
(10077, 2753507, 10003, 0),
(10078, 2753507, 10001, 0),
(10079, 2753507, 50001, 1),
(10080, 2753508, 10003, 0),
(10081, 2753508, 10003, 0),
(10082, 2753508, 10001, 0),
(10083, 2753508, 50001, 1),
(10084, 2753509, 10003, 0),
(10085, 2753509, 10003, 0),
(10086, 2753509, 10001, 0),
(10087, 2753509, 50001, 1),
(10088, 2753510, 10003, 0),
(10089, 2753510, 10003, 0),
(10090, 2753510, 10001, 0),
(10091, 2753510, 50001, 1),
(10092, 2753511, 10003, 0),
(10093, 2753511, 10003, 0),
(10094, 2753511, 10001, 0),
(10095, 2753511, 50001, 1),
(10096, 2753512, 10003, 0),
(10097, 2753512, 10003, 0),
(10098, 2753512, 10001, 0),
(10099, 2753512, 50001, 1),
(10100, 2753513, 10003, 0),
(10101, 2753513, 10003, 0),
(10102, 2753513, 10001, 0),
(10103, 2753513, 50001, 1),
(10104, 2753515, 10002, 0),
(10105, 2753516, 10003, 0),
(10106, 2753516, 10003, 0),
(10107, 2753516, 10001, 0),
(10108, 2753516, 50001, 1),
(10109, 2753517, 10003, 0),
(10110, 2753517, 10003, 0),
(10111, 2753517, 10001, 0),
(10112, 2753517, 50001, 1),
(10113, 2753518, 10003, 0),
(10114, 2753518, 10003, 0),
(10115, 2753518, 10001, 0),
(10116, 2753518, 50001, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sidedish`
--

CREATE TABLE IF NOT EXISTS `sidedish` (
  `sid` int(5) NOT NULL AUTO_INCREMENT,
  `did` int(5) NOT NULL,
  `sname` varchar(30) NOT NULL,
  `sdes` varchar(30) DEFAULT NULL,
  `sprice` float NOT NULL,
  `spicture` varchar(30) NOT NULL,
  PRIMARY KEY (`sid`),
  KEY `did` (`did`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10005 ;

--
-- Dumping data for table `sidedish`
--

INSERT INTO `sidedish` (`sid`, `did`, `sname`, `sdes`, `sprice`, `spicture`) VALUES
(50001, 10001, '麻辣热干面', NULL, 6.99, '../../css/images/4_03img01.jpg'),
(50002, 10002, '成都冒菜', NULL, 6.99, '../../css/images/4_03img03.jpg'),
(50003, 10002, '鲜肉叉烧包', NULL, 6.99, '../../css/images/3_08.jpg'),
(50004, 10002, '东北小菜', NULL, 5.99, '../../css/images/4_03img04.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `sidemenu`
--

CREATE TABLE IF NOT EXISTS `sidemenu` (
  `sideMenuID` int(5) NOT NULL AUTO_INCREMENT,
  `cid` int(5) DEFAULT NULL,
  `sideMenuDate` date DEFAULT NULL,
  `sideMenuStatus` tinyint(1) NOT NULL,
  PRIMARY KEY (`sideMenuID`),
  KEY `cid` (`cid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10006 ;

--
-- Dumping data for table `sidemenu`
--

INSERT INTO `sidemenu` (`sideMenuID`, `cid`, `sideMenuDate`, `sideMenuStatus`) VALUES
(10001, 10001, '2014-12-06', 1),
(10002, 10002, '2014-12-06', 1),
(10004, 10003, '2014-12-06', 1),
(10005, 10004, '2014-12-06', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sidemenuitem`
--

CREATE TABLE IF NOT EXISTS `sidemenuitem` (
  `sideItemID` int(5) NOT NULL AUTO_INCREMENT,
  `sid` int(5) DEFAULT NULL,
  `sideMenuID` int(5) NOT NULL,
  PRIMARY KEY (`sideItemID`),
  KEY `sid` (`sid`,`sideMenuID`),
  KEY `mid` (`sideMenuID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `sidemenuitem`
--

INSERT INTO `sidemenuitem` (`sideItemID`, `sid`, `sideMenuID`) VALUES
(9, 50001, 10001),
(15, 50001, 10002),
(1, 50001, 10004),
(6, 50001, 10005),
(10, 50002, 10001),
(13, 50002, 10002),
(2, 50002, 10004),
(5, 50002, 10005),
(11, 50003, 10001),
(14, 50003, 10002),
(3, 50003, 10004),
(7, 50003, 10005),
(12, 50004, 10001),
(16, 50004, 10002),
(4, 50004, 10004),
(8, 50004, 10005);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `uid` int(5) NOT NULL AUTO_INCREMENT,
  `cid` int(5) DEFAULT NULL,
  `vipid` int(5) DEFAULT NULL,
  `uphone` varchar(20) DEFAULT NULL,
  `uhash` varchar(128) NOT NULL,
  `ip` varchar(20) DEFAULT NULL,
  `ordered` tinyint(4) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`uid`),
  KEY `cid` (`cid`,`vipid`),
  KEY `vipid` (`vipid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10206 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `cid`, `vipid`, `uphone`, `uhash`, `ip`, `ordered`, `created`, `last_login`) VALUES
(10001, 10001, 10001, '647789456', '', '', 0, '0000-00-00 00:00:00', '2014-12-03 21:25:48'),
(10002, 10001, 32716, '201-456-4567', '', '', 0, '0000-00-00 00:00:00', '2014-12-03 21:25:48'),
(10003, 10002, NULL, '453-453-1234', '', '', 0, '0000-00-00 00:00:00', '2014-12-03 21:25:48'),
(10004, 10001, NULL, '234-234-1234', '', '', 0, '0000-00-00 00:00:00', '2014-12-03 21:25:48'),
(10054, 10002, NULL, NULL, '12345', '::1', 0, '2014-12-04 17:23:58', NULL),
(10065, 10002, NULL, NULL, '12345', '::1', 0, '2014-12-04 17:48:10', NULL),
(10077, 10002, NULL, NULL, '12345', '::1', 0, '2014-12-04 20:16:05', NULL),
(10078, 10001, NULL, NULL, '12345', '::1', 0, '2014-12-04 20:19:57', NULL),
(10079, 10002, NULL, NULL, '12345', '::1', 0, '2014-12-04 20:21:05', NULL),
(10080, 10002, NULL, NULL, '12345', '::1', 0, '2014-12-04 20:24:59', NULL),
(10081, 10001, NULL, NULL, '12345', '::1', 0, '2014-12-04 21:50:02', NULL),
(10114, 10002, 0, '', '12345', '::1', 0, '2014-12-05 01:15:55', '0000-00-00 00:00:00'),
(10115, 10001, 0, '', '12345', '::1', 0, '2014-12-05 01:19:18', '0000-00-00 00:00:00'),
(10119, 10002, 0, '', '12345', '::1', 0, '2014-12-05 01:24:41', '0000-00-00 00:00:00'),
(10124, 10002, 0, '', '12345', '::1', 0, '2014-12-05 16:37:01', '0000-00-00 00:00:00'),
(10125, 10003, NULL, NULL, '', NULL, NULL, '2014-12-05 17:09:56', NULL),
(10127, 10003, NULL, NULL, '12345', '::1', 0, '2014-12-05 17:24:16', NULL),
(10128, 10002, NULL, NULL, '12345', '::1', 0, '2014-12-05 17:28:29', NULL),
(10130, 10002, NULL, NULL, '12345', '::1', 0, '2014-12-05 19:25:44', NULL),
(10131, 10001, NULL, NULL, '12345', '::1', 0, '2014-12-05 19:56:10', NULL),
(10132, 10002, NULL, NULL, '12345', '::1', 0, '2014-12-05 20:15:38', NULL),
(10133, 10004, NULL, NULL, '12345', '::1', 0, '2014-12-05 20:16:24', NULL),
(10134, 10002, NULL, NULL, '12345', '::1', 0, '2014-12-05 20:32:52', NULL),
(10135, 10002, NULL, NULL, '12345', '::1', 0, '2014-12-05 21:06:09', NULL),
(10136, 10003, NULL, NULL, '12345', '::1', 0, '2014-12-05 23:21:14', NULL),
(10137, 10001, NULL, NULL, '12345', '::1', 0, '2014-12-06 00:08:15', NULL),
(10138, 10004, NULL, NULL, '12345', '::1', 0, '2014-12-06 00:09:28', NULL),
(10139, 10002, NULL, NULL, '12345', '::1', 0, '2014-12-06 00:13:55', NULL),
(10140, 10002, NULL, NULL, '12345', '::1', 0, '2014-12-06 00:14:18', NULL),
(10141, 10001, NULL, NULL, '12345', '::1', 0, '2014-12-06 00:15:53', NULL),
(10142, 10002, NULL, NULL, '12345', '::1', 0, '2014-12-06 00:18:45', NULL),
(10143, 10001, NULL, NULL, '12345', '::1', 0, '2014-12-06 00:21:20', NULL),
(10144, 10002, NULL, NULL, '12345', '::1', 0, '2014-12-06 00:29:46', NULL),
(10145, 10004, NULL, NULL, '12345', '::1', 0, '2014-12-06 00:32:28', NULL),
(10146, 10004, NULL, NULL, '12345', '::1', 0, '2014-12-06 00:37:24', NULL),
(10147, 10004, NULL, NULL, '12345', '::1', 0, '2014-12-06 00:42:26', NULL),
(10148, 10004, NULL, NULL, '12345', '::1', 0, '2014-12-06 00:46:22', NULL),
(10149, 10004, NULL, NULL, '12345', '::1', 0, '2014-12-06 01:07:50', NULL),
(10150, 10002, 10005, '647-123-4567', '12345', '::1', 0, '2014-12-06 02:59:46', NULL),
(10151, 10004, NULL, NULL, '3a538bb5f530c15cce7e6b840645000fc8697a194532812a19652710a8ef5509', '::1', 0, '2014-12-06 05:37:16', NULL),
(10152, 10002, 10006, NULL, '1195b4cdc64e4e248ff388680d34774a10e40a5facff17681a8a645d8434bf7c', '::1', 0, '2014-12-06 20:58:25', NULL),
(10153, 10004, 10009, NULL, '50c7071738f9d9ce3ad497f2ee444a2b52653aa75572c1636d6b7f4cf8c7ecb5', '::1', 0, '2014-12-06 22:41:50', NULL),
(10163, 10004, NULL, NULL, 'ce7772fd360297e9f0455ca7bb4ac784a8e83c97186471bdb8837a024f2a5f5e', '::1', 0, '2014-12-07 02:34:41', NULL),
(10164, 10004, NULL, NULL, 'e5b862407ff79f180276e1f6dddbcdd6823dfe32c6342aae6d89edd6a3427e89', '::1', 0, '2014-12-07 02:39:39', NULL),
(10166, 10004, 10010, NULL, '2f19e1106c94fcd552cbd8f4c354bf7c463715dd7b07b0359272ec47b22fcda0', '::1', 0, '2014-12-07 02:59:41', NULL),
(10167, 10002, NULL, NULL, '6d19021e3fcd8075eac58f7d78d7e275e0d8a6ad4febe883af4364a288155273', '::1', 0, '2014-12-07 16:30:18', NULL),
(10168, 10002, NULL, NULL, '65db06b543a510cc1c7d4ec5bab2add717070f55775d457af4a2bdcf5efdccdc', '::1', 0, '2014-12-07 23:02:04', NULL),
(10169, 10004, NULL, NULL, 'ac5d499580e05f70dc2d6e1ef4d970b8e1502b8468a3a17ed1f5eab02f5a00dd', '::1', 0, '2014-12-07 23:56:02', NULL),
(10170, 10001, NULL, NULL, 'e941ce2cfbfe77a7edcff4a19dd65db92bdf47f1f6d1804f3b80d25280f35509', '::1', 0, '2014-12-08 01:07:45', NULL),
(10171, 10003, NULL, NULL, 'a67debf9b55d648530627997abf54d0d6a30926b0946833d0a612e777801a886', '::1', 0, '2014-12-08 01:27:24', NULL),
(10172, 10002, NULL, NULL, 'bc439d9d676688e9d5e563039474a9830992af172b682bcff339da0699c4534d', '::1', 0, '2014-12-08 01:30:29', NULL),
(10173, 10002, NULL, NULL, '08393c4e8ba73a1b14f0cfbbe489d708c5566259170ea85ebaa7920f03ce9361', '::1', 0, '2014-12-08 01:31:58', NULL),
(10174, 10002, NULL, NULL, '271b3f1de56770a20d8c8a25e4ec16bed58deb805fee1f90f852ce1a18bac40c', '::1', 0, '2014-12-08 01:32:28', NULL),
(10175, 10002, NULL, NULL, '1418976f52fa9512ffaecb0ab43c351d3543d2411444d45b86ef237cfcad1d15', '::1', 0, '2014-12-08 01:35:08', NULL),
(10176, 10002, NULL, NULL, '4394ca83de46028cce19b586b1a3d7fef635d4ebd50c9c7fcec74b4ab1377a95', '::1', 1, '2014-12-08 05:59:14', NULL),
(10177, 10001, NULL, NULL, 'a54a878797df75406d98c00d107499f0ef7f54c02e7951e9fcf812533ee33126', '::1', 1, '2014-12-08 06:11:55', NULL),
(10178, 10001, NULL, NULL, '4e1a67348631f82e22bcf8a1cbfe252a9cc2bc9a7df10e6b290cfe1b1189f6f8', '::1', 1, '2014-12-08 06:13:48', NULL),
(10179, 10001, 10101, NULL, 'c9638f6f221a6be6fe46745bfe9edb4436784c08647da00cf65a8951b4fc69e4', '::1', 0, '2014-12-08 19:41:19', NULL),
(10180, 10002, NULL, NULL, 'af6f2b93ebf8b416e004d711a6e01baf26b8bb11df244b357eba1fa7ddf4f706', '::1', 1, '2014-12-09 06:16:08', NULL),
(10181, 10003, NULL, NULL, '9dff5b1b71330496432ff39cc992fa64ec35c3be581bb8f511958b52b8eb60a5', '::1', 1, '2014-12-09 07:11:29', NULL),
(10182, 10004, NULL, NULL, 'e187c25df3c7f7fc821573da81d32a1b196216912ad6c4c8c597a5e1bea31421', '::1', 1, '2014-12-09 07:21:40', NULL),
(10184, 10003, 10141, NULL, 'c39eb1e187b03d280bb82a422622e1d5f322d5415ea0a8e053ea78cb2e0c11b8', '::1', 1, '2014-12-10 03:29:29', NULL),
(10185, 10004, 10142, '6131231234', '208795b584c83f3bae579f721868d1cbd4884783362387f95f50e35f810a3f50', '::1', 1, '2014-12-10 15:38:21', NULL),
(10203, 10002, NULL, NULL, '8726ad15a3cff1ff4ae283263c66ebffccc750bec91e8755cc493632af0b7eda', '::1', 0, '2014-12-11 00:56:29', NULL),
(10204, 10002, NULL, NULL, 'c38fcbd1b472f52a1d4687f428f0eb24b9b75c76a6176f68012ee8cccfe95e14', '::1', 0, '2014-12-11 00:57:05', NULL),
(10205, 10003, NULL, NULL, 'b7da29ad6ad3d9766b61b60eefe32518f6ef8dafc50d86633e456c9f4c89639f', '::1', 0, '2014-12-11 01:21:46', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vipcard`
--

CREATE TABLE IF NOT EXISTS `vipcard` (
  `vipid` int(5) NOT NULL AUTO_INCREMENT,
  `uid` int(5) DEFAULT NULL,
  `vnumber` int(4) NOT NULL,
  `vpassword` varchar(6) NOT NULL,
  `vbalance` float NOT NULL,
  PRIMARY KEY (`vipid`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32717 ;

--
-- Dumping data for table `vipcard`
--

INSERT INTO `vipcard` (`vipid`, `uid`, `vnumber`, `vpassword`, `vbalance`) VALUES
(10001, 10001, 4592, 'qweqwe', 50),
(10005, 10150, 45612, 'yuanyi', 50),
(10141, 10184, 4975, '', 46.72),
(10142, 10185, 9645, 'qwer', 78.12),
(32716, 10002, 9874, 'asdfas', 50);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `coperationline`
--
ALTER TABLE `coperationline`
  ADD CONSTRAINT `linecid` FOREIGN KEY (`cid`) REFERENCES `campus` (`cid`) ON DELETE CASCADE,
  ADD CONSTRAINT `linedid` FOREIGN KEY (`did`) REFERENCES `diner` (`did`) ON DELETE CASCADE;

--
-- Constraints for table `dailymenu`
--
ALTER TABLE `dailymenu`
  ADD CONSTRAINT `dailymenucid` FOREIGN KEY (`cid`) REFERENCES `campus` (`cid`) ON DELETE SET NULL;

--
-- Constraints for table `food`
--
ALTER TABLE `food`
  ADD CONSTRAINT `fooddid` FOREIGN KEY (`did`) REFERENCES `diner` (`did`) ON DELETE CASCADE;

--
-- Constraints for table `menuitem`
--
ALTER TABLE `menuitem`
  ADD CONSTRAINT `mitemfid` FOREIGN KEY (`fid`) REFERENCES `food` (`fid`) ON DELETE SET NULL,
  ADD CONSTRAINT `mitemmid` FOREIGN KEY (`mid`) REFERENCES `dailymenu` (`mid`) ON DELETE CASCADE;

--
-- Constraints for table `orderitem`
--
ALTER TABLE `orderitem`
  ADD CONSTRAINT `orderitem-oid` FOREIGN KEY (`oid`) REFERENCES `order` (`oid`) ON DELETE CASCADE;

--
-- Constraints for table `sidedish`
--
ALTER TABLE `sidedish`
  ADD CONSTRAINT `sidedid` FOREIGN KEY (`did`) REFERENCES `diner` (`did`) ON DELETE CASCADE;

--
-- Constraints for table `sidemenu`
--
ALTER TABLE `sidemenu`
  ADD CONSTRAINT `campus-sidemenu` FOREIGN KEY (`cid`) REFERENCES `campus` (`cid`) ON DELETE SET NULL;

--
-- Constraints for table `sidemenuitem`
--
ALTER TABLE `sidemenuitem`
  ADD CONSTRAINT `side-menu-item` FOREIGN KEY (`sid`) REFERENCES `sidedish` (`sid`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `menu-item` FOREIGN KEY (`sideMenuID`) REFERENCES `sidemenu` (`sideMenuID`) ON DELETE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `usercid` FOREIGN KEY (`cid`) REFERENCES `campus` (`cid`) ON DELETE SET NULL;

--
-- Constraints for table `vipcard`
--
ALTER TABLE `vipcard`
  ADD CONSTRAINT `vipcarduid` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE SET NULL;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
