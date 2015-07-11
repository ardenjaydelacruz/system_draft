-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 11, 2015 at 05:29 PM
-- Server version: 5.6.24
-- PHP Version: 5.5.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `msi_system`
--

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
(1, 'Ardenx', 'Alcairo', 'Dela Cruz', 'CEOs', 'Regular', 'Executive', 23, '1993-12-16', 'male', 'Single', '12', 'qwqw', 'manda', 'manila', 999, 'Philippines', 123, 123, 'ardents02@gmail.com', 'ardents', 'asdasd', 123123, 'steam_logo-wallpaper-1366x7681.jpg', '2015-06-30 07:00:00'),
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
-- Table structure for table `purchase_stocks`
--

CREATE TABLE IF NOT EXISTS `purchase_stocks` (
  `order_number` int(5) NOT NULL,
  `item_number` int(5) NOT NULL,
  `item_name` varchar(10) NOT NULL,
  `quantity` int(5) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `vendor` varchar(20) NOT NULL,
  `date_ordered` date NOT NULL,
  `status` varchar(10) NOT NULL,
  `number_of_items_delivered` int(5) NOT NULL,
  `notes` varchar(50) NOT NULL,
  `date_delivered` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_stocks`
--

INSERT INTO `purchase_stocks` (`order_number`, `item_number`, `item_name`, `quantity`, `price`, `vendor`, `date_ordered`, `status`, `number_of_items_delivered`, `notes`, `date_delivered`) VALUES
(123, 321, 'chua', 3, '1233.00', 'neil inc.', '0000-00-00', 'das', 2, 'asdasdadf fuck you ka chua', '0000-00-00'),
(231, 2, 'sad', 34, '1233.00', 'yow', '0000-00-00', 'assdasd', 23, 'chuariwariwap', '0000-00-00'),
(98, 98, 'dog', 10, '1000.00', 'resnera', '2015-06-17', 'asdds', 12, 'picachua', '2015-07-29'),
(789, 12, 'name', 12, '1234.00', 'chuariwariwap', '2015-07-01', 'asdsdd', 12, 'hey', '2015-07-05'),
(12344, 98, 'hp', 2, '189.00', 'dealen', '2015-07-01', 'yeah', 35, 'fuck you', '2015-07-02'),
(4521, 321, 'acer', 19, '1000.00', 'jaycent', '2015-06-01', 'lyonfng vn', 14, 'asdfghjk', '2015-07-02'),
(654, 456, 'chair', 5, '500.00', 'gilbert', '2015-07-01', '', 0, '', '0000-00-00'),
(1232, 122, 'bed', 2, '123333.00', 'paul', '2015-07-01', 'new', 3, 'asddff', '2015-07-01'),
(32, 12, 'laptop', 23, '99999999.99', 'neil', '0000-00-00', 'asdsd', 5, 'sdadasd', '0000-00-00'),
(321, 234, 'drugs', 40, '50000.00', 'cj', '2015-07-01', 'high', 40, 'yeeeaaahhh \\m/', '2015-07-02');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_inventory`
--

CREATE TABLE IF NOT EXISTS `tbl_inventory` (
  `item_number` int(5) NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `category` varchar(50) NOT NULL,
  `vendor` varchar(50) NOT NULL,
  `location` varchar(50) NOT NULL,
  `quantity` int(5) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_inventory`
--

INSERT INTO `tbl_inventory` (`item_number`, `item_name`, `category`, `vendor`, `location`, `quantity`, `price`, `date_added`) VALUES
(10001, 'Vanguard', 'Shield', 'Pasig Palengke', 'Pasig', 1000, '500.00', '2015-07-08 20:54:39'),
(10002, 'DC Hook', 'COstume', 'Secret Shop', 'Paris', 1000, '7000.00', '2015-07-08 00:22:48'),
(10003, 'Pana ni Mirana', 'Deadly Weapon', 'Aling Nena', 'Buting', 1000, '200.00', '2015-07-08 00:25:41'),
(10004, 'Es Totem', 'Weapon', 'Steam', 'Philippines', 1000, '100.00', '2015-07-08 20:57:18');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_materials`
--

CREATE TABLE IF NOT EXISTS `tbl_materials` (
  `materials_id` varchar(5) NOT NULL,
  `item_number` int(5) NOT NULL,
  `quantity` int(5) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `project_id` varchar(5) NOT NULL,
  `date_issued` date NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_materials`
--

INSERT INTO `tbl_materials` (`materials_id`, `item_number`, `quantity`, `price`, `project_id`, `date_issued`, `date_added`) VALUES
('M1003', 10002, 12, '7000.00', 'P1001', '2015-07-08', '2015-07-08 22:39:42'),
('M1003', 10004, 2, '100.00', 'P1003', '2015-07-09', '2015-07-09 13:07:56'),
('M1006', 10001, 20, '500.00', 'P1001', '2015-07-30', '2015-07-09 13:33:41'),
('M1002', 10001, 100, '500.00', 'P1001', '2015-07-21', '2015-07-09 13:35:06'),
('M1003', 10002, 100, '7000.00', 'P1003', '2015-07-21', '2015-07-09 13:41:57'),
('M1002', 10003, 100, '200.00', 'P1005', '2015-07-28', '2015-07-11 20:25:03');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_project`
--

CREATE TABLE IF NOT EXISTS `tbl_project` (
  `project_id` varchar(5) NOT NULL,
  `project_name` varchar(50) NOT NULL,
  `client` varchar(50) NOT NULL,
  `starting_date` date NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_project`
--

INSERT INTO `tbl_project` (`project_id`, `project_name`, `client`, `starting_date`, `date_added`) VALUES
('P1001', 'Project Almanac', 'Scientists Inc.', '2015-07-08', '2015-07-08 13:36:31'),
('P1002', 'Project Alpha', 'NASA', '2015-07-03', '2015-07-08 14:21:12'),
('P1003', 'Project X', 'Classified', '2015-07-09', '2015-07-08 18:59:33'),
('P1004', 'Project Alpha', 'NASA', '2015-07-10', '2015-07-08 19:05:40'),
('P1005', 'Project Pie', 'Arden', '2015-07-11', '2015-07-11 20:20:08');

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_account`
--

INSERT INTO `user_account` (`user_id`, `username`, `password`, `email`, `user_level`, `secret_question`, `secret_answer`, `employee_id`, `date_registered`) VALUES
(1, 'ardents', 'daca2125e1f1f3c5ff6e8663ab1edef3', 'ardents02@gmail.com', 'Administrator', 'What is your pet name?', 'ardents', 1, '2015-06-05 05:28:36'),
(7, 'ardendeveloper', 'daca2125e1f1f3c5ff6e8663ab1edef3', 'ardendeveloper@gmail.com', 'Employee', '2', 'acs', 0, '2015-06-05 05:30:12'),
(9, 'ardenity', 'daca2125e1f1f3c5ff6e8663ab1edef3', 'ardents02@gmail.com', 'Manager', '1', 'pito', 0, '2015-06-05 21:34:52'),
(10, 'resnerac03', '25d55ad283aa400af464c76d713c07ad', 'resnerac03@gmail.com', 'Administrator', '2', 'asdasdasdas', 0, '2015-07-03 14:27:13');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE IF NOT EXISTS `vendors` (
  `vendor_id` int(5) NOT NULL,
  `vendor_name` varchar(15) NOT NULL,
  `address` varchar(50) NOT NULL,
  `contact_number` int(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `date_added` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`vendor_id`, `vendor_name`, `address`, `contact_number`, `email`, `date_added`) VALUES
(1231, 'neil', '123 taga taytay rizal', 2349, 'neil_resnera@yahoo.com', '2015-07-03'),
(123124, 'gilbert', '123 taga altura manila', 23125, 'gilbert_start@yahoo.com', '2015-07-02'),
(1231, 'arden', '123 taga jennys ave pasig', 123521, 'arden_delacruz@yahoo.com', '2015-07-03'),
(12412, 'paul', '123 taga kanila daw', 1231247, 'johnpaul_evangelista@yahoo.com', '2015-07-02'),
(609, 'Biboy', '123 kapit bahay ni arden', 905800609, 'chua_biboy@yahoo.com', '2015-07-03'),
(12214, 'resnera', '123 housemate ni neil', 21312038, 'neilneil@yahoo.com', '2015-07-02'),
(123421, 'start', '123 housemate ni gilbert', 1231283, 'startstart@yahoo.com', '2015-07-03'),
(12312, 'delacruz', '123 housemate ni arden', 1241231, 'delacruz@yahoo.com', '2015-07-03'),
(2131, 'evangelista', '123 housemate ni paul', 12314324, 'johnpaul_patun-og@yahoo.com', '2015-07-03'),
(324234, 'CHUA', '123 housemate ni Biboy', 123123, 'chuachua@yahoo.com', '2015-07-03');

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
-- Indexes for table `tbl_project`
--
ALTER TABLE `tbl_project`
  ADD PRIMARY KEY (`project_id`);

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
-- AUTO_INCREMENT for table `user_account`
--
ALTER TABLE `user_account`
  MODIFY `user_id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
