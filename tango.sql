-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 12, 2020 at 04:13 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tango`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact_info`
--

CREATE TABLE `contact_info` (
  `id` int(11) NOT NULL,
  `phone` varchar(25) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact_info`
--

INSERT INTO `contact_info` (`id`, `phone`, `email`, `address`) VALUES
(5, '11111111111111', 'tango@mail.com', 'Dahab - South Sinai, Egypt');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `invoice_id` int(11) NOT NULL,
  `reservation_id` int(11) NOT NULL,
  `total_amount` int(11) NOT NULL,
  `amount_paid` float DEFAULT 0,
  `amount_paid_egp` int(11) DEFAULT 0,
  `amount_due` int(11) NOT NULL DEFAULT 0,
  `payment_method` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `invoiced` datetime NOT NULL DEFAULT current_timestamp(),
  `last_updated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`invoice_id`, `reservation_id`, `total_amount`, `amount_paid`, `amount_paid_egp`, `amount_due`, `payment_method`, `invoiced`, `last_updated`) VALUES
(1005, 1005, 400, 85, 400, 0, 'pp', '2019-03-26 00:13:03', '2019-04-02 09:27:01'),
(1009, 1009, 280, 0, 0, 280, NULL, '2019-03-29 10:31:29', '2019-03-29 10:31:29'),
(1011, 1011, 280, 0, 0, 280, NULL, '2019-03-29 10:36:02', '2019-03-29 10:36:02'),
(1012, 1012, 200, 14, 100, 100, 'Cash', '2019-04-01 16:35:59', '2019-04-02 11:10:53'),
(1013, 1013, 420, 0, 0, 420, NULL, '2019-04-02 16:04:27', '2019-04-02 16:04:27'),
(1014, 1014, 420, 0, 0, 420, NULL, '2019-04-05 20:57:25', '2019-04-05 20:57:25'),
(1015, 1015, 150, 0, 100, 50, NULL, '2019-04-05 21:12:28', '2019-04-09 03:35:03'),
(1016, 1016, 280, 0, 0, 280, NULL, '2019-04-25 07:02:55', '2019-04-25 07:02:55'),
(1017, 1017, 100, 0, 0, 100, NULL, '2019-09-19 18:39:55', '2019-09-19 18:39:55');

-- --------------------------------------------------------

--
-- Table structure for table `manage_website`
--

CREATE TABLE `manage_website` (
  `setting` text NOT NULL,
  `content` varchar(10000) NOT NULL,
  `image` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `manage_website`
--

INSERT INTO `manage_website` (`setting`, `content`, `image`) VALUES
('aboutus', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec malesuada lorem maximus mauris sceleri sque, at rutrum nulla dictum. Ut ac ligula sapien. Suspendisse cursus faucibus finibus.', '2.jpg'),
('home-aboutus2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec malesuada lorem maximus mauris sceleri sque, at rutrum nulla dictum. Ut ac ligula sapien. Suspendisse cursus faucibus finibus.', 'bg-2.jpg'),
('home-aboutus3', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec malesuada lorem maximus mauris sceleri sque, at rutrum nulla dictum. Ut ac ligula sapien. Suspendisse cursus faucibus finibus.', 'bg-3.jpg'),
('home-aboutus1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec malesuada lorem maximus mauris sceleri sque, at rutrum nulla dictum. Ut ac ligula sapien. Suspendisse cursus faucibus finibus.', '2.jpg'),
('termsconditions', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec malesuada lorem maximus mauris sceleri sque, at rutrum nulla dictum. Ut ac ligula sapien. Suspendisse cursus faucibus finibus.\r\n\r\n', '2.jpg'),
('paying-option', '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `message_id` int(11) NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `last_updated` datetime DEFAULT current_timestamp(),
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`message_id`, `name`, `email`, `subject`, `message`, `date`, `last_updated`, `status`) VALUES
(4, 'Shrief Mohamed', 'shriefmohamed@live.com', 'subject', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec malesuada lorem maximus mauris sceleri sque, at rutrum nulla dictum. Ut ac ligula sapien. Suspendisse cursus faucibus finibus.\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Donec malesuada lorem maximus mauris sceleri sque, at rutrum nulla dictum. Ut ac ligula sapien. Suspendisse cursus faucibus finibus.\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Donec malesuada lorem maximus mauris sceleri sque, at rutrum nulla dictum. Ut ac ligula sapien. Suspendisse cursus faucibus finibus.', '2019-03-30 09:04:01', '2019-04-05 07:05:00', '0');

-- --------------------------------------------------------

--
-- Table structure for table `message_replies`
--

CREATE TABLE `message_replies` (
  `reply_id` int(11) NOT NULL,
  `message_id` int(11) NOT NULL DEFAULT 0,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `sender` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `message_replies`
--

INSERT INTO `message_replies` (`reply_id`, `message_id`, `name`, `email`, `message`, `date`, `sender`) VALUES
(14, 4, 'Shrief Mohamed', 'shriefmohamed@live.com', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec malesuada lorem maximus mauris sceleri sque, at rutrum nulla dictum. Ut ac ligula sapien. Suspendisse cursus faucibus finibus.', '2019-03-30 09:05:40', 'admin'),
(15, 4, 'Shrief Mohamed', 'shriefmohamed@live.com', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.', '2019-03-30 15:11:52', 'customer'),
(16, 4, 'Shrief Mohamed', 'shriefmohamed@live.com', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.', '2019-03-31 09:42:28', 'customer'),
(17, 4, 'Shrief Mohamed', 'shriefmohamed@live.com', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.', '2019-03-31 09:47:42', 'customer'),
(18, 4, 'Shrief Mohamed', 'shriefmohamed@live.com', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.', '2019-04-02 17:01:57', 'admin'),
(19, 4, 'Shrief Mohamed', 'shriefmohamed@live.com', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec malesuada lorem maximus mauris sceleri sque, at rutrum nulla dictum. Ut ac ligula sapien. Suspendisse cursus faucibus finibus.', '2019-04-05 21:05:00', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `post_id` int(11) NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `place` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `views` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`post_id`, `title`, `description`, `place`, `date`, `image`, `views`) VALUES
(1, 'The program for the Summer of 2019', 'Donec malesuada lorem maximus mauris sceleri sque, at rutrum nulla dictum. Ut ac ligula sapien. Suspendisse cursus faucibus finibus. Integer tempus ligula sem, id feugiat quam egestas et. Donec porttitor varius diam in vulputate. Fusce blandit consequat elit non egestas. Donec tortor odio, consectetur eu justo ut, auctor.\r\nDonec malesuada lorem maximus mauris sceleri sque, at rutrum nulla dictum. Ut ac ligula sapien. Suspendisse cursus faucibus finibus. Integer tempus ligula sem, id feugiat quam egestas et. Donec porttitor varius diam in vulputate. Fusce blandit consequat elit non egestas. Donec tortor odio, consectetur eu justo ut, auctor.', 'In Camp', 'June 25, 2018', '1.jpg', 6),
(2, '3 Tip for the perfect vacation', 'Donec malesuada lorem maximus mauris sceleri sque, at rutrum nulla dictum. Ut ac ligula sapien. Suspendisse cursus faucibus finibus. Integer tempus ligula sem, id feugiat quam egestas et. Donec porttitor varius diam in vulputate. Fusce blandit consequat elit non egestas. Donec tortor odio, consectetur eu justo ut, auctor.\r\nDonec malesuada lorem maximus mauris sceleri sque, at rutrum nulla dictum. Ut ac ligula sapien. Suspendisse cursus faucibus finibus. Integer tempus ligula sem, id feugiat quam egestas et. Donec porttitor varius diam in vulputate. Fusce blandit consequat elit non egestas. Donec tortor odio, consectetur eu justo ut, auctor.', 'In Camp', 'June 25, 2019', '3.jpg', 1),
(4, 'New Post', 'Donec malesuada lorem maximus mauris sceleri sque, at rutrum nulla dictum. Ut ac ligula sapien. Suspendisse cursus faucibus finibus. Integer tempus ligula sem, id feugiat quam egestas et. Donec porttitor varius diam in vulputate. Fusce blandit consequat elit non egestas. Donec tortor odio, consectetur eu justo ut, auct Donec malesuada lorem maximus mauris sceleri sque, at rutrum nulla dictum. Ut ac ligula sapien. Suspendisse cursus faucibus finibus. Integer tempus ligula sem, id feugiat quam egestas et. Donec porttitor varius diam in vulputate. Fusce blandit consequat elit non egestas. Donec tortor odio, consectetur eu justo ut, auct ', 'In Camp', '2019-03-07', '16359348-2.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `privileges`
--

CREATE TABLE `privileges` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rooms_management` int(1) DEFAULT NULL,
  `users_management` int(1) DEFAULT NULL,
  `messages_management` int(1) DEFAULT NULL,
  `news_management` int(1) DEFAULT NULL,
  `testimonials_management` int(1) DEFAULT NULL,
  `website_settings_management` int(1) DEFAULT NULL,
  `view_reservations` int(1) DEFAULT NULL,
  `add_reservations` int(1) DEFAULT NULL,
  `update_reservations` int(1) DEFAULT NULL,
  `logs` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `privileges`
--

INSERT INTO `privileges` (`id`, `user_id`, `rooms_management`, `users_management`, `messages_management`, `news_management`, `testimonials_management`, `website_settings_management`, `view_reservations`, `add_reservations`, `update_reservations`, `logs`) VALUES
(1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(2, 12, 1, 1, 1, 1, 1, 1, 1, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `check_in` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `check_out` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `period` int(11) NOT NULL,
  `guests` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `room_price` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reservation_date` datetime NOT NULL DEFAULT current_timestamp(),
  `reservation_status` enum('confirmed','unconfirmed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unconfirmed',
  `payment_status` enum('paid','unpaid') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unpaid'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `check_in`, `check_out`, `period`, `guests`, `room_id`, `room_price`, `total`, `email`, `note`, `reservation_date`, `reservation_status`, `payment_status`) VALUES
(1005, '2019-03-27', '2019-03-29', 2, 1, 6, 200, 400, 'shriefmohamed@live.com', NULL, '2019-03-26 00:13:03', 'confirmed', 'paid'),
(1009, '2019-03-29', '2019-03-31', 2, 1, 4, 140, 280, 'shriefmohamed87@yahoo.com', NULL, '2019-03-29 10:31:29', 'confirmed', 'unpaid'),
(1011, '2019-03-29', '2019-03-31', 2, 3, 4, 140, 280, 'shriefmohamed87@yahoo.com', 'note', '2019-03-29 10:36:02', 'confirmed', 'unpaid'),
(1012, '2019-04-01', '2019-04-03', 2, 1, 2, 100, 200, 'shriefmohamed87@yahoo.com', NULL, '2019-04-01 16:35:59', 'confirmed', 'paid'),
(1013, '2019-04-02', '2019-04-05', 3, 2, 4, 140, 420, 'shriefmohamed@live.com', NULL, '2019-04-02 16:04:27', 'unconfirmed', 'unpaid'),
(1014, '2019-04-05', '2019-04-08', 3, 1, 4, 140, 420, 'shriefmohamed@live.com', NULL, '2019-04-05 20:57:25', 'unconfirmed', 'unpaid'),
(1015, '2019-04-05', '2019-04-06', 1, 1, 2, 100, 150, 'shriefmohamed@live.com', NULL, '2019-04-05 21:12:28', 'unconfirmed', 'paid'),
(1016, '2019-04-25', '2019-04-27', 2, 1, 4, 140, 280, 'shriefmohamed@live.com', NULL, '2019-04-25 07:02:55', 'unconfirmed', 'unpaid'),
(1017, '2019-09-19', '2019-09-20', 1, 1, 2, 100, 100, 'shriefmohamed@live.com', NULL, '2019-09-19 18:39:55', 'confirmed', 'unpaid');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `room_id` int(11) NOT NULL,
  `room_number` int(11) NOT NULL,
  `room_type` enum('single','double','suite') COLLATE utf8mb4_unicode_ci NOT NULL,
  `beds` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('inactive','active') COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`room_id`, `room_number`, `room_type`, `beds`, `price`, `description`, `image`, `status`) VALUES
(2, 14, 'single', 2, 100, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec malesuada lorem maximus mauris sceleri sque.', '6813254-2.jpg', 'active'),
(4, 11, 'single', 2, 140, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec malesuada lorem maximus mauris sceleri sque.', '39086898-7.jpg', 'active'),
(6, 16, 'double', 3, 200, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec malesuada lorem maximus mauris sceleri sque.', '27956318-3.jpg', 'active'),
(7, 400, 'single', 1, 170, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec malesuada lorem maximus mauris sceleri sque, at rutrum nulla dictum. Ut ac ligula sapien. Suspendisse cursus faucibus finibus.', '78366195-11.jpg', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `sent_messages`
--

CREATE TABLE `sent_messages` (
  `message_id` int(11) NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sent_messages`
--

INSERT INTO `sent_messages` (`message_id`, `email`, `subject`, `message`, `date`) VALUES
(1, 'shriefmohamed@live.com', 'Some Subject', '$_SESSION[&#039;adminMessages&#039;] = array(&#039;error&#039;, &quot;Mailer Error: &quot; . $mail-&gt;ErrorInfo);\r\n                header(&quot;location: &quot; . HOST_NAME . &#039;admin/sentmessages&#039;);', '2019-03-13 16:10:36'),
(2, 'shriefmohamed@live.com', 'Some Subject', 'sssssssssssss', '2019-03-13 16:11:11');

-- --------------------------------------------------------

--
-- Table structure for table `subscribtion`
--

CREATE TABLE `subscribtion` (
  `id` int(11) NOT NULL,
  `email` varchar(250) NOT NULL,
  `date_subscribe` datetime NOT NULL DEFAULT current_timestamp(),
  `date_unsubscribe` varchar(50) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscribtion`
--

INSERT INTO `subscribtion` (`id`, `email`, `date_subscribe`, `date_unsubscribe`, `status`) VALUES
(14, 'shriefmohamed@live.com', '2019-02-24 20:17:17', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `review` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `name`, `position`, `review`, `image`) VALUES
(2, 'Michael Smith', 'Client', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec malesuada lorem maximus mauris sceleri sque, at rutrum nulla dictum. Ut ac ligula sapien. Suspendisse cursus faucibus finibus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec malesuada lorem maximus mauris sceleri sque, at rutrum nulla dictum. Ut ac ligula sapien. Suspendisse cursus faucibus finibus.', ''),
(3, 'Nazrul Islam', 'Developer', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec malesuada lorem maximus mauris sceleri sque, at rutrum nulla dictum. Ut ac ligula sapien. Suspendisse cursus faucibus finibus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec malesuada lorem maximus mauris sceleri sque, at rutrum nulla dictum. Ut ac ligula sapien. Suspendisse cursus faucibus finibus.', ''),
(6, 'Shrief', 'Visitor', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec malesuada lorem maximus mauris sceler', '15694254-2017-06-08-1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `fullname` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` int(20) NOT NULL,
  `governorate` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `fullname`, `username`, `email`, `password`, `phone`, `governorate`, `role`, `created`) VALUES
(1, 'Shrief Mohamed', 'smohamed', 'shriefmohamed@live.com', 'ad1fdeb1416d222ea4eef582992340c9', 1210325979, 'Alexandria', 'admin', '2019-02-08 21:37:24'),
(12, 'Admin', 'admin', 'admin@mail.com', 'fe412a8d4e2a9bc035caa028c48cd341', 1210325979, 'Alexandria', 'admin', '2019-04-08 13:19:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact_info`
--
ALTER TABLE `contact_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`invoice_id`),
  ADD UNIQUE KEY `reservation_id` (`reservation_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `message_replies`
--
ALTER TABLE `message_replies`
  ADD PRIMARY KEY (`reply_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `privileges`
--
ALTER TABLE `privileges`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`room_id`),
  ADD UNIQUE KEY `room_number` (`room_number`);

--
-- Indexes for table `sent_messages`
--
ALTER TABLE `sent_messages`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `subscribtion`
--
ALTER TABLE `subscribtion`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact_info`
--
ALTER TABLE `contact_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1018;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `message_replies`
--
ALTER TABLE `message_replies`
  MODIFY `reply_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `privileges`
--
ALTER TABLE `privileges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1018;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sent_messages`
--
ALTER TABLE `sent_messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subscribtion`
--
ALTER TABLE `subscribtion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
