-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2021 at 04:53 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cantamathssdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `questionID` int(10) NOT NULL,
  `filename` varchar(1500) NOT NULL,
  `answer` varchar(200) NOT NULL,
  `level` int(11) NOT NULL,
  `year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`questionID`, `filename`, `answer`, `level`, `year`) VALUES
(1, 'q2012.10.1.jpg', 'a2012.10.1.jpg', 10, 2012),
(2, 'q2012.10.2.jpg', 'a2012.10.2.jpg', 8, 2015),
(3, 'q2012.10.3.jpg', 'a2012.10.3.jpg', 10, 2012),
(4, 'q2012.10.4.jpg', 'a2012.10.4.jpg', 9, 2009),
(5, 'q2012.10.5.jpg', 'a2012.10.5.jpg', 7, 2010);

-- --------------------------------------------------------

--
-- Table structure for table `questiontag`
--

CREATE TABLE `questiontag` (
  `ID` int(11) NOT NULL,
  `questionID` int(11) NOT NULL,
  `tagID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE `tag` (
  `tagID` int(10) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` int(5) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(150) NOT NULL,
  `email` varchar(100) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `access` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `username`, `password`, `email`, `firstname`, `lastname`, `access`) VALUES
(1, 'admin', '$2y$10$mgmcArYsDGPSptpkB5LmCuDPp1e0v5TyiXBxsODW8ctT2CMBDUsfu', '', 'Admin', 'User', 2),
(2, 'active', '$2y$10$qrK.Nkt/RONXFKkjoQaFBuMKyxoSPJxs8/hN3xiNv7l3JxSae6k6.', '', 'Active', 'User', 1),
(3, 'inactive', '$2y$10$1Z3kOFY0yYYbnltusRpMxeOy6qfH6.YF4BsMBkyf/.qTQ4or2llUe', '', 'Inactive', 'User', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`questionID`);

--
-- Indexes for table `questiontag`
--
ALTER TABLE `questiontag`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`tagID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `questionID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `questiontag`
--
ALTER TABLE `questiontag`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tag`
--
ALTER TABLE `tag`
  MODIFY `tagID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
