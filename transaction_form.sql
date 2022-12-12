-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 24, 2022 at 10:13 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_order`
--

-- --------------------------------------------------------

--
-- Table structure for table `transaction_form`
--

CREATE TABLE `transaction_form` (
  `ID` int(30) NOT NULL,
  `ITEM_TYPE` varchar(30) NOT NULL,
  `ITEM_NAME` varchar(30) NOT NULL,
  `ORDER_QUANTITY` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction_form`
--

INSERT INTO `transaction_form` (`ID`, `ITEM_TYPE`, `ITEM_NAME`, `ORDER_QUANTITY`) VALUES
(1, 'parts', 'shimano', 2),
(2, 'bike', 'shimano', 5),
(3, 'parts', 'shimano', 4),
(4, 'bike', 'shimano', 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `transaction_form`
--
ALTER TABLE `transaction_form`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `transaction_form`
--
ALTER TABLE `transaction_form`
  MODIFY `ID` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
