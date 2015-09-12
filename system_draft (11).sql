-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 12, 2015 at 05:16 PM
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
DROP FUNCTION IF EXISTS `fn_generate_emp_id`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `fn_generate_emp_id`() RETURNS varchar(20) CHARSET latin1
BEGIN
	#Routine body goes here...
DECLARE empID VARCHAR(20);
SELECT CONCAT('EMP-', (COUNT(*)+1)) INTO empID
FROM tbl_emp_info;
	RETURN empID;
END$$

DROP FUNCTION IF EXISTS `fn_getTaxComputation`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `fn_getTaxComputation`(taxID int, amount decimal(8, 2)) RETURNS decimal(8,2)
BEGIN
	DECLARE temp_amount_deducted DECIMAL(8, 2);
	DECLARE var_amount_deducted DECIMAL(8, 2);
    DECLARE var_tax_ranged INT;
    
    SELECT ranges_active INTO var_tax_ranged
    FROM tbl_taxes
    WHERE tax_id = taxID;
    
    CASE var_tax_ranged
		WHEN 1 THEN
			SELECT amount_deducted INTO temp_amount_deducted
			FROM tbl_tax_range
			WHERE tax_id = taxID AND amount BETWEEN amount_from AND amount_to;
		ELSE
			SELECT (amount*percentage) + tbl_taxes.amount INTO temp_amount_deducted 
            FROM tbl_taxes 
            WHERE tax_id = taxID;
	END CASE;
    
    SET var_amount_deducted = IFNULL(temp_amount_deducted, (SELECT (amount*percentage) + tbl_taxes.amount FROM tbl_taxes WHERE tax_id = taxID));
RETURN var_amount_deducted;
END$$

DROP FUNCTION IF EXISTS `fn_getTimeIn`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `fn_getTimeIn`(logdate varchar(12)) RETURNS varchar(10) CHARSET utf8 COLLATE utf8_unicode_ci
BEGIN
	DECLARE logtime varchar(10);
	SELECT DATE_FORMAT(MIN(tbl_attendance.datetimelog), '%h:%i %p') INTO logtime
    FROM `tbl_attendance`
    WHERE DATE_FORMAT(`tbl_attendance`.`datetimelog`,'%m/%d/%Y') = logdate AND tbl_attendance.`event` = 'IN';
    
RETURN logtime;
END$$

DROP FUNCTION IF EXISTS `fn_getTimeOut`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `fn_getTimeOut`(logdate varchar(12)) RETURNS varchar(10) CHARSET utf8 COLLATE utf8_unicode_ci
BEGIN
	DECLARE logtime varchar(10);

	SELECT DATE_FORMAT(MIN(tbl_attendance.datetimelog), '%h:%i %p') INTO logtime
    FROM `tbl_attendance`
    WHERE DATE_FORMAT(`tbl_attendance`.`datetimelog`,'%m/%d/%Y') = logdate AND tbl_attendance.`event` = 'OUT';
    
RETURN logtime;
END$$

DROP FUNCTION IF EXISTS `fn_getTotalManHours`$$
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

DROP FUNCTION IF EXISTS `fn_getTotalOvertime`$$
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

DROP FUNCTION IF EXISTS `fn_getTotalTardiness`$$
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
-- Table structure for table `tbl_201_file`
--

DROP TABLE IF EXISTS `tbl_201_file`;
CREATE TABLE IF NOT EXISTS `tbl_201_file` (
  `file_id` varchar(10) NOT NULL,
  `file_name` varchar(50) DEFAULT NULL,
  `emp_id` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_address`
--

DROP TABLE IF EXISTS `tbl_address`;
CREATE TABLE IF NOT EXISTS `tbl_address` (
  `employee_id` varchar(8) DEFAULT NULL,
  `street` varchar(50) DEFAULT NULL,
  `barangay` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `zip` int(10) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_address`
--

INSERT INTO `tbl_address` (`employee_id`, `street`, `barangay`, `city`, `state`, `zip`, `country`) VALUES
('EMP002', 'Toge', 'Walang Bunga', 'Taguig City', 'Metro Manila', 1125, 'PH'),
('EMP003', 'Batas', 'Soccorro', 'Quezon City', 'Metro Manila', 2234, 'PH'),
('EMP004', 'Maginhawa', 'Katips', 'Quezon City', 'Metro Manila', 1133, 'PH'),
('EMP005', 'None', 'Macatal', 'Aurora', 'Isabela', 5522, 'PH'),
('EMP006', 'Jenny', 'Rosario', 'Pasig City', 'Metro Manila', 2356, 'BS'),
('EMP007', 'e', 'e', 'e', 'e', 11, 'BS'),
('EMP001', 'Jenny''s', 'Maybunga', 'pasig City', 'Metro Manila', 1607, 'PH'),
('EMP008', 'Holly', 'Wood', 'City', 'California', 2233, 'AR');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_allowances`
--

DROP TABLE IF EXISTS `tbl_allowances`;
CREATE TABLE IF NOT EXISTS `tbl_allowances` (
  `allowance_id` int(11) NOT NULL,
  `allowance_name` varchar(50) NOT NULL,
  `percentage` decimal(3,3) NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_allowances`
--

INSERT INTO `tbl_allowances` (`allowance_id`, `allowance_name`, `percentage`, `amount`, `active`) VALUES
(1, 'Communication Allowance', '0.000', '300.00', 1),
(2, 'Transportation Allowance', '0.000', '200.00', 1),
(3, 'Travel', '0.999', '1000.00', 1),
(4, 'Food', '0.120', '200.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_announcement`
--

DROP TABLE IF EXISTS `tbl_announcement`;
CREATE TABLE IF NOT EXISTS `tbl_announcement` (
  `announcement_id` int(5) unsigned zerofill NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `posted_by` varchar(50) DEFAULT NULL,
  `date_posted` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_announcement`
--

INSERT INTO `tbl_announcement` (`announcement_id`, `description`, `posted_by`, `date_posted`) VALUES
(00001, 'Merry Christmas!', 'Administrator Arden', '2015-09-01 01:20:03'),
(00002, 'No Work for tomorrow (Sept 2, 2015, Tuesday)', 'Administrator Arden', '2015-09-01 01:20:35'),
(00003, 'Happy New Year!', 'Administrator Arden', '2015-09-01 01:20:50'),
(00004, 'Happy na Birthday pa', 'Administrator Arden', '2015-09-01 02:09:42'),
(00005, 'Hello Welcome! Enjoy your day.', 'HR Manager Ardensssss', '2015-09-01 06:35:43'),
(00006, '', 'HR Manager Ardensssss', '2015-09-01 06:36:20'),
(00007, 'No Work for tomorrow. Holiday', 'HR Manager Ardensssss', '2015-09-01 06:36:42'),
(00008, 'Holiday', 'Administrator Ardensssss', '2015-09-01 07:05:10'),
(00009, 'Hello? Is it me youre looking for.', 'Administrator Arden', '2015-09-05 21:37:43'),
(00010, 'It''s a beautiful day and I can''t stop my self from smiling.', 'HR Manager Bong', '2015-09-08 11:34:53');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_assets`
--

DROP TABLE IF EXISTS `tbl_assets`;
CREATE TABLE IF NOT EXISTS `tbl_assets` (
  `asset_id` varchar(10) DEFAULT NULL,
  `employee_id` varchar(8) DEFAULT NULL,
  `asset_status` varchar(255) DEFAULT NULL,
  `assigned_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_assets`
--

INSERT INTO `tbl_assets` (`asset_id`, `employee_id`, `asset_status`, `assigned_date`) VALUES
('EQ1001', '0', 'asd', '2015-08-31 00:00:00'),
('EQ1002', '0', 'Damaged', '2015-07-14 00:00:00'),
('EQ1003', '0', 'Destroyed', '2015-08-12 00:00:00'),
('EQ1004', '0', 'Brand New', '2015-07-20 00:00:00'),
('EQ1005', '0', 'Damaged', '2015-07-21 00:00:00'),
('EQ1006', '0', 'Bago to!', '2015-08-06 00:00:00'),
('EQ1007', '0', 'Destroyed', '2015-08-07 00:00:00'),
('EQ1008', '0', '2nd Hand', '2015-07-12 20:46:13'),
('EQ1009', '0', 'Brand New', '2015-07-20 00:00:00'),
('EQ10010', '0', 'Damaged', '2015-07-21 00:00:00'),
('EQ1013', '0', 'Brand New', NULL),
('EQ1011', '0', 'Brand New', NULL),
('EQ1014', '0', 'Brand New', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_asset_info`
--

DROP TABLE IF EXISTS `tbl_asset_info`;
CREATE TABLE IF NOT EXISTS `tbl_asset_info` (
  `asset_id` varchar(10) NOT NULL,
  `asset_name` varchar(50) DEFAULT NULL,
  `asset_description` varchar(100) DEFAULT NULL,
  `asset_price` decimal(10,0) DEFAULT NULL,
  `category_id` varchar(50) DEFAULT NULL,
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

INSERT INTO `tbl_asset_info` (`asset_id`, `asset_name`, `asset_description`, `asset_price`, `category_id`, `brand`, `serial_number`, `model`, `vendor_id`, `warranty_end_date`, `date_acquired`) VALUES
('EQ1001', 'Toshiba Laptop', 'It is an awesome laptop.', '50000', 'COMP', 'Toshiba', 1231231, 'Satellite S10', 'VEN1001', '2015-07-25', '2015-07-18'),
('EQ1002', 'Office Table', 'eqwewewe   ', '11111', 'PLSTC', 'Unbranded', 1231231, 'N/A', 'VEN1001', NULL, '2012-07-18'),
('EQ1003', 'Zanpaktou', 'Sharp Sword', '1000', 'PLSTC', 'Unbranded', 1231231, 'N/A', 'VEN1001', '2015-07-21', '2015-07-13'),
('EQ1004', 'Steel Chair', 'Steel Chair for Wrestling', '2000', 'STL', 'Unbranded', 1231231, 'N/A', 'VEN1001', NULL, '2015-07-21'),
('EQ1005', 'Martilyo ni Thor!''', 'Sharp Sword', '3000', 'PLSTC', 'CD R-king', 1231231, 'Super Model', 'VEN1001', '2015-07-22', '2015-07-02'),
('EQ1006', 'Iron Man Suit', 'It is an awesome laptop. ', '4000', 'COMP', 'Toshiba', 1111111111, 'Satellite S10', 'VEN1001', NULL, '2015-07-18'),
('EQ1007', 'Batman Mask', 'It is a table. Duh!', '5000', 'WD', 'Unbranded', 1231231, '', 'VEN1001', '2015-08-29', '2015-07-18'),
('EQ1008', 'Superman Cape', 'Sharp Sword', '6000', 'ELEC', 'Unbranded', 1231231, 'N/A', 'VEN1001', '2015-07-21', '2015-07-13'),
('EQ1009', 'Wolverine Claw', 'Steel Chair for Wrestling', '7000', 'SC', 'Unbranded', 1231231, 'N/A', 'VEN1001', '0000-00-00', '2015-07-21'),
('EQ1010', 'Hulk Formula', 'Sharp Sword', '8000', 'SC', 'CD R-king', 1231231, 'Super Model', 'VEN1001', '2015-07-22', '2015-07-02'),
('EQ1011', 'Nicole', 'Stupid', '2123', 'WD', 'Unbranded', 0, 'N/A', 'VEN1002', NULL, '2015-08-19'),
('EQ1013', 'TV', 'Malaki', '12000', 'ELEC', 'Bear', 123456, '3', 'VEN1002', '2015-09-29', '2015-08-24'),
('EQ1014', 'Mouse', 'Daga', '1000', 'ELEC', 'Unbranded', 0, 'N/A', 'VEN1002', NULL, '2015-07-29');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_asset_request`
--

DROP TABLE IF EXISTS `tbl_asset_request`;
CREATE TABLE IF NOT EXISTS `tbl_asset_request` (
  `asset_request_id` smallint(5) unsigned zerofill NOT NULL,
  `asset_name` varchar(50) DEFAULT NULL,
  `quantity` smallint(6) DEFAULT NULL,
  `request_status` varchar(20) DEFAULT NULL,
  `employee_id` varchar(8) DEFAULT NULL,
  `date_approved` datetime DEFAULT NULL,
  `approved_by` varchar(50) DEFAULT NULL,
  `date_requested` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_asset_request`
--

INSERT INTO `tbl_asset_request` (`asset_request_id`, `asset_name`, `quantity`, `request_status`, `employee_id`, `date_approved`, `approved_by`, `date_requested`) VALUES
(00001, 'Palakol', 1, 'Approved', '', '2015-08-31 00:00:00', 'Administrator Arden', '2015-09-07 07:45:24'),
(00002, 'Martilyo', 2, 'Denied', '', '2015-08-31 00:00:00', 'Administrator Arden', '2015-09-07 07:45:25'),
(00003, 'Pencil', 5, 'Denied', '', '2015-08-31 00:00:00', 'Administrator Arden', '2015-09-07 07:45:26'),
(00004, 'Palakol', 2, 'Pending', NULL, NULL, NULL, '2015-09-01 02:13:43'),
(00005, 'Palakol', 2, 'Pending', NULL, NULL, NULL, '2015-09-01 02:30:05'),
(00007, 'Desktop', 1, 'Pending', '', NULL, 'Null', '2015-09-07 07:45:27'),
(00008, 'Palakol', 2, 'Pending', '', NULL, 'Null', '2015-09-07 07:45:29'),
(00009, 'Desktop', 1, 'Pending', 'EMP004', NULL, 'Null', '2015-09-09 08:21:47');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_attendance`
--

DROP TABLE IF EXISTS `tbl_attendance`;
CREATE TABLE IF NOT EXISTS `tbl_attendance` (
  `attendance_id` int(11) NOT NULL,
  `emp_id` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `datelog` datetime DEFAULT NULL,
  `datetimelog` datetime NOT NULL,
  `event` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `datetimefetch` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_attendance`
--

INSERT INTO `tbl_attendance` (`attendance_id`, `emp_id`, `datelog`, `datetimelog`, `event`, `datetimefetch`) VALUES
(1, 'EMP001', '2015-06-05 00:00:00', '2015-06-05 06:28:36', 'IN', '2015-06-05 06:30:00'),
(2, 'EMP001', '2015-06-05 00:00:00', '2015-06-05 06:28:36', 'IN', '2015-06-05 06:30:00'),
(3, 'EMP001', '2015-06-01 00:00:00', '2015-06-01 07:28:36', 'IN', '2015-06-05 06:30:00'),
(4, 'EMP001', '2015-06-01 00:00:00', '2015-06-01 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(5, 'EMP001', '2015-06-02 00:00:00', '2015-06-02 07:28:36', 'IN', '2015-06-05 06:30:00'),
(6, 'EMP001', '2015-06-02 00:00:00', '2015-06-02 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(7, 'EMP001', '2015-06-03 00:00:00', '2015-06-03 07:28:36', 'IN', '2015-06-05 06:30:00'),
(8, 'EMP001', '2015-06-03 00:00:00', '2015-06-03 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(9, 'EMP001', '2015-06-04 00:00:00', '2015-06-04 07:28:36', 'IN', '2015-06-05 06:30:00'),
(10, 'EMP001', '2015-06-04 00:00:00', '2015-06-04 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(11, 'EMP001', '2015-06-05 00:00:00', '2015-06-05 07:28:36', 'IN', '2015-06-05 06:30:00'),
(12, 'EMP001', '2015-06-05 00:00:00', '2015-06-05 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(13, 'EMP001', '2015-06-08 00:00:00', '2015-06-08 07:28:36', 'IN', '2015-06-05 06:30:00'),
(14, 'EMP001', '2015-06-08 00:00:00', '2015-06-08 17:28:36', 'OUT', '2015-06-05 06:30:00'),
(17, 'EMP001', '2015-06-10 00:00:00', '2015-06-10 07:28:36', 'IN', '2015-06-05 06:30:00'),
(18, 'EMP001', '2015-06-10 00:00:00', '2015-06-10 17:28:36', 'OUT', '2015-06-05 06:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_audit_trail`
--

DROP TABLE IF EXISTS `tbl_audit_trail`;
CREATE TABLE IF NOT EXISTS `tbl_audit_trail` (
  `audit_trail_id` smallint(5) unsigned zerofill NOT NULL,
  `ip_address` varchar(15) DEFAULT NULL,
  `user_level` varchar(20) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `action` varchar(50) DEFAULT NULL,
  `employee_id` varchar(8) DEFAULT NULL,
  `date_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_audit_trail`
--

INSERT INTO `tbl_audit_trail` (`audit_trail_id`, `ip_address`, `user_level`, `username`, `action`, `employee_id`, `date_time`) VALUES
(00001, '::1', 'Administrator', 'ardents', 'CREATED Employee Profile', '', '2015-09-07 06:11:34'),
(00002, '::1', 'Administrator', 'ardents', 'CREATED Employee Profile', '', '2015-09-07 06:20:14'),
(00003, '::1', 'Administrator', 'ardents', 'CREATED Employee Profile', 'Array', '2015-09-07 06:32:32'),
(00004, '::1', 'Administrator', 'ardents', 'CREATED Employee Profile', 'Array', '2015-09-07 06:33:56'),
(00005, '::1', 'Administrator', 'ardents', 'CREATED Employee Profile', 'Array', '2015-09-07 06:38:06'),
(00006, '::1', 'Administrator', 'ardents', 'CREATED Employee Profile', 'Array', '2015-09-07 06:39:24'),
(00007, '::1', 'Administrator', 'ardents', 'CREATED Employee Profile', 'Array', '2015-09-07 06:40:39'),
(00008, '::1', 'Administrator', 'ardents', 'CREATED Employee Profile', 'EMP008', '2015-09-07 06:55:04'),
(00009, '::1', 'Administrator', 'Ardens', 'Added Leave to Employee EMP001', NULL, '2015-09-07 07:46:37'),
(00010, '::1', 'Administrator', 'ardents', 'CREATED Employee Profile', 'EMP008', '2015-09-07 07:58:57'),
(00011, '::1', 'Administrator', 'ardents', 'Evaluated EmployeeEMP002', NULL, '2015-09-07 08:01:47'),
(00012, '::1', 'Administrator', 'ardents', 'Logged out', NULL, '2015-09-07 08:02:18'),
(00013, '::1', 'Administrator', 'ardents', 'Logged out', NULL, '2015-09-07 08:02:21'),
(00014, '::1', 'Administrator', 'ardents', 'Logged out', NULL, '2015-09-07 08:02:27'),
(00015, '::1', 'Administrator', 'ardents', 'Logged in', NULL, '2015-09-07 08:07:08'),
(00016, '::1', 'Administrator', 'ardents', 'Evaluated EmployeeEMP003', NULL, '2015-09-07 08:32:32'),
(00017, '::1', 'Administrator', 'ardents', 'Logged out', NULL, '2015-09-07 09:21:54'),
(00018, '::1', 'Administrator', 'ardents', 'Logged in', NULL, '2015-09-08 09:08:42'),
(00019, '::1', 'Administrator', 'ardents', 'UPDATED Employee Profile', 'EMP002', '2015-09-08 09:09:39'),
(00020, '::1', 'Administrator', 'Ardens', 'Added Leave to Employee EMP002', NULL, '2015-09-08 09:09:51'),
(00021, '::1', 'Administrator', 'ardents', 'Logged out', NULL, '2015-09-08 09:10:21'),
(00022, '::1', 'HR Manager', 'hrmanager', 'Logged in', NULL, '2015-09-08 09:10:28'),
(00023, '::1', 'HR Manager', 'hrmanager', 'UPDATED Employee Profile', 'EMP003', '2015-09-08 09:13:49'),
(00024, '::1', 'HR Manager', 'hrmanager', 'Logged out', NULL, '2015-09-08 09:14:30'),
(00025, '::1', 'Accounting Manager', 'finance', 'Logged in', NULL, '2015-09-08 09:14:35'),
(00026, '::1', 'Accounting Manager', 'finance', 'Logged out', NULL, '2015-09-08 09:24:56'),
(00027, '::1', 'Administrator', 'ardents', 'Logged in', NULL, '2015-09-08 09:25:09'),
(00028, '::1', 'Administrator', 'ardents', 'UPDATED Employee Profile', 'EMP001', '2015-09-08 09:25:23'),
(00029, '::1', 'Administrator', 'ardents', 'UPDATED Employee Profile', 'EMP008', '2015-09-08 09:25:51'),
(00030, '::1', 'Administrator', 'ardents', 'Logged out', NULL, '2015-09-08 11:33:29'),
(00031, '::1', 'HR Manager', 'hrmanager', 'Logged in', NULL, '2015-09-08 11:33:38'),
(00032, '::1', 'HR Manager', 'Bong', 'Posted an Announcement', NULL, '2015-09-08 11:34:53'),
(00033, '::1', 'HR Manager', 'hrmanager', 'UPDATED Employee Profile', 'EMP007', '2015-09-08 11:45:36'),
(00034, '::1', 'HR Manager', 'hrmanager', 'UPDATED Employee Profile', 'EMP007', '2015-09-08 11:48:10'),
(00035, '::1', 'HR Manager', 'hrmanager', 'UPDATED Employee Profile', 'EMP007', '2015-09-08 11:49:06'),
(00036, '::1', 'HR Manager', 'hrmanager', 'Logged out', NULL, '2015-09-08 11:52:37'),
(00037, '::1', 'HR Manager', 'hrmanager', 'Logged in', NULL, '2015-09-08 11:52:42'),
(00038, '::1', 'HR Manager', 'hrmanager', 'Logged out', NULL, '2015-09-08 12:13:28'),
(00039, '::1', 'Administrator', 'ardents', 'Logged in', NULL, '2015-09-08 12:13:37'),
(00040, '::1', 'Administrator', 'ardents', 'Employee EMP002 requested leave', NULL, '2015-09-08 13:09:11'),
(00041, '::1', 'Administrator', 'ardents', 'Leave Request Approved by Administrator Arden', NULL, '2015-09-08 13:12:39'),
(00042, '::1', 'Administrator', 'ardents', 'Employee EMP007 requested leave', NULL, '2015-09-08 13:31:23'),
(00043, '::1', 'Administrator', 'ardents', 'Leave Request Denied by Administrator Arden', NULL, '2015-09-08 13:31:39'),
(00044, '::1', 'Administrator', 'ardents', 'Employee EMP001 requested leave', NULL, '2015-09-08 13:32:50'),
(00045, '::1', 'Administrator', 'ardents', 'Leave Request Approved by Administrator Arden', NULL, '2015-09-08 13:32:52'),
(00046, '::1', 'Administrator', 'ardents', 'Employee EMP002 requested leave', NULL, '2015-09-08 13:38:36'),
(00047, '::1', 'Administrator', 'ardents', 'Leave Request Approved by Administrator Arden', NULL, '2015-09-08 13:38:39'),
(00048, '::1', 'Administrator', 'ardents', 'Employee EMP007 requested leave', NULL, '2015-09-08 13:40:47'),
(00049, '::1', 'Administrator', 'ardents', 'Leave Request Approved by Administrator Arden', NULL, '2015-09-08 13:40:51'),
(00050, '::1', 'Administrator', 'ardents', 'Employee EMP006 requested leave', NULL, '2015-09-08 13:41:37'),
(00051, '::1', 'Administrator', 'ardents', 'Leave Request Denied by Administrator Arden', NULL, '2015-09-08 13:42:47'),
(00052, '::1', 'Administrator', 'ardents', 'Employee EMP006 requested leave', NULL, '2015-09-08 13:43:00'),
(00053, '::1', 'Administrator', 'ardents', 'Leave Request Approved by Administrator Arden', NULL, '2015-09-08 13:46:03'),
(00054, '::1', 'Administrator', 'ardents', 'Employee EMP002 requested leave', NULL, '2015-09-08 14:03:47'),
(00055, '::1', 'Administrator', 'ardents', 'Employee EMP006 requested leave', NULL, '2015-09-08 14:08:02'),
(00056, '::1', 'Administrator', 'ardents', 'Employee EMP006 requested leave', NULL, '2015-09-08 14:11:10'),
(00057, '::1', 'Administrator', 'ardents', 'Leave Request Approved by Administrator Arden', NULL, '2015-09-08 14:11:26'),
(00058, '::1', 'Administrator', 'ardents', 'Employee EMP006 requested leave', NULL, '2015-09-08 14:25:40'),
(00059, '::1', 'Administrator', 'ardents', 'Leave Request Approved by Administrator Arden', NULL, '2015-09-08 14:25:50'),
(00060, '::1', 'Administrator', 'ardents', 'Employee EMP006 requested leave', NULL, '2015-09-08 14:27:43'),
(00061, '::1', 'Administrator', 'ardents', 'Employee EMP006 requested leave', NULL, '2015-09-08 14:29:50'),
(00062, '::1', 'Administrator', 'ardents', 'Employee EMP001 requested leave', NULL, '2015-09-08 14:31:38'),
(00063, '::1', 'Administrator', 'ardents', 'Leave Request Denied by Administrator Arden', NULL, '2015-09-08 14:35:41'),
(00064, '::1', 'HR Manager', 'hrmanager', 'Logged in', NULL, '2015-09-08 15:04:47'),
(00065, '::1', 'HR Manager', 'hrmanager', 'Logged out', NULL, '2015-09-08 15:11:14'),
(00066, '::1', 'HR Manager', 'hrmanager', 'Logged in', NULL, '2015-09-08 15:11:25'),
(00067, '::1', 'HR Manager', 'hrmanager', 'Employee EMP004 requested leave', NULL, '2015-09-08 15:14:34'),
(00068, '::1', 'HR Manager', 'hrmanager', 'Leave Request Approved by HR Manager Bong', NULL, '2015-09-08 15:17:42'),
(00069, '::1', 'HR Manager', 'hrmanager', 'Logged in', NULL, '2015-09-08 15:47:18'),
(00070, '::1', 'Administrator', 'ardents', 'Logged in', NULL, '2015-09-09 00:15:58'),
(00071, '::1', 'Administrator', 'ardents', 'Employee EMP001 requested leave', NULL, '2015-09-09 00:34:30'),
(00072, '::1', 'Administrator', 'ardents', 'Employee EMP001 requested leave', NULL, '2015-09-09 00:35:40'),
(00073, '::1', 'Administrator', 'ardents', 'Employee EMP001 requested leave', NULL, '2015-09-09 00:37:02'),
(00074, '::1', 'Administrator', 'ardents', 'Employee EMP001 requested leave', NULL, '2015-09-09 00:37:24'),
(00075, '::1', 'Administrator', 'ardents', 'Logged out', NULL, '2015-09-09 03:14:05'),
(00076, '::1', 'Administrator', 'ardents', 'Logged in', NULL, '2015-09-09 06:40:48'),
(00077, '::1', 'Administrator', 'ardents', 'Added employee EMP001 to Project P1001', 'EMP001', '2015-09-09 07:08:45'),
(00078, '::1', 'Administrator', 'ardents', 'Added employee EMP002 to Project P1002', 'EMP002', '2015-09-09 07:09:03'),
(00079, '::1', 'Administrator', 'ardents', 'Added employee EMP003 to Project P1003', 'EMP003', '2015-09-09 07:09:26'),
(00080, '::1', 'Administrator', 'ardents', 'Logged out', NULL, '2015-09-09 07:45:16'),
(00081, '::1', 'Administrator', 'ardents', 'Logged in', NULL, '2015-09-09 07:51:52'),
(00082, '::1', 'Administrator', 'ardents', 'Logged out', NULL, '2015-09-09 07:55:44'),
(00083, '::1', 'HR Manager', 'hrmanager', 'Logged in', NULL, '2015-09-09 07:55:49'),
(00084, '::1', 'HR Manager', 'hrmanager', 'Assigend Employee EMP006 to Supervisor SP1001', 'EMP006', '2015-09-09 07:56:33'),
(00085, '::1', 'HR Manager', 'hrmanager', 'Logged out', NULL, '2015-09-09 08:00:10'),
(00086, '::1', 'Administrator', 'ardents', 'Logged in', NULL, '2015-09-09 08:00:19'),
(00087, '::1', 'Administrator', 'ardents', 'UPDATED Employee Profile', 'EMP001', '2015-09-09 08:00:39'),
(00088, '::1', 'Administrator', 'ardents', 'UPDATED Employee Profile', 'EMP004', '2015-09-09 08:02:07'),
(00089, '::1', 'Administrator', 'ardents', 'UPDATED Employee Profile', 'EMP005', '2015-09-09 08:02:43'),
(00090, '::1', 'Administrator', 'ardents', 'Logged out', NULL, '2015-09-09 08:03:01'),
(00091, '::1', 'Stock Clerk', 'stock', 'Logged in', NULL, '2015-09-09 08:04:09'),
(00092, '::1', 'Stock Clerk', 'stock', 'Logged out', NULL, '2015-09-09 08:05:50'),
(00093, '::1', 'Stock Clerk', 'stock', 'Logged in', NULL, '2015-09-09 08:05:58'),
(00094, '::1', 'Stock Clerk', 'stock', 'Logged out', NULL, '2015-09-09 08:07:55'),
(00095, '::1', 'Stock Clerk', 'stock', 'Logged in', NULL, '2015-09-09 08:08:01'),
(00096, '::1', 'Stock Clerk', 'stock', 'Logged out', NULL, '2015-09-09 08:11:00'),
(00097, '::1', 'Stock Clerk', 'stock', 'Logged in', NULL, '2015-09-09 08:11:07'),
(00098, '::1', 'Stock Clerk', 'stock', 'Logged out', NULL, '2015-09-09 08:12:06'),
(00099, '::1', 'Stock Clerk', 'stock', 'Logged in', NULL, '2015-09-09 08:12:16'),
(00100, '::1', 'Stock Clerk', 'stock', 'Added new project: Project Cool', NULL, '2015-09-09 08:14:29'),
(00101, '::1', 'Stock Clerk', 'stock', 'Logged out', NULL, '2015-09-09 08:15:33'),
(00102, '::1', 'Employee', 'employee', 'Logged in', NULL, '2015-09-09 08:15:41'),
(00103, '::1', 'Employee', 'employee', 'Employee EMP004 requested leave', NULL, '2015-09-09 08:17:36'),
(00104, '::1', 'Employee', 'employee', 'Evaluated EmployeeEMP001', NULL, '2015-09-09 08:19:50'),
(00105, '::1', 'Employee', 'employee', 'Evaluated EmployeeEMP002', NULL, '2015-09-09 08:21:31'),
(00106, '::1', 'Employee', 'employee', 'Logged out', NULL, '2015-09-09 08:21:58'),
(00107, '::1', 'Administrator', 'admin', 'Logged in', NULL, '2015-09-09 08:53:05'),
(00108, '::1', 'Administrator', 'admin', 'Logged out', NULL, '2015-09-09 09:52:43'),
(00109, '::1', 'Administrator', 'admin', 'Logged in', NULL, '2015-09-09 09:52:54'),
(00110, '::1', 'Administrator', 'admin', 'Logged out', NULL, '2015-09-09 10:19:48'),
(00111, '::1', 'Administrator', 'admin', 'Logged in', NULL, '2015-09-09 10:34:40'),
(00112, '::1', 'Administrator', 'admin', 'Logged in', NULL, '2015-09-12 14:45:15');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_calendar`
--

DROP TABLE IF EXISTS `tbl_calendar`;
CREATE TABLE IF NOT EXISTS `tbl_calendar` (
  `calendar_id` int(11) NOT NULL,
  `day_name` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL,
  `date_value` date NOT NULL,
  `day_type_id` int(11) NOT NULL,
  `allow_absence` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_calendar`
--

INSERT INTO `tbl_calendar` (`calendar_id`, `day_name`, `description`, `date_value`, `day_type_id`, `allow_absence`) VALUES
(1, 'New Year''s Day', 'Happy New Year!', '2015-01-01', 1, 1),
(2, 'Valentine''s Day', 'Love is in the air!', '2015-02-14', 3, 1),
(3, 'People Power Anniversary', 'I have no idea what is this.', '2015-02-25', 2, 1),
(4, 'Independence Day', 'Araw ng kalayaan', '2015-06-12', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_client`
--

DROP TABLE IF EXISTS `tbl_client`;
CREATE TABLE IF NOT EXISTS `tbl_client` (
  `client_id` varchar(10) DEFAULT NULL,
  `client_name` varchar(50) DEFAULT NULL,
  `client_address` varchar(50) DEFAULT NULL,
  `client_contact_no` int(20) DEFAULT NULL,
  `client_email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_client`
--

INSERT INTO `tbl_client` (`client_id`, `client_name`, `client_address`, `client_contact_no`, `client_email`) VALUES
('CL1001', 'Skyjet Airlines', 'Tokyo, Japan', 1232323213, 'skyjet@gmail.com'),
('CL1002', 'Lucio Tan', 'Fujian, China', 232323232, 'lucio@gmail.com'),
('CL1003', 'Tan Yu', 'wewee', 313131, 'tanyu@gmail.com'),
('CL1004', 'Coring Ramos', 'Escolta, Manila', 231232132, 'coring@gmail.com'),
('CL1005', 'Sandy Javier', 'Leyte', 32323232, 'sandy@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contact_number`
--

DROP TABLE IF EXISTS `tbl_contact_number`;
CREATE TABLE IF NOT EXISTS `tbl_contact_number` (
  `employee_id` varchar(8) DEFAULT NULL,
  `mobile_number` int(20) DEFAULT NULL,
  `tel_number` int(20) DEFAULT NULL,
  `email_address` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_contact_number`
--

INSERT INTO `tbl_contact_number` (`employee_id`, `mobile_number`, `tel_number`, `email_address`) VALUES
('EMP001', 1, 1, 'ardents02@gmail.com'),
('EMP002', 11, 22, 'bong@gmail.com'),
('EMP003', 223, 44, 'mriam@gmail.com'),
('EMP004', 22, 44, 'jason@gmail.com'),
('EMP005', 5662, 323, 'rajid@gmail.com'),
('EMP006', 22, 33, 'victor@gmail.com'),
('EMP007', 22, 22, 'ee@gmail.com'),
('EMP008', 22, 22, 'bart@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contact_person`
--

DROP TABLE IF EXISTS `tbl_contact_person`;
CREATE TABLE IF NOT EXISTS `tbl_contact_person` (
  `contact_person` varchar(100) DEFAULT NULL,
  `contact_rel` varchar(30) DEFAULT NULL,
  `contact_num` int(20) DEFAULT NULL,
  `employee_id` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_contact_person`
--

INSERT INTO `tbl_contact_person` (`contact_person`, `contact_rel`, `contact_num`, `employee_id`) VALUES
('', '', 0, 'EMP002'),
('', '', 0, 'EMP003'),
('', '', 0, 'EMP004'),
('', '', 0, 'EMP005'),
(NULL, NULL, NULL, 'EMP006'),
('', '', 0, 'EMP007'),
('', '', 0, 'EMP001'),
('', '', 0, 'EMP008');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_countries`
--

DROP TABLE IF EXISTS `tbl_countries`;
CREATE TABLE IF NOT EXISTS `tbl_countries` (
  `id` int(11) NOT NULL,
  `country_code` varchar(2) NOT NULL DEFAULT '',
  `country_name` varchar(100) NOT NULL DEFAULT ''
) ENGINE=MyISAM AUTO_INCREMENT=243 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_countries`
--

INSERT INTO `tbl_countries` (`id`, `country_code`, `country_name`) VALUES
(1, 'US', 'United States'),
(2, 'CA', 'Canada'),
(3, 'AF', 'Afghanistan'),
(4, 'AL', 'Albania'),
(5, 'DZ', 'Algeria'),
(6, 'DS', 'American Samoa'),
(7, 'AD', 'Andorra'),
(8, 'AO', 'Angola'),
(9, 'AI', 'Anguilla'),
(10, 'AQ', 'Antarctica'),
(11, 'AG', 'Antigua and/or Barbuda'),
(12, 'AR', 'Argentina'),
(13, 'AM', 'Armenia'),
(14, 'AW', 'Aruba'),
(15, 'AU', 'Australia'),
(16, 'AT', 'Austria'),
(17, 'AZ', 'Azerbaijan'),
(18, 'BS', 'Bahamas'),
(19, 'BH', 'Bahrain'),
(20, 'BD', 'Bangladesh'),
(21, 'BB', 'Barbados'),
(22, 'BY', 'Belarus'),
(23, 'BE', 'Belgium'),
(24, 'BZ', 'Belize'),
(25, 'BJ', 'Benin'),
(26, 'BM', 'Bermuda'),
(27, 'BT', 'Bhutan'),
(28, 'BO', 'Bolivia'),
(29, 'BA', 'Bosnia and Herzegovina'),
(30, 'BW', 'Botswana'),
(31, 'BV', 'Bouvet Island'),
(32, 'BR', 'Brazil'),
(33, 'IO', 'British lndian Ocean Territory'),
(34, 'BN', 'Brunei Darussalam'),
(35, 'BG', 'Bulgaria'),
(36, 'BF', 'Burkina Faso'),
(37, 'BI', 'Burundi'),
(38, 'KH', 'Cambodia'),
(39, 'CM', 'Cameroon'),
(40, 'CV', 'Cape Verde'),
(41, 'KY', 'Cayman Islands'),
(42, 'CF', 'Central African Republic'),
(43, 'TD', 'Chad'),
(44, 'CL', 'Chile'),
(45, 'CN', 'China'),
(46, 'CX', 'Christmas Island'),
(47, 'CC', 'Cocos (Keeling) Islands'),
(48, 'CO', 'Colombia'),
(49, 'KM', 'Comoros'),
(50, 'CG', 'Congo'),
(51, 'CK', 'Cook Islands'),
(52, 'CR', 'Costa Rica'),
(53, 'HR', 'Croatia (Hrvatska)'),
(54, 'CU', 'Cuba'),
(55, 'CY', 'Cyprus'),
(56, 'CZ', 'Czech Republic'),
(57, 'DK', 'Denmark'),
(58, 'DJ', 'Djibouti'),
(59, 'DM', 'Dominica'),
(60, 'DO', 'Dominican Republic'),
(61, 'TP', 'East Timor'),
(62, 'EC', 'Ecuador'),
(63, 'EG', 'Egypt'),
(64, 'SV', 'El Salvador'),
(65, 'GQ', 'Equatorial Guinea'),
(66, 'ER', 'Eritrea'),
(67, 'EE', 'Estonia'),
(68, 'ET', 'Ethiopia'),
(69, 'FK', 'Falkland Islands (Malvinas)'),
(70, 'FO', 'Faroe Islands'),
(71, 'FJ', 'Fiji'),
(72, 'FI', 'Finland'),
(73, 'FR', 'France'),
(74, 'FX', 'France, Metropolitan'),
(75, 'GF', 'French Guiana'),
(76, 'PF', 'French Polynesia'),
(77, 'TF', 'French Southern Territories'),
(78, 'GA', 'Gabon'),
(79, 'GM', 'Gambia'),
(80, 'GE', 'Georgia'),
(81, 'DE', 'Germany'),
(82, 'GH', 'Ghana'),
(83, 'GI', 'Gibraltar'),
(84, 'GR', 'Greece'),
(85, 'GL', 'Greenland'),
(86, 'GD', 'Grenada'),
(87, 'GP', 'Guadeloupe'),
(88, 'GU', 'Guam'),
(89, 'GT', 'Guatemala'),
(90, 'GN', 'Guinea'),
(91, 'GW', 'Guinea-Bissau'),
(92, 'GY', 'Guyana'),
(93, 'HT', 'Haiti'),
(94, 'HM', 'Heard and Mc Donald Islands'),
(95, 'HN', 'Honduras'),
(96, 'HK', 'Hong Kong'),
(97, 'HU', 'Hungary'),
(98, 'IS', 'Iceland'),
(99, 'IN', 'India'),
(100, 'ID', 'Indonesia'),
(101, 'IR', 'Iran (Islamic Republic of)'),
(102, 'IQ', 'Iraq'),
(103, 'IE', 'Ireland'),
(104, 'IL', 'Israel'),
(105, 'IT', 'Italy'),
(106, 'CI', 'Ivory Coast'),
(107, 'JM', 'Jamaica'),
(108, 'JP', 'Japan'),
(109, 'JO', 'Jordan'),
(110, 'KZ', 'Kazakhstan'),
(111, 'KE', 'Kenya'),
(112, 'KI', 'Kiribati'),
(113, 'KP', 'Korea, Democratic People''s Republic of'),
(114, 'KR', 'Korea, Republic of'),
(115, 'XK', 'Kosovo'),
(116, 'KW', 'Kuwait'),
(117, 'KG', 'Kyrgyzstan'),
(118, 'LA', 'Lao People''s Democratic Republic'),
(119, 'LV', 'Latvia'),
(120, 'LB', 'Lebanon'),
(121, 'LS', 'Lesotho'),
(122, 'LR', 'Liberia'),
(123, 'LY', 'Libyan Arab Jamahiriya'),
(124, 'LI', 'Liechtenstein'),
(125, 'LT', 'Lithuania'),
(126, 'LU', 'Luxembourg'),
(127, 'MO', 'Macau'),
(128, 'MK', 'Macedonia'),
(129, 'MG', 'Madagascar'),
(130, 'MW', 'Malawi'),
(131, 'MY', 'Malaysia'),
(132, 'MV', 'Maldives'),
(133, 'ML', 'Mali'),
(134, 'MT', 'Malta'),
(135, 'MH', 'Marshall Islands'),
(136, 'MQ', 'Martinique'),
(137, 'MR', 'Mauritania'),
(138, 'MU', 'Mauritius'),
(139, 'TY', 'Mayotte'),
(140, 'MX', 'Mexico'),
(141, 'FM', 'Micronesia, Federated States of'),
(142, 'MD', 'Moldova, Republic of'),
(143, 'MC', 'Monaco'),
(144, 'MN', 'Mongolia'),
(145, 'ME', 'Montenegro'),
(146, 'MS', 'Montserrat'),
(147, 'MA', 'Morocco'),
(148, 'MZ', 'Mozambique'),
(149, 'MM', 'Myanmar'),
(150, 'NA', 'Namibia'),
(151, 'NR', 'Nauru'),
(152, 'NP', 'Nepal'),
(153, 'NL', 'Netherlands'),
(154, 'AN', 'Netherlands Antilles'),
(155, 'NC', 'New Caledonia'),
(156, 'NZ', 'New Zealand'),
(157, 'NI', 'Nicaragua'),
(158, 'NE', 'Niger'),
(159, 'NG', 'Nigeria'),
(160, 'NU', 'Niue'),
(161, 'NF', 'Norfork Island'),
(162, 'MP', 'Northern Mariana Islands'),
(163, 'NO', 'Norway'),
(164, 'OM', 'Oman'),
(165, 'PK', 'Pakistan'),
(166, 'PW', 'Palau'),
(167, 'PA', 'Panama'),
(168, 'PG', 'Papua New Guinea'),
(169, 'PY', 'Paraguay'),
(170, 'PE', 'Peru'),
(171, 'PH', 'Philippines'),
(172, 'PN', 'Pitcairn'),
(173, 'PL', 'Poland'),
(174, 'PT', 'Portugal'),
(175, 'PR', 'Puerto Rico'),
(176, 'QA', 'Qatar'),
(177, 'RE', 'Reunion'),
(178, 'RO', 'Romania'),
(179, 'RU', 'Russian Federation'),
(180, 'RW', 'Rwanda'),
(181, 'KN', 'Saint Kitts and Nevis'),
(182, 'LC', 'Saint Lucia'),
(183, 'VC', 'Saint Vincent and the Grenadines'),
(184, 'WS', 'Samoa'),
(185, 'SM', 'San Marino'),
(186, 'ST', 'Sao Tome and Principe'),
(187, 'SA', 'Saudi Arabia'),
(188, 'SN', 'Senegal'),
(189, 'RS', 'Serbia'),
(190, 'SC', 'Seychelles'),
(191, 'SL', 'Sierra Leone'),
(192, 'SG', 'Singapore'),
(193, 'SK', 'Slovakia'),
(194, 'SI', 'Slovenia'),
(195, 'SB', 'Solomon Islands'),
(196, 'SO', 'Somalia'),
(197, 'ZA', 'South Africa'),
(198, 'GS', 'South Georgia South Sandwich Islands'),
(199, 'ES', 'Spain'),
(200, 'LK', 'Sri Lanka'),
(201, 'SH', 'St. Helena'),
(202, 'PM', 'St. Pierre and Miquelon'),
(203, 'SD', 'Sudan'),
(204, 'SR', 'Suriname'),
(205, 'SJ', 'Svalbarn and Jan Mayen Islands'),
(206, 'SZ', 'Swaziland'),
(207, 'SE', 'Sweden'),
(208, 'CH', 'Switzerland'),
(209, 'SY', 'Syrian Arab Republic'),
(210, 'TW', 'Taiwan'),
(211, 'TJ', 'Tajikistan'),
(212, 'TZ', 'Tanzania, United Republic of'),
(213, 'TH', 'Thailand'),
(214, 'TG', 'Togo'),
(215, 'TK', 'Tokelau'),
(216, 'TO', 'Tonga'),
(217, 'TT', 'Trinidad and Tobago'),
(218, 'TN', 'Tunisia'),
(219, 'TR', 'Turkey'),
(220, 'TM', 'Turkmenistan'),
(221, 'TC', 'Turks and Caicos Islands'),
(222, 'TV', 'Tuvalu'),
(223, 'UG', 'Uganda'),
(224, 'UA', 'Ukraine'),
(225, 'AE', 'United Arab Emirates'),
(226, 'GB', 'United Kingdom'),
(227, 'UM', 'United States minor outlying islands'),
(228, 'UY', 'Uruguay'),
(229, 'UZ', 'Uzbekistan'),
(230, 'VU', 'Vanuatu'),
(231, 'VA', 'Vatican City State'),
(232, 'VE', 'Venezuela'),
(233, 'VN', 'Vietnam'),
(234, 'VG', 'Virgin Islands (British)'),
(235, 'VI', 'Virgin Islands (U.S.)'),
(236, 'WF', 'Wallis and Futuna Islands'),
(237, 'EH', 'Western Sahara'),
(238, 'YE', 'Yemen'),
(239, 'YU', 'Yugoslavia'),
(240, 'ZR', 'Zaire'),
(241, 'ZM', 'Zambia'),
(242, 'ZW', 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_criteria`
--

DROP TABLE IF EXISTS `tbl_criteria`;
CREATE TABLE IF NOT EXISTS `tbl_criteria` (
  `criteria_id` int(5) NOT NULL,
  `criteria_desc` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_criteria`
--

INSERT INTO `tbl_criteria` (`criteria_id`, `criteria_desc`) VALUES
(1, 'VOLUME OF WORK: Maintains steady, acceptable  level of work output.'),
(2, 'QUALITY OF WORK: Maintains acceptable standards of worksmanship.'),
(3, 'JOB KNOWLEDGE: Understands job procedures, equipments, and methods, responsibilities and scope of duties.'),
(4, 'COMMITMENT TO JOB: Demonstrates a consistent, dependable work effort and positive work attitude.'),
(5, 'ATTENDANCE AND PUNCTUALITY: Uses company time conscientiously.'),
(6, 'SAFETY, HEALTHY AND MAINTENANCE: Ensures health safety of self and others through proper use and care of equipment/work site,'),
(7, 'RELIABILITY AND DEPENDABILITY: Trust / Confidence on employee in meeting deadline; carry out instruction established procedure with minimum follow-up.'),
(8, 'COOPERATION: Works with others to accomplish the goals of the job and work group.'),
(9, 'ETHICS AND ATTITUDE: Maintains high level of character and a professional attitude.'),
(10, 'COMMUNICATION: Has the ability to convey information and present ideas clearly and concisely throughout the organization and with outside contracts.');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_day_type`
--

DROP TABLE IF EXISTS `tbl_day_type`;
CREATE TABLE IF NOT EXISTS `tbl_day_type` (
  `day_type_id` int(11) NOT NULL,
  `day_type_name` varchar(45) NOT NULL,
  `multiplier` decimal(4,2) NOT NULL DEFAULT '1.00'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_day_type`
--

INSERT INTO `tbl_day_type` (`day_type_id`, `day_type_name`, `multiplier`) VALUES
(1, 'Regular Date', '1.00'),
(2, 'Special Holiday', '1.33'),
(3, 'Regular Holiday', '2.00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_departments`
--

DROP TABLE IF EXISTS `tbl_departments`;
CREATE TABLE IF NOT EXISTS `tbl_departments` (
  `department_id` varchar(10) DEFAULT NULL,
  `department_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_departments`
--

INSERT INTO `tbl_departments` (`department_id`, `department_name`) VALUES
('DE1001', 'HR / Admin'),
('DE1002', 'Accounting'),
('DE1003', 'Purchasing'),
('DE1004', 'Technology'),
('DE1005', 'Production'),
('DE1006', 'Logistics');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dependent`
--

DROP TABLE IF EXISTS `tbl_dependent`;
CREATE TABLE IF NOT EXISTS `tbl_dependent` (
  `employee_id` varchar(8) DEFAULT NULL,
  `dependent_fname` varchar(50) DEFAULT NULL,
  `dependent_lname` varchar(50) DEFAULT NULL,
  `relationship` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_dependent`
--

INSERT INTO `tbl_dependent` (`employee_id`, `dependent_fname`, `dependent_lname`, `relationship`) VALUES
('EMP006', 'Sansa', 'Stark', 'Daughter'),
('EMP006', 'Bran', 'Stark', 'Nephew');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employment_history`
--

DROP TABLE IF EXISTS `tbl_employment_history`;
CREATE TABLE IF NOT EXISTS `tbl_employment_history` (
  `company_name` varchar(50) DEFAULT NULL,
  `company_address` varchar(50) DEFAULT NULL,
  `years_stayed` tinyint(2) DEFAULT NULL,
  `job_title` varchar(255) DEFAULT NULL,
  `employee_id` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_employment_history`
--

INSERT INTO `tbl_employment_history` (`company_name`, `company_address`, `years_stayed`, `job_title`, `employee_id`) VALUES
('IBM', 'Eastwood', 1, 'Programmer', 'EMP006'),
('IBM', 'Eastwood', 1, 'Programmer', 'EMP002');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employment_type`
--

DROP TABLE IF EXISTS `tbl_employment_type`;
CREATE TABLE IF NOT EXISTS `tbl_employment_type` (
  `employment_type_id` varchar(10) DEFAULT NULL,
  `employment_type` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_employment_type`
--

INSERT INTO `tbl_employment_type` (`employment_type_id`, `employment_type`) VALUES
('ET1001', 'Regular'),
('ET1002', 'Project-based'),
('ET1003', 'Contractual'),
('ET1004', 'Probitionary');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_emp_history`
--

DROP TABLE IF EXISTS `tbl_emp_history`;
CREATE TABLE IF NOT EXISTS `tbl_emp_history` (
  `emp_id` varchar(8) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `employment_type_id` varchar(255) DEFAULT NULL,
  `job_title_id` varchar(50) DEFAULT NULL,
  `department_id` varchar(50) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `probationary_date` date DEFAULT NULL,
  `permanency_date` date DEFAULT NULL,
  `salary` decimal(10,2) DEFAULT NULL,
  `pay_grade` varchar(5) DEFAULT NULL,
  `user_id` smallint(10) DEFAULT NULL,
  `date_modified` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_emp_history`
--

INSERT INTO `tbl_emp_history` (`emp_id`, `status`, `employment_type_id`, `job_title_id`, `department_id`, `start_date`, `end_date`, `probationary_date`, `permanency_date`, `salary`, `pay_grade`, `user_id`, `date_modified`) VALUES
('EMP001', 'Existing', 'ET1001', 'JT1001', 'DE1001', '2015-07-27', '2015-08-13', '2015-08-13', '2015-08-14', '15000.00', 'C', NULL, '2015-08-11 20:53:11'),
('EMP002', 'Existing', 'ET1001', 'JT1001', 'DE1001', '2015-09-07', '2015-09-07', '2015-09-07', '2015-09-07', '0.00', '', NULL, '2015-09-07 14:32:31'),
('EMP003', 'Existing', 'ET1001', 'JT1003', 'DE1002', '2015-09-07', '2015-09-07', '2015-09-07', '2015-09-07', '0.00', '', NULL, '2015-09-07 14:33:54'),
('EMP004', 'Existing', 'ET1002', 'JT1004', 'DE1004', '2015-09-07', '2015-09-07', '2015-09-07', '2015-09-07', '0.00', '', NULL, '2015-09-07 14:38:06'),
('EMP005', 'Existing', 'ET1003', 'JT1003', 'DE1004', '2015-09-07', '2015-09-07', '2015-09-07', '2015-09-07', '0.00', '', NULL, '2015-09-07 14:39:23'),
('EMP006', 'Existing', 'ET1002', 'JT1002', 'DE1003', '2015-09-07', '2015-09-07', '2015-09-07', '2015-09-07', NULL, NULL, NULL, '2015-09-07 14:40:39'),
('EMP007', 'OnLeave', 'ET1001', 'JT1001', 'DE1002', '2015-09-07', '2015-09-07', '2015-09-07', '2015-09-07', '0.00', '', NULL, '2015-09-07 14:55:02'),
('EMP008', 'Resigned', 'ET1002', 'JT1001', 'DE1002', '2015-09-07', '2015-09-07', '2015-09-07', '2015-09-07', '0.00', '', NULL, '2015-09-07 15:58:56');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_emp_info`
--

DROP TABLE IF EXISTS `tbl_emp_info`;
CREATE TABLE IF NOT EXISTS `tbl_emp_info` (
  `emp_id` varchar(8) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `marital_status` varchar(50) DEFAULT NULL,
  `date_added` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_emp_info`
--

INSERT INTO `tbl_emp_info` (`emp_id`, `first_name`, `middle_name`, `last_name`, `birthday`, `gender`, `marital_status`, `date_added`) VALUES
('EMP001', 'Arden', 'Jay', 'Dela Cruz', '2015-09-02', 'male', 'Single', '2015-08-11 12:53:11'),
('EMP002', 'Bong', 'We', 'Revilla', '1960-03-24', 'male', 'Single', '2015-09-07 06:32:30'),
('EMP003', 'Miriam', 'Defensor ', 'Santiago', '1970-07-23', 'female', 'Single', '2015-09-07 06:33:54'),
('EMP004', 'Jason', 'Chayene', 'Derulo', '1969-03-06', 'male', 'Single', '2015-09-07 06:38:06'),
('EMP005', 'Rajid', 'wewe', 'Woo', '1985-07-23', 'female', 'Single', '2015-09-07 06:39:23'),
('EMP006', 'Victor', 'B.', 'Wood', '1980-09-18', 'male', 'married', '2015-09-07 06:40:38'),
('EMP007', 'Jolly', 'HOt', 'Dog', '1984-09-05', 'male', 'Single', '2015-09-07 06:55:02'),
('EMP008', 'Bart', 'Virtual', 'Simpsons', '2000-02-15', 'male', 'Single', '2015-09-07 07:58:56');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_emp_supervisions`
--

DROP TABLE IF EXISTS `tbl_emp_supervisions`;
CREATE TABLE IF NOT EXISTS `tbl_emp_supervisions` (
  `supervisor_id` varchar(10) DEFAULT NULL,
  `employee_id` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_evaluation`
--

DROP TABLE IF EXISTS `tbl_evaluation`;
CREATE TABLE IF NOT EXISTS `tbl_evaluation` (
  `evaluation_id` int(5) NOT NULL,
  `evaluation_desc` varchar(50) DEFAULT NULL,
  `assessor_id` varchar(8) DEFAULT NULL,
  `assessee_id` varchar(8) DEFAULT NULL,
  `evaluation_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_evaluation`
--

INSERT INTO `tbl_evaluation` (`evaluation_id`, `evaluation_desc`, `assessor_id`, `assessee_id`, `evaluation_date`) VALUES
(1, 'September Evaluation', 'EMP001', 'EMP002', '2015-09-07 08:02:16'),
(2, 'October Evaluation', 'EMP001', 'EMP003', '2015-09-07 08:32:32'),
(3, 'September Evaluation', 'EMP004', 'EMP001', '2015-09-09 08:19:49'),
(4, 'September Evaluation', 'EMP004', 'EMP002', '2015-09-09 08:21:30');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_evaluation_rate`
--

DROP TABLE IF EXISTS `tbl_evaluation_rate`;
CREATE TABLE IF NOT EXISTS `tbl_evaluation_rate` (
  `evaluation_id` int(5) unsigned zerofill DEFAULT NULL,
  `rate1` decimal(3,2) DEFAULT NULL,
  `rate2` decimal(3,2) DEFAULT NULL,
  `rate3` decimal(3,2) DEFAULT NULL,
  `rate4` decimal(3,2) DEFAULT NULL,
  `rate5` decimal(3,2) DEFAULT NULL,
  `rate6` decimal(3,2) DEFAULT NULL,
  `rate7` decimal(3,2) DEFAULT NULL,
  `rate8` decimal(3,2) DEFAULT NULL,
  `rate9` decimal(3,2) DEFAULT NULL,
  `rate10` decimal(3,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_evaluation_rate`
--

INSERT INTO `tbl_evaluation_rate` (`evaluation_id`, `rate1`, `rate2`, `rate3`, `rate4`, `rate5`, `rate6`, `rate7`, `rate8`, `rate9`, `rate10`) VALUES
(00001, '1.00', '1.00', '1.00', '1.00', '1.00', '1.00', '1.00', '1.00', '1.00', '1.00'),
(00002, '1.00', '4.00', '3.00', '1.00', '5.00', '4.00', '1.00', '3.00', '3.00', '4.00'),
(00003, '2.00', '3.00', '4.00', '1.00', '3.00', '1.00', '1.00', '1.00', '1.00', '1.00'),
(00004, '3.00', '1.00', '3.00', '1.00', '3.00', '1.00', '1.00', '1.00', '1.00', '1.00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_governmentid`
--

DROP TABLE IF EXISTS `tbl_governmentid`;
CREATE TABLE IF NOT EXISTS `tbl_governmentid` (
  `employee_id` varchar(8) NOT NULL,
  `sss_no` int(10) DEFAULT NULL,
  `pagibig_no` int(12) DEFAULT NULL,
  `philhealth_no` int(12) DEFAULT NULL,
  `tin` int(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_governmentid`
--

INSERT INTO `tbl_governmentid` (`employee_id`, `sss_no`, `pagibig_no`, `philhealth_no`, `tin`) VALUES
('EMP001', 0, 0, 0, 0),
('EMP002', 0, 0, 0, 0),
('EMP003', 0, 0, 0, 0),
('EMP004', 0, 0, 0, 0),
('EMP005', 0, 0, 0, 0),
('EMP006', NULL, NULL, NULL, NULL),
('EMP007', 0, 0, 0, 0),
('EMP008', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_job_title`
--

DROP TABLE IF EXISTS `tbl_job_title`;
CREATE TABLE IF NOT EXISTS `tbl_job_title` (
  `job_title_id` varchar(10) DEFAULT NULL,
  `job_title_name` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_job_title`
--

INSERT INTO `tbl_job_title` (`job_title_id`, `job_title_name`) VALUES
('JT1001', 'HR Manager'),
('JT1002', 'Accounting Manager'),
('JT1003', 'Purchasing Manager'),
('JT1004', 'Technology Manager'),
('JT1005', 'Production Manager'),
('JT1006', 'Logistics Manager'),
('JT1007', 'Accounting Clerk'),
('JT1009', 'Operation Manager'),
('JT1010', 'Stock Clerk');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_leave_left`
--

DROP TABLE IF EXISTS `tbl_leave_left`;
CREATE TABLE IF NOT EXISTS `tbl_leave_left` (
  `employee_id` varchar(8) DEFAULT NULL,
  `leave_type_id` varchar(10) DEFAULT NULL,
  `days` smallint(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_leave_left`
--

INSERT INTO `tbl_leave_left` (`employee_id`, `leave_type_id`, `days`) VALUES
('EMP006', 'SL', 3),
('EMP001', 'VL', 5),
('EMP002', 'VL', 5),
('EMP002', 'SL', 5),
('EMP003', 'VL', 5),
('EMP003', 'SL', 5),
('EMP004', 'VL', 5),
('EMP004', 'SL', 3),
('EMP005', 'VL', 5),
('EMP005', 'SL', 5),
('EMP006', 'VL', 4),
('EMP001', 'SL', 5),
('EMP007', 'VL', 5),
('EMP007', 'SL', 5),
('EMP008', 'VL', 5),
('EMP008', 'SL', 5);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_leave_request`
--

DROP TABLE IF EXISTS `tbl_leave_request`;
CREATE TABLE IF NOT EXISTS `tbl_leave_request` (
  `id` smallint(5) unsigned zerofill NOT NULL,
  `prefix` varchar(3) NOT NULL DEFAULT 'LVR',
  `leave_type` varchar(50) DEFAULT NULL,
  `leave_reason` varchar(100) DEFAULT NULL,
  `leave_start` date DEFAULT NULL,
  `leave_end` date DEFAULT NULL,
  `days` tinyint(2) DEFAULT NULL,
  `leave_left` smallint(2) DEFAULT NULL,
  `leave_status` varchar(20) DEFAULT NULL,
  `approved_by` varchar(255) DEFAULT NULL,
  `date_approved` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_requested` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `employee_id` varchar(10) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_leave_request`
--

INSERT INTO `tbl_leave_request` (`id`, `prefix`, `leave_type`, `leave_reason`, `leave_start`, `leave_end`, `days`, `leave_left`, `leave_status`, `approved_by`, `date_approved`, `date_requested`, `employee_id`) VALUES
(00001, 'LVR', 'SL', 'sdasdasd', '2015-09-08', '2015-09-30', 17, 5, 'Denied', 'Administrator Arden', '2015-09-08 14:35:41', '2015-09-08 14:31:38', 'EMP001'),
(00002, 'LVR', 'SL', 'eqwewe', '2015-09-08', '2015-09-09', 2, 5, 'Approved', 'HR Manager Bong', '2015-09-08 15:17:42', '2015-09-08 15:14:34', 'EMP004'),
(00003, 'LVR', 'SL', 'qwe', '2015-09-09', '2015-09-09', 1, 5, 'Pending', NULL, NULL, '2015-09-09 00:34:29', 'EMP001'),
(00004, 'LVR', 'SL', 'eeee', '2015-09-09', '2015-09-09', 1, 5, 'Pending', NULL, NULL, '2015-09-09 00:35:40', 'EMP001'),
(00005, 'LVR', 'SL', 'qweqwe', '2015-09-10', '2015-09-09', 1, 5, 'Pending', NULL, NULL, '2015-09-09 00:37:02', 'EMP001'),
(00006, 'LVR', 'SL', 'qweqwe', '2015-09-10', '2015-09-09', 1, 5, 'Pending', NULL, NULL, '2015-09-09 00:37:24', 'EMP001'),
(00007, 'LVR', 'SL', 'asd', '2015-09-09', '2015-09-09', 1, 3, 'Pending', NULL, NULL, '2015-09-09 08:17:36', 'EMP004');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_leave_type`
--

DROP TABLE IF EXISTS `tbl_leave_type`;
CREATE TABLE IF NOT EXISTS `tbl_leave_type` (
  `leave_type_id` varchar(10) DEFAULT '',
  `leave_type_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_leave_type`
--

INSERT INTO `tbl_leave_type` (`leave_type_id`, `leave_type_name`) VALUES
('SL', 'Sick Leave'),
('VL', 'Vacation Leave'),
('OTH', 'Others');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_materials`
--

DROP TABLE IF EXISTS `tbl_materials`;
CREATE TABLE IF NOT EXISTS `tbl_materials` (
  `item_id` varchar(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `project_id` varchar(10) NOT NULL,
  `date_issued` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_materials`
--

INSERT INTO `tbl_materials` (`item_id`, `quantity`, `price`, `project_id`, `date_issued`) VALUES
('STK1001', 20, '20000.00', 'P1001', '2015-07-08'),
('STK1002', 2, '100.00', 'P1003', '2015-07-09'),
('STK1003', 20, '500.00', 'P1001', '2015-07-30'),
('STK1004', 100, '500.00', 'P1001', '2015-07-21'),
('STK1005', 100, '7000.00', 'P1003', '2015-07-21'),
('STK1001', 100, '200.00', 'P1005', '2015-07-28'),
('STK1004', 2, '4000.00', 'P1004', '2015-07-08'),
('STK1006', 2, '4000.00', 'P1005', '2015-07-08'),
('STK1006', 2, '4000.00', 'P1006', '2015-07-19'),
('STK1001', 2, '2000.00', 'P1005', '2015-07-20'),
('STK1002', 10, '30000.00', 'P1002', '2015-07-20'),
('STK1001', 20, '1000.00', 'P1002', '2015-07-21'),
('STK1001', 20, '1000.00', 'P1007', '2015-07-20'),
('STK1002', 50, '10000.00', 'P1001', '2015-07-22'),
('STK1003', 10, '1000.00', 'P1003', '2015-07-23'),
('STK1004', 60, '1000.00', 'P1002', '2015-07-22'),
('STK1001', 10, '1001.00', 'P1008', '2015-09-09');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payslip`
--

DROP TABLE IF EXISTS `tbl_payslip`;
CREATE TABLE IF NOT EXISTS `tbl_payslip` (
  `payslip_id` int(4) NOT NULL,
  `emp_id` varchar(8) NOT NULL,
  `payslip_date` datetime NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `monthly_rate` decimal(8,2) NOT NULL,
  `basic_salary` decimal(8,2) NOT NULL,
  `total_overtime` decimal(8,2) NOT NULL,
  `total_tardiness` decimal(8,2) NOT NULL,
  `days_absent` decimal(4,2) DEFAULT NULL,
  `total_absent_amount` decimal(8,2) NOT NULL,
  `total_allowances` decimal(8,2) NOT NULL,
  `total_taxes` decimal(8,2) NOT NULL,
  `gross_pay` decimal(8,2) NOT NULL,
  `net_pay` decimal(8,2) NOT NULL,
  `remarks` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_payslip`
--

INSERT INTO `tbl_payslip` (`payslip_id`, `emp_id`, `payslip_date`, `start_date`, `end_date`, `monthly_rate`, `basic_salary`, `total_overtime`, `total_tardiness`, `days_absent`, `total_absent_amount`, `total_allowances`, `total_taxes`, `gross_pay`, `net_pay`, `remarks`) VALUES
(8, 'EMP003', '2015-06-20 00:00:00', '2015-06-01 00:00:00', '2015-06-15 00:00:00', '40000.00', '20000.00', '1215.52', '0.00', NULL, '1841.08', '500.00', '3776.14', '19874.44', '16098.29', ''),
(9, 'EMP002', '2015-06-20 00:00:00', '2015-06-01 00:00:00', '2015-06-15 00:00:00', '15000.00', '7500.00', '455.82', '0.00', NULL, '690.66', '500.00', '1475.38', '7765.16', '6289.78', ''),
(10, 'EMP001', '2015-06-20 00:00:00', '2015-06-01 00:00:00', '2015-06-15 00:00:00', '15000.00', '7500.00', '455.82', '0.00', NULL, '690.66', '500.00', '1475.38', '7765.16', '6289.78', ''),
(11, 'EMP002', '2015-06-20 00:00:00', '2015-06-01 00:00:00', '2015-06-15 00:00:00', '15000.00', '7500.00', '455.82', '0.00', NULL, '690.66', '500.00', '1475.38', '7765.16', '6289.78', ''),
(12, 'EMP001', '2015-06-20 00:00:00', '2015-06-01 00:00:00', '2015-06-15 00:00:00', '15000.00', '7500.00', '455.82', '0.00', NULL, '690.66', '500.00', '1475.38', '7765.16', '6289.78', ''),
(13, 'EMP003', '2015-06-20 00:00:00', '2015-06-01 00:00:00', '2015-06-15 00:00:00', '15000.00', '7500.00', '455.82', '0.00', NULL, '690.66', '500.00', '1475.38', '7765.16', '6289.78', ''),
(22, 'EMP002', '2015-06-19 00:00:00', '2015-06-01 00:00:00', '2015-06-15 00:00:00', '15000.00', '7500.00', '455.82', '0.00', '1.00', '689.66', '500.00', '1475.57', '7766.16', '6290.59', ''),
(24, 'EMP001', '2015-06-18 00:00:00', '2015-06-01 00:00:00', '2015-06-17 00:00:00', '40000.00', '20000.00', '1215.52', '0.00', '4.00', '7356.32', '500.00', '2728.25', '14359.20', '11630.95', ''),
(25, 'EMP003', '2015-06-18 00:00:00', '2015-06-01 00:00:00', '2015-06-17 00:00:00', '15000.00', '7500.00', '455.82', '0.00', '3.00', '2068.97', '500.00', '1213.50', '6386.85', '5173.35', ''),
(26, 'EMP002', '2015-06-18 00:00:00', '2015-06-01 00:00:00', '2015-06-17 00:00:00', '15000.00', '7500.00', '455.82', '0.00', '3.00', '2068.97', '500.00', '1213.50', '6386.85', '5173.35', ''),
(27, 'EMP001', '2015-06-18 00:00:00', '2015-06-01 00:00:00', '2015-06-17 00:00:00', '15000.00', '7500.00', '455.82', '0.00', '3.00', '2068.97', '500.00', '1213.50', '6386.85', '5173.35', ''),
(28, 'EMP003', '2015-06-18 00:00:00', '2015-06-01 00:00:00', '2015-06-17 00:00:00', '15000.00', '7500.00', '455.82', '0.00', '3.00', '2068.97', '500.00', '1213.50', '6386.85', '5173.35', ''),
(29, 'EMP002', '2015-06-18 00:00:00', '2015-06-01 00:00:00', '2015-06-17 00:00:00', '15000.00', '7500.00', '455.82', '0.00', '3.00', '2068.97', '500.00', '1213.50', '6386.85', '5173.35', ''),
(30, 'EMP001', '2015-06-21 00:00:00', '2015-06-01 00:00:00', '2015-06-15 00:00:00', '40000.00', '20000.00', '1215.52', '0.00', '2.00', '3678.16', '21480.00', '7123.12', '39017.36', '31894.23', ''),
(31, 'EMP001', '2015-06-24 00:00:00', '2015-06-01 00:00:00', '2015-06-15 00:00:00', '40000.00', '20000.00', '1215.52', '0.00', '2.00', '3678.16', '21480.00', '7123.12', '39017.36', '31894.23', ''),
(32, 'EMP001', '2015-06-24 00:00:00', '2015-06-01 00:00:00', '2015-06-15 00:00:00', '40000.00', '20000.00', '1215.52', '0.00', '1.00', '1839.08', '21480.00', '7454.16', '40856.44', '33402.28', ''),
(33, 'EMP001', '2015-06-24 00:00:00', '2015-06-01 00:00:00', '2015-06-15 00:00:00', '40000.00', '20000.00', '1215.52', '0.00', '1.00', '1839.08', '21480.00', '7454.16', '40856.44', '33402.28', ''),
(34, 'EMP001', '2015-06-24 00:00:00', '2015-06-01 00:00:00', '2015-06-15 00:00:00', '40000.00', '20000.00', '1215.52', '0.00', '1.00', '1839.08', '21480.00', '7454.16', '40856.44', '33402.28', ''),
(35, 'EMP001', '2015-06-24 00:00:00', '2015-06-01 00:00:00', '2015-06-15 00:00:00', '0.00', '0.00', '0.00', '0.00', '1.00', '0.00', '1500.00', '370.00', '1500.00', '1130.00', ''),
(36, 'EMP001', '2015-06-24 00:00:00', '2015-06-01 00:00:00', '2015-06-15 00:00:00', '0.00', '0.00', '0.00', '0.00', '1.00', '0.00', '1500.00', '370.00', '1500.00', '1130.00', ''),
(37, 'EMP001', '2015-06-19 00:00:00', '2015-06-01 00:00:00', '2015-06-15 00:00:00', '15000.00', '7500.00', '0.00', '0.00', '4.00', '2758.62', '10092.50', '2770.10', '14833.88', '12063.78', ''),
(38, 'EMP001', '2015-06-19 00:00:00', '2015-06-01 00:00:00', '2015-06-15 00:00:00', '15000.00', '7500.00', '0.00', '0.00', '4.00', '2758.62', '10092.50', '2770.10', '14833.88', '12063.78', ''),
(39, 'EMP001', '2015-06-19 00:00:00', '2015-06-01 00:00:00', '2015-06-15 00:00:00', '15000.00', '7500.00', '0.00', '0.00', '4.00', '2758.62', '9242.50', '1250.00', '4741.38', '12733.88', ''),
(40, 'EMP001', '2015-06-30 00:00:00', '2015-06-01 00:00:00', '2015-06-15 00:00:00', '15000.00', '7500.00', '0.00', '0.00', '4.00', '2758.62', '9242.50', '1250.00', '4741.38', '12733.88', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payslip_allowances`
--

DROP TABLE IF EXISTS `tbl_payslip_allowances`;
CREATE TABLE IF NOT EXISTS `tbl_payslip_allowances` (
  `payslip_allowance_id` int(11) NOT NULL,
  `payslip_id` int(11) NOT NULL,
  `allowance_id` int(11) NOT NULL,
  `percentage` decimal(3,3) NOT NULL,
  `percentage_amount` decimal(8,2) NOT NULL,
  `fixed_amount` decimal(8,2) NOT NULL,
  `total` decimal(8,2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=latin1;

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
(28, 19, 2, '0.000', '0.00', '200.00', '200.00'),
(29, 30, 1, '0.000', '0.00', '300.00', '300.00'),
(30, 30, 2, '0.000', '0.00', '200.00', '200.00'),
(31, 30, 3, '0.999', '19980.00', '1000.00', '20980.00'),
(32, 31, 1, '0.000', '0.00', '300.00', '300.00'),
(33, 31, 2, '0.000', '0.00', '200.00', '200.00'),
(34, 31, 3, '0.999', '19980.00', '1000.00', '20980.00'),
(35, 32, 1, '0.000', '0.00', '300.00', '300.00'),
(36, 32, 2, '0.000', '0.00', '200.00', '200.00'),
(37, 32, 3, '0.999', '19980.00', '1000.00', '20980.00'),
(38, 33, 1, '0.000', '0.00', '300.00', '300.00'),
(39, 33, 2, '0.000', '0.00', '200.00', '200.00'),
(40, 33, 3, '0.999', '19980.00', '1000.00', '20980.00'),
(41, 34, 1, '0.000', '0.00', '300.00', '300.00'),
(42, 34, 2, '0.000', '0.00', '200.00', '200.00'),
(43, 34, 3, '0.999', '19980.00', '1000.00', '20980.00'),
(44, 35, 1, '0.000', '0.00', '300.00', '300.00'),
(45, 35, 2, '0.000', '0.00', '200.00', '200.00'),
(46, 35, 3, '0.999', '0.00', '1000.00', '1000.00'),
(47, 36, 1, '0.000', '0.00', '300.00', '300.00'),
(48, 36, 2, '0.000', '0.00', '200.00', '200.00'),
(49, 36, 3, '0.999', '0.00', '1000.00', '1000.00'),
(50, 37, 0, '0.000', '0.00', '0.00', '0.00'),
(51, 37, 0, '0.000', '0.00', '0.00', '0.00'),
(52, 37, 0, '0.000', '0.00', '0.00', '0.00'),
(53, 37, 0, '0.000', '0.00', '0.00', '0.00'),
(54, 38, 0, '0.000', '0.00', '0.00', '0.00'),
(55, 38, 0, '0.000', '0.00', '0.00', '0.00'),
(56, 38, 0, '0.000', '0.00', '0.00', '0.00'),
(57, 38, 0, '0.000', '0.00', '0.00', '0.00'),
(58, 39, 1, '0.000', '0.00', '300.00', '150.00'),
(59, 39, 2, '0.000', '0.00', '200.00', '100.00'),
(60, 39, 3, '0.999', '7492.50', '1000.00', '7.00'),
(61, 39, 4, '0.120', '900.00', '200.00', '1.00'),
(62, 40, 1, '0.000', '0.00', '300.00', '150.00'),
(63, 40, 2, '0.000', '0.00', '200.00', '100.00'),
(64, 40, 3, '0.999', '7492.50', '1000.00', '7992.50'),
(65, 40, 4, '0.120', '900.00', '200.00', '1000.00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payslip_taxes`
--

DROP TABLE IF EXISTS `tbl_payslip_taxes`;
CREATE TABLE IF NOT EXISTS `tbl_payslip_taxes` (
  `payslip_tax_id` int(11) NOT NULL,
  `payslip_id` int(11) NOT NULL,
  `tax_id` int(11) NOT NULL,
  `percentage` decimal(3,3) NOT NULL,
  `percentage_amount` decimal(8,2) NOT NULL,
  `fixed_amount` decimal(8,2) NOT NULL,
  `total` decimal(8,2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=99 DEFAULT CHARSET=latin1;

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
(56, 19, 6, '0.120', '931.82', '0.00', '931.82'),
(57, 30, 3, '0.040', '1560.69', '0.00', '1560.69'),
(58, 30, 4, '0.020', '780.35', '0.00', '780.35'),
(59, 30, 6, '0.120', '4682.08', '0.00', '4682.08'),
(60, 30, 7, '0.000', '0.00', '100.00', '100.00'),
(61, 31, 3, '0.040', '1560.69', '0.00', '1560.69'),
(62, 31, 4, '0.020', '780.35', '0.00', '780.35'),
(63, 31, 6, '0.120', '4682.08', '0.00', '4682.08'),
(64, 31, 7, '0.000', '0.00', '100.00', '100.00'),
(65, 32, 3, '0.040', '1634.26', '0.00', '1634.26'),
(66, 32, 4, '0.020', '817.13', '0.00', '817.13'),
(67, 32, 6, '0.120', '4902.77', '0.00', '4902.77'),
(68, 32, 7, '0.000', '0.00', '100.00', '100.00'),
(69, 33, 3, '0.040', '1634.26', '0.00', '1634.26'),
(70, 33, 4, '0.020', '817.13', '0.00', '817.13'),
(71, 33, 6, '0.120', '4902.77', '0.00', '4902.77'),
(72, 33, 7, '0.000', '0.00', '100.00', '100.00'),
(73, 34, 3, '0.040', '1634.26', '0.00', '1634.26'),
(74, 34, 4, '0.020', '817.13', '0.00', '817.13'),
(75, 34, 6, '0.120', '4902.77', '0.00', '4902.77'),
(76, 34, 7, '0.000', '0.00', '100.00', '100.00'),
(77, 35, 3, '0.040', '60.00', '0.00', '60.00'),
(78, 35, 4, '0.020', '30.00', '0.00', '30.00'),
(79, 35, 6, '0.120', '180.00', '0.00', '180.00'),
(80, 35, 7, '0.000', '0.00', '100.00', '100.00'),
(81, 36, 3, '0.040', '60.00', '0.00', '60.00'),
(82, 36, 4, '0.020', '30.00', '0.00', '30.00'),
(83, 36, 6, '0.120', '180.00', '0.00', '180.00'),
(84, 36, 7, '0.000', '0.00', '100.00', '100.00'),
(85, 37, 0, '0.000', '0.00', '0.00', '0.00'),
(86, 37, 0, '0.000', '0.00', '0.00', '0.00'),
(87, 37, 0, '0.000', '0.00', '0.00', '0.00'),
(88, 37, 0, '0.000', '0.00', '0.00', '0.00'),
(89, 38, 0, '0.000', '0.00', '0.00', '0.00'),
(90, 38, 0, '0.000', '0.00', '0.00', '0.00'),
(91, 39, 3, '0.000', '0.00', '0.00', '150.00'),
(92, 39, 4, '0.000', '0.00', '0.00', '150.00'),
(93, 39, 6, '0.000', '0.00', '0.00', '900.00'),
(94, 39, 7, '0.000', '0.00', '0.00', '50.00'),
(95, 40, 3, '0.040', '300.00', '0.00', '150.00'),
(96, 40, 4, '0.000', '0.00', '0.00', '150.00'),
(97, 40, 6, '0.000', '0.00', '0.00', '900.00'),
(98, 40, 7, '0.000', '0.00', '0.00', '50.00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_project`
--

DROP TABLE IF EXISTS `tbl_project`;
CREATE TABLE IF NOT EXISTS `tbl_project` (
  `project_id` varchar(5) DEFAULT NULL,
  `project_name` varchar(50) DEFAULT NULL,
  `client` varchar(50) DEFAULT NULL,
  `starting_date` date DEFAULT NULL,
  `ending_date` date DEFAULT NULL,
  `date_added` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_project`
--

INSERT INTO `tbl_project` (`project_id`, `project_name`, `client`, `starting_date`, `ending_date`, `date_added`) VALUES
('P1001', 'Project Almanac', 'CL1001', '2015-07-08', '2015-08-01', '2015-07-08 13:36:31'),
('P1002', 'Project Beta', 'CL1002', '2015-07-03', '2015-07-22', '2015-07-08 14:21:12'),
('P1003', 'Project X', 'CL1004', '2015-07-09', '2015-07-14', '2015-07-08 18:59:33'),
('P1004', 'Project Alpha', 'CL1003', '2015-07-10', '2015-08-07', '2015-07-08 19:05:40'),
('P1006', '9DevCorp', 'CL1005', '2015-07-15', '2015-07-22', '2015-07-21 23:19:42'),
('P1007', 'Project Pie', 'CL1002', '2015-07-20', '2015-07-23', '2015-07-20 01:06:53'),
('P1008', 'Project Cool', 'JRU', '2015-09-23', '2015-09-25', '2015-09-09 16:14:29');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_project_workers`
--

DROP TABLE IF EXISTS `tbl_project_workers`;
CREATE TABLE IF NOT EXISTS `tbl_project_workers` (
  `project_id` varchar(10) DEFAULT NULL,
  `employee_id` varchar(8) DEFAULT NULL,
  `assigned_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_project_workers`
--

INSERT INTO `tbl_project_workers` (`project_id`, `employee_id`, `assigned_date`) VALUES
('P1009', 'EMP001', '2015-08-04'),
('P1001', 'EMP001', '2015-09-09'),
('P1002', 'EMP002', '2015-09-09'),
('P1003', 'EMP003', '2015-09-09');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_requestentry`
--

DROP TABLE IF EXISTS `tbl_requestentry`;
CREATE TABLE IF NOT EXISTS `tbl_requestentry` (
  `req_id` int(11) NOT NULL,
  `emp_id` varchar(8) NOT NULL,
  `date_value` date NOT NULL,
  `time_in` time NOT NULL,
  `time_out` time NOT NULL,
  `remarks` varchar(200) DEFAULT NULL,
  `date_requested` datetime NOT NULL,
  `approved` tinyint(1) DEFAULT NULL,
  `approved_by` varchar(8) DEFAULT NULL,
  `date_approved` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_requestentry`
--

INSERT INTO `tbl_requestentry` (`req_id`, `emp_id`, `date_value`, `time_in`, `time_out`, `remarks`, `date_requested`, `approved`, `approved_by`, `date_approved`) VALUES
(1, 'EMP002', '2015-06-22', '08:00:00', '00:00:00', NULL, '2015-07-13 00:00:00', 0, 'EMP001', '0000-00-00 00:00:00'),
(2, 'EMP003', '2015-06-22', '08:00:00', '00:00:00', NULL, '2015-07-13 00:00:00', 1, 'EMP001', '0000-00-00 00:00:00'),
(3, 'EMP004', '2015-06-22', '08:00:00', '05:00:00', NULL, '2015-07-13 00:00:00', 0, 'EMP001', '0000-00-00 00:00:00'),
(4, 'EMP005', '2015-06-22', '08:00:00', '05:00:00', NULL, '2015-07-13 00:00:00', NULL, NULL, NULL),
(5, 'EMP001', '2015-06-22', '08:00:00', '05:00:00', NULL, '2015-07-13 00:00:00', 1, 'EMP001', '0000-00-00 00:00:00'),
(6, 'EMP001', '2015-06-22', '08:00:00', '05:00:00', NULL, '2015-07-13 00:00:00', NULL, NULL, NULL),
(7, 'EMP001', '2015-06-15', '09:00:00', '04:00:00', NULL, '0000-00-00 00:00:00', 1, 'EMP001', '0000-00-00 00:00:00'),
(8, 'EMP001', '2015-06-06', '08:50:00', '12:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL, '2015-07-17 23:24:04'),
(9, 'EMP001', '2015-06-01', '09:00:00', '12:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL, '2015-08-19 03:10:37'),
(10, 'EMP001', '2015-06-09', '08:30:00', '07:30:00', NULL, '0000-00-00 00:00:00', NULL, NULL, '2015-08-25 21:01:37'),
(11, 'EMP001', '2015-06-24', '08:00:00', '17:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL, '2015-09-09 17:08:44');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_restock`
--

DROP TABLE IF EXISTS `tbl_restock`;
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
('STK1002', 'VEN1001', 610, '2015-07-19'),
('STK10012', 'VEN1002', 100, '2015-08-06');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_school`
--

DROP TABLE IF EXISTS `tbl_school`;
CREATE TABLE IF NOT EXISTS `tbl_school` (
  `employee_id` varchar(8) DEFAULT NULL,
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
('EMP001', '', '', 0, '', '', 0, '', '', 0),
('EMP002', '', '', 0, '', '', 0, '', '', 0),
('EMP003', '', '', 0, '', '', 0, '', '', 0),
('EMP004', '', '', 0, '', '', 0, '', '', 0),
('EMP005', '', '', 0, '', '', 0, '', '', 0),
('EMP006', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('EMP007', '', '', 0, '', '', 0, '', '', 0),
('EMP008', '', '', 0, '', '', 0, '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stocks`
--

DROP TABLE IF EXISTS `tbl_stocks`;
CREATE TABLE IF NOT EXISTS `tbl_stocks` (
  `item_id` varchar(10) NOT NULL,
  `quantity` varchar(50) NOT NULL,
  `date_last_restocked` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_stocks`
--

INSERT INTO `tbl_stocks` (`item_id`, `quantity`, `date_last_restocked`) VALUES
('STK1001', '890', '2015-07-18'),
('STK10012', '100', '2015-08-06'),
('STK1002', '1100', '2015-07-19'),
('STK1003', '980', '2015-07-19'),
('STK1004', '950', '2015-07-19'),
('STK1005', '990', '2015-07-19'),
('STK1006', '1008', '2015-07-08'),
('STK1007', '1000', '2015-07-19');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stocks_category`
--

DROP TABLE IF EXISTS `tbl_stocks_category`;
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
('PPR', 'Paper Materials'),
('SC', 'Secret Materials'),
('STL', 'Steel Materials');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stock_info`
--

DROP TABLE IF EXISTS `tbl_stock_info`;
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
('STK1001', 'Steel Posts', 'STL', '1001.00'),
('STK1002', 'Wooden Chair', 'ELEC', '2000.00'),
('STK1003', 'Steel Plates', 'PLSTC', '5000.00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_supervisions`
--

DROP TABLE IF EXISTS `tbl_supervisions`;
CREATE TABLE IF NOT EXISTS `tbl_supervisions` (
  `supervisor_id` varchar(10) DEFAULT NULL,
  `employee_id` varchar(8) DEFAULT NULL,
  `assigned_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_supervisions`
--

INSERT INTO `tbl_supervisions` (`supervisor_id`, `employee_id`, `assigned_date`) VALUES
('SP1001', 'EMP006', '2015-09-09');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_supervisors`
--

DROP TABLE IF EXISTS `tbl_supervisors`;
CREATE TABLE IF NOT EXISTS `tbl_supervisors` (
  `supervisor_id` varchar(6) DEFAULT NULL,
  `employee_id` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_supervisors`
--

INSERT INTO `tbl_supervisors` (`supervisor_id`, `employee_id`) VALUES
('SP1001', 'EMP001'),
('SP1002', 'EMP002');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_taxes`
--

DROP TABLE IF EXISTS `tbl_taxes`;
CREATE TABLE IF NOT EXISTS `tbl_taxes` (
  `tax_id` int(4) NOT NULL,
  `tax_name` varchar(50) NOT NULL,
  `percentage` decimal(3,3) NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `ranges_active` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_taxes`
--

INSERT INTO `tbl_taxes` (`tax_id`, `tax_name`, `percentage`, `amount`, `active`, `ranges_active`) VALUES
(3, 'SSS', '0.040', '0.00', 1, 1),
(4, 'Philhealth', '0.020', '0.00', 1, 0),
(6, 'Withholding', '0.120', '0.00', 1, 0),
(7, 'TIN', '0.000', '100.00', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tax_range`
--

DROP TABLE IF EXISTS `tbl_tax_range`;
CREATE TABLE IF NOT EXISTS `tbl_tax_range` (
  `tax_range_id` int(11) NOT NULL,
  `tax_id` int(11) NOT NULL,
  `amount_from` decimal(8,2) NOT NULL,
  `amount_to` decimal(8,2) NOT NULL,
  `amount_deducted` decimal(8,2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_tax_range`
--

INSERT INTO `tbl_tax_range` (`tax_range_id`, `tax_id`, `amount_from`, `amount_to`, `amount_deducted`) VALUES
(1, 3, '10000.00', '12499.00', '100.00'),
(2, 3, '12500.00', '14999.00', '125.00'),
(3, 3, '15000.00', '17499.00', '150.00'),
(4, 4, '17500.00', '22499.00', '200.00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE IF NOT EXISTS `tbl_user` (
  `user_id` int(5) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `user_level` varchar(20) DEFAULT NULL,
  `profile_image` varchar(100) DEFAULT NULL,
  `employee_id` varchar(8) DEFAULT NULL,
  `logged` tinyint(2) DEFAULT '0',
  `date_registered` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `username`, `password`, `email`, `user_level`, `profile_image`, `employee_id`, `logged`, `date_registered`) VALUES
(1, 'admin', 'nKH3ERO9gzXxj4m5R6g6a1RdxO9OQmd+gdSC79JVirSOOnur+qCJ7nMX0syHwHv/52+cFQVcmQH9rrCJMfX8xQ==', 'ardents02@gmail.com', 'ADMIN', 'DSC_1538.png', 'EMP001', 1, '2015-06-05 05:28:36'),
(2, 'hrmanager', '/1miPRnyxIc6K7OLV/V/d4sFNVDvUPesrrIDxo7Nr25GRFU7Hgu2A5sGI5ib9DYS4sdMQSukOA7jjHiefQLh4w==', NULL, 'HR', '99335579.jpg', 'EMP002', 0, '2015-09-07 07:38:44'),
(3, 'finance', 'kR6FMoRNt/qhhoZXvBnl1c8cwdrV5Rle2K4O+H571Nlf5TPE3Wq5/OODAcmIvnkq7ah9BKFA/KRyKqhtVmeGKQ==', NULL, 'FIN', 'hello-kitty1.png', 'EMP003', 0, '2015-09-07 07:39:02'),
(4, 'employee', '517tIeRe8Qo0/S1JDGfyS8eUj1e/t2FCXezqhqgXvzJH285QtB3P38KEHFabTBUlbIeryf81KYT+JfVCNiGbPA==', NULL, 'EMP', 'default.jpg', 'EMP004', 0, '2015-09-07 07:39:02'),
(5, 'stock', 'jQIsia43tYbiyTSYXuf9LX2IXY2Z37WMGgmCpAnoW+XhSMaOD+Eb3P/Jz3aA1JhRk+mhE4EliR5ALuODwpITuQ==', NULL, 'STK', 'default.jpg', 'EMP005', 0, '2015-09-07 07:39:02'),
(6, NULL, NULL, NULL, 'EMP', 'default.jpg', 'EMP006', 0, '2015-09-07 07:39:02'),
(8, '', '1nw/DGCyDDsv/TQoWPDnpBbfU1OjXrhrSOp2x+vGANXjQfyzZy7WnbceaMG2PXmKoGOHHg5+10SMnjPoFndW7mG/G/iJBuqfJDtHXaGa1NCCrGQiQrETz5HTaAB2lLlhmczKG8djKjoU+PTRKhVWavhu3pwtcev+RMbUbGVTGjfDl74sVtRus+WnWr6jvhhQnSk+kqdC8eMOgY5AGKvTASPHEAg6Q/GdYnaao0PVrDp6SVBcVr+su7xcUSu3xok', NULL, 'EMP', 'default.jpg', 'EMP007', 0, '2015-09-07 06:55:03'),
(39, '', 'Tha5P7CjRucOFHXtHBkSP7Qp8aGx+O1s/CEImBwIVrS069/00BwFVz65aYu5PAW5H3ZrUNmWk5PqNCu3NBNnMA==', NULL, 'EMP', 'default.jpg', 'EMP008', 0, '2015-09-07 07:58:57');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_level`
--

DROP TABLE IF EXISTS `tbl_user_level`;
CREATE TABLE IF NOT EXISTS `tbl_user_level` (
  `user_level_id` varchar(10) NOT NULL,
  `user_level` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user_level`
--

INSERT INTO `tbl_user_level` (`user_level_id`, `user_level`) VALUES
('ADMIN', 'Administrator'),
('EMP', 'Employee'),
('FIN', 'Finance Manager'),
('HR', 'HR Manager'),
('STK', 'Stock Clerk'),
('SUP', 'Supervisor');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vendor`
--

DROP TABLE IF EXISTS `tbl_vendor`;
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
('VEN1001', 'Secret Shop', 'Secret Lair', 999999999, 'secret@gmail.com'),
('VEN1002', 'Ace Hardware', '', 0, NULL);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_all_project_materials`
--
DROP VIEW IF EXISTS `view_all_project_materials`;
CREATE TABLE IF NOT EXISTS `view_all_project_materials` (
`item_name` varchar(50)
,`quantity` int(10)
,`price` decimal(10,2)
,`project_name` varchar(50)
,`date_issued` date
,`item_id` varchar(10)
,`project_id` varchar(5)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_asset_request`
--
DROP VIEW IF EXISTS `view_asset_request`;
CREATE TABLE IF NOT EXISTS `view_asset_request` (
`asset_request_id` smallint(5) unsigned zerofill
,`asset_name` varchar(50)
,`quantity` smallint(6)
,`request_status` varchar(20)
,`date_requested` timestamp
,`name` varchar(152)
,`approved_by` varchar(50)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_assigned_assets`
--
DROP VIEW IF EXISTS `view_assigned_assets`;
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
,`emp_id` varchar(8)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_attendance`
--
DROP VIEW IF EXISTS `view_attendance`;
CREATE TABLE IF NOT EXISTS `view_attendance` (
`emp_id` varchar(8)
,`first_name` varchar(50)
,`middle_name` varchar(50)
,`last_name` varchar(50)
,`job_title_name` varchar(20)
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
-- Stand-in structure for view `view_calendar`
--
DROP VIEW IF EXISTS `view_calendar`;
CREATE TABLE IF NOT EXISTS `view_calendar` (
`calendar_id` int(11)
,`day_name` varchar(50)
,`description` varchar(200)
,`date_value` varchar(10)
,`day_type_id` int(11)
,`allow_absence` tinyint(1)
,`day_type_name` varchar(45)
,`multiplier` decimal(4,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_employees_list`
--
DROP VIEW IF EXISTS `view_employees_list`;
CREATE TABLE IF NOT EXISTS `view_employees_list` (
`emp_id` varchar(8)
,`first_name` varchar(50)
,`middle_name` varchar(50)
,`last_name` varchar(50)
,`status` varchar(50)
,`start_date` date
,`department_name` varchar(100)
,`employment_type` varchar(50)
,`job_title_name` varchar(20)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_emp_address`
--
DROP VIEW IF EXISTS `view_emp_address`;
CREATE TABLE IF NOT EXISTS `view_emp_address` (
`employee_id` varchar(8)
,`street` varchar(50)
,`barangay` varchar(50)
,`city` varchar(50)
,`state` varchar(50)
,`zip` int(10)
,`country_code` varchar(2)
,`country_name` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_emp_evaluation`
--
DROP VIEW IF EXISTS `view_emp_evaluation`;
CREATE TABLE IF NOT EXISTS `view_emp_evaluation` (
`evaluation_id` int(5)
,`evaluation_desc` varchar(50)
,`assessor` varchar(101)
,`assessee` varchar(101)
,`rate1` decimal(3,2)
,`rate2` decimal(3,2)
,`rate3` decimal(3,2)
,`rate4` decimal(3,2)
,`rate5` decimal(3,2)
,`rate6` decimal(3,2)
,`rate7` decimal(3,2)
,`rate8` decimal(3,2)
,`rate9` decimal(3,2)
,`rate10` decimal(3,2)
,`evaluation_date` timestamp
,`final_rating` decimal(16,6)
,`assessor_image` varchar(100)
,`assessee_image` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_evaluation`
--
DROP VIEW IF EXISTS `view_evaluation`;
CREATE TABLE IF NOT EXISTS `view_evaluation` (
`evaluation_id` int(5)
,`evaluation_desc` varchar(50)
,`assessor` varchar(101)
,`assessee` varchar(101)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_job_history`
--
DROP VIEW IF EXISTS `view_job_history`;
CREATE TABLE IF NOT EXISTS `view_job_history` (
`emp_id` varchar(8)
,`status` varchar(50)
,`employment_type` varchar(50)
,`job_title_name` varchar(20)
,`department_name` varchar(100)
,`start_date` date
,`probationary_date` date
,`permanency_date` date
,`salary` decimal(10,2)
,`end_date` date
,`pay_grade` varchar(5)
,`date_modified` datetime
,`employment_type_id` varchar(10)
,`department_id` varchar(10)
,`job_title_id` varchar(10)
,`first_name` varchar(50)
,`middle_name` varchar(50)
,`last_name` varchar(50)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_leave_left`
--
DROP VIEW IF EXISTS `view_leave_left`;
CREATE TABLE IF NOT EXISTS `view_leave_left` (
`name` varchar(152)
,`days` smallint(2)
,`leave_type_name` varchar(50)
,`employee_id` varchar(8)
,`leave_type_id` varchar(10)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_leave_request`
--
DROP VIEW IF EXISTS `view_leave_request`;
CREATE TABLE IF NOT EXISTS `view_leave_request` (
`name` varchar(152)
,`leave_request_id` varchar(8)
,`leave_reason` varchar(100)
,`leave_start` date
,`leave_status` varchar(20)
,`approved_by` varchar(255)
,`date_approved` timestamp
,`date_requested` timestamp
,`leave_end` date
,`leave_left` smallint(2)
,`leave_type` varchar(50)
,`leave_type_name` varchar(50)
,`emp_id` varchar(8)
,`leave_type_id` varchar(10)
,`days` tinyint(2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_materials`
--
DROP VIEW IF EXISTS `view_materials`;
CREATE TABLE IF NOT EXISTS `view_materials` (
`item_name` varchar(50)
,`item_id` varchar(10)
,`quantity` int(10)
,`price` decimal(10,2)
,`project_id` varchar(10)
,`date_issued` date
,`project_name` varchar(50)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_payslip`
--
DROP VIEW IF EXISTS `view_payslip`;
CREATE TABLE IF NOT EXISTS `view_payslip` (
`emp_id` varchar(8)
,`first_name` varchar(50)
,`middle_name` varchar(50)
,`last_name` varchar(50)
,`department_name` varchar(100)
,`job_title_name` varchar(20)
,`emp_history_start_date` date
,`emp_history_end_date` date
,`payslip_id` int(4)
,`payslip_date` datetime
,`start_date` datetime
,`end_date` datetime
,`monthly_rate` decimal(8,2)
,`basic_salary` decimal(8,2)
,`total_overtime` decimal(8,2)
,`total_tardiness` decimal(8,2)
,`days_absent` decimal(4,2)
,`total_absent_amount` decimal(8,2)
,`total_allowances` decimal(8,2)
,`total_taxes` decimal(8,2)
,`gross_pay` decimal(8,2)
,`net_pay` decimal(8,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_payslip_allowances`
--
DROP VIEW IF EXISTS `view_payslip_allowances`;
CREATE TABLE IF NOT EXISTS `view_payslip_allowances` (
`payslip_allowance_id` int(11)
,`allowance_id` int(11)
,`allowance_name` varchar(50)
,`payslip_id` int(4)
,`percentage` decimal(3,3)
,`percentage_amount` decimal(8,2)
,`fixed_amount` decimal(8,2)
,`total` decimal(8,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_payslip_taxes`
--
DROP VIEW IF EXISTS `view_payslip_taxes`;
CREATE TABLE IF NOT EXISTS `view_payslip_taxes` (
`payslip_tax_id` int(11)
,`tax_id` int(4)
,`tax_name` varchar(50)
,`payslip_id` int(4)
,`percentage` decimal(3,3)
,`percentage_amount` decimal(8,2)
,`fixed_amount` decimal(8,2)
,`total` decimal(8,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_project_cost`
--
DROP VIEW IF EXISTS `view_project_cost`;
CREATE TABLE IF NOT EXISTS `view_project_cost` (
`starting_date` date
,`ending_date` date
,`project_id` varchar(5)
,`project_name` varchar(50)
,`client_name` varchar(50)
,`date_added` datetime
,`total_expense` decimal(42,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_project_workers`
--
DROP VIEW IF EXISTS `view_project_workers`;
CREATE TABLE IF NOT EXISTS `view_project_workers` (
`project_id` varchar(5)
,`project_name` varchar(50)
,`name` varchar(152)
,`assigned_date` date
,`emp_id` varchar(8)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_requestentry`
--
DROP VIEW IF EXISTS `view_requestentry`;
CREATE TABLE IF NOT EXISTS `view_requestentry` (
`req_id` int(11)
,`emp_id` varchar(8)
,`requestee` varchar(101)
,`date_value` date
,`time_in` time
,`time_out` time
,`remarks` varchar(200)
,`date_requested` datetime
,`approved` tinyint(1)
,`date_approved` datetime
,`approved_by` varchar(8)
,`approver` varchar(101)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_stocks`
--
DROP VIEW IF EXISTS `view_stocks`;
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
-- Stand-in structure for view `view_supervisions`
--
DROP VIEW IF EXISTS `view_supervisions`;
CREATE TABLE IF NOT EXISTS `view_supervisions` (
`supervisor_id` varchar(10)
,`employee_id` varchar(8)
,`employee_name` varchar(152)
,`supervisor_name` varchar(152)
,`assigned_date` date
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_supervisors`
--
DROP VIEW IF EXISTS `view_supervisors`;
CREATE TABLE IF NOT EXISTS `view_supervisors` (
`supervisor_id` varchar(6)
,`first_name` varchar(50)
,`middle_name` varchar(50)
,`last_name` varchar(50)
,`employee_id` varchar(8)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_users`
--
DROP VIEW IF EXISTS `view_users`;
CREATE TABLE IF NOT EXISTS `view_users` (
`user_id` int(5)
,`username` varchar(50)
,`password` varchar(255)
,`date_registered` timestamp
,`first_name` varchar(50)
,`middle_name` varchar(50)
,`last_name` varchar(50)
,`profile_image` varchar(100)
,`employee_id` varchar(8)
,`user_level` varchar(20)
,`user_level_id` varchar(10)
,`email` varchar(50)
,`logged` tinyint(2)
);

-- --------------------------------------------------------

--
-- Structure for view `view_all_project_materials`
--
DROP TABLE IF EXISTS `view_all_project_materials`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_all_project_materials` AS select `tbl_stock_info`.`item_name` AS `item_name`,`tbl_materials`.`quantity` AS `quantity`,`tbl_materials`.`price` AS `price`,`tbl_project`.`project_name` AS `project_name`,`tbl_materials`.`date_issued` AS `date_issued`,`tbl_stock_info`.`item_id` AS `item_id`,`tbl_project`.`project_id` AS `project_id` from ((`tbl_project` join `tbl_materials` on((`tbl_materials`.`project_id` = `tbl_project`.`project_id`))) join `tbl_stock_info` on((`tbl_materials`.`item_id` = `tbl_stock_info`.`item_id`)));

-- --------------------------------------------------------

--
-- Structure for view `view_asset_request`
--
DROP TABLE IF EXISTS `view_asset_request`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_asset_request` AS select `tbl_asset_request`.`asset_request_id` AS `asset_request_id`,`tbl_asset_request`.`asset_name` AS `asset_name`,`tbl_asset_request`.`quantity` AS `quantity`,`tbl_asset_request`.`request_status` AS `request_status`,`tbl_asset_request`.`date_requested` AS `date_requested`,concat(`tbl_emp_info`.`first_name`,' ',`tbl_emp_info`.`middle_name`,' ',`tbl_emp_info`.`last_name`) AS `name`,`tbl_asset_request`.`approved_by` AS `approved_by` from (`tbl_emp_info` join `tbl_asset_request` on((`tbl_emp_info`.`emp_id` = `tbl_asset_request`.`employee_id`)));

-- --------------------------------------------------------

--
-- Structure for view `view_assigned_assets`
--
DROP TABLE IF EXISTS `view_assigned_assets`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_assigned_assets` AS select `tbl_asset_info`.`asset_id` AS `asset_id`,`tbl_asset_info`.`asset_name` AS `asset_name`,`tbl_stocks_category`.`category_name` AS `category_name`,`tbl_assets`.`asset_status` AS `asset_status`,concat(`tbl_emp_info`.`first_name`,' ',`tbl_emp_info`.`middle_name`,' ',`tbl_emp_info`.`last_name`) AS `name`,`tbl_vendor`.`vendor_name` AS `vendor_name`,`tbl_asset_info`.`asset_description` AS `asset_description`,`tbl_asset_info`.`brand` AS `brand`,`tbl_asset_info`.`serial_number` AS `serial_number`,`tbl_asset_info`.`model` AS `model`,`tbl_asset_info`.`warranty_end_date` AS `warranty_end_date`,`tbl_assets`.`assigned_date` AS `assigned_date`,`tbl_emp_info`.`emp_id` AS `emp_id` from ((((`tbl_stocks_category` join `tbl_asset_info` on((`tbl_asset_info`.`category_id` = `tbl_stocks_category`.`category_id`))) join `tbl_assets` on((`tbl_assets`.`asset_id` = `tbl_asset_info`.`asset_id`))) join `tbl_emp_info` on((`tbl_assets`.`employee_id` = `tbl_emp_info`.`emp_id`))) join `tbl_vendor` on((`tbl_vendor`.`vendor_id` = `tbl_asset_info`.`vendor_id`))) order by `tbl_asset_info`.`asset_id`;

-- --------------------------------------------------------

--
-- Structure for view `view_attendance`
--
DROP TABLE IF EXISTS `view_attendance`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_attendance` AS select distinct `tbl_emp_info`.`emp_id` AS `emp_id`,`tbl_emp_info`.`first_name` AS `first_name`,`tbl_emp_info`.`middle_name` AS `middle_name`,`tbl_emp_info`.`last_name` AS `last_name`,`tbl_job_title`.`job_title_name` AS `job_title_name`,`tbl_attendance`.`datelog` AS `datelog`,date_format(`tbl_attendance`.`datetimelog`,'%m/%d/%Y') AS `logdate`,`FN_GETTIMEIN`(date_format(`tbl_attendance`.`datetimelog`,'%m/%d/%Y')) AS `time_in`,`FN_GETTIMEOUT`(date_format(`tbl_attendance`.`datetimelog`,'%m/%d/%Y')) AS `time_out`,ifnull(if((timestampdiff(MINUTE,str_to_date(concat('01/01/1970 ',convert(`FN_GETTIMEIN`(date_format(`tbl_attendance`.`datetimelog`,'%m/%d/%Y')) using utf8mb4)),'%c/%e/%Y %h:%i %p'),str_to_date(concat('01/01/1970 ',convert(`FN_GETTIMEOUT`(date_format(`tbl_attendance`.`datetimelog`,'%m/%d/%Y')) using utf8mb4)),'%c/%e/%Y %h:%i %p')) >= 0),format(((timestampdiff(MINUTE,str_to_date(concat('01/01/1970 ',convert(`FN_GETTIMEIN`(date_format(`tbl_attendance`.`datetimelog`,'%m/%d/%Y')) using utf8mb4)),'%c/%e/%Y %h:%i %p'),str_to_date(concat('01/01/1970 ',convert(`FN_GETTIMEOUT`(date_format(`tbl_attendance`.`datetimelog`,'%m/%d/%Y')) using utf8mb4)),'%c/%e/%Y %h:%i %p')) / 60) - 1),2),0),0) AS `man_hours`,ifnull(if((timestampdiff(MINUTE,str_to_date('01/01/1970 08:00 AM','%c/%e/%Y %h:%i %p'),str_to_date(concat('01/01/1970 ',convert(`FN_GETTIMEIN`(date_format(`tbl_attendance`.`datetimelog`,'%m/%d/%Y')) using utf8mb4)),'%c/%e/%Y %h:%i %p')) >= 0),timestampdiff(MINUTE,str_to_date('01/01/1970 08:00 AM','%c/%e/%Y %h:%i %p'),str_to_date(concat('01/01/1970 ',convert(`FN_GETTIMEIN`(date_format(`tbl_attendance`.`datetimelog`,'%m/%d/%Y')) using utf8mb4)),'%c/%e/%Y %h:%i %p')),0),0) AS `tardiness`,ifnull(if((timestampdiff(MINUTE,str_to_date('01/01/1970 05:00 PM','%c/%e/%Y %h:%i %p'),str_to_date(concat('01/01/1970 ',convert(`FN_GETTIMEOUT`(date_format(`tbl_attendance`.`datetimelog`,'%m/%d/%Y')) using utf8mb4)),'%c/%e/%Y %h:%i %p')) >= 0),format((timestampdiff(MINUTE,str_to_date('01/01/1970 05:00 PM','%c/%e/%Y %h:%i %p'),str_to_date(concat('01/01/1970 ',convert(`FN_GETTIMEOUT`(date_format(`tbl_attendance`.`datetimelog`,'%m/%d/%Y')) using utf8mb4)),'%c/%e/%Y %h:%i %p')) / 60),2),0),0) AS `overtime` from (((`tbl_emp_info` join `tbl_attendance` on((`tbl_attendance`.`emp_id` = convert(`tbl_emp_info`.`emp_id` using utf8)))) join `tbl_emp_history` on((`tbl_emp_info`.`emp_id` = `tbl_emp_history`.`emp_id`))) join `tbl_job_title` on((`tbl_job_title`.`job_title_id` = `tbl_emp_history`.`job_title_id`))) order by `tbl_emp_info`.`emp_id`,6;

-- --------------------------------------------------------

--
-- Structure for view `view_calendar`
--
DROP TABLE IF EXISTS `view_calendar`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_calendar` AS select `tbl_calendar`.`calendar_id` AS `calendar_id`,`tbl_calendar`.`day_name` AS `day_name`,`tbl_calendar`.`description` AS `description`,date_format(`tbl_calendar`.`date_value`,'%m/%d/%Y') AS `date_value`,`tbl_calendar`.`day_type_id` AS `day_type_id`,`tbl_calendar`.`allow_absence` AS `allow_absence`,`tbl_day_type`.`day_type_name` AS `day_type_name`,`tbl_day_type`.`multiplier` AS `multiplier` from (`tbl_calendar` join `tbl_day_type` on((`tbl_day_type`.`day_type_id` = `tbl_calendar`.`day_type_id`))) order by `tbl_calendar`.`date_value`;

-- --------------------------------------------------------

--
-- Structure for view `view_employees_list`
--
DROP TABLE IF EXISTS `view_employees_list`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_employees_list` AS select `tbl_emp_info`.`emp_id` AS `emp_id`,`tbl_emp_info`.`first_name` AS `first_name`,`tbl_emp_info`.`middle_name` AS `middle_name`,`tbl_emp_info`.`last_name` AS `last_name`,`tbl_emp_history`.`status` AS `status`,`tbl_emp_history`.`start_date` AS `start_date`,`tbl_departments`.`department_name` AS `department_name`,`tbl_employment_type`.`employment_type` AS `employment_type`,`tbl_job_title`.`job_title_name` AS `job_title_name` from ((((`tbl_emp_info` join `tbl_emp_history` on((`tbl_emp_info`.`emp_id` = `tbl_emp_history`.`emp_id`))) join `tbl_departments` on((`tbl_emp_history`.`department_id` = `tbl_departments`.`department_id`))) join `tbl_employment_type` on((`tbl_emp_history`.`employment_type_id` = `tbl_employment_type`.`employment_type_id`))) join `tbl_job_title` on((`tbl_emp_history`.`job_title_id` = `tbl_job_title`.`job_title_id`))) order by `tbl_emp_info`.`emp_id`;

-- --------------------------------------------------------

--
-- Structure for view `view_emp_address`
--
DROP TABLE IF EXISTS `view_emp_address`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_emp_address` AS select `tbl_address`.`employee_id` AS `employee_id`,`tbl_address`.`street` AS `street`,`tbl_address`.`barangay` AS `barangay`,`tbl_address`.`city` AS `city`,`tbl_address`.`state` AS `state`,`tbl_address`.`zip` AS `zip`,`tbl_countries`.`country_code` AS `country_code`,`tbl_countries`.`country_name` AS `country_name` from (`tbl_countries` join `tbl_address` on((`tbl_countries`.`country_code` = convert(`tbl_address`.`country` using utf8))));

-- --------------------------------------------------------

--
-- Structure for view `view_emp_evaluation`
--
DROP TABLE IF EXISTS `view_emp_evaluation`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_emp_evaluation` AS select `tbl_evaluation`.`evaluation_id` AS `evaluation_id`,`tbl_evaluation`.`evaluation_desc` AS `evaluation_desc`,concat(`assessor`.`first_name`,' ',`assessor`.`last_name`) AS `assessor`,concat(`assessee`.`first_name`,' ',`assessee`.`last_name`) AS `assessee`,`tbl_evaluation_rate`.`rate1` AS `rate1`,`tbl_evaluation_rate`.`rate2` AS `rate2`,`tbl_evaluation_rate`.`rate3` AS `rate3`,`tbl_evaluation_rate`.`rate4` AS `rate4`,`tbl_evaluation_rate`.`rate5` AS `rate5`,`tbl_evaluation_rate`.`rate6` AS `rate6`,`tbl_evaluation_rate`.`rate7` AS `rate7`,`tbl_evaluation_rate`.`rate8` AS `rate8`,`tbl_evaluation_rate`.`rate9` AS `rate9`,`tbl_evaluation_rate`.`rate10` AS `rate10`,`tbl_evaluation`.`evaluation_date` AS `evaluation_date`,((((((((((`tbl_evaluation_rate`.`rate1` + `tbl_evaluation_rate`.`rate2`) + `tbl_evaluation_rate`.`rate3`) + `tbl_evaluation_rate`.`rate4`) + `tbl_evaluation_rate`.`rate5`) + `tbl_evaluation_rate`.`rate6`) + `tbl_evaluation_rate`.`rate7`) + `tbl_evaluation_rate`.`rate8`) + `tbl_evaluation_rate`.`rate9`) + `tbl_evaluation_rate`.`rate10`) / 10) AS `final_rating`,`assessor`.`profile_image` AS `assessor_image`,`assessee`.`profile_image` AS `assessee_image` from (((`tbl_evaluation` join `tbl_evaluation_rate` on((`tbl_evaluation_rate`.`evaluation_id` = `tbl_evaluation`.`evaluation_id`))) join `view_users` `assessor` on((`tbl_evaluation`.`assessor_id` = `assessor`.`employee_id`))) join `view_users` `assessee` on((`tbl_evaluation`.`assessee_id` = `assessee`.`employee_id`)));

-- --------------------------------------------------------

--
-- Structure for view `view_evaluation`
--
DROP TABLE IF EXISTS `view_evaluation`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_evaluation` AS select `tbl_evaluation`.`evaluation_id` AS `evaluation_id`,`tbl_evaluation`.`evaluation_desc` AS `evaluation_desc`,concat(`assessor`.`first_name`,' ',`assessor`.`last_name`) AS `assessor`,concat(`assessee`.`first_name`,' ',`assessee`.`last_name`) AS `assessee` from (((`tbl_emp_info` `assessor` join `tbl_evaluation` on((`assessor`.`emp_id` = `tbl_evaluation`.`assessor_id`))) join `tbl_evaluation_rate` on((`tbl_evaluation_rate`.`evaluation_id` = `tbl_evaluation`.`evaluation_id`))) join `tbl_emp_info` `assessee` on((`assessee`.`emp_id` = `tbl_evaluation`.`assessee_id`)));

-- --------------------------------------------------------

--
-- Structure for view `view_job_history`
--
DROP TABLE IF EXISTS `view_job_history`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_job_history` AS select `tbl_emp_history`.`emp_id` AS `emp_id`,`tbl_emp_history`.`status` AS `status`,`tbl_employment_type`.`employment_type` AS `employment_type`,`tbl_job_title`.`job_title_name` AS `job_title_name`,`tbl_departments`.`department_name` AS `department_name`,`tbl_emp_history`.`start_date` AS `start_date`,`tbl_emp_history`.`probationary_date` AS `probationary_date`,`tbl_emp_history`.`permanency_date` AS `permanency_date`,`tbl_emp_history`.`salary` AS `salary`,`tbl_emp_history`.`end_date` AS `end_date`,`tbl_emp_history`.`pay_grade` AS `pay_grade`,`tbl_emp_history`.`date_modified` AS `date_modified`,`tbl_employment_type`.`employment_type_id` AS `employment_type_id`,`tbl_departments`.`department_id` AS `department_id`,`tbl_job_title`.`job_title_id` AS `job_title_id`,`tbl_emp_info`.`first_name` AS `first_name`,`tbl_emp_info`.`middle_name` AS `middle_name`,`tbl_emp_info`.`last_name` AS `last_name` from ((((`tbl_emp_history` join `tbl_departments` on((`tbl_departments`.`department_id` = `tbl_emp_history`.`department_id`))) join `tbl_employment_type` on((`tbl_employment_type`.`employment_type_id` = `tbl_emp_history`.`employment_type_id`))) join `tbl_job_title` on((`tbl_job_title`.`job_title_id` = `tbl_emp_history`.`job_title_id`))) join `tbl_emp_info` on((`tbl_emp_history`.`emp_id` = `tbl_emp_info`.`emp_id`)));

-- --------------------------------------------------------

--
-- Structure for view `view_leave_left`
--
DROP TABLE IF EXISTS `view_leave_left`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_leave_left` AS select concat(`tbl_emp_info`.`first_name`,' ',`tbl_emp_info`.`middle_name`,' ',`tbl_emp_info`.`last_name`) AS `name`,`tbl_leave_left`.`days` AS `days`,`tbl_leave_type`.`leave_type_name` AS `leave_type_name`,`tbl_leave_left`.`employee_id` AS `employee_id`,`tbl_leave_type`.`leave_type_id` AS `leave_type_id` from ((`tbl_leave_type` join `tbl_leave_left` on((`tbl_leave_type`.`leave_type_id` = `tbl_leave_left`.`leave_type_id`))) join `tbl_emp_info` on((`tbl_emp_info`.`emp_id` = `tbl_leave_left`.`employee_id`)));

-- --------------------------------------------------------

--
-- Structure for view `view_leave_request`
--
DROP TABLE IF EXISTS `view_leave_request`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_leave_request` AS select concat(`tbl_emp_info`.`first_name`,' ',`tbl_emp_info`.`middle_name`,' ',`tbl_emp_info`.`last_name`) AS `name`,concat(`tbl_leave_request`.`prefix`,`tbl_leave_request`.`id`) AS `leave_request_id`,`tbl_leave_request`.`leave_reason` AS `leave_reason`,`tbl_leave_request`.`leave_start` AS `leave_start`,`tbl_leave_request`.`leave_status` AS `leave_status`,`tbl_leave_request`.`approved_by` AS `approved_by`,`tbl_leave_request`.`date_approved` AS `date_approved`,`tbl_leave_request`.`date_requested` AS `date_requested`,`tbl_leave_request`.`leave_end` AS `leave_end`,`tbl_leave_request`.`leave_left` AS `leave_left`,`tbl_leave_request`.`leave_type` AS `leave_type`,`tbl_leave_type`.`leave_type_name` AS `leave_type_name`,`tbl_emp_info`.`emp_id` AS `emp_id`,`tbl_leave_type`.`leave_type_id` AS `leave_type_id`,`tbl_leave_request`.`days` AS `days` from ((`tbl_emp_info` join `tbl_leave_request` on((`tbl_emp_info`.`emp_id` = `tbl_leave_request`.`employee_id`))) join `tbl_leave_type` on((`tbl_leave_type`.`leave_type_id` = `tbl_leave_request`.`leave_type`))) order by concat(`tbl_leave_request`.`prefix`,`tbl_leave_request`.`id`);

-- --------------------------------------------------------

--
-- Structure for view `view_materials`
--
DROP TABLE IF EXISTS `view_materials`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_materials` AS select `tbl_stock_info`.`item_name` AS `item_name`,`tbl_materials`.`item_id` AS `item_id`,`tbl_materials`.`quantity` AS `quantity`,`tbl_materials`.`price` AS `price`,`tbl_materials`.`project_id` AS `project_id`,`tbl_materials`.`date_issued` AS `date_issued`,`tbl_project`.`project_name` AS `project_name` from ((`tbl_materials` join `tbl_stock_info` on((`tbl_materials`.`item_id` = `tbl_stock_info`.`item_id`))) join `tbl_project` on((`tbl_project`.`project_id` = `tbl_materials`.`project_id`)));

-- --------------------------------------------------------

--
-- Structure for view `view_payslip`
--
DROP TABLE IF EXISTS `view_payslip`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_payslip` AS select `tbl_emp_info`.`emp_id` AS `emp_id`,`tbl_emp_info`.`first_name` AS `first_name`,`tbl_emp_info`.`middle_name` AS `middle_name`,`tbl_emp_info`.`last_name` AS `last_name`,`tbl_departments`.`department_name` AS `department_name`,`tbl_job_title`.`job_title_name` AS `job_title_name`,max(`tbl_emp_history`.`start_date`) AS `emp_history_start_date`,max(`tbl_emp_history`.`end_date`) AS `emp_history_end_date`,`tbl_payslip`.`payslip_id` AS `payslip_id`,`tbl_payslip`.`payslip_date` AS `payslip_date`,`tbl_payslip`.`start_date` AS `start_date`,`tbl_payslip`.`end_date` AS `end_date`,`tbl_payslip`.`monthly_rate` AS `monthly_rate`,`tbl_payslip`.`basic_salary` AS `basic_salary`,`tbl_payslip`.`total_overtime` AS `total_overtime`,`tbl_payslip`.`total_tardiness` AS `total_tardiness`,`tbl_payslip`.`days_absent` AS `days_absent`,`tbl_payslip`.`total_absent_amount` AS `total_absent_amount`,`tbl_payslip`.`total_allowances` AS `total_allowances`,`tbl_payslip`.`total_taxes` AS `total_taxes`,`tbl_payslip`.`gross_pay` AS `gross_pay`,`tbl_payslip`.`net_pay` AS `net_pay` from ((((`tbl_emp_info` left join `tbl_emp_history` on((`tbl_emp_history`.`emp_id` = `tbl_emp_info`.`emp_id`))) left join `tbl_departments` on((`tbl_departments`.`department_id` = `tbl_emp_history`.`department_id`))) left join `tbl_job_title` on((`tbl_job_title`.`job_title_id` = `tbl_emp_history`.`job_title_id`))) join `tbl_payslip` on((`tbl_payslip`.`emp_id` = `tbl_emp_info`.`emp_id`))) group by `tbl_emp_info`.`emp_id`,`tbl_emp_info`.`first_name`,`tbl_emp_info`.`middle_name`,`tbl_emp_info`.`last_name`,`tbl_departments`.`department_name`,`tbl_job_title`.`job_title_name`,`tbl_payslip`.`payslip_id`,`tbl_payslip`.`payslip_date`,`tbl_payslip`.`start_date`,`tbl_payslip`.`end_date`,`tbl_payslip`.`monthly_rate`,`tbl_payslip`.`basic_salary`,`tbl_payslip`.`total_overtime`,`tbl_payslip`.`total_tardiness`,`tbl_payslip`.`days_absent`,`tbl_payslip`.`total_absent_amount`,`tbl_payslip`.`total_allowances`,`tbl_payslip`.`total_taxes`,`tbl_payslip`.`gross_pay`,`tbl_payslip`.`net_pay`;

-- --------------------------------------------------------

--
-- Structure for view `view_payslip_allowances`
--
DROP TABLE IF EXISTS `view_payslip_allowances`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_payslip_allowances` AS select `tbl_payslip_allowances`.`payslip_allowance_id` AS `payslip_allowance_id`,`tbl_allowances`.`allowance_id` AS `allowance_id`,`tbl_allowances`.`allowance_name` AS `allowance_name`,`tbl_payslip`.`payslip_id` AS `payslip_id`,`tbl_payslip_allowances`.`percentage` AS `percentage`,`tbl_payslip_allowances`.`percentage_amount` AS `percentage_amount`,`tbl_payslip_allowances`.`fixed_amount` AS `fixed_amount`,`tbl_payslip_allowances`.`total` AS `total` from ((`tbl_payslip_allowances` join `tbl_allowances` on((`tbl_allowances`.`allowance_id` = `tbl_payslip_allowances`.`allowance_id`))) join `tbl_payslip` on((`tbl_payslip`.`payslip_id` = `tbl_payslip_allowances`.`payslip_id`)));

-- --------------------------------------------------------

--
-- Structure for view `view_payslip_taxes`
--
DROP TABLE IF EXISTS `view_payslip_taxes`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_payslip_taxes` AS select `tbl_payslip_taxes`.`payslip_tax_id` AS `payslip_tax_id`,`tbl_taxes`.`tax_id` AS `tax_id`,`tbl_taxes`.`tax_name` AS `tax_name`,`tbl_payslip`.`payslip_id` AS `payslip_id`,`tbl_payslip_taxes`.`percentage` AS `percentage`,`tbl_payslip_taxes`.`percentage_amount` AS `percentage_amount`,`tbl_payslip_taxes`.`fixed_amount` AS `fixed_amount`,`tbl_payslip_taxes`.`total` AS `total` from ((`tbl_payslip_taxes` join `tbl_taxes` on((`tbl_taxes`.`tax_id` = `tbl_payslip_taxes`.`tax_id`))) join `tbl_payslip` on((`tbl_payslip`.`payslip_id` = `tbl_payslip_taxes`.`payslip_id`)));

-- --------------------------------------------------------

--
-- Structure for view `view_project_cost`
--
DROP TABLE IF EXISTS `view_project_cost`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_project_cost` AS select `tbl_project`.`starting_date` AS `starting_date`,`tbl_project`.`ending_date` AS `ending_date`,`tbl_project`.`project_id` AS `project_id`,`tbl_project`.`project_name` AS `project_name`,`tbl_client`.`client_name` AS `client_name`,`tbl_project`.`date_added` AS `date_added`,sum((`tbl_materials`.`quantity` * `tbl_materials`.`price`)) AS `total_expense` from ((`tbl_project` join `tbl_client` on((`tbl_client`.`client_id` = `tbl_project`.`client`))) join `tbl_materials` on((`tbl_project`.`project_id` = `tbl_materials`.`project_id`))) group by `tbl_project`.`project_id`,`tbl_project`.`project_name`,`tbl_client`.`client_name`,`tbl_project`.`date_added`;

-- --------------------------------------------------------

--
-- Structure for view `view_project_workers`
--
DROP TABLE IF EXISTS `view_project_workers`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_project_workers` AS select `tbl_project`.`project_id` AS `project_id`,`tbl_project`.`project_name` AS `project_name`,concat(`tbl_emp_info`.`first_name`,' ',`tbl_emp_info`.`middle_name`,' ',`tbl_emp_info`.`last_name`) AS `name`,`tbl_project_workers`.`assigned_date` AS `assigned_date`,`tbl_emp_info`.`emp_id` AS `emp_id` from ((`tbl_project` join `tbl_project_workers` on((`tbl_project`.`project_id` = `tbl_project_workers`.`project_id`))) join `tbl_emp_info` on((`tbl_project_workers`.`employee_id` = `tbl_emp_info`.`emp_id`)));

-- --------------------------------------------------------

--
-- Structure for view `view_requestentry`
--
DROP TABLE IF EXISTS `view_requestentry`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_requestentry` AS select `tbl_requestentry`.`req_id` AS `req_id`,`tbl_requestentry`.`emp_id` AS `emp_id`,concat(`requestee`.`first_name`,' ',`requestee`.`last_name`) AS `requestee`,`tbl_requestentry`.`date_value` AS `date_value`,`tbl_requestentry`.`time_in` AS `time_in`,`tbl_requestentry`.`time_out` AS `time_out`,`tbl_requestentry`.`remarks` AS `remarks`,`tbl_requestentry`.`date_requested` AS `date_requested`,`tbl_requestentry`.`approved` AS `approved`,`tbl_requestentry`.`date_approved` AS `date_approved`,`tbl_requestentry`.`approved_by` AS `approved_by`,concat(`approver`.`first_name`,' ',`approver`.`last_name`) AS `approver` from ((`tbl_requestentry` join `tbl_emp_info` `requestee` on((`requestee`.`emp_id` = `tbl_requestentry`.`emp_id`))) left join `tbl_emp_info` `approver` on((`approver`.`emp_id` = `tbl_requestentry`.`approved_by`)));

-- --------------------------------------------------------

--
-- Structure for view `view_stocks`
--
DROP TABLE IF EXISTS `view_stocks`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_stocks` AS select `tbl_stock_info`.`item_name` AS `item_name`,`tbl_stocks_category`.`category_name` AS `category_name`,`tbl_stocks`.`quantity` AS `quantity`,`tbl_stocks`.`date_last_restocked` AS `date_last_restocked`,`tbl_stock_info`.`price` AS `price`,`tbl_stocks`.`item_id` AS `item_id` from ((`tbl_stock_info` join `tbl_stocks_category` on((`tbl_stock_info`.`category_id` = `tbl_stocks_category`.`category_id`))) join `tbl_stocks` on((`tbl_stocks`.`item_id` = `tbl_stock_info`.`item_id`)));

-- --------------------------------------------------------

--
-- Structure for view `view_supervisions`
--
DROP TABLE IF EXISTS `view_supervisions`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_supervisions` AS select `tbl_supervisions`.`supervisor_id` AS `supervisor_id`,`tbl_supervisions`.`employee_id` AS `employee_id`,concat(`tbl_emp_info`.`first_name`,' ',`tbl_emp_info`.`middle_name`,' ',`tbl_emp_info`.`last_name`) AS `employee_name`,concat(`view_supervisors`.`first_name`,' ',`view_supervisors`.`middle_name`,' ',`view_supervisors`.`last_name`) AS `supervisor_name`,`tbl_supervisions`.`assigned_date` AS `assigned_date` from ((`tbl_emp_info` join `tbl_supervisions` on((`tbl_supervisions`.`employee_id` = `tbl_emp_info`.`emp_id`))) join `view_supervisors` on((`tbl_supervisions`.`supervisor_id` = `view_supervisors`.`supervisor_id`)));

-- --------------------------------------------------------

--
-- Structure for view `view_supervisors`
--
DROP TABLE IF EXISTS `view_supervisors`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_supervisors` AS select `tbl_supervisors`.`supervisor_id` AS `supervisor_id`,`tbl_emp_info`.`first_name` AS `first_name`,`tbl_emp_info`.`middle_name` AS `middle_name`,`tbl_emp_info`.`last_name` AS `last_name`,`tbl_supervisors`.`employee_id` AS `employee_id` from (`tbl_emp_info` join `tbl_supervisors` on((`tbl_emp_info`.`emp_id` = `tbl_supervisors`.`employee_id`)));

-- --------------------------------------------------------

--
-- Structure for view `view_users`
--
DROP TABLE IF EXISTS `view_users`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_users` AS select `tbl_user`.`user_id` AS `user_id`,`tbl_user`.`username` AS `username`,`tbl_user`.`password` AS `password`,`tbl_user`.`date_registered` AS `date_registered`,`tbl_emp_info`.`first_name` AS `first_name`,`tbl_emp_info`.`middle_name` AS `middle_name`,`tbl_emp_info`.`last_name` AS `last_name`,`tbl_user`.`profile_image` AS `profile_image`,`tbl_user`.`employee_id` AS `employee_id`,`tbl_user_level`.`user_level` AS `user_level`,`tbl_user_level`.`user_level_id` AS `user_level_id`,`tbl_user`.`email` AS `email`,`tbl_user`.`logged` AS `logged` from ((`tbl_user` join `tbl_emp_info` on((`tbl_emp_info`.`emp_id` = `tbl_user`.`employee_id`))) join `tbl_user_level` on((`tbl_user_level`.`user_level_id` = `tbl_user`.`user_level`)));

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_201_file`
--
ALTER TABLE `tbl_201_file`
  ADD PRIMARY KEY (`file_id`);

--
-- Indexes for table `tbl_allowances`
--
ALTER TABLE `tbl_allowances`
  ADD PRIMARY KEY (`allowance_id`);

--
-- Indexes for table `tbl_announcement`
--
ALTER TABLE `tbl_announcement`
  ADD PRIMARY KEY (`announcement_id`);

--
-- Indexes for table `tbl_asset_info`
--
ALTER TABLE `tbl_asset_info`
  ADD PRIMARY KEY (`asset_id`);

--
-- Indexes for table `tbl_asset_request`
--
ALTER TABLE `tbl_asset_request`
  ADD PRIMARY KEY (`asset_request_id`);

--
-- Indexes for table `tbl_audit_trail`
--
ALTER TABLE `tbl_audit_trail`
  ADD PRIMARY KEY (`audit_trail_id`);

--
-- Indexes for table `tbl_calendar`
--
ALTER TABLE `tbl_calendar`
  ADD PRIMARY KEY (`calendar_id`);

--
-- Indexes for table `tbl_countries`
--
ALTER TABLE `tbl_countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_criteria`
--
ALTER TABLE `tbl_criteria`
  ADD PRIMARY KEY (`criteria_id`);

--
-- Indexes for table `tbl_day_type`
--
ALTER TABLE `tbl_day_type`
  ADD PRIMARY KEY (`day_type_id`);

--
-- Indexes for table `tbl_emp_info`
--
ALTER TABLE `tbl_emp_info`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `tbl_evaluation`
--
ALTER TABLE `tbl_evaluation`
  ADD PRIMARY KEY (`evaluation_id`);

--
-- Indexes for table `tbl_governmentid`
--
ALTER TABLE `tbl_governmentid`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `tbl_leave_request`
--
ALTER TABLE `tbl_leave_request`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `tbl_tax_range`
--
ALTER TABLE `tbl_tax_range`
  ADD PRIMARY KEY (`tax_range_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tbl_user_level`
--
ALTER TABLE `tbl_user_level`
  ADD PRIMARY KEY (`user_level_id`);

--
-- Indexes for table `tbl_vendor`
--
ALTER TABLE `tbl_vendor`
  ADD PRIMARY KEY (`vendor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_allowances`
--
ALTER TABLE `tbl_allowances`
  MODIFY `allowance_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_announcement`
--
ALTER TABLE `tbl_announcement`
  MODIFY `announcement_id` int(5) unsigned zerofill NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tbl_asset_request`
--
ALTER TABLE `tbl_asset_request`
  MODIFY `asset_request_id` smallint(5) unsigned zerofill NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tbl_audit_trail`
--
ALTER TABLE `tbl_audit_trail`
  MODIFY `audit_trail_id` smallint(5) unsigned zerofill NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=113;
--
-- AUTO_INCREMENT for table `tbl_calendar`
--
ALTER TABLE `tbl_calendar`
  MODIFY `calendar_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_countries`
--
ALTER TABLE `tbl_countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=243;
--
-- AUTO_INCREMENT for table `tbl_day_type`
--
ALTER TABLE `tbl_day_type`
  MODIFY `day_type_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_evaluation`
--
ALTER TABLE `tbl_evaluation`
  MODIFY `evaluation_id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_leave_request`
--
ALTER TABLE `tbl_leave_request`
  MODIFY `id` smallint(5) unsigned zerofill NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tbl_payslip`
--
ALTER TABLE `tbl_payslip`
  MODIFY `payslip_id` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `tbl_payslip_allowances`
--
ALTER TABLE `tbl_payslip_allowances`
  MODIFY `payslip_allowance_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=66;
--
-- AUTO_INCREMENT for table `tbl_payslip_taxes`
--
ALTER TABLE `tbl_payslip_taxes`
  MODIFY `payslip_tax_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=99;
--
-- AUTO_INCREMENT for table `tbl_requestentry`
--
ALTER TABLE `tbl_requestentry`
  MODIFY `req_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tbl_taxes`
--
ALTER TABLE `tbl_taxes`
  MODIFY `tax_id` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tbl_tax_range`
--
ALTER TABLE `tbl_tax_range`
  MODIFY `tax_range_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=40;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
