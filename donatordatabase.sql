-- phpMyAdmin SQL Dump
-- version 4.0.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 20, 2014 at 10:30 AM
-- Server version: 5.5.35-cll
-- PHP Version: 5.3.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
--

-- --------------------------------------------------------

--
-- Table structure for table `authorize`
--

CREATE TABLE IF NOT EXISTS `authorize` (
  `username` varchar(20) DEFAULT NULL,
  `last_login` date DEFAULT NULL,
  `photo` varchar(30) NOT NULL,
  `serverop` int(30) NOT NULL,
  `guid` bigint(255) NOT NULL,
  `tokens` decimal(50,2) NOT NULL,
  FULLTEXT KEY `username` (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `authorize`
--



-- --------------------------------------------------------

--
-- Table structure for table `banned`
--

CREATE TABLE IF NOT EXISTS `banned` (
  `no_access` varchar(30) DEFAULT NULL,
  `ipaddress` varchar(25) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `banned`
--

INSERT INTO `banned` (`no_access`, `ipaddress`) VALUES
('rofl1024', '12.94.15.106');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(128) DEFAULT NULL,
  `lastname` varchar(128) DEFAULT NULL,
  `username` varchar(42) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `is_admin` int(11) NOT NULL DEFAULT '0',
  `email` varchar(128) NOT NULL DEFAULT '',
  `user_group` int(1) DEFAULT '0' COMMENT '0=member;1=Group1;2=group2;',
  `forgot_hash` varchar(128) DEFAULT NULL,
  `redirect` varchar(128) NOT NULL DEFAULT 'protected.php',
  `status` int(11) DEFAULT '0' COMMENT '0=awaiting activation;1=activated;2=moderator;3=admin;4=banned;',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=303 ;


--
-- Dumping data for table `members`
--



-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `allow_registration` int(1) DEFAULT '1',
  `paypal_email` varchar(128) DEFAULT 'none@none.com',
  `redirect_location` varchar(128) DEFAULT 'welcome.php',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `allow_registration`, `paypal_email`, `redirect_location`) VALUES
(1, 1, 'none@none.com', 'welcome.php');

-- --------------------------------------------------------

--
-- Table structure for table `trash`
--

CREATE TABLE IF NOT EXISTS `trash` (
  `firstname` varchar(20) DEFAULT NULL,
  `lastname` varchar(20) DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `group1` varchar(20) DEFAULT NULL,
  `group2` varchar(20) DEFAULT NULL,
  `group3` varchar(20) DEFAULT NULL,
  `pchange` varchar(1) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `redirect` varchar(100) DEFAULT NULL,
  `verified` varchar(1) DEFAULT NULL,
  `last_login` date DEFAULT NULL,
  `del_date` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
-- 
-- Structure for table `donatorlog`
-- 

DROP TABLE IF EXISTS `donatorlog`;
CREATE TABLE IF NOT EXISTS `donatorlog` (
  `date` varchar(255) NOT NULL,
  `user` varchar(255) NOT NULL,
  `action` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

