-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 10, 2019 at 05:39 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_sms`
--

CREATE TABLE `tb_sms` (
  `sms_id` varchar(30) NOT NULL,
  `reg_no` varchar(30) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `message` text NOT NULL,
  `time` varchar(20) NOT NULL,
  `status` enum('sent','failed') NOT NULL,
  `s_code` varchar(4) NOT NULL,
  `coll_id` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_sms`
--

INSERT INTO `tb_sms` (`sms_id`, `reg_no`, `mobile`, `message`, `time`, `status`, `s_code`, `coll_id`) VALUES
('d5af18fb-fd8a-4fe0-bd18-16d0f4', 'BEAC/EL/01/001', '255718617461', 'REGNO:BEAC/EL/01/001, CS101:53, CS102:13, CS103:34, CS104:34, AVR:33, GRADE:C, POS:3.', '10-10-2019 16:54:31', 'sent', '1701', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tb_users`
--

CREATE TABLE `tb_users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `password` varchar(64) NOT NULL,
  `hash` varchar(64) NOT NULL,
  `call_number` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_users`
--

INSERT INTO `tb_users` (`user_id`, `username`, `fname`, `lname`, `password`, `hash`, `call_number`) VALUES
(1, 'Betets1@outlook.com', 'Amos', 'Maombi', 'be6d297260c716c23e137cf7bbf77dafc1faf25b1da2f79d506d6d3f8945dfa6', '322eec51408916e71dccd621859f9fae62b000606952a24245407e822c6d7d62', '0'),
(3, 'info@sms.com', 'Kulwa', 'Josephat', 'df1b35510099cc29401cef252919165abf59ce2b4cc66e7c88898da66751bcf1', 'b7c81ae1ee5dcaafb377f8dbadaddd5afd757056c69757a0a011e5bf4327af73', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_sms`
--
ALTER TABLE `tb_sms`
  ADD PRIMARY KEY (`sms_id`);

--
-- Indexes for table `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
