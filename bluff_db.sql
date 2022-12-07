-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 07, 2022 at 08:16 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bluff_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cards`
--

CREATE TABLE `cards` (
  `id` int(11) NOT NULL,
  `colour` enum('HEART','DIAMOND','SPADE','CLOVER','') NOT NULL,
  `number` enum('A','2','3','4','5','6','7','8','9','10','JACK','QUEEN','KING','JOKER1','JOKER2') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cards`
--

INSERT INTO `cards` (`id`, `colour`, `number`) VALUES
(1, 'HEART', 'A'),
(2, 'HEART', '2'),
(3, 'HEART', '3'),
(4, 'HEART', '4'),
(5, 'HEART', '5'),
(6, 'HEART', '6'),
(7, 'HEART', '7'),
(8, 'HEART', '8'),
(9, 'HEART', '9'),
(10, 'HEART', '10'),
(11, 'HEART', 'JACK'),
(12, 'HEART', 'QUEEN'),
(13, 'HEART', 'KING'),
(14, 'DIAMOND', 'A'),
(15, 'DIAMOND', '2'),
(16, 'DIAMOND', '3'),
(17, 'DIAMOND', '4'),
(18, 'DIAMOND', '5'),
(19, 'DIAMOND', '6'),
(20, 'DIAMOND', '7'),
(21, 'DIAMOND', '8'),
(22, 'DIAMOND', '9'),
(23, 'DIAMOND', '10'),
(24, 'DIAMOND', 'JACK'),
(25, 'DIAMOND', 'QUEEN'),
(26, 'DIAMOND', 'KING'),
(27, 'SPADE', 'A'),
(28, 'SPADE', '2'),
(29, 'SPADE', '3'),
(30, 'SPADE', '4'),
(31, 'SPADE', '5'),
(32, 'SPADE', '6'),
(33, 'SPADE', '7'),
(34, 'SPADE', '8'),
(35, 'SPADE', '9'),
(36, 'SPADE', '10'),
(37, 'SPADE', 'JACK'),
(38, 'SPADE', 'QUEEN'),
(39, 'SPADE', 'KING'),
(40, 'CLOVER', 'A'),
(41, 'CLOVER', '2'),
(42, 'CLOVER', '3'),
(43, 'CLOVER', '4'),
(44, 'CLOVER', '5'),
(45, 'CLOVER', '6'),
(46, 'CLOVER', '7'),
(47, 'CLOVER', '8'),
(48, 'CLOVER', '9'),
(49, 'CLOVER', '10'),
(50, 'CLOVER', 'JACK'),
(51, 'CLOVER', 'QUEEN'),
(52, 'CLOVER', 'KING'),
(53, '', 'JOKER1'),
(54, '', 'JOKER2');

-- --------------------------------------------------------

--
-- Table structure for table `game_condition`
--

CREATE TABLE `game_condition` (
  `id` int(11) NOT NULL,
  `p_turn` int(11) DEFAULT NULL,
  `status` enum('STARTED','ENDED','ABORTED') DEFAULT NULL,
  `last_change` datetime DEFAULT NULL,
  `result` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `game_table`
--

CREATE TABLE `game_table` (
  `id` int(11) NOT NULL,
  `player_id` int(11) DEFAULT NULL,
  `game_condition_id` int(11) DEFAULT NULL,
  `card_id` int(11) DEFAULT NULL,
  `burned` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

CREATE TABLE `players` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `players`
--

INSERT INTO `players` (`id`, `name`, `created`) VALUES
(1, 'alexandros allakse', '2022-12-06 11:40:16'),
(2, 'alex', '2022-12-06 11:40:16'),
(7, 'alex2', '2022-12-06 11:41:09'),
(8, '', '2022-12-06 11:56:20'),
(9, 'kal', '2022-12-06 11:56:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cards`
--
ALTER TABLE `cards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `game_condition`
--
ALTER TABLE `game_condition`
  ADD PRIMARY KEY (`id`),
  ADD KEY `p_turn` (`p_turn`);

--
-- Indexes for table `game_table`
--
ALTER TABLE `game_table`
  ADD PRIMARY KEY (`id`),
  ADD KEY `player_id` (`player_id`),
  ADD KEY `card_id` (`card_id`),
  ADD KEY `game_condition_id` (`game_condition_id`);

--
-- Indexes for table `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cards`
--
ALTER TABLE `cards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `game_condition`
--
ALTER TABLE `game_condition`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `game_table`
--
ALTER TABLE `game_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `players`
--
ALTER TABLE `players`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `game_condition`
--
ALTER TABLE `game_condition`
  ADD CONSTRAINT `game_condition_ibfk_1` FOREIGN KEY (`p_turn`) REFERENCES `players` (`id`);

--
-- Constraints for table `game_table`
--
ALTER TABLE `game_table`
  ADD CONSTRAINT `game_table_ibfk_1` FOREIGN KEY (`player_id`) REFERENCES `players` (`id`),
  ADD CONSTRAINT `game_table_ibfk_2` FOREIGN KEY (`card_id`) REFERENCES `cards` (`id`),
  ADD CONSTRAINT `game_table_ibfk_3` FOREIGN KEY (`game_condition_id`) REFERENCES `game_condition` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
