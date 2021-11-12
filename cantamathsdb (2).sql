-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2021 at 10:29 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

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
  `questionID` int(5) NOT NULL,
  `qnumber` int(2) NOT NULL,
  `filename` varchar(150) NOT NULL,
  `answer` varchar(200) NOT NULL,
  `levelID` int(2) NOT NULL,
  `yearID` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`questionID`, `qnumber`, `filename`, `answer`, `levelID`, `yearID`) VALUES
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
(68, 1, '2013-7-1.jpg', '1089', 1, 42),
(69, 2, '2013-7-2.jpg', '26', 1, 42),
(70, 3, '2013-7-3.jpg', '15', 1, 42),
(71, 4, '2013-7-4.jpg', '1/32', 1, 42),
(72, 5, '2013-7-5.jpg', '8 years', 1, 42),
(73, 6, '2013-7-6.jpg', '28 units', 1, 42),
(74, 7, '2013-7-7.jpg', '930°', 1, 42),
(75, 8, '2013-7-8.jpg', '3h 15m', 1, 42),
(76, 9, '2013-7-9.jpg', '36', 1, 42),
(77, 10, '2013-7-10.jpg', '88 minutes', 1, 42),
(78, 11, '2013-7-11.jpg', '24', 1, 42),
(79, 12, '2013-7-12.jpg', '1856', 1, 42),
(80, 14, '2013-7-14.jpg', 'Brooke', 1, 42),
(81, 15, '2013-7-15.jpg', '59', 1, 42),
(82, 16, '2013-7-16.jpg', '168 cm2', 1, 42),
(83, 17, '2013-7-17.jpg', '3', 1, 42),
(84, 18, '2013-7-18.jpg', '169cm2', 1, 42),
(85, 19, '2013-7-19.jpg', '24 minutes', 1, 42),
(86, 20, '2013-7-20.jpg', '42cm', 1, 42),
(87, 1, '2012-10-1.jpg', '231', 4, 41),
(93, 1, '2011-7-1.jpg', '36', 1, 40),
(94, 2, '2011-7-2.jpg', '2.25', 1, 40),
(95, 3, '2011-7-3.jpg', '3', 1, 40),
(96, 4, '2011-7-4.jpg', 'Monday', 1, 40),
(97, 5, '2011-7-5.jpg', '1/4', 1, 40),
(98, 6, '2011-7-6.jpg', '167', 1, 40),
(99, 7, '2011-7-7.jpg', '1.50', 1, 40),
(100, 8, '2011-7-8.jpg', '58', 1, 40),
(101, 9, '2011-7-9.jpg', '119', 1, 40),
(102, 10, '2011-7-10.jpg', '8000', 1, 40),
(103, 11, '2011-7-11.jpg', '32', 1, 40),
(104, 12, '2011-7-12.jpg', '12', 1, 40),
(105, 13, '2011-7-13.jpg', '2520', 1, 40),
(106, 14, '2011-7-14.jpg', '72', 1, 40),
(107, 15, '2011-7-15.jpg', '26', 1, 40),
(108, 16, '2011-7-16.jpg', '19', 1, 40),
(109, 17, '2011-7-17.jpg', '64', 1, 40),
(110, 18, '2011-7-18.jpg', '336', 1, 40),
(111, 19, '2011-7-19.jpg', '2', 1, 40),
(112, 20, '2011-7-20.jpg', '255', 1, 40);

-- --------------------------------------------------------

--
-- Table structure for table `questiontag`
--

CREATE TABLE `questiontag` (
  `ID` int(9) NOT NULL,
  `questionID` int(5) NOT NULL,
  `tagID` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `questiontag`
--

INSERT INTO `questiontag` (`ID`, `questionID`, `tagID`) VALUES
(56, 40, 21),
(57, 41, 47),
(58, 41, 49),
(59, 42, 36),
(61, 42, 47),
(62, 42, 49),
(63, 43, 36),
(64, 43, 42),
(65, 44, 47),
(66, 44, 48),
(67, 45, 51),
(68, 45, 54),
(69, 46, 24),
(70, 46, 51),
(71, 47, 42),
(72, 47, 44),
(73, 47, 47),
(74, 48, 21),
(75, 48, 51),
(76, 48, 54),
(78, 49, 36),
(79, 49, 46),
(80, 49, 54),
(81, 50, 54),
(82, 50, 56),
(83, 50, 59),
(84, 51, 21),
(85, 51, 56),
(86, 51, 60),
(87, 52, 25),
(88, 52, 36),
(89, 52, 45),
(90, 53, 21),
(91, 53, 29),
(92, 54, 21),
(93, 54, 24),
(94, 54, 32),
(95, 54, 54),
(96, 55, 51),
(97, 55, 54),
(98, 56, 21),
(99, 56, 26),
(100, 57, 21),
(101, 57, 27),
(102, 57, 29),
(103, 57, 51),
(104, 57, 54),
(105, 58, 36),
(106, 58, 42),
(107, 59, 36),
(108, 59, 41),
(109, 59, 42),
(110, 68, 21),
(111, 69, 21),
(112, 69, 25),
(113, 69, 47),
(114, 69, 50),
(115, 70, 51),
(116, 70, 52),
(117, 71, 21),
(118, 71, 29),
(119, 71, 36),
(120, 71, 42),
(121, 72, 21),
(122, 72, 29),
(123, 72, 51),
(124, 72, 54),
(125, 73, 51),
(126, 73, 53),
(127, 73, 55),
(128, 74, 36),
(129, 74, 46),
(130, 74, 47),
(131, 74, 48),
(132, 75, 36),
(133, 75, 46),
(134, 76, 47),
(135, 76, 49),
(136, 77, 21),
(138, 78, 21),
(139, 78, 51),
(140, 79, 21),
(141, 80, 36),
(142, 81, 21),
(143, 81, 51),
(144, 81, 54),
(145, 82, 36),
(146, 82, 41),
(147, 82, 42),
(148, 83, 56),
(149, 84, 36),
(150, 84, 42),
(151, 84, 41),
(152, 85, 21),
(153, 85, 31),
(154, 77, 31),
(155, 86, 36),
(156, 86, 41),
(157, 87, 51),
(158, 87, 52),
(159, 20, 56),
(160, 20, 59),
(161, 21, 36),
(162, 21, 42),
(163, 21, 47),
(164, 21, 49),
(165, 22, 51),
(166, 22, 54),
(167, 23, 21),
(168, 23, 27),
(169, 24, 36),
(170, 24, 45),
(171, 25, 36),
(172, 25, 42),
(173, 26, 51),
(174, 26, 53),
(175, 26, 55),
(176, 27, 21),
(177, 27, 29),
(178, 28, 21),
(179, 28, 51),
(180, 28, 54),
(181, 34, 36),
(182, 34, 44),
(183, 35, 21),
(184, 35, 25),
(185, 36, 21),
(186, 36, 29),
(187, 37, 21),
(188, 37, 29),
(189, 38, 56),
(190, 38, 59),
(191, 93, 21),
(192, 93, 24),
(193, 93, 51),
(194, 93, 52),
(195, 94, 21),
(196, 94, 51),
(197, 95, 21),
(198, 95, 51),
(199, 96, 36),
(200, 96, 46),
(201, 97, 56),
(202, 97, 59),
(203, 98, 47),
(204, 98, 48),
(205, 99, 21),
(206, 99, 51),
(207, 99, 54),
(208, 100, 21),
(209, 101, 21),
(210, 101, 25),
(211, 101, 51),
(212, 101, 55),
(213, 102, 21),
(214, 102, 24),
(215, 103, 51),
(216, 103, 53),
(217, 104, 21),
(218, 104, 51),
(219, 105, 36),
(220, 105, 38),
(221, 105, 51),
(222, 105, 54),
(223, 106, 21),
(224, 106, 31),
(225, 107, 51),
(226, 107, 54),
(227, 108, 21),
(228, 108, 33),
(229, 109, 51),
(230, 110, 36),
(231, 110, 41),
(232, 110, 42),
(233, 111, 47),
(234, 112, 21),
(235, 40, 28);

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE `tag` (
  `tagID` int(4) NOT NULL,
  `tagname` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`tagID`, `tagname`) VALUES
(21, 'Number'),
(24, 'Products'),
(25, 'Sums'),
(26, 'BEDMAS'),
(27, 'Percentages'),
(28, 'Decimals'),
(29, 'Fractions'),
(30, 'Ratios'),
(31, 'Rates'),
(32, 'Factors'),
(33, 'Primes'),
(34, 'Faction laws'),
(35, 'Logic'),
(36, 'Measurement'),
(37, 'Units'),
(38, 'Capacity'),
(39, 'Mass'),
(40, 'Length'),
(41, 'Perimeter'),
(42, 'Area'),
(43, 'Volume'),
(44, 'Circles'),
(45, 'Bearings'),
(46, 'Time'),
(47, 'Geometry'),
(48, 'Angles'),
(49, 'Polygons'),
(50, '3D Shapes'),
(51, 'Algebra'),
(52, 'Equations'),
(53, 'Patterns'),
(54, 'Word Problems'),
(55, 'Consecutive Terms'),
(56, 'Statistics'),
(57, 'Graphs'),
(58, 'Data'),
(59, 'Probability'),
(60, 'Means'),
(61, 'Medians'),
(62, 'Modes'),
(63, 'Ranges');

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
  MODIFY `questionID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `questiontag`
--
ALTER TABLE `questiontag`
  MODIFY `ID` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=236;

--
-- AUTO_INCREMENT for table `tag`
--
ALTER TABLE `tag`
  MODIFY `tagID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `year`
--
ALTER TABLE `year`
  MODIFY `yearID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
