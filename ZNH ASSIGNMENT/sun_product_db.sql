-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2024 at 10:16 AM
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
-- Database: `sun_product_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_products`
--

CREATE TABLE `tb_products` (
  `ID` int(11) NOT NULL,
  `PRODUCT_NAME` varchar(255) NOT NULL,
  `PRICE` int(11) NOT NULL,
  `POST_DATE` datetime NOT NULL DEFAULT current_timestamp(),
  `DESCRIPTION` varchar(255) NOT NULL,
  `SELLER_ID` varchar(255) NOT NULL,
  `CATEGORY` varchar(255) NOT NULL,
  `STATUS` varchar(255) NOT NULL,
  `PRODUCT_IMAGE` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_products`
--

INSERT INTO `tb_products` (`ID`, `PRODUCT_NAME`, `PRICE`, `POST_DATE`, `DESCRIPTION`, `SELLER_ID`, `CATEGORY`, `STATUS`, `PRODUCT_IMAGE`) VALUES
(0, 'Ceramic Vases', 69, '2024-11-29 09:51:16', '3set of Ceramic Vases', 'Admin', 'home', 'active', 'C:\\xampp\\htdocs\\ZNH Assignment\\includes/files/product/Screenshot_2024-11-29_063541.png'),
(1, 'Family table', 90, '2024-11-29 09:51:54', 'Brown Flexible Family size Table ', 'Admin', 'home', 'active', 'C:\\xampp\\htdocs\\ZNH Assignment\\includes/files/product/Screenshot_2024-11-29_063335.png'),
(2, 'Cookware Set', 79, '2024-11-29 09:52:11', 'Stainless Steel Kitchen Cookware Set', 'Admin', 'home', 'active', 'C:\\xampp\\htdocs\\ZNH Assignment\\includes/files/product/Screenshot_2024-11-29_073800.png'),
(5, 'White Sweater', 95, '2024-11-29 09:52:24', 'Sweater for men', 'Admin', 'fashion', 'active', 'C:\\xampp\\htdocs\\ZNH Assignment\\includes/files/product/sweater1.png'),
(6, 'R&D Magic BoX for car', 50, '2024-11-29 09:52:42', 'R&D Magicbox carplay Wired to wireless for iphone and android', 'Admin', 'electronics', 'active', 'C:\\xampp\\htdocs\\ZNH Assignment\\includes/files/product/Screenshot_2024-11-29_064855.png'),
(7, 'Security Camera', 52, '2024-11-29 09:52:56', 'Security Camera', 'Admin', 'electronics', 'active', 'C:\\xampp\\htdocs\\ZNH Assignment\\includes/files/product/Screenshot_2024-11-29_073238.png'),
(59, 'Blue Jacket', 46, '2024-11-29 09:53:10', 'Blue Jacket for men', 'Admin', 'fashion', 'active', 'C:\\xampp\\htdocs\\ZNH Assignment\\includes/files/product/Screenshot_2024-11-25_042651.png'),
(175, 'Hood Jacket', 80, '2024-11-29 09:54:27', 'Seasonal LightWeight Hood Jacket', 'Admin', 'fashion', 'active', 'C:\\xampp\\htdocs\\ZNH Assignment\\includes/files/product/Jacket1.png'),
(76185038, 'Headset', 53, '2024-11-29 09:54:41', 'Set of Head Phone and earphone', 'Admin', 'electronics', 'active', 'C:\\xampp\\htdocs\\ZNH Assignment\\includes/files/product/Screenshot_2024-11-29_064402.png');

-- --------------------------------------------------------

--
-- Table structure for table `tb_users`
--

CREATE TABLE `tb_users` (
  `ID` varchar(255) NOT NULL,
  `USERNAME` varchar(30) NOT NULL,
  `EMAIL` varchar(255) NOT NULL,
  `PASSWORD` varchar(30) NOT NULL,
  `ROLE` tinyint(1) NOT NULL,
  `PROFILE` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_users`
--

INSERT INTO `tb_users` (`ID`, `USERNAME`, `EMAIL`, `PASSWORD`, `ROLE`, `PROFILE`) VALUES
('0049623c-11a7-4825-8f1d-d83ee853f6db', 'bang', 'bang@gmail.com', '123', 0, 'C:\\xampp\\htdocs\\ZNH Assignment\\includes/files/profile/WIN_20241125_03_03_06_Pro.jpg'),
('841e6492-b8a6-4a0f-9487-5e0c3e0d0924', 'Admin', 'admin@gmail.com', 'admin', 1, 'C:\\xampp\\htdocs\\ZNH Assignment\\includes/files/profile/admin.png'),
('87734199-b889-464d-b718-65310f12735a', 'Cold', 'cold@gmail.com', '123', 0, 'C:\\xampp\\htdocs\\ZNH Assignment\\includes/files/profile/WIN_20241125_04_31_50_Pro.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_products`
--
ALTER TABLE `tb_products`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `EMAIL` (`EMAIL`),
  ADD UNIQUE KEY `PICTURE` (`PROFILE`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
