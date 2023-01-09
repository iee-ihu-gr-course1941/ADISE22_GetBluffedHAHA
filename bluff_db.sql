-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:4333
-- Generation Time: Jan 08, 2023 at 04:09 PM
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
-- Table structure for table `check_bluff`
--

CREATE TABLE `check_bluff` (
  `id` int(11) NOT NULL,
  `card_id` int(11) NOT NULL,
  `player_id` int(11) NOT NULL,
  `last_changed` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

--
-- Dumping data for table `game_condition`
--

INSERT INTO `game_condition` (`id`, `p_turn`, `status`, `last_change`, `result`) VALUES
(11, 4, 'STARTED', '2023-01-07 14:38:53', 'pame');

-- --------------------------------------------------------

--
-- Table structure for table `game_table`
--

CREATE TABLE `game_table` (
  `id` int(11) NOT NULL,
  `player_id` int(11) DEFAULT NULL,
  `game_condition_id` int(11) DEFAULT NULL,
  `card_id` int(11) DEFAULT NULL,
  `burned` bit(1) DEFAULT NULL,
  `ontable` bit(1) DEFAULT NULL,
  `bluff` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `game_table`
--

INSERT INTO `game_table` (`id`, `player_id`, `game_condition_id`, `card_id`, `burned`, `ontable`, `bluff`) VALUES
(5136, 2, 11, 20, b'0', b'0', NULL),
(5140, 2, 11, 36, b'0', b'0', NULL),
(5141, 2, 11, 50, b'0', b'0', NULL),
(5142, 2, 11, 44, b'0', b'0', NULL),
(5143, 2, 11, 11, b'0', b'0', NULL),
(5144, 2, 11, 19, b'0', b'0', NULL),
(5146, 2, 11, 42, b'0', b'0', NULL),
(5147, 2, 11, 14, b'0', b'0', NULL),
(5148, 4, 11, 49, b'0', b'0', NULL),
(5150, 4, 11, 32, b'0', b'0', NULL),
(5153, 4, 11, 30, b'0', b'0', NULL),
(5154, 6, 11, 24, b'0', b'0', NULL),
(5155, 4, 11, 25, b'0', b'0', NULL),
(5156, 4, 11, 31, b'0', b'0', NULL),
(5157, 2, 11, 38, b'0', b'0', NULL),
(5158, 6, 11, 43, b'0', b'0', NULL),
(5159, 4, 11, 45, b'0', b'0', NULL),
(5160, 6, 11, 18, b'0', b'0', NULL),
(5161, 6, 11, 6, b'0', b'0', NULL),
(5162, 6, 11, 16, b'0', b'0', NULL),
(5163, 6, 11, 47, b'0', b'0', NULL),
(5164, 6, 11, 21, b'0', b'0', NULL),
(5165, 2, 11, 22, b'0', b'0', NULL),
(5166, 2, 11, 28, b'0', b'0', NULL),
(5167, 2, 11, 12, b'0', b'0', NULL),
(5168, 2, 11, 51, b'0', b'0', NULL),
(5169, 2, 11, 1, b'0', b'0', NULL),
(5170, 4, 11, 17, b'0', b'0', NULL),
(5171, 6, 11, 37, b'0', b'0', NULL),
(5172, 4, 11, 27, b'0', b'0', NULL),
(5173, 4, 11, 4, b'0', b'0', NULL),
(5174, 4, 11, 5, b'0', b'0', NULL),
(5175, 6, 11, 8, b'0', b'0', NULL),
(5177, 4, 11, 29, b'0', b'0', NULL),
(5178, 4, 11, 33, b'0', b'0', NULL),
(5179, 4, 11, 41, b'0', b'0', NULL),
(5180, 4, 11, 10, b'0', b'0', NULL),
(5181, 4, 11, 53, b'0', b'0', NULL),
(5182, 2, 11, 9, b'0', b'0', NULL),
(5183, 2, 11, 35, b'0', b'0', NULL),
(5185, 6, 11, 23, b'0', b'0', NULL),
(5186, 4, 11, 34, b'0', b'0', NULL),
(5187, 6, 11, 52, b'0', b'0', NULL),
(5188, 4, 11, 26, b'0', b'0', NULL),
(5189, 6, 11, 7, b'0', b'0', NULL),
(5190, 2, 11, 3, b'0', b'0', NULL),
(5191, 6, 11, 54, b'0', b'0', NULL),
(5192, 6, 11, 2, b'0', b'0', NULL),
(5193, 6, 11, 39, b'0', b'0', NULL),
(5194, 4, 11, 40, b'0', b'0', NULL),
(5195, 2, 11, 15, b'0', b'0', NULL),
(5196, 6, 11, 46, b'0', b'0', NULL),
(5197, 6, 11, 13, b'0', b'0', NULL),
(5198, 6, 11, 48, b'0', b'0', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

CREATE TABLE `players` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `token` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `players`
--

INSERT INTO `players` (`id`, `name`, `created`, `token`) VALUES
(1, '', '2023-01-07 11:27:14', 'd41d8cd98f00b204e9800998ecf8427e'),
(2, 'antonis', '2023-01-07 11:27:14', '1351cd4c983681e73e4c9a8348c7e0d9'),
(4, 'antonis2', '2023-01-07 11:29:03', '7faa4389fbef5aef5b3058cb910f1a4c'),
(6, 'Alex', '2023-01-07 14:40:59', 'a08372b70196c21a9229cf04db6b7ceb');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cards`
--
ALTER TABLE `cards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `check_bluff`
--
ALTER TABLE `check_bluff`
  ADD PRIMARY KEY (`id`),
  ADD KEY `card_id` (`card_id`),
  ADD KEY `player_id` (`player_id`);

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
-- AUTO_INCREMENT for table `check_bluff`
--
ALTER TABLE `check_bluff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `game_condition`
--
ALTER TABLE `game_condition`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `game_table`
--
ALTER TABLE `game_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5199;

--
-- AUTO_INCREMENT for table `players`
--
ALTER TABLE `players`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `check_bluff`
--
ALTER TABLE `check_bluff`
  ADD CONSTRAINT `check_bluff_ibfk_1` FOREIGN KEY (`card_id`) REFERENCES `cards` (`id`),
  ADD CONSTRAINT `check_bluff_ibfk_2` FOREIGN KEY (`player_id`) REFERENCES `players` (`id`);

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
