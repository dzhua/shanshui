-- phpMyAdmin SQL Dump
-- version 2.11.9.2
-- http://www.phpmyadmin.net
--
-- 主机: 127.0.0.1:3306
-- 生成日期: 2015 年 11 月 15 日 15:40
-- 服务器版本: 5.1.28
-- PHP 版本: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- 数据库: `shanshui`
--

-- --------------------------------------------------------

--
-- 表的结构 `admin`
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 导出表中的数据 `admin`
--

INSERT INTO `admin` (`id`, `user_name`, `real_name`, `password`, `type`, `status`, `create_time`, `update_time`) VALUES
(1, 'admin', 'dzhua', 'e10adc3949ba59abbe56e057f20f883e', 2, 1, 1447592808, 1447592808);

-- --------------------------------------------------------

--
-- 表的结构 `financing`
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
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 导出表中的数据 `financing`
--

INSERT INTO `financing` (`id`, `identifier`, `item_name`, `buy_start`, `buy_stop`, `total`, `lock_start`, `lock_stop`, `rate`, `min_share`, `cover_path`, `introduce`, `status`, `create_time`, `update_time`) VALUES
(1, '', '项目名称', 2015, 2015, 10000, 2015, 2015, 8, 100, 'IMG_financing_UPLOAD_PATH1447481181.jpg', '<p><span class="p-order" style="margin: 0px; padding: 0px; border: 0px; outline: 0px; font-size: 16px; vertical-align: baseline; float: left; line-height: 18px; background: transparent;">1.</span></p><p class="p-english family-english size-english" style="margin: 0px 0px 3px; padding: 0px; border: 0px; outline: 0px; font-size: 16px; vertical-align: baseline; line-height: 20px; font-family: arial, sans-serif, &#39;microsoft yahei&#39;, simhei; background: transparent;">Precious few homebuyers will notice any reduction in their monthly repayments.</p><p class="p-chinese family-chinese size-chinese" style="margin: 0px 0px 3px; padding: 0px; border: 0px; outline: 0px; font-size: 14px; vertical-align: baseline; line-height: 20px; font-family: &#39;microsoft yahei&#39;, simhei, arial, sans-serif; background: transparent;">极少数购房者会注意到他们月还款额的减少。</p><p><span class="p-order" style="margin: 0px; padding: 0px; border: 0px; outline: 0px; font-size: 16px; vertical-align: baseline; float: left; line-height: 18px; background: transparent;">2.</span></p><p class="p-english family-english size-english" style="margin: 0px 0px 3px; padding: 0px; border: 0px; outline: 0px; font-size: 16px; vertical-align: baseline; line-height: 20px; font-family: arial, sans-serif, &#39;microsoft yahei&#39;, simhei; background: transparent;">It&#39;s not a case of whether anyone would notice or not.</p><p class="p-chinese family-chinese size-chinese" style="margin: 0px 0px 3px; padding: 0px; border: 0px; outline: 0px; font-size: 14px; vertical-align: baseline; line-height: 20px; font-family: &#39;microsoft yahei&#39;, simhei, arial, sans-serif; background: transparent;">这不是会不会有人注意到的问题。</p><p><span class="p-order" style="margin: 0px; padding: 0px; border: 0px; outline: 0px; font-size: 16px; vertical-align: baseline; float: left; line-height: 18px; background: transparent;">3.</span></p><p class="p-english family-english size-english" style="margin: 0px 0px 3px; padding: 0px; border: 0px; outline: 0px; font-size: 16px; vertical-align: baseline; line-height: 20px; font-family: arial, sans-serif, &#39;microsoft yahei&#39;, simhei; background: transparent;">Interest is paid monthly. Three months&#39; notice is required for withdrawals.</p><p class="p-chinese family-chinese size-chinese" style="margin: 0px 0px 3px; padding: 0px; border: 0px; outline: 0px; font-size: 14px; vertical-align: baseline; line-height: 20px; font-family: &#39;microsoft yahei&#39;, simhei, arial, sans-serif; background: transparent;">利息按月支付。提款须提前3个月通知银行。</p><p><br/></p>', 1, 1447481182, 0),
(2, '', '项目名称', 2015, 2015, 10000, 2015, 2015, 8, 100, '/photo/financing/1447502626.jpg', '<p><span class="p-order" style="margin: 0px; padding: 0px; border: 0px; outline: 0px; font-size: 16px; vertical-align: baseline; float: left; line-height: 18px; background: transparent;">1.</span></p><p class="p-english family-english size-english" style="margin: 0px 0px 3px; padding: 0px; border: 0px; outline: 0px; font-size: 16px; vertical-align: baseline; line-height: 20px; font-family: arial, sans-serif, &#39;microsoft yahei&#39;, simhei; background: transparent;">Precious few homebuyers will notice any reduction in their monthly repayments.</p><p class="p-chinese family-chinese size-chinese" style="margin: 0px 0px 3px; padding: 0px; border: 0px; outline: 0px; font-size: 14px; vertical-align: baseline; line-height: 20px; font-family: &#39;microsoft yahei&#39;, simhei, arial, sans-serif; background: transparent;">极少数购房者会注意到他们月还款额的减少。</p><p><span class="p-order" style="margin: 0px; padding: 0px; border: 0px; outline: 0px; font-size: 16px; vertical-align: baseline; float: left; line-height: 18px; background: transparent;">2.</span></p><p class="p-english family-english size-english" style="margin: 0px 0px 3px; padding: 0px; border: 0px; outline: 0px; font-size: 16px; vertical-align: baseline; line-height: 20px; font-family: arial, sans-serif, &#39;microsoft yahei&#39;, simhei; background: transparent;">It&#39;s not a case of whether anyone would notice or not.</p><p class="p-chinese family-chinese size-chinese" style="margin: 0px 0px 3px; padding: 0px; border: 0px; outline: 0px; font-size: 14px; vertical-align: baseline; line-height: 20px; font-family: &#39;microsoft yahei&#39;, simhei, arial, sans-serif; background: transparent;">这不是会不会有人注意到的问题。</p><p><span class="p-order" style="margin: 0px; padding: 0px; border: 0px; outline: 0px; font-size: 16px; vertical-align: baseline; float: left; line-height: 18px; background: transparent;">3.</span></p><p class="p-english family-english size-english" style="margin: 0px 0px 3px; padding: 0px; border: 0px; outline: 0px; font-size: 16px; vertical-align: baseline; line-height: 20px; font-family: arial, sans-serif, &#39;microsoft yahei&#39;, simhei; background: transparent;">Interest is paid monthly. Three months&#39; notice is required for withdrawals.</p><p class="p-chinese family-chinese size-chinese" style="margin: 0px 0px 3px; padding: 0px; border: 0px; outline: 0px; font-size: 14px; vertical-align: baseline; line-height: 20px; font-family: &#39;microsoft yahei&#39;, simhei, arial, sans-serif; background: transparent;">利息按月支付。提款须提前3个月通知银行。</p><p><br/></p>', 1, 1447502628, 0),
(3, '', '项目名称', 2015, 2015, 10000, 2015, 2015, 8, 100, '/photo/financing/1447502656.jpg', '<p><span class="p-order" style="margin: 0px; padding: 0px; border: 0px; outline: 0px; font-size: 16px; vertical-align: baseline; float: left; line-height: 18px; background: transparent;">1.</span></p><p class="p-english family-english size-english" style="margin: 0px 0px 3px; padding: 0px; border: 0px; outline: 0px; font-size: 16px; vertical-align: baseline; line-height: 20px; font-family: arial, sans-serif, &#39;microsoft yahei&#39;, simhei; background: transparent;">Precious few homebuyers will notice any reduction in their monthly repayments.</p><p class="p-chinese family-chinese size-chinese" style="margin: 0px 0px 3px; padding: 0px; border: 0px; outline: 0px; font-size: 14px; vertical-align: baseline; line-height: 20px; font-family: &#39;microsoft yahei&#39;, simhei, arial, sans-serif; background: transparent;">极少数购房者会注意到他们月还款额的减少。</p><p><span class="p-order" style="margin: 0px; padding: 0px; border: 0px; outline: 0px; font-size: 16px; vertical-align: baseline; float: left; line-height: 18px; background: transparent;">2.</span></p><p class="p-english family-english size-english" style="margin: 0px 0px 3px; padding: 0px; border: 0px; outline: 0px; font-size: 16px; vertical-align: baseline; line-height: 20px; font-family: arial, sans-serif, &#39;microsoft yahei&#39;, simhei; background: transparent;">It&#39;s not a case of whether anyone would notice or not.</p><p class="p-chinese family-chinese size-chinese" style="margin: 0px 0px 3px; padding: 0px; border: 0px; outline: 0px; font-size: 14px; vertical-align: baseline; line-height: 20px; font-family: &#39;microsoft yahei&#39;, simhei, arial, sans-serif; background: transparent;">这不是会不会有人注意到的问题。</p><p><span class="p-order" style="margin: 0px; padding: 0px; border: 0px; outline: 0px; font-size: 16px; vertical-align: baseline; float: left; line-height: 18px; background: transparent;">3.</span></p><p class="p-english family-english size-english" style="margin: 0px 0px 3px; padding: 0px; border: 0px; outline: 0px; font-size: 16px; vertical-align: baseline; line-height: 20px; font-family: arial, sans-serif, &#39;microsoft yahei&#39;, simhei; background: transparent;">Interest is paid monthly. Three months&#39; notice is required for withdrawals.</p><p class="p-chinese family-chinese size-chinese" style="margin: 0px 0px 3px; padding: 0px; border: 0px; outline: 0px; font-size: 14px; vertical-align: baseline; line-height: 20px; font-family: &#39;microsoft yahei&#39;, simhei, arial, sans-serif; background: transparent;">利息按月支付。提款须提前3个月通知银行。</p><p><br/></p>', 1, 1447502658, 0),
(4, '', '项目名称', 1446393600, 1448899200, 10000, 1448985600, 1448553600, 8, 100, '/photo/financing/1447508148.jpg', '<h3 style="margin: 20px 0px 0px; padding: 0px; border: 0px; font-weight: bold; font-size: 12px; color: rgb(0, 0, 0); font-family: Verdana, Arial, 宋体; font-style: normal; font-variant: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(249, 249, 249);">说明</h3><p style="margin: 12px 0px 0px; padding: 0px; border: 0px; line-height: 18px; color: rgb(0, 0, 0); font-family: Verdana, Arial, 宋体; font-size: 12px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: auto; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(249, 249, 249);">该函数预期接受一个包含美国英语日期格式的字符串并尝试将其解析为 Unix 时间戳（自 January 1 1970 00:00:00 GMT 起的秒数），其值相对于<span class="Apple-converted-space">&nbsp;</span><em style="margin: 0px; padding: 0px; border: 0px;">now</em><span class="Apple-converted-space">&nbsp;</span>参数给出的时间，如果没有提供此参数，则用系统当前时间。</p><p style="margin: 12px 0px 0px; padding: 0px; border: 0px; line-height: 18px; color: rgb(0, 0, 0); font-family: Verdana, Arial, 宋体; font-size: 12px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: auto; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(249, 249, 249);">该函数将使用<span class="Apple-converted-space">&nbsp;</span><em style="margin: 0px; padding: 0px; border: 0px;">TZ</em><span class="Apple-converted-space">&nbsp;</span>环境变量（如果有的话）来计算时间戳。自 PHP 5.1.0 起有更容易的方法来定义时区用于所有的日期／时间函数。此过程在<span class="Apple-converted-space">&nbsp;</span><a href="http://www.w3school.com.cn/php/func_date_default_timezone_get.asp" title="PHP date_default_timezone_get() 函数" style="margin: 0px; padding: 0px; border: 0px; text-decoration: underline; color: rgb(144, 11, 9); background: transparent;">date_default_timezone_get()</a><span class="Apple-converted-space">&nbsp;</span>函数页面中有说明。</p><p><br/></p>', 1, 1447508148, 1447508148);

-- --------------------------------------------------------

--
-- 表的结构 `financing_status`
--

CREATE TABLE IF NOT EXISTS `financing_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- 导出表中的数据 `financing_status`
--

INSERT INTO `financing_status` (`id`, `status`) VALUES
(1, '审核中'),
(2, '展示期'),
(3, '认购期'),
(4, '认购结束'),
(5, '封闭期'),
(6, '赎回期'),
(7, '已赎回'),
(8, '失败'),
(9, '已退款');

-- --------------------------------------------------------

--
-- 表的结构 `notice`
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
-- 导出表中的数据 `notice`
--


-- --------------------------------------------------------

--
-- 表的结构 `order`
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
-- 导出表中的数据 `order`
--


-- --------------------------------------------------------

--
-- 表的结构 `user_account`
--

CREATE TABLE IF NOT EXISTS `user_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) NOT NULL,
  `password` char(32) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 导出表中的数据 `user_account`
--

INSERT INTO `user_account` (`id`, `user_name`, `password`, `status`, `create_time`, `update_time`) VALUES
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 1, 0, 0),
(2, 'dzhua', 'a826a722a321b0755b69a4e5df98d34c', 0, 1447513767, 1447513767);

-- --------------------------------------------------------

--
-- 表的结构 `user_info`
--

CREATE TABLE IF NOT EXISTS `user_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) NOT NULL,
  `company_name` varchar(50) NOT NULL,
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
  `introduce` text,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 导出表中的数据 `user_info`
--

INSERT INTO `user_info` (`id`, `account_id`, `company_name`, `service_type`, `IDnumber`, `linkman`, `tel`, `mobile`, `email`, `fax`, `qq`, `city`, `area`, `district`, `address`, `introduce`, `status`, `create_time`, `update_time`) VALUES
(1, 2, '商家名称', 0, '证件编号', '联系人', '手机号码', '座机号码', '邮箱地址', '传真', 'QQ号码', 0, 0, 0, '联系地址', '<p>简介简介简介简介</p>', 1, 1447513768, 1447513768);
