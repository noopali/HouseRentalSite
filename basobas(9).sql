-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 26, 2023 at 06:17 PM
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
  `request` tinyint(1) NOT NULL DEFAULT 0,
  `start` date NOT NULL,
  `end` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`bid`, `tenant`, `landlord`, `status`, `property`, `request`, `start`, `end`) VALUES
(80, 20, 5, 1, 92, 1, '2023-07-21', '2023-08-29'),
(88, 20, 8, 1, 101, 1, '2023-08-27', '2023-09-27'),
(91, 20, 5, 1, 99, 1, '2023-08-28', '2023-09-28');

-- --------------------------------------------------------

--
-- Table structure for table `landlord`
--

CREATE TABLE `landlord` (
  `lid` int(11) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `llastname` varchar(255) NOT NULL,
  `lpassword` varchar(255) DEFAULT NULL,
  `lemail` varchar(30) NOT NULL,
  `lphone` bigint(10) NOT NULL,
  `laddress` varchar(255) NOT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT 0,
  `request` tinyint(1) NOT NULL DEFAULT 0,
  `message` tinyint(1) NOT NULL DEFAULT 0,
  `id_document` varchar(255) NOT NULL,
  `property_document` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `landlord`
--

INSERT INTO `landlord` (`lid`, `lname`, `llastname`, `lpassword`, `lemail`, `lphone`, `laddress`, `verified`, `request`, `message`, `id_document`, `property_document`) VALUES
(5, 'Shiva', 'Ghimire', '$2y$10$Nfvj9G8MSktCplGotxbJY.0PPTBlO3Yjv9XNRTaoK/lQ.uNvOG2Ja', 'shiva@gmail.com', 9876543210, 'baneshwor,kathmandu', 1, 1, 1, 'uploads/Untitled Diagram(2).jpg', 'uploads/you\'r hired.jpg'),
(8, 'Shivam', 'Shahi', '$2y$10$RGnyudRoYMhZbZPm1hqqzOF1iJv9wNok1f0BtHYSIUGR/P.HissLy', 'shivam@gmail.com', 9865384739, 'balaju, kathmandu', 1, 1, 1, 'uploads/citizenship.jpeg', 'uploads/lalpurja.jpg'),
(12, 'Hari', 'Gurung', '$2y$10$EFRYYnLM3Q74yLoEGgYfXeUT3uUnpz9I6vSO7Fk/nywPwdR0xMnaq', 'hari@gmail.com', 9783572653, 'Koteshwor, Kathmandu', 0, 0, 0, '', ''),
(13, 'Gyani', 'Singh', '$2y$10$sZefNrPt/DrTjvBTofnVuujl7.z2FKMxTHwoCSqnHEldQ6zM6ji8y', 'gyani@gmail.com', 9841229988, 'Thamel, Kathmandu', 1, 1, 1, 'uploads/prioritynonprem.png', 'uploads/you\'r hired.jpg'),
(14, 'Madan', 'Thapa', '$2y$10$sHNWNhQsr6m4VkGOv3cwa.WqgRineafCwvUfd6h2XNXBcVZ.FcdNi', 'madan@gmail.com', 9867234563, 'kalimati,kathmandu', 0, 0, 0, '', '');

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
(92, 'uploads/chastity-cortijo-R-w5Q-4Mqm0-unsplash.jpg', 'kathmandu', 'Room has an attached bathroom\r\n20 by 30 meter area', '1200.00', 2, 5),
(93, 'uploads/francesca-tosolini-hCU4fimRW-c-unsplash.jpg', 'Baneshwor', 'The room is spacious and well-maintained, providing a comfortable living space. It includes a bed, desk, chair, and ample storage options like a closet or wardrobe.', '3000.00', 2, 12),
(95, 'uploads/sidekix-media-WgkA3CSFrjc-unsplash.jpg', 'Kathmandu', 'The available room is located in a spacious and well-maintained apartment situated in a vibrant neighborhood. It is an ideal living space for individuals seeking comfort, convenience, and a welcoming atmosphere.', '3000.00', 1, 5),
(97, 'uploads/sidekix-media-WgkA3CSFrjc-unsplash.jpg', 'kathmandu', '2 large rooms, 1 bed room,1 kitchen', '2000.00', 2, 5),
(99, 'uploads/francesca-tosolini-hCU4fimRW-c-unsplash.jpg', 'lalitpur', 'T24 hr water supply.', '30000.00', 2, 5),
(101, 'uploads/Untitled Diagram(2).jpg', 'afdsa', 'adfdfsdfas', '23323.00', 2, 8);

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `rid` int(11) NOT NULL,
  `lid` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  `stars` int(11) NOT NULL,
  `feedback` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`rid`, `lid`, `tid`, `stars`, `feedback`) VALUES
(12, 8, 20, 5, 'Amazing. This person is a genuine person'),
(13, 8, 20, 2, 'not good'),
(14, 8, 20, 2, 'extremely bad'),
(15, 5, 20, 3, 'ds'),
(16, 5, 20, 2, 'dddddd');

-- --------------------------------------------------------

--
-- Table structure for table `tenant`
--

CREATE TABLE `tenant` (
  `tid` int(11) NOT NULL,
  `tname` varchar(50) NOT NULL,
  `tlastname` varchar(255) NOT NULL,
  `tpassword` varchar(255) DEFAULT NULL,
  `temail` varchar(50) NOT NULL,
  `tphone` bigint(20) NOT NULL,
  `taddress` varchar(255) NOT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT 0,
  `request` tinyint(1) NOT NULL DEFAULT 0,
  `tdocument` varchar(255) NOT NULL,
  `message` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tenant`
--

INSERT INTO `tenant` (`tid`, `tname`, `tlastname`, `tpassword`, `temail`, `tphone`, `taddress`, `verified`, `request`, `tdocument`, `message`) VALUES
(17, 'Ram', 'Thapa', '$2y$10$nFf41Vf0pY3OcFlwCOGe5OhFwIzozdQNk8mNyFpETYyDpkEIRcmee', 'ram@gmail.com', 9856482900, 'Stado bato, lalitpur', 0, 0, '', 0),
(18, 'Haribahadur', 'Rai', '$2y$10$Oh3CaMjRh4cMpbGShDwjQOoonFU3wjDqTQ.w/joba7FaGV91oY.jm', 'Hari123@gmail.com', 9873728394, 'patan dhoka, lalitpur', 1, 1, '', 0),
(19, 'Aman', 'Manandhar', '$2y$10$aWPeb.88acg6zg3tC0igWuCZunoL09zx4hMOFlLP6rNlfCVhZARki', 'amansenpai01@gmail.com', 9861222521, 'jhamsikhel,lalitpur', 0, 0, '', 0),
(20, 'Kritya', 'Shah', '$2y$10$qSclVs1HA2ka1U1bev8wTezZR0SNnedXv8gohh3YhjWVTX9QC2046', 'kritya@gmail.com', 9083647832, 'Dhapasi,Kathmandu', 1, 1, 'uploads/logo-no-background.png', 1),
(22, 'Kuber', 'Shakya', '$2y$10$vi4AftsIrtDTwRE4QLoPFuIvxhTsWZLsTuCnUfZMnQMgyKFys6pxC', 'Shakya@gmail.com', 9638749384, '', 0, 0, '', 0);

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
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`rid`),
  ADD KEY `rating_ibfk_1` (`lid`),
  ADD KEY `rating_ibfk_2` (`tid`);

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
  MODIFY `bid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `landlord`
--
ALTER TABLE `landlord`
  MODIFY `lid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `property`
--
ALTER TABLE `property`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tenant`
--
ALTER TABLE `tenant`
  MODIFY `tid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

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
