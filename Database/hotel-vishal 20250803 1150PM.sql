-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 03, 2025 at 06:19 PM
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
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu_items`
--

INSERT INTO `menu_items` (`id`, `cat`, `gu_name`, `en_name`, `price`, `date`) VALUES
(1, 'Kaju', 'કાજુ કારી', 'Kaju Curry', '220.00', '2025-07-10 10:34:56'),
(2, 'Kaju', 'કાજુ પનીર', 'Kaju Paneer', '230', '2025-07-10 10:34:56'),
(3, 'Kaju', 'પનીર બટર મસાલા', 'Paneer Butter Masala', '200', '2025-07-10 10:34:56'),
(4, 'Kaju', 'શાહી પનીર', 'Shahi Paneer', '210', '2025-07-10 10:34:56'),
(5, 'Kaju', 'પનીર ટikka મસાલા', 'Paneer Tikka Masala', '220', '2025-07-10 10:34:56'),
(6, 'Chinese', 'વેજ ફ્રાઈડ રાઈસ', 'Veg Fried Rice', '130', '2025-07-10 10:34:56'),
(7, 'Chinese', 'વેજ નૂડલ્સ', 'Veg Noodles', '130', '2025-07-10 10:34:56'),
(8, 'Chinese', 'ચીલી પનીર', 'Chilli Paneer', '160', '2025-07-10 10:34:56'),
(9, 'Chinese', 'મંચુરિયન', 'Manchurian', '150', '2025-07-10 10:34:56'),
(10, 'Chinese', 'સ્કેજવાન રાઈસ', 'Schezwan Rice', '150', '2025-07-10 10:34:56'),
(11, 'South Indian', 'ઇડલી-સાંભર', 'Idli Sambar', '70', '2025-07-10 10:34:56'),
(12, 'South Indian', 'મસાલા ડોસા', 'Masala Dosa', '90', '2025-07-10 10:34:56'),
(13, 'South Indian', 'ઉતપમ', 'Uttapam', '80', '2025-07-10 10:34:56'),
(14, 'South Indian', 'મેડુ વડા', 'Medu Vada', '70', '2025-07-10 10:34:56'),
(15, 'Tandoor', 'તANDOORI રોટી', 'Tandoori Roti', '25', '2025-07-10 10:34:56'),
(16, 'Tandoor', 'બટર નાન', 'Butter Naan', '40', '2025-07-10 10:34:56'),
(17, 'Tandoor', 'લચ્છા પરોઠા', 'Lachha Paratha', '45', '2025-07-10 10:34:56'),
(18, 'Tandoor', 'સ્ટફ નાન', 'Stuffed Naan', '60', '2025-07-10 10:34:56'),
(19, 'Soups', 'વેજ મંચાઉ', 'Veg Manchow', '70', '2025-07-10 10:34:56'),
(20, 'Soups', 'ટામેટા સૂપ', 'Tomato Soup', '60', '2025-07-10 10:34:56'),
(21, 'Soups', 'સ્વીટ કોર્ન', 'Sweet Corn Soup', '70', '2025-07-10 10:34:56'),
(22, 'Soups', 'હોટ એન્ડ સોર', 'Hot & Sour', '70', '2025-07-10 10:34:56'),
(23, 'Papad', 'ફ્રાય પાપડ', 'Fried Papad', '20', '2025-07-10 10:34:56'),
(24, 'Papad', 'રોસ્ટ પાપડ', 'Roasted Papad', '15', '2025-07-10 10:34:56'),
(25, 'Papad', 'મસાલા પાપડ', 'Masala Papad', '30', '2025-07-10 10:34:56'),
(26, 'Veg Sabji', 'મિક્સ વેજ', 'Mix Veg', '150', '2025-07-10 10:34:56'),
(27, 'Veg Sabji', 'આલૂ મટર', 'Aloo Matar', '130', '2025-07-10 10:34:56'),
(28, 'Veg Sabji', 'ભીંડા મસાલા', 'Bhindi Masala', '140', '2025-07-10 10:34:56'),
(29, 'Veg Sabji', 'બૈંગન ભરતા', 'Baingan Bharta', '130', '2025-07-10 10:34:56'),
(30, 'Veg Sabji', 'ટમેટા સેવ', 'Tameta Sev', '120', '2025-07-10 10:34:56'),
(31, 'Dal & Rice', 'તુવેર દાળ', 'Tuver Dal', '100', '2025-07-10 10:34:56'),
(32, 'Dal & Rice', 'દાળ તડકા', 'Dal Tadka', '120', '2025-07-10 10:34:56'),
(33, 'Dal & Rice', 'વેજ પુલાવ', 'Veg Pulao', '130', '2025-07-10 10:34:56'),
(34, 'Dal & Rice', 'જીરા રાઈસ', 'Jeera Rice', '110', '2025-07-10 10:34:56'),
(35, 'Dal & Rice', 'દાળ ખિચડી', 'Dal Khichdi', '150', '2025-07-10 10:34:56'),
(36, 'Starters', 'હરીયાળી કબાબ', 'Haryali Kebab', '160', '2025-07-10 10:34:56'),
(37, 'Starters', 'પનીર ટીક્કા', 'Paneer Tikka', '190', '2025-07-10 10:34:56'),
(38, 'Starters', 'વેજ ફિંગર', 'Veg Finger', '150', '2025-07-10 10:34:56'),
(39, 'Starters', 'ચીલી પોટેટો', 'Chilli Potato', '140', '2025-07-10 10:34:56'),
(40, 'Starters', 'ડ્રાય મંચુરિયન', 'Dry Manchurian', '160', '2025-07-10 10:34:56');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `t_id` varchar(256) NOT NULL,
  `c_name` varchar(256) NOT NULL,
  `c_num` varchar(256) NOT NULL,
  `status` enum('pending','paid') NOT NULL DEFAULT 'pending',
  `sub_total` varchar(256) DEFAULT NULL,
  `cgst` decimal(10,2) DEFAULT '0.00',
  `sgst` decimal(10,2) DEFAULT '2.50',
  `grand_total` decimal(10,2) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `t_id`, `c_name`, `c_num`, `status`, `sub_total`, `cgst`, `sgst`, `grand_total`, `date`) VALUES
(1, '2', 'karan', '9099474398', 'paid', '', '0.00', '0.00', '0.00', '2025-07-11 07:32:26'),
(2, '2', 'vishal', '9876543210', 'pending', '', '0.00', '0.00', '0.00', '2025-07-11 10:22:43'),
(4, '6', 'dhaval vaghela', '9558969444', 'pending', '', '0.00', '0.00', '0.00', '2025-08-02 14:21:16'),
(5, '3', 'nimisha', '98754142360', 'pending', NULL, '0.00', '2.50', NULL, '2025-08-03 18:18:36');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE IF NOT EXISTS `order_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `menu_item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `total` decimal(10,2) GENERATED ALWAYS AS ((`quantity` * `price`)) STORED NOT NULL,
  `status` enum('pending','delivered') NOT NULL DEFAULT 'pending',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `menu_item_id` (`menu_item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `menu_item_id`, `quantity`, `price`, `status`, `date`) VALUES
(2, 1, 2, 1, '230.00', 'delivered', '2025-08-02 15:23:42'),
(3, 1, 3, 1, '200.00', 'delivered', '2025-08-02 15:23:42'),
(6, 1, 3, 1, '200.00', 'delivered', '2025-08-02 15:29:41'),
(7, 2, 18, 1, '60.00', 'delivered', '2025-08-02 15:31:17'),
(10, 1, 38, 1, '150.00', 'delivered', '2025-08-03 17:49:26'),
(11, 2, 33, 1, '130.00', 'delivered', '2025-08-03 17:50:29');

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
(6, '6', 'not_available'),
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

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`menu_item_id`) REFERENCES `menu_items` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
