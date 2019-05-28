-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2019 at 07:17 PM
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
(1, 1, 'dasdsdsds', 'ad@ad.com', 'ad@ad.com', '$2y$10$vxKEL6IKVyvZJsytqgZC8On1M7Abx29bSEEovhYQYnxp4juwXDIdO', '072b030ba126b2f4b2374f342be9ed44', 0, 0, 0);

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
(1, 'Chamik', 'Nimal', 'ad@ad.com', '$2y$10$/.inTtfMvoTSCCoH4RBt5.vG5Grg1BrDU9kmyqVEIkicQuQxJrA6O', '54229abfcfa5649e7003b83dd4755294', 0, 0),
(3, 'Thumula', 'Na', 'thumula@gmail.com', '$2y$10$/.inTtfMvoTSCCoH4RBt5.vG5Grg1BrDU9kmyqVEIkicQuQxJrA6O', 'c0c7c76d30bd3dcaefc96f40275bdc0a', 0, 0),
(4, 'anjala', 'dilhara', 'anjaladilhara@gmail.com', '$2y$10$CNaMpSNn6kDummFGp43edu5qZO0rMu6ogDtFjfZUNguASvwilpDmW', 'd2ddea18f00665ce8623e36bd4e3c7c5', 1, 0),
(5, 'hg', 'qwe', 'c9@qwe.com', '$2y$10$/.inTtfMvoTSCCoH4RBt5.vG5Grg1BrDU9kmyqVEIkicQuQxJrA6O', '3c59dc048e8850243be8079a5c74d079', 0, 0);

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
(1, 1, 'Kottu', 'Perfect combination of cut up roti and chickenzzz', 250, '/Kamu_1.0/exported/img/items/1558789100.png', 0, 0, 0, 0),
(26, 1, 'Soup', 'Tantalize your taste buds with our signature recipe chicken soup', 140, '/mvc/img/items/1552849585.png', 4, 1, 0, 0),
(30, 2, 'Kottu', 'Enjoy the goodness of little bits of heaven', 300, '/mvc/img/items/1552914320.png', 0, 0, 0, 0),
(31, 2, 'Fried Rice', 'Enjoy the taste of china ', 250, '/mvc/img/items/1552914407.png', 4, 1, 0, 0),
(32, 2, 'Soup', 'Description of soup', 100, '/mvc/img/items/1552931132.png', 4, 1, 0, 0),
(34, 1, 'Noodles', 'description of noodles', 140, '/Kamu_1.0/exported/img/items/1558789530.png', 0, 0, 0, 0),
(147, 2, 'Hoppers', 'asd ewo o o for kok gpd fdr gfd.', 20, '/mvc/img/items/1554563173.png', 4, 4, 0, 0),
(151, 2, 'Rice', 'asfewidn djsak uad s kdasddd sada ', 150, '/mvc/img/items/1554564091.png', 3, 4, 0, 0),
(152, 1, 'Rice', 'description of noodles', 149.98, '/mvc/img/items/default.png', 0, 0, 0, 0),
(153, 1, 'Milk Ric', 'Description of milk rice', 60, '/Kamu/Kamu-webapp/img/items/default.png', 0, 0, 0, 0);

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
(1, 30, 1),
(2, 30, 5),
(18, 147, 9),
(19, 147, 5),
(20, 147, 8),
(23, 151, 83),
(24, 151, 5),
(25, 151, 82),
(27, 26, 84),
(30, 31, 88),
(31, 32, 84),
(32, 30, 2),
(33, 152, 82),
(34, 152, 91),
(40, 153, 96),
(41, 153, 101),
(48, 1, 2),
(49, 1, 1),
(50, 34, 86);

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
(1, 1, 'Kamal', 'Nimal', 'ad@ad.com', '$2y$10$qq9.h2y.o5olleUHZOR8e.c3HjhLLq0PJEj9yKmC7UHonJrZ3eVRS', 'fe9fc289c3ff0af142b6d3bead98a923', 1, 0),
(2, 2, 'Thumula', 'Perera', 'thumula@gmail.com', '$2y$10$dhEnRK0VJnAMe7x7Dw52BeyVozeRa7ejhBc2/uhvbc/cykh0o4PlS', '92cc227532d17e56e07902b254dfad10', 0, 0),
(5, NULL, 'dasdsdsds', 'dsd', 'c9@qwe.com', '$2y$10$NXKcgXPjin84A78OQyhq7.2dq0dK3xWnoGWSxplNGiPpGK4GgiF3y', 'fbd7939d674997cdb4692d34de8633c4', 0, 0);

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
(2, 147, 1, 2),
(3, 147, 4, 5),
(4, 151, 4, 3),
(5, 30, 4, 4),
(6, 152, 4, 2),
(7, 151, 1, 2),
(8, 152, 1, 5),
(9, 30, 1, 4),
(10, 147, 3, 4),
(11, 30, 3, 3),
(12, 152, 3, 4),
(13, 151, 3, 2),
(14, 147, 5, 5),
(15, 30, 5, 4),
(16, 152, 5, 3),
(17, 1, 1, 5),
(18, 32, 1, 4),
(19, 34, 1, 5),
(20, 26, 1, 4),
(21, 31, 1, 4);

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
(2, 2, 'Shop', '3421 rd', '/Kamu_1.0/exported/img/restaurant/1558533870.png', '12482123', 'sda@gmail.com', 81, 8, 1, 0);

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
(10, 1, '{\"152\":1}', 1, 2, '2019-05-29 19:18:00', '5CE7F629.0844', 0, 0, 0, '2019-05-24 13:48:25', NULL, 0),
(11, 1, '{\"34\":1,\"26\":1,\"1\":9}', 1, 2, '2019-05-15 18:31:00', '5CE93CCD.792', 0, 0, 0, '2019-05-25 13:02:05', 'None......', 0),
(12, 1, '{\"34\":1,\"26\":1,\"1\":7}', 1, 2, '2019-05-31 19:50:00', '5CE94F39.4681', 1, 0, 0, '2019-05-25 14:20:41', '', 2030),
(13, 1, '{\"1\":11,\"26\":2}', 1, 2, '2019-05-11 03:01:00', '5CE9B456.8691', 1, 0, 0, '2019-05-25 21:32:06', 'nothing', 3030),
(14, 1, '{\"1\":4,\"26\":10}', 1, 2, '2019-05-11 17:34:00', '5CEA80D2.8821', 1, 0, 0, '2019-05-26 12:04:34', 'None.....', 2400),
(16, 1, '{\"1\":4,\"26\":14}', 1, 2, '2019-05-26 18:58:00', '5CEA947A.031', 1, 0, 0, '2019-05-26 13:28:26', '', 2960),
(17, 1, '{\"1\":1,\"34\":1,\"26\":1}', 1, 2, '2019-05-26 18:59:00', '5CEA94B1.6756', 0, 0, 0, '2019-05-26 13:29:21', 'notes....', 530),
(18, 1, '{\"34\":1,\"26\":1,\"1\":1}', 1, 2, '2019-05-26 18:59:00', '5CEA94CC.445', 0, 0, 0, '2019-05-26 13:29:48', '', 530),
(19, 1, '{\"1\":4,\"26\":2}', 1, 2, '2019-05-26 19:00:00', '5CEA94FD.3943', 1, 0, 0, '2019-05-26 13:30:37', '', 1280),
(21, 1, '{\"1\":4,\"26\":2}', 1, 2, '2019-05-27 12:16:00', '5CEADEED.8741', 0, 0, 0, '2019-05-26 18:46:05', '', 1280);

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
(88, 'fried rice'),
(9, 'hoppers'),
(83, 'hot'),
(2, 'kottu'),
(96, 'milk'),
(101, 'milk ric'),
(95, 'milk rice'),
(5, 'new'),
(86, 'noodles'),
(82, 'rice'),
(6, 'sdkfs'),
(84, 'soup'),
(1, 'spicy'),
(91, 'tag'),
(8, 'tasty');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- AUTO_INCREMENT for table `item_tags`
--
ALTER TABLE `item_tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `owners`
--
ALTER TABLE `owners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `submitted_orders`
--
ALTER TABLE `submitted_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

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
