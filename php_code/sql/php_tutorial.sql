-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 01, 2018 at 08:51 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.0.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php_tuttorial`
--

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
(2, 'Iphone 6', 66000),
(3, 'Mi Fitband', 1200),
(4, 'Vega Helmet', 1600),
(5, 'Redmi Note 4', 10000),
(6, 'Micromax Bharat 1', 2500);

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` int(11) NOT NULL,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `code`, `description`) VALUES
(1, 'AFA', 'Afghanistan Afghani'),
(2, 'ALL', 'Albanian Lek'),
(3, 'DZD', 'Algerian Dinar'),
(4, 'ARS', 'Argentine Peso'),
(5, 'AWG', 'Aruba Florin'),
(6, 'AUD', 'Australian Dollar'),
(7, 'BSD', 'Bahamian Dollar'),
(8, 'BHD', 'Bahraini Dinar'),
(9, 'BDT', 'Bangladesh Taka'),
(10, 'BBD', 'Barbados Dollar'),
(11, 'BZD', 'Belize Dollar'),
(12, 'BMD', 'Bermuda Dollar'),
(13, 'BTN', 'Bhutan Ngultrum'),
(14, 'BOB', 'Bolivian Boliviano'),
(15, 'BWP', 'Botswana Pula'),
(16, 'BRL', 'Brazilian Real'),
(17, 'GBP', 'British Pound'),
(18, 'BND', 'Brunei Dollar'),
(19, 'BIF', 'Burundi Franc'),
(20, 'XOF', 'CFA Franc (BCEAO)'),
(21, 'XAF', 'CFA Franc (BEAC)'),
(22, 'KHR', 'Cambodia Riel'),
(23, 'CAD', 'Canadian Dollar'),
(24, 'CVE', 'Cape Verde Escudo'),
(25, 'KYD', 'Cayman Islands Dollar'),
(26, 'CLP', 'Chilean Peso'),
(27, 'CNY', 'Chinese Yuan'),
(28, 'COP', 'Colombian Peso'),
(29, 'KMF', 'Comoros Franc'),
(30, 'CRC', 'Costa Rica Colon'),
(31, 'HRK', 'Croatian Kuna'),
(32, 'CUP', 'Cuban Peso'),
(33, 'CYP', 'Cyprus Pound'),
(34, 'CZK', 'Czech Koruna'),
(35, 'DKK', 'Danish Krone'),
(36, 'DJF', 'Dijibouti Franc'),
(37, 'DOP', 'Dominican Peso'),
(38, 'XCD', 'East Caribbean Dollar'),
(39, 'EGP', 'Egyptian Pound'),
(40, 'SVC', 'El Salvador Colon'),
(41, 'EEK', 'Estonian Kroon'),
(42, 'ETB', 'Ethiopian Birr'),
(43, 'EUR', 'Euro'),
(44, 'FKP', 'Falkland Islands Pound'),
(45, 'GMD', 'Gambian Dalasi'),
(46, 'GHC', 'Ghanian Cedi'),
(47, 'GIP', 'Gibraltar Pound'),
(48, 'XAU', 'Gold Ounces'),
(49, 'GTQ', 'Guatemala Quetzal'),
(50, 'GNF', 'Guinea Franc'),
(51, 'GYD', 'Guyana Dollar'),
(52, 'HTG', 'Haiti Gourde'),
(53, 'HNL', 'Honduras Lempira'),
(54, 'HKD', 'Hong Kong Dollar'),
(55, 'HUF', 'Hungarian Forint'),
(56, 'ISK', 'Iceland Krona'),
(57, 'INR', 'Indian Rupee'),
(58, 'IDR', 'Indonesian Rupiah'),
(59, 'IQD', 'Iraqi Dinar'),
(60, 'ILS', 'Israeli Shekel'),
(61, 'JMD', 'Jamaican Dollar'),
(62, 'JPY', 'Japanese Yen'),
(63, 'JOD', 'Jordanian Dinar'),
(64, 'KZT', 'Kazakhstan Tenge'),
(65, 'KES', 'Kenyan Shilling'),
(66, 'KRW', 'Korean Won'),
(67, 'KWD', 'Kuwaiti Dinar'),
(68, 'LAK', 'Lao Kip'),
(69, 'LVL', 'Latvian Lat'),
(70, 'LBP', 'Lebanese Pound'),
(71, 'LSL', 'Lesotho Loti'),
(72, 'LRD', 'Liberian Dollar'),
(73, 'LYD', 'Libyan Dinar'),
(74, 'LTL', 'Lithuanian Lita'),
(75, 'MOP', 'Macau Pataca'),
(76, 'MKD', 'Macedonian Denar'),
(77, 'MGF', 'Malagasy Franc'),
(78, 'MWK', 'Malawi Kwacha'),
(79, 'MYR', 'Malaysian Ringgit'),
(80, 'MVR', 'Maldives Rufiyaa'),
(81, 'MTL', 'Maltese Lira'),
(82, 'MRO', 'Mauritania Ougulya'),
(83, 'MUR', 'Mauritius Rupee'),
(84, 'MXN', 'Mexican Peso'),
(85, 'MDL', 'Moldovan Leu'),
(86, 'MNT', 'Mongolian Tugrik'),
(87, 'MAD', 'Moroccan Dirham'),
(88, 'MZM', 'Mozambique Metical'),
(89, 'MMK', 'Myanmar Kyat'),
(90, 'NAD', 'Namibian Dollar'),
(91, 'NPR', 'Nepalese Rupee'),
(92, 'ANG', 'Neth Antilles Guilder'),
(93, 'NZD', 'New Zealand Dollar'),
(94, 'NIO', 'Nicaragua Cordoba'),
(95, 'NGN', 'Nigerian Naira'),
(96, 'KPW', 'North Korean Won'),
(97, 'NOK', 'Norwegian Krone'),
(98, 'OMR', 'Omani Rial'),
(99, 'XPF', 'Pacific Franc'),
(100, 'PKR', 'Pakistani Rupee'),
(101, 'XPD', 'Palladium Ounces'),
(102, 'PAB', 'Panama Balboa'),
(103, 'PGK', 'Papua New Guinea Kina'),
(104, 'PYG', 'Paraguayan Guarani'),
(105, 'PEN', 'Peruvian Nuevo Sol'),
(106, 'PHP', 'Philippine Peso'),
(107, 'XPT', 'Platinum Ounces'),
(108, 'PLN', 'Polish Zloty'),
(109, 'QAR', 'Qatar Rial'),
(110, 'ROL', 'Romanian Leu'),
(111, 'RUB', 'Russian Rouble'),
(112, 'WST', 'Samoa Tala'),
(113, 'STD', 'Sao Tome Dobra'),
(114, 'SAR', 'Saudi Arabian Riyal'),
(115, 'SCR', 'Seychelles Rupee'),
(116, 'SLL', 'Sierra Leone Leone'),
(117, 'XAG', 'Silver Ounces'),
(118, 'SGD', 'Singapore Dollar'),
(119, 'SKK', 'Slovak Koruna'),
(120, 'SIT', 'Slovenian Tolar'),
(121, 'SBD', 'Solomon Islands Dollar'),
(122, 'SOS', 'Somali Shilling'),
(123, 'ZAR', 'South African Rand'),
(124, 'LKR', 'Sri Lanka Rupee'),
(125, 'SHP', 'St Helena Pound'),
(126, 'SDD', 'Sudanese Dinar'),
(127, 'SRG', 'Surinam Guilder'),
(128, 'SZL', 'Swaziland Lilageni'),
(129, 'SEK', 'Swedish Krona'),
(130, 'TRY', 'Turkey Lira'),
(131, 'CHF', 'Swiss Franc'),
(132, 'SYP', 'Syrian Pound'),
(133, 'TWD', 'Taiwan Dollar'),
(134, 'TZS', 'Tanzanian Shilling'),
(135, 'THB', 'Thai Baht'),
(136, 'TOP', 'Tonga Pa\'anga'),
(137, 'TTD', 'Trinidad&amp;Tobago Dollar'),
(138, 'TND', 'Tunisian Dinar'),
(139, 'TRL', 'Turkish Lira'),
(140, 'USD', 'U.S. Dollar'),
(141, 'AED', 'UAE Dirham'),
(142, 'UGX', 'Ugandan Shilling'),
(143, 'UAH', 'Ukraine Hryvnia'),
(144, 'UYU', 'Uruguayan New Peso'),
(145, 'VUV', 'Vanuatu Vatu'),
(146, 'VEB', 'Venezuelan Bolivar'),
(147, 'VND', 'Vietnam Dong'),
(148, 'YER', 'Yemen Riyal'),
(149, 'YUM', 'Yugoslav Dinar'),
(150, 'ZMK', 'Zambian Kwacha'),
(151, 'ZWD', 'Zimbabwe Dollar');

-- --------------------------------------------------------

--
-- Table structure for table `ip_hits`
--

CREATE TABLE `ip_hits` (
  `customer_id` int(11) NOT NULL,
  `user_agent` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `session_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `hits` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `ip_address` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `access_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ip_hits`
--

INSERT INTO `ip_hits` (`customer_id`, `user_agent`, `session_id`, `hits`, `ip_address`, `access_time`) VALUES
(1, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.108 Safari/537.36', 'uq613he4dqmfk4us60pvb5lt04', 6, '::1', '2017-12-31 23:13:31');

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
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD UNIQUE KEY `description` (`description`);

--
-- Indexes for table `ip_hits`
--
ALTER TABLE `ip_hits`
  ADD PRIMARY KEY (`customer_id`,`session_id`) USING BTREE,
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
  MODIFY `product_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;
--
-- AUTO_INCREMENT for table `ip_hits`
--
ALTER TABLE `ip_hits`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
