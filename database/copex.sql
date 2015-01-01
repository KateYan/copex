-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 01, 2015 at 09:54 PM
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
('user_order_start', '13:00:00'),
('user_pickup_end', '13:30:00'),
('user_pickup_start', '11:30:00'),
('vip_order_end', '06:00:00'),
('vip_order_start', '13:00:00'),
('vip_pickup_end', '13:30:00'),
('vip_pickup_start', '11:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `campus`
--

CREATE TABLE IF NOT EXISTS `campus` (
  `cid` int(5) NOT NULL AUTO_INCREMENT,
  `cname` varchar(20) NOT NULL,
  `caddr` varchar(30) NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10012 ;

--
-- Dumping data for table `campus`
--

INSERT INTO `campus` (`cid`, `cname`, `caddr`) VALUES
(10001, 'UTSC', '312 King Street'),
(10002, 'UTM', '789 Queen ');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10020 ;

--
-- Dumping data for table `coperationline`
--

INSERT INTO `coperationline` (`lineid`, `cid`, `did`) VALUES
(10009, 10001, 10001),
(10004, 10001, 10002),
(10012, 10001, 10003),
(10010, 10001, 10004),
(10007, 10001, 10005),
(10013, 10002, 10003),
(10011, 10002, 10004),
(10008, 10002, 10005);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10023 ;

--
-- Dumping data for table `dailymenu`
--

INSERT INTO `dailymenu` (`mid`, `cid`, `mdate`, `mstatus`) VALUES
(10005, 10001, '2014-12-09', 0),
(10006, 10002, '2014-12-09', 1),
(10011, NULL, '2014-12-09', 1),
(10012, NULL, '2014-12-09', 1),
(10013, 10001, '2014-12-24', 0),
(10014, 10002, '2014-12-24', 0),
(10015, NULL, '2014-12-24', 0),
(10016, NULL, '2014-12-24', 0),
(10022, 10001, '2014-12-28', 1);

-- --------------------------------------------------------

--
-- Table structure for table `diner`
--

CREATE TABLE IF NOT EXISTS `diner` (
  `did` int(5) NOT NULL AUTO_INCREMENT,
  `dname` varchar(30) NOT NULL,
  `contact` varchar(30) DEFAULT NULL,
  `dphone` varchar(20) DEFAULT NULL,
  `demail` varchar(25) NOT NULL,
  `daddr` varchar(30) NOT NULL,
  `dinfo` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`did`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10006 ;

--
-- Dumping data for table `diner`
--

INSERT INTO `diner` (`did`, `dname`, `contact`, `dphone`, `demail`, `daddr`, `dinfo`) VALUES
(10001, 'T&T', '', '6473106789', 'tt123@gmail.com', '123 bay street', ''),
(10002, 'benben resturaunt', NULL, '6471234567', 'benben@hotmail.com', '', ''),
(10003, 'UTSG餐厅', NULL, NULL, 'utsg@gmail.com', '', ''),
(10004, 'YouK餐厅', '王女士', '6479876541', 'youk@gmail.com', '57 Onion Road', ''),
(10005, '羊城小馆', '王先生', '9876543211', 'asdghdfiu@gmail.com', '610 bay street', '');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10058 ;

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
(10042, 10008, 10006, 0),
(10055, 10005, 10022, 1),
(10056, 10002, 10022, 0),
(10057, 10006, 10022, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2753651 ;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`oid`, `uid`, `cid`, `odate`, `fordate`, `ostatus`, `oispaid`, `tax`, `totalcost`) VALUES
(2753623, 10257, 10002, '2014-12-18 17:50:17', '2014-12-19', 1, 1, 1.3, 11.29),
(2753634, 10185, 10002, '2014-12-20 14:28:07', '2014-12-21', 0, 1, 2.08, 18.06),
(2753640, 10272, 10001, '2014-12-20 23:35:24', '2014-12-21', 0, 0, 0.91, 7.9),
(2753645, 10185, 10002, '2014-12-30 02:21:15', '2014-12-30', 0, 1, 1.3, 11.29),
(2753646, 10185, 10002, '2014-12-30 15:24:07', '2014-12-31', 0, 1, 3.82, 33.19),
(2753647, 10185, 10002, '2014-12-30 15:24:30', '2014-12-31', 0, 1, 5.25, 45.61),
(2753648, 10290, 10002, '2014-12-30 15:30:08', '2014-12-31', 0, 0, 1.52, 13.21),
(2753649, 10185, 10002, '2014-12-30 17:33:17', '2014-12-31', 0, 1, 2.21, 19.19),
(2753650, 10292, 10002, '2014-12-31 14:21:17', '2015-01-01', 0, 0, 1.3, 11.29);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10366 ;

--
-- Dumping data for table `orderitem`
--

INSERT INTO `orderitem` (`oitemid`, `oid`, `dishid`, `dishtype`) VALUES
(10315, 2753623, 10004, 0),
(10342, 2753634, 10007, 0),
(10343, 2753634, 50004, 1),
(10349, 2753640, 10003, 0),
(10354, 2753645, 10007, 0),
(10355, 2753646, 10008, 0),
(10356, 2753646, 10008, 0),
(10357, 2753646, 50004, 1),
(10358, 2753647, 10007, 0),
(10359, 2753647, 10008, 0),
(10360, 2753647, 10008, 0),
(10361, 2753647, 50001, 1),
(10362, 2753648, 10008, 0),
(10363, 2753649, 10004, 0),
(10364, 2753649, 50003, 1),
(10365, 2753650, 10004, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10010 ;

--
-- Dumping data for table `sidemenu`
--

INSERT INTO `sidemenu` (`sideMenuID`, `cid`, `sideMenuDate`, `sideMenuStatus`) VALUES
(10001, 10001, '2014-12-06', 0),
(10002, 10002, '2014-12-06', 1),
(10004, NULL, '2014-12-06', 1),
(10005, NULL, '2014-12-06', 1),
(10009, 10001, '2014-12-28', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `sidemenuitem`
--

INSERT INTO `sidemenuitem` (`sideItemID`, `sid`, `sideMenuID`) VALUES
(9, 50001, 10001),
(15, 50001, 10002),
(1, 50001, 10004),
(6, 50001, 10005),
(21, 50001, 10009),
(10, 50002, 10001),
(13, 50002, 10002),
(2, 50002, 10004),
(5, 50002, 10005),
(22, 50002, 10009),
(11, 50003, 10001),
(14, 50003, 10002),
(3, 50003, 10004),
(7, 50003, 10005),
(23, 50003, 10009),
(12, 50004, 10001),
(16, 50004, 10002),
(4, 50004, 10004),
(8, 50004, 10005),
(24, 50004, 10009);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10294 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `cid`, `vipid`, `uphone`, `uhash`, `ip`, `ordered`, `last_login`, `created`) VALUES
(10184, NULL, 10141, '6471234567', 'c39eb1e187b03d280bb82a422622e1d5f322d5415ea0a8e053ea78cb2e0c11b8', '::1', 1, '2014-12-12 21:06:58', '2014-12-10 03:29:29'),
(10185, 10002, 10142, '6131231234', '208795b584c83f3bae579f721868d1cbd4884783362387f95f50e35f810a3f50', '::1', 1, '2014-12-31 06:21:37', '2014-12-20 04:38:21'),
(10256, NULL, NULL, '1231234123', '38f31bfacb6f2fddbd10ade8b55e2f6f', '::1', 1, '2014-12-18 21:57:58', '2014-12-18 21:57:48'),
(10257, 10002, NULL, '6134564567', '9dec88b3772c35708f47db386b2f487e', '::1', 1, '2014-12-18 22:51:51', '2014-12-18 22:50:08'),
(10258, NULL, NULL, '4564567456', '1cac981fb61dc0e4a41e6a8508552803', '::1', 1, '2014-12-18 22:58:21', '2014-12-18 22:52:04'),
(10259, NULL, NULL, '1231234123', '04766957db82a24eaa3006fb015798ba', '::1', 1, '2014-12-18 23:07:17', '2014-12-18 22:58:31'),
(10262, NULL, NULL, '6131234567', '09aa223930043d41701befd2405be618', '::1', 1, '2014-12-20 04:33:54', '2014-12-19 20:51:21'),
(10264, NULL, NULL, '2011231234', '4452a20b72619243841d5680730ca02d', '::1', 1, '2014-12-20 20:01:30', '2014-12-20 20:01:13'),
(10265, NULL, NULL, '1231234123', '1fe6ebbd7d718fc2a8010756ede5ce8a', '::1', 1, '2014-12-20 20:23:44', '2014-12-20 20:02:43'),
(10267, NULL, NULL, '1231234123', 'bf7110437fd3cbfb253cd18639ae1bb9', '::1', 1, '2014-12-20 22:25:27', '2014-12-20 22:24:56'),
(10268, NULL, NULL, '1231234123', '2ce272dd812dea3da5ce76a469b6004a', '::1', 1, '2014-12-20 22:33:59', '2014-12-20 22:26:21'),
(10281, 10001, NULL, NULL, '6d48ab89d5f164e8291b973b6c73fe0e', '::1', 0, '2014-12-28 23:04:14', '2014-12-28 23:03:58'),
(10282, NULL, NULL, NULL, 'bcd9ecdada91ad9da498b58877cc8f18', '::1', 0, '2014-12-28 23:04:56', '2014-12-28 23:04:56'),
(10283, 10002, NULL, NULL, '788b0a20be8b1f7214e3c6960ae796a5', '::1', 0, '2014-12-30 07:19:50', '2014-12-30 07:19:50'),
(10286, NULL, NULL, '9638521741', '', NULL, NULL, '2014-12-30 15:10:43', '0000-00-00 00:00:00'),
(10287, NULL, NULL, '1234567896', '495872fb664ccc1391a6b44e21f290ae', NULL, NULL, '2014-12-30 15:21:53', '2014-12-30 15:21:53'),
(10289, 10002, NULL, NULL, '775bc655c77d679c193f1982dac04668', '::1', 0, '2014-12-30 19:19:51', '2014-12-30 19:19:51'),
(10290, 10002, NULL, '7539514568', 'ce877939e3b892254bb24a6ce7c03620', '::1', 1, '2014-12-30 22:32:55', '2014-12-30 20:29:58'),
(10291, NULL, 10156, '1231234123', '97db59e30c8008f13ce9219a1a84e33a', NULL, 0, '2014-12-31 15:48:55', '2014-12-31 15:48:55'),
(10292, 10002, NULL, '1231234123', '59ddf60f6efb7a194b24a392215fb222', '::1', 1, '2014-12-31 19:21:20', '2014-12-31 19:20:58'),
(10293, NULL, 10159, '1234567892', '3cdb82a314eeef6d77aa4cbacb7280dd', NULL, 0, '2015-01-01 20:48:46', '2015-01-01 20:48:46');

-- --------------------------------------------------------

--
-- Table structure for table `vipcard`
--

CREATE TABLE IF NOT EXISTS `vipcard` (
  `vipid` int(5) NOT NULL AUTO_INCREMENT,
  `vnumber` int(4) NOT NULL,
  `vpassword` varchar(128) NOT NULL,
  `vbalance` float NOT NULL,
  PRIMARY KEY (`vipid`),
  UNIQUE KEY `vnumber` (`vnumber`),
  UNIQUE KEY `vnumber_2` (`vnumber`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10160 ;

--
-- Dumping data for table `vipcard`
--

INSERT INTO `vipcard` (`vipid`, `vnumber`, `vpassword`, `vbalance`) VALUES
(10141, 4975, '912ec803b2ce49e4a541068d495ab570', 150),
(10142, 9646, '962012d09b8170d912f0669f6d7d9d07', 1.76),
(10151, 8923, 'd432eb18017c004fd305969713a17aa8', 150),
(10153, 4565, 'a152e841783914146e4bcd4f39100686', 50),
(10155, 5693, 'a152e841783914146e4bcd4f39100686', 50),
(10156, 1234, 'e10adc3949ba59abbe56e057f20f883e', 50),
(10159, 4569, 'e10adc3949ba59abbe56e057f20f883e', 50);

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
  ADD CONSTRAINT `usercid` FOREIGN KEY (`cid`) REFERENCES `campus` (`cid`) ON DELETE SET NULL,
  ADD CONSTRAINT `uservipid` FOREIGN KEY (`vipid`) REFERENCES `vipcard` (`vipid`) ON DELETE SET NULL ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
