-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 20, 2019 at 09:25 PM
-- Server version: 5.7.24-log
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(11) NOT NULL,
  `payment_info_id` bigint(11) DEFAULT NULL,
  `order_state` varchar(255) NOT NULL DEFAULT 'not_completed',
  `date_time_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_time_payed` datetime DEFAULT NULL,
  `user_id` bigint(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `payment_info_id`, `order_state`, `date_time_created`, `date_time_payed`, `user_id`) VALUES
(1, NULL, 'not_completed', '2019-05-20 15:03:29', NULL, 4),
(2, NULL, 'not_completed', '2019-05-20 22:06:31', NULL, NULL),
(3, NULL, 'not_completed', '2019-05-20 22:09:20', NULL, NULL),
(4, NULL, 'not_completed', '2019-05-20 22:16:29', NULL, NULL),
(5, NULL, 'not_completed', '2019-05-20 22:17:11', NULL, NULL),
(6, NULL, 'not_completed', '2019-05-20 22:18:05', NULL, NULL),
(7, 8, 'not_completed', '2019-05-20 22:20:14', NULL, 4),
(8, 9, 'not_completed', '2019-05-20 22:23:28', NULL, 4),
(9, 10, 'not_completed', '2019-05-20 22:24:06', NULL, 4),
(10, 11, 'not_completed', '2019-05-20 22:24:15', NULL, 4),
(11, 12, 'not_completed', '2019-05-20 22:24:21', NULL, 4),
(12, 13, 'not_completed', '2019-05-20 22:26:06', NULL, 4),
(13, 14, 'not_completed', '2019-05-20 22:26:09', NULL, 4),
(14, 15, 'not_completed', '2019-05-20 22:27:02', NULL, 4),
(15, 16, 'not_completed', '2019-05-20 22:27:10', NULL, 4),
(16, 17, 'not_completed', '2019-05-20 22:31:01', NULL, 4),
(17, 18, 'not_completed', '2019-05-20 22:35:51', NULL, 4),
(18, 19, 'not_completed', '2019-05-20 22:36:14', NULL, 4),
(19, 20, 'not_completed', '2019-05-20 22:44:24', NULL, 4),
(20, 21, 'not_completed', '2019-05-20 22:44:57', NULL, 4),
(21, 22, 'not_completed', '2019-05-20 22:48:47', NULL, 4),
(22, 23, 'not_completed', '2019-05-20 22:49:47', NULL, 4),
(23, 24, 'not_completed', '2019-05-20 22:51:14', NULL, 4),
(24, 25, 'not_completed', '2019-05-20 22:54:26', NULL, 4),
(25, 26, 'not_completed', '2019-05-20 22:54:54', NULL, 4),
(26, 27, 'not_completed', '2019-05-20 22:56:48', NULL, 4),
(27, 28, 'not_completed', '2019-05-20 22:57:45', NULL, 4),
(28, 29, 'not_completed', '2019-05-20 23:01:23', NULL, 4),
(29, 30, 'not_completed', '2019-05-20 23:01:48', NULL, 4),
(30, 31, 'not_completed', '2019-05-20 23:07:15', NULL, 4),
(31, 32, 'not_completed', '2019-05-20 23:16:25', NULL, 4),
(32, 1, 'not_completed', '2019-05-20 23:23:45', NULL, 4),
(33, 33, 'not_completed', '2019-05-20 23:24:25', NULL, 4);

-- --------------------------------------------------------

--
-- Table structure for table `order_lines`
--

CREATE TABLE `order_lines` (
  `id` bigint(11) NOT NULL,
  `product_variation_id` bigint(11) NOT NULL,
  `order_id` bigint(11) NOT NULL,
  `date_time_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `price` int(11) NOT NULL,
  `discount_percent` int(11) DEFAULT NULL,
  `price_with_discount` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_lines`
--

INSERT INTO `order_lines` (`id`, `product_variation_id`, `order_id`, `date_time_created`, `price`, `discount_percent`, `price_with_discount`) VALUES
(1, 1, 1, '2019-05-20 15:04:36', 29995, NULL, NULL),
(2, 2, 1, '2019-05-20 15:17:40', 29995, NULL, NULL),
(3, 1, 1, '2019-05-20 22:49:47', 29995, NULL, NULL),
(4, 1, 25, '2019-05-20 22:54:54', 29995, NULL, NULL),
(5, 1, 26, '2019-05-20 22:56:48', 29995, NULL, NULL),
(6, 1, 27, '2019-05-20 22:57:45', 29995, NULL, NULL),
(7, 1, 28, '2019-05-20 23:01:23', 29995, NULL, NULL),
(8, 1, 29, '2019-05-20 23:01:48', 29995, NULL, NULL),
(9, 1, 30, '2019-05-20 23:07:15', 29995, NULL, NULL),
(10, 1, 31, '2019-05-20 23:16:25', 29995, NULL, NULL),
(11, 1, 32, '2019-05-20 23:23:45', 29995, NULL, NULL),
(12, 1, 33, '2019-05-20 23:24:25', 29995, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payment_info`
--

CREATE TABLE `payment_info` (
  `id` bigint(11) NOT NULL,
  `user_id` bigint(11) DEFAULT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `zip_code` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `card_number` int(11) NOT NULL,
  `card_expiration_date` varchar(255) NOT NULL,
  `cvc_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payment_info`
--

INSERT INTO `payment_info` (`id`, `user_id`, `first_name`, `last_name`, `address`, `phone_number`, `country`, `zip_code`, `email`, `card_number`, `card_expiration_date`, `cvc_number`) VALUES
(1, NULL, 'jakob', 'blinkilde', 'test', '111', 'Danmark', '3400', 'jab@bb.dk', 111, '11/11/2020', 111),
(2, 4, 'jakob', 'blinkilde', 'test', '111', 'Danmark', '3400', 'jab@bb.dk', 111, '11/11/2020', 111),
(3, 4, 'jakob', 'blinkilde', 'test', '111', 'Danmark', '3400', 'jab@bb.dk', 111, '11/11/2020', 111),
(4, 4, 'jakob', 'blinkilde', 'test', '111', 'Danmark', '3400', 'jab@bb.dk', 111, '11/11/2020', 111),
(5, 4, 'jakob', 'blinkilde', 'test', '111', 'Danmark', '3400', 'jab@bb.dk', 111, '11/11/2020', 111),
(6, 4, 'jakob', 'blinkilde', 'test', '111', 'Danmark', '3400', 'jab@bb.dk', 111, '11/11/2020', 111),
(7, 4, 'jakob', 'blinkilde', 'test', '111', 'Danmark', '3400', 'jab@bb.dk', 111, '11/11/2020', 111),
(8, 4, 'jakob', 'blinkilde', 'test', '111', 'Danmark', '3400', 'jab@bb.dk', 111, '11/11/2020', 111),
(9, 4, 'jakob', 'blinkilde', 'test', '111', 'Danmark', '3400', 'jab@bb.dk', 111, '11/11/2020', 111),
(10, 4, 'jakob', 'blinkilde', 'test', '111', 'Danmark', '3400', 'jab@bb.dk', 111, '11/11/2020', 111),
(11, 4, 'jakob', 'blinkilde', 'test', '111', 'Danmark', '3400', 'jab@bb.dk', 111, '11/11/2020', 111),
(12, 4, 'jakob', 'blinkilde', 'test', '111', 'Danmark', '3400', 'jab@bb.dk', 111, '11/11/2020', 111),
(13, 4, 'jakob', 'blinkilde', 'test', '111', 'Danmark', '3400', 'jab@bb.dk', 111, '11/11/2020', 111),
(14, 4, 'jakob', 'blinkilde', 'test', '111', 'Danmark', '3400', 'jab@bb.dk', 111, '11/11/2020', 111),
(15, 4, 'jakob', 'blinkilde', 'test', '111', 'Danmark', '3400', 'jab@bb.dk', 111, '11/11/2020', 111),
(16, 4, 'jakob', 'blinkilde', 'test', '111', 'Danmark', '3400', 'jab@bb.dk', 111, '11/11/2020', 111),
(17, 4, 'jakob', 'blinkilde', 'test', '111', 'Danmark', '3400', 'jab@bb.dk', 111, '11/11/2020', 111),
(18, 4, 'jakob', 'blinkilde', 'test', '111', 'Danmark', '3400', 'jab@bb.dk', 111, '11/11/2020', 111),
(19, 4, 'jakob', 'blinkilde', 'test', '111', 'Danmark', '3400', 'jab@bb.dk', 111, '11/11/2020', 111),
(20, 4, 'jakob', 'blinkilde', 'test', '111', 'Danmark', '3400', 'jab@bb.dk', 111, '11/11/2020', 111),
(21, 4, 'jakob', 'blinkilde', 'test', '111', 'Danmark', '3400', 'jab@bb.dk', 111, '11/11/2020', 111),
(22, 4, 'jakob', 'blinkilde', 'test', '111', 'Danmark', '3400', 'jab@bb.dk', 111, '11/11/2020', 111),
(23, 4, 'jakob', 'blinkilde', 'test', '111', 'Danmark', '3400', 'jab@bb.dk', 111, '11/11/2020', 111),
(24, 4, 'jakob', 'blinkilde', 'test', '111', 'Danmark', '3400', 'jab@bb.dk', 111, '11/11/2020', 111),
(25, 4, 'jakob', 'blinkilde', 'test', '111', 'Danmark', '3400', 'jab@bb.dk', 111, '11/11/2020', 111),
(26, 4, 'jakob', 'blinkilde', 'test', '111', 'Danmark', '3400', 'jab@bb.dk', 111, '11/11/2020', 111),
(27, 4, 'jakob', 'blinkilde', 'test', '111', 'Danmark', '3400', 'jab@bb.dk', 111, '11/11/2020', 111),
(28, 4, 'jakob', 'blinkilde', 'test', '111', 'Danmark', '3400', 'jab@bb.dk', 111, '11/11/2020', 111),
(29, 4, 'jakob', 'blinkilde', 'test', '111', 'Danmark', '3400', 'jab@bb.dk', 111, '11/11/2020', 111),
(30, 4, 'jakob', 'blinkilde', 'test', '111', 'Danmark', '3400', 'jab@bb.dk', 111, '11/11/2020', 111),
(31, 4, 'jakob', 'blinkilde', 'test', '111', 'Danmark', '3400', 'jab@bb.dk', 111, '11/11/2020', 111),
(32, 4, 'jakob', 'blinkilde', 'test', '111', 'Danmark', '3400', 'jab@bb.dk', 111, '11/11/2020', 111),
(33, 4, 'jakob', 'blinkilde', 'test', '111', 'Danmark', '3400', 'jab@bb.dk', 111, '11/11/2020', 111);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `date_time_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_time_updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `active_from_date` date DEFAULT NULL,
  `expiration_date` date DEFAULT NULL,
  `description` longtext NOT NULL,
  `price` int(11) NOT NULL,
  `discount_percent` int(2) DEFAULT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `is_active`, `date_time_created`, `date_time_updated`, `active_from_date`, `expiration_date`, `description`, `price`, `discount_percent`, `category`) VALUES
(1, 'Sko 2019 serie', 1, '2019-05-05 10:44:42', NULL, NULL, NULL, 'Flotte Sko', 29995, NULL, 'shoes'),
(2, 'T-Shirt 2019 serie', 1, '2019-05-05 10:45:35', '2019-05-13 10:49:11', NULL, NULL, 'Flot t-shirt', 11995, NULL, 'clothes'),
(5, 'Sko 2016 serie', 1, '2019-05-05 10:44:42', NULL, NULL, NULL, 'Flotte Sko', 39995, NULL, 'shoes'),
(6, 'test123', 1, '2019-05-13 11:27:47', '2019-05-13 12:24:42', NULL, NULL, 'hej', 10000, NULL, 'shoes'),
(8, 'test1234', 1, '2019-05-13 17:53:47', NULL, NULL, NULL, 'hej', 10000, NULL, 'shoes'),
(9, 'jakob', 1, '2019-05-13 18:10:46', NULL, NULL, NULL, 'hej', 20000, NULL, 'shoes'),
(10, 'test111', 1, '2019-05-13 19:40:28', NULL, NULL, NULL, 'hej', 20000, NULL, 'shoes'),
(11, 'test321', 0, '2019-05-13 22:35:50', NULL, NULL, NULL, 'test', 15000, NULL, 'shoes'),
(12, 'test3215', 0, '2019-05-13 23:01:02', NULL, NULL, NULL, 'test', 15000, NULL, 'shoes'),
(13, 'test32156', 0, '2019-05-13 23:05:12', NULL, NULL, NULL, 'test', 150000, NULL, 'shoes'),
(14, 't123', 1, '2019-05-14 06:30:25', NULL, NULL, NULL, 'hej', 2000, NULL, 'shoes'),
(15, 't1234', 1, '2019-05-14 06:33:22', NULL, NULL, NULL, 'hej', 2000, NULL, 'shoes'),
(16, 't1234', 1, '2019-05-14 06:34:06', NULL, NULL, NULL, 'hej', 2000, NULL, 'shoes'),
(17, 't1234', 1, '2019-05-14 06:34:28', NULL, NULL, NULL, 'hej', 2000, NULL, 'shoes'),
(18, 't1234k', 1, '2019-05-14 06:48:15', NULL, NULL, NULL, 'hej', 2000, NULL, 'shoes'),
(19, 't1234kk', 1, '2019-05-14 06:48:38', NULL, NULL, NULL, 'hej', 2000, NULL, 'shoes'),
(20, 't1234kkj', 1, '2019-05-14 06:48:57', NULL, NULL, NULL, 'hej', 2000, NULL, 'shoes'),
(21, 't1234kkjh', 1, '2019-05-14 06:51:54', NULL, NULL, NULL, 'hej', 2000, NULL, 'shoes'),
(22, 't1234kkjhp', 1, '2019-05-14 06:55:46', NULL, NULL, NULL, 'hej', 2000, NULL, 'shoes'),
(23, 't1234kkjhpa', 1, '2019-05-14 06:57:02', NULL, NULL, NULL, 'hej', 2000, NULL, 'shoes'),
(24, 't1234kkjbq', 1, '2019-05-14 06:57:37', NULL, NULL, NULL, 'hej', 2000, NULL, 'shoes'),
(25, 't1234kkjbn', 1, '2019-05-14 06:58:25', NULL, NULL, NULL, 'hej', 2000, NULL, 'shoes'),
(26, 't1234kkjbw', 1, '2019-05-14 07:00:06', NULL, NULL, NULL, 'hej', 2000, NULL, 'shoes'),
(27, 't1234kkjbwt', 1, '2019-05-14 07:04:03', NULL, NULL, NULL, 'hej', 2000, NULL, 'shoes'),
(28, 't12okk', 1, '2019-05-14 07:08:24', NULL, NULL, NULL, 'hej', 2000, NULL, 'shoes'),
(29, 't12okkht', 1, '2019-05-14 07:32:46', NULL, NULL, NULL, 'hej', 2000, NULL, 'shoes'),
(30, 't12okkht6', 1, '2019-05-14 07:41:20', NULL, NULL, NULL, 'hej', 2000, NULL, 'shoes'),
(31, 't12okkht63', 1, '2019-05-14 07:41:47', NULL, NULL, NULL, 'hej', 2000, NULL, 'shoes'),
(32, 't12okkht634', 1, '2019-05-14 07:43:18', NULL, NULL, NULL, 'hej', 2000, NULL, 'shoes'),
(33, 't12okkht6344', 1, '2019-05-14 07:43:31', NULL, NULL, NULL, 'hej', 2000, NULL, 'shoes'),
(34, 't12okkh421e', 1, '2019-05-14 07:44:39', NULL, NULL, NULL, 'hej', 2000, NULL, 'shoes'),
(35, 't12okkh421k', 1, '2019-05-14 07:47:38', NULL, NULL, NULL, 'hej', 2000, NULL, 'shoes'),
(36, 't12okkh421p', 1, '2019-05-14 07:49:03', NULL, NULL, NULL, 'hej', 2000, NULL, 'shoes'),
(37, 't12okkh42122', 1, '2019-05-14 07:50:31', NULL, NULL, NULL, 'hej', 2000, NULL, 'shoes'),
(38, 't12okkh42121', 1, '2019-05-14 07:52:08', NULL, NULL, NULL, 'hej', 2000, NULL, 'shoes'),
(39, 'test54321', 1, '2019-05-14 09:16:32', NULL, NULL, NULL, 'test', 20000, NULL, 'shoes');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `product_id` bigint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product_variations`
--

CREATE TABLE `product_variations` (
  `id` bigint(11) NOT NULL,
  `in_stock` int(11) NOT NULL,
  `sku` varchar(255) NOT NULL,
  `product_id` bigint(11) NOT NULL,
  `size` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_variations`
--

INSERT INTO `product_variations` (`id`, `in_stock`, `sku`, `product_id`, `size`) VALUES
(1, 9, 'SKO2019BLACK43', 1, '43'),
(2, 10, 'SKO2019BLUE44', 1, '44'),
(7, 3, 'SKO2016BLACK43', 5, NULL),
(8, 2, 'SKO2016RED44', 5, NULL),
(9, 5, 'tok', 36, '39'),
(10, 5, 'tok', 37, '39'),
(11, 5, 'tok', 38, '39'),
(12, 15, 'test54321', 39, '45');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `zip_code` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `confirmed_email` tinyint(1) NOT NULL DEFAULT '0',
  `password` varchar(255) NOT NULL,
  `gender` tinyint(1) DEFAULT NULL,
  `date_time_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role` varchar(255) NOT NULL DEFAULT 'costumer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `address`, `zip_code`, `email`, `confirmed_email`, `password`, `gender`, `date_time_created`, `role`) VALUES
(2, 'jakob', 'blinkilde', 'test', '3400', 'jab@b.dk', 0, '12345', 1, '2019-05-19 10:16:57', 'admin'),
(4, 'jakob', 'blinkilde', 'test', '3400', 'jab@bb.dk', 0, '12345', 1, '2019-05-19 10:17:14', 'admin'),
(7, 'jakob', 'blinkilde', 'test', '3400', 'jab@bbb.dk', 0, '12345', 1, '2019-05-19 10:17:39', 'costumer'),
(8, 'jakob', 'blinkilde', 'test', '3400', 'jab@bbbb.dk', 0, '12345', 0, '2019-05-19 10:18:31', 'costumer'),
(9, 'jakob', 'blinkilde', 'test', '3400', 'jab@bl.dk', 0, '12345', 1, '2019-05-20 01:24:44', 'costumer'),
(10, 'test', 'test', 'test', '3400', 'test@t.dk', 0, '12345', 1, '2019-05-20 01:28:58', 'costumer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_info_id` (`payment_info_id`),
  ADD KEY `orders_user_id` (`user_id`);

--
-- Indexes for table `order_lines`
--
ALTER TABLE `order_lines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_variation_id` (`product_variation_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `payment_info`
--
ALTER TABLE `payment_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `images_product_id` (`product_id`);

--
-- Indexes for table `product_variations`
--
ALTER TABLE `product_variations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `order_lines`
--
ALTER TABLE `order_lines`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `payment_info`
--
ALTER TABLE `payment_info`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_variations`
--
ALTER TABLE `product_variations`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `payment_info_id` FOREIGN KEY (`payment_info_id`) REFERENCES `payment_info` (`id`);

--
-- Constraints for table `order_lines`
--
ALTER TABLE `order_lines`
  ADD CONSTRAINT `order_id` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `product_variation_id` FOREIGN KEY (`product_variation_id`) REFERENCES `product_variations` (`id`);

--
-- Constraints for table `payment_info`
--
ALTER TABLE `payment_info`
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `images_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `product_variations`
--
ALTER TABLE `product_variations`
  ADD CONSTRAINT `product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
