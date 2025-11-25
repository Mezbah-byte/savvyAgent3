-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 25, 2025 at 03:21 PM
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
-- Database: `savvy3`
--

-- --------------------------------------------------------

--
-- Table structure for table `regular_program_package_update`
--

CREATE TABLE `regular_program_package_update` (
  `id` int(111) NOT NULL,
  `user_un_id` varchar(111) NOT NULL,
  `regular_program_package_id` varchar(111) NOT NULL,
  `quantity` int(11) NOT NULL,
  `payment_mode` varchar(111) NOT NULL,
  `agentId` varchar(111) NOT NULL,
  `gatewayId` varchar(11) NOT NULL,
  `trx` varchar(111) NOT NULL,
  `ssLink` varchar(255) NOT NULL,
  `amount` decimal(11,2) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `regular_program_package_update`
--

INSERT INTO `regular_program_package_update` (`id`, `user_un_id`, `regular_program_package_id`, `quantity`, `payment_mode`, `agentId`, `gatewayId`, `trx`, `ssLink`, `amount`, `status`, `created_at`) VALUES
(1, '66f675052b0f5', 'qwrwerwetrtw', 0, '', '', '', '', '', 1000.00, 0, '2025-11-22 19:44:29'),
(2, '66f675052b0f5', 'qwrwerwetrtw', 1, 'wallet', '', '', '', '', 1000.00, 1, '2025-11-25 12:45:24'),
(3, '66f675052b0f5', 'qwrwerwetrtw', 1, 'wallet', '', '', '', '', 1000.00, 1, '2025-11-25 12:47:41'),
(4, '66f675052b0f5', 'qwrwerwetrtw', 1, 'agent', '683ecdad20fa0', 'asydadaasda', 'hgf', 'https://f005.backblazeb2.com/file/savvy-data/img/img_69255ac274c6d.jpg', 1000.00, 0, '2025-11-25 13:29:22'),
(5, '66f675052b0f5', 'qwrwerwetrtw', 1, 'wallet', '', '', '', '', 1000.00, 1, '2025-11-25 20:07:38'),
(6, '66f675052b0f5', 'qwrwerwetrtw', 1, 'wallet', '', '', '', '', 1000.00, 1, '2025-11-25 20:09:10'),
(7, '66f675052b0f5', 'qwrwerwetrtw', 1, 'wallet', '', '', '', '', 1000.00, 1, '2025-11-25 20:10:50'),
(8, '66f675052b0f5', 'qwrwerwetrtw', 1, 'wallet', '', '', '', '', 1000.00, 1, '2025-11-25 20:12:46'),
(9, '66f675052b0f5', 'qwrwerwetrtw', 1, 'wallet', '', '', '', '', 1000.00, 1, '2025-11-25 20:13:36'),
(10, '66f675052b0f5', 'qwrwerwetrtw', 1, 'agent', '681f1cfc08f53', 'asydadaasda', 'dgg', 'https://f005.backblazeb2.com/file/savvy-data/img/img_6925b9e25516d.jpg', 1000.00, 0, '2025-11-25 20:15:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `regular_program_package_update`
--
ALTER TABLE `regular_program_package_update`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `regular_program_package_update`
--
ALTER TABLE `regular_program_package_update`
  MODIFY `id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
