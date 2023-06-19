-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2023 at 08:01 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `basobas`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `aid` int(11) NOT NULL,
  `aname` varchar(30) NOT NULL,
  `apassword` varchar(255) DEFAULT NULL,
  `aemail` varchar(30) NOT NULL,
  `aphone` bigint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`aid`, `aname`, `apassword`, `aemail`, `aphone`) VALUES
(3, 'shankarsan', 'I@madmin123', 'shankarsan@gmail.com', 9863197067);

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `bid` int(11) NOT NULL,
  `tenant` int(11) NOT NULL,
  `landlord` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `property` int(11) NOT NULL,
  `request` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`bid`, `tenant`, `landlord`, `status`, `property`, `request`) VALUES
(55, 20, 8, 1, 20, 1),
(56, 20, 5, 1, 92, 1);

-- --------------------------------------------------------

--
-- Table structure for table `landlord`
--

CREATE TABLE `landlord` (
  `lid` int(11) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `lpassword` varchar(255) DEFAULT NULL,
  `lemail` varchar(30) NOT NULL,
  `lphone` bigint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `landlord`
--

INSERT INTO `landlord` (`lid`, `lname`, `lpassword`, `lemail`, `lphone`) VALUES
(5, 'Shiva', '$2y$10$Nfvj9G8MSktCplGotxbJY.0PPTBlO3Yjv9XNRTaoK/lQ.uNvOG2Ja', 'shiva@gmail.com', 9876543210),
(8, 'Shivam', '$2y$10$RGnyudRoYMhZbZPm1hqqzOF1iJv9wNok1f0BtHYSIUGR/P.HissLy', 'shivam@gmail.com', 9865384739),
(10, 'New', '$2y$10$SFZo0n/2LHa9DYccnEdByOZf8PAvSFJatgKlfN3h/u/qb36302fiq', 'New123@gmail.com', 1029384756);

-- --------------------------------------------------------

--
-- Table structure for table `property`
--

CREATE TABLE `property` (
  `pid` int(11) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `rooms` tinyint(4) NOT NULL,
  `landlord` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `property`
--

INSERT INTO `property` (`pid`, `photo`, `location`, `description`, `price`, `rooms`, `landlord`) VALUES
(20, 'uploads/francesca-tosolini-hCU4fimRW-c-unsplash.jpg', 'biratnagar', 'adfadfsadfs', '2000.00', 2, 8),
(91, 'uploads/sidekix-media-WgkA3CSFrjc-unsplash.jpg', 'lalitpur', 'line vaye le natra chup lag', '2000.00', 1, 8),
(92, 'uploads/chastity-cortijo-R-w5Q-4Mqm0-unsplash.jpg', 'kathmandu', 'Room has an attached bathroom\r\n20 by 30 meter area', '1200.00', 2, 5);

-- --------------------------------------------------------

--
-- Table structure for table `tenant`
--

CREATE TABLE `tenant` (
  `tid` int(11) NOT NULL,
  `tname` varchar(50) NOT NULL,
  `tpassword` varchar(255) DEFAULT NULL,
  `temail` varchar(50) NOT NULL,
  `tphone` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tenant`
--

INSERT INTO `tenant` (`tid`, `tname`, `tpassword`, `temail`, `tphone`) VALUES
(2, 'tenant123', '$2y$10$YHf3MWASMx3tgnQJMJANwuWdN6K/eWuc7sxHfxdOs/Spd4wKxJZtG', 'tenant123@gmail.com', 9198793123),
(17, 'RamBahadur', '$2y$10$nFf41Vf0pY3OcFlwCOGe5OhFwIzozdQNk8mNyFpETYyDpkEIRcmee', 'ram@gmail.com', 9856482900),
(18, 'Haribahadur', '$2y$10$Oh3CaMjRh4cMpbGShDwjQOoonFU3wjDqTQ.w/joba7FaGV91oY.jm', 'Hari123@gmail.com', 9873728394),
(19, 'Aman', '$2y$10$aWPeb.88acg6zg3tC0igWuCZunoL09zx4hMOFlLP6rNlfCVhZARki', 'amansenpai01@gmail.com', 9861222521),
(20, 'Kritya', '$2y$10$qSclVs1HA2ka1U1bev8wTezZR0SNnedXv8gohh3YhjWVTX9QC2046', 'kritya@gmail.com', 9083647832);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`bid`),
  ADD KEY `landlord` (`landlord`),
  ADD KEY `tenant` (`tenant`),
  ADD KEY `pid` (`property`);

--
-- Indexes for table `landlord`
--
ALTER TABLE `landlord`
  ADD PRIMARY KEY (`lid`);

--
-- Indexes for table `property`
--
ALTER TABLE `property`
  ADD PRIMARY KEY (`pid`),
  ADD KEY `landlord` (`landlord`);

--
-- Indexes for table `tenant`
--
ALTER TABLE `tenant`
  ADD PRIMARY KEY (`tid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `bid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `landlord`
--
ALTER TABLE `landlord`
  MODIFY `lid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `property`
--
ALTER TABLE `property`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `tenant`
--
ALTER TABLE `tenant`
  MODIFY `tid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`landlord`) REFERENCES `landlord` (`lid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`tenant`) REFERENCES `tenant` (`tid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `booking_ibfk_3` FOREIGN KEY (`property`) REFERENCES `property` (`pid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `property`
--
ALTER TABLE `property`
  ADD CONSTRAINT `landlord` FOREIGN KEY (`landlord`) REFERENCES `landlord` (`lid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
