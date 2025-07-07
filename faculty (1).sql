-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 20, 2025 at 11:35 AM
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
-- Database: `faculty`
--

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `experience` int(11) DEFAULT NULL,
  `bio` text NOT NULL,
  `expertise` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `faculty_id` int(10) UNSIGNED DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `name`, `designation`, `department`, `experience`, `bio`, `expertise`, `email`, `phone`, `faculty_id`, `image`) VALUES
(87, 'Ayaj', 'hod', 'Computer Science & Engineering', 1, 'developer', 'java,c ,html,php', 'dype472.ec@unishivaji.ac.in', '9359405574', 113, 'uploads/log.png'),
(88, 'Ram', 'hod', 'cse', 2, 'ehjenfsj', 'java,c ,html,php', 'dype472.e5c@unishivaji.ac.in', '1234567890', 151, 'uploads/close-up-image-programer-working-his-desk-office.jpg'),
(89, 'Dhanashree Lendave', 'CEO', 'Computer Science & Engineering', 3, 'kay tr', 'java', 'dhanulendave1012@gmail.com', '9322234567', 136, 'uploads/log.png');

-- --------------------------------------------------------

--
-- Table structure for table `research_publications`
--

CREATE TABLE `research_publications` (
  `publication_id` int(10) UNSIGNED NOT NULL,
  `publication_name` varchar(255) NOT NULL,
  `project_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `faculty_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `research_publications`
--

INSERT INTO `research_publications` (`publication_id`, `publication_name`, `project_name`, `description`, `faculty_id`) VALUES
(33, 'Ayaj Mulla', 'wefw', 'wefw', 113),
(34, 'Ayaj Mulla', 'rgr', 'trege', 113),
(35, 'Ayaj Mulla', 'Diploma Aspirants', 'study app', 151),
(36, 'Dhanashree Lendave', 'Food Order System', 'You can order any type of food', 136);

-- --------------------------------------------------------

--
-- Table structure for table `signup`
--

CREATE TABLE `signup` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `dt` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `signup`
--

INSERT INTO `signup` (`id`, `username`, `email`, `password`, `dt`) VALUES
(1, 'ayaj', 'ayajmulla2341@gmail.com', '$2y$10$kRfOXkvcULwawNEev3B3KO.LfqqU.c5IoAG2JOI17w/.Ki7MeyWS6', '2025-01-10 13:05:14'),
(2, 'Dhanashree', 'dhanulendave1012@gmail.com', '$2y$10$Vqw2kaFi9kgIR7UA08CJWOLym1fZ7eCwMpmBGD/JYK2gxMOphzKwi', '2025-01-14 10:47:47'),
(3, 'vishal', 'vishal@gmail.com', '$2y$10$05LY2RgviXzarr1CXgFzAO3gSEGzZiwZps3HSHqcASiwo.VIYmyRG', '2025-01-14 23:11:30'),
(4, 'Salim', 'mulsajid3@gmail.com', '$2y$10$hT7qQnhiFVpQfA4bEj0q8.fYKQC8aVTfqkLrbnGpbg6VtmaUEP0ly', '2025-01-21 15:44:45'),
(5, 'ayajmulla ', 'dype472.ec@unishivaji.ac.in', '$2y$10$R4vrHOR3cHpaptXTjy/q7.0nbwJJFRC95bnHCA6LWU9R0zfz6r1Ey', '2025-01-21 16:09:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `research_publications`
--
ALTER TABLE `research_publications`
  ADD PRIMARY KEY (`publication_id`);

--
-- Indexes for table `signup`
--
ALTER TABLE `signup`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `research_publications`
--
ALTER TABLE `research_publications`
  MODIFY `publication_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `signup`
--
ALTER TABLE `signup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
