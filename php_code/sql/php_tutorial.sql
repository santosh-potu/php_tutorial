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
CREATE  PROCEDURE `CountEmpBySalary`(IN `sal` DECIMAL(10,0), OUT `total` INT)
BEGIN
SELECT count(id) INTO total FROM employees WHERE salary = sal;
END$$
DELIMITER ;

DELIMITER $$
CREATE  PROCEDURE `GetEmployeeGrade`(IN `emp_name` VARCHAR(50), OUT `grade` VARCHAR(20))
BEGIN
DECLARE sal DECIMAL(10,0);
SELECT salary INTO sal FROM employees WHERE name LIKE emp_name;

IF sal >= 20000 THEN
SET grade = "PLATINUM";
ELSEIF sal >= 10000 THEN
SET grade = "GOLD";
ELSEIF sal >= 5000 THEN
SET grade = "SILVER";
ELSE
SET grade = "BRONZE";
END IF;

END$$
DELIMITER ;

DELIMITER $$
CREATE  PROCEDURE `build_email_list`(INOUT `email_list` VARCHAR(4000))
BEGIN
 
 DECLARE v_finished INTEGER DEFAULT 0;
        DECLARE v_email varchar(100) DEFAULT "";
 
  DEClARE email_cursor CURSOR FOR 
 SELECT email FROM employees;
 
  DECLARE CONTINUE HANDLER 
        FOR NOT FOUND SET v_finished = 1;
 
 OPEN email_cursor;
 
 get_email: LOOP
 
 FETCH email_cursor INTO v_email;
 
 IF v_finished = 1 THEN 
 LEAVE get_email;
 END IF;
 
  SET email_list = CONCAT(v_email,";",email_list);
 
 END LOOP get_email;
 
 CLOSE email_cursor;
 
END$$
DELIMITER ;

DELIMITER $$
CREATE  PROCEDURE `SimpleCaseEx`(IN `emp_name` VARCHAR(50), OUT `grade` VARCHAR(25))
BEGIN
DECLARE sal DECIMAL(10,0) DEFAULT 0;
SELECT salary INTO sal FROM employees WHERE name LIKE emp_name;

CASE
WHEN sal >= 20000 THEN
SET grade = "PLATINUM";
WHEN sal >= 10000 THEN
SET grade = "GOLD";
WHEN sal >= 5000 THEN
SET grade = "SILVER";
ELSE
SET grade = "BRONZE";
END CASE;
END$$
DELIMITER ;

DELIMITER $$
CREATE  FUNCTION `getEmployeeGrade`(`emp_name` VARCHAR(100)) RETURNS varchar(50) CHARSET utf8
    NO SQL
    DETERMINISTIC
BEGIN
DECLARE sal DECIMAL(10,0);
DECLARE grade varchar(50);
SELECT salary INTO sal FROM employees WHERE name LIKE emp_name;

IF sal >= 20000 THEN
SET grade = "PLATINUM";
ELSEIF sal >= 10000 THEN
SET grade = "GOLD";
ELSEIF sal >= 5000 THEN
SET grade = "SILVER";
ELSE
SET grade = "BRONZE";
END IF;

return grade;

END$$
DELIMITER ;

DELIMITER $$
CREATE  PROCEDURE `set_counter`(INOUT count INT(4), IN inc INT(4))
BEGIN
SET count = count + inc;
END$$
DELIMITER ;

DELIMITER $$
CREATE  PROCEDURE `mysql_test_repeat_loop`()
BEGIN
 DECLARE x INT;
 DECLARE str VARCHAR(255);
        
 SET x = 1;
        SET str =  '';
        
 REPEAT
 SET  str = CONCAT(str,x,',');
 SET  x = x + 1; 
        UNTIL x  > 5
        END REPEAT;
 
        SELECT str;
 END$$
DELIMITER ;

DELIMITER $$
CREATE  PROCEDURE `test_mysql_loop`()
BEGIN
 DECLARE x  INT;
DECLARE str  VARCHAR(255);
        
 SET x = 1;
        SET str =  '';
        
 loop_label:  LOOP
 IF  x > 10 THEN 
 LEAVE  loop_label;
 END  IF;
            
 SET  x = x + 1;
 IF  (x mod 2) THEN
 ITERATE  loop_label;
 ELSE
                SET  str = CONCAT(str,x,',');
 END  IF;
         END LOOP;    
 
         SELECT str;
 
 END$$
DELIMITER ;

DELIMITER $$
CREATE  PROCEDURE `GetEmployeeByName`(IN emp_name VARCHAR(50))
BEGIN
SELECT * FROM employees WHERE name = emp_name;
END$$
DELIMITER ;

DELIMITER $$
CREATE  PROCEDURE `GetAllEmployees`()
BEGIN
SELECT * FROM employees;
END$$
DELIMITER ;

DELIMITER $$
CREATE  PROCEDURE `test_mysql_while_loop`()
BEGIN
 DECLARE x  INT;
 DECLARE str  VARCHAR(255);
 
 SET x = 1;
 SET str =  '';
 
 WHILE x  <= 5 DO
 SET  str = CONCAT(str,x,',');
 SET  x = x + 1; 
 END WHILE;
 
 SELECT str;
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


--
-- Table structure for table `employee_audit`
--

CREATE TABLE `employee_audit` (
  `id` int(11) NOT NULL,
  `emp_id` int(11) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `action` varchar(50) NOT NULL,
  `changed_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employee_audit`
--
ALTER TABLE `employee_audit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `empaudit_id_fk` (`emp_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employee_audit`
--
ALTER TABLE `employee_audit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `employee_audit`
--
ALTER TABLE `employee_audit`
  ADD CONSTRAINT `empaudit_id_fk` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

CREATE TRIGGER `before_employee_update` BEFORE UPDATE ON `employees`
 FOR EACH ROW 
BEGIN
INSERT INTO employee_audit
  SET action = "UPDATE",
  emp_id = OLD.id,
  name = CONCAT(OLD.name,':',NEW.NAME),
  changed_at = NOW();
END

CREATE EVENT test_event_03
ON SCHEDULE EVERY 1 MINUTE
STARTS CURRENT_TIMESTAMP
ENDS CURRENT_TIMESTAMP + INTERVAL 1 HOUR
DO
 INSERT INTO test(name,description)
   VALUES(concat('test',':',NOW()),concat('test',':',NOW()))

CREATE EVENT test_event_02
ON SCHEDULE AT CURRENT_TIMESTAMP + INTERVAL 1 MINUTE
ON COMPLETION PRESERVE
DO
INSERT INTO test(name,description)
   VALUES(concat('test',':',NOW()),concat('test',':',NOW()))

-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 19, 2019 at 05:36 PM
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

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `session_id` varchar(100) NOT NULL,
  `session_data` varchar(1000) NOT NULL,
  `session_lastaccesstime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `session_id` (`session_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;