-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 22, 2019 at 10:33 PM
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
-- Table structure for table `tb_accounts`
--

CREATE TABLE `tb_accounts` (
  `coll_reg_no` varchar(30) NOT NULL,
  `coll_name` varchar(50) NOT NULL,
  `coll_location` varchar(50) NOT NULL,
  `coll_contact` varchar(50) NOT NULL,
  `coll_address` varchar(50) NOT NULL,
  `coll_sender` varchar(10) NOT NULL,
  `coll_status` enum('unactivated','activated','blocked') NOT NULL,
  `coll_logo` text NOT NULL,
  `coll_bg` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_accounts`
--

INSERT INTO `tb_accounts` (`coll_reg_no`, `coll_name`, `coll_location`, `coll_contact`, `coll_address`, `coll_sender`, `coll_status`, `coll_logo`, `coll_bg`) VALUES
('VET/DOM/PR/2017/C/057', 'Boboya East Africa College', 'Dodoma', '255714630000', 'Box Dodoma Tanzania', 'BEAC', 'activated', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_auth`
--

CREATE TABLE `tb_auth` (
  `auth` varchar(40) NOT NULL,
  `token` varchar(64) NOT NULL,
  `expire` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_auth`
--

INSERT INTO `tb_auth` (`auth`, `token`, `expire`) VALUES
('356a192b7913b04c54574d18c28d46e6395428ab', '220b105b97ffcce595f18953f116170ca66b3fcba785f4857c67ed30736bfe23', 1574490338);

-- --------------------------------------------------------

--
-- Table structure for table `tb_childcare_education`
--

CREATE TABLE `tb_childcare_education` (
  `std_id` varchar(30) NOT NULL,
  `month` int(2) NOT NULL,
  `year` int(4) NOT NULL,
  `status` enum('fresh','supp') NOT NULL,
  `type` enum('exam','test') NOT NULL,
  `CCE_0401` varchar(4) NOT NULL,
  `CCE_0402` varchar(4) NOT NULL,
  `CCE_0403` varchar(4) NOT NULL,
  `CCE_0404` varchar(4) NOT NULL,
  `CCE_0405` varchar(4) NOT NULL,
  `CCE_0406` varchar(4) NOT NULL,
  `CCE_0407` varchar(4) NOT NULL,
  `CCE_0408` varchar(4) NOT NULL,
  `CCE_0409` varchar(4) NOT NULL,
  `CCE_04010` varchar(4) NOT NULL,
  `CCE_04011` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Stand-in structure for view `tb_childcare_education_view`
-- (See below for the actual view)
--
CREATE TABLE `tb_childcare_education_view` (
`reg_no` varchar(30)
,`fname` varchar(20)
,`mname` varchar(20)
,`lname` varchar(20)
,`dob` varchar(12)
,`nationality` varchar(20)
,`gender` varchar(6)
,`mobile` varchar(13)
,`reg_date` varchar(12)
,`passport` text
,`std_id` varchar(30)
,`month` int(2)
,`year` int(4)
,`status` enum('fresh','supp')
,`type` enum('exam','test')
,`CCE_0401` varchar(4)
,`CCE_0402` varchar(4)
,`CCE_0403` varchar(4)
,`CCE_0404` varchar(4)
,`CCE_0405` varchar(4)
,`CCE_0406` varchar(4)
,`CCE_0407` varchar(4)
,`CCE_0408` varchar(4)
,`CCE_0409` varchar(4)
,`CCE_04010` varchar(4)
,`CCE_04011` varchar(4)
);

-- --------------------------------------------------------

--
-- Table structure for table `tb_course`
--

CREATE TABLE `tb_course` (
  `c_id` varchar(15) NOT NULL,
  `c_name` varchar(100) NOT NULL,
  `c_aka` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_course`
--

INSERT INTO `tb_course` (`c_id`, `c_name`, `c_aka`) VALUES
('CC_004', 'CUSTOMER CARE', 'CUSTOMER CARE'),
('CP_005', 'COMPUTER APPLICATIONS', 'COMPT APPLICATIONS'),
('E__C_002', 'ENGLISH LANGUAGE AND COMMUNICATION SKILLS', 'ENGLISH & COM/SKILLS'),
('FO_001', 'FRONT OFFICE OPERATIONS', 'FRONT OFFC OPERATIONS'),
('PR_006', 'PRACTICAL', 'PRACTICAL'),
('TM_003', 'TOURISM AND HOSPITALITY', 'TOURISM & HOSPITALITY');

-- --------------------------------------------------------

--
-- Stand-in structure for view `tb_course_view`
-- (See below for the actual view)
--
CREATE TABLE `tb_course_view` (
`c_id` varchar(15)
,`c_name` varchar(100)
,`c_aka` varchar(30)
,`prog_id` varchar(20)
,`name` varchar(100)
);

-- --------------------------------------------------------

--
-- Table structure for table `tb_hotel_mgt`
--

CREATE TABLE `tb_hotel_mgt` (
  `std_id` varchar(30) NOT NULL,
  `month` int(1) NOT NULL,
  `year` int(11) NOT NULL,
  `type` enum('exam','test') NOT NULL,
  `FO_001` varchar(4) NOT NULL,
  `E__C_002` varchar(4) NOT NULL,
  `TM_003` varchar(4) NOT NULL,
  `CC_004` varchar(4) NOT NULL,
  `CP_005` varchar(4) NOT NULL,
  `PR_006` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_hotel_mgt`
--

INSERT INTO `tb_hotel_mgt` (`std_id`, `month`, `year`, `type`, `FO_001`, `E__C_002`, `TM_003`, `CC_004`, `CP_005`, `PR_006`) VALUES
('BEATC/FO/01/013', 6, 2019, 'test', '56', '78', '54', '55', '90', '78'),
('BEATC/FO/01/013', 7, 2019, 'test', '85', '70', '90', '89', '72', '87'),
('BEATC/FO/01/013', 8, 2019, 'exam', '86', '100', '73', '45', '56', '80');

-- --------------------------------------------------------

--
-- Stand-in structure for view `tb_hotel_mgt_view`
-- (See below for the actual view)
--
CREATE TABLE `tb_hotel_mgt_view` (
`reg_no` varchar(30)
,`fname` varchar(20)
,`mname` varchar(20)
,`lname` varchar(20)
,`dob` varchar(12)
,`nationality` varchar(20)
,`gender` varchar(6)
,`mobile` varchar(13)
,`reg_date` varchar(12)
,`passport` text
,`month` int(1)
,`year` int(11)
,`type` enum('exam','test')
,`FO_001` varchar(4)
,`E__C_002` varchar(4)
,`TM_003` varchar(4)
,`CC_004` varchar(4)
,`CP_005` varchar(4)
,`PR_006` varchar(4)
);

-- --------------------------------------------------------

--
-- Table structure for table `tb_ict`
--

CREATE TABLE `tb_ict` (
  `std_id` varchar(30) NOT NULL,
  `month` int(2) NOT NULL,
  `year` int(4) NOT NULL,
  `status` enum('fresh','supp') NOT NULL,
  `type` enum('exam','test') NOT NULL,
  `ITT04101` varchar(4) NOT NULL,
  `ITT04102` varchar(4) NOT NULL,
  `ITT04103` varchar(4) NOT NULL,
  `ITT04104` varchar(4) NOT NULL,
  `ITT04105` varchar(4) NOT NULL,
  `ITT04206` varchar(4) NOT NULL,
  `ITT04207` varchar(4) NOT NULL,
  `ITT04208` varchar(4) NOT NULL,
  `ITT04209` varchar(4) NOT NULL,
  `ITT042010` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Stand-in structure for view `tb_ict_view`
-- (See below for the actual view)
--
CREATE TABLE `tb_ict_view` (
`reg_no` varchar(30)
,`fname` varchar(20)
,`mname` varchar(20)
,`lname` varchar(20)
,`dob` varchar(12)
,`nationality` varchar(20)
,`gender` varchar(6)
,`mobile` varchar(13)
,`reg_date` varchar(12)
,`passport` text
,`std_id` varchar(30)
,`month` int(2)
,`year` int(4)
,`status` enum('fresh','supp')
,`type` enum('exam','test')
,`ITT04101` varchar(4)
,`ITT04102` varchar(4)
,`ITT04103` varchar(4)
,`ITT04104` varchar(4)
,`ITT04105` varchar(4)
,`ITT04206` varchar(4)
,`ITT04207` varchar(4)
,`ITT04208` varchar(4)
,`ITT04209` varchar(4)
,`ITT042010` varchar(4)
);

-- --------------------------------------------------------

--
-- Table structure for table `tb_program`
--

CREATE TABLE `tb_program` (
  `prog_id` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_program`
--

INSERT INTO `tb_program` (`prog_id`, `name`) VALUES
('PROG005', 'Information & Communication Technology'),
('PROG006', 'Childcare & Education '),
('PROG007', 'Front office operations in hotel management');

-- --------------------------------------------------------

--
-- Table structure for table `tb_program_course`
--

CREATE TABLE `tb_program_course` (
  `program_id` varchar(15) NOT NULL,
  `course_id` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_program_course`
--

INSERT INTO `tb_program_course` (`program_id`, `course_id`) VALUES
('PROG007', 'CC_004'),
('PROG007', 'CP_005'),
('PROG007', 'E__C_002'),
('PROG007', 'FO_001'),
('PROG007', 'PR_006'),
('PROG007', 'TM_003');

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
('00af7bb4-7de0-4d16-8131-d71771', 'BEAC/EL/01/002', '255718409291', 'REGNO:BEAC/EL/01/002, CS101:73, CS102:69, CS103:44, CS104:60, AVR:61.5, GRADE:B, POS:3.', '28-10-2019 12:19:51', 'sent', '1701', '1'),
('1236d8f4-afe6-487f-8242-dc234b', 'BEAC/EL/01/001', '255718617461', 'REGNO:BEAC/EL/01/001, CS101:63, CS102:57, CS103:50, CS104:80, AVR:62.5, GRADE:B+, POS:2.', '13-10-2019 03:34:18', 'sent', '1701', '1'),
('43af107a-d20e-4195-a5bb-b770e3', 'BEAC/EL/01/001', '255718617461', 'REGNO:BEAC/EL/01/001, CS101:63, CS102:57, CS103:50, CS104:80, AVR:62.5, GRADE:B+, POS:2.', '09-11-2019 15:26:04', 'sent', '1701', '1'),
('8aef65b0-1ccc-4b25-a1a7-e35a55', 'T/UDOM/2018/09568', '255745306581', 'REGNO:T/UDOM/2018/09568, CS101:90, CS102:65, CS103:74, CS104:80, AVR:77.25, GRADE:A, POS:1.', '13-10-2019 05:36:45', 'sent', '1701', '1'),
('a347fe17-541a-4985-8230-1393dd', 'BEAC/EL/01/001', '255718617461', 'REGNO:BEAC/EL/01/001, CS101:63, CS102:57, CS103:50, CS104:80, AVR:62.5, GRADE:B+, POS:2.', '27-10-2019 14:11:04', 'sent', '1701', '1'),
('e484a51f-656b-4740-a08f-533aa8', 'BEAC/EL/01/003', '255655007457', 'REGNO:BEAC/EL/01/003, CS101:89, CS102:50, CS103:78, CS104:90, AVR:76.8, GRADE:A, POS:1.', '13-10-2019 03:27:14', 'sent', '1701', '1'),
('fa9ddec3-6462-4b46-869f-a53298', 'BEAC/EL/01/001', '255718617461', 'REGNO:BEAC/EL/01/001, CS101:63, CS102:57, CS103:50, CS104:80, AVR:62.5, GRADE:B+, POS:2.', '13-10-2019 03:27:46', 'sent', '1701', '1');

-- --------------------------------------------------------

--
-- Stand-in structure for view `tb_sms_view`
-- (See below for the actual view)
--
CREATE TABLE `tb_sms_view` (
`fname` varchar(20)
,`mname` varchar(20)
,`lname` varchar(20)
,`sms_id` varchar(30)
,`reg_no` varchar(30)
,`mobile` varchar(15)
,`message` text
,`time` varchar(20)
,`status` enum('sent','failed')
,`s_code` varchar(4)
,`coll_id` varchar(10)
);

-- --------------------------------------------------------

--
-- Table structure for table `tb_student`
--

CREATE TABLE `tb_student` (
  `reg_no` varchar(30) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `mname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `dob` varchar(12) NOT NULL,
  `nationality` varchar(20) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `mobile` varchar(13) NOT NULL,
  `reg_date` varchar(12) NOT NULL,
  `passport` text NOT NULL,
  `program_id` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_student`
--

INSERT INTO `tb_student` (`reg_no`, `fname`, `mname`, `lname`, `dob`, `nationality`, `gender`, `mobile`, `reg_date`, `passport`, `program_id`) VALUES
('BEAC/EL/01/001', 'ODILO', 'ANDREA', 'AMMA', '30.7.1997', 'Tanzanian', 'Male', '0655007457', '15.08.2018', '', 'PROG007'),
('BEATC/FO/01/013', 'SOPHIA', 'JOHN', 'JOSEPH', '23.02.2001', 'Tanzanian', 'female', '0718617461', '15.08.2018', '', 'PROG007');

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
  `call_number` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_users`
--

INSERT INTO `tb_users` (`user_id`, `username`, `fname`, `lname`, `password`, `hash`, `call_number`) VALUES
(1, 'Betets1@outlook.com', 'Amos', 'Maombi', '38481e5bf4a001625edf55f357ff2dee164518f9ee00d7d4ee76dd72112e5744', 'fbc3a2f5633da299b0fc3e88b30c51ecb2a05b42a48ef936173585c1509bb718', 'VET/DOM/PR/2017/C/057'),
(3, 'info@sms.com', 'Kulwa', 'Josephat', 'df1b35510099cc29401cef252919165abf59ce2b4cc66e7c88898da66751bcf1', 'b7c81ae1ee5dcaafb377f8dbadaddd5afd757056c69757a0a011e5bf4327af73', 'VET/DOM/PR/2017/C/057');

-- --------------------------------------------------------

--
-- Structure for view `tb_childcare_education_view`
--
DROP TABLE IF EXISTS `tb_childcare_education_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tb_childcare_education_view`  AS  select `tb_student`.`reg_no` AS `reg_no`,`tb_student`.`fname` AS `fname`,`tb_student`.`mname` AS `mname`,`tb_student`.`lname` AS `lname`,`tb_student`.`dob` AS `dob`,`tb_student`.`nationality` AS `nationality`,`tb_student`.`gender` AS `gender`,`tb_student`.`mobile` AS `mobile`,`tb_student`.`reg_date` AS `reg_date`,`tb_student`.`passport` AS `passport`,`tb_childcare_education`.`std_id` AS `std_id`,`tb_childcare_education`.`month` AS `month`,`tb_childcare_education`.`year` AS `year`,`tb_childcare_education`.`status` AS `status`,`tb_childcare_education`.`type` AS `type`,`tb_childcare_education`.`CCE_0401` AS `CCE_0401`,`tb_childcare_education`.`CCE_0402` AS `CCE_0402`,`tb_childcare_education`.`CCE_0403` AS `CCE_0403`,`tb_childcare_education`.`CCE_0404` AS `CCE_0404`,`tb_childcare_education`.`CCE_0405` AS `CCE_0405`,`tb_childcare_education`.`CCE_0406` AS `CCE_0406`,`tb_childcare_education`.`CCE_0407` AS `CCE_0407`,`tb_childcare_education`.`CCE_0408` AS `CCE_0408`,`tb_childcare_education`.`CCE_0409` AS `CCE_0409`,`tb_childcare_education`.`CCE_04010` AS `CCE_04010`,`tb_childcare_education`.`CCE_04011` AS `CCE_04011` from (`tb_student` join `tb_childcare_education`) where (`tb_student`.`reg_no` = `tb_childcare_education`.`std_id`) ;

-- --------------------------------------------------------

--
-- Structure for view `tb_course_view`
--
DROP TABLE IF EXISTS `tb_course_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tb_course_view`  AS  select `tb_course`.`c_id` AS `c_id`,`tb_course`.`c_name` AS `c_name`,`tb_course`.`c_aka` AS `c_aka`,`tb_program`.`prog_id` AS `prog_id`,`tb_program`.`name` AS `name` from ((`tb_program` join `tb_program_course`) join `tb_course`) where ((`tb_program`.`prog_id` = `tb_program_course`.`program_id`) and (`tb_course`.`c_id` = `tb_program_course`.`course_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `tb_hotel_mgt_view`
--
DROP TABLE IF EXISTS `tb_hotel_mgt_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tb_hotel_mgt_view`  AS  select `tb_student`.`reg_no` AS `reg_no`,`tb_student`.`fname` AS `fname`,`tb_student`.`mname` AS `mname`,`tb_student`.`lname` AS `lname`,`tb_student`.`dob` AS `dob`,`tb_student`.`nationality` AS `nationality`,`tb_student`.`gender` AS `gender`,`tb_student`.`mobile` AS `mobile`,`tb_student`.`reg_date` AS `reg_date`,`tb_student`.`passport` AS `passport`,`tb_hotel_mgt`.`month` AS `month`,`tb_hotel_mgt`.`year` AS `year`,`tb_hotel_mgt`.`type` AS `type`,`tb_hotel_mgt`.`FO_001` AS `FO_001`,`tb_hotel_mgt`.`E__C_002` AS `E__C_002`,`tb_hotel_mgt`.`TM_003` AS `TM_003`,`tb_hotel_mgt`.`CC_004` AS `CC_004`,`tb_hotel_mgt`.`CP_005` AS `CP_005`,`tb_hotel_mgt`.`PR_006` AS `PR_006` from (`tb_student` join `tb_hotel_mgt`) where (`tb_student`.`reg_no` = `tb_hotel_mgt`.`std_id`) ;

-- --------------------------------------------------------

--
-- Structure for view `tb_ict_view`
--
DROP TABLE IF EXISTS `tb_ict_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tb_ict_view`  AS  select `tb_student`.`reg_no` AS `reg_no`,`tb_student`.`fname` AS `fname`,`tb_student`.`mname` AS `mname`,`tb_student`.`lname` AS `lname`,`tb_student`.`dob` AS `dob`,`tb_student`.`nationality` AS `nationality`,`tb_student`.`gender` AS `gender`,`tb_student`.`mobile` AS `mobile`,`tb_student`.`reg_date` AS `reg_date`,`tb_student`.`passport` AS `passport`,`tb_ict`.`std_id` AS `std_id`,`tb_ict`.`month` AS `month`,`tb_ict`.`year` AS `year`,`tb_ict`.`status` AS `status`,`tb_ict`.`type` AS `type`,`tb_ict`.`ITT04101` AS `ITT04101`,`tb_ict`.`ITT04102` AS `ITT04102`,`tb_ict`.`ITT04103` AS `ITT04103`,`tb_ict`.`ITT04104` AS `ITT04104`,`tb_ict`.`ITT04105` AS `ITT04105`,`tb_ict`.`ITT04206` AS `ITT04206`,`tb_ict`.`ITT04207` AS `ITT04207`,`tb_ict`.`ITT04208` AS `ITT04208`,`tb_ict`.`ITT04209` AS `ITT04209`,`tb_ict`.`ITT042010` AS `ITT042010` from (`tb_student` join `tb_ict`) where (`tb_student`.`reg_no` = `tb_ict`.`std_id`) ;

-- --------------------------------------------------------

--
-- Structure for view `tb_sms_view`
--
DROP TABLE IF EXISTS `tb_sms_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tb_sms_view`  AS  select `s`.`fname` AS `fname`,`s`.`mname` AS `mname`,`s`.`lname` AS `lname`,`t`.`sms_id` AS `sms_id`,`s`.`reg_no` AS `reg_no`,`t`.`mobile` AS `mobile`,`t`.`message` AS `message`,`t`.`time` AS `time`,`t`.`status` AS `status`,`t`.`s_code` AS `s_code`,`t`.`coll_id` AS `coll_id` from (`tb_student` `s` join `tb_sms` `t`) where (`s`.`reg_no` = `t`.`reg_no`) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_accounts`
--
ALTER TABLE `tb_accounts`
  ADD PRIMARY KEY (`coll_reg_no`);

--
-- Indexes for table `tb_auth`
--
ALTER TABLE `tb_auth`
  ADD PRIMARY KEY (`auth`);

--
-- Indexes for table `tb_childcare_education`
--
ALTER TABLE `tb_childcare_education`
  ADD PRIMARY KEY (`std_id`,`month`,`year`);

--
-- Indexes for table `tb_course`
--
ALTER TABLE `tb_course`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `tb_hotel_mgt`
--
ALTER TABLE `tb_hotel_mgt`
  ADD PRIMARY KEY (`std_id`,`month`,`year`);

--
-- Indexes for table `tb_ict`
--
ALTER TABLE `tb_ict`
  ADD PRIMARY KEY (`std_id`,`month`,`year`);

--
-- Indexes for table `tb_program`
--
ALTER TABLE `tb_program`
  ADD PRIMARY KEY (`prog_id`);

--
-- Indexes for table `tb_program_course`
--
ALTER TABLE `tb_program_course`
  ADD PRIMARY KEY (`program_id`,`course_id`);

--
-- Indexes for table `tb_sms`
--
ALTER TABLE `tb_sms`
  ADD PRIMARY KEY (`sms_id`);

--
-- Indexes for table `tb_student`
--
ALTER TABLE `tb_student`
  ADD PRIMARY KEY (`reg_no`);

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
