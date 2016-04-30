-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2016 at 03:40 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projectweb`
--

-- --------------------------------------------------------

--
-- Table structure for table `examaccess`
--

CREATE TABLE `examaccess` (
  `number_exam` int(11) NOT NULL,
  `exam_title` varchar(50) NOT NULL,
  `password` varchar(50) DEFAULT NULL,
  `status` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `examaccess`
--

INSERT INTO `examaccess` (`number_exam`, `exam_title`, `password`, `status`) VALUES
(35, 'second exam', '55', '1'),
(36, 'introdcution', '', '1'),
(37, 'quiz5', '', '1');

-- --------------------------------------------------------

--
-- Table structure for table `examq`
--

CREATE TABLE `examq` (
  `no_exam` int(11) NOT NULL,
  `examTitle` varchar(50) NOT NULL,
  `q1` varchar(50) DEFAULT NULL,
  `q2` varchar(50) DEFAULT NULL,
  `q3` varchar(50) DEFAULT NULL,
  `q4` varchar(50) DEFAULT NULL,
  `q5` varchar(50) DEFAULT NULL,
  `q6` varchar(50) DEFAULT NULL,
  `q7` varchar(50) DEFAULT NULL,
  `q8` varchar(50) DEFAULT NULL,
  `q9` varchar(50) DEFAULT NULL,
  `q10` varchar(50) DEFAULT NULL,
  `q11` varchar(50) DEFAULT NULL,
  `q12` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `examq`
--

INSERT INTO `examq` (`no_exam`, `examTitle`, `q1`, `q2`, `q3`, `q4`, `q5`, `q6`, `q7`, `q8`, `q9`, `q10`, `q11`, `q12`) VALUES
(8, 'introdcution', 'fdgfdsg', 'fdgfdsg', 'dsfgfdsg', 'fdgfdsgfd', 'dfgsdgfd', 'dfsgfdsgfd', 'fdgsfdsg', 'dsgfds', '', '', '', ''),
(9, 'second exam', '1st quetions', 'sfdsfsa', 'kdlsagfjdsakfjds', 'klsdgfd', 'fdslkgfdl', 'fdslkgfdl', 'sfgfsd', '', '', '', '', ''),
(11, 'quiz2', 'sdfsd', 'kdslfgmndlsjk', 'kjldsnjlfdsnmlf', 'fkldgmnlfsdgm', 'fdklsgmsdklfg', 'fdklsgmsdklfg', 'kldsgfnmlkds', 'slkdgdnflsdkagnasd', 'klsdfgnmlasdgn', 'skldfgnmdlskagnldsdl', 'lksfgmlsdkgn', 'asdfasfsda'),
(12, 'quiz5', 'what is class', 'what is method', 'why we use private method', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `no` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `firstname` varchar(30) DEFAULT NULL,
  `lastname` varchar(30) DEFAULT NULL,
  `course` varchar(20) NOT NULL,
  `section` varchar(20) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `email` varchar(120) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`no`, `id`, `firstname`, `lastname`, `course`, `section`, `password`, `email`) VALUES
(1, 212, 'sulaiman', 'aloraini', 'cs101', '321', '12345', 'sulaiman@aloraini.com'),
(2, 33, 'ali', 'omar', 'cs102', '123', '12345', 'ali@omar.com'),
(3, 3344, 'samy', 'ibrahem', 'cs102', '12', '12345', 'ibrahem@yahoo.com');

-- --------------------------------------------------------

--
-- Table structure for table `student_anw`
--

CREATE TABLE `student_anw` (
  `id` int(11) DEFAULT NULL,
  `exam_title` varchar(100) NOT NULL,
  `q1` mediumtext,
  `q2` mediumtext,
  `q3` mediumtext,
  `q4` mediumtext,
  `q5` mediumtext,
  `q6` mediumtext,
  `q7` mediumtext,
  `q8` mediumtext,
  `q9` mediumtext,
  `q10` mediumtext,
  `q11` mediumtext,
  `q12` mediumtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_anw`
--

INSERT INTO `student_anw` (`id`, `exam_title`, `q1`, `q2`, `q3`, `q4`, `q5`, `q6`, `q7`, `q8`, `q9`, `q10`, `q11`, `q12`) VALUES
(212, 'introdcution', 'rgfdgfds', 'fdsgfd', 'dfgsfd', 'fdsgfdsg', 'fdsgfdsg', 'dfsgfds', 'dfgfdsg', 'fdgfdsgf', 'no question', 'no question', 'no question', 'no question'),
(212, 'quiz5', 'class is : ', 'method is : ', 'to hide the data', 'no question', 'no question', 'no question', 'no question', 'no question', 'no question', 'no question', 'no question', 'no question'),
(33, 'quiz5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `student_grade`
--

CREATE TABLE `student_grade` (
  `id` int(11) DEFAULT NULL,
  `exam_title` varchar(100) NOT NULL,
  `grade` int(11) NOT NULL,
  `q1` mediumtext,
  `q2` mediumtext,
  `q3` mediumtext,
  `q4` mediumtext,
  `q5` mediumtext,
  `q6` mediumtext,
  `q7` mediumtext,
  `q8` mediumtext,
  `q9` mediumtext,
  `q10` mediumtext,
  `q11` mediumtext,
  `q12` mediumtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_grade`
--

INSERT INTO `student_grade` (`id`, `exam_title`, `grade`, `q1`, `q2`, `q3`, `q4`, `q5`, `q6`, `q7`, `q8`, `q9`, `q10`, `q11`, `q12`) VALUES
(33, 'quiz5', 44, 'rtrewt', 'rewtrewt', 'retre', 'ertrewt', 'retre', 'retre', 'ertre', 'ertre', 'retre', 'ertre', 'ewrte', 'ertre');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `id` int(11) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`id`, `firstname`, `lastname`, `password`) VALUES
(1, 'anis', 'koubaa', '12345');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `examaccess`
--
ALTER TABLE `examaccess`
  ADD PRIMARY KEY (`number_exam`);

--
-- Indexes for table `examq`
--
ALTER TABLE `examq`
  ADD PRIMARY KEY (`no_exam`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`no`,`id`),
  ADD UNIQUE KEY `no` (`no`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `examaccess`
--
ALTER TABLE `examaccess`
  MODIFY `number_exam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `examq`
--
ALTER TABLE `examq`
  MODIFY `no_exam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
