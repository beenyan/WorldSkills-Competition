-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2021-01-25 04:40:09
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
-- 資料庫： `50 屆技能競賽[區賽] (二)`
--
CREATE DATABASE IF NOT EXISTS `50 屆技能競賽[區賽] (二)` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `50 屆技能競賽[區賽] (二)`;

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
(002, '第一個意見', '詳細資訊', '2021-01-24', 'image', 'file/2021-01-24_1611453712.png', 1, 1),
(003, '第二個意見', '詳細資訊', '2021-01-24', 'image', 'file/2021-01-24_1611453686.png', 1, 1),
(004, '第三個意見', '資訊詳細', '2021-01-24', 'video', 'file/2021-01-24_1611453719.mp4', 1, 1),
(005, '第四個意見', '資訊詳細', '2021-01-24', 'audio', 'file/2021-01-24_1611453669.mp3', 1, 1),
(006, '第五個意見', '詳細資訊', '2021-01-24', '', '', 7, 1),
(007, '第六個意見	', '詳細資訊', '2021-01-24', '', '', 1, 1),
(008, '第七個意見', '詳細資訊', '2021-01-24', 'image', 'file/2021-01-24_1611453665.png', 1, 1),
(009, '無聊', 'AA', '2021-01-25', '', '', 1, 2),
(010, '不無聊', 'GGGG', '2021-01-25', 'image', 'file/2021-01-25_1611536477.png', 1, 3),
(011, '未知', '159', '2021-01-25', 'image', 'file/2021-01-25_1611536494.png', 1, 4);

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
(1, 008, 002),
(2, 008, 007),
(3, 008, 008);

-- --------------------------------------------------------

--
-- 資料表結構 `leader`
--

CREATE TABLE `leader` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `project_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `leader`
--

INSERT INTO `leader` (`id`, `name`, `project_id`) VALUES
(2, 'GGWP', 2),
(3, 'fsdf', 2),
(4, 'dghh', 2),
(5, 'jghj', 2),
(6, 'qrwe', 2);

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
(1, 2, 3),
(2, 2, 4),
(3, 2, 5),
(4, 2, 6),
(5, 3, 3),
(6, 3, 4),
(7, 3, 5),
(8, 3, 7),
(9, 4, 1),
(10, 4, 3),
(11, 4, 8),
(12, 5, 3),
(13, 6, 3),
(14, 6, 4),
(15, 6, 9),
(16, 7, 1),
(17, 7, 3),
(18, 7, 4),
(19, 7, 5),
(20, 7, 9),
(21, 8, 1),
(22, 8, 3),
(23, 8, 4),
(24, 8, 6),
(60, 9, 1),
(61, 9, 3),
(62, 9, 4),
(63, 9, 6),
(64, 9, 7),
(65, 9, 8),
(66, 9, 9),
(68, 11, 4),
(69, 11, 5),
(70, 11, 6);

-- --------------------------------------------------------

--
-- 資料表結構 `plan`
--

CREATE TABLE `plan` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `detail` text COLLATE utf8_unicode_ci NOT NULL,
  `mode` int(1) NOT NULL DEFAULT 0 COMMENT '0：未開評分\r\n1：開始評分\r\n2：結束評分',
  `project_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `plan`
--

INSERT INTO `plan` (`id`, `name`, `detail`, `mode`, `project_id`) VALUES
(2, '第一個方案', 'XD', 1, 2),
(3, '第二個方案', 'GGWP', 1, 2),
(4, '待變化', 'ASD', 1, 2);

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
(1, 2, 006),
(2, 2, 009),
(3, 2, 010),
(4, 2, 011),
(5, 3, 005),
(6, 3, 009),
(7, 3, 010),
(8, 4, 005),
(9, 4, 009),
(10, 4, 011);

-- --------------------------------------------------------

--
-- 資料表結構 `plan_score`
--

CREATE TABLE `plan_score` (
  `id` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `plan_score`
--

INSERT INTO `plan_score` (`id`, `score`, `plan_id`, `user_id`) VALUES
(1, 4, 2, 4),
(2, 5, 3, 4),
(3, 4, 4, 4),
(4, 5, 2, 5),
(5, 1, 3, 5),
(6, 1, 4, 5);

-- --------------------------------------------------------

--
-- 資料表結構 `project`
--

CREATE TABLE `project` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `detail` text COLLATE utf8_unicode_ci NOT NULL,
  `leader` int(11) NOT NULL,
  `view` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `project`
--

INSERT INTO `project` (`id`, `name`, `detail`, `leader`, `view`) VALUES
(2, '社會科研', 'TNT試炸', 1, 1),
(3, '自然科學', '火焰發射器', 6, 0),
(4, '死亡數學', '超級無聊', 9, 0),
(5, '超難英文', '無敵無聊', 8, 0),
(6, '死亡雷射光', '耗能巨大', 1, 0),
(7, '動物方程式', '很多動物', 6, 0),
(8, '我要當隊長', '賄賂中', 5, 0),
(9, '修改專用', '修改專用', 5, 0),
(11, 'Covid 19', 'Can kill erveryone', 1, 0);

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
(1, 3, 7, 002),
(2, 5, 7, 003);

-- --------------------------------------------------------

--
-- 資料表結構 `side`
--

CREATE TABLE `side` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `detail` text COLLATE utf8_unicode_ci NOT NULL,
  `project_id` int(11) NOT NULL,
  `increase` tinyint(1) NOT NULL DEFAULT 1 COMMENT '是否可以發表意見'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `side`
--

INSERT INTO `side` (`id`, `name`, `detail`, `project_id`, `increase`) VALUES
(1, '打火機點燃', '不用錢的', 2, 1),
(2, '噴槍燒', '一些瓦斯費', 2, 1),
(3, '炭烤', '有焦香味', 2, 1),
(4, '電磁引爆', '需不受干擾', 2, 1);

-- --------------------------------------------------------

--
-- 資料表結構 `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `account` text COLLATE utf8_unicode_ci NOT NULL,
  `password` text COLLATE utf8_unicode_ci NOT NULL,
  `isAdmin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `user`
--

INSERT INTO `user` (`id`, `name`, `account`, `password`, `isAdmin`) VALUES
(1, 'John', 'admin', '1234', 1),
(3, 'utest1', 'test1', '1234', 0),
(4, 'utest2', 'test2', '1234', 0),
(5, 'utest3', 'test3', '1234', 0),
(6, 'utest4', 'test4', '1234', 0),
(7, 'utest5', 'test5', '1234', 0),
(8, 'utest6', 'test6', '1234', 0),
(9, 'utest7', 'test7', '1234', 0);

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
-- 資料表索引 `leader`
--
ALTER TABLE `leader`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id` (`project_id`);

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
-- 資料表索引 `plan_score`
--
ALTER TABLE `plan_score`
  ADD PRIMARY KEY (`id`),
  ADD KEY `plan_id` (`plan_id`),
  ADD KEY `user_id` (`user_id`);

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
  MODIFY `id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `comment_stratch`
--
ALTER TABLE `comment_stratch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `leader`
--
ALTER TABLE `leader`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `member`
--
ALTER TABLE `member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `plan`
--
ALTER TABLE `plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `plan_comment`
--
ALTER TABLE `plan_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `plan_score`
--
ALTER TABLE `plan_score`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `project`
--
ALTER TABLE `project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `project_score`
--
ALTER TABLE `project_score`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `score`
--
ALTER TABLE `score`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `side`
--
ALTER TABLE `side`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
-- 資料表的限制式 `leader`
--
ALTER TABLE `leader`
  ADD CONSTRAINT `leader_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- 資料表的限制式 `plan_score`
--
ALTER TABLE `plan_score`
  ADD CONSTRAINT `plan_score_ibfk_1` FOREIGN KEY (`plan_id`) REFERENCES `plan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `plan_score_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
