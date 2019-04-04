-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 03, 2019 at 08:16 AM
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
(2, 'Chamika', 'Nimal', 'ad@ad.com', '$2y$10$lO/3azXVdJ1aLxQp2Tll.eGnKe6r2iOfA311oKE.OXVenYqG4p52u', '6f4922f45568161a8cdf4ad2299f6d23', 0, 0),
(3, 'Thumula', 'Nimal', 'thumula@gmail.com', '$2y$10$Vh86n8AbQW6hzNsiZtXQ9.TNKfWhyavHmXmq/JyaRTApNhskRIcGa', '2838023a778dfaecdc212708f721b788', 0, 0);

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
(1, 'Chamika', 'Nimal', 'ad@ad.com', '$2y$10$lO/3azXVdJ1aLxQp2Tll.eGnKe6r2iOfA311oKE.OXVenYqG4p52u', '6f4922f45568161a8cdf4ad2299f6d23', 0, 0),
(3, 'Thumula', 'Na', 'thumula@gmail.com', '$2y$10$XtPm1532UgsRFehBnWLKqOh.p1RNN4ZO9Bb32MK.ogE5PgjIFBWMe', 'c0c7c76d30bd3dcaefc96f40275bdc0a', 0, 0),
(4, 'anjala', 'dilhara', 'anjaladilhara@gmail.com', '$2y$10$CNaMpSNn6kDummFGp43edu5qZO0rMu6ogDtFjfZUNguASvwilpDmW', 'd2ddea18f00665ce8623e36bd4e3c7c5', 1, 0),
(5, 'hg', 'qwe', 'c9599@qwe.com', '$2y$10$5be5bBxUYSAn7ilQsbwZEexoz.Smb.qUcq4RVGS2V53M.i/qrSVme', '3c59dc048e8850243be8079a5c74d079', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `restaurant_id` int(11) DEFAULT NULL,
  `item_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `image_url` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `rating` double NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `restaurant_id`, `item_name`, `description`, `price`, `image_url`, `rating`, `deleted`) VALUES
(1, 1, 'Kottu', 'Perfect combination of cut up roti and chickenzzz', 250, '/mvc/img/items/1553572046.png', 0, 0),
(26, 1, 'Soup', 'Tantalize your taste buds with our signature recipe chicken soup', 140, '/mvc/img/items/1552849585.png', 0, 0),
(30, 2, 'Kottu', 'Enjoy the goodness of little bits of heaven', 300, '/mvc/img/items/1552914320.png', 0, 0),
(31, 2, 'Fried Rice', 'Enjoy the taste of china ', 250, '/mvc/img/items/1552914407.png', 0, 0),
(32, 2, 'Soup', 'Description of soup', 100, '/mvc/img/items/1552931132.png', 0, 0),
(34, 1, 'Noodles', 'description of noodles', 140, '/mvc/img/items/1553572181.png', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `item_tags`
--

CREATE TABLE `item_tags` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `items` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `restaurant_id` int(11) NOT NULL,
  `type` tinyint(1) DEFAULT NULL,
  `submit_time` timestamp NULL DEFAULT NULL,
  `order_code` int(11) DEFAULT NULL,
  `submitted` tinyint(1) NOT NULL DEFAULT '0',
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `items`, `restaurant_id`, `type`, `submit_time`, `order_code`, `submitted`, `time_stamp`) VALUES
(1, 1, '{\"1\":4 ,\"34\":2}', 1, 0, NULL, NULL, 0, '2019-03-29 14:27:53'),
(3, 1, '{\"1\":4,\"26\":2}', 1, 0, NULL, NULL, 0, '2019-03-29 14:27:53'),
(6, 1, '{\"1\":1,\"34\":1,\"26\":1}', 1, NULL, NULL, NULL, 0, '2019-04-01 15:32:47'),
(7, 1, '{\"30\":1,\"32\":1}', 0, NULL, NULL, NULL, 0, '2019-04-01 15:34:18'),
(8, 1, '{\"30\":1,\"32\":1}', 0, NULL, NULL, NULL, 0, '2019-04-01 15:35:01'),
(9, 1, '{\"30\":1,\"32\":1,\"31\":1}', 0, NULL, NULL, NULL, 0, '2019-04-01 17:34:50');

-- --------------------------------------------------------

--
-- Table structure for table `owners`
--

CREATE TABLE `owners` (
  `id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
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
(1, 1, 'Kamal', 'Nimal', 'ad@ad.com', '$2y$10$n0qUvrVBnVt4oRtk6RX1gOmTYVNHtBWiUyRftM7mxMhJIc4XtaBjO', 'ac627ab1ccbdb62ec96e702f07f6425b', 0, 0),
(2, 0, 'Thumula', 'Perera', 'thumula@gmail.com', '$2y$10$dhEnRK0VJnAMe7x7Dw52BeyVozeRa7ejhBc2/uhvbc/cykh0o4PlS', '92cc227532d17e56e07902b254dfad10', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `restaurants`
--

CREATE TABLE `restaurants` (
  `id` int(11) NOT NULL,
  `restaurant_name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image_url` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `telephone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lng` int(11) NOT NULL,
  `lat` int(11) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `restaurants`
--

INSERT INTO `restaurants` (`id`, `restaurant_name`, `address`, `image_url`, `telephone`, `email`, `lng`, `lat`, `deleted`) VALUES
(1, 'Kama Kade', '190 tpl', '/mvc/img/restaurant/1552895082.png', '12482042', 'kkadilhara@gmail.com', 12, 34, 0),
(2, 'Shop', '3421 rd', '/mvc/img/restaurant/1552895082.png', '12482123', 'sda@gmail.com', 11, 13, 0);

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
  `submit_time` timestamp NULL DEFAULT NULL,
  `order_code` int(11) DEFAULT NULL,
  `accepted` tinyint(1) NOT NULL DEFAULT '0',
  `rejected` tinyint(1) NOT NULL DEFAULT '0',
  `completed` tinyint(1) NOT NULL DEFAULT '0',
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `tag_name` varchar(25) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_tags`
--
ALTER TABLE `item_tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `owners`
--
ALTER TABLE `owners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `owners`
--
ALTER TABLE `owners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_sessions`
--
ALTER TABLE `user_sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
