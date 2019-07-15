-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 15, 2019 at 12:36 PM
-- Server version: 5.7.26-0ubuntu0.18.10.1
-- PHP Version: 7.2.19-0ubuntu0.18.10.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php_tutorial`
--

DELIMITER $$
--
-- Procedures
--
CREATE  PROCEDURE `CountEmpBySalary` (IN `sal` DECIMAL(10,0), OUT `total` INT)  BEGIN
SELECT count(id) INTO total FROM employees WHERE salary = sal;
END$$

CREATE  PROCEDURE `GetAllEmployees` ()  BEGIN
SELECT * FROM employees;
END$$

CREATE  PROCEDURE `GetEmployeeByName` (IN `emp_name` VARCHAR(50))  BEGIN
SELECT * FROM employees WHERE name = emp_name;
END$$

CREATE  PROCEDURE `set_counter` (INOUT `count` INT(4), IN `inc` INT(4))  BEGIN
SET count = count + inc;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `cart_products`
--

CREATE TABLE `cart_products` (
  `product_id` int(10) UNSIGNED NOT NULL,
  `product_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `product_price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cart_products`
--

INSERT INTO `cart_products` (`product_id`, `product_name`, `product_price`) VALUES
(1, 'Nokia 1100', 2800),
(2, 'Iphone 6', 66000);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `salary` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `salary`) VALUES
(1, 'raju', '10000'),
(2, 'rani', '12000'),
(3, 'bhumi', '15000'),
(4, 'hani', '20000'),
(5, 'test', '7000'),
(6, 'test', '7000'),
(7, 'xyz', '20000'),
(8, 'xyz2', '30000'),
(9, 'xyz4', '4000'),
(10, 'xyz5', '5000');

-- --------------------------------------------------------

--
-- Table structure for table `ip_hits`
--

CREATE TABLE `ip_hits` (
  `customer_id` int(11) NOT NULL,
  `user_agent` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `session_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `hits` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `ip_address` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `access_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ip_hits`
--

INSERT INTO `ip_hits` (`customer_id`, `user_agent`, `session_id`, `hits`, `ip_address`, `access_time`) VALUES
(1, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'tijgjt32r142eib5e84fp6noac', 5, '::1', '2019-07-15 12:22:48');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `language_id` int(11) NOT NULL,
  `language` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE TABLE `messages` (
  `message_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `message_key` varchar(255) NOT NULL,
  `message` varchar(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(250) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`id`, `name`, `description`, `updated_at`) VALUES
(1, 'test1', 'test test', '2019-06-03 13:44:27'),
(2, 'test2', 'test2 test2', '2019-06-03 14:41:14'),
(3, 'test3', 'test3 test3', '2019-06-03 14:42:18');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `user_name` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `pwd` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email_id` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `pwd`, `email_id`, `created_time`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', NULL, '2017-12-07 15:11:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart_products`
--
ALTER TABLE `cart_products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ip_hits`
--
ALTER TABLE `ip_hits`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `session_id` (`session_id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`language_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`),
  ADD UNIQUE KEY `Unique_messsage` (`language_id`,`message_key`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name` (`user_name`),
  ADD UNIQUE KEY `email_id` (`email_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart_products`
--
ALTER TABLE `cart_products`
  MODIFY `product_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `ip_hits`
--
ALTER TABLE `ip_hits`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `language_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
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