-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 07, 2025 at 04:50 AM
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertuser` (IN `in_name` VARCHAR(45), IN `in_phone` INT(10), IN `in_email` VARCHAR(25), IN `in_region_id` INT, IN `in_city_id` INT, IN `in_township_id` INT, IN `in_ward_id` INT, IN `in_address` VARCHAR(25), IN `in_password` VARCHAR(20), IN `in_otp_code` INT(10), IN `in_otp_expiry` TIME, IN `in_security_code` INT(10), IN `in_role_id` INT, IN `in_status_id` INT, IN `in_created_at` TIME, IN `in_is_login` INT)   BEGIN
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
    is_login
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
    in_is_login
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
(423, 5, 3, 1, 'New Delivery Available!', 'A new delivery request (Order ID: #YGN951364YGN) is available for acceptance. Check \'Request Deliveries\'.', '2025-08-05 09:54:14'),
(424, 5, 3, 1, 'New Delivery Available!', 'A new delivery request (Order ID: #YGN479024YGN) is available for acceptance. Check \'Request Deliveries\'.', '2025-08-05 09:56:58'),
(425, 5, 3, 1, 'New Delivery Available!', 'A new delivery request (Order ID: #YGN374995YGN) is available for acceptance. Check \'Request Deliveries\'.', '2025-08-05 09:57:37'),
(426, 5, 3, 1, 'New Delivery Available!', 'A new delivery request (Order ID: #YGN810438YGN) is available for acceptance. Check \'Request Deliveries\'.', '2025-08-05 09:58:54'),
(427, 5, 3, 1, 'New Delivery Available!', 'A new delivery request (Order ID: #YGN906081YGN) is available for acceptance. Check \'Request Deliveries\'.', '2025-08-05 09:59:18'),
(428, 5, 3, 1, 'New Delivery Available!', 'A new delivery request (Order ID: #YGN669336YGN) is available for acceptance. Check \'Request Deliveries\'.', '2025-08-05 10:16:03'),
(429, 5, 3, 1, 'New Delivery Available!', 'A new delivery request (Order ID: #YGN960422YGN) is available for acceptance. Check \'Request Deliveries\'.', '2025-08-05 10:17:00'),
(430, 5, 3, 1, 'New Delivery Available!', 'A new delivery request (Order ID: #YGN423543YGN) is available for acceptance. Check \'Request Deliveries\'.', '2025-08-05 10:27:24'),
(431, 5, 3, 1, 'New Delivery Available!', 'A new delivery request (Order ID: #YGN725189YGN) is available for acceptance. Check \'Request Deliveries\'.', '2025-08-05 10:29:44'),
(432, 5, 3, 3, 'System Alert: Delivery Cancelled', 'Voucher YGN423543YGN has been cancelled by the customer.', '2025-08-05 16:37:46'),
(433, 5, 3, 3, 'System Alert: Delivery Cancelled', 'Voucher YGN423543YGN has been cancelled by the customer.', '2025-08-05 16:43:04'),
(434, 5, 3, 3, 'System Alert: Delivery Cancelled', 'Voucher YGN423543YGN has been cancelled by the customer.', '2025-08-05 16:47:06'),
(435, 2, 5, 1, 'New Delivery Available!', 'A new delivery request (Order ID: #MDY337605YGN) is available for acceptance. Check \'Request Deliveries\'.', '2025-08-05 12:49:01'),
(436, 2, 5, 1, 'New Delivery Available!', 'A new delivery request (Order ID: #MDY987200YGN) is available for acceptance. Check \'Request Deliveries\'.', '2025-08-05 12:49:38'),
(437, 5, 2, 1, 'Delivery Accepted!', 'You accepted delivery: MDY337605YGN. Proceed to pickup.', '2025-08-05 12:51:42'),
(438, 5, 2, 1, 'Delivery Accepted!', 'You accepted delivery: MDY337605YGN. Proceed to pickup.', '2025-08-05 22:07:42'),
(439, 5, 2, 3, 'Return Initiated', 'Return started for voucher MDY337605YGN. Please check it.', '2025-08-06 02:40:55'),
(440, 5, 2, 2, 'Delivery Completed', 'Delivery MDY337605YGN marked as \'Delivered\'. Earnings processed.', '2025-08-06 02:44:19'),
(441, 5, 2, 3, 'Return Initiated', 'Return started for voucher MDY337605YGN. Please check it.', '2025-08-06 02:46:24'),
(442, 4, 1, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-05 22:23:33'),
(443, 4, 2, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-05 22:23:33'),
(444, 4, 3, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-05 22:23:33'),
(445, 4, 5, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-05 22:23:33'),
(446, 4, 6, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-05 22:23:33'),
(447, 4, 7, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-05 22:23:33'),
(448, 4, 8, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-05 22:23:33'),
(449, 4, 9, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-05 22:23:33'),
(450, 4, 10, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-05 22:23:33'),
(451, 4, 11, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-05 22:23:33'),
(452, 4, 12, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-05 22:23:33'),
(453, 4, 13, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-05 22:23:33'),
(454, 4, 14, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-05 22:23:33'),
(455, 4, 15, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-05 22:23:33'),
(456, 4, 16, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-05 22:23:33'),
(457, 4, 17, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-05 22:23:33'),
(458, 4, 18, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-05 22:23:33'),
(459, 4, 19, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-05 22:23:33'),
(460, 4, 20, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-05 22:23:33'),
(461, 4, 21, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-05 22:23:33'),
(462, 4, 22, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-05 22:23:33'),
(463, 4, 23, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-05 22:23:33'),
(464, 4, 24, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-05 22:23:33'),
(465, 4, 25, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-05 22:23:33'),
(466, 4, 26, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-05 22:23:33'),
(467, 4, 27, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-05 22:23:33'),
(468, 4, 28, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-05 22:23:33'),
(469, 4, 29, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-05 22:23:33'),
(470, 4, 30, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-05 22:23:33'),
(471, 4, 31, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-05 22:23:33'),
(472, 4, 32, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-05 22:23:33'),
(473, 4, 33, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-05 22:23:33'),
(474, 4, 1, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-05 22:23:35'),
(475, 4, 2, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-05 22:23:35'),
(476, 4, 3, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-05 22:23:35'),
(477, 4, 5, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-05 22:23:35'),
(478, 4, 6, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-05 22:23:35'),
(479, 4, 7, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-05 22:23:35'),
(480, 4, 8, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-05 22:23:35'),
(481, 4, 9, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-05 22:23:35'),
(482, 4, 10, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-05 22:23:35'),
(483, 4, 11, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-05 22:23:35'),
(484, 4, 12, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-05 22:23:35'),
(485, 4, 13, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-05 22:23:35'),
(486, 4, 14, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-05 22:23:35'),
(487, 4, 15, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-05 22:23:35'),
(488, 4, 16, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-05 22:23:35'),
(489, 4, 17, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-05 22:23:35'),
(490, 4, 18, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-05 22:23:35'),
(491, 4, 19, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-05 22:23:35'),
(492, 4, 20, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-05 22:23:35'),
(493, 4, 21, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-05 22:23:35'),
(494, 4, 22, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-05 22:23:35'),
(495, 4, 23, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-05 22:23:35'),
(496, 4, 24, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-05 22:23:35'),
(497, 4, 25, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-05 22:23:35'),
(498, 4, 26, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-05 22:23:35'),
(499, 4, 27, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-05 22:23:35'),
(500, 4, 28, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-05 22:23:35'),
(501, 4, 29, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-05 22:23:35'),
(502, 4, 30, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-05 22:23:35'),
(503, 4, 31, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-05 22:23:35'),
(504, 4, 32, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-05 22:23:35'),
(505, 4, 33, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-05 22:23:35'),
(506, 4, 1, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-05 22:23:48'),
(507, 4, 2, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-05 22:23:48'),
(508, 4, 3, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-05 22:23:48'),
(509, 4, 5, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-05 22:23:48'),
(510, 4, 6, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-05 22:23:48'),
(511, 4, 7, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-05 22:23:48'),
(512, 4, 8, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-05 22:23:48'),
(513, 4, 9, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-05 22:23:48'),
(514, 4, 10, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-05 22:23:48'),
(515, 4, 11, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-05 22:23:48'),
(516, 4, 12, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-05 22:23:48'),
(517, 4, 13, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-05 22:23:48'),
(518, 4, 14, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-05 22:23:48'),
(519, 4, 15, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-05 22:23:48'),
(520, 4, 16, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-05 22:23:48'),
(521, 4, 17, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-05 22:23:48'),
(522, 4, 18, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-05 22:23:48'),
(523, 4, 19, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-05 22:23:48'),
(524, 4, 20, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-05 22:23:48'),
(525, 4, 21, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-05 22:23:48'),
(526, 4, 22, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-05 22:23:48'),
(527, 4, 23, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-05 22:23:48'),
(528, 4, 24, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-05 22:23:48'),
(529, 4, 25, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-05 22:23:48'),
(530, 4, 26, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-05 22:23:48'),
(531, 4, 27, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-05 22:23:48'),
(532, 4, 28, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-05 22:23:48'),
(533, 4, 29, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-05 22:23:48'),
(534, 4, 30, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-05 22:23:48'),
(535, 4, 31, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-05 22:23:48'),
(536, 4, 32, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-05 22:23:48'),
(537, 4, 33, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-05 22:23:48'),
(538, 4, 1, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-05 22:31:01'),
(539, 4, 2, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-05 22:31:01'),
(540, 4, 3, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-05 22:31:01'),
(541, 4, 5, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-05 22:31:01'),
(542, 4, 6, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-05 22:31:01'),
(543, 4, 7, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-05 22:31:01'),
(544, 4, 8, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-05 22:31:01'),
(545, 4, 9, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-05 22:31:01'),
(546, 4, 10, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-05 22:31:01'),
(547, 4, 11, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-05 22:31:01'),
(548, 4, 12, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-05 22:31:01'),
(549, 4, 13, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-05 22:31:01'),
(550, 4, 14, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-05 22:31:01'),
(551, 4, 15, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-05 22:31:01'),
(552, 4, 16, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-05 22:31:01'),
(553, 4, 17, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-05 22:31:01'),
(554, 4, 18, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-05 22:31:01'),
(555, 4, 19, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-05 22:31:01'),
(556, 4, 20, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-05 22:31:01'),
(557, 4, 21, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-05 22:31:01'),
(558, 4, 22, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-05 22:31:01'),
(559, 4, 23, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-05 22:31:01'),
(560, 4, 24, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-05 22:31:01'),
(561, 4, 25, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-05 22:31:01'),
(562, 4, 26, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-05 22:31:01'),
(563, 4, 27, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-05 22:31:01'),
(564, 4, 28, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-05 22:31:01'),
(565, 4, 29, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-05 22:31:01'),
(566, 4, 30, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-05 22:31:01'),
(567, 4, 31, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-05 22:31:01'),
(568, 4, 32, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-05 22:31:01'),
(569, 4, 33, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-05 22:31:01'),
(570, 4, 1, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 05:48:13'),
(571, 4, 2, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 05:48:13'),
(572, 4, 3, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 05:48:13'),
(573, 4, 5, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 05:48:13'),
(574, 4, 6, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 05:48:13'),
(575, 4, 7, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 05:48:13'),
(576, 4, 8, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 05:48:13'),
(577, 4, 9, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 05:48:13'),
(578, 4, 10, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 05:48:13'),
(579, 4, 11, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 05:48:13'),
(580, 4, 12, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 05:48:13'),
(581, 4, 13, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 05:48:13'),
(582, 4, 14, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 05:48:13'),
(583, 4, 15, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 05:48:13'),
(584, 4, 16, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 05:48:13'),
(585, 4, 17, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 05:48:13'),
(586, 4, 18, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 05:48:13'),
(587, 4, 19, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 05:48:13'),
(588, 4, 20, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 05:48:13'),
(589, 4, 21, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 05:48:13'),
(590, 4, 22, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 05:48:13'),
(591, 4, 23, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 05:48:13'),
(592, 4, 24, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 05:48:13'),
(593, 4, 25, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 05:48:13'),
(594, 4, 26, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 05:48:13'),
(595, 4, 27, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 05:48:13'),
(596, 4, 28, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 05:48:13'),
(597, 4, 29, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 05:48:13'),
(598, 4, 30, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 05:48:13'),
(599, 4, 31, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 05:48:13'),
(600, 4, 32, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 05:48:13'),
(601, 4, 33, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 05:48:13'),
(602, 4, 1, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:45:01'),
(603, 4, 2, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:45:01'),
(604, 4, 3, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:45:01'),
(605, 4, 5, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:45:01'),
(606, 4, 6, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:45:01'),
(607, 4, 7, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:45:01'),
(608, 4, 8, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:45:01'),
(609, 4, 9, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:45:01'),
(610, 4, 10, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:45:01'),
(611, 4, 11, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:45:01'),
(612, 4, 12, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:45:01'),
(613, 4, 13, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:45:01'),
(614, 4, 14, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:45:01'),
(615, 4, 15, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:45:01'),
(616, 4, 16, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:45:01'),
(617, 4, 17, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:45:01'),
(618, 4, 18, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:45:01'),
(619, 4, 19, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:45:01'),
(620, 4, 20, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:45:01'),
(621, 4, 21, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:45:01'),
(622, 4, 22, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:45:01'),
(623, 4, 23, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:45:01'),
(624, 4, 24, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:45:01'),
(625, 4, 25, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:45:01'),
(626, 4, 26, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:45:01'),
(627, 4, 27, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:45:01'),
(628, 4, 28, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:45:01'),
(629, 4, 29, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:45:01'),
(630, 4, 30, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:45:01'),
(631, 4, 31, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:45:01'),
(632, 4, 32, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:45:01'),
(633, 4, 33, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:45:01'),
(634, 4, 1, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 09:45:13'),
(635, 4, 2, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 09:45:13'),
(636, 4, 3, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 09:45:13'),
(637, 4, 5, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 09:45:13'),
(638, 4, 6, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 09:45:13'),
(639, 4, 7, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 09:45:13'),
(640, 4, 8, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 09:45:13'),
(641, 4, 9, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 09:45:13'),
(642, 4, 10, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 09:45:13'),
(643, 4, 11, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 09:45:13'),
(644, 4, 12, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 09:45:13'),
(645, 4, 13, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 09:45:13'),
(646, 4, 14, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 09:45:13'),
(647, 4, 15, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 09:45:13'),
(648, 4, 16, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 09:45:13'),
(649, 4, 17, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 09:45:13'),
(650, 4, 18, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 09:45:13'),
(651, 4, 19, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 09:45:13'),
(652, 4, 20, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 09:45:13'),
(653, 4, 21, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 09:45:13'),
(654, 4, 22, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 09:45:13'),
(655, 4, 23, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 09:45:13'),
(656, 4, 24, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 09:45:13'),
(657, 4, 25, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 09:45:13'),
(658, 4, 26, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 09:45:13'),
(659, 4, 27, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 09:45:13'),
(660, 4, 28, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 09:45:13'),
(661, 4, 29, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 09:45:13'),
(662, 4, 30, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 09:45:13'),
(663, 4, 31, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 09:45:13'),
(664, 4, 32, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 09:45:13'),
(665, 4, 33, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 09:45:13'),
(666, 4, 1, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:45:30'),
(667, 4, 2, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:45:30'),
(668, 4, 3, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:45:30'),
(669, 4, 5, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:45:30'),
(670, 4, 6, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:45:30'),
(671, 4, 7, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:45:30'),
(672, 4, 8, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:45:30'),
(673, 4, 9, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:45:30'),
(674, 4, 10, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:45:30'),
(675, 4, 11, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:45:30'),
(676, 4, 12, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:45:30'),
(677, 4, 13, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:45:30'),
(678, 4, 14, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:45:30'),
(679, 4, 15, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:45:30'),
(680, 4, 16, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:45:30'),
(681, 4, 17, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:45:30'),
(682, 4, 18, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:45:30'),
(683, 4, 19, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:45:30'),
(684, 4, 20, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:45:30'),
(685, 4, 21, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:45:30'),
(686, 4, 22, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:45:30'),
(687, 4, 23, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:45:30'),
(688, 4, 24, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:45:30'),
(689, 4, 25, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:45:30'),
(690, 4, 26, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:45:30'),
(691, 4, 27, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:45:30'),
(692, 4, 28, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:45:30'),
(693, 4, 29, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:45:30'),
(694, 4, 30, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:45:30'),
(695, 4, 31, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:45:30'),
(696, 4, 32, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:45:30'),
(697, 4, 33, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:45:30'),
(698, 4, 1, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:47:05'),
(699, 4, 2, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:47:05'),
(700, 4, 3, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:47:05'),
(701, 4, 5, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:47:05'),
(702, 4, 6, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:47:05'),
(703, 4, 7, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:47:05'),
(704, 4, 8, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:47:05'),
(705, 4, 9, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:47:05'),
(706, 4, 10, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:47:05'),
(707, 4, 11, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:47:05'),
(708, 4, 12, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:47:05'),
(709, 4, 13, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:47:05'),
(710, 4, 14, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:47:05'),
(711, 4, 15, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:47:05'),
(712, 4, 16, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:47:05'),
(713, 4, 17, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:47:05'),
(714, 4, 18, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:47:05'),
(715, 4, 19, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:47:05'),
(716, 4, 20, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:47:05'),
(717, 4, 21, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:47:05'),
(718, 4, 22, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:47:05'),
(719, 4, 23, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:47:05'),
(720, 4, 24, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:47:05'),
(721, 4, 25, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:47:05'),
(722, 4, 26, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:47:05'),
(723, 4, 27, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:47:05'),
(724, 4, 28, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:47:05'),
(725, 4, 29, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:47:05'),
(726, 4, 30, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:47:05'),
(727, 4, 31, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:47:05'),
(728, 4, 32, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:47:05'),
(729, 4, 33, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 09:47:05'),
(730, 4, 1, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:30:49'),
(731, 4, 2, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:30:49'),
(732, 4, 3, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:30:49'),
(733, 4, 5, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:30:49'),
(734, 4, 6, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:30:49'),
(735, 4, 7, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:30:49'),
(736, 4, 8, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:30:49'),
(737, 4, 9, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:30:49'),
(738, 4, 10, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:30:49'),
(739, 4, 11, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:30:49'),
(740, 4, 12, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:30:49'),
(741, 4, 13, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:30:49'),
(742, 4, 14, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:30:49'),
(743, 4, 15, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:30:49'),
(744, 4, 16, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:30:49'),
(745, 4, 17, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:30:49'),
(746, 4, 18, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:30:49'),
(747, 4, 19, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:30:49'),
(748, 4, 20, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:30:49'),
(749, 4, 21, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:30:49'),
(750, 4, 22, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:30:49'),
(751, 4, 23, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:30:49'),
(752, 4, 24, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:30:49'),
(753, 4, 25, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:30:49'),
(754, 4, 26, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:30:49'),
(755, 4, 27, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:30:49'),
(756, 4, 28, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:30:49'),
(757, 4, 29, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:30:49'),
(758, 4, 30, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:30:49'),
(759, 4, 31, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:30:49'),
(760, 4, 32, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:30:49'),
(761, 4, 33, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:30:49'),
(762, 4, 1, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:30:52'),
(763, 4, 2, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:30:52'),
(764, 4, 3, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:30:52'),
(765, 4, 5, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:30:52'),
(766, 4, 6, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:30:52'),
(767, 4, 7, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:30:52'),
(768, 4, 8, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:30:52'),
(769, 4, 9, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:30:52'),
(770, 4, 10, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:30:52'),
(771, 4, 11, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:30:52'),
(772, 4, 12, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:30:52'),
(773, 4, 13, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:30:52'),
(774, 4, 14, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:30:52'),
(775, 4, 15, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:30:52'),
(776, 4, 16, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:30:52'),
(777, 4, 17, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:30:52'),
(778, 4, 18, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:30:52'),
(779, 4, 19, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:30:52'),
(780, 4, 20, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:30:52'),
(781, 4, 21, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:30:52'),
(782, 4, 22, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:30:52'),
(783, 4, 23, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:30:52'),
(784, 4, 24, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:30:52'),
(785, 4, 25, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:30:52'),
(786, 4, 26, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:30:52'),
(787, 4, 27, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:30:52'),
(788, 4, 28, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:30:52');
INSERT INTO `agent_notifications` (`id`, `from_agent_id`, `to_agent_id`, `type_id`, `title`, `message`, `created_at`) VALUES
(789, 4, 29, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:30:52'),
(790, 4, 30, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:30:52'),
(791, 4, 31, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:30:52'),
(792, 4, 32, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:30:52'),
(793, 4, 33, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:30:52'),
(794, 4, 1, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:31:23'),
(795, 4, 2, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:31:23'),
(796, 4, 3, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:31:23'),
(797, 4, 5, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:31:23'),
(798, 4, 6, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:31:23'),
(799, 4, 7, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:31:23'),
(800, 4, 8, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:31:23'),
(801, 4, 9, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:31:23'),
(802, 4, 10, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:31:23'),
(803, 4, 11, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:31:23'),
(804, 4, 12, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:31:23'),
(805, 4, 13, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:31:23'),
(806, 4, 14, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:31:23'),
(807, 4, 15, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:31:23'),
(808, 4, 16, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:31:23'),
(809, 4, 17, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:31:23'),
(810, 4, 18, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:31:23'),
(811, 4, 19, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:31:23'),
(812, 4, 20, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:31:23'),
(813, 4, 21, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:31:23'),
(814, 4, 22, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:31:23'),
(815, 4, 23, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:31:23'),
(816, 4, 24, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:31:23'),
(817, 4, 25, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:31:23'),
(818, 4, 26, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:31:23'),
(819, 4, 27, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:31:23'),
(820, 4, 28, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:31:23'),
(821, 4, 29, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:31:23'),
(822, 4, 30, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:31:23'),
(823, 4, 31, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:31:23'),
(824, 4, 32, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:31:23'),
(825, 4, 33, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:31:23'),
(826, 4, 1, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:42:09'),
(827, 4, 2, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:42:09'),
(828, 4, 3, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:42:09'),
(829, 4, 5, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:42:09'),
(830, 4, 6, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:42:09'),
(831, 4, 7, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:42:09'),
(832, 4, 8, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:42:09'),
(833, 4, 9, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:42:09'),
(834, 4, 10, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:42:09'),
(835, 4, 11, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:42:09'),
(836, 4, 12, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:42:09'),
(837, 4, 13, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:42:09'),
(838, 4, 14, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:42:09'),
(839, 4, 15, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:42:09'),
(840, 4, 16, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:42:09'),
(841, 4, 17, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:42:09'),
(842, 4, 18, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:42:09'),
(843, 4, 19, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:42:09'),
(844, 4, 20, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:42:09'),
(845, 4, 21, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:42:09'),
(846, 4, 22, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:42:09'),
(847, 4, 23, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:42:09'),
(848, 4, 24, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:42:09'),
(849, 4, 25, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:42:09'),
(850, 4, 26, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:42:09'),
(851, 4, 27, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:42:09'),
(852, 4, 28, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:42:09'),
(853, 4, 29, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:42:09'),
(854, 4, 30, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:42:09'),
(855, 4, 31, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:42:09'),
(856, 4, 32, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:42:09'),
(857, 4, 33, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:42:09'),
(858, 4, 1, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:42:37'),
(859, 4, 2, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:42:37'),
(860, 4, 3, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:42:37'),
(861, 4, 5, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:42:37'),
(862, 4, 6, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:42:37'),
(863, 4, 7, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:42:37'),
(864, 4, 8, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:42:37'),
(865, 4, 9, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:42:37'),
(866, 4, 10, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:42:37'),
(867, 4, 11, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:42:37'),
(868, 4, 12, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:42:37'),
(869, 4, 13, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:42:37'),
(870, 4, 14, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:42:37'),
(871, 4, 15, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:42:37'),
(872, 4, 16, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:42:37'),
(873, 4, 17, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:42:37'),
(874, 4, 18, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:42:37'),
(875, 4, 19, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:42:37'),
(876, 4, 20, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:42:37'),
(877, 4, 21, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:42:37'),
(878, 4, 22, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:42:37'),
(879, 4, 23, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:42:37'),
(880, 4, 24, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:42:37'),
(881, 4, 25, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:42:37'),
(882, 4, 26, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:42:37'),
(883, 4, 27, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:42:37'),
(884, 4, 28, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:42:37'),
(885, 4, 29, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:42:37'),
(886, 4, 30, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:42:37'),
(887, 4, 31, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:42:37'),
(888, 4, 32, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:42:37'),
(889, 4, 33, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:42:37'),
(890, 4, 1, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:46:00'),
(891, 4, 2, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:46:00'),
(892, 4, 3, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:46:00'),
(893, 4, 5, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:46:00'),
(894, 4, 6, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:46:00'),
(895, 4, 7, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:46:00'),
(896, 4, 8, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:46:00'),
(897, 4, 9, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:46:00'),
(898, 4, 10, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:46:00'),
(899, 4, 11, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:46:00'),
(900, 4, 12, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:46:00'),
(901, 4, 13, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:46:00'),
(902, 4, 14, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:46:00'),
(903, 4, 15, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:46:00'),
(904, 4, 16, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:46:00'),
(905, 4, 17, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:46:00'),
(906, 4, 18, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:46:00'),
(907, 4, 19, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:46:00'),
(908, 4, 20, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:46:00'),
(909, 4, 21, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:46:00'),
(910, 4, 22, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:46:00'),
(911, 4, 23, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:46:00'),
(912, 4, 24, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:46:00'),
(913, 4, 25, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:46:00'),
(914, 4, 26, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:46:00'),
(915, 4, 27, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:46:00'),
(916, 4, 28, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:46:00'),
(917, 4, 29, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:46:00'),
(918, 4, 30, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:46:00'),
(919, 4, 31, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:46:00'),
(920, 4, 32, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:46:00'),
(921, 4, 33, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 10:46:00'),
(922, 4, 1, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:47:31'),
(923, 4, 2, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:47:31'),
(924, 4, 3, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:47:31'),
(925, 4, 5, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:47:31'),
(926, 4, 6, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:47:31'),
(927, 4, 7, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:47:31'),
(928, 4, 8, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:47:31'),
(929, 4, 9, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:47:31'),
(930, 4, 10, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:47:31'),
(931, 4, 11, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:47:31'),
(932, 4, 12, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:47:31'),
(933, 4, 13, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:47:31'),
(934, 4, 14, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:47:31'),
(935, 4, 15, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:47:31'),
(936, 4, 16, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:47:31'),
(937, 4, 17, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:47:31'),
(938, 4, 18, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:47:31'),
(939, 4, 19, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:47:31'),
(940, 4, 20, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:47:31'),
(941, 4, 21, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:47:31'),
(942, 4, 22, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:47:31'),
(943, 4, 23, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:47:31'),
(944, 4, 24, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:47:31'),
(945, 4, 25, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:47:31'),
(946, 4, 26, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:47:31'),
(947, 4, 27, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:47:31'),
(948, 4, 28, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:47:31'),
(949, 4, 29, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:47:31'),
(950, 4, 30, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:47:31'),
(951, 4, 31, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:47:31'),
(952, 4, 32, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:47:31'),
(953, 4, 33, 3, 'Township Deactivated', 'The township of Yangon has been deactivated and is no longer available for new deliveries.', '2025-08-06 10:47:31'),
(954, 5, 2, 3, 'Return Initiated', 'Return started for voucher MDY337605YGN. Please check it.', '2025-08-06 15:27:06'),
(955, 5, 2, 2, 'Delivery Completed', 'Delivery MDY337605YGN marked as \'Delivered\'. Earnings processed.', '2025-08-06 15:37:17'),
(956, 5, 2, 2, 'Delivery Completed', 'Delivery MDY337605YGN marked as \'Delivered\'. Earnings processed.', '2025-08-06 15:39:44'),
(957, 5, 2, 2, 'Delivery Completed', 'Delivery MDY337605YGN marked as \'Delivered\'. Earnings processed.', '2025-08-06 15:43:47'),
(958, 5, 2, 3, 'Return Initiated', 'Return started for voucher MDY337605YGN. Please check it.', '2025-08-06 15:48:24'),
(959, 5, 2, 3, 'Return Initiated', 'Return started for voucher MDY337605YGN. Please check it.', '2025-08-06 15:50:02'),
(960, 5, 2, 3, 'Return Initiated', 'Return started for voucher MDY337605YGN. Please check it.', '2025-08-06 15:51:06'),
(961, 2, 5, 1, 'New Delivery Available!', 'A new delivery request (Order ID: #MDY383541YGN) is available for acceptance. Check \'Request Deliveries\'.', '2025-08-06 12:20:30'),
(962, 4, 1, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 12:26:26'),
(963, 4, 2, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 12:26:26'),
(964, 4, 3, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 12:26:26'),
(965, 4, 5, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 12:26:26'),
(966, 4, 6, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 12:26:26'),
(967, 4, 7, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 12:26:26'),
(968, 4, 8, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 12:26:26'),
(969, 4, 9, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 12:26:26'),
(970, 4, 10, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 12:26:26'),
(971, 4, 11, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 12:26:26'),
(972, 4, 12, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 12:26:26'),
(973, 4, 13, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 12:26:26'),
(974, 4, 14, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 12:26:26'),
(975, 4, 15, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 12:26:26'),
(976, 4, 16, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 12:26:26'),
(977, 4, 17, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 12:26:26'),
(978, 4, 18, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 12:26:26'),
(979, 4, 19, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 12:26:26'),
(980, 4, 20, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 12:26:26'),
(981, 4, 21, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 12:26:26'),
(982, 4, 22, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 12:26:26'),
(983, 4, 23, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 12:26:26'),
(984, 4, 24, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 12:26:26'),
(985, 4, 25, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 12:26:26'),
(986, 4, 26, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 12:26:26'),
(987, 4, 27, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 12:26:26'),
(988, 4, 28, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 12:26:26'),
(989, 4, 29, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 12:26:26'),
(990, 4, 30, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 12:26:26'),
(991, 4, 31, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 12:26:26'),
(992, 4, 32, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 12:26:26'),
(993, 4, 33, 2, 'Township Activated', 'Activation complete: Yangon is now live in the system.', '2025-08-06 12:26:26'),
(994, 2, 5, 1, 'New Delivery Available!', 'A new delivery request (Order ID: #MDY467313YGN) is available for acceptance. Check \'Request Deliveries\'.', '2025-08-06 12:26:35');

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
(1, 1, 1, 1, 7, '2025-07-30 09:30:10', '2025-08-06 16:56:26', 1),
(2, 1, 1, 2, 8, '2025-07-30 09:30:10', '2025-08-06 14:42:21', 1),
(3, 1, 1, 5, NULL, '2025-07-30 09:30:10', '2025-08-05 07:11:52', 1),
(4, 1, 1, 6, NULL, '2025-07-30 09:30:10', '2025-08-05 07:11:57', 1),
(5, 2, 2, 3, NULL, '2025-07-30 09:30:10', '2025-07-30 09:51:54', 3),
(7, 2, 2, 8, NULL, '2025-07-30 09:30:10', '2025-07-30 09:51:58', 3),
(13, 1, 4, 11, NULL, '2025-07-30 09:30:10', '2025-07-30 09:52:08', 3),
(15, 1, 5, 13, NULL, '2025-07-30 09:30:10', '2025-07-30 09:52:11', 3),
(17, 1, 6, 15, NULL, '2025-07-30 09:30:10', '2025-07-30 09:52:14', 3),
(19, 2, 7, 17, NULL, '2025-07-30 09:30:10', '2025-07-30 09:52:18', 3),
(21, 2, 8, 19, NULL, '2025-07-30 09:30:10', '2025-07-30 09:52:21', 3),
(23, 2, 9, 21, NULL, '2025-07-30 09:30:10', '2025-07-30 09:52:24', 3),
(25, 2, 10, 23, NULL, '2025-07-30 09:30:10', '2025-07-30 09:52:29', 3),
(27, 2, 11, 25, NULL, '2025-07-30 09:30:10', '2025-08-01 07:18:20', 3),
(45, 1, 1, 51, NULL, '2025-08-05 09:56:41', NULL, 3);

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
(4, 1, 'Thanlyin'),
(5, 1, 'Hmawbi'),
(6, 1, 'Thaketa'),
(7, 1, 'Insein'),
(8, 2, 'Pyin Oo Lwin'),
(9, 2, 'Myingyan'),
(10, 2, 'Amarapura'),
(11, 2, 'Meiktila'),
(17, 1, 'Yangon'),
(24, 2, 'pyawbwe'),
(25, 2, 'kumae'),
(26, 2, 'bagan');

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
  `piece_count` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `deliveries`
--

INSERT INTO `deliveries` (`id`, `sender_agent_id`, `receiver_agent_id`, `sender_customer_id`, `receiver_customer_id`, `weight`, `amount`, `delivery_status_id`, `payment_status_id`, `created_at`, `updated_at`, `product_type`, `tracking_code`, `duration`, `from_township_id`, `to_township_id`, `from_city_id`, `to_city_id`, `from_region_id`, `to_region_id`, `delivery_type_id`, `piece_count`) VALUES
(5, 5, 3, 80, 81, 11.00, 33738.54, 1, 3, '2025-08-05 10:27:24', '2025-08-06 15:59:07', '11', 'YGN423543YGN', '2025-08-06 03:57:24', 1, 2, 1, 2, 1, 2, 2, 11),
(6, 5, 3, 80, 81, 11.00, 34782.00, 6, 3, '2025-08-05 10:29:44', '2025-08-06 02:36:37', '11', 'YGN725189YGN', '2025-08-06 03:59:44', 1, 2, 1, 2, 1, 2, 2, 11),
(7, 2, 5, 84, 85, 12.00, 20640.00, 5, 3, '2025-08-05 12:49:01', '2025-08-06 15:48:24', 'nn', 'MDY337605YGN', '2025-08-05 08:19:01', 3, 1, 2, 1, 2, 1, 1, 5);

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
(2, 'In Transit'),
(3, 'Delivered'),
(4, 'Cancelled'),
(5, 'Returned'),
(6, 'Awaiting Acceptance'),
(7, 'Rejected');

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
(2, 5, 2, 5, 'In Stransti', '2025-08-05 23:08:05'),
(3, 6, 1, NULL, NULL, NULL),
(5, 5, 1, 5, 'Pending', '2025-08-05 23:16:08'),
(6, 5, 2, 5, 'Hi', '2025-08-05 23:16:44'),
(7, 5, 4, 5, 'Cancelled', '2025-08-05 23:17:06'),
(8, 5, 6, 5, 'Waiting', '2025-08-05 23:20:26'),
(9, 5, 1, 5, 'pen', '2025-08-05 23:28:55'),
(10, 7, 1, NULL, NULL, NULL),
(12, 5, 6, 5, 'Wait Your Accept', '2025-08-06 09:02:31'),
(13, 6, 6, 5, 'Wait', '2025-08-06 09:06:37'),
(14, 7, 6, 2, 'Wait', '2025-08-06 09:07:21'),
(15, 7, 3, 5, 'Deliveried', '2025-08-06 09:14:19'),
(16, 7, 5, 5, 'This is Returned', '2025-08-06 09:16:24'),
(17, 7, 5, 5, '', '2025-08-06 21:57:06'),
(18, 7, 3, 5, '', '2025-08-06 22:07:17'),
(19, 7, 3, 5, '', '2025-08-06 22:09:44'),
(20, 7, 3, 5, 'Deliveried', '2025-08-06 22:13:47'),
(21, 7, 5, 5, 'Return', '2025-08-06 22:18:24'),
(22, 7, 5, 5, 'Returned', '2025-08-06 22:20:02'),
(23, 7, 5, 5, 'Returned Package', '2025-08-06 22:21:06'),
(24, 5, 1, 5, 'Pending', '2025-08-06 22:29:07');

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
(4, 'from_agent'),
(3, 'from_delivery_issue'),
(2, 'my_delivery'),
(1, 'request_delivery');

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
(1, 'Unpaid'),
(2, 'Paid'),
(3, 'Prepaid');

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
(2, 'Mandalay Region'),
(3, 'Sagaing Region');

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
(3, 'Customer');

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
(1, 1, 1, 8, 17, 76.85, 3532.00, 'active', '2025-05-29 23:03:43', '2025-08-06 16:56:26', 165),
(2, 1, 1, 5, 25, 26.16, 2650.20, 'active', '2024-11-22 23:03:43', '2025-08-06 16:56:26', 130),
(3, 2, 8, 9, 19, 37.61, 4361.20, 'active', '2025-05-29 23:03:43', '2025-06-28 23:03:43', 33),
(4, 2, 3, 2, 8, 128.75, 6167.00, 'active', '2025-02-20 23:03:43', '2025-02-23 23:03:43', 52),
(5, 1, 5, 1, 6, 31.16, 2059.20, 'active', '2025-06-12 23:03:43', '2025-08-06 16:56:26', 126),
(6, 2, 8, 11, 23, 67.79, 4052.80, 'active', '2025-05-22 23:03:43', '2025-06-15 23:03:43', 151),
(7, 1, 1, 7, 13, 13.62, 1817.40, 'active', '2025-04-22 23:03:43', '2025-08-06 16:56:26', 190),
(8, 10, 21, 5, 25, 125.41, 4098.20, 'active', '2024-08-11 23:03:43', '2025-08-05 07:11:52', 194),
(9, 1, 1, 1, 6, 69.83, 2576.60, 'active', '2025-04-24 23:03:43', '2025-08-06 16:56:26', 166),
(10, 9, 19, 6, 15, 138.55, 3888.00, 'active', '2024-12-05 23:03:43', '2024-12-14 23:03:43', 139),
(11, 11, 23, 9, 19, 52.04, 3863.80, 'active', '2025-02-12 23:03:43', '2025-03-08 23:03:43', 144),
(12, 11, 23, 2, 8, 32.98, 4174.60, 'active', '2025-01-09 23:03:43', '2025-01-27 23:03:43', 176),
(13, 1, 2, 6, 15, 96.47, 5902.40, 'active', '2024-10-26 23:03:43', '2025-08-06 16:56:26', 87),
(14, 1, 5, 1, 6, 146.35, 4601.00, 'active', '2025-01-24 23:03:43', '2025-08-06 16:56:26', 192),
(15, 2, 3, 1, 5, 117.71, 5423.20, 'active', '2024-11-29 23:03:43', '2025-08-06 16:56:26', 122),
(16, 5, 25, 1, 6, 102.60, 3939.00, 'active', '2024-09-29 23:03:43', '2025-08-06 16:56:26', 180),
(17, 1, 2, 5, 25, 135.54, 3956.80, 'active', '2025-05-04 23:03:43', '2025-08-06 16:56:26', 48),
(18, 1, 5, 2, 8, 105.69, 3303.80, 'active', '2025-01-29 23:03:43', '2025-08-06 16:56:26', 69),
(19, 5, 25, 1, 6, 57.65, 4676.00, 'active', '2024-10-04 23:03:43', '2025-08-06 16:56:26', 179),
(20, 6, 15, 2, 8, 49.11, 4730.20, 'active', '2025-04-05 23:03:43', '2025-08-05 07:11:48', 160),
(21, 5, 25, 7, 13, 41.47, 2884.40, 'active', '2025-05-04 23:03:43', '2025-05-24 23:03:43', 161),
(22, 2, 3, 1, 2, 139.39, 5870.80, 'active', '2025-05-17 23:03:43', '2025-08-06 16:56:26', 92),
(23, 2, 8, 1, 6, 93.02, 5500.40, 'active', '2025-02-10 23:03:43', '2025-08-06 16:56:26', 130),
(24, 1, 6, 7, 13, 10.04, 2718.80, 'active', '2024-11-29 23:03:43', '2025-08-06 16:56:26', 47),
(25, 1, 2, 2, 8, 107.26, 3670.20, 'active', '2025-04-13 23:03:43', '2025-08-06 16:56:26', 185),
(26, 1, 5, 4, 11, 144.61, 4733.20, 'active', '2025-05-09 23:03:43', '2025-08-06 16:56:26', 154),
(27, 9, 19, 4, 11, 78.63, 3830.60, 'inactive', '2024-08-22 23:03:43', '2024-09-13 23:03:43', 35),
(28, 1, 1, 1, 5, 75.30, 3783.00, 'active', '2024-12-13 23:03:43', '2025-08-06 16:56:26', 35),
(29, 10, 21, 9, 19, 40.99, 3094.80, 'active', '2025-02-11 23:03:43', '2025-02-24 23:03:43', 45),
(30, 9, 19, 8, 17, 108.65, 3580.00, 'active', '2024-11-28 23:03:43', '2024-12-26 23:03:43', 64),
(31, 8, 17, 2, 8, 52.78, 3482.60, 'active', '2025-07-01 23:03:43', '2025-08-05 07:11:48', 51),
(32, 2, 3, 11, 23, 139.04, 6140.80, 'active', '2025-03-09 23:03:43', '2025-03-19 23:03:43', 199),
(33, 4, 11, 1, 6, 96.40, 4291.00, 'active', '2025-01-16 23:03:43', '2025-08-06 16:56:26', 194),
(34, 8, 17, 4, 11, 141.70, 6776.00, 'active', '2025-07-06 23:03:43', '2025-07-23 23:03:43', 168),
(35, 2, 8, 7, 13, 44.31, 3879.20, 'active', '2024-10-15 23:03:43', '2025-08-05 07:11:48', 59),
(36, 1, 6, 1, 5, 55.28, 3534.60, 'active', '2024-08-22 23:03:43', '2025-08-06 16:56:26', 135),
(37, 2, 3, 5, 25, 105.44, 4343.80, 'active', '2024-12-29 23:03:43', '2025-01-07 23:03:43', 44),
(38, 7, 13, 4, 11, 87.79, 3533.80, 'active', '2025-05-17 23:03:43', '2025-05-23 23:03:43', 95),
(39, 1, 2, 11, 23, 134.45, 4707.00, 'active', '2025-02-22 23:03:43', '2025-08-06 16:56:26', 114),
(40, 1, 1, 4, 11, 81.18, 4827.60, 'active', '2024-10-03 23:03:43', '2025-08-06 16:56:26', 48),
(41, 5, 25, 8, 17, 17.55, 3817.00, 'active', '2025-04-17 23:03:43', '2025-08-05 07:11:52', 63),
(42, 8, 17, 6, 15, 119.71, 4022.20, 'active', '2024-10-01 23:03:43', '2025-08-05 07:11:57', 113),
(43, 1, 2, 10, 21, 72.51, 4059.20, 'active', '2025-02-03 23:03:43', '2025-08-06 16:56:26', 98),
(44, 2, 3, 11, 23, 112.86, 4182.20, 'active', '2025-03-25 23:03:43', '2025-04-16 23:03:43', 194),
(45, 11, 23, 8, 17, 93.79, 4771.80, 'inactive', '2024-12-05 23:03:43', '2024-12-18 23:03:43', 101),
(46, 4, 11, 10, 21, 47.91, 4223.20, 'active', '2025-02-03 23:03:43', '2025-03-02 23:03:43', 194),
(47, 1, 2, 2, 3, 85.94, 3654.80, 'active', '2025-06-22 23:03:43', '2025-08-06 16:56:26', 161),
(48, 1, 5, 8, 17, 27.97, 3393.40, 'active', '2025-07-19 23:03:43', '2025-08-06 16:56:26', 95),
(49, 2, 8, 10, 21, 23.21, 2427.20, 'active', '2025-06-20 23:03:43', '2025-06-30 23:03:43', 98),
(50, 11, 23, 2, 3, 102.50, 5362.00, 'active', '2025-03-29 23:03:43', '2025-04-14 23:03:43', 34),
(51, 1, 2, 1, 6, 88.10, 3556.00, 'active', '2025-05-06 23:03:43', '2025-08-06 16:56:26', 33),
(52, 6, 15, 1, 6, 41.34, 2049.80, 'active', '2024-09-14 23:03:43', '2025-08-06 16:56:26', 126),
(53, 9, 19, 11, 23, 131.42, 5031.40, 'inactive', '2024-11-15 23:03:43', '2024-12-02 23:03:43', 57),
(54, 5, 25, 6, 15, 132.20, 5678.00, 'active', '2024-11-16 23:03:43', '2024-12-05 23:03:43', 63),
(55, 2, 3, 5, 25, 81.20, 4767.00, 'active', '2025-02-17 23:03:43', '2025-02-19 23:03:43', 145),
(56, 6, 15, 11, 23, 60.68, 3876.60, 'active', '2024-10-15 23:03:43', '2025-08-05 07:11:57', 57),
(57, 6, 15, 2, 3, 70.63, 4750.60, 'active', '2025-06-14 23:03:43', '2025-08-05 07:11:48', 39),
(58, 1, 5, 1, 6, 81.59, 4208.80, 'active', '2024-08-07 23:03:43', '2025-08-06 16:56:26', 66),
(59, 2, 8, 1, 1, 113.34, 4358.80, 'active', '2024-10-19 23:03:43', '2025-08-06 16:56:26', 110),
(60, 8, 17, 2, 8, 49.46, 3391.20, 'active', '2024-11-18 23:03:43', '2024-12-01 23:03:43', 175),
(61, 6, 15, 9, 19, 48.18, 2899.60, 'active', '2024-10-26 23:03:43', '2025-08-05 07:11:57', 32),
(62, 7, 13, 2, 8, 74.80, 5049.00, 'active', '2025-06-17 23:03:43', '2025-06-28 23:03:43', 59),
(63, 2, 3, 8, 17, 139.62, 5844.40, 'active', '2024-10-27 23:03:43', '2025-08-05 07:11:48', 79),
(64, 1, 1, 2, 8, 38.72, 3802.40, 'active', '2025-01-14 23:03:43', '2025-08-06 16:56:26', 80),
(65, 9, 19, 1, 1, 103.43, 3206.60, 'active', '2024-09-05 23:03:43', '2025-08-06 16:56:26', 132),
(66, 10, 21, 4, 11, 78.25, 4018.00, 'active', '2024-11-07 23:03:43', '2024-11-08 23:03:43', 185),
(67, 8, 17, 1, 6, 51.29, 3333.80, 'active', '2025-03-24 23:03:43', '2025-08-06 16:56:26', 128),
(68, 8, 17, 4, 11, 144.28, 6576.60, 'active', '2025-03-23 23:03:43', '2025-04-06 23:03:43', 105),
(69, 1, 6, 7, 13, 100.13, 3945.60, 'active', '2025-06-11 23:03:43', '2025-08-06 16:56:26', 118),
(70, 2, 3, 5, 25, 128.35, 4869.00, 'active', '2024-10-05 23:03:43', '2025-08-05 07:11:48', 157),
(71, 11, 23, 10, 21, 77.32, 4848.40, 'active', '2025-04-11 23:03:43', '2025-05-10 23:03:43', 73),
(72, 2, 8, 6, 15, 116.32, 3926.40, 'active', '2025-06-09 23:03:43', '2025-08-05 07:11:48', 74),
(73, 4, 11, 11, 23, 110.86, 5917.20, 'inactive', '2025-05-28 23:03:43', '2025-06-20 23:03:43', 55),
(74, 2, 3, 4, 11, 140.89, 5494.80, 'active', '2025-06-23 23:03:43', '2025-07-01 23:03:43', 121),
(75, 6, 15, 4, 11, 48.23, 4574.60, 'active', '2025-03-06 23:03:43', '2025-03-09 23:03:43', 34),
(76, 11, 23, 4, 11, 91.61, 4384.20, 'inactive', '2025-08-01 23:03:43', '2025-08-21 23:03:43', 146),
(77, 1, 6, 11, 23, 104.98, 4616.60, 'active', '2024-10-17 23:03:43', '2025-08-06 16:56:26', 168),
(78, 2, 3, 1, 5, 31.53, 2399.60, 'active', '2024-09-06 23:03:43', '2025-08-06 16:56:26', 133),
(79, 7, 13, 1, 5, 55.45, 3562.00, 'active', '2025-04-20 23:03:43', '2025-08-06 16:56:26', 133),
(80, 2, 3, 1, 2, 113.97, 4731.40, 'active', '2024-11-30 23:03:43', '2025-08-06 16:56:26', 128),
(81, 9, 19, 10, 21, 62.08, 4261.60, 'active', '2025-06-26 23:03:43', '2025-07-16 23:03:43', 80),
(82, 5, 25, 2, 8, 13.49, 2895.80, 'active', '2025-02-02 23:03:43', '2025-02-15 23:03:43', 44),
(83, 11, 23, 6, 15, 46.05, 4153.00, 'active', '2024-10-02 23:03:43', '2024-10-22 23:03:43', 97),
(84, 7, 13, 10, 21, 59.48, 2745.60, 'active', '2025-06-15 23:03:43', '2025-06-25 23:03:43', 68),
(85, 1, 2, 8, 17, 51.57, 4335.40, 'active', '2024-11-02 23:03:43', '2025-08-06 16:56:26', 143),
(86, 10, 21, 5, 25, 31.50, 2933.00, 'active', '2025-02-05 23:03:43', '2025-08-05 07:11:52', 140),
(87, 1, 5, 4, 11, 130.32, 6041.40, 'active', '2024-10-10 23:03:43', '2025-08-06 16:56:26', 197),
(88, 6, 15, 2, 3, 88.72, 4290.40, 'active', '2024-10-02 23:03:43', '2025-08-05 07:11:48', 156),
(89, 7, 13, 1, 1, 51.61, 3111.20, 'active', '2024-11-23 23:03:43', '2025-08-06 16:56:26', 93),
(90, 2, 3, 2, 8, 16.10, 3753.00, 'active', '2025-04-05 23:03:43', '2025-04-20 23:03:43', 65),
(91, 1, 5, 7, 13, 108.37, 4497.40, 'active', '2025-01-11 23:03:43', '2025-08-06 16:56:26', 135),
(92, 9, 19, 11, 23, 100.49, 3730.80, 'active', '2025-07-25 23:03:43', '2025-08-21 23:03:43', 157),
(93, 9, 19, 2, 8, 30.94, 2058.80, 'active', '2024-10-19 23:03:43', '2024-11-04 23:03:43', 47),
(94, 11, 23, 8, 17, 15.44, 3879.80, 'inactive', '2024-09-22 23:03:43', '2024-09-23 23:03:43', 158),
(95, 1, 1, 1, 2, 65.60, 3500.00, 'active', '2025-06-13 23:03:43', '2025-08-06 16:56:26', 105),
(96, 1, 2, 1, 5, 66.76, 2578.20, 'active', '2025-02-09 23:03:43', '2025-08-06 16:56:26', 115),
(97, 1, 5, 1, 6, 73.40, 2615.00, 'active', '2024-10-15 23:03:43', '2025-08-06 16:56:26', 32),
(98, 10, 21, 6, 15, 142.10, 3879.00, 'active', '2024-10-12 23:03:43', '2024-10-21 23:03:43', 163),
(99, 1, 2, 8, 17, 20.57, 2555.40, 'active', '2025-02-27 23:03:43', '2025-08-06 16:56:26', 67),
(100, 11, 23, 2, 3, 113.90, 6031.00, 'active', '2024-09-19 23:03:43', '2024-09-25 23:03:43', 192),
(101, 1, 1, 7, 13, 131.81, 4751.20, 'active', '2024-09-27 23:03:43', '2025-08-06 16:56:26', 85),
(102, 10, 21, 1, 5, 83.24, 3967.80, 'active', '2024-12-04 23:03:43', '2025-08-06 16:56:26', 99),
(103, 4, 11, 6, 15, 77.13, 3005.60, 'active', '2025-07-14 23:03:43', '2025-07-24 23:03:43', 68),
(104, 1, 6, 7, 13, 82.21, 4270.20, 'active', '2025-05-24 23:03:43', '2025-08-06 16:56:26', 61),
(105, 10, 21, 5, 25, 41.79, 2202.80, 'active', '2025-03-09 23:03:43', '2025-03-18 23:03:43', 198),
(106, 1, 6, 5, 25, 60.43, 3693.60, 'active', '2024-12-29 23:03:43', '2025-08-06 16:56:26', 43),
(107, 10, 21, 2, 3, 35.34, 3487.80, 'active', '2025-05-21 23:03:43', '2025-06-14 23:03:43', 194),
(108, 7, 13, 1, 6, 111.49, 4777.80, 'active', '2025-04-10 23:03:43', '2025-08-06 16:56:26', 175),
(109, 2, 3, 1, 6, 49.85, 2440.00, 'active', '2025-03-10 23:03:43', '2025-08-06 16:56:26', 137),
(110, 1, 5, 1, 2, 23.62, 1778.40, 'active', '2024-08-12 23:03:43', '2025-08-06 16:56:26', 53),
(111, 2, 3, 7, 13, 118.32, 3873.40, 'active', '2024-10-21 23:03:43', '2024-11-20 23:03:43', 121),
(112, 11, 23, 7, 13, 67.31, 3414.20, 'inactive', '2024-11-16 23:03:43', '2024-11-18 23:03:43', 143),
(113, 9, 19, 7, 13, 135.41, 5732.20, 'active', '2025-01-01 23:03:43', '2025-01-01 23:03:43', 70),
(114, 4, 11, 8, 17, 132.12, 3658.40, 'active', '2024-11-23 23:03:43', '2024-11-23 23:03:43', 160),
(115, 8, 17, 10, 21, 51.74, 2619.80, 'active', '2024-12-09 23:03:43', '2024-12-10 23:03:43', 82),
(116, 10, 21, 5, 25, 139.10, 3953.00, 'active', '2024-11-06 23:03:43', '2025-08-05 07:11:52', 78),
(117, 11, 23, 6, 15, 56.88, 5010.60, 'active', '2024-12-10 23:03:43', '2025-08-05 07:11:57', 142),
(118, 11, 23, 6, 15, 55.24, 3496.80, 'active', '2024-08-11 23:03:43', '2025-08-05 07:11:57', 55),
(119, 8, 17, 4, 11, 59.51, 4245.20, 'inactive', '2025-04-01 23:03:43', '2025-04-09 23:03:43', 87),
(120, 1, 5, 5, 25, 146.59, 5963.80, 'active', '2025-06-18 23:03:43', '2025-08-06 16:56:26', 154),
(121, 2, 3, 1, 6, 35.83, 4289.60, 'active', '2024-09-25 23:03:43', '2025-08-06 16:56:26', 77),
(122, 6, 15, 1, 1, 86.25, 3955.00, 'active', '2025-03-05 23:03:43', '2025-08-06 16:56:26', 104),
(123, 4, 11, 2, 8, 143.79, 5415.80, 'active', '2024-12-24 23:03:43', '2025-01-10 23:03:43', 160),
(124, 9, 19, 1, 1, 30.27, 3323.40, 'active', '2024-12-21 23:03:43', '2025-08-06 16:56:26', 148),
(125, 2, 8, 4, 11, 95.80, 3534.00, 'active', '2025-03-18 23:03:43', '2025-03-30 23:03:43', 115),
(126, 5, 25, 1, 6, 51.04, 2305.80, 'active', '2024-12-11 23:03:43', '2025-08-06 16:56:26', 176),
(127, 6, 15, 9, 19, 69.45, 4269.00, 'active', '2025-07-04 23:03:43', '2025-07-24 23:03:43', 49),
(128, 8, 17, 1, 2, 137.59, 5941.80, 'active', '2025-07-12 23:03:43', '2025-08-06 16:56:26', 174),
(129, 2, 3, 8, 17, 142.68, 5617.60, 'active', '2025-03-13 23:03:43', '2025-08-05 07:11:48', 105),
(130, 1, 5, 5, 25, 36.88, 4424.60, 'active', '2025-02-17 23:03:43', '2025-08-06 16:56:26', 104),
(131, 8, 17, 10, 21, 36.94, 2635.80, 'inactive', '2024-12-18 23:03:43', '2025-01-12 23:03:43', 35),
(132, 6, 15, 11, 23, 133.40, 3703.00, 'active', '2025-01-16 23:03:43', '2025-08-05 07:11:57', 132),
(133, 6, 15, 1, 6, 59.45, 2298.00, 'active', '2024-11-27 23:03:43', '2025-08-06 16:56:26', 118),
(134, 1, 5, 1, 1, 128.66, 5670.20, 'active', '2025-01-02 23:03:43', '2025-08-06 16:56:26', 64),
(135, 8, 17, 6, 15, 139.03, 5704.60, 'active', '2025-02-02 23:03:43', '2025-02-09 23:03:43', 104),
(136, 10, 21, 2, 3, 84.54, 4462.80, 'active', '2025-05-31 23:03:43', '2025-06-13 23:03:43', 90),
(137, 5, 25, 4, 11, 11.83, 3792.60, 'active', '2024-11-09 23:03:43', '2024-11-10 23:03:43', 46),
(138, 11, 23, 5, 25, 146.71, 5474.20, 'active', '2025-03-30 23:03:43', '2025-08-05 07:11:52', 104),
(139, 5, 25, 7, 13, 10.55, 2566.00, 'active', '2025-03-01 23:03:43', '2025-08-05 07:11:52', 86),
(140, 11, 23, 8, 17, 48.87, 3679.40, 'active', '2025-04-21 23:03:43', '2025-05-03 23:03:43', 180),
(141, 1, 5, 9, 19, 51.40, 2835.00, 'active', '2024-11-27 23:03:43', '2025-08-06 16:56:26', 58),
(142, 10, 21, 2, 3, 106.46, 5596.20, 'active', '2024-08-05 23:03:43', '2024-08-17 23:03:43', 122),
(143, 10, 21, 6, 15, 109.67, 6157.40, 'active', '2024-08-31 23:03:43', '2025-08-05 07:11:57', 157),
(144, 7, 13, 6, 15, 11.33, 3565.60, 'active', '2025-05-30 23:03:43', '2025-08-05 07:11:57', 189),
(145, 7, 13, 2, 3, 16.82, 2015.40, 'active', '2024-09-04 23:03:43', '2025-08-05 07:11:48', 67),
(146, 8, 17, 2, 8, 125.42, 4627.40, 'active', '2024-11-27 23:03:43', '2025-08-05 07:11:48', 59),
(147, 4, 11, 1, 6, 61.01, 4113.20, 'active', '2024-10-24 23:03:43', '2025-08-06 16:56:26', 124),
(148, 7, 13, 9, 19, 71.98, 3609.60, 'active', '2024-09-26 23:03:43', '2024-10-09 23:03:43', 77),
(149, 9, 19, 5, 25, 126.82, 4482.40, 'active', '2024-12-23 23:03:43', '2025-08-05 07:11:52', 31),
(150, 5, 25, 1, 6, 80.96, 3099.20, 'active', '2025-04-24 23:03:43', '2025-08-06 16:56:26', 196),
(151, 9, 19, 1, 5, 83.60, 4647.00, 'active', '2024-10-31 23:03:43', '2025-08-06 16:56:26', 68),
(152, 8, 17, 9, 19, 74.61, 4481.20, 'inactive', '2025-05-25 23:03:43', '2025-06-17 23:03:43', 55),
(153, 1, 2, 8, 17, 35.64, 3773.80, 'active', '2025-07-23 23:03:43', '2025-08-06 16:56:26', 151),
(154, 2, 3, 1, 5, 18.83, 1607.60, 'active', '2024-08-31 23:03:43', '2025-08-06 16:56:26', 48),
(155, 5, 25, 1, 5, 104.79, 4607.80, 'active', '2024-09-25 23:03:43', '2025-08-06 16:56:26', 107),
(156, 1, 6, 1, 5, 52.93, 2331.60, 'active', '2024-12-12 23:03:43', '2025-08-06 16:56:26', 74),
(157, 1, 5, 2, 8, 18.96, 3715.20, 'active', '2024-11-11 23:03:43', '2025-08-06 16:56:26', 171),
(158, 1, 2, 10, 21, 106.15, 5748.00, 'active', '2025-05-01 23:03:43', '2025-08-06 16:56:26', 199),
(159, 5, 25, 1, 6, 61.37, 5000.40, 'active', '2025-02-02 23:03:43', '2025-08-06 16:56:26', 36),
(160, 7, 13, 9, 19, 87.32, 4029.40, 'active', '2024-11-22 23:03:43', '2024-12-16 23:03:43', 151),
(161, 1, 5, 11, 23, 68.87, 3085.40, 'active', '2025-04-12 23:03:43', '2025-08-06 16:56:26', 141),
(162, 7, 13, 2, 3, 36.62, 3712.40, 'active', '2025-08-04 23:03:43', '2025-08-10 23:03:43', 155),
(163, 1, 1, 11, 23, 68.56, 3300.20, 'active', '2025-06-25 23:03:43', '2025-08-06 16:56:26', 149),
(164, 1, 6, 2, 8, 118.90, 3896.00, 'active', '2024-08-10 23:03:43', '2025-08-06 16:56:26', 48),
(165, 7, 13, 11, 23, 19.22, 3200.40, 'inactive', '2025-06-29 23:03:43', '2025-07-23 23:03:43', 43),
(166, 5, 25, 7, 13, 142.85, 4908.00, 'active', '2024-10-01 23:03:43', '2025-08-05 07:11:52', 119),
(167, 8, 17, 5, 25, 90.60, 5115.00, 'active', '2025-05-21 23:03:43', '2025-06-16 23:03:43', 187),
(168, 4, 11, 9, 19, 25.90, 3448.00, 'inactive', '2024-08-10 23:03:43', '2024-08-27 23:03:43', 90),
(169, 1, 6, 1, 1, 82.36, 3615.20, 'active', '2025-05-31 23:03:43', '2025-08-06 16:56:26', 99),
(170, 6, 15, 2, 8, 80.43, 2713.60, 'active', '2024-11-04 23:03:43', '2025-08-05 07:11:48', 114),
(171, 2, 3, 2, 8, 34.39, 2399.80, 'active', '2024-12-31 23:03:43', '2025-01-15 23:03:43', 120),
(172, 10, 21, 11, 23, 22.20, 2622.00, 'inactive', '2024-09-06 23:03:43', '2024-09-29 23:03:43', 120),
(173, 8, 17, 1, 2, 116.49, 4827.80, 'active', '2024-08-22 23:03:43', '2025-08-06 16:56:26', 151),
(174, 8, 17, 1, 1, 24.30, 4200.00, 'active', '2025-08-01 23:03:43', '2025-08-06 16:56:26', 125),
(175, 2, 3, 5, 25, 12.57, 3776.40, 'active', '2025-06-29 23:03:43', '2025-07-02 23:03:43', 121),
(176, 1, 2, 9, 19, 35.46, 2487.20, 'active', '2025-07-10 23:03:43', '2025-08-06 16:56:26', 163),
(177, 7, 13, 1, 6, 18.01, 1926.20, 'active', '2025-03-29 23:03:43', '2025-08-06 16:56:26', 108),
(178, 4, 11, 2, 3, 15.04, 4271.80, 'active', '2024-08-14 23:03:43', '2024-09-12 23:03:43', 137),
(179, 1, 2, 10, 21, 120.35, 6027.00, 'active', '2024-09-27 23:03:43', '2025-08-06 16:56:26', 108),
(180, 10, 21, 1, 6, 46.62, 3994.40, 'active', '2024-12-13 23:03:43', '2025-08-06 16:56:26', 150),
(181, 2, 3, 5, 25, 37.64, 3850.80, 'active', '2025-01-26 23:03:43', '2025-02-11 23:03:43', 45),
(182, 6, 15, 4, 11, 13.99, 4062.80, 'active', '2025-08-01 23:03:43', '2025-08-05 07:11:57', 190),
(183, 1, 5, 6, 15, 96.78, 3357.60, 'active', '2024-11-07 23:03:43', '2025-08-06 16:56:26', 93),
(184, 6, 15, 8, 17, 91.13, 3609.60, 'active', '2025-04-22 23:03:43', '2025-08-05 07:11:57', 110),
(185, 10, 21, 1, 2, 38.37, 4111.40, 'active', '2024-08-10 23:03:43', '2025-08-06 16:56:26', 108),
(186, 1, 6, 4, 11, 33.73, 2281.60, 'active', '2025-05-27 23:03:43', '2025-08-06 16:56:26', 148),
(187, 2, 8, 8, 17, 139.03, 6750.60, 'active', '2025-02-20 23:03:43', '2025-08-05 07:11:48', 60),
(188, 2, 3, 7, 13, 85.57, 5315.40, 'active', '2024-11-25 23:03:43', '2024-11-27 23:03:43', 61),
(189, 1, 2, 10, 21, 32.14, 3488.80, 'active', '2025-01-25 23:03:43', '2025-08-06 16:56:26', 118),
(190, 9, 19, 8, 17, 66.21, 3178.20, 'active', '2024-08-10 23:03:43', '2024-08-13 23:03:43', 74),
(191, 2, 8, 1, 5, 88.99, 4394.80, 'active', '2025-07-08 23:03:43', '2025-08-06 16:56:26', 91),
(192, 2, 3, 2, 8, 82.60, 3608.00, 'active', '2025-02-27 23:03:43', '2025-03-04 23:03:43', 33),
(193, 1, 1, 11, 23, 93.27, 3670.40, 'active', '2025-07-02 23:03:43', '2025-08-06 16:56:26', 52),
(194, 11, 23, 7, 13, 54.06, 2931.20, 'active', '2025-04-06 23:03:43', '2025-04-09 23:03:43', 196),
(195, 5, 25, 8, 17, 37.27, 2731.40, 'active', '2025-05-01 23:03:43', '2025-08-05 07:11:52', 198),
(196, 11, 23, 2, 3, 53.70, 3004.00, 'active', '2024-08-24 23:03:43', '2024-08-31 23:03:43', 49),
(197, 2, 3, 2, 8, 48.29, 2127.80, 'active', '2024-11-25 23:03:43', '2025-08-05 07:11:48', 196),
(198, 2, 3, 11, 23, 95.22, 4925.40, 'active', '2025-06-06 23:03:43', '2025-06-24 23:03:43', 139),
(199, 1, 6, 8, 17, 107.93, 4893.60, 'active', '2025-07-24 23:03:43', '2025-08-06 16:56:26', 64),
(200, 1, 6, 5, 25, 29.61, 3691.20, 'active', '2025-02-16 23:03:43', '2025-08-06 16:56:26', 89),
(201, 1, 1, 2, 3, 111.00, 3162.00, 'active', '2025-08-05 07:48:59', '2025-08-06 16:56:26', 11),
(202, 9, 19, 4, 11, 11.00, 1462.00, 'active', '2025-08-05 09:23:37', '2025-08-05 09:23:37', 111),
(203, 2, 8, 1, 1, 11.00, 1720.00, 'active', '2025-08-05 09:25:41', '2025-08-06 16:56:26', 111),
(204, 2, 8, 1, 1, 11.00, 1720.00, 'active', '2025-08-05 09:25:56', '2025-08-06 16:56:26', -11),
(205, 2, 3, 1, 1, 11.00, 1720.00, 'active', '2025-08-05 09:26:42', '2025-08-06 16:56:26', -11),
(206, 1, 2, 10, 21, 1.00, 1520.00, 'active', '2025-08-05 09:41:54', '2025-08-06 16:56:26', 1),
(207, 4, 11, 8, 17, 1.00, 1520.00, 'active', '2025-08-05 09:42:26', '2025-08-05 09:42:26', 1),
(208, 4, 11, 8, 17, 1.00, 1520.00, 'active', '2025-08-05 09:42:54', '2025-08-05 09:42:54', 1),
(209, 4, 11, 8, 17, 1.00, 1520.00, 'active', '2025-08-05 09:43:41', '2025-08-05 09:43:41', 1);

--
-- Triggers `route`
--
DELIMITER $$
CREATE TRIGGER `before_insert_route` BEFORE INSERT ON `route` FOR EACH ROW BEGIN
    -- Check from and to township are different
    IF NEW.from_township_id = NEW.to_township_id THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'From and To township cannot be the same.';
    END IF;

    -- Check distance is positive
    IF NEW.distance <= 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Distance must be greater than zero.';
    END IF;

    -- Set created_at if missing
    IF NEW.created_at IS NULL THEN
        SET NEW.created_at = NOW();
    END IF;

    -- Set default status if missing
    IF NEW.status IS NULL THEN
        SET NEW.status = 'active';
    END IF;
END
$$
DELIMITER ;

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
(5, 1, 'South Okkalapa Township'),
(6, 1, 'North Okkalapa Township'),
(8, 2, 'Kyauktan Township'),
(11, 4, 'Thanlyin Township'),
(13, 7, 'Insein Township'),
(15, 6, 'Thaketa Township'),
(17, 8, 'Pyin Oo Lwin Township'),
(19, 9, 'Myingyan Township'),
(21, 10, 'Amarapura Township'),
(23, 11, 'Meiktila Township'),
(25, 5, 'Hmawbi Township'),
(51, 1, 'Hlaing Township');

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
  `status_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `is_login` tinyint(1) DEFAULT 0,
  `user_type_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `access_code`, `name`, `phone`, `email`, `region_id`, `city_id`, `township_id`, `ward_id`, `address`, `password`, `otp_code`, `otp_expiry`, `security_code`, `role_id`, `status_id`, `created_at`, `is_login`, `user_type_id`) VALUES
(1, '', 'Min Thu', '09441386934', 'minthu@example.com', 1, 1, 3, 1, 'No.123, Insein Road, Yangon', 'encoded_password1', NULL, NULL, NULL, 2, 1, '2025-07-20 21:25:38', 0, NULL),
(2, '', 'Aung Aung', '09234567890', 'min20thu20@gmail.com', 2, 2, 3, 3, '456, Chanayethazan St, Mandalay', 'MQ==', '725544', NULL, '222222', 2, 1, '2025-07-20 21:25:38', 1, NULL),
(3, '', 'Min Thu ', '09772528282', 'mint12696@gmail.com', 1, 1, 2, 7, '111', '$2y$10$yUeLGqutV7oTlJ.Ix2yYv.l7N/6QEWFXc8/qFth/7WiC0ks.QZFqW', '350259', '2025-07-23 13:27:34', '739573', 2, 1, '2025-07-22 21:30:10', 0, NULL),
(4, '', 'Min Thu ', '09441386930', 'mint206202@gmail.com', 1, 1, 2, 3, '111', 'MTEx', NULL, NULL, '000000', 1, 3, '2025-07-22 21:31:15', 1, NULL),
(5, 'YGN0001', 'MI MI', '09441386934', 'mimikhainglin70@gmail.com', 1, 1, 1, 1, '111', 'MQ==', '155253', NULL, '111111', 2, 1, '2025-07-23 13:23:58', 0, NULL),
(6, '', 'Agent Insein 1', '0910000001', 'insein1@example.com', 1, 1, 1, NULL, 'Insein Address 1', 'hashed_password', NULL, NULL, NULL, 2, 3, '2025-08-05 12:09:49', 0, NULL),
(7, 'YGN0640', 'Agent Insein 2', '0910000002', 'mint206202@gmail.com', 1, 1, 1, NULL, 'Insein Address 2', 'hashed_password', NULL, NULL, '123123', 2, 1, '2025-08-05 12:09:49', 0, NULL),
(8, '', 'Agent Lanmadaw 1', '0910000003', 'lanmadaw1@example.com', 1, 1, 2, NULL, 'Lanmadaw Address 1', 'hashed_password', NULL, NULL, NULL, 2, 1, '2025-08-05 12:09:49', 0, NULL),
(9, '', 'Agent Lanmadaw 2', '0910000004', 'lanmadaw2@example.com', 1, 1, 2, NULL, 'Lanmadaw Address 2', 'hashed_password', NULL, NULL, NULL, 2, 3, '2025-08-05 12:09:49', 0, NULL),
(10, '', 'Agent Chanayethazan 1', '0910000005', 'chanayethazan1@example.com', 1, 2, 3, NULL, 'Chanayethazan Address 1', 'hashed_password', NULL, NULL, NULL, 2, 3, '2025-08-05 12:09:49', 0, NULL),
(11, '', 'Agent Chanayethazan 2', '0910000006', 'chanayethazan2@example.com', 1, 2, 3, NULL, 'Chanayethazan Address 2', 'hashed_password', NULL, NULL, NULL, 2, 3, '2025-08-05 12:09:49', 0, NULL),
(12, '', 'Agent South Okkalapa 1', '0910000007', 'southokkalapa1@example.com', 1, 1, 5, NULL, 'South Okkalapa Address 1', 'hashed_password', NULL, NULL, NULL, 2, 3, '2025-08-05 12:09:49', 0, NULL),
(13, '', 'Agent South Okkalapa 2', '0910000008', 'southokkalapa2@example.com', 1, 1, 5, NULL, 'South Okkalapa Address 2', 'hashed_password', NULL, NULL, NULL, 2, 3, '2025-08-05 12:09:49', 0, NULL),
(14, '', 'Agent North Okkalapa 1', '0910000009', 'northokkalapa1@example.com', 1, 1, 6, NULL, 'North Okkalapa Address 1', 'hashed_password', NULL, NULL, NULL, 2, 3, '2025-08-05 12:09:49', 0, NULL),
(15, '', 'Agent North Okkalapa 2', '0910000010', 'northokkalapa2@example.com', 1, 1, 6, NULL, 'North Okkalapa Address 2', 'hashed_password', NULL, NULL, NULL, 2, 3, '2025-08-05 12:09:49', 0, NULL),
(16, '', 'Agent Kyauktan 1', '0910000011', 'kyauktan1@example.com', 1, 2, 8, NULL, 'Kyauktan Address 1', 'hashed_password', NULL, NULL, NULL, 2, 3, '2025-08-05 12:09:49', 0, NULL),
(17, '', 'Agent Kyauktan 2', '0910000012', 'kyauktan2@example.com', 1, 2, 8, NULL, 'Kyauktan Address 2', 'hashed_password', NULL, NULL, NULL, 2, 3, '2025-08-05 12:09:49', 0, NULL),
(18, '', 'Agent Thanlyin 1', '0910000013', 'thanlyin1@example.com', 1, 4, 11, NULL, 'Thanlyin Address 1', 'hashed_password', NULL, NULL, NULL, 2, 3, '2025-08-05 12:09:49', 0, NULL),
(19, '', 'Agent Thanlyin 2', '0910000014', 'thanlyin2@example.com', 1, 4, 11, NULL, 'Thanlyin Address 2', 'hashed_password', NULL, NULL, NULL, 2, 3, '2025-08-05 12:09:49', 0, NULL),
(20, '', 'Agent Insein Township 1', '0910000015', 'inseintownship1@example.com', 1, 7, 13, NULL, 'Insein Township Address 1', 'hashed_password', NULL, NULL, NULL, 2, 3, '2025-08-05 12:09:49', 0, NULL),
(21, '', 'Agent Insein Township 2', '0910000016', 'inseintownship2@example.com', 1, 7, 13, NULL, 'Insein Township Address 2', 'hashed_password', NULL, NULL, NULL, 2, 3, '2025-08-05 12:09:49', 0, NULL),
(22, '', 'Agent Thaketa 1', '0910000017', 'thaketa1@example.com', 1, 6, 15, NULL, 'Thaketa Address 1', 'hashed_password', NULL, NULL, NULL, 2, 3, '2025-08-05 12:09:49', 0, NULL),
(23, '', 'Agent Thaketa 2', '0910000018', 'thaketa2@example.com', 1, 6, 15, NULL, 'Thaketa Address 2', 'hashed_password', NULL, NULL, NULL, 2, 3, '2025-08-05 12:09:49', 0, NULL),
(24, '', 'Agent Pyin Oo Lwin 1', '0910000019', 'pyinoowlwin1@example.com', 1, 8, 17, NULL, 'Pyin Oo Lwin Address 1', 'hashed_password', NULL, NULL, NULL, 2, 3, '2025-08-05 12:09:49', 0, NULL),
(25, '', 'Agent Pyin Oo Lwin 2', '0910000020', 'pyinoowlwin2@example.com', 1, 8, 17, NULL, 'Pyin Oo Lwin Address 2', 'hashed_password', NULL, NULL, NULL, 2, 3, '2025-08-05 12:09:49', 0, NULL),
(26, '', 'Agent Myingyan 1', '0910000021', 'myingyan1@example.com', 1, 9, 19, NULL, 'Myingyan Address 1', 'hashed_password', NULL, NULL, NULL, 2, 3, '2025-08-05 12:09:49', 0, NULL),
(27, '', 'Agent Myingyan 2', '0910000022', 'myingyan2@example.com', 1, 9, 19, NULL, 'Myingyan Address 2', 'hashed_password', NULL, NULL, NULL, 2, 3, '2025-08-05 12:09:49', 0, NULL),
(28, '', 'Agent Amarapura 1', '0910000023', 'amarapura1@example.com', 1, 10, 21, NULL, 'Amarapura Address 1', 'hashed_password', NULL, NULL, NULL, 2, 3, '2025-08-05 12:09:49', 0, NULL),
(29, '', 'Agent Amarapura 2', '0910000024', 'amarapura2@example.com', 1, 10, 21, NULL, 'Amarapura Address 2', 'hashed_password', NULL, NULL, NULL, 2, 3, '2025-08-05 12:09:49', 0, NULL),
(30, '', 'Agent Meiktila 1', '0910000025', 'meiktila1@example.com', 1, 11, 23, NULL, 'Meiktila Address 1', 'hashed_password', NULL, NULL, NULL, 2, 3, '2025-08-05 12:09:49', 0, NULL),
(31, '', 'Agent Meiktila 2', '0910000026', 'meiktila2@example.com', 1, 11, 23, NULL, 'Meiktila Address 2', 'hashed_password', NULL, NULL, NULL, 2, 3, '2025-08-05 12:09:49', 0, NULL),
(32, '', 'Agent Hmawbi 1', '0910000027', 'hmawbi1@example.com', 1, 5, 25, NULL, 'Hmawbi Address 1', 'hashed_password', NULL, NULL, NULL, 2, 3, '2025-08-05 12:09:49', 0, NULL),
(33, '', 'Agent Hmawbi 2', '0910000028', 'hmawbi2@example.com', 1, 5, 25, NULL, 'Hmawbi Address 2', 'hashed_password', NULL, NULL, NULL, 2, 3, '2025-08-05 12:09:49', 0, NULL),
(80, NULL, 'mi', '09348`348', 'mimimi1mi@gmail.com', 2, 2, 3, NULL, 'sfdfs', NULL, NULL, NULL, NULL, 3, NULL, '2025-08-05 16:57:24', 0, NULL),
(81, NULL, 'htet', '09883774', 'nyimin@gmail.com', 1, 1, 1, NULL, 'sdsdf', NULL, NULL, NULL, NULL, 3, NULL, '2025-08-05 16:57:24', 0, NULL),
(82, NULL, 'mi', '09348`348', 'mimimi1mi@gmail.com', 2, 2, 3, NULL, 'sfdfs', NULL, NULL, NULL, NULL, 3, NULL, '2025-08-05 16:59:44', 0, NULL),
(83, NULL, 'htet', '09883774', 'nyimin@gmail.com', 1, 1, 1, NULL, 'sdsdf', NULL, NULL, NULL, NULL, 3, NULL, '2025-08-05 16:59:44', 0, NULL),
(84, NULL, 'mi', '09348`348', 'mint206202@gmail.com', 1, 1, 1, NULL, 'mm', NULL, NULL, NULL, NULL, 3, NULL, '2025-08-05 19:19:01', 0, NULL),
(85, NULL, 'htet', '034890000', 'mint35768@gmail.com', 2, 2, 3, NULL, ' mmm', NULL, NULL, NULL, NULL, 3, NULL, '2025-08-05 19:19:01', 0, NULL),
(86, NULL, 'mi', '09348`348', 'mimimmi@gmail.com', 1, 1, 1, NULL, 'mm', NULL, NULL, NULL, NULL, 3, NULL, '2025-08-05 19:19:38', 0, NULL),
(87, NULL, 'htet', '034890000', 'htdfafsadfet@gmail.com', 2, 2, 3, NULL, ' mmm', NULL, NULL, NULL, NULL, 3, NULL, '2025-08-05 19:19:38', 0, NULL),
(88, NULL, 'nyi', '09348`348', 'mimimmi@gmail.com', 1, 1, 1, NULL, 'dssdfds', NULL, NULL, NULL, NULL, 3, NULL, '2025-08-06 18:41:57', 0, NULL),
(89, NULL, 'Htet ', '03', 'htethdf44me@gmail.com', 2, 2, 3, NULL, 'sdfsd', NULL, NULL, NULL, NULL, 3, NULL, '2025-08-06 18:41:57', 0, NULL),
(90, NULL, 'nyi', '09348`348', 'mimimmi@gmail.com', 1, 1, 1, NULL, 'dssdfds', NULL, NULL, NULL, NULL, 3, NULL, '2025-08-06 18:42:21', 0, NULL),
(91, NULL, 'Htet ', '03', 'htethdf44me@gmail.com', 2, 2, 3, NULL, 'sdfsd', NULL, NULL, NULL, NULL, 3, NULL, '2025-08-06 18:42:21', 0, NULL),
(92, NULL, 'nyi', '09348`348', 'mimimmi@gmail.com', 1, 1, 1, NULL, 'dssdfds', NULL, NULL, NULL, NULL, 3, NULL, '2025-08-06 18:48:35', 0, NULL),
(93, NULL, 'Htet ', '03', 'htethdf44me@gmail.com', 2, 2, 3, NULL, 'sdfsd', NULL, NULL, NULL, NULL, 3, NULL, '2025-08-06 18:48:35', 0, NULL),
(94, NULL, 'nyi', '09348`348', 'mimimmi@gmail.com', 1, 1, 1, NULL, 'dssdfds', NULL, NULL, NULL, NULL, 3, NULL, '2025-08-06 18:50:30', 0, NULL),
(95, NULL, 'Htet ', '03', 'htethdf44me@gmail.com', 2, 2, 3, NULL, 'sdfsd', NULL, NULL, NULL, NULL, 3, NULL, '2025-08-06 18:50:30', 0, NULL),
(96, NULL, 'nyi', '09348`348', 'mimimmi@gmail.com', 1, 1, 1, NULL, 'dssdfds', NULL, NULL, NULL, NULL, 3, NULL, '2025-08-06 18:56:35', 0, NULL),
(97, NULL, 'Htet ', '03', 'htethdf44me@gmail.com', 2, 2, 3, NULL, 'sdfsd', NULL, NULL, NULL, NULL, 3, NULL, '2025-08-06 18:56:35', 0, NULL);

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
(13, 5, 'Ward 1'),
(14, 5, 'Ward 2'),
(15, 6, 'Ward 3'),
(16, 6, 'Ward 4'),
(19, 8, 'Ward 3'),
(20, 8, 'Ward 4'),
(25, 11, 'Ward 1'),
(26, 11, 'Ward 2'),
(29, 13, 'Ward 1'),
(30, 13, 'Ward 2'),
(33, 15, 'Ward 1'),
(34, 15, 'Ward 2'),
(37, 17, 'Ward 1'),
(38, 17, 'Ward 2'),
(41, 19, 'Ward 1'),
(42, 19, 'Ward 2'),
(45, 21, 'Ward 1'),
(46, 21, 'Ward 2'),
(49, 23, 'Ward 1'),
(50, 23, 'Ward 2'),
(53, 25, 'Ward 1'),
(54, 25, 'Ward 2');

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

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `user_full_info`  AS SELECT `u`.`id` AS `id`, `u`.`access_code` AS `access_code`, `u`.`name` AS `name`, `u`.`phone` AS `phone`, `u`.`email` AS `email`, `r`.`name` AS `region_name`, `c`.`name` AS `city_name`, `t`.`name` AS `township_name`, `w`.`name` AS `ward_name`, `u`.`address` AS `address`, `u`.`password` AS `password`, `u`.`otp_code` AS `otp_code`, `u`.`otp_expiry` AS `otp_expiry`, `u`.`security_code` AS `security_code`, `ro`.`name` AS `role_name`, `s`.`name` AS `status_name`, `ut`.`type_name` AS `user_type_name`, `u`.`created_at` AS `created_at` FROM (((((((`users` `u` left join `regions` `r` on(`u`.`region_id` = `r`.`id`)) left join `cities` `c` on(`u`.`city_id` = `c`.`id`)) left join `townships` `t` on(`u`.`township_id` = `t`.`id`)) left join `wards` `w` on(`u`.`ward_id` = `w`.`id`)) left join `roles` `ro` on(`u`.`role_id` = `ro`.`id`)) left join `statuses` `s` on(`u`.`status_id` = `s`.`id`)) left join `user_type` `ut` on(`u`.`user_type_id` = `ut`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `view_agent_messages`
--
DROP TABLE IF EXISTS `view_agent_messages`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_agent_messages`  AS SELECT `am`.`id` AS `id`, `am`.`from_agent_id` AS `from_agent_id`, `fu`.`name` AS `from_agent_name`, `am`.`to_agent_id` AS `to_agent_id`, `tu`.`name` AS `to_agent_name`, `nt`.`type_name` AS `notification_type`, `am`.`title` AS `title`, `am`.`message` AS `message`, `am`.`created_at` AS `created_at` FROM (((`agent_notifications` `am` join `users` `fu` on(`am`.`from_agent_id` = `fu`.`id`)) join `users` `tu` on(`am`.`to_agent_id` = `tu`.`id`)) join `notification_types` `nt` on(`am`.`type_id` = `nt`.`id`)) ;

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

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_deliveries_detailed`  AS SELECT `d`.`id` AS `id`, `d`.`tracking_code` AS `tracking_code`, `d`.`product_type` AS `product_type`, `d`.`weight` AS `weight`, `d`.`amount` AS `amount`, `d`.`duration` AS `duration`, `d`.`created_at` AS `created_at`, `d`.`updated_at` AS `updated_at`, `d`.`sender_agent_id` AS `sender_agent_id`, `sa`.`name` AS `sender_agent_name`, `sa`.`email` AS `sender_agent_email`, `sa`.`phone` AS `sender_agent_phone`, `sa`.`address` AS `sender_agent_address`, `d`.`receiver_agent_id` AS `receiver_agent_id`, `ra`.`name` AS `receiver_agent_name`, `ra`.`email` AS `receiver_agent_email`, `ra`.`phone` AS `receiver_agent_phone`, `ra`.`address` AS `receiver_agent_address`, `d`.`sender_customer_id` AS `sender_customer_id`, `sc`.`name` AS `sender_customer_name`, `sc`.`email` AS `sender_customer_email`, `sc`.`phone` AS `sender_customer_phone`, `sc`.`address` AS `sender_customer_address`, `d`.`receiver_customer_id` AS `receiver_customer_id`, `rc`.`name` AS `receiver_customer_name`, `rc`.`email` AS `receiver_customer_email`, `rc`.`phone` AS `receiver_customer_phone`, `rc`.`address` AS `receiver_customer_address`, `d`.`from_township_id` AS `from_township_id`, `ft`.`name` AS `from_township_name`, `d`.`to_township_id` AS `to_township_id`, `tt`.`name` AS `to_township_name`, `d`.`from_city_id` AS `from_city_id`, `fc`.`name` AS `from_city_name`, `d`.`to_city_id` AS `to_city_id`, `tc`.`name` AS `to_city_name`, `d`.`from_region_id` AS `from_region_id`, `fr`.`name` AS `from_region_name`, `d`.`to_region_id` AS `to_region_id`, `tr`.`name` AS `to_region_name`, `d`.`delivery_status_id` AS `delivery_status_id`, `ds`.`name` AS `delivery_status`, `d`.`payment_status_id` AS `payment_status_id`, `ps`.`name` AS `payment_status`, `d`.`delivery_type_id` AS `delivery_type_id`, `dt`.`type_name` AS `delivery_type_name`, `d`.`piece_count` AS `piece_count` FROM (((((((((((((`deliveries` `d` left join `users` `sa` on(`d`.`sender_agent_id` = `sa`.`id`)) left join `users` `ra` on(`d`.`receiver_agent_id` = `ra`.`id`)) left join `users` `sc` on(`d`.`sender_customer_id` = `sc`.`id`)) left join `users` `rc` on(`d`.`receiver_customer_id` = `rc`.`id`)) left join `townships` `ft` on(`d`.`from_township_id` = `ft`.`id`)) left join `townships` `tt` on(`d`.`to_township_id` = `tt`.`id`)) left join `cities` `fc` on(`d`.`from_city_id` = `fc`.`id`)) left join `cities` `tc` on(`d`.`to_city_id` = `tc`.`id`)) left join `regions` `fr` on(`d`.`from_region_id` = `fr`.`id`)) left join `regions` `tr` on(`d`.`to_region_id` = `tr`.`id`)) left join `delivery_statuses` `ds` on(`d`.`delivery_status_id` = `ds`.`id`)) left join `payment_statuses` `ps` on(`d`.`payment_status_id` = `ps`.`id`)) left join `delivery_type` `dt` on(`d`.`delivery_type_id` = `dt`.`id`)) ;

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
  ADD KEY `fk_delivery_type` (`delivery_type_id`);

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
-- Indexes for table `payment_statuses`
--
ALTER TABLE `payment_statuses`
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
  ADD KEY `fk_user_type` (`user_type_id`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=995;

--
-- AUTO_INCREMENT for table `available_location`
--
ALTER TABLE `available_location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `deliveries`
--
ALTER TABLE `deliveries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `delivery_statuses`
--
ALTER TABLE `delivery_statuses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `delivery_status_history`
--
ALTER TABLE `delivery_status_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payment_statuses`
--
ALTER TABLE `payment_statuses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `route`
--
ALTER TABLE `route`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=210;

--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `townships`
--
ALTER TABLE `townships`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  ADD CONSTRAINT `fk_to_city` FOREIGN KEY (`to_city_id`) REFERENCES `cities` (`id`),
  ADD CONSTRAINT `fk_to_region` FOREIGN KEY (`to_region_id`) REFERENCES `regions` (`id`);

--
-- Constraints for table `delivery_status_history`
--
ALTER TABLE `delivery_status_history`
  ADD CONSTRAINT `delivery_status_history_ibfk_1` FOREIGN KEY (`delivery_id`) REFERENCES `deliveries` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `delivery_status_history_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `delivery_statuses` (`id`);

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
  ADD CONSTRAINT `fk_user_type` FOREIGN KEY (`user_type_id`) REFERENCES `user_type` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`),
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`),
  ADD CONSTRAINT `users_ibfk_3` FOREIGN KEY (`township_id`) REFERENCES `townships` (`id`),
  ADD CONSTRAINT `users_ibfk_4` FOREIGN KEY (`ward_id`) REFERENCES `wards` (`id`),
  ADD CONSTRAINT `users_ibfk_5` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `users_ibfk_6` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`);

--
-- Constraints for table `wards`
--
ALTER TABLE `wards`
  ADD CONSTRAINT `wards_ibfk_1` FOREIGN KEY (`township_id`) REFERENCES `townships` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
