-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 31, 2026 at 12:06 PM
-- Server version: 10.11.16-MariaDB
-- PHP Version: 8.3.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `acedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `accessories`
--

CREATE TABLE `accessories` (
  `accessoriesID` int(11) NOT NULL,
  `accessoriesName` varchar(255) NOT NULL,
  `accessoriesPrice` decimal(8,2) NOT NULL,
  `accessoriesImage` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accessories`
--

INSERT INTO `accessories` (`accessoriesID`, `accessoriesName`, `accessoriesPrice`, `accessoriesImage`) VALUES
(1, 'Stitch Keychain', 200.00, 'Assets/Images/Stitch Keychain.png'),
(2, 'Labubu Keychain', 200.00, 'Assets/Images/Labubu Keychain.png'),
(3, 'Blue-White Bi-Color Rope', 300.00, 'Assets/Images/Blue-White Bi-Color Rope.png'),
(4, 'Purple Bi-Color', 300.00, 'Assets/Images/Purple Bi-Colour Rope.png'),
(5, 'Blue-Yellow Bi-Color Rope', 395.00, 'Assets/Images/Blue-Yellow Bi-Color Rope.png'),
(6, 'Blue-Pink Straw Lid', 395.00, 'Assets/Images/Blue-Pink straw lid.png'),
(7, 'Yellow-Purple Straw Lid', 395.00, 'Assets/Images/yellow-purple straw lid.png'),
(8, 'Blue-Green Straw Lid', 395.00, 'Assets/Images/Blue-Green straw lid.png'),
(9, 'Silicone Base 500 - 750 ml', 250.00, 'Assets/Images/silicone base 500 - 750 ml.png'),
(10, 'Silicone Base 1L', 250.00, 'Assets/Images/silicone base 1L.png');

-- --------------------------------------------------------

--
-- Table structure for table `bottle_colours`
--

CREATE TABLE `bottle_colours` (
  `colourID` int(50) NOT NULL,
  `colour` varchar(255) NOT NULL,
  `colourImage` varchar(255) NOT NULL,
  `Price` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bottle_colours`
--

INSERT INTO `bottle_colours` (`colourID`, `colour`, `colourImage`, `Price`) VALUES
(1, 'Red', 'Assets\\Images\\bottle_colours\\red_bottle.png', 800),
(2, 'Blue', 'Assets\\Images\\bottle_colours\\blue_bottle.png', 800),
(3, 'Green', 'Assets\\Images\\bottle_colours\\green_bottle.png', 800),
(4, 'Yellow', 'Assets\\Images\\bottle_colours\\yellow_bottle.png', 800),
(5, 'Purple', 'Assets\\Images\\bottle_colours\\purple_bottle.png', 800),
(6, 'Orange', 'Assets\\Images\\bottle_colours\\orange_bottle.png', 1000);

-- --------------------------------------------------------

--
-- Table structure for table `caps`
--

CREATE TABLE `caps` (
  `capID` int(50) NOT NULL,
  `capColour` varchar(255) NOT NULL,
  `capImage` varchar(255) NOT NULL,
  `Price` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `caps`
--

INSERT INTO `caps` (`capID`, `capColour`, `capImage`, `Price`) VALUES
(1, 'Black', 'Assets\\Images\\caps\\default_cap.png', 0),
(2, 'Red', 'Assets\\Images\\caps\\red_cap.png', 150),
(3, 'Blue', 'Assets\\Images\\caps\\blue_cap.png', 150),
(4, 'Green', 'Assets\\Images\\caps\\green_cap.png', 150),
(5, 'Yellow', 'Assets\\Images\\caps\\yellow_cap.png', 150),
(6, 'Purple', 'Assets\\Images\\caps\\purple_cap.png', 150);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `first_name`, `last_name`, `email`, `password`) VALUES
(1, 'test', 'test', 'test@email.com', '$2y$10$o.IPCTgZnXtNwK9l59hG2uDH50a.e6aCT2brSDRV63IjJlME3AQZe');

-- --------------------------------------------------------

--
-- Table structure for table `icons`
--

CREATE TABLE `icons` (
  `iconID` int(50) NOT NULL,
  `iconName` varchar(255) NOT NULL,
  `iconImage` varchar(255) NOT NULL,
  `Price` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `icons`
--

INSERT INTO `icons` (`iconID`, `iconName`, `iconImage`, `Price`) VALUES
(1, 'Bedtime', 'Assets\\Images\\icons\\bedtime.png', 250),
(2, 'Bubble_tea', 'Assets\\Images\\icons\\bubble_tea.png', 250),
(3, 'Cool', 'Assets\\Images\\icons\\cool.png', 250),
(4, 'Skateboard', 'Assets\\Images\\icons\\skateboard.png', 250),
(5, 'Workout', 'Assets\\Images\\icons\\workout.png', 250);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderID` int(50) NOT NULL,
  `customerID` int(50) NOT NULL,
  `totalPrice` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `orderItemID` int(50) NOT NULL,
  `orderID` int(50) NOT NULL,
  `personalisationID` int(50) DEFAULT NULL,
  `accessoriesID` int(50) DEFAULT NULL,
  `price` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personalisations`
--

CREATE TABLE `personalisations` (
  `personalisationID` int(50) NOT NULL,
  `colourID` int(50) NOT NULL,
  `capID` int(50) NOT NULL,
  `iconID` int(50) NOT NULL,
  `Price` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accessories`
--
ALTER TABLE `accessories`
  ADD PRIMARY KEY (`accessoriesID`);

--
-- Indexes for table `bottle_colours`
--
ALTER TABLE `bottle_colours`
  ADD PRIMARY KEY (`colourID`);

--
-- Indexes for table `caps`
--
ALTER TABLE `caps`
  ADD PRIMARY KEY (`capID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `EMAIL` (`email`);

--
-- Indexes for table `icons`
--
ALTER TABLE `icons`
  ADD PRIMARY KEY (`iconID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderID`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`orderItemID`);

--
-- Indexes for table `personalisations`
--
ALTER TABLE `personalisations`
  ADD PRIMARY KEY (`personalisationID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accessories`
--
ALTER TABLE `accessories`
  MODIFY `accessoriesID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `bottle_colours`
--
ALTER TABLE `bottle_colours`
  MODIFY `colourID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `caps`
--
ALTER TABLE `caps`
  MODIFY `capID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `icons`
--
ALTER TABLE `icons`
  MODIFY `iconID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderID` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `orderItemID` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personalisations`
--
ALTER TABLE `personalisations`
  MODIFY `personalisationID` int(50) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
