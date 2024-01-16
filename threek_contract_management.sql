-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2020 at 12:05 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `threek_contract_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `contracts`
--

CREATE TABLE `contracts` (
  `contractID` int(11) NOT NULL,
  `customerID` int(11) NOT NULL,
  `serviceID` int(11) NOT NULL,
  `contractName` varchar(200) NOT NULL,
  `contractDesc` mediumtext DEFAULT NULL,
  `contractSite` mediumtext NOT NULL,
  `initiationDate` date NOT NULL,
  `deadline` date NOT NULL,
  `endDate` date DEFAULT NULL,
  `contractStatus` enum('Initiation Pending','Ongoing','Completed','') NOT NULL,
  `grandTotal` varchar(100) NOT NULL,
  `registryDate` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contracts`
--

INSERT INTO `contracts` (`contractID`, `customerID`, `serviceID`, `contractName`, `contractDesc`, `contractSite`, `initiationDate`, `deadline`, `endDate`, `contractStatus`, `grandTotal`, `registryDate`) VALUES
(25, 11, 2, 'Commercial Cleaning for AreMe', 'Cleaning of 12 total rooms on a floor of an office building. ', 'Example Address for Site', '2020-11-04', '2020-11-06', '0000-00-00', 'Ongoing', '200.000 XOF', '2020-11-05 07:38:46'),
(26, 9, 1, 'Residential Cleaning of Sample Individual\'s Duplex', 'Deep cleaning of Sample Individual\'s home. 13 total rooms to be cleaned. ', 'Filler Address', '2020-11-05', '2020-11-06', '0000-00-00', 'Ongoing', '250.000 XOF', '2020-11-07 11:02:31'),
(27, 10, 6, 'Exterior Cleaning for Example Business', 'Cleaning of the outside of the business\'s office building and of the perimeter of said building. ', 'Fake Address', '2020-11-24', '2020-11-25', '0000-00-00', 'Initiation Pending', '150.000 XOF', '2020-11-05 07:44:15'),
(28, 12, 4, 'End of Tenancy Cleaning for Sample Example ', 'The customer\'s apartment will be cleaned on the occasion that he will be moving out. 5 Total rooms to clean. ', 'A Convincing Address ', '2020-10-31', '2020-11-01', '2020-11-01', 'Completed', '75.000 XOF', '2020-11-05 07:47:38'),
(29, 11, 3, 'Event Cleaning for AreMe ', 'Cleaning the client\'s office space both prior to and following an event they are holding. 3 Rooms to be cleaned. ', 'Example of an Address', '2020-11-15', '2020-11-15', '0000-00-00', 'Initiation Pending', '150.000 XOF', '2020-11-06 02:09:09'),
(30, 13, 7, 'ApexTech Renovation', 'Renovating the ApexTech office workspace to accommodate workforce changes.', 'ApexTech HQ Address', '2020-11-06', '2020-11-09', '0000-00-00', 'Initiation Pending', '350.000 XOF', '2020-11-07 07:54:39'),
(31, 9, 6, 'Exterior Cleaning for Sample Individual', 'Cleanign of the exterior of client\'s duplex and of the property\'s perimeter.', 'Sample Individual Home Address', '2020-11-06', '2020-11-08', '0000-00-00', 'Ongoing', '200.000 XOF', '2020-11-06 12:44:34'),
(34, 9, 3, 'Event Cleaning for Sample Individual', 'Cleaning that will be done prior to and following a festivity that the customer will be hosting. ', 'Customer\'s Home Address', '2020-11-05', '2020-11-06', '2020-11-06', 'Completed', '150.000 XOF', '2020-11-07 06:19:49');

-- --------------------------------------------------------

--
-- Table structure for table `contract_activities`
--

CREATE TABLE `contract_activities` (
  `activityID` int(11) NOT NULL,
  `contractID` int(11) NOT NULL,
  `activityName` text NOT NULL,
  `activityDesc` mediumtext DEFAULT NULL,
  `startDate` datetime DEFAULT NULL,
  `finishDate` datetime DEFAULT NULL,
  `completionStatus` enum('Incomplete','Complete','','') NOT NULL,
  `dateLastUpdated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contract_activities`
--

INSERT INTO `contract_activities` (`activityID`, `contractID`, `activityName`, `activityDesc`, `startDate`, `finishDate`, `completionStatus`, `dateLastUpdated`) VALUES
(1, 25, 'Displace Office Equipment ', 'Clear up the office space for cleaning. \r\n', NULL, NULL, 'Incomplete', '2020-11-07 15:55:42'),
(1, 26, 'Displace Household Items ', 'Move out household items that could get in the way of cleaning. ', '2020-11-05 12:30:00', '2020-11-05 14:30:00', 'Complete', '2020-11-07 17:03:31'),
(2, 25, 'Vacuum the Office Space', 'Use a vacuum to get rid of the dirt and debris in the office space. ', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Incomplete', '2020-11-07 15:59:40');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customerID` int(11) NOT NULL,
  `customerType` enum('Business','Individual','','') NOT NULL,
  `fullName` varchar(350) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phoneNumber` varchar(50) NOT NULL,
  `addr` mediumtext NOT NULL,
  `DOB` date NOT NULL,
  `dateLastUpdated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customerID`, `customerType`, `fullName`, `email`, `phoneNumber`, `addr`, `DOB`, `dateLastUpdated`) VALUES
(9, 'Individual', 'Sample Individual ', 'individual1@gmail.com', '01-02-03-04', 'Sample Address', '1974-04-13', '2020-11-03 17:36:27'),
(10, 'Business', 'Example Business', 'business1@gmail.com', '04-03-02-01', 'Example Address', '2015-02-14', '2020-11-03 17:37:28'),
(11, 'Business', 'AreMe', 'AreMe@yahoo.com', '23-20-21-21', 'Example of an Address', '2013-05-24', '2020-11-04 20:07:33'),
(12, 'Individual', 'Sample Example', 'blank@email.com', '11-11-11-11', 'Address of Customer', '1994-03-09', '2020-11-05 07:39:57'),
(13, 'Business', 'ApexTech', 'apextech@gmail.com', '21-21-22-22', 'Address of Apex Tech', '2005-11-16', '2020-11-06 00:25:57'),
(14, 'Business', 'Population Services International ', 'info@psici.org', '22 52 75 10', '06 BP 2456 Abidjan 06', '1970-02-14', '2020-11-10 23:43:02');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `paymentID` int(11) NOT NULL,
  `contractID` int(11) NOT NULL,
  `paymentMethodID` int(11) NOT NULL,
  `paymentDate` datetime NOT NULL DEFAULT current_timestamp(),
  `amountPaid` varchar(100) NOT NULL,
  `amountToPay` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`paymentID`, `contractID`, `paymentMethodID`, `paymentDate`, `amountPaid`, `amountToPay`) VALUES
(1, 25, 1, '2020-11-03 12:30:00', '200.000 XOF', '0 XOF'),
(2, 26, 1, '2020-11-04 00:00:00', '125.000 XOF', '125.000 XOF'),
(3, 26, 1, '2020-11-04 00:00:00', '125.000 XOF', '0 XOF'),
(4, 27, 3, '2020-11-10 08:30:00', '150.000 XOF', '0 XOF'),
(5, 28, 4, '2020-10-31 16:00:00', '50.000 XOF', '25.000 XOF'),
(6, 28, 1, '2020-11-01 08:00:00', '25.000 XOF', '0 XOF'),
(7, 29, 2, '2020-11-05 00:00:00', '150.000 XOF', '0 XOF');

-- --------------------------------------------------------

--
-- Table structure for table `payment_method`
--

CREATE TABLE `payment_method` (
  `paymentMethodID` int(11) NOT NULL,
  `methodName` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_method`
--

INSERT INTO `payment_method` (`paymentMethodID`, `methodName`) VALUES
(1, 'Cash'),
(2, 'Check'),
(3, 'Credit Card'),
(4, 'Debit Card'),
(5, 'Orange Money'),
(6, 'Moov Money');

-- --------------------------------------------------------

--
-- Table structure for table `service_offerings`
--

CREATE TABLE `service_offerings` (
  `serviceID` int(11) NOT NULL,
  `serviceName` varchar(200) NOT NULL,
  `serviceDesc` longtext NOT NULL COMMENT 'Service Description',
  `dateLastUpdated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='The services that Three K Services offers.';

--
-- Dumping data for table `service_offerings`
--

INSERT INTO `service_offerings` (`serviceID`, `serviceName`, `serviceDesc`, `dateLastUpdated`) VALUES
(1, 'Residential Cleaning', 'Cleaning of residences, apartments, houses and of things or areas around one\'s home.', '2020-11-06 02:59:21'),
(2, 'Commercial Cleaning', 'Cleaning services provided to other businesses such as offices, retailers, factories, bars, restaurants, etc. ', '2020-11-03 19:03:36'),
(3, 'Event Cleaning', 'Cleaning done before and/or after an event. ', '2020-11-03 19:04:19'),
(4, 'End of Tenancy Cleaning ', 'Cleaning that is done after a homeowner or apartment owner has vacated their former living space. ', '2020-11-03 19:06:39'),
(5, 'Builders Cleaning ', 'Cleaning that is done after construction work to ensure a building is safe and clean to inhabit. ', '2020-11-03 19:08:15'),
(6, 'Exterior Cleaning', 'Cleaning of the exteriors of houses, commercial offices and stores, buildings, etc.', '2020-11-03 19:09:13'),
(7, 'Renovation', 'Construction work that is undertaken to broken, damaged, or outdated building or housing structures. ', '2020-11-03 19:10:47'),
(8, 'Building Project', 'Ground-up construction of a building or house. ', '2020-11-03 19:11:24');

-- --------------------------------------------------------

--
-- Table structure for table `uploads`
--

CREATE TABLE `uploads` (
  `uploadID` int(11) NOT NULL,
  `contractID` int(11) NOT NULL,
  `fileName` varchar(300) NOT NULL,
  `fileType` varchar(300) NOT NULL,
  `fileSize` int(11) NOT NULL,
  `dateUploaded` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `uploads`
--

INSERT INTO `uploads` (`uploadID`, `contractID`, `fileName`, `fileType`, `fileSize`, `dateUploaded`) VALUES
(4, 25, 'Sample Estimate.docx', 'docx', 11776, '2020-11-07 21:15:23'),
(5, 25, 'Sample Bill.docx', 'docx', 11778, '2020-11-07 21:21:07');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `firstName` varchar(175) NOT NULL,
  `lastName` varchar(175) NOT NULL,
  `userRole` enum('Administrator','Administrative Staff','Project Manager','') NOT NULL,
  `username` varchar(255) NOT NULL,
  `passw` varchar(255) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phoneNumber` varchar(50) NOT NULL,
  `dateLastUpdated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `firstName`, `lastName`, `userRole`, `username`, `passw`, `email`, `phoneNumber`, `dateLastUpdated`) VALUES
(3, 'Admin', 'Admin', 'Administrator', 'admin', '$2y$10$sORkArrsNcCnvkTxSgTNGOuXa5cGSQKDASjr8F0imcK4GiUSPB2O2', 'admin@email.com', '00-00-00-00', '2020-11-06 08:52:40'),
(5, 'Sample', 'Sample', 'Administrative Staff', 'sample', '$2y$10$zr4hqP73FIudFUuBVw9nv.eUV8JzJX8uYBwdPiqS1ptoPLHdvbpoi', 'sample@email.com', '22-22-22-22', '2020-11-01 14:30:36'),
(6, 'Demo', 'Demo', 'Project Manager', 'demo', '$2y$10$4dVPsdjyZDEE458ZcyWvLupHRSbqPf6OzEUKbiMrMrzlH8hBS.ocC', 'demo@email.com', '44-44-44-44', '2020-11-06 04:09:03'),
(7, 'Staff', 'Staff', 'Administrative Staff', 'staff', '$2y$10$FJ3Xf.7vHkaoihWgfgeL2.NGCaqACh4LIoIcxElhcUvl0TM2ERnCq', 'staff@gmail.com', '12-24-36-48', '2020-11-09 06:19:00'),
(8, 'Boss', 'Boss', 'Administrator', 'boss', '$2y$10$eYSGL5y3rCUcGsaTDDnpuOmN3qFpMZ1gWMAvxFR.Hjkz257to0N.a', 'boss@gmail.com', '02-04-06-08', '2020-11-10 23:08:52'),
(9, 'UserA', 'UserA', 'Administrative Staff', 'userA', '$2y$10$9OKCxOFPj/uhcZWMBlKG0.MaMAo9BF/8rjEFIylWg0d/Rg67Kakai', 'userA@gmail.com', '03-09-12-15', '2020-11-10 23:21:16'),
(10, 'UserP', 'UserP', 'Project Manager', 'userP', '$2y$10$b5elUh/jtQ9ZiZMdxDHGSuuDtwRejNzOiOwJbdj2YSebimmqdsQ3q', 'userP@email.com', '04-08-12-16', '2020-11-10 23:20:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contracts`
--
ALTER TABLE `contracts`
  ADD PRIMARY KEY (`contractID`),
  ADD KEY `serviceID` (`serviceID`),
  ADD KEY `contracts_ibfk_1` (`customerID`);

--
-- Indexes for table `contract_activities`
--
ALTER TABLE `contract_activities`
  ADD PRIMARY KEY (`activityID`,`contractID`),
  ADD KEY `contractID` (`contractID`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customerID`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`paymentID`),
  ADD KEY `paymentMethodID` (`paymentMethodID`),
  ADD KEY `payments_ibfk_1` (`contractID`);

--
-- Indexes for table `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`paymentMethodID`);

--
-- Indexes for table `service_offerings`
--
ALTER TABLE `service_offerings`
  ADD PRIMARY KEY (`serviceID`);

--
-- Indexes for table `uploads`
--
ALTER TABLE `uploads`
  ADD PRIMARY KEY (`uploadID`),
  ADD KEY `contractID` (`contractID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `Unique_User` (`username`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contracts`
--
ALTER TABLE `contracts`
  MODIFY `contractID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `paymentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `payment_method`
--
ALTER TABLE `payment_method`
  MODIFY `paymentMethodID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `service_offerings`
--
ALTER TABLE `service_offerings`
  MODIFY `serviceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `uploads`
--
ALTER TABLE `uploads`
  MODIFY `uploadID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contracts`
--
ALTER TABLE `contracts`
  ADD CONSTRAINT `contracts_ibfk_1` FOREIGN KEY (`customerID`) REFERENCES `customers` (`customerID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `contracts_ibfk_2` FOREIGN KEY (`serviceID`) REFERENCES `service_offerings` (`serviceID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `contract_activities`
--
ALTER TABLE `contract_activities`
  ADD CONSTRAINT `contract_activities_ibfk_1` FOREIGN KEY (`contractID`) REFERENCES `contracts` (`contractID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`contractID`) REFERENCES `contracts` (`contractID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payments_ibfk_2` FOREIGN KEY (`paymentMethodID`) REFERENCES `payment_method` (`paymentMethodID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `uploads`
--
ALTER TABLE `uploads`
  ADD CONSTRAINT `uploads_ibfk_1` FOREIGN KEY (`contractID`) REFERENCES `contracts` (`contractID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
