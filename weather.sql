-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 14, 2019 at 01:51 PM
-- Server version: 5.7.21
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `weather`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `adid` varchar(15) COLLATE utf8_bin NOT NULL,
  `password` varchar(64) COLLATE utf8_bin NOT NULL,
  `fname` varchar(15) COLLATE utf8_bin NOT NULL,
  `lname` varchar(15) COLLATE utf8_bin NOT NULL,
  `email` varchar(30) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`adid`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adid`, `password`, `fname`, `lname`, `email`) VALUES
('admin_001', '236521c253d1df3484669ee2146d27fe71db79362bedc5f75c51b908a12cd050', 'Sylvie', 'Sylvester', 'oinkbhawna@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `blocked`
--

DROP TABLE IF EXISTS `blocked`;
CREATE TABLE IF NOT EXISTS `blocked` (
  `usrid` varchar(10) COLLATE utf8_bin NOT NULL,
  `block` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`usrid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `blocked`
--

INSERT INTO `blocked` (`usrid`, `block`) VALUES
('oink007', 0),
('oink001', 0),
('prad', 0);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `email` varchar(30) COLLATE utf8_bin NOT NULL,
  `fname` varchar(10) COLLATE utf8_bin NOT NULL,
  `lname` varchar(10) COLLATE utf8_bin NOT NULL,
  `query` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
CREATE TABLE IF NOT EXISTS `login` (
  `usrid` varchar(10) COLLATE utf8_bin NOT NULL,
  `password` varchar(64) COLLATE utf8_bin NOT NULL,
  `email` varchar(30) COLLATE utf8_bin NOT NULL,
  `fname` varchar(15) COLLATE utf8_bin NOT NULL,
  `lname` varchar(15) COLLATE utf8_bin NOT NULL,
  `purpose` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`usrid`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`usrid`, `password`, `email`, `fname`, `lname`, `purpose`) VALUES
('oink007', '236521c253d1df3484669ee2146d27fe71db79362bedc5f75c51b908a12cd050', 'oinksharma@gmail.com', 'Dragon', 'Doom', 'Agriculture'),
('oink001', '65e84be33532fb784c48129675f9eff3a682b27168c0ea744b2cf58ee02337c5', 'dfvdvf@hsds.com', 'Onkar', 'Sharma', 'General'),
('prad', 'a4cc3b3e07f5ff505fb53b2fdeb92be82c3ebf613fa037b911245345a9ddb9c3', 'praduman@gmail.com', 'Praduman', 'Rana', 'Agricultural');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

DROP TABLE IF EXISTS `profile`;
CREATE TABLE IF NOT EXISTS `profile` (
  `usrid` varchar(10) COLLATE utf8_bin NOT NULL,
  `accpic` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT 'deff.jpg'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`usrid`, `accpic`) VALUES
('oink007', 'nier-automata-screenshot-hd-03.jpg'),
('admin_001', 'nier-automata-screenshot-hd-03.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `wdata`
--

DROP TABLE IF EXISTS `wdata`;
CREATE TABLE IF NOT EXISTS `wdata` (
  `location` varchar(50) COLLATE utf8_bin NOT NULL,
  `date_time` datetime NOT NULL,
  `temp` float UNSIGNED DEFAULT NULL,
  `clouds` float UNSIGNED DEFAULT NULL,
  `humidity` float UNSIGNED DEFAULT NULL,
  `wind` float UNSIGNED DEFAULT NULL,
  `pressure` float UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`location`,`date_time`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `wdata`
--

INSERT INTO `wdata` (`location`, `date_time`, `temp`, `clouds`, `humidity`, `wind`, `pressure`) VALUES
('Paraguay', '2019-03-26 15:00:00', 28.42, 0, 94, 0.97, 1015.47),
('Vienna', '2019-03-26 18:00:00', 6.99, 12, 61, 5.56, 1024.42);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
