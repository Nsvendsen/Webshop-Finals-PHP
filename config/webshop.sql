-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 08, 2019 at 08:18 PM
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
  `payment_info_id` bigint(11) NOT NULL,
  `order_state` int(11) NOT NULL DEFAULT '0',
  `date_time_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_time_payed` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `order_lines`
--

CREATE TABLE `order_lines` (
  `id` bigint(11) NOT NULL,
  `product_variation_id` bigint(11) NOT NULL,
  `order_id` bigint(11) NOT NULL,
  `date_time_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `card_type` varchar(255) NOT NULL,
  `card_number` int(11) NOT NULL,
  `card_expiration_date` varchar(255) NOT NULL,
  `cvc_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(2, 'T-Shirt 2019 serie', 1, '2019-05-05 10:45:35', NULL, NULL, NULL, 'Flot t-shirt', 14995, NULL, 'clothes'),
(3, 'Sko 2018 serie', 1, '2019-05-05 10:44:42', NULL, NULL, NULL, 'Flotte Sko', 29995, NULL, 'shoes'),
(4, 'Sko 2017 serie', 1, '2019-05-05 10:44:42', NULL, NULL, NULL, 'Flotte Sko', 39995, NULL, 'shoes'),
(5, 'Sko 2016 serie', 1, '2019-05-05 10:44:42', NULL, NULL, NULL, 'Flotte Sko', 39995, NULL, 'shoes');

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
(1, 25, 'SKO2019BLACK43', 1, NULL),
(2, 20, 'SKO2019BLUE44', 1, NULL),
(3, 15, 'SKO2018YELLOW43', 3, NULL),
(4, 12, 'SKO2018RED44', 3, NULL),
(5, 5, 'SKO2017GREEN43', 4, NULL),
(6, 4, 'SKO2017PURPLE44', 4, NULL),
(7, 3, 'SKO2016BLACK43', 5, NULL),
(8, 2, 'SKO2016RED44', 5, NULL);

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
  `gender` tinyint(1) DEFAULT NULL,
  `date_time_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_info_id` (`payment_info_id`);

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
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_lines`
--
ALTER TABLE `order_lines`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_info`
--
ALTER TABLE `payment_info`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_variations`
--
ALTER TABLE `product_variations`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
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
  ADD CONSTRAINT `product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
