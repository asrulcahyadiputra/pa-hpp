-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Nov 19, 2020 at 09:07 PM
-- Server version: 5.7.26
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `pa_hpp`
--

-- --------------------------------------------------------

--
-- Table structure for table `bill_of_materials`
--

CREATE TABLE `bill_of_materials` (
  `bom_id` bigint(20) NOT NULL,
  `trans_id` varchar(50) NOT NULL,
  `material_id` varchar(50) NOT NULL,
  `qty` float NOT NULL,
  `unit` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bill_of_materials`
--

INSERT INTO `bill_of_materials` (`bom_id`, `trans_id`, `material_id`, `qty`, `unit`) VALUES
(1, 'TRX-BOM-000000001', 'MTR-0004', 1.5, 'Meter'),
(2, 'TRX-BOM-000000001', 'MTR-0005', 3, 'Roll'),
(5, 'TRX-BOM-000000001', 'MTR-0008', 1, 'Pcs'),
(10, 'TRX-BOM-000000002', 'MTR-0004', 1, 'Meter'),
(11, 'TRX-BOM-000000002', 'MTR-0005', 2, 'Roll'),
(12, 'TRX-BOM-000000002', 'MTR-0008', 1, 'Pcs');

-- --------------------------------------------------------

--
-- Table structure for table `chart_of_accouts`
--

CREATE TABLE `chart_of_accouts` (
  `account_no` int(11) NOT NULL,
  `account_name` varchar(100) NOT NULL,
  `normal_balance` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` varchar(20) NOT NULL,
  `cus_name` varchar(100) NOT NULL,
  `cus_address` text NOT NULL,
  `cus_phone` varchar(13) NOT NULL,
  `cus_email` varchar(100) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted` int(1) NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `cus_name`, `cus_address`, `cus_phone`, `cus_email`, `date_created`, `deleted`, `deleted_at`) VALUES
('CUS-0001', 'Ujang Farhan', 'Jl Terusan Buah Batu No 12, Bandung', '082585654789', 'ujangfarhan@gmail.com', '2020-10-22 14:33:49', 0, NULL),
('CUS-0002', 'Kang Ical', 'Jl M Toha, Bandung', '081298789200', 'kangical@gmail.com', '2020-10-22 15:19:08', 0, NULL),
('CUS-0003', 'Neng Riska', 'Jl Soekar Hatta No 123, Bandung', '085654123400', 'negriska@gmail.com', '2020-10-22 15:20:28', 0, NULL),
('CUS-0004', 'Kang Jamal', 'Jl Bukit Baruga No 6A, Bandung', '081554456123', 'kangjamal@gmail.com', '2020-10-22 15:40:06', 0, NULL),
('CUS-0005', 'Neng Fatma', 'Jl Soekarno Hatta No 56A, Bandung', '085645879123', 'negfatma@gmail.com', '2020-10-22 18:47:34', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `direct_labor_costs`
--

CREATE TABLE `direct_labor_costs` (
  `direct_labor_id` bigint(20) NOT NULL,
  `trans_id` varchar(50) NOT NULL,
  `employee_id` varchar(50) NOT NULL,
  `cost` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `employee_id` varchar(50) NOT NULL,
  `employee_name` varchar(100) NOT NULL,
  `employee_address` text NOT NULL,
  `employee_phone` varchar(13) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`employee_id`, `employee_name`, `employee_address`, `employee_phone`, `status`, `date_created`, `date_updated`) VALUES
('KAR-0001', 'Kang Dandang Suherman', 'Bandung Juara', '087780087787', 1, '2020-11-17 16:31:39', '2020-11-17 16:55:18'),
('KAR-0002', 'Neng Sulisa Tisna', 'Bandung Bermartabat', '085585850858', 1, '2020-11-17 16:34:30', NULL),
('KAR-0003', 'Ujang Doni Maulana', 'Bandung Kota Kembang', '081558855288', 1, '2020-11-17 16:56:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `general_ledger`
--

CREATE TABLE `general_ledger` (
  `gl_id` bigint(20) NOT NULL,
  `account_no` int(11) NOT NULL,
  `gl_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `trans_id` varchar(50) NOT NULL,
  `nominal` double NOT NULL,
  `gl_balance` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` bigint(20) NOT NULL,
  `trans_id` varchar(50) NOT NULL,
  `product_id` varchar(50) NOT NULL,
  `order_qty` varchar(20) NOT NULL,
  `order_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `production_costs`
--

CREATE TABLE `production_costs` (
  `cost_id` bigint(20) NOT NULL,
  `trans_id` varchar(50) NOT NULL,
  `material_cost` double NOT NULL,
  `direct_labor_cost` double NOT NULL,
  `overhead_cost` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` varchar(50) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `sales_price` int(11) NOT NULL,
  `product_unit` varchar(50) NOT NULL,
  `product_category` varchar(100) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted` int(11) NOT NULL DEFAULT '0',
  `date_updated` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `sales_price`, `product_unit`, `product_category`, `date_created`, `deleted`, `date_updated`, `deleted_at`) VALUES
('PRD-0001', 'Kaos Anak', 55000, 'Pcs', 'Kaos', '2020-10-22 19:26:07', 0, NULL, NULL),
('PRD-0002', 'Kaos Dewasa', 60000, 'Pcs', 'Kaos', '2020-10-22 19:29:25', 0, NULL, NULL),
('PRD-0003', 'Seragam Olahraga SD', 120000, 'Pcs', 'Pakaian Seragam', '2020-10-22 19:45:28', 0, NULL, NULL),
('PRD-0004', 'Kaos Polos', 55000, 'Pcs', 'Kaos ', '2020-11-19 16:37:46', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `purchase_id` bigint(20) NOT NULL,
  `trans_id` varchar(50) NOT NULL,
  `material_id` varchar(50) NOT NULL,
  `purchase_qty` int(11) NOT NULL,
  `purchase_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `raw_materials`
--

CREATE TABLE `raw_materials` (
  `material_id` varchar(50) NOT NULL,
  `material_name` varchar(100) NOT NULL,
  `material_stock` double NOT NULL,
  `material_unit` varchar(50) NOT NULL,
  `material_type` char(20) NOT NULL,
  `deleted` int(11) NOT NULL DEFAULT '0',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `raw_materials`
--

INSERT INTO `raw_materials` (`material_id`, `material_name`, `material_stock`, `material_unit`, `material_type`, `deleted`, `date_created`, `date_updated`, `deleted_at`) VALUES
('MTR-0001', 'Kain Katun', 0, 'Meter', 'BBB', 0, '2020-10-22 20:24:59', NULL, NULL),
('MTR-0004', 'Cotton Combed 40S', 0, 'Meter', 'BBB', 0, '2020-10-22 20:30:12', NULL, '2020-10-22 20:33:49'),
('MTR-0005', 'Benang', 0, 'Roll', 'BBB', 0, '2020-11-19 17:03:32', NULL, NULL),
('MTR-0008', 'Plastik Kemasan', 0, 'Pcs', 'BBP', 0, '2020-11-19 17:07:02', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `trans_id` varchar(50) NOT NULL,
  `trans_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `customer_id` varchar(20) DEFAULT NULL,
  `product_id` varchar(50) DEFAULT NULL,
  `order_done` date DEFAULT NULL,
  `trans_total` double NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`trans_id`, `trans_date`, `customer_id`, `product_id`, `order_done`, `trans_total`, `status`, `date_created`, `updated_at`) VALUES
('TRX-BOM-000000001', '2020-11-19 21:00:48', NULL, 'PRD-0004', NULL, 0, 1, '2020-11-19 17:52:19', '2020-11-19 21:00:48'),
('TRX-BOM-000000002', '2020-11-19 21:01:36', NULL, 'PRD-0001', NULL, 0, 1, '2020-11-19 21:01:12', '2020-11-19 21:01:36');

-- --------------------------------------------------------

--
-- Table structure for table `type_of_materials`
--

CREATE TABLE `type_of_materials` (
  `id` char(20) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `type_of_materials`
--

INSERT INTO `type_of_materials` (`id`, `name`) VALUES
('BBB', 'Bahan Baku Utama'),
('BBP', 'Bahan Baku Penolong');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` bigint(20) NOT NULL,
  `name` int(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bill_of_materials`
--
ALTER TABLE `bill_of_materials`
  ADD PRIMARY KEY (`bom_id`),
  ADD KEY `material_id` (`material_id`),
  ADD KEY `trans_id` (`trans_id`);

--
-- Indexes for table `chart_of_accouts`
--
ALTER TABLE `chart_of_accouts`
  ADD PRIMARY KEY (`account_no`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `direct_labor_costs`
--
ALTER TABLE `direct_labor_costs`
  ADD PRIMARY KEY (`direct_labor_id`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `trans_id` (`trans_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `general_ledger`
--
ALTER TABLE `general_ledger`
  ADD PRIMARY KEY (`gl_id`),
  ADD KEY `trans_id` (`trans_id`),
  ADD KEY `account_no` (`account_no`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `trans_id` (`trans_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `production_costs`
--
ALTER TABLE `production_costs`
  ADD PRIMARY KEY (`cost_id`),
  ADD KEY `trans_id` (`trans_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`purchase_id`),
  ADD KEY `trans_id` (`trans_id`),
  ADD KEY `material_id` (`material_id`);

--
-- Indexes for table `raw_materials`
--
ALTER TABLE `raw_materials`
  ADD PRIMARY KEY (`material_id`),
  ADD KEY `material_type` (`material_type`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`trans_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `type_of_materials`
--
ALTER TABLE `type_of_materials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bill_of_materials`
--
ALTER TABLE `bill_of_materials`
  MODIFY `bom_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `direct_labor_costs`
--
ALTER TABLE `direct_labor_costs`
  MODIFY `direct_labor_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `general_ledger`
--
ALTER TABLE `general_ledger`
  MODIFY `gl_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `production_costs`
--
ALTER TABLE `production_costs`
  MODIFY `cost_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `purchase_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bill_of_materials`
--
ALTER TABLE `bill_of_materials`
  ADD CONSTRAINT `bill_of_materials_ibfk_1` FOREIGN KEY (`material_id`) REFERENCES `raw_materials` (`material_id`),
  ADD CONSTRAINT `bill_of_materials_ibfk_3` FOREIGN KEY (`trans_id`) REFERENCES `transactions` (`trans_id`);

--
-- Constraints for table `direct_labor_costs`
--
ALTER TABLE `direct_labor_costs`
  ADD CONSTRAINT `direct_labor_costs_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`employee_id`),
  ADD CONSTRAINT `direct_labor_costs_ibfk_2` FOREIGN KEY (`trans_id`) REFERENCES `transactions` (`trans_id`);

--
-- Constraints for table `general_ledger`
--
ALTER TABLE `general_ledger`
  ADD CONSTRAINT `general_ledger_ibfk_1` FOREIGN KEY (`trans_id`) REFERENCES `transactions` (`trans_id`),
  ADD CONSTRAINT `general_ledger_ibfk_2` FOREIGN KEY (`account_no`) REFERENCES `chart_of_accouts` (`account_no`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`trans_id`) REFERENCES `transactions` (`trans_id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `production_costs`
--
ALTER TABLE `production_costs`
  ADD CONSTRAINT `production_costs_ibfk_1` FOREIGN KEY (`trans_id`) REFERENCES `transactions` (`trans_id`);

--
-- Constraints for table `purchase`
--
ALTER TABLE `purchase`
  ADD CONSTRAINT `purchase_ibfk_1` FOREIGN KEY (`trans_id`) REFERENCES `transactions` (`trans_id`),
  ADD CONSTRAINT `purchase_ibfk_2` FOREIGN KEY (`material_id`) REFERENCES `raw_materials` (`material_id`);

--
-- Constraints for table `raw_materials`
--
ALTER TABLE `raw_materials`
  ADD CONSTRAINT `raw_materials_ibfk_1` FOREIGN KEY (`material_type`) REFERENCES `type_of_materials` (`id`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`),
  ADD CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);
