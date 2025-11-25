-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 25, 2025 at 03:20 PM
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
-- Table structure for table `agentcoursebuyrequest`
--

CREATE TABLE `agentcoursebuyrequest` (
  `id` int(11) NOT NULL,
  `agent_un_id` varchar(255) NOT NULL,
  `course_un_id` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price_per_unit` decimal(11,2) NOT NULL,
  `commission_per_unit` decimal(11,2) NOT NULL,
  `commission_amount` decimal(11,2) NOT NULL,
  `balance_used` decimal(11,2) NOT NULL,
  `total_amount` decimal(11,2) NOT NULL,
  `gateway_id` varchar(255) NOT NULL,
  `trx` varchar(255) NOT NULL,
  `ssLink` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `agentcoursebuyrequest`
--

INSERT INTO `agentcoursebuyrequest` (`id`, `agent_un_id`, `course_un_id`, `quantity`, `price_per_unit`, `commission_per_unit`, `commission_amount`, `balance_used`, `total_amount`, `gateway_id`, `trx`, `ssLink`, `status`, `created_at`, `updated_at`) VALUES
(1, 'ahsdvdjcv', 'sdfgsdgbd', 20, 5199.00, 0.00, 0.00, 0.00, 103980.00, '20', 'asasfsdfsdfsd', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_681f243a7eb38.png', 2, '2025-05-10 16:02:38', '2025-05-10 16:02:38'),
(2, '681f1cfc08f53', 'sdfgsdgbd', 20, 5199.00, 200.00, 4000.00, 0.00, 99980.00, '0', '44677889', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_681f244c1e250.jpg', 1, '2025-05-10 16:02:55', '2025-05-10 16:02:55'),
(3, '681f1cfc08f53', 'sdfgsdgbd', 100, 5199.00, 200.00, 20000.00, 0.00, 499900.00, '0', 'LID01313748759', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_681f2be27f87f.jpg', 1, '2025-05-10 16:35:18', '2025-05-10 16:35:18'),
(4, 'ahsdvdjcv', 'sdfgsdgbd', 999, 5199.00, 0.00, 0.00, 0.00, 5193801.00, '0', '12345678', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_682d7c0b20a03.jpg', 1, '2025-05-21 13:09:02', '2025-05-21 13:09:02'),
(5, '681f1cfc08f53', 'sdfgsdgbd', 21, 5199.00, 200.00, 4200.00, 0.00, 104979.00, '0', '123456', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_683712f6826b6.jpeg', 1, '2025-05-28 19:43:24', '2025-05-28 19:43:24'),
(6, '681f1cfc08f53', 'sdfgsdgbd', 20, 5199.00, 200.00, 4000.00, 0.00, 99980.00, '0', '123456', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_683c92f403028.jpeg', 1, '2025-06-01 23:50:48', '2025-06-01 23:50:48'),
(7, '681f1cfc08f53', 'fyjsdfh', 20, 1099.00, 40.00, 800.00, 0.00, 21180.00, '0', '123456', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_683c93e4c83a1.jpeg', 1, '2025-06-01 23:54:48', '2025-06-01 23:54:48'),
(8, '681f1cfc08f53', 'sdfgsdgbd', 20, 5199.00, 200.00, 4000.00, 0.00, 99980.00, '0', '123456', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_683dcbd541db3.jpeg', 1, '2025-06-02 22:05:45', '2025-06-02 22:05:45'),
(9, '681f1cfc08f53', 'sdfgsdgbd', 20, 5199.00, 200.00, 4000.00, 0.00, 99980.00, '0', '123456', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_683ead7de0ef7.jpeg', 1, '2025-06-03 14:08:33', '2025-06-03 14:08:33'),
(10, '683ecdad20fa0', 'sdfgsdgbd', 180, 5199.00, 200.00, 36000.00, 0.00, 899820.00, '0', '899820', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_683ed6c736b33.jpg', 1, '2025-06-03 17:04:44', '2025-06-03 17:04:44'),
(11, '683ecdad20fa0', 'sdfgsdgbd', 180, 5199.00, 200.00, 36000.00, 0.00, 899820.00, '0', '899820', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_683ed6ca35be4.jpg', 2, '2025-06-03 17:04:47', '2025-06-03 17:04:47'),
(12, '683ecdad20fa0', 'sdfgsdgbd', 126, 5199.00, 200.00, 25200.00, 0.00, 629874.00, '0', 'Younusctg', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68402e2001d84.jpg', 1, '2025-06-04 17:29:39', '2025-06-04 17:29:39'),
(13, '681f1cfc08f53', 'sdfgsdgbd', 20, 5199.00, 200.00, 4000.00, 0.00, 99980.00, '0', '123456', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68416ec171ab3.jpeg', 1, '2025-06-05 16:17:41', '2025-06-05 16:17:41'),
(14, '683ecdad20fa0', 'sdfgsdgbd', 28, 5199.00, 200.00, 5600.00, 0.00, 139972.00, '0', 'Younusctg', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68418cfce0839.jpg', 1, '2025-06-05 18:26:40', '2025-06-05 18:26:40'),
(15, '683ecdad20fa0', 'sdfgsdgbd', 20, 5199.00, 200.00, 4000.00, 0.00, 99980.00, '0', 'Younusctg', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_6841c8496838f.jpg', 1, '2025-06-05 22:39:41', '2025-06-05 22:39:41'),
(16, '683ecdad20fa0', 'sdfgsdgbd', 20, 5199.00, 200.00, 4000.00, 0.00, 99980.00, '0', '99980', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_6843235b6823c.jpg', 1, '2025-06-06 23:20:31', '2025-06-06 23:20:31'),
(17, '683ecdad20fa0', 'sdfgsdgbd', 81, 5199.00, 200.00, 16200.00, 0.00, 404919.00, '0', '404919', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68481882bfce5.jpg', 1, '2025-06-10 17:35:34', '2025-06-10 17:35:34'),
(18, '681f1cfc08f53', 'sdfgsdgbd', 90, 5199.00, 200.00, 18000.00, 0.00, 449910.00, '0', '123456', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_684e7b393d7bc.jpeg', 1, '2025-06-15 13:50:21', '2025-06-15 13:50:21'),
(19, '683ecdad20fa0', 'sdfgsdgbd', 25, 5199.00, 200.00, 5000.00, 0.00, 124975.00, '0', 'Younus', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_684ea0886bc92.jpg', 1, '2025-06-15 16:29:33', '2025-06-15 16:29:33'),
(20, '681f1cfc08f53', 'sdfgsdgbd', 50, 5199.00, 200.00, 10000.00, 0.00, 249950.00, '0', '123456', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68514302cdf0a.jpeg', 1, '2025-06-17 16:27:18', '2025-06-17 16:27:18'),
(21, '681f1cfc08f53', 'sdfgsdgbd', 50, 5199.00, 200.00, 10000.00, 0.00, 249950.00, '0', '123456', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68514324f2abe.jpeg', 1, '2025-06-17 16:27:53', '2025-06-17 16:27:53'),
(22, '681f1cfc08f53', 'sdfgsdgbd', 70, 5199.00, 200.00, 14000.00, 0.00, 349930.00, '0', '123456', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_685146b3d34ed.jpeg', 1, '2025-06-17 16:43:04', '2025-06-17 16:43:04'),
(23, '683ecdad20fa0', 'sdfgsdgbd', 20, 5199.00, 200.00, 4000.00, 0.00, 99980.00, '0', '99980', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68519e0cd15ce.jpg', 1, '2025-06-17 22:55:46', '2025-06-17 22:55:46'),
(24, '683ecdad20fa0', 'sdfgsdgbd', 20, 5199.00, 200.00, 4000.00, 0.00, 99980.00, '0', '99980', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_685278da91047.jpg', 1, '2025-06-18 14:29:18', '2025-06-18 14:29:18'),
(25, '683ecdad20fa0', 'sdfgsdgbd', 43, 5199.00, 200.00, 8600.00, 0.00, 214957.00, '0', '223557', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_6853bf4bb2746.jpg', 1, '2025-06-19 13:42:07', '2025-06-19 13:42:07'),
(26, '683ecdad20fa0', 'sdfgsdgbd', 20, 5199.00, 200.00, 4000.00, 0.00, 99980.00, '0', '99980', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_685404180986c.jpg', 1, '2025-06-19 18:35:39', '2025-06-19 18:35:39'),
(27, '685816d83c7fa', 'sdfgsdgbd', 100, 5199.00, 200.00, 20000.00, 0.00, 499900.00, '0', 'Dm Kamruzzaman', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_6858294811ed9.jpg', 1, '2025-06-22 22:03:24', '2025-06-22 22:03:24'),
(28, '683ecdad20fa0', 'sdfgsdgbd', 20, 5199.00, 200.00, 4000.00, 0.00, 99980.00, '0', '100000', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68592d4511e59.jpg', 1, '2025-06-23 16:32:40', '2025-06-23 16:32:40'),
(29, '683ecdad20fa0', 'sdfgsdgbd', 20, 5199.00, 200.00, 4000.00, 0.00, 99980.00, '0', '99980', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_685a4a32f4107.jpg', 2, '2025-06-24 12:48:24', '2025-06-24 12:48:24'),
(30, '683ecdad20fa0', 'sdfgsdgbd', 20, 5199.00, 200.00, 4000.00, 0.00, 99980.00, '0', '99980', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_685a4a583be88.jpg', 1, '2025-06-24 12:49:01', '2025-06-24 12:49:01'),
(31, '683ecdad20fa0', 'sdfgsdgbd', 31, 5199.00, 200.00, 6200.00, 0.00, 154969.00, '0', '154968', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_685a9cd7df972.jpg', 1, '2025-06-24 18:41:00', '2025-06-24 18:41:00'),
(32, '683ecdad20fa0', 'sdfgsdgbd', 68, 5199.00, 200.00, 13600.00, 0.00, 339932.00, '0', '339932', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_685adb0820944.jpg', 1, '2025-06-24 23:06:19', '2025-06-24 23:06:19'),
(33, '681f1cfc08f53', 'sdfgsdgbd', 20, 5199.00, 200.00, 4000.00, 0.00, 99980.00, '0', '123456', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_685ba93258f30.jpeg', 1, '2025-06-25 13:45:58', '2025-06-25 13:45:58'),
(34, '683ecdad20fa0', 'sdfgsdgbd', 69, 5199.00, 200.00, 13800.00, 0.00, 344931.00, '0', 'Younus ctg', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_685c19f0e16d0.jpg', 1, '2025-06-25 21:47:00', '2025-06-25 21:47:00'),
(35, '683ecdad20fa0', 'sdfgsdgbd', 20, 5199.00, 200.00, 4000.00, 0.00, 99980.00, '0', '99980', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_685c4c5c27773.jpg', 1, '2025-06-26 01:22:07', '2025-06-26 01:22:07'),
(36, '683ecdad20fa0', 'sdfgsdgbd', 20, 5199.00, 200.00, 4000.00, 0.00, 99980.00, '0', '99980', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_685cf9c4c5ab1.jpg', 1, '2025-06-26 13:42:01', '2025-06-26 13:42:01'),
(37, '683ecdad20fa0', 'sdfgsdgbd', 20, 5199.00, 200.00, 4000.00, 0.00, 99980.00, '0', 'Younusctg', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_685ff3b977b46.jpg', 1, '2025-06-28 19:53:01', '2025-06-28 19:53:01'),
(38, '683ecdad20fa0', 'sdfgsdgbd', 20, 5199.00, 200.00, 4000.00, 0.00, 99980.00, '0', '99980', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_6860eedac9031.jpg', 1, '2025-06-29 13:44:31', '2025-06-29 13:44:31'),
(39, '683ecdad20fa0', 'sdfgsdgbd', 30, 5199.00, 200.00, 6000.00, 0.00, 149970.00, '0', 'Younus ctg', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68613a3994703.jpg', 1, '2025-06-29 19:06:06', '2025-06-29 19:06:06'),
(40, '683ecdad20fa0', 'sdfgsdgbd', 20, 5199.00, 200.00, 4000.00, 0.00, 99980.00, '0', '99980', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68624e2158d47.jpg', 1, '2025-06-30 14:43:17', '2025-06-30 14:43:17'),
(41, '683ecdad20fa0', 'sdfgsdgbd', 30, 5199.00, 200.00, 6000.00, 0.00, 149970.00, '0', '149970', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68651521bc49a.jpg', 1, '2025-07-02 17:16:53', '2025-07-02 17:16:53'),
(42, '681f1cfc08f53', 'sdfgsdgbd', 60, 5199.00, 200.00, 12000.00, 0.00, 299940.00, '0', '123456', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68662cc9cb459.jpeg', 1, '2025-07-03 13:10:07', '2025-07-03 13:10:07'),
(43, '683ecdad20fa0', 'sdfgsdgbd', 66, 5199.00, 200.00, 13200.00, 0.00, 329934.00, '0', '329934', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68669c3d86fa8.jpg', 1, '2025-07-03 21:05:37', '2025-07-03 21:05:37'),
(44, '683ecdad20fa0', 'sdfgsdgbd', 20, 5199.00, 200.00, 4000.00, 0.00, 99980.00, '0', '99980', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_6867f7221a125.jpg', 1, '2025-07-04 21:45:42', '2025-07-04 21:45:42'),
(45, '683ecdad20fa0', 'sdfgsdgbd', 40, 5199.00, 200.00, 8000.00, 0.00, 199960.00, '0', '199960', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_686926d6ec939.jpg', 1, '2025-07-05 19:21:30', '2025-07-05 19:21:30'),
(46, '683ecdad20fa0', 'sdfgsdgbd', 20, 5199.00, 200.00, 4000.00, 0.00, 99980.00, '0', '99980', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_686a1f67dcd56.jpg', 1, '2025-07-06 13:02:05', '2025-07-06 13:02:05'),
(47, '685816d83c7fa', 'sdfgsdgbd', 100, 5199.00, 200.00, 20000.00, 0.00, 499900.00, '0', 'Dm Kamruzzaman', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_686b5ec814386.jpg', 1, '2025-07-07 11:44:44', '2025-07-07 11:44:44'),
(48, '681f1cfc08f53', 'sdfgsdgbd', 100, 5199.00, 200.00, 20000.00, 0.00, 499900.00, '0', '123456', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_686bc6e0622fb.jpeg', 1, '2025-07-07 19:08:52', '2025-07-07 19:08:52'),
(49, '681f1cfc08f53', 'sdfgsdgbd', 21, 5199.00, 200.00, 4200.00, 0.00, 104979.00, '0', '123456', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_686cdd425b174.jpeg', 1, '2025-07-08 14:56:38', '2025-07-08 14:56:38'),
(50, '683ecdad20fa0', 'sdfgsdgbd', 32, 5199.00, 200.00, 6400.00, 0.00, 159968.00, '0', '159968', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_686cdf12807bf.jpg', 1, '2025-07-08 15:04:22', '2025-07-08 15:04:22'),
(51, '681f1cfc08f53', 'sdfgsdgbd', 20, 5199.00, 200.00, 4000.00, 0.00, 99980.00, '0', '123456', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_686d409575b1e.jpeg', 1, '2025-07-08 22:00:25', '2025-07-08 22:00:25'),
(52, '683ecdad20fa0', 'sdfgsdgbd', 20, 5199.00, 200.00, 4000.00, 0.00, 99980.00, '0', '99980', '', 1, '2025-07-09 15:02:55', '2025-07-09 15:02:55'),
(53, '681f1cfc08f53', 'sdfgsdgbd', 50, 5199.00, 200.00, 10000.00, 0.00, 249950.00, '0', '123456', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_686f9e758a11a.jpeg', 1, '2025-07-10 17:05:29', '2025-07-10 17:05:29'),
(54, '683ecdad20fa0', 'sdfgsdgbd', 20, 5199.00, 200.00, 4000.00, 0.00, 99980.00, '0', '99980', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_686fa8e8cae0a.jpg', 1, '2025-07-10 17:50:06', '2025-07-10 17:50:06'),
(55, '683ecdad20fa0', 'sdfgsdgbd', 20, 5199.00, 200.00, 4000.00, 0.00, 99980.00, '0', '99980', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_687616cdc786e.jpg', 1, '2025-07-15 14:52:33', '2025-07-15 14:52:33'),
(56, '683ecdad20fa0', 'sdfgsdgbd', 20, 5199.00, 200.00, 4000.00, 0.00, 99980.00, '0', '99980', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68761871d0bee.jpg', 2, '2025-07-15 14:59:36', '2025-07-15 14:59:36'),
(57, '681f1cfc08f53', 'sdfgsdgbd', 20, 5199.00, 200.00, 4000.00, 0.00, 99980.00, '0', '123456', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68764820dc5fd.jpeg', 1, '2025-07-15 18:23:00', '2025-07-15 18:23:00'),
(58, '685816d83c7fa', 'sdfgsdgbd', 22, 5199.00, 200.00, 4400.00, 0.00, 109978.00, '0', 'Dm Kamruzzaman', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68765207efdb8.jpg', 1, '2025-07-15 19:05:16', '2025-07-15 19:05:16'),
(59, '683ecdad20fa0', 'sdfgsdgbd', 32, 5199.00, 200.00, 6400.00, 0.00, 159968.00, '0', '159968', '', 1, '2025-07-16 21:32:12', '2025-07-16 21:32:12'),
(60, '683ecdad20fa0', 'sdfgsdgbd', 32, 5199.00, 200.00, 6400.00, 0.00, 159968.00, '0', '159968', '', 2, '2025-07-16 21:33:35', '2025-07-16 21:33:35'),
(61, '681f1cfc08f53', 'sdfgsdgbd', 20, 5199.00, 200.00, 4000.00, 0.00, 99980.00, '0', '123456', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_6878f08454c98.jpeg', 1, '2025-07-17 18:46:00', '2025-07-17 18:46:00'),
(62, '683ecdad20fa0', 'sdfgsdgbd', 20, 5199.00, 200.00, 4000.00, 0.00, 99980.00, '0', '99980', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68791e62ead79.jpg', 1, '2025-07-17 22:01:42', '2025-07-17 22:01:42'),
(63, '685816d83c7fa', 'sdfgsdgbd', 156, 5199.00, 200.00, 31200.00, 0.00, 779844.00, '0', 'Dm Kamruzzaman', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_687922d903ef6.jpg', 1, '2025-07-17 22:20:46', '2025-07-17 22:20:46'),
(64, '683ecdad20fa0', 'sdfgsdgbd', 20, 5199.00, 200.00, 4000.00, 0.00, 99980.00, '0', '99980', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_687ba0271c316.jpg', 1, '2025-07-19 19:39:54', '2025-07-19 19:39:54'),
(65, '681f1cfc08f53', 'sdfgsdgbd', 30, 5199.00, 200.00, 6000.00, 0.00, 149970.00, '0', '123456', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_687baab91fc9a.jpeg', 1, '2025-07-19 20:25:01', '2025-07-19 20:25:01'),
(66, '683ecdad20fa0', 'sdfgsdgbd', 20, 5199.00, 200.00, 4000.00, 0.00, 99980.00, '0', '99980', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_687cc7a6be2f2.jpg', 1, '2025-07-20 16:40:42', '2025-07-20 16:40:42'),
(67, 'ahsdvdjcv', 'sdfgsdgbd', 1000, 5199.00, 0.00, 0.00, 0.00, 5199000.00, '0', '2445678899', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_687e615d0a72d.jpg', 1, '2025-07-21 21:48:48', '2025-07-21 21:48:48'),
(68, '683ecdad20fa0', 'sdfgsdgbd', 50, 5199.00, 200.00, 10000.00, 0.00, 249950.00, '20', '249950', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_687e6e614e39e.jpg', 1, '2025-07-21 22:44:20', '2025-07-21 22:44:20'),
(69, '681f1cfc08f53', 'sdfgsdgbd', 20, 5199.00, 200.00, 4000.00, 0.00, 99980.00, '0', '123456', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_687f228342e73.jpeg', 1, '2025-07-22 11:32:55', '2025-07-22 11:32:55'),
(70, '683ecdad20fa0', 'sdfgsdgbd', 100, 5199.00, 200.00, 20000.00, 0.00, 499900.00, '0', '499900', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_687f742deac71.jpg', 1, '2025-07-22 17:21:21', '2025-07-22 17:21:21'),
(71, '683ecdad20fa0', 'sdfgsdgbd', 20, 5199.00, 200.00, 4000.00, 0.00, 99980.00, '0', '99980', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_6880d7ee6dfad.jpg', 1, '2025-07-23 18:39:13', '2025-07-23 18:39:13'),
(73, '683ecdad20fa0', 'sdfgsdgbd', 70, 5199.00, 200.00, 14000.00, 0.00, 349930.00, '0', '349930', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_688242ebd204b.jpg', 1, '2025-07-24 20:27:59', '2025-07-24 20:27:59'),
(74, '681f1cfc08f53', 'sdfgsdgbd', 40, 5199.00, 200.00, 8000.00, 0.00, 199960.00, '0', '123456', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_688383d916418.jpeg', 1, '2025-07-25 19:17:17', '2025-07-25 19:17:17'),
(75, '6885bab18fae5', 'sdfgsdgbd', 18, 7250.00, 200.00, 3600.00, 0.00, 126900.00, '20', '4557765', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_6887184ba772f.jpg', 1, '2025-07-28 12:27:27', '2025-07-28 12:27:27'),
(76, '6885bab18fae5', '5ece4797eaf5e', 11, 4250.00, 130.00, 1430.00, 0.00, 45320.00, '20', '4557765', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_6887184ba772f.jpg', 1, '2025-07-28 12:27:27', '2025-07-28 12:27:27'),
(77, '683ecdad20fa0', 'sdfgsdgbd', 9, 7250.00, 200.00, 1800.00, 0.00, 63450.00, '20', '114300', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68871b7ba9771.jpg', 1, '2025-07-28 12:41:03', '2025-07-28 12:41:03'),
(78, '683ecdad20fa0', '5ece4797eaf5e', 10, 4250.00, 130.00, 1300.00, 0.00, 41200.00, '20', '114300', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68871b7ba9771.jpg', 1, '2025-07-28 12:41:03', '2025-07-28 12:41:03'),
(79, '683ecdad20fa0', '688461257188e', 1, 9950.00, 300.00, 300.00, 0.00, 9650.00, '20', '114300', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68871b7ba9771.jpg', 1, '2025-07-28 12:41:03', '2025-07-28 12:41:03'),
(80, '6885bab18fae5', '688461257188e', 10, 9950.00, 300.00, 3000.00, 0.00, 96500.00, '20', 'Uzzal', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68877c0a355cf.jpg', 2, '2025-07-28 19:33:02', '2025-07-28 19:33:02'),
(81, '6885bab18fae5', '688461257188e', 10, 9950.00, 300.00, 3000.00, 0.00, 96500.00, '20', 'Uzzal', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68877c3f7fc00.jpg', 1, '2025-07-28 19:33:55', '2025-07-28 19:33:55'),
(82, '683ecdad20fa0', 'sdfgsdgbd', 10, 7250.00, 200.00, 2000.00, 13100.00, 57400.00, '20', '108259', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_688a0b5d9710b.jpg', 1, '2025-07-30 18:09:04', '2025-07-30 18:09:04'),
(83, '683ecdad20fa0', '5ece4797eaf5e', 10, 4250.00, 130.00, 1300.00, 0.00, 41200.00, '20', '108259', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_688a0b5d9710b.jpg', 1, '2025-07-30 18:09:04', '2025-07-30 18:09:04'),
(84, '683ecdad20fa0', '688461257188e', 1, 9950.00, 300.00, 300.00, 0.00, 9650.00, '20', '108259', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_688a0b5d9710b.jpg', 1, '2025-07-30 18:09:04', '2025-07-30 18:09:04'),
(85, 'ahsdvdjcv', 'sdfgsdgbd', 1000, 7250.00, 0.00, 0.00, 0.00, 7250000.00, '20', 'Cash', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_688a1ce2b1a1f.jpg', 1, '2025-07-30 19:23:50', '2025-07-30 19:23:50'),
(86, 'ahsdvdjcv', '5ece4797eaf5e', 2000, 4250.00, 0.00, 0.00, 0.00, 8500000.00, '20', 'Cash', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_688a1ce2b1a1f.jpg', 1, '2025-07-30 19:23:50', '2025-07-30 19:23:50'),
(87, 'ahsdvdjcv', '688461257188e', 1000, 9950.00, 0.00, 0.00, 0.00, 9950000.00, '20', 'Cash', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_688a1ce2b1a1f.jpg', 1, '2025-07-30 19:23:50', '2025-07-30 19:23:50'),
(88, '681f1cfc08f53', 'sdfgsdgbd', 5, 7250.00, 200.00, 1000.00, 9720.00, 25530.00, '20', '123456', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_688a256e23d22.jpeg', 1, '2025-07-30 20:00:18', '2025-07-30 20:00:18'),
(89, '681f1cfc08f53', '5ece4797eaf5e', 5, 4250.00, 130.00, 650.00, 0.00, 20600.00, '20', '123456', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_688a256e23d22.jpeg', 1, '2025-07-30 20:00:18', '2025-07-30 20:00:18'),
(90, '681f1cfc08f53', '688461257188e', 5, 9950.00, 300.00, 1500.00, 0.00, 48250.00, '20', '123456', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_688a256e23d22.jpeg', 1, '2025-07-30 20:00:18', '2025-07-30 20:00:18'),
(91, '683ecdad20fa0', 'sdfgsdgbd', 20, 7250.00, 200.00, 4000.00, 0.00, 141000.00, '20', '141000', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_688b56ac46fb1.jpg', 1, '2025-07-31 17:42:41', '2025-07-31 17:42:41'),
(92, '683ecdad20fa0', 'sdfgsdgbd', 20, 7250.00, 200.00, 4000.00, 0.00, 141000.00, '20', '141000', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_688b56b196a1f.jpg', 2, '2025-07-31 17:42:46', '2025-07-31 17:42:46'),
(93, '683ecdad20fa0', 'sdfgsdgbd', 10, 7250.00, 200.00, 2000.00, 0.00, 70500.00, '20', 'Ertuioo', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_688bbc2e8eb56.jpg', 2, '2025-08-01 00:55:46', '2025-08-01 00:55:46'),
(94, '683ecdad20fa0', 'sdfgsdgbd', 20, 7250.00, 200.00, 4000.00, 650.00, 140350.00, '20', '150000', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_688dec0a8259a.jpg', 1, '2025-08-02 16:44:29', '2025-08-02 16:44:29'),
(95, '683ecdad20fa0', '688461257188e', 1, 9950.00, 300.00, 300.00, 0.00, 9650.00, '20', '150000', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_688dec0a8259a.jpg', 1, '2025-08-02 16:44:29', '2025-08-02 16:44:29'),
(96, '683ecdad20fa0', 'sdfgsdgbd', 13, 7250.00, 200.00, 2600.00, 210.00, 91440.00, '20', '145000', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_688f41887e4cf.jpg', 1, '2025-08-03 17:01:33', '2025-08-03 17:01:33'),
(97, '683ecdad20fa0', '5ece4797eaf5e', 13, 4250.00, 130.00, 1690.00, 0.00, 53560.00, '20', '145000', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_688f41887e4cf.jpg', 1, '2025-08-03 17:01:33', '2025-08-03 17:01:33'),
(98, '6885bab18fae5', '5ece4797eaf5e', 24, 4250.00, 130.00, 3120.00, 0.00, 98880.00, '20', 'Bank transfer ', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_688f4ed0f3463.jpg', 1, '2025-08-03 17:58:13', '2025-08-03 17:58:13'),
(99, '681f1cfc08f53', 'sdfgsdgbd', 15, 7250.00, 200.00, 3000.00, 0.00, 105750.00, '20', '123456', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_688f59a184c9f.jpeg', 1, '2025-08-03 18:44:21', '2025-08-03 18:44:21'),
(100, '6885bab18fae5', '5ece4797eaf5e', 11, 4250.00, 130.00, 1430.00, 0.00, 45320.00, '20', 'Bank transfer ', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_688f649ea0076.jpg', 1, '2025-08-03 19:31:14', '2025-08-03 19:31:14'),
(101, '685816d83c7fa', '5ece4797eaf5e', 10, 4250.00, 130.00, 1300.00, 0.00, 41200.00, '20', 'Dm Kamruzzaman ', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_688f8d51180a6.jpg', 1, '2025-08-03 22:24:52', '2025-08-03 22:24:52'),
(102, '6885bab18fae5', '5ece4797eaf5e', 12, 4250.00, 130.00, 1560.00, 0.00, 49440.00, '20', 'Bank transfer ', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_6890da495ed0b.jpg', 1, '2025-08-04 22:05:34', '2025-08-04 22:05:34'),
(103, '681f1cfc08f53', 'sdfgsdgbd', 5, 7250.00, 200.00, 1000.00, 0.00, 35250.00, '20', '123456', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_6890e76469fa7.png', 1, '2025-08-04 23:01:29', '2025-08-04 23:01:29'),
(104, '681f1cfc08f53', '5ece4797eaf5e', 5, 4250.00, 130.00, 650.00, 0.00, 20600.00, '20', '123456', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_6890e76469fa7.png', 1, '2025-08-04 23:01:29', '2025-08-04 23:01:29'),
(105, '683ecdad20fa0', 'sdfgsdgbd', 30, 7250.00, 200.00, 6000.00, 0.00, 211500.00, '20', '211500', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_6893491315ec9.jpg', 1, '2025-08-06 18:22:46', '2025-08-06 18:22:46'),
(106, '683ecdad20fa0', 'sdfgsdgbd', 17, 7250.00, 200.00, 3400.00, 1740.00, 118110.00, '20', '130470', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_6894ac4723f05.jpg', 1, '2025-08-07 19:38:18', '2025-08-07 19:38:18'),
(107, '683ecdad20fa0', '5ece4797eaf5e', 3, 4250.00, 130.00, 390.00, 0.00, 12360.00, '20', '130470', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_6894ac4723f05.jpg', 1, '2025-08-07 19:38:18', '2025-08-07 19:38:18'),
(108, '6885bab18fae5', 'sdfgsdgbd', 5, 7250.00, 200.00, 1000.00, 0.00, 35250.00, '20', 'Bank transfer ', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_6894cfe4a6c83.jpg', 1, '2025-08-07 22:10:16', '2025-08-07 22:10:16'),
(109, '6885bab18fae5', '688461257188e', 10, 9950.00, 300.00, 3000.00, 0.00, 96500.00, '20', 'Bank transfer ', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_6894cfe4a6c83.jpg', 1, '2025-08-07 22:10:16', '2025-08-07 22:10:16'),
(110, '685816d83c7fa', '5ece4797eaf5e', 10, 4250.00, 130.00, 1300.00, 0.00, 41200.00, '20', 'Dm Kamruzzaman ', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_6894e0c8cf920.jpg', 1, '2025-08-07 23:22:22', '2025-08-07 23:22:22'),
(111, '681f1cfc08f53', 'sdfgsdgbd', 20, 7250.00, 200.00, 4000.00, 0.00, 141000.00, '20', '123456', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68961115a7254.png', 1, '2025-08-08 21:00:41', '2025-08-08 21:00:41'),
(112, '681f1cfc08f53', '688461257188e', 0, 9950.00, 300.00, 0.00, 0.00, 0.00, '20', '123456', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68961115a7254.png', 2, '2025-08-08 21:00:41', '2025-08-08 21:00:41'),
(113, '683ecdad20fa0', 'sdfgsdgbd', 21, 7250.00, 200.00, 4200.00, 700.00, 147350.00, '20', '159710', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_6896e76e93ebe.jpg', 1, '2025-08-09 12:15:14', '2025-08-09 12:15:14'),
(114, '683ecdad20fa0', '5ece4797eaf5e', 3, 4250.00, 130.00, 390.00, 0.00, 12360.00, '20', '159710', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_6896e76e93ebe.jpg', 1, '2025-08-09 12:15:14', '2025-08-09 12:15:14'),
(115, '681f1cfc08f53', 'sdfgsdgbd', 5, 7250.00, 200.00, 1000.00, 0.00, 35250.00, '20', '123456', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_6897561ac0e3a.png', 1, '2025-08-09 20:07:26', '2025-08-09 20:07:26'),
(116, '681f1cfc08f53', '5ece4797eaf5e', 5, 4250.00, 130.00, 650.00, 0.00, 20600.00, '20', '123456', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_6897561ac0e3a.png', 1, '2025-08-09 20:07:26', '2025-08-09 20:07:26'),
(117, 'ahsdvdjcv', 'sdfgsdgbd', 10, 7250.00, 0.00, 0.00, 0.00, 72500.00, '20', '34566778', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68977f9aa4cec.jpg', 2, '2025-08-09 23:04:32', '2025-08-09 23:04:32'),
(118, '681f1cfc08f53', 'sdfgsdgbd', 10, 7250.00, 200.00, 2000.00, 0.00, 70500.00, '20', '123456', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68983154291b0.png', 1, '2025-08-10 11:42:47', '2025-08-10 11:42:47'),
(119, '681f1cfc08f53', '688461257188e', 10, 9950.00, 300.00, 3000.00, 0.00, 96500.00, '20', '123456', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68983154291b0.png', 1, '2025-08-10 11:42:47', '2025-08-10 11:42:47'),
(120, '683ecdad20fa0', 'sdfgsdgbd', 10, 7250.00, 200.00, 2000.00, 600.00, 69900.00, '20', '111100', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68989aa0a95f5.jpg', 1, '2025-08-10 19:12:04', '2025-08-10 19:12:04'),
(121, '683ecdad20fa0', '5ece4797eaf5e', 10, 4250.00, 130.00, 1300.00, 0.00, 41200.00, '20', '111100', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68989aa0a95f5.jpg', 1, '2025-08-10 19:12:04', '2025-08-10 19:12:04'),
(122, '6899a9b4bf765', '5ece4797eaf5e', 17, 4250.00, 130.00, 2210.00, 0.00, 70040.00, '20', 'Bank transfer ', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_6899c043934bb.jpg', 1, '2025-08-11 16:04:55', '2025-08-11 16:04:55'),
(123, '6899a9b4bf765', '688461257188e', 3, 9950.00, 300.00, 900.00, 0.00, 28950.00, '20', 'Bank transfer ', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_6899c043934bb.jpg', 1, '2025-08-11 16:04:55', '2025-08-11 16:04:55'),
(124, '681f1cfc08f53', 'sdfgsdgbd', 55, 7250.00, 200.00, 11000.00, 0.00, 387750.00, '20', '123456', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_6899d2deb4fc1.png', 1, '2025-08-11 17:24:18', '2025-08-11 17:24:18'),
(125, 'ahsdvdjcv', 'sdfgsdgbd', 13, 7250.00, 0.00, 0.00, 0.00, 94250.00, '20', 'safsdgdfsgasd', '', 2, '2025-08-11 21:13:18', '2025-08-11 21:13:18'),
(126, '681f1cfc08f53', 'sdfgsdgbd', 15, 7250.00, 200.00, 3000.00, 0.00, 105750.00, '20', '123456', '', 1, '2025-08-11 21:15:06', '2025-08-11 21:15:06'),
(127, '6899a9b4bf765', 'sdfgsdgbd', 6, 7250.00, 200.00, 1200.00, 0.00, 42300.00, '20', 'Bank transfer', '', 1, '2025-08-11 22:32:02', '2025-08-11 22:32:02'),
(128, '6899a9b4bf765', '5ece4797eaf5e', 6, 4250.00, 130.00, 780.00, 0.00, 24720.00, '20', 'Bank transfer', '', 1, '2025-08-11 22:32:02', '2025-08-11 22:32:02'),
(129, '689a171d79af4', 'sdfgsdgbd', 42, 7250.00, 200.00, 8400.00, 0.00, 296100.00, '20', 'Cash by md', '', 1, '2025-08-11 22:57:28', '2025-08-11 22:57:28'),
(130, '689a171d79af4', 'sdfgsdgbd', 18, 7250.00, 200.00, 3600.00, 0.00, 126900.00, '20', 'LID01438215020', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_689b6656d6dec.jpg', 1, '2025-08-12 22:05:48', '2025-08-12 22:05:48'),
(131, '683ecdad20fa0', 'sdfgsdgbd', 20, 7250.00, 200.00, 4000.00, 0.00, 141000.00, '20', '165720', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_689c77ce7ec27.jpg', 1, '2025-08-13 17:32:33', '2025-08-13 17:32:33'),
(132, '683ecdad20fa0', '5ece4797eaf5e', 6, 4250.00, 130.00, 780.00, 0.00, 24720.00, '20', '165720', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_689c77ce7ec27.jpg', 1, '2025-08-13 17:32:33', '2025-08-13 17:32:33'),
(133, '6899a9b4bf765', 'sdfgsdgbd', 8, 7250.00, 200.00, 1600.00, 0.00, 56400.00, '20', 'Bank transfer ', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_689db24c6c467.jpg', 1, '2025-08-14 15:54:24', '2025-08-14 15:54:24'),
(134, '6899a9b4bf765', '5ece4797eaf5e', 5, 4250.00, 130.00, 650.00, 0.00, 20600.00, '20', 'Bank transfer ', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_689db24c6c467.jpg', 1, '2025-08-14 15:54:24', '2025-08-14 15:54:24'),
(135, '6899a9b4bf765', '688461257188e', 5, 9950.00, 300.00, 1500.00, 0.00, 48250.00, '20', 'Bank transfer ', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_689db24c6c467.jpg', 1, '2025-08-14 15:54:24', '2025-08-14 15:54:24'),
(136, '681f1cfc08f53', 'sdfgsdgbd', 25, 7250.00, 200.00, 5000.00, 0.00, 176250.00, '20', '123456', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_689de8f26e7cb.png', 1, '2025-08-14 19:47:34', '2025-08-14 19:47:34'),
(137, '683ecdad20fa0', 'sdfgsdgbd', 1, 7250.00, 200.00, 200.00, 2700.00, 4350.00, '20', '82630', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68a050d671f0b.jpg', 1, '2025-08-16 15:35:22', '2025-08-16 15:35:22'),
(138, '683ecdad20fa0', '5ece4797eaf5e', 19, 4250.00, 130.00, 2470.00, 0.00, 78280.00, '20', '82630', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68a050d671f0b.jpg', 1, '2025-08-16 15:35:22', '2025-08-16 15:35:22'),
(139, '68a1e8e59696e', 'sdfgsdgbd', 31, 7250.00, 200.00, 6200.00, 0.00, 218550.00, '20', 'Intiyaz rubel', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68a3267574372.jpg', 1, '2025-08-18 19:11:21', '2025-08-18 19:11:21'),
(140, '681f1cfc08f53', 'sdfgsdgbd', 100, 7250.00, 200.00, 20000.00, 0.00, 705000.00, '20', '123456', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68a41b293a90c.png', 1, '2025-08-19 12:35:25', '2025-08-19 12:35:25'),
(141, '681f1cfc08f53', 'sdfgsdgbd', 15, 7250.00, 200.00, 3000.00, 0.00, 105750.00, '20', '123456', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68a4297553f7f.png', 1, '2025-08-19 13:36:25', '2025-08-19 13:36:25'),
(142, '681f1cfc08f53', '5ece4797eaf5e', 5, 4250.00, 130.00, 650.00, 0.00, 20600.00, '20', '123456', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68a4297553f7f.png', 1, '2025-08-19 13:36:25', '2025-08-19 13:36:25'),
(143, '683ecdad20fa0', 'sdfgsdgbd', 10, 7250.00, 200.00, 2000.00, 1100.00, 69400.00, '20', '90000', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68a48b838bed0.jpg', 1, '2025-08-19 20:34:47', '2025-08-19 20:34:47'),
(144, '683ecdad20fa0', '5ece4797eaf5e', 5, 4250.00, 130.00, 650.00, 0.00, 20600.00, '20', '90000', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68a48b838bed0.jpg', 1, '2025-08-19 20:34:47', '2025-08-19 20:34:47'),
(145, '685816d83c7fa', '688461257188e', 100, 9950.00, 300.00, 30000.00, 0.00, 965000.00, '20', 'Dm Kamruzzaman ', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68a497d65236d.jpg', 1, '2025-08-19 21:27:22', '2025-08-19 21:27:22'),
(146, '685816d83c7fa', '688461257188e', 30, 9950.00, 300.00, 9000.00, 0.00, 289500.00, '20', 'Dm Kamruzzaman ', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68a49eca7cdd6.jpg', 1, '2025-08-19 21:57:02', '2025-08-19 21:57:02'),
(147, '683ecdad20fa0', 'sdfgsdgbd', 1, 7250.00, 200.00, 200.00, 90.00, 6960.00, '20', '180000', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68a583d99bc61.jpg', 1, '2025-08-20 14:14:21', '2025-08-20 14:14:21'),
(148, '683ecdad20fa0', '5ece4797eaf5e', 42, 4250.00, 130.00, 5460.00, 0.00, 173040.00, '20', '180000', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68a583d99bc61.jpg', 1, '2025-08-20 14:14:21', '2025-08-20 14:14:21'),
(149, '683ecdad20fa0', '5ece4797eaf5e', 20, 4250.00, 130.00, 2600.00, 0.00, 82400.00, '20', '82400', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68a58c2bb3c18.jpg', 1, '2025-08-20 14:49:51', '2025-08-20 14:49:51'),
(150, '683ecdad20fa0', '5ece4797eaf5e', 20, 4250.00, 130.00, 2600.00, 0.00, 82400.00, '20', '82400', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68a58c2fa6086.jpg', 2, '2025-08-20 14:49:55', '2025-08-20 14:49:55'),
(151, '681f1cfc08f53', 'sdfgsdgbd', 10, 7250.00, 200.00, 2000.00, 0.00, 70500.00, '20', '123456', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68a5a024452ef.png', 1, '2025-08-20 16:15:03', '2025-08-20 16:15:03'),
(152, '681f1cfc08f53', '688461257188e', 1, 9950.00, 300.00, 300.00, 0.00, 9650.00, '20', '123456', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68a5a024452ef.png', 1, '2025-08-20 16:15:03', '2025-08-20 16:15:03'),
(153, '685816d83c7fa', '5ece4797eaf5e', 10, 4250.00, 130.00, 1300.00, 0.00, 41200.00, '20', 'Dm Kamruzzaman ', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68a5b4eaa9e34.jpg', 1, '2025-08-20 17:43:42', '2025-08-20 17:43:42'),
(154, '683ecdad20fa0', '5ece4797eaf5e', 25, 4250.00, 130.00, 3250.00, 700.00, 102300.00, '20', '102300', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68a6e08f6f8a0.jpg', 1, '2025-08-21 15:02:11', '2025-08-21 15:02:11'),
(155, '683ecdad20fa0', '5ece4797eaf5e', 20, 4250.00, 130.00, 2600.00, 0.00, 82400.00, '20', '82400', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68a73a71a235f.png', 1, '2025-08-21 21:25:41', '2025-08-21 21:25:41'),
(156, '683ecdad20fa0', 'sdfgsdgbd', 2, 7250.00, 200.00, 400.00, 710.00, 13390.00, '20', '54590', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68a83738189aa.png', 1, '2025-08-22 15:24:11', '2025-08-22 15:24:11'),
(157, '683ecdad20fa0', '5ece4797eaf5e', 10, 4250.00, 130.00, 1300.00, 0.00, 41200.00, '20', '54590', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68a83738189aa.png', 1, '2025-08-22 15:24:12', '2025-08-22 15:24:12'),
(158, '683ecdad20fa0', '5ece4797eaf5e', 22, 4250.00, 130.00, 2860.00, 400.00, 90240.00, '20', '90240', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68a95fcad9cef.jpg', 1, '2025-08-23 12:29:36', '2025-08-23 12:29:36'),
(159, '683ecdad20fa0', 'sdfgsdgbd', 10, 7250.00, 200.00, 2000.00, 0.00, 70500.00, '20', '122760', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68a9acddb1e22.jpg', 1, '2025-08-23 17:58:26', '2025-08-23 17:58:26'),
(160, '683ecdad20fa0', '5ece4797eaf5e', 8, 4250.00, 130.00, 1040.00, 0.00, 32960.00, '20', '122760', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68a9acddb1e22.jpg', 1, '2025-08-23 17:58:26', '2025-08-23 17:58:26'),
(161, '683ecdad20fa0', '688461257188e', 2, 9950.00, 300.00, 600.00, 0.00, 19300.00, '20', '122760', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68a9acddb1e22.jpg', 1, '2025-08-23 17:58:26', '2025-08-23 17:58:26'),
(162, '683ecdad20fa0', 'sdfgsdgbd', 5, 7250.00, 200.00, 1000.00, 300.00, 34950.00, '20', '55550', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68a9fe1a77ec4.jpg', 1, '2025-08-23 23:45:02', '2025-08-23 23:45:02'),
(163, '683ecdad20fa0', '5ece4797eaf5e', 5, 4250.00, 130.00, 650.00, 0.00, 20600.00, '20', '55550', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68a9fe1a77ec4.jpg', 1, '2025-08-23 23:45:02', '2025-08-23 23:45:02'),
(164, '681f1cfc08f53', 'sdfgsdgbd', 35, 7250.00, 200.00, 7000.00, 0.00, 246750.00, '20', '123456', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68aab9502316f.png', 1, '2025-08-24 13:03:47', '2025-08-24 13:03:47'),
(165, '683ecdad20fa0', '5ece4797eaf5e', 9, 4250.00, 130.00, 1170.00, 0.00, 37080.00, '20', '46730', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68ab1dc784ec1.jpg', 1, '2025-08-24 20:12:27', '2025-08-24 20:12:27'),
(166, '683ecdad20fa0', '688461257188e', 1, 9950.00, 300.00, 300.00, 0.00, 9650.00, '20', '46730', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68ab1dc784ec1.jpg', 1, '2025-08-24 20:12:27', '2025-08-24 20:12:27'),
(167, '683ecdad20fa0', '5ece4797eaf5e', 10, 4250.00, 130.00, 1300.00, 0.00, 41200.00, '20', '50850', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68ac163ede36e.jpg', 1, '2025-08-25 13:52:34', '2025-08-25 13:52:34'),
(168, '683ecdad20fa0', '688461257188e', 1, 9950.00, 300.00, 300.00, 0.00, 9650.00, '20', '50850', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68ac163ede36e.jpg', 1, '2025-08-25 13:52:34', '2025-08-25 13:52:34'),
(169, '683ecdad20fa0', '5ece4797eaf5e', 17, 4250.00, 130.00, 2210.00, 0.00, 70040.00, '20', '79690', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68ac4fdfc72d3.jpg', 1, '2025-08-25 17:58:27', '2025-08-25 17:58:27'),
(170, '683ecdad20fa0', '688461257188e', 1, 9950.00, 300.00, 300.00, 0.00, 9650.00, '20', '79690', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68ac4fdfc72d3.jpg', 1, '2025-08-25 17:58:27', '2025-08-25 17:58:27'),
(171, '681f1cfc08f53', 'sdfgsdgbd', 20, 7250.00, 200.00, 4000.00, 0.00, 141000.00, '20', '123456', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68ac5a21d442f.png', 1, '2025-08-25 18:42:13', '2025-08-25 18:42:13'),
(172, '681f1cfc08f53', '5ece4797eaf5e', 4, 4250.00, 130.00, 520.00, 0.00, 16480.00, '20', '123456', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68ac5a21d442f.png', 1, '2025-08-25 18:42:13', '2025-08-25 18:42:13'),
(173, '681f1cfc08f53', '688461257188e', 2, 9950.00, 300.00, 600.00, 0.00, 19300.00, '20', '123456', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68ac5a21d442f.png', 1, '2025-08-25 18:42:13', '2025-08-25 18:42:13'),
(174, '6899a9b4bf765', '5ece4797eaf5e', 12, 4250.00, 130.00, 1560.00, 0.00, 49440.00, '20', 'Bank transfer ', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68ac9841943e1.png', 1, '2025-08-25 23:07:17', '2025-08-25 23:07:17'),
(175, '683ecdad20fa0', '5ece4797eaf5e', 10, 4250.00, 130.00, 1300.00, 0.00, 41200.00, '20', '41200', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68ad4fb8a8dcb.jpg', 1, '2025-08-26 12:10:06', '2025-08-26 12:10:06'),
(176, '683ecdad20fa0', 'sdfgsdgbd', 62, 7250.00, 200.00, 12400.00, 0.00, 437100.00, '20', '457700', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68ad7f6ac496b.jpg', 1, '2025-08-26 15:33:34', '2025-08-26 15:33:34'),
(177, '683ecdad20fa0', '5ece4797eaf5e', 5, 4250.00, 130.00, 650.00, 0.00, 20600.00, '20', '457700', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68ad7f6ac496b.jpg', 1, '2025-08-26 15:33:34', '2025-08-26 15:33:34'),
(178, '683ecdad20fa0', 'sdfgsdgbd', 16, 7250.00, 200.00, 3200.00, 0.00, 112800.00, '20', '112800', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68aea198d3468.jpg', 1, '2025-08-27 12:11:41', '2025-08-27 12:11:41'),
(179, '683ecdad20fa0', 'sdfgsdgbd', 10, 7250.00, 200.00, 2000.00, 0.00, 70500.00, '20', '70500', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68af214135811.jpg', 1, '2025-08-27 21:16:24', '2025-08-27 21:16:24'),
(180, '683ecdad20fa0', '5ece4797eaf5e', 160, 4250.00, 130.00, 20800.00, 0.00, 659200.00, '20', '659200', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68b013552db93.jpg', 1, '2025-08-28 14:29:13', '2025-08-28 14:29:13'),
(181, '683ecdad20fa0', '5ece4797eaf5e', 15, 4250.00, 130.00, 1950.00, 0.00, 61800.00, '20', '71450', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68b06ae246248.jpg', 1, '2025-08-28 20:42:47', '2025-08-28 20:42:47'),
(182, '683ecdad20fa0', '688461257188e', 1, 9950.00, 300.00, 300.00, 0.00, 9650.00, '20', '71450', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68b06ae246248.jpg', 1, '2025-08-28 20:42:47', '2025-08-28 20:42:47'),
(183, '683ecdad20fa0', 'sdfgsdgbd', 1, 7250.00, 200.00, 200.00, 0.00, 7050.00, '20', '44130', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68b1ca873e2e7.png', 1, '2025-08-29 21:43:13', '2025-08-29 21:43:13'),
(184, '683ecdad20fa0', '5ece4797eaf5e', 9, 4250.00, 130.00, 1170.00, 0.00, 37080.00, '20', '44130', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68b1ca873e2e7.png', 1, '2025-08-29 21:43:13', '2025-08-29 21:43:13'),
(185, '683ecdad20fa0', 'sdfgsdgbd', 12, 7250.00, 200.00, 2400.00, 0.00, 84600.00, '20', '84600', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68b29b23771af.jpg', 1, '2025-08-30 12:33:12', '2025-08-30 12:33:12'),
(186, '683ecdad20fa0', 'sdfgsdgbd', 7, 7250.00, 200.00, 1400.00, 0.00, 49350.00, '20', '86430', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68b2c9d31ac27.jpg', 1, '2025-08-30 15:52:22', '2025-08-30 15:52:22'),
(187, '683ecdad20fa0', '5ece4797eaf5e', 9, 4250.00, 130.00, 1170.00, 0.00, 37080.00, '20', '86430', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68b2c9d31ac27.jpg', 1, '2025-08-30 15:52:22', '2025-08-30 15:52:22'),
(188, '683ecdad20fa0', 'sdfgsdgbd', 9, 7250.00, 200.00, 1800.00, 0.00, 63450.00, '20', '108770', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68b2e289563da.jpg', 1, '2025-08-30 17:37:48', '2025-08-30 17:37:48'),
(189, '683ecdad20fa0', '5ece4797eaf5e', 11, 4250.00, 130.00, 1430.00, 0.00, 45320.00, '20', '108770', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68b2e289563da.jpg', 1, '2025-08-30 17:37:48', '2025-08-30 17:37:48'),
(190, '683ecdad20fa0', 'sdfgsdgbd', 6, 7250.00, 200.00, 1200.00, 0.00, 42300.00, '20', '67020', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68b2e916aa0e1.jpg', 1, '2025-08-30 18:05:46', '2025-08-30 18:05:46'),
(191, '683ecdad20fa0', '5ece4797eaf5e', 6, 4250.00, 130.00, 780.00, 0.00, 24720.00, '20', '67020', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68b2e916aa0e1.jpg', 1, '2025-08-30 18:05:46', '2025-08-30 18:05:46'),
(192, '683ecdad20fa0', '5ece4797eaf5e', 10, 4250.00, 130.00, 1300.00, 0.00, 41200.00, '20', '41200', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68b32621d99bd.jpg', 1, '2025-08-30 22:26:16', '2025-08-30 22:26:16'),
(193, '683ecdad20fa0', 'sdfgsdgbd', 3, 7250.00, 200.00, 600.00, 0.00, 21150.00, '20', '66470', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68b3f6aef3d89.jpg', 1, '2025-08-31 13:16:04', '2025-08-31 13:16:04'),
(194, '683ecdad20fa0', '5ece4797eaf5e', 11, 4250.00, 130.00, 1430.00, 0.00, 45320.00, '20', '66470', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68b3f6aef3d89.jpg', 1, '2025-08-31 13:16:04', '2025-08-31 13:16:04'),
(195, '6885bab18fae5', 'sdfgsdgbd', 1, 7250.00, 200.00, 200.00, 0.00, 7050.00, '20', 'Bank transfer ', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68b402a5d4852.jpg', 1, '2025-08-31 14:07:06', '2025-08-31 14:07:06'),
(196, '6885bab18fae5', '5ece4797eaf5e', 1, 4250.00, 130.00, 130.00, 0.00, 4120.00, '20', 'Bank transfer ', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68b402a5d4852.jpg', 1, '2025-08-31 14:07:06', '2025-08-31 14:07:06'),
(197, '6885bab18fae5', '688461257188e', 12, 9950.00, 300.00, 3600.00, 0.00, 115800.00, '20', 'Bank transfer ', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68b402a5d4852.jpg', 1, '2025-08-31 14:07:06', '2025-08-31 14:07:06'),
(198, '683ecdad20fa0', '5ece4797eaf5e', 10, 4250.00, 130.00, 1300.00, 0.00, 41200.00, '20', '41200', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68b4193f4fbc8.jpg', 1, '2025-08-31 15:43:32', '2025-08-31 15:43:32'),
(199, '683ecdad20fa0', '5ece4797eaf5e', 12, 4250.00, 130.00, 1560.00, 0.00, 49440.00, '20', '49440', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68b43c05d3454.jpg', 1, '2025-08-31 18:11:53', '2025-08-31 18:11:53'),
(200, '681f1cfc08f53', 'sdfgsdgbd', 10, 7250.00, 200.00, 2000.00, 0.00, 70500.00, '20', '123456', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68b442492c3c1.png', 1, '2025-08-31 18:38:37', '2025-08-31 18:38:37'),
(201, '681f1cfc08f53', '5ece4797eaf5e', 5, 4250.00, 130.00, 650.00, 0.00, 20600.00, '20', '123456', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68b442492c3c1.png', 1, '2025-08-31 18:38:37', '2025-08-31 18:38:37'),
(202, '681f1cfc08f53', '688461257188e', 2, 9950.00, 300.00, 600.00, 0.00, 19300.00, '20', '123456', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68b442492c3c1.png', 1, '2025-08-31 18:38:37', '2025-08-31 18:38:37'),
(203, '683ecdad20fa0', 'sdfgsdgbd', 2, 7250.00, 200.00, 400.00, 0.00, 14100.00, '20', '54000', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68b44d63d08a9.jpg', 1, '2025-08-31 19:25:59', '2025-08-31 19:25:59'),
(204, '683ecdad20fa0', '5ece4797eaf5e', 6, 4250.00, 130.00, 780.00, 0.00, 24720.00, '20', '54000', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68b44d63d08a9.jpg', 1, '2025-08-31 19:25:59', '2025-08-31 19:25:59'),
(205, '683ecdad20fa0', '688461257188e', 2, 9950.00, 300.00, 600.00, 0.00, 19300.00, '20', '54000', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68b44d63d08a9.jpg', 1, '2025-08-31 19:25:59', '2025-08-31 19:25:59'),
(206, '683ecdad20fa0', '5ece4797eaf5e', 7, 4250.00, 130.00, 910.00, 0.00, 28840.00, '20', '57790', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68b45ad9ce5d4.jpg', 1, '2025-08-31 20:23:25', '2025-08-31 20:23:25'),
(207, '683ecdad20fa0', '688461257188e', 3, 9950.00, 300.00, 900.00, 0.00, 28950.00, '20', '57790', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68b45ad9ce5d4.jpg', 1, '2025-08-31 20:23:25', '2025-08-31 20:23:25'),
(208, '683ecdad20fa0', '5ece4797eaf5e', 40, 4250.00, 130.00, 5200.00, 0.00, 164800.00, '20', '164800', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68b46b185d3d4.jpg', 1, '2025-08-31 21:32:44', '2025-08-31 21:32:44'),
(209, '6899a9b4bf765', '5ece4797eaf5e', 22, 4250.00, 130.00, 2860.00, 0.00, 90640.00, '20', 'Bank transfer ', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68b479b6568eb.jpg', 1, '2025-08-31 22:35:07', '2025-08-31 22:35:07'),
(210, '683ecdad20fa0', 'sdfgsdgbd', 18, 7250.00, 200.00, 3600.00, 0.00, 126900.00, '20', '126900', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68b92d8bccbb4.jpg', 1, '2025-09-04 12:11:27', '2025-09-04 12:11:27'),
(211, '683ecdad20fa0', 'sdfgsdgbd', 18, 7250.00, 200.00, 3600.00, 0.00, 126900.00, '20', '126900', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68b92d8fe51b2.jpg', 2, '2025-09-04 12:11:31', '2025-09-04 12:11:31'),
(212, '6899a9b4bf765', '5ece4797eaf5e', 39, 4250.00, 130.00, 5070.00, 0.00, 160680.00, '20', 'Bank transfer ', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68b97dd5c6671.jpg', 1, '2025-09-04 17:54:03', '2025-09-04 17:54:03'),
(213, '6899a9b4bf765', '5ece4797eaf5e', 62, 4250.00, 130.00, 8060.00, 0.00, 255440.00, '20', 'Bank transfer', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68b9db044b2a5.jpg', 1, '2025-09-05 00:31:37', '2025-09-05 00:31:37'),
(214, '683ecdad20fa0', '5ece4797eaf5e', 10, 4250.00, 130.00, 1300.00, 0.00, 41200.00, '20', '41200', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68c1393ec9316.png', 1, '2025-09-10 14:39:30', '2025-09-10 14:39:30'),
(215, '683ecdad20fa0', 'sdfgsdgbd', 10, 7250.00, 200.00, 2000.00, 0.00, 70500.00, '20', '70500', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68c57063914ea.jpg', 1, '2025-09-13 19:23:50', '2025-09-13 19:23:50'),
(216, '683ecdad20fa0', '688461257188e', 1, 9950.00, 300.00, 300.00, 0.00, 9650.00, '20', '70500', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68c57063914ea.jpg', 1, '2025-09-13 19:23:50', '2025-09-13 19:23:50'),
(217, '683ecdad20fa0', 'sdfgsdgbd', 10, 7250.00, 200.00, 2000.00, 0.00, 70500.00, '20', '70500', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68c5706a9eb42.jpg', 2, '2025-09-13 19:23:58', '2025-09-13 19:23:58'),
(218, '683ecdad20fa0', '688461257188e', 1, 9950.00, 300.00, 300.00, 0.00, 9650.00, '20', '70500', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68c5706a9eb42.jpg', 2, '2025-09-13 19:23:58', '2025-09-13 19:23:58'),
(219, '683ecdad20fa0', 'sdfgsdgbd', 10, 7250.00, 200.00, 2000.00, 0.00, 70500.00, '20', '70500', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68c573f6dbd0b.jpg', 2, '2025-09-13 19:39:06', '2025-09-13 19:39:06'),
(220, '683ecdad20fa0', '688461257188e', 1, 9950.00, 300.00, 300.00, 0.00, 9650.00, '20', '70500', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68c573f6dbd0b.jpg', 2, '2025-09-13 19:39:06', '2025-09-13 19:39:06'),
(221, '681f1cfc08f53', 'sdfgsdgbd', 10, 7250.00, 200.00, 2000.00, 11300.00, 59200.00, '20', '123456', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68c6c0ca13f9d.jpg', 1, '2025-09-14 19:19:09', '2025-09-14 19:19:09'),
(222, '681f1cfc08f53', '5ece4797eaf5e', 1, 4250.00, 130.00, 130.00, 0.00, 4120.00, '20', '123456', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68c6c0ca13f9d.jpg', 1, '2025-09-14 19:19:09', '2025-09-14 19:19:09'),
(223, '681f1cfc08f53', '688461257188e', 5, 9950.00, 300.00, 1500.00, 0.00, 48250.00, '20', '123456', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68c6c0ca13f9d.jpg', 1, '2025-09-14 19:19:09', '2025-09-14 19:19:09');
INSERT INTO `agentcoursebuyrequest` (`id`, `agent_un_id`, `course_un_id`, `quantity`, `price_per_unit`, `commission_per_unit`, `commission_amount`, `balance_used`, `total_amount`, `gateway_id`, `trx`, `ssLink`, `status`, `created_at`, `updated_at`) VALUES
(224, '683ecdad20fa0', 'sdfgsdgbd', 28, 7250.00, 200.00, 5600.00, 0.00, 197400.00, '20', '197000', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68ce9f50dd0dd.jpg', 1, '2025-09-20 18:34:28', '2025-09-20 18:34:28'),
(225, 'ahsdvdjcv', '5ece4797eaf5ee', 10, 100000.00, 0.00, 0.00, 0.00, 1000000.00, '20', '223456', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68cfbcb5e150f.jpg', 1, '2025-09-21 14:52:09', '2025-09-21 14:52:09'),
(226, 'ahsdvdjcv', '68ce3c6969699', 10, 200000.00, 0.00, 0.00, 0.00, 2000000.00, '20', '223456', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68cfbcb5e150f.jpg', 1, '2025-09-21 14:52:09', '2025-09-21 14:52:09'),
(227, 'ahsdvdjcv', '68ce3d030b821', 10, 500000.00, 0.00, 0.00, 0.00, 5000000.00, '20', '223456', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68cfbcb5e150f.jpg', 1, '2025-09-21 14:52:09', '2025-09-21 14:52:09'),
(228, '683ecdad20fa0', 'sdfgsdgbd', 7, 7250.00, 200.00, 1400.00, 0.00, 49350.00, '20', '245300', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68cfbf41875a5.jpg', 1, '2025-09-21 15:03:02', '2025-09-21 15:03:02'),
(229, '683ecdad20fa0', '688461257188e', 1, 9950.00, 300.00, 300.00, 0.00, 9650.00, '20', '245300', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68cfbf41875a5.jpg', 1, '2025-09-21 15:03:02', '2025-09-21 15:03:02'),
(230, '683ecdad20fa0', '5ece4797eaf5ee', 2, 100000.00, 2000.00, 4000.00, 0.00, 196000.00, '20', '245300', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68cfbf41875a5.jpg', 1, '2025-09-21 15:03:02', '2025-09-21 15:03:02'),
(231, '683ecdad20fa0', 'sdfgsdgbd', 6, 7250.00, 200.00, 1200.00, 0.00, 42300.00, '20', 'Due ', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68d2530fd7a65.jpg', 1, '2025-09-23 13:58:14', '2025-09-23 13:58:14'),
(232, '683ecdad20fa0', '5ece4797eaf5', 2, 100000.00, 2000.00, 4000.00, 0.00, 196000.00, '20', 'Due ', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68d2530fd7a65.jpg', 1, '2025-09-23 13:58:14', '2025-09-23 13:58:14'),
(233, '683ecdad20fa0', '68ce3d030b821', 2, 500000.00, 10000.00, 20000.00, 0.00, 980000.00, '20', 'Due ', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68d2530fd7a65.jpg', 1, '2025-09-23 13:58:14', '2025-09-23 13:58:14'),
(234, '683ecdad20fa0', 'sdfgsdgbd', 50, 7250.00, 200.00, 10000.00, 0.00, 352500.00, '20', '3525000', 'https://f005.backblazeb2.com/file/savvy-data/payments/pay_68e53c8759aea.jpg', 1, '2025-10-07 22:15:07', '2025-10-07 22:15:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agentcoursebuyrequest`
--
ALTER TABLE `agentcoursebuyrequest`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agentcoursebuyrequest`
--
ALTER TABLE `agentcoursebuyrequest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=235;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
