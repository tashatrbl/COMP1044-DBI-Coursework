-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2023 at 06:18 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `comp1044_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `car`
--

CREATE TABLE `car` (
  `car_id` varchar(255) NOT NULL,
  `car_type_id` int(11) NOT NULL,
  `car_model` varchar(255) NOT NULL,
  `car_colour` varchar(255) NOT NULL,
  `rental_per_day` decimal(10,0) NOT NULL,
  `availability` enum('available','unavailable') NOT NULL DEFAULT 'available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `car`
--

INSERT INTO `car` (`car_id`, `car_type_id`, `car_model`, `car_colour`, `rental_per_day`, `availability`) VALUES
('C01', 1, 'Rolls Royce Phantom', 'Blue', '9800', 'available'),
('C02', 1, 'Bentley Continental Flying Spur', 'White', '4800', 'available'),
('C03', 1, 'Mercedes Benz CLS 350', 'Silver', '1350', 'available'),
('C04', 1, 'Jaguar S Type', 'Champagne', '1350', 'available'),
('C05', 2, 'Ferrari F430 Scuderia', 'Red', '6000', 'available'),
('C06', 2, 'Lamborghini Murcielago LP640', 'Matte Black', '7000', 'available'),
('C07', 2, 'Porsche Boxster', 'White', '2800', 'available'),
('C08', 2, 'Lexus SC430', 'Black', '1600', 'available'),
('C09', 3, 'Jaguar MK 2', 'White', '2200', 'available'),
('C10', 3, 'Rolls Royce Silver Spirit Limousine', 'Georgian Silver', '3200', 'available'),
('C11', 3, 'MG TD', 'Red', '2500', 'available');

-- --------------------------------------------------------

--
-- Table structure for table `car_type`
--

CREATE TABLE `car_type` (
  `car_type_id` int(11) NOT NULL,
  `type_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `car_type`
--

INSERT INTO `car_type` (`car_type_id`, `type_name`) VALUES
(1, 'Luxurious Car'),
(2, 'Sports Car'),
(3, 'Classics Car');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` varchar(255) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `contact_number` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `customer_id` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `car_id` varchar(255) NOT NULL,
  `car_model` varchar(255) NOT NULL,
  `reservation_id` int(11) NOT NULL,
  `rental_date_start` date NOT NULL,
  `rental_date_end` date NOT NULL,
  `rental_cost` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `actual_name` varchar(255) NOT NULL,
  `encrypted_pw` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`username`, `password`, `actual_name`, `encrypted_pw`) VALUES
('efywy2', '20301686', 'Yap Wei Ni', '0LARlup2OqY='),
('hcycb2', '20509430', 'Carmel Natasha Barnabas', '0LAXluJ0MaA='),
('hfymy3', '20409203', 'Merlyn Teow Yi-Lin', '0LAWluJyMqM='),
('hfyvv2', '20409418', 'Varsagasorraj A/L Vasagarajan', '0LAWluJ0M6g=');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `car`
--
ALTER TABLE `car`
  ADD PRIMARY KEY (`car_id`),
  ADD KEY `car_type_id` (`car_type_id`),
  ADD KEY `car_model` (`car_model`);

--
-- Indexes for table `car_type`
--
ALTER TABLE `car_type`
  ADD PRIMARY KEY (`car_type_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`reservation_id`),
  ADD KEY `username` (`username`),
  ADD KEY `car_model` (`car_model`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `car_id` (`car_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `car_type`
--
ALTER TABLE `car_type`
  MODIFY `car_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `car`
--
ALTER TABLE `car`
  ADD CONSTRAINT `car_ibfk_1` FOREIGN KEY (`car_type_id`) REFERENCES `car_type` (`car_type_id`);

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`),
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`username`) REFERENCES `staff` (`username`),
  ADD CONSTRAINT `reservation_ibfk_3` FOREIGN KEY (`car_model`) REFERENCES `car` (`car_model`),
  ADD CONSTRAINT `reservation_ibfk_4` FOREIGN KEY (`car_id`) REFERENCES `car` (`car_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
