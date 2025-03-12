-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2025 at 09:21 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vms`
--

-- --------------------------------------------------------

--
-- Table structure for table `restrict`
--

CREATE TABLE `restrict` (
  `res_id` int(11) NOT NULL,
  `res_name` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `res_description` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `res_lat` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `res_lng` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `res_radius` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `res_area` varchar(4096) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `res_vehicles` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `res_createddate` timestamp NOT NULL DEFAULT current_timestamp(),
  `res_modifieddate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `restrict_events`
--

CREATE TABLE `restrict_events` (
  `res_id` int(11) NOT NULL,
  `res_v_id` int(11) NOT NULL,
  `res_res_id` int(11) NOT NULL,
  `res_events` int(11) NOT NULL,
  `res_timestamp` datetime NOT NULL,
  `res_create_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `restrict`
--
ALTER TABLE `restrict`
  ADD PRIMARY KEY (`res_id`);

--
-- Indexes for table `restrict_events`
--
ALTER TABLE `restrict_events`
  ADD PRIMARY KEY (`res_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `restrict`
--
ALTER TABLE `restrict`
  MODIFY `res_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `restrict_events`
--
ALTER TABLE `restrict_events`
  MODIFY `res_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
