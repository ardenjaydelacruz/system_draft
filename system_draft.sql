-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 20, 2015 at 02:22 PM
-- Server version: 5.6.24
-- PHP Version: 5.5.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `system_draft`
--

DELIMITER $$
--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `fn_getTimeIn`(logdate varchar(12)) RETURNS varchar(10) CHARSET utf8 COLLATE utf8_unicode_ci
BEGIN
	DECLARE logtime varchar(10);
	SELECT DATE_FORMAT(MIN(tbl_attendance.datetimelog), '%h:%i %p') INTO logtime
    FROM `msi_system`.`tbl_attendance`
    WHERE DATE_FORMAT(`msi_system`.`tbl_attendance`.`datetimelog`,'%m/%d/%Y') = logdate AND tbl_attendance.`event` = 'IN';
    
RETURN logtime;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `fn_getTimeOut`(logdate varchar(12)) RETURNS varchar(10) CHARSET utf8 COLLATE utf8_unicode_ci
BEGIN
	DECLARE logtime varchar(10);

	SELECT DATE_FORMAT(MIN(tbl_attendance.datetimelog), '%h:%i %p') INTO logtime
    FROM `msi_system`.`tbl_attendance`
    WHERE DATE_FORMAT(`msi_system`.`tbl_attendance`.`datetimelog`,'%m/%d/%Y') = logdate AND tbl_attendance.`event` = 'OUT';
    
RETURN logtime;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `fn_getTotalManHours`(id int, start_date datetime, end_date datetime) RETURNS decimal(10,2)
BEGIN
	DECLARE total DECIMAL(10,2);
    #Shift is from 8:00 AM to 5:00 PM
    #Modify shifts in view_attendance view if needed
    
    SELECT SUM(IFNULL(man_hours,0)) INTO total
    FROM view_attendance
    WHERE view_attendance.emp_id = id AND datelog BETWEEN start_date AND end_date;
    
RETURN total;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `fn_getTotalOvertime`(id int, start_date datetime, end_date datetime) RETURNS decimal(10,2)
BEGIN
	DECLARE total DECIMAL(10,2);
    #Shift is from 8:00 AM to 5:00 PM
    #Modify shifts in view_attendance view if needed
    
    SELECT SUM(IFNULL(overtime,0)) INTO total
    FROM view_attendance
    WHERE view_attendance.emp_id = id AND datelog BETWEEN start_date AND end_date;
    
RETURN total;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `fn_getTotalTardiness`(id int, start_date datetime, end_date datetime) RETURNS decimal(10,2)
BEGIN
	DECLARE total DECIMAL(10,2);
    #Shift is from 8:00 AM to 5:00 PM
    #Modify shifts in view_attendance view if needed
    
    SELECT SUM(IFNULL(tardiness,0))/60 INTO total
    FROM view_attendance
    WHERE view_attendance.emp_id = id AND datelog BETWEEN start_date AND end_date;
    
RETURN total;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `assets`
--

CREATE TABLE IF NOT EXISTS `assets` (
  `asset_id` int(5) NOT NULL,
  `serial_number` varchar(50) NOT NULL,
  `model` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `brand` varchar(100) NOT NULL,
  `vendor` varchar(100) NOT NULL,
  `assigned_employee` varchar(100) NOT NULL,
  `assigned_date` date NOT NULL,
  `status` varchar(100) NOT NULL,
  `date_acquired` date NOT NULL,
  `warranty_start` date NOT NULL,
  `warranty_end` date NOT NULL,
  `date_registered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assets`
--

INSERT INTO `assets` (`asset_id`, `serial_number`, `model`, `category`, `brand`, `vendor`, `assigned_employee`, `assigned_date`, `status`, `date_acquired`, `warranty_start`, `warranty_end`, `date_registered`) VALUES
(0, '28998', '32817', 'Adipiscing Elit Company', 'Pellentesque Habitant Industries', 'Nullam Vitae Corporation', 'None', '2015-03-12', 'wewewew', '2015-01-04', '0000-00-00', '2014-01-09', '0000-00-00 00:00:00'),
(4, '81934', '61300', 'Metus Aliquam Erat Industries', 'Metus Aenean LLC', 'Malesuada Malesuada LLC', 'Melissa F. Preston', '0000-00-00', 'tempor', '0000-00-00', '0000-00-00', '2016-01-05', '2014-10-09 07:00:00'),
(5, '90428', '59786', 'Enim Etiam LLC', 'In Tincidunt Incorporated', 'Lobortis Mauris Inc.', 'Boris I. Valencia', '0000-00-00', 'In', '2014-10-10', '2015-11-08', '0000-00-00', '0000-00-00 00:00:00'),
(6, '00187', '87860', 'Orci Ut Corporation', 'Semper Et Associates', 'Facilisis Vitae Inc.', 'Jerry N. Riddle', '2014-02-10', 'Nulla', '2014-11-11', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00'),
(7, '46361', '60019', 'Maecenas Iaculis Aliquet Limited', 'Lorem Vitae Odio Consulting', 'Volutpat Nulla LLC', 'Josephine U. West', '2014-06-08', 'Curabitur', '0000-00-00', '2015-01-04', '0000-00-00', '0000-00-00 00:00:00'),
(8, '93347', '52475', 'Ligula Tortor Limited', 'Purus In Molestie Foundation', 'Hendrerit Company', 'Sara Y. Wagner', '2014-10-12', 'lacus.', '0000-00-00', '2015-12-04', '0000-00-00', '0000-00-00 00:00:00'),
(9, '56871', '11091', 'Eros Nam PC', 'Nibh Lacinia Orci Corporation', 'Congue Institute', 'Brenden G. Moon', '0000-00-00', 'lacus.', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00'),
(10, '96718', '31228', 'Sit LLC', 'Sed Diam Lorem LLP', 'Donec Porttitor LLC', 'Inez B. Burch', '0000-00-00', 'orci', '0000-00-00', '0000-00-00', '2015-02-10', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE IF NOT EXISTS `employees` (
  `emp_id` int(5) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) NOT NULL,
  `position` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `department` varchar(50) NOT NULL,
  `leaves` int(5) NOT NULL,
  `birthday` date NOT NULL,
  `gender` varchar(50) NOT NULL,
  `marital_status` varchar(50) NOT NULL,
  `street` varchar(100) DEFAULT NULL,
  `barangay` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `zip` int(50) NOT NULL,
  `country` varchar(100) NOT NULL,
  `mobile_number` int(20) DEFAULT NULL,
  `tel_number` int(20) DEFAULT NULL,
  `email_address` varchar(50) DEFAULT NULL,
  `contact_person` varchar(50) DEFAULT NULL,
  `contact_rel` varchar(50) DEFAULT NULL,
  `contact_num` int(20) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`emp_id`, `first_name`, `middle_name`, `last_name`, `position`, `status`, `department`, `leaves`, `birthday`, `gender`, `marital_status`, `street`, `barangay`, `city`, `state`, `zip`, `country`, `mobile_number`, `tel_number`, `email_address`, `contact_person`, `contact_rel`, `contact_num`, `image`, `date_added`) VALUES
(0, 'Unassigned', 'Unassigned', 'Unassigned', '', '', '', 0, '0000-00-00', '', '', NULL, '', '', '', 0, '', NULL, NULL, NULL, NULL, NULL, NULL, '', '2015-07-19 11:07:12'),
(1, 'Ardenx', 'Alcairo', 'Dela Cruz', 'CEOs', 'Regular', 'Executive', 30, '0000-00-00', 'male', 'Single', '12', 'qwqw', 'manda', 'manila', 999, 'Philippines', 123, 123, 'ardents02@gmail.com', 'ardents', 'asdasd', 123123, 'steam_logo-wallpaper-1366x7681.jpg', '2015-06-30 07:00:00'),
(2, 'Yvonne', 'Franklin', 'Beach', 'Avye', 'Joy', 'Laoreet Posuere Enim PC', 2, '2015-12-26', 'female', 'Married', '1793 Nulla Rd.', 'Ada', 'Ceyhan', 'Diyarbak?r', 71652, 'Mali', 7624, 0, 'sapien@lectusquismassa.ca', 'Thor Y. Terry', 'Mr.', 278, '', '2016-02-08 08:00:00'),
(3, 'Ashely', 'Hensley', 'Delgado', 'Ross', 'Jenette', 'Ante Consulting', 4, '2015-06-09', 'female', 'Married', '375 Sagittis Road', 'SL', 'Sosnowiec', 'CV', 40205, 'Saint Pierre and Miquelon', 0, 0, 'Etiam.bibendum.fermentum@ullamcorperDuiscursus.org', 'Deacon K. Frye', 'Mrs.', 335, '', '2015-05-09 07:00:00'),
(4, 'Illana', 'Avery', 'Zamora', 'Pearl', 'Kelsie', 'Mi LLC', 6, '2016-06-14', 'female', 'Single', 'Ap #549-9677 Tortor Avenue', 'BA', 'Vitória da Conquista', 'North Island', 453128, 'Saint Vincent and The Grenadines', 500, 800, 'Duis.mi.enim@malesuadafamesac.org', 'Tallulah B. Levy', 'Ms.', 1, '', '2015-06-03 07:00:00'),
(5, 'Phillip', 'Peck', 'Cameron', 'Oliver', 'Isabella', 'Velit Quisque Foundation', 0, '2015-07-16', 'male', 'Widowed', 'P.O. Box 616, 5935 Vel, St.', '?z', 'Tire', 'AK', 35724, 'Saint Pierre and Miquelon', 0, 7624, 'lacus@adipiscinglobortis.net', 'Griffith W. Sawyer', 'Dr.', 1, '', '2014-10-23 07:00:00'),
(6, 'Virginia', 'Curry', 'Mendoza', 'Cameran', 'Ginger', 'Velit Justo Nec Inc.', 7, '2015-06-23', 'male', 'Single', '6319 Odio. St.', 'Hesse', 'Obertshausen', 'Luxemburg', 0, 'Gambia', 0, 0, 'molestie.sodales.Mauris@mauris.edu', 'Yardley K. Kennedy', 'Ms.', 978, '', '2015-06-14 07:00:00'),
(7, 'Abel', 'King', 'Ford', 'Todd', 'Thane', 'Ornare In Corp.', 10, '2016-06-04', 'male', 'Single', '637 Dui. St.', 'Aragón', 'Zaragoza', 'RJ', 14743, 'Niger', 800, 0, 'Nunc@ante.net', 'Hoyt F. Grimes', 'Dr.', 982, '', '2014-08-14 07:00:00'),
(8, 'Kendall', 'Bright', 'Cameron', 'Beau', 'Giacomo', 'Arcu Sed Et Consulting', 10, '2016-04-10', 'female', 'Single', '984-3608 Pede. Rd.', 'South Australia', 'Whyalla', 'YT', 1077, 'El Salvador', 76, 800, 'Nunc@tellusAenean.edu', 'Wanda L. Cain', '', 1, '', '2015-11-07 08:00:00'),
(9, 'Brittany', 'French', 'Gray', 'Imogene', 'Odysseus', 'Ac Arcu Institute', -4, '2014-09-21', 'female', 'Widowed', 'Ap #165-4162 Fusce Avenue', 'Ist', 'Istanbul', 'Bur', 82667, 'Micronesia', 800, 7624, 'imperdiet.ullamcorper@euismodin.com', 'Ulric V. Kidd', 'Ms.', 189, '', '2015-08-24 07:00:00'),
(10, 'Amir', 'Hernandez', 'Herrera', 'Nigel', 'Kellie', 'Sem Molestie Inc.', -1, '2015-06-09', 'female', 'Single', 'Ap #913-4290 Massa. Rd.', 'Istanbul', 'Istanbul', 'Leinster', 0, 'Liechtenstein', 7850, 76, 'tincidunt.orci@vulputatemauris.co.uk', 'Hamilton Q. Townsend', 'Dr.', 1, '', '2015-01-26 08:00:00'),
(11, 'Hakeem', 'Carson', 'Mullins', 'Katell', 'Belle', 'Suspendisse Institute', -1, '2015-02-11', 'male', 'Married', '1704 Consectetuer Rd.', 'Leinster', 'Dublin', 'PR', 25689, 'Mongolia', 845, 0, 'iaculis.nec.eleifend@dictumProin.org', 'Mona Y. Valenzuela', 'Mrs.', 289, '', '2015-12-03 08:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `emp_performance`
--

CREATE TABLE IF NOT EXISTS `emp_performance` (
  `performance_id` int(5) NOT NULL,
  `employee_name` varchar(255) NOT NULL,
  `evaluators` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `criteria1` varchar(100) NOT NULL,
  `criteria2` varchar(100) DEFAULT NULL,
  `criteria3` varchar(100) DEFAULT NULL,
  `criteria4` varchar(100) DEFAULT NULL,
  `criteria5` varchar(100) DEFAULT NULL,
  `rate1` decimal(3,2) NOT NULL,
  `rate2` decimal(3,2) DEFAULT NULL,
  `rate3` decimal(3,2) DEFAULT NULL,
  `rate4` decimal(3,2) DEFAULT NULL,
  `rate5` decimal(3,2) DEFAULT NULL,
  `final_rating` decimal(3,2) NOT NULL,
  `date_evaluated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emp_performance`
--

INSERT INTO `emp_performance` (`performance_id`, `employee_name`, `evaluators`, `description`, `criteria1`, `criteria2`, `criteria3`, `criteria4`, `criteria5`, `rate1`, `rate2`, `rate3`, `rate4`, `rate5`, `final_rating`, `date_evaluated`) VALUES
(1, 'Arden Alcairo Dela Cruz', 'Arden', '', '', '', '', '', '', '1.00', '1.00', '1.00', '1.00', '1.00', '1.00', '2015-06-30 04:38:40'),
(2, 'Yvonne Franklin Beach', 'Arden', 'Some Title', 'Are you hungry?', 'Are you pretty?', 'Are you satisfied with this company?', 'Do you want to build a snowman?', 'Do you wanna come out and play?', '5.00', '4.00', '2.00', '5.00', '4.00', '4.00', '2015-07-01 04:25:31'),
(3, 'Yvonne Franklin Beach', 'Arden', 'Some Title', 'Are you hungry?', 'Are you pretty?', 'Are you satisfied with this company?', 'Do you want to build a snowman?', 'Do you wanna come out and play?', '2.00', '4.00', '3.00', '3.00', '5.00', '3.40', '2015-07-01 11:51:03'),
(4, 'Arden Alcairo Dela Cruz', 'Arden', 'Some Title', 'q', 'q', 'q', 'q', 'q', '1.00', '2.00', '3.00', '4.00', '1.00', '2.20', '2015-07-03 19:50:20'),
(5, 'Arden Alcairo Dela Cruz', 'Arden', 'TitleFucker', 'q', 'q', 'q', 'q', 'q', '2.00', '3.00', '2.00', '4.00', '2.00', '2.60', '2015-07-03 19:55:19'),
(6, 'Arden Alcairo Dela Cruz', 'Arden', 'TitleFucker', 'e', 'e', 'e', 'e', 'e', '1.00', '1.00', '1.00', '1.00', '1.00', '1.00', '2015-07-03 20:00:30'),
(7, '  ', 'Arden', 'TitleFucker', 'e', 'e', 'e', 'e', 'e', '1.00', '1.00', '1.00', '1.00', '1.00', '1.00', '2015-07-03 20:02:11'),
(8, 'Arden Alcairo Dela Cruz', 'Arden', 'TitleFucker', 'w', 'w', 'w', 'w', 'w', '1.00', '1.00', '1.00', '1.00', '1.00', '1.00', '2015-07-03 20:02:53'),
(9, 'Ardenx Alcairo Dela Cruz', 'Ardenx', 'Some Title', 'qwe1', 'qwe2', 'qwe3', 'qwe4', 'qwe5', '2.00', '3.00', '3.00', '3.00', '4.00', '3.00', '2015-07-11 11:40:32'),
(10, 'Ardenx Alcairo Dela Cruz', 'Ardenx', 'TitleFucker', 'qwe1', 'qwe2', 'qwe3', 'qwe4', 'qwe5', '2.00', '2.00', '4.00', '5.00', '2.00', '3.00', '2015-07-11 11:45:58');

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

CREATE TABLE IF NOT EXISTS `leaves` (
  `leave_id` int(5) NOT NULL,
  `employee_name` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `days` int(4) NOT NULL,
  `leaves_left` int(5) NOT NULL,
  `type` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `approved_by` varchar(100) NOT NULL,
  `date_approved` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_requested` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `employee_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leaves`
--

INSERT INTO `leaves` (`leave_id`, `employee_name`, `start_date`, `end_date`, `days`, `leaves_left`, `type`, `status`, `approved_by`, `date_approved`, `date_requested`, `employee_id`) VALUES
(1, 'Arden Dela Cruz', '2015-06-01', '2015-06-01', 0, 4, 'Sick Leave', 'Approved', 'Administrator Arden', '2015-06-29 16:00:00', '2015-06-30 12:15:18', 1),
(2, 'Yvonne Beach', '2015-06-01', '2015-06-01', 0, 4, 'Sick Leave', 'Approved', 'Administrator Arden', '2015-06-29 16:00:00', '2015-06-30 12:15:33', 2),
(3, 'Ashely Delgado', '2015-06-02', '2015-06-02', 0, 5, 'Sick Leave', 'Approved', 'Administrator Arden', '2015-06-29 16:00:00', '2015-06-30 12:36:04', 3),
(4, 'Illana Zamora', '2015-06-02', '2015-06-02', 0, 7, 'Sick Leave', 'Approved', 'Administrator Arden', '2015-06-29 16:00:00', '2015-06-30 12:36:22', 4),
(5, 'Arden Dela Cruz', '2015-06-01', '2015-06-01', 0, 3, 'Sick Leave', 'Approved', 'Administrator Arden', '2015-06-29 16:00:00', '2015-06-30 12:36:37', 1),
(6, 'Arden Dela Cruz', '2015-06-01', '2015-06-01', 0, 2, 'Sick Leave', 'Approved', 'Administrator Arden', '2015-06-29 16:00:00', '2015-06-30 12:51:40', 1),
(7, 'Yvonne Beach', '2015-06-01', '2015-06-01', 0, 3, 'Maternity Leave', 'Declined', 'Administrator Arden', '2015-06-29 16:00:00', '2015-06-30 12:51:59', 2),
(8, 'Illana Zamora', '2015-06-02', '2015-06-04', 3, 6, 'Vacation Leave', 'Declined', 'Administrator Arden', '2015-06-29 16:00:00', '2015-06-30 13:53:58', 4),
(9, 'Phillip Cameron', '2015-06-01', '2015-06-08', 8, 8, 'Sick Leave', 'Approved', 'Administrator Arden', '2015-06-29 16:00:00', '2015-06-30 13:55:19', 5),
(10, 'Virginia Mendoza', '2015-07-07', '2015-07-09', 3, 10, 'Sick Leave', 'Approved', 'Administrator Arden', '2015-06-30 16:00:00', '2015-07-01 11:44:04', 6),
(11, 'Illana Zamora', '2015-07-01', '2015-07-03', 3, 6, 'Vacation Leave', 'Declined', 'Administrator Arden', '2015-06-30 16:00:00', '2015-07-01 11:48:54', 4);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_address`
--

CREATE TABLE IF NOT EXISTS `tbl_address` (
  `emp_address_id` int(5) NOT NULL,
  `street` varchar(50) DEFAULT NULL,
  `barangay` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `zip` int(10) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `employee_id` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_address`
--

INSERT INTO `tbl_address` (`emp_address_id`, `street`, `barangay`, `city`, `state`, `zip`, `country`, `employee_id`) VALUES
(10000, 'weewe', 'ewewe', 'wewewe', 'qeqeqe', 12122, 'qeqeqee', 0),
(10001, '577', 'Maybunga', 'Pasig City', 'Metro Manila', 1607, 'Philippines', 1),
(10002, '577', 'Maybunga', 'Pasig City', 'Metro Manila', 1607, 'Philippines', 2),
(10003, '1793 Nulla Rd.', 'Ada', 'Ceyhan', 'Diyarbak?r', 71652, 'Mali', 3),
(10004, '375 Sagittis Road', 'SL', 'Sosnowiec', 'CV', 40205, 'Saint Pierre and Miquelon', 4),
(10005, 'Ap #549-9677 Tortor Avenue', 'BA', 'Vitória da Conquista', 'North Island', 453128, 'Saint Vincent and The Grenadines', 5),
(10006, 'P.O. Box 616, 5935 Vel, St.', '?z', 'Tire', 'AK', 35724, 'Saint Pierre and Miquelon', 6),
(10007, '6319 Odio. St.', 'Hesse', 'Obertshausen', 'Luxemburg', 0, 'Gambia', 7),
(10008, '637 Dui. St.', 'Aragón', 'Zaragoza', 'RJ', 14743, 'Niger', 8),
(10009, '984-3608 Pede. Rd.', 'South Australia', 'Whyalla', 'YT', 1077, 'El Salvador', 9),
(10010, 'Ap #165-4162 Fusce Avenue', 'Ist', 'Istanbul', 'Bur', 82667, 'Micronesia', 10),
(10011, 'Ap #913-4290 Massa. Rd.', 'Istanbul', 'Istanbul', 'Leinster', 0, 'Liechtenstein', 11),
(10012, '12', 'qwqw', 'manda', 'manila', 999, 'Philippines', 12),
(10013, 'w', 'qwqw', 'manda', 'manila', 999, 'Philippines', 13),
(10014, '12', 'Kalentong', 'Mandaluyong', 'Metro Manila', 999, 'Philippines', 14);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_allowances`
--

CREATE TABLE IF NOT EXISTS `tbl_allowances` (
  `allowance_id` int(11) NOT NULL,
  `allowance_name` varchar(50) NOT NULL,
  `percentage` decimal(3,3) NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_allowances`
--

INSERT INTO `tbl_allowances` (`allowance_id`, `allowance_name`, `percentage`, `amount`, `active`) VALUES
(1, 'Communication Allowance', '0.000', '300.00', 1),
(2, 'Transportation Allowance', '0.000', '200.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_assets`
--

CREATE TABLE IF NOT EXISTS `tbl_assets` (
  `asset_id` varchar(10) NOT NULL,
  `employee_id` varchar(10) DEFAULT NULL,
  `asset_status` varchar(255) DEFAULT NULL,
  `assigned_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_assets`
--

INSERT INTO `tbl_assets` (`asset_id`, `employee_id`, `asset_status`, `assigned_date`) VALUES
('EQ1001', '4', 'Destroyed', '2015-07-20 00:00:00'),
('EQ1002', '1', 'Sabog', '2015-07-14 00:00:00'),
('EQ1003', '1', 'Brand New', NULL),
('EQ1004', '1', 'BOOOOOM', '2015-07-20 00:00:00'),
('EQ1005', '3', 'Sabog', '2015-07-21 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_asset_info`
--

CREATE TABLE IF NOT EXISTS `tbl_asset_info` (
  `asset_id` varchar(10) NOT NULL,
  `asset_name` varchar(50) DEFAULT NULL,
  `asset_description` varchar(100) DEFAULT NULL,
  `category_id` varchar(50) NOT NULL,
  `brand` varchar(50) DEFAULT NULL,
  `serial_number` int(20) DEFAULT NULL,
  `model` varchar(50) DEFAULT NULL,
  `vendor_id` varchar(10) DEFAULT NULL,
  `warranty_end_date` date DEFAULT NULL,
  `date_acquired` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_asset_info`
--

INSERT INTO `tbl_asset_info` (`asset_id`, `asset_name`, `asset_description`, `category_id`, `brand`, `serial_number`, `model`, `vendor_id`, `warranty_end_date`, `date_acquired`) VALUES
('EQ1001', 'Toshiba Laptop', 'It is an awesome laptop.', 'COMP', 'Toshiba', 1111111111, 'Satellite S10', 'VEN1001', '2015-07-25', '2015-07-18'),
('EQ1002', 'Office Table', 'It is a table. Duh!', 'WD', 'Unbranded', NULL, NULL, 'VEN1001', '2015-08-29', '2015-07-18'),
('EQ1003', 'Zanpaktou', 'Sharp Sword', 'PLSTC', 'Unbranded', 0, 'N/A', 'VEN1001', '2015-07-21', '2015-07-13'),
('EQ1004', 'Steel Chair', 'Steel Chair for Wrestling', 'STL', 'Unbranded', 0, 'N/A', 'VEN1001', NULL, '2015-07-21'),
('EQ1005', 'Martilyo ni Thor!''', 'Sharp Sword', 'PLSTC', 'CD R-king', 1231231, 'Super Model', 'VEN1001', '2015-07-22', '2015-07-02');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_attendance`
--

CREATE TABLE IF NOT EXISTS `tbl_attendance` (
  `attendance_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `datelog` datetime DEFAULT NULL,
  `datetimelog` datetime NOT NULL,
  `event` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `datetimefetch` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=243 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_attendance`
--

INSERT INTO `tbl_attendance` (`attendance_id`, `emp_id`, `datelog`, `datetimelog`, `event`, `datetimefetch`) VALUES
(1, 1, '2015-06-05 00:00:00', '2015-06-05 06:28:36', 'IN', '2015-06-05 06:30:00'),
(2, 1, '2015-06-05 00:00:00', '2015-06-05 06:28:36', 'IN', '2015-06-05 06:30:00'),
(3, 1, '2015-06-01 00:00:00', '2015-06-01 07:28:36', 'IN', '2015-06-05 06:30:00'),
(4, 1, '2015-06-01 00:00:00', '2015-06-01 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(5, 1, '2015-06-02 00:00:00', '2015-06-02 07:28:36', 'IN', '2015-06-05 06:30:00'),
(6, 1, '2015-06-02 00:00:00', '2015-06-02 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(7, 1, '2015-06-03 00:00:00', '2015-06-03 07:28:36', 'IN', '2015-06-05 06:30:00'),
(8, 1, '2015-06-03 00:00:00', '2015-06-03 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(9, 1, '2015-06-04 00:00:00', '2015-06-04 07:28:36', 'IN', '2015-06-05 06:30:00'),
(10, 1, '2015-06-04 00:00:00', '2015-06-04 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(11, 1, '2015-06-05 00:00:00', '2015-06-05 07:28:36', 'IN', '2015-06-05 06:30:00'),
(12, 1, '2015-06-05 00:00:00', '2015-06-05 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(13, 1, '2015-06-08 00:00:00', '2015-06-08 07:28:36', 'IN', '2015-06-05 06:30:00'),
(14, 1, '2015-06-08 00:00:00', '2015-06-08 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(17, 1, '2015-06-10 00:00:00', '2015-06-10 07:28:36', 'IN', '2015-06-05 06:30:00'),
(18, 1, '2015-06-10 00:00:00', '2015-06-10 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(19, 1, '2015-06-11 00:00:00', '2015-06-11 07:28:36', 'IN', '2015-06-05 06:30:00'),
(20, 1, '2015-06-11 00:00:00', '2015-06-11 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(21, 1, '2015-06-12 00:00:00', '2015-06-12 07:28:36', 'IN', '2015-06-05 06:30:00'),
(22, 1, '2015-06-12 00:00:00', '2015-06-12 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(23, 7, '2015-06-01 00:00:00', '2015-06-01 07:28:36', 'IN', '2015-06-05 06:30:00'),
(24, 7, '2015-06-01 00:00:00', '2015-06-01 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(25, 7, '2015-06-02 00:00:00', '2015-06-02 07:28:36', 'IN', '2015-06-05 06:30:00'),
(26, 7, '2015-06-02 00:00:00', '2015-06-02 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(27, 7, '2015-06-03 00:00:00', '2015-06-03 07:28:36', 'IN', '2015-06-05 06:30:00'),
(28, 7, '2015-06-03 00:00:00', '2015-06-03 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(29, 7, '2015-06-04 00:00:00', '2015-06-04 07:28:36', 'IN', '2015-06-05 06:30:00'),
(30, 7, '2015-06-04 00:00:00', '2015-06-04 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(31, 7, '2015-06-05 00:00:00', '2015-06-05 07:28:36', 'IN', '2015-06-05 06:30:00'),
(32, 7, '2015-06-05 00:00:00', '2015-06-05 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(33, 7, '2015-06-08 00:00:00', '2015-06-08 07:28:36', 'IN', '2015-06-05 06:30:00'),
(34, 7, '2015-06-08 00:00:00', '2015-06-08 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(35, 7, '2015-06-09 00:00:00', '2015-06-09 07:28:36', 'IN', '2015-06-05 06:30:00'),
(36, 7, '2015-06-09 00:00:00', '2015-06-09 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(37, 7, '2015-06-10 00:00:00', '2015-06-10 07:28:36', 'IN', '2015-06-05 06:30:00'),
(38, 7, '2015-06-10 00:00:00', '2015-06-10 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(39, 7, '2015-06-11 00:00:00', '2015-06-11 07:28:36', 'IN', '2015-06-05 06:30:00'),
(40, 7, '2015-06-11 00:00:00', '2015-06-11 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(41, 7, '2015-06-12 00:00:00', '2015-06-12 07:28:36', 'IN', '2015-06-05 06:30:00'),
(42, 7, '2015-06-12 00:00:00', '2015-06-12 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(43, 8, '2015-06-01 00:00:00', '2015-06-01 07:28:36', 'IN', '2015-06-05 06:30:00'),
(44, 8, '2015-06-01 00:00:00', '2015-06-01 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(45, 8, '2015-06-02 00:00:00', '2015-06-02 07:28:36', 'IN', '2015-06-05 06:30:00'),
(46, 8, '2015-06-02 00:00:00', '2015-06-02 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(47, 8, '2015-06-03 00:00:00', '2015-06-03 07:28:36', 'IN', '2015-06-05 06:30:00'),
(48, 8, '2015-06-03 00:00:00', '2015-06-03 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(49, 8, '2015-06-04 00:00:00', '2015-06-04 07:28:36', 'IN', '2015-06-05 06:30:00'),
(50, 8, '2015-06-04 00:00:00', '2015-06-04 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(51, 8, '2015-06-05 00:00:00', '2015-06-05 07:28:36', 'IN', '2015-06-05 06:30:00'),
(52, 8, '2015-06-05 00:00:00', '2015-06-05 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(53, 8, '2015-06-08 00:00:00', '2015-06-08 07:28:36', 'IN', '2015-06-05 06:30:00'),
(54, 8, '2015-06-08 00:00:00', '2015-06-08 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(55, 8, '2015-06-09 00:00:00', '2015-06-09 07:28:36', 'IN', '2015-06-05 06:30:00'),
(56, 8, '2015-06-09 00:00:00', '2015-06-09 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(57, 8, '2015-06-10 00:00:00', '2015-06-10 07:28:36', 'IN', '2015-06-05 06:30:00'),
(58, 8, '2015-06-10 00:00:00', '2015-06-10 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(59, 8, '2015-06-11 00:00:00', '2015-06-11 07:28:36', 'IN', '2015-06-05 06:30:00'),
(60, 8, '2015-06-11 00:00:00', '2015-06-11 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(61, 8, '2015-06-12 00:00:00', '2015-06-12 07:28:36', 'IN', '2015-06-05 06:30:00'),
(62, 8, '2015-06-12 00:00:00', '2015-06-12 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(63, 9, '2015-06-01 00:00:00', '2015-06-01 07:28:36', 'IN', '2015-06-05 06:30:00'),
(64, 9, '2015-06-01 00:00:00', '2015-06-01 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(65, 9, '2015-06-02 00:00:00', '2015-06-02 07:28:36', 'IN', '2015-06-05 06:30:00'),
(66, 9, '2015-06-02 00:00:00', '2015-06-02 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(67, 9, '2015-06-03 00:00:00', '2015-06-03 07:28:36', 'IN', '2015-06-05 06:30:00'),
(68, 9, '2015-06-03 00:00:00', '2015-06-03 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(69, 9, '2015-06-04 00:00:00', '2015-06-04 07:28:36', 'IN', '2015-06-05 06:30:00'),
(70, 9, '2015-06-04 00:00:00', '2015-06-04 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(71, 9, '2015-06-05 00:00:00', '2015-06-05 07:28:36', 'IN', '2015-06-05 06:30:00'),
(72, 9, '2015-06-05 00:00:00', '2015-06-05 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(73, 9, '2015-06-08 00:00:00', '2015-06-08 07:28:36', 'IN', '2015-06-05 06:30:00'),
(74, 9, '2015-06-08 00:00:00', '2015-06-08 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(75, 9, '2015-06-09 00:00:00', '2015-06-09 07:28:36', 'IN', '2015-06-05 06:30:00'),
(76, 9, '2015-06-09 00:00:00', '2015-06-09 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(77, 9, '2015-06-10 00:00:00', '2015-06-10 07:28:36', 'IN', '2015-06-05 06:30:00'),
(78, 9, '2015-06-10 00:00:00', '2015-06-10 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(79, 9, '2015-06-11 00:00:00', '2015-06-11 07:28:36', 'IN', '2015-06-05 06:30:00'),
(80, 9, '2015-06-11 00:00:00', '2015-06-11 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(81, 9, '2015-06-12 00:00:00', '2015-06-12 07:28:36', 'IN', '2015-06-05 06:30:00'),
(82, 9, '2015-06-12 00:00:00', '2015-06-12 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(83, 10, '2015-06-01 00:00:00', '2015-06-01 07:28:36', 'IN', '2015-06-05 06:30:00'),
(84, 10, '2015-06-01 00:00:00', '2015-06-01 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(85, 10, '2015-06-02 00:00:00', '2015-06-02 07:28:36', 'IN', '2015-06-05 06:30:00'),
(86, 10, '2015-06-02 00:00:00', '2015-06-02 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(87, 10, '2015-06-03 00:00:00', '2015-06-03 07:28:36', 'IN', '2015-06-05 06:30:00'),
(88, 10, '2015-06-03 00:00:00', '2015-06-03 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(89, 10, '2015-06-04 00:00:00', '2015-06-04 07:28:36', 'IN', '2015-06-05 06:30:00'),
(90, 10, '2015-06-04 00:00:00', '2015-06-04 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(91, 10, '2015-06-05 00:00:00', '2015-06-05 07:28:36', 'IN', '2015-06-05 06:30:00'),
(92, 10, '2015-06-05 00:00:00', '2015-06-05 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(93, 10, '2015-06-08 00:00:00', '2015-06-08 07:28:36', 'IN', '2015-06-05 06:30:00'),
(94, 10, '2015-06-08 00:00:00', '2015-06-08 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(95, 10, '2015-06-09 00:00:00', '2015-06-09 07:28:36', 'IN', '2015-06-05 06:30:00'),
(96, 10, '2015-06-09 00:00:00', '2015-06-09 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(97, 10, '2015-06-10 00:00:00', '2015-06-10 07:28:36', 'IN', '2015-06-05 06:30:00'),
(98, 10, '2015-06-10 00:00:00', '2015-06-10 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(99, 10, '2015-06-11 00:00:00', '2015-06-11 07:28:36', 'IN', '2015-06-05 06:30:00'),
(100, 10, '2015-06-11 00:00:00', '2015-06-11 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(101, 10, '2015-06-12 00:00:00', '2015-06-12 07:28:36', 'IN', '2015-06-05 06:30:00'),
(102, 10, '2015-06-12 00:00:00', '2015-06-12 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(103, 11, '2015-06-01 00:00:00', '2015-06-01 07:28:36', 'IN', '2015-06-05 06:30:00'),
(104, 11, '2015-06-01 00:00:00', '2015-06-01 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(105, 11, '2015-06-02 00:00:00', '2015-06-02 07:28:36', 'IN', '2015-06-05 06:30:00'),
(106, 11, '2015-06-02 00:00:00', '2015-06-02 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(107, 11, '2015-06-03 00:00:00', '2015-06-03 07:28:36', 'IN', '2015-06-05 06:30:00'),
(108, 11, '2015-06-03 00:00:00', '2015-06-03 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(109, 11, '2015-06-04 00:00:00', '2015-06-04 07:28:36', 'IN', '2015-06-05 06:30:00'),
(110, 11, '2015-06-04 00:00:00', '2015-06-04 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(111, 11, '2015-06-05 00:00:00', '2015-06-05 07:28:36', 'IN', '2015-06-05 06:30:00'),
(112, 11, '2015-06-05 00:00:00', '2015-06-05 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(113, 11, '2015-06-08 00:00:00', '2015-06-08 07:28:36', 'IN', '2015-06-05 06:30:00'),
(114, 11, '2015-06-08 00:00:00', '2015-06-08 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(115, 11, '2015-06-09 00:00:00', '2015-06-09 07:28:36', 'IN', '2015-06-05 06:30:00'),
(116, 11, '2015-06-09 00:00:00', '2015-06-09 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(117, 11, '2015-06-10 00:00:00', '2015-06-10 07:28:36', 'IN', '2015-06-05 06:30:00'),
(118, 11, '2015-06-10 00:00:00', '2015-06-10 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(119, 11, '2015-06-11 00:00:00', '2015-06-11 07:28:36', 'IN', '2015-06-05 06:30:00'),
(120, 11, '2015-06-11 00:00:00', '2015-06-11 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(121, 11, '2015-06-12 00:00:00', '2015-06-12 07:28:36', 'IN', '2015-06-05 06:30:00'),
(122, 11, '2015-06-12 00:00:00', '2015-06-12 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(123, 1, '2015-06-01 00:00:00', '2015-06-01 07:28:36', 'IN', '2015-06-05 06:30:00'),
(124, 1, '2015-06-01 00:00:00', '2015-06-01 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(125, 1, '2015-06-02 00:00:00', '2015-06-02 07:28:36', 'IN', '2015-06-05 06:30:00'),
(126, 1, '2015-06-02 00:00:00', '2015-06-02 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(127, 1, '2015-06-03 00:00:00', '2015-06-03 07:28:36', 'IN', '2015-06-05 06:30:00'),
(128, 1, '2015-06-03 00:00:00', '2015-06-03 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(129, 1, '2015-06-04 00:00:00', '2015-06-04 07:28:36', 'IN', '2015-06-05 06:30:00'),
(130, 1, '2015-06-04 00:00:00', '2015-06-04 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(131, 1, '2015-06-05 00:00:00', '2015-06-05 07:28:36', 'IN', '2015-06-05 06:30:00'),
(132, 1, '2015-06-05 00:00:00', '2015-06-05 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(133, 1, '2015-06-08 00:00:00', '2015-06-08 07:28:36', 'IN', '2015-06-05 06:30:00'),
(134, 1, '2015-06-08 00:00:00', '2015-06-08 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(137, 1, '2015-06-10 00:00:00', '2015-06-10 07:28:36', 'IN', '2015-06-05 06:30:00'),
(138, 1, '2015-06-10 00:00:00', '2015-06-10 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(139, 1, '2015-06-11 00:00:00', '2015-06-11 07:28:36', 'IN', '2015-06-05 06:30:00'),
(140, 1, '2015-06-11 00:00:00', '2015-06-11 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(141, 1, '2015-06-12 00:00:00', '2015-06-12 07:28:36', 'IN', '2015-06-05 06:30:00'),
(142, 1, '2015-06-12 00:00:00', '2015-06-12 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(143, 7, '2015-06-01 00:00:00', '2015-06-01 07:28:36', 'IN', '2015-06-05 06:30:00'),
(144, 7, '2015-06-01 00:00:00', '2015-06-01 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(145, 7, '2015-06-02 00:00:00', '2015-06-02 07:28:36', 'IN', '2015-06-05 06:30:00'),
(146, 7, '2015-06-02 00:00:00', '2015-06-02 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(147, 7, '2015-06-03 00:00:00', '2015-06-03 07:28:36', 'IN', '2015-06-05 06:30:00'),
(148, 7, '2015-06-03 00:00:00', '2015-06-03 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(149, 7, '2015-06-04 00:00:00', '2015-06-04 07:28:36', 'IN', '2015-06-05 06:30:00'),
(150, 7, '2015-06-04 00:00:00', '2015-06-04 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(151, 7, '2015-06-05 00:00:00', '2015-06-05 07:28:36', 'IN', '2015-06-05 06:30:00'),
(152, 7, '2015-06-05 00:00:00', '2015-06-05 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(153, 7, '2015-06-08 00:00:00', '2015-06-08 07:28:36', 'IN', '2015-06-05 06:30:00'),
(154, 7, '2015-06-08 00:00:00', '2015-06-08 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(155, 7, '2015-06-09 00:00:00', '2015-06-09 07:28:36', 'IN', '2015-06-05 06:30:00'),
(156, 7, '2015-06-09 00:00:00', '2015-06-09 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(157, 7, '2015-06-10 00:00:00', '2015-06-10 07:28:36', 'IN', '2015-06-05 06:30:00'),
(158, 7, '2015-06-10 00:00:00', '2015-06-10 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(159, 7, '2015-06-11 00:00:00', '2015-06-11 07:28:36', 'IN', '2015-06-05 06:30:00'),
(160, 7, '2015-06-11 00:00:00', '2015-06-11 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(161, 7, '2015-06-12 00:00:00', '2015-06-12 07:28:36', 'IN', '2015-06-05 06:30:00'),
(162, 7, '2015-06-12 00:00:00', '2015-06-12 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(163, 8, '2015-06-01 00:00:00', '2015-06-01 07:28:36', 'IN', '2015-06-05 06:30:00'),
(164, 8, '2015-06-01 00:00:00', '2015-06-01 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(165, 8, '2015-06-02 00:00:00', '2015-06-02 07:28:36', 'IN', '2015-06-05 06:30:00'),
(166, 8, '2015-06-02 00:00:00', '2015-06-02 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(167, 8, '2015-06-03 00:00:00', '2015-06-03 07:28:36', 'IN', '2015-06-05 06:30:00'),
(168, 8, '2015-06-03 00:00:00', '2015-06-03 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(169, 8, '2015-06-04 00:00:00', '2015-06-04 07:28:36', 'IN', '2015-06-05 06:30:00'),
(170, 8, '2015-06-04 00:00:00', '2015-06-04 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(171, 8, '2015-06-05 00:00:00', '2015-06-05 07:28:36', 'IN', '2015-06-05 06:30:00'),
(172, 8, '2015-06-05 00:00:00', '2015-06-05 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(173, 8, '2015-06-08 00:00:00', '2015-06-08 07:28:36', 'IN', '2015-06-05 06:30:00'),
(174, 8, '2015-06-08 00:00:00', '2015-06-08 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(175, 8, '2015-06-09 00:00:00', '2015-06-09 07:28:36', 'IN', '2015-06-05 06:30:00'),
(176, 8, '2015-06-09 00:00:00', '2015-06-09 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(177, 8, '2015-06-10 00:00:00', '2015-06-10 07:28:36', 'IN', '2015-06-05 06:30:00'),
(178, 8, '2015-06-10 00:00:00', '2015-06-10 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(179, 8, '2015-06-11 00:00:00', '2015-06-11 07:28:36', 'IN', '2015-06-05 06:30:00'),
(180, 8, '2015-06-11 00:00:00', '2015-06-11 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(181, 8, '2015-06-12 00:00:00', '2015-06-12 07:28:36', 'IN', '2015-06-05 06:30:00'),
(182, 8, '2015-06-12 00:00:00', '2015-06-12 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(183, 9, '2015-06-01 00:00:00', '2015-06-01 07:28:36', 'IN', '2015-06-05 06:30:00'),
(184, 9, '2015-06-01 00:00:00', '2015-06-01 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(185, 9, '2015-06-02 00:00:00', '2015-06-02 07:28:36', 'IN', '2015-06-05 06:30:00'),
(186, 9, '2015-06-02 00:00:00', '2015-06-02 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(187, 9, '2015-06-03 00:00:00', '2015-06-03 07:28:36', 'IN', '2015-06-05 06:30:00'),
(188, 9, '2015-06-03 00:00:00', '2015-06-03 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(189, 9, '2015-06-04 00:00:00', '2015-06-04 07:28:36', 'IN', '2015-06-05 06:30:00'),
(190, 9, '2015-06-04 00:00:00', '2015-06-04 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(191, 9, '2015-06-05 00:00:00', '2015-06-05 07:28:36', 'IN', '2015-06-05 06:30:00'),
(192, 9, '2015-06-05 00:00:00', '2015-06-05 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(193, 9, '2015-06-08 00:00:00', '2015-06-08 07:28:36', 'IN', '2015-06-05 06:30:00'),
(194, 9, '2015-06-08 00:00:00', '2015-06-08 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(195, 9, '2015-06-09 00:00:00', '2015-06-09 07:28:36', 'IN', '2015-06-05 06:30:00'),
(196, 9, '2015-06-09 00:00:00', '2015-06-09 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(197, 9, '2015-06-10 00:00:00', '2015-06-10 07:28:36', 'IN', '2015-06-05 06:30:00'),
(198, 9, '2015-06-10 00:00:00', '2015-06-10 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(199, 9, '2015-06-11 00:00:00', '2015-06-11 07:28:36', 'IN', '2015-06-05 06:30:00'),
(200, 9, '2015-06-11 00:00:00', '2015-06-11 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(201, 9, '2015-06-12 00:00:00', '2015-06-12 07:28:36', 'IN', '2015-06-05 06:30:00'),
(202, 9, '2015-06-12 00:00:00', '2015-06-12 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(203, 10, '2015-06-01 00:00:00', '2015-06-01 07:28:36', 'IN', '2015-06-05 06:30:00'),
(204, 10, '2015-06-01 00:00:00', '2015-06-01 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(205, 10, '2015-06-02 00:00:00', '2015-06-02 07:28:36', 'IN', '2015-06-05 06:30:00'),
(206, 10, '2015-06-02 00:00:00', '2015-06-02 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(207, 10, '2015-06-03 00:00:00', '2015-06-03 07:28:36', 'IN', '2015-06-05 06:30:00'),
(208, 10, '2015-06-03 00:00:00', '2015-06-03 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(209, 10, '2015-06-04 00:00:00', '2015-06-04 07:28:36', 'IN', '2015-06-05 06:30:00'),
(210, 10, '2015-06-04 00:00:00', '2015-06-04 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(211, 10, '2015-06-05 00:00:00', '2015-06-05 07:28:36', 'IN', '2015-06-05 06:30:00'),
(212, 10, '2015-06-05 00:00:00', '2015-06-05 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(213, 10, '2015-06-08 00:00:00', '2015-06-08 07:28:36', 'IN', '2015-06-05 06:30:00'),
(214, 10, '2015-06-08 00:00:00', '2015-06-08 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(215, 10, '2015-06-09 00:00:00', '2015-06-09 07:28:36', 'IN', '2015-06-05 06:30:00'),
(216, 10, '2015-06-09 00:00:00', '2015-06-09 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(217, 10, '2015-06-10 00:00:00', '2015-06-10 07:28:36', 'IN', '2015-06-05 06:30:00'),
(218, 10, '2015-06-10 00:00:00', '2015-06-10 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(219, 10, '2015-06-11 00:00:00', '2015-06-11 07:28:36', 'IN', '2015-06-05 06:30:00'),
(220, 10, '2015-06-11 00:00:00', '2015-06-11 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(221, 10, '2015-06-12 00:00:00', '2015-06-12 07:28:36', 'IN', '2015-06-05 06:30:00'),
(222, 10, '2015-06-12 00:00:00', '2015-06-12 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(223, 11, '2015-06-01 00:00:00', '2015-06-01 07:28:36', 'IN', '2015-06-05 06:30:00'),
(224, 11, '2015-06-01 00:00:00', '2015-06-01 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(225, 11, '2015-06-02 00:00:00', '2015-06-02 07:28:36', 'IN', '2015-06-05 06:30:00'),
(226, 11, '2015-06-02 00:00:00', '2015-06-02 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(227, 11, '2015-06-03 00:00:00', '2015-06-03 07:28:36', 'IN', '2015-06-05 06:30:00'),
(228, 11, '2015-06-03 00:00:00', '2015-06-03 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(229, 11, '2015-06-04 00:00:00', '2015-06-04 07:28:36', 'IN', '2015-06-05 06:30:00'),
(230, 11, '2015-06-04 00:00:00', '2015-06-04 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(231, 11, '2015-06-05 00:00:00', '2015-06-05 07:28:36', 'IN', '2015-06-05 06:30:00'),
(232, 11, '2015-06-05 00:00:00', '2015-06-05 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(233, 11, '2015-06-08 00:00:00', '2015-06-08 07:28:36', 'IN', '2015-06-05 06:30:00'),
(234, 11, '2015-06-08 00:00:00', '2015-06-08 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(235, 11, '2015-06-09 00:00:00', '2015-06-09 07:28:36', 'IN', '2015-06-05 06:30:00'),
(236, 11, '2015-06-09 00:00:00', '2015-06-09 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(237, 11, '2015-06-10 00:00:00', '2015-06-10 07:28:36', 'IN', '2015-06-05 06:30:00'),
(238, 11, '2015-06-10 00:00:00', '2015-06-10 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(239, 11, '2015-06-11 00:00:00', '2015-06-11 07:28:36', 'IN', '2015-06-05 06:30:00'),
(240, 11, '2015-06-11 00:00:00', '2015-06-11 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(241, 11, '2015-06-12 00:00:00', '2015-06-12 07:28:36', 'IN', '2015-06-05 06:30:00'),
(242, 11, '2015-06-12 00:00:00', '2015-06-12 17:28:36', 'OUT', '2015-06-05 06:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_client`
--

CREATE TABLE IF NOT EXISTS `tbl_client` (
  `client_id` varchar(10) NOT NULL,
  `client_name` varchar(50) NOT NULL,
  `client_address` varchar(50) NOT NULL,
  `client_contact_no` int(20) NOT NULL,
  `client_email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_client`
--

INSERT INTO `tbl_client` (`client_id`, `client_name`, `client_address`, `client_contact_no`, `client_email`) VALUES
('CL1001', 'Skyjet Airlines', 'Tokyo, Japan', 1232323213, 'skyjet@gmail.com'),
('CL1002', 'Lucio Tan', 'Fujian, China', 232323232, 'lucio@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contact_number`
--

CREATE TABLE IF NOT EXISTS `tbl_contact_number` (
  `employee_id` int(5) DEFAULT NULL,
  `mobile_number` int(20) DEFAULT NULL,
  `tel_number` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_contact_number`
--

INSERT INTO `tbl_contact_number` (`employee_id`, `mobile_number`, `tel_number`) VALUES
(1, 926246265, 3692735),
(2, 32132132, 65656565),
(4, 2132323213, 656565656),
(5, 564564564, 12212121),
(6, 878978998, 21212121),
(8, 564564654, 2122121),
(9, 321321321, 21212121),
(10, 465454656, 212121255),
(11, 988979878, 54545488),
(12, 564654656, 5454448),
(13, 1321321231, 55454878),
(14, 554545454, 878898978);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contact_person`
--

CREATE TABLE IF NOT EXISTS `tbl_contact_person` (
  `cperson_id` int(5) NOT NULL,
  `contact_person` varchar(100) DEFAULT NULL,
  `contact_rel` varchar(30) DEFAULT NULL,
  `contact_num` int(20) DEFAULT NULL,
  `employee_id` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_contact_person`
--

INSERT INTO `tbl_contact_person` (`cperson_id`, `contact_person`, `contact_rel`, `contact_num`, `employee_id`) VALUES
(1, 'Jon Snow', 'Tropa', 1620111, 1),
(6, NULL, NULL, NULL, NULL),
(8, NULL, NULL, NULL, NULL),
(10, NULL, NULL, NULL, NULL),
(12, NULL, NULL, NULL, NULL),
(13, NULL, NULL, NULL, NULL),
(14, NULL, NULL, NULL, NULL),
(10001, 'Pareng Erap', 'Kainuman', 162012, 0),
(10002, NULL, NULL, NULL, NULL),
(10003, NULL, NULL, NULL, NULL),
(10004, NULL, NULL, NULL, NULL),
(10005, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_departments`
--

CREATE TABLE IF NOT EXISTS `tbl_departments` (
  `department_id` varchar(10) NOT NULL,
  `department_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_departments`
--

INSERT INTO `tbl_departments` (`department_id`, `department_name`) VALUES
('DE1001', 'Technical'),
('DE1002', 'Operational'),
('DE1003', 'Finance');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dependent`
--

CREATE TABLE IF NOT EXISTS `tbl_dependent` (
  `dependent_id` int(5) NOT NULL,
  `dependent_fname` varchar(50) DEFAULT NULL,
  `dependent_lname` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_dependent`
--

INSERT INTO `tbl_dependent` (`dependent_id`, `dependent_fname`, `dependent_lname`) VALUES
(1, 'Aria', 'Stark'),
(2, 'Sansa', 'Stark'),
(3, 'Bran', 'Stark'),
(4, 'Tony', 'Stark');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dependent_info`
--

CREATE TABLE IF NOT EXISTS `tbl_dependent_info` (
  `employee_id` varchar(10) DEFAULT NULL,
  `dependent_id` varchar(10) DEFAULT NULL,
  `relationship` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_dependent_info`
--

INSERT INTO `tbl_dependent_info` (`employee_id`, `dependent_id`, `relationship`) VALUES
('1', '1', 'Daughter'),
('1', '2', 'Daughter'),
('1', '3', 'Son');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_emp_history`
--

CREATE TABLE IF NOT EXISTS `tbl_emp_history` (
  `emp_history_id` int(4) NOT NULL,
  `emp_id` int(4) NOT NULL,
  `status` varchar(50) NOT NULL,
  `job_title` varchar(50) NOT NULL,
  `job_category` varchar(50) NOT NULL,
  `department` varchar(50) NOT NULL,
  `start_date` date NOT NULL,
  `probationary_date` date DEFAULT NULL,
  `permanency_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `salary` decimal(10,2) NOT NULL,
  `pay_grade` varchar(5) NOT NULL,
  `date_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_emp_history`
--

INSERT INTO `tbl_emp_history` (`emp_history_id`, `emp_id`, `status`, `job_title`, `job_category`, `department`, `start_date`, `probationary_date`, `permanency_date`, `end_date`, `salary`, `pay_grade`, `date_modified`) VALUES
(1, 1, 'Regular', 'CTO', 'Professionals', 'Executive', '1990-01-01', '2015-07-07', '2015-07-17', '2020-12-31', '40000.00', 'A', '2015-07-08 05:11:34'),
(2, 2, '', '', '', 'Laoreet Posuere Enim PC', '1990-01-01', NULL, NULL, '2020-12-31', '30000.00', 'A', '2015-07-08 05:13:55'),
(3, 3, '', '', '', 'Ante Consulting', '1990-01-01', NULL, NULL, '2020-12-31', '25000.00', 'A', '2015-07-08 05:15:00'),
(4, 4, '', '', '', 'Mi LLC', '1990-01-01', NULL, NULL, '2020-12-31', '20000.00', 'A', '2015-07-08 05:16:20'),
(5, 5, '', '', '', 'Velit Quisque Foundation', '1990-01-01', NULL, NULL, '2020-12-31', '20000.00', 'A', '2015-07-08 05:16:20'),
(6, 6, '', '', '', 'Velit Justo Nec Inc.', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(7, 7, '', '', '', 'Ornare In Corp.', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(8, 8, '', '', '', 'Arcu Sed Et Consulting', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(9, 9, '', '', '', 'Ac Arcu Institute', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(10, 10, '', '', '', 'Sem Molestie Inc.', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(11, 11, '', '', '', 'Suspendisse Institute', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(12, 12, '', '', '', 'Non Feugiat Associates', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(13, 13, '', '', '', 'Vulputate Ullamcorper Magna Incorporated', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(14, 14, '', '', '', 'Rutrum Eu LLP', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(15, 15, '', '', '', 'A Ultricies Inc.', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(16, 16, '', '', '', 'Ultrices Iaculis Odio Incorporated', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(17, 17, '', '', '', 'Vel LLC', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(18, 18, '', '', '', 'Eu Euismod Consulting', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(19, 19, '', '', '', 'Nostra Per Industries', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(20, 20, '', '', '', 'Ante LLC', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(21, 21, '', '', '', 'Enim Associates', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(22, 22, '', '', '', 'At PC', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(23, 23, '', '', '', 'Donec Institute', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(24, 24, '', '', '', 'Ornare Facilisis Eget Corporation', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(25, 25, '', '', '', 'Nulla Foundation', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(26, 26, '', '', '', 'Tempor Erat Neque Corp.', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(27, 27, '', '', '', 'Magnis Dis Corporation', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(28, 28, '', '', '', 'Euismod Limited', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(29, 29, '', '', '', 'Elementum Lorem Ut PC', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(30, 30, '', '', '', 'Eget Foundation', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(31, 31, '', '', '', 'Vitae Corporation', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(32, 32, '', '', '', 'Fames Ac Turpis Institute', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(33, 33, '', '', '', 'Mi Tempor Lorem Corp.', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(34, 34, '', '', '', 'Euismod Enim Etiam Industries', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(35, 35, '', '', '', 'Ultrices Duis Volutpat Inc.', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(36, 36, '', '', '', 'Sit Incorporated', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(37, 37, '', '', '', 'Non Incorporated', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(38, 38, '', '', '', 'Vel Pede Blandit Limited', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(39, 39, '', '', '', 'Sem Semper Erat Ltd', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(40, 40, '', '', '', 'Pede Cum LLP', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(41, 41, '', '', '', 'Proin Ltd', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(42, 42, '', '', '', 'Adipiscing Ligula Aenean Inc.', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(43, 43, '', '', '', 'Tincidunt Corp.', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(44, 44, '', '', '', 'Tincidunt Corp.', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(45, 45, '', '', '', 'Eleifend Nunc Risus Incorporated', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(46, 46, '', '', '', 'Nunc LLP', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(47, 47, '', '', '', 'Ligula Elit Pretium LLP', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(48, 48, '', '', '', 'Ligula Aenean Euismod LLP', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(49, 49, '', '', '', 'Purus Incorporated', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(50, 50, '', '', '', 'Proin Mi Aliquam LLC', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(51, 51, '', '', '', 'Quam Curabitur LLC', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(52, 52, '', '', '', 'Semper Auctor Mauris Associates', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(53, 53, '', '', '', 'Aliquam Ltd', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(54, 54, '', '', '', 'Velit Dui Semper Industries', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(55, 55, '', '', '', 'Volutpat Incorporated', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(56, 56, '', '', '', 'Dui Limited', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(57, 57, '', '', '', 'Molestie Dapibus Associates', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(58, 58, '', '', '', 'Ante Maecenas Corp.', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(59, 59, '', '', '', 'Pretium Et Institute', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(60, 60, '', '', '', 'Fringilla Donec Foundation', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(61, 61, '', '', '', 'Magnis Dis Parturient Corp.', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(62, 62, '', '', '', 'Dolor Limited', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(63, 63, '', '', '', 'Egestas PC', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(64, 64, '', '', '', 'Eu Erat Semper Foundation', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(65, 65, '', '', '', 'Vitae Inc.', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(66, 66, '', '', '', 'Velit Corporation', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(67, 67, '', '', '', 'Convallis Erat Foundation', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(68, 68, '', '', '', 'Ultricies Dignissim Lacus Foundation', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(69, 69, '', '', '', 'Ullamcorper Magna Sed Limited', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(70, 70, '', '', '', 'Odio Limited', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(71, 71, '', '', '', 'Dolor Dapibus Gravida Associates', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(72, 72, '', '', '', 'Mauris Ut Mi Inc.', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(73, 73, '', '', '', 'Egestas Blandit Nam Inc.', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(74, 74, '', '', '', 'Quis Pede Praesent LLP', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(75, 75, '', '', '', 'Sed Molestie Corp.', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(76, 76, '', '', '', 'Lacinia At Inc.', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(77, 77, '', '', '', 'Et Magna Praesent LLP', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(78, 78, '', '', '', 'Sit Amet Ante Associates', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(79, 79, '', '', '', 'Fusce LLP', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(80, 80, '', '', '', 'Feugiat Non Limited', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(81, 81, '', '', '', 'Tempor Bibendum Donec Associates', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(82, 82, '', '', '', 'Volutpat Corp.', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(83, 83, '', '', '', 'Leo LLP', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(84, 84, '', '', '', 'Ligula Aenean LLC', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(85, 85, '', '', '', 'Porttitor Company', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(86, 86, '', '', '', 'Magnis Dis Incorporated', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(87, 87, '', '', '', 'Posuere Limited', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(88, 88, '', '', '', 'Suspendisse LLC', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(89, 89, '', '', '', 'Nisi Inc.', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(90, 90, '', '', '', 'Nulla Dignissim Limited', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(91, 91, '', '', '', 'Tincidunt Vehicula Risus Corporation', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(92, 92, '', '', '', 'Nec Orci Donec LLP', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(93, 93, '', '', '', 'Orci Sem Company', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(94, 94, '', '', '', 'Eu Arcu Morbi Company', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(95, 95, '', '', '', 'Nunc Incorporated', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(96, 96, '', '', '', 'Vitae Velit Institute', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(97, 97, '', '', '', 'Ante Bibendum Ullamcorper Industries', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(98, 98, '', '', '', 'Commodo Corporation', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44'),
(99, 99, '', '', '', '', '1990-01-01', NULL, NULL, '2020-12-31', '15000.00', 'A', '2015-07-13 06:33:44');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_emp_info`
--

CREATE TABLE IF NOT EXISTS `tbl_emp_info` (
  `emp_id` int(5) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `birthday` date NOT NULL,
  `gender` varchar(50) NOT NULL,
  `marital_status` varchar(50) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_emp_info`
--

INSERT INTO `tbl_emp_info` (`emp_id`, `first_name`, `middle_name`, `last_name`, `birthday`, `gender`, `marital_status`, `date_added`) VALUES
(0, 'Unassigned', NULL, NULL, '0000-00-00', '', '', '2015-07-19 12:53:30'),
(1, 'Arden', 'Alcairo', 'Dela Cruz', '1993-12-16', 'male', 'Single', '2015-06-30 07:00:00'),
(2, 'Yvonne', 'Franklin', 'Beach', '2015-12-26', 'female', 'Married', '2016-02-08 08:00:00'),
(3, 'Ashely', 'Hensley', 'Delgado', '2015-06-09', 'female', 'Married', '2015-05-09 07:00:00'),
(4, 'Illana', 'Avery', 'Zamora', '2016-06-14', 'female', 'Single', '2015-06-03 07:00:00'),
(5, 'Phillip', 'Peck', 'Cameron', '2015-07-16', 'male', 'Widowed', '2014-10-23 07:00:00'),
(6, 'Virginia', 'Curry', 'Mendoza', '2015-06-23', 'male', 'Single', '2015-06-14 07:00:00'),
(7, 'Abel', 'King', 'Ford', '2016-06-04', 'male', 'Single', '2014-08-14 07:00:00'),
(8, 'Kendall', 'Bright', 'Cameron', '2016-04-10', 'female', 'Single', '2015-11-07 08:00:00'),
(9, 'Brittany', 'French', 'Gray', '2014-09-21', 'female', 'Widowed', '2015-08-24 07:00:00'),
(10, 'Amir', 'Hernandez', 'Herrera', '2015-06-09', 'female', 'Single', '2015-01-26 08:00:00'),
(11, 'q', 'q', '61300', '2015-07-01', 'q', 'married', '2015-07-12 14:39:19'),
(12, 'Sheldon', 'q', '61300', '2015-10-14', 'Sheldon', 'single', '2015-07-13 11:41:09'),
(13, 'Neil', 'Crist', 'Resnera', '0000-00-00', '', 'Single', '2015-07-13 11:54:49');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_governmentid`
--

CREATE TABLE IF NOT EXISTS `tbl_governmentid` (
  `employee_id` varchar(10) DEFAULT NULL,
  `sss_no` int(10) DEFAULT NULL,
  `pagibig_no` int(12) DEFAULT NULL,
  `philhealth_no` int(12) DEFAULT NULL,
  `tin` int(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_governmentid`
--

INSERT INTO `tbl_governmentid` (`employee_id`, `sss_no`, `pagibig_no`, `philhealth_no`, `tin`) VALUES
('1', 1111111111, 222222222, 333333333, 444444444);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_leave_left`
--

CREATE TABLE IF NOT EXISTS `tbl_leave_left` (
  `employee_id` varchar(10) DEFAULT NULL,
  `leave_type_id` varchar(10) DEFAULT NULL,
  `leave_remaining` smallint(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_leave_left`
--

INSERT INTO `tbl_leave_left` (`employee_id`, `leave_type_id`, `leave_remaining`) VALUES
('1', 'VL', 5),
('1', 'ML', 5),
('1', 'SL', 5),
('1', 'PL', 5),
('1', 'BL', 5);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_leave_request`
--

CREATE TABLE IF NOT EXISTS `tbl_leave_request` (
  `leave_request_id` varchar(10) NOT NULL,
  `leave_type` varchar(50) DEFAULT NULL,
  `leave_reason` varchar(100) DEFAULT NULL,
  `leave_start` date DEFAULT NULL,
  `leave_end` date DEFAULT NULL,
  `leave_status` varchar(20) DEFAULT NULL,
  `approved_by` varchar(255) DEFAULT NULL,
  `date_approved` datetime DEFAULT NULL,
  `date_requested` datetime DEFAULT NULL,
  `employee_id` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_leave_type`
--

CREATE TABLE IF NOT EXISTS `tbl_leave_type` (
  `leave_type_id` varchar(10) NOT NULL,
  `leave_type_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_leave_type`
--

INSERT INTO `tbl_leave_type` (`leave_type_id`, `leave_type_name`) VALUES
('BL', 'Birthday Leave'),
('ML', 'Mandatory Leave'),
('PL', 'Paternity Leave'),
('SL', 'Sick Leave'),
('VL', 'Vacation Leave');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_materials`
--

CREATE TABLE IF NOT EXISTS `tbl_materials` (
  `item_id` varchar(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `project_id` varchar(10) NOT NULL,
  `date_issued` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_materials`
--

INSERT INTO `tbl_materials` (`item_id`, `quantity`, `price`, `project_id`, `date_issued`) VALUES
('STK1001', 20, '20000.00', 'P1001', '2015-07-08 00:00:00'),
('10004', 2, '100.00', 'P1003', '2015-07-09 00:00:00'),
('10001', 20, '500.00', 'P1001', '2015-07-30 00:00:00'),
('10001', 100, '500.00', 'P1001', '2015-07-21 00:00:00'),
('10002', 100, '7000.00', 'P1003', '2015-07-21 00:00:00'),
('10003', 100, '200.00', 'P1005', '2015-07-28 00:00:00'),
('STK1002', 2, '0.00', 'P1001', '2015-07-08 00:00:00'),
('STK1002', 2, '4000.00', 'P1001', '2015-07-08 00:00:00'),
('STK1002', 2, '4000.00', 'P1001', '2015-07-19 00:00:00'),
('STK1001', 2, '2000.00', 'P1001', '2015-07-20 00:00:00'),
('STK1002', 10, '20000.00', 'P1001', '2015-07-20 00:00:00'),
('STK1001', 20, '1000.00', 'P1001', '2015-07-21 00:00:00'),
('STK1001', 20, '1000.00', 'P1007', '2015-07-20 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payslip`
--

CREATE TABLE IF NOT EXISTS `tbl_payslip` (
  `payslip_id` int(4) NOT NULL,
  `emp_id` int(4) NOT NULL,
  `payslip_date` datetime NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `monthly_rate` decimal(8,2) NOT NULL,
  `basic_salary` decimal(8,2) NOT NULL,
  `total_overtime` decimal(8,2) NOT NULL,
  `total_tardiness` decimal(8,2) NOT NULL,
  `total_absent_amount` decimal(8,2) NOT NULL,
  `total_allowances` decimal(8,2) NOT NULL,
  `total_taxes` decimal(8,2) NOT NULL,
  `gross_pay` decimal(8,2) NOT NULL,
  `net_pay` decimal(8,2) NOT NULL,
  `remarks` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_payslip`
--

INSERT INTO `tbl_payslip` (`payslip_id`, `emp_id`, `payslip_date`, `start_date`, `end_date`, `monthly_rate`, `basic_salary`, `total_overtime`, `total_tardiness`, `total_absent_amount`, `total_allowances`, `total_taxes`, `gross_pay`, `net_pay`, `remarks`) VALUES
(8, 1, '2015-06-20 00:00:00', '2015-06-01 00:00:00', '2015-06-15 00:00:00', '40000.00', '20000.00', '1215.52', '0.00', '1841.08', '500.00', '3776.14', '19874.44', '16098.29', ''),
(9, 7, '2015-06-20 00:00:00', '2015-06-01 00:00:00', '2015-06-15 00:00:00', '15000.00', '7500.00', '455.82', '0.00', '690.66', '500.00', '1475.38', '7765.16', '6289.78', ''),
(10, 8, '2015-06-20 00:00:00', '2015-06-01 00:00:00', '2015-06-15 00:00:00', '15000.00', '7500.00', '455.82', '0.00', '690.66', '500.00', '1475.38', '7765.16', '6289.78', ''),
(11, 9, '2015-06-20 00:00:00', '2015-06-01 00:00:00', '2015-06-15 00:00:00', '15000.00', '7500.00', '455.82', '0.00', '690.66', '500.00', '1475.38', '7765.16', '6289.78', ''),
(12, 10, '2015-06-20 00:00:00', '2015-06-01 00:00:00', '2015-06-15 00:00:00', '15000.00', '7500.00', '455.82', '0.00', '690.66', '500.00', '1475.38', '7765.16', '6289.78', ''),
(13, 11, '2015-06-20 00:00:00', '2015-06-01 00:00:00', '2015-06-15 00:00:00', '15000.00', '7500.00', '455.82', '0.00', '690.66', '500.00', '1475.38', '7765.16', '6289.78', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payslip_allowances`
--

CREATE TABLE IF NOT EXISTS `tbl_payslip_allowances` (
  `payslip_allowance_id` int(11) NOT NULL,
  `payslip_id` int(11) NOT NULL,
  `allowance_id` int(11) NOT NULL,
  `percentage` decimal(3,3) NOT NULL,
  `percentage_amount` decimal(8,2) NOT NULL,
  `fixed_amount` decimal(8,2) NOT NULL,
  `total` decimal(8,2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_payslip_allowances`
--

INSERT INTO `tbl_payslip_allowances` (`payslip_allowance_id`, `payslip_id`, `allowance_id`, `percentage`, `percentage_amount`, `fixed_amount`, `total`) VALUES
(3, 7, 1, '0.000', '0.00', '300.00', '300.00'),
(4, 7, 2, '0.000', '0.00', '200.00', '200.00'),
(5, 8, 1, '0.000', '0.00', '300.00', '300.00'),
(6, 8, 2, '0.000', '0.00', '200.00', '200.00'),
(7, 9, 1, '0.000', '0.00', '300.00', '300.00'),
(8, 9, 2, '0.000', '0.00', '200.00', '200.00'),
(9, 10, 1, '0.000', '0.00', '300.00', '300.00'),
(10, 10, 2, '0.000', '0.00', '200.00', '200.00'),
(11, 11, 1, '0.000', '0.00', '300.00', '300.00'),
(12, 11, 2, '0.000', '0.00', '200.00', '200.00'),
(13, 12, 1, '0.000', '0.00', '300.00', '300.00'),
(14, 12, 2, '0.000', '0.00', '200.00', '200.00'),
(15, 13, 1, '0.000', '0.00', '300.00', '300.00'),
(16, 13, 2, '0.000', '0.00', '200.00', '200.00'),
(17, 14, 1, '0.000', '0.00', '300.00', '300.00'),
(18, 14, 2, '0.000', '0.00', '200.00', '200.00'),
(19, 15, 1, '0.000', '0.00', '300.00', '300.00'),
(20, 15, 2, '0.000', '0.00', '200.00', '200.00'),
(21, 16, 1, '0.000', '0.00', '300.00', '300.00'),
(22, 16, 2, '0.000', '0.00', '200.00', '200.00'),
(23, 17, 1, '0.000', '0.00', '300.00', '300.00'),
(24, 17, 2, '0.000', '0.00', '200.00', '200.00'),
(25, 18, 1, '0.000', '0.00', '300.00', '300.00'),
(26, 18, 2, '0.000', '0.00', '200.00', '200.00'),
(27, 19, 1, '0.000', '0.00', '300.00', '300.00'),
(28, 19, 2, '0.000', '0.00', '200.00', '200.00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payslip_taxes`
--

CREATE TABLE IF NOT EXISTS `tbl_payslip_taxes` (
  `payslip_tax_id` int(11) NOT NULL,
  `payslip_id` int(11) NOT NULL,
  `tax_id` int(11) NOT NULL,
  `percentage` decimal(3,3) NOT NULL,
  `percentage_amount` decimal(8,2) NOT NULL,
  `fixed_amount` decimal(8,2) NOT NULL,
  `total` decimal(8,2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_payslip_taxes`
--

INSERT INTO `tbl_payslip_taxes` (`payslip_tax_id`, `payslip_id`, `tax_id`, `percentage`, `percentage_amount`, `fixed_amount`, `total`) VALUES
(5, 7, 3, '0.040', '794.98', '0.00', '794.98'),
(6, 7, 4, '0.020', '397.49', '0.00', '397.49'),
(7, 7, 5, '0.010', '198.74', '0.00', '198.74'),
(8, 7, 6, '0.120', '2384.93', '0.00', '2384.93'),
(9, 8, 3, '0.040', '794.98', '0.00', '794.98'),
(10, 8, 4, '0.020', '397.49', '0.00', '397.49'),
(11, 8, 5, '0.010', '198.74', '0.00', '198.74'),
(12, 8, 6, '0.120', '2384.93', '0.00', '2384.93'),
(13, 9, 3, '0.040', '310.61', '0.00', '310.61'),
(14, 9, 4, '0.020', '155.30', '0.00', '155.30'),
(15, 9, 5, '0.010', '77.65', '0.00', '77.65'),
(16, 9, 6, '0.120', '931.82', '0.00', '931.82'),
(17, 10, 3, '0.040', '310.61', '0.00', '310.61'),
(18, 10, 4, '0.020', '155.30', '0.00', '155.30'),
(19, 10, 5, '0.010', '77.65', '0.00', '77.65'),
(20, 10, 6, '0.120', '931.82', '0.00', '931.82'),
(21, 11, 3, '0.040', '310.61', '0.00', '310.61'),
(22, 11, 4, '0.020', '155.30', '0.00', '155.30'),
(23, 11, 5, '0.010', '77.65', '0.00', '77.65'),
(24, 11, 6, '0.120', '931.82', '0.00', '931.82'),
(25, 12, 3, '0.040', '310.61', '0.00', '310.61'),
(26, 12, 4, '0.020', '155.30', '0.00', '155.30'),
(27, 12, 5, '0.010', '77.65', '0.00', '77.65'),
(28, 12, 6, '0.120', '931.82', '0.00', '931.82'),
(29, 13, 3, '0.040', '310.61', '0.00', '310.61'),
(30, 13, 4, '0.020', '155.30', '0.00', '155.30'),
(31, 13, 5, '0.010', '77.65', '0.00', '77.65'),
(32, 13, 6, '0.120', '931.82', '0.00', '931.82'),
(33, 14, 3, '0.040', '794.98', '0.00', '794.98'),
(34, 14, 4, '0.020', '397.49', '0.00', '397.49'),
(35, 14, 5, '0.010', '198.74', '0.00', '198.74'),
(36, 14, 6, '0.120', '2384.93', '0.00', '2384.93'),
(37, 15, 3, '0.040', '310.61', '0.00', '310.61'),
(38, 15, 4, '0.020', '155.30', '0.00', '155.30'),
(39, 15, 5, '0.010', '77.65', '0.00', '77.65'),
(40, 15, 6, '0.120', '931.82', '0.00', '931.82'),
(41, 16, 3, '0.040', '310.61', '0.00', '310.61'),
(42, 16, 4, '0.020', '155.30', '0.00', '155.30'),
(43, 16, 5, '0.010', '77.65', '0.00', '77.65'),
(44, 16, 6, '0.120', '931.82', '0.00', '931.82'),
(45, 17, 3, '0.040', '310.61', '0.00', '310.61'),
(46, 17, 4, '0.020', '155.30', '0.00', '155.30'),
(47, 17, 5, '0.010', '77.65', '0.00', '77.65'),
(48, 17, 6, '0.120', '931.82', '0.00', '931.82'),
(49, 18, 3, '0.040', '310.61', '0.00', '310.61'),
(50, 18, 4, '0.020', '155.30', '0.00', '155.30'),
(51, 18, 5, '0.010', '77.65', '0.00', '77.65'),
(52, 18, 6, '0.120', '931.82', '0.00', '931.82'),
(53, 19, 3, '0.040', '310.61', '0.00', '310.61'),
(54, 19, 4, '0.020', '155.30', '0.00', '155.30'),
(55, 19, 5, '0.010', '77.65', '0.00', '77.65'),
(56, 19, 6, '0.120', '931.82', '0.00', '931.82');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_project`
--

CREATE TABLE IF NOT EXISTS `tbl_project` (
  `project_id` varchar(5) NOT NULL,
  `project_name` varchar(50) NOT NULL,
  `client` varchar(50) NOT NULL,
  `starting_date` date NOT NULL,
  `ending_date` date NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_project`
--

INSERT INTO `tbl_project` (`project_id`, `project_name`, `client`, `starting_date`, `ending_date`, `date_added`) VALUES
('P1001', 'Project Almanac', 'CL1001', '2015-07-08', '2015-07-25', '2015-07-08 13:36:31'),
('P1002', 'Project Alpha', 'NASA', '2015-07-03', '0000-00-00', '2015-07-08 14:21:12'),
('P1003', 'Project X', 'Classified', '2015-07-09', '0000-00-00', '2015-07-08 18:59:33'),
('P1004', 'Project Alpha', 'NASA', '2015-07-10', '0000-00-00', '2015-07-08 19:05:40'),
('P1007', 'Project Pie', 'CL1002', '2015-07-20', '2015-07-23', '2015-07-20 01:06:53');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_requestentry`
--

CREATE TABLE IF NOT EXISTS `tbl_requestentry` (
  `req_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `date_value` date NOT NULL,
  `time_in` time NOT NULL,
  `time_out` time NOT NULL,
  `remarks` varchar(200) DEFAULT NULL,
  `date_requested` datetime NOT NULL,
  `approved` tinyint(1) DEFAULT NULL,
  `approved_by` int(11) DEFAULT NULL,
  `date_approved` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_requestentry`
--

INSERT INTO `tbl_requestentry` (`req_id`, `emp_id`, `date_value`, `time_in`, `time_out`, `remarks`, `date_requested`, `approved`, `approved_by`, `date_approved`) VALUES
(1, 2, '2015-06-22', '08:00:00', '00:00:00', NULL, '2015-07-13 00:00:00', 0, 1, '0000-00-00 00:00:00'),
(2, 3, '2015-06-22', '08:00:00', '00:00:00', NULL, '2015-07-13 00:00:00', 1, 1, '0000-00-00 00:00:00'),
(3, 4, '2015-06-22', '08:00:00', '05:00:00', NULL, '2015-07-13 00:00:00', 0, 1, '0000-00-00 00:00:00'),
(4, 5, '2015-06-22', '08:00:00', '05:00:00', NULL, '2015-07-13 00:00:00', NULL, NULL, NULL),
(5, 6, '2015-06-22', '08:00:00', '05:00:00', NULL, '2015-07-13 00:00:00', 1, 1, '0000-00-00 00:00:00'),
(6, 7, '2015-06-22', '08:00:00', '05:00:00', NULL, '2015-07-13 00:00:00', NULL, NULL, NULL),
(7, 0, '2015-06-15', '09:00:00', '04:00:00', NULL, '0000-00-00 00:00:00', 1, 1, '0000-00-00 00:00:00'),
(8, 1, '2015-06-06', '08:50:00', '12:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL, '2015-07-17 23:24:04');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_restock`
--

CREATE TABLE IF NOT EXISTS `tbl_restock` (
  `item_id` varchar(10) NOT NULL,
  `vendor_id` varchar(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `date_restock` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_restock`
--

INSERT INTO `tbl_restock` (`item_id`, `vendor_id`, `quantity`, `date_restock`) VALUES
('STK1004', 'VEN1001', 1000, '2015-07-19'),
('STK1002', 'VEN1001', 333, '2015-07-21'),
('STK1004', 'VEN1001', 10000, '2015-07-20'),
('STK1006', 'VEN1001', 737, '2015-07-31'),
('STK1006', 'VEN1001', 737, '2015-07-22'),
('STK1006', 'VEN1001', 1000, '2015-07-25'),
('STK1006', 'VEN1001', 8, '2015-07-08'),
('STK1003', 'VEN1001', 1000, '2015-07-19'),
('STK1005', 'VEN1001', 1000, '2015-07-19'),
('STK1003', 'VEN1001', 1000, '2015-07-19'),
('STK1004', 'VEN1001', 1000, '2015-07-19'),
('STK1007', 'VEN1001', 1000, '2015-07-19'),
('STK1002', 'VEN1001', 610, '2015-07-19');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_school`
--

CREATE TABLE IF NOT EXISTS `tbl_school` (
  `employee_id` int(5) DEFAULT NULL,
  `primary_name` varchar(50) DEFAULT NULL,
  `primary_address` varchar(50) DEFAULT NULL,
  `primary_year` smallint(50) DEFAULT NULL,
  `secondary_name` varchar(50) DEFAULT NULL,
  `secondary_address` varchar(50) DEFAULT NULL,
  `secondary_year` smallint(50) DEFAULT NULL,
  `tertiary_name` varchar(50) DEFAULT NULL,
  `tertiary_address` varchar(50) DEFAULT NULL,
  `tertiary_year` smallint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_school`
--

INSERT INTO `tbl_school` (`employee_id`, `primary_name`, `primary_address`, `primary_year`, `secondary_name`, `secondary_address`, `secondary_year`, `tertiary_name`, `tertiary_address`, `tertiary_year`) VALUES
(1, 'Aurora Central School', 'Aurora, Isabela', 2006, 'DANHS', 'Aurora, Isabela', 2010, 'JRU', 'Mandaluyong City', 2016);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stocks`
--

CREATE TABLE IF NOT EXISTS `tbl_stocks` (
  `item_id` varchar(10) NOT NULL,
  `quantity` varchar(50) NOT NULL,
  `date_last_restocked` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_stocks`
--

INSERT INTO `tbl_stocks` (`item_id`, `quantity`, `date_last_restocked`) VALUES
('STK1001', '960', '2015-07-18'),
('STK1002', '1100', '2015-07-19'),
('STK1003', '980', '2015-07-19'),
('STK1004', '1000', '2015-07-19'),
('STK1005', '1000', '2015-07-19'),
('STK1006', '1008', '2015-07-08'),
('STK1007', '1000', '2015-07-19');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stocks_category`
--

CREATE TABLE IF NOT EXISTS `tbl_stocks_category` (
  `category_id` varchar(10) NOT NULL,
  `category_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_stocks_category`
--

INSERT INTO `tbl_stocks_category` (`category_id`, `category_name`) VALUES
('COMP', 'Computer'),
('ELEC', 'Electronics'),
('PLSTC', 'Plastic Materials'),
('STL', 'Steel Materials'),
('WD', 'Wood Materials');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stock_info`
--

CREATE TABLE IF NOT EXISTS `tbl_stock_info` (
  `item_id` varchar(10) NOT NULL,
  `item_name` varchar(50) DEFAULT NULL,
  `category_id` varchar(10) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_stock_info`
--

INSERT INTO `tbl_stock_info` (`item_id`, `item_name`, `category_id`, `price`) VALUES
('STK1001', 'Steel Post', 'STL', '1000.00'),
('STK1002', 'Wooden Chair', 'WD', '2000.00'),
('STK1003', 'Steel Plates', 'STL', '5000.00'),
('STK1004', 'Pako', 'STL', '5.00'),
('STK1005', 'Eye of Skadiis', 'ELEC', '1000.00'),
('STK1007', 'Martilyo', 'STL', '100.00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_taxes`
--

CREATE TABLE IF NOT EXISTS `tbl_taxes` (
  `tax_id` int(4) NOT NULL,
  `tax_name` varchar(50) NOT NULL,
  `percentage` decimal(3,3) NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_taxes`
--

INSERT INTO `tbl_taxes` (`tax_id`, `tax_name`, `percentage`, `amount`, `active`) VALUES
(3, 'SSS', '0.040', '0.00', 1),
(4, 'Philhealth', '0.020', '0.00', 1),
(5, 'PagIbig', '0.010', '0.00', 1),
(6, 'Withholding', '0.120', '0.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `user_id` int(5) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `user_level` varchar(20) NOT NULL,
  `secret_question` varchar(50) NOT NULL,
  `secret_answer` varchar(50) NOT NULL,
  `employee_id` varchar(10) NOT NULL,
  `date_registered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `username`, `password`, `email`, `user_level`, `secret_question`, `secret_answer`, `employee_id`, `date_registered`) VALUES
(1, 'ardents', 'daca2125e1f1f3c5ff6e8663ab1edef3', 'ardents02@gmail.com', 'Administrator', '1', 'ardents', '1', '2015-06-05 05:28:36'),
(7, 'ardendeveloper', 'daca2125e1f1f3c5ff6e8663ab1edef3', 'ardendeveloper@gmail.com', 'Employee', '2', 'acs', '2', '2015-06-05 05:30:12'),
(9, 'ardenity', 'daca2125e1f1f3c5ff6e8663ab1edef3', 'ardents02@gmail.com', 'Manager', '1', 'pito', '3', '2015-06-05 21:34:52'),
(10, 'resnerac03', '25d55ad283aa400af464c76d713c07ad', 'resnerac03@gmail.com', 'Administrator', '2', 'asdasdasdas', '4', '2015-07-03 14:27:13'),
(11, 'ardentss', 'daca2125e1f1f3c5ff6e8663ab1edef3', 'ardentss@gmail.com', 'Administrator', '1', 'ardentss', '5', '2015-07-12 13:24:19'),
(12, 'ardentswew', '324554b6b5ff6e4f41f3bce8b0d8a157', 'ardentswew@g.c', 'Employee', '1', 'ardentswew', '6', '2015-07-12 13:28:22'),
(13, 'ardentsweww', '89e8ec248dabeea723ef2bc175288234', 'asdsadsadsad@gmail.com', 'Employee', '1', 'ardentsweww', '7', '2015-07-12 13:28:52'),
(14, 'dasdasdsad', '5e44a9ce239320776166d40c5579607e', 'asdsadsadsad@gmail.com', 'Employee', '1', 'dasdasdsad', '8', '2015-07-12 13:30:06'),
(15, 'qwewqewqewq', '26c7245d7e62a6a69404bf27886edab5', 'asdsadsadsad@gmail.com', 'Employee', '1', 'qwewqewqewq', '9', '2015-07-12 13:30:35');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vendor`
--

CREATE TABLE IF NOT EXISTS `tbl_vendor` (
  `vendor_id` varchar(10) NOT NULL,
  `vendor_name` varchar(50) NOT NULL,
  `vendor_address` varchar(50) NOT NULL,
  `vendor_contact_num` int(20) NOT NULL,
  `vendor_email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_vendor`
--

INSERT INTO `tbl_vendor` (`vendor_id`, `vendor_name`, `vendor_address`, `vendor_contact_num`, `vendor_email`) VALUES
('VEN1001', 'Secret Shop', 'Secret Lair', 999999999, 'secret@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `user_account`
--

CREATE TABLE IF NOT EXISTS `user_account` (
  `user_id` int(5) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `user_level` varchar(255) NOT NULL,
  `secret_question` varchar(255) NOT NULL,
  `secret_answer` varchar(255) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `date_registered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_account`
--

INSERT INTO `user_account` (`user_id`, `username`, `password`, `email`, `user_level`, `secret_question`, `secret_answer`, `employee_id`, `date_registered`) VALUES
(1, 'ardents', 'daca2125e1f1f3c5ff6e8663ab1edef3', 'ardents02@gmail.com', 'Administrator', 'What is your pet name?', 'ardents', 1, '2015-06-05 05:28:36'),
(7, 'ardendeveloper', 'daca2125e1f1f3c5ff6e8663ab1edef3', 'ardendeveloper@gmail.com', 'Employee', '2', 'acs', 0, '2015-06-05 05:30:12'),
(9, 'ardenity', 'daca2125e1f1f3c5ff6e8663ab1edef3', 'ardents02@gmail.com', 'Manager', '1', 'pito', 0, '2015-06-05 21:34:52'),
(10, 'resnerac03', '25d55ad283aa400af464c76d713c07ad', 'resnerac03@gmail.com', 'Administrator', '2', 'asdasdasdas', 0, '2015-07-03 14:27:13'),
(11, 'gilberto', '5f4dcc3b5aa765d61d8327deb882cf99', 'sample@email.com', 'Administrator', '1', 'Gilbert', 0, '2015-07-13 05:07:58');

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_active_employees`
--
CREATE TABLE IF NOT EXISTS `view_active_employees` (
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_all_project_materials`
--
CREATE TABLE IF NOT EXISTS `view_all_project_materials` (
`item_name` varchar(50)
,`quantity` int(10)
,`price` decimal(10,2)
,`project_name` varchar(50)
,`date_issued` datetime
,`item_id` varchar(10)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_assigned_assets`
--
CREATE TABLE IF NOT EXISTS `view_assigned_assets` (
`asset_id` varchar(10)
,`asset_name` varchar(50)
,`category_name` varchar(50)
,`asset_status` varchar(255)
,`name` varchar(152)
,`vendor_name` varchar(50)
,`asset_description` varchar(100)
,`brand` varchar(50)
,`serial_number` int(20)
,`model` varchar(50)
,`warranty_end_date` date
,`assigned_date` datetime
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_attendance`
--
CREATE TABLE IF NOT EXISTS `view_attendance` (
`emp_id` int(5)
,`first_name` varchar(50)
,`middle_name` varchar(50)
,`last_name` varchar(50)
,`position` varchar(50)
,`datelog` datetime
,`logdate` varchar(10)
,`time_in` varchar(10)
,`time_out` varchar(10)
,`man_hours` varchar(69)
,`tardiness` bigint(21)
,`overtime` varchar(67)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_dependents`
--
CREATE TABLE IF NOT EXISTS `view_dependents` (
`employee_id` varchar(10)
,`dependent_fname` varchar(50)
,`dependent_lname` varchar(50)
,`relationship` varchar(50)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_employee_info`
--
CREATE TABLE IF NOT EXISTS `view_employee_info` (
`emp_id` int(5)
,`first_name` varchar(50)
,`middle_name` varchar(50)
,`last_name` varchar(50)
,`gender` varchar(50)
,`birthday` varchar(10)
,`marital_status` varchar(50)
,`street` varchar(50)
,`barangay` varchar(50)
,`city` varchar(50)
,`state` varchar(50)
,`zip` int(10)
,`country` varchar(50)
,`mobile_number` int(20)
,`tel_number` int(20)
,`primary_name` varchar(50)
,`primary_address` varchar(50)
,`primary_year` smallint(50)
,`secondary_name` varchar(50)
,`secondary_address` varchar(50)
,`secondary_year` smallint(50)
,`tertiary_name` varchar(50)
,`tertiary_address` varchar(50)
,`tertiary_year` smallint(4)
,`username` varchar(50)
,`password` varchar(255)
,`email` varchar(50)
,`user_level` varchar(20)
,`secret_question` varchar(50)
,`secret_answer` varchar(50)
,`department` varchar(50)
,`start_date` varchar(10)
,`end_date` varchar(10)
,`salary` decimal(10,2)
,`pay_grade` varchar(5)
,`status` varchar(50)
,`contact_person` varchar(100)
,`contact_rel` varchar(30)
,`contact_num` int(20)
,`user_id` int(5)
,`job_category` varchar(50)
,`job_title` varchar(50)
,`probationary_date` varchar(10)
,`permanency_date` varchar(10)
,`num_dependents` bigint(21)
,`sss_no` int(10)
,`philhealth_no` int(12)
,`pagibig_no` int(12)
,`tin` int(12)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_leave_left`
--
CREATE TABLE IF NOT EXISTS `view_leave_left` (
`emp_id` int(5)
,`Name` varchar(152)
,`leave_type_name` varchar(50)
,`leave_remaining` smallint(2)
,`leave_type_id` varchar(10)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_project_cost`
--
CREATE TABLE IF NOT EXISTS `view_project_cost` (
`project_id` varchar(5)
,`project_name` varchar(50)
,`client_name` varchar(50)
,`price` decimal(42,2)
,`starting_date` varchar(74)
,`ending_date` varchar(73)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_stocks`
--
CREATE TABLE IF NOT EXISTS `view_stocks` (
`item_name` varchar(50)
,`category_name` varchar(50)
,`quantity` varchar(50)
,`date_last_restocked` date
,`price` decimal(10,2)
,`item_id` varchar(10)
);

-- --------------------------------------------------------

--
-- Structure for view `view_active_employees`
--
DROP TABLE IF EXISTS `view_active_employees`;
-- in use(#1356 - View 'system_draft.view_active_employees' references invalid table(s) or column(s) or function(s) or definer/invoker of view lack rights to use them)

-- --------------------------------------------------------

--
-- Structure for view `view_all_project_materials`
--
DROP TABLE IF EXISTS `view_all_project_materials`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_all_project_materials` AS select `tbl_stock_info`.`item_name` AS `item_name`,`tbl_materials`.`quantity` AS `quantity`,`tbl_materials`.`price` AS `price`,`tbl_project`.`project_name` AS `project_name`,`tbl_materials`.`date_issued` AS `date_issued`,`tbl_stock_info`.`item_id` AS `item_id` from ((`tbl_project` join `tbl_materials` on((`tbl_materials`.`project_id` = `tbl_project`.`project_id`))) join `tbl_stock_info` on((`tbl_materials`.`item_id` = `tbl_stock_info`.`item_id`)));

-- --------------------------------------------------------

--
-- Structure for view `view_assigned_assets`
--
DROP TABLE IF EXISTS `view_assigned_assets`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_assigned_assets` AS select `tbl_asset_info`.`asset_id` AS `asset_id`,`tbl_asset_info`.`asset_name` AS `asset_name`,`tbl_stocks_category`.`category_name` AS `category_name`,`tbl_assets`.`asset_status` AS `asset_status`,concat(`tbl_emp_info`.`first_name`,' ',`tbl_emp_info`.`middle_name`,' ',`tbl_emp_info`.`last_name`) AS `name`,`tbl_vendor`.`vendor_name` AS `vendor_name`,`tbl_asset_info`.`asset_description` AS `asset_description`,`tbl_asset_info`.`brand` AS `brand`,`tbl_asset_info`.`serial_number` AS `serial_number`,`tbl_asset_info`.`model` AS `model`,`tbl_asset_info`.`warranty_end_date` AS `warranty_end_date`,`tbl_assets`.`assigned_date` AS `assigned_date` from ((((`tbl_stocks_category` join `tbl_asset_info` on((`tbl_asset_info`.`category_id` = `tbl_stocks_category`.`category_id`))) join `tbl_assets` on((`tbl_assets`.`asset_id` = `tbl_asset_info`.`asset_id`))) join `tbl_emp_info` on((`tbl_assets`.`employee_id` = `tbl_emp_info`.`emp_id`))) join `tbl_vendor` on((`tbl_vendor`.`vendor_id` = `tbl_asset_info`.`vendor_id`)));

-- --------------------------------------------------------

--
-- Structure for view `view_attendance`
--
DROP TABLE IF EXISTS `view_attendance`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_attendance` AS select distinct `employees`.`emp_id` AS `emp_id`,`employees`.`first_name` AS `first_name`,`employees`.`middle_name` AS `middle_name`,`employees`.`last_name` AS `last_name`,`employees`.`position` AS `position`,`tbl_attendance`.`datelog` AS `datelog`,date_format(`tbl_attendance`.`datetimelog`,'%m/%d/%Y') AS `logdate`,`FN_GETTIMEIN`(date_format(`tbl_attendance`.`datetimelog`,'%m/%d/%Y')) AS `time_in`,`FN_GETTIMEOUT`(date_format(`tbl_attendance`.`datetimelog`,'%m/%d/%Y')) AS `time_out`,ifnull(if((timestampdiff(MINUTE,str_to_date(concat('01/01/1970 ',`FN_GETTIMEIN`(date_format(`tbl_attendance`.`datetimelog`,'%m/%d/%Y'))),'%c/%e/%Y %h:%i %p'),str_to_date(concat('01/01/1970 ',`FN_GETTIMEOUT`(date_format(`tbl_attendance`.`datetimelog`,'%m/%d/%Y'))),'%c/%e/%Y %h:%i %p')) >= 0),format(((timestampdiff(MINUTE,str_to_date(concat('01/01/1970 ',`FN_GETTIMEIN`(date_format(`tbl_attendance`.`datetimelog`,'%m/%d/%Y'))),'%c/%e/%Y %h:%i %p'),str_to_date(concat('01/01/1970 ',`FN_GETTIMEOUT`(date_format(`tbl_attendance`.`datetimelog`,'%m/%d/%Y'))),'%c/%e/%Y %h:%i %p')) / 60) - 1),2),0),0) AS `man_hours`,ifnull(if((timestampdiff(MINUTE,str_to_date('01/01/1970 08:00 AM','%c/%e/%Y %h:%i %p'),str_to_date(concat('01/01/1970 ',`FN_GETTIMEIN`(date_format(`tbl_attendance`.`datetimelog`,'%m/%d/%Y'))),'%c/%e/%Y %h:%i %p')) >= 0),timestampdiff(MINUTE,str_to_date('01/01/1970 08:00 AM','%c/%e/%Y %h:%i %p'),str_to_date(concat('01/01/1970 ',`FN_GETTIMEIN`(date_format(`tbl_attendance`.`datetimelog`,'%m/%d/%Y'))),'%c/%e/%Y %h:%i %p')),0),0) AS `tardiness`,ifnull(if((timestampdiff(MINUTE,str_to_date('01/01/1970 05:00 PM','%c/%e/%Y %h:%i %p'),str_to_date(concat('01/01/1970 ',`FN_GETTIMEOUT`(date_format(`tbl_attendance`.`datetimelog`,'%m/%d/%Y'))),'%c/%e/%Y %h:%i %p')) >= 0),format((timestampdiff(MINUTE,str_to_date('01/01/1970 05:00 PM','%c/%e/%Y %h:%i %p'),str_to_date(concat('01/01/1970 ',`FN_GETTIMEOUT`(date_format(`tbl_attendance`.`datetimelog`,'%m/%d/%Y'))),'%c/%e/%Y %h:%i %p')) / 60),2),0),0) AS `overtime` from (`employees` join `tbl_attendance` on((`tbl_attendance`.`emp_id` = `employees`.`emp_id`))) order by `employees`.`emp_id`,6;

-- --------------------------------------------------------

--
-- Structure for view `view_dependents`
--
DROP TABLE IF EXISTS `view_dependents`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_dependents` AS select `tbl_dependent_info`.`employee_id` AS `employee_id`,`tbl_dependent`.`dependent_fname` AS `dependent_fname`,`tbl_dependent`.`dependent_lname` AS `dependent_lname`,`tbl_dependent_info`.`relationship` AS `relationship` from (`tbl_dependent` join `tbl_dependent_info` on((`tbl_dependent`.`dependent_id` = `tbl_dependent_info`.`dependent_id`)));

-- --------------------------------------------------------

--
-- Structure for view `view_employee_info`
--
DROP TABLE IF EXISTS `view_employee_info`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_employee_info` AS select `tbl_emp_info`.`emp_id` AS `emp_id`,`tbl_emp_info`.`first_name` AS `first_name`,`tbl_emp_info`.`middle_name` AS `middle_name`,`tbl_emp_info`.`last_name` AS `last_name`,`tbl_emp_info`.`gender` AS `gender`,date_format(`tbl_emp_info`.`birthday`,'%m-%d-%Y') AS `birthday`,`tbl_emp_info`.`marital_status` AS `marital_status`,`tbl_address`.`street` AS `street`,`tbl_address`.`barangay` AS `barangay`,`tbl_address`.`city` AS `city`,`tbl_address`.`state` AS `state`,`tbl_address`.`zip` AS `zip`,`tbl_address`.`country` AS `country`,`tbl_contact_number`.`mobile_number` AS `mobile_number`,`tbl_contact_number`.`tel_number` AS `tel_number`,`tbl_school`.`primary_name` AS `primary_name`,`tbl_school`.`primary_address` AS `primary_address`,`tbl_school`.`primary_year` AS `primary_year`,`tbl_school`.`secondary_name` AS `secondary_name`,`tbl_school`.`secondary_address` AS `secondary_address`,`tbl_school`.`secondary_year` AS `secondary_year`,`tbl_school`.`tertiary_name` AS `tertiary_name`,`tbl_school`.`tertiary_address` AS `tertiary_address`,`tbl_school`.`tertiary_year` AS `tertiary_year`,`tbl_user`.`username` AS `username`,`tbl_user`.`password` AS `password`,`tbl_user`.`email` AS `email`,`tbl_user`.`user_level` AS `user_level`,`tbl_user`.`secret_question` AS `secret_question`,`tbl_user`.`secret_answer` AS `secret_answer`,`tbl_emp_history`.`department` AS `department`,date_format(`tbl_emp_history`.`start_date`,'%m-%d-%Y') AS `start_date`,date_format(`tbl_emp_history`.`end_date`,'%m-%d-%Y') AS `end_date`,`tbl_emp_history`.`salary` AS `salary`,`tbl_emp_history`.`pay_grade` AS `pay_grade`,`tbl_emp_history`.`status` AS `status`,`tbl_contact_person`.`contact_person` AS `contact_person`,`tbl_contact_person`.`contact_rel` AS `contact_rel`,`tbl_contact_person`.`contact_num` AS `contact_num`,`tbl_user`.`user_id` AS `user_id`,`tbl_emp_history`.`job_category` AS `job_category`,`tbl_emp_history`.`job_title` AS `job_title`,date_format(`tbl_emp_history`.`probationary_date`,'%m-%d-%Y') AS `probationary_date`,date_format(`tbl_emp_history`.`permanency_date`,'%m-%d-%Y') AS `permanency_date`,count(`tbl_dependent_info`.`dependent_id`) AS `num_dependents`,`tbl_governmentid`.`sss_no` AS `sss_no`,`tbl_governmentid`.`philhealth_no` AS `philhealth_no`,`tbl_governmentid`.`pagibig_no` AS `pagibig_no`,`tbl_governmentid`.`tin` AS `tin` from ((((((((`tbl_emp_info` join `tbl_contact_number` on((`tbl_emp_info`.`emp_id` = `tbl_contact_number`.`employee_id`))) join `tbl_address` on((`tbl_emp_info`.`emp_id` = `tbl_address`.`employee_id`))) join `tbl_emp_history` on((`tbl_emp_info`.`emp_id` = `tbl_emp_history`.`emp_id`))) join `tbl_school` on((`tbl_emp_info`.`emp_id` = `tbl_school`.`employee_id`))) join `tbl_user` on((`tbl_emp_info`.`emp_id` = `tbl_user`.`employee_id`))) join `tbl_contact_person` on((`tbl_emp_info`.`emp_id` = `tbl_contact_person`.`employee_id`))) join `tbl_dependent_info` on((`tbl_emp_info`.`emp_id` = `tbl_dependent_info`.`employee_id`))) join `tbl_governmentid` on((`tbl_emp_info`.`emp_id` = `tbl_governmentid`.`employee_id`))) group by `tbl_emp_info`.`emp_id`,`tbl_emp_info`.`first_name`,`tbl_emp_info`.`middle_name`,`tbl_emp_info`.`last_name`,`tbl_emp_info`.`gender`,`tbl_emp_info`.`marital_status`,`tbl_address`.`street`,`tbl_address`.`barangay`,`tbl_address`.`city`,`tbl_address`.`state`,`tbl_address`.`zip`,`tbl_address`.`country`,`tbl_contact_number`.`mobile_number`,`tbl_contact_number`.`tel_number`,`tbl_school`.`primary_name`,`tbl_school`.`primary_address`,`tbl_school`.`primary_year`,`tbl_school`.`secondary_name`,`tbl_school`.`secondary_address`,`tbl_school`.`secondary_year`,`tbl_school`.`tertiary_name`,`tbl_school`.`tertiary_address`,`tbl_school`.`tertiary_year`,`tbl_user`.`username`,`tbl_user`.`password`,`tbl_user`.`email`,`tbl_user`.`user_level`,`tbl_user`.`secret_question`,`tbl_user`.`secret_answer`,`tbl_emp_history`.`department`,`tbl_emp_history`.`start_date`,`tbl_emp_history`.`end_date`,`tbl_emp_history`.`salary`,`tbl_emp_history`.`pay_grade`,`tbl_emp_history`.`status`,`tbl_contact_person`.`contact_person`,`tbl_contact_person`.`contact_rel`,`tbl_contact_person`.`contact_num`,`tbl_user`.`user_id`,`tbl_emp_history`.`job_category`,`tbl_emp_history`.`job_title`,`tbl_emp_history`.`probationary_date`,`tbl_emp_history`.`permanency_date`;

-- --------------------------------------------------------

--
-- Structure for view `view_leave_left`
--
DROP TABLE IF EXISTS `view_leave_left`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_leave_left` AS select `tbl_emp_info`.`emp_id` AS `emp_id`,concat(`tbl_emp_info`.`first_name`,' ',`tbl_emp_info`.`middle_name`,' ',`tbl_emp_info`.`last_name`) AS `Name`,`tbl_leave_type`.`leave_type_name` AS `leave_type_name`,`tbl_leave_left`.`leave_remaining` AS `leave_remaining`,`tbl_leave_type`.`leave_type_id` AS `leave_type_id` from ((`tbl_leave_left` join `tbl_leave_type` on((`tbl_leave_left`.`leave_type_id` = `tbl_leave_type`.`leave_type_id`))) join `tbl_emp_info` on((`tbl_emp_info`.`emp_id` = `tbl_leave_left`.`employee_id`)));

-- --------------------------------------------------------

--
-- Structure for view `view_project_cost`
--
DROP TABLE IF EXISTS `view_project_cost`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_project_cost` AS select `tbl_project`.`project_id` AS `project_id`,`tbl_project`.`project_name` AS `project_name`,`tbl_client`.`client_name` AS `client_name`,sum((`tbl_materials`.`price` * `tbl_materials`.`quantity`)) AS `price`,date_format(`tbl_project`.`starting_date`,'%M %d, 	%Y') AS `starting_date`,date_format(`tbl_project`.`ending_date`,'%M %d, %Y') AS `ending_date` from ((`tbl_materials` join `tbl_project` on((`tbl_project`.`project_id` = `tbl_materials`.`project_id`))) join `tbl_client` on((`tbl_client`.`client_id` = `tbl_project`.`client`))) group by `tbl_project`.`project_id`,`tbl_project`.`project_name`,`tbl_client`.`client_name`;

-- --------------------------------------------------------

--
-- Structure for view `view_stocks`
--
DROP TABLE IF EXISTS `view_stocks`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_stocks` AS select `tbl_stock_info`.`item_name` AS `item_name`,`tbl_stocks_category`.`category_name` AS `category_name`,`tbl_stocks`.`quantity` AS `quantity`,`tbl_stocks`.`date_last_restocked` AS `date_last_restocked`,`tbl_stock_info`.`price` AS `price`,`tbl_stocks`.`item_id` AS `item_id` from ((`tbl_stock_info` join `tbl_stocks_category` on((`tbl_stock_info`.`category_id` = `tbl_stocks_category`.`category_id`))) join `tbl_stocks` on((`tbl_stocks`.`item_id` = `tbl_stock_info`.`item_id`)));

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assets`
--
ALTER TABLE `assets`
  ADD PRIMARY KEY (`asset_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `emp_performance`
--
ALTER TABLE `emp_performance`
  ADD PRIMARY KEY (`performance_id`);

--
-- Indexes for table `leaves`
--
ALTER TABLE `leaves`
  ADD PRIMARY KEY (`leave_id`);

--
-- Indexes for table `tbl_address`
--
ALTER TABLE `tbl_address`
  ADD PRIMARY KEY (`emp_address_id`);

--
-- Indexes for table `tbl_allowances`
--
ALTER TABLE `tbl_allowances`
  ADD PRIMARY KEY (`allowance_id`);

--
-- Indexes for table `tbl_assets`
--
ALTER TABLE `tbl_assets`
  ADD PRIMARY KEY (`asset_id`);

--
-- Indexes for table `tbl_asset_info`
--
ALTER TABLE `tbl_asset_info`
  ADD PRIMARY KEY (`asset_id`);

--
-- Indexes for table `tbl_attendance`
--
ALTER TABLE `tbl_attendance`
  ADD PRIMARY KEY (`attendance_id`);

--
-- Indexes for table `tbl_client`
--
ALTER TABLE `tbl_client`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `tbl_contact_person`
--
ALTER TABLE `tbl_contact_person`
  ADD PRIMARY KEY (`cperson_id`);

--
-- Indexes for table `tbl_departments`
--
ALTER TABLE `tbl_departments`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `tbl_dependent`
--
ALTER TABLE `tbl_dependent`
  ADD PRIMARY KEY (`dependent_id`);

--
-- Indexes for table `tbl_emp_history`
--
ALTER TABLE `tbl_emp_history`
  ADD PRIMARY KEY (`emp_history_id`);

--
-- Indexes for table `tbl_emp_info`
--
ALTER TABLE `tbl_emp_info`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `tbl_leave_request`
--
ALTER TABLE `tbl_leave_request`
  ADD PRIMARY KEY (`leave_request_id`);

--
-- Indexes for table `tbl_leave_type`
--
ALTER TABLE `tbl_leave_type`
  ADD PRIMARY KEY (`leave_type_id`);

--
-- Indexes for table `tbl_payslip`
--
ALTER TABLE `tbl_payslip`
  ADD PRIMARY KEY (`payslip_id`);

--
-- Indexes for table `tbl_payslip_allowances`
--
ALTER TABLE `tbl_payslip_allowances`
  ADD PRIMARY KEY (`payslip_allowance_id`);

--
-- Indexes for table `tbl_payslip_taxes`
--
ALTER TABLE `tbl_payslip_taxes`
  ADD PRIMARY KEY (`payslip_tax_id`);

--
-- Indexes for table `tbl_project`
--
ALTER TABLE `tbl_project`
  ADD PRIMARY KEY (`project_id`);

--
-- Indexes for table `tbl_requestentry`
--
ALTER TABLE `tbl_requestentry`
  ADD PRIMARY KEY (`req_id`);

--
-- Indexes for table `tbl_stocks`
--
ALTER TABLE `tbl_stocks`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `tbl_stocks_category`
--
ALTER TABLE `tbl_stocks_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `tbl_stock_info`
--
ALTER TABLE `tbl_stock_info`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `tbl_taxes`
--
ALTER TABLE `tbl_taxes`
  ADD PRIMARY KEY (`tax_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tbl_vendor`
--
ALTER TABLE `tbl_vendor`
  ADD PRIMARY KEY (`vendor_id`);

--
-- Indexes for table `user_account`
--
ALTER TABLE `user_account`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `emp_id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `emp_performance`
--
ALTER TABLE `emp_performance`
  MODIFY `performance_id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `leaves`
--
ALTER TABLE `leaves`
  MODIFY `leave_id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tbl_allowances`
--
ALTER TABLE `tbl_allowances`
  MODIFY `allowance_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_attendance`
--
ALTER TABLE `tbl_attendance`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=243;
--
-- AUTO_INCREMENT for table `tbl_emp_history`
--
ALTER TABLE `tbl_emp_history`
  MODIFY `emp_history_id` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=100;
--
-- AUTO_INCREMENT for table `tbl_emp_info`
--
ALTER TABLE `tbl_emp_info`
  MODIFY `emp_id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `tbl_payslip`
--
ALTER TABLE `tbl_payslip`
  MODIFY `payslip_id` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `tbl_payslip_allowances`
--
ALTER TABLE `tbl_payslip_allowances`
  MODIFY `payslip_allowance_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `tbl_payslip_taxes`
--
ALTER TABLE `tbl_payslip_taxes`
  MODIFY `payslip_tax_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT for table `tbl_requestentry`
--
ALTER TABLE `tbl_requestentry`
  MODIFY `req_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tbl_taxes`
--
ALTER TABLE `tbl_taxes`
  MODIFY `tax_id` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `user_account`
--
ALTER TABLE `user_account`
  MODIFY `user_id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
