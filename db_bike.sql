-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2022 at 03:56 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_bike`
--

-- --------------------------------------------------------

--
-- Table structure for table `order_form`
--

CREATE TABLE `order_form` (
  `ID` int(10) NOT NULL,
  `ORDER_DATE` text NOT NULL,
  `ITEM_TYPE` text NOT NULL,
  `ITEM_NAME` varchar(30) NOT NULL,
  `description` text NOT NULL,
  `ORDER_QUANTITY` int(30) NOT NULL,
  `amount` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_form`
--

INSERT INTO `order_form` (`ID`, `ORDER_DATE`, `ITEM_TYPE`, `ITEM_NAME`, `description`, `ORDER_QUANTITY`, `amount`) VALUES
(29, '2022-10-24', 'bike', 'shimano', '', 5, 0),
(30, '2022-10-24', 'parts', 'bmx', '', 6, 0),
(31, '2022-10-26', 'bike', 'bmx', '', 3, 0),
(32, '2022-11-04', 'parts', 'shimano', '', 2, 0),
(33, '2022-11-04', 'bike', 'shimano', '', 10, 0),
(34, '2022-11-05', 'bike', 'bmx', '', 10, 0),
(35, '2022-11-05', 'parts', 'shimano', '', 3, 0),
(36, '2022-11-05', 'parts', 'shimano', '', 9, 0),
(37, '', 'itemtypes', 'itemnames', '', 1, 0),
(38, '', 'itemtypes', 'itemnames', '', 1, 0),
(39, '', 'bike', 'bmx', '', 3, 0),
(40, '2022-11-06', 'bike', 'bmx', '', 3, 0),
(41, '2022-11-06', 'parts', 'shimano', 'afafqf', 2, 0),
(42, '2022-11-06', 'parts', 'bmx', 'Bikekingshop', 3, 0),
(43, '2022-11-06', 'bike', 'shimano', 'biket o', 2, 0),
(44, '2022-11-06', 'bike', 'shimano', 'safs gsegsgesg', 2, 0),
(45, '', 'itemtypes', 'itemnames', 'description', 2, 0),
(46, '2022-11-07', 'parts', 'bmx', 'dgfbdfhdrthdtfh', 3, 0),
(47, '2022-11-07', 'parts', 'bmx', 'description', 2, 0),
(48, '', 'itemtypes', 'itemnames', 'description', 1, 0),
(49, '2022-12-02', 'parts', 'shimano', 'hgjfhjfghjgfgfhj', 2, 0),
(50, '2022-12-11', 'Parts', 'Breaks', '', 2, 4000),
(51, '2022-12-11', 'Parts', 'Tsunami Frame', '', 1, 6000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_inventory`
--

CREATE TABLE `tbl_inventory` (
  `item_id` int(10) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_inventory`
--

INSERT INTO `tbl_inventory` (`item_id`, `item_name`, `type`, `quantity`, `price`) VALUES
(1, 'Breaks', 'Parts', 16, 2000),
(2, 'Tsunami Frame', 'Parts', 2, 6000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_itemtype`
--

CREATE TABLE `tbl_itemtype` (
  `itemtype_id` int(11) NOT NULL,
  `item_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_itemtype`
--

INSERT INTO `tbl_itemtype` (`itemtype_id`, `item_type`) VALUES
(1, 'Bike'),
(4, 'Parts');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_login`
--

CREATE TABLE `tbl_login` (
  `USERNAME` text NOT NULL,
  `PASSWORD` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_login`
--

INSERT INTO `tbl_login` (`USERNAME`, `PASSWORD`) VALUES
('admin', 'admin123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `order_form`
--
ALTER TABLE `order_form`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_inventory`
--
ALTER TABLE `tbl_inventory`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `tbl_itemtype`
--
ALTER TABLE `tbl_itemtype`
  ADD PRIMARY KEY (`itemtype_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `order_form`
--
ALTER TABLE `order_form`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `tbl_inventory`
--
ALTER TABLE `tbl_inventory`
  MODIFY `item_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_itemtype`
--
ALTER TABLE `tbl_itemtype`
  MODIFY `itemtype_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
