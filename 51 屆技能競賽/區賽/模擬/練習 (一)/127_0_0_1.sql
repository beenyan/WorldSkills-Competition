-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2021-03-19 02:55:03
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
-- 資料庫： `51 屆技能競賽[區賽] (一)`
--
CREATE DATABASE IF NOT EXISTS `51 屆技能競賽[區賽] (一)` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `51 屆技能競賽[區賽] (一)`;

-- --------------------------------------------------------

--
-- 資料表結構 `form`
--

CREATE TABLE `form` (
  `invite` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `page` int(11) NOT NULL DEFAULT 100,
  `need` int(11) NOT NULL DEFAULT 10,
  `isLocking` tinyint(1) DEFAULT 0,
  `user` int(11) NOT NULL,
  `count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `form`
--

INSERT INTO `form` (`invite`, `name`, `page`, `need`, `isLocking`, `user`, `count`) VALUES
('Math_0001', '數學問卷', 3, 10, 1, 1, 2),
('QQ1234', '金錢投資', 5, 4, 0, 1, 0),
('QQWP123', '食物類型', 5, 10, 0, 1, 12);

-- --------------------------------------------------------

--
-- 資料表結構 `question`
--

CREATE TABLE `question` (
  `id` int(11) NOT NULL,
  `invite` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(1) NOT NULL,
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `ques1` text COLLATE utf8_unicode_ci NOT NULL,
  `ques2` text COLLATE utf8_unicode_ci NOT NULL,
  `ques3` text COLLATE utf8_unicode_ci NOT NULL,
  `ques4` text COLLATE utf8_unicode_ci NOT NULL,
  `ques5` text COLLATE utf8_unicode_ci NOT NULL,
  `ques6` text COLLATE utf8_unicode_ci NOT NULL,
  `ques7` text COLLATE utf8_unicode_ci NOT NULL,
  `required` tinyint(1) NOT NULL,
  `another` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `question`
--

INSERT INTO `question` (`id`, `invite`, `type`, `title`, `ques1`, `ques2`, `ques3`, `ques4`, `ques5`, `ques6`, `ques7`, `required`, `another`) VALUES
(1, 'QQWP123', 4, '你對本問卷的看法', '', '', '', '', '', '', '', 0, 0),
(2, 'QQWP123', 3, '你喜歡吃甚麼?', '麵條', '飯粒', '藥水', '點滴', '炸彈', '牛排', '', 1, 0),
(3, 'QQWP123', 2, '以平常吃甚麼當主食?', '麵條', '飯粒', '藥水', '點滴', '', '', '', 0, 1),
(4, 'QQWP123', 1, '你會吃東西嗎?', '', '', '', '', '', '', '', 1, 0),
(5, 'QQ1234', 1, '你買過股票嗎?', '', '', '', '', '', '', '', 1, 0),
(6, 'QQ1234', 4, '你有買甚麼股票?', '', '', '', '', '', '', '', 0, 0),
(7, 'Math_0001', 2, '3+3=?', '2', '4', '6', '8', '10', '12', '', 1, 0),
(8, 'Math_0001', 1, '1+1=2?', '', '', '', '', '', '', '', 1, 0),
(9, 'Math_0001', 1, '2+2=4?', '', '', '', '', '', '', '', 1, 0),
(10, 'Math_0001', 2, '8+8', '16', '24', '36', '', '', '', '', 1, 0),
(11, 'Math_0001', 2, '7+7', '14', '24', '34', '44', '', '', '', 1, 1),
(12, 'Math_0001', 2, '6*6', '345', '45378', '7825', '25', '36', '', '', 1, 0),
(13, 'Math_0001', 3, 'x^2 = 4，x = ?', '2', '1', '3', '-2', '', '', '', 1, 0),
(14, 'Math_0001', 2, '10+10=?', '20', '40', '50', '60', '', '', '', 1, 0),
(15, 'Math_0001', 2, '80*80=?', '6400', '78378', '78345', '3453', '453', '', '', 1, 0),
(16, 'Math_0001', 2, '783+783+783=?', '78678', '678', '6786', '7867867', '86786', '以上皆非', '', 1, 0),
(17, 'Math_0001', 2, '4-5=?', '45', '245', '37', '87', '以上皆是', '以上皆非', '', 1, 0),
(18, 'Math_0001', 1, '你是人類嗎?', '', '', '', '', '', '', '', 1, 0),
(19, 'Math_0001', 1, '你有認真作答嗎?', '', '', '', '', '', '', '', 1, 0),
(20, 'Math_0001', 1, '你是機器人嗎?', '', '', '', '', '', '', '', 1, 0),
(21, 'Math_0001', 1, '你是炸彈超人嗎?', '', '', '', '', '', '', '', 1, 0),
(22, 'Math_0001', 1, '無限大 > 無限大 +1 ?', '', '', '', '', '', '', '', 1, 0),
(23, 'Math_0001', 1, '-5是無理數?', '', '', '', '', '', '', '', 1, 0),
(24, 'Math_0001', 2, '5+5=?', '10', '44', '573', '782', '25', '', '', 1, 0),
(25, 'Math_0001', 1, '是否因為這些題目對人生感到絕望?', '', '', '', '', '', '', '', 1, 0),
(26, 'Math_0001', 4, '這張考卷難嗎?', '', '', '', '', '', '', '', 1, 0);

-- --------------------------------------------------------

--
-- 資料表結構 `response`
--

CREATE TABLE `response` (
  `id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `ques1` tinyint(1) NOT NULL,
  `ques2` tinyint(1) NOT NULL,
  `ques3` tinyint(1) NOT NULL,
  `ques4` tinyint(1) NOT NULL,
  `ques5` tinyint(1) NOT NULL,
  `ques6` tinyint(1) NOT NULL,
  `another` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `response`
--

INSERT INTO `response` (`id`, `question_id`, `ques1`, `ques2`, `ques3`, `ques4`, `ques5`, `ques6`, `another`) VALUES
(1, 7, 0, 0, 0, 0, 0, 1, ''),
(2, 8, 1, 0, 0, 0, 0, 0, ''),
(3, 9, 1, 0, 0, 0, 0, 0, ''),
(4, 10, 1, 0, 0, 0, 0, 0, ''),
(5, 11, 1, 0, 0, 0, 0, 0, ''),
(6, 12, 0, 0, 0, 0, 1, 0, ''),
(7, 13, 1, 0, 0, 1, 0, 0, ''),
(8, 14, 1, 0, 0, 0, 0, 0, ''),
(9, 15, 1, 0, 0, 0, 0, 0, ''),
(10, 16, 0, 0, 0, 0, 0, 1, ''),
(11, 17, 0, 0, 0, 0, 0, 1, ''),
(12, 18, 0, 1, 0, 0, 0, 0, ''),
(13, 19, 0, 1, 0, 0, 0, 0, ''),
(14, 20, 1, 0, 0, 0, 0, 0, ''),
(15, 21, 0, 1, 0, 0, 0, 0, ''),
(16, 22, 0, 1, 0, 0, 0, 0, ''),
(17, 23, 1, 0, 0, 0, 0, 0, ''),
(18, 24, 1, 0, 0, 0, 0, 0, ''),
(19, 25, 1, 0, 0, 0, 0, 0, ''),
(20, 26, 0, 0, 0, 0, 0, 0, '非常難'),
(22, 2, 1, 0, 1, 0, 1, 0, ''),
(23, 4, 0, 1, 0, 0, 0, 0, ''),
(24, 3, 0, 0, 1, 0, 0, 0, ''),
(25, 2, 0, 1, 0, 0, 0, 0, ''),
(26, 4, 1, 0, 0, 0, 0, 0, ''),
(27, 1, 0, 0, 0, 0, 0, 0, '453'),
(28, 2, 0, 1, 0, 0, 0, 0, ''),
(29, 3, 1, 0, 0, 0, 0, 0, ''),
(30, 4, 0, 1, 0, 0, 0, 0, ''),
(31, 2, 1, 0, 0, 0, 0, 0, ''),
(32, 3, 0, 0, 1, 0, 0, 0, ''),
(33, 4, 1, 0, 0, 0, 0, 0, ''),
(34, 2, 1, 1, 0, 1, 0, 0, ''),
(35, 3, 0, 0, 1, 0, 0, 0, ''),
(36, 4, 1, 0, 0, 0, 0, 0, ''),
(37, 1, 0, 0, 0, 0, 0, 0, '456'),
(38, 2, 1, 1, 0, 1, 0, 0, ''),
(39, 3, 0, 0, 1, 0, 0, 0, ''),
(40, 4, 1, 0, 0, 0, 0, 0, ''),
(41, 1, 0, 0, 0, 0, 0, 0, '456'),
(42, 2, 1, 1, 0, 1, 0, 0, ''),
(43, 3, 0, 1, 0, 0, 0, 0, ''),
(44, 4, 1, 0, 0, 0, 0, 0, ''),
(45, 1, 0, 0, 0, 0, 0, 0, '456'),
(46, 2, 1, 1, 0, 1, 0, 0, ''),
(47, 3, 0, 1, 0, 0, 0, 0, ''),
(48, 4, 0, 1, 0, 0, 0, 0, ''),
(49, 1, 0, 0, 0, 0, 0, 0, '456'),
(50, 2, 1, 0, 0, 1, 1, 0, ''),
(51, 3, 0, 1, 0, 0, 0, 0, ''),
(52, 4, 0, 1, 0, 0, 0, 0, ''),
(53, 1, 0, 0, 0, 0, 0, 0, '456'),
(54, 2, 1, 0, 0, 0, 1, 1, ''),
(55, 3, 0, 1, 0, 0, 0, 0, ''),
(56, 4, 0, 1, 0, 0, 0, 0, ''),
(57, 1, 0, 0, 0, 0, 0, 0, '456'),
(58, 2, 1, 0, 0, 0, 1, 1, ''),
(59, 3, 0, 0, 0, 1, 0, 0, ''),
(60, 4, 0, 1, 0, 0, 0, 0, ''),
(61, 1, 0, 0, 0, 0, 0, 0, '456'),
(62, 2, 1, 0, 0, 0, 1, 1, ''),
(63, 3, 0, 0, 1, 0, 0, 0, ''),
(64, 4, 0, 1, 0, 0, 0, 0, ''),
(65, 1, 0, 0, 0, 0, 0, 0, '456453'),
(66, 2, 1, 0, 0, 0, 1, 1, ''),
(67, 3, 0, 0, 1, 0, 0, 0, ''),
(68, 4, 1, 0, 0, 0, 0, 0, ''),
(69, 2, 1, 0, 1, 0, 1, 1, ''),
(70, 3, 0, 0, 1, 0, 0, 0, ''),
(71, 4, 1, 0, 0, 0, 0, 0, ''),
(72, 2, 0, 0, 1, 0, 1, 1, ''),
(73, 3, 0, 0, 1, 0, 0, 0, ''),
(74, 4, 1, 0, 0, 0, 0, 0, '');

-- --------------------------------------------------------

--
-- 資料表結構 `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `account` text COLLATE utf8_unicode_ci NOT NULL,
  `password` text COLLATE utf8_unicode_ci NOT NULL,
  `rank` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `user`
--

INSERT INTO `user` (`id`, `name`, `account`, `password`, `rank`) VALUES
(1, '管理員', 'admin', '1234', 3);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `form`
--
ALTER TABLE `form`
  ADD PRIMARY KEY (`invite`),
  ADD KEY `user` (`user`);

--
-- 資料表索引 `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invite` (`invite`);

--
-- 資料表索引 `response`
--
ALTER TABLE `response`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_id` (`question_id`);

--
-- 資料表索引 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `question`
--
ALTER TABLE `question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `response`
--
ALTER TABLE `response`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `form`
--
ALTER TABLE `form`
  ADD CONSTRAINT `form_ibfk_1` FOREIGN KEY (`user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的限制式 `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `question_ibfk_1` FOREIGN KEY (`invite`) REFERENCES `form` (`invite`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的限制式 `response`
--
ALTER TABLE `response`
  ADD CONSTRAINT `response_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
