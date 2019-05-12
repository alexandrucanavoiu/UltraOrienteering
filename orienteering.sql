-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 12, 2019 at 04:45 PM
-- Server version: 5.7.24
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
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
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `routes_id` int(11) NOT NULL,
  `category_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `clubs`
--

CREATE TABLE `clubs` (
  `id` int(11) NOT NULL,
  `club_name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `city` varchar(255) CHARACTER SET latin1 NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `participants`
--

CREATE TABLE `participants` (
  `id` int(11) NOT NULL,
  `uuidcards_id` int(11) NOT NULL,
  `clubs_id` int(11) NOT NULL,
  `participant_name` varchar(25) CHARACTER SET latin1 NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `participant_stages`
--

CREATE TABLE `participant_stages` (
  `id` int(11) NOT NULL,
  `participants_id` int(11) NOT NULL,
  `stages_id` int(11) NOT NULL,
  `categories_id` int(11) NOT NULL,
  `uuidcards_id` int(11) NOT NULL,
  `start_time` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `finish_time` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `total_time` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `abandon` int(1) NOT NULL,
  `missed_posts` text COLLATE utf8_unicode_ci,
  `order_posts` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `relay_categories`
--

CREATE TABLE `relay_categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `relay_categories_managers`
--

CREATE TABLE `relay_categories_managers` (
  `id` int(11) NOT NULL,
  `relay_category_id` int(11) NOT NULL,
  `routes_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `relay_participants`
--

CREATE TABLE `relay_participants` (
  `id` int(11) NOT NULL,
  `clubs_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `relay_participant_managers`
--

CREATE TABLE `relay_participant_managers` (
  `id` int(11) NOT NULL,
  `relay_participant_id` int(11) NOT NULL,
  `participant_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `uuidcards_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `relay_participant_stages`
--

CREATE TABLE `relay_participant_stages` (
  `id` int(11) NOT NULL,
  `relay_participant_id` int(11) NOT NULL,
  `relay_participant_managers_id` int(11) NOT NULL,
  `uuidcards_id` int(11) NOT NULL,
  `stages_id` int(11) NOT NULL,
  `relay_categories_id` int(11) NOT NULL,
  `relay_category_managers_id` int(11) NOT NULL,
  `routes_id` int(11) NOT NULL,
  `start_time` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `finish_time` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `total_time` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `abandon` int(1) NOT NULL,
  `missed_posts` text COLLATE utf8_unicode_ci,
  `order_posts` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

CREATE TABLE `routes` (
  `id` int(11) NOT NULL,
  `route_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `routes_managers`
--

CREATE TABLE `routes_managers` (
  `id` int(11) NOT NULL,
  `routes_id` int(11) NOT NULL,
  `post_code` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `organizer_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `competition_type` int(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `organizer_name`, `competition_type`, `created_at`, `updated_at`) VALUES
(1, 'Ultra Orienteering', 1, NULL, '2019-05-12 09:45:04');

-- --------------------------------------------------------

--
-- Table structure for table `stages`
--

CREATE TABLE `stages` (
  `id` int(11) NOT NULL,
  `stage_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `filename` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `uuidcards`
--

CREATE TABLE `uuidcards` (
  `id` int(8) NOT NULL,
  `uuid_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `uuidcards`
--

INSERT INTO `uuidcards` (`id`, `uuid_name`, `created_at`, `updated_at`) VALUES
(1, '03 1F 3D C2', NULL, NULL),
(2, '03 63 36 C2', NULL, NULL),
(3, '03 6F 36 C2', NULL, NULL),
(4, '03 77 36 C2', NULL, NULL),
(5, '03 83 35 C2', NULL, NULL),
(6, '03 B7 3E C2', NULL, NULL),
(7, '03 BF 41 C2', NULL, NULL),
(8, '03 D2 3F C2', NULL, NULL),
(9, '03 D5 33 C2', NULL, NULL),
(10, '03 D8 36 C2', NULL, NULL),
(11, '03 E0 37 C2', NULL, NULL),
(12, '03 E4 38 C2', NULL, NULL),
(13, '13 1A 38 C2', NULL, NULL),
(14, '13 2B 3D C2', NULL, NULL),
(15, '13 30 3A C2', NULL, NULL),
(16, '13 52 34 C2', NULL, NULL),
(17, '13 56 38 C2', NULL, NULL),
(18, '13 62 36 C2', NULL, NULL),
(19, '13 75 41 C2', NULL, NULL),
(20, '13 89 36 C2', NULL, NULL),
(21, '13 F0 34 C2', NULL, NULL),
(22, '23 0C 35 C2', NULL, NULL),
(23, '23 13 3A C2', NULL, NULL),
(24, '23 37 38 C2', NULL, NULL),
(25, '23 4C 3D C2', NULL, NULL),
(26, '23 58 3D C2', NULL, NULL),
(27, '23 D4 35 C2', NULL, NULL),
(28, '23 F5 35 C2', NULL, NULL),
(29, '23 F5 36 C2', NULL, NULL),
(30, '33 07 42 C2', NULL, NULL),
(31, '33 16 3E C2', NULL, NULL),
(32, '33 2C 38 C2', NULL, NULL),
(33, '33 3A 3E C2', NULL, NULL),
(34, '33 5E 36 C2', NULL, NULL),
(35, '33 67 3D C2', NULL, NULL),
(36, '33 89 36 C2', NULL, NULL),
(37, '33 C1 37 C2', NULL, NULL),
(38, '33 F5 36 C2', NULL, NULL),
(39, '43 1E 3A C2', NULL, NULL),
(40, '43 22 37 C2', NULL, NULL),
(41, '43 33 3C C2', NULL, NULL),
(42, '43 3A 42 C2', NULL, NULL),
(43, '43 6F 3C C2', NULL, NULL),
(44, '43 70 74 C2', NULL, NULL),
(45, '43 C8 3A C2', NULL, NULL),
(46, '43 D1 37 C2', NULL, NULL),
(47, '43 EB 74 C2', NULL, NULL),
(48, '53 0B 3A C2', NULL, NULL),
(49, '53 3D 75 C2', NULL, NULL),
(50, '53 3E 42 C2', NULL, NULL),
(51, '53 50 38 C2', NULL, NULL),
(52, '53 9F 36 C2', NULL, NULL),
(53, '53 AA 41 C2', NULL, NULL),
(54, '53 D8 38 C2', NULL, NULL),
(55, '53 E2 41 C2', NULL, NULL),
(56, '53 E4 3D C2', NULL, NULL),
(57, '53 F0 36 C2', NULL, NULL),
(58, '63 3E 38 C2', NULL, NULL),
(59, '63 49 3E C2', NULL, NULL),
(60, '63 9B 37 C2', NULL, NULL),
(61, '63 DD 38 C2', NULL, NULL),
(62, '63 E5 37 C2', NULL, NULL),
(63, '63 EC 38 C2', NULL, NULL),
(64, '63 F0 39 C2', NULL, NULL),
(65, '73 17 3F C2', NULL, NULL),
(66, '73 26 37 C2', NULL, NULL),
(67, '73 2A 38 C2', NULL, NULL),
(68, '73 30 3A C2', NULL, NULL),
(69, '73 35 37 C2', NULL, NULL),
(70, '73 3C 36 C2', NULL, NULL),
(71, '73 64 38 C2', NULL, NULL),
(72, '73 7C 38 C2', NULL, NULL),
(73, '73 9A 3A C2', NULL, NULL),
(74, '73 A2 38 C2', NULL, NULL),
(75, '73 D0 41 C2', NULL, NULL),
(76, '73 E2 3D C2', NULL, NULL),
(77, '73 FF 41 C2', NULL, NULL),
(78, '83 2B 3F C2', NULL, NULL),
(79, '83 46 3E C2', NULL, NULL),
(80, '83 EF 41 C2', NULL, NULL),
(81, '93 28 3A C2', NULL, NULL),
(82, '93 29 35 C2', NULL, NULL),
(83, '93 40 38 C2', NULL, NULL),
(84, '93 51 3D C2', NULL, NULL),
(85, '93 5A 3F C2', NULL, NULL),
(86, '93 81 35 C2', NULL, NULL),
(87, '93 95 74 C2', NULL, NULL),
(88, '93 A6 3C C2', NULL, NULL),
(89, '93 BF 3D C2', NULL, NULL),
(90, '93 CB 36 C2', NULL, NULL),
(91, '93 D0 35 C2', NULL, NULL),
(92, 'A3 11 36 C2', NULL, NULL),
(93, 'A3 16 37 C2', NULL, NULL),
(94, 'A3 46 38 C2', NULL, NULL),
(95, 'A3 88 35 C2', NULL, NULL),
(96, 'A3 EB 74 C2', NULL, NULL),
(97, 'A9 AB 89 AB', NULL, NULL),
(98, 'A9 C2 89 AB', NULL, NULL),
(99, 'B3 75 38 C2', NULL, NULL),
(100, 'B3 A1 3F C2', NULL, NULL),
(101, 'B3 C5 37 C2', NULL, NULL),
(102, 'B3 C5 3F C2', NULL, NULL),
(103, 'B3 C9 37 C2', NULL, NULL),
(104, 'B3 D0 36 C2', NULL, NULL),
(105, 'B3 ED 35 C2', NULL, NULL),
(106, 'C3 07 40 C2', NULL, NULL),
(107, 'C3 15 42 C2', NULL, NULL),
(108, 'C3 65 3D C2', NULL, NULL),
(109, 'C3 AD 3B C2', NULL, NULL),
(110, 'C3 CD 37 C2', NULL, NULL),
(111, 'C3 DB 34 C2', NULL, NULL),
(112, 'C3 DC 38 C2', NULL, NULL),
(113, 'D3 15 37 C2', NULL, NULL),
(114, 'D3 26 3E C2', NULL, NULL),
(115, 'D3 31 42 C2', NULL, NULL),
(116, 'D3 46 34 C2', NULL, NULL),
(117, 'D3 4F 38 C2', NULL, NULL),
(118, 'D3 6E 74 C2', NULL, NULL),
(119, 'D3 A6 40 C2', NULL, NULL),
(120, 'D3 C2 3D C2', NULL, NULL),
(121, 'D3 DE 35 C2', NULL, NULL),
(122, 'D3 EB 41 C2', NULL, NULL),
(123, 'D3 FC 39 C2', NULL, NULL),
(124, 'E3 11 36 C2', NULL, NULL),
(125, 'E3 28 40 C2', NULL, NULL),
(126, 'E3 2D 39 C2', NULL, NULL),
(127, 'E3 40 38 C2', NULL, NULL),
(128, 'E3 48 3D C2', NULL, NULL),
(129, 'E3 4C 3D C2', NULL, NULL),
(130, 'E3 5E 36 C2', NULL, NULL),
(131, 'E3 64 36 C2', NULL, NULL),
(132, 'E3 81 37 C2', NULL, NULL),
(133, 'E3 88 39 C2', NULL, NULL),
(134, 'E3 90 3D C2', NULL, NULL),
(135, 'F3 20 3F C2', NULL, NULL),
(136, 'F3 82 36 C2', NULL, NULL),
(137, 'F3 94 3D C2', NULL, NULL),
(138, 'F3 9B 36 C2', NULL, NULL),
(139, 'F3 AA 41 C2', NULL, NULL),
(140, 'F9 DD 89 AB', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clubs`
--
ALTER TABLE `clubs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `participants`
--
ALTER TABLE `participants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `club_name` (`clubs_id`);

--
-- Indexes for table `participant_stages`
--
ALTER TABLE `participant_stages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `relay_categories`
--
ALTER TABLE `relay_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `relay_categories_managers`
--
ALTER TABLE `relay_categories_managers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `relay_participants`
--
ALTER TABLE `relay_participants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `club_name` (`clubs_id`);

--
-- Indexes for table `relay_participant_managers`
--
ALTER TABLE `relay_participant_managers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `relay_participant_stages`
--
ALTER TABLE `relay_participant_stages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `routes_managers`
--
ALTER TABLE `routes_managers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stages`
--
ALTER TABLE `stages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uuidcards`
--
ALTER TABLE `uuidcards`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid_name` (`uuid_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `clubs`
--
ALTER TABLE `clubs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `participants`
--
ALTER TABLE `participants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `participant_stages`
--
ALTER TABLE `participant_stages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `relay_categories`
--
ALTER TABLE `relay_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `relay_categories_managers`
--
ALTER TABLE `relay_categories_managers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `relay_participants`
--
ALTER TABLE `relay_participants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `relay_participant_managers`
--
ALTER TABLE `relay_participant_managers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `relay_participant_stages`
--
ALTER TABLE `relay_participant_stages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `routes`
--
ALTER TABLE `routes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `routes_managers`
--
ALTER TABLE `routes_managers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `stages`
--
ALTER TABLE `stages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `uuidcards`
--
ALTER TABLE `uuidcards`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `participants`
--
ALTER TABLE `participants`
  ADD CONSTRAINT `club_name` FOREIGN KEY (`clubs_id`) REFERENCES `clubs` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
