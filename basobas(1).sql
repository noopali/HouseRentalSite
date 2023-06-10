-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2023 at 12:57 PM
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
  `AdminID` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(30) NOT NULL,
  `phone` bigint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`AdminID`, `username`, `password`, `email`, `phone`) VALUES
(3, 'shankarsan', '$2y$10$CgibU.84mqI4gyFp.dFvBuYT4fk0LcWRGyZdeNE.7RBH8OIY5GxOi', 'shankarsan@gmail.com', 9863197067);

-- --------------------------------------------------------

--
-- Table structure for table `landlord`
--

CREATE TABLE `landlord` (
  `lid` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(30) NOT NULL,
  `phone` bigint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `landlord`
--

INSERT INTO `landlord` (`lid`, `username`, `password`, `email`, `phone`) VALUES
(1, 'shankarsan', '$2y$10$XPa/8Hs7lkxBBULruYBH9uC', '321@gmail.com', 11194434),
(2, 'landlord', '$2y$10$ak4b1VJybSWz6vjO4tmvweomF498IWB3Vdcl24IaSkSIHuu6SLmeS', 'landlord@gmail.com', 4234243),
(3, 'ramesh', '$2y$10$EJzZNb1Ba9Soer1cTzdpn.e4zBBCjBXwMWipBcka3KYA8H7L7lTBq', 'ramesh@gmail.com', 98787373),
(4, 'landy', '$2y$10$F2WRjJpYLlm0SBf5TUH5TuIEMUZE7jgsBEtjAWY5isbYH2luNZUu6', 'landy@gmail.com', 9876558762);

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
(53, 'uploads/sidekix-media-WgkA3CSFrjc-unsplash.jpg', 'kathmandu', 'the best room', '30000.00', 1, 4),
(57, 'uploads/chastity-cortijo-R-w5Q-4Mqm0-unsplash.jpg', 'kathmandu', 'room is good', '999999.99', 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tenant`
--

CREATE TABLE `tenant` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `phone` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tenant`
--

INSERT INTO `tenant` (`id`, `username`, `password`, `email`, `phone`) VALUES
(1, 'aman', '123', '123ramesh@gmail.com.np', 8798),
(2, 'fdgq', '123', 'admin@gmail.com', 324234234),
(3, 'sombahadur@gmail.com', '123', 'sdfsdf@dsf', 54345345),
(7, 'admin', '123', 'shankarsan@asd', 534534),
(8, 'adminqwe', '123', 'shankarsan@gmail.com', 37456346),
(9, 'admin', '123', 'rari@gmail.com', 4324),
(10, 'admin', '123', 'thapa@gmail.com', 563245),
(11, 'ramish', '$2y$10$K3sZFq2Wtw04DYQibDrH4enHwQJz./8MGNnePctARpL', 'ramish@out.com', 98362732134),
(14, 'tenant', '$2y$10$0OMRmZjnkKo0hkGRMPLNpO7niCbT16t9qpfRbXWRwHlquzbXkS3mq', 'tenant@gmail.com', 874737423),
(15, 'tenant', '$2y$10$YHf3MWASMx3tgnQJMJANwuWdN6K/eWuc7sxHfxdOs/Spd4wKxJZtG', 'tenant123@gmail.com', 9198793123);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`AdminID`);

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
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `AdminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `landlord`
--
ALTER TABLE `landlord`
  MODIFY `lid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `property`
--
ALTER TABLE `property`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `tenant`
--
ALTER TABLE `tenant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `property`
--
ALTER TABLE `property`
  ADD CONSTRAINT `landlord` FOREIGN KEY (`landlord`) REFERENCES `landlord` (`Lid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
