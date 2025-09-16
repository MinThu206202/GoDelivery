-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 16, 2025 at 06:15 AM
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
-- Database: `godelivery`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `Insertroute` (IN `in_from_city_id` INT, IN `in_from_township_id` INT, IN `in_to_city_id` INT, IN `in_to_township_id` INT, IN `in_distance` DECIMAL(6,2), IN `in_price` DECIMAL(10,2), IN `in_status` VARCHAR(20), IN `in_time` INT)   BEGIN
INSERT INTO route(
	from_city_id,
    from_township_id,
    to_city_id,
    to_township_id,
    distance,
    price,
    status,
    created_at,
    updated_at,
    time
)VALUES(
	in_from_city_id,
    in_from_township_id,
    in_to_city_id,
    in_to_township_id,
    in_distance,
    in_price,
    in_status,
    NOW(),
    NOW(),
    in_time
);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertuser` (IN `in_name` VARCHAR(45), IN `in_phone` VARCHAR(20), IN `in_email` VARCHAR(25), IN `in_region_id` INT, IN `in_city_id` INT, IN `in_township_id` INT, IN `in_ward_id` INT, IN `in_address` VARCHAR(25), IN `in_password` VARCHAR(50), IN `in_otp_code` INT(10), IN `in_otp_expiry` TIME, IN `in_security_code` INT(10), IN `in_role_id` INT, IN `in_status_id` INT, IN `in_created_at` TIME, IN `in_is_login` INT, IN `in_access_code` VARCHAR(50))   BEGIN
INSERT INTO users(
	name,
    phone,
    email,
    region_id,
    city_id,
    township_id,
    ward_id,
    address,
    password,
    otp_code,
    otp_expiry,
    security_code,
    role_id,
    status_id,
    created_at,
    is_login,
    access_code
)VALUES(
	in_name,
    in_phone,
    in_email,
    in_region_id,
    in_city_id,
    in_township_id,
    in_ward_id,
    in_address,
    in_password,
    in_otp_code,
    in_otp_expiry,
    in_security_code,
    in_role_id,
    in_status_id,
    in_created_at,
    in_is_login,
    in_access_code
);
END$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `Calculateprice` (`distance` INT) RETURNS INT(11) DETERMINISTIC BEGIN
	RETURN 1500 + (distance * 20);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `agent_notifications`
--

CREATE TABLE `agent_notifications` (
  `id` int(11) NOT NULL,
  `from_agent_id` int(11) NOT NULL,
  `to_agent_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `agent_notifications`
--

INSERT INTO `agent_notifications` (`id`, `from_agent_id`, `to_agent_id`, `type_id`, `title`, `message`, `created_at`) VALUES
(1, 4, 2, 2, 'Route Activated', 'Route from Mandalay to Meiktila is now active.', '2025-09-15 14:35:38'),
(2, 4, 5, 2, 'Route Activated', 'Route from Mandalay to Meiktila is now active.', '2025-09-15 14:35:38'),
(3, 4, 7, 2, 'Route Activated', 'Route from Mandalay to Meiktila is now active.', '2025-09-15 14:35:38'),
(4, 4, 2, 2, 'Route Activated', 'Route from Yangon to Meiktila is now active.', '2025-09-15 15:09:27'),
(5, 4, 5, 2, 'Route Activated', 'Route from Yangon to Meiktila is now active.', '2025-09-15 15:09:27'),
(6, 4, 7, 2, 'Route Activated', 'Route from Yangon to Meiktila is now active.', '2025-09-15 15:09:27'),
(7, 4, 226, 2, 'Route Activated', 'Route from Yangon to Meiktila is now active.', '2025-09-15 15:09:27'),
(8, 4, 2, 2, 'Route Activated', 'Route from Meiktila to Yangon is now active.', '2025-09-15 15:10:16'),
(9, 4, 5, 2, 'Route Activated', 'Route from Meiktila to Yangon is now active.', '2025-09-15 15:10:16'),
(10, 4, 7, 2, 'Route Activated', 'Route from Meiktila to Yangon is now active.', '2025-09-15 15:10:16'),
(11, 4, 226, 2, 'Route Activated', 'Route from Meiktila to Yangon is now active.', '2025-09-15 15:10:16'),
(12, 226, 5, 1, 'New Delivery Available!', 'A new delivery request (Order ID: #MKL567190YGN) is available for acceptance. Check \'Request Deliveries\'.', '2025-09-15 19:41:09'),
(13, 226, 5, 1, 'New Delivery Available!', 'A new delivery request (Order ID: #MKL545169YGN) is available for acceptance. Check \'Request Deliveries\'.', '2025-09-15 19:42:20'),
(14, 226, 5, 1, 'New Delivery Available!', 'A new delivery request (Order ID: #MKL511951YGN) is available for acceptance. Check \'Request Deliveries\'.', '2025-09-15 19:44:18'),
(15, 226, 5, 1, 'New Delivery Available!', 'A new delivery request (Order ID: #MKL549612YGN) is available for acceptance. Check \'Request Deliveries\'.', '2025-09-15 19:45:36'),
(16, 226, 5, 1, 'New Delivery Request', 'New request received for Delivery MKL567190YGN', '2025-09-15 19:46:26'),
(17, 5, 226, 1, 'Delivery Accepted!', 'You accepted delivery: MKL567190YGN. Proceed to pickup.', '2025-09-15 15:16:50'),
(18, 5, 226, 2, 'Delivery At Office', 'Delivery MKL567190YGN marked as \'Arrived at Office\'. Ready for next processing.', '2025-09-15 19:47:14'),
(19, 226, 5, 1, 'New Delivery Request', 'New request received for Delivery MKL545169YGN', '2025-09-15 19:52:50'),
(20, 5, 226, 3, 'Delivery Reject!', 'Your  delivery: MKL545169YGN is Reject.Try Again.', '2025-09-15 15:23:01'),
(21, 226, 5, 1, 'New Delivery Request', 'New request received for Delivery MKL545169YGN', '2025-09-15 19:53:54'),
(22, 5, 226, 1, 'Delivery Accepted!', 'You accepted delivery: MKL545169YGN. Proceed to pickup.', '2025-09-15 15:23:58'),
(23, 5, 226, 2, 'Delivery At Office', 'Delivery MKL545169YGN marked as \'Arrived at Office\'. Ready for next processing.', '2025-09-15 19:54:19'),
(24, 5, 226, 3, 'Delivery Returned!', 'Your delivery with tracking code MKL545169YGN has been returned. Please proceed to pick it up.', '2025-09-15 20:13:11'),
(25, 226, 5, 1, 'New Delivery Request', 'New request received for Delivery MKL511951YGN', '2025-09-15 20:17:38'),
(26, 5, 226, 1, 'Delivery Accepted!', 'You accepted delivery: MKL511951YGN. Proceed to pickup.', '2025-09-15 15:47:56'),
(27, 5, 226, 2, 'Delivery At Office', 'Delivery MKL511951YGN marked as \'Arrived at Office\'. Ready for next processing.', '2025-09-15 20:19:45'),
(28, 5, 226, 2, 'Delivery Successful!', 'Your delivery with tracking code MKL567190YGN has been successfully delivered to the customer.', '2025-09-15 20:30:52'),
(29, 5, 226, 2, 'Delivery Successful!', 'Your delivery with tracking code MKL567190YGN has been successfully delivered to the customer.', '2025-09-15 20:36:51'),
(30, 5, 226, 2, 'Delivery Successful!', 'Your delivery with tracking code MKL567190YGN has been successfully delivered to the customer.', '2025-09-15 20:43:05'),
(31, 5, 226, 2, 'Delivery Successful!', 'Your delivery with tracking code MKL567190YGN has been successfully delivered to the customer.', '2025-09-15 20:45:11'),
(32, 5, 226, 2, 'Delivery Successful!', 'Your delivery with tracking code MKL567190YGN has been successfully delivered to the customer.', '2025-09-15 20:46:26'),
(33, 5, 226, 2, 'Delivery Successful!', 'Your delivery with tracking code MKL567190YGN has been successfully delivered to the customer.', '2025-09-15 16:20:49'),
(34, 121, 226, 5, 'New Pickup Request', '📦 New Pickup Request #PR-MKL-561263 from MI MI Min Thu at mdm. Please proceed with collection.', '2025-09-15 20:52:53'),
(35, 226, 121, 8, 'Pickup Request Confirmed', 'Your pickup request #PR-MKL-561263 has been confirmed. An agent will arrive soon at mdm.', '2025-09-15 20:56:53'),
(36, 226, 237, 8, 'New Pickup Assignment Confirmed', 'You have been assigned to pickup request #PR-MKL-561263. Please collect the parcel from mdm.', '2025-09-15 20:56:53'),
(37, 237, 121, 6, 'pickup agent on the way', '🚚 Your pickup agent is on the way for request #PR-MKL-561263. Please be ready at mdm.', '2025-09-15 20:57:27'),
(38, 4, 226, 4, 'Pickup Agent Activated!', 'Hello, your Pickup Agent Mi MI account has been successfully activated. You can now log in and start managing deliveries. Use the security code sent to your email for your first login.', '2025-09-15 16:51:49'),
(39, 4, 226, 4, 'Pickup Agent Deactivated', 'Your Pickup Agent Mi MI account has been deactivated. You no longer have access to the system. Please contact support if you believe this is a mistake.', '2025-09-15 21:26:14'),
(40, 4, 2, 2, 'Route Activated', 'Route from Yangon to Mandalay is now active.', '2025-09-15 21:22:27'),
(41, 4, 5, 2, 'Route Activated', 'Route from Yangon to Mandalay is now active.', '2025-09-15 21:22:27'),
(42, 4, 7, 2, 'Route Activated', 'Route from Yangon to Mandalay is now active.', '2025-09-15 21:22:27'),
(43, 4, 226, 2, 'Route Activated', 'Route from Yangon to Mandalay is now active.', '2025-09-15 21:22:27'),
(44, 4, 2, 2, 'Route Activated', 'Route from Meiktila to Mandalay is now active.', '2025-09-15 21:23:20'),
(45, 4, 5, 2, 'Route Activated', 'Route from Meiktila to Mandalay is now active.', '2025-09-15 21:23:20'),
(46, 4, 7, 2, 'Route Activated', 'Route from Meiktila to Mandalay is now active.', '2025-09-15 21:23:20'),
(47, 4, 226, 2, 'Route Activated', 'Route from Meiktila to Mandalay is now active.', '2025-09-15 21:23:20'),
(48, 5, 226, 1, 'New Delivery Available!', 'A new delivery request (Order ID: #YGN154428MKL) is available for acceptance. Check \'Request Deliveries\'.', '2025-09-16 03:30:49'),
(49, 121, 5, 5, 'New Pickup Request', '📦 New Pickup Request #PR-INS-465940 from MI MI Min Thu at Yangon. Please proceed with collection.', '2025-09-16 03:32:23'),
(50, 5, 226, 1, 'New Delivery Request', 'New request received for Delivery YGN154428MKL', '2025-09-16 03:55:52'),
(51, 5, 2, 1, 'New Delivery Available!', 'A new delivery request (Order ID: #YGN866141MDY) is available for acceptance. Check \'Request Deliveries\'.', '2025-09-16 03:57:31'),
(52, 5, 2, 1, 'New Delivery Request', 'New request received for Delivery YGN866141MDY', '2025-09-16 03:57:42'),
(53, 2, 5, 1, 'Delivery Accepted!', 'You accepted delivery: YGN866141MDY. Proceed to pickup.', '2025-09-15 23:27:56'),
(54, 2, 5, 2, 'Delivery At Office', 'Delivery YGN866141MDY marked as \'Arrived at Office\'. Ready for next processing.', '2025-09-16 03:58:22'),
(55, 2, 5, 2, 'Delivery Successful!', 'Your delivery with tracking code YGN866141MDY has been successfully delivered to the customer.', '2025-09-16 03:59:51'),
(56, 5, 121, 8, 'Pickup Request Confirmed', 'Your pickup request #PR-INS-465940 has been confirmed. An agent will arrive soon at Yangon.', '2025-09-16 04:01:37'),
(57, 5, 134, 8, 'New Pickup Assignment Confirmed', 'You have been assigned to pickup request #PR-INS-465940. Please collect the parcel from Yangon.', '2025-09-16 04:01:37'),
(58, 134, 121, 6, 'pickup agent on the way', '🚚 Your pickup agent is on the way for request #PR-INS-465940. Please be ready at Yangon.', '2025-09-16 04:02:07');

-- --------------------------------------------------------

--
-- Table structure for table `available_location`
--

CREATE TABLE `available_location` (
  `id` int(11) NOT NULL,
  `region_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `township_id` int(11) NOT NULL,
  `agent_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status_location_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `available_location`
--

INSERT INTO `available_location` (`id`, `region_id`, `city_id`, `township_id`, `agent_id`, `created_at`, `updated_at`, `status_location_id`) VALUES
(1, 1, 1, 1, 5, '2025-07-30 09:30:10', '2025-09-10 17:47:21', 1),
(5, 2, 2, 3, 2, '2025-07-30 09:30:10', '2025-08-21 08:24:28', 1),
(65, 1, 11, 23, 226, '2025-09-15 19:29:28', '2025-09-15 19:30:39', 1),
(66, 1, 1, 2, NULL, '2025-09-16 01:54:58', '2025-09-16 01:54:58', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `region_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `region_id`, `name`) VALUES
(1, 1, 'Yangon'),
(2, 2, 'Mandalay'),
(11, 2, 'Meiktila');

-- --------------------------------------------------------

--
-- Table structure for table `deliveries`
--

CREATE TABLE `deliveries` (
  `id` int(11) NOT NULL,
  `sender_agent_id` int(11) DEFAULT NULL,
  `receiver_agent_id` int(11) DEFAULT NULL,
  `sender_customer_id` int(11) DEFAULT NULL,
  `receiver_customer_id` int(11) DEFAULT NULL,
  `weight` decimal(10,2) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `delivery_status_id` int(11) DEFAULT NULL,
  `payment_status_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `product_type` varchar(100) DEFAULT NULL,
  `tracking_code` varchar(50) DEFAULT NULL,
  `duration` datetime DEFAULT NULL,
  `from_township_id` int(11) DEFAULT NULL,
  `to_township_id` int(11) DEFAULT NULL,
  `from_city_id` int(11) DEFAULT NULL,
  `to_city_id` int(11) DEFAULT NULL,
  `from_region_id` int(11) DEFAULT NULL,
  `to_region_id` int(11) DEFAULT NULL,
  `delivery_type_id` int(11) DEFAULT NULL,
  `piece_count` int(11) DEFAULT NULL,
  `pickupagent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `deliveries`
--

INSERT INTO `deliveries` (`id`, `sender_agent_id`, `receiver_agent_id`, `sender_customer_id`, `receiver_customer_id`, `weight`, `amount`, `delivery_status_id`, `payment_status_id`, `created_at`, `updated_at`, `product_type`, `tracking_code`, `duration`, `from_township_id`, `to_township_id`, `from_city_id`, `to_city_id`, `from_region_id`, `to_region_id`, `delivery_type_id`, `piece_count`, `pickupagent_id`) VALUES
(80, 226, 5, 229, 230, 1.80, 13500.00, 3, 2, '2025-09-15 19:41:09', '2025-09-15 20:50:58', 'fdg', 'MKL567190YGN', '2025-09-17 02:11:09', 23, 1, 11, 1, 2, 1, 1, 4, 134),
(81, 5, 226, 229, 230, 1.80, 13500.00, 17, 1, '2025-09-15 19:42:20', '2025-09-15 20:13:11', 'fdg', 'MKL545169YGN', '2025-09-17 02:12:20', 23, 1, 11, 1, 2, 1, 1, 4, 134),
(82, 226, 5, 229, 230, 1.80, 13500.00, 3, 1, '2025-09-15 19:44:18', '2025-09-15 20:23:54', 'fdg', 'MKL511951YGN', '2025-09-17 02:14:18', 23, 1, 11, 1, 2, 1, 1, 4, 134),
(83, 226, 5, 229, 230, 1.80, 13500.00, 1, 1, '2025-09-15 19:45:36', '2025-09-15 19:45:36', 'fdg', 'MKL549612YGN', '2025-09-17 02:15:36', 23, 1, 11, 1, 2, 1, 1, 4, NULL),
(84, 226, 5, 239, 238, 1.00, 7500.00, 4, 1, '2025-09-15 20:58:15', '2025-09-15 20:58:24', '1', 'MKL798147YGN', '2025-09-17 03:28:15', 23, 1, 11, 1, 2, 1, 1, 2, NULL),
(85, 5, 226, 243, 237, 4.00, 30000.00, 6, 1, '2025-09-16 03:30:49', '2025-09-16 03:55:52', 'Clothes', 'YGN154428MKL', '2025-09-17 10:00:49', 1, 23, 1, 11, 1, 2, 1, 3, NULL),
(86, 5, 2, 226, 246, 1.00, 7500.00, 3, 1, '2025-09-16 03:57:31', '2025-09-16 04:00:01', 'Clothes', 'YGN866141MDY', '2025-09-17 10:27:31', 1, 3, 1, 2, 1, 2, 1, 3, 133);

-- --------------------------------------------------------

--
-- Table structure for table `delivery_statuses`
--

CREATE TABLE `delivery_statuses` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `delivery_statuses`
--

INSERT INTO `delivery_statuses` (`id`, `name`) VALUES
(1, 'Pending'),
(2, 'Ready for Pickup'),
(3, 'Delivered'),
(4, 'Cancelled'),
(5, 'Returned'),
(6, 'Awaiting Acceptance'),
(7, 'Rejected'),
(8, 'Out for Delivery'),
(9, 'Deliver Parcel'),
(10, 'Waiting Payment'),
(11, 'Receipt Submitted'),
(12, 'Payment Success'),
(13, 'On the Way'),
(14, 'Delivery at Office'),
(15, 'Rejected by Agent'),
(16, 'Payment Reject'),
(17, 'Return Back');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_status_history`
--

CREATE TABLE `delivery_status_history` (
  `id` int(11) NOT NULL,
  `delivery_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `changed_by` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `changed_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `delivery_status_history`
--

INSERT INTO `delivery_status_history` (`id`, `delivery_id`, `status_id`, `changed_by`, `note`, `changed_at`) VALUES
(67, 80, 1, NULL, NULL, NULL),
(68, 81, 1, NULL, NULL, NULL),
(69, 82, 1, NULL, NULL, NULL),
(70, 83, 1, NULL, NULL, NULL),
(71, 80, 13, 226, NULL, '2025-09-16 02:17:03'),
(72, 80, 14, 226, NULL, '2025-09-16 02:17:14'),
(73, 81, 13, 226, NULL, '2025-09-16 02:24:03'),
(74, 81, 14, 226, NULL, '2025-09-16 02:24:19'),
(75, 82, 13, 226, NULL, '2025-09-16 02:48:08'),
(76, 82, 14, 226, NULL, '2025-09-16 02:49:45'),
(77, 85, 1, NULL, NULL, NULL),
(78, 86, 1, NULL, NULL, NULL),
(79, 86, 13, 5, NULL, '2025-09-16 10:28:07'),
(80, 86, 14, 5, NULL, '2025-09-16 10:28:22');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_type`
--

CREATE TABLE `delivery_type` (
  `id` int(11) NOT NULL,
  `type_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `delivery_type`
--

INSERT INTO `delivery_type` (`id`, `type_name`) VALUES
(2, 'Express'),
(4, 'Important'),
(3, 'In-City'),
(1, 'Normal');

-- --------------------------------------------------------

--
-- Table structure for table `location_status`
--

CREATE TABLE `location_status` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `location_status`
--

INSERT INTO `location_status` (`id`, `name`) VALUES
(1, 'active'),
(2, 'inactive'),
(3, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `notification_types`
--

CREATE TABLE `notification_types` (
  `id` int(11) NOT NULL,
  `type_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notification_types`
--

INSERT INTO `notification_types` (`id`, `type_name`) VALUES
(7, 'Delivery_complete'),
(4, 'from_agent'),
(3, 'from_delivery_issue'),
(2, 'my_delivery'),
(6, 'on_its_way'),
(8, 'pickup_confirmed'),
(5, 'pickup_request'),
(9, 'Rejected'),
(1, 'request_delivery');

-- --------------------------------------------------------

--
-- Table structure for table `parcel_type`
--

CREATE TABLE `parcel_type` (
  `id` int(10) UNSIGNED NOT NULL,
  `type_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parcel_type`
--

INSERT INTO `parcel_type` (`id`, `type_name`) VALUES
(1, 'Document'),
(2, 'Box'),
(3, 'Fragile'),
(4, 'Food'),
(5, 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `payment_history`
--

CREATE TABLE `payment_history` (
  `id` int(11) NOT NULL,
  `deliveries_id` int(11) NOT NULL,
  `payment_method_id` int(11) NOT NULL,
  `agent_id` int(11) NOT NULL,
  `receipt_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_history`
--

INSERT INTO `payment_history` (`id`, `deliveries_id`, `payment_method_id`, `agent_id`, `receipt_image`, `created_at`) VALUES
(3, 80, 5, 5, 'public/uploads/payment_68c87bc062c437.21814939_Image14-09-2025at1053PM.jpeg', '2025-09-15 20:49:04');

-- --------------------------------------------------------

--
-- Stand-in structure for view `payment_history_view`
-- (See below for the actual view)
--
CREATE TABLE `payment_history_view` (
`payment_history_id` int(11)
,`deliveries_id` int(11)
,`tracking_code` varchar(50)
,`amount` decimal(10,2)
,`receiver_customer_name` varchar(100)
,`payment_method_id` int(11)
,`payment_method_name` varchar(50)
,`payment_method_number` varchar(50)
,`payment_type_name` varchar(50)
,`agent_id` int(11)
,`agent_name` varchar(100)
,`receipt_image` varchar(255)
,`created_at` timestamp
,`delivery_status_id` int(11)
,`delivery_status_name` varchar(50)
);

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` int(11) NOT NULL,
  `create_by_agent_id` int(11) NOT NULL,
  `payment_type_id` int(11) NOT NULL,
  `method_name` varchar(50) NOT NULL,
  `method_image` varchar(255) DEFAULT NULL,
  `method_number` varchar(50) DEFAULT NULL,
  `account_holder` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `create_by_agent_id`, `payment_type_id`, `method_name`, `method_image`, `method_number`, `account_holder`) VALUES
(3, 5, 2, 'Min Min', 'public/uploads/payment_68c6f681a3e403.03791600_Image14-09-2025at458PM.jpeg', '09980810815', 'Min Thu'),
(4, 5, 2, 'KBZ Pay', 'public/uploads/payment_68ad3e7d04a757.50442944_Image25-08-2025at958PM.jpeg', '09772528282', 'Min Thu'),
(5, 5, 3, 'CB Pay', 'public/uploads/payment_68ad3ea15b5c86.59120532_Image23-08-2025at845PM.jpeg', '2399383992993', 'Min Thu'),
(6, 5, 2, 'Wave', 'public/uploads/payment_68ad659484c4a7.36426829_IMG_14082.jpeg', '09681375111', 'Min Thu'),
(7, 2, 2, 'KBZ Pay', 'public/uploads/payment_68bc452fd467b2.80980093_IMG_14082.jpeg', '09772528282', 'Min THu');

-- --------------------------------------------------------

--
-- Stand-in structure for view `payment_methods_view`
-- (See below for the actual view)
--
CREATE TABLE `payment_methods_view` (
`id` int(11)
,`payment_type_id` int(11)
,`name` varchar(50)
,`method_name` varchar(50)
,`method_image` varchar(255)
,`method_number` varchar(50)
,`account_holder` varchar(100)
,`create_by_agent_id` int(11)
,`created_by_agent_name` varchar(100)
);

-- --------------------------------------------------------

--
-- Table structure for table `payment_statuses`
--

CREATE TABLE `payment_statuses` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_statuses`
--

INSERT INTO `payment_statuses` (`id`, `name`) VALUES
(1, 'Sender Pay'),
(2, 'Receiver Pay'),
(3, 'Prepaid');

-- --------------------------------------------------------

--
-- Table structure for table `payment_types`
--

CREATE TABLE `payment_types` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_types`
--

INSERT INTO `payment_types` (`id`, `name`) VALUES
(1, 'Cash'),
(2, 'Online'),
(3, 'Banking');

-- --------------------------------------------------------

--
-- Table structure for table `pickup_requests`
--

CREATE TABLE `pickup_requests` (
  `id` int(10) UNSIGNED NOT NULL,
  `sender_id` int(11) UNSIGNED DEFAULT NULL,
  `request_code` varchar(50) NOT NULL,
  `sender_address` text NOT NULL,
  `landmark` varchar(255) DEFAULT NULL,
  `sender_region_id` int(11) NOT NULL,
  `sender_city_id` int(11) NOT NULL,
  `sender_township_id` int(11) NOT NULL,
  `receiver_name` varchar(100) DEFAULT NULL,
  `receiver_email` varchar(100) DEFAULT NULL,
  `receiver_phone` varchar(20) DEFAULT NULL,
  `receiver_address` text DEFAULT NULL,
  `receiver_region_id` int(11) DEFAULT NULL,
  `receiver_city_id` int(11) DEFAULT NULL,
  `receiver_township_id` int(11) DEFAULT NULL,
  `parcel_type_id` int(10) UNSIGNED NOT NULL,
  `delivery_type_id` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `amount` decimal(10,2) DEFAULT NULL,
  `payment_type_id` int(10) UNSIGNED DEFAULT NULL,
  `payment_method_id` int(10) UNSIGNED DEFAULT NULL,
  `payment_status_id` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `weight` varchar(20) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `preferred_date` date NOT NULL,
  `agent_id` int(11) NOT NULL,
  `pickup_agent_id` int(11) DEFAULT NULL,
  `status_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `method_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pickup_requests`
--

INSERT INTO `pickup_requests` (`id`, `sender_id`, `request_code`, `sender_address`, `landmark`, `sender_region_id`, `sender_city_id`, `sender_township_id`, `receiver_name`, `receiver_email`, `receiver_phone`, `receiver_address`, `receiver_region_id`, `receiver_city_id`, `receiver_township_id`, `parcel_type_id`, `delivery_type_id`, `amount`, `payment_type_id`, `payment_method_id`, `payment_status_id`, `weight`, `quantity`, `preferred_date`, `agent_id`, `pickup_agent_id`, `status_id`, `created_at`, `updated_at`, `method_image`) VALUES
(13, 121, 'PR-MKL-561263', 'mdm', 'MM', 2, 11, 23, 'mi', 'mint12696@gmail.com', '0977383883', 'SU Lay', 1, 1, 1, 1, 1, 7500.00, 1, NULL, 1, '1', 2, '2025-09-17', 226, 237, 15, '2025-09-15 16:22:53', '2025-09-15 20:58:15', NULL),
(14, 121, 'PR-INS-465940', 'Yangon', '', 1, 1, 1, 'Aung Thu', 'aungthu@gmail.com', '09441386934', 'Taw MA', 2, 11, 23, 1, 1, 7500.00, NULL, NULL, 1, '1', 1, '2025-09-17', 5, 134, 9, '2025-09-15 23:02:23', '2025-09-16 04:02:46', NULL);

-- --------------------------------------------------------

--
-- Stand-in structure for view `pickup_requests_view`
-- (See below for the actual view)
--
CREATE TABLE `pickup_requests_view` (
`id` int(10) unsigned
,`sender_id` int(11) unsigned
,`request_code` varchar(50)
,`sender_name` varchar(100)
,`sender_email` varchar(100)
,`sender_phone` varchar(20)
,`sender_address` text
,`landmark` varchar(255)
,`sender_region` varchar(100)
,`sender_city` varchar(100)
,`sender_township` varchar(100)
,`receiver_name` varchar(100)
,`receiver_email` varchar(100)
,`receiver_phone` varchar(20)
,`receiver_address` text
,`receiver_region` varchar(100)
,`receiver_city` varchar(100)
,`receiver_township` varchar(100)
,`parcel_type` varchar(50)
,`weight` varchar(20)
,`quantity` int(11)
,`preferred_date` date
,`agent_id` int(11)
,`agent_name` varchar(100)
,`pickup_agent_id` int(11)
,`pickup_agent_name` varchar(100)
,`status_id` int(10) unsigned
,`status` varchar(50)
,`delivery_type_id` int(10) unsigned
,`delivery_type_name` varchar(50)
,`payment_status_id` int(10) unsigned
,`payment_status_name` varchar(50)
,`amount` decimal(10,2)
,`payment_type_id` int(10) unsigned
,`payment_type` varchar(50)
,`payment_method_id` int(10) unsigned
,`payment_method` varchar(50)
,`method_image` varchar(255)
,`method_number` varchar(50)
,`created_at` timestamp
,`updated_at` timestamp
);

-- --------------------------------------------------------

--
-- Table structure for table `pickup_status`
--

CREATE TABLE `pickup_status` (
  `id` int(10) UNSIGNED NOT NULL,
  `status_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pickup_status`
--

INSERT INTO `pickup_status` (`id`, `status_name`) VALUES
(1, 'pending'),
(2, 'accepted'),
(3, 'collected'),
(4, 'on_the_way'),
(5, 'rejected'),
(6, 'waiting_for_receipt'),
(7, 'payment_success'),
(8, 'pickup_verified'),
(9, 'pickup_verification_pending'),
(10, 'payment_pending'),
(11, 'awaiting_cash'),
(12, 'cancelled'),
(13, 'receipt_submitted'),
(14, 'payment_reject'),
(15, 'voucher_created'),
(16, 'cash_collected'),
(17, 'arrived_at_user'),
(18, 'arrived_at_office'),
(19, 'pickup_failed');

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE `regions` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`id`, `name`) VALUES
(1, 'Yangon Region'),
(2, 'Mandalay Region');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'Admin'),
(2, 'Agent'),
(3, 'Customer'),
(4, 'Pickup Agent');

-- --------------------------------------------------------

--
-- Table structure for table `route`
--

CREATE TABLE `route` (
  `id` int(11) NOT NULL,
  `from_city_id` int(11) NOT NULL,
  `from_township_id` int(11) NOT NULL,
  `to_city_id` int(11) NOT NULL,
  `to_township_id` int(11) NOT NULL,
  `distance` decimal(6,2) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `route`
--

INSERT INTO `route` (`id`, `from_city_id`, `from_township_id`, `to_city_id`, `to_township_id`, `distance`, `price`, `status`, `created_at`, `updated_at`, `time`) VALUES
(1, 1, 1, 1, 1, 0.00, 0.00, 'active', '2025-09-15 19:07:53', '2025-09-15 19:07:53', 0),
(2, 1, 1, 1, 2, 12.00, 1200.00, 'active', '2025-09-15 19:07:53', '2025-09-15 19:07:53', 1),
(3, 1, 1, 2, 2, 600.00, 50000.00, 'active', '2025-09-15 19:07:53', '2025-09-15 19:07:53', 12),
(4, 1, 1, 2, 11, 610.00, 52000.00, 'active', '2025-09-15 19:07:53', '2025-09-15 19:07:53', 13),
(5, 1, 2, 1, 1, 12.00, 1200.00, 'active', '2025-09-15 19:07:53', '2025-09-15 19:07:53', 1),
(6, 1, 2, 1, 2, 0.00, 0.00, 'active', '2025-09-15 19:07:53', '2025-09-15 19:07:53', 0),
(7, 1, 2, 2, 2, 600.00, 50000.00, 'active', '2025-09-15 19:07:53', '2025-09-15 19:07:53', 12),
(8, 1, 2, 2, 11, 610.00, 52000.00, 'active', '2025-09-15 19:07:53', '2025-09-15 19:07:53', 13),
(9, 2, 2, 2, 2, 0.00, 0.00, 'active', '2025-09-15 19:07:53', '2025-09-15 19:07:53', 0),
(10, 2, 2, 2, 11, 50.00, 5000.00, 'active', '2025-09-15 19:07:53', '2025-09-15 19:07:53', 2),
(11, 2, 2, 1, 1, 600.00, 50000.00, 'active', '2025-09-15 19:07:53', '2025-09-15 19:07:53', 12),
(12, 2, 2, 1, 2, 610.00, 52000.00, 'active', '2025-09-15 19:07:53', '2025-09-15 19:07:53', 13),
(13, 2, 11, 2, 11, 0.00, 0.00, 'active', '2025-09-15 19:07:53', '2025-09-15 19:07:53', 0),
(14, 2, 11, 1, 1, 610.00, 52000.00, 'active', '2025-09-15 19:07:53', '2025-09-15 19:07:53', 13),
(15, 2, 11, 2, 2, 50.00, 5000.00, 'active', '2025-09-15 19:07:53', '2025-09-15 19:07:53', 2),
(16, 1, 1, 11, 23, 300.00, 7500.00, 'active', '2025-09-15 19:39:27', '2025-09-15 19:39:27', 24),
(17, 11, 23, 1, 1, 300.00, 7500.00, 'active', '2025-09-15 19:40:16', '2025-09-15 19:40:16', 24),
(18, 1, 1, 2, 3, 300.00, 7500.00, 'active', '2025-09-16 01:52:27', '2025-09-16 01:52:27', 24),
(19, 11, 23, 2, 3, 120.00, 3900.00, 'active', '2025-09-16 01:53:20', '2025-09-16 01:53:20', 10);

-- --------------------------------------------------------

--
-- Stand-in structure for view `route_full_info`
-- (See below for the actual view)
--
CREATE TABLE `route_full_info` (
`route_id` int(11)
,`from_city` varchar(100)
,`from_township` varchar(100)
,`to_city` varchar(100)
,`to_township` varchar(100)
,`distance` decimal(6,2)
,`time` int(11)
,`price` decimal(10,2)
,`status` enum('active','inactive')
,`created_at` timestamp
,`updated_at` timestamp
);

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE `statuses` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`id`, `name`) VALUES
(1, 'Active'),
(2, 'Inactive'),
(3, 'Suspended');

-- --------------------------------------------------------

--
-- Table structure for table `townships`
--

CREATE TABLE `townships` (
  `id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `townships`
--

INSERT INTO `townships` (`id`, `city_id`, `name`) VALUES
(1, 1, 'Insein Township'),
(2, 1, 'Lanmadaw Township'),
(3, 2, 'Chanayethazan Township'),
(23, 11, 'Meiktila Township');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `access_code` varchar(255) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `profile_image` varchar(255) NOT NULL DEFAULT 'default.png',
  `region_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `township_id` int(11) DEFAULT NULL,
  `ward_id` int(11) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `otp_code` varchar(10) DEFAULT NULL,
  `otp_expiry` datetime DEFAULT NULL,
  `security_code` varchar(100) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `created_by_agent` int(11) DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `is_login` tinyint(1) DEFAULT 0,
  `user_type_id` int(11) DEFAULT NULL,
  `vehicle_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `access_code`, `name`, `phone`, `email`, `profile_image`, `region_id`, `city_id`, `township_id`, `ward_id`, `address`, `password`, `otp_code`, `otp_expiry`, `security_code`, `role_id`, `created_by_agent`, `status_id`, `created_at`, `is_login`, `user_type_id`, `vehicle_id`) VALUES
(2, 'MDY00001', 'Aung Aung', '09234567890', 'saipaye202@gmail.com', 'public/uploads/user_68a9e5fb21be68.61817645_IMG_4469.jpeg', 2, 2, 3, 3, 'Mandalay ZayCho', 'MQ==', '725544', NULL, '222222', 2, NULL, 1, '2025-07-20 21:25:38', 0, NULL, NULL),
(4, '', 'Min Thu ', '09441386930', 'mint206202@gmail.com', 'default.png', 1, 1, 2, 3, '111', 'MTEx', NULL, NULL, '000000', 1, NULL, 1, '2025-07-22 21:31:15', 0, NULL, NULL),
(5, 'YGN0001', 'Min Thu', '09441386934', 'mimikhainglin70@gmail.com', 'public/uploads/user_68b7f8134d0003.33355452_IMG_14082.jpeg', 1, 1, 1, 1, 'Yangon Myanmar Plaza', 'Mg==', '199741', NULL, '111111', 2, NULL, 1, '2025-07-23 13:23:58', 1, NULL, NULL),
(7, 'YGN0640', 'Agent Insein 2', '0910000002', 'mint206202@gmail.com', 'default.png', 1, 1, 1, NULL, 'Insein Address 2', 'hashed_password', NULL, NULL, '123123', 2, NULL, 3, '2025-08-05 12:09:49', 0, NULL, NULL),
(120, NULL, 'MI MI Min Thu', '09772528282', 'mint1d2696@gmail.com', 'default.png', NULL, NULL, NULL, NULL, NULL, 'TXQ=', NULL, NULL, NULL, 3, NULL, 3, '2025-08-22 19:06:34', 0, NULL, NULL),
(121, NULL, 'MI MI Min Thu', '0972528282', 'min@gmail.com', 'default.png', NULL, NULL, NULL, NULL, NULL, 'TXQ=', '718254', '2025-09-15 10:42:54', NULL, 3, NULL, 3, '2025-08-22 19:08:34', 0, NULL, NULL),
(133, 'CYZ-PGA-390690', 'John Doe', '94413846934', 'minddt12696@gmail.com', 'public/uploads/payment_68bc7dfd71c0b6.16352770_IMG_0107.jpeg', 2, 2, 3, NULL, '123 Delivery St, Cityville, CA 90210', 'MQ==', NULL, NULL, '444444', 4, 2, 1, '2025-08-24 16:18:36', 0, NULL, 4),
(134, 'INS-PGA-85994', 'Mi', '9441386900', 'thantz34aw@gmail.com', 'public/uploads/payment_68bc7dc1a710e0.89683992_IMG_6690.jpeg', 1, 1, 1, NULL, '123 Delivery St, Cityville, CA 90210', 'MQ==', NULL, NULL, '333333', 4, 5, 1, '2025-08-24 16:32:45', 1, NULL, 5),
(226, 'MKL-036631', 'KIt KIt ', '09772528', 'kitkit206202@gmail.com', 'public/uploads/user_68c86af9aeb7e8.96501595_man-signing-for-shipping-box.jpeg', 2, 11, 23, 49, '', 'TXRAMjA2MjAy', NULL, NULL, '000111', 2, NULL, 1, '2025-09-16 01:56:54', 1, NULL, NULL),
(227, NULL, '', '', '', 'default.png', 1, 1, 1, NULL, '', NULL, NULL, NULL, NULL, 3, NULL, NULL, '2025-09-16 02:10:29', 0, NULL, NULL),
(228, NULL, '', '', '', 'default.png', 2, 11, 23, NULL, '', NULL, NULL, NULL, NULL, 3, NULL, NULL, '2025-09-16 02:10:29', 0, NULL, NULL),
(229, NULL, 'MI MI Min Thu', '0972528282', 'mint12696@gmail.com', 'default.png', 1, 1, 1, NULL, 'df', NULL, NULL, NULL, NULL, 3, NULL, NULL, '2025-09-16 02:11:09', 0, NULL, NULL),
(230, NULL, 'htet', '09883774', 'min206202thu@gmail.com', 'default.png', 2, 11, 23, NULL, 'dfd', NULL, NULL, NULL, NULL, 3, NULL, NULL, '2025-09-16 02:11:09', 0, NULL, NULL),
(231, NULL, 'MI MI Min Thu', '0972528282', 'mimi@gmail.com', 'default.png', 1, 1, 1, NULL, 'df', NULL, NULL, NULL, NULL, 3, NULL, NULL, '2025-09-16 02:12:20', 0, NULL, NULL),
(232, NULL, 'htet', '09883774', 'htethdf44me@gmail.com', 'default.png', 2, 11, 23, NULL, 'dfd', NULL, NULL, NULL, NULL, 3, NULL, NULL, '2025-09-16 02:12:20', 0, NULL, NULL),
(233, NULL, 'MI MI Min Thu', '0972528282', 'mimi@gmail.com', 'default.png', 1, 1, 1, NULL, 'df', NULL, NULL, NULL, NULL, 3, NULL, NULL, '2025-09-16 02:14:18', 0, NULL, NULL),
(234, NULL, 'htet', '09883774', 'htethdf44me@gmail.com', 'default.png', 2, 11, 23, NULL, 'dfd', NULL, NULL, NULL, NULL, 3, NULL, NULL, '2025-09-16 02:14:18', 0, NULL, NULL),
(235, NULL, 'MI MI Min Thu', '0972528282', 'mimi@gmail.com', 'default.png', 1, 1, 1, NULL, 'df', NULL, NULL, NULL, NULL, 3, NULL, NULL, '2025-09-16 02:15:36', 0, NULL, NULL),
(236, NULL, 'htet', '09883774', 'htethdf44me@gmail.com', 'default.png', 2, 11, 23, NULL, 'dfd', NULL, NULL, NULL, NULL, 3, NULL, NULL, '2025-09-16 02:15:36', 0, NULL, NULL),
(237, 'MKL-PGA-243195', 'Mi MI', '098738388', 'min123kit@gmail.com', 'default.png', 2, 11, 23, NULL, 'Taw Ma', 'MQ==', NULL, NULL, '555555', 4, 226, 2, '2025-09-15 22:53:55', 0, NULL, 6),
(238, NULL, 'mi', '0977383883', 'mint12696@gmail.com', 'default.png', 1, 1, 1, NULL, 'SU Lay', NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(239, NULL, 'MI MI Min Thu', '0972528282', 'min@gmail.com', 'default.png', 2, 11, 23, NULL, 'mdm', NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(240, NULL, 'nyi nyi', '09980810815', 'nit@gmail.com', 'default.png', NULL, NULL, NULL, NULL, NULL, 'Tnlp', NULL, NULL, NULL, 3, NULL, 3, '2025-09-16 03:49:41', 0, NULL, NULL),
(241, 'LMD-910353', 'Min Thu ', '09741386', 'thantzaw@gmail.com', 'default.png', 1, 1, 2, 3, 'Lanmadaw Address', 'TXRAMjA2MjAy', NULL, NULL, '898120', 2, NULL, 3, '2025-09-16 08:30:14', 0, NULL, NULL),
(242, 'LMD-217032', 'Min Thu ', '09741386938', 'thantzsaw@gmail.com', 'default.png', 1, 1, 2, 3, '111', 'TXRAMTExMTEx', NULL, NULL, '657309', 2, NULL, 3, '2025-09-16 08:33:32', 0, NULL, NULL),
(243, NULL, 'Min Thu', '09772528282', 'mint126969@gmail.com', 'default.png', 2, 11, 23, NULL, 'Yangon', NULL, NULL, NULL, NULL, 3, NULL, NULL, '2025-09-16 10:00:49', 0, NULL, NULL),
(244, NULL, 'Kit Kit', '09980810815', 'min123kit@gmail.com', 'default.png', 1, 1, 1, NULL, 'Meiktila', NULL, NULL, NULL, NULL, 3, NULL, NULL, '2025-09-16 10:00:49', 0, NULL, NULL),
(245, NULL, 'MI MI Min Thu', '0972528282', 'kitkit206202@gmail.com', 'default.png', 2, 2, 3, NULL, 'Mi', NULL, NULL, NULL, NULL, 3, NULL, NULL, '2025-09-16 10:27:31', 0, NULL, NULL),
(246, NULL, 'Htet ', '034890', 'htet@gmail.com', 'default.png', 1, 1, 1, NULL, 'Meiktila', NULL, NULL, NULL, NULL, 3, NULL, NULL, '2025-09-16 10:27:31', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Stand-in structure for view `user_full_info`
-- (See below for the actual view)
--
CREATE TABLE `user_full_info` (
`id` int(11)
,`access_code` varchar(255)
,`name` varchar(100)
,`phone` varchar(20)
,`email` varchar(100)
,`profile_image` varchar(255)
,`region_name` varchar(100)
,`city_name` varchar(100)
,`township_name` varchar(100)
,`ward_name` varchar(100)
,`address` text
,`password` varchar(255)
,`otp_code` varchar(10)
,`otp_expiry` datetime
,`security_code` varchar(100)
,`role_name` varchar(50)
,`status_name` varchar(50)
,`user_type_name` varchar(50)
,`vehicle_id` int(11)
,`plate_number` varchar(50)
,`make` varchar(100)
,`color` varchar(50)
,`vehicle_type_name` varchar(100)
,`created_by_agent` int(11)
,`created_by_agent_name` varchar(100)
,`created_at` datetime
);

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `id` int(11) NOT NULL,
  `type_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`id`, `type_name`) VALUES
(1, 'normal'),
(2, 'premium');

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `id` int(11) NOT NULL,
  `vehicle_type_id` int(11) NOT NULL,
  `make` varchar(100) NOT NULL,
  `color` varchar(50) NOT NULL,
  `plate_number` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`id`, `vehicle_type_id`, `make`, `color`, `plate_number`) VALUES
(4, 1, 'Hondai', 'Red', '4N-9099'),
(5, 2, 'Hondai', 'Red', '4N-9000'),
(6, 1, 'Hondai', 'Red', '4N-9098');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_types`
--

CREATE TABLE `vehicle_types` (
  `id` int(11) NOT NULL,
  `type_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicle_types`
--

INSERT INTO `vehicle_types` (`id`, `type_name`) VALUES
(1, 'Bike'),
(3, 'Car'),
(2, 'Van');

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_agent_messages`
-- (See below for the actual view)
--
CREATE TABLE `view_agent_messages` (
`id` int(11)
,`from_agent_id` int(11)
,`from_agent_name` varchar(100)
,`to_agent_id` int(11)
,`to_agent_name` varchar(100)
,`notification_type` varchar(50)
,`title` varchar(255)
,`message` text
,`created_at` timestamp
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_available_locations`
-- (See below for the actual view)
--
CREATE TABLE `view_available_locations` (
`id` int(11)
,`region_id` int(11)
,`region_name` varchar(100)
,`city_id` int(11)
,`city_name` varchar(100)
,`township_id` int(11)
,`township_name` varchar(100)
,`agent_id` int(11)
,`agent_name` varchar(100)
,`agent_email` varchar(100)
,`agent_phone` varchar(20)
,`agent_status_name` varchar(50)
,`status_location_id` int(11)
,`status_location_name` varchar(50)
,`created_at` timestamp
,`updated_at` timestamp
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_deliveries_detailed`
-- (See below for the actual view)
--
CREATE TABLE `view_deliveries_detailed` (
`id` int(11)
,`tracking_code` varchar(50)
,`product_type` varchar(100)
,`weight` decimal(10,2)
,`amount` decimal(10,2)
,`duration` datetime
,`created_at` timestamp
,`updated_at` timestamp
,`sender_agent_id` int(11)
,`sender_agent_name` varchar(100)
,`sender_agent_email` varchar(100)
,`sender_agent_phone` varchar(20)
,`sender_agent_address` text
,`receiver_agent_id` int(11)
,`receiver_agent_name` varchar(100)
,`receiver_agent_email` varchar(100)
,`receiver_agent_phone` varchar(20)
,`receiver_agent_address` text
,`sender_customer_id` int(11)
,`sender_customer_name` varchar(100)
,`sender_customer_email` varchar(100)
,`sender_customer_phone` varchar(20)
,`sender_customer_address` text
,`receiver_customer_id` int(11)
,`receiver_customer_name` varchar(100)
,`receiver_customer_email` varchar(100)
,`receiver_customer_phone` varchar(20)
,`receiver_customer_address` text
,`pickupagent_id` int(11)
,`pickupagent_name` varchar(100)
,`from_township_id` int(11)
,`from_township_name` varchar(100)
,`to_township_id` int(11)
,`to_township_name` varchar(100)
,`from_city_id` int(11)
,`from_city_name` varchar(100)
,`to_city_id` int(11)
,`to_city_name` varchar(100)
,`from_region_id` int(11)
,`from_region_name` varchar(100)
,`to_region_id` int(11)
,`to_region_name` varchar(100)
,`delivery_status_id` int(11)
,`delivery_status` varchar(50)
,`payment_status_id` int(11)
,`payment_status` varchar(50)
,`delivery_type_id` int(11)
,`delivery_type_name` varchar(50)
,`piece_count` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_delivery_status_history`
-- (See below for the actual view)
--
CREATE TABLE `view_delivery_status_history` (
`id` int(11)
,`delivery_id` int(11)
,`tracking_code` varchar(50)
,`sender_agent` varchar(109)
,`receiver_agent` varchar(111)
,`status` varchar(50)
,`changed_by` varchar(100)
,`note` text
,`changed_at` datetime
);

-- --------------------------------------------------------

--
-- Table structure for table `wards`
--

CREATE TABLE `wards` (
  `id` int(11) NOT NULL,
  `township_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wards`
--

INSERT INTO `wards` (`id`, `township_id`, `name`) VALUES
(1, 1, 'Ward 1'),
(2, 1, 'Ward 2'),
(3, 2, 'Ward 3'),
(4, 3, 'Ward 4'),
(5, 1, 'Ward 1'),
(6, 1, 'Ward 2'),
(7, 2, 'Ward 3'),
(8, 2, 'Ward 4'),
(9, 3, 'Ward 1'),
(10, 3, 'Ward 2'),
(49, 23, 'Ward 1'),
(50, 23, 'Ward 2');

-- --------------------------------------------------------

--
-- Structure for view `payment_history_view`
--
DROP TABLE IF EXISTS `payment_history_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `payment_history_view`  AS SELECT `ph`.`id` AS `payment_history_id`, `ph`.`deliveries_id` AS `deliveries_id`, `d`.`tracking_code` AS `tracking_code`, `d`.`amount` AS `amount`, `u`.`name` AS `receiver_customer_name`, `ph`.`payment_method_id` AS `payment_method_id`, `pm`.`method_name` AS `payment_method_name`, `pm`.`method_number` AS `payment_method_number`, `pt`.`name` AS `payment_type_name`, `ph`.`agent_id` AS `agent_id`, `a`.`name` AS `agent_name`, `ph`.`receipt_image` AS `receipt_image`, `ph`.`created_at` AS `created_at`, `d`.`delivery_status_id` AS `delivery_status_id`, `ds`.`name` AS `delivery_status_name` FROM ((((((`payment_history` `ph` join `deliveries` `d` on(`ph`.`deliveries_id` = `d`.`id`)) join `users` `u` on(`d`.`receiver_customer_id` = `u`.`id`)) join `delivery_statuses` `ds` on(`d`.`delivery_status_id` = `ds`.`id`)) join `payment_methods` `pm` on(`ph`.`payment_method_id` = `pm`.`id`)) join `payment_types` `pt` on(`pm`.`payment_type_id` = `pt`.`id`)) join `users` `a` on(`ph`.`agent_id` = `a`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `payment_methods_view`
--
DROP TABLE IF EXISTS `payment_methods_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `payment_methods_view`  AS SELECT `pm`.`id` AS `id`, `pm`.`payment_type_id` AS `payment_type_id`, `pt`.`name` AS `name`, `pm`.`method_name` AS `method_name`, `pm`.`method_image` AS `method_image`, `pm`.`method_number` AS `method_number`, `pm`.`account_holder` AS `account_holder`, `pm`.`create_by_agent_id` AS `create_by_agent_id`, `u`.`name` AS `created_by_agent_name` FROM ((`payment_methods` `pm` left join `payment_types` `pt` on(`pm`.`payment_type_id` = `pt`.`id`)) left join `users` `u` on(`pm`.`create_by_agent_id` = `u`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `pickup_requests_view`
--
DROP TABLE IF EXISTS `pickup_requests_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `pickup_requests_view`  AS SELECT `pr`.`id` AS `id`, `pr`.`sender_id` AS `sender_id`, `pr`.`request_code` AS `request_code`, `u`.`name` AS `sender_name`, `u`.`email` AS `sender_email`, `u`.`phone` AS `sender_phone`, `pr`.`sender_address` AS `sender_address`, `pr`.`landmark` AS `landmark`, `r`.`name` AS `sender_region`, `c`.`name` AS `sender_city`, `t`.`name` AS `sender_township`, `pr`.`receiver_name` AS `receiver_name`, `pr`.`receiver_email` AS `receiver_email`, `pr`.`receiver_phone` AS `receiver_phone`, `pr`.`receiver_address` AS `receiver_address`, `r2`.`name` AS `receiver_region`, `c2`.`name` AS `receiver_city`, `t2`.`name` AS `receiver_township`, `pt`.`type_name` AS `parcel_type`, `pr`.`weight` AS `weight`, `pr`.`quantity` AS `quantity`, `pr`.`preferred_date` AS `preferred_date`, `pr`.`agent_id` AS `agent_id`, `a`.`name` AS `agent_name`, `pr`.`pickup_agent_id` AS `pickup_agent_id`, `pa`.`name` AS `pickup_agent_name`, `pr`.`status_id` AS `status_id`, `psu`.`status_name` AS `status`, `pr`.`delivery_type_id` AS `delivery_type_id`, `dt`.`type_name` AS `delivery_type_name`, `pr`.`payment_status_id` AS `payment_status_id`, `ps`.`name` AS `payment_status_name`, `pr`.`amount` AS `amount`, `pr`.`payment_type_id` AS `payment_type_id`, `ptype`.`name` AS `payment_type`, `pr`.`payment_method_id` AS `payment_method_id`, `pm`.`method_name` AS `payment_method`, `pr`.`method_image` AS `method_image`, `pm`.`method_number` AS `method_number`, `pr`.`created_at` AS `created_at`, `pr`.`updated_at` AS `updated_at` FROM ((((((((((((((((`pickup_requests` `pr` left join `users` `u` on(`pr`.`sender_id` = `u`.`id`)) left join `regions` `r` on(`pr`.`sender_region_id` = `r`.`id`)) left join `cities` `c` on(`pr`.`sender_city_id` = `c`.`id`)) left join `townships` `t` on(`pr`.`sender_township_id` = `t`.`id`)) left join `regions` `r2` on(`pr`.`receiver_region_id` = `r2`.`id`)) left join `cities` `c2` on(`pr`.`receiver_city_id` = `c2`.`id`)) left join `townships` `t2` on(`pr`.`receiver_township_id` = `t2`.`id`)) left join `parcel_type` `pt` on(`pr`.`parcel_type_id` = `pt`.`id`)) left join `users` `a` on(`pr`.`agent_id` = `a`.`id`)) left join `pickup_status` `psu` on(`pr`.`status_id` = `psu`.`id`)) left join `users` `pa` on(`pr`.`pickup_agent_id` = `pa`.`id`)) left join `statuses` `s` on(`pr`.`status_id` = `s`.`id`)) left join `delivery_type` `dt` on(`pr`.`delivery_type_id` = `dt`.`id`)) left join `payment_statuses` `ps` on(`pr`.`payment_status_id` = `ps`.`id`)) left join `payment_types` `ptype` on(`pr`.`payment_type_id` = `ptype`.`id`)) left join `payment_methods` `pm` on(`pr`.`payment_method_id` = `pm`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `route_full_info`
--
DROP TABLE IF EXISTS `route_full_info`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `route_full_info`  AS SELECT `r`.`id` AS `route_id`, `fc`.`name` AS `from_city`, `ft`.`name` AS `from_township`, `tc`.`name` AS `to_city`, `tt`.`name` AS `to_township`, `r`.`distance` AS `distance`, `r`.`time` AS `time`, `r`.`price` AS `price`, `r`.`status` AS `status`, `r`.`created_at` AS `created_at`, `r`.`updated_at` AS `updated_at` FROM ((((`route` `r` join `cities` `fc` on(`r`.`from_city_id` = `fc`.`id`)) join `cities` `tc` on(`r`.`to_city_id` = `tc`.`id`)) join `townships` `ft` on(`r`.`from_township_id` = `ft`.`id`)) join `townships` `tt` on(`r`.`to_township_id` = `tt`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `user_full_info`
--
DROP TABLE IF EXISTS `user_full_info`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `user_full_info`  AS SELECT `u`.`id` AS `id`, `u`.`access_code` AS `access_code`, `u`.`name` AS `name`, `u`.`phone` AS `phone`, `u`.`email` AS `email`, `u`.`profile_image` AS `profile_image`, `r`.`name` AS `region_name`, `c`.`name` AS `city_name`, `t`.`name` AS `township_name`, `w`.`name` AS `ward_name`, `u`.`address` AS `address`, `u`.`password` AS `password`, `u`.`otp_code` AS `otp_code`, `u`.`otp_expiry` AS `otp_expiry`, `u`.`security_code` AS `security_code`, `ro`.`name` AS `role_name`, `s`.`name` AS `status_name`, `ut`.`type_name` AS `user_type_name`, `u`.`vehicle_id` AS `vehicle_id`, `v`.`plate_number` AS `plate_number`, `v`.`make` AS `make`, `v`.`color` AS `color`, `vt`.`type_name` AS `vehicle_type_name`, `u`.`created_by_agent` AS `created_by_agent`, `a`.`name` AS `created_by_agent_name`, `u`.`created_at` AS `created_at` FROM ((((((((((`users` `u` left join `regions` `r` on(`u`.`region_id` = `r`.`id`)) left join `cities` `c` on(`u`.`city_id` = `c`.`id`)) left join `townships` `t` on(`u`.`township_id` = `t`.`id`)) left join `wards` `w` on(`u`.`ward_id` = `w`.`id`)) left join `roles` `ro` on(`u`.`role_id` = `ro`.`id`)) left join `statuses` `s` on(`u`.`status_id` = `s`.`id`)) left join `user_type` `ut` on(`u`.`user_type_id` = `ut`.`id`)) left join `vehicles` `v` on(`u`.`vehicle_id` = `v`.`id`)) left join `vehicle_types` `vt` on(`v`.`vehicle_type_id` = `vt`.`id`)) left join `users` `a` on(`u`.`created_by_agent` = `a`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `view_agent_messages`
--
DROP TABLE IF EXISTS `view_agent_messages`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_agent_messages`  AS SELECT `n`.`id` AS `id`, `n`.`from_agent_id` AS `from_agent_id`, `f`.`name` AS `from_agent_name`, `n`.`to_agent_id` AS `to_agent_id`, `t`.`name` AS `to_agent_name`, `nt`.`type_name` AS `notification_type`, `n`.`title` AS `title`, `n`.`message` AS `message`, `n`.`created_at` AS `created_at` FROM (((`agent_notifications` `n` left join `users` `f` on(`n`.`from_agent_id` = `f`.`id`)) left join `users` `t` on(`n`.`to_agent_id` = `t`.`id`)) left join `notification_types` `nt` on(`n`.`type_id` = `nt`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `view_available_locations`
--
DROP TABLE IF EXISTS `view_available_locations`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_available_locations`  AS SELECT `al`.`id` AS `id`, `al`.`region_id` AS `region_id`, `r`.`name` AS `region_name`, `al`.`city_id` AS `city_id`, `c`.`name` AS `city_name`, `al`.`township_id` AS `township_id`, `t`.`name` AS `township_name`, `al`.`agent_id` AS `agent_id`, `a`.`name` AS `agent_name`, `a`.`email` AS `agent_email`, `a`.`phone` AS `agent_phone`, `s`.`name` AS `agent_status_name`, `al`.`status_location_id` AS `status_location_id`, `ls`.`name` AS `status_location_name`, `al`.`created_at` AS `created_at`, `al`.`updated_at` AS `updated_at` FROM ((((((`available_location` `al` join `regions` `r` on(`al`.`region_id` = `r`.`id`)) join `cities` `c` on(`al`.`city_id` = `c`.`id`)) join `townships` `t` on(`al`.`township_id` = `t`.`id`)) left join `users` `a` on(`al`.`agent_id` = `a`.`id`)) left join `statuses` `s` on(`a`.`status_id` = `s`.`id`)) left join `location_status` `ls` on(`al`.`status_location_id` = `ls`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `view_deliveries_detailed`
--
DROP TABLE IF EXISTS `view_deliveries_detailed`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_deliveries_detailed`  AS SELECT `d`.`id` AS `id`, `d`.`tracking_code` AS `tracking_code`, `d`.`product_type` AS `product_type`, `d`.`weight` AS `weight`, `d`.`amount` AS `amount`, `d`.`duration` AS `duration`, `d`.`created_at` AS `created_at`, `d`.`updated_at` AS `updated_at`, `sa`.`id` AS `sender_agent_id`, `sa`.`name` AS `sender_agent_name`, `sa`.`email` AS `sender_agent_email`, `sa`.`phone` AS `sender_agent_phone`, `sa`.`address` AS `sender_agent_address`, `ra`.`id` AS `receiver_agent_id`, `ra`.`name` AS `receiver_agent_name`, `ra`.`email` AS `receiver_agent_email`, `ra`.`phone` AS `receiver_agent_phone`, `ra`.`address` AS `receiver_agent_address`, `sc`.`id` AS `sender_customer_id`, `sc`.`name` AS `sender_customer_name`, `sc`.`email` AS `sender_customer_email`, `sc`.`phone` AS `sender_customer_phone`, `sc`.`address` AS `sender_customer_address`, `rc`.`id` AS `receiver_customer_id`, `rc`.`name` AS `receiver_customer_name`, `rc`.`email` AS `receiver_customer_email`, `rc`.`phone` AS `receiver_customer_phone`, `rc`.`address` AS `receiver_customer_address`, `pa`.`id` AS `pickupagent_id`, `pa`.`name` AS `pickupagent_name`, `d`.`from_township_id` AS `from_township_id`, `ft`.`name` AS `from_township_name`, `d`.`to_township_id` AS `to_township_id`, `tt`.`name` AS `to_township_name`, `d`.`from_city_id` AS `from_city_id`, `fc`.`name` AS `from_city_name`, `d`.`to_city_id` AS `to_city_id`, `tc`.`name` AS `to_city_name`, `d`.`from_region_id` AS `from_region_id`, `fr`.`name` AS `from_region_name`, `d`.`to_region_id` AS `to_region_id`, `tr`.`name` AS `to_region_name`, `d`.`delivery_status_id` AS `delivery_status_id`, `ds`.`name` AS `delivery_status`, `d`.`payment_status_id` AS `payment_status_id`, `ps`.`name` AS `payment_status`, `d`.`delivery_type_id` AS `delivery_type_id`, `dt`.`type_name` AS `delivery_type_name`, `d`.`piece_count` AS `piece_count` FROM ((((((((((((((`deliveries` `d` left join `users` `sa` on(`d`.`sender_agent_id` = `sa`.`id`)) left join `users` `ra` on(`d`.`receiver_agent_id` = `ra`.`id`)) left join `users` `sc` on(`d`.`sender_customer_id` = `sc`.`id`)) left join `users` `rc` on(`d`.`receiver_customer_id` = `rc`.`id`)) left join `users` `pa` on(`d`.`pickupagent_id` = `pa`.`id`)) left join `townships` `ft` on(`d`.`from_township_id` = `ft`.`id`)) left join `townships` `tt` on(`d`.`to_township_id` = `tt`.`id`)) left join `cities` `fc` on(`d`.`from_city_id` = `fc`.`id`)) left join `cities` `tc` on(`d`.`to_city_id` = `tc`.`id`)) left join `regions` `fr` on(`d`.`from_region_id` = `fr`.`id`)) left join `regions` `tr` on(`d`.`to_region_id` = `tr`.`id`)) left join `delivery_statuses` `ds` on(`d`.`delivery_status_id` = `ds`.`id`)) left join `payment_statuses` `ps` on(`d`.`payment_status_id` = `ps`.`id`)) left join `delivery_type` `dt` on(`d`.`delivery_type_id` = `dt`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `view_delivery_status_history`
--
DROP TABLE IF EXISTS `view_delivery_status_history`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_delivery_status_history`  AS SELECT `dsh`.`id` AS `id`, `dsh`.`delivery_id` AS `delivery_id`, `d`.`tracking_code` AS `tracking_code`, concat(`su`.`name`,' (Sender)') AS `sender_agent`, concat(`ru`.`name`,' (Receiver)') AS `receiver_agent`, `ds`.`name` AS `status`, `cb`.`name` AS `changed_by`, `dsh`.`note` AS `note`, `dsh`.`changed_at` AS `changed_at` FROM (((((`delivery_status_history` `dsh` join `deliveries` `d` on(`dsh`.`delivery_id` = `d`.`id`)) left join `users` `su` on(`d`.`sender_agent_id` = `su`.`id`)) left join `users` `ru` on(`d`.`receiver_agent_id` = `ru`.`id`)) left join `delivery_statuses` `ds` on(`dsh`.`status_id` = `ds`.`id`)) left join `users` `cb` on(`dsh`.`changed_by` = `cb`.`id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agent_notifications`
--
ALTER TABLE `agent_notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `from_agent_id` (`from_agent_id`),
  ADD KEY `to_agent_id` (`to_agent_id`),
  ADD KEY `fk_type_id` (`type_id`);

--
-- Indexes for table `available_location`
--
ALTER TABLE `available_location`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_region` (`region_id`),
  ADD KEY `fk_city` (`city_id`),
  ADD KEY `fk_township` (`township_id`),
  ADD KEY `fk_agent` (`agent_id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `region_id` (`region_id`);

--
-- Indexes for table `deliveries`
--
ALTER TABLE `deliveries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sender_agent_id` (`sender_agent_id`),
  ADD KEY `receiver_agent_id` (`receiver_agent_id`),
  ADD KEY `sender_customer_id` (`sender_customer_id`),
  ADD KEY `receiver_customer_id` (`receiver_customer_id`),
  ADD KEY `delivery_status_id` (`delivery_status_id`),
  ADD KEY `payment_status_id` (`payment_status_id`),
  ADD KEY `fk_from_city` (`from_city_id`),
  ADD KEY `fk_to_city` (`to_city_id`),
  ADD KEY `fk_from_region` (`from_region_id`),
  ADD KEY `fk_to_region` (`to_region_id`),
  ADD KEY `fk_delivery_type` (`delivery_type_id`),
  ADD KEY `fk_pickup_agent` (`pickupagent_id`);

--
-- Indexes for table `delivery_statuses`
--
ALTER TABLE `delivery_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_status_history`
--
ALTER TABLE `delivery_status_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `delivery_id` (`delivery_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Indexes for table `delivery_type`
--
ALTER TABLE `delivery_type`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `type_name` (`type_name`);

--
-- Indexes for table `location_status`
--
ALTER TABLE `location_status`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `notification_types`
--
ALTER TABLE `notification_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `type_name` (`type_name`);

--
-- Indexes for table `parcel_type`
--
ALTER TABLE `parcel_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_history`
--
ALTER TABLE `payment_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_payment_history_delivery` (`deliveries_id`),
  ADD KEY `fk_payment_history_method` (`payment_method_id`),
  ADD KEY `fk_payment_history_agent` (`agent_id`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_type_id` (`payment_type_id`);

--
-- Indexes for table `payment_statuses`
--
ALTER TABLE `payment_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_types`
--
ALTER TABLE `payment_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pickup_requests`
--
ALTER TABLE `pickup_requests`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `request_code` (`request_code`),
  ADD KEY `fk_parcel_type` (`parcel_type_id`),
  ADD KEY `fk_pickup_status` (`status_id`);

--
-- Indexes for table `pickup_status`
--
ALTER TABLE `pickup_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `route`
--
ALTER TABLE `route`
  ADD PRIMARY KEY (`id`),
  ADD KEY `from_city_id` (`from_city_id`),
  ADD KEY `to_city_id` (`to_city_id`);

--
-- Indexes for table `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `townships`
--
ALTER TABLE `townships`
  ADD PRIMARY KEY (`id`),
  ADD KEY `city_id` (`city_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `region_id` (`region_id`),
  ADD KEY `city_id` (`city_id`),
  ADD KEY `township_id` (`township_id`),
  ADD KEY `ward_id` (`ward_id`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `status_id` (`status_id`),
  ADD KEY `fk_user_type` (`user_type_id`),
  ADD KEY `fk_created_by_agent` (`created_by_agent`),
  ADD KEY `fk_vehicle` (`vehicle_id`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `plate_number` (`plate_number`),
  ADD KEY `vehicle_type_id` (`vehicle_type_id`);

--
-- Indexes for table `vehicle_types`
--
ALTER TABLE `vehicle_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `type_name` (`type_name`);

--
-- Indexes for table `wards`
--
ALTER TABLE `wards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `township_id` (`township_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agent_notifications`
--
ALTER TABLE `agent_notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `available_location`
--
ALTER TABLE `available_location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `deliveries`
--
ALTER TABLE `deliveries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `delivery_statuses`
--
ALTER TABLE `delivery_statuses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `delivery_status_history`
--
ALTER TABLE `delivery_status_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `delivery_type`
--
ALTER TABLE `delivery_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `location_status`
--
ALTER TABLE `location_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `notification_types`
--
ALTER TABLE `notification_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `parcel_type`
--
ALTER TABLE `parcel_type`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payment_history`
--
ALTER TABLE `payment_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `payment_statuses`
--
ALTER TABLE `payment_statuses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payment_types`
--
ALTER TABLE `payment_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pickup_requests`
--
ALTER TABLE `pickup_requests`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pickup_status`
--
ALTER TABLE `pickup_status`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `route`
--
ALTER TABLE `route`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `townships`
--
ALTER TABLE `townships`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `vehicle_types`
--
ALTER TABLE `vehicle_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `wards`
--
ALTER TABLE `wards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `agent_notifications`
--
ALTER TABLE `agent_notifications`
  ADD CONSTRAINT `agent_notifications_ibfk_1` FOREIGN KEY (`from_agent_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `agent_notifications_ibfk_2` FOREIGN KEY (`to_agent_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_type_id` FOREIGN KEY (`type_id`) REFERENCES `notification_types` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `available_location`
--
ALTER TABLE `available_location`
  ADD CONSTRAINT `fk_agent` FOREIGN KEY (`agent_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_city` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_region` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_township` FOREIGN KEY (`township_id`) REFERENCES `townships` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_ibfk_1` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `deliveries`
--
ALTER TABLE `deliveries`
  ADD CONSTRAINT `deliveries_ibfk_1` FOREIGN KEY (`sender_agent_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `deliveries_ibfk_2` FOREIGN KEY (`receiver_agent_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `deliveries_ibfk_3` FOREIGN KEY (`sender_customer_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `deliveries_ibfk_4` FOREIGN KEY (`receiver_customer_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `deliveries_ibfk_5` FOREIGN KEY (`delivery_status_id`) REFERENCES `delivery_statuses` (`id`),
  ADD CONSTRAINT `deliveries_ibfk_6` FOREIGN KEY (`payment_status_id`) REFERENCES `payment_statuses` (`id`),
  ADD CONSTRAINT `fk_delivery_type` FOREIGN KEY (`delivery_type_id`) REFERENCES `delivery_type` (`id`),
  ADD CONSTRAINT `fk_from_city` FOREIGN KEY (`from_city_id`) REFERENCES `cities` (`id`),
  ADD CONSTRAINT `fk_from_region` FOREIGN KEY (`from_region_id`) REFERENCES `regions` (`id`),
  ADD CONSTRAINT `fk_pickup_agent` FOREIGN KEY (`pickupagent_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_to_city` FOREIGN KEY (`to_city_id`) REFERENCES `cities` (`id`),
  ADD CONSTRAINT `fk_to_region` FOREIGN KEY (`to_region_id`) REFERENCES `regions` (`id`);

--
-- Constraints for table `delivery_status_history`
--
ALTER TABLE `delivery_status_history`
  ADD CONSTRAINT `delivery_status_history_ibfk_1` FOREIGN KEY (`delivery_id`) REFERENCES `deliveries` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `delivery_status_history_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `delivery_statuses` (`id`);

--
-- Constraints for table `payment_history`
--
ALTER TABLE `payment_history`
  ADD CONSTRAINT `fk_payment_history_agent` FOREIGN KEY (`agent_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_payment_history_delivery` FOREIGN KEY (`deliveries_id`) REFERENCES `deliveries` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_payment_history_method` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_methods` (`id`);

--
-- Constraints for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD CONSTRAINT `payment_methods_ibfk_1` FOREIGN KEY (`payment_type_id`) REFERENCES `payment_types` (`id`);

--
-- Constraints for table `pickup_requests`
--
ALTER TABLE `pickup_requests`
  ADD CONSTRAINT `fk_parcel_type` FOREIGN KEY (`parcel_type_id`) REFERENCES `parcel_type` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pickup_status` FOREIGN KEY (`status_id`) REFERENCES `pickup_status` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `route`
--
ALTER TABLE `route`
  ADD CONSTRAINT `route_ibfk_1` FOREIGN KEY (`from_city_id`) REFERENCES `cities` (`id`),
  ADD CONSTRAINT `route_ibfk_2` FOREIGN KEY (`to_city_id`) REFERENCES `cities` (`id`);

--
-- Constraints for table `townships`
--
ALTER TABLE `townships`
  ADD CONSTRAINT `townships_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_created_by_agent` FOREIGN KEY (`created_by_agent`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_user_type` FOREIGN KEY (`user_type_id`) REFERENCES `user_type` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_vehicle` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`),
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`),
  ADD CONSTRAINT `users_ibfk_3` FOREIGN KEY (`township_id`) REFERENCES `townships` (`id`),
  ADD CONSTRAINT `users_ibfk_4` FOREIGN KEY (`ward_id`) REFERENCES `wards` (`id`),
  ADD CONSTRAINT `users_ibfk_5` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `users_ibfk_6` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`);

--
-- Constraints for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD CONSTRAINT `vehicles_ibfk_1` FOREIGN KEY (`vehicle_type_id`) REFERENCES `vehicle_types` (`id`);

--
-- Constraints for table `wards`
--
ALTER TABLE `wards`
  ADD CONSTRAINT `wards_ibfk_1` FOREIGN KEY (`township_id`) REFERENCES `townships` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
