-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 08, 2019 at 11:11 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `reservation`
--

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user` int(11) NOT NULL,
  `from` date NOT NULL,
  `to` date NOT NULL,
  `time_from` time NOT NULL,
  `time_to` time NOT NULL,
  `reservation_id` int(11) NOT NULL,
  `reservation_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`id`, `user`, `from`, `to`, `time_from`, `time_to`, `reservation_id`, `reservation_type`, `created_at`, `updated_at`) VALUES
(2, 8, '2019-08-14', '2019-08-24', '13:01:00', '13:01:00', 1, 'App\\Item', '2019-08-14 09:10:53', '2019-08-14 09:10:53'),
(3, 8, '2019-08-15', '2019-08-16', '13:01:00', '01:00:00', 3, 'App\\Item', '2019-08-14 09:10:58', '2019-08-14 09:10:58'),
(4, 8, '2019-08-15', '2019-08-16', '02:01:00', '01:00:00', 6, 'App\\Item', '2019-08-14 09:15:16', '2019-08-14 09:15:16'),
(5, 8, '2019-08-15', '2019-08-16', '14:01:00', '02:01:00', 8, 'App\\Item', '2019-08-14 09:15:42', '2019-08-14 09:15:42'),
(6, 8, '2019-08-14', '2019-09-14', '00:00:00', '00:00:00', 10, 'App\\Item', '2019-08-14 09:15:47', '2019-08-14 09:15:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
