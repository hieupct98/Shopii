-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2019 at 04:25 PM
-- Server version: 10.1.36-MariaDB
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
-- Database: `shopii`
--
CREATE DATABASE IF NOT EXISTS `shopii` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `shopii`;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `Name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `Name`) VALUES
(1, 'Điện thoại'),
(2, 'Laptop');

-- --------------------------------------------------------

--
-- Table structure for table `orderdetail`
--

CREATE TABLE `orderdetail` (
  `orderID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orderdetail`
--

INSERT INTO `orderdetail` (`orderID`, `productID`, `quantity`) VALUES
(1, 24, 2),
(1, 25, 1),
(2, 24, 3),
(2, 9, 2),
(3, 12, 2),
(4, 9, 7);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `ID` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `create_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`ID`, `total`, `create_at`) VALUES
(1, 10300000, '2019-06-21 18:03:21'),
(2, 26450000, '2019-06-21 18:05:18'),
(3, 302000, '2019-06-21 20:20:46'),
(4, 91000000, '2019-06-21 22:22:00');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ID` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `catID` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock` int(11) NOT NULL,
  `create_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ID`, `name`, `catID`, `price`, `image`, `description`, `stock`, `create_at`) VALUES
(9, 'Galaxy S10+', 1, 13000000, 'samsung-galaxy-s10-plus.jpg', 'Thiết kế sang trọng, bóng bẩy', 37, '2019-06-17 11:26:56'),
(11, 'Samsung galaxy note 8', 1, 100000001, 'samsung-galaxy-note8.jpg', 'galaxy note 8', 12, '2019-06-17 13:39:49'),
(12, 'iPhone 7+', 1, 151000, 'iphone-7-plus.jpg', 'ccvbn', 4, '2019-06-17 14:13:00'),
(15, 'iPhone XR', 1, 500000, 'iphone-xr.jpg', 'bgtrne rư qư', 20, '2019-06-17 17:00:18'),
(16, 'laptop abcd', 2, 15100000, 'laptop msi.jpg', 'đv tmom oqwok', 16, '2019-06-17 17:00:51'),
(17, 'dell inspiron', 2, 20000000, 'laptop lenovo.jpg', 'ssss dddd qqqq', 7, '2019-06-17 17:01:15'),
(18, 'laptop bc', 2, 10000000, 'laptop asus.jpg', 'ccs qừ 3t hg', 7, '2019-06-17 17:03:22'),
(19, 'iPhone 12', 1, 150000, 'iphone-xr.jpg', 'ssss iphone', 46, '2019-06-17 17:04:31'),
(20, 'huawei p30', 1, 15000000, 'huawei-p30.jpg', 'h j lppl oop', 10, '2019-06-17 17:06:02'),
(22, 'acer aspire e5', 2, 15000000, 'laptop abc.jpg', 'ssss ffqw qư qc sac', 7, '2019-06-18 10:27:30'),
(24, 'laptop samsung', 2, 150000, 'laptop samsung.jpg', 'sssf qư', 5, '2019-06-18 10:28:45'),
(25, 'laptop e', 2, 10000000, 'laptop asus 2.jpg', 'bbf a', 6, '2019-06-18 10:29:44'),
(26, 'vivo v15', 1, 5000001, 'vivo-v15-quanghai-400x400.jpg', 'Vivoooooo', 25, '2019-06-22 21:11:01'),
(27, 'Huawei Y7', 1, 1000050, 'huawei-y7-pro-2019-1-400x400.jpg', 'âcscasc ', 20, '2019-06-22 21:12:15'),
(28, 'Blackberry k2', 1, 15101000, 'blackberry-key2-4-400x400.jpg', 'bác học', 25, '2019-06-22 21:13:08'),
(29, 'iPhone 6s+', 1, 5000000, 'iphone-6s-plus-32gb-400x400.jpg', 'hhhhh uuuu', 25, '2019-06-22 21:13:59'),
(30, 'Xiaomi mi 8 lite', 1, 10000000, 'xiaomi-mi-8-lite-black-18thangbh-400x400.jpg', 'cccc ooo hay hya', 25, '2019-06-22 21:15:18'),
(31, 'realme 3', 1, 2500000, 'realme-3-pro-blue-2nambh-400x400.jpg', 'điện thoại cao cấp', 25, '2019-06-22 21:15:46'),
(32, 'laptop hịn', 2, 10000000, 'laptop asus 2.jpg', 'laptop siêuuuuuuuuu xịn', 25, '2019-06-22 21:16:18'),
(33, 'iPhone 7-', 1, 39990000, 'iphone-6s-plus-32gb-400x400.jpg', 'điện thoại iphone 7-', 20, '2019-06-22 21:17:05'),
(34, 'asus k51', 2, 10000000, 'laptop abc.jpg', 'Laptop của asus', 25, '2019-06-22 21:17:33'),
(35, 'macbook pro 5', 2, 10000000, 'laptop bcd.jpg', 'macbook mới nhất', 25, '2019-06-22 21:18:09'),
(36, 'Samsung galaxy note 9+', 1, 15000000, 'samsung-galaxy-s10-plus.jpg', 'jjjuuu abd đẹp', 65, '2019-06-22 21:18:44'),
(37, 'huawei nova 3i', 1, 3650000, 'huawei-y7-pro-2019-1-400x400.jpg', 'điện thoại chống nước', 45, '2019-06-22 21:19:36'),
(38, 'samsung s650', 1, 7000000, 'samsung-galaxy-note8.jpg', 'máy samsung chạy ios', 38, '2019-06-22 21:20:27'),
(39, 'acer b52', 2, 5000000, 'laptop samsung.jpg', 'laptop đời cũ', 38, '2019-06-22 21:22:15'),
(40, 'samsung K980', 2, 10000000, 'laptop abc.jpg', 'laptop abccccccc', 40, '2019-06-22 21:22:52');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `ID` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`ID`, `name`) VALUES
(1, 'Admin'),
(2, 'chủ shop'),
(3, 'khách hàng');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `email`, `password`) VALUES
(1, 'admin@gmail.com', '$2y$10$EG5v/i48qJlo54bIp0BnbuqBDil9uPXePOh.mytHeP3L17cWGlpri'),
(2, 'anhthu.3198@gmail.com', '$2y$10$ustb8ZyUWlaQdRDExIL.Y.00pkNS8McLHluFdRuWPhGZB5olvxzf.'),
(3, 'hieupct98@gmail.com', '$2y$10$tEAC6JBv2.e2yPdoRFRuOuc56kX1MfJW.6pT8DsCWuCHGEN/EPeTC'),
(4, 'hieu@gmail.com', '$2y$10$j62hX9UAFZDAskTt3VM79.RGSjDV.YWDr6u0ixI2Xu5dg4kgqhk/u'),
(5, 'a@gmail.com', '$2y$10$2yMvS24BOxvPCP90WpOfQeHjT7DHQOMbLgEdgk/RF3tw10hJZ07yO'),
(6, 'abc@abc.com', '$2y$10$cWpaEQ3UURh63LMUWxVyvOKIwycj68DSAOpL/yBwi1p41.wI8IFwC'),
(7, 'a@a.com', '$2y$10$yV1VrvnW38q5ozcXs/UVOe9m06j8y0jVrkb02Q4fyhfvesxZSJOx.');

-- --------------------------------------------------------

--
-- Table structure for table `user_order`
--

CREATE TABLE `user_order` (
  `userID` int(11) NOT NULL,
  `orderID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_order`
--

INSERT INTO `user_order` (`userID`, `orderID`) VALUES
(7, 1),
(4, 2),
(7, 3),
(2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `user_product`
--

CREATE TABLE `user_product` (
  `userID` int(11) NOT NULL,
  `productID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_product`
--

INSERT INTO `user_product` (`userID`, `productID`) VALUES
(3, 9),
(2, 11),
(2, 12),
(3, 15),
(3, 16),
(3, 17),
(6, 18),
(6, 19),
(6, 20),
(3, 22),
(3, 24),
(3, 25),
(3, 26),
(3, 27),
(3, 28),
(3, 29),
(2, 30),
(2, 31),
(2, 32),
(2, 33),
(2, 34),
(2, 35),
(2, 36),
(2, 37),
(2, 38),
(2, 39),
(2, 40);

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `userID` int(11) NOT NULL,
  `roleID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`userID`, `roleID`) VALUES
(1, 1),
(2, 2),
(3, 2),
(4, 3),
(5, 3),
(6, 2),
(7, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD KEY `orderID` (`orderID`),
  ADD KEY `productID` (`productID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `catID` (`catID`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user_order`
--
ALTER TABLE `user_order`
  ADD KEY `orderID` (`orderID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `user_product`
--
ALTER TABLE `user_product`
  ADD KEY `userID` (`userID`),
  ADD KEY `productID` (`productID`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD KEY `userID` (`userID`),
  ADD KEY `roleID` (`roleID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD CONSTRAINT `orderdetail_ibfk_1` FOREIGN KEY (`orderID`) REFERENCES `orders` (`ID`),
  ADD CONSTRAINT `orderdetail_ibfk_2` FOREIGN KEY (`productID`) REFERENCES `products` (`ID`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`catID`) REFERENCES `categories` (`id`);

--
-- Constraints for table `user_order`
--
ALTER TABLE `user_order`
  ADD CONSTRAINT `user_order_ibfk_1` FOREIGN KEY (`orderID`) REFERENCES `orders` (`ID`),
  ADD CONSTRAINT `user_order_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `users` (`ID`);

--
-- Constraints for table `user_product`
--
ALTER TABLE `user_product`
  ADD CONSTRAINT `user_product_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`ID`),
  ADD CONSTRAINT `user_product_ibfk_2` FOREIGN KEY (`productID`) REFERENCES `products` (`ID`);

--
-- Constraints for table `user_role`
--
ALTER TABLE `user_role`
  ADD CONSTRAINT `user_role_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`ID`),
  ADD CONSTRAINT `user_role_ibfk_2` FOREIGN KEY (`roleID`) REFERENCES `roles` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
