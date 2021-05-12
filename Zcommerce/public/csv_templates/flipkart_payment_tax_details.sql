-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 08, 2021 at 06:13 AM
-- Server version: 8.0.23
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `unicom`
--

-- --------------------------------------------------------

--
-- Table structure for table `flipkart_payment_tax_details`
--

CREATE TABLE `flipkart_payment_tax_details` (
  `id` int NOT NULL,
  `shop_id` int NOT NULL,
  `marketplace_id` int NOT NULL,
  `service_type` varchar(255) NOT NULL,
  `neft_id` varchar(255) DEFAULT NULL,
  `order_item_listing_id_campign_id_transaction_id` varchar(255) DEFAULT NULL,
  `recall_id` varchar(255) DEFAULT NULL,
  `warehouse_state_code` varchar(255) DEFAULT NULL,
  `fee_name` varchar(255) DEFAULT NULL,
  `fee_amount_new` float NOT NULL DEFAULT '0',
  `cgst_rate` float NOT NULL DEFAULT '0',
  `sgst_rate` float NOT NULL DEFAULT '0',
  `igst_rate` float NOT NULL DEFAULT '0',
  `cgst_amount` float NOT NULL DEFAULT '0',
  `sgst_amount` float NOT NULL DEFAULT '0',
  `igst_amount` float NOT NULL DEFAULT '0',
  `fee_amount_old` float NOT NULL DEFAULT '0',
  `service_tax_rate` float NOT NULL DEFAULT '0',
  `kkc_rate` float NOT NULL DEFAULT '0',
  `sbc_rate` float NOT NULL DEFAULT '0',
  `service_tax_amount` float NOT NULL DEFAULT '0',
  `kkc_amount` float NOT NULL DEFAULT '0',
  `sbc_amount` float NOT NULL DEFAULT '0',
  `total_tax` float NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `flipkart_payment_tax_details`
--
ALTER TABLE `flipkart_payment_tax_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `flipkart_payment_tax_details`
--
ALTER TABLE `flipkart_payment_tax_details`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
