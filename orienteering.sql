-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 05, 2017 at 04:41 PM
-- Server version: 5.7.11
-- PHP Version: 5.6.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `orienteering`
--

-- --------------------------------------------------------

--
-- Table structure for table `uuid_cards`
--

CREATE TABLE `uuid_cards` (
  `id` int(10) UNSIGNED NOT NULL,
  `uuidcard` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `uuid_cards`
--

INSERT INTO `uuid_cards` (`id`, `uuidcard`, `created_at`, `updated_at`) VALUES
(1, 'C2385613', NULL, NULL),
(2, 'C2369F53', NULL, NULL),
(3, 'C24231D3', NULL, NULL),
(4, 'C2368913', NULL, NULL),
(5, 'C2420733', NULL, NULL),
(6, 'C239F063', NULL, NULL),
(7, 'C236D0B3', NULL, NULL),
(8, 'C23846A3', NULL, NULL),
(9, 'C2373573', NULL, NULL),
(10, 'C235D093', NULL, NULL),
(11, 'C2387843', NULL, NULL),
(12, 'C23E4963', NULL, NULL),
(13, 'C236F523', NULL, NULL),
(14, 'C23D5193', NULL, NULL),
(15, 'C2358303', NULL, NULL),
(16, 'C2417513', NULL, NULL),
(17, 'C2385053', NULL, NULL),
(18, 'C2366213', NULL, NULL),
(19, 'C2366303', NULL, NULL),
(20, 'C238E403', NULL, NULL),
(21, 'C23FC5B3', NULL, NULL),
(22, 'C235DED3', NULL, NULL),
(23, 'C241BF03', NULL, NULL),
(24, 'C23781E3', NULL, NULL),
(25, 'C238CD13', NULL, NULL),
(26, 'C241EF83', NULL, NULL),
(27, 'C23F5A93', NULL, NULL),
(28, 'C24028E3', NULL, NULL),
(29, 'C23EB703', NULL, NULL),
(30, 'AB89C2A9', NULL, NULL),
(31, 'C23D1F03', NULL, NULL),
(32, 'C238EC63', NULL, NULL),
(33, 'C23A2893', NULL, NULL),
(34, 'C23875B3', NULL, NULL),
(35, 'C237C5B3', NULL, NULL),
(36, 'C23BADC3', NULL, NULL),
(37, 'C238A273', NULL, NULL),
(38, 'C236CB93', NULL, NULL),
(39, 'C241E253', NULL, NULL),
(40, 'C2382A73', NULL, NULL),
(41, 'C2751003', NULL, NULL),
(42, 'C2358193', NULL, NULL),
(43, 'C274EB43', NULL, NULL),
(44, 'C23A1E43', NULL, NULL),
(45, 'C2370AE3', NULL, NULL),
(46, 'C23E26D3', NULL, NULL),
(47, 'C23682F3', NULL, NULL),
(48, 'C2379B63', NULL, NULL),
(49, 'C2345213', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `uuid_cards`
--
ALTER TABLE `uuid_cards`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid_cards_uuidcard_unique` (`uuidcard`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `uuid_cards`
--
ALTER TABLE `uuid_cards`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
