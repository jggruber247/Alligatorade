-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 27, 2019 at 08:42 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `drinks`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `C_custid` varchar(5) DEFAULT NULL,
  `D_id` varchar(5) DEFAULT NULL,
  `item` varchar(20) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `c_quantity` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `cust_ID` varchar(5) NOT NULL,
  `cust_name` varchar(20) DEFAULT NULL,
  `username` varchar(10) DEFAULT NULL,
  `password` varchar(10) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`cust_ID`, `cust_name`, `username`, `password`, `status`) VALUES
('ad111', 'Bob', 'Barkley', 'stoo', 0),
('ad247', 'Garrett', 'guy247bp', 'no', 1),
('cu123', 'maddddddlad', 'guuuuuuujm', 'jsgd', 0),
('KWKW1', 'kyle', 'koolkyle', 'radk', 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_ID` int(5) NOT NULL,
  `O_date` date DEFAULT NULL,
  `o_cust_id` varchar(5) DEFAULT NULL,
  `o_drinkID` varchar(5) DEFAULT NULL,
  `Quantity` decimal(10,0) DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_ID`, `O_date`, `o_cust_id`, `o_drinkID`, `Quantity`, `total_price`) VALUES
(1, '2018-11-09', 'KWKW1', 'ALB1', '10', '2.99'),
(2, '2018-11-09', 'KWKW1', 'ALR2', '12', '2.99'),
(3, '2018-11-09', 'KWKW1', 'ALB1', '10', '2.99'),
(4, '2018-11-09', 'KWKW1', 'ALR2', '12', '2.99'),
(5, '2018-11-09', 'KWKW1', 'ALB1', '10', '2.99'),
(6, '2018-11-09', 'KWKW1', 'ALR2', '12', '2.99'),
(7, '2018-11-09', 'KWKW1', 'ALB1', '10', '2.99'),
(8, '2018-11-09', 'KWKW1', 'ALR2', '12', '2.99'),
(9, '2018-11-09', 'KWKW1', 'ALB1', '10', '2.99'),
(10, '2018-11-09', 'KWKW1', 'ALR2', '12', '2.99'),
(11, '2018-11-09', 'KWKW1', 'ALB1', '10', '2.99'),
(12, '2018-11-09', 'KWKW1', 'ALR2', '12', '2.99'),
(13, '2018-11-09', 'KWKW1', 'ALB1', '10', '2.99'),
(14, '2018-11-09', 'KWKW1', 'ALR2', '12', '2.99'),
(15, '2018-11-09', 'KWKW1', 'ALB1', '10', '2.99'),
(16, '2018-11-09', 'KWKW1', 'ALR2', '12', '2.99'),
(17, '2018-11-09', 'KWKW1', 'ALB1', '10', '2.99'),
(18, '2018-11-09', 'KWKW1', 'ALR2', '12', '2.99'),
(19, '2018-11-09', 'KWKW1', 'ALB1', '10', '2.99'),
(20, '2018-11-09', 'KWKW1', 'ALR2', '12', '2.99'),
(21, '2018-12-04', 'ad247', 'ALP6', '124', '370.76'),
(22, '2018-12-04', 'ad247', 'ALB1', '13', '38.87'),
(23, '2018-12-04', 'ad247', 'ALO3', '24', '71.76'),
(24, '2018-12-04', 'ad247', 'ALY5', '22', '65.78'),
(25, '2018-12-04', 'ad247', 'ALP6', '100', '299.00'),
(26, '2018-12-04', 'ad247', 'ALO3', '-300', '-897.00');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `cardName` varchar(20) NOT NULL,
  `cardNum` varchar(30) NOT NULL,
  `cardCV` varchar(5) NOT NULL,
  `expDate` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`cardName`, `cardNum`, `cardCV`, `expDate`) VALUES
('Garrett', '1234-5678', '247', '010120'),
('Garrett', '12341233', '135', '1222'),
('HenryFord', '12', '122', '122346');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `drink_ID` varchar(5) NOT NULL,
  `dr_name` varchar(20) DEFAULT NULL,
  `unit_price` decimal(10,2) DEFAULT NULL,
  `inventory` decimal(10,0) DEFAULT NULL,
  `pic` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`drink_ID`, `dr_name`, `unit_price`, `inventory`, `pic`) VALUES
('ALB1', 'Blue Bayou', '2.99', '600', 'blueDrink.png'),
('ALO3', 'Orange Crusher', '2.99', '600', 'orangeDrink.png'),
('ALP6', 'Gator Grape', '2.99', '600', 'purpleDrink.png'),
('ALR2', 'Red Snapper', '2.99', '600', 'redDrink.png'),
('ALY5', 'Yellowbelly', '2.99', '600', 'yellowDrink.png'),
('ALZ4', 'Coming Soon!', '3.59', '0', 'nullDrink.png'),
('ALZ7', 'Coming 2019!', '3.99', '0', 'nullDrink.png'),
('ALZ8', 'Coming Late 2019!', '1.50', '0', 'nullDrink.png'),
('ALZ9', 'Coming Eventually', '2.29', '0', 'nullDrink.png'),
('ALZ91', 'Maybe Coming', '10.00', '0', 'nullDrink.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD KEY `C_custid` (`C_custid`),
  ADD KEY `cart_ibfk_2` (`D_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`cust_ID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD KEY `order_ID` (`order_ID`),
  ADD KEY `o_cust_id` (`o_cust_id`),
  ADD KEY `o_drinkID` (`o_drinkID`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`drink_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`C_custid`) REFERENCES `customers` (`cust_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`D_id`) REFERENCES `stock` (`drink_ID`) ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`o_cust_id`) REFERENCES `customers` (`cust_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`o_drinkID`) REFERENCES `stock` (`drink_ID`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
