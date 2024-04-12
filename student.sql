-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2024 at 07:51 PM
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
-- Database: `student`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `student_id` varchar(20) NOT NULL,
  `time-in` time NOT NULL,
  `time-return` time NOT NULL,
  `date` date NOT NULL,
  `location` varchar(50) NOT NULL,
  `remarks` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `student_id`, `time-in`, `time-return`, `date`, `location`, `remarks`, `image`, `status`) VALUES
(1, '1003', '01:27:11', '00:00:00', '2024-04-13', 'ROOM', 'EARLY', '66196efd60d30.jpg', 'entered'),
(2, '1003', '01:28:27', '00:00:00', '2024-04-13', 'CLINIC', '', '', 'exit'),
(3, '1004', '01:28:37', '00:00:00', '2024-04-13', 'ROOM', 'EARLY', '66196f4b29123.jpg', 'entered'),
(4, '1003', '01:28:49', '00:00:00', '2024-04-13', 'ROOM', 'EARLY', '', 'entered'),
(5, '1003', '01:28:54', '00:00:00', '2024-04-13', 'COMFORT ROOM', '', '', 'exit'),
(6, '1003', '01:29:06', '00:00:00', '2024-04-13', 'ROOM', 'EARLY', '66196f6d54770.jpg', 'entered'),
(7, '1004', '01:29:33', '00:00:00', '2024-04-13', 'COMFORT ROOM', '', '', 'exit'),
(8, '1004', '01:29:51', '00:00:00', '2024-04-13', 'ROOM', 'EARLY', '66196f963df86.jpg', 'entered'),
(9, '1004', '01:35:24', '00:00:00', '2024-04-13', 'CLINIC', '', '', 'exit'),
(10, '1003', '01:35:46', '00:00:00', '2024-04-13', 'CLINIC', '', '', 'exit'),
(11, '1002', '01:36:58', '00:00:00', '2024-04-13', 'ROOM', 'EARLY', '661971527ac74.jpg', 'entered'),
(12, '1001', '01:39:34', '00:00:00', '2024-04-13', 'ROOM', 'EARLY', '661971dcabf08.jpg', 'entered');

-- --------------------------------------------------------

--
-- Table structure for table `student_info`
--

CREATE TABLE `student_info` (
  `id` int(11) NOT NULL,
  `student_id` varchar(20) NOT NULL,
  `UID` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `section` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_general_ci;

--
-- Dumping data for table `student_info`
--

INSERT INTO `student_info` (`id`, `student_id`, `UID`, `name`, `section`) VALUES
(1, '1001', '90D13F26', 'MAYOL, DANIEL DAVE', 'ST12A6'),
(2, '1002', 'F37D98A6', 'SILAY, HEAVEN HARLEY', 'ST12A6'),
(3, '1003', '920F7151', 'YCONG, JAMES', 'ST12A6'),
(4, '1004', '536C9DA9', 'LOUISE, PRINCESS', 'ST12A6');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_info`
--
ALTER TABLE `student_info`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `student_info`
--
ALTER TABLE `student_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
