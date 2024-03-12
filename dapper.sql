-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2024 at 06:31 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dapper`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(100) NOT NULL,
  `admin_name` varchar(100) NOT NULL,
  `admin_email` text NOT NULL,
  `admin_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `admin_name`, `admin_email`, `admin_password`) VALUES
(1, 'joey', 'admin@gmail.com', 'adminjoey');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(100) NOT NULL,
  `order_cost` int(100) NOT NULL,
  `order_status` varchar(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `user_phone` int(100) NOT NULL,
  `user_city` varchar(100) NOT NULL,
  `user_address` varchar(100) NOT NULL,
  `order_date` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `item_id` int(100) NOT NULL,
  `order_id` int(100) NOT NULL,
  `product_id` int(100) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_image` varchar(100) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `order_date` varchar(100) NOT NULL,
  `product_price` int(100) NOT NULL,
  `product_quantity` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`item_id`, `order_id`, `product_id`, `product_name`, `product_image`, `user_id`, `order_date`, `product_price`, `product_quantity`) VALUES
(17, 14, 15, 'Hoodie with jeans jacket', '42.jpg', '1', '2024-03-12 05:29:17', 100, 1),
(18, 15, 13, 'Grey hoodie and black jeans jacket', '40.jpg', '4', '2024-03-12 06:21:13', 160, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(100) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_price` int(100) NOT NULL,
  `product_description` varchar(255) NOT NULL,
  `product_image` varchar(100) NOT NULL,
  `product_category` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_price`, `product_description`, `product_image`, `product_category`) VALUES
(1, 'Black Jacket', 90, 'Simple Black Jacket', '0.jpg', 'Jacket'),
(2, 'Black Brown Jacket', 80, 'Simple Black Brown Jacket', '1.jpg', 'Jacket'),
(5, 'Light brown Jacket', 60, 'Simple Light Brown Jacket', '2.jpg', 'Jacket'),
(9, 'Light green Sweater', 100, 'Simple Light Green Sweater', '36.jpg', 'Sweater'),
(10, 'Dark Brown Sweater', 110, 'Simple Dark Brown Sweater', '37.jpg', 'Sweater'),
(11, 'Light Brown High Neck Sweater', 105, 'Simple Light Brown High Neck Sweater', '38.jpg', 'Sweater'),
(12, 'Light Green High Neck Sweater', 115, 'Simple Light Green High Neck Sweater', '39.jpg', 'Sweater'),
(13, 'Grey hoodie and black jeans jacket', 160, 'Simple Grey hoodie and black jeans jacket', '40.jpg', 'Hoodies and Jackets'),
(14, 'Grey hoodie and grunge jeans jacket', 150, 'Simple', '41.jpg', 'Hoodies and Jackets'),
(15, 'Hoodie with jeans jacket', 100, 'Simple Hoodie with jeans jacket', '42.jpg', 'Hoodies and Jackets'),
(16, 'Grey hoodie with brown jacket', 155, 'Simple Grey hoodie with brown jcacket', '43.jpg', 'Hoodies and Jackets'),
(17, 'Light green shirt with light brown jacket', 180, 'Simple Light green shirt with light brown jacket', '44.jpg', 'combos'),
(18, 'Light yellow shirt with brown jacket', 170, 'Simple Light yellow shirt with brown jacket', '45.jpg', 'Combos'),
(19, 'Grey sweater with dark brown jacket', 160, 'Simple Grey sweater with dark brown jacket', '46.jpg', 'Combos'),
(20, 'Grey sweater with brown coat', 175, 'Simple Grey sweater with brown coat', '47.jpg', 'Combos'),
(21, 'Casual Short-sleeve T-shirt', 160, 'Simple Casual Short-sleeve T-shirt', '4.jpg', 'new'),
(22, 'Casual Short-sleeve shirt', 170, 'Simple Casual Short-sleeve shirt', 'Casual Short-sleeve shirt.jpg', 'new'),
(23, 'Simple Stylish Jacket', 175, 'Simple Stylish Jacket', '8.jpg', 'new');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(100) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_password`) VALUES
(1, 'Samrid Dangol', 'samrid.dangol.sd@gmail.com', 'ee9f44a2315812602bbadf772bf8b457'),
(2, 'Samrid Dangol', 'joey.snow.js@gmail.com', '26a8c5dc22c96640c0002261b75f8bdf'),
(3, 'ram', 'samrid1998 ', '6a557ed1005dddd940595b8fc6ed47b2'),
(4, 'ram', 'ram@gmail.com', 'c9a2c96cd599eca3ba0a2e2a471043e3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `item_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
