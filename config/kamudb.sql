-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2019 at 04:08 PM
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
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `restaurant_id`, `item_name`, `description`, `price`, `image_url`, `rating`, `rating_num`, `deleted`) VALUES
(1, 1, 'Kottu', 'Perfect combination of cut up roti and chickenzzz', 250, '/mvc/img/items/1553572046.png', 0, 0, 0),
(26, 1, 'Soup', 'Tantalize your taste buds with our signature recipe chicken soup', 140, '/mvc/img/items/1552849585.png', 0, 0, 0),
(30, 2, 'Kottu', 'Enjoy the goodness of little bits of heaven', 300, '/mvc/img/items/1552914320.png', 0, 0, 0),
(31, 2, 'Fried Rice', 'Enjoy the taste of china ', 250, '/mvc/img/items/1552914407.png', 0, 0, 0),
(32, 2, 'Soup', 'Description of soup', 100, '/mvc/img/items/1552931132.png', 0, 0, 0),
(34, 1, 'Noodles', 'description of noodles', 140, '/mvc/img/items/1553572181.png', 0, 0, 0),
(147, 2, 'Hoppers', 'asd ewo o o for kok gpd fdr gfd.', 20, '/mvc/img/items/1554563173.png', 4, 4, 0),
(151, 2, 'Rice', 'asfewidn djsak uad s kdasddd sada ', 150, '/mvc/img/items/1554564091.png', 3.5, 4, 0),
(152, 1, 'Rice', 'description of noodles', 149.98, '/mvc/img/items/default.png', 3.25, 4, 0);

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
(26, 152, 82),
(27, 26, 84),
(28, 34, 86),
(29, 1, 2),
(30, 31, 88),
(31, 32, 84),
(32, 30, 2);

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
  `submit_time` timestamp NULL DEFAULT NULL,
  `order_code` int(11) DEFAULT NULL,
  `submitted` tinyint(1) NOT NULL DEFAULT '0',
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_name`, `customer_id`, `items`, `restaurant_id`, `type`, `submit_time`, `order_code`, `submitted`, `time_stamp`) VALUES
(3, 'Saved Order', 1, '{\"1\":4,\"26\":2}', 1, 2, NULL, NULL, 0, '2019-03-29 14:27:53'),
(6, 'Saved Order', 1, '{\"1\":1,\"34\":1,\"26\":1}', 1, 1, NULL, NULL, 0, '2019-04-01 15:32:47'),
(8, 'Saved Order', 1, '{\"34\":1,\"26\":1}', 1, 1, NULL, NULL, 0, '2019-04-12 12:56:07'),
(11, 'Saved Order', 1, '{\"26\":1,\"1\":1}', 1, 2, NULL, NULL, 1, '2019-04-12 13:09:28'),
(18, 'Saved Order', 1, '{\"34\":1,\"26\":1,\"1\":1}', 1, 1, NULL, NULL, 0, '2019-04-12 13:38:36'),
(19, 'Saved Order', 1, '{\"34\":1,\"26\":1}', 1, 1, NULL, NULL, 1, '2019-04-12 13:40:44'),
(20, 'Saved Order', 4, '{\"34\":1,\"1\":1}', 1, 1, NULL, NULL, 0, '2019-04-17 18:14:58'),
(21, 'Saved Order', 4, '{\"34\":1,\"26\":1}', 1, 2, NULL, NULL, 0, '2019-04-17 18:17:14'),
(22, 'Saved Order', 4, '{\"147\":1,\"30\":1}', 2, 2, NULL, NULL, 0, '2019-04-23 05:23:07'),
(27, 'New', 1, '{\"147\":1}', 2, NULL, NULL, NULL, 0, '2019-05-01 13:27:23'),
(28, 'Shop : Saved Order', 1, '{\"30\":1}', 2, NULL, NULL, NULL, 0, '2019-05-06 11:03:47');

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
(1, 1, 'Kamal', 'Nimal', 'ad@ad.com', '$2y$10$qq9.h2y.o5olleUHZOR8e.c3HjhLLq0PJEj9yKmC7UHonJrZ3eVRS', 'fe9fc289c3ff0af142b6d3bead98a923', 1, 0),
(2, 2, 'Thumula', 'Perera', 'thumula@gmail.com', '$2y$10$dhEnRK0VJnAMe7x7Dw52BeyVozeRa7ejhBc2/uhvbc/cykh0o4PlS', '92cc227532d17e56e07902b254dfad10', 0, 0);

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
(7, 151, 1, 4),
(8, 152, 1, 4),
(9, 30, 1, 3),
(10, 147, 3, 4),
(11, 30, 3, 3),
(12, 152, 3, 4),
(13, 151, 3, 2),
(14, 147, 5, 5),
(15, 30, 5, 4),
(16, 152, 5, 3);

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
(1, 'Kama Kade', '190 tpl', '/mvc/img/restaurant/1552895082.png', '12482042', 'kkadilhara@gmail.com', 80, 7, 0),
(2, 'Shop', '3421 rd', '/mvc/img/restaurant/1552895082.png', '12482123', 'sda@gmail.com', 81, 8, 0);

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

--
-- Dumping data for table `submitted_orders`
--

INSERT INTO `submitted_orders` (`id`, `customer_id`, `items`, `restaurant_id`, `type`, `submit_time`, `order_code`, `accepted`, `rejected`, `completed`, `time_stamp`) VALUES
(2, 1, '{\"34\":1,\"26\":1,\"1\":1}', 1, 1, NULL, NULL, 1, 0, 0, '2019-04-12 13:38:36'),
(3, 1, '{\"34\":1,\"26\":1}', 1, 1, NULL, NULL, 0, 1, 0, '2019-04-12 13:40:44'),
(4, 4, '{\"34\":1,\"1\":1}', 1, 1, NULL, NULL, 1, 0, 0, '2019-04-17 18:14:58'),
(5, 4, '{\"34\":1,\"26\":1}', 1, 2, NULL, NULL, 1, 0, 0, '2019-04-17 18:17:14');

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
(5, 'new'),
(86, 'noodles'),
(82, 'rice'),
(6, 'sdkfs'),
(84, 'soup'),
(1, 'spicy'),
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
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

--
-- AUTO_INCREMENT for table `item_tags`
--
ALTER TABLE `item_tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `owners`
--
ALTER TABLE `owners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `submitted_orders`
--
ALTER TABLE `submitted_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

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
