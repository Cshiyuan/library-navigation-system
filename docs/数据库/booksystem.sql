-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-10-10 17:41:50
-- 服务器版本： 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `booksystem`
--

-- --------------------------------------------------------

--
-- 表的结构 `app`
--

CREATE TABLE IF NOT EXISTS `app` (
  `id` smallint(4) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `name` varchar(10) DEFAULT NULL COMMENT 'APP类型名称  如 ： 安卓手机',
  `is_encryption` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否加密 1加密 0不加密',
  `key` varchar(20) NOT NULL DEFAULT '0' COMMENT '加密key',
  `image_size` text COMMENT '按json_encode存储',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态 1正常 0删除',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `app`
--

INSERT INTO `app` (`id`, `name`, `is_encryption`, `key`, `image_size`, `create_time`, `update_time`, `status`) VALUES
(1, '安卓pad', 0, '0', NULL, 0, 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `bs_administrator`
--

CREATE TABLE IF NOT EXISTS `bs_administrator` (
  `workID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(20) CHARACTER SET utf8 NOT NULL,
  `password` varchar(32) CHARACTER SET utf8 NOT NULL,
  `telephone` varchar(20) CHARACTER SET utf8 NOT NULL,
  `email` varchar(20) CHARACTER SET utf8 NOT NULL,
  `last_ip` char(15) CHARACTER SET utf8 NOT NULL,
  `last_date` int(10) NOT NULL,
  `login_num` smallint(5) NOT NULL DEFAULT '1',
  `regdate` int(11) NOT NULL,
  PRIMARY KEY (`workID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `bs_administrator`
--

INSERT INTO `bs_administrator` (`workID`, `admin_name`, `password`, `telephone`, `email`, `last_ip`, `last_date`, `login_num`, `regdate`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '13632871619', '826718591@qq.com', '0.0.0.0', 1474971219, 43, 1470238204),
(2, 'admin11', 'e020590f0e18cd6053d7ae0e0a507609', '13632871111', '826718511@qq.com', '0.0.0.0', 1470487616, 2, 1470487578);

-- --------------------------------------------------------

--
-- 表的结构 `bs_book`
--

CREATE TABLE IF NOT EXISTS `bs_book` (
  `book_ID` int(20) NOT NULL AUTO_INCREMENT,
  `book_name` varchar(50) NOT NULL,
  `slf_name` varchar(20) DEFAULT NULL,
  `author` varchar(20) DEFAULT NULL,
  `pub_house` varchar(20) DEFAULT NULL,
  `search_time` int(20) DEFAULT NULL,
  `cover` varchar(32) DEFAULT NULL COMMENT '书籍封面',
  `pos` varchar(50) DEFAULT NULL,
  `is_onslf` varchar(2) DEFAULT '0' COMMENT '是否在架',
  PRIMARY KEY (`book_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- 转存表中的数据 `bs_book`
--

INSERT INTO `bs_book` (`book_ID`, `book_name`, `slf_name`, `author`, `pub_house`, `search_time`, `cover`, `pos`, `is_onslf`) VALUES
(2, '数据结构', NULL, NULL, NULL, NULL, NULL, NULL, '1'),
(3, '算法分析与设计', NULL, NULL, NULL, NULL, NULL, NULL, '1'),
(4, '高等数学', 'Test', 'Test', 'Test', NULL, NULL, NULL, '1'),
(7, '概率论', 'F2048', 'Test', 'Test4386534563', NULL, NULL, NULL, '0'),
(10, '数学1', 'F2045', 'Test', 'Test', NULL, NULL, NULL, '1');

-- --------------------------------------------------------

--
-- 表的结构 `version_upgrade`
--

CREATE TABLE IF NOT EXISTS `version_upgrade` (
  `id` smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  `app_id` smallint(4) unsigned NOT NULL DEFAULT '0' COMMENT '客户端设备id 1安卓pad 2安卓手机 3ios手机 4iospad',
  `version_id` smallint(4) unsigned DEFAULT '0' COMMENT '大版本号id',
  `version_mini` mediumint(8) unsigned DEFAULT '0' COMMENT '小版本号',
  `version_code` varchar(10) DEFAULT NULL COMMENT '版本标识 1.2',
  `type` tinyint(2) unsigned DEFAULT NULL COMMENT '是否升级  1升级，0不升级，2强制升级',
  `apk_url` varchar(255) DEFAULT NULL,
  `upgrade_point` varchar(255) DEFAULT NULL COMMENT '升级提示',
  `status` tinyint(2) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `version_upgrade`
--

INSERT INTO `version_upgrade` (`id`, `app_id`, `version_id`, `version_mini`, `version_code`, `type`, `apk_url`, `upgrade_point`, `status`, `create_time`, `update_time`) VALUES
(1, 1, 2, 1, '2.1', 1, 'http://hhahah.com', '有新功能，快来升级', 1, NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
