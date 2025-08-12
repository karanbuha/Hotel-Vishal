-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 12, 2025 at 04:35 PM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel-vishal`
--

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

DROP TABLE IF EXISTS `menu_items`;
CREATE TABLE IF NOT EXISTS `menu_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat` varchar(256) NOT NULL,
  `gu_name` varchar(256) NOT NULL,
  `en_name` varchar(256) NOT NULL,
  `price` varchar(256) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu_items`
--

INSERT INTO `menu_items` (`id`, `cat`, `gu_name`, `en_name`, `price`, `date`) VALUES
(1, 'kaju', ' àª•àª¾àªœà« àª¬àªŸàª° àª®àª¸àª¾àª²àª¾ (àª†àª–à«àª‚)', 'Kaju Butter Masala (Full)', ' 260', '2025-08-11 17:32:00'),
(2, 'kaju', ' àª•àª¾àªœà« àª¬àªŸàª° àª®àª¸àª¾àª²àª¾ (àª…àª¡àª§à«àª‚)', 'Kaju Butter Masala (Half)', ' 150', '2025-08-11 17:32:00'),
(3, 'kaju', ' àª•àª¾àªœà« àª•àª°à«€ (àª†àª–à«àª‚)', ' Kaju Kari (Full)', ' 250', '2025-08-11 17:32:00'),
(4, 'kaju', ' àª•àª¾àªœà« àª•àª°à«€ (àª…àª¡àª§à«àª‚)', ' Kaju Kari (Half)', ' 150', '2025-08-11 17:32:00'),
(5, 'kaju', ' àª•àª¾àªœà« àª–à«‹àª¯àª¾ àª¸à«àªµà«€àªŸ (àª†àª–à«àª‚)', ' Kaju Khoya Sweet (Full)', ' 270', '2025-08-11 17:32:00'),
(6, 'kaju', ' àª•àª¾àªœà« àªªàª¨à«€àª° àª®àª¸àª¾àª²àª¾ (àª†àª–à«àª‚)', ' Kaju Paneer Masala (Full)', ' 240', '2025-08-11 17:32:00'),
(7, 'kaju', ' àª•àª¾àªœà« àªªàª¨à«€àª° àª®àª¸àª¾àª²àª¾ (àª…àª¡àª§à«àª‚)', ' Kaju Paneer Masala (Half)', ' 150', '2025-08-11 17:32:00'),
(8, 'kaju', ' àª•àª¾àªœà« àª­à«àª°àªœà«€ (àª†àª–à«àª‚)', ' Kaju Bhurji (Full)', ' 240', '2025-08-11 17:32:00'),
(9, 'kaju', ' àª•àª¾àªœà« àª­à«àª°àªœà«€ (àª…àª¡àª§à«àª‚)', ' Kaju Bhurji (Half)', ' 150', '2025-08-11 17:32:00'),
(10, 'kaju', ' àª•àª¾àªœà« àª®àª¸àª¾àª²àª¾ (àª†àª–à«àª‚)', ' Kaju Masala (Full)', ' 250', '2025-08-11 17:32:00'),
(11, 'kaju', ' àª•àª¾àªœà« àª®àª¸àª¾àª²àª¾ (àª…àª¡àª§à«àª‚)', ' Kaju Masala (Half)', ' 150', '2025-08-11 17:32:00'),
(12, 'kaju', ' àª•àª¾àªœà« àª—àª¾àª à«€àª¯àª¾ (àª†àª–à«àª‚)', ' Kaju Gathiya (Full)', ' 190', '2025-08-11 17:32:00'),
(13, 'kaju', ' àª•àª¾àªœà« àª—àª¾àª à«€àª¯àª¾ (àª…àª¡àª§à«àª‚)', ' Kaju Gathiya (Half)', ' 130', '2025-08-11 17:32:00'),
(14, 'tandoori', ' àª¨àª¾àª¨ (àªªà«àª²à«‡àª¨)', ' Naan (Plain)', ' 40', '2025-08-12 16:07:56'),
(15, 'tandoori', ' àª¨àª¾àª¨ (àª¬àªŸàª°)', ' Naan (Butter)', ' 45', '2025-08-12 16:07:56'),
(16, 'tandoori', ' àª¤àª‚àª¦à«àª°à«€ àª°à«‹àªŸà«€ (àªªà«àª²à«‡àª¨)', ' Tandoori Roti (Plain)', ' 25', '2025-08-12 16:07:56'),
(17, 'tandoori', ' àª¤àª‚àª¦à«àª°à«€ àª°à«‹àªŸà«€ (àª¬àªŸàª°)', ' Tandoori Roti (Butter)', ' 30', '2025-08-12 16:07:56'),
(18, 'tandoori', ' àª²àª›àª¾ àªªàª°à«‹àª àª¾(àªªà«àª²à«‡àª¨)', ' Lachha Paratha(Plain)', ' 40', '2025-08-12 16:07:56'),
(19, 'tandoori', ' àª²àª›àª¾ àªªàª°à«‹àª àª¾ (àª¬àªŸàª°)', ' Lachha Paratha (Butter)', ' 50', '2025-08-12 16:07:56'),
(20, 'tandoori', ' àª•à«àª²àª¸àª¾(àªªà«àª²à«‡àª¨)', ' Kulcha(Plain)', ' 40', '2025-08-12 16:07:56'),
(21, 'tandoori', ' àª•à«àª²àª¸àª¾ (àª¬àªŸàª°)', ' Kulcha (Butter)', ' 50', '2025-08-12 16:07:56'),
(22, 'tandoori', ' àª—àª¾Ã¤àª°à«àª²à«€àª• àª¨àª¾àª¨', ' Garlic Naan', ' 70', '2025-08-12 16:07:56'),
(23, 'tandoori', ' àªšà«€àª àª—àª¾Ã¤àª°à«àª²à«€àª• àª¨àª¾àª¨', ' Cheese Garlic Naan', ' 80', '2025-08-12 16:07:56'),
(24, 'tandoori', ' àª†àª²à«àªªàª°à«‹àª àª¾', ' aloo paratha', ' 60', '2025-08-12 16:07:56'),
(25, 'tandoori', ' àª‡àª¸à«àªŸà«‹àªª àª¨àª¾àª¨ (àªªà«àª²à«‡àª¨)', ' Estop Nan (Plain)', ' 80', '2025-08-12 16:07:56'),
(26, 'tandoori', ' àª‡àª¸à«àªŸà«‹àªª àª¨àª¾àª¨ (àª¬àªŸàª°)', ' Estop Nan (Butter)', ' 85', '2025-08-12 16:07:56'),
(27, 'tandoori', ' àª¤àªµàª¾ àªªàª°à«‹àª àª¾ (àªªà«àª²à«‡àª¨)', ' Tawa Paratha (Plain)', ' 30', '2025-08-12 16:07:56'),
(28, 'tandoori', ' àª¤àªµàª¾ àªªàª°à«‹àª àª¾ (àª¬àªŸàª°)', ' Tawa Paratha (Butter)', ' 35', '2025-08-12 16:07:56'),
(29, 'tandoori', ' àªšàªªàª¾àª¤à«€ (àªªà«àª²à«‡àª¨)', ' Chapati (Plain)', ' 10', '2025-08-12 16:07:56'),
(30, 'tandoori', ' àªšàªªàª¾àª¤à«€ (àª¬àªŸàª°)', ' Chapati (Butter)', ' 15', '2025-08-12 16:07:56'),
(31, 'paneer', ' àª¸à«àªªà«‡. àªµàª¿àª¶àª¾àª² àª¹à«‹àªŸàª²', ' Spe. Vishal Hotel', ' 250', '2025-08-12 16:32:55'),
(32, 'paneer', ' àªªàª¨à«€àª° àªŸà«€àª•àª¾ àª®àª¸àª¾àª²àª¾ (àª…àª¡àª§à«àª‚)', ' Paneer Tikka Masala (Half)', ' 110', '2025-08-12 16:32:55'),
(33, 'paneer', ' àªªàª¨à«€àª° àªŸà«€àª•àª¾ àª®àª¸àª¾àª²àª¾ (àª†àª–à«àª‚)', ' Paneer Tikka Masala (Full)', ' 170', '2025-08-12 16:32:55'),
(34, 'paneer', ' àªªàª¨à«€àª° àª¬àªŸàª° àª®àª¸àª¾àª²àª¾ (àª…àª¡àª§à«àª‚)', ' Paneer Butter Masala (Half)', ' 120', '2025-08-12 16:32:55'),
(35, 'paneer', ' àªªàª¨à«€àª° àª¬àªŸàª° àª®àª¸àª¾àª²àª¾ (àª†àª–à«àª‚)', ' Paneer Butter Masala (Full)', ' 190', '2025-08-12 16:32:55'),
(36, 'paneer', ' àªªàª¨à«€àª° àª•àª¡àª¾àªˆ (àª…àª¡àª§à«àª‚)', ' Paneer Kadal (Half)', ' 120', '2025-08-12 16:32:55'),
(37, 'paneer', ' àªªàª¨à«€àª° àª•àª¡àª¾àªˆ (àª†àª–à«àª‚)', ' Paneer Kadal (Full)', ' 180', '2025-08-12 16:32:55'),
(38, 'paneer', ' àªªàª¨à«€àª° àªšàªŸàªªàªŸàª¾', ' Paneer Chatpata', ' 200', '2025-08-12 16:32:55'),
(39, 'paneer', ' àªªàª¨à«€àª° àª¤à«àª«àª¾àª¨à«€ (àª…àª¡àª§à«àª‚)', ' Paneer Toofani (Half)', ' 120', '2025-08-12 16:32:55'),
(40, 'paneer', ' àªªàª¨à«€àª° àª¤à«àª«àª¾àª¨à«€ (àª†àª–à«àª‚)', ' Paneer Toofani (Full)', ' 200', '2025-08-12 16:32:55'),
(41, 'paneer', ' àªªàª¨à«€àª° àª®à«€àª•àª¸ àª®àª¸àª¾àª²àª¾ (àª…àª¡àª§à«àª‚)', ' Paneer Mix Masala (Half)', ' 120', '2025-08-12 16:32:55'),
(42, 'paneer', ' àªªàª¨à«€àª° àª®à«€àª•àª¸ àª®àª¸àª¾àª²àª¾ (àª†àª–à«àª‚)', ' Paneer Mix Masala (Full)', ' 180', '2025-08-12 16:32:55'),
(43, 'paneer', ' àªªàª¨à«€àª° àªªàª¾àª²àª• (àª…àª¡àª§à«àª‚)', ' Paneer Palak (Half)', ' 120', '2025-08-12 16:32:55'),
(44, 'paneer', ' àªªàª¨à«€àª° àªªàª¾àª²àª• (àª†àª–à«àª‚)', ' Paneer Palak (Full)', ' 180', '2025-08-12 16:32:55'),
(45, 'paneer', ' àªªàª¨à«€àª° àªªàªŸà«€àª¯àª¾àª²àª¾', ' Paneer Patiala', ' 250', '2025-08-12 16:32:55'),
(46, 'paneer', ' àªªàª¨à«€àª° àªªàª¸àª‚àª¦àª¾', ' Paneer Pasanda', ' 250', '2025-08-12 16:32:55'),
(47, 'paneer', ' àªªàª¨à«€àª° àª•à«‹àª«àª¤àª¾', ' Paneer Kofta', ' 260', '2025-08-12 16:32:55'),
(48, 'paneer', ' àªªàª¨à«€àª° àª­à«àª°à«àªœ (àª…àª¡àª§à«àª‚)', ' Paneer Bhurji (Half)', ' 120', '2025-08-12 16:32:55'),
(49, 'paneer', ' àªªàª¨à«€àª° àª­à«àª°à«àªœ (àª†àª–à«àª‚)', ' Paneer Bhurji (Full)', ' 190', '2025-08-12 16:32:55'),
(50, 'paneer', ' àª®àªŸàª° àªªàª¨à«€àª° (àª…àª¡àª§à«àª‚)', ' Matar Paneer (Half)', ' 120', '2025-08-12 16:32:55'),
(51, 'paneer', ' àª®àªŸàª° àªªàª¨à«€àª° (àª†àª–à«àª‚)', ' Matar Paneer (Full)', ' 160', '2025-08-12 16:32:55'),
(52, 'paneer', ' àªªàª¨à«€àª° àªšà«€àª àª®àª¸àª¾àª²àª¾ (àª…àª¡àª§à«àª‚)', ' Paneer Cheese Masala (Half)', ' 150', '2025-08-12 16:32:55'),
(53, 'paneer', ' àªªàª¨à«€àª° àªšà«€àª àª®àª¸àª¾àª²àª¾ (àª†àª–à«àª‚)', ' Paneer Cheese Masala (Full)', ' 260', '2025-08-12 16:32:55'),
(54, 'paneer', ' àª¸àª¾àª¹à«€ àªªàª¨à«€àª°', 'Shahi Paneer', ' 190', '2025-08-12 16:32:55'),
(55, 'paneer', ' àªªàª¨à«€àª° àª…àª‚àª—àª¾àª°àª¾', 'Paneer Angara', ' 260', '2025-08-12 16:32:55'),
(56, 'paneer', ' àªªàª¨à«€àª° àª¹àª¾àª‚àª¡à«€ (àª…àª¡àª§à«àª‚)', ' Paneer Handi (Half)', ' 110', '2025-08-12 16:32:55'),
(57, 'paneer', ' àªªàª¨à«€àª° àª¹àª¾àª‚àª¡à«€ (àª†àª–à«àª‚)', ' Paneer Handi (Full)', ' 180', '2025-08-12 16:32:55'),
(58, 'paneer', ' àªªàª¨à«€àª° àª¬àª¾àª°à«àª¬à«‡àª•à«àª¯à«‚ àª®àª¸àª¾àª²àª¾', ' Paneer Barbeque Masala', ' 260', '2025-08-12 16:32:55'),
(59, 'paneer', ' àªªàª¨à«€àª° àª¶àª¹à«‡àª¨àª¶àª¾àª¹ àª®àª¸àª¾àª²àª¾', ' Paneer Shahenshah Masala', ' 190', '2025-08-12 16:32:55'),
(60, 'paneer', ' àªªàª¨à«€àª° àª¬à«àª²à«‡àªŸ àª®àª¸àª¾àª²àª¾', ' Paneer Bullets Masala', ' 260', '2025-08-12 16:32:55'),
(61, 'paneer', ' àªªàª¨à«€àª° àª•Jàª°àª¿àª¶à«àª®àª¾ àª®àª¸àª¾àª²àª¾', ' Paneer Karishma Masala', ' 200', '2025-08-12 16:32:55');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_id` varchar(255) NOT NULL,
  `t_id` varchar(256) NOT NULL,
  `c_name` varchar(256) NOT NULL,
  `c_num` varchar(256) NOT NULL,
  `status` enum('pending','paid') NOT NULL DEFAULT 'pending',
  `sub_total` decimal(10,2) DEFAULT '0.00',
  `cgst` decimal(10,2) DEFAULT '0.00',
  `sgst` decimal(10,2) DEFAULT '0.00',
  `grand_total` decimal(10,2) DEFAULT '0.00',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE IF NOT EXISTS `order_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_id` varchar(255) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `menu_item_id` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `total` decimal(10,2) GENERATED ALWAYS AS ((`quantity` * `price`)) STORED NOT NULL,
  `status` enum('pending','delivered') NOT NULL DEFAULT 'pending',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tables`
--

DROP TABLE IF EXISTS `tables`;
CREATE TABLE IF NOT EXISTS `tables` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `t_num` varchar(256) NOT NULL,
  `status` enum('available','not_available') NOT NULL DEFAULT 'available',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tables`
--

INSERT INTO `tables` (`id`, `t_num`, `status`) VALUES
(1, '1', 'available'),
(2, '2', 'not_available'),
(3, '3', 'available'),
(4, '4', 'available'),
(5, '5', 'available'),
(6, '6', 'available'),
(7, '7', 'available'),
(8, '8', 'available'),
(9, '9', 'available');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` enum('admin','staff') NOT NULL DEFAULT 'staff',
  `status` enum('active','deactive','delete') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `role`, `status`, `date`) VALUES
(1, 'aa aa', 'aa', 'aa', 'admin', 'active', '2025-07-21 10:03:29');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
