-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2017 at 09:49 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wt4`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `ime` varchar(20) COLLATE utf8_slovenian_ci NOT NULL,
  `email` text COLLATE utf8_slovenian_ci NOT NULL,
  `pass` text COLLATE utf8_slovenian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ime`, `email`, `pass`) VALUES
(1, 'mirza', 'miduds@gmail.com', '809d3570023bd56a9d79b93a984f1843'),
(2, 'majamaja', 'maja@gmail.com', 'be50ae3a0b4232052027ede23ccf8513'),
(3, 'Lala', 'lalal@gmail.com', '44cc51139b4b377dc98f46d1f8426c4d'),
(4, 'lala32', 'lalal@gmail.com', '354426a5d1613f8e4f67bfdbaa479967'),
(5, 'dedo', 'dede@gmail.com', '9607210e71bfdf949c2363bc4a321a07'),
(6, 'kiks', 'kiki@gmail.com', '60cb42d3a14e6de7cffabb06b73e965c'),
(7, 'dado', 'dado@gmail.com', '6d2cf3fdab44bdfc1990230f21e4c25d'),
(8, 'mujo', 'mujo@gmail.com', '47024f8ea8d523b4a40fe40596c6ce52'),
(9, 'mumo', 'dado@gmail.com', '3f60c4a7ecc2ee4ac9436182d32bce15'),
(10, 'kik', 'kiki@gmail.com', 'ef592c87c9ff628ae52bf96a796de2f3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ime` (`ime`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
