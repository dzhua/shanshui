-- phpMyAdmin SQL Dump
-- version 2.11.9.2
-- http://www.phpmyadmin.net
--
-- ����: 127.0.0.1:3306
-- ��������: 2015 �� 11 �� 12 �� 16:08
-- �������汾: 5.1.28
-- PHP �汾: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- ���ݿ�: `shanshui`
--

-- --------------------------------------------------------

--
-- ��Ľṹ `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(30) NOT NULL,
  `real_name` varchar(30) NOT NULL,
  `password` char(32) NOT NULL,
  `type` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- �������е����� `admin`
--


-- --------------------------------------------------------

--
-- ��Ľṹ `financing`
--

CREATE TABLE IF NOT EXISTS `financing` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `identifier` varchar(50) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `buy_start` int(11) NOT NULL,
  `buy_stop` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `lock_start` int(11) NOT NULL,
  `lock_stop` int(11) NOT NULL,
  `rate` float NOT NULL,
  `min_share` int(11) NOT NULL,
  `cover_path` varchar(150) NOT NULL,
  `introduce` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- �������е����� `financing`
--


-- --------------------------------------------------------

--
-- ��Ľṹ `notice`
--

CREATE TABLE IF NOT EXISTS `notice` (
  `id` int(11) NOT NULL,
  `category` varchar(50) NOT NULL,
  `type` int(11) NOT NULL,
  `content` text NOT NULL,
  `file_path` varchar(100) DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- �������е����� `notice`
--


-- --------------------------------------------------------

--
-- ��Ľṹ `order`
--

CREATE TABLE IF NOT EXISTS `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `identifier` varchar(50) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `obj_id` int(11) NOT NULL,
  `obj_name` varchar(100) NOT NULL,
  `order_code` varchar(50) NOT NULL,
  `price` double NOT NULL,
  `order_time` int(11) NOT NULL,
  `pay_time` int(11) NOT NULL,
  `order_status` int(11) NOT NULL,
  `pay_status` int(11) NOT NULL,
  `item_status` int(11) NOT NULL,
  `remark` varchar(500) NOT NULL,
  `status` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- �������е����� `order`
--


-- --------------------------------------------------------

--
-- ��Ľṹ `user_account`
--

CREATE TABLE IF NOT EXISTS `user_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) NOT NULL,
  `password` char(32) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- �������е����� `user_account`
--

INSERT INTO `user_account` (`id`, `user_name`, `password`, `status`, `create_time`, `update_time`) VALUES
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 1, 0, 0);

-- --------------------------------------------------------

--
-- ��Ľṹ `user_info`
--

CREATE TABLE IF NOT EXISTS `user_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) NOT NULL,
  `shop_name` varchar(50) NOT NULL,
  `service_type` int(11) NOT NULL,
  `IDnumber` varchar(50) NOT NULL,
  `linkman` varchar(50) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `fax` varchar(20) DEFAULT NULL,
  `qq` varchar(20) DEFAULT NULL,
  `city` int(11) NOT NULL,
  `area` int(11) NOT NULL,
  `district` int(11) NOT NULL,
  `address` varchar(150) NOT NULL,
  `introduction` varchar(500) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- �������е����� `user_info`
--

