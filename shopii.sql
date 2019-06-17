-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2019 at 01:16 PM
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

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `ID` int(11) NOT NULL,
  `Name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`ID`, `Name`) VALUES
(1, 'Điện thoại'),
(2, 'Laptop');

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
  `quantity` int(11) NOT NULL,
  `create_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ID`, `name`, `catID`, `price`, `image`, `description`, `quantity`, `create_at`) VALUES
(9, 'Galaxy S10+', 1, 13000000, 'samsung-galaxy-s10-plus.jpg', 'Thiết kế sang trọng, bóng bẩy', 46, '2019-06-17 11:26:56'),
(11, 'Samsung galaxy note 8', 1, 100000001, 'samsung-galaxy-note8.jpg', 'galaxy note 8', 12, '2019-06-17 13:39:49'),
(12, 'iPhone 7+', 1, 151000, 'iphone-7-plus.jpg', 'ccvbn', 6, '2019-06-17 14:13:00'),
(13, 'acer aspire e5', 2, 10000000, 'acer-aspire-e5.jpg', 'đâscasc', 4, '2019-06-17 16:59:17'),
(14, 'macbook air', 2, 15000000, 'apple-macbook-air.jpg', 'hswww', 10, '2019-06-17 16:59:39'),
(15, 'iPhone XR', 1, 500000, 'iphone-xr.jpg', 'bgtrne rư qư', 15, '2019-06-17 17:00:18'),
(16, 'laptop abcd', 2, 15100000, 'asus-a411ua.jpg', 'đv tmom oqwok', 16, '2019-06-17 17:00:51'),
(17, 'dell inspiron', 2, 20000000, 'dell-inspiron-3576.png', 'ssss dddd qqqq', 7, '2019-06-17 17:01:15'),
(18, 'laptop bc', 2, 10000000, 'dell-vostro-3578.jpg', 'ccs qừ 3t hg', 7, '2019-06-17 17:03:22'),
(19, 'iPhone 12', 1, 150000, 'iphone-xr.jpg', 'ssss iphone', 46, '2019-06-17 17:04:31'),
(20, 'huawei p30', 1, 15000000, 'huawei-p30.jpg', 'h j lppl oop', 10, '2019-06-17 17:06:02');

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
(8, 'anhthu@gmail.com', '$2y$10$tAzfeKjoh9Js9rgGLoL0juIM2byzJrGcHjegdgsNYuVHthKD2WLKO'),
(9, 'a1@gmail.com', '$2y$10$vS1ccpa4JBa56ILK/moboOUoQKNHpHw05lJVO4rMrcd89APzfsn4y');

-- --------------------------------------------------------

--
-- Table structure for table `user_product`
--

CREATE TABLE `user_product` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `productID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_product`
--

INSERT INTO `user_product` (`id`, `userID`, `productID`) VALUES
(4, 3, 9),
(6, 2, 11),
(7, 2, 12),
(8, 3, 13),
(9, 3, 14),
(10, 3, 15),
(11, 3, 16),
(12, 3, 17),
(13, 8, 18),
(14, 8, 19),
(15, 8, 20);

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `ID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `roleID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`ID`, `userID`, `roleID`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 2),
(4, 4, 3),
(5, 5, 3),
(6, 6, 3),
(7, 8, 2),
(8, 9, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
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
-- Indexes for table `user_product`
--
ALTER TABLE `user_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userID` (`userID`),
  ADD KEY `productID` (`productID`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `roleID` (`roleID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_product`
--
ALTER TABLE `user_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`catID`) REFERENCES `categories` (`ID`);

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
