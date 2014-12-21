-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 21, 2014 at 08:35 AM
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
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `adminId` int(5) NOT NULL,
  `adminName` varchar(10) NOT NULL,
  `adminPassword` varchar(128) NOT NULL,
  UNIQUE KEY `adminName` (`adminName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminId`, `adminName`, `adminPassword`) VALUES
(20001, 'admin', '750d90bc8a9edcaac607461072175854');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10005 ;

--
-- Dumping data for table `diner`
--

INSERT INTO `diner` (`did`, `dname`, `daddr`, `demail`, `dphone`) VALUES
(10001, 'T&T', '', 'tt123@gmail.com', '647-310-6789'),
(10002, 'benben resturaunt', '', 'benben@hotmail.com', '647-123-4567'),
(10003, 'UTSG餐厅', '', 'utsg@gmail.com', NULL),
(10004, 'YouK餐厅', '', 'youk@gmail.com', NULL);

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
  `odate` datetime NOT NULL,
  `fordate` date NOT NULL,
  `ostatus` tinyint(1) DEFAULT '0',
  `oispaid` tinyint(1) DEFAULT '0',
  `tax` float NOT NULL,
  `totalcost` float DEFAULT '0',
  PRIMARY KEY (`oid`),
  KEY `uid` (`uid`),
  KEY `cid` (`cid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2753644 ;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`oid`, `uid`, `cid`, `odate`, `fordate`, `ostatus`, `oispaid`, `tax`, `totalcost`) VALUES
(2753623, 10257, 10002, '2014-12-18 17:50:17', '2014-12-19', 1, 1, 1.3, 11.29),
(2753624, 10258, 10004, '2014-12-18 17:53:53', '2014-12-19', 1, 1, 1.3, 11.29),
(2753625, 10259, 10003, '2014-12-18 17:58:43', '2014-12-19', 1, 1, 1.65, 14.34),
(2753630, 10185, 10003, '2014-12-19 13:14:07', '2014-12-20', 1, 1, 3.47, 30.14),
(2753631, 10185, 10003, '2014-12-19 14:50:33', '2014-12-20', 1, 1, 5.28, 45.93),
(2753632, 10262, 10004, '2014-12-19 15:51:35', '2014-12-20', 1, 1, 0.91, 7.9),
(2753633, 10184, 10003, '2014-12-20 13:17:09', '2014-12-21', 0, 1, 1.69, 14.68),
(2753634, 10185, 10002, '2014-12-20 14:28:07', '2014-12-21', 0, 1, 2.08, 18.06),
(2753635, 10264, 10004, '2014-12-20 15:01:27', '2014-12-21', 0, 0, 0.91, 7.9),
(2753636, 10265, 10004, '2014-12-20 15:23:42', '2014-12-21', 0, 0, 0.91, 7.9),
(2753637, 10267, 10003, '2014-12-20 17:25:25', '2014-12-21', 0, 0, 1.69, 14.68),
(2753638, 10268, 10004, '2014-12-20 17:33:44', '2014-12-21', 0, 0, 0.91, 7.9),
(2753639, 10185, 10004, '2014-12-20 18:16:33', '2014-12-21', 0, 1, 0.91, 7.9),
(2753640, 10272, 10001, '2014-12-20 23:35:24', '2014-12-21', 0, 0, 0.91, 7.9),
(2753641, 10273, 10004, '2014-12-20 23:37:20', '2014-12-21', 0, 0, 0.91, 7.9),
(2753642, 10274, 10004, '2014-12-20 23:40:39', '2014-12-21', 0, 0, 0.91, 7.9),
(2753643, 10275, 10004, '2014-12-20 23:44:58', '2014-12-21', 0, 0, 1.95, 16.94);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10353 ;

--
-- Dumping data for table `orderitem`
--

INSERT INTO `orderitem` (`oitemid`, `oid`, `dishid`, `dishtype`) VALUES
(10315, 2753623, 10004, 0),
(10316, 2753624, 10007, 0),
(10317, 2753625, 10005, 0),
(10332, 2753630, 10005, 0),
(10333, 2753630, 10003, 0),
(10334, 2753630, 10003, 0),
(10335, 2753631, 10005, 0),
(10336, 2753631, 10003, 0),
(10337, 2753631, 10003, 0),
(10338, 2753631, 50002, 1),
(10339, 2753631, 50003, 1),
(10340, 2753632, 10002, 0),
(10341, 2753633, 10009, 0),
(10342, 2753634, 10007, 0),
(10343, 2753634, 50004, 1),
(10344, 2753635, 10002, 0),
(10345, 2753636, 10002, 0),
(10346, 2753637, 10009, 0),
(10347, 2753638, 10002, 0),
(10348, 2753639, 10002, 0),
(10349, 2753640, 10003, 0),
(10350, 2753641, 10002, 0),
(10351, 2753642, 10002, 0),
(10352, 2753643, 10006, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10280 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `cid`, `vipid`, `uphone`, `uhash`, `ip`, `ordered`, `last_login`, `created`) VALUES
(10181, 10003, NULL, NULL, '9dff5b1b71330496432ff39cc992fa64ec35c3be581bb8f511958b52b8eb60a5', '::1', 1, '2014-12-12 21:06:58', '2014-12-09 07:11:29'),
(10182, 10004, NULL, NULL, 'e187c25df3c7f7fc821573da81d32a1b196216912ad6c4c8c597a5e1bea31421', '::1', 1, '2014-12-12 21:06:58', '2014-12-09 07:21:40'),
(10184, 10003, 10141, '6471234567', 'c39eb1e187b03d280bb82a422622e1d5f322d5415ea0a8e053ea78cb2e0c11b8', '::1', 1, '2014-12-12 21:06:58', '2014-12-10 03:29:29'),
(10185, 10004, 10142, '6131231234', '208795b584c83f3bae579f721868d1cbd4884783362387f95f50e35f810a3f50', '::1', 1, '2014-12-21 02:25:19', '2014-12-20 04:38:21'),
(10255, 10003, NULL, NULL, 'cb4e168db1faa34bd0893e4889a2f4f1', '::1', 0, '2014-12-18 20:25:13', '2014-12-18 20:25:13'),
(10256, 10003, NULL, '1231234123', '38f31bfacb6f2fddbd10ade8b55e2f6f', '::1', 1, '2014-12-18 21:57:58', '2014-12-18 21:57:48'),
(10257, 10002, NULL, '6134564567', '9dec88b3772c35708f47db386b2f487e', '::1', 1, '2014-12-18 22:51:51', '2014-12-18 22:50:08'),
(10258, 10004, NULL, '4564567456', '1cac981fb61dc0e4a41e6a8508552803', '::1', 1, '2014-12-18 22:58:21', '2014-12-18 22:52:04'),
(10259, 10003, NULL, '1231234123', '04766957db82a24eaa3006fb015798ba', '::1', 1, '2014-12-18 23:07:17', '2014-12-18 22:58:31'),
(10260, 10004, NULL, NULL, 'b8213dd6cdc0bfb7d1ca745b9aaf2ba2', '::1', 0, '2014-12-18 23:08:50', '2014-12-18 23:08:50'),
(10261, 10003, NULL, NULL, '11cacfed4035ede9cfdc45762d47a8bf', '::1', 0, '2014-12-19 04:05:08', '2014-12-18 23:38:12'),
(10262, 10004, NULL, '6131234567', '09aa223930043d41701befd2405be618', '::1', 1, '2014-12-20 04:33:54', '2014-12-19 20:51:21'),
(10263, 10004, NULL, NULL, '824a1dc7b4d566aeb78f866d278dbc7c', '::1', 0, '2014-12-20 19:23:41', '2014-12-20 19:23:41'),
(10264, 10004, NULL, '2011231234', '4452a20b72619243841d5680730ca02d', '::1', 1, '2014-12-20 20:01:30', '2014-12-20 20:01:13'),
(10265, 10004, NULL, '1231234123', '1fe6ebbd7d718fc2a8010756ede5ce8a', '::1', 1, '2014-12-20 20:23:44', '2014-12-20 20:02:43'),
(10266, 10004, NULL, NULL, 'ba69c18752ba976646ab3002adf2a116', '::1', 0, '2014-12-20 20:25:49', '2014-12-20 20:25:49'),
(10267, 10003, NULL, '1231234123', 'bf7110437fd3cbfb253cd18639ae1bb9', '::1', 1, '2014-12-20 22:25:27', '2014-12-20 22:24:56'),
(10268, 10004, NULL, '1231234123', '2ce272dd812dea3da5ce76a469b6004a', '::1', 1, '2014-12-20 22:33:59', '2014-12-20 22:26:21'),
(10269, 10003, NULL, NULL, '3eef94f1f66ae5df2419fe66ad1cc23a', '::1', 0, '2014-12-21 04:16:58', '2014-12-21 04:16:58'),
(10270, 10004, NULL, NULL, '70e177868d7bc383ce3ea10b6f976ada', '::1', 0, '2014-12-21 04:30:46', '2014-12-21 04:25:00'),
(10271, 10002, NULL, NULL, '296a4a440e3b55ea2556f652bb30dc98', '::1', 0, '2014-12-21 04:35:06', '2014-12-21 04:31:00'),
(10277, NULL, NULL, '1234567891', '', NULL, NULL, '2014-12-21 06:53:23', '0000-00-00 00:00:00'),
(10279, NULL, 10151, '6134130633', '', NULL, NULL, '2014-12-21 06:57:11', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `vipcard`
--

CREATE TABLE IF NOT EXISTS `vipcard` (
  `vipid` int(5) NOT NULL AUTO_INCREMENT,
  `vnumber` int(4) NOT NULL,
  `vpassword` varchar(128) NOT NULL,
  `vbalance` float NOT NULL,
  PRIMARY KEY (`vipid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10152 ;

--
-- Dumping data for table `vipcard`
--

INSERT INTO `vipcard` (`vipid`, `vnumber`, `vpassword`, `vbalance`) VALUES
(10141, 4975, '912ec803b2ce49e4a541068d495ab570', 150),
(10142, 9646, '962012d09b8170d912f0669f6d7d9d07', 111.04),
(10151, 8923, 'd432eb18017c004fd305969713a17aa8', 150);

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
  ADD CONSTRAINT `uservipid` FOREIGN KEY (`vipid`) REFERENCES `vipcard` (`vipid`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `usercid` FOREIGN KEY (`cid`) REFERENCES `campus` (`cid`) ON DELETE SET NULL;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
