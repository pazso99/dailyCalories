# SQL
-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2020 at 04:38 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `healthv1`
--

-- --------------------------------------------------------

--
-- Table structure for table `dailyfoods`
--

CREATE TABLE `dailyfoods` (
  `id` int(11) NOT NULL,
  `date` varchar(40) NOT NULL,
  `user.id` int(11) NOT NULL,
  `food.eaten` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `foods`
--

CREATE TABLE `foods` (
  `id` int(11) NOT NULL,
  `quantity` varchar(50) NOT NULL,
  `name` varchar(60) NOT NULL,
  `carbs` double NOT NULL,
  `fiber` double NOT NULL,
  `sugar` double NOT NULL,
  `protein` double NOT NULL,
  `fat` double NOT NULL,
  `calorie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `birth` date NOT NULL,
  `gender` varchar(30) NOT NULL,
  `height` int(11) NOT NULL,
  `weight` double NOT NULL,
  `activity` varchar(30) NOT NULL,
  `ideal` varchar(30) NOT NULL,
  `idealpercentage` int(11) NOT NULL,
  `bmr` double NOT NULL,
  `bmi` double NOT NULL,
  `lbm` double NOT NULL,
  `bodyfat` double NOT NULL,
  `bodyfatpercentage` double NOT NULL,
  `tdee` int(11) NOT NULL,
  `dailycalorie` int(11) NOT NULL,
  `dailyprotein` double NOT NULL,
  `dailycarbs` double NOT NULL,
  `dailyfat` double NOT NULL,
  `dailyfiber` double NOT NULL,
  `dailysugar` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dailyfoods`
--
ALTER TABLE `dailyfoods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `foodeaten` (`user.id`);

--
-- Indexes for table `foods`
--
ALTER TABLE `foods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dailyfoods`
--
ALTER TABLE `dailyfoods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `foods`
--
ALTER TABLE `foods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dailyfoods`
--
ALTER TABLE `dailyfoods`
  ADD CONSTRAINT `foodeaten` FOREIGN KEY (`user.id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
