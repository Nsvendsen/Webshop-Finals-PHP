-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 07, 2019 at 09:22 AM
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
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'shoes'),
(2, 'clothes'),
(3, 'beautyproducts'),
(4, 'homeappliances');

-- --------------------------------------------------------

--
-- Table structure for table `category_attributes`
--

CREATE TABLE `category_attributes` (
  `id` bigint(11) NOT NULL,
  `category_id` bigint(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category_attributes`
--

INSERT INTO `category_attributes` (`id`, `category_id`, `name`) VALUES
(1, 1, 'Size'),
(2, 1, 'Color'),
(3, 2, 'Size'),
(4, 2, 'Color');

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
  `category_id` bigint(11) NOT NULL,
  `date_time_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_time_updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `active_from_date` date DEFAULT NULL,
  `expiration_date` date DEFAULT NULL,
  `description` longtext NOT NULL,
  `price` int(11) NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `is_active`, `category_id`, `date_time_created`, `date_time_updated`, `active_from_date`, `expiration_date`, `description`, `price`, `category`) VALUES
(1, 'Sko 2019 serie', 1, 1, '2019-05-05 10:44:42', NULL, NULL, NULL, 'Flotte Sko', 29995, 'shoes'),
(2, 'T-Shirt 2019 serie', 1, 2, '2019-05-05 10:45:35', NULL, NULL, NULL, 'Flot t-shirt', 14995, 'clothes'),
(3, 'Sko 2018 serie', 1, 1, '2019-05-05 10:44:42', NULL, NULL, NULL, 'Flotte Sko', 29995, 'shoes'),
(4, 'Sko 2017 serie', 1, 1, '2019-05-05 10:44:42', NULL, NULL, NULL, 'Flotte Sko', 39995, 'shoes'),
(5, 'Sko 2016 serie', 1, 1, '2019-05-05 10:44:42', NULL, NULL, NULL, 'Flotte Sko', 39995, 'shoes');

-- --------------------------------------------------------

--
-- Table structure for table `product_variations`
--

CREATE TABLE `product_variations` (
  `id` bigint(11) NOT NULL,
  `in_stock` int(11) NOT NULL,
  `sku` varchar(255) NOT NULL,
  `product_id` bigint(11) NOT NULL,
  `price` int(11) NOT NULL,
  `discount_percent` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_variations`
--

INSERT INTO `product_variations` (`id`, `in_stock`, `sku`, `product_id`, `price`, `discount_percent`) VALUES
(1, 25, 'SKO2019BLACK43', 1, 29995, NULL),
(2, 20, 'SKO2019BLUE44', 1, 29995, NULL),
(3, 15, 'SKO2018YELLOW43', 3, 39995, NULL),
(4, 12, 'SKO2018RED44', 3, 39995, NULL),
(5, 5, 'SKO2017GREEN43', 4, 39995, NULL),
(6, 4, 'SKO2017PURPLE44', 4, 39995, NULL),
(7, 3, 'SKO2016BLACK43', 5, 39995, NULL),
(8, 2, 'SKO2016RED44', 5, 39995, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_variation_attributes`
--

CREATE TABLE `product_variation_attributes` (
  `id` bigint(11) NOT NULL,
  `product_variation_id` bigint(11) NOT NULL,
  `value` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_variation_attributes`
--

INSERT INTO `product_variation_attributes` (`id`, `product_variation_id`, `value`, `name`) VALUES
(1, 1, '43', 'Size'),
(2, 1, 'Black', 'Color'),
(3, 2, '44', 'Size'),
(4, 2, 'Blue', 'Color'),
(5, 3, '43', 'Size'),
(6, 3, 'Yellow', 'Color'),
(7, 4, '44', 'Size'),
(8, 4, 'Red', 'Color'),
(9, 5, '43', 'Size'),
(10, 5, 'Green', 'Color'),
(11, 6, '44', 'Size'),
(12, 6, 'Purple', 'Color'),
(13, 7, '43', 'Size'),
(14, 7, 'Black', 'Color'),
(15, 8, '44', 'Size'),
(16, 8, 'Red', 'Color');

-- --------------------------------------------------------

--
-- Table structure for table `product_variation_images`
--

CREATE TABLE `product_variation_images` (
  `id` bigint(11) NOT NULL,
  `product_variation_id` bigint(11) NOT NULL,
  `url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_attributes`
--
ALTER TABLE `category_attributes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `category` (`category_id`);

--
-- Indexes for table `product_variations`
--
ALTER TABLE `product_variations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product_variation_attributes`
--
ALTER TABLE `product_variation_attributes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_variation` (`product_variation_id`);

--
-- Indexes for table `product_variation_images`
--
ALTER TABLE `product_variation_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prod_variation` (`product_variation_id`);

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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `category_attributes`
--
ALTER TABLE `category_attributes`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
-- AUTO_INCREMENT for table `product_variations`
--
ALTER TABLE `product_variations`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product_variation_attributes`
--
ALTER TABLE `product_variation_attributes`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `product_variation_images`
--
ALTER TABLE `product_variation_images`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `category_attributes`
--
ALTER TABLE `category_attributes`
  ADD CONSTRAINT `category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

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
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `product_variations`
--
ALTER TABLE `product_variations`
  ADD CONSTRAINT `product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `product_variation_attributes`
--
ALTER TABLE `product_variation_attributes`
  ADD CONSTRAINT `product_variation` FOREIGN KEY (`product_variation_id`) REFERENCES `product_variations` (`id`);

--
-- Constraints for table `product_variation_images`
--
ALTER TABLE `product_variation_images`
  ADD CONSTRAINT `prod_variation` FOREIGN KEY (`product_variation_id`) REFERENCES `product_variations` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
