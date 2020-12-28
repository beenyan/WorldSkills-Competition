-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2020-12-28 03:11:44
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
(011, 'Good', 'nice', '2020-12-27', 'image', '../file/2020-12-27_1609038739.png', 7, 24),
(012, 'asd', '453', '2020-12-27', 'image', '../file/2020-12-27_1609053147.png', 7, 26),
(013, '測試', '測試', '2020-12-27', 'image', '../file/2020-12-27_1609053159.png', 7, 26),
(014, '測試1', '測試2', '2020-12-27', 'image', '../file/2020-12-27_1609053168.png', 7, 26),
(015, 'yuk', 'kyuk', '2020-12-28', 'image', '../file/2020-12-28_1609117970.png', 14, 29),
(016, '378', '783783', '2020-12-28', 'image', '../file/2020-12-28_1609117977.png', 14, 29),
(017, '378', '378378', '2020-12-28', 'image', '../file/2020-12-28_1609117939.png', 14, 28),
(018, '45.45', '5.45.', '2020-12-28', 'image', '../file/2020-12-28_1609117945.png', 14, 28);

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
(53, 14, 13),
(54, 15, 4),
(55, 15, 5),
(56, 15, 6),
(57, 15, 12),
(58, 16, 5),
(59, 16, 6),
(60, 16, 10),
(61, 17, 4),
(62, 17, 5),
(63, 17, 12),
(64, 18, 6),
(65, 18, 7),
(66, 18, 10),
(67, 19, 7),
(68, 19, 10),
(69, 19, 14),
(70, 20, 7),
(71, 20, 14);

-- --------------------------------------------------------

--
-- 資料表結構 `plan`
--

CREATE TABLE `plan` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `detail` text COLLATE utf8_unicode_ci NOT NULL,
  `start_time` int(11) NOT NULL,
  `end_time` int(11) NOT NULL,
  `project_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `plan`
--

INSERT INTO `plan` (`id`, `name`, `detail`, `start_time`, `end_time`, `project_id`) VALUES
(1, '這是專案名稱', '這是專案說明', 1609161660, 1611797580, 6),
(2, '1', '1', 1609144680, 1609231080, 6),
(3, '2', '2', 1609144800, 1609231200, 6),
(5, 'gdfg', 'dfg', 1609146000, 1609318800, 19),
(6, 'hjk', 'hjk', 1606554000, 1580288400, 19),
(7, 'jh', 'kljkl', 1580202060, 1606640460, 20);

-- --------------------------------------------------------

--
-- 資料表結構 `plan_comment`
--

CREATE TABLE `plan_comment` (
  `id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `comment_id` int(3) UNSIGNED ZEROFILL NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `plan_comment`
--

INSERT INTO `plan_comment` (`id`, `plan_id`, `comment_id`) VALUES
(43, 1, 005),
(44, 1, 012),
(55, 2, 004),
(56, 2, 012),
(57, 3, 009),
(58, 3, 012),
(59, 7, 017),
(60, 7, 015),
(61, 7, 018),
(62, 7, 016);

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
(14, 'hk4g4', 'asdasd', 3),
(15, '78678', '6786', 7),
(16, '測試中', '測試中', 7),
(17, '專案用', '專案用', 7),
(18, 'adf', 'sdf', 5),
(19, 'dh', 'fgh', 4),
(20, 'werwere', 'hrth', 6);

-- --------------------------------------------------------

--
-- 資料表結構 `project_score`
--

CREATE TABLE `project_score` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `project_id` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `nums` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `project_score`
--

INSERT INTO `project_score` (`id`, `name`, `project_id`, `score`, `nums`) VALUES
(1, '評分指21號', 6, 0, 0),
(2, '評分指標測試', 6, 0, 0),
(3, '評分指標測試', 15, 0, 0),
(8, 'GG', 17, 0, 0),
(9, 'GGWP', 17, 0, 0),
(10, 'GGWXP', 17, 0, 0),
(11, 'asdf', 16, 0, 0),
(12, 'dfhgh', 16, 0, 0),
(14, '4551', 15, 0, 0),
(15, 'sg', 19, 0, 0),
(16, 'wer', 19, 0, 0),
(17, 'gjkhj', 20, 0, 0),
(18, 'hjk', 20, 0, 0);

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
(10, 3, 7, 011),
(11, 5, 7, 012),
(12, 3, 7, 013),
(13, 4, 7, 014),
(14, 5, 14, 015),
(15, 4, 14, 016);

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
(26, 'GG', 'GG', 6, 1),
(28, 'gk', 'hjk', 20, 1),
(29, ';jl;', 'kl;', 20, 1);

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
(13, '89', '6786', '8498', 3),
(14, 'XD', 'user1', '1234', 3);

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
-- 資料表索引 `plan`
--
ALTER TABLE `plan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id` (`project_id`);

--
-- 資料表索引 `plan_comment`
--
ALTER TABLE `plan_comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comment_id` (`comment_id`),
  ADD KEY `plan_id` (`plan_id`);

--
-- 資料表索引 `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_ibfk_1` (`leader`);

--
-- 資料表索引 `project_score`
--
ALTER TABLE `project_score`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id` (`project_id`);

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
  MODIFY `id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `comment_stratch`
--
ALTER TABLE `comment_stratch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `member`
--
ALTER TABLE `member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `plan`
--
ALTER TABLE `plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `plan_comment`
--
ALTER TABLE `plan_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `project`
--
ALTER TABLE `project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `project_score`
--
ALTER TABLE `project_score`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `score`
--
ALTER TABLE `score`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `side`
--
ALTER TABLE `side`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
-- 資料表的限制式 `plan`
--
ALTER TABLE `plan`
  ADD CONSTRAINT `plan_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的限制式 `plan_comment`
--
ALTER TABLE `plan_comment`
  ADD CONSTRAINT `plan_comment_ibfk_1` FOREIGN KEY (`comment_id`) REFERENCES `comment` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `plan_comment_ibfk_2` FOREIGN KEY (`plan_id`) REFERENCES `plan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的限制式 `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `project_ibfk_1` FOREIGN KEY (`leader`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- 資料表的限制式 `project_score`
--
ALTER TABLE `project_score`
  ADD CONSTRAINT `project_score_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
