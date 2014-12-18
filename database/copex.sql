-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2014 at 03:41 AM
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

use copex;

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
  `odate` datetime NOT NULL,
  `ostatus` tinyint(1) DEFAULT '0',
  `oispaid` tinyint(1) DEFAULT '0',
  `totalcost` float DEFAULT '0',
  PRIMARY KEY (`oid`),
  KEY `uid` (`uid`),
  KEY `cid` (`cid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2753615 ;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`oid`, `uid`, `cid`, `odate`, `ostatus`, `oispaid`, `totalcost`) VALUES
(2753594, 10237, 10004, '2014-12-17 00:00:00', 0, 0, 9.99),
(2753595, 10241, 10004, '2014-12-17 00:00:00', 0, 0, 9.99),
(2753596, 10242, 10004, '2014-12-17 00:00:00', 0, 0, 9.99),
(2753597, 10242, 10004, '2014-12-17 00:00:00', 0, 0, 14.99),
(2753598, 10242, 10004, '2014-12-17 00:00:00', 0, 0, 6.99),
(2753599, 10242, 10004, '2014-12-17 00:00:00', 0, 0, 6.99),
(2753600, 10243, 10002, '2014-12-17 00:00:00', 0, 0, 9.99),
(2753601, 10243, 10003, '2014-12-17 00:00:00', 0, 0, 12.99),
(2753602, 10243, 10003, '2014-12-17 00:00:00', 0, 0, 6.99),
(2753603, 10243, 10003, '2014-12-17 00:00:00', 0, 0, 6.99),
(2753604, 10243, 10003, '2014-12-17 00:00:00', 0, 0, 12.99),
(2753605, 10243, 10003, '2014-12-17 00:00:00', 0, 0, 6.99),
(2753606, 10243, 10003, '2014-12-17 00:00:00', 0, 0, 6.99),
(2753607, 10244, 10004, '2014-12-17 00:00:00', 0, 0, 14.99),
(2753608, 10244, 10004, '2014-12-17 00:00:00', 0, 0, 9.99),
(2753609, 10244, 10004, '2014-12-17 00:00:00', 0, 0, 9.99),
(2753610, 10245, 10003, '2014-12-17 00:00:00', 0, 0, 12.69),
(2753611, 10185, 10003, '2014-12-17 00:00:00', 0, 1, 18.98),
(2753612, 10185, 10003, '2014-12-17 00:00:00', 0, 1, 18.98),
(2753613, 10185, 10003, '2014-12-17 21:25:17', 0, 1, 31.97),
(2753614, 10249, 10003, '2014-12-17 21:30:22', 0, 0, 6.99);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10302 ;

--
-- Dumping data for table `orderitem`
--

INSERT INTO `orderitem` (`oitemid`, `oid`, `dishid`, `dishtype`) VALUES
(10277, 2753594, 10007, 0),
(10278, 2753595, 10007, 0),
(10279, 2753596, 10007, 0),
(10280, 2753597, 10006, 0),
(10281, 2753598, 10002, 0),
(10282, 2753599, 10002, 0),
(10283, 2753600, 10007, 0),
(10284, 2753601, 10009, 0),
(10285, 2753602, 10003, 0),
(10286, 2753603, 10003, 0),
(10287, 2753604, 10009, 0),
(10288, 2753605, 10003, 0),
(10289, 2753606, 10003, 0),
(10290, 2753607, 10006, 0),
(10291, 2753608, 10007, 0),
(10292, 2753609, 10007, 0),
(10293, 2753610, 10005, 0),
(10294, 2753611, 10009, 0),
(10295, 2753611, 50004, 0),
(10296, 2753612, 10009, 0),
(10297, 2753612, 50004, 0),
(10298, 2753613, 10009, 0),
(10299, 2753613, 10009, 0),
(10300, 2753613, 50004, 0),
(10301, 2753614, 10003, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10250 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `cid`, `vipid`, `uphone`, `uhash`, `ip`, `ordered`, `last_login`, `created`) VALUES
(10181, 10003, NULL, NULL, '9dff5b1b71330496432ff39cc992fa64ec35c3be581bb8f511958b52b8eb60a5', '::1', 1, '2014-12-12 21:06:58', '2014-12-09 07:11:29'),
(10182, 10004, NULL, NULL, 'e187c25df3c7f7fc821573da81d32a1b196216912ad6c4c8c597a5e1bea31421', '::1', 1, '2014-12-12 21:06:58', '2014-12-09 07:21:40'),
(10184, 10003, 10141, NULL, 'c39eb1e187b03d280bb82a422622e1d5f322d5415ea0a8e053ea78cb2e0c11b8', '::1', 1, '2014-12-12 21:06:58', '2014-12-10 03:29:29'),
(10185, 10003, 10142, '6131231234', '208795b584c83f3bae579f721868d1cbd4884783362387f95f50e35f810a3f50', '::1', 1, '2014-12-18 01:14:42', '2014-12-10 15:38:21'),
(10216, 10003, NULL, NULL, 'b841314f665bb44d5aeea2d40a193c17', '::1', 0, '2014-12-14 06:05:01', '2014-12-14 06:05:01'),
(10217, 10003, NULL, NULL, 'c12115d24bfb31afa25ae90da0d05620', '::1', 0, '2014-12-14 19:11:07', '2014-12-14 19:11:07'),
(10218, 10003, NULL, NULL, 'd749404b6d46b10202ec2fe499e538dc', '::1', 0, '2014-12-14 19:58:23', '2014-12-14 19:58:23'),
(10219, 10002, NULL, NULL, 'ba77bae42fe231d046c61ca2596e4213', '::1', 0, '2014-12-14 20:29:07', '2014-12-14 20:29:07'),
(10220, 10004, NULL, NULL, '6101b9fd73460a545f78400ed0ff2319', '::1', 0, '2014-12-14 20:44:10', '2014-12-14 20:44:10'),
(10221, 10003, NULL, NULL, '2488df38e83023b0ff8293b5fef87340', '::1', 0, '2014-12-14 20:57:07', '2014-12-14 20:57:07'),
(10222, 10002, NULL, NULL, '48feffb437c5fead9eac3fe8eca4e8f4', '::1', 0, '2014-12-14 22:37:35', '2014-12-14 22:37:35'),
(10223, 10004, NULL, NULL, 'ed8e6efad7341b8f1afbecbf35b070f9', '::1', 0, '2014-12-14 22:43:31', '2014-12-14 22:43:20'),
(10234, 10004, NULL, NULL, 'e4c072e019448100c4f7c2059729f050', '::1', 0, '2014-12-16 05:12:53', '2014-12-16 05:12:53'),
(10235, 10003, NULL, NULL, 'ea1acb5549f38021d7372b6eeb61fd05', '::1', 0, '2014-12-16 15:53:29', '2014-12-16 15:04:23'),
(10236, 10003, NULL, NULL, '1e6056272785711944eac49558205243', '::1', 0, '2014-12-17 00:08:29', '2014-12-17 00:08:29'),
(10237, 10004, NULL, NULL, '897fd9c0f53fa1d2d4cedaf50ce5b4b8', '::1', NULL, '2014-12-17 19:08:54', '2014-12-17 05:29:24'),
(10238, 10004, NULL, NULL, '0791cd7b835e1bdc3996e6689f55f66d', '::1', 0, '2014-12-17 19:27:02', '2014-12-17 19:26:21'),
(10239, 10001, NULL, NULL, 'c2636c1bac9e9f0b4681955165240396', '::1', 0, '2014-12-17 19:27:28', '2014-12-17 19:27:09'),
(10240, 10003, NULL, NULL, 'c877c4db98e634e2f1caf172f121dfa8', '::1', 0, '2014-12-17 19:27:52', '2014-12-17 19:27:46'),
(10241, 10004, NULL, '1', '2c0c63b0449c63fe70737d064f3c43bb', '::1', 1, '2014-12-17 20:05:02', '2014-12-17 19:59:31'),
(10243, 10003, NULL, '0', '11ce4c3ce3498f8b1c49e8adad14eee5', '::1', 0, '2014-12-17 20:39:53', '2014-12-17 20:32:55'),
(10244, 10004, NULL, '6131231234', '87d0df35ea2d504fa30f81e84acb8ef4', '::1', 1, '2014-12-17 21:00:16', '2014-12-17 21:06:31'),
(10245, 10003, NULL, '1231231594', '6375d77e5b6bea3ac46a02b2ebc17fe3', '::1', 1, '2014-12-17 21:38:26', '2014-12-17 21:33:45'),
(10246, 10004, NULL, NULL, 'd8b2eaef64d8c4b617aedeb3f3994754', '::1', 0, '2014-12-17 21:48:56', '2014-12-17 21:48:56'),
(10247, 10004, NULL, NULL, 'c4a924129cb0cb4d184ac8ea579fb905', '::1', 0, '2014-12-17 21:57:21', '2014-12-17 21:57:21'),
(10248, 10004, NULL, NULL, '03e17dbf92c96771d35b3271f4a49899', '::1', 0, '2014-12-18 01:05:41', '2014-12-18 00:47:16'),
(10249, 10003, NULL, '1231234123', '56de536d3a4d2dde30bcacb3745387b9', '::1', 1, '2014-12-18 02:30:14', '2014-12-18 02:30:14');

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
(10142, 10185, 9645, '912ec803b2ce49e4a541068d495ab570', 404.4);

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
