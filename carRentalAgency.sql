-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 11, 2021 at 01:09 PM
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

--
-- Dumping data for table `carBookings`
--

INSERT INTO `carBookings` (`bookingId`, `userId`, `vehicleNo`, `noDays`, `startingDate`, `totalCost`, `status`, `datm`) VALUES
(1, 2, 'AP35AA1632', 4, '2021-12-15', 2000, 1, '2021-12-10 18:59:33'),
(2, 2, 'AP35GG6463', 3, '2021-12-16', 4500, 0, '2021-12-10 18:59:56');

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
(1, 'Nikhitha Car Rental Agency', 'nikhithacarrentalagency@gmail.com', '9491694195', 'VIJAYANAGARAM', 'Sathiwada, vijayanagaram', 'ARN9491694195', 'nikhitha car rental agencynikhithacarrentalagency@gmail.com.pdf', '$2y$10$VFY3THd/z6sP9ODnDkKUiOoP.SLbwIw/2p.Psb.flMXov.EvrYnuW', 'nikhithacarrentalagency@gmail.com.jpeg', 0, '2021-12-10 17:20:30'),
(2, 'Goteti Jayachandra', 'gotetijayachandra@gmail.com', '9491694195', 'VISAKHAPATNAM', '1-73/78 Medacharla Village K.Kotapadu Mandal', '946481686094', 'goteti jayachandragotetijayachandra@gmail.com.pdf', '$2y$10$4uWBy440YrXqR0KFvf/w8OdnNq91D2b27/hrf.GM/g1v.pNQI0tdS', 'gotetijayachandra@gmail.com.jpg', 1, '2021-12-10 18:15:31'),
(3, 'Guntur Rental Agency', 'gunturrentalagency@gmail.com', '9491694195', 'GUNTUR', 'guntur', 'ARNG9491694195', 'guntur rental agencygunturrentalagency@gmail.com.pdf', '$2y$10$q/L255aQFQGoM429MLZKAu1IB3zTYF9VE71Kn.bWUzL5TZwEIsnf6', NULL, 0, '2021-12-10 18:16:12'),
(4, 'Vishakapatnam Car Rental Agency', 'vishakapatnamcarrentalagency@gmail.com', '9491694195', 'VISHAKAPATNAM', 'vishakapatnam', 'ARNV9491694195', 'vishakapatnam car rental agencyvishakapatnamcarrentalagency@gmail.com.pdf', '$2y$10$W6JI2BGiDak5eRhgkLAp0.5OUKFl/N91O8oSsmWS.dlYvHc5xBVNO', NULL, 0, '2021-12-10 18:17:37'),
(5, 'Tirupati Car Rental Agency', 'tirupaticarrentalagency@gmail.com', '9491694195', 'TIRUPATI', 'tirupati', 'ARNTTD9491694195', 'tirupati car rental agencytirupaticarrentalagency@gmail.com.pdf', '$2y$10$aCw9gxYTg119TUUYPdyrWOXgqegwcBz./idFTUa2zTrktV3GO5iBe', NULL, 0, '2021-12-10 18:18:20'),
(6, 'Nellore Car Rental Agency', 'nellorecarrentalagency@gmail.com', '9491694195', 'NELLORE', 'Nellore', 'ARNLD9491694195', 'nellore car rental agencynellorecarrentalagency@gmail.com.pdf', '$2y$10$b10wjCQYaf3vLTej5zdJ1.ObUJcAnPs8QqPOpa79Gb3c07Pt8mcQy', NULL, 0, '2021-12-10 18:20:02'),
(7, 'vijayanagaram Car Rental Agency', 'vijayanagaramrentalagency@gmail.com', '9491694195', 'VIJAYANAGARAM', 'vijayanagaram', 'ARNVZM9491694195', 'vijayanagaram car rental agencyvijayanagaramrentalagency@gmail.com.pdf', '$2y$10$BI0lIR6K.j095vIaYKur9..zz8C1Q4Si3xuOj/bUstSitXkjEIKZC', NULL, 0, '2021-12-10 18:22:34');

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
('AP31AA1312', 'TOYOTA INNOVA CRYSTA', 8, 1000, 'ap31aa1312.jpeg', 0, 1, '2021-12-11 03:46:29'),
('AP34GS1232', 'AULTO K10', 5, 500, 'ap34gs1232.jpg', 0, 4, '2021-12-10 18:53:09'),
('AP34VI5562', 'TOYOTA INNOVA CRYSTA', 8, 1550, 'ap34vi5562.jpeg', 0, 4, '2021-12-10 18:54:36'),
('AP34VR3332', 'WAGON R', 5, 550, 'ap34vr3332.jpg', 0, 4, '2021-12-10 18:53:42'),
('AP35AA1234', 'SHIFT', 5, 750, 'ap35aa1234.jpeg', 0, 5, '2021-12-10 18:51:10'),
('AP35AA1632', 'AULTO', 5, 500, 'ap35aa1632.jpg', 1, 6, '2021-12-10 18:47:58'),
('AP35DF5555', 'SHIFT', 5, 750, 'ap35df5555.jpg', 0, 5, '2021-12-10 18:51:35'),
('AP35GG4444', 'TOYOTA INNOVA CRYSTA', 8, 1500, 'ap35gg4444.jpeg', 0, 6, '2021-12-10 18:49:38'),
('AP35GG6463', 'TOYOTA INNOVA CRYSTA', 8, 1500, 'ap35gg6463.jpeg', 1, 6, '2021-12-10 18:49:20'),
('AP35HG6755', 'SHIFT', 5, 750, 'ap35hg6755.jpg', 0, 5, '2021-12-10 18:51:58'),
('AP35RA1734', 'SKODA RAPID', 5, 1500, 'ap35ra1734.jpg', 0, 7, '2021-12-10 18:30:09'),
('AP35RA5353', 'MAHINDRA THAR', 5, 1750, 'ap35ra5353.jpg', 0, 7, '2021-12-10 18:31:04'),
('AP35RA5553', 'AULTO K10', 5, 550, 'ap35ra5553.jpg', 0, 7, '2021-12-10 18:32:07'),
('AP35SS1235', 'AULTO K10', 5, 555, 'ap35ss1235.jpg', 0, 3, '2021-12-10 18:55:42'),
('AP35SS1665', 'WAGON R', 5, 750, 'ap35ss1665.jpg', 0, 3, '2021-12-10 18:56:50');

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
  MODIFY `bookingId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
