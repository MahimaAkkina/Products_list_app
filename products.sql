-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2024 at 09:07 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `products_list`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `image` varchar(500) NOT NULL,
  `category` varchar(250) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `sale_status` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `image`, `category`, `price`, `sale_status`) VALUES
(1, 'Vivo', 'phone.jpg', 'Mobile', 15000.00, 'On sale'),
(2, 'ASUS VivoBook', 'asus.jpg', 'Laptop', 47000.00, 'On sale'),
(3, 'Boat', 'boat.jpg', 'Headphones', 3500.00, 'On sale'),
(4, 'Oppo', 'oppo.jpg', 'Mobile', 10000.00, 'On sale'),
(5, 'HP', 'hp.jpg', 'Laptop', 40000.00, 'On sale'),
(6, 'Nokia', 'nokia.jpg', 'Mobile', 12000.00, 'On sale'),
(7, 'POCO', 'poco.jpg', 'Mobile', 9000.00, 'Not on sale'),
(8, 'Stax', 'stax.jpg', 'Headphones', 4000.00, 'On sale'),
(9, 'MSI', 'msi.jpg', 'Laptop', 80000.00, 'On sale'),
(10, 'Redmi', 'redmi.jpg', 'Mobile', 7500.00, 'On sale'),
(11, 'Apple', 'applelap.jpg', 'Laptop', 95499.00, 'On sale'),
(12, 'Dell', 'dell.jpg', 'Laptop', 65350.00, 'Not on sale'),
(13, 'Zebronics', 'zebro.jpg', 'Headphones', 5050.00, 'On sale'),
(14, 'Vodafone', 'vodafone.jpg', 'Mobile', 6700.00, 'Not on sale'),
(15, 'Infinix', 'infinix.jpg', 'Laptop', 72000.00, 'On sale'),
(16, 'L.G', 'lg.jpg', 'Laptop', 50700.00, 'On sale'),
(17, 'Lenovo', 'lenovo.jpg', 'Laptop', 45000.00, 'On sale'),
(18, 'Focal', 'focal.jpg', 'Headphones', 3700.00, 'Not on sale'),
(19, 'Apple iPhone', 'apple.jpg', 'Mobile', 35000.00, 'Not on sale'),
(20, 'Philips', 'philips.jpg', 'Headphones', 4599.00, 'On sale'),
(21, 'Samsung', 'samsung.jpg', 'Mobile', 25000.00, 'On sale'),
(22, 'Acer', 'acer.jpg', 'Laptop', 36000.00, 'On sale'),
(23, 'Bose', 'bose.jpg', 'Headphones', 6500.00, 'On sale'),
(24, 'Realme', 'realme.jpg', 'Mobile', 15500.00, 'On sale'),
(25, 'Sony', 'sony.jpg', 'Laptop', 76000.00, 'Not on sale'),
(26, 'Grado', 'grad.jpg', 'Headphones', 3500.00, 'On sale');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
