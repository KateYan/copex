-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2014 at 08:12 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2753572 ;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`oid`, `uid`, `cid`, `odate`, `ostatus`, `oispaid`, `totalcost`) VALUES
(2753481, 10178, 0, '2014-12-08', 0, 0, 19.99),
(2753508, 10185, 10004, '2014-12-10', 0, 1, 40.96),
(2753509, 10185, 10004, '2014-12-10', 0, 1, 40.96),
(2753510, 10185, 10004, '2014-12-10', 0, 1, 40.96),
(2753511, 10185, 10004, '2014-12-10', 0, 1, 40.96),
(2753512, 10185, 10004, '2014-12-10', 0, 1, 40.96),
(2753513, 10185, 10004, '2014-12-10', 0, 1, 40.96),
(2753515, 10195, 10003, '2014-12-10', 0, 0, 6.99),
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
(2753571, 10185, 10003, '2014-12-15', 0, 1, 12.98);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10215 ;

--
-- Dumping data for table `orderitem`
--

INSERT INTO `orderitem` (`oitemid`, `oid`, `dishid`, `dishtype`) VALUES
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
(10117, 2753520, 10003, 0),
(10119, 2753523, 10003, 0),
(10120, 2753524, 10003, 0),
(10121, 2753524, 10003, 0),
(10122, 2753524, 10001, 0),
(10123, 2753524, 50001, 1),
(10124, 2753525, 10002, 0),
(10125, 2753526, 10003, 0),
(10126, 2753526, 10003, 0),
(10127, 2753526, 10001, 0),
(10128, 2753526, 50001, 1),
(10129, 2753527, 10009, 0),
(10130, 2753528, 10007, 0),
(10131, 2753529, 10007, 0),
(10132, 2753530, 10007, 0),
(10133, 2753531, 10007, 0),
(10134, 2753532, 10002, 0),
(10135, 2753533, 10002, 0),
(10136, 2753534, 10002, 0),
(10137, 2753535, 10002, 0),
(10138, 2753536, 10002, 0),
(10139, 2753537, 10006, 0),
(10140, 2753538, 10006, 0),
(10141, 2753539, 10007, 0),
(10142, 2753540, 10007, 0),
(10143, 2753542, 10002, 0),
(10163, 2753549, 10009, 0),
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
(10201, 2753567, 10005, 0),
(10202, 2753567, 50001, 1),
(10203, 2753567, 50001, 1),
(10204, 2753567, 50001, 1),
(10205, 2753567, 50001, 1),
(10206, 2753568, 10009, 0),
(10207, 2753568, 50001, 1),
(10208, 2753569, 10005, 0),
(10209, 2753569, 50001, 1),
(10210, 2753569, 50001, 1),
(10211, 2753570, 10005, 0),
(10212, 2753570, 50004, 1),
(10213, 2753571, 10003, 0),
(10214, 2753571, 50004, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10232 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `cid`, `vipid`, `uphone`, `uhash`, `ip`, `ordered`, `last_login`, `created`) VALUES
(10151, 10004, NULL, NULL, '3a538bb5f530c15cce7e6b840645000fc8697a194532812a19652710a8ef5509', '::1', 0, '2014-12-12 21:06:58', '2014-12-06 05:37:16'),
(10152, 10002, 10006, NULL, '1195b4cdc64e4e248ff388680d34774a10e40a5facff17681a8a645d8434bf7c', '::1', 0, '2014-12-12 21:06:58', '2014-12-06 20:58:25'),
(10153, 10004, 10009, NULL, '50c7071738f9d9ce3ad497f2ee444a2b52653aa75572c1636d6b7f4cf8c7ecb5', '::1', 0, '2014-12-12 21:06:58', '2014-12-06 22:41:50'),
(10163, 10004, NULL, NULL, 'ce7772fd360297e9f0455ca7bb4ac784a8e83c97186471bdb8837a024f2a5f5e', '::1', 0, '2014-12-12 21:06:58', '2014-12-07 02:34:41'),
(10164, 10004, NULL, NULL, 'e5b862407ff79f180276e1f6dddbcdd6823dfe32c6342aae6d89edd6a3427e89', '::1', 0, '2014-12-12 21:06:58', '2014-12-07 02:39:39'),
(10166, 10004, 10010, NULL, '2f19e1106c94fcd552cbd8f4c354bf7c463715dd7b07b0359272ec47b22fcda0', '::1', 0, '2014-12-12 21:06:58', '2014-12-07 02:59:41'),
(10167, 10002, NULL, NULL, '6d19021e3fcd8075eac58f7d78d7e275e0d8a6ad4febe883af4364a288155273', '::1', 0, '2014-12-12 21:06:58', '2014-12-07 16:30:18'),
(10168, 10002, NULL, NULL, '65db06b543a510cc1c7d4ec5bab2add717070f55775d457af4a2bdcf5efdccdc', '::1', 0, '2014-12-12 21:06:58', '2014-12-07 23:02:04'),
(10169, 10004, NULL, NULL, 'ac5d499580e05f70dc2d6e1ef4d970b8e1502b8468a3a17ed1f5eab02f5a00dd', '::1', 0, '2014-12-12 21:06:58', '2014-12-07 23:56:02'),
(10170, 10001, NULL, NULL, 'e941ce2cfbfe77a7edcff4a19dd65db92bdf47f1f6d1804f3b80d25280f35509', '::1', 0, '2014-12-12 21:06:58', '2014-12-08 01:07:45'),
(10171, 10003, NULL, NULL, 'a67debf9b55d648530627997abf54d0d6a30926b0946833d0a612e777801a886', '::1', 0, '2014-12-12 21:06:58', '2014-12-08 01:27:24'),
(10172, 10002, NULL, NULL, 'bc439d9d676688e9d5e563039474a9830992af172b682bcff339da0699c4534d', '::1', 0, '2014-12-12 21:06:58', '2014-12-08 01:30:29'),
(10173, 10002, NULL, NULL, '08393c4e8ba73a1b14f0cfbbe489d708c5566259170ea85ebaa7920f03ce9361', '::1', 0, '2014-12-12 21:06:58', '2014-12-08 01:31:58'),
(10174, 10002, NULL, NULL, '271b3f1de56770a20d8c8a25e4ec16bed58deb805fee1f90f852ce1a18bac40c', '::1', 0, '2014-12-12 21:06:58', '2014-12-08 01:32:28'),
(10175, 10002, NULL, NULL, '1418976f52fa9512ffaecb0ab43c351d3543d2411444d45b86ef237cfcad1d15', '::1', 0, '2014-12-12 21:06:58', '2014-12-08 01:35:08'),
(10176, 10002, NULL, NULL, '4394ca83de46028cce19b586b1a3d7fef635d4ebd50c9c7fcec74b4ab1377a95', '::1', 1, '2014-12-12 21:06:58', '2014-12-08 05:59:14'),
(10177, 10001, NULL, NULL, 'a54a878797df75406d98c00d107499f0ef7f54c02e7951e9fcf812533ee33126', '::1', 1, '2014-12-12 21:06:58', '2014-12-08 06:11:55'),
(10178, 10001, NULL, NULL, '4e1a67348631f82e22bcf8a1cbfe252a9cc2bc9a7df10e6b290cfe1b1189f6f8', '::1', 1, '2014-12-12 21:06:58', '2014-12-08 06:13:48'),
(10179, 10001, 10101, NULL, 'c9638f6f221a6be6fe46745bfe9edb4436784c08647da00cf65a8951b4fc69e4', '::1', 0, '2014-12-12 21:06:58', '2014-12-08 19:41:19'),
(10180, 10002, NULL, NULL, 'af6f2b93ebf8b416e004d711a6e01baf26b8bb11df244b357eba1fa7ddf4f706', '::1', 1, '2014-12-12 21:06:58', '2014-12-09 06:16:08'),
(10181, 10003, NULL, NULL, '9dff5b1b71330496432ff39cc992fa64ec35c3be581bb8f511958b52b8eb60a5', '::1', 1, '2014-12-12 21:06:58', '2014-12-09 07:11:29'),
(10182, 10004, NULL, NULL, 'e187c25df3c7f7fc821573da81d32a1b196216912ad6c4c8c597a5e1bea31421', '::1', 1, '2014-12-12 21:06:58', '2014-12-09 07:21:40'),
(10184, 10003, 10141, NULL, 'c39eb1e187b03d280bb82a422622e1d5f322d5415ea0a8e053ea78cb2e0c11b8', '::1', 1, '2014-12-12 21:06:58', '2014-12-10 03:29:29'),
(10185, 10003, 10142, '6131231234', '208795b584c83f3bae579f721868d1cbd4884783362387f95f50e35f810a3f50', '::1', 1, '2014-12-15 19:09:30', '2014-12-10 15:38:21'),
(10203, 10002, NULL, NULL, '8726ad15a3cff1ff4ae283263c66ebffccc750bec91e8755cc493632af0b7eda', '::1', 0, '2014-12-12 21:06:58', '2014-12-11 00:56:29'),
(10204, 10002, NULL, NULL, 'c38fcbd1b472f52a1d4687f428f0eb24b9b75c76a6176f68012ee8cccfe95e14', '::1', 0, '2014-12-12 21:06:58', '2014-12-11 00:57:05'),
(10205, 10003, NULL, NULL, 'b7da29ad6ad3d9766b61b60eefe32518f6ef8dafc50d86633e456c9f4c89639f', '::1', 0, '2014-12-12 21:06:58', '2014-12-11 01:21:46'),
(10206, 10004, NULL, NULL, '123c551bc0603235e4caa45bd89e6934ac67cff416c2bcac9bcfb0777762e24a', '::1', 0, '2014-12-12 21:06:58', '2014-12-11 20:03:09'),
(10207, 10003, NULL, NULL, '8fe37e80692f22c6ffdaff4ee61bddf213811ccd801d658521ad67187a209c3e', '::1', NULL, '2014-12-12 21:06:58', '2014-12-12 19:28:51'),
(10208, 10002, NULL, '6134564567', '', NULL, NULL, '2014-12-12 20:45:03', '2014-12-12 20:45:03'),
(10209, 10004, NULL, NULL, 'c4ac73add7c1d626ddb4a8691bc4fcef6ebdd10df24c601f59edb5bcd20945ed', '::1', 0, '2014-12-12 21:06:58', '2014-12-12 21:05:51'),
(10210, 10003, NULL, NULL, 'd1db330b8a74df12271bb9781e6792add0619443a5db50c44b9fc61d3fcdce59', '::1', 0, '2014-12-12 21:10:10', '2014-12-12 21:10:10'),
(10211, 10004, NULL, NULL, '7bfd3922c27a4ea0e97c1b3da9649a977aa1dd07850d90b5bcb3b356ca9b53c8', '::1', 0, '2014-12-12 21:31:04', '2014-12-12 21:10:41'),
(10212, 10003, NULL, NULL, '322ff3a5897807e517ca142ec42b253171f377311a185071a858d9f90ff6710e', '::1', NULL, '2014-12-13 00:04:55', '2014-12-12 23:09:43'),
(10213, 10003, NULL, NULL, 'b7e06a757a729840220e7f448377ff7cdc1164aacd313c65b767daa61eb309a1', '::1', 0, '2014-12-13 00:44:12', '0000-00-00 00:00:00'),
(10214, 10004, NULL, NULL, 'ec61da0b6202f24dabeb74007dacb88fe24fed6c32aa195a954c4bec39cc679d', '::1', 0, '2014-12-13 04:44:17', '2014-12-13 00:45:58'),
(10215, 10003, NULL, NULL, '00deb198efcd0b916591df25be7d16ed21da9bfb38f7fa8dbb825168fd7b22b7', '::1', 0, '2014-12-14 04:41:56', '2014-12-13 19:06:56'),
(10216, 10003, NULL, NULL, 'b841314f665bb44d5aeea2d40a193c17', '::1', 0, '2014-12-14 06:05:01', '2014-12-14 06:05:01'),
(10217, 10003, NULL, NULL, 'c12115d24bfb31afa25ae90da0d05620', '::1', 0, '2014-12-14 19:11:07', '2014-12-14 19:11:07'),
(10218, 10003, NULL, NULL, 'd749404b6d46b10202ec2fe499e538dc', '::1', 0, '2014-12-14 19:58:23', '2014-12-14 19:58:23'),
(10219, 10002, NULL, NULL, 'ba77bae42fe231d046c61ca2596e4213', '::1', 0, '2014-12-14 20:29:07', '2014-12-14 20:29:07'),
(10220, 10004, NULL, NULL, '6101b9fd73460a545f78400ed0ff2319', '::1', 0, '2014-12-14 20:44:10', '2014-12-14 20:44:10'),
(10221, 10003, NULL, NULL, '2488df38e83023b0ff8293b5fef87340', '::1', 0, '2014-12-14 20:57:07', '2014-12-14 20:57:07'),
(10222, 10002, NULL, NULL, '48feffb437c5fead9eac3fe8eca4e8f4', '::1', 0, '2014-12-14 22:37:35', '2014-12-14 22:37:35'),
(10223, 10004, NULL, NULL, 'ed8e6efad7341b8f1afbecbf35b070f9', '::1', 0, '2014-12-14 22:43:31', '2014-12-14 22:43:20'),
(10224, 10003, NULL, NULL, '924b2e54f1a05cd98ca6502859d506b5', '::1', NULL, '2014-12-14 23:45:38', '2014-12-14 23:31:54'),
(10225, 10002, NULL, NULL, 'ff451b4a456150649bc16b979c93a383', '::1', NULL, '2014-12-15 01:43:16', '2014-12-14 23:55:33'),
(10226, 10004, NULL, NULL, 'a797b6a1d0ad896d6ef294d668d9a0c0', '::1', NULL, '2014-12-15 02:02:15', '2014-12-15 02:02:15'),
(10227, 10004, NULL, NULL, '601d951f4f2552d36955ef1cd551253a', '::1', NULL, '2014-12-15 03:37:28', '2014-12-15 03:37:28'),
(10228, 10004, NULL, NULL, 'bcbdc857aaf698544556b72de87ca6a3', '::1', NULL, '2014-12-15 04:04:19', '2014-12-15 03:48:31'),
(10229, 10003, NULL, NULL, 'df638792b4b5442d1ab1e46dd1dea479', '::1', NULL, '2014-12-15 04:25:23', '2014-12-15 04:25:23'),
(10230, 10004, NULL, NULL, '1eba9b4a9af24d47bdc5f3274fb227a1', '::1', 0, '2014-12-15 05:19:30', '2014-12-15 05:19:30'),
(10231, 10004, NULL, NULL, '045690f8e96026370317620eb147fff3', '::1', NULL, '2014-12-15 17:03:03', '2014-12-15 17:03:03');

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
(10001, NULL, 4592, 'qweqwe', 50),
(10005, NULL, 45612, 'yuanyi', 50),
(10141, 10184, 4975, '', 150),
(10142, 10185, 9645, 'asdf', 200),
(32716, NULL, 9874, 'asdfas', 50);

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
