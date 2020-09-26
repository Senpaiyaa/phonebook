-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 26, 2020 at 10:31 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.5.37

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phonebook`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `activity_id` int(11) NOT NULL,
  `user_activity` varchar(100) NOT NULL,
  `date_logged` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`activity_id`, `user_activity`, `date_logged`) VALUES
(1, 'Contact with name Erwin Ignacio  has been created.', '2020-09-26 15:47:01'),
(2, 'Contact with name Erwin Ignacio  has been updated.', '2020-09-26 15:47:35'),
(3, 'Contact with name Erwin Ignacio  has been updated.', '2020-09-26 15:50:21'),
(4, 'Contact with name Erwin Ignacio  has been updated.', '2020-09-26 15:51:29'),
(5, 'Contact with name Erwin Ignacio  has been updated.', '2020-09-26 15:51:55'),
(6, 'Contact with name Erwin Ignacio  has been updated.', '2020-09-26 15:52:54'),
(7, 'Contact with name Erwin Ignacio  has been updated.', '2020-09-26 15:55:38'),
(8, 'Contact with name John Doe  has been created.', '2020-09-26 15:59:37'),
(9, 'Contact with name Jane Doe  has been created.', '2020-09-26 16:03:29'),
(10, 'Contact with name John Doe  has been updated.', '2020-09-26 16:16:27'),
(11, 'Contact with name Jane Doe  has been updated.', '2020-09-26 16:16:32'),
(12, 'Contact with name John Roe  has been created.', '2020-09-26 16:17:42'),
(13, 'A contact with id 4 has been deleted.', '2020-09-26 16:19:43'),
(14, 'Contact with name Foo Bar  has been created.', '2020-09-26 16:20:33');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `contact_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact_number` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `path` text NOT NULL,
  `notes_id` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`contact_id`, `first_name`, `last_name`, `email`, `contact_number`, `address`, `path`, `notes_id`, `is_deleted`) VALUES
(1, 'Erwin', 'Ignacio', 'ignacioerwin00@gmail.com', '+639235449017', 'Grove St., home', 'uploads/IMG_20180510_071239.jpg', 3, 0),
(2, 'John', 'Doe', 'doe@email.com', '+639123456789', 'Yamagata, Japan', 'uploads/ec29edc4c1985d37614d6ceb53aead32.jpg', 4, 0),
(3, 'Jane', 'Doe', 'doejane@mail.com', '+639123456789', 'Queensland, Australia', 'uploads/d8a66738a955815f4eeac6d1ab8b2f0a.jpg', 4, 0),
(4, 'John', 'Roe', 'roe@email.com', '+123213123213', 'Quezon City, Philippines', 'uploads/damn.JPG', 0, 1),
(5, 'Foo', 'Bar', 'foo@mail.com', '+01234456789', 'Foo St., Barlands', 'uploads/bday.JPG', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `notes_id` int(11) NOT NULL,
  `contact_notes` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`notes_id`, `contact_notes`) VALUES
(1, 'None'),
(2, 'Classmate'),
(3, 'Administrator'),
(4, 'Staff');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`activity_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`notes_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `activity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `notes_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
