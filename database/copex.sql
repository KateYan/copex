-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2014 at 12:57 AM
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
  `timestart` time NOT NULL,
  `timeend` time NOT NULL,
  `date` date NOT NULL,
  `risvip` tinyint(1) NOT NULL,
  PRIMARY KEY (`ruleid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
(10001, 'UTSC', ''),
(10002, 'UTM', ''),
(10003, 'UTSG', ''),
(10004, 'YouK', '');

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
(10001, 10001, '2014-12-03', 1),
(10002, 10002, '2014-12-03', 1),
(10003, 10003, '2014-12-03', 1),
(10004, 10004, '2014-12-03', 1),
(10005, 10001, '2014-12-07', 1),
(10006, 10002, '2014-12-07', 1),
(10007, 10001, '2014-12-05', 1),
(10008, 10002, '2014-12-05', 1),
(10009, 10003, '2014-12-05', 1),
(10010, 10004, '2014-12-05', 1),
(10011, 10003, '2014-12-07', 1),
(10012, 10004, '2014-12-07', 1);

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
  `oid` int(5) NOT NULL AUTO_INCREMENT,
  `uid` int(5) DEFAULT NULL,
  `odate` date NOT NULL,
  `ostatus` tinyint(1) NOT NULL,
  `oispaid` tinyint(1) NOT NULL,
  `totalcost` float DEFAULT NULL,
  PRIMARY KEY (`oid`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10025 ;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`oid`, `uid`, `odate`, `ostatus`, `oispaid`, `totalcost`) VALUES
(10001, 10001, '2014-11-30', 1, 1, 43.98),
(10002, 10168, '2014-12-07', 0, 0, 0),
(10003, 10168, '2014-12-07', 0, 0, 0),
(10004, 10168, '2014-12-07', 0, 0, 0),
(10005, 10168, '2014-12-07', 0, 0, 0),
(10006, 10168, '2014-12-07', 0, 0, 0),
(10007, 10168, '2014-12-07', 0, 0, 0),
(10008, 10168, '2014-12-07', 0, 0, NULL),
(10009, 10168, '2014-12-07', 0, 0, NULL),
(10010, 10168, '2014-12-07', 0, 0, NULL),
(10011, 10168, '2014-12-07', 0, 0, NULL),
(10012, 10168, '2014-12-07', 0, 0, NULL),
(10013, 10168, '2014-12-07', 0, 0, NULL),
(10014, 10168, '2014-12-07', 0, 0, NULL),
(10015, 10168, '2014-12-07', 0, 0, NULL),
(10016, 10168, '2014-12-07', 0, 0, NULL),
(10017, 0, '0000-00-00', 0, 0, NULL),
(10018, 10168, '2014-12-07', 0, 0, NULL),
(10019, 0, '0000-00-00', 0, 0, NULL),
(10020, 10168, '2014-12-07', 0, 0, NULL),
(10021, 0, '0000-00-00', 0, 0, NULL),
(10022, 10169, '2014-12-07', 0, 0, NULL),
(10023, 0, '0000-00-00', 0, 0, NULL),
(10024, 10169, '2014-12-07', 0, 0, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10018 ;

--
-- Dumping data for table `orderitem`
--

INSERT INTO `orderitem` (`oitemid`, `oid`, `dishid`, `dishtype`) VALUES
(10009, 10011, 10004, 0),
(10010, 10012, 10004, 0),
(10011, 10013, 10004, 0),
(10012, 10014, 10004, 0),
(10013, 10015, 10004, 0),
(10014, 10016, 10004, 0),
(10015, 10020, 10004, 0),
(10016, 10022, 10004, 0),
(10017, 10024, 10003, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10170 ;

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
(10169, 10004, NULL, NULL, 'ac5d499580e05f70dc2d6e1ef4d970b8e1502b8468a3a17ed1f5eab02f5a00dd', '::1', 0, '2014-12-07 23:56:02', NULL);

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
