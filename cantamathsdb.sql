-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 10, 2021 at 10:48 AM
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
-- Database: `cantamathsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `access`
--

CREATE TABLE `access` (
  `accessID` int(3) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `access`
--

INSERT INTO `access` (`accessID`, `name`) VALUES
(1, 'Admin'),
(2, 'Active'),
(3, 'Inactive');

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `levelID` int(2) NOT NULL,
  `levelname` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`levelID`, `levelname`) VALUES
(1, 7),
(2, 8),
(3, 9),
(4, 10);

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `questionID` int(10) NOT NULL,
  `qnumber` int(2) NOT NULL,
  `filename` varchar(1500) NOT NULL,
  `answer` varchar(200) NOT NULL,
  `levelID` int(2) NOT NULL,
  `yearID` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`questionID`, `qnumber`, `filename`, `answer`, `levelID`, `yearID`) VALUES
(19, 1, '2012-10-1.jpg', '312', 4, 41),
(20, 2, '2012-10-2.jpg', '1/3', 4, 41),
(21, 3, '2012-10-3.jpg', '126', 4, 41),
(22, 4, '2012-10-4.jpg', '16', 4, 41),
(23, 5, '2012-10-5.jpg', '150', 4, 41),
(24, 6, '2012-10-6.jpg', '(-5, -2)', 4, 41),
(25, 7, '2012-10-7.jpg', '7', 4, 41),
(26, 8, '2012-10-8.jpg', '504', 4, 41),
(27, 9, '2012-10-9.jpg', '2 43/60', 4, 41),
(28, 10, '2012-10-10.jpg', '88', 4, 41),
(29, 11, '2012-10-11.jpg', '144', 4, 41),
(30, 12, '2012-10-12.jpg', '385', 4, 41),
(31, 13, '2012-10-13.jpg', '9', 4, 41),
(32, 14, '2012-10-14.jpg', '10', 4, 41),
(33, 15, '2012-10-15.jpg', 'green', 4, 41),
(34, 16, '2012-10-16.jpg', '15:1', 4, 41),
(35, 17, '2012-10-17.jpg', '2500', 4, 41),
(36, 18, '2012-10-18.jpg', '12', 4, 41),
(37, 19, '2012-10-19.jpg', '2 5/16', 4, 41),
(38, 20, '2012-10-20.jpg', '1/5', 4, 41),
(40, 1, '2014-9-1.jpg', '181.26', 3, 43),
(41, 2, '2014-9-2.jpg', '36', 3, 43),
(42, 3, '2014-9-3.jpg', '216', 3, 43),
(43, 4, '2014-9-4.jpg', '12.5', 3, 43),
(44, 5, '2014-9-5.jpg', '124', 3, 43),
(45, 6, '2014-9-6.jpg', '15', 3, 43),
(46, 7, '2014-9-7.jpg', '24', 3, 43),
(47, 8, '2014-9-8.jpg', '36π', 3, 43),
(48, 9, '2014-9-9.jpg', '2124', 3, 43),
(49, 10, '2014-9-10.jpg', '5', 3, 43),
(50, 11, '2014-9-11.jpg', '13/18', 3, 43),
(51, 12, '2014-9-12.jpg', '97', 3, 43),
(52, 13, '2014-9-13.jpg', '6', 3, 43),
(53, 14, '2014-9-14.jpg', '848', 3, 43),
(54, 15, '2014-9-15.jpg', '1.2', 3, 43),
(55, 16, '2014-9-16.jpg', '16', 3, 43),
(56, 17, '2014-9-17.jpg', '6', 3, 43),
(57, 18, '2014-9-18.jpg', '600', 3, 43),
(58, 19, '2014-9-19.jpg', '2500', 3, 43),
(59, 20, '2014-9-20.jpg', '120', 3, 43),
(65, 1, '2020-10-1.jpg', '12', 4, 49),
(68, 1, '7-2013-1.jpg', '1089', 1, 42),
(69, 2, '7-2013-2.jpg', '26', 1, 42),
(70, 3, '7-2013-3.jpg', '15', 1, 42),
(71, 4, '7-2013-4.jpg', '1/32', 1, 42),
(72, 5, '7-2013-5.jpg', '8 years', 1, 42),
(73, 6, '7-2013-6.jpg', '28 units', 1, 42),
(74, 7, '7-2013-7.jpg', '930°', 1, 42),
(75, 8, '7-2013-8.jpg', '3h 15m', 1, 42),
(76, 9, '7-2013-9.jpg', '36', 1, 42),
(77, 10, '7-2013-10.jpg', '88 minutes', 1, 42),
(78, 11, '7-2013-11.jpg', '24', 1, 42),
(79, 12, '7-2013-12.jpg', '1856', 1, 42),
(80, 14, '7-2013-14.jpg', 'Brooke', 1, 42),
(81, 15, '7-2013-15.jpg', '59', 1, 42),
(82, 16, '7-2013-16.jpg', '168 cm2', 1, 42),
(83, 17, '7-2013-17.jpg', '3', 1, 42),
(84, 18, '7-2013-18.jpg', '169cm2', 1, 42),
(85, 19, '7-2013-19.jpg', '24 minutes', 1, 42),
(86, 20, '7-2013-20.jpg', '42cm', 1, 42);

-- --------------------------------------------------------

--
-- Table structure for table `questiontag`
--

CREATE TABLE `questiontag` (
  `ID` int(11) NOT NULL,
  `questionID` int(11) NOT NULL,
  `tagID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `questiontag`
--

INSERT INTO `questiontag` (`ID`, `questionID`, `tagID`) VALUES
(7, 19, 1),
(8, 19, 3),
(9, 20, 6),
(10, 20, 5),
(11, 21, 2),
(12, 22, 1),
(13, 22, 3),
(14, 23, 3),
(15, 23, 5),
(16, 24, 2),
(17, 25, 2),
(18, 26, 1),
(19, 26, 2),
(20, 26, 3),
(21, 27, 5);

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE `tag` (
  `tagID` int(4) NOT NULL,
  `tagname` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`tagID`, `tagname`) VALUES
(1, 'Algebra'),
(2, 'Geometry'),
(3, 'Arithmetic'),
(4, 'Statistics'),
(5, 'Fractions'),
(6, 'Probability');

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
  `accessID` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `username`, `password`, `email`, `firstname`, `lastname`, `accessID`) VALUES
(1, 'admin', '$2y$10$mgmcArYsDGPSptpkB5LmCuDPp1e0v5TyiXBxsODW8ctT2CMBDUsfu', '', 'Admin', 'User', 1),
(2, 'active', '$2y$10$qrK.Nkt/RONXFKkjoQaFBuMKyxoSPJxs8/hN3xiNv7l3JxSae6k6.', '', 'Active', 'User', 2),
(3, 'inactive', '$2y$10$1Z3kOFY0yYYbnltusRpMxeOy6qfH6.YF4BsMBkyf/.qTQ4or2llUe', '', 'Inactive', 'User', 3);

-- --------------------------------------------------------

--
-- Table structure for table `year`
--

CREATE TABLE `year` (
  `yearID` int(3) NOT NULL,
  `yearname` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `year`
--

INSERT INTO `year` (`yearID`, `yearname`) VALUES
(1, 1972),
(2, 1973),
(3, 1974),
(4, 1975),
(5, 1976),
(6, 1977),
(7, 1978),
(8, 1979),
(9, 1980),
(10, 1981),
(11, 1982),
(12, 1983),
(13, 1984),
(14, 1985),
(15, 1986),
(16, 1987),
(17, 1988),
(18, 1989),
(19, 1990),
(20, 1991),
(21, 1992),
(22, 1993),
(23, 1994),
(24, 1995),
(25, 1996),
(26, 1997),
(27, 1998),
(28, 1999),
(29, 2000),
(30, 2001),
(31, 2002),
(32, 2003),
(33, 2004),
(34, 2005),
(35, 2006),
(36, 2007),
(37, 2008),
(38, 2009),
(39, 2010),
(40, 2011),
(41, 2012),
(42, 2013),
(43, 2014),
(44, 2015),
(45, 2016),
(46, 2017),
(47, 2018),
(48, 2019),
(49, 2020),
(50, 2021),
(51, 2022);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access`
--
ALTER TABLE `access`
  ADD PRIMARY KEY (`accessID`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`levelID`);

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
-- Indexes for table `year`
--
ALTER TABLE `year`
  ADD PRIMARY KEY (`yearID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access`
--
ALTER TABLE `access`
  MODIFY `accessID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `levelID` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `questionID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `questiontag`
--
ALTER TABLE `questiontag`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tag`
--
ALTER TABLE `tag`
  MODIFY `tagID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `year`
--
ALTER TABLE `year`
  MODIFY `yearID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
