-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 01, 2017 at 01:30 AM
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
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `route_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `route_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 'OPEN', '2016-12-30 18:51:05', '2016-12-30 18:51:05');

-- --------------------------------------------------------

--
-- Table structure for table `clubs`
--

CREATE TABLE `clubs` (
  `id` int(10) UNSIGNED NOT NULL,
  `club_district_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `clubs`
--

INSERT INTO `clubs` (`id`, `club_district_id`, `name`, `city`, `created_at`, `updated_at`) VALUES
(1, 21, 'Asociatia Drumetii Montane', 'Targu Jiu', '2016-12-31 04:56:54', '2016-12-31 04:56:54'),
(2, 10, 'Gaska Bucuresti', 'Bucuresti', '2016-12-31 04:56:54', '2016-12-31 04:56:54'),
(3, 1, 'Hhsdhgsdghsdghd', 'hdshsd', '2016-12-31 04:56:54', '2016-12-31 04:56:54'),
(4, 1, 'Balfdldf hfdhdfhfhdf', 'hfdhdfhfdh', '2016-12-31 04:59:22', '2016-12-31 04:59:22');

-- --------------------------------------------------------

--
-- Table structure for table `club_districts`
--

CREATE TABLE `club_districts` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `club_districts`
--

INSERT INTO `club_districts` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Alba', '2016-12-28 19:02:28', '2016-12-28 19:02:28'),
(2, 'Arad', '2016-12-28 19:02:28', '2016-12-28 19:02:28'),
(3, 'Arges', '2016-12-28 19:02:28', '2016-12-28 19:02:28'),
(4, 'Bacau', '2016-12-28 19:02:28', '2016-12-28 19:02:28'),
(5, 'Bihor', '2016-12-28 19:02:28', '2016-12-28 19:02:28'),
(6, 'Bistrita Nasaud', '2016-12-28 19:02:28', '2016-12-28 19:02:28'),
(7, 'Botosani', '2016-12-28 19:02:28', '2016-12-28 19:02:28'),
(8, 'Braila', '2016-12-28 19:02:28', '2016-12-28 19:02:28'),
(9, 'Brasov', '2016-12-28 19:02:28', '2016-12-28 19:02:28'),
(10, 'Bucuresti', '2016-12-28 19:02:28', '2016-12-28 19:02:28'),
(11, 'Buzau', '2016-12-28 19:02:28', '2016-12-28 19:02:28'),
(12, 'Calarasi', '2016-12-28 19:02:28', '2016-12-28 19:02:28'),
(13, 'Caras Severin', '2016-12-28 19:02:28', '2016-12-28 19:02:28'),
(14, 'Cluj', '2016-12-28 19:02:28', '2016-12-28 19:02:28'),
(15, 'Constanta', '2016-12-28 19:02:28', '2016-12-28 19:02:28'),
(16, 'Covasna', '2016-12-28 19:02:28', '2016-12-28 19:02:28'),
(17, 'Dambovita', '2016-12-28 19:02:28', '2016-12-28 19:02:28'),
(18, 'Dolj', '2016-12-28 19:02:28', '2016-12-28 19:02:28'),
(19, 'Galati', '2016-12-28 19:02:28', '2016-12-28 19:02:28'),
(20, 'Giurgiu', '2016-12-28 19:02:28', '2016-12-28 19:02:28'),
(21, 'Gorj', '2016-12-28 19:02:28', '2016-12-28 19:02:28'),
(22, 'Harghita', '2016-12-28 19:02:28', '2016-12-28 19:02:28'),
(23, 'Hunedoara', '2016-12-28 19:02:28', '2016-12-28 19:02:28'),
(24, 'Ialomita', '2016-12-28 19:02:28', '2016-12-28 19:02:28'),
(25, 'Iasi', '2016-12-28 19:02:28', '2016-12-28 19:02:28'),
(26, 'Ilfov', '2016-12-28 19:02:28', '2016-12-28 19:02:28'),
(27, 'Maramures', '2016-12-28 19:02:28', '2016-12-28 19:02:28'),
(28, 'Mehedinti', '2016-12-28 19:02:28', '2016-12-28 19:02:28'),
(29, 'Mures', '2016-12-28 19:02:28', '2016-12-28 19:02:28'),
(30, 'Neamt', '2016-12-28 19:02:28', '2016-12-28 19:02:28'),
(31, 'Olt', '2016-12-28 19:02:28', '2016-12-28 19:02:28'),
(32, 'Prahova', '2016-12-28 19:02:28', '2016-12-28 19:02:28'),
(33, 'Salaj', '2016-12-28 19:02:28', '2016-12-28 19:02:28'),
(34, 'Satu Mare', '2016-12-28 19:02:28', '2016-12-28 19:02:28'),
(35, 'Sibiu', '2016-12-28 19:02:28', '2016-12-28 19:02:28'),
(36, 'Suceava', '2016-12-28 19:02:28', '2016-12-28 19:02:28'),
(37, 'Teleorman', '2016-12-28 19:02:28', '2016-12-28 19:02:28'),
(38, 'Timis', '2016-12-28 19:02:28', '2016-12-28 19:02:28'),
(39, 'Tulcea', '2016-12-28 19:02:28', '2016-12-28 19:02:28'),
(40, 'Valcea', '2016-12-28 19:02:28', '2016-12-28 19:02:28'),
(41, 'Vaslui', '2016-12-28 19:02:28', '2016-12-28 19:02:28'),
(42, 'Vrancea', '2016-12-28 19:02:28', '2016-12-28 19:02:28');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(61, '2014_10_12_000000_create_users_table', 1),
(62, '2014_10_12_100000_create_password_resets_table', 1),
(63, '2016_12_22_200604_create_club_districts_table', 1),
(64, '2016_12_22_200739_create_clubs_table', 1),
(65, '2016_12_22_201816_create_uuid_cards_table', 1),
(66, '2016_12_22_202536_create_participants_table', 1),
(67, '2016_12_22_202834_create_stages_table', 1),
(68, '2016_12_22_203113_create_routes_table', 1),
(69, '2016_12_22_204324_create_categories_table', 1),
(70, '2016_12_22_204720_create_participant_managers_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `participants`
--

CREATE TABLE `participants` (
  `id` int(10) UNSIGNED NOT NULL,
  `club_id` int(10) UNSIGNED NOT NULL,
  `uuid_card_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `participants`
--

INSERT INTO `participants` (`id`, `club_id`, `uuid_card_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Ahdshsd hsdhdsh', '2016-12-31 04:57:43', '2016-12-31 04:57:43'),
(2, 1, 2, 'gfgfgfgfgf', '2016-12-31 04:57:51', '2016-12-31 04:57:51'),
(3, 3, 3, 'gfhgjh fdfd ggf', '2016-12-31 04:58:02', '2016-12-31 04:58:02'),
(4, 2, 4, 'gfhguyyu dsdsds ', '2016-12-31 04:58:10', '2016-12-31 04:58:10'),
(5, 2, 5, 'hghghg dsdsds', '2016-12-31 04:58:20', '2016-12-31 04:58:20'),
(6, 1, 6, 'fdfdf dsds gfgf', '2016-12-31 04:58:30', '2016-12-31 04:58:30'),
(7, 4, 10, 'ytuyuydsds gfgfgf yytyt', '2016-12-31 04:59:34', '2016-12-31 04:59:34'),
(8, 1, 30, 'Alexandru Canavoiu', '2016-12-31 06:06:49', '2016-12-31 17:12:13');

-- --------------------------------------------------------

--
-- Table structure for table `participant_managers`
--

CREATE TABLE `participant_managers` (
  `id` int(10) UNSIGNED NOT NULL,
  `participant_id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `uuid_card_id` int(10) UNSIGNED NOT NULL,
  `stage_id` int(10) UNSIGNED NOT NULL,
  `total_time` time NOT NULL DEFAULT '23:59:59',
  `post_start` time NOT NULL DEFAULT '00:00:00',
  `post_1` time NOT NULL DEFAULT '00:00:00',
  `post_2` time NOT NULL DEFAULT '00:00:00',
  `post_3` time NOT NULL DEFAULT '00:00:00',
  `post_4` time NOT NULL DEFAULT '00:00:00',
  `post_5` time NOT NULL DEFAULT '00:00:00',
  `post_6` time NOT NULL DEFAULT '00:00:00',
  `post_7` time NOT NULL DEFAULT '00:00:00',
  `post_8` time NOT NULL DEFAULT '00:00:00',
  `post_9` time NOT NULL DEFAULT '00:00:00',
  `post_10` time NOT NULL DEFAULT '00:00:00',
  `post_11` time NOT NULL DEFAULT '00:00:00',
  `post_12` time NOT NULL DEFAULT '00:00:00',
  `post_finish` time NOT NULL DEFAULT '00:00:00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `participant_managers`
--

INSERT INTO `participant_managers` (`id`, `participant_id`, `category_id`, `uuid_card_id`, `stage_id`, `total_time`, `post_start`, `post_1`, `post_2`, `post_3`, `post_4`, `post_5`, `post_6`, `post_7`, `post_8`, `post_9`, `post_10`, `post_11`, `post_12`, `post_finish`, `created_at`, `updated_at`) VALUES
(3, 2, 1, 2, 1, '00:31:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '2016-12-31 08:15:43', '2016-12-31 08:15:43'),
(4, 2, 1, 2, 2, '23:59:59', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '2016-12-31 08:15:47', '2016-12-31 08:15:47'),
(5, 6, 1, 6, 1, '00:30:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '2016-12-31 08:15:54', '2016-12-31 08:15:54'),
(6, 6, 1, 6, 2, '23:59:59', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '2016-12-31 08:15:57', '2016-12-31 08:15:57'),
(7, 8, 1, 39, 1, '11:25:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '2016-12-31 08:16:05', '2016-12-31 08:16:05'),
(9, 7, 1, 10, 1, '00:58:25', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '2016-12-31 08:16:40', '2016-12-31 08:16:40'),
(10, 7, 1, 10, 2, '23:59:59', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '2016-12-31 08:16:43', '2016-12-31 08:16:43'),
(13, 3, 1, 3, 1, '00:48:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '2016-12-31 10:21:00', '2016-12-31 10:21:00'),
(14, 5, 1, 5, 1, '00:44:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '2016-12-31 10:21:43', '2016-12-31 10:21:43'),
(15, 8, 1, 30, 2, '23:59:59', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '2016-12-31 17:12:32', '2016-12-31 17:12:32'),
(16, 1, 1, 1, 1, '23:59:59', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '2016-12-31 19:00:00', '2016-12-31 19:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

CREATE TABLE `routes` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `length_in_km` decimal(8,3) NOT NULL,
  `post_amount` int(11) NOT NULL,
  `post_1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `post_2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `post_3` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `post_4` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `post_5` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `post_6` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `post_7` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `post_8` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `post_9` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `post_10` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `post_11` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `post_12` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `routes`
--

INSERT INTO `routes` (`id`, `name`, `length_in_km`, `post_amount`, `post_1`, `post_2`, `post_3`, `post_4`, `post_5`, `post_6`, `post_7`, `post_8`, `post_9`, `post_10`, `post_11`, `post_12`, `created_at`, `updated_at`) VALUES
(1, 'Route 1', '2.000', 5, 'PRO', 'PRO', 'PRO', 'PRO', 'PRO', '', '', '', '', '', '', '', '2016-12-30 18:50:36', '2016-12-30 18:50:36');

-- --------------------------------------------------------

--
-- Table structure for table `stages`
--

CREATE TABLE `stages` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `start_time` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `duration` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `stages`
--

INSERT INTO `stages` (`id`, `name`, `start_time`, `duration`, `created_at`, `updated_at`) VALUES
(1, 'Ziua 1', '11/03/2016', '00:02:00', '2016-12-30 18:50:09', '2016-12-30 18:50:09'),
(2, 'Ziua 2', '12/28/2016', '00:03:00', '2016-12-30 18:50:09', '2016-12-30 18:50:09');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_route_id_foreign` (`route_id`);

--
-- Indexes for table `clubs`
--
ALTER TABLE `clubs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clubs_club_district_id_foreign` (`club_district_id`);

--
-- Indexes for table `club_districts`
--
ALTER TABLE `club_districts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `club_districts_name_unique` (`name`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `participants`
--
ALTER TABLE `participants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `participants_club_id_foreign` (`club_id`),
  ADD KEY `participants_uuid_card_id_foreign` (`uuid_card_id`);

--
-- Indexes for table `participant_managers`
--
ALTER TABLE `participant_managers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `participant_managers_participant_id_foreign` (`participant_id`),
  ADD KEY `participant_managers_category_id_foreign` (`category_id`),
  ADD KEY `participant_managers_uuid_card_id_foreign` (`uuid_card_id`),
  ADD KEY `participant_managers_stage_id_foreign` (`stage_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stages`
--
ALTER TABLE `stages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `clubs`
--
ALTER TABLE `clubs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `club_districts`
--
ALTER TABLE `club_districts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;
--
-- AUTO_INCREMENT for table `participants`
--
ALTER TABLE `participants`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `participant_managers`
--
ALTER TABLE `participant_managers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `routes`
--
ALTER TABLE `routes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `stages`
--
ALTER TABLE `stages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `uuid_cards`
--
ALTER TABLE `uuid_cards`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_route_id_foreign` FOREIGN KEY (`route_id`) REFERENCES `routes` (`id`);

--
-- Constraints for table `clubs`
--
ALTER TABLE `clubs`
  ADD CONSTRAINT `clubs_club_district_id_foreign` FOREIGN KEY (`club_district_id`) REFERENCES `club_districts` (`id`);

--
-- Constraints for table `participants`
--
ALTER TABLE `participants`
  ADD CONSTRAINT `participants_club_id_foreign` FOREIGN KEY (`club_id`) REFERENCES `clubs` (`id`),
  ADD CONSTRAINT `participants_uuid_card_id_foreign` FOREIGN KEY (`uuid_card_id`) REFERENCES `uuid_cards` (`id`);

--
-- Constraints for table `participant_managers`
--
ALTER TABLE `participant_managers`
  ADD CONSTRAINT `participant_managers_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `participant_managers_participant_id_foreign` FOREIGN KEY (`participant_id`) REFERENCES `participants` (`id`),
  ADD CONSTRAINT `participant_managers_stage_id_foreign` FOREIGN KEY (`stage_id`) REFERENCES `stages` (`id`),
  ADD CONSTRAINT `participant_managers_uuid_card_id_foreign` FOREIGN KEY (`uuid_card_id`) REFERENCES `uuid_cards` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
