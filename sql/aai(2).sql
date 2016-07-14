-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2015 at 03:41 AM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `aai`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE IF NOT EXISTS `brand` (
  `brand_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `brand_name` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`brand_id`, `client_id`, `brand_name`) VALUES
(1, 1, 'cloudwalk'),
(2, 3, 'photolive'),
(3, 1, 'littleweight');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `client_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `company_name` text NOT NULL,
  `contact_person` text NOT NULL,
  `contact_number` text NOT NULL,
  `birth_date` date NOT NULL,
  `email` text NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`client_id`, `emp_id`, `company_name`, `contact_person`, `contact_number`, `birth_date`, `email`, `date_created`) VALUES
(1, 20150001, 'Cloudwalk', 'Roel', '414-4014', '1991-04-05', 'roel.r@cloudwalkdigital.com', '2015-12-02 00:00:00'),
(3, 20150001, 'Light Weight Solutions', 'Laiza Musa', '09093408707', '1993-12-19', 'laiza.m@cloudwalkdigital.com', '2015-12-02 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE IF NOT EXISTS `departments` (
  `dept_id` int(11) NOT NULL,
  `department_name` text NOT NULL,
  `date_created` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`dept_id`, `department_name`, `date_created`) VALUES
(1, 'admin', '2015-12-08'),
(2, 'account executive', '2015-12-08'),
(3, 'accounting', '2015-12-08'),
(4, 'activations', '2015-12-08'),
(5, 'hr', '2015-12-08'),
(6, 'operations', '2015-12-08'),
(7, 'production', '2015-12-08'),
(8, 'purchase/inventory', '2015-12-08'),
(9, 'set-up/logistics', '2015-12-08');

-- --------------------------------------------------------

--
-- Table structure for table `employee_list`
--

CREATE TABLE IF NOT EXISTS `employee_list` (
  `id` int(11) NOT NULL,
  `emp_id` int(10) NOT NULL,
  `role_type` text NOT NULL,
  `email` text NOT NULL,
  `emp_pass` text NOT NULL,
  `first_name` text NOT NULL,
  `sur_name` text NOT NULL,
  `middle_name` text NOT NULL,
  `birth_date` text NOT NULL,
  `street` text,
  `barangay` text,
  `city` text,
  `province` text,
  `department` text NOT NULL,
  `position` text NOT NULL,
  `status` text NOT NULL,
  `date_hired` text NOT NULL,
  `last_login` text NOT NULL,
  `img_loc` text,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_list`
--

INSERT INTO `employee_list` (`id`, `emp_id`, `role_type`, `email`, `emp_pass`, `first_name`, `sur_name`, `middle_name`, `birth_date`, `street`, `barangay`, `city`, `province`, `department`, `position`, `status`, `date_hired`, `last_login`, `img_loc`, `date_created`) VALUES
(1, 20150001, 'admin', 'roel.r@cloudwalkdigital.com', 'a618f27b5ef53fdc64acf27234730498', 'Little', 'Inc', 'Wieght', '04-05-1991', 'Kamuning', 'Kamuning', 'Quezon City', 'Quezon City', '1', '1', 'Hired', '11-24-2015', '', 'a.png', '2015-11-16 14:43:23'),
(2, 20150002, 'employee', 'chabi050613@gmail.com', 'a618f27b5ef53fdc64acf27234730498', 'Laiza', 'Musa', 'Manforte', '12-19-1993', 'Roque', 'Pasong Tamo', 'Quezon City', 'NCR', '2', '2', 'Hired', '12-8-2015', '', NULL, '2015-12-08 10:15:48'),
(3, 2015000003, 'admin', 'roelrosil1705@gmail.com', 'dbe25c05afd5751bcebf9b1f0f64eb34', 'Roel', 'Rosil', 'Nanar', '05-04-1991', NULL, NULL, NULL, NULL, '3', '1', 'Hired', '12-09-2015', '', NULL, '0000-00-00 00:00:00'),
(4, 2015000004, 'admin', 'khero_hhmm_14@yahoo.com', 'dbe25c05afd5751bcebf9b1f0f64eb34', 'Laizel', 'Rosil', 'Musa', '19-12-1993', NULL, NULL, NULL, NULL, '2', '1', 'Hired', '12-09-2015', '', NULL, '0000-00-00 00:00:00'),
(5, 2015000005, 'employee', 'sephiroth_1705@hotmail.com', 'dbe25c05afd5751bcebf9b1f0f64eb34', 'Roza', 'Rosil', 'Musa', '19-12-1999', NULL, NULL, NULL, NULL, '4', '2', 'Hired', '12-09-2015', '', NULL, '0000-00-00 00:00:00'),
(6, 2015000006, 'employee', 'hbg@yahoo.com', 'dbe25c05afd5751bcebf9b1f0f64eb34', 'Henry', 'Gasga', 'B', '14-12-2015', NULL, NULL, NULL, NULL, '2', '2', 'Evaluation', '12-09-2015', '', NULL, '0000-00-00 00:00:00'),
(7, 2015000007, 'admin', 'mm@medix.ph', 'dbe25c05afd5751bcebf9b1f0f64eb34', 'Marc', 'Medina', 'G', '04-06-1985', NULL, NULL, NULL, NULL, '1', '1', 'Hired', '12-10-2015', '', NULL, '0000-00-00 00:00:00'),
(8, 2015000008, 'employee', 'roel.r@cloudwalkdigital.com', 'dbe25c05afd5751bcebf9b1f0f64eb34', 'hjkhkhk', 'rythhngt', 'hjkhjkh', '02-12-2015', NULL, NULL, NULL, NULL, '2', '2', 'Evaluation', '12-11-2015', '', NULL, '0000-00-00 00:00:00'),
(9, 2015000009, 'admin', 'roel.r@cloudwalkdigital.com', 'dbe25c05afd5751bcebf9b1f0f64eb34', 'hyukjl', 'lkjkjljkl', 'kljljkklj', '06-12-1993', NULL, NULL, NULL, NULL, '2', '2', 'Evaluation', '12-11-2015', '', NULL, '0000-00-00 00:00:00'),
(10, 2015000010, 'employee', 'roel.r@cloudwalkdigital.com', 'dbe25c05afd5751bcebf9b1f0f64eb34', 'vbnvnvb', 'gfyfvgy', 'vbnvbnf', '15-12-2015', NULL, NULL, NULL, NULL, '2', '2', 'Evaluation', '12-11-2015', '', NULL, '0000-00-00 00:00:00'),
(11, 2015000011, 'admin', 'roel.r@cloudwalkdigital.com', 'dbe25c05afd5751bcebf9b1f0f64eb34', 'bvnbvnbv', 'vbnbnbv', 'vbnbvnbv', '01-12-1991', NULL, NULL, NULL, NULL, '3', '1', 'Evaluation', '12-11-2015', '', NULL, '0000-00-00 00:00:00'),
(12, 2015000012, 'admin', 'roel.r@cloudwalkdigital.com', 'dbe25c05afd5751bcebf9b1f0f64eb34', 'qwe', 'tyutyu', 'tert', '03-12-2015', NULL, NULL, NULL, NULL, '3', '2', 'Evaluation', '12-11-2015', '', NULL, '0000-00-00 00:00:00'),
(13, 2015000013, 'admin', 'roel.r@cloudwalkdigital.com', 'dbe25c05afd5751bcebf9b1f0f64eb34', 'nm', 'rr', 'nm', '01-12-2015', NULL, NULL, NULL, NULL, '2', '1', 'Hired', '12-11-2015', '', NULL, '0000-00-00 00:00:00'),
(14, 2015000014, 'employee', 'roel.r@cloudwalkdigital.com', 'dbe25c05afd5751bcebf9b1f0f64eb34', 'la', 'za', 'i', '01-12-2015', NULL, NULL, NULL, NULL, '3', '2', 'Hired', '12-11-2015', '', NULL, '0000-00-00 00:00:00'),
(15, 2015000015, 'admin', 'v@m.com', 'dbe25c05afd5751bcebf9b1f0f64eb34', 'nmvnvb', 'vbnvbnvb', 'vbnvbnvbn', '01-12-2015', NULL, NULL, NULL, NULL, '2', '1', 'Hired', '12-11-2015', '', NULL, '0000-00-00 00:00:00'),
(16, 2015000016, 'employee', 'hbg@yahoo.com', 'dbe25c05afd5751bcebf9b1f0f64eb34', 'Henry', 'Gasga', 'Bryan', '03-12-2015', NULL, NULL, NULL, NULL, '3', '2', 'hired', '12-11-2015', '', NULL, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `event_animation_details`
--

CREATE TABLE IF NOT EXISTS `event_animation_details` (
  `ad_id` int(11) NOT NULL,
  `ed_id` int(11) NOT NULL,
  `particulars` text NOT NULL,
  `target_activity` text NOT NULL,
  `target_schedule` text NOT NULL,
  `selling` int(11) DEFAULT NULL,
  `flyering` int(11) DEFAULT NULL,
  `survey` int(11) DEFAULT NULL,
  `experiment` int(11) DEFAULT NULL,
  `other` int(11) DEFAULT NULL,
  `target_date` datetime DEFAULT NULL,
  `duration` text,
  `num_of_areas` text,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `event_detail_list`
--

CREATE TABLE IF NOT EXISTS `event_detail_list` (
  `ed_id` int(11) NOT NULL,
  `jo_id` int(11) NOT NULL,
  `what` text NOT NULL,
  `what_add_notes` text,
  `when` text NOT NULL,
  `when_add_notes` text,
  `where` text NOT NULL,
  `where_add_notes` text,
  `expected_guest` int(11) NOT NULL,
  `event_specification` int(11) DEFAULT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `event_requirement`
--

CREATE TABLE IF NOT EXISTS `event_requirement` (
  `req_id` int(11) NOT NULL,
  `ed_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `deliverables` text,
  `deadline` text,
  `next_steps` text,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `job_order_list`
--

CREATE TABLE IF NOT EXISTS `job_order_list` (
  `jo_id` int(11) NOT NULL,
  `jo_number` int(11) DEFAULT NULL,
  `emp_id` int(11) NOT NULL,
  `do_contract_no` text,
  `project_name` text NOT NULL,
  `project_type` text NOT NULL,
  `client_company_name` text NOT NULL,
  `brand` text NOT NULL,
  `billed_date` text,
  `paid_date` text,
  `date_created` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `job_order_list`
--

INSERT INTO `job_order_list` (`jo_id`, `jo_number`, `emp_id`, `do_contract_no`, `project_name`, `project_type`, `client_company_name`, `brand`, `billed_date`, `paid_date`, `date_created`) VALUES
(1, 20150001, 20150001, NULL, 'Luna', 'Ambient', '1', '1', NULL, NULL, '2015-12-02 00:00:00'),
(2, 20150002, 20150001, NULL, 'Test', 'Sampling', '1', '1', NULL, NULL, '0000-00-00 00:00:00'),
(3, 20150003, 20150001, NULL, 'test', 'Events', '3', '2', NULL, NULL, '0000-00-00 00:00:00'),
(4, 2015000004, 20150001, NULL, 'necktie', 'Tie ups', '1', '1', NULL, NULL, '0000-00-00 00:00:00'),
(5, 2015000005, 20150001, NULL, 'West', 'Events', '1', '1', NULL, NULL, '12-02-2015 07:36:55'),
(6, 2015000006, 20150001, NULL, 'East', 'Acti', '3', '3', NULL, NULL, '12-02-2015 07:38:41'),
(7, 2015000007, 20150001, NULL, 'North', 'Samp', '1', '1', NULL, NULL, '12-02-2015 07:40:00'),
(8, 2015000008, 20150001, NULL, 'ccccc', 'Act', '1', '1', NULL, NULL, '12-02-2015 07:40:56'),
(9, 2015000009, 20150001, NULL, 'fghfhfghfghfgh', 'asasas', '1', '1', NULL, NULL, '12-02-2015 07:46:46'),
(10, 2015000010, 20150001, NULL, 'hgfhf', 'wasada', '1', '1', NULL, NULL, '12-02-2015 08:06:38'),
(11, 2015000011, 20150001, NULL, 'dgfhfh', 'sdfsdf', '3', '3', NULL, NULL, '12-02-2015 08:07:17'),
(12, 2015000012, 20150001, NULL, 'asd', 'hfghfhfghfghg', '3', '3', NULL, NULL, '12-02-2015 08:08:44'),
(13, 2015000013, 20150001, NULL, 'hfghf', 'hgjhgjgh', '3', '3', NULL, NULL, '12-02-2015 08:09:15'),
(14, 2015000014, 20150001, NULL, 'South', 'Evvv', '3', '3', NULL, NULL, '12-02-2015 08:17:39'),
(15, 2015000015, 20150001, NULL, 'NE', 'hgjhgjhg', '3', '3', NULL, NULL, '12-02-2015 08:18:46'),
(16, 2015000016, 20150001, NULL, 'jhkjhkh', 'Heart', '1', '1', NULL, NULL, '12-02-2015 08:25:20'),
(17, 2015000017, 20150001, NULL, 'hjhgjghj', 'ytut', '1', '1', NULL, NULL, '12-02-2015 08:26:14'),
(18, 2015000018, 20150001, NULL, 'hjkhkhjkh', 'ghjhhk', '3', '3', NULL, NULL, '12-02-2015 08:26:36'),
(19, 2015000019, 20150001, NULL, 'hfghfgjh', 'fsdfdf', '3', '3', NULL, NULL, '12-09-2015 06:21:39'),
(20, 201500020, 20150001, NULL, 'cloudwalk', 'Sampling', '1', '1', NULL, NULL, '12-11-2015 04:13:13'),
(21, 201500021, 20150001, NULL, 'afff', 'test', '1', '1', NULL, NULL, '12-11-2015 06:43:10'),
(22, 201500022, 20150001, NULL, 'ttttt', 'hgffhf', '3', '3', NULL, NULL, '12-11-2015 08:45:51'),
(23, 201500023, 20150001, NULL, 'name', 'Events', '3', '3', NULL, NULL, '12-11-2015 10:34:43');

-- --------------------------------------------------------

--
-- Table structure for table `jo_other`
--

CREATE TABLE IF NOT EXISTS `jo_other` (
  `other_id` int(11) NOT NULL,
  `jo_id` int(11) NOT NULL,
  `text` text NOT NULL,
  `date_created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mom_list`
--

CREATE TABLE IF NOT EXISTS `mom_list` (
  `mom_id` int(11) NOT NULL,
  `jo_id` int(11) NOT NULL,
  `attendees` text NOT NULL,
  `agenda` text NOT NULL,
  `mom_date` text NOT NULL,
  `mom_time` time NOT NULL,
  `location` text NOT NULL,
  `what` text NOT NULL,
  `what_add_notes` text NOT NULL,
  `when` text NOT NULL,
  `when_add_notes` text NOT NULL,
  `where` text NOT NULL,
  `where_add_notes` text NOT NULL,
  `expected_guest` text NOT NULL,
  `campaign_text` text,
  `act_flow_text` text,
  `other_details` text,
  `nsd` text,
  `date_created` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mom_list`
--

INSERT INTO `mom_list` (`mom_id`, `jo_id`, `attendees`, `agenda`, `mom_date`, `mom_time`, `location`, `what`, `what_add_notes`, `when`, `when_add_notes`, `where`, `where_add_notes`, `expected_guest`, `campaign_text`, `act_flow_text`, `other_details`, `nsd`, `date_created`) VALUES
(1, 1, '12', 'PhotoLive', '2015-12-17 03:00:00', '00:00:00', 'Cloudwalk', 'what', 'what notes', 'when', 'when notes', 'where', 'where notes', '12', '', '', '', '', '2015-12-16 11:47:21'),
(2, 1, '12', 'PhotoLive', '2015-12-17 03:00:00', '00:00:00', 'Cloudwalk', 'what', 'what notes', 'when', 'when notes', 'where', 'where notes', '12', '&lt;p&gt;camp&lt;/p&gt;\n', '&lt;p&gt;activation flow&lt;/p&gt;\n', '&lt;p&gt;Detail&lt;/p&gt;\n', '&lt;p&gt;Steps&lt;/p&gt;\n', '2015-12-16 11:47:29'),
(3, 1, '122', 'test', '2015-12-18 04:12:22', '00:00:00', 'qc', 'asdasd', 'sgfdg', 'qwe', 'sadfdsf', 'qwe', 'sdfdg', '122', '', '', '', '', '2015-12-16 13:07:07'),
(4, 1, '122', 'test', '2015-12-18 04:12:22', '00:00:00', 'qc', 'asdasd', 'sgfdg', 'qwe', 'sadfdsf', 'qwe', 'sdfdg', '122', '&lt;p&gt;camp&lt;/p&gt;\n', '&lt;p&gt;act&lt;/p&gt;\n', '&lt;p&gt;details&lt;/p&gt;\n', '&lt;p&gt;nsd&lt;/p&gt;\n', '2015-12-16 13:07:15'),
(5, 1, '12', 'test', '2015-12-19 07:00', '00:00:00', 'QC', 'what', 'what note', 'when', 'when note', 'where', 'where note', '12', '<p>xcvxcv</p>\n', '<p>qweqwe</p>\n', '<p>qaazaq</p>\n', '<p>asdasd</p>\n', '2015-12-16 13:58:25');

-- --------------------------------------------------------

--
-- Table structure for table `mom_notes`
--

CREATE TABLE IF NOT EXISTS `mom_notes` (
  `mom_ed_id` int(11) NOT NULL,
  `mom_id` int(11) NOT NULL,
  `what` text NOT NULL,
  `what_add_notes` text,
  `when` text NOT NULL,
  `when_add_notes` text,
  `where` text NOT NULL,
  `where_add_notes` text,
  `campaign_text` text,
  `act_flow_text` text,
  `other_details` text,
  `nsd` text,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mvrf`
--

CREATE TABLE IF NOT EXISTS `mvrf` (
  `mvrf_id` int(11) NOT NULL,
  `jo_id` int(11) NOT NULL,
  `when` text NOT NULL,
  `where` text NOT NULL,
  `num_of_teams` int(11) DEFAULT NULL,
  `attire` text,
  `date_created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mvrf_manpower`
--

CREATE TABLE IF NOT EXISTS `mvrf_manpower` (
  `manpower_id` int(11) NOT NULL,
  `mvrf_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `designation` text NOT NULL,
  `specification` text NOT NULL,
  `rate` text NOT NULL,
  `venue` text,
  `date_created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mvrf_vehicle`
--

CREATE TABLE IF NOT EXISTS `mvrf_vehicle` (
  `vehicle_id` int(11) NOT NULL,
  `mvrf_id` int(11) NOT NULL,
  `vehicle_type` text NOT NULL,
  `qty` int(11) NOT NULL,
  `designation` text NOT NULL,
  `specification` text NOT NULL,
  `rate` text NOT NULL,
  `venue` text NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE IF NOT EXISTS `positions` (
  `position_id` int(11) NOT NULL,
  `position_name` text NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`position_id`, `position_name`, `date_created`) VALUES
(1, 'manager', '2015-12-08 00:00:00'),
(2, 'staff', '2015-12-08 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `project_attachments`
--

CREATE TABLE IF NOT EXISTS `project_attachments` (
  `attachment_id` int(11) NOT NULL,
  `jo_id` int(11) NOT NULL,
  `file_name` text NOT NULL,
  `file_location` text NOT NULL,
  `reference_for` text NOT NULL,
  `date_uploaded` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `setup_images`
--

CREATE TABLE IF NOT EXISTS `setup_images` (
  `img_id` int(11) NOT NULL,
  `setup_id` int(11) NOT NULL,
  `img_loc` text NOT NULL,
  `date_created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `setup_particulars`
--

CREATE TABLE IF NOT EXISTS `setup_particulars` (
  `particular_id` int(11) NOT NULL,
  `pt_id` int(11) NOT NULL,
  `particulars` text NOT NULL,
  `qty` text NOT NULL,
  `details` text,
  `point_person` text NOT NULL,
  `date_created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `setup_particular_title`
--

CREATE TABLE IF NOT EXISTS `setup_particular_title` (
  `pt_id` int(11) NOT NULL,
  `setup_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `date_created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `set_up_details`
--

CREATE TABLE IF NOT EXISTS `set_up_details` (
  `setup_id` int(11) NOT NULL,
  `jo_id` int(11) NOT NULL,
  `num_of_teams` int(11) DEFAULT NULL,
  `setup_date` date DEFAULT NULL,
  `actual_ingress_time` time DEFAULT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`dept_id`);

--
-- Indexes for table `employee_list`
--
ALTER TABLE `employee_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_animation_details`
--
ALTER TABLE `event_animation_details`
  ADD PRIMARY KEY (`ad_id`);

--
-- Indexes for table `event_detail_list`
--
ALTER TABLE `event_detail_list`
  ADD PRIMARY KEY (`ed_id`);

--
-- Indexes for table `event_requirement`
--
ALTER TABLE `event_requirement`
  ADD PRIMARY KEY (`req_id`);

--
-- Indexes for table `job_order_list`
--
ALTER TABLE `job_order_list`
  ADD PRIMARY KEY (`jo_id`);

--
-- Indexes for table `jo_other`
--
ALTER TABLE `jo_other`
  ADD PRIMARY KEY (`other_id`);

--
-- Indexes for table `mom_list`
--
ALTER TABLE `mom_list`
  ADD PRIMARY KEY (`mom_id`);

--
-- Indexes for table `mom_notes`
--
ALTER TABLE `mom_notes`
  ADD PRIMARY KEY (`mom_ed_id`);

--
-- Indexes for table `mvrf`
--
ALTER TABLE `mvrf`
  ADD PRIMARY KEY (`mvrf_id`);

--
-- Indexes for table `mvrf_manpower`
--
ALTER TABLE `mvrf_manpower`
  ADD PRIMARY KEY (`manpower_id`);

--
-- Indexes for table `mvrf_vehicle`
--
ALTER TABLE `mvrf_vehicle`
  ADD PRIMARY KEY (`vehicle_id`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`position_id`);

--
-- Indexes for table `project_attachments`
--
ALTER TABLE `project_attachments`
  ADD PRIMARY KEY (`attachment_id`);

--
-- Indexes for table `setup_images`
--
ALTER TABLE `setup_images`
  ADD PRIMARY KEY (`img_id`);

--
-- Indexes for table `setup_particulars`
--
ALTER TABLE `setup_particulars`
  ADD PRIMARY KEY (`particular_id`);

--
-- Indexes for table `set_up_details`
--
ALTER TABLE `set_up_details`
  ADD PRIMARY KEY (`setup_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `dept_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `employee_list`
--
ALTER TABLE `employee_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `event_animation_details`
--
ALTER TABLE `event_animation_details`
  MODIFY `ad_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `event_detail_list`
--
ALTER TABLE `event_detail_list`
  MODIFY `ed_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `event_requirement`
--
ALTER TABLE `event_requirement`
  MODIFY `req_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `job_order_list`
--
ALTER TABLE `job_order_list`
  MODIFY `jo_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `jo_other`
--
ALTER TABLE `jo_other`
  MODIFY `other_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mom_list`
--
ALTER TABLE `mom_list`
  MODIFY `mom_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `mom_notes`
--
ALTER TABLE `mom_notes`
  MODIFY `mom_ed_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mvrf`
--
ALTER TABLE `mvrf`
  MODIFY `mvrf_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mvrf_manpower`
--
ALTER TABLE `mvrf_manpower`
  MODIFY `manpower_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mvrf_vehicle`
--
ALTER TABLE `mvrf_vehicle`
  MODIFY `vehicle_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `position_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `project_attachments`
--
ALTER TABLE `project_attachments`
  MODIFY `attachment_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `setup_images`
--
ALTER TABLE `setup_images`
  MODIFY `img_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `set_up_details`
--
ALTER TABLE `set_up_details`
  MODIFY `setup_id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
