-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2014 年 03 月 07 日 15:21
-- 服务器版本: 5.5.35
-- PHP 版本: 5.4.24

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `pengfei`
--

-- --------------------------------------------------------

--
-- 表的结构 `pf_app`
--

CREATE TABLE IF NOT EXISTS `pf_app` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自动编号',
  `name` varchar(100) NOT NULL COMMENT '应用名称',
  `download` varchar(250) NOT NULL COMMENT '下载地址',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='应用表' AUTO_INCREMENT=73 ;

--
-- 转存表中的数据 `pf_app`
--

INSERT INTO `pf_app` (`id`, `name`, `download`) VALUES
(2, '节奏大师', 'http://gdown.baidu.com/data/wisegame/3d9c8cc4830976de/365riliwannianli_28.apk'),
(4, '经典超级马里奥', 'http://gdown.baidu.com/data/wisegame/3d9c8cc4830976de/365riliwannianli_28.apk'),
(5, '口袋战争：天降奇允', 'http://gdown.baidu.com/data/wisegame/3d9c8cc4830976de/365riliwannianli_28.apk'),
(6, '停车大师 3D', 'http://gdown.baidu.com/data/wisegame/3d9c8cc4830976de/365riliwannianli_28.apk'),
(8, '水果连连省3 HD', 'http://gdown.baidu.com/data/wisegame/3d9c8cc4830976de/365riliwannianli_28.apk'),
(10, 'QQ中国象棋', 'http://gdown.baidu.com/data/wisegame/3d9c8cc4830976de/365riliwannianli_28.apk'),
(23, '365日历', 'gdown.baidu.com/data/wisegame/3d9c8cc4830976de/365riliwannianli_28.apk'),
(25, '程序移动到SD卡', 'http://bcs.hiapk.91rb.com/data/upload/2013/12_11/21/com.probcomp.moveapps_211446.apk'),
(38, 'WinZip', 'http://bcs.hiapk.91rb.com/data/upload/2013/12_11/21/com.probcomp.moveapps_211446.apk'),
(37, 'phpStudy 2014', 'http://www.phpstudy.net/phpstudy/phpStudy.zip '),
(67, 'Flappy Bird', 'http://bcs.hiapk.91rb.com/data/upload//2014/02_07/10/com.dotgears.flappybird_103303.apk'),
(66, 'NBA梦之队', 'http://gdown.baidu.com/data/wisegame/d88e46c09a6ca1ca/NBAmengzhidui_18.apk'),
(68, '百度输入法', 'http://shouji.360tpcdn.com/140304/cd1722c24216b7fd2ccb2dc1d7b0d766/com.baidu.input_62.apk'),
(69, '百度视频', 'http://shouji.360tpcdn.com/140304/cd1722c24216b7fd2ccb2dc1d7b0d766/com.baidu.input_62.apk'),
(70, '百度音乐播放器', 'http://shouji.360tpcdn.com/140224/30ced403b6eeab71713e47b22d29fad2/com.ting.mp3.android_49.apk'),
(71, '百度地图', 'http://shouji.360tpcdn.com/140305/a10fc8ecc42a142d54ef76adb3135674/com.baidu.BaiduMap_494.apk'),
(72, '百度手机浏览器', 'http://shouji.360tpcdn.com/140130/d31f744c38c150ec0fa741c0e0a60f8a/com.baidu.browser.apps_35.apk');

-- --------------------------------------------------------

--
-- 表的结构 `pf_date`
--

CREATE TABLE IF NOT EXISTS `pf_date` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自动编号',
  `date` date NOT NULL COMMENT '预备日期',
  `amount` varchar(11) NOT NULL COMMENT '数量',
  `price` varchar(11) NOT NULL COMMENT '消费值',
  `income` varchar(11) NOT NULL COMMENT '收入',
  `user_id` int(11) NOT NULL COMMENT '用户ID',
  `app_id` int(11) NOT NULL COMMENT '应用ID',
  PRIMARY KEY (`id`,`app_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='日期和数量表' AUTO_INCREMENT=174 ;

--
-- 转存表中的数据 `pf_date`
--

INSERT INTO `pf_date` (`id`, `date`, `amount`, `price`, `income`, `user_id`, `app_id`) VALUES
(122, '2014-02-26', '70', '50', '50', 1, 119),
(121, '2014-02-27', '60', '40', '40', 1, 119),
(120, '2014-02-28', '50', '30', '10', 1, 119),
(119, '2014-03-01', '40', '20', '20', 1, 119),
(118, '2014-03-02', '30', '10', '20', 1, 119),
(117, '2014-03-03', '20', '10', '10', 1, 119),
(116, '2014-03-04', '10', '80', '20', 1, 119),
(123, '2014-03-04', '1000', '5000', '50000', 1, 117),
(124, '2014-03-03', '2000', '10000', '100000', 1, 117),
(125, '2014-03-02', '6565', '656', '56', 1, 117),
(126, '2014-03-01', '565', '65', '6', 1, 117),
(127, '2014-02-28', '565', '6', '565', 1, 117),
(128, '2014-02-27', '65', '65', '656', 1, 117),
(129, '2014-02-26', '65', '656', '5654', 1, 117),
(130, '2014-03-04', '100', '1000', '10000', 34, 138),
(131, '2014-03-03', '600', '2000', '20000', 34, 138),
(132, '2014-03-02', '500', '3000', '30000', 34, 138),
(133, '2014-03-01', '200', '4000', '40000', 34, 138),
(134, '2014-02-28', '100', '5000', '50000', 34, 138),
(135, '2014-02-27', '300', '6000', '6000', 34, 138),
(136, '2014-02-26', '500', '7000', '70000', 34, 138),
(137, '2014-03-04', '123', '5659', '656', 34, 139),
(138, '2014-03-03', '896', '56', '59', 34, 139),
(139, '2014-03-02', '65698', '56', '85956', 34, 139),
(140, '2014-03-01', '95965', '95699', '565689', 34, 139),
(141, '2014-02-28', '5656', '9563', '56521', 34, 139),
(142, '2014-02-27', '6556', '65647', '654', 34, 139),
(143, '2014-02-26', '565', '65678', '6255', 34, 139),
(144, '2014-03-01', '10', '20', '30', 38, 140),
(145, '2014-03-02', '50', '60', '80', 38, 140),
(146, '2014-03-03', '70', '80', '9', 38, 140),
(147, '2014-03-04', '78', '540', '654', 38, 140),
(148, '2014-03-05', '88', '668', '552', 38, 140),
(156, '2014-03-04', '1', '', '', 38, 143),
(157, '2014-03-03', '0', '0', '', 38, 143),
(158, '2014-03-02', '', '0', '0', 38, 143),
(159, '2014-03-01', '0', '', '', 38, 143),
(160, '2014-03-05', '535435', '405435', '505345', 38, 148),
(161, '2014-03-04', '65350', '80543', '90543', 38, 148),
(162, '2014-03-03', '7054353', '706435', '654350', 38, 148),
(163, '2014-03-02', '1456', '48564', '56416', 38, 148),
(164, '2014-03-01', '151564', '14165', '4545646', 38, 148),
(165, '2014-02-28', '546465', '14451465', '554536', 38, 148),
(166, '2014-02-27', '5454654', '545648', '52456746', 38, 148),
(167, '2014-03-06', '', '658', '624', 38, 156),
(168, '2014-03-05', '26', '85', '26', 38, 156),
(169, '2014-03-04', '47', '15', '22', 38, 156),
(170, '2014-03-03', '41', '56', '47', 38, 156),
(171, '2014-03-02', '52', '63', '54', 38, 156),
(172, '2014-03-01', '14', '25', '63', 38, 156),
(173, '2014-02-28', '87', '96', '52', 38, 156);

-- --------------------------------------------------------

--
-- 表的结构 `pf_download`
--

CREATE TABLE IF NOT EXISTS `pf_download` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自动编号',
  `name` varchar(35) NOT NULL COMMENT '应用名称',
  `download` varchar(200) NOT NULL COMMENT '下载地址',
  `user_id` int(11) NOT NULL COMMENT '用户ID',
  `app_id` int(11) NOT NULL COMMENT '应用ID',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='应用下载地址' AUTO_INCREMENT=175 ;

--
-- 转存表中的数据 `pf_download`
--

INSERT INTO `pf_download` (`id`, `name`, `download`, `user_id`, `app_id`) VALUES
(49, '5000MB webruimte', 'http://www.w3school.com.cn/tiy/t.asp?f=jquery_ajax_serialize', 18, 0),
(109, '365日历', 'http://gdown.baidu.com/data/wisegame/3d9c8cc4830976de/365riliwannianli_28.apk', 26, 23),
(139, '365日历', 'http://gdown.baidu.com/data/wisegame/3d9c8cc4830976de/365riliwannianli_28.apk', 34, 23),
(64, '365日历', 'http://gdown.baidu.com/data/wisegame/3d9c8cc4830976de/365riliwannianli_28.apk', 22, 23),
(87, '365日历', 'http://gdown.baidu.com/data/wisegame/3d9c8cc4830976de/365riliwannianli_28.apk', 24, 23),
(97, '365日历', 'http://gdown.baidu.com/data/wisegame/3d9c8cc4830976de/365riliwannianli_28.apk', 25, 23),
(131, '365日历', 'http://gdown.baidu.com/data/wisegame/3d9c8cc4830976de/365riliwannianli_28.apk', 32, 23),
(156, '节奏大师', 'http://www.zhaoping.com', 38, 2),
(157, 'QQ中国象棋', 'http://www.baidu.com', 38, 10),
(158, '停车大师 3D', 'http://www.google.com', 38, 6),
(159, 'WinZip', 'http://www.51job.com', 38, 38),
(160, '365日历', 'http://www.nba.com', 38, 23),
(161, 'NBA梦之队', 'http://www.qq.com/news', 38, 66);

-- --------------------------------------------------------

--
-- 表的结构 `pf_money`
--

CREATE TABLE IF NOT EXISTS `pf_money` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自动编号',
  `money` float NOT NULL COMMENT '金额',
  `poundage` float NOT NULL COMMENT '手续费',
  `reality` float NOT NULL COMMENT '税后收入',
  `bank_name` varchar(30) NOT NULL COMMENT '开户银行',
  `bank_accument` varchar(30) NOT NULL COMMENT '收款账号',
  `cycle` varchar(30) NOT NULL COMMENT '结算周期',
  `status` varchar(20) NOT NULL DEFAULT '无' COMMENT '汇款状态',
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='汇款表' AUTO_INCREMENT=24 ;

--
-- 转存表中的数据 `pf_money`
--

INSERT INTO `pf_money` (`id`, `money`, `poundage`, `reality`, `bank_name`, `bank_accument`, `cycle`, `status`, `user_id`) VALUES
(2, 254.4, 15.26, 239.14, '建设银行', '6225882040', '2013-08-01至2013-08-15', '已汇款     ', 4),
(12, 132, 22, 110, '建设银行', '12645678987523456', '2014-03-09至2014-04-11', '已汇款  ', 19),
(20, 2000, 200, 1800, '工商银行', '123456789987654321', '2014-02-01至2014-03-08', '已汇款   ', 38),
(5, 254.4, 15.26, 239.14, '建设银行', '6225882020', '2013-08-01至2013-08-15', '汇款失败 ', 23),
(13, 235, 21, 342, '建设银行', '56484684864684685', '2014-02-06至2014-03-08', '已汇款', 1),
(14, 2555, 55, 2500, '建设银行', '123456789987654321', 'xxxx-xx-xx至xxx-xx-xx', '待付款', 27),
(17, 400, 10, 390, '交通银行', '12345678998765421', '2014-02-06至2014-03-08', '已汇款 ', 1);

-- --------------------------------------------------------

--
-- 表的结构 `pf_user`
--

CREATE TABLE IF NOT EXISTS `pf_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自动编号',
  `username` varchar(50) NOT NULL COMMENT '用户名',
  `password` varchar(50) DEFAULT NULL COMMENT '用户密码',
  `realname` varchar(30) NOT NULL COMMENT '真实姓名',
  `bank_name` varchar(30) NOT NULL COMMENT '银行名称',
  `bank_accument` varchar(50) NOT NULL COMMENT '银行卡号',
  `join_date` date NOT NULL COMMENT '注册日期',
  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '用户类型',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_2` (`username`),
  UNIQUE KEY `username_3` (`username`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `username_4` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='用户表' AUTO_INCREMENT=51 ;

--
-- 转存表中的数据 `pf_user`
--

INSERT INTO `pf_user` (`id`, `username`, `password`, `realname`, `bank_name`, `bank_accument`, `join_date`, `type`) VALUES
(1, 'nihility', '123456', '安含巧', '工商银行', '123456789987654321', '2014-02-26', 0),
(3, 'admin', '123456', '', '', '', '2014-02-27', 1),
(23, 'tvloginq', '12355646', '武保柱', '建设银行', '4894665654', '2014-03-01', 0),
(26, 'nihichina', '123456', '国梓穹', '建设银行', '123456789987654321', '2014-03-02', 0),
(25, 'fjkdsjf', '123456', '雷淋', '农业银行', '123456987452145236', '2014-03-01', 0),
(27, 'test1', '123456', '冯星宇', '工商银行', '123456789987654321', '2014-03-04', 0),
(28, 'fuck1', '123456', '麻生太郎', '农村信用合作社', '123456789987654321', '2014-03-04', 0),
(29, 'fuck2', '123456', '奥班马', '美国银行', '456985263698562412', '2014-03-04', 0),
(30, 'fuck3', '654321', '里根', '美国民生银行', '456985263586362412', '2014-03-04', 0),
(33, 'mingren', '123456', '漩涡鸣人', '木叶银行', '369852147741258963', '2014-03-05', 0),
(31, 'abc147', '123456', '阿西斯', '交通银行', '147258369963258745', '2014-03-04', 0),
(32, 'hello123', '123456', '陈浩', '民生银行', '147852369852147963', '2014-03-04', 0),
(34, 'liuyifei', '123456', '刘亦菲', '光大银行', '582369741326598475', '2014-03-05', 0),
(38, 'Monkey', 'abc123', '蒙奇S路飞', '建设银行', '147258369963258741', '2014-03-05', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
