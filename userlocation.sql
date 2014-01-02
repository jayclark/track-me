-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2013 at 08:08 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `locate`
--

CREATE USER 'locate'@'localhost' IDENTIFIED BY '5RjJtwHA6KcxbjUD';

CREATE DATABASE locate;

GRANT USAGE ON locate.* TO  'locate'@'localhost' IDENTIFIED BY '5RjJtwHA6KcxbjUD' WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;

-- --------------------------------------------------------

--
-- Table structure for table `userlocation`
--

CREATE TABLE IF NOT EXISTS `userlocation` (
  `email` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `lat` varchar(16) DEFAULT NULL,
  `long` varchar(32) DEFAULT NULL,
  `lastUpdated` datetime DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
