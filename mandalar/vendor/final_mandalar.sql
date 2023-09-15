-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 15, 2023 at 04:06 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mandalar`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `img`) VALUES
(1, 'Moblie', 'mobile.jpg\r\n'),
(2, 'Bike', 'bike.jpg'),
(4, 'Car', 'car.jpg\r\n'),
(5, 'Bicycle', 'bicycle.jpg\r\n'),
(7, 'Girl Fashion', 'girl.jpg'),
(8, 'Men Fashion', 'men.jpg'),
(9, 'Game ACcessories', 'game.jpg'),
(10, 'Computer & Digital', 'computer.jpg'),
(11, 'Sport', 'sports.jpg'),
(12, 'Electronic', 'electronic.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id`, `name`) VALUES
(1, 'Chanayethazan'),
(2, 'Maha Aung Myay'),
(3, 'Chanmyathazi'),
(4, 'Amarapura');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `parent_com_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `post_id`, `user_id`, `content`, `parent_com_id`, `date`) VALUES
(1, 57, 6, 'Hello', 0, '2023-08-08 06:11:38'),
(2, 57, 6, 'htoonaung Hi', 1, '2023-08-08 06:11:58'),
(3, 57, 6, 'htoonaung hi', 1, '2023-08-08 06:12:22'),
(4, 57, 6, 'htoonaung hello', 1, '2023-08-08 06:13:14'),
(5, 57, 6, 'htoonaung hello', 1, '2023-08-08 06:27:59'),
(6, 57, 6, 'Hello', 0, '2023-08-08 06:30:52'),
(7, 57, 6, 'Hello', 0, '2023-08-08 06:31:24'),
(8, 57, 6, 'Hello', 0, '2023-08-08 06:31:35'),
(9, 57, 6, 'htoonaung hello', 6, '2023-08-08 06:48:19'),
(10, 57, 6, 'htoonaung Hello', 8, '2023-08-08 06:48:34'),
(11, 57, 6, 'undefined hello', 2, '2023-08-08 07:27:15'),
(12, 57, 6, 'hello\n', 2, '2023-08-08 07:33:06'),
(13, 57, 6, '', 7, '2023-08-16 07:17:37'),
(14, 63, 7, 'hi\n', 0, '2023-08-19 02:19:46'),
(15, 63, 7, '', 14, '2023-08-19 02:20:09'),
(16, 63, 7, 'ThwinHtoo jaj', 15, '2023-08-19 02:20:19'),
(17, 63, 7, '', 16, '2023-08-19 02:20:34'),
(18, 63, 7, 'hello', 16, '2023-08-19 02:21:03'),
(19, 63, 7, 'fff', 0, '2023-08-19 02:25:22'),
(21, 69, 20, 'hello\n', 0, '2023-09-07 03:59:06'),
(22, 69, 20, 'hi', 0, '2023-09-07 03:58:50'),
(23, 70, 20, 'hi', 0, '2023-09-07 04:41:31'),
(24, 70, 20, 'hi', 0, '2023-09-07 04:44:04'),
(25, 5, 20, 'hello', 0, '2023-09-07 09:33:01'),
(26, 5, 20, 'is there', 25, '2023-09-07 09:33:53'),
(27, 1, 20, 'hi', 0, '2023-09-07 09:43:43'),
(28, 5, 20, 'hello\n', 0, '2023-09-10 06:28:09'),
(29, 5, 22, 'hello\n', 28, '2023-09-10 06:37:04'),
(30, 5, 22, 'hello', 29, '2023-09-10 06:38:29'),
(31, 5, 22, 'hello', 28, '2023-09-10 06:40:18'),
(32, 7, 22, 'hellp', 0, '2023-09-10 06:53:55'),
(33, 6, 22, 'Prices', 0, '2023-09-10 06:59:15'),
(34, 6, 22, 'Hello', 0, '2023-09-10 06:59:30'),
(35, 12, 23, 'Price!', 0, '2023-09-10 08:01:23'),
(36, 12, 23, 'hi', 35, '2023-09-10 08:01:42'),
(37, 12, 20, 'hello', 0, '2023-09-10 08:01:49'),
(38, 12, 23, 'hello', 0, '2023-09-10 08:01:59');

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `nrc` varchar(255) NOT NULL,
  `phone` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `city_id` int(11) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `nrc_front` varchar(255) NOT NULL,
  `nrc_back` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` (`id`, `name`, `nrc`, `phone`, `password`, `city_id`, `photo`, `nrc_front`, `nrc_back`, `date`) VALUES
(33, 'Nay Myo Thant', 'oasidjf', 91919191, '21b69ec29a9b1ed459b472fa034d3675', 1, '16939742191.png', '169397421901.05.2023_10.53.59_REC.png', '16939742191.png', '2023-09-06 04:23:39'),
(34, 'Thwin Htoo Naung', 'asdfa', 97858, 'f264190978eb7fb3d1ad52e7aa7850b5', 1, '16940802441.png', '16940802442.png', '16940802441.png', '2023-09-07 09:50:44'),
(35, 'Thwin Htoo Naung', 'n/adfaeqeaed', 996939393, 'f264190978eb7fb3d1ad52e7aa7850b5', 1, '1694333415thn.jpg', '1694333415front_nrc.jpg', '1694333415back_nrc.jpg', '2023-09-10 08:10:15');

-- --------------------------------------------------------

--
-- Table structure for table `favorite`
--

CREATE TABLE `favorite` (
  `id` int(11) NOT NULL,
  `user_id` int(255) NOT NULL,
  `post_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `favorite`
--

INSERT INTO `favorite` (`id`, `user_id`, `post_id`, `date`) VALUES
(17, 6, 47, '2023-07-29 10:32:57'),
(18, 6, 40, '2023-07-30 07:46:04'),
(19, 6, 39, '2023-07-30 07:46:10'),
(20, 6, 38, '2023-07-30 07:46:15'),
(21, 6, 37, '2023-07-30 07:46:20'),
(23, 6, 62, '2023-08-03 08:10:28'),
(24, 6, 61, '2023-08-16 06:54:45'),
(25, 17, 69, '2023-09-07 02:51:18'),
(26, 17, 70, '2023-09-07 02:51:30'),
(28, 17, 67, '2023-09-07 02:59:19'),
(30, 17, 68, '2023-09-07 03:02:31'),
(56, 20, 69, '2023-09-07 04:09:32'),
(58, 20, 66, '2023-09-07 04:37:43'),
(59, 20, 5, '2023-09-07 09:32:38'),
(60, 22, 5, '2023-09-10 06:36:50'),
(61, 22, 6, '2023-09-10 07:04:33'),
(62, 23, 13, '2023-09-10 07:59:39'),
(64, 23, 15, '2023-09-10 08:18:36');

-- --------------------------------------------------------

--
-- Table structure for table `follow`
--

CREATE TABLE `follow` (
  `id` int(11) NOT NULL,
  `from_id` int(255) NOT NULL,
  `to_id` int(255) NOT NULL,
  `follow` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_read` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `follow`
--

INSERT INTO `follow` (`id`, `from_id`, `to_id`, `follow`, `timestamp`, `is_read`) VALUES
(6, 21, 20, 1, '2023-09-08 07:24:11', 0),
(8, 20, 21, 1, '2023-09-08 07:26:22', 0),
(9, 22, 21, 1, '2023-09-10 06:42:13', 0),
(10, 23, 20, 1, '2023-09-10 08:17:17', 0);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL,
  `incoming_msg_id` int(255) NOT NULL,
  `outgoing_msg_id` int(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `msg` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`msg_id`, `incoming_msg_id`, `outgoing_msg_id`, `img`, `date`, `msg`) VALUES
(1, 1262294086, 719426914, '', '2023-07-15 13:14:52', 'hi'),
(2, 1262294086, 719426914, '', '2023-07-15 13:49:50', 'hi'),
(3, 1262294086, 719426914, '', '2023-07-15 14:35:58', 'hi'),
(4, 1262294086, 719426914, '1689432122onepiece.jpg', '2023-07-15 14:42:02', ''),
(5, 1262294086, 719426914, '1689433598one-piece-kaido-one-piece-monkey-d-luffy-hd-wallpaper-preview.jpg', '2023-07-15 15:06:38', ''),
(6, 719426914, 1262294086, '1689434071nissan-skyline-r34-4k-j6.jpg', '2023-07-15 15:14:31', ''),
(7, 719426914, 1262294086, '', '2023-07-15 15:16:20', 'hi'),
(8, 719426914, 1262294086, '', '2023-07-15 15:17:30', 'hi'),
(9, 719426914, 1262294086, '', '2023-07-15 15:18:39', 'hi'),
(10, 1262294086, 719426914, '', '2023-07-15 15:18:42', 'hi'),
(11, 719426914, 1262294086, '1689434328onepiece.jpg', '2023-07-15 15:18:48', ''),
(12, 1262294086, 719426914, '', '2023-07-15 15:18:54', 'hi'),
(13, 1262294086, 719426914, '1689434337nissan-skyline-r34-4k-j6.jpg', '2023-07-15 15:18:57', ''),
(14, 719426914, 1262294086, '1689478921one-piece-for-desktop-thousand-sunny-ship-ocean-clouds-artwork-wallpaper.jpg', '2023-07-16 03:42:01', ''),
(15, 719426914, 1262294086, '1689478931one-piece-kaido-one-piece-monkey-d-luffy-hd-wallpaper-preview.jpg', '2023-07-16 03:42:11', ''),
(16, 719426914, 1262294086, '', '2023-07-16 03:42:30', 'hidfdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd'),
(17, 719426914, 1262294086, '1689479764one-piece-for-desktop-thousand-sunny-ship-ocean-clouds-artwork-wallpaper.jpg', '2023-07-16 03:56:04', ''),
(18, 719426914, 1262294086, '1689479826one-piece-for-desktop-thousand-sunny-ship-ocean-clouds-artwork-wallpaper.jpg', '2023-07-16 03:57:06', ''),
(19, 719426914, 1262294086, '1689479832one-piece-kaido-one-piece-monkey-d-luffy-hd-wallpaper-preview.jpg', '2023-07-16 03:57:12', ''),
(20, 719426914, 1262294086, '1689479838nissan-skyline-r34-4k-j6.jpg', '2023-07-16 03:57:18', ''),
(21, 719426914, 1262294086, '', '2023-07-16 04:33:58', 'hi'),
(22, 719426914, 1262294086, '', '2023-07-16 04:34:02', 'hi'),
(23, 719426914, 1262294086, '', '2023-07-16 04:34:45', 'hi'),
(24, 719426914, 1262294086, '', '2023-07-16 04:35:09', 'hi'),
(25, 719426914, 1262294086, '', '2023-07-16 04:35:12', 'hello'),
(26, 719426914, 1262294086, '1689482117nissan-skyline-r34-4k-j6.jpg', '2023-07-16 04:35:17', ''),
(27, 719426914, 1262294086, '', '2023-07-16 04:36:13', 'hi'),
(28, 719426914, 1262294086, '1689482177one-piece-kaido-one-piece-monkey-d-luffy-hd-wallpaper-preview.jpg', '2023-07-16 04:36:17', ''),
(29, 719426914, 1262294086, '', '2023-07-16 04:37:23', 'hi'),
(30, 1262294086, 719426914, '1689482282onepiece.jpg', '2023-07-16 04:38:02', ''),
(31, 719426914, 1262294086, '1689482295onepiece.jpg', '2023-07-16 04:38:15', ''),
(32, 1262294086, 719426914, '', '2023-07-16 04:39:17', 'hi'),
(33, 1262294086, 719426914, '', '2023-07-16 04:39:26', 'hi'),
(34, 719426914, 1262294086, '', '2023-07-16 04:39:37', 'hi'),
(35, 1262294086, 719426914, '', '2023-07-16 04:45:50', 'hi'),
(36, 1262294086, 719426914, '', '2023-07-16 04:45:53', 'hi'),
(37, 1262294086, 719426914, '', '2023-07-16 04:46:11', 'hi'),
(38, 1262294086, 1359880073, '', '2023-07-16 04:46:54', 'hi'),
(39, 1262294086, 1359880073, '1689482824one-piece-for-desktop-thousand-sunny-ship-ocean-clouds-artwork-wallpaper.jpg', '2023-07-16 04:47:04', ''),
(40, 719426914, 1359880073, '', '2023-07-16 04:48:39', 'hi'),
(41, 719426914, 1359880073, '', '2023-07-16 04:48:44', 'hello'),
(42, 719426914, 1359880073, '1689482929one-piece-for-desktop-thousand-sunny-ship-ocean-clouds-artwork-wallpaper.jpg', '2023-07-16 04:48:49', ''),
(43, 719426914, 1262294086, '', '2023-07-16 04:49:45', 'hi'),
(44, 719426914, 1262294086, '1689482998onepiece.jpg', '2023-07-16 04:49:58', ''),
(45, 7, 6, '', '2023-07-17 07:33:40', 'hi'),
(46, 7, 6, '', '2023-07-17 07:33:42', 'hi'),
(47, 7, 6, '1689579849onepiece.jpg', '2023-07-17 07:44:09', ''),
(48, 7, 8, '1689580985onepiece.jpg', '2023-07-17 08:03:05', ''),
(49, 7, 8, '', '2023-07-17 08:03:08', 'hi'),
(50, 12, 8, '1690179674one-piece-for-desktop-thousand-sunny-ship-ocean-clouds-artwork-wallpaper.jpg', '2023-07-24 06:21:14', ''),
(51, 13, 8, '1690179703one-piece-kaido-one-piece-monkey-d-luffy-hd-wallpaper-preview.jpg', '2023-07-24 06:21:43', ''),
(52, 13, 8, '', '2023-07-24 06:23:41', 'hi'),
(53, 13, 8, '', '2023-07-24 06:23:42', 'hi'),
(54, 13, 8, '', '2023-07-24 06:23:42', 'hi'),
(55, 13, 8, '', '2023-07-24 06:23:42', 'hi'),
(56, 13, 8, '', '2023-07-24 06:23:42', 'hi'),
(57, 13, 8, '', '2023-07-24 06:23:43', 'hi'),
(58, 13, 8, '', '2023-07-24 06:23:43', 'hi'),
(59, 13, 8, '', '2023-07-24 06:23:43', 'hi'),
(60, 13, 8, '', '2023-07-24 06:23:44', 'hi'),
(61, 13, 8, '', '2023-07-24 06:23:44', 'hi'),
(62, 13, 8, '', '2023-07-24 06:23:44', 'hi'),
(63, 13, 8, '', '2023-07-24 06:23:44', 'hi'),
(64, 13, 8, '', '2023-07-24 06:23:45', 'hi'),
(65, 13, 8, '', '2023-07-24 06:23:45', 'hi'),
(66, 13, 8, '', '2023-07-24 06:23:45', 'hi'),
(67, 13, 8, '', '2023-07-24 06:23:45', 'hi'),
(68, 13, 8, '', '2023-07-24 06:23:45', 'hi'),
(69, 12, 8, '', '2023-07-24 06:23:53', 'hi'),
(70, 12, 8, '', '2023-07-24 06:23:56', 'hi'),
(71, 12, 8, '', '2023-07-24 06:23:56', 'hi'),
(72, 12, 8, '', '2023-07-24 06:23:57', 'hi'),
(73, 12, 8, '', '2023-07-24 06:23:57', 'hi'),
(74, 12, 8, '', '2023-07-24 06:23:58', 'hi'),
(75, 12, 8, '', '2023-07-24 06:23:58', 'hi'),
(76, 12, 8, '', '2023-07-24 06:23:58', 'hi'),
(77, 12, 8, '', '2023-07-24 06:23:58', 'hi'),
(78, 12, 8, '', '2023-07-24 06:23:58', 'hi'),
(79, 12, 8, '', '2023-07-24 06:23:58', 'hi'),
(80, 12, 8, '', '2023-07-24 06:23:59', 'hi'),
(81, 12, 8, '', '2023-07-24 06:23:59', 'hi'),
(82, 12, 8, '', '2023-07-24 06:23:59', 'hi'),
(83, 12, 8, '', '2023-07-24 06:23:59', 'hi'),
(84, 12, 8, '', '2023-07-24 06:24:00', 'hi'),
(85, 12, 8, '', '2023-07-24 06:24:12', 'hi'),
(86, 12, 8, '', '2023-07-24 06:24:25', 'hello'),
(87, 12, 8, '', '2023-07-24 06:25:01', 'hi'),
(88, 12, 8, '', '2023-07-24 06:25:07', 'hello'),
(89, 12, 8, '', '2023-07-24 06:25:18', 'hi'),
(90, 12, 8, '', '2023-07-24 06:25:26', 'hello'),
(91, 12, 8, '', '2023-07-24 06:25:27', 'hello'),
(92, 12, 8, '', '2023-07-24 06:25:29', 'hello'),
(93, 13, 8, '', '2023-07-24 06:53:19', 'hi'),
(94, 7, 8, '', '2023-07-24 06:54:14', 'hi'),
(95, 7, 8, '', '2023-07-24 06:55:43', 'hi'),
(96, 13, 8, '', '2023-07-24 07:03:48', 'hi'),
(97, 12, 8, '', '2023-07-24 07:03:54', 'hi'),
(98, 12, 8, '', '2023-07-24 07:15:57', 'hi'),
(99, 7, 8, '', '2023-07-24 07:16:20', 'hi'),
(100, 12, 8, '', '2023-07-24 08:00:57', 'hi'),
(101, 12, 8, '', '2023-07-26 02:45:15', 'hi'),
(102, 12, 8, '', '2023-07-26 02:45:17', 'hello'),
(103, 12, 8, '', '2023-07-26 02:45:20', 'way'),
(104, 12, 8, '', '2023-07-26 02:45:24', 'way'),
(105, 12, 8, '', '2023-07-26 02:46:00', 'hi'),
(106, 12, 15, '', '2023-08-03 07:00:46', 'hi'),
(107, 12, 15, '1691046054onepiece.jpg', '2023-08-03 07:00:54', ''),
(108, 20, 21, '', '2023-09-07 08:18:44', 'hi'),
(109, 20, 21, '169407518601.05.2023_10.53.59_REC.png', '2023-09-07 08:26:26', ''),
(110, 21, 20, '', '2023-09-07 09:37:03', 'hello'),
(111, 20, 21, '16940794361.png', '2023-09-07 09:37:16', ''),
(112, 21, 20, '', '2023-09-10 05:30:47', 'hi'),
(113, 21, 22, '', '2023-09-10 06:42:18', 'hi'),
(114, 21, 22, '', '2023-09-10 06:42:26', 'hello'),
(115, 21, 22, '1694328157onepiece.jpg', '2023-09-10 06:42:37', ''),
(116, 21, 22, '', '2023-09-10 06:43:30', 'hi'),
(117, 20, 22, '', '2023-09-10 07:42:33', 'hi'),
(118, 22, 20, '', '2023-09-10 07:42:43', 'hello'),
(119, 22, 20, '', '2023-09-10 07:44:46', 'hi'),
(120, 22, 20, '', '2023-09-10 07:46:39', 'hi'),
(121, 22, 20, '', '2023-09-10 07:47:15', 'hi'),
(122, 22, 20, '', '2023-09-10 07:47:19', ' ss'),
(123, 22, 20, '', '2023-09-10 07:47:29', ' ss'),
(124, 22, 20, '', '2023-09-10 07:47:33', ' '),
(125, 22, 20, '', '2023-09-10 07:47:38', ' '),
(126, 22, 20, '', '2023-09-10 07:47:51', ' '),
(127, 22, 20, '', '2023-09-10 07:47:55', 'hello'),
(128, 22, 20, '', '2023-09-10 07:48:23', 'asdasd'),
(129, 22, 20, '', '2023-09-10 07:48:37', 'hello'),
(130, 22, 20, '', '2023-09-10 07:48:54', 'hi'),
(131, 23, 20, '', '2023-09-10 08:16:14', 'hello kaung'),
(132, 20, 23, '', '2023-09-10 08:16:38', 'hello maung'),
(133, 20, 23, '1694333807bike_1.jpg', '2023-09-10 08:16:47', '');

-- --------------------------------------------------------

--
-- Table structure for table `money_check`
--

CREATE TABLE `money_check` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `check_wallet` varchar(255) NOT NULL,
  `kpay_phone` int(11) NOT NULL,
  `kpay_img` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` tinyint(1) NOT NULL,
  `kpay_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `money_check`
--

INSERT INTO `money_check` (`id`, `user_id`, `check_wallet`, `kpay_phone`, `kpay_img`, `date`, `status`, `kpay_name`) VALUES
(1, 21, '500000', 2147483647, '06.05.2023_09.34.51_REC.png', '2023-09-07 07:54:53', 1, 'U Nay Myo Thant'),
(2, 21, '100000000', 2147483647, '1.png', '2023-09-07 07:56:18', 1, 'Nay Myo Thant'),
(3, 20, '500000', 2147483647, '09.05.2023_07.17.15_REC.png', '2023-09-07 09:42:44', 1, 'U Nay Myo Thant'),
(7, 20, '500000', 2147483647, 'download (1).jpg', '2023-09-10 06:59:59', 1, 'U Nay Myo Thant'),
(8, 20, '500000', 2147483647, 'download (1).jpg', '2023-09-10 07:00:01', 1, 'U Nay Myo Thant'),
(9, 20, '500000', 2147483647, 'download (1).jpg', '2023-09-10 07:00:04', 1, 'U Nay Myo Thant'),
(10, 20, '500000', 2147483647, 'download (1).jpg', '2023-09-10 07:00:07', 1, 'U Nay Myo Thant'),
(11, 20, '500000', 2147483647, 'download (1).jpg', '2023-09-10 07:00:10', 1, 'U Nay Myo Thant'),
(12, 20, '500000', 2147483647, 'download (1).jpg', '2023-09-10 07:00:13', 1, 'U Nay Myo Thant'),
(13, 20, '500000', 2147483647, 'download (1).jpg', '2023-09-10 07:00:15', 1, 'U Nay Myo Thant'),
(14, 20, '500000', 2147483647, 'download (1).jpg', '2023-09-10 07:00:17', 1, 'U Nay Myo Thant'),
(15, 20, '500000', 2147483647, 'download (1).jpg', '2023-09-10 07:00:19', 1, 'U Nay Myo Thant'),
(16, 20, '500000', 2147483647, 'download (1).jpg', '2023-09-10 07:00:22', 1, 'U Nay Myo Thant'),
(17, 20, '500000', 2147483647, 'download (1).jpg', '2023-09-10 07:00:24', 1, 'U Nay Myo Thant'),
(18, 22, '10000', 2147483647, 'download.png', '2023-09-10 06:46:30', 1, 'U Nay Myo Thant'),
(19, 22, '10000', 2147483647, 'download.png', '2023-09-10 07:00:27', 1, 'U Nay Myo Thant'),
(20, 22, '4000', 2147483647, 'download.png', '2023-09-10 07:01:24', 0, 'U Nay Myo Thant'),
(21, 23, '500000', 2147483647, 'download.png', '2023-09-10 08:03:23', 1, 'maung hla');

-- --------------------------------------------------------

--
-- Table structure for table `noti`
--

CREATE TABLE `noti` (
  `id` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  `is_read` tinyint(1) NOT NULL,
  `link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `noti`
--

INSERT INTO `noti` (`id`, `content`, `is_read`, `link`) VALUES
(1, 'kaung khant is folling You', 1, 'http://localhost/second/MandalarSecond1.0/mandalar/searchprofile.php?id=21'),
(2, 'kaung khant is Comment Your Post', 0, 'http://localhost/MandalarSecond1.0/mandalar/productDetail.php?id=5'),
(3, 'kaung khant reply your comment', 0, 'http://localhost/MandalarSecond1.0/mandalar/productDetail.php?id=5'),
(4, 'Maung Myint React Your Post', 0, 'http://localhost/MandalarSecond1.0/mandalar/productDetail.php?id=5'),
(5, 'Maung Myint is Comment Your Post', 0, 'http://localhost/MandalarSecond1.0/mandalar/productDetail.php?id=5'),
(6, 'Maung Myint reply your comment', 0, 'http://localhost/MandalarSecond1.0/mandalar/productDetail.php?id=5'),
(7, 'Maung Myint is Comment Your Post', 0, 'http://localhost/MandalarSecond1.0/mandalar/productDetail.php?id=5'),
(8, 'Maung Myint is Comment Your Post', 0, 'http://localhost/MandalarSecond1.0/mandalar/productDetail.php?id=5'),
(9, 'Maung Myint reply your comment', 0, 'http://localhost/MandalarSecond1.0/mandalar/productDetail.php?id=5'),
(10, 'Maung Myint is folling You', 0, 'http://localhost/MandalarSecond1.0/mandalar/searchprofile.php?id=21'),
(11, 'Maung Ko React Your Post', 0, 'http://localhost/MandalarSecond1.0/mandalar/productDetail.php?id=7'),
(12, 'Maung Ko React Your Post', 0, 'http://localhost/MandalarSecond1.0/mandalar/productDetail.php?id=7'),
(13, 'Maung Ko is Comment Your Post', 0, 'http://localhost/MandalarSecond1.0/mandalar/productDetail.php?id=7'),
(14, 'Maung Ko reply your comment', 0, 'http://localhost/MandalarSecond1.0/mandalar/productDetail.php?id=7'),
(15, 'Maung Ko is Comment Your Post', 0, 'http://localhost/MandalarSecond1.0/mandalar/productDetail.php?id=6'),
(16, 'Maung Ko reply your comment', 0, 'http://localhost/MandalarSecond1.0/mandalar/productDetail.php?id=6'),
(17, 'Maung Ko is Comment Your Post', 0, 'http://localhost/MandalarSecond1.0/mandalar/productDetail.php?id=6'),
(18, 'Maung Ko React Your Post', 0, 'http://localhost/MandalarSecond1.0/mandalar/productDetail.php?id=6'),
(19, 'Maung Ko React Your Post', 0, 'http://localhost/MandalarSecond1.0/mandalar/productDetail.php?id=6'),
(20, 'Maung Ko React Your Post', 0, 'http://localhost/MandalarSecond1.0/mandalar/productDetail.php?id=6'),
(21, 'Maung Ko React Your Post', 0, 'http://localhost/MandalarSecond1.0/mandalar/productDetail.php?id=6'),
(22, 'Maung Ko React Your Post', 0, 'http://localhost/MandalarSecond1.0/mandalar/productDetail.php?id=6'),
(23, 'Maung Ko React Your Post', 0, 'http://localhost/MandalarSecond1.0/mandalar/productDetail.php?id=6'),
(24, 'kaung khant add new Post', 0, 'http://localhost/MandalarSecond1.0/mandalar/productDetail.php?id=8'),
(25, 'kaung khant add new Post', 0, 'http://localhost/MandalarSecond1.0/mandalar/productDetail.php?id=10'),
(26, 'kaung khant add new Post', 0, 'http://localhost/MandalarSecond1.0/mandalar/productDetail.php?id=11'),
(27, 'kaung khant add new Post', 0, 'http://localhost/MandalarSecond1.0/mandalar/productDetail.php?id=12'),
(28, 'kaung khant add new Post', 0, 'http://localhost/MandalarSecond1.0/mandalar/productDetail.php?id=13'),
(29, 'maung hla aung React Your Post', 0, 'http://localhost/MandalarSecond1.0/mandalar/productDetail.php?id=13'),
(30, 'maung hla aung React Your Post', 0, 'http://localhost/MandalarSecond1.0/mandalar/productDetail.php?id=12'),
(31, 'maung hla aung React Your Post', 1, 'http://localhost/MandalarSecond1.0/mandalar/productDetail.php?id=12'),
(32, 'maung hla aung is Comment Your Post', 1, 'http://localhost/MandalarSecond1.0/mandalar/productDetail.php?id=12'),
(33, 'maung hla aung reply your comment', 0, 'http://localhost/MandalarSecond1.0/mandalar/productDetail.php?id=12'),
(34, 'maung hla aung is Comment Your Post', 0, 'http://localhost/MandalarSecond1.0/mandalar/productDetail.php?id=12'),
(35, 'kaung khant reply your comment', 0, 'http://localhost/MandalarSecond1.0/mandalar/productDetail.php?id=12'),
(36, 'maung hla aung is Comment Your Post', 0, 'http://localhost/MandalarSecond1.0/mandalar/productDetail.php?id=12'),
(37, 'maung hla aung is folling You', 0, 'http://localhost/MandalarSecond1.0/mandalar/searchprofile.php?id=20'),
(38, 'kaung khant add new Post', 0, 'http://localhost/MandalarSecond1.0/mandalar/productDetail.php?id=15'),
(39, 'kaung khant add new Post', 1, 'http://localhost/MandalarSecond1.0/mandalar/productDetail.php?id=15'),
(40, 'maung hla aung React Your Post', 0, 'http://localhost/MandalarSecond1.0/mandalar/productDetail.php?id=15');

-- --------------------------------------------------------

--
-- Table structure for table `noti_pivi`
--

CREATE TABLE `noti_pivi` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `noti_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `noti_pivi`
--

INSERT INTO `noti_pivi` (`id`, `user_id`, `noti_id`) VALUES
(1, 21, 1),
(2, 21, 2),
(3, 21, 4),
(4, 21, 5),
(5, 20, 6),
(6, 21, 7),
(7, 21, 8),
(8, 20, 9),
(9, 21, 10),
(10, 20, 11),
(11, 20, 12),
(12, 20, 13),
(13, 20, 15),
(14, 20, 17),
(15, 20, 18),
(16, 20, 19),
(17, 20, 20),
(18, 20, 21),
(19, 20, 22),
(20, 20, 23),
(21, 21, 24),
(22, 21, 25),
(23, 21, 26),
(24, 21, 27),
(25, 21, 28),
(26, 20, 29),
(27, 20, 30),
(28, 20, 31),
(29, 20, 32),
(30, 20, 34),
(31, 20, 36),
(32, 20, 37),
(33, 21, 38),
(34, 23, 39),
(35, 20, 40);

-- --------------------------------------------------------

--
-- Table structure for table `nrc`
--

CREATE TABLE `nrc` (
  `id` int(11) NOT NULL,
  `from_id` int(255) NOT NULL,
  `to_id` int(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `nrc` varchar(255) NOT NULL,
  `front_nrc` varchar(255) NOT NULL,
  `back_nrc` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nrc`
--

INSERT INTO `nrc` (`id`, `from_id`, `to_id`, `date`, `nrc`, `front_nrc`, `back_nrc`, `status`) VALUES
(18, 0, 20, '2023-09-07 07:31:22', '9/alsd/12345', '1.png', '2.png', 1),
(19, 0, 21, '2023-09-07 07:31:06', '9/alsd/12345', 'one-piece-kaido-one-piece-monkey-d-luffy-hd-wallpaper-preview.jpg', 'one-piece-for-desktop-thousand-sunny-ship-ocean-clouds-artwork-wallpaper.jpg', 1),
(20, 0, 20, '2023-09-07 09:27:41', '9/alsd/12345', '01.05.2023_10.53.59_REC.png', '09.05.2023_07.17.15_REC.png', 0),
(21, 0, 21, '2023-09-07 09:41:15', '9/alsd/12345', '1.png', '2.png', 1),
(22, 0, 22, '2023-09-10 06:44:33', '9/alsd/12345', 'front_nrc.jpg', 'back_nrc.jpg', 1),
(23, 0, 22, '2023-09-10 06:44:33', '9/alsd/12345', 'front_nrc.jpg', 'back_nrc.jpg', 1),
(24, 0, 20, '2023-09-10 06:54:17', '9/alsd/12345', 'one-piece-kaido-one-piece-monkey-d-luffy-hd-wallpaper-preview.jpg', 'one-piece-kaido-one-piece-monkey-d-luffy-hd-wallpaper-preview.jpg', 0),
(25, 0, 20, '2023-09-10 06:54:17', '9/alsd/12345', 'one-piece-kaido-one-piece-monkey-d-luffy-hd-wallpaper-preview.jpg', 'one-piece-kaido-one-piece-monkey-d-luffy-hd-wallpaper-preview.jpg', 0),
(26, 0, 22, '2023-09-10 06:55:34', '9/alsd/12345', 'one-piece-kaido-one-piece-monkey-d-luffy-hd-wallpaper-preview.jpg', 'one-piece-kaido-one-piece-monkey-d-luffy-hd-wallpaper-preview.jpg', 0),
(27, 0, 23, '2023-09-10 08:14:12', '9/alsd/12345', 'front_nrc.jpg', 'back_nrc.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `seller_id` int(255) NOT NULL,
  `buyer_id` int(255) NOT NULL,
  `sub_category_id` int(11) NOT NULL,
  `buyer_info_id` int(11) NOT NULL,
  `seller_info_id` int(11) NOT NULL,
  `item` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `photo_folder` varchar(255) NOT NULL,
  `price` int(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `new_used` enum('new','used') NOT NULL,
  `freeze` int(255) NOT NULL,
  `post_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `buy_date` timestamp NULL DEFAULT NULL,
  `status` enum('none','waiting','go_take','take','go_send','sold_out','seller_waiting','take_waiting','send_waiting') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `seller_id`, `buyer_id`, `sub_category_id`, `buyer_info_id`, `seller_info_id`, `item`, `brand`, `photo_folder`, `price`, `description`, `new_used`, `freeze`, `post_date`, `buy_date`, `status`) VALUES
(1, 20, 21, 2, 72, 73, 'Vivo Z99', 'Vivo', '20image_169406984664f97456300026.40829004', 1500000, 'Certainly! Here\'s a sample post for selling your second-hand Vivo Z99 Pro:\r\n\r\n---\r\n\r\n**Title:**\r\n\r\n**\"Gently Used Vivo Z99 Pro for Sale - Excellent Condition!\"**\r\n\r\n**Description:**\r\n\r\nAre you in the market for a fantastic smartphone at a great price? Loo', 'used', 0, '2023-09-10 05:22:04', '2023-09-07 03:39:20', 'go_take'),
(3, 20, 21, 8, 70, 71, 'car', 'cardillac', '20image_169407000064f974f0e5da10.58947771', 900000, 'that is greatest car', 'used', 0, '2023-09-07 08:01:01', '2023-09-07 03:26:49', 'sold_out'),
(5, 21, 20, 4, 74, 75, 'z 1000', 'kawasaki', '21image_169407271964f97f8f424f61.18787484', 180000, 'That is Greatest Bike', 'used', 0, '2023-09-10 05:22:40', '2023-09-07 05:17:38', 'take'),
(7, 20, 22, 4, 0, 68, 'Bike', 'apple', '20image_169415589464fac476692202.78092462', 1111, 'qwert', 'used', 0, '2023-09-10 07:12:44', '2023-09-10 02:17:47', 'waiting'),
(9, 22, 0, 5, 0, 0, 'NGAF', 'crocodile', '22image_169432970864fd6b6c92f015.15573542', 2000, 'ASDFASDF', 'used', 0, '2023-09-10 07:08:28', NULL, 'none'),
(10, 20, 0, 4, 0, 0, 'Power 14', 'chrocodie', '20image_169433028164fd6da9474bc6.81131622', 23000, 'asdfasdf', 'used', 0, '2023-09-10 07:18:01', NULL, 'none'),
(11, 20, 0, 1, 0, 0, 'Ear Phone', 'Yrmahna', '20image_169433041764fd6e311a8a79.90141035', 5000, 'Best Earphone', 'used', 0, '2023-09-10 07:20:17', NULL, 'none'),
(12, 20, 0, 1, 0, 0, 'Brand New Ear Phone', 'asus', '20image_169433051364fd6e9132a6e3.30368051', 460000, 'The best Ear phone', 'new', 0, '2023-09-10 07:21:53', NULL, 'none'),
(13, 20, 23, 2, 102, 103, 'Vivo z 12', 'vivo', '20image_169433059664fd6ee4c8b151.84551745', 20000, 'Vivo adadsfasdfd', 'used', 0, '2023-09-10 08:12:07', '2023-09-10 03:34:41', 'sold_out'),
(14, 23, 0, 4, 0, 0, 'bike', 'toyota', '23image_169433369964fd7b0315f0f5.84058939', 10000, 'greate bike!!', 'used', 0, '2023-09-10 08:14:59', NULL, 'none'),
(15, 20, 0, 2, 0, 0, 'phone', 'apple', '20image_169433388564fd7bbd320275.51994420', 111133, 'i phone 16', 'new', 0, '2023-09-10 08:18:05', NULL, 'none');

-- --------------------------------------------------------

--
-- Table structure for table `post_react`
--

CREATE TABLE `post_react` (
  `id` int(11) NOT NULL,
  `user_id` int(255) NOT NULL,
  `post_id` int(11) NOT NULL,
  `react` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post_react`
--

INSERT INTO `post_react` (`id`, `user_id`, `post_id`, `react`) VALUES
(19, 3, 46, 0),
(20, 4, 46, 0),
(23, 5, 39, 0),
(33, 5, 46, 0),
(34, 6, 47, 0),
(35, 7, 50, 0),
(36, 6, 61, 0),
(37, 6, 62, 0),
(38, 6, 63, 0),
(42, 7, 63, 0),
(43, 6, 53, 0),
(44, 17, 69, 0),
(45, 17, 70, 0),
(46, 17, 68, 0),
(59, 20, 66, 0),
(61, 20, 5, 0),
(62, 22, 5, 0),
(64, 22, 7, 0),
(70, 22, 6, 0),
(71, 23, 13, 0),
(73, 23, 12, 0),
(74, 23, 15, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sub_category`
--

CREATE TABLE `sub_category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sub_category`
--

INSERT INTO `sub_category` (`id`, `name`, `category_id`) VALUES
(1, 'Speaker', 1),
(2, 'Mobile', 1),
(3, 'Charger', 1),
(4, 'Bike', 2),
(5, 'Three Wheels Bike', 2),
(6, 'Bicycle ', 5),
(7, 'Electric Bicycle ', 5),
(8, 'SUV', 4),
(9, 'Saloon', 4),
(10, 'bag', 7),
(11, 'Clothes', 7),
(12, 'Clothes', 8),
(13, 'bag', 8),
(14, 'Console', 9),
(15, 'Accessories', 9),
(16, 'PC', 10),
(17, 'Accessories', 10),
(18, 'Ball', 11),
(19, 'Gym', 11),
(20, 'Home', 12),
(21, 'Kitchen', 12);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `bio` varchar(255) DEFAULT NULL,
  `wallet` int(255) DEFAULT NULL,
  `nrc` varchar(255) DEFAULT NULL,
  `start_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ban_user` tinyint(1) DEFAULT NULL,
  `img` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `fname`, `lname`, `email`, `password`, `bio`, `wallet`, `nrc`, `start_date`, `ban_user`, `img`, `status`, `full_name`) VALUES
(20, 'kaung', 'khant', 'kaungkhant@gmail.com', 'f426726a2e76a177ed114b01bedb3b7f', NULL, 5521311, '9/alsd/12345', '2023-09-10 08:12:07', NULL, 'mylove.jpg', '', 'kaung khant'),
(21, 'Nay', 'ko', 'naymyothat@gmail.com', 'f34d86332d9792a208f7c5e958066710', 'hello', 98280000, '9/alsd/12345', '2023-09-07 09:52:47', NULL, 'eef56742ec0dd6abd4b78f6e582f1d98.jpg', '', 'Nay ko'),
(22, 'Maung', 'Ko', 'maungmyint@gmail.com', '94322442462a4b3f19ebb8aebca69127', 'hello', 18889, '9/alsd/12345', '2023-09-10 07:00:27', NULL, 'onepiece.jpg', '', 'Maung Ko'),
(23, 'Nay Myo', 'Thant', 'MaungHla@gmail.com', '44673df52530f23e5b2a717a8a32bb12', 'hello', 0, '9/alsd/12345', '2023-09-10 08:22:32', NULL, 'Nay Myo Thant.jpg', '', 'Nay Myo Thant');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `id` int(11) NOT NULL,
  `user_id` int(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` int(11) NOT NULL,
  `city_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`id`, `user_id`, `address`, `phone`, `city_id`) VALUES
(3, 6, 'qqqqq', 2147483647, 1),
(4, 6, 'hello', 12345, 1),
(5, 6, 'hi', 2222, 1),
(6, 6, 'hi', 234, 1),
(7, 6, 'hi', 123, 1),
(8, 6, 'qwertyuio', 12345678, 1),
(9, 6, 'asdfgh', 123456, 1),
(10, 7, 'hi', 123456, 1),
(11, 7, 'hi', 123456, 1),
(12, 7, 'hello', 12345, 1),
(13, 7, 'a;dsfjaw', 2147483647, 1),
(14, 7, 'hello', 12412, 1),
(15, 7, 'jaljf;adf', 1234567, 1),
(16, 7, 'asidfo', 1234567, 1),
(17, 7, '2342345234532', 2147483647, 2),
(18, 7, 'adfdfdfdasdfd', 9324545, 1),
(19, 7, 'qwerqw', 123123, 2),
(20, 7, 'aweraer', 34523425, 1),
(21, 7, 'ajkfj;al', 1234, 1),
(22, 7, 'asdfghj', 123456, 1),
(23, 6, 'qwert', 12345, 1),
(24, 6, 'sdfgh', 1234, 1),
(25, 7, 'hello', 12345, 1),
(26, 7, 'qwerty', 123456, 1),
(27, 6, 'qwert', 12345, 1),
(28, 6, 'qwert', 12345, 1),
(29, 7, 'qwerty', 12345, 1),
(30, 7, 'wert', 12345, 1),
(31, 6, 'qwerty', 12345, 1),
(32, 6, 'qwerty', 12345, 1),
(33, 7, 'qwertyu', 123456, 1),
(34, 6, 'qwer', 12345, 1),
(35, 7, 'qwe', 123, 1),
(36, 7, 'qwe', 123, 1),
(37, 6, 'qwerliauhdsihbisdhvoa;nd[ovina', 1234, 1),
(38, 7, 'qwe', 123, 1),
(39, 6, 'asfasd', 123, 1),
(40, 6, 'asd', 123, 1),
(41, 7, 'qwertyuiop', 123456789, 3),
(42, 6, 'qwertyuio', 123456789, 1),
(43, 6, 'qwertyu', 12345, 1),
(44, 6, 'qwertyuio', 12345678, 1),
(45, 6, 'qwertyui', 123456789, 1),
(46, 6, 'qwertyui', 123456789, 1),
(47, 6, 'qwertyui', 123456789, 1),
(48, 6, 'qwertyui', 123456789, 1),
(49, 6, 'qwertyui', 123456789, 1),
(50, 6, 'qwertyui', 123456789, 1),
(51, 6, 'qwertyui', 123456789, 1),
(52, 6, 'qwertyui', 123456789, 1),
(53, 6, 'qwertyui', 123456789, 1),
(54, 6, 'qwertyui', 123456789, 1),
(55, 6, 'qwertyui', 123456789, 1),
(56, 6, 'qwertyui', 123456789, 1),
(57, 6, 'qwertyui', 123456789, 1),
(58, 6, 'qwertyui', 123456789, 1),
(59, 6, 'qwertyui', 123456789, 1),
(60, 6, 'qwertyui', 123456789, 1),
(61, 6, 'qwertyui', 123456789, 1),
(62, 6, 'qwertyui', 123456789, 1),
(63, 6, 'qwertyui', 123456789, 1),
(64, 6, 'qwertyui', 123456789, 1),
(65, 6, 'qwertyuio', 1234567890, 1),
(66, 18, 'wertyu', 12345678, 1),
(67, 17, 'qwertyu', 123456, 1),
(68, 20, 'qwerty', 123456, 1),
(69, 20, 'qwerty', 12345, 1),
(70, 21, 'mandalay', 9123456, 1),
(71, 20, 'mandalay', 123456, 1),
(72, 21, 'qwerty', 123456, 1),
(73, 20, 'erty', 123456, 1),
(74, 20, 'mandalay', 987654321, 1),
(75, 21, 'mandalay', 1234567, 1),
(76, 22, 'mandalay', 2147483647, 1),
(77, 22, 'mandalay', 2147483647, 1),
(78, 22, 'mandalay', 2147483647, 1),
(79, 22, 'mandalay', 2147483647, 1),
(80, 22, 'mandalay', 2147483647, 1),
(81, 22, 'mandalay', 2147483647, 1),
(82, 22, 'mandalay', 2147483647, 1),
(83, 22, 'mandalay', 2147483647, 1),
(84, 22, 'mandalay', 2147483647, 1),
(85, 22, 'mandalay', 2147483647, 1),
(86, 22, 'mandalay', 2147483647, 1),
(87, 22, 'mandalay', 2147483647, 1),
(88, 22, 'mandalay', 2147483647, 1),
(89, 22, 'mandalay', 2147483647, 1),
(90, 22, 'mandalay', 2147483647, 1),
(91, 22, 'mandalay', 2147483647, 1),
(92, 22, 'mandalay', 2147483647, 1),
(93, 22, 'mandalay', 2147483647, 1),
(94, 22, 'mandalay', 2147483647, 1),
(95, 22, 'mandalay', 2147483647, 1),
(96, 22, 'mandalay', 2147483647, 1),
(97, 22, 'mandalay', 2147483647, 1),
(98, 22, 'mandalay', 2147483647, 1),
(99, 22, 'mdy', 1234567, 1),
(100, 20, 'mdy', 123456, 1),
(101, 20, 'qwerty', 123456, 1),
(102, 23, 'mandalay', 987887878, 1),
(103, 20, 'adafdf', 9878788, 1);

-- --------------------------------------------------------

--
-- Table structure for table `view_count`
--

CREATE TABLE `view_count` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `view_count`
--

INSERT INTO `view_count` (`id`, `user_id`, `post_id`, `date`) VALUES
(1, 6, 63, '2023-08-16 08:02:02'),
(2, 6, 63, '2023-08-16 08:03:31'),
(3, 6, 57, '2023-08-16 08:03:36'),
(4, 6, 63, '2023-08-16 08:03:38'),
(5, 6, 63, '2023-08-16 08:03:58'),
(6, 6, 57, '2023-08-16 08:03:59'),
(7, 6, 57, '2023-08-16 08:04:00'),
(8, 6, 57, '2023-08-16 08:04:00'),
(9, 6, 57, '2023-08-16 08:04:00'),
(10, 6, 57, '2023-08-16 08:04:01'),
(11, 6, 57, '2023-08-16 08:04:01'),
(12, 6, 57, '2023-08-16 08:04:02'),
(13, 6, 54, '2023-08-16 08:04:03'),
(14, 6, 54, '2023-08-16 08:04:04'),
(15, 6, 54, '2023-08-16 08:04:05'),
(16, 6, 63, '2023-08-16 08:09:18'),
(17, 6, 63, '2023-08-16 08:09:50'),
(18, 6, 63, '2023-08-16 08:09:50'),
(19, 6, 63, '2023-08-16 08:10:09'),
(20, 6, 63, '2023-08-16 08:10:09'),
(21, 6, 54, '2023-08-16 08:12:35'),
(22, 6, 63, '2023-08-16 08:12:41'),
(23, 6, 63, '2023-08-16 08:13:35'),
(24, 6, 63, '2023-08-19 02:19:36'),
(25, 6, 63, '2023-08-19 02:24:48'),
(26, 6, 63, '2023-08-19 02:25:07'),
(27, 6, 57, '2023-08-23 06:21:22'),
(28, 6, 54, '2023-08-23 06:21:42'),
(29, 6, 63, '2023-09-04 06:40:45'),
(30, 6, 55, '2023-09-04 06:41:01'),
(31, 6, 55, '2023-09-04 06:41:39'),
(32, 6, 55, '2023-09-04 06:46:19'),
(33, 6, 55, '2023-09-04 06:49:20'),
(34, 18, 69, '2023-09-06 04:19:57'),
(35, 19, 68, '2023-09-06 06:26:33'),
(36, 19, 67, '2023-09-06 06:26:38'),
(37, 19, 70, '2023-09-06 07:08:32'),
(38, 19, 70, '2023-09-06 07:10:53'),
(39, 19, 65, '2023-09-06 07:20:22'),
(40, 17, 69, '2023-09-07 02:51:13'),
(41, 17, 70, '2023-09-07 02:51:27'),
(42, 17, 69, '2023-09-07 02:52:12'),
(43, 17, 68, '2023-09-07 02:55:17'),
(44, 17, 70, '2023-09-07 02:55:24'),
(45, 17, 68, '2023-09-07 02:55:28'),
(46, 17, 67, '2023-09-07 02:59:16'),
(47, 17, 68, '2023-09-07 03:02:25'),
(48, 20, 69, '2023-09-07 03:11:57'),
(49, 0, 68, '2023-09-07 03:19:17'),
(50, 20, 69, '2023-09-07 03:20:51'),
(51, 20, 69, '2023-09-07 04:02:08'),
(52, 20, 69, '2023-09-07 04:02:26'),
(53, 20, 70, '2023-09-07 04:09:57'),
(54, 20, 69, '2023-09-07 04:11:57'),
(55, 20, 66, '2023-09-07 04:14:29'),
(56, 20, 67, '2023-09-07 04:15:02'),
(57, 20, 66, '2023-09-07 04:17:08'),
(58, 20, 66, '2023-09-07 04:37:34'),
(59, 0, 70, '2023-09-07 04:39:24'),
(60, 20, 70, '2023-09-07 04:41:00'),
(61, 20, 1, '2023-09-07 07:02:47'),
(62, 20, 4, '2023-09-07 07:10:34'),
(63, 21, 4, '2023-09-07 07:41:29'),
(64, 21, 3, '2023-09-07 07:42:17'),
(65, 21, 1, '2023-09-07 07:42:20'),
(66, 21, 5, '2023-09-07 07:45:28'),
(67, 21, 5, '2023-09-07 07:55:09'),
(68, 21, 3, '2023-09-07 07:55:12'),
(69, 21, 1, '2023-09-07 07:55:22'),
(70, 21, 3, '2023-09-07 07:56:34'),
(71, 21, 1, '2023-09-07 08:09:12'),
(72, 0, 5, '2023-09-07 09:32:20'),
(73, 20, 5, '2023-09-07 09:34:49'),
(74, 20, 5, '2023-09-07 09:38:19'),
(75, 20, 5, '2023-09-07 09:38:26'),
(76, 20, 1, '2023-09-07 09:43:35'),
(77, 20, 5, '2023-09-07 09:47:04'),
(78, 0, 6, '2023-09-10 04:46:05'),
(79, 20, 5, '2023-09-10 06:27:45'),
(80, 20, 5, '2023-09-10 06:27:48'),
(81, 20, 5, '2023-09-10 06:28:01'),
(82, 22, 5, '2023-09-10 06:36:47'),
(83, 21, 3, '2023-09-10 06:40:35'),
(84, 22, 5, '2023-09-10 06:40:38'),
(85, 22, 7, '2023-09-10 06:47:28'),
(86, 22, 6, '2023-09-10 06:48:07'),
(87, 22, 6, '2023-09-10 06:51:41'),
(88, 22, 7, '2023-09-10 06:52:41'),
(89, 20, 7, '2023-09-10 06:53:39'),
(90, 20, 6, '2023-09-10 06:57:51'),
(91, 22, 6, '2023-09-10 06:59:01'),
(92, 22, 6, '2023-09-10 07:03:57'),
(93, 20, 8, '2023-09-10 07:06:46'),
(94, 20, 10, '2023-09-10 07:18:08'),
(95, 20, 7, '2023-09-10 07:18:16'),
(96, 20, 3, '2023-09-10 07:18:20'),
(97, 20, 1, '2023-09-10 07:18:24'),
(98, 20, 7, '2023-09-10 07:18:39'),
(99, 20, 9, '2023-09-10 07:18:45'),
(100, 20, 11, '2023-09-10 07:20:20'),
(101, 20, 13, '2023-09-10 07:23:19'),
(102, 20, 12, '2023-09-10 07:23:28'),
(103, 20, 1, '2023-09-10 07:23:35'),
(104, 21, 3, '2023-09-10 07:56:34'),
(105, 23, 13, '2023-09-10 07:59:30'),
(106, 23, 12, '2023-09-10 08:00:05'),
(107, 23, 13, '2023-09-10 08:03:55'),
(108, 20, 13, '2023-09-10 08:13:15'),
(109, 23, 14, '2023-09-10 08:15:02'),
(110, 20, 13, '2023-09-10 08:15:20'),
(111, 20, 14, '2023-09-10 08:15:24'),
(112, 20, 7, '2023-09-10 08:15:41');

-- --------------------------------------------------------

--
-- Table structure for table `wave`
--

CREATE TABLE `wave` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `delivery_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wave`
--

INSERT INTO `wave` (`id`, `post_id`, `delivery_id`, `date`) VALUES
(23, 69, 33, '2023-09-06 04:43:38'),
(24, 69, 33, '2023-09-06 05:02:59'),
(25, 3, 33, '2023-09-07 07:57:47'),
(26, 3, 33, '2023-09-07 07:59:03'),
(27, 1, 33, '2023-09-07 08:09:51'),
(29, 5, 34, '2023-09-07 09:48:54'),
(30, 6, 34, '2023-09-10 06:49:41'),
(31, 13, 35, '2023-09-10 08:10:48');

-- --------------------------------------------------------

--
-- Table structure for table `withdraw`
--

CREATE TABLE `withdraw` (
  `id` int(11) NOT NULL,
  `kpay_name` varchar(255) NOT NULL,
  `kpay_phone` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` enum('wait','reject','success') NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `withdraw`
--

INSERT INTO `withdraw` (`id`, `kpay_name`, `kpay_phone`, `amount`, `user_id`, `status`, `date`) VALUES
(1, 'U Nay Myo Thant', '12345', 12345, 20, 'success', '2023-09-07 15:13:49'),
(8, 'U Nay Myo Thant', '1234567', 123456, 20, 'success', '2023-09-07 15:13:49'),
(9, 'U Nay Myo Thant', '1234567', 12, 20, 'success', '2023-09-07 15:13:49'),
(10, 'U Nay Myo Thant', '1234567', 12, 20, 'wait', '2023-09-07 15:13:49'),
(11, 'U Nay Myo Thant', '1234567', 12, 20, 'wait', '2023-09-07 15:13:49'),
(12, 'U Nay Myo Thant', '1234567', 12, 20, 'success', '2023-09-07 15:13:49'),
(13, 'U Nay Myo Thant', '1234567', 300, 20, 'success', '2023-09-08 02:44:55'),
(14, 'U Nay Myo Thant', '1234567', 300, 20, 'reject', '2023-09-08 02:44:58'),
(15, 'U Nay Myo Thant', '1234567', 400, 20, 'success', '2023-09-08 03:42:09'),
(16, 'U Nay Myo Thant', '1234567', 100, 20, 'wait', '2023-09-08 03:43:10'),
(17, 'U Nay Myo Thant', '1234567', 450000, 23, 'success', '2023-09-10 08:20:34'),
(18, 'U Nay Myo Thant', '1234567', 30000, 23, 'success', '2023-09-08 08:20:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favorite`
--
ALTER TABLE `favorite`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `follow`
--
ALTER TABLE `follow`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `money_check`
--
ALTER TABLE `money_check`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `noti`
--
ALTER TABLE `noti`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `noti_pivi`
--
ALTER TABLE `noti_pivi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nrc`
--
ALTER TABLE `nrc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_react`
--
ALTER TABLE `post_react`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `view_count`
--
ALTER TABLE `view_count`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wave`
--
ALTER TABLE `wave`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdraw`
--
ALTER TABLE `withdraw`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `favorite`
--
ALTER TABLE `favorite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `follow`
--
ALTER TABLE `follow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- AUTO_INCREMENT for table `money_check`
--
ALTER TABLE `money_check`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `noti`
--
ALTER TABLE `noti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `noti_pivi`
--
ALTER TABLE `noti_pivi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `nrc`
--
ALTER TABLE `nrc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `post_react`
--
ALTER TABLE `post_react`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `sub_category`
--
ALTER TABLE `sub_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `view_count`
--
ALTER TABLE `view_count`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `wave`
--
ALTER TABLE `wave`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `withdraw`
--
ALTER TABLE `withdraw`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
