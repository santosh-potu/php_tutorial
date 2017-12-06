-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 16, 2012 at 10:48 PM
-- Server version: 5.5.24
-- PHP Version: 5.3.10-1ubuntu3.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `php_tutorial`
--

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE IF NOT EXISTS `languages` (
  `language_id` int(11) NOT NULL AUTO_INCREMENT,
  `language` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`language_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`language_id`, `language`) VALUES
(1, 'English'),
(2, 'తెలుగు'),
(3, 'हिन्दी');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `language_id` int(11) NOT NULL,
  `message_key` varchar(255) NOT NULL,
  `message` varchar(1024) NOT NULL,
  PRIMARY KEY (`message_id`),
  UNIQUE KEY `Unique_messsage` (`language_id`,`message_key`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`message_id`, `language_id`, `message_key`, `message`) VALUES
(1, 1, 'MESSAGE_CLICK_HERE', 'Click Here'),
(2, 2, 'MESSAGE_CLICK_HERE', 'ఇక్కడ క్లిక్ చేయండి'),
(3, 3, 'MESSAGE_CLICK_HERE', 'यहाँ क्लिक करें'),
(4, 1, 'MESSAGE_SELECT_A_LANGUAGE', 'Please select a language to continue with'),
(5, 2, 'MESSAGE_SELECT_A_LANGUAGE', 'కొనసాగడానికి భాష ని ఎంచుకోండి'),
(6, 3, 'MESSAGE_SELECT_A_LANGUAGE', 'जारी रखने के लिए एक भाषा चुनें'),
(7, 1, 'MESSAGE_SITE_UNDER_DEVELOPMENT', 'Thanks for Choosing Us! Site is under development! To change Language'),
(8, 2, 'MESSAGE_SITE_UNDER_DEVELOPMENT', 'మమ్మల్ని ఎంచుకున్నందుకు ధన్యవాదాలు!  సైట్ పనులు జరుగుచున్నవి! భాష మర్చుకోవాలంటే'),
(9, 3, 'MESSAGE_SITE_UNDER_DEVELOPMENT', 'हमें चुनने के लिए धन्यवाद! साइट के विकास के अंतर्गत है! करने के लिए भाषा बदलने');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`language_id`) REFERENCES `languages` (`language_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
