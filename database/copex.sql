-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 10, 2015 at 05:52 AM
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10003 ;

--
-- Dumping data for table `campus`
--

INSERT INTO `campus` (`cid`, `cname`, `caddr`) VALUES
(10001, 'UTSC', 'Market Place'),
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10024 ;

--
-- Dumping data for table `coperationline`
--

INSERT INTO `coperationline` (`lineid`, `cid`, `did`) VALUES
(10009, 10001, 10001),
(10004, 10001, 10002),
(10012, 10001, 10003),
(10010, 10001, 10004),
(10007, 10001, 10005),
(10020, 10001, 10006),
(10021, 10001, 10007),
(10022, 10001, 10008),
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10009 ;

--
-- Dumping data for table `dailymenu`
--

INSERT INTO `dailymenu` (`mid`, `cid`, `mdate`, `mstatus`) VALUES
(10005, 10001, '2014-12-09', 0),
(10006, 10002, '2014-12-09', 0),
(10007, 10001, '2015-01-09', 1),
(10008, 10002, '2015-01-09', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10012 ;

--
-- Dumping data for table `diner`
--

INSERT INTO `diner` (`did`, `dname`, `contact`, `dphone`, `demail`, `daddr`, `dinfo`) VALUES
(10001, '风味小厨', '', '6473106789', 'tt123@gmail.com', '123 bay street', ''),
(10002, '小渔村', '', '6471234567', 'benben@hotmail.com', '123 bay street', ''),
(10003, '西北楼', '', '6474564567', 'utsg@gmail.com', '123 bay street', ''),
(10004, '刘厨房', '王女士', '6479876541', 'youk@gmail.com', '57 Onion Road', ''),
(10005, '台味轩', '王先生', '9876543211', 'asdghdfiu@gmail.com', '610 bay street', ''),
(10006, '雨晴', '', '6471231234', 'asdf@yahoo.com', '123 bay street', ''),
(10007, '乐活', '', '6471234567', 'asdfasdf@gmail.com', '123 bay street', ''),
(10008, '老房子', '', '6477894564', 'asdfqwe@gmail.com', '123 bay street', '');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10011 ;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`fid`, `did`, `fname`, `fdes`, `fprice`, `fpicture`) VALUES
(10001, 10006, '酥肉扣碗', '', 6.95, 'surou.jpg'),
(10002, 10002, '藕片黑椒牛肉', '', 6.95, 'oupianheijiaoniu.jpg'),
(10003, 10002, '麻辣香锅', '', 8.85, 'malazonghexiangguo.jpg'),
(10004, 10002, '高丽菜豆瓣鱼', '', 6.95, 'gaolidoubanyu.jpg'),
(10005, 10002, '爆炒回锅肉', '', 6.95, 'huiguorou.jpg'),
(10006, 10002, '尖椒鸡丁', '', 6.95, 'jianjiaojiding.jpg'),
(10007, 10003, '新疆大盘鸡', '', 9.96, 'dapanji.jpg'),
(10008, 10001, '萝卜炖软骨', '', 8.85, 'luobodunruangu.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `menuitem`
--

CREATE TABLE IF NOT EXISTS `menuitem` (
  `mitemid` int(5) NOT NULL AUTO_INCREMENT,
  `fid` int(5) DEFAULT NULL,
  `mid` int(5) NOT NULL,
  `isrecomd` tinyint(4) NOT NULL COMMENT 'recommend or not',
  `minventory` int(3) DEFAULT NULL,
  PRIMARY KEY (`mitemid`),
  KEY `fid` (`fid`,`mid`),
  KEY `mid` (`mid`),
  KEY `mid_2` (`mid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10049 ;

--
-- Dumping data for table `menuitem`
--

INSERT INTO `menuitem` (`mitemid`, `fid`, `mid`, `isrecomd`, `minventory`) VALUES
(10037, 10001, 10005, 1, 9),
(10038, 10003, 10005, 0, 8),
(10039, 10002, 10005, 0, 10),
(10040, 10004, 10006, 1, 48),
(10041, 10007, 10006, 0, 48),
(10042, 10008, 10006, 0, 50),
(10043, 10003, 10007, 1, 50),
(10044, 10005, 10007, 0, 50),
(10045, 10006, 10007, 0, 49),
(10046, 10007, 10008, 1, NULL),
(10047, 10006, 10008, 0, NULL),
(10048, 10008, 10008, 0, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2753675 ;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`oid`, `uid`, `cid`, `odate`, `fordate`, `ostatus`, `oispaid`, `tax`, `totalcost`) VALUES
(2753665, 10185, 10001, '2015-01-04 19:08:19', '2015-01-05', 1, 1, 9.3, 80.85),
(2753666, 10300, 10002, '2015-01-04 19:08:59', '2015-01-05', 0, 0, 1.3, 11.29),
(2753667, 10185, 10001, '2015-01-05 20:00:41', '2015-01-06', 1, 1, 4.01, 34.85),
(2753668, 10185, 10001, '2015-01-06 15:08:22', '2015-01-07', 1, 1, 5.69, 49.47),
(2753669, 10185, 10002, '2015-01-06 15:08:48', '2015-01-07', 0, 1, 3.51, 30.48),
(2753670, 10185, 10001, '2015-01-06 22:26:25', '2015-01-07', 1, 1, 4.52, 39.31),
(2753671, 10185, 10001, '2015-01-08 20:17:48', '2015-01-09', 0, 1, 4.4, 38.24),
(2753672, 10303, 10001, '2015-01-08 20:19:16', '2015-01-09', 0, 0, 0.9, 7.85),
(2753673, 10185, 10001, '2015-01-08 20:20:50', '2015-01-09', 0, 1, 2.72, 23.61),
(2753674, 10185, 10001, '2015-01-09 17:10:41', '2015-01-10', 0, 1, 2.73, 23.71);

-- --------------------------------------------------------

--
-- Table structure for table `orderitem`
--

CREATE TABLE IF NOT EXISTS `orderitem` (
  `oitemid` int(5) NOT NULL AUTO_INCREMENT,
  `amount` int(11) NOT NULL,
  `oid` int(5) NOT NULL,
  `dishid` int(5) NOT NULL,
  `price` float NOT NULL,
  `dishtype` tinyint(1) NOT NULL,
  PRIMARY KEY (`oitemid`),
  KEY `oid` (`oid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10427 ;

--
-- Dumping data for table `orderitem`
--

INSERT INTO `orderitem` (`oitemid`, `amount`, `oid`, `dishid`, `price`, `dishtype`) VALUES
(10401, 3, 2753665, 10001, 9.95, 0),
(10402, 3, 2753665, 10003, 6.95, 0),
(10403, 3, 2753665, 10002, 6.95, 0),
(10404, 1, 2753666, 10007, 9.99, 0),
(10405, 1, 2753667, 10001, 9.95, 0),
(10406, 1, 2753667, 10003, 6.95, 0),
(10407, 1, 2753667, 10002, 6.95, 0),
(10408, 1, 2753667, 50003, 6.99, 1),
(10409, 1, 2753668, 10001, 9.95, 0),
(10410, 1, 2753668, 10003, 6.95, 0),
(10411, 2, 2753668, 10002, 6.95, 0),
(10412, 1, 2753668, 50003, 6.99, 1),
(10413, 1, 2753668, 50004, 5.99, 1),
(10414, 2, 2753669, 10004, 9.99, 0),
(10415, 1, 2753669, 50002, 6.99, 1),
(10416, 2, 2753670, 10003, 6.95, 0),
(10417, 2, 2753670, 10002, 6.95, 0),
(10418, 1, 2753670, 50002, 6.99, 1),
(10419, 2, 2753671, 10001, 9.95, 0),
(10420, 1, 2753671, 10003, 6.95, 0),
(10421, 1, 2753671, 50003, 6.99, 1),
(10422, 1, 2753672, 10002, 6.95, 0),
(10423, 2, 2753673, 10003, 6.95, 0),
(10424, 1, 2753673, 50001, 6.99, 1),
(10425, 1, 2753674, 10006, 14.99, 0),
(10426, 1, 2753674, 50004, 5.99, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=50007 ;

--
-- Dumping data for table `sidedish`
--

INSERT INTO `sidedish` (`sid`, `did`, `sname`, `sdes`, `sprice`, `spicture`) VALUES
(50001, 10002, '可口可乐', '', 1.79, 'coke.jpg'),
(50002, 10002, '健怡可乐', '', 1.79, 'dietcoke.jpg'),
(50003, 10002, '冰茶', '', 1.79, 'icetea.jpg'),
(50004, 10004, '辣卤牛肉', '', 5.99, 'laluniurou.jpg');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10011 ;

--
-- Dumping data for table `sidemenu`
--

INSERT INTO `sidemenu` (`sideMenuID`, `cid`, `sideMenuDate`, `sideMenuStatus`) VALUES
(10002, 10002, '2014-12-06', 1),
(10009, 10001, '2014-12-28', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sidemenuitem`
--

CREATE TABLE IF NOT EXISTS `sidemenuitem` (
  `sideItemID` int(5) NOT NULL AUTO_INCREMENT,
  `sid` int(5) DEFAULT NULL,
  `sideMenuID` int(5) NOT NULL,
  `sinventory` int(3) DEFAULT NULL,
  PRIMARY KEY (`sideItemID`),
  KEY `sid` (`sid`,`sideMenuID`),
  KEY `mid` (`sideMenuID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `sidemenuitem`
--

INSERT INTO `sidemenuitem` (`sideItemID`, `sid`, `sideMenuID`, `sinventory`) VALUES
(13, 50002, 10002, 49),
(14, 50003, 10002, 50),
(15, 50001, 10002, 50),
(16, 50004, 10002, 50),
(21, 50001, 10009, 48),
(22, 50002, 10009, 45),
(23, 50003, 10009, 45),
(24, 50004, 10009, 45);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10304 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `cid`, `vipid`, `uphone`, `uhash`, `ip`, `ordered`, `last_login`, `created`) VALUES
(10185, 10001, 10142, '6131231234', '208795b584c83f3bae579f721868d1cbd4884783362387f95f50e35f810a3f50', '::1', 1, '2015-01-10 00:10:28', '2014-12-20 04:38:21'),
(10298, 10002, NULL, '1231234123', '474411562182ddb5617d587f97c901c4', '::1', 1, '2015-01-03 19:39:03', '2015-01-03 19:15:55'),
(10299, 10001, NULL, '1234567893', 'cde8e1a7e5b11006d7f1930ce63e9462', '::1', 1, '2015-01-04 04:49:55', '2015-01-03 20:55:52'),
(10300, 10002, NULL, '6131231234', '05d1131727e33e10ec7195aa77f6090e', '::1', 1, '2015-01-05 00:09:09', '2015-01-05 00:08:52'),
(10301, 10002, NULL, NULL, '20f16dbde9f389fb902074b9a48881a3', '::1', 0, '2015-01-07 15:44:08', '2015-01-07 15:43:06'),
(10302, 10001, NULL, NULL, 'e089cde0cb1dba5629577807517594e5', '::1', 0, '2015-01-08 15:17:52', '2015-01-07 15:49:52'),
(10303, 10001, NULL, '1231231234', 'dfb3863762a64ef643d5c9ed51e60d2c', '::1', 1, '2015-01-09 01:19:19', '2015-01-09 01:18:45');

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
(10142, 9646, 'a152e841783914146e4bcd4f39100686', 95.18),
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
