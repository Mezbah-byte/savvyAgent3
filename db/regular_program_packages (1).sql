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
-- Table structure for table `regular_program_packages`
--

CREATE TABLE `regular_program_packages` (
  `id` int(11) NOT NULL,
  `un_id` varchar(111) NOT NULL,
  `title` varchar(255) NOT NULL,
  `details` text NOT NULL,
  `price` decimal(11,2) NOT NULL,
  `old_price` decimal(11,2) NOT NULL,
  `status` int(3) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `regular_program_packages`
--

INSERT INTO `regular_program_packages` (`id`, `un_id`, `title`, `details`, `price`, `old_price`, `status`, `created_at`) VALUES
(1, 'qwrwerwetrtw', 'First one', 'asdfsa  fsd hfvsajfvasjd vfjasv asd fs ajfvhsg fsaghf jhgdsf jsg fjgas f', 1000.00, 1200.00, 1, '2025-11-22 12:02:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `regular_program_packages`
--
ALTER TABLE `regular_program_packages`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `regular_program_packages`
--
ALTER TABLE `regular_program_packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
