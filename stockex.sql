-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2017 at 02:05 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stockex`
--

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `transaction` varchar(255) NOT NULL,
  `symbol` varchar(255) NOT NULL,
  `shares` int(11) NOT NULL,
  `price` float NOT NULL,
  `cost` float NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`id`, `user_id`, `transaction`, `symbol`, `shares`, `price`, `cost`, `time`) VALUES
(1, 1, 'BUY', 'amzn', 1, 884.67, 884.67, '2017-04-14 11:59:01'),
(2, 1, 'BUY', 'dog', 1, 18.28, 18.28, '2017-04-14 12:10:50'),
(3, 1, 'BUY', 'dog', 1, 18.28, 18.28, '2017-04-14 12:12:05'),
(4, 1, 'BUY', 'dog', 1, 18.28, 18.28, '2017-04-14 12:13:24'),
(5, 1, 'BUY', 'dog', 1, 18.28, 18.28, '2017-04-14 12:18:04'),
(6, 1, 'BUY', 'dog', 1, 18.28, 18.28, '2017-04-14 12:20:17'),
(7, 1, 'BUY', 'dog', 5, 18.28, 91.4, '2017-04-14 12:32:49'),
(8, 1, 'SELL', 'dog', 13, 18.28, 237.64, '2017-04-14 18:26:16'),
(9, 1, 'BUY', 'amzn', 5, 884.67, 4423.35, '2017-04-14 19:00:25'),
(10, 1, 'SELL', 'amzn', 5, 884.67, 4423.35, '2017-04-14 19:01:43'),
(11, 2, 'BUY', 'yhoo', 100, 46.9, 4690, '2017-04-14 19:05:24'),
(12, 2, 'BUY', 'atnm', 10000, 1.47, 14700, '2017-04-14 19:06:19'),
(13, 2, 'BUY', 'tsla', 100, 310.83, 31083, '2017-05-21 10:50:57'),
(14, 2, 'SELL', 'atnm', 10000, 1.38, 13800, '2017-05-21 10:55:18');

-- --------------------------------------------------------

--
-- Table structure for table `portfolio`
--

CREATE TABLE `portfolio` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `symbol` varchar(255) NOT NULL,
  `shares` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `portfolio`
--

INSERT INTO `portfolio` (`id`, `user_id`, `symbol`, `shares`) VALUES
(4, 2, 'yhoo', 100),
(6, 2, 'tsla', 100);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `cash` float NOT NULL DEFAULT '10000'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `cash`) VALUES
(2, 'Iaro', '$2y$10$LN8AoHEbsZlRt1.JeEkhBeemMmt5VSJCEck5BMCLbbSPODrIoz3BG', 63327),
(8, 'billy', '$2y$10$Foh131tZnkTFr.HwoOLEjeexhQdjsJ9CFtfSX/hrHsmTwyzLP1YvK', 10000),
(25, 'qw', '$2y$10$isytZbbT34P7asYX/hsiKuZjEywbBP2PILW2FEI4fSBCx5U0QpiZO', 10000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `portfolio`
--
ALTER TABLE `portfolio`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `symbol` (`symbol`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `portfolio`
--
ALTER TABLE `portfolio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
