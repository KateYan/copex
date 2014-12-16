-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2014 at 08:33 AM
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
  `key` varchar(50) NOT NULL,
  `value` varchar(100) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `basic`
--

INSERT INTO `basic` (`key`, `value`) VALUES
('user_order_end', '23:59:59'),
('user_order_start', '12:00:00'),
('user_pickup_end', '13:30:00'),
('user_pickup_start', '11:30:00'),
('vip_order_end', '06:00:00'),
('vip_order_start', '12:00:00'),
('vip_pickup_end', '14:00:00'),
('vip_pickup_start', '11:00:00');

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
(10005, 10001, '2014-12-09', 1),
(10006, 10002, '2014-12-09', 1),
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10010 ;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`fid`, `did`, `fname`, `fdes`, `fprice`, `fpicture`) VALUES
(10001, 10001, '红烧鸭子', NULL, 19.99, '1_04img01'),
(10002, 10002, '地三鲜', NULL, 6.99, 'disanxian'),
(10003, 10001, '蜜辣烤翅', NULL, 6.99, '1_04img02'),
(10004, 10002, '清蒸鲤鱼', NULL, 9.99, '4_03img02'),
(10005, 10001, '口水鸡', NULL, 12.69, 'koushuiji'),
(10006, 10001, '芋头牛腩煲', NULL, 14.99, 'niunanbao'),
(10007, 10001, '招牌粉蒸肉', NULL, 9.99, 'fenzhengrou'),
(10008, 10002, '宫保鸡丁', NULL, 11.69, 'gongbaojiding'),
(10009, 10001, '酸辣牛肚', NULL, 12.99, 'niudu');

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
(10029, 10005, 10011, 1),
(10032, 10003, 10011, 0),
(10033, 10009, 10011, 0),
(10034, 10006, 10012, 1),
(10035, 10002, 10012, 0),
(10036, 10007, 10012, 0),
(10037, 10001, 10005, 1),
(10038, 10003, 10005, 0),
(10039, 10002, 10005, 0),
(10040, 10004, 10006, 1),
(10041, 10007, 10006, 0),
(10042, 10008, 10006, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2753591 ;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`oid`, `uid`, `cid`, `odate`, `ostatus`, `oispaid`, `totalcost`) VALUES
(2753516, 10185, 10004, '2014-12-11', 0, 1, 40.96),
(2753517, 10185, 10004, '2014-12-11', 0, 1, 40.96),
(2753519, 10207, 10003, '2014-12-12', 0, 0, 0),
(2753520, 10207, 10003, '2014-12-12', 0, 0, 6.99),
(2753523, 10207, 10003, '2014-12-12', 0, 0, 6.99),
(2753524, 10185, 10004, '2014-12-12', 0, 1, 40.96),
(2753525, 10212, 10003, '2014-12-12', 0, 0, 6.99),
(2753526, 10185, 10004, '2014-12-14', 0, 1, 43.96),
(2753527, 10224, 10003, '2014-12-14', 0, 0, 12.99),
(2753528, 10225, 10004, '2014-12-14', 0, 0, 9.99),
(2753529, 10225, 10004, '2014-12-14', 0, 0, 9.99),
(2753530, 10225, 10004, '2014-12-14', 0, 0, 9.99),
(2753531, 10225, 10004, '2014-12-14', 0, 0, 9.99),
(2753532, 10225, 10004, '2014-12-14', 0, 0, 6.99),
(2753533, 10225, 10004, '2014-12-14', 0, 0, 6.99),
(2753534, 10225, 10004, '2014-12-14', 0, 0, 6.99),
(2753535, 10225, 10004, '2014-12-14', 0, 0, 6.99),
(2753536, 10225, 10004, '2014-12-14', 0, 0, 6.99),
(2753537, 10225, 10004, '2014-12-14', 0, 0, 14.99),
(2753538, 10225, 10004, '2014-12-14', 0, 0, 14.99),
(2753539, 10225, 10002, '2014-12-14', 0, 0, 9.99),
(2753540, 10225, 10002, '2014-12-14', 0, 0, 9.99),
(2753542, 10226, 10004, '2014-12-14', 0, 0, 6.99),
(2753543, 10185, 10004, '2014-12-14', 0, 1, 63.94),
(2753544, 10227, 10004, '2014-12-14', 0, 0, 6.99),
(2753545, 10185, 10004, '2014-12-14', 0, 1, 48.95),
(2753546, 10228, 10004, '2014-12-14', 0, 0, 14.99),
(2753547, 10185, 10004, '2014-12-14', 0, 1, 48.95),
(2753548, 10185, 10004, '2014-12-14', 0, 1, 9.99),
(2753549, 10229, 10003, '2014-12-14', 0, 0, 12.99),
(2753552, 10185, 10004, '2014-12-15', 0, 1, 28.97),
(2753553, 10185, 10004, '2014-12-15', 0, 1, 14.99),
(2753554, 10185, 10003, '2014-12-15', 0, 1, 6.99),
(2753555, 10231, 10004, '2014-12-15', 0, 0, 6.99),
(2753556, 10185, 10003, '2014-12-15', 0, 1, 12.69),
(2753560, 10185, 10003, '2014-12-15', 0, 1, 6.99),
(2753561, 10185, 10003, '2014-12-15', 0, 1, 6.99),
(2753562, 10185, 10003, '2014-12-15', 0, 1, 6.99),
(2753563, 10185, 10003, '2014-12-15', 0, 1, 13.98),
(2753564, 10185, 10003, '2014-12-15', 0, 1, 93.3),
(2753565, 10185, 10003, '2014-12-15', 0, 1, 105),
(2753566, 10185, 10003, '2014-12-15', 0, 1, 79.32),
(2753567, 10185, 10003, '2014-12-15', 0, 1, 40.65),
(2753568, 10185, 10003, '2014-12-15', 0, 1, 19.98),
(2753569, 10185, 10003, '2014-12-15', 0, 1, 26.67),
(2753570, 10185, 10003, '2014-12-15', 0, 1, 18.68),
(2753571, 10185, 10003, '2014-12-15', 0, 1, 12.98),
(2753573, 10185, 10003, '2014-12-15', 0, 1, 45.65),
(2753575, 10232, 10004, '2014-12-15', 0, 0, 14.99),
(2753576, 10232, 10004, '2014-12-15', 0, 0, 9.99),
(2753577, 10185, 10003, '2014-12-15', 0, 1, 6.99),
(2753578, 10233, 10004, '2014-12-15', 0, 0, 14.99),
(2753579, 10233, 10004, '2014-12-15', 0, 0, 14.99),
(2753580, 10185, 10003, '2014-12-16', 0, 1, 18.68),
(2753581, 10185, 10003, '2014-12-16', 0, 1, 18.68),
(2753582, 10185, 10003, '2014-12-16', 0, 1, 25.67),
(2753583, 10002, 10003, '2014-12-16', 0, 1, 12.99),
(2753584, 10185, 10003, '2014-12-16', 0, 1, 12.98),
(2753585, 10185, 10003, '2014-12-16', 0, 1, 12.98),
(2753586, 10185, 10003, '2014-12-16', 0, 1, 45.65),
(2753587, 10185, 10003, '2014-12-16', 0, 1, 25.68),
(2753588, 10185, 10003, '2014-12-16', 0, 1, 25.67),
(2753589, 10185, 10003, '2014-12-16', 0, 1, 18.98),
(2753590, 10185, 10003, '2014-12-16', 0, 1, 25.97);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10242 ;

--
-- Dumping data for table `orderitem`
--

INSERT INTO `orderitem` (`oitemid`, `oid`, `dishid`, `dishtype`) VALUES
(10164, 2753552, 10006, 0),
(10165, 2753552, 10002, 0),
(10166, 2753552, 50002, 1),
(10167, 2753553, 10006, 0),
(10168, 2753554, 10003, 0),
(10169, 2753555, 10002, 0),
(10170, 2753556, 10005, 0),
(10171, 2753560, 10003, 0),
(10172, 2753561, 10003, 0),
(10173, 2753562, 10003, 0),
(10174, 2753563, 10003, 0),
(10175, 2753563, 50001, 1),
(10176, 2753564, 10005, 0),
(10177, 2753564, 10003, 0),
(10178, 2753564, 10009, 0),
(10179, 2753564, 50001, 1),
(10180, 2753564, 50001, 1),
(10181, 2753564, 50001, 1),
(10182, 2753564, 50001, 1),
(10183, 2753565, 10005, 0),
(10184, 2753565, 10005, 0),
(10185, 2753565, 10005, 0),
(10186, 2753565, 10003, 0),
(10187, 2753565, 10003, 0),
(10188, 2753565, 10003, 0),
(10189, 2753565, 10009, 0),
(10190, 2753565, 10009, 0),
(10191, 2753565, 10009, 0),
(10192, 2753565, 50001, 1),
(10193, 2753566, 10005, 0),
(10194, 2753566, 10005, 0),
(10195, 2753566, 10003, 0),
(10196, 2753566, 10003, 0),
(10197, 2753566, 10009, 0),
(10198, 2753566, 10009, 0),
(10199, 2753566, 50001, 1),
(10200, 2753566, 50001, 1),
(10206, 2753568, 10009, 0),
(10207, 2753568, 50001, 1),
(10208, 2753569, 10005, 0),
(10209, 2753569, 50001, 1),
(10210, 2753569, 50001, 1),
(10211, 2753570, 10005, 0),
(10212, 2753570, 50004, 1),
(10213, 2753571, 10003, 0),
(10214, 2753571, 50004, 1),
(10215, 2753573, 10005, 0),
(10216, 2753573, 10003, 0),
(10217, 2753573, 10009, 0),
(10218, 2753573, 50003, 1),
(10219, 2753573, 50004, 1),
(10220, 2753575, 10006, 0),
(10221, 2753576, 10007, 0),
(10222, 2753577, 10003, 0),
(10223, 2753578, 10006, 0),
(10224, 2753579, 10006, 0),
(10225, 2753585, 10003, 1),
(10226, 2753585, 50004, 1),
(10227, 2753586, 10005, 0),
(10228, 2753586, 10003, 0),
(10229, 2753586, 10009, 0),
(10230, 2753586, 50003, 0),
(10231, 2753586, 50004, 0),
(10232, 2753587, 10005, 0),
(10233, 2753587, 10009, 0),
(10234, 2753588, 10005, 0),
(10235, 2753588, 50003, 0),
(10236, 2753588, 50004, 0),
(10237, 2753589, 10009, 0),
(10238, 2753589, 50004, 0),
(10239, 2753590, 10009, 0),
(10240, 2753590, 50003, 0),
(10241, 2753590, 50004, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=50005 ;

--
-- Dumping data for table `sidedish`
--

INSERT INTO `sidedish` (`sid`, `did`, `sname`, `sdes`, `sprice`, `spicture`) VALUES
(50001, 10001, '麻辣热干面', NULL, 6.99, '4_03img01'),
(50002, 10002, '成都冒菜', NULL, 6.99, '4_03img03'),
(50003, 10002, '鲜肉叉烧包', NULL, 6.99, '3_08'),
(50004, 10002, '东北小菜', NULL, 5.99, '4_03img04');

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
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created` timestamp NOT NULL,
  PRIMARY KEY (`uid`),
  KEY `cid` (`cid`,`vipid`),
  KEY `vipid` (`vipid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10235 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `cid`, `vipid`, `uphone`, `uhash`, `ip`, `ordered`, `last_login`, `created`) VALUES
(10181, 10003, NULL, NULL, '9dff5b1b71330496432ff39cc992fa64ec35c3be581bb8f511958b52b8eb60a5', '::1', 1, '2014-12-12 21:06:58', '2014-12-09 07:11:29'),
(10182, 10004, NULL, NULL, 'e187c25df3c7f7fc821573da81d32a1b196216912ad6c4c8c597a5e1bea31421', '::1', 1, '2014-12-12 21:06:58', '2014-12-09 07:21:40'),
(10184, 10003, 10141, NULL, 'c39eb1e187b03d280bb82a422622e1d5f322d5415ea0a8e053ea78cb2e0c11b8', '::1', 1, '2014-12-12 21:06:58', '2014-12-10 03:29:29'),
(10185, 10003, 10142, '6131231234', '208795b584c83f3bae579f721868d1cbd4884783362387f95f50e35f810a3f50', '::1', 1, '2014-12-16 07:32:50', '2014-12-10 15:38:21'),
(10216, 10003, NULL, NULL, 'b841314f665bb44d5aeea2d40a193c17', '::1', 0, '2014-12-14 06:05:01', '2014-12-14 06:05:01'),
(10217, 10003, NULL, NULL, 'c12115d24bfb31afa25ae90da0d05620', '::1', 0, '2014-12-14 19:11:07', '2014-12-14 19:11:07'),
(10218, 10003, NULL, NULL, 'd749404b6d46b10202ec2fe499e538dc', '::1', 0, '2014-12-14 19:58:23', '2014-12-14 19:58:23'),
(10219, 10002, NULL, NULL, 'ba77bae42fe231d046c61ca2596e4213', '::1', 0, '2014-12-14 20:29:07', '2014-12-14 20:29:07'),
(10220, 10004, NULL, NULL, '6101b9fd73460a545f78400ed0ff2319', '::1', 0, '2014-12-14 20:44:10', '2014-12-14 20:44:10'),
(10221, 10003, NULL, NULL, '2488df38e83023b0ff8293b5fef87340', '::1', 0, '2014-12-14 20:57:07', '2014-12-14 20:57:07'),
(10222, 10002, NULL, NULL, '48feffb437c5fead9eac3fe8eca4e8f4', '::1', 0, '2014-12-14 22:37:35', '2014-12-14 22:37:35'),
(10223, 10004, NULL, NULL, 'ed8e6efad7341b8f1afbecbf35b070f9', '::1', 0, '2014-12-14 22:43:31', '2014-12-14 22:43:20'),
(10234, 10004, NULL, NULL, 'e4c072e019448100c4f7c2059729f050', '::1', 0, '2014-12-16 05:12:53', '2014-12-16 05:12:53');

-- --------------------------------------------------------

--
-- Table structure for table `vipcard`
--

CREATE TABLE IF NOT EXISTS `vipcard` (
  `vipid` int(5) NOT NULL AUTO_INCREMENT,
  `uid` int(5) DEFAULT NULL,
  `vnumber` int(4) NOT NULL,
  `vpassword` varchar(128) NOT NULL,
  `vbalance` float NOT NULL,
  PRIMARY KEY (`vipid`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32717 ;

--
-- Dumping data for table `vipcard`
--

INSERT INTO `vipcard` (`vipid`, `uid`, `vnumber`, `vpassword`, `vbalance`) VALUES
(10141, 10184, 4975, '', 150),
(10142, 10185, 9645, '912ec803b2ce49e4a541068d495ab570', 150);

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
  ADD CONSTRAINT `menu-item` FOREIGN KEY (`sideMenuID`) REFERENCES `sidemenu` (`sideMenuID`) ON DELETE CASCADE,
  ADD CONSTRAINT `side-menu-item` FOREIGN KEY (`sid`) REFERENCES `sidedish` (`sid`) ON DELETE SET NULL ON UPDATE CASCADE;

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
