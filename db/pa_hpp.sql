-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jul 03, 2021 at 01:34 AM
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
  `unit` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bill_of_materials`
--

INSERT INTO `bill_of_materials` (`bom_id`, `trans_id`, `material_id`, `qty`, `unit`) VALUES
(1, 'TRX-BOM-000000001', 'MTR-0001', 0.5, NULL),
(2, 'TRX-BOM-000000001', 'MTR-0008', 1, NULL),
(3, 'TRX-BOM-000000001', 'MTR-0005', 0.5, NULL),
(4, 'TRX-BOM-000000002', 'MTR-0001', 1, NULL),
(5, 'TRX-BOM-000000002', 'MTR-0008', 1, NULL),
(6, 'TRX-BOM-000000002', 'MTR-0005', 1, NULL),
(7, 'TRX-BOM-000000003', 'MTR-0001', 0.75, NULL),
(8, 'TRX-BOM-000000003', 'MTR-0008', 1, NULL),
(9, 'TRX-BOM-000000003', 'MTR-0005', 0.75, NULL),
(10, 'TRX-BOM-000000004', 'MTR-0001', 0.6, NULL),
(11, 'TRX-BOM-000000004', 'MTR-0008', 1, NULL),
(12, 'TRX-BOM-000000004', 'MTR-0005', 0.6, NULL),
(13, 'TRX-BOM-000000005', 'MTR-0004', 1, NULL),
(14, 'TRX-BOM-000000005', 'MTR-0008', 1, NULL),
(15, 'TRX-BOM-000000005', 'MTR-0005', 1, NULL),
(16, 'TRX-BOM-000000006', 'MTR-0004', 1.5, NULL),
(17, 'TRX-BOM-000000006', 'MTR-0005', 1.5, NULL),
(18, 'TRX-BOM-000000006', 'MTR-0008', 1, NULL),
(19, 'TRX-BOM-000000007', 'MTR-0004', 1.75, NULL),
(20, 'TRX-BOM-000000007', 'MTR-0005', 2, NULL),
(21, 'TRX-BOM-000000007', 'MTR-0008', 1, NULL),
(22, 'TRX-BOM-000000008', 'MTR-0001', 2, NULL),
(23, 'TRX-BOM-000000008', 'MTR-0005', 3, NULL),
(24, 'TRX-BOM-000000008', 'MTR-0008', 3, NULL),
(25, 'TRX-BOM-000000009', 'MTR-0001', 3, NULL),
(26, 'TRX-BOM-000000009', 'MTR-0005', 4, NULL),
(27, 'TRX-BOM-000000009', 'MTR-0008', 3, NULL),
(28, 'TRX-BOM-000000010', 'MTR-0001', 4, NULL),
(29, 'TRX-BOM-000000010', 'MTR-0005', 4, NULL),
(30, 'TRX-BOM-000000010', 'MTR-0008', 3, NULL),
(31, 'TRX-BOM-000000011', 'MTR-0004', 1, NULL),
(32, 'TRX-BOM-000000011', 'MTR-0005', 1, NULL),
(33, 'TRX-BOM-000000011', 'MTR-0008', 1, NULL),
(34, 'TRX-BOM-000000012', 'MTR-0004', 0.5, NULL),
(35, 'TRX-BOM-000000012', 'MTR-0005', 0.5, NULL),
(36, 'TRX-BOM-000000012', 'MTR-0008', 1, NULL);

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

--
-- Dumping data for table `direct_labor_costs`
--

INSERT INTO `direct_labor_costs` (`direct_labor_id`, `trans_id`, `employee_id`, `cost`) VALUES
(14, 'TRX-PRD-000000001', 'KAR-0001', 5000000),
(15, 'TRX-PRD-000000001', 'KAR-0002', 6500000),
(16, 'TRX-PRD-000000001', 'KAR-0004', 5000000),
(17, 'TRX-PRD-000000002', 'KAR-0001', 200000),
(18, 'TRX-PRD-000000002', 'KAR-0002', 250000),
(19, 'TRX-PRD-000000003', 'KAR-0001', 150000),
(20, 'TRX-PRD-000000003', 'KAR-0002', 250000);

-- --------------------------------------------------------

--
-- Table structure for table `direct_material_cost`
--

CREATE TABLE `direct_material_cost` (
  `id` int(11) NOT NULL,
  `material_id` varchar(20) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `trans_id` varchar(50) DEFAULT NULL,
  `type` varchar(150) DEFAULT NULL,
  `unit_price` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `direct_material_cost`
--

INSERT INTO `direct_material_cost` (`id`, `material_id`, `qty`, `trans_id`, `type`, `unit_price`) VALUES
(32, 'MTR-0001', 500, 'TRX-PRD-000000001', 'BBB', 15000),
(33, 'MTR-0008', 1000, 'TRX-PRD-000000001', 'BBP', 375),
(34, 'MTR-0005', 500, 'TRX-PRD-000000001', 'BBB', 4000),
(35, 'MTR-0004', 500, 'TRX-PRD-000000001', 'BBB', 12500),
(36, 'MTR-0008', 500, 'TRX-PRD-000000001', 'BBP', 375),
(37, 'MTR-0005', 500, 'TRX-PRD-000000001', 'BBB', 4000),
(38, 'MTR-0001', 10, 'TRX-PRD-000000002', 'BBB', 15000),
(39, 'MTR-0008', 20, 'TRX-PRD-000000002', 'BBP', 375),
(40, 'MTR-0005', 10, 'TRX-PRD-000000002', 'BBB', 4000),
(41, 'MTR-0001', 30, 'TRX-PRD-000000003', 'BBB', 15000),
(42, 'MTR-0005', 40, 'TRX-PRD-000000003', 'BBB', 4000),
(43, 'MTR-0008', 30, 'TRX-PRD-000000003', 'BBP', 375);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `employee_id` varchar(50) NOT NULL,
  `employee_name` varchar(100) NOT NULL,
  `employee_address` text NOT NULL,
  `employee_phone` varchar(13) NOT NULL,
  `department` varchar(100) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`employee_id`, `employee_name`, `employee_address`, `employee_phone`, `department`, `status`, `date_created`, `date_updated`) VALUES
('KAR-0001', 'Kang Dandang Suherman', 'Bandung Juara', '087780087787', 'Potong Kain', 1, '2020-11-17 16:31:39', '2021-06-16 09:01:08'),
('KAR-0002', 'Neng Sulisa Tisna', 'Bandung Bermartabat', '085585850858', 'Jahit', 1, '2020-11-17 16:34:30', '2021-06-16 09:00:55'),
('KAR-0003', 'Ujang Doni Maulana', 'Bandung Kota Kembang', '081558855288', 'Potong Kain', 1, '2020-11-17 16:56:03', '2021-06-16 09:00:37'),
('KAR-0004', 'Teh Tia', 'Bojongsoang', '085145645545', 'Obras', 1, '2021-06-16 08:59:31', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `general_ledger`
--

CREATE TABLE `general_ledger` (
  `gl_id` bigint(20) NOT NULL,
  `account_no` varchar(20) NOT NULL,
  `periode` int(11) NOT NULL,
  `gl_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `trans_id` varchar(50) NOT NULL,
  `nominal` double NOT NULL,
  `gl_balance` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `general_ledger`
--

INSERT INTO `general_ledger` (`gl_id`, `account_no`, `periode`, `gl_date`, `trans_id`, `nominal`, `gl_balance`) VALUES
(47, '1-10003', 202107, '2021-07-02 06:21:26', 'TRX-PMB-000000001', 17750000, 'd'),
(48, '1-10004', 202107, '2021-07-02 06:21:26', 'TRX-PMB-000000001', 3000000, 'd'),
(49, '1-10001', 202107, '2021-07-02 06:21:26', 'TRX-PMB-000000001', 20750000, 'k'),
(50, '1-10003', 202107, '2021-07-02 07:49:08', 'TRX-PMB-000000002', 2750000, 'd'),
(51, '1-10004', 202107, '2021-07-02 07:49:08', 'TRX-PMB-000000002', 500000, 'd'),
(52, '1-10001', 202107, '2021-07-02 07:49:08', 'TRX-PMB-000000002', 3250000, 'k'),
(70, '1-10001', 202107, '2021-07-02 15:32:05', 'TRX-PSN-000000001', 45000000, 'd'),
(71, '2-10001', 202107, '2021-07-02 15:32:05', 'TRX-PSN-000000001', 45000000, 'k'),
(72, '2-10001', 202107, '2021-07-02 15:33:39', 'TRX-PRD-000000001', 45000000, 'd'),
(73, '1-10002', 202107, '2021-07-02 15:33:39', 'TRX-PRD-000000001', 40000000, 'd'),
(74, '4-10001', 202107, '2021-07-02 15:33:39', 'TRX-PRD-000000001', 85000000, 'k'),
(75, '5-20001', 202107, '2021-07-02 15:33:39', 'TRX-PRD-000000001', 17750000, 'd'),
(76, '1-10003', 202107, '2021-07-02 15:33:39', 'TRX-PRD-000000001', 17750000, 'k'),
(77, '5-20004', 202107, '2021-07-02 15:33:39', 'TRX-PRD-000000001', 562500, 'd'),
(78, '1-10004', 202107, '2021-07-02 15:33:39', 'TRX-PRD-000000001', 562500, 'k'),
(79, '5-20003', 202107, '2021-07-02 15:33:39', 'TRX-PRD-000000001', 12062500, 'd'),
(80, '5-20005', 202107, '2021-07-02 15:33:39', 'TRX-PRD-000000001', 12062500, 'k'),
(81, '1-10005', 202107, '2021-07-02 15:33:39', 'TRX-PRD-000000001', 46312500, 'd'),
(82, '5-20001', 202107, '2021-07-02 15:33:39', 'TRX-PRD-000000001', 17750000, 'k'),
(83, '5-20002', 202107, '2021-07-02 15:33:39', 'TRX-PRD-000000001', 16500000, 'k'),
(84, '5-20003', 202107, '2021-07-02 15:33:39', 'TRX-PRD-000000001', 12062500, 'k'),
(85, '1-10001', 202107, '2021-07-02 16:13:59', 'TRX-PSN-000000002', 500000, 'd'),
(86, '2-10001', 202107, '2021-07-02 16:13:59', 'TRX-PSN-000000002', 500000, 'k'),
(87, '2-10001', 202107, '2021-07-02 16:14:51', 'TRX-PRD-000000002', 500000, 'd'),
(88, '1-10002', 202107, '2021-07-02 16:14:51', 'TRX-PRD-000000002', 600000, 'd'),
(89, '4-10001', 202107, '2021-07-02 16:14:51', 'TRX-PRD-000000002', 1100000, 'k'),
(90, '5-20001', 202107, '2021-07-02 16:14:51', 'TRX-PRD-000000002', 190000, 'd'),
(91, '1-10003', 202107, '2021-07-02 16:14:51', 'TRX-PRD-000000002', 190000, 'k'),
(92, '5-20004', 202107, '2021-07-02 16:14:51', 'TRX-PRD-000000002', 7500, 'd'),
(93, '1-10004', 202107, '2021-07-02 16:14:51', 'TRX-PRD-000000002', 7500, 'k'),
(94, '5-20003', 202107, '2021-07-02 16:14:51', 'TRX-PRD-000000002', 14500, 'd'),
(95, '5-20005', 202107, '2021-07-02 16:14:51', 'TRX-PRD-000000002', 14500, 'k'),
(96, '1-10005', 202107, '2021-07-02 16:14:51', 'TRX-PRD-000000002', 654500, 'd'),
(97, '5-20001', 202107, '2021-07-02 16:14:51', 'TRX-PRD-000000002', 190000, 'k'),
(98, '5-20002', 202107, '2021-07-02 16:14:51', 'TRX-PRD-000000002', 450000, 'k'),
(99, '5-20003', 202107, '2021-07-02 16:14:51', 'TRX-PRD-000000002', 14500, 'k'),
(100, '1-10001', 202107, '2021-07-02 16:19:22', 'TRX-PSN-000000003', 250000, 'd'),
(101, '2-10001', 202107, '2021-07-02 16:19:22', 'TRX-PSN-000000003', 250000, 'k'),
(102, '2-10001', 202107, '2021-07-02 16:20:04', 'TRX-PRD-000000003', 250000, 'd'),
(103, '1-10002', 202107, '2021-07-02 16:20:04', 'TRX-PRD-000000003', 950000, 'd'),
(104, '4-10001', 202107, '2021-07-02 16:20:04', 'TRX-PRD-000000003', 1200000, 'k'),
(105, '5-20001', 202107, '2021-07-02 16:20:04', 'TRX-PRD-000000003', 610000, 'd'),
(106, '1-10003', 202107, '2021-07-02 16:20:04', 'TRX-PRD-000000003', 610000, 'k'),
(107, '5-20004', 202107, '2021-07-02 16:20:04', 'TRX-PRD-000000003', 11250, 'd'),
(108, '1-10004', 202107, '2021-07-02 16:20:04', 'TRX-PRD-000000003', 11250, 'k'),
(109, '5-20003', 202107, '2021-07-02 16:20:04', 'TRX-PRD-000000003', 18250, 'd'),
(110, '5-20005', 202107, '2021-07-02 16:20:04', 'TRX-PRD-000000003', 18250, 'k'),
(111, '1-10005', 202107, '2021-07-02 16:20:04', 'TRX-PRD-000000003', 1028250, 'd'),
(112, '5-20001', 202107, '2021-07-02 16:20:04', 'TRX-PRD-000000003', 610000, 'k'),
(113, '5-20002', 202107, '2021-07-02 16:20:04', 'TRX-PRD-000000003', 400000, 'k'),
(114, '5-20003', 202107, '2021-07-02 16:20:04', 'TRX-PRD-000000003', 18250, 'k');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` bigint(20) NOT NULL,
  `trans_id` varchar(50) NOT NULL,
  `product_id` varchar(50) NOT NULL,
  `order_size` varchar(50) DEFAULT NULL,
  `order_qty` varchar(20) NOT NULL,
  `order_price` int(11) NOT NULL,
  `order_total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `trans_id`, `product_id`, `order_size`, `order_qty`, `order_price`, `order_total`) VALUES
(30, 'TRX-PSN-000000001', 'PRD-0001', 'M', '1000', 55000, 55000000),
(31, 'TRX-PSN-000000001', 'PRD-0002', 'M', '500', 60000, 30000000),
(32, 'TRX-PSN-000000002', 'PRD-0001', 'M', '20', 55000, 1100000),
(33, 'TRX-PSN-000000003', 'PRD-0003', 'L', '10', 120000, 1200000);

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

--
-- Dumping data for table `overhead_cost`
--

INSERT INTO `overhead_cost` (`id`, `trans_id`, `oc_id`, `overhead_cost`) VALUES
(18, 'TRX-PRD-000000001', 'OV01', 5000000),
(19, 'TRX-PRD-000000001', 'OV02', 3000000),
(20, 'TRX-PRD-000000001', 'OV03', 2500000),
(21, 'TRX-PRD-000000001', 'OV04', 1000000),
(22, 'TRX-PRD-000000002', 'OV03', 7000),
(23, 'TRX-PRD-000000003', 'OV03', 7000);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` bigint(20) NOT NULL,
  `trans_id` varchar(50) NOT NULL,
  `periode` int(11) NOT NULL,
  `nominal` double NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `trans_id`, `periode`, `nominal`, `description`) VALUES
(15, 'TRX-PSN-000000001', 202107, 45000000, 'Down Payment (DP)'),
(16, 'TRX-PSN-000000002', 202107, 500000, 'Down Payment (DP)'),
(17, 'TRX-PSN-000000003', 202107, 250000, 'Down Payment (DP)');

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

--
-- Dumping data for table `production_costs`
--

INSERT INTO `production_costs` (`cost_id`, `trans_id`, `material_cost`, `direct_labor_cost`, `overhead_cost`) VALUES
(8, 'TRX-PRD-000000001', 17750000, 16500000, 12062500),
(9, 'TRX-PRD-000000002', 190000, 450000, 14500),
(10, 'TRX-PRD-000000003', 610000, 400000, 18250);

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
(8, 'TRX-PMB-000000001', 'MTR-0001', 500, 15000),
(9, 'TRX-PMB-000000001', 'MTR-0004', 500, 12500),
(10, 'TRX-PMB-000000001', 'MTR-0005', 1000, 4000),
(11, 'TRX-PMB-000000001', 'MTR-0008', 12000, 250),
(12, 'TRX-PMB-000000002', 'MTR-0001', 100, 15000),
(13, 'TRX-PMB-000000002', 'MTR-0004', 100, 12500),
(14, 'TRX-PMB-000000002', 'MTR-0008', 1000, 500);

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
  `periode` int(11) DEFAULT NULL,
  `description` text,
  `trans_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `customer_id` varchar(20) DEFAULT NULL,
  `product_id` varchar(50) DEFAULT NULL,
  `order_done` date DEFAULT NULL,
  `production_step` int(11) DEFAULT NULL,
  `ref_production` varchar(50) DEFAULT NULL,
  `trans_total` double NOT NULL,
  `dp` double DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1' COMMENT '1 = Aktif, 0 Tidak Aktif',
  `status_production` int(11) DEFAULT NULL COMMENT '0 Belum Produksi, 1 Dalam Produksi, 3 Sudah Produksi',
  `lock_doc` int(11) NOT NULL DEFAULT '1' COMMENT '0: Lock,1 : Open',
  `trans_type` varchar(100) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`trans_id`, `periode`, `description`, `trans_date`, `customer_id`, `product_id`, `order_done`, `production_step`, `ref_production`, `trans_total`, `dp`, `status`, `status_production`, `lock_doc`, `trans_type`, `date_created`, `updated_at`) VALUES
('TRX-BOM-000000001', 202107, 'Bom Kaos Anak', '2021-07-01 06:14:41', NULL, 'PRD-0001', NULL, NULL, NULL, 0, NULL, 1, NULL, 1, 'bom', '2021-07-01 03:59:38', NULL),
('TRX-BOM-000000002', 202107, 'Bom Kaos Anak Ukuran XXL', '2021-07-01 05:28:48', NULL, 'PRD-0001', NULL, NULL, NULL, 0, NULL, 1, NULL, 1, 'bom', '2021-07-01 04:00:45', NULL),
('TRX-BOM-000000003', 202107, 'Bom Kaos Anak Ukuran XL', '2021-07-01 05:28:48', NULL, 'PRD-0001', NULL, NULL, NULL, 0, NULL, 1, NULL, 1, 'bom', '2021-07-01 04:01:53', NULL),
('TRX-BOM-000000004', 202107, 'Bom Kaos Anak Ukuran L', '2021-07-01 05:28:48', NULL, 'PRD-0001', NULL, NULL, NULL, 0, NULL, 1, NULL, 1, 'bom', '2021-07-01 04:02:46', NULL),
('TRX-BOM-000000005', 202107, 'Bom Kaos Dewasa Ukuran M', '2021-07-01 05:28:48', NULL, 'PRD-0002', NULL, NULL, NULL, 0, NULL, 1, NULL, 1, 'bom', '2021-07-01 04:04:17', NULL),
('TRX-BOM-000000006', 202107, 'Bom Kaos Dewasa Ukuran XL', '2021-07-01 05:28:48', NULL, 'PRD-0002', NULL, NULL, NULL, 0, NULL, 1, NULL, 1, 'bom', '2021-07-01 04:07:01', NULL),
('TRX-BOM-000000007', 202107, 'Bom Kaos Dewasa Ukuran XXL', '2021-07-01 05:28:48', NULL, 'PRD-0002', NULL, NULL, NULL, 0, NULL, 1, NULL, 1, 'bom', '2021-07-01 04:07:57', NULL),
('TRX-BOM-000000008', 202107, 'Bom Seragam Olahraga SD Ukuran M', '2021-07-01 05:28:48', NULL, 'PRD-0003', NULL, NULL, NULL, 0, NULL, 1, NULL, 1, 'bom', '2021-07-01 04:13:19', NULL),
('TRX-BOM-000000009', 202107, 'Bom Seragam Olahraga Ukuran L', '2021-07-02 16:20:04', NULL, 'PRD-0003', NULL, NULL, NULL, 0, NULL, 1, NULL, 0, 'bom', '2021-07-01 04:14:25', '2021-07-02 16:20:04'),
('TRX-BOM-000000010', 202107, 'BOM Seragam Olahraga Ukuran XL', '2021-07-01 05:28:48', NULL, 'PRD-0003', NULL, NULL, NULL, 0, NULL, 1, NULL, 1, 'bom', '2021-07-01 04:15:42', NULL),
('TRX-BOM-000000011', 202107, 'Bom Kaos Polos All Size', '2021-07-01 05:28:48', NULL, 'PRD-0004', NULL, NULL, NULL, 0, NULL, 1, NULL, 1, 'bom', '2021-07-01 04:54:04', NULL),
('TRX-BOM-000000012', 202107, 'BOM Kaos Polos Ukruan S', '2021-07-02 08:50:29', NULL, 'PRD-0004', NULL, NULL, NULL, 0, NULL, 1, NULL, 1, 'bom', '2021-07-02 08:46:00', NULL),
('TRX-PMB-000000001', 202107, NULL, '2021-07-02 06:21:26', NULL, NULL, NULL, NULL, NULL, 20750000, NULL, 1, NULL, 1, 'purchasing', '2021-07-02 06:19:40', '2021-07-02 06:21:26'),
('TRX-PMB-000000002', 202107, NULL, '2021-07-02 07:49:08', NULL, NULL, NULL, NULL, NULL, 3250000, NULL, 1, NULL, 1, 'purchasing', '2021-07-02 07:30:45', '2021-07-02 07:49:08'),
('TRX-PRD-000000001', 202107, 'Produksi 1', '2021-07-01 17:00:00', NULL, NULL, NULL, NULL, 'TRX-PSN-000000001', 46312500, NULL, 1, NULL, 0, 'production', '2021-07-02 15:33:39', NULL),
('TRX-PRD-000000002', 202107, 'Produksi 2', '2021-07-01 17:00:00', NULL, NULL, NULL, NULL, 'TRX-PSN-000000002', 654500, NULL, 1, NULL, 0, 'production', '2021-07-02 16:14:51', NULL),
('TRX-PRD-000000003', 202107, 'Produksi 3', '2021-07-01 17:00:00', NULL, NULL, NULL, NULL, 'TRX-PSN-000000003', 1028250, NULL, 1, NULL, 0, 'production', '2021-07-02 16:20:03', NULL),
('TRX-PSN-000000001', 202107, 'Pesanan 1', '2021-07-02 15:33:39', 'CUS-0003', NULL, '0000-00-00', NULL, NULL, 85000000, 45000000, 1, 3, 0, 'order', '2021-07-02 15:32:05', '2021-07-02 15:33:39'),
('TRX-PSN-000000002', 202107, 'Pesanan 2', '2021-07-02 16:14:51', 'CUS-0002', NULL, '0000-00-00', NULL, NULL, 1100000, 500000, 1, 3, 0, 'order', '2021-07-02 16:13:59', '2021-07-02 16:14:51'),
('TRX-PSN-000000003', 202107, 'Produksi 3', '2021-07-02 16:20:03', 'CUS-0002', NULL, '0000-00-00', NULL, NULL, 1200000, 250000, 1, 3, 0, 'order', '2021-07-02 16:19:22', '2021-07-02 16:20:03');

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
  ADD KEY `bill_of_materials_ibfk_3` (`trans_id`);

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
-- Indexes for table `direct_material_cost`
--
ALTER TABLE `direct_material_cost`
  ADD PRIMARY KEY (`id`),
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
  MODIFY `bom_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `direct_labor_costs`
--
ALTER TABLE `direct_labor_costs`
  MODIFY `direct_labor_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `direct_material_cost`
--
ALTER TABLE `direct_material_cost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `general_ledger`
--
ALTER TABLE `general_ledger`
  MODIFY `gl_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `overhead_cost`
--
ALTER TABLE `overhead_cost`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `production_costs`
--
ALTER TABLE `production_costs`
  MODIFY `cost_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `purchase_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
  ADD CONSTRAINT `bill_of_materials_ibfk_3` FOREIGN KEY (`trans_id`) REFERENCES `transactions` (`trans_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `direct_labor_costs_ibfk_2` FOREIGN KEY (`trans_id`) REFERENCES `transactions` (`trans_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `direct_material_cost`
--
ALTER TABLE `direct_material_cost`
  ADD CONSTRAINT `direct_material_cost_ibfk_1` FOREIGN KEY (`trans_id`) REFERENCES `transactions` (`trans_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `general_ledger`
--
ALTER TABLE `general_ledger`
  ADD CONSTRAINT `general_ledger_ibfk_2` FOREIGN KEY (`account_no`) REFERENCES `chart_of_accounts` (`account_no`),
  ADD CONSTRAINT `general_ledger_ibfk_3` FOREIGN KEY (`trans_id`) REFERENCES `transactions` (`trans_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`trans_id`) REFERENCES `transactions` (`trans_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `overhead_cost`
--
ALTER TABLE `overhead_cost`
  ADD CONSTRAINT `overhead_cost_ibfk_1` FOREIGN KEY (`oc_id`) REFERENCES `overhead_component` (`oc_id`),
  ADD CONSTRAINT `overhead_cost_ibfk_2` FOREIGN KEY (`trans_id`) REFERENCES `transactions` (`trans_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`trans_id`) REFERENCES `transactions` (`trans_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `production_costs`
--
ALTER TABLE `production_costs`
  ADD CONSTRAINT `production_costs_ibfk_1` FOREIGN KEY (`trans_id`) REFERENCES `transactions` (`trans_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `purchase`
--
ALTER TABLE `purchase`
  ADD CONSTRAINT `purchase_ibfk_1` FOREIGN KEY (`trans_id`) REFERENCES `transactions` (`trans_id`) ON DELETE CASCADE ON UPDATE CASCADE,
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
