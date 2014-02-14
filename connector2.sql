-- phpMyAdmin SQL Dump
-- version 4.0.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 14, 2014 at 03:57 AM
-- Server version: 5.6.11-log
-- PHP Version: 5.3.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `connector`
--
CREATE DATABASE IF NOT EXISTS `connector` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `connector`;

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `ip_address` varchar(16) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `user_agent` varchar(150) COLLATE utf8_bin NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('4d7e629a017cd41b435f4e6e65f339ea', '127.0.0.1', 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', 1391601708, 'a:6:{s:9:"user_data";s:0:"";s:7:"user_id";s:1:"1";s:8:"username";s:8:"Florante";s:5:"email";s:22:"florante.kho@gmail.com";s:4:"role";s:5:"admin";s:6:"status";s:1:"1";}');

-- --------------------------------------------------------

--
-- Table structure for table `connector_map`
--

CREATE TABLE IF NOT EXISTS `connector_map` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user` bigint(20) NOT NULL,
  `api_source` int(11) NOT NULL,
  `api_target` int(11) NOT NULL,
  `fields1` text NOT NULL,
  `fields2` text NOT NULL,
  `map` text NOT NULL,
  `source_fields` text NOT NULL,
  `target_fields` text NOT NULL,
  `source_filter` text NOT NULL,
  `connection_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `schedule` text NOT NULL,
  `last_run` datetime NOT NULL,
  `nextrun` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `connector_map`
--

INSERT INTO `connector_map` (`id`, `user`, `api_source`, `api_target`, `fields1`, `fields2`, `map`, `source_fields`, `target_fields`, `source_filter`, `connection_name`, `description`, `schedule`, `last_run`, `nextrun`) VALUES
(3, 1, 0, 1, '{"1":"16","2":"5","3":"7","12":"2"}', '{"1":"email","2":"username","3":"displayname","12":"level_id"}', '{"1":{"OAP":["16","E-Mail"],"SE":["1","email"]},"2":{"OAP":["5","First Name"],"SE":["2","username"]},"3":{"OAP":["7","Last Name"],"SE":["3","displayname"]}}', '["1","2","3"]', '', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 1, 0, 1, '{"1":"16","2":"5","3":"7","12":"2"}', '{"1":"email","2":"username","3":"displayname","12":"level_id"}', '{"1":{"OAP":["16","E-Mail"],"SE":["1","email"]},"2":{"OAP":["5","First Name"],"SE":["2","username"]},"3":{"OAP":["7","Last Name"],"SE":["3","displayname"]}}', '["1","2","3"]', '', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 1, 0, 1, '{"1":"16","2":"5","3":"7","12":"2"}', '{"1":"email","2":"username","3":"displayname","12":"level_id"}', '{"1":{"OAP":["16","E-Mail"],"SE":["1","email"]},"2":{"OAP":["5","First Name"],"SE":["2","username"]},"3":{"OAP":["7","Last Name"],"SE":["3","displayname"]}}', '["1","2","3"]', '', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 1, 0, 1, '{"1":"16","2":"5","3":"7","12":"2"}', '{"1":"email","2":"username","3":"displayname","12":"level_id"}', '{"1":{"OAP":["16","E-Mail"],"SE":["1","email"]},"2":{"OAP":["5","First Name"],"SE":["2","username"]},"3":{"OAP":["7","Last Name"],"SE":["3","displayname"]}}', '["1","2","3"]', '', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 1, 0, 1, '{"1":"6","2":"5","3":"7","12":"2"}', '{"1":"email","2":"username","3":"displayname","12":"level_id"}', '{"1":{"OAP":["6","Middle Name"],"SE":["1","email"]},"2":{"OAP":["5","First Name"],"SE":["2","username"]},"3":{"OAP":["7","Last Name"],"SE":["3","displayname"]}}', '["1","2","3"]', '', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 0, 0, 1, '', '', '', '', '', '', 'my connection', 'new connection', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 0, 0, 1, '', '', '', '["5","7","5"]', '["1","2","3"]', '{"field":["5","5","5"],"operation":["n","n","n"],"value":["florante","florante","florante"]}', 'My first connection', 'this is a test', '2', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 0, 0, 0, '', '', '', '', '', '', '', '', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `jqcalendar`
--

CREATE TABLE IF NOT EXISTS `jqcalendar` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Subject` varchar(1000) CHARACTER SET utf8 DEFAULT NULL,
  `Location` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `Description` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `StartTime` datetime DEFAULT NULL,
  `EndTime` datetime DEFAULT NULL,
  `IsAllDayEvent` smallint(6) NOT NULL,
  `Color` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `RecurringRule` varchar(500) CHARACTER SET utf8 DEFAULT NULL,
  `connection_id` bigint(20) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `jqcalendar`
--

INSERT INTO `jqcalendar` (`Id`, `Subject`, `Location`, `Description`, `StartTime`, `EndTime`, `IsAllDayEvent`, `Color`, `RecurringRule`, `connection_id`) VALUES
(8, 'My first connection', '', '', '2014-01-24 00:00:00', '2014-01-25 00:00:00', 1, '14', NULL, 0),
(9, 'My first connection', '', '', '2014-01-02 00:00:00', '2014-01-02 00:00:00', 1, '-1', NULL, 0),
(10, 'hjk', NULL, NULL, '2014-01-23 07:30:00', '2014-01-23 08:30:00', 0, NULL, NULL, 0),
(11, 'My first connection', '', '', '2014-01-09 00:00:00', '2014-01-31 00:00:00', 1, '-1', NULL, 0),
(12, 'My first connection', '', '', '2014-01-26 00:00:00', '2014-01-29 00:00:00', 1, '-1', NULL, 0),
(13, 'n ew', NULL, NULL, '2014-01-22 14:00:00', '2014-01-22 15:00:00', 0, NULL, NULL, 9),
(14, 'My first connection', '', '', '2014-01-26 00:00:00', '2014-01-30 00:00:00', 1, '9', NULL, 9);

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE IF NOT EXISTS `login_attempts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(40) COLLATE utf8_bin NOT NULL,
  `login` varchar(50) COLLATE utf8_bin NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(255) NOT NULL,
  `default` tinyint(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`, `default`) VALUES
(1, 'admin', 0),
(2, 'user', 1);

-- --------------------------------------------------------

--
-- Table structure for table `scheduler`
--

CREATE TABLE IF NOT EXISTS `scheduler` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `connectionID` bigint(20) NOT NULL,
  `userID` bigint(20) NOT NULL,
  `weekdays_type` varchar(25) NOT NULL,
  `days` int(11) NOT NULL,
  `mon-enabled` int(11) NOT NULL,
  `tue-enabled` int(11) NOT NULL,
  `wed-enabled` int(11) NOT NULL,
  `thu-enabled` int(11) NOT NULL,
  `fri-enabled` int(11) NOT NULL,
  `sat-enabled` int(11) NOT NULL,
  `sun-enabled` int(11) NOT NULL,
  `mon-start` float NOT NULL,
  `tue-start` float NOT NULL,
  `wed-start` float NOT NULL,
  `thu-start` float NOT NULL,
  `fri-start` float NOT NULL,
  `sat-start` float NOT NULL,
  `sun-start` float NOT NULL,
  `mon-end` float NOT NULL,
  `tue-end` float NOT NULL,
  `wed-end` float NOT NULL,
  `thu-end` float NOT NULL,
  `fri-end` float NOT NULL,
  `sat-end` float NOT NULL,
  `sun-end` float NOT NULL,
  `sync_interval` decimal(10,0) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `scheduler`
--

INSERT INTO `scheduler` (`id`, `connectionID`, `userID`, `weekdays_type`, `days`, `mon-enabled`, `tue-enabled`, `wed-enabled`, `thu-enabled`, `fri-enabled`, `sat-enabled`, `sun-enabled`, `mon-start`, `tue-start`, `wed-start`, `thu-start`, `fri-start`, `sat-start`, `sun-start`, `mon-end`, `tue-end`, `wed-end`, `thu-end`, `fri-end`, `sat-end`, `sun-end`, `sync_interval`) VALUES
(1, 9, 0, 'alldays', 0, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 24, 24, 24, 24, 24, 0, 0, '0'),
(2, 9, 1, 'alldays', 0, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 24, 24, 24, 24, 24, 0, 0, '1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
  `email` varchar(100) COLLATE utf8_bin NOT NULL,
  `role_id` int(11) NOT NULL,
  `activated` tinyint(1) NOT NULL DEFAULT '1',
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `ban_reason` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `new_password_key` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `new_password_requested` datetime DEFAULT NULL,
  `new_email` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `new_email_key` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `last_ip` varchar(40) COLLATE utf8_bin NOT NULL,
  `last_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `role_id`, `activated`, `banned`, `ban_reason`, `new_password_key`, `new_password_requested`, `new_email`, `new_email_key`, `last_ip`, `last_login`, `created`, `modified`) VALUES
(1, 'Florante', '$2a$08$C3M0mvlJuDfv.P1CYrdxnejVxBJP69E5BVJn51h1DkTu.TvjopfG6', 'florante.kho@gmail.com', 1, 1, 0, NULL, NULL, NULL, NULL, NULL, '127.0.0.1', '2014-02-05 11:19:32', '2014-01-14 13:34:47', '2014-02-05 11:19:32');

-- --------------------------------------------------------

--
-- Table structure for table `user_autologin`
--

CREATE TABLE IF NOT EXISTS `user_autologin` (
  `key_id` char(32) COLLATE utf8_bin NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `user_agent` varchar(150) COLLATE utf8_bin NOT NULL,
  `last_ip` varchar(40) COLLATE utf8_bin NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`key_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `user_autologin`
--

INSERT INTO `user_autologin` (`key_id`, `user_id`, `user_agent`, `last_ip`, `last_login`) VALUES
('4238a0b1311a3b1a25ae63533c28d790', 1, 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/31.0.1650.63 Safari/537.36', '127.0.0.1', '2014-01-14 15:47:52'),
('9dec1a946778e5613a4d996c463fcfc9', 1, 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.102 Safari/537.36', '127.0.0.1', '2014-01-30 09:27:52'),
('b5dfac07bf34de897e060469645f5879', 1, 'Mozilla/5.0 (Windows NT 6.1; Trident/7.0; rv:11.0) like Gecko', '127.0.0.1', '2014-01-25 22:06:28'),
('f082906cd49f4ccf0f5cdc8652e8e340', 1, 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.76 Safari/537.36', '127.0.0.1', '2014-01-26 21:51:48');

-- --------------------------------------------------------

--
-- Table structure for table `user_profiles`
--

CREATE TABLE IF NOT EXISTS `user_profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `country` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user_profiles`
--

INSERT INTO `user_profiles` (`id`, `user_id`, `country`, `website`) VALUES
(1, 1, NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
