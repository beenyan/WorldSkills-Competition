-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2020-12-27 06:47:06
-- 伺服器版本： 10.4.14-MariaDB
-- PHP 版本： 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `50 屆技能競賽[區賽] (一)`
--
CREATE DATABASE IF NOT EXISTS `50 屆技能競賽[區賽] (一)` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `50 屆技能競賽[區賽] (一)`;

-- --------------------------------------------------------

--
-- 資料表結構 `comment`
--

CREATE TABLE `comment` (
  `id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `detail` text COLLATE utf8_unicode_ci NOT NULL,
  `time` date NOT NULL,
  `type` text COLLATE utf8_unicode_ci NOT NULL,
  `file` text COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `side_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `comment`
--

INSERT INTO `comment` (`id`, `title`, `detail`, `time`, `type`, `file`, `user_id`, `side_id`) VALUES
(003, '第一個意見', '圖片', '2020-12-27', 'image', '../file/2020-12-27_1609027922.png', 7, 24),
(004, '第二個意見', '影片', '2020-12-27', 'video', '../file/2020-12-27_1609027941.mp4', 7, 24),
(005, '第三個意見', '聲音', '2020-12-27', 'audio', '../file/2020-12-27_1609027936.mp3', 7, 24),
(006, '第四個意見', '無檔案', '2020-12-27', '', '', 7, 24),
(007, '要刪除的1', 'asd', '2020-12-27', '', '', 7, 24),
(008, '要刪除的2', 'asdfsdf', '2020-12-27', '', '', 7, 24),
(009, 'thrth', 'rthrth', '2020-12-27', 'video', '../file/2020-12-27_1609027925.mp4', 7, 24),
(010, 'dfg56', '56', '2020-12-27', '', '', 7, 24),
(011, 'Good', 'nice', '2020-12-27', 'image', '../file/2020-12-27_1609038739.png', 7, 24);

-- --------------------------------------------------------

--
-- 資料表結構 `comment_stratch`
--

CREATE TABLE `comment_stratch` (
  `id` int(11) NOT NULL,
  `comment_id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `comment_stratch` int(3) UNSIGNED ZEROFILL NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `comment_stratch`
--

INSERT INTO `comment_stratch` (`id`, `comment_id`, `comment_stratch`) VALUES
(1, 011, 004),
(2, 011, 005),
(3, 011, 006),
(4, 011, 007);

-- --------------------------------------------------------

--
-- 資料表結構 `member`
--

CREATE TABLE `member` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `member`
--

INSERT INTO `member` (`id`, `project_id`, `user_id`) VALUES
(11, 4, 4),
(39, 12, 5),
(40, 12, 6),
(43, 3, 3),
(44, 3, 4),
(46, 6, 5),
(47, 6, 6),
(51, 14, 6),
(52, 14, 7),
(53, 14, 13);

-- --------------------------------------------------------

--
-- 資料表結構 `project`
--

CREATE TABLE `project` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `detail` text COLLATE utf8_unicode_ci NOT NULL,
  `leader` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `project`
--

INSERT INTO `project` (`id`, `name`, `detail`, `leader`) VALUES
(3, 'Math', 'learn', 2),
(4, 'TEst', 'TEST', 5),
(6, '測試1號', '測試1號', 7),
(12, 'ㄎ', 'Aㄎ', 13),
(14, 'hk4g4', 'asdasd', 3);

-- --------------------------------------------------------

--
-- 資料表結構 `score`
--

CREATE TABLE `score` (
  `id` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment_id` int(3) UNSIGNED ZEROFILL NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `score`
--

INSERT INTO `score` (`id`, `score`, `user_id`, `comment_id`) VALUES
(1, 5, 7, 003),
(2, 3, 12, 003),
(3, 5, 2, 003),
(4, 5, 7, 004),
(5, 2, 7, 005),
(6, 5, 5, 003),
(7, 4, 5, 004),
(8, 5, 5, 010),
(9, 1, 7, 010),
(10, 3, 7, 011);

-- --------------------------------------------------------

--
-- 資料表結構 `side`
--

CREATE TABLE `side` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `detail` text COLLATE utf8_unicode_ci NOT NULL,
  `project_id` int(11) NOT NULL,
  `increase` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `side`
--

INSERT INTO `side` (`id`, `name`, `detail`, `project_id`, `increase`) VALUES
(1, '第一個面向', '面向的說明', 3, 1),
(2, 'rtert', 'ert', 3, 1),
(3, 'hfdyujhkhjk', 'dfghfgh', 3, 1),
(4, 'dghytu', 'rtyutr', 3, 1),
(5, 'tryu', 'tryu', 3, 1),
(6, '434', '345345', 3, 1),
(7, '3', '453', 3, 1),
(8, '3', '7837', 3, 1),
(12, 'asdasd', 'gerg', 3, 1),
(13, 'erg', 'fhjg', 3, 1),
(24, '8784', '9794545', 6, 1),
(26, 'GG', 'GG', 6, 1);

-- --------------------------------------------------------

--
-- 資料表結構 `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `account` text COLLATE utf8_unicode_ci NOT NULL,
  `password` text COLLATE utf8_unicode_ci NOT NULL,
  `rank` int(11) NOT NULL DEFAULT 3
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `user`
--

INSERT INTO `user` (`id`, `name`, `account`, `password`, `rank`) VALUES
(2, 'utest2', 'test2', '1234', 3),
(3, 'utest3', 'test3', '1234', 3),
(4, 'utest4', 'test4', '1234', 3),
(5, 'utest5', 'test5', '1234', 3),
(6, 'utest6', 'test6', '1234', 3),
(7, 'atest1', 'admin', '1234', 1),
(10, 'utest1', 'test1', '1234', 3),
(11, '4534', '453', '453', 3),
(12, '9786+', '786', '786', 3),
(13, '89', '6786', '8498', 3);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `side_id` (`side_id`);

--
-- 資料表索引 `comment_stratch`
--
ALTER TABLE `comment_stratch`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comment_stratch` (`comment_stratch`),
  ADD KEY `comment_id` (`comment_id`);

--
-- 資料表索引 `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_ibfk_1` (`project_id`),
  ADD KEY `member_ibfk_2` (`user_id`);

--
-- 資料表索引 `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_ibfk_1` (`leader`);

--
-- 資料表索引 `score`
--
ALTER TABLE `score`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `comment_id` (`comment_id`);

--
-- 資料表索引 `side`
--
ALTER TABLE `side`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id` (`project_id`);

--
-- 資料表索引 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `comment_stratch`
--
ALTER TABLE `comment_stratch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `member`
--
ALTER TABLE `member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `project`
--
ALTER TABLE `project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `score`
--
ALTER TABLE `score`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `side`
--
ALTER TABLE `side`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`side_id`) REFERENCES `side` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的限制式 `comment_stratch`
--
ALTER TABLE `comment_stratch`
  ADD CONSTRAINT `comment_stratch_ibfk_2` FOREIGN KEY (`comment_stratch`) REFERENCES `comment` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_stratch_ibfk_3` FOREIGN KEY (`comment_id`) REFERENCES `comment` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的限制式 `member`
--
ALTER TABLE `member`
  ADD CONSTRAINT `member_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `member_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- 資料表的限制式 `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `project_ibfk_1` FOREIGN KEY (`leader`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- 資料表的限制式 `score`
--
ALTER TABLE `score`
  ADD CONSTRAINT `score_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `score_ibfk_2` FOREIGN KEY (`comment_id`) REFERENCES `comment` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的限制式 `side`
--
ALTER TABLE `side`
  ADD CONSTRAINT `side_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
