-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2019 at 10:04 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kamudb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `hash` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT '0',
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `first_name`, `last_name`, `email`, `password`, `hash`, `verified`, `deleted`) VALUES
(1, 'Anjala', 'Dilahara', 'ad@ad.com', '$2y$10$lO/3azXVdJ1aLxQp2Tll.eGnKe6r2iOfA311oKE.OXVenYqG4p52u', '6f4922f45568161a8cdf4ad2299f6d23', 0, 0),
(3, 'Thumula', 'Nimal', 'thumula@gmail.com', '$2y$10$Vh86n8AbQW6hzNsiZtXQ9.TNKfWhyavHmXmq/JyaRTApNhskRIcGa', '2838023a778dfaecdc212708f721b788', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `cashiers`
--

CREATE TABLE `cashiers` (
  `id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `first_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `hash` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `disabled` tinyint(1) NOT NULL DEFAULT '0',
  `verified` tinyint(1) NOT NULL DEFAULT '0',
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cashiers`
--

INSERT INTO `cashiers` (`id`, `restaurant_id`, `first_name`, `last_name`, `email`, `password`, `hash`, `disabled`, `verified`, `deleted`) VALUES
(1, 1, 'Daa', 'ad@ad.com', 'ad@ad.com', '$2y$10$WJSbLiho/Yxvwq7capXT3uJZhrEqBw6LWP3CZdxt4ZF5MJ5eREpiC', '70efdf2ec9b086079795c442636b55fb', 0, 0, 0),
(2, 1, 'Anjala', 'dsd', 'anjaladilhara@gmail.com', '$2y$10$mHQVRCOh4KPU1iNp5WUxRuyfSAHPeBsTJNSeplCJRStx/ssULaX5C', '8e296a067a37563370ded05f5a3bf3ec', 0, 0, 0),
(3, 1, 'Cashier1', 'Cashier1Last', 'cachier1@gmail.com', '$2y$10$2zwTvvlbjnrCnHE1xzBz5u8.xP91vQnhPvnb9UhYMHBx1Bk2NRFBy', '37693cfc748049e45d87b8c7d8b9aacd', 0, 0, 0),
(4, 2, 'cashier1', 'cachier1last', 'millanium.cashier1@gmail.com', '$2y$10$8z8Uo.v/uBBfa2AQNGETr.IqBq3xrpEtFT/bdi2aYIhdc1v24xSJm', 'd09bf41544a3365a46c9077ebb5e35c3', 0, 0, 0),
(5, 2, 'cashier2', 'cachier2last', 'millanium.cashier2@gmail.com', '$2y$10$1fnEP84IDNDC4nVahFUiZu.dtPP6yY4xTqXR3ZyhzTqekMQ1HD2AC', 'c51ce410c124a10e0db5e4b97fc2af39', 0, 0, 0),
(6, 2, 'cashier3', 'cachier3last', 'millanium.cashier3@gmail.com', '$2y$10$RxVciB5essaM/3SMYjUwyevdUoy4B1bMnP8VnwK9yqPAbb/k2OMFa', 'd3d9446802a44259755d38e6d163e820', 0, 0, 0),
(7, 2, 'cashier4', 'cachier4last', 'millanium.cashier4@gmail.com', '$2y$10$xfZrYJ4hl5Gt.7pzO/qPR.62Hs/uZKDZTRxs5Aghw8sYd5PaXAvLa', '072b030ba126b2f4b2374f342be9ed44', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `hash` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT '0',
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `first_name`, `last_name`, `email`, `password`, `hash`, `verified`, `deleted`) VALUES
(1, 'Chamikai', 'Nimal', 'ad@ad.com', '$2y$10$MU4a5jPsgvKoksAJcWY7U.JZzXo3XU16Kt82yas70sCU1ezxxgfxu', 'cfcd208495d565ef66e7dff9f98764da', 0, 0),
(3, 'Thumula', 'Na', 'thumula@gmail.com', '$2y$10$/.inTtfMvoTSCCoH4RBt5.vG5Grg1BrDU9kmyqVEIkicQuQxJrA6O', 'c0c7c76d30bd3dcaefc96f40275bdc0a', 0, 0),
(4, 'anjala', 'dilhara', 'anjaladilhara@gmail.com', '$2y$10$CNaMpSNn6kDummFGp43edu5qZO0rMu6ogDtFjfZUNguASvwilpDmW', 'd2ddea18f00665ce8623e36bd4e3c7c5', 1, 0),
(5, 'hg', 'qwe', 'c9@qwe.com', '$2y$10$/.inTtfMvoTSCCoH4RBt5.vG5Grg1BrDU9kmyqVEIkicQuQxJrA6O', '3c59dc048e8850243be8079a5c74d079', 0, 0),
(6, 'customer1', 'customer1last', 'customer1@gmail.com', '$2y$10$BmIOBt6WJPO./8UjdzNjeeTtY6bIf.9ulKzyho63HJ96Q7duQLuT6', '8613985ec49eb8f757ae6439e879bb2a', 0, 0),
(7, 'customer2', 'customer2last', 'customer2@gmail.com', '$2y$10$yP5hPX5PzVKqo3RG7ufagO7k1ke0ucRJ5nHrTko1YL6CrSR5SRWCy', 'a5771bce93e200c36f7cd9dfd0e5deaa', 0, 0),
(8, 'customer3', 'customer3last', 'customer3@gmail.com', '$2y$10$kKU2Yj9M6gE4rcbqhEJ3AOas1r0/TZ6lWi0.WaVtinbfvTQA093/m', '093f65e080a295f8076b1c5722a46aa2', 0, 0),
(9, 'Thumula', 'Perera', 'thumusteam@gmail.com', '$2y$10$cO44UFTo31C1ysWSoo3vHO4.Thk.qXN2kkGN4RUTUHtKPaLCh1wHq', 'c74d97b01eae257e44aa9d5bade97baf', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `item_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `image_url` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `rating` double NOT NULL,
  `rating_num` int(11) NOT NULL DEFAULT '0',
  `hidden` tinyint(1) NOT NULL DEFAULT '0',
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `restaurant_id`, `item_name`, `description`, `price`, `image_url`, `rating`, `rating_num`, `hidden`, `deleted`) VALUES
(1, 1, 'beef and rice', 'Indian style beef served with steamed rice', 300, '/mvc/img/items/1559064546rl9P1NlLS0.png', 0, 0, 0, 0),
(26, 1, 'chicken biriyani', 'Description of chicken biriyani', 350, '/mvc/img/items/15590648939gET1ji2M3.png', 0, 0, 0, 0),
(30, 2, 'Koththu', 'Enjoy the goodness of little bits of heaven', 300, '/mvc/img/items/1552914320.png', 0, 0, 0, 0),
(31, 2, 'Fried Rice', 'Enjoy the taste of china ', 250, '/mvc/img/items/1552914407.png', 0, 0, 0, 0),
(32, 2, 'Soup', 'Description of soup', 100, '/mvc/img/items/1552931132.png', 0, 0, 0, 0),
(34, 1, 'beef steak', 'description of beef steak', 400, '/mvc/img/items/1559064734FB9g4AsbRC.png', 0, 0, 0, 0),
(147, 2, 'Hoppers', 'description of hoppers', 20, '/mvc/img/items/1554563173.png', 0, 0, 0, 0),
(151, 2, 'steamed rice', 'description of steamed rice', 150, '/mvc/img/items/1554564091.png', 0, 0, 0, 0),
(152, 1, 'chicken burger', 'description of chicken burger', 350, '/mvc/img/items/15590648186WHwwMRwAM.png', 0, 0, 0, 0),
(153, 1, 'beef biriyani', 'Description of beef biriyani', 400, '/mvc/img/items/1559064639ej3jgvFTMG.png', 0, 0, 0, 0),
(155, 1, 'chicken lasagna', 'description of chicken lasagna', 400, '/mvc/img/items/1559064989G9ixGJ8Bbr.png', 0, 0, 0, 0),
(156, 1, 'chicken fried rice', 'description of chicken fried rice', 300, '/mvc/img/items/1559065074Bq4E6XxoGJ.png', 0, 0, 0, 0),
(157, 1, 'egg hoppers', 'description of hoppers', 50, '/mvc/img/items/155906518633HGwQGI0w.png', 0, 0, 0, 0),
(158, 1, 'chicken koththu', 'description of koththu', 250, '/mvc/img/items/1559065833S9Xd0fCRTg.png', 0, 0, 0, 0),
(159, 1, 'nasi goreng', 'description of nasi goreng', 300, '/mvc/img/items/1559065709jhFPdcUf4O.png', 0, 0, 0, 0),
(160, 1, 'noodles', 'description of noodles', 250, '/mvc/img/items/1559065642RUExd0ZpZ0.png', 0, 0, 0, 0),
(161, 1, 'rice and curry', 'description of rice and curry', 200, '/mvc/img/items/1559065608FXXfd6oYyV.png', 0, 0, 0, 0),
(162, 1, 'chicken submarine', 'description of chicken submarine', 300, '/mvc/img/items/15590657840P4108vJpH.png', 0, 0, 0, 0),
(163, 1, 'thai rice', 'description of thai rice', 300, '/mvc/img/items/1559065940VgHijqx8UR.png', 0, 0, 0, 0),
(164, 1, 'chicken submarine', 'description of submarine', 300, '/mvc/img/items/1559066097sesawSjXNu.png', 0, 0, 0, 1),
(165, 3, 'beef biriyani', 'description of beef biriyani of res2', 400, '/mvc/img/items/1559070875TFKi1u2MxH.png', 0, 0, 0, 0),
(166, 3, 'beef burger', 'description of beef burger', 300, '/mvc/img/items/15590709772yDfSSPNwv.png', 0, 0, 0, 0),
(167, 3, 'chicken burger', 'description of chicken burger', 300, '/mvc/img/items/1559071046PHHaOX8d1e.png', 0, 0, 0, 0),
(168, 3, 'chicken biriyani', 'description of chicken biriyani', 350, '/mvc/img/items/1559071112bFiHMtx29e.png', 0, 0, 0, 0),
(169, 3, 'fish and chips', 'description of fish and chips', 400, '/mvc/img/items/1559071172VTdusYoGok.png', 0, 0, 0, 0),
(170, 3, 'fried rice', 'description of fried rice', 300, '/mvc/img/items/1559071226jC4XWzJQ7G.png', 0, 0, 0, 0),
(171, 3, 'egg hopper', 'description of egg hopper', 40, '/mvc/img/items/1559071294hyWkELjobw.png', 0, 0, 0, 0),
(172, 3, 'koththu', 'description of koththu', 250, '/mvc/img/items/1559071337h9rvRt6oRs.png', 0, 0, 0, 0),
(173, 3, 'nasi goreng', 'description of nasi goreng', 350, '/mvc/img/items/default.png', 0, 0, 0, 0),
(174, 3, 'noodles', 'description of noodles', 250, '/mvc/img/items/default.png', 0, 0, 0, 0),
(175, 3, 'rice and curry', 'description of rice and curry', 150, '/mvc/img/items/1559071486pBuBb05pwv.png', 0, 0, 0, 0),
(176, 3, 'chicken submarine', 'description of chicken submarine', 350, '/mvc/img/items/1559071546gSzUUIxKfj.png', 0, 0, 0, 0),
(177, 4, 'fish and chips', 'description of fish and chips', 350, '/mvc/img/items/1559071620Of4z8XmkjL.png', 0, 0, 0, 0),
(178, 4, 'fried rice', 'description of fried rice', 250, '/mvc/img/items/1559071672g9DFRvfJJt.png', 0, 0, 0, 0),
(179, 4, 'koththu', 'description of koththu', 300, '/mvc/img/items/1559071715izErDKvIkk.png', 0, 0, 0, 0),
(180, 4, 'nasi goreng', 'description of nasi goreng', 350, '/mvc/img/items/15590717751cFJv2i1iV.png', 0, 0, 0, 0),
(181, 4, 'noodles', 'description of noodles', 250, '/mvc/img/items/1559071823Eq5Dx4d3op.png', 0, 0, 0, 0),
(182, 4, 'rice and curry', 'description of rice and curry', 180, '/mvc/img/items/1559071890ydNfeYER8S.png', 0, 0, 0, 0),
(183, 4, 'thai rice', 'description of thai rice', 300, '/mvc/img/items/1559071932r2RX85rWRC.png', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `item_tags`
--

CREATE TABLE `item_tags` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `tag_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `item_tags`
--

INSERT INTO `item_tags` (`id`, `item_id`, `tag_id`) VALUES
(63, 153, 104),
(64, 153, 114),
(65, 153, 116),
(66, 153, 117),
(67, 1, 104),
(68, 1, 103),
(69, 1, 117),
(70, 1, 82),
(71, 1, 1),
(72, 34, 104),
(73, 34, 123),
(74, 34, 125),
(75, 34, 126),
(76, 152, 129),
(77, 152, 128),
(78, 152, 127),
(79, 152, 126),
(80, 26, 116),
(81, 26, 128),
(82, 26, 131),
(83, 26, 117),
(84, 155, 128),
(85, 155, 135),
(86, 155, 137),
(87, 156, 128),
(88, 156, 138),
(89, 156, 141),
(90, 156, 88),
(91, 157, 143),
(92, 157, 142),
(93, 157, 9),
(94, 157, 145),
(104, 161, 128),
(105, 161, 82),
(106, 161, 155),
(107, 161, 145),
(108, 160, 141),
(109, 160, 143),
(110, 160, 86),
(111, 159, 150),
(112, 159, 151),
(113, 159, 149),
(114, 162, 128),
(115, 162, 165),
(116, 162, 168),
(117, 162, 167),
(118, 162, 126),
(119, 158, 128),
(120, 158, 146),
(121, 158, 147),
(122, 163, 128),
(123, 163, 174),
(124, 163, 173),
(125, 164, 128),
(126, 164, 165),
(127, 164, 168),
(128, 164, 167),
(129, 164, 126),
(130, 31, 128),
(131, 31, 141),
(132, 31, 88),
(133, 147, 9),
(134, 147, 145),
(135, 147, 186),
(136, 147, 187),
(137, 30, 128),
(138, 30, 147),
(139, 30, 2),
(140, 30, 1),
(141, 151, 82),
(142, 151, 145),
(143, 151, 192),
(144, 32, 84),
(145, 32, 196),
(146, 32, 187),
(149, 165, 104),
(150, 165, 114),
(151, 165, 116),
(152, 165, 117),
(153, 166, 104),
(154, 166, 204),
(155, 166, 129),
(156, 166, 126),
(157, 167, 129),
(158, 167, 128),
(159, 167, 127),
(160, 167, 126),
(161, 168, 116),
(162, 168, 128),
(163, 168, 131),
(164, 168, 117),
(165, 169, 218),
(166, 169, 217),
(167, 169, 216),
(168, 169, 219),
(169, 169, 126),
(170, 170, 128),
(171, 170, 141),
(172, 170, 88),
(173, 171, 143),
(174, 171, 224),
(175, 171, 227),
(176, 171, 145),
(177, 172, 128),
(178, 172, 147),
(179, 172, 1),
(180, 173, 128),
(181, 173, 143),
(182, 173, 150),
(183, 173, 149),
(184, 174, 141),
(185, 174, 143),
(186, 174, 86),
(187, 175, 240),
(188, 175, 217),
(189, 175, 82),
(190, 175, 155),
(191, 175, 145),
(192, 176, 128),
(193, 176, 165),
(194, 176, 168),
(195, 176, 167),
(196, 176, 126),
(197, 177, 218),
(198, 177, 217),
(199, 177, 216),
(200, 177, 219),
(201, 177, 126),
(202, 178, 128),
(203, 178, 141),
(204, 178, 88),
(205, 178, 82),
(206, 179, 128),
(207, 179, 147),
(208, 179, 1),
(209, 180, 128),
(210, 180, 143),
(211, 180, 150),
(212, 180, 151),
(213, 180, 149),
(214, 180, 1),
(215, 181, 128),
(216, 181, 141),
(217, 181, 86),
(218, 181, 1),
(219, 182, 217),
(220, 182, 82),
(221, 182, 155),
(222, 182, 145),
(223, 183, 128),
(224, 183, 1),
(225, 183, 174),
(226, 183, 173);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `customer_id` int(11) NOT NULL,
  `items` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `restaurant_id` int(11) NOT NULL,
  `type` tinyint(1) DEFAULT NULL,
  `delivery_time` datetime DEFAULT NULL,
  `order_code` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `submitted` tinyint(1) NOT NULL DEFAULT '0',
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `notes` varchar(200) COLLATE utf8_unicode_ci DEFAULT 'None...'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_name`, `customer_id`, `items`, `restaurant_id`, `type`, `delivery_time`, `order_code`, `submitted`, `time_stamp`, `notes`) VALUES
(3, 'Saved Order', 1, '{\"1\":4,\"26\":2}', 1, 2, NULL, NULL, 0, '2019-03-29 14:27:53', 'None...'),
(6, 'Saved Order', 1, '{\"1\":1,\"34\":1,\"26\":1}', 1, 1, NULL, NULL, 0, '2019-04-01 15:32:47', 'None...'),
(11, 'Saved Order', 1, '{\"26\":1,\"1\":1}', 1, 2, NULL, NULL, 1, '2019-04-12 13:09:28', 'None...'),
(18, 'Saved Order', 1, '{\"34\":1,\"26\":1,\"1\":1}', 1, 1, NULL, NULL, 0, '2019-04-12 13:38:36', 'None...'),
(19, 'Saved Order', 1, '{\"34\":1,\"26\":1}', 1, 1, NULL, NULL, 1, '2019-04-12 13:40:44', 'None...'),
(20, 'Saved Order', 4, '{\"34\":1,\"1\":1}', 1, 1, NULL, NULL, 0, '2019-04-17 18:14:58', 'None...'),
(21, 'Saved Order', 4, '{\"34\":1,\"26\":1}', 1, 2, NULL, NULL, 0, '2019-04-17 18:17:14', 'None...'),
(22, 'Saved Order', 4, '{\"147\":1,\"30\":1}', 2, 2, NULL, NULL, 0, '2019-04-23 05:23:07', 'None...'),
(23, '', 1, '{\"1\":1,\"34\":1,\"26\":1}', 1, 2, NULL, NULL, 0, '2019-05-24 10:35:55', 'None...'),
(24, '', 1, '{\"1\":4,\"26\":2}', 1, 2, '2019-05-04 18:34:00', '1558703273.0689', 0, '2019-05-24 13:07:53', NULL),
(25, '', 1, '{\"1\":1}', 1, 2, '2019-05-31 19:10:00', '1558704689.8524', 1, '2019-05-24 13:31:29', NULL),
(26, '', 1, '{\"34\":1}', 1, 1, '2019-05-15 19:15:00', '5ce7f58e.5536', 1, '2019-05-24 13:45:50', NULL),
(27, '', 1, '{\"152\":1}', 1, 2, '2019-05-29 19:18:00', '5CE7F629.0844', 1, '2019-05-24 13:48:25', NULL),
(28, '', 1, '{\"34\":1,\"26\":1,\"1\":9}', 1, 2, '2019-05-15 18:31:00', '5CE93CCD.792', 1, '2019-05-25 13:02:05', 'None......'),
(29, '', 1, '{\"34\":1,\"26\":1,\"1\":7}', 1, 2, '2019-05-31 19:50:00', '5CE94F39.4681', 1, '2019-05-25 14:20:41', ''),
(30, '', 1, '{\"1\":11,\"26\":2}', 1, 2, '2019-05-11 03:01:00', '5CE9B456.8691', 1, '2019-05-25 21:32:06', 'nothing'),
(31, '', 1, '{\"1\":4,\"26\":10}', 1, 2, '2019-05-11 17:34:00', '5CEA80D2.8821', 1, '2019-05-26 12:04:34', 'None.....'),
(32, '', 1, '{\"34\":1,\"26\":1,\"1\":1}', 1, 2, '2019-05-26 18:23:00', '5CEA8C40.9142', 1, '2019-05-26 12:53:20', 'Spicy'),
(33, '', 1, '{\"1\":4,\"26\":14}', 1, 2, '2019-05-26 18:58:00', '5CEA947A.031', 1, '2019-05-26 13:28:26', ''),
(34, '', 1, '{\"1\":1,\"34\":1,\"26\":1}', 1, 2, '2019-05-26 18:59:00', '5CEA94B1.6756', 1, '2019-05-26 13:29:21', 'notes....'),
(35, '', 1, '{\"34\":1,\"26\":1,\"1\":1}', 1, 2, '2019-05-26 18:59:00', '5CEA94CC.445', 1, '2019-05-26 13:29:48', ''),
(36, '', 1, '{\"1\":4,\"26\":2}', 1, 2, '2019-05-27 12:12:00', '5CEADE1D.0149', 1, '2019-05-26 18:42:37', ''),
(37, '', 1, '{\"1\":4,\"26\":2}', 1, 2, '2019-05-27 12:16:00', '5CEADEED.8741', 1, '2019-05-26 18:46:05', '');

-- --------------------------------------------------------

--
-- Table structure for table `owners`
--

CREATE TABLE `owners` (
  `id` int(11) NOT NULL,
  `restaurant_id` int(11) DEFAULT NULL,
  `first_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `hash` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT '0',
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `owners`
--

INSERT INTO `owners` (`id`, `restaurant_id`, `first_name`, `last_name`, `email`, `password`, `hash`, `verified`, `deleted`) VALUES
(1, 1, 'Owner', 'Owner', 'owner@testmail.com', '$2y$10$qq9.h2y.o5olleUHZOR8e.c3HjhLLq0PJEj9yKmC7UHonJrZ3eVRS', 'fe9fc289c3ff0af142b6d3bead98a923', 1, 0),
(2, 2, 'Thumula', 'Perera', 'thumula@gmail.com', '$2y$10$qq9.h2y.o5olleUHZOR8e.c3HjhLLq0PJEj9yKmC7UHonJrZ3eVRS', '92cc227532d17e56e07902b254dfad10', 1, 0),
(5, 3, 'Chamika', 'Nandasiri', 'chamika@gmail.com', '$2y$10$qq9.h2y.o5olleUHZOR8e.c3HjhLLq0PJEj9yKmC7UHonJrZ3eVRS', 'fbd7939d674997cdb4692d34de8633c4', 0, 0),
(6, NULL, 'Thumula', 'Perera', 'thumusteam@gmail.com', '$2y$10$dnSWFJEonpMI1cW5GVBuHus9FEFXBjyOiXm7.W3SX92WkFmxtCwei', '37693cfc748049e45d87b8c7d8b9aacd', 1, 0),
(7, 4, 'Anjala', 'Dilhara', 'anjala@gmail.com', '$2y$10$FcRALTrvjuRmUjNsYADI/eGEPmlJyDrigMeUQX5fGNeJGVFlPTMsa', 'a5bfc9e07964f8dddeb95fc584cd965d', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `rating` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `item_id`, `customer_id`, `rating`) VALUES
(23, 1, 1, 4),
(24, 147, 1, 3),
(25, 31, 1, 1),
(26, 153, 1, 2),
(27, 34, 1, 5),
(28, 152, 1, 4),
(29, 26, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `restaurants`
--

CREATE TABLE `restaurants` (
  `id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `restaurant_name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image_url` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `telephone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `lng` int(11) NOT NULL,
  `lat` int(11) NOT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT '0',
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `restaurants`
--

INSERT INTO `restaurants` (`id`, `owner_id`, `restaurant_name`, `address`, `image_url`, `telephone`, `email`, `lng`, `lat`, `verified`, `deleted`) VALUES
(1, 1, 'Kama Kade', '190 tpl', '/Kamu_1.0/exported/img/restaurant/1558533839.png', '12482042', 'kkadilhara@gmail.com', 80, 7, 1, 0),
(2, 2, 'Millanium Restaurant', '3421 rd', '/Kamu_1.0/exported/img/restaurant/1558533870.png', '12482123', 'sda@gmail.com', 81, 8, 1, 0),
(3, 5, 'Rainbow foods', '333/Colombo', '/mvc/img/restaurant/1559072310.png', '0112399345', 'chamika@gmail.com', 80, 7, 1, 0),
(4, 7, 'Sakura Foods', '56/Moratuwa', '/mvc/img/restaurant/1559073102.png', '0118796045', 'anjala@gmail.com', 80, 6, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `submitted_orders`
--

CREATE TABLE `submitted_orders` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `items` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `type` tinyint(1) NOT NULL,
  `delivery_time` datetime DEFAULT NULL,
  `order_code` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `accepted` tinyint(1) NOT NULL DEFAULT '0',
  `rejected` tinyint(1) NOT NULL DEFAULT '0',
  `completed` tinyint(1) NOT NULL DEFAULT '0',
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `notes` varchar(200) COLLATE utf8_unicode_ci DEFAULT 'None...',
  `total_price` double NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `submitted_orders`
--

INSERT INTO `submitted_orders` (`id`, `customer_id`, `items`, `restaurant_id`, `type`, `delivery_time`, `order_code`, `accepted`, `rejected`, `completed`, `time_stamp`, `notes`, `total_price`) VALUES
(2, 1, '{\"34\":1,\"26\":1,\"1\":1}', 1, 1, NULL, NULL, 1, 0, 0, '2019-04-12 13:38:36', 'None...', 0),
(4, 4, '{\"34\":1,\"1\":1}', 1, 1, NULL, NULL, 1, 0, 0, '2019-04-17 18:14:58', 'None...', 0),
(5, 4, '{\"34\":1,\"26\":1}', 1, 2, NULL, NULL, 1, 0, 0, '2019-04-17 18:17:14', 'None...', 0),
(6, 1, '{\"1\":1,\"34\":1,\"26\":1}', 1, 2, NULL, NULL, 1, 0, 0, '2019-05-24 10:35:55', 'None...', 0),
(7, 1, '{\"1\":4,\"26\":2}', 1, 2, '2019-05-04 18:34:00', '1558703273.0689', 1, 0, 0, '2019-05-24 13:07:53', NULL, 0),
(9, 1, '{\"34\":1}', 2, 1, '2019-05-15 19:15:00', '5ce7f58e.5536', 0, 0, 0, '2019-05-24 13:45:50', NULL, 0),
(10, 1, '{\"152\":1}', 1, 2, '2019-05-29 19:18:00', '5CE7F629.0844', 0, 1, 0, '2019-05-24 13:48:25', NULL, 0),
(11, 1, '{\"34\":1,\"26\":1,\"1\":9}', 1, 2, '2019-05-15 18:31:00', '5CE93CCD.792', 0, 0, 0, '2019-05-25 13:02:05', 'None......', 0),
(12, 1, '{\"34\":1,\"26\":1,\"1\":7}', 1, 2, '2019-05-31 19:50:00', '5CE94F39.4681', 1, 0, 0, '2019-05-25 14:20:41', '', 2030),
(13, 1, '{\"1\":11,\"26\":2}', 1, 2, '2019-05-11 03:01:00', '5CE9B456.8691', 1, 0, 0, '2019-05-25 21:32:06', 'nothing', 3030),
(14, 1, '{\"1\":4,\"26\":10}', 1, 2, '2019-05-11 17:34:00', '5CEA80D2.8821', 1, 0, 0, '2019-05-26 12:04:34', 'None.....', 2400),
(16, 1, '{\"1\":4,\"26\":14}', 1, 2, '2019-05-26 18:58:00', '5CEA947A.031', 1, 0, 1, '2019-05-26 13:28:26', '', 2960),
(17, 1, '{\"1\":1,\"34\":1,\"26\":1}', 1, 2, '2019-05-26 18:59:00', '5CEA94B1.6756', 0, 0, 0, '2019-05-26 13:29:21', 'notes....', 530),
(18, 1, '{\"34\":1,\"26\":1,\"1\":1}', 1, 2, '2019-05-26 18:59:00', '5CEA94CC.445', 0, 0, 0, '2019-05-26 13:29:48', '', 530),
(19, 1, '{\"1\":4,\"26\":2}', 1, 2, '2019-05-26 19:00:00', '5CEA94FD.3943', 1, 0, 1, '2019-05-26 13:30:37', '', 1280),
(21, 1, '{\"1\":4,\"26\":2}', 1, 2, '2019-05-27 12:16:00', '5CEADEED.8741', 1, 0, 0, '2019-05-26 18:46:05', '', 1280);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `tag_name` varchar(25) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `tag_name`) VALUES
(104, 'beef'),
(103, 'beef and rice'),
(114, 'beef biriyani'),
(204, 'beef burger'),
(123, 'beef steak'),
(116, 'biriyani'),
(129, 'burger'),
(128, 'chicken'),
(131, 'chicken biriyani'),
(127, 'chicken burger'),
(138, 'chicken fried rice'),
(146, 'chicken koththu'),
(135, 'chicken lasagna'),
(165, 'chicken submarine'),
(141, 'chinese'),
(218, 'chips'),
(240, 'curry'),
(143, 'egg'),
(224, 'egg hopper'),
(142, 'egg hoppers'),
(217, 'fish'),
(216, 'fish and chips'),
(88, 'fried rice'),
(219, 'fries'),
(227, 'hopper'),
(9, 'hoppers'),
(83, 'hot'),
(117, 'indian'),
(150, 'indonesian'),
(147, 'koththu'),
(2, 'kottu'),
(137, 'lasagna'),
(96, 'milk'),
(101, 'milk ric'),
(95, 'milk rice'),
(151, 'nasi'),
(149, 'nasi goreng'),
(5, 'new'),
(86, 'noodles'),
(82, 'rice'),
(155, 'rice and curry'),
(6, 'sdkfs'),
(84, 'soup'),
(1, 'spicy'),
(145, 'sri lankan'),
(125, 'steak'),
(192, 'steamed rice'),
(168, 'sub'),
(167, 'submarine'),
(91, 'tag'),
(8, 'tasty'),
(174, 'thai'),
(173, 'thai rice'),
(186, 'vege'),
(196, 'vegetable'),
(187, 'vegetarian'),
(126, 'western');

-- --------------------------------------------------------

--
-- Table structure for table `user_sessions`
--

CREATE TABLE `user_sessions` (
  `id` int(11) NOT NULL,
  `user_type` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `session` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_agent` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cashiers`
--
ALTER TABLE `cashiers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `restaurant_id` (`restaurant_id`);

--
-- Indexes for table `item_tags`
--
ALTER TABLE `item_tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `restaurant_id` (`restaurant_id`);

--
-- Indexes for table `owners`
--
ALTER TABLE `owners`
  ADD PRIMARY KEY (`id`),
  ADD KEY `restaurant_id` (`restaurant_id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `submitted_orders`
--
ALTER TABLE `submitted_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `restaurant_id` (`restaurant_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tag_name` (`tag_name`);

--
-- Indexes for table `user_sessions`
--
ALTER TABLE `user_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cashiers`
--
ALTER TABLE `cashiers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=184;

--
-- AUTO_INCREMENT for table `item_tags`
--
ALTER TABLE `item_tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=227;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `owners`
--
ALTER TABLE `owners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `submitted_orders`
--
ALTER TABLE `submitted_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=278;

--
-- AUTO_INCREMENT for table `user_sessions`
--
ALTER TABLE `user_sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`);

--
-- Constraints for table `item_tags`
--
ALTER TABLE `item_tags`
  ADD CONSTRAINT `item_tags_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`);

--
-- Constraints for table `owners`
--
ALTER TABLE `owners`
  ADD CONSTRAINT `owners_ibfk_1` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`);

--
-- Constraints for table `submitted_orders`
--
ALTER TABLE `submitted_orders`
  ADD CONSTRAINT `submitted_orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `submitted_orders_ibfk_2` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
