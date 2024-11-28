-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 28, 2024 at 10:38 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `LPA_eComms`
--

-- --------------------------------------------------------

--
-- Table structure for table `lpa_clients`
--

CREATE TABLE `lpa_clients` (
  `lpa_client_ID` varchar(20) NOT NULL,
  `lpa_client_firstname` varchar(50) DEFAULT NULL,
  `lpa_client_lastname` varchar(50) DEFAULT NULL,
  `lpa_client_address` varchar(250) DEFAULT NULL,
  `lpa_client_phone` varchar(30) DEFAULT NULL,
  `lpa_client_status` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lpa_invoices`
--

CREATE TABLE `lpa_invoices` (
  `lpa_inv_no` varchar(20) NOT NULL,
  `lpa_inv_date` datetime DEFAULT NULL,
  `lpa_inv_client_ID` varchar(20) DEFAULT NULL,
  `lpa_inv_client_name` varchar(50) DEFAULT NULL,
  `lpa_inv_client_address` varchar(250) DEFAULT NULL,
  `lpa_inv_amount` decimal(8,2) DEFAULT NULL,
  `lpa_inv_status` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lpa_invoice_items`
--

CREATE TABLE `lpa_invoice_items` (
  `lpa_invitem_no` varchar(20) NOT NULL,
  `lpa_invitem_inv_no` varchar(20) DEFAULT NULL,
  `lpa_invitem_stock_ID` varchar(20) DEFAULT NULL,
  `lpa_invitem_stock_name` varchar(250) DEFAULT NULL,
  `lpa_invitem_qty` varchar(6) DEFAULT NULL,
  `lpa_invitem_stock_price` decimal(7,2) DEFAULT NULL,
  `lpa_invitem_stock_amount` decimal(7,2) DEFAULT NULL,
  `lpa_inv_status` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lpa_stock`
--

CREATE TABLE `lpa_stock` (
  `lpa_stock_ID` varchar(20) NOT NULL,
  `lpa_stock_name` varchar(250) DEFAULT NULL,
  `lpa_stock_desc` text DEFAULT NULL,
  `lpa_stock_onhand` varchar(5) DEFAULT NULL,
  `lpa_stock_price` decimal(7,2) DEFAULT NULL,
  `lpa_stock_status` char(1) DEFAULT NULL,
  `lpa_stock_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lpa_stock`
--

INSERT INTO `lpa_stock` (`lpa_stock_ID`, `lpa_stock_name`, `lpa_stock_desc`, `lpa_stock_onhand`, `lpa_stock_price`, `lpa_stock_status`, `lpa_stock_image`) VALUES
('1', 'Test', 'Test', '5', 2321.00, 'A', 'images/pc1.jpg'),
('2342', 'Test', 'Test', '5', 2321.00, 'A', 'images/pc2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `lpa_users`
--

CREATE TABLE `lpa_users` (
  `lpa_user_ID` int(11) NOT NULL,
  `lpa_user_username` varchar(255) DEFAULT NULL,
  `lpa_user_password` varchar(255) DEFAULT NULL,
  `lpa_user_firstname` varchar(255) DEFAULT NULL,
  `lpa_user_lastname` varchar(255) DEFAULT NULL,
  `lpa_inv_status` char(255) DEFAULT NULL,
  `lpa_users_email` varchar(255) NOT NULL,
  `lpa_user_role` enum('admin','user') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expires_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`id`, `user_id`, `token`, `expires_at`) VALUES
(3, 1, '32a80bd0692af5c1b0577d5c672514d80a17d0cda7addae1ec9877882467b3007084b8c5e25079c9fa7ff1d8cb1d83773515', '2024-11-17 13:18:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lpa_clients`
--
ALTER TABLE `lpa_clients`
  ADD PRIMARY KEY (`lpa_client_ID`);

--
-- Indexes for table `lpa_invoices`
--
ALTER TABLE `lpa_invoices`
  ADD PRIMARY KEY (`lpa_inv_no`);

--
-- Indexes for table `lpa_invoice_items`
--
ALTER TABLE `lpa_invoice_items`
  ADD PRIMARY KEY (`lpa_invitem_no`);

--
-- Indexes for table `lpa_stock`
--
ALTER TABLE `lpa_stock`
  ADD PRIMARY KEY (`lpa_stock_ID`);

--
-- Indexes for table `lpa_users`
--
ALTER TABLE `lpa_users`
  ADD PRIMARY KEY (`lpa_user_ID`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lpa_users`
--
ALTER TABLE `lpa_users`
  MODIFY `lpa_user_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
