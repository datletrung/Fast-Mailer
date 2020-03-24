-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 23, 2020 at 09:58 PM
-- Server version: 10.3.22-MariaDB-0+deb10u1
-- PHP Version: 7.3.14-1~deb10u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onetimemail`
--

-- --------------------------------------------------------

--
-- Table structure for table `data`
--

CREATE TABLE `data` (
  `id` int(32) NOT NULL,
  `from` varchar(100) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `to` varchar(64) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `subject` text CHARACTER SET utf8 NOT NULL DEFAULT '',
  `body` mediumtext CHARACTER SET utf8 NOT NULL DEFAULT '',
  `time_receive` varchar(32) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `time_parse` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT current_timestamp(),
  `ip` varchar(32) CHARACTER SET utf8 NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `email`
--

CREATE TABLE `email` (
  `id` int(32) NOT NULL,
  `email` varchar(28) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `ip` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `time_create` datetime NOT NULL DEFAULT current_timestamp(),
  `time_check` datetime NOT NULL DEFAULT current_timestamp(),
  `description` text CHARACTER SET utf8 NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(32) NOT NULL,
  `username` varchar(64) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `password` varchar(64) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `display_name` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `email` varchar(100) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `assigned_email` varchar(28) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `token` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `token_qr` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `position` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `time_create` datetime NOT NULL DEFAULT current_timestamp(),
  `last_login` datetime NOT NULL DEFAULT current_timestamp(),
  `ip` varchar(32) COLLATE utf8_unicode_ci DEFAULT '',
  `description` text CHARACTER SET utf8 NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `display_name`, `email`, `assigned_email`, `token`, `token_qr`, `position`, `status`, `time_create`, `last_login`, `ip`, `description`) VALUES
(1, 'root', 'Tatdat0922', 'Admin', 'root', '', '', '', 1, 0, '2020-03-07 22:39:31', '2020-03-09 18:20:20', '70.77.106.152', ''),
(2, 'admin', 'Tatdat0922', 'Admin', 'admin', '', '', '', 1, 0, '2020-03-07 22:39:57', '2020-03-07 22:39:57', '70.77.106.152', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data`
--
ALTER TABLE `data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email`
--
ALTER TABLE `email`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data`
--
ALTER TABLE `data`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `email`
--
ALTER TABLE `email`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
