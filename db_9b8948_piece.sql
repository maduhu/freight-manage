-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- 主機: localhost
-- 產生時間： 2015 年 05 月 29 日 18:29
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
-- 資料表結構 `korea`
--

CREATE TABLE IF NOT EXISTS `korea` (
`id` int(11) NOT NULL,
  `account` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 資料表的匯出資料 `korea`
--

INSERT INTO `korea` (`id`, `account`, `password`) VALUES
(1, 'david', 'davidlin978'),
(2, 'korea2tw', 'koreatw888');

-- --------------------------------------------------------

--
-- 資料表結構 `moneys`
--

CREATE TABLE IF NOT EXISTS `moneys` (
`money_id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL COMMENT 'users''sPK',
  `save_money` int(11) NOT NULL,
  `use_money` int(11) NOT NULL,
  `kg` varchar(255) NOT NULL,
  `detail` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 資料表結構 `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
`order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'users''sPK',
  `state_id` int(11) NOT NULL DEFAULT '1',
  `cross` int(11) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 資料表結構 `order_imgs`
--

CREATE TABLE IF NOT EXISTS `order_imgs` (
`order_img_id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `order_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `position_desc` varchar(255) NOT NULL,
  `store_message` text NOT NULL,
  `korea_message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
  `price` int(11) NOT NULL DEFAULT '0',
  `sub_state` varchar(255) NOT NULL,
  `sub_state_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `korea`
--
ALTER TABLE `korea`
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
-- 使用資料表 AUTO_INCREMENT `korea`
--
ALTER TABLE `korea`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- 使用資料表 AUTO_INCREMENT `moneys`
--
ALTER TABLE `moneys`
MODIFY `money_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用資料表 AUTO_INCREMENT `orders`
--
ALTER TABLE `orders`
MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用資料表 AUTO_INCREMENT `order_imgs`
--
ALTER TABLE `order_imgs`
MODIFY `order_img_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用資料表 AUTO_INCREMENT `order_subs`
--
ALTER TABLE `order_subs`
MODIFY `order_sub_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用資料表 AUTO_INCREMENT `states`
--
ALTER TABLE `states`
MODIFY `state_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- 使用資料表 AUTO_INCREMENT `users`
--
ALTER TABLE `users`
MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
