-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 26, 2017 at 01:41 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.0.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `demo_paypal`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `oid` int(11) NOT NULL,
  `pid_fk` int(11) DEFAULT NULL,
  `uid_fk` int(11) DEFAULT NULL,
  `payerID` varchar(300) DEFAULT NULL,
  `paymentID` varchar(400) DEFAULT NULL,
  `token` varchar(400) DEFAULT NULL,
  `created` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`oid`, `pid_fk`, `uid_fk`, `payerID`, `paymentID`, `token`, `created`) VALUES
(5, 1, 1, '8B6CEM33UZFFG', 'PAY-4EU9291320072404VLG6EY3Q', 'EC-6M9829956F554642S', 1505665831),
(6, 2, 1, '8B6CEM33UZFFG', 'PAY-59X180707Y2127145LG75DRA', 'EC-5NW69550VG452514Y', 1505743317),
(7, 1, 1, '8B6CEM33UZFFG', 'PAY-1LP319553K4748813LG75WZQ', 'EC-52V24967TB735624C', 1505745783),
(8, 1, 1, '8B6CEM33UZFFG', 'PAY-75R31998X3933340BLG777KY', 'EC-8CN890966V0309306', 1505755075);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `pid` int(11) NOT NULL,
  `product` varchar(255) DEFAULT NULL,
  `product_img` varchar(100) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `currency` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pid`, `product`, `product_img`, `price`, `currency`) VALUES
(1, '9lessons Sticker', '9lessons.png', 2, 'USD'),
(2, 'WallScript Sticker', 'wallscript.png', 3, 'USD');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `username` varchar(200) DEFAULT NULL,
  `password` varchar(400) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `username`, `password`, `email`) VALUES
(1, 'srinivas', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'srinivas@9lessons.info');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`oid`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `oid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
