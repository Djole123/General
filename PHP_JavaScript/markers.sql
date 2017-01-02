-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2016 at 08:52 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `doctorwholocator`
--

-- --------------------------------------------------------

--
-- Table structure for table `markers`
--

CREATE TABLE `markers` (
  `ID` int(11) NOT NULL,
  `x` double NOT NULL,
  `y` double NOT NULL,
  `name` varchar(15) NOT NULL,
  `review` varchar(150) NOT NULL,
  `rating` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `markers`
--

INSERT INTO `markers` (`ID`, `x`, `y`, `name`, `review`, `rating`) VALUES
(1, 43.7238, 20.6873, 'Kraljevo', 'Only one person as witness, likely an attention grab.', '1 Star'),
(2, 43.6126, 20.6572, 'Meljanica', 'Very cool! He left crop circles and everything!', '5 Stars'),
(3, 43.25902, -79.92064, 'McMaster', 'Marker was relatively accurate but was not witnessed by very many people.', '3 Stars'),
(5, 43.6674, 20.6917, 'Ribnica', 'This place is cool, it''s where my mother was born and where I grew up.', '4 Stars'),
(6, 48.8566, 2.3522, 'Paris', 'This place reminds me of the Kalos region!', '5 Stars'),
(7, 19.8968, 155.5828, 'Alola', 'This area really reminds me of Hawaii.', '3 Stars'),
(8, 40.7128, -74.0059, 'Unova Region', 'Blah Blah Blah.', '3 Stars');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `markers`
--
ALTER TABLE `markers`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `markers`
--
ALTER TABLE `markers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
