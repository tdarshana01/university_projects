-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 30, 2023 at 03:47 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `abc`
--

-- --------------------------------------------------------

--
-- Table structure for table `complaint`
--

DROP TABLE IF EXISTS `complaint`;
CREATE TABLE IF NOT EXISTS `complaint` (
  `Customer_id` int(11) NOT NULL,
  `Product_id` int(11) NOT NULL,
  `Order_id` int(11) NOT NULL,
  `Complaint_status` varchar(15) NOT NULL,
  `Complaint` varchar(200) NOT NULL,
  `Admin_msg` varchar(200) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `complaint`
--

INSERT INTO `complaint` (`Customer_id`, `Product_id`, `Order_id`, `Complaint_status`, `Complaint`, `Admin_msg`) VALUES
(42545, 23, 66, 'In progress', 'yuiokjh', 'we are reviewing your status'),
(42541, 12, 25, 'Open', 'fgh', NULL),
(42544, 12, 52, 'Resolved', 'sdfs', 'we are done with you'),
(42549, 23, 21, 'Open', 'product broken', ' ');

-- --------------------------------------------------------

--
-- Table structure for table `contact_admin`
--

DROP TABLE IF EXISTS `contact_admin`;
CREATE TABLE IF NOT EXISTS `contact_admin` (
  `Message_no` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(20) NOT NULL,
  `Phone_number` int(11) DEFAULT NULL,
  `Email` varchar(30) DEFAULT NULL,
  `Subject` varchar(200) NOT NULL,
  PRIMARY KEY (`Message_no`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact_admin`
--

INSERT INTO `contact_admin` (`Message_no`, `Username`, `Phone_number`, `Email`, `Subject`) VALUES
(1, 'uoc', 785645123, 'uoc@gmail.com', 'jtrsrzxghugyf'),
(11, '15', 758475682, 'abc@gmail.com', 'sssssss'),
(10, 'uoc', 74547465, 'kamal@gmail.com', 'I can not register'),
(9, 'kusum', 74547465, 'tharindupanditawatta@gmail.com', '');

-- --------------------------------------------------------

--
-- Table structure for table `customer_relation`
--

DROP TABLE IF EXISTS `customer_relation`;
CREATE TABLE IF NOT EXISTS `customer_relation` (
  `Customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `First_name` varchar(20) NOT NULL,
  `Last_name` varchar(20) NOT NULL,
  `Username` varchar(30) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `Address` varchar(30) DEFAULT NULL,
  `Gender` varchar(10) DEFAULT NULL,
  `Phone_no` int(10) DEFAULT NULL,
  `NIC` bigint(12) DEFAULT NULL,
  `Email` varchar(30) DEFAULT NULL,
  `Date_of_birth` varchar(20) DEFAULT NULL,
  `Hobby` varchar(50) DEFAULT NULL,
  `Preferred_language` varchar(10) DEFAULT NULL,
  `Job_title` varchar(10) DEFAULT NULL,
  `Preferred_payment_method` varchar(15) DEFAULT NULL,
  `Customer_type` varchar(10) DEFAULT NULL,
  `Admin` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`Customer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=42555 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_relation`
--

INSERT INTO `customer_relation` (`Customer_id`, `First_name`, `Last_name`, `Username`, `Password`, `Address`, `Gender`, `Phone_no`, `NIC`, `Email`, `Date_of_birth`, `Hobby`, `Preferred_language`, `Job_title`, `Preferred_payment_method`, `Customer_type`, `Admin`) VALUES
(42549, 'Colombo', 'University', 'uoc', 'uoc', 'colombo 7', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(42551, 'admin', 'admin', 'admin', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'yes'),
(42553, '', '', 'tharindu', 'sdsdfsfs', 'Kelaniya', 'male', 74547465, 2000000015, 'tharindupanditawatta@gmail.com', '2023-10-04', ',,', 'Sinhala', '', 'Cash', 'Individual', ''),
(42543, '', '', 'dasuni', '145654', 'asdsfdg', 'female', 745621458, 20045487456, 'dasuni@gmail.com', '2023-10-18', 'Reading,Watching movies', 'English', 'manager', 'Credit card', 'Business', ''),
(42554, '', '', 'sameera', 'sameera', 'fbdvdge', 'male', 724587456, 1999554411, 'sameera@gmail.com', '2023-10-18', 'reading,,', 'Sinhala', 'hhh', 'Cash', 'Individual', ''),
(10, '', '', 'Gunawardana', '12123', 'erter', 'male', 745415876, 200014587463, 'gunawardana@gamil.com', '1966-02-10', NULL, NULL, NULL, NULL, NULL, 'yes'),
(11, '', '', 'Siriwardana', '23231', 'erter', 'male', 745415876, 196245784512, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'yes'),
(42545, 'Tharindu', 'Darshana', 'tdarshana', 'dar99', 'kelaniya', 'male', 74547465, 200126547785, 'tharindupanditawatta@gmail.com', '2007-11-14', 'Watching movies,,', 'Sinhala', 'manager', 'Debit card', 'Individual', ''),
(42546, 'Dasun', 'Shanaka', 'dassa', '145541', '54/2,colombo 7', 'male', 758475682, 19954785236, 'dasunl@gmail.com', '2023-10-11', 'others,,', 'English', 'Cricketer', 'Credit card', 'Individual', ''),
(42547, 'Pathum', 'Nissanka', 'pathuma', '001002', '54/2,colombo 7', 'male', 758475682, 199814521455, 'amal@gmail.com', '2023-11-08', 'others,,', 'Sinhala', 'Cricketer', 'Credit card', 'Individual', '');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
CREATE TABLE IF NOT EXISTS `employee` (
  `id` int(11) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `department` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `first_name`, `last_name`, `department`, `email`) VALUES
(1, 'Peter', 'Doe', 'Operations', 'peter@gmail.com'),
(2, 'Megan', 'Morel', 'Finance', ''),
(3, 'Rose', 'Bailey', 'Operations', 'rose@gmail.com'),
(4, 'Linda', 'Bailey', 'Finance', ''),
(5, 'Mary', 'Doe', 'Sales', '');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
CREATE TABLE IF NOT EXISTS `feedback` (
  `Book_id` int(11) NOT NULL AUTO_INCREMENT,
  `Customer_id` int(11) NOT NULL,
  `Product_name` varchar(20) DEFAULT NULL,
  `Purchase_date` varchar(20) DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `Total_amount` int(11) DEFAULT NULL,
  `Payment_method` varchar(10) DEFAULT NULL,
  `Purchase_status` varchar(10) DEFAULT NULL,
  `Purchase_rating` int(11) DEFAULT NULL,
  `Feedback` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`Book_id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`Book_id`, `Customer_id`, `Product_name`, `Purchase_date`, `Quantity`, `Total_amount`, `Payment_method`, `Purchase_status`, `Purchase_rating`, `Feedback`) VALUES
(1, 0, 'chocolate', '2023-10-04', 5, 1500, 'Cash', 'Completed', 4, 'good product'),
(2, 42541, 'biscuit', '2023-10-04', 3, 450, 'Cash', 'Completed', 3, 'did not get yet'),
(3, 42544, 'ice-cream', '2023-10-04', 2, 1500, 'Cash', 'Completed', 4, 'good'),
(4, 56, 'Toys', '2023-10-03', 5, 1250, 'Debit card', 'Completed', 4, 'ggwge4e'),
(5, 42512, 'Home and Furniture', '2023-10-04', 3, 2500, 'Cash', 'Pending', 3, 'jhgfdcvb'),
(6, 42512, 'Home and Furniture', '2023-10-04', 3, 2500, 'Cash', 'Pending', 3, 'jhgfdcvb'),
(7, 42512, 'biscuit', '2023-10-10', 2, 2500, 'Cash', 'Completed', 3, 'efrgg'),
(8, 42512, 'biscuit', '2023-10-10', 2, 5000, 'Cash', 'Completed', 3, 'wefg'),
(9, 42512, 'Home and Furniture', '2023-10-04', 3, 2500, 'Cash', 'Pending', 3, 'jhgfdcvb'),
(10, 42543, 'Home and Furniture', '2023-10-11', 3, 2500, 'Cash', 'Completed', 3, 'jhgf'),
(11, 42543, 'Home and Furniture', '2023-10-11', 3, 2500, 'Cash', 'Completed', 3, 'jhgf'),
(12, 42543, 'Home and Furniture', '2023-10-11', 3, 2500, 'Cash', 'Completed', 3, 'jhgf'),
(13, 42549, 'Sports and Outdoors', '2023-10-03', 2, 2500, 'Cash', 'Completed', 3, 'kjuytrdsz'),
(14, 42549, 'Home and Furniture', '2023-10-03', 2, 2500, 'Cash', 'Completed', 3, 'jgf'),
(15, 45321, 'Home and Furniture', '2023-10-03', 4, 2, 'Cash', 'Completed', 1, 'yes'),
(16, 42545, 'Automative', '2023-10-02', 3, 5600, 'Debit card', 'Pending', 3, 'good');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `Customer_id` int(11) NOT NULL,
  `Product_id` int(11) NOT NULL,
  `Order_id` int(11) NOT NULL,
  `Order_status` varchar(20) NOT NULL,
  `Product_name` varchar(30) NOT NULL,
  PRIMARY KEY (`Order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`Customer_id`, `Product_id`, `Order_id`, `Order_status`, `Product_name`) VALUES
(42514, 12, 36, 'Shipped', ''),
(42549, 21, 35, 'ordered', 'Toys');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
