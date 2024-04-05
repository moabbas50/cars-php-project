-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 05, 2024 at 04:15 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `car_rental`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `name` varchar(220) NOT NULL,
  `email` varchar(220) NOT NULL,
  `passowrds` varchar(220) NOT NULL,
  `image` varchar(360) NOT NULL DEFAULT 'admin.webp',
  `phone` varchar(220) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `passowrds`, `image`, `phone`) VALUES
(20, 'mohamed abbas', 'mohamed.abbass356@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '17104601421973.jpg', '01030260510');

-- --------------------------------------------------------

--
-- Table structure for table `car-owners`
--

CREATE TABLE `car-owners` (
  `id` int(11) NOT NULL,
  `name` varchar(220) NOT NULL,
  `email` varchar(220) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `nums_owned_car` int(20) NOT NULL DEFAULT 0,
  `password` varchar(220) NOT NULL,
  `profit` decimal(10,0) NOT NULL DEFAULT 0,
  `is_blocked` varchar(50) NOT NULL DEFAULT 'unblock',
  `image` varchar(350) NOT NULL DEFAULT 'oo.webp'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `car-owners`
--

INSERT INTO `car-owners` (`id`, `name`, `email`, `phone`, `nums_owned_car`, `password`, `profit`, `is_blocked`, `image`) VALUES
(4, 'Mohamed Abbas Zaher', 'Mohamed@gmail.com', '01030260510', 0, '7c4a8d09ca3762af61e59520943dc26494f8941b', 0, 'unblock', '17104603451733.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `id` int(11) NOT NULL,
  `car_model` varchar(220) NOT NULL,
  `car_number` varchar(220) NOT NULL,
  `is_avilable` tinyint(1) NOT NULL DEFAULT 1,
  `is_active` varchar(50) NOT NULL DEFAULT 'none',
  `cost_per_day` decimal(10,2) NOT NULL,
  `car_owner_id` int(11) NOT NULL,
  `Car_licence` varchar(350) NOT NULL,
  `Car_Report` varchar(350) NOT NULL,
  `images` varchar(350) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `name` varchar(220) NOT NULL,
  `email` varchar(220) NOT NULL,
  `passowrd` varchar(240) NOT NULL,
  `image` varchar(360) NOT NULL,
  `phone` varchar(220) NOT NULL,
  `national_id` bigint(20) NOT NULL,
  `img_national_id` varchar(240) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `email`, `passowrd`, `image`, `phone`, `national_id`, `img_national_id`) VALUES
(1, 'ahmed', 'ahmed@gmail.com', '123456', 'oo.webp', '012345678', 134546987951231, ''),
(2, 'mohamed abbas', 'lolo@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '1710600308363.jpg', '', 0, ''),
(4, 'Loay', 'ahmed.memo356@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'oo.webp', '', 5646565123, '');

-- --------------------------------------------------------

--
-- Table structure for table `rents`
--

CREATE TABLE `rents` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `car_id` int(11) NOT NULL,
  `rent_start_date` date NOT NULL,
  `rent_end_date` date NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'notStart',
  `total_cost` decimal(10,2) NOT NULL,
  `profit_car_owner` decimal(10,2) NOT NULL,
  `profit_business_owner` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Stand-in structure for view `rentsdata`
-- (See below for the actual view)
--
CREATE TABLE `rentsdata` (
`rentid` int(11)
,`clientid` int(11)
,`clientname` varchar(220)
,`carid` int(11)
,`carOwnerid` int(11)
,`carmodel` varchar(220)
,`carnumber` varchar(220)
,`isAvilabe` tinyint(1)
,`startdate` date
,`enddate` date
,`total_cost` decimal(10,2)
,`profit_car_owner` decimal(10,2)
,`profit_business_owner` decimal(10,2)
,`status` varchar(20)
);

-- --------------------------------------------------------

--
-- Structure for view `rentsdata`
--
DROP TABLE IF EXISTS `rentsdata`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `rentsdata`  AS SELECT `rents`.`id` AS `rentid`, `clients`.`id` AS `clientid`, `clients`.`name` AS `clientname`, `cars`.`id` AS `carid`, `cars`.`car_owner_id` AS `carOwnerid`, `cars`.`car_model` AS `carmodel`, `cars`.`car_number` AS `carnumber`, `cars`.`is_avilable` AS `isAvilabe`, `rents`.`rent_start_date` AS `startdate`, `rents`.`rent_end_date` AS `enddate`, `rents`.`total_cost` AS `total_cost`, `rents`.`profit_car_owner` AS `profit_car_owner`, `rents`.`profit_business_owner` AS `profit_business_owner`, `rents`.`status` AS `status` FROM ((`rents` join `cars` on(`rents`.`car_id` = `cars`.`id`)) join `clients` on(`rents`.`client_id` = `clients`.`id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `car-owners`
--
ALTER TABLE `car-owners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `car-number` (`car_number`),
  ADD KEY `car-owner-id` (`car_owner_id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `national-id` (`national_id`);

--
-- Indexes for table `rents`
--
ALTER TABLE `rents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client-id` (`client_id`),
  ADD KEY `car-id` (`car_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `car-owners`
--
ALTER TABLE `car-owners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `rents`
--
ALTER TABLE `rents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cars`
--
ALTER TABLE `cars`
  ADD CONSTRAINT `cars_ibfk_1` FOREIGN KEY (`car_owner_id`) REFERENCES `car-owners` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rents`
--
ALTER TABLE `rents`
  ADD CONSTRAINT `rents_ibfk_1` FOREIGN KEY (`car_id`) REFERENCES `cars` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rents_ibfk_2` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
