-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 17, 2024 at 03:27 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `solospend_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `budget`
--

CREATE TABLE `budget` (
  `bud_id` int(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `bud_title` varchar(50) NOT NULL,
  `bud_desc` varchar(300) NOT NULL,
  `date_modified` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `budget_item`
--

CREATE TABLE `budget_item` (
  `bud_item_id` int(25) NOT NULL,
  `bud_id` int(20) NOT NULL,
  `bud_item_name` varchar(50) NOT NULL,
  `bud_item_purp` varchar(30) NOT NULL,
  `bud_item_amount` decimal(10,2) NOT NULL,
  `bud_item_desc` varchar(300) NOT NULL,
  `date_modified` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `exp_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `exp_date` date NOT NULL,
  `exp_type` varchar(50) NOT NULL,
  `exp_mop` varchar(50) NOT NULL,
  `exp_amount` decimal(10,2) NOT NULL,
  `exp_remarks` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`exp_id`, `user_id`, `exp_date`, `exp_type`, `exp_mop`, `exp_amount`, `exp_remarks`) VALUES
(1, 1, '2024-07-17', 'adasda', 'CASH', 54.00, ''),
(3, 1, '2024-06-07', 'sdasdadas', 'CASH', 54.00, 'daksjdlkasjdlaksjdlaskdlkasdlaskhsajhfsajlhdalskjdlkasjdlkasjd'),
(4, 1, '2024-06-07', 'sdasdadas', 'CASH', 54.00, 'daksjdlkasjdlaksjdlaskdlkasdlaskhsajhfsajlhdalskjdlkasjdlkasjd'),
(5, 1, '2024-06-07', 'sdasdadas', 'CASH', 54.00, 'daksjdlkasjdlaksjdlaskdlkasdlaskhsajhfsajlhdalskjdlkasjdlkasjd'),
(6, 1, '2024-06-07', 'sdasdadas', 'CASH', 54.00, 'daksjdlkasjdlaksjdlaskdlkasdlaskhsajhfsajlhdalskjdlkasjdlkasjd'),
(7, 1, '2024-06-07', 'sdasdadas', 'CASH', 54.00, 'daksjdlkasjdlaksjdlaskdlkasdlaskhsajhfsajlhdalskjdlkasjdlkasjd'),
(8, 1, '2024-06-07', 'sdasdadas', 'CASH', 54.00, 'daksjdlkasjdlaksjdlaskdlkasdlaskhsajhfsajlhdalskjdlkasjdlkasjd'),
(9, 1, '2024-07-19', 'sdasdadas', 'CASH', 54.00, '');

-- --------------------------------------------------------

--
-- Table structure for table `income`
--

CREATE TABLE `income` (
  `inc_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `inc_date` date NOT NULL,
  `inc_origin` varchar(50) NOT NULL,
  `inc_type` varchar(50) NOT NULL,
  `inc_mot` varchar(50) NOT NULL,
  `inc_amount` decimal(10,2) NOT NULL,
  `inc_remarks` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_uname` varchar(30) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `user_fname` varchar(100) NOT NULL,
  `user_lname` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_dob` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_uname`, `user_password`, `user_fname`, `user_lname`, `user_email`, `user_dob`) VALUES
(1, 'mjadetc', '$2y$10$HREmfpli86hxfQQZuLwKGuaRUG1rMo7pBmylmZOw6hTMdOtHxTqFG', 'Marnel Jade', 'Carpio', '202211328@fit.edu.ph', '2004-06-19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `budget`
--
ALTER TABLE `budget`
  ADD PRIMARY KEY (`bud_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `budget_item`
--
ALTER TABLE `budget_item`
  ADD PRIMARY KEY (`bud_item_id`),
  ADD KEY `bud_id` (`bud_id`) USING BTREE;

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`exp_id`),
  ADD KEY `user_id` (`user_id`) USING BTREE;

--
-- Indexes for table `income`
--
ALTER TABLE `income`
  ADD PRIMARY KEY (`inc_id`),
  ADD KEY `user_id` (`user_id`) USING BTREE;

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `budget`
--
ALTER TABLE `budget`
  MODIFY `bud_id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `budget_item`
--
ALTER TABLE `budget_item`
  MODIFY `bud_item_id` int(25) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `exp_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `budget`
--
ALTER TABLE `budget`
  ADD CONSTRAINT `del_bud` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `budget_item`
--
ALTER TABLE `budget_item`
  ADD CONSTRAINT `del_bud_item` FOREIGN KEY (`bud_id`) REFERENCES `budget` (`bud_id`) ON DELETE CASCADE;

--
-- Constraints for table `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `expenses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
