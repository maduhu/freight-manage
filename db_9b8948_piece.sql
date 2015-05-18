-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- 主機: localhost
-- 產生時間： 2015 年 05 月 18 日 16:28
-- 伺服器版本: 5.6.20
-- PHP 版本： 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 資料庫： `db_9b8948_piece`
--

-- --------------------------------------------------------

--
-- 資料表結構 `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
`id` int(11) NOT NULL,
  `account` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 資料表的匯出資料 `admin`
--

INSERT INTO `admin` (`id`, `account`, `password`) VALUES
(1, 'admin', '123456789');

-- --------------------------------------------------------

--
-- 資料表結構 `moneys`
--

CREATE TABLE IF NOT EXISTS `moneys` (
`money_id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL COMMENT 'users''sPK',
  `save_money` int(11) NOT NULL,
  `use_money` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- 資料表的匯出資料 `moneys`
--

INSERT INTO `moneys` (`money_id`, `user_id`, `save_money`, `use_money`, `date`) VALUES
(2, '7', 0, 100, '2015-05-29'),
(6, '8', 1000, 0, '2015-05-27'),
(7, '7', 1000, 0, '2015-05-18'),
(8, '8', 1000, 0, '2015-05-18'),
(9, '9', 111, 0, '2015-05-18');

-- --------------------------------------------------------

--
-- 資料表結構 `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
`order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'users''sPK',
  `state_id` int(11) NOT NULL DEFAULT '1',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- 資料表的匯出資料 `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `state_id`, `create_time`, `update_time`) VALUES
(9, 7, 2, '2015-05-12 13:43:01', '2015-05-18 01:38:06');

-- --------------------------------------------------------

--
-- 資料表結構 `order_imgs`
--

CREATE TABLE IF NOT EXISTS `order_imgs` (
`order_img_id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `order_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=95 ;

--
-- 資料表的匯出資料 `order_imgs`
--

INSERT INTO `order_imgs` (`order_img_id`, `user_id`, `order_id`, `image`) VALUES
(25, '7', 2, 'uploads/2ea4341d9c28235300abbf355a21ced6.jpg'),
(26, '7', 3, 'uploads/6eca05fad4d940f3578d4f3e008c0e2e.jpg'),
(89, '7', 9, 'uploads/bab2ac51141a9ceed471a53216893d3f.jpeg'),
(90, '7', 9, 'uploads/e24507d8a0ebd180bdbb0ac18ea567fe.jpeg'),
(91, '7', 9, 'uploads/bd86fc7a93ccf11251fe16d4d2259980.jpg'),
(92, '7', 9, 'uploads/029da8999c8d8650b3148255322455d7.jpg');

-- --------------------------------------------------------

--
-- 資料表結構 `order_subs`
--

CREATE TABLE IF NOT EXISTS `order_subs` (
`order_sub_id` int(11) NOT NULL,
  `order_img_id` int(11) NOT NULL COMMENT 'order_imgs''sPK',
  `color` varchar(255) NOT NULL,
  `size` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL DEFAULT '0',
  `price` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- 資料表的匯出資料 `order_subs`
--

INSERT INTO `order_subs` (`order_sub_id`, `order_img_id`, `color`, `size`, `amount`, `price`) VALUES
(9, 25, '', '', 10, 1000),
(22, 89, '', '', 1000, 1000),
(23, 91, '', '', 1000, 1000);

-- --------------------------------------------------------

--
-- 資料表結構 `states`
--

CREATE TABLE IF NOT EXISTS `states` (
`state_id` int(11) NOT NULL,
  `state_name` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 資料表的匯出資料 `states`
--

INSERT INTO `states` (`state_id`, `state_name`) VALUES
(1, '未處理'),
(2, '處理中'),
(3, '追貨中'),
(4, '出貨');

-- --------------------------------------------------------

--
-- 資料表結構 `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`user_id` int(11) NOT NULL,
  `company` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `account` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- 資料表的匯出資料 `users`
--

INSERT INTO `users` (`user_id`, `company`, `user_name`, `address`, `telephone`, `email`, `account`, `password`) VALUES
(7, '創業者股份有限公司', '趙承瑋', '桃園縣', '0989098908', 'piece601@hotmail.com', 'piece601', '1234');

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `admin`
--
ALTER TABLE `admin`
 ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `moneys`
--
ALTER TABLE `moneys`
 ADD PRIMARY KEY (`money_id`);

--
-- 資料表索引 `orders`
--
ALTER TABLE `orders`
 ADD PRIMARY KEY (`order_id`);

--
-- 資料表索引 `order_imgs`
--
ALTER TABLE `order_imgs`
 ADD PRIMARY KEY (`order_img_id`);

--
-- 資料表索引 `order_subs`
--
ALTER TABLE `order_subs`
 ADD PRIMARY KEY (`order_sub_id`);

--
-- 資料表索引 `states`
--
ALTER TABLE `states`
 ADD PRIMARY KEY (`state_id`);

--
-- 資料表索引 `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`user_id`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `admin`
--
ALTER TABLE `admin`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- 使用資料表 AUTO_INCREMENT `moneys`
--
ALTER TABLE `moneys`
MODIFY `money_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- 使用資料表 AUTO_INCREMENT `orders`
--
ALTER TABLE `orders`
MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- 使用資料表 AUTO_INCREMENT `order_imgs`
--
ALTER TABLE `order_imgs`
MODIFY `order_img_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=95;
--
-- 使用資料表 AUTO_INCREMENT `order_subs`
--
ALTER TABLE `order_subs`
MODIFY `order_sub_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- 使用資料表 AUTO_INCREMENT `states`
--
ALTER TABLE `states`
MODIFY `state_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- 使用資料表 AUTO_INCREMENT `users`
--
ALTER TABLE `users`
MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
