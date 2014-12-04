-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2014-12-04 02:53:50
-- 服务器版本： 5.6.17
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
-- 表的结构 `basicrule`
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
-- 表的结构 `campus`
--

CREATE TABLE IF NOT EXISTS `campus` (
  `cid` int(5) NOT NULL AUTO_INCREMENT,
  `cname` varchar(20) NOT NULL,
  `caddr` varchar(30) NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10005 ;

--
-- 转存表中的数据 `campus`
--

INSERT INTO `campus` (`cid`, `cname`, `caddr`) VALUES
(10001, 'UTSC', ''),
(10002, 'UTM', ''),
(10003, 'UTSG', ''),
(10004, 'YouK', '');

-- --------------------------------------------------------

--
-- 表的结构 `coperationline`
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
-- 转存表中的数据 `coperationline`
--

INSERT INTO `coperationline` (`lineid`, `cid`, `did`) VALUES
(10004, 10001, 10002),
(10001, 10002, 10001),
(10002, 10003, 10001),
(10006, 10003, 10002),
(10005, 10004, 10001);

-- --------------------------------------------------------

--
-- 表的结构 `dailymenu`
--

CREATE TABLE IF NOT EXISTS `dailymenu` (
  `mid` int(5) NOT NULL AUTO_INCREMENT,
  `cid` int(5) DEFAULT NULL,
  `mcreatedate` date NOT NULL,
  `mstatus` tinyint(1) NOT NULL,
  PRIMARY KEY (`mid`),
  KEY `cid` (`cid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10005 ;

--
-- 转存表中的数据 `dailymenu`
--

INSERT INTO `dailymenu` (`mid`, `cid`, `mcreatedate`, `mstatus`) VALUES
(10001, 10001, '2014-12-03', 1),
(10002, 10002, '2014-12-03', 1),
(10003, 10003, '2014-12-03', 1),
(10004, 10004, '2014-12-03', 1);

-- --------------------------------------------------------

--
-- 表的结构 `diner`
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
-- 转存表中的数据 `diner`
--

INSERT INTO `diner` (`did`, `dname`, `daddr`, `demail`, `dphone`) VALUES
(10001, 'T&T', '', 'tt123@gmail.com', '647-310-6789'),
(10002, 'benben resturaunt', '', 'benben@hotmail.com', '647-123-4567');

-- --------------------------------------------------------

--
-- 表的结构 `food`
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
-- 转存表中的数据 `food`
--

INSERT INTO `food` (`fid`, `did`, `fname`, `fdes`, `fprice`, `fpicture`) VALUES
(10001, 10001, '红烧鸭子', NULL, 19.99, 'css/images/1_04img01.jpg'),
(10002, 10002, '干锅排骨', NULL, 6.99, 'css/images/3_03img01.jpg'),
(10003, 10001, '蜜辣烤翅', NULL, 6.99, 'css/images/1_04img02.jpg'),
(10004, 10002, '清蒸鲤鱼', NULL, 9.99, 'css/images/4_03img02.jpg');

-- --------------------------------------------------------

--
-- 表的结构 `menuitem`
--

CREATE TABLE IF NOT EXISTS `menuitem` (
  `mitemid` int(5) NOT NULL AUTO_INCREMENT,
  `fid` int(5) DEFAULT NULL,
  `mid` int(5) NOT NULL,
  `isrecomd` tinyint(4) NOT NULL COMMENT 'recommend or not',
  PRIMARY KEY (`mitemid`),
  KEY `fid` (`fid`,`mid`),
  KEY `mid` (`mid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10017 ;

--
-- 转存表中的数据 `menuitem`
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
(10016, 10003, 10004, 0);

-- --------------------------------------------------------

--
-- 表的结构 `ofitem`
--

CREATE TABLE IF NOT EXISTS `ofitem` (
  `ofitemid` int(5) NOT NULL AUTO_INCREMENT,
  `oid` int(5) NOT NULL,
  `fid` int(5) DEFAULT NULL,
  `ofamount` int(2) NOT NULL,
  PRIMARY KEY (`ofitemid`),
  KEY `oid` (`oid`,`fid`),
  KEY `fid` (`fid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10009 ;

--
-- 转存表中的数据 `ofitem`
--

INSERT INTO `ofitem` (`ofitemid`, `oid`, `fid`, `ofamount`) VALUES
(10001, 10001, 10001, 1),
(10008, 10001, 10002, 2);

-- --------------------------------------------------------

--
-- 表的结构 `order`
--

CREATE TABLE IF NOT EXISTS `order` (
  `oid` int(5) NOT NULL AUTO_INCREMENT,
  `uid` int(5) DEFAULT NULL,
  `odate` date NOT NULL,
  `ostatus` tinyint(1) NOT NULL,
  `oispaid` tinyint(1) NOT NULL,
  `ocost` float NOT NULL,
  PRIMARY KEY (`oid`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10002 ;

--
-- 转存表中的数据 `order`
--

INSERT INTO `order` (`oid`, `uid`, `odate`, `ostatus`, `oispaid`, `ocost`) VALUES
(10001, 10001, '2014-11-30', 1, 1, 43.98);

-- --------------------------------------------------------

--
-- 表的结构 `osideitem`
--

CREATE TABLE IF NOT EXISTS `osideitem` (
  `osideid` int(5) NOT NULL AUTO_INCREMENT,
  `oid` int(5) NOT NULL,
  `sid` int(5) DEFAULT NULL,
  `osideamount` int(3) NOT NULL,
  PRIMARY KEY (`osideid`),
  KEY `oid` (`oid`,`sid`),
  KEY `sid` (`sid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10002 ;

--
-- 转存表中的数据 `osideitem`
--

INSERT INTO `osideitem` (`osideid`, `oid`, `sid`, `osideamount`) VALUES
(10001, 10001, 10001, 1);

-- --------------------------------------------------------

--
-- 表的结构 `sidedish`
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10004 ;

--
-- 转存表中的数据 `sidedish`
--

INSERT INTO `sidedish` (`sid`, `did`, `sname`, `sdes`, `sprice`, `spicture`) VALUES
(10001, 10001, '鱼香宫保鸡丁小份', NULL, 18, ''),
(10002, 10002, '麻辣热干面2两', NULL, 7, ''),
(10003, 10002, '鲜肉叉烧包一笼', NULL, 12, '');

-- --------------------------------------------------------

--
-- 表的结构 `user`
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10027 ;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`uid`, `cid`, `vipid`, `uphone`, `uhash`, `ip`, `ordered`, `created`, `last_login`) VALUES
(10001, 10001, 10001, '647789456', '', '', 0, '0000-00-00 00:00:00', '2014-12-03 21:25:48'),
(10002, 10001, 32716, '201-456-4567', '', '', 0, '0000-00-00 00:00:00', '2014-12-03 21:25:48'),
(10003, 10002, NULL, '453-453-1234', '', '', 0, '0000-00-00 00:00:00', '2014-12-03 21:25:48'),
(10004, 10001, NULL, '234-234-1234', '', '', 0, '0000-00-00 00:00:00', '2014-12-03 21:25:48'),
(10016, 10002, NULL, NULL, '12345', '::1', 0, '2014-12-03 21:50:59', '2014-12-03 21:50:59'),
(10023, 10001, NULL, NULL, '12345', '::1', 0, '2014-12-04 01:36:11', NULL),
(10024, 10002, NULL, NULL, '12345', '::1', 0, '2014-12-04 01:44:32', NULL),
(10025, 10004, NULL, NULL, '12345', '::1', 0, '2014-12-04 01:47:06', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `vipcard`
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
-- 转存表中的数据 `vipcard`
--

INSERT INTO `vipcard` (`vipid`, `uid`, `vnumber`, `vpassword`, `vbalance`) VALUES
(10001, 10001, 4592, 'qweqwe', 50),
(32716, 10002, 9874, 'asdfas', 50);

--
-- 限制导出的表
--

--
-- 限制表 `coperationline`
--
ALTER TABLE `coperationline`
  ADD CONSTRAINT `linecid` FOREIGN KEY (`cid`) REFERENCES `campus` (`cid`) ON DELETE CASCADE,
  ADD CONSTRAINT `linedid` FOREIGN KEY (`did`) REFERENCES `diner` (`did`) ON DELETE CASCADE;

--
-- 限制表 `dailymenu`
--
ALTER TABLE `dailymenu`
  ADD CONSTRAINT `dailymenucid` FOREIGN KEY (`cid`) REFERENCES `campus` (`cid`) ON DELETE SET NULL;

--
-- 限制表 `food`
--
ALTER TABLE `food`
  ADD CONSTRAINT `fooddid` FOREIGN KEY (`did`) REFERENCES `diner` (`did`) ON DELETE CASCADE;

--
-- 限制表 `menuitem`
--
ALTER TABLE `menuitem`
  ADD CONSTRAINT `mitemfid` FOREIGN KEY (`fid`) REFERENCES `food` (`fid`) ON DELETE SET NULL,
  ADD CONSTRAINT `mitemmid` FOREIGN KEY (`mid`) REFERENCES `dailymenu` (`mid`) ON DELETE CASCADE;

--
-- 限制表 `ofitem`
--
ALTER TABLE `ofitem`
  ADD CONSTRAINT `ofitemfid` FOREIGN KEY (`fid`) REFERENCES `food` (`fid`) ON DELETE SET NULL,
  ADD CONSTRAINT `ofitemoid` FOREIGN KEY (`oid`) REFERENCES `order` (`oid`) ON DELETE CASCADE;

--
-- 限制表 `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `orderuid` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE SET NULL;

--
-- 限制表 `osideitem`
--
ALTER TABLE `osideitem`
  ADD CONSTRAINT `osideoid` FOREIGN KEY (`oid`) REFERENCES `order` (`oid`) ON DELETE CASCADE,
  ADD CONSTRAINT `osidesid` FOREIGN KEY (`sid`) REFERENCES `sidedish` (`sid`) ON DELETE SET NULL;

--
-- 限制表 `sidedish`
--
ALTER TABLE `sidedish`
  ADD CONSTRAINT `sidedid` FOREIGN KEY (`did`) REFERENCES `diner` (`did`) ON DELETE CASCADE;

--
-- 限制表 `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `usercid` FOREIGN KEY (`cid`) REFERENCES `campus` (`cid`) ON DELETE SET NULL,
  ADD CONSTRAINT `uservipid` FOREIGN KEY (`vipid`) REFERENCES `vipcard` (`vipid`) ON DELETE SET NULL;

--
-- 限制表 `vipcard`
--
ALTER TABLE `vipcard`
  ADD CONSTRAINT `vipcarduid` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE SET NULL;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
