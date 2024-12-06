-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 06, 2024 at 02:00 AM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lpa_ecomms`
--

-- --------------------------------------------------------

--
-- Table structure for table `lpa_clients`
--

DROP TABLE IF EXISTS `lpa_clients`;
CREATE TABLE IF NOT EXISTS `lpa_clients` (
  `lpa_client_ID` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `lpa_client_firstname` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `lpa_client_lastname` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `lpa_client_address` varchar(250) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `lpa_client_phone` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `lpa_client_status` char(1) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`lpa_client_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lpa_clients`
--

INSERT INTO `lpa_clients` (`lpa_client_ID`, `lpa_client_firstname`, `lpa_client_lastname`, `lpa_client_address`, `lpa_client_phone`, `lpa_client_status`) VALUES
('0001', 'Jhon', 'Smith', ' 00 willis st, Tarraguindi QLD', '0415896256', NULL),
('0002', 'Hall', 'Thomson', '88 cloth st, brisbane', '0415245862', NULL),
('0003', 'Thon', 'Gill', '253 Queen st, brisbane', '0412536897', NULL),
('0004', 'Marcus', 'North', '253 Delta st, Bowenhill', '0412458942', NULL),
('0005', 'Sara', 'Connor', '15 Fail st, Grey city', '0485963214', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lpa_invoices`
--

DROP TABLE IF EXISTS `lpa_invoices`;
CREATE TABLE IF NOT EXISTS `lpa_invoices` (
  `lpa_inv_no` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `lpa_inv_date` datetime DEFAULT NULL,
  `lpa_inv_client_ID` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `lpa_inv_client_name` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `lpa_inv_client_address` varchar(250) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `lpa_inv_amount` decimal(8,2) DEFAULT NULL,
  `lpa_inv_status` char(1) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`lpa_inv_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lpa_invoice_items`
--

DROP TABLE IF EXISTS `lpa_invoice_items`;
CREATE TABLE IF NOT EXISTS `lpa_invoice_items` (
  `lpa_invitem_no` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `lpa_invitem_inv_no` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `lpa_invitem_stock_ID` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `lpa_invitem_stock_name` varchar(250) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `lpa_invitem_qty` varchar(6) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `lpa_invitem_stock_price` decimal(7,2) DEFAULT NULL,
  `lpa_invitem_stock_amount` decimal(7,2) DEFAULT NULL,
  `lpa_inv_status` char(1) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`lpa_invitem_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lpa_stock`
--

DROP TABLE IF EXISTS `lpa_stock`;
CREATE TABLE IF NOT EXISTS `lpa_stock` (
  `lpa_stock_ID` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `lpa_stock_name` varchar(250) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `lpa_stock_desc` text COLLATE utf8mb4_general_ci,
  `lpa_stock_onhand` varchar(5) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `lpa_stock_price` decimal(7,2) DEFAULT NULL,
  `lpa_stock_status` char(1) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `lpa_stock_image` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`lpa_stock_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lpa_stock`
--

INSERT INTO `lpa_stock` (`lpa_stock_ID`, `lpa_stock_name`, `lpa_stock_desc`, `lpa_stock_onhand`, `lpa_stock_price`, `lpa_stock_status`, `lpa_stock_image`) VALUES
('1', 'Dell Inspiron 15	\r\n', '15.6-inch laptop perfect for everyday use, in a stylish, thoughtful design. Featuring the latest AMD processors. Inspiron 15 with Simple Details, Elevated Experiences, connects all your devices with a variety of ports.Write and calculate quickly with roomy keypads, separate numeric keypad and calculator hotkey.Keep your wrists comfortable as you type with the practical typing angle of the lift hinge. Enjoy quality video chats with a built-in HD webcam that keeps you looking your best. Adaptive thermals keep your PC running efficiently, whether at your desk or working from your lap.	\r\n', '15', 699.00, NULL, 'images/product1.png	\r\n'),
('2', 'Lenovo Tab M9 	\r\n', 'Stay ahead in-class. 9\" Ultra large Display, 176ppi, 60hz refresh rate. MTK G80 platform. Full metal body, 3.5mm audio jack, full function Type C Support 15w fast charge. Micro SD. Dual Full-range Speakers.	\r\n', '20', 289.00, NULL, 'images/product2.png\r\n'),
('3', 'Corsair K55 CORE RGB Gaming Keyboard 	\r\n', 'The CORSAIR K55 CORE gaming keyboard puts you on the winning path, with fully customizable ten-zone RGB backlighting and dedicated media control buttons.	\r\n', '25', 79.00, NULL, 'images/product3.png	\r\n'),
('4', 'Dell KM5221W Pro Wireless Keyboard and Mouse	\r\n', 'Combining a discreetly powerful keyboard with an expertly designed mouse, the Dell Pro Wireless Keyboard and Mouse combo enhances your productivity. Powered by one of the industry\'s leading battery lives of up to 36 months, this combo is built to last.	\r\n', '50', 59.00, NULL, 'images/product4.png	\r\n'),
('5', 'Beats Solo Buds True Wireless Earbuds (Matte Black)	\r\n', 'Beats Solo Buds feature incredibly big sound, packed into the tiniest case we’ve ever made. Designed for music first, their cleanly balanced tuning gives you the full range and emotion of all your favourite music, with richly detailed clarity and power plus accurate bass reproduction. These tiny buds have all-day battery life with up to 18 hours of playback.1 For extra power on the go, they can charge directly from your phone,2 tablet or laptop. They are ready to pair with your Apple or Android device straight out of the box for seamless one-touch pairing, automatic pre-pairing across your devices and Find My or Find My Device, for everybody.	\r\n', '13', 129.00, NULL, 'images/product5.png	\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `lpa_users`
--

DROP TABLE IF EXISTS `lpa_users`;
CREATE TABLE IF NOT EXISTS `lpa_users` (
  `lpa_user_ID` int NOT NULL AUTO_INCREMENT,
  `lpa_user_username` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `lpa_user_password` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `lpa_user_firstname` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `lpa_user_lastname` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `lpa_inv_status` char(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `lpa_users_email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `lpa_user_role` enum('admin','user') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'user',
  PRIMARY KEY (`lpa_user_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lpa_users`
--

INSERT INTO `lpa_users` (`lpa_user_ID`, `lpa_user_username`, `lpa_user_password`, `lpa_user_firstname`, `lpa_user_lastname`, `lpa_inv_status`, `lpa_users_email`, `lpa_user_role`) VALUES
(1, 'johany', '$2y$10$B4bI0921bNjFmPLqFcwVTeoVQ2Lq5tVk/Z/LxVN74WsFkr9ZMoGkq', 'Johany', 'Pena', NULL, 'johanyflorez@gmail.com', 'admin'),
(2, 'ct', '$2y$10$lYOIVI49qp0M/Gli3Y1v5u2i8LWS2PoZPM6.7UlGDdCBhrLsc9Aq2', 'Canterbury', 'CT', NULL, 'ct@gmail.com', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `expires_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`id`, `user_id`, `token`, `expires_at`) VALUES
(3, 1, '32a80bd0692af5c1b0577d5c672514d80a17d0cda7addae1ec9877882467b3007084b8c5e25079c9fa7ff1d8cb1d83773515', '2024-11-17 13:18:02');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD CONSTRAINT `password_resets_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `lpa_users` (`lpa_user_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
