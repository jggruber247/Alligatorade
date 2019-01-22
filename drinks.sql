-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2018 at 08:31 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.8

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

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`C_custid`, `D_id`, `item`, `price`, `c_quantity`) VALUES
('cu123', 'ALO3', 'aligatorade-orange', '2.99', '10');

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
('cu123', 'maddddddlad', 'guuuuuuujm', 'jsgd', 0),
('KWKW1', 'kyle', 'koolkyle', 'radk', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_ID` varchar(5) NOT NULL,
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
('', '2018-11-09', 'KWKW1', 'ALB1', '10', '2.99'),
('', '2018-11-09', 'KWKW1', 'ALR2', '12', '2.99'),
('', '2018-11-09', 'KWKW1', 'ALB1', '10', '2.99'),
('', '2018-11-09', 'KWKW1', 'ALR2', '12', '2.99'),
('', '2018-11-09', 'KWKW1', 'ALB1', '10', '2.99'),
('', '2018-11-09', 'KWKW1', 'ALR2', '12', '2.99'),
('', '2018-11-09', 'KWKW1', 'ALB1', '10', '2.99'),
('', '2018-11-09', 'KWKW1', 'ALR2', '12', '2.99'),
('', '2018-11-09', 'KWKW1', 'ALB1', '10', '2.99'),
('', '2018-11-09', 'KWKW1', 'ALR2', '12', '2.99'),
('', '2018-11-09', 'KWKW1', 'ALB1', '10', '2.99'),
('', '2018-11-09', 'KWKW1', 'ALR2', '12', '2.99'),
('', '2018-11-09', 'KWKW1', 'ALB1', '10', '2.99'),
('', '2018-11-09', 'KWKW1', 'ALR2', '12', '2.99'),
('', '2018-11-09', 'KWKW1', 'ALB1', '10', '2.99'),
('', '2018-11-09', 'KWKW1', 'ALR2', '12', '2.99'),
('', '2018-11-09', 'KWKW1', 'ALB1', '10', '2.99'),
('', '2018-11-09', 'KWKW1', 'ALR2', '12', '2.99'),
('', '2018-11-09', 'KWKW1', 'ALB1', '10', '2.99'),
('', '2018-11-09', 'KWKW1', 'ALR2', '12', '2.99');

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

-- --------------------------------------------------------

--
-- Table structure for table `shipment`
--

CREATE TABLE `shipment` (
  `package_Num` varchar(20) NOT NULL,
  `ship_id` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `drink_ID` varchar(5) NOT NULL,
  `dr_name` varchar(20) DEFAULT NULL,
  `unit_price` decimal(10,2) DEFAULT NULL,
  `inventory` decimal(10,2) DEFAULT NULL,
  `pic` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`drink_ID`, `dr_name`, `unit_price`, `inventory`, `pic`) VALUES
('ALB1', 'Aligatorade-blue', '2.99', '160.00', 'blueDrink.png'),
('ALO3', 'Aligatorade-orange', '2.99', '150.00', 'orangeDrink.png'),
('ALR2', 'Aligatorade-red', '2.99', '150.00', 'redDrink.png');

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
-- Indexes for table `shipment`
--
ALTER TABLE `shipment`
  ADD PRIMARY KEY (`package_Num`),
  ADD KEY `ship_id` (`ship_id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`drink_ID`);

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

--
-- Constraints for table `shipment`
--
ALTER TABLE `shipment`
  ADD CONSTRAINT `shipment_ibfk_1` FOREIGN KEY (`ship_id`) REFERENCES `orders` (`order_ID`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
