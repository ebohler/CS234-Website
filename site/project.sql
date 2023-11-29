-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Nov 29, 2023 at 01:26 AM
-- Server version: 5.7.24
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `favid` int(7) NOT NULL,
  `id` int(7) NOT NULL DEFAULT '1',
  `song` varchar(100) NOT NULL,
  `genre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `favorites`
--

INSERT INTO `favorites` (`favid`, `id`, `song`, `genre`) VALUES
(1, 25, 'Stayin\' Alive', 'Rock'),
(2, 25, 'Through The Wire', 'Rap'),
(3, 27, 'Take Me Out', 'Rock'),
(4, 27, 'Free Bird', 'Rock'),
(5, 27, 'Otis', 'Rap');

-- --------------------------------------------------------

--
-- Table structure for table `info`
--

CREATE TABLE `info` (
  `infoid` int(7) NOT NULL,
  `id` int(7) NOT NULL DEFAULT '1',
  `weather` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `info`
--

INSERT INTO `info` (`infoid`, `id`, `weather`, `state`) VALUES
(1, 25, 'Sunny', 'IL'),
(2, 25, 'Cloudy', 'AR'),
(3, 27, 'Sunny', 'CA'),
(4, 27, 'Cloudy', 'MO'),
(5, 27, 'Sunny', 'AZ'),
(6, 28, 'Cloudy', 'CA');

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `id` int(7) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`id`, `username`, `password`) VALUES
(25, 'admin', '$2y$10$f1XwQ9YrcHlk.nO9SpARFO8B3.3IsX7WcU5aMjUoQwG8McmgSuxEu'),
(27, 'THEUSER', '$2y$10$TtobwvK02WIhbRFglLdFwOwSbRCyHH2lsyFGlUcg9vYhGnBWO/TIW'),
(28, 'dummy', '$2y$10$FghzbLxSwuViCEkfAwwZVeBTC5k17/IMw5j/eACaXLq1SB0vQUQSi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`favid`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `info`
--
ALTER TABLE `info`
  ADD PRIMARY KEY (`infoid`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `favid` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `info`
--
ALTER TABLE `info`
  MODIFY `infoid` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_ibfk_1` FOREIGN KEY (`id`) REFERENCES `registration` (`id`);

--
-- Constraints for table `info`
--
ALTER TABLE `info`
  ADD CONSTRAINT `info_ibfk_1` FOREIGN KEY (`id`) REFERENCES `registration` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
