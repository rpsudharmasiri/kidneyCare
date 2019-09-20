-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 20, 2019 at 01:42 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `users`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `a_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`a_id`, `name`, `email`, `password`) VALUES
(1, 'gayan', 'hhhh@gmail.com', 'my'),
(2, 'asanka', 'asd@gmail.com', '3ece1471f44f63177cbc35ba0b904e0c096b6783'),
(3, 'admin', 'admin@gmail.com', '7de4f7a008f95958b1a2c971df4ea891ad31641f'),
(4, 'dissanayaka', 'dis@gmail.com', '3710260e38080955a2853290a7553ba9d9c04632'),
(5, 'Aruna', 'admin1@gmail.com', 'bf33a2540d8fe46f74afbcda467ee2cc271856ea');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `com_id` int(11) NOT NULL,
  `q_id` int(11) NOT NULL,
  `pro_id` int(11) NOT NULL,
  `com_body` varchar(200) NOT NULL,
  `com_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`com_id`, `q_id`, `pro_id`, `com_body`, `com_date`) VALUES
(85, 54, 2, 'qqqqqqqqqqqqqqqqqqqqqqq', '2019-07-12 14:20:55'),
(86, 54, 2, 'qqqqqqqqqqqqqqqqqqqqqqq', '2019-07-12 14:20:55'),
(87, 54, 2, 'asda', '2019-07-12 14:32:15'),
(88, 54, 2, 'asasdaaaaaaaa', '2019-07-12 14:32:47'),
(89, 54, 2, 'kkkkkkkkkkkkkk', '2019-07-12 14:33:28'),
(90, 54, 2, 'kkkkkkkkkkkkkk', '2019-07-12 14:33:28'),
(91, 54, 2, 'kkkkkkkkkkkkkk', '2019-07-12 14:33:28'),
(92, 54, 2, 'kkkkkkkkkkkkkk', '2019-07-12 14:33:28'),
(93, 54, 2, 'zzzz', '2019-07-12 14:36:00'),
(94, 54, 2, 'zzzz', '2019-07-12 14:36:00'),
(100, 54, 2, 'axas', '2019-07-12 15:00:18'),
(101, 54, 2, 'sssd', '2019-07-12 15:00:38'),
(107, 54, 2, 's', '2019-07-12 19:24:57'),
(108, 54, 2, 's', '2019-07-12 19:25:34'),
(109, 54, 2, 'a', '2019-07-12 19:26:30'),
(110, 54, 2, 'w', '2019-07-12 19:27:30'),
(111, 54, 2, 'dharmasiri', '2019-07-13 00:19:08'),
(116, 53, 2, 'a', '2019-07-13 07:31:32'),
(117, 53, 2, 'a', '2019-07-13 07:31:32'),
(118, 53, 2, 'asda', '2019-07-13 07:31:32'),
(119, 53, 2, 'as', '2019-07-13 07:32:28'),
(120, 53, 2, 'dds', '2019-07-13 08:03:56'),
(121, 53, 2, 'das', '2019-07-13 08:05:26'),
(122, 53, 2, 'sssa', '2019-07-13 08:06:45'),
(123, 53, 2, 'sssa', '2019-07-13 08:06:45'),
(124, 53, 2, 'sssa', '2019-07-13 08:06:45'),
(125, 53, 2, 'sssa', '2019-07-13 08:06:45'),
(126, 53, 2, 'asq', '2019-07-13 08:08:10'),
(127, 53, 2, 'asq', '2019-07-13 08:08:10'),
(128, 53, 2, 'a', '2019-07-13 08:13:06'),
(129, 53, 2, 'SA', '2019-07-13 08:13:55'),
(130, 53, 2, 'SA', '2019-07-13 08:13:55'),
(131, 53, 2, 'as', '2019-07-13 10:58:16'),
(132, 53, 2, 'asas', '2019-07-13 10:58:48'),
(133, 53, 2, 'asas', '2019-07-13 10:58:48'),
(134, 54, 2, 'asdq', '2019-07-13 11:00:07'),
(135, 54, 2, 'asd', '2019-07-13 11:02:15'),
(136, 54, 2, 'asd', '2019-07-13 11:02:15'),
(137, 54, 2, 'asd', '2019-07-13 11:02:15'),
(138, 53, 2, 'asxsxasd', '2019-07-13 11:09:33'),
(139, 53, 2, 'asxsxasd', '2019-07-13 11:09:33'),
(140, 53, 2, 'asxsxasd', '2019-07-13 11:09:33'),
(141, 53, 2, 'suranjith', '2019-07-13 11:10:23'),
(142, 53, 2, 'suranjith', '2019-07-13 11:10:23'),
(143, 53, 2, 'asdadqaa', '2019-07-13 11:14:36'),
(144, 53, 2, 'asdadqaa', '2019-07-13 11:14:36'),
(145, 53, 2, 'asdadqaa', '2019-07-13 11:14:36'),
(146, 53, 2, 'asdad', '2019-07-13 11:18:21'),
(147, 53, 2, 'aaa', '2019-07-13 11:19:07'),
(148, 54, 2, 'ddddaaaa', '2019-07-13 11:21:59'),
(149, 53, 2, 'this ', '2019-07-13 15:09:18'),
(150, 53, 2, 'this ', '2019-07-13 15:09:18'),
(151, 54, 2, 'asdq', '2019-07-13 15:10:47'),
(152, 54, 2, 'as', '2019-07-13 15:12:31'),
(153, 53, 2, 'aeasdaaaa', '2019-07-13 15:47:46'),
(154, 54, 2, 'asdas', '2019-07-13 15:50:05'),
(155, 54, 2, 'asdas', '2019-07-13 15:50:05'),
(156, 53, 2, 'sdaWWS', '2019-07-13 15:54:36'),
(157, 53, 2, 'sdaWWS', '2019-07-13 15:54:36'),
(158, 53, 2, 'sdaWWS', '2019-07-13 15:54:36'),
(159, 53, 2, 'sasdq', '2019-07-13 15:58:28'),
(161, 53, 2, 'qqqqqqqqqqqqqqqqqqqqqqqqqqq', '2019-07-13 16:47:02'),
(162, 53, 2, 'aaaaaaaaaaaa', '2019-07-13 16:48:16'),
(163, 53, 39, 'asdaaa', '2019-07-13 19:14:06'),
(166, 53, 39, 'zxczz', '2019-07-15 08:31:18'),
(167, 53, 39, 'aaaakaaa', '2019-07-15 08:32:43'),
(171, 53, 39, 'suranjith1sd 1', '2019-07-15 08:41:40'),
(173, 53, 39, 'now or never1 2 3', '2019-07-15 09:00:47'),
(182, 54, 39, 'my my dff ddd', '2019-07-19 08:21:06'),
(188, 54, 2, 'qwqqwqwqwqwq', '2019-07-23 20:13:30'),
(189, 54, 39, 'all about', '2019-08-19 18:03:25'),
(190, 53, 39, 'comment', '2019-08-29 06:20:22');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL,
  `a_id` int(11) NOT NULL,
  `event_title` varchar(100) NOT NULL,
  `event_location` varchar(100) NOT NULL,
  `event_date` varchar(50) NOT NULL,
  `event_time` time NOT NULL,
  `event_dis` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `a_id`, `event_title`, `event_location`, `event_date`, `event_time`, `event_dis`) VALUES
(6, 2, 'Kidney care campaign.', 'Anuradhapura', '2019-07-30', '08:00:00', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation '),
(7, 2, 'Kidney Walk', 'Anuradhapura', '2019-08-31', '09:00:00', 'Please be there for Support kidney patiemts');

-- --------------------------------------------------------

--
-- Table structure for table `general_users`
--

CREATE TABLE `general_users` (
  `guser_id` int(50) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `NIC` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `general_users`
--

INSERT INTO `general_users` (`guser_id`, `first_name`, `last_name`, `NIC`, `email`, `password`, `token`) VALUES
(15, 'usert', 'test my', '555598744v', 'usermy@gmail.com', 'ddbed576b775f2af9f020e31991a560be0e9264d', ''),
(16, 'user', 'test as', '526598744v', 'user@gmail.com', '4933be305ef019498fd5b353a6883b46bee8cd97', ''),
(18, 'Nirmala', 'Nanayakkara', '698547852v', 'AAA@gmail.com', 'bf33a2540d8fe46f74afbcda467ee2cc271856ea', ''),
(19, 'harshana', 'athukorala', '578469862v', 'hhha@gmail.com', 'bf33a2540d8fe46f74afbcda467ee2cc271856ea', ''),
(20, 'harshana', 'asdfkasd', '986987985v', 'tttt@gmail.com', 'bf33a2540d8fe46f74afbcda467ee2cc271856ea', ''),
(21, 'sdsf', 'sdfew', '564789874v', 'kkkk@gmail.com', 'bf33a2540d8fe46f74afbcda467ee2cc271856ea', ''),
(22, 'tst', 'last', '987548658v', 'jjjjj@gmail.com', 'bf33a2540d8fe46f74afbcda467ee2cc271856ea', ''),
(23, 'kdjdknda', 'nsdbfjashdf', '587958452v', 'kjashdfha@gmail.com', 'bf33a2540d8fe46f74afbcda467ee2cc271856ea', ''),
(24, 'dnfbjjnaanx', 'jadfandfad', '578468978v', 'jhdifj@gmail.com', 'bf33a2540d8fe46f74afbcda467ee2cc271856ea', ''),
(25, 'Udayanga', 'Jayasingha', '925647895v', 'hjfuk@gmail.com', 'd622ad523f12e51559a3d00d5662398cbf5e0130', ''),
(26, 'dileep', 'dharmasiri', '568568972v', 'kjkfpodfk@Gmail.com', 'f1f1a6d86f7eda8d02272839291cae2c2ee3a2df', ''),
(27, 'harshana', 'hasitha', '921352698v', 'userlogin@gmail.com', '8daa84b4cd276258a3fa7fe6c99a7da3a343caea', '');

-- --------------------------------------------------------

--
-- Table structure for table `organs`
--

CREATE TABLE `organs` (
  `org_id` int(11) NOT NULL,
  `first_name` varbinary(100) NOT NULL,
  `last_name` varbinary(100) NOT NULL,
  `age` varbinary(100) NOT NULL,
  `gender` varbinary(100) NOT NULL,
  `NIC` varbinary(100) NOT NULL,
  `email` varbinary(100) NOT NULL,
  `phone_num` varbinary(100) NOT NULL,
  `blood_group` varbinary(100) NOT NULL,
  `address1` varbinary(100) NOT NULL,
  `address2` varbinary(100) NOT NULL,
  `city` varbinary(100) NOT NULL,
  `district` varbinary(100) NOT NULL,
  `acc` varchar(5) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `organs`
--

INSERT INTO `organs` (`org_id`, `first_name`, `last_name`, `age`, `gender`, `NIC`, `email`, `phone_num`, `blood_group`, `address1`, `address2`, `city`, `district`, `acc`) VALUES
(8, 0x617364616461, 0x617364617364, 0x32303034, '', 0x39343433333239393876, 0x6b6b6b40676d61696c2e636f6d, 0x373736373632373833, 0x412b, 0x61736461, 0x61736461, 0x6173646173646173, 0x416d70617261, ''),
(18, 0x6173646173, 0x6173646173, 0x32362e353337323034353430323639, '', 0x32323235363839373276, 0x61736461717140676d61696c2e636f6d, 0x35, 0x412b, 0x6164, 0x617364, 0x616461, 0x416d70617261, ''),
(19, 0x617364617364, 0x6173646173646173646173646173, 0x32372e313331343336343834333937, '', 0x39323133333234343476, 0x617364616461736461647140676d61696c2e636f6d, 0x343535353535353535, 0x412b, 0x61646661, 0x6164666466, 0x6473666466, 0x416d70617261, ''),
(23, 0x737572616e6a697468, 0x75646179616e6761, 0x3237, 0x4d616c65, 0x39323133333535353876, 0x6768676840676d61696c2e636f6d, 0x373736373632373833, 0x412b, 0x6173646173, 0x617364616661616466616466, 0x61736471, 0x48616d62616e746f7461, '1'),
(26, 0x73646661736466, 0x73646661736466, 0x3236, 0x4d616c65, 0x39323133333939393876, 0x64646440676d61696c2e636f6d, 0x373736373632373833, 0x4f2b, 0x64616677, 0x7765717765, 0x77716577, 0x4b696c696e6f6368636869, '1'),
(27, 0x756d65736861, 0x73616d7564696e69, 0x3237, 0x46656d616c65, 0x36353135383038353476, 0x756d613139393473656e617669726174686e6140676d61696c2e636f6d, 0x373733303831343234, 0x4f2b, 0x757474696d616468757761, 0x757474696d616468757761, 0x416e75726164686170757261, 0x416d70617261, '1'),
(29, 0x756d65736861, 0x73656e657669726174686e61, 0x3235, 0x46656d616c65, 0x39343537393733313476, 0x756d657368613139393440676d61696c2e636f6d, 0x30373733303831343234, 0x422b, 0x757474696d6164757761, 0x757474696d6164757761, 0x416e75726164686170757261, 0x416e75726164686170757261, '1'),
(30, 0x756d65736861, 0x73616d7564696e69, 0x3234, 0x46656d616c65, 0x39323131313839393876, 0x756d657368613139393473616d7564686940676d61696c2e636f6d, 0x30373736373632373833, 0x4f2b, 0x757474696d6164757761, 0x757474696d6164757761, 0x416e75726164686170757261, 0x416e75726164686170757261, '1'),
(31, 0x756d65736861, 0x73616d7564696e69, 0x3235, 0x46656d616c65, 0x39323132353438393876, 0x756d657368613139393473616d75646940676d61696c2e636f6d, 0x30373736373632373833, 0x4f2b, 0x757474696d6164757761, 0x757474696d6164757761, 0x616e75726164686170757261, 0x416e75726164686170757261, '1'),
(32, 0x796173686f6461, 0x68, 0x3233, 0x46656d616c65, 0x39323133333835343876, 0x796173686f3132323140676d61696c2e636f6d, 0x30373736373632373833, 0x4f2b, 0x616161, 0x61736173, 0x61736173617361736173, 0x416e75726164686170757261, '1'),
(33, 0x6275646468696b6120, 0x6d61647573616e6b61, 0x3232, 0x4d616c65, 0x39363233353333333976, 0x64656570627564646940676d61696c2e636f6d, 0x30373636353431313736, 0x422b, 0x323934302f612c332073746167652c, 0x416e75726164686170757261, 0x416e75726164686170757261, 0x416e75726164686170757261, '1');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(100) NOT NULL,
  `pro_id` int(100) NOT NULL,
  `post_title` varchar(200) NOT NULL,
  `post_body` varchar(200) NOT NULL,
  `post_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `pro_id`, `post_title`, `post_body`, `post_date`) VALUES
(18, 2, 'About kidneys', 'thease are some tips for save your kidney', '2019-02-07 10:12:33'),
(19, 6, 'Drink Water', 'for save your kidneys drink water  ', '2019-02-13 12:27:03'),
(20, 32, 'Blood presure', 'Blood prsure is the main reson for kidney failures', '2019-02-15 14:54:34'),
(21, 35, 'Donate', 'Save a life with your donation', '2019-02-16 20:07:38'),
(22, 2, 'medication ', 'let it free', '2019-06-03 16:02:41'),
(23, 39, 'we need ', 'kdifnasdnfadnasd jdnsadckdnc sdjcinsadc', '2019-08-19 21:32:36'),
(24, 39, 'hdjdn', 'dkjhfsdf', '2019-08-20 10:31:21');

-- --------------------------------------------------------

--
-- Table structure for table `pro`
--

CREATE TABLE `pro` (
  `pro_id` int(50) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `pro_for` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pro`
--

INSERT INTO `pro` (`pro_id`, `first_name`, `last_name`, `pro_for`, `email`, `password`) VALUES
(2, 'jason', 'statham', 'Professor', 'hjfu@gmail.com', '3ece1471f44f63177cbc35ba0b904e0c096b6783'),
(6, 'donald', 'Layanal', 'Professor', 'loead@gmail.com', 'bf33a2540d8fe46f74afbcda467ee2cc271856ea'),
(7, 'sunil', 'silva', 'lecturer', 'kkkl@gmail.com', 'bf33a2540d8fe46f74afbcda467ee2cc271856ea'),
(8, 'albet', 'asdfkasd', 'Consultant', 'lllll@gmai.com', 'bf33a2540d8fe46f74afbcda467ee2cc271856ea'),
(32, 'lalith', 'Athukorala', 'Consultant', 'lalith@gmail.com', 'bf33a2540d8fe46f74afbcda467ee2cc271856ea'),
(33, 'donald', 'Ranasingha', 'Consultant', 'donald@gmail.com', 'bf33a2540d8fe46f74afbcda467ee2cc271856ea'),
(34, 'donald', 'Ranasingha', 'Consultant', 'd@gmail.com', 'bf33a2540d8fe46f74afbcda467ee2cc271856ea'),
(35, 'nipuna', 'anuranga', 'Consultant', 'nipunaanurangarko@gmail.com', '6d50fc65ed75ba180dc7613c10fd538dcbfd6e3c'),
(36, 'jacob', 'daniyal', 'Consultant', 'jacob@gmail.com', 'bf33a2540d8fe46f74afbcda467ee2cc271856ea'),
(37, 'jonathan', 'fernando', 'Consultant', 'jonathan@gmail.com', 'bf33a2540d8fe46f74afbcda467ee2cc271856ea'),
(38, 'msdhfadbf', 'sldkjf', 'Consultant', 'jsdkfjsld@gmail.com', 'bf33a2540d8fe46f74afbcda467ee2cc271856ea'),
(39, 'Asanka', 'jayawardhana', 'lecturer', 'pro2@gmail.com', '8daa84b4cd276258a3fa7fe6c99a7da3a343caea'),
(40, 'a,sdmlaknd', 's,mdsd', 'Consultant', 'ksdcsd@gmail.com', 'bf33a2540d8fe46f74afbcda467ee2cc271856ea'),
(41, 'ksdnflmdsad', ',mnacad', 'Consultant', 'mmlkdjfoiajdfj@gmail.com', 'bf33a2540d8fe46f74afbcda467ee2cc271856ea'),
(43, 'umesha', 'samudini', 'Consultant', 'umesha1994samudi@gmail.com', 'b983d65519bb8d725b0d002f59e974a3f22e8502');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `q_id` int(50) NOT NULL,
  `guser_id` int(50) NOT NULL,
  `q_title` varchar(100) NOT NULL,
  `q_body` varchar(200) NOT NULL,
  `q_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`q_id`, `guser_id`, `q_title`, `q_body`, `q_date`) VALUES
(53, 18, 'Medication', 'what would be the best method for reduce blood prsure', '2019-02-17 12:51:46'),
(54, 27, 'title ', 'ask from me a', '2019-07-11 10:56:14');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `pro_id` int(50) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `pro_for` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`pro_id`, `first_name`, `last_name`, `pro_for`, `email`, `password`) VALUES
(19, ',mnkjhbkjn', 'mnbdjz ', 'Consultant', 'nbdvgaj@gmail.com', 'bf33a2540d8fe46f74afbcda467ee2cc271856ea'),
(20, 'sad/,lfjasf', 's,mnskjfsf', 'Consultant', 'amfiudhncL@gmail.com', 'bf33a2540d8fe46f74afbcda467ee2cc271856ea'),
(21, 'sad/,lfjasf', 's,mnskjfsf', 'Consultant', 'amfiudhncL@gmail.com', 'bf33a2540d8fe46f74afbcda467ee2cc271856ea'),
(22, 'fkjawnbfqjw f', 'nsjdngsjnf', 'Consultant', 'akmdfniahu@gmail.com', 'bf33a2540d8fe46f74afbcda467ee2cc271856ea'),
(23, 'sd,mfnsf', 'akjdbnsd', 'Consultant', 'emkk@gmail.com', 'bf33a2540d8fe46f74afbcda467ee2cc271856ea'),
(24, 'kkk', 'akjdhfd', 'Consultant', 'kmnc@gmail.com', 'bf33a2540d8fe46f74afbcda467ee2cc271856ea'),
(25, 'lllll', 'nbadfa', 'Consultant', 'Aasda@gmail.com', 'bf33a2540d8fe46f74afbcda467ee2cc271856ea'),
(26, 'kajwenfiawej', 'kjNDFINASDFJ', 'Consultant', 'JD@gmail.com', 'bf33a2540d8fe46f74afbcda467ee2cc271856ea'),
(27, 'palitha', 'wanigasekara', 'Consultant', 'aaa@gmail.com', 'bf33a2540d8fe46f74afbcda467ee2cc271856ea'),
(28, 'asdq', 'asdq', 'Consultant', 'aaa@gmail.com', 'bf33a2540d8fe46f74afbcda467ee2cc271856ea'),
(30, 'suranjith', 'udaynga', 'Consultant', 'suranith@gmail.com', 'bf33a2540d8fe46f74afbcda467ee2cc271856ea'),
(31, 'suranjith', 'qe', 'Consultant', 'leus@gmail.com', 'd622ad523f12e51559a3d00d5662398cbf5e0130');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`a_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`com_id`),
  ADD KEY `q_id` (`q_id`),
  ADD KEY `pro_id` (`pro_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`),
  ADD KEY `a_id` (`a_id`);

--
-- Indexes for table `general_users`
--
ALTER TABLE `general_users`
  ADD PRIMARY KEY (`guser_id`);

--
-- Indexes for table `organs`
--
ALTER TABLE `organs`
  ADD PRIMARY KEY (`org_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `pro_id` (`pro_id`);

--
-- Indexes for table `pro`
--
ALTER TABLE `pro`
  ADD PRIMARY KEY (`pro_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`q_id`) USING BTREE,
  ADD KEY `questions_ibfk_2` (`guser_id`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`pro_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `com_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=191;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `general_users`
--
ALTER TABLE `general_users`
  MODIFY `guser_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `organs`
--
ALTER TABLE `organs`
  MODIFY `org_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `pro`
--
ALTER TABLE `pro`
  MODIFY `pro_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `q_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `pro_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`q_id`) REFERENCES `questions` (`q_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`pro_id`) REFERENCES `pro` (`pro_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`a_id`) REFERENCES `admin` (`a_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`pro_id`) REFERENCES `pro` (`pro_id`);

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`guser_id`) REFERENCES `general_users` (`guser_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `questions_ibfk_2` FOREIGN KEY (`guser_id`) REFERENCES `general_users` (`guser_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
