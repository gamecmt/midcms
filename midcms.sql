-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-01-10 05:44:55
-- 服务器版本： 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `midcms`
--

-- --------------------------------------------------------

--
-- 表的结构 `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `register_data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_admin` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `register_data`, `is_admin`) VALUES
(1, 'a', '$2y$12$0VQwPjSQ5cccMrjsEAzD1.NXoHqrft0vQa51tF.ctUkZqXG8.MD.W', 'a@b.com', '2016-01-04 13:18:40', 1),
(2, 'b', '$2y$12$BFdF/ShKZ/Dkn/1of0mlPOEBtb4dWR6QxuuhgqJP9Je4N4H36P1.C', 'a@b.com', '2016-01-07 13:29:23', 0),
(3, 'c', '$2y$12$AajssWH0NShr4z3KJ7ODH.ibS/XFc7Va3ALkcJzih/qXl9cnz/KeG', 'a@b.com', '2016-01-09 12:16:59', 1),
(4, 'd', '$2y$12$o9IH6.KRD5iqT3SGm5S9ZeiTskNCvl/Efnsdexoj2A5.YXJs7t9UG', 'a@b.com', '2016-01-09 12:17:21', 0),
(5, 'e', '$2y$12$lxJt6G6dsmhYsDVvwYPgGewKNGu2QBt8X7S0mfuLwfgTLi5Ua60qq', 'a@b.com', '2016-01-09 12:17:49', 1),
(6, 'f', '$2y$12$drsAX5UJLAM1Xszggp7StuXpGKFDMS.ExBcZw/DrKwU2WXp7fCl5S', 'a@b.com', '2016-01-09 12:51:25', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
