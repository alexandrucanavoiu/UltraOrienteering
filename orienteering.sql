-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 22, 2016 at 08:19 PM
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
  `id` int(100) NOT NULL,
  `category_name` text NOT NULL,
  `route_name` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `route_name`) VALUES
(2, 'F18x', 2),
(3, 'M18', 2),
(4, 'Open', 1),
(5, 'fdfd', 1),
(6, 'gffgffg', 2);

-- --------------------------------------------------------

--
-- Table structure for table `clubs`
--

CREATE TABLE `clubs` (
  `id` int(11) NOT NULL,
  `club_name` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `club_city` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `club_district` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clubs`
--

INSERT INTO `clubs` (`id`, `club_name`, `club_city`, `club_district`) VALUES
(1, 'Asociatia Drumetii Montanex', 'Targu Jiu', 21),
(2, 'Jnepenissssdgfgvvfoo', 'Bucuresti', 19),
(3, 'Mecanturistlfdff', 'Galati', 10),
(4, 'Marinia Scoala X', 'Targu Jiu', 2);

-- --------------------------------------------------------

--
-- Table structure for table `district`
--

CREATE TABLE `district` (
  `id` int(11) NOT NULL,
  `district_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `district`
--

INSERT INTO `district` (`id`, `district_name`) VALUES
(0, ''),
(1, 'Alba'),
(2, 'Arad'),
(3, 'Arges'),
(4, 'Bacau'),
(5, 'Bihor'),
(6, 'Bistrita Nasaud'),
(7, 'Botosani'),
(8, 'Braila'),
(9, 'Brasov'),
(10, 'Bucuresti'),
(11, 'Buzau'),
(12, 'Calarasi'),
(13, 'Caras Severin'),
(14, 'Cluj'),
(15, 'Constanta'),
(16, 'Covasna'),
(17, 'Dambovita'),
(18, 'Dolj'),
(19, 'Galati'),
(20, 'Giurgiu'),
(21, 'Gorj'),
(22, 'Harghita'),
(23, 'Hunedoara'),
(24, 'Ialomita'),
(25, 'Iasi'),
(26, 'Ilfov'),
(27, 'Maramures'),
(28, 'Mehedinti'),
(29, 'Mures'),
(30, 'Neamt'),
(31, 'Olt'),
(32, 'Prahova'),
(33, 'Salaj'),
(34, 'Satu Mare'),
(35, 'Sibiu'),
(36, 'Suceava'),
(37, 'Teleorman'),
(38, 'Timis'),
(39, 'Tulcea'),
(40, 'Valcea'),
(41, 'Vaslui'),
(42, 'Vrancea');

-- --------------------------------------------------------

--
-- Table structure for table `participants`
--

CREATE TABLE `participants` (
  `id` int(11) NOT NULL,
  `uuidcard_id` int(11) NOT NULL,
  `clubs_name` int(11) NOT NULL,
  `participants_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `participants`
--

INSERT INTO `participants` (`id`, `uuidcard_id`, `clubs_name`, `participants_name`) VALUES
(1, 28, 1, 'Alexandru Canavoiu'),
(2, 45, 4, 'Maria Grigorex'),
(3, 28, 1, 'Alexandru Canavoiu'),
(4, 40, 2, 'hjfdjfdh fdhdhfd');

-- --------------------------------------------------------

--
-- Table structure for table `participants_manage`
--

CREATE TABLE `participants_manage` (
  `id` bigint(11) NOT NULL,
  `participants_id` int(11) NOT NULL,
  `categories_id` int(11) NOT NULL,
  `uuidcards_id` int(11) NOT NULL,
  `stages_name` int(11) NOT NULL,
  `post_s` varchar(255) NOT NULL DEFAULT '00:00:00',
  `post_1` varchar(255) NOT NULL DEFAULT '00:00:00',
  `post_2` varchar(255) NOT NULL DEFAULT '00:00:00',
  `post_3` varchar(255) NOT NULL DEFAULT '00:00:00',
  `post_4` varchar(255) NOT NULL DEFAULT '00:00:00',
  `post_5` varchar(255) NOT NULL DEFAULT '00:00:00',
  `post_6` varchar(255) NOT NULL DEFAULT '00:00:00',
  `post_7` varchar(255) NOT NULL DEFAULT '00:00:00',
  `post_8` varchar(255) NOT NULL DEFAULT '00:00:00',
  `post_9` varchar(255) NOT NULL DEFAULT '00:00:00',
  `post_10` varchar(255) NOT NULL DEFAULT '00:00:00',
  `post_11` varchar(255) NOT NULL DEFAULT '00:00:00',
  `post_12` varchar(255) NOT NULL DEFAULT '00:00:00',
  `post_f` varchar(255) NOT NULL DEFAULT '00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `participants_manage`
--

INSERT INTO `participants_manage` (`id`, `participants_id`, `categories_id`, `uuidcards_id`, `stages_name`, `post_s`, `post_1`, `post_2`, `post_3`, `post_4`, `post_5`, `post_6`, `post_7`, `post_8`, `post_9`, `post_10`, `post_11`, `post_12`, `post_f`) VALUES
(1, 3, 5, 28, 2, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00'),
(2, 3, 6, 28, 3, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00'),
(3, 3, 6, 28, 4, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00'),
(4, 3, 2, 28, 5, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00'),
(5, 1, 2, 28, 2, '00:00:02', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00'),
(6, 1, 2, 28, 3, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00'),
(7, 1, 2, 28, 4, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00'),
(8, 1, 2, 28, 5, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00'),
(9, 2, 2, 45, 2, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00'),
(10, 2, 2, 45, 3, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00'),
(11, 2, 2, 45, 4, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00'),
(12, 2, 2, 45, 5, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

CREATE TABLE `routes` (
  `id` int(11) NOT NULL,
  `route_name` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `route_length` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `post_nr` int(11) NOT NULL,
  `post_1` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `post_2` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `post_3` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `post_4` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `post_5` varchar(255) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `post_6` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `post_7` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `post_8` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `post_9` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `post_10` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `post_11` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `post_12` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `routes`
--

INSERT INTO `routes` (`id`, `route_name`, `route_length`, `post_nr`, `post_1`, `post_2`, `post_3`, `post_4`, `post_5`, `post_6`, `post_7`, `post_8`, `post_9`, `post_10`, `post_11`, `post_12`) VALUES
(1, 'Short', '2', 6, 'P1', 'P2', 'P3', 'P4', 'P5', 'P6', '', '', '', '', '', ''),
(2, 'Route 2', '4', 7, 'P1', 'P2', 'P3', 'P4', 'P5', 'P6', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `stages`
--

CREATE TABLE `stages` (
  `id` int(11) NOT NULL,
  `stage_name` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `stage_date` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `stage_time` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stages`
--

INSERT INTO `stages` (`id`, `stage_name`, `stage_date`, `stage_time`) VALUES
(2, 'Ziua 1', '12/28/2016', '00:03:00'),
(3, 'Ziua 2', '12/31/2016', '00:03:00'),
(4, 'Ziua 3', '12/13/2016', '00:03:00'),
(5, 'Ziua 4x', '12/13/2016', '00:05:00');

-- --------------------------------------------------------

--
-- Table structure for table `uuidcards`
--

CREATE TABLE `uuidcards` (
  `id` int(100) NOT NULL,
  `uuidcard` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `uuidcards`
--

INSERT INTO `uuidcards` (`id`, `uuidcard`) VALUES
(14, 'C23D5193'),
(17, 'C2385053'),
(18, 'C2366213'),
(20, 'C238E403'),
(21, 'C23FC5B3'),
(23, 'C241BF03'),
(26, 'C241EF83'),
(27, 'C23F5A93'),
(28, 'C24028E3'),
(29, 'C23EB703'),
(30, 'AB89C2A9'),
(31, 'C23D1F03'),
(32, 'C238EC63'),
(33, 'C23A2893'),
(34, 'C23875B3'),
(35, 'C237C5B3'),
(36, 'C23BADC3'),
(37, 'C238A273'),
(38, 'C236CB93'),
(39, 'C241E253'),
(40, 'C2382A73'),
(41, 'C2751003'),
(42, 'C2358193'),
(43, 'C274EB43'),
(44, 'C23A1E43'),
(45, 'C2370AE3'),
(46, 'C23E26D3'),
(47, 'C23682F3'),
(48, 'C2379B63'),
(49, 'C2379B63'),
(50, 'C2345213');

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
-- Indexes for table `district`
--
ALTER TABLE `district`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `participants`
--
ALTER TABLE `participants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `participants_manage`
--
ALTER TABLE `participants_manage`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `uuidcards`
--
ALTER TABLE `uuidcards`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `clubs`
--
ALTER TABLE `clubs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `participants`
--
ALTER TABLE `participants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `participants_manage`
--
ALTER TABLE `participants_manage`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `routes`
--
ALTER TABLE `routes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `stages`
--
ALTER TABLE `stages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `uuidcards`
--
ALTER TABLE `uuidcards`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
