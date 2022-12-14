-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2022 at 02:09 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sale_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `assets`
--

CREATE TABLE `assets` (
  `Asset_id` int(4) NOT NULL,
  `Asset_name` varchar(256) NOT NULL,
  `Description` varchar(256) NOT NULL,
  `Costs` decimal(10,0) NOT NULL,
  `Status` varchar(256) NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assets`
--

INSERT INTO `assets` (`Asset_id`, `Asset_name`, `Description`, `Costs`, `Status`, `Date`) VALUES
(1, 'Computer', 'DELL Latitude 220', '250000', 'Not in use', '2020-03-29'),
(2, 'Computer', 'HP Elitebook 8460p', '550000', 'Good', '2020-02-04'),
(5, 'Generator', 'Hp7. 6', '800000', 'Good', '2020-02-05');

-- --------------------------------------------------------

--
-- Table structure for table `credits`
--

CREATE TABLE `credits` (
  `credit_id` int(100) NOT NULL,
  `Product_id` int(100) NOT NULL,
  `Borrower` varchar(255) NOT NULL,
  `Phone_number` varchar(256) NOT NULL,
  `Quantity_borrowed` int(100) NOT NULL,
  `Price` int(100) NOT NULL,
  `Mode` varchar(200) NOT NULL,
  `Amount_total` int(100) NOT NULL,
  `Amount_payed` int(100) NOT NULL,
  `Amount_left` int(100) NOT NULL,
  `Status` varchar(100) NOT NULL,
  `Maelezo` text NOT NULL,
  `Borrowing_date` date NOT NULL,
  `User_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `credits`
--

INSERT INTO `credits` (`credit_id`, `Product_id`, `Borrower`, `Phone_number`, `Quantity_borrowed`, `Price`, `Mode`, `Amount_total`, `Amount_payed`, `Amount_left`, `Status`, `Maelezo`, `Borrowing_date`, `User_id`) VALUES
(2, 1, 'David Daniel', '0767676767', 15, 1400, 'jumla', 21000, 21000, 0, 'complete', '', '2020-04-29', 1),
(3, 1, 'David Daniel', '0586436309', 1, 1400, 'jumla', 1400, 1140, 260, 'Incomplete', '', '2020-04-29', 1),
(4, 1, 'David Daniel', '', 10, 1400, 'jumla', 14000, 10200, 3800, 'Incomplete', '', '2020-04-29', 1),
(5, 18, 'David Daniel', '0345454545', 1, 1800, 'jumla', 1800, 1550, 250, 'Incomplete', '', '2020-04-29', 1),
(6, 1, 'David Daniel', '', 1, 1400, 'jumla', 1400, 1400, 0, 'complete', '', '2020-04-29', 1),
(7, 17, 'Alex Mwijage', '0767776659', 15, 1500, 'rejareja', 22500, 22500, 0, 'complete', '', '2020-04-30', 1),
(8, 19, 'Jackson Simon', '0765787565', 3, 1300, 'jumla', 3900, 3900, 0, 'complete', 'Kasema hana ela atalipa kesho', '2020-04-30', 1),
(9, 1, 'Jabil Swaibu', '0645465599', 15, 1400, 'jumla', 21000, 9600, 11400, 'Incomplete', 'Atalipa tarehe 20-05-2020', '2020-05-01', 1),
(10, 17, 'Dani Daniel', '0756554354', 1, 1500, 'rejareja', 1500, 1100, 400, 'Incomplete', 'Malipo kesho', '2020-05-02', 1);

-- --------------------------------------------------------

--
-- Table structure for table `loandetails`
--

CREATE TABLE `loandetails` (
  `detail_id` int(100) NOT NULL,
  `Amount_payed` int(100) NOT NULL,
  `date` datetime NOT NULL,
  `credit_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loandetails`
--

INSERT INTO `loandetails` (`detail_id`, `Amount_payed`, `date`, `credit_id`) VALUES
(2, 9000, '2020-04-30 00:00:00', 2),
(4, 11800, '2020-04-30 00:00:00', 2),
(5, 140, '2020-05-01 00:00:00', 3),
(6, 500, '2020-05-01 00:00:00', 3),
(7, 1200, '2020-05-01 00:00:00', 4),
(8, 9000, '2020-05-01 09:35:00', 4),
(9, 1500, '2020-05-01 11:04:00', 5),
(10, 9500, '2020-05-01 07:59:00', 9),
(11, 500, '2020-05-02 09:27:00', 3),
(12, 500, '2020-05-02 10:38:00', 10),
(14, 100, '2020-05-03 07:07:00', 9),
(15, 50, '2020-05-03 07:07:00', 5),
(16, 500, '2020-05-06 05:13:00', 10),
(17, 200, '2020-05-07 08:20:00', 2),
(18, 50, '2022-12-09 02:24:00', 10);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `Product_id` int(255) NOT NULL,
  `Product_name` varchar(256) NOT NULL,
  `Product_description` varchar(256) NOT NULL,
  `Quantity_total` int(4) NOT NULL,
  `Quantity_left` int(4) NOT NULL,
  `Cost_single` decimal(10,0) NOT NULL,
  `Cost_total` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`Product_id`, `Product_name`, `Product_description`, `Quantity_total`, `Quantity_left`, `Cost_single`, `Cost_total`) VALUES
(1, 'Files', 'box file kubwa', 400, 20, '1500', '1400'),
(3, 'Files', 'folder file', 400, 400, '1500', '1450'),
(16, 'Counter Books', 'Q2', 12, 12, '1500', '1500'),
(17, 'Manila', 'Nyekundu', 400, 384, '1500', '1800'),
(18, 'Pading', 'DMK/KAGERA', 400, 299, '1500', '1800'),
(19, 'Pads', 'Manila Kubwa', 400, 391, '1500', '1300'),
(20, 'Excise Books', 'DMK/KAGERA', 400, 70, '2000', '1500'),
(21, 'Computer ', 'Dell Latitude 530l', 5, 0, '450000', '420000'),
(22, 'Pads', 'Ddd', 66, 66, '1500', '1200'),
(23, 'Okay ', 'Okay ', 5, 5, '500', '550'),
(24, 'Files-box file kubwa', 'Okay ', 5, 399, '500', '400'),
(25, 'Gazeti', 'Mwananchi', 12, 12, '600', '500');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `Sale_id` int(4) NOT NULL,
  `User_id` int(4) NOT NULL,
  `Product_id` int(4) NOT NULL,
  `selling_mode` varchar(100) NOT NULL,
  `Quantity` int(100) NOT NULL,
  `Price` decimal(10,0) NOT NULL,
  `Description` varchar(256) NOT NULL,
  `Total` int(100) NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`Sale_id`, `User_id`, `Product_id`, `selling_mode`, `Quantity`, `Price`, `Description`, `Total`, `Date`) VALUES
(57, 1, 3, 'jumla', 3, '1500', '', 4500, '2020-03-31'),
(58, 1, 3, 'jumla', 93, '1450', '', 134850, '2020-03-30'),
(77, 4, 1, 'jumla', 20, '1500', '', 30000, '2020-04-03'),
(79, 1, 1, 'rejareja', 5, '1500', '', 19500, '2020-04-04'),
(82, 1, 3, 'jumla', 10, '1450', '', 14500, '2020-04-05'),
(85, 1, 3, 'rejareja', 15, '1500', '', 22500, '2020-04-05'),
(86, 1, 3, 'jumla', 10, '1450', '', 14500, '2020-04-07'),
(93, 1, 16, 'rejareja', 10, '1500', '', 15000, '2020-04-10'),
(95, 1, 1, 'jumla', 100, '1400', 'No reduction', 140000, '2020-04-10'),
(96, 1, 1, 'jumla', 50, '1390', 'Kapunguziwa tsh 10', 69500, '2020-04-10'),
(97, 1, 3, 'jumla', 20, '1450', '', 29000, '2020-04-10'),
(98, 1, 1, 'jumla', 50, '1400', 'No reduction', 70000, '2020-04-11'),
(99, 1, 3, 'rejareja', 10, '1500', '', 15000, '2020-04-11'),
(100, 1, 16, 'rejareja', 33, '1500', '', 49500, '2020-04-11'),
(101, 1, 16, 'jumla', 50, '1500', '', 75000, '2020-04-11'),
(102, 1, 3, 'rejareja', 8, '1500', 'yyyuu hhgjg', 12000, '2020-04-15'),
(103, 1, 3, 'jumla', 30, '1450', '', 43500, '2020-04-15'),
(104, 1, 1, 'rejareja', 99, '1500', '', 148500, '2020-04-15'),
(105, 1, 3, 'jumla', 50, '1450', '', 72500, '2020-04-17'),
(106, 1, 1, 'rejareja', 10, '1500', '', 15000, '2020-04-29'),
(107, 1, 18, 'jumla', 19, '1800', '', 34200, '2020-04-29'),
(108, 1, 16, 'jumla', 50, '1500', '', 75000, '2020-04-29'),
(109, 1, 1, 'rejareja', 3, '1500', '', 4500, '2020-04-30'),
(110, 1, 18, 'jumla', 80, '1800', '', 144000, '2020-05-01'),
(111, 1, 19, 'rejareja', 1, '1500', '', 1500, '2020-05-01'),
(112, 1, 19, 'rejareja', 5, '1490', 'Kapunguzuwa  Tsh 50 kwa kila moja', 7450, '2020-05-01'),
(113, 1, 20, 'rejareja', 1, '1500', '', 1500, '2020-05-02'),
(114, 1, 1, 'rejareja', 15, '1500', '', 22500, '2020-05-03'),
(115, 1, 18, 'rejareja', 1, '1500', 'No reduction done ', 1500, '2020-05-06'),
(116, 1, 21, 'jumla', 1, '420000', '', 420000, '2020-05-11'),
(117, 1, 24, '...........', 1, '5', '', 5, '2020-06-07');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `service_id` int(100) NOT NULL,
  `Product_id` int(100) NOT NULL,
  `Quantity` int(100) NOT NULL,
  `Full_name` varchar(256) NOT NULL,
  `Phone_number` varchar(200) NOT NULL,
  `Reason` text NOT NULL,
  `Date` date NOT NULL,
  `Amount` int(100) NOT NULL,
  `User_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`service_id`, `Product_id`, `Quantity`, `Full_name`, `Phone_number`, `Reason`, `Date`, `Amount`, `User_id`) VALUES
(26, 1, 1, 'David Daniel', '0586436309', 'rrrr', '2020-04-04', 1500, 1),
(28, 1, 1, 'David Daniel', '0586436309', 'dd', '2020-04-04', 1500, 1),
(30, 16, 5, 'Fabian Claudianus', '0767676767', 'Said manager', '2020-04-11', 7500, 1),
(31, 3, 2, 'David Daniel', '0768989898', 'no reason', '2020-04-11', 3000, 1),
(32, 1, 1, 'Fabian Claudianus', '0767676767', 'tggybygygy', '2020-04-15', 1500, 1);

-- --------------------------------------------------------

--
-- Table structure for table `system_confg`
--

CREATE TABLE `system_confg` (
  `config_id` int(11) NOT NULL,
  `Expire_date` date NOT NULL,
  `Access` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `system_confg`
--

INSERT INTO `system_confg` (`config_id`, `Expire_date`, `Access`) VALUES
(1, '2090-09-01', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `User_id` int(255) NOT NULL,
  `Full_name` varchar(256) NOT NULL,
  `Phone_number` varchar(255) NOT NULL,
  `Role` varchar(256) NOT NULL,
  `Status` varchar(256) NOT NULL,
  `Registration_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Username` varchar(256) NOT NULL,
  `Password` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`User_id`, `Full_name`, `Phone_number`, `Role`, `Status`, `Registration_date`, `Username`, `Password`) VALUES
(1, 'David Daniel', '0767676767', 'normal_user', 'inactive', '2022-12-09 10:27:41', 'daniel', 'aa47f8215c6f30a0dcdb2a36a9f4168e'),
(2, 'Ester Daniel', '0767676767', 'normal_user', 'active', '2022-12-09 10:28:56', 'ester', '172522ec1028ab781d9dfd17eaca4427'),
(3, 'User', '0785544766', 'normal_user', 'active', '2022-12-09 12:10:54', 'user', 'ee11cbb19052e40b07aac0ca060c23ee'),
(4, 'Alfredina Daniel', '76758578575', 'normal_user', 'active', '2020-04-04 08:37:26', 'fred', '570a90bfbf8c7eab5dc5d4e26832d5b1'),
(11, 'SHARIFU MAJANDILA', '0756565656', 'Admin', 'active', '2022-12-09 12:13:13', 'admin', '21232f297a57a5a743894a0e4a801fc3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assets`
--
ALTER TABLE `assets`
  ADD PRIMARY KEY (`Asset_id`);

--
-- Indexes for table `credits`
--
ALTER TABLE `credits`
  ADD PRIMARY KEY (`credit_id`);

--
-- Indexes for table `loandetails`
--
ALTER TABLE `loandetails`
  ADD PRIMARY KEY (`detail_id`),
  ADD KEY `credit_id` (`credit_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`Product_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`Sale_id`),
  ADD KEY `user-sale-relationship` (`User_id`),
  ADD KEY `sale-product-relationship` (`Product_id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`service_id`),
  ADD KEY `service_ibfk_1` (`Product_id`),
  ADD KEY `service_ibfk_2` (`User_id`);

--
-- Indexes for table `system_confg`
--
ALTER TABLE `system_confg`
  ADD PRIMARY KEY (`config_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`User_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assets`
--
ALTER TABLE `assets`
  MODIFY `Asset_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `credits`
--
ALTER TABLE `credits`
  MODIFY `credit_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `loandetails`
--
ALTER TABLE `loandetails`
  MODIFY `detail_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `Product_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `Sale_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `service_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `system_confg`
--
ALTER TABLE `system_confg`
  MODIFY `config_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `User_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `loandetails`
--
ALTER TABLE `loandetails`
  ADD CONSTRAINT `loandetails_ibfk_1` FOREIGN KEY (`credit_id`) REFERENCES `credits` (`credit_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sale-product-relationship` FOREIGN KEY (`Product_id`) REFERENCES `product` (`Product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user-sale-relationship` FOREIGN KEY (`User_id`) REFERENCES `user` (`User_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `service`
--
ALTER TABLE `service`
  ADD CONSTRAINT `service_ibfk_1` FOREIGN KEY (`Product_id`) REFERENCES `product` (`Product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `service_ibfk_2` FOREIGN KEY (`User_id`) REFERENCES `user` (`User_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
