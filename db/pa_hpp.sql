-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Apr 20, 2021 at 01:59 PM
-- Server version: 5.7.32
-- PHP Version: 7.4.12

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
  `material_id` varchar(50) DEFAULT NULL,
  `qty` float DEFAULT NULL,
  `unit` varchar(100) DEFAULT NULL,
  `employee_id` varchar(50) DEFAULT NULL,
  `cost` int(11) DEFAULT NULL,
  `oc_id` char(5) DEFAULT NULL,
  `overhead_cost` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bill_of_materials`
--

INSERT INTO `bill_of_materials` (`bom_id`, `trans_id`, `material_id`, `qty`, `unit`, `employee_id`, `cost`, `oc_id`, `overhead_cost`) VALUES
(16, 'TRX-BOM-000000001', 'MTR-0001', 2.5, 'Meter', NULL, NULL, NULL, NULL),
(17, 'TRX-BOM-000000001', 'MTR-0005', 5, 'Roll', NULL, NULL, NULL, NULL),
(18, 'TRX-BOM-000000001', 'MTR-0008', 1, 'Pcs', NULL, NULL, NULL, NULL),
(19, 'TRX-BOM-000000002', 'MTR-0004', 1.5, 'Meter', NULL, NULL, NULL, NULL),
(20, 'TRX-BOM-000000002', 'MTR-0005', 1, 'Roll', NULL, NULL, NULL, NULL),
(21, 'TRX-BOM-000000002', 'MTR-0008', 1, 'Pcs', NULL, NULL, NULL, NULL),
(25, 'TRX-BOM-000000004', NULL, NULL, NULL, 'KAR-0002', 100, NULL, NULL),
(26, 'TRX-BOM-000000004', 'MTR-0001', 1, NULL, NULL, NULL, NULL, NULL),
(27, 'TRX-BOM-000000004', NULL, NULL, NULL, NULL, NULL, 'OV02', 100);

-- --------------------------------------------------------

--
-- Table structure for table `chart_of_accounts`
--

CREATE TABLE `chart_of_accounts` (
  `account_no` varchar(20) NOT NULL,
  `account_name` varchar(100) NOT NULL,
  `normal_balance` varchar(1) NOT NULL,
  `sub_code` char(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `chart_of_accounts`
--

INSERT INTO `chart_of_accounts` (`account_no`, `account_name`, `normal_balance`, `sub_code`) VALUES
('1-10001', 'Kas', 'd', '1-1'),
('1-10002', 'Piutang Usaha', 'd', '1-1'),
('1-10003', 'Persediaan Bahan Baku', 'd', '1-1'),
('1-10004', 'Persedian Bahan Penolong', 'd', '1-1'),
('1-10005', 'Persediaan Produk Jadi', 'd', '1-1'),
('1-20001', 'Mesin Jahit', 'd', '1-2'),
('1-20002', 'Mesin Bordir', 'd', '1-2'),
('1-30001', 'Akta Notaris', 'd', '1-3'),
('2-10001', 'Pendapatan diterima dimuka', 'k', '2-1'),
('2-10002', 'Utang Usaha', 'k', '2-1'),
('2-20001', 'Utang Kredit Bank', 'k', '2-2'),
('3-10001', 'Modal Pemilik', 'k', '3-1'),
('4-10001', 'Penjualan', 'k', '4-1'),
('5-10001', 'Beban Administrasi dan Umum', 'd', '5-1'),
('5-20001', 'BDP-BBB', 'd', '5-2'),
('5-20002', 'BDP-BTKL', 'd', '5-2'),
('5-20003', 'BDP-BOP', 'd', '5-2'),
('5-20004', 'BDP-BBP', 'd', '5-2'),
('5-20005', 'BOP yang sesungguhnya', 'd', '5-2');

-- --------------------------------------------------------

--
-- Table structure for table `coa_head`
--

CREATE TABLE `coa_head` (
  `head_code` char(1) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `coa_head`
--

INSERT INTO `coa_head` (`head_code`, `name`) VALUES
('1', 'Aktiva'),
('2', 'Pasiva'),
('3', 'Modal'),
('4', 'Penjualan'),
('5', 'Beban');

-- --------------------------------------------------------

--
-- Table structure for table `coa_subhead`
--

CREATE TABLE `coa_subhead` (
  `sub_code` char(3) NOT NULL,
  `name` varchar(100) NOT NULL,
  `head_code` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `coa_subhead`
--

INSERT INTO `coa_subhead` (`sub_code`, `name`, `head_code`) VALUES
('1-1', 'Aktiva Lancar', '1'),
('1-2', 'Aktiva Tetap', '1'),
('1-3', 'Aktiva Tidak Berwujud', '1'),
('2-1', 'Kewajiban Jangka Pendek', '2'),
('2-2', 'Kewajiban Jangka Panjang', '2'),
('3-1', 'Modal', '3'),
('4-1', 'Penjualan ', '4'),
('5-1', 'Beban Operasional', '5'),
('5-2', 'Beban Produksi', '5');

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
  `account_no` varchar(20) NOT NULL,
  `gl_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `trans_id` varchar(50) NOT NULL,
  `nominal` double NOT NULL,
  `gl_balance` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `general_ledger`
--

INSERT INTO `general_ledger` (`gl_id`, `account_no`, `gl_date`, `trans_id`, `nominal`, `gl_balance`) VALUES
(11, '1-10003', '2020-11-21 17:09:47', 'TRX-PMB-000000001', 8200000, 'd'),
(12, '1-10004', '2020-11-21 17:09:47', 'TRX-PMB-000000001', 540000, 'd'),
(13, '1-10001', '2020-11-21 17:09:47', 'TRX-PMB-000000001', 8740000, 'k'),
(14, '1-10003', '2020-11-21 17:24:25', 'TRX-PMB-000000002', 1800000, 'd'),
(15, '1-10001', '2020-11-21 17:24:25', 'TRX-PMB-000000002', 1800000, 'k'),
(16, '1-10003', '2020-11-21 17:28:00', 'TRX-PMB-000000003', 460000, 'd'),
(17, '1-10001', '2020-11-21 17:28:00', 'TRX-PMB-000000003', 460000, 'k'),
(18, '1-10001', '2020-11-21 17:37:39', 'TRX-PSN-000000001', 15000000, 'd'),
(19, '2-10001', '2020-11-21 17:37:39', 'TRX-PSN-000000001', 15000000, 'k'),
(20, '1-10003', '2020-11-21 17:40:02', 'TRX-PMB-000000004', 230000, 'd'),
(21, '1-10001', '2020-11-21 17:40:02', 'TRX-PMB-000000004', 230000, 'k'),
(22, '1-10001', '2020-11-21 17:56:57', 'TRX-PSN-000000002', 250000, 'd'),
(23, '2-10001', '2020-11-21 17:56:57', 'TRX-PSN-000000002', 250000, 'k');

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

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `trans_id`, `product_id`, `order_qty`, `order_price`) VALUES
(8, 'TRX-PSN-000000001', 'PRD-0003', '360', 120000),
(9, 'TRX-PSN-000000002', 'PRD-0004', '12', 55000);

-- --------------------------------------------------------

--
-- Table structure for table `overhead_component`
--

CREATE TABLE `overhead_component` (
  `oc_id` char(5) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `overhead_component`
--

INSERT INTO `overhead_component` (`oc_id`, `name`) VALUES
('OV01', 'Biaya Tenaga Kerja Tidak Langsung'),
('OV02', 'Biaya perbaikan dna pemeliharaan Mesin'),
('OV03', 'Biaya Listrik dan Air'),
('OV04', 'Biaya Overhead Rupa-rupa');

-- --------------------------------------------------------

--
-- Table structure for table `overhead_cost`
--

CREATE TABLE `overhead_cost` (
  `id` bigint(20) NOT NULL,
  `trans_id` varchar(50) NOT NULL,
  `oc_id` char(5) NOT NULL,
  `overhead_cost` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` bigint(20) NOT NULL,
  `trans_id` varchar(50) NOT NULL,
  `nominal` double NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `trans_id`, `nominal`, `description`) VALUES
(6, 'TRX-PSN-000000001', 15000000, 'Down Payment (DP)'),
(7, 'TRX-PSN-000000002', 250000, 'Down Payment (DP)');

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

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`purchase_id`, `trans_id`, `material_id`, `purchase_qty`, `purchase_price`) VALUES
(1, 'TRX-PMB-000000001', 'MTR-0001', 200, 23000),
(2, 'TRX-PMB-000000001', 'MTR-0005', 200, 18000),
(4, 'TRX-PMB-000000001', 'MTR-0008', 360, 1500),
(5, 'TRX-PMB-000000002', 'MTR-0001', 100, 18000),
(6, 'TRX-PMB-000000003', 'MTR-0004', 20, 23000),
(7, 'TRX-PMB-000000004', 'MTR-0004', 10, 23000);

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
('MTR-0008', 'Plastik Kemasan', 0, 'Pcs', 'BBP', 0, '2020-11-19 17:07:02', NULL, NULL),
('MTR-0011', 'Kain Batik', 0, 'Meter', 'BBB', 0, '2021-04-17 03:08:23', NULL, NULL);

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
  `trans_type` varchar(100) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`trans_id`, `trans_date`, `customer_id`, `product_id`, `order_done`, `trans_total`, `status`, `trans_type`, `date_created`, `updated_at`) VALUES
('TRX-BOM-000000001', '2021-04-18 11:20:50', NULL, 'PRD-0003', NULL, 0, 0, 'bom', '2020-11-21 15:37:42', '2021-04-18 11:20:50'),
('TRX-BOM-000000002', '2021-04-20 13:55:26', NULL, 'PRD-0004', NULL, 0, 0, 'bom', '2020-11-21 19:59:10', '2021-04-20 13:55:26'),
('TRX-BOM-000000003', '2021-04-17 19:07:08', NULL, 'PRD-0003', NULL, 0, 0, 'bom', '2021-04-17 04:16:10', '2021-04-17 19:07:08'),
('TRX-BOM-000000004', '2021-04-20 13:53:28', NULL, 'PRD-0003', NULL, 0, 0, 'bom', '2021-04-17 19:07:31', '2021-04-20 13:53:28'),
('TRX-BOM-000000005', '2021-04-20 13:51:29', NULL, 'PRD-0004', NULL, 0, 0, 'bom', '2021-04-20 13:51:29', NULL),
('TRX-PMB-000000001', '2020-11-21 17:16:15', NULL, NULL, NULL, 8740000, 1, 'purchasing', '2020-11-21 15:40:44', '2020-11-21 17:16:15'),
('TRX-PMB-000000002', '2020-11-21 17:24:25', NULL, NULL, NULL, 1800000, 1, 'purchasing', '2020-11-21 17:24:09', '2020-11-21 17:24:25'),
('TRX-PMB-000000003', '2020-11-21 17:28:00', NULL, NULL, NULL, 460000, 1, 'purchasing', '2020-11-21 17:27:32', '2020-11-21 17:28:00'),
('TRX-PMB-000000004', '2020-11-21 17:40:02', NULL, NULL, NULL, 230000, 1, 'purchasing', '2020-11-21 17:37:09', '2020-11-21 17:40:02'),
('TRX-PSN-000000001', '2020-11-21 17:37:39', 'CUS-0003', NULL, '0000-00-00', 43200000, 0, 'order', '2020-11-21 17:37:39', NULL),
('TRX-PSN-000000002', '2020-11-21 17:56:57', 'CUS-0002', NULL, '0000-00-00', 660000, 0, 'order', '2020-11-21 17:56:57', NULL);

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
  ADD KEY `bill_of_materials_ibfk_3` (`trans_id`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `oc_id` (`oc_id`);

--
-- Indexes for table `chart_of_accounts`
--
ALTER TABLE `chart_of_accounts`
  ADD PRIMARY KEY (`account_no`),
  ADD KEY `sub_code` (`sub_code`);

--
-- Indexes for table `coa_head`
--
ALTER TABLE `coa_head`
  ADD PRIMARY KEY (`head_code`);

--
-- Indexes for table `coa_subhead`
--
ALTER TABLE `coa_subhead`
  ADD PRIMARY KEY (`sub_code`),
  ADD KEY `head_code` (`head_code`);

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
  ADD KEY `account_no` (`account_no`),
  ADD KEY `trans_id` (`trans_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `orders_ibfk_1` (`trans_id`);

--
-- Indexes for table `overhead_component`
--
ALTER TABLE `overhead_component`
  ADD PRIMARY KEY (`oc_id`);

--
-- Indexes for table `overhead_cost`
--
ALTER TABLE `overhead_cost`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oc_id` (`oc_id`),
  ADD KEY `trans_id` (`trans_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `payments_ibfk_1` (`trans_id`);

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
  MODIFY `bom_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `direct_labor_costs`
--
ALTER TABLE `direct_labor_costs`
  MODIFY `direct_labor_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `general_ledger`
--
ALTER TABLE `general_ledger`
  MODIFY `gl_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `overhead_cost`
--
ALTER TABLE `overhead_cost`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `production_costs`
--
ALTER TABLE `production_costs`
  MODIFY `cost_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `purchase_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  ADD CONSTRAINT `bill_of_materials_ibfk_3` FOREIGN KEY (`trans_id`) REFERENCES `transactions` (`trans_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bill_of_materials_ibfk_4` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`employee_id`),
  ADD CONSTRAINT `bill_of_materials_ibfk_5` FOREIGN KEY (`oc_id`) REFERENCES `overhead_component` (`oc_id`);

--
-- Constraints for table `chart_of_accounts`
--
ALTER TABLE `chart_of_accounts`
  ADD CONSTRAINT `chart_of_accounts_ibfk_1` FOREIGN KEY (`sub_code`) REFERENCES `coa_subhead` (`sub_code`);

--
-- Constraints for table `coa_subhead`
--
ALTER TABLE `coa_subhead`
  ADD CONSTRAINT `coa_subhead_ibfk_1` FOREIGN KEY (`head_code`) REFERENCES `coa_head` (`head_code`);

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
  ADD CONSTRAINT `general_ledger_ibfk_2` FOREIGN KEY (`account_no`) REFERENCES `chart_of_accounts` (`account_no`),
  ADD CONSTRAINT `general_ledger_ibfk_3` FOREIGN KEY (`trans_id`) REFERENCES `transactions` (`trans_id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`trans_id`) REFERENCES `transactions` (`trans_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `overhead_cost`
--
ALTER TABLE `overhead_cost`
  ADD CONSTRAINT `overhead_cost_ibfk_1` FOREIGN KEY (`oc_id`) REFERENCES `overhead_component` (`oc_id`),
  ADD CONSTRAINT `overhead_cost_ibfk_2` FOREIGN KEY (`trans_id`) REFERENCES `transactions` (`trans_id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`trans_id`) REFERENCES `transactions` (`trans_id`) ON DELETE CASCADE;

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
