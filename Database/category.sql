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
-- 資料表結構 `category`
--

CREATE TABLE `category` (
  `id` int(6) NOT NULL,
  `Category` varchar(12) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 傾印資料表的資料 `category`
--

INSERT INTO `category` (`id`, `Category`) VALUES
(1, '早午餐'),
(2, '火鍋'),
(3, '甜點'),
(4, '小吃'),
(5, '蛋糕'),
(6, '咖啡'),
(7, '牛排'),
(8, '燒烤'),
(9, '冰品飲料'),
(10, '合菜'),
(11, '宵夜'),
(12, '海鮮'),
(13, '拉麵'),
(14, '牛肉麵'),
(15, '壽司'),
(16, '素食'),
(17, '日本料理'),
(18, '韓式料理'),
(19, '中式料理'),
(20, '美式料理'),
(21, '義式料理'),
(22, '泰式料理'),
(23, '港式料理');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
