-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 09, 2021 at 08:02 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `carRentalAgency`
--

-- --------------------------------------------------------

--
-- Table structure for table `carBookings`
--

CREATE TABLE `carBookings` (
  `bookingId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `vehicleNo` varchar(25) NOT NULL,
  `noDays` int(10) NOT NULL,
  `startingDate` varchar(200) NOT NULL,
  `totalCost` int(11) NOT NULL,
  `status` int(2) NOT NULL,
  `datm` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contactNo` varchar(11) NOT NULL,
  `city` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `AadharNoOrAgencyRegistrationNo` varchar(100) NOT NULL,
  `document` varchar(225) NOT NULL,
  `password` text NOT NULL,
  `profileImage` varchar(200) DEFAULT NULL,
  `loginType` tinyint(1) NOT NULL,
  `datm` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `name`, `email`, `contactNo`, `city`, `address`, `AadharNoOrAgencyRegistrationNo`, `document`, `password`, `profileImage`, `loginType`, `datm`) VALUES
(1, 'Goteti Jayachandra', 'gotetijayachandra@gmail.com', '9491694195', 'VISAKHAPATNAM', '1-73/78 Medacharla Village K.Kotapadu Mandal', '946481686094', 'goteti jayachandragotetijayachandra@gmail.com.pdf', '$2y$10$MnvX0lUTdcqYLJ4RT2qVnu2ZoReukZXn/5IDaGGaqfxv49DpwBaWi', 'gotetijayachandra@gmail.com.jpeg', 1, '2021-12-09 18:47:40'),
(2, 'Nikhitha Rental Agency', 'nikhitharentalagency@gmail.com', '9491694195', 'VIJAYANAGARAM', 'Sathiwada, vijayanagaram', 'ARN9491694195', 'nikhitha rental agencynikhitharentalagency@gmail.com.pdf', '$2y$10$lc6D9rvx2JOW6dAisUepZOQxQ/Pw/Tt8a2pVSSMoPEcFU4EehLKKe', 'nikhitharentalagency@gmail.com.png', 0, '2021-12-09 18:52:55');

-- --------------------------------------------------------

--
-- Table structure for table `vehicleList`
--

CREATE TABLE `vehicleList` (
  `vehicleNo` varchar(50) NOT NULL,
  `vehicleModel` varchar(100) NOT NULL,
  `seatingCapacity` int(5) NOT NULL,
  `rentPerDay` int(10) NOT NULL,
  `vehicleImage` varchar(220) NOT NULL,
  `VehicleStatus` tinyint(1) NOT NULL,
  `userId` int(11) NOT NULL,
  `datm` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vehicleList`
--

INSERT INTO `vehicleList` (`vehicleNo`, `vehicleModel`, `seatingCapacity`, `rentPerDay`, `vehicleImage`, `VehicleStatus`, `userId`, `datm`) VALUES
('AP35RA1734', 'AULTO', 5, 750, 'ap35ra1734.jpg', 0, 2, '2021-12-09 18:55:45'),
('AP35RA1735', 'AULTO K10', 5, 800, 'ap35ra1735.jpg', 0, 2, '2021-12-09 18:57:27'),
('AP35RA1990', 'AULTO K10', 5, 850, 'ap35ra1990.jpg', 0, 2, '2021-12-09 18:58:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carBookings`
--
ALTER TABLE `carBookings`
  ADD PRIMARY KEY (`bookingId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `vehicleList`
--
ALTER TABLE `vehicleList`
  ADD UNIQUE KEY `Vehicle No` (`vehicleNo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carBookings`
--
ALTER TABLE `carBookings`
  MODIFY `bookingId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
