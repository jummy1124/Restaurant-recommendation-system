-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 
-- 伺服器版本： 10.1.38-MariaDB
-- PHP 版本： 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `restaurant_db`
--

-- --------------------------------------------------------

--
-- 資料表結構 `city`
--

CREATE TABLE `city` (
  `id` int(6) NOT NULL,
  `City` varchar(6) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 傾印資料表的資料 `city`
--

INSERT INTO `city` (`id`, `City`) VALUES
(1, '臺北市'),
(2, '新北市'),
(3, '桃園市'),
(4, '臺中市'),
(5, '臺南市'),
(6, '高雄市'),
(7, '基隆市'),
(8, '宜蘭縣'),
(9, '新竹市'),
(10, '新竹縣'),
(11, '苗栗縣'),
(12, '彰化縣'),
(13, '雲林縣'),
(14, '嘉義市'),
(15, '嘉義縣'),
(16, '屏東縣'),
(17, '花蓮縣'),
(18, '南投縣'),
(19, '台東縣'),
(20, '澎湖縣'),
(21, '金門縣');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
