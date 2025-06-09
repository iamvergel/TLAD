-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2025 at 05:30 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tala`
--

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `name`) VALUES
(1, 'MCC CLUSTER DIVISION'),
(2, 'HOPPS DIVISION'),
(3, 'ALLIED DIVISION'),
(4, 'NURSING DIVISION'),
(5, 'FINANCE DIVISION'),
(6, 'MEDICAL DIVISION');

-- --------------------------------------------------------

--
-- Table structure for table `mail_settings`
--

CREATE TABLE `mail_settings` (
  `id` int(11) NOT NULL,
  `host` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mail_settings`
--

INSERT INTO `mail_settings` (`id`, `host`, `username`, `password`, `created_at`) VALUES
(1, 'smtp.gmail.com', 'PETRU081997@gmail.com', 'ohermrxcwhcuszet', '2025-01-14 03:54:28');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` bigint(20) NOT NULL,
  `patient_id` bigint(20) NOT NULL,
  `doc_id` bigint(20) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `seen_status` int(1) NOT NULL COMMENT '0=not seen, 1=seen',
  `type` int(1) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `system_details`
--

CREATE TABLE `system_details` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `days` varchar(255) NOT NULL,
  `openhr` varchar(50) NOT NULL,
  `closehr` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `telno` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `facebook` varchar(255) NOT NULL,
  `map` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_details`
--

INSERT INTO `system_details` (`id`, `name`, `days`, `openhr`, `closehr`, `address`, `telno`, `email`, `mobile`, `facebook`, `map`, `logo`, `brand`) VALUES
(1, 'DJNRMHS - PETRU', '1,2,3,4,5', '8:00 AM', '5:00 PM', 'System Address', '+639952350999', 'PETRU081997@gmail.com', '+639952350999', 'https://www.facebook.com/PETRU.DJNRMHS/', 'https://goo.gl/maps/AJx8wi8tU4TNuNh16', '1739028210.jpg', '1739500780.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `status` tinyint(2) NOT NULL,
  `verify_token` varchar(255) NOT NULL,
  `verify_status` tinyint(2) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`id`, `name`, `address`, `phone`, `email`, `image`, `password`, `role`, `status`, `verify_token`, `verify_status`, `created_at`) VALUES
(1, 'Angelica faye', 'PETRU', '+639999999999', 'admin@gmail.com', '1739028194.jpg', '$2y$10$ovSBMnrKAE/MENpdZpVMe.Xf/qeZeldHbdL5NP.10gNwe/rtmMJgi', 'admin', 1, '', 1, '2022-11-02 05:49:00');

-- --------------------------------------------------------

--
-- Table structure for table `tblcoordinator`
--

CREATE TABLE `tblcoordinator` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `dob` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `image` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(191) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT 1,
  `verify_token` varchar(255) NOT NULL,
  `verify_status` tinyint(2) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL,
  `division_id` int(11) DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `unit_section_head_name` varchar(255) DEFAULT NULL,
  `unit_section_head_title` varchar(255) DEFAULT NULL,
  `division_head_name` varchar(255) DEFAULT NULL,
  `division_head_position` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblcoordinator`
--

INSERT INTO `tblcoordinator` (`id`, `name`, `dob`, `address`, `gender`, `phone`, `email`, `image`, `password`, `role`, `status`, `verify_token`, `verify_status`, `created_at`, `division_id`, `unit_id`, `unit_section_head_name`, `unit_section_head_title`, `division_head_name`, `division_head_position`) VALUES
(4, 'Coordinator', '08/31/2001', 'tala caloocan city', 'Male', '+639363007584', 'coordinator@gmail.com', '1739028721.jpg', '$2y$10$ul5bG21hlLAlqrW4XLbpue.XmWIsXoGT1HxrUVhRW5l1F8bpC/a6G', 'coordinator', 1, '', 0, '2025-01-15 11:51:57', 1, 24, 'Sample', 'Sample', 'Sample', 'Sample'),
(7, 'MCC OFFICE', '', 'MCC OFFICE', '', '+639000000001', 'mccoffice@gmail.com', '1739171618.jpg', '$2y$10$CgeURYlR/HtxhZN8MONW/eukmDGRf.ZB6pDtc9rplKt/.98kxk4Lq', 'coordinator', 1, '', 0, '2025-02-10 15:13:38', 1, 1, 'MCC OFFICE', 'MCC OFFICE', 'MCC OFFICE', 'MCC OFFICE'),
(8, 'HESU', '', 'HESU', '', '+639000000000', 'hesu@gmail.com', '1739171914.jpg', '$2y$10$LgEXrWfYVbckYiwzMzbPLuOv4PO1g1z4C0W5u2scmlXPnCK.6cY2y', 'coordinator', 1, '', 0, '2025-02-10 15:18:34', 1, 2, 'HESU', 'HESU', 'HESU', 'HESU'),
(9, 'SQMS', '', 'SQMS', '', '+639000000000', 'sqms@gmail.com', '1739172050.jpg', '$2y$10$ERqniGpUxIjsy/X5p9pwNuKhb1VU6JKaqhHN2hPKsICKa2dIkiqjy', 'coordinator', 1, '', 0, '2025-02-10 15:20:50', 1, 3, 'SQMS', 'SQMS', 'SQMS', 'SQMS'),
(10, 'PHU', '', 'PHU', '', '+639000000000', 'phu@gmail.com', '1739172262.jpg', '$2y$10$oAbf2DjeYoEtXVdaJ5G/aeZ.nm5KwKK3jeILA83krUPPCo0TOT1sC', 'coordinator', 1, '', 0, '2025-02-10 15:24:22', 1, 5, 'PHU', 'PHU', 'PHU', 'PHU'),
(11, 'LEGAL', '', 'LEGAL', '', '+639000000000', 'legal@gmail.com', '1739172333.jpg', '$2y$10$y5MYZsfD2Xw.XlkejhvniecLsmQv5oy5GRYwxLotaEzSASLvXcjuS', 'coordinator', 1, '', 0, '2025-02-10 15:25:33', 1, 6, 'LEGAL', 'LEGAL', 'LEGAL', 'LEGAL'),
(12, 'PACU', '', 'PACU', '', '+639000000000', 'pacu@gmail.com', '1739172396.jpg', '$2y$10$B2A2Gbav2.XPbm2/qmRMjuggAY4tQE7N8Y6ALTg62lB.6N/u5n2SW', 'coordinator', 1, '', 0, '2025-02-10 15:26:36', 1, 7, 'PACU', 'PACU', 'PACU', 'PACU'),
(13, 'HEMS', '', 'HEMS', '', '+639000000000', 'hems@gmail.com', '1739172551.jpg', '$2y$10$OyrqefKFqSwgpsCCSwNEguZV32IHMWcoE/MJMxWXQTyB9HYec3pf.', 'coordinator', 1, '', 0, '2025-02-10 15:29:11', 1, 8, 'HEMS', 'HEMS', 'HEMS', 'HEMS'),
(14, 'PETRU', '', 'PETRU', '', '+639000000000', 'petru@gmail.com', '1739172684.jpg', '$2y$10$vNIx1MKEtxCdbZq785y6uela0WSdG632CE2Pc1U64ZcZvGceAnsM.', 'coordinator', 1, '', 0, '2025-02-10 15:31:24', 1, 24, 'PETRU', 'PETRU', 'PETRU', 'PETRU'),
(15, 'IREB', '', 'IREB', '', '+639000000000', 'ireb@gmail.com', '1739172783.jpg', '$2y$10$Z1YWHZi4ajWxYhp2Nhrxr.nvhZEHqaqIYfASxAfbT2LOC7/gyP3JG', 'coordinator', 1, '', 0, '2025-02-10 15:33:03', 1, 34, 'IREB', 'IREB', 'IREB', 'IREB'),
(16, 'IHOMP', '', 'IHOMP', '', '+639000000000', 'ihomp@gmail.com', '1739172960.jpg', '$2y$10$4w5haYNKLXvGiBK71DAo0uf70gIaVDCidrmf/1lupdbdas7YNL2/W', 'coordinator', 1, '', 0, '2025-02-10 15:36:00', 1, 35, 'IHOMP', 'IHOMP', 'IHOMP', 'IHOMP'),
(17, 'IHOMS', '', 'IHOMS', '', '+639000000000', 'ihoms@gmail.com', '1739173438.jpg', '$2y$10$JrKCcq733c5ExzCUw73XO.oa1hRk8Ti1BBZBA9NtvSCeUvBm9uEIG', 'coordinator', 1, '', 0, '2025-02-10 15:43:58', 2, 4, 'IHOMS', 'IHOMS', 'IHOMS', 'IHOMS'),
(18, 'TIMEKEEPING UNIT', '', 'TIMEKEEPING UNIT', '', '+639000000000', 'timekeeping@gmail.com', '1739173739.jpg', '$2y$10$bodki2FQM3Ew3tgp5xMC2OLYllz3vxJ41ikucwWLWYlZf/MeE8AEm', 'coordinator', 1, '', 0, '2025-02-10 15:48:58', 2, 26, 'TIMEKEEPING UNIT', 'TIMEKEEPING UNIT', 'TIMEKEEPING UNIT', 'TIMEKEEPING UNIT'),
(19, 'PROCUREMENT', '', 'PROCUREMENT', '', '+639000000000', 'procurement@gmail.com', '1739173849.jpg', '$2y$10$Wg/qNLDCv54TjEipFVbkGOdUZW/H2iO3U4IcGKi4dKMGgVoMadOaW', 'coordinator', 1, '', 0, '2025-02-10 15:50:49', 2, 27, 'PROCUREMENT', 'PROCUREMENT', 'PROCUREMENT', 'PROCUREMENT'),
(20, 'MATERIAL MANAGEMENT', '', 'MATERIAL MANAGEMENT', '', '+639000000000', 'materialmanagement@gmail.com', '1739173979.jpg', '$2y$10$9b6OsOMnppaF/Al0sDHOgeqErHZ8Thv5dmGlOHptVgHTG7vjIocHK', 'coordinator', 1, '', 0, '2025-02-10 15:52:59', 2, 28, 'MATERIAL MANAGEMENT', 'MATERIAL MANAGEMENT', 'MATERIAL MANAGEMENT', 'MATERIAL MANAGEMENT'),
(21, 'HRMO', '', 'HRMO', '', '+639000000000', 'hrmo@gmail.com', '1739174067.jpg', '$2y$10$9J5tWmn3OkIc696jGlzR..geE3LNg3HHYV3zuqXkvON/Ij7m7OgY6', 'coordinator', 1, '', 0, '2025-02-10 15:54:27', 2, 29, 'HRMO', 'HRMO', 'HRMO', 'HRMO'),
(22, 'EMPS', '', 'EMPS', '', '+639000000000', 'emps@gmail.com', '1739174133.jpg', '$2y$10$TsOT.L00NFc56hFFrS1.n.xeGy2OndBe7A6k6OimJvDJBK8kyPOfW', 'coordinator', 1, '', 0, '2025-02-10 15:55:33', 2, 30, 'EMPS', 'EMPS', 'EMPS', 'EMPS'),
(23, 'COA', '', 'COA', '', '+639000000000', 'coa@gmail.com', '1739174222.jpg', '$2y$10$4zI6msh2cDdnsSNE78tXiOXc3dy8czdXLdsInsgWaZfbaOQeVBtn6', 'coordinator', 1, '', 0, '2025-02-10 15:57:02', 2, 31, 'COA', 'COA', 'COA', 'COA'),
(24, 'CAO', '', 'CAO', '', '+639000000000', 'cao@gmail.com', '1739174264.jpg', '$2y$10$SptGwUtwMftecSp8ajZFBuFZz7/TWHB4E/Kdmv0IH8CRkOmwhp98.', 'coordinator', 1, '', 0, '2025-02-10 15:57:44', 2, 32, 'CAO', 'CAO', 'CAO', 'CAO'),
(25, 'ADMIN RECORDS', '', 'ADMIN RECORDS', '', '+639000000000', 'adminrecords@gmail.com', '1739174364.jpg', '$2y$10$5s0pgQmgLkENW0ZcFw3TwOwzVOL7cH9rVDkEXNbePRPe3NPnRy1pm', 'coordinator', 1, '', 0, '2025-02-10 15:59:24', 2, 33, 'ADMIN RECORDS', 'ADMIN RECORDS', 'ADMIN RECORDS', 'ADMIN RECORDS'),
(26, 'PAYROLL', '', 'PAYROLL', '', '+639000000000', 'payroll@gmail.com', '1739174459.jpg', '$2y$10$uTj6TBm53mguypb07sQXj.gaDsYuybfzFY66huH08qUzNTzQvZKIS', 'coordinator', 1, '', 0, '2025-02-10 16:00:59', 2, 55, 'PAYROLL', 'PAYROLL', 'PAYROLL', 'PAYROLL'),
(27, 'DIETARY', '', 'DIETARY', '', '+639000000000', 'dietary@gmail.com', '1739174513.jpg', '$2y$10$msuRFYAc84mb.J/aFFau3uEYRd8W7KCHrztx54/QneTZoCPe1hsuC', 'coordinator', 1, '', 0, '2025-02-10 16:01:53', 3, 9, 'DIETARY', 'DIETARY', 'DIETARY', 'DIETARY'),
(28, 'HIMD ADU', '', 'HIMD-ADU', '', '+639000000000', 'himd-adu@gmail.com', '1739175500.jpg', '$2y$10$d9187mIpqF6fqgg5RfWsvub/uDrPcMKM3b.ZK0Lc/AsVLd91BKRmu', 'coordinator', 1, '', 0, '2025-02-10 16:18:20', 3, 10, 'HIMD-ADU', 'HIMD-ADU', 'HIMD-ADU', 'HIMD-ADU'),
(29, 'HIMD MAIN', '', 'HIMD-MAIN', '', '+639000000000', 'himd-main@gmail.com', '1739175577.jpg', '$2y$10$NM1nCe7OVNVWWcZlrBaO7upOp2Ryu2BKttOXpu0.fDF3O5SEbvrbO', 'coordinator', 1, '', 0, '2025-02-10 16:19:37', 3, 11, 'HIMD-MAIN', 'HIMD-MAIN', 'HIMD-MAIN', 'HIMD-MAIN'),
(30, 'HIMD ER', '', 'HIMD-ER', '', '+639000000000', 'himd-er@gmail.com', '1739175692.jpg', '$2y$10$Q020P4V73JRln2j/fAF2vepiSo1yR1ed12zC19.0GEvpIF2.wb59W', 'coordinator', 1, '', 0, '2025-02-10 16:21:32', 3, 12, 'HIMD-ER', 'HIMD-ER', 'HIMD-ER', 'HIMD-ER'),
(31, 'HIMD STATISTICS', '', 'HIMD-STATISTICS', '', '+639000000000', 'himd-statistics@gmail.com', '1739175777.jpg', '$2y$10$hUGqXONbJi/uErtqwQr84.izscwbgv3DQxOxWLIjmi7PV/3yRqBMG', 'coordinator', 1, '', 0, '2025-02-10 16:22:57', 3, 13, 'HIMD-STATISTICS', 'HIMD-STATISTICS', 'HIMD-STATISTICS', 'HIMD-STATISTICS'),
(32, 'HIMD OPD', '', 'HIMD-OPD', '', '+639000000000', 'himd-opd@gmail.com', '1739175900.jpg', '$2y$10$EQjE.nmAUrO0Shk3/EseEeYbgSc4Bek5bjbG5DPYvRqLYnNy0IVdy', 'coordinator', 1, '', 0, '2025-02-10 16:25:00', 3, 15, 'HIMD-OPD', 'HIMD-OPD', 'HIMD-OPD', 'HIMD-OPD'),
(33, 'MSWD', '', 'MSWD', '', '+639000000000', 'mswd@gmail.com', '1739175951.jpg', '$2y$10$.YlhBCWDHPZeJWJMOVrwMeX9ASD1K13dpdqto5swiQ3zhUAFcRSte', 'coordinator', 1, '', 0, '2025-02-10 16:25:51', 3, 16, 'MSWD', 'MSWD', 'MSWD', 'MSWD'),
(34, 'PHARMACY', '', 'PHARMACY', '', '+639000000000', 'pharmacy@gmail.com', '1739176000.jpg', '$2y$10$wiXIOT8IaopNItOP8TxhTuDklOf.oMtIApJI5q9GSQy38M7pcochW', 'coordinator', 1, '', 0, '2025-02-10 16:26:40', 3, 17, 'PHARMACY', 'PHARMACY', 'PHARMACY', 'PHARMACY'),
(35, 'FINANCE', '', 'FINANCE', '', '+639000000000', 'finance@gmail.com', '1739176111.jpg', '$2y$10$90T1BNvPCFpJZBlIbU0VBu5WmdGwnQyOWpDxA3q8HOU/KVKX3XzL.', 'coordinator', 1, '', 0, '2025-02-10 16:28:31', 5, 36, 'FINANCE', 'FINANCE', 'FINANCE', 'FINANCE'),
(36, 'CASHIER', '', 'CASHIER', '', '+639000000000', 'cashier@gmail.com', '1739176174.jpg', '$2y$10$i.Gry1MRp1ioUUFjL8Ld.Of/Pdqtn9Dix2PN5uINuKC2s3fkcr2Cu', 'coordinator', 1, '', 0, '2025-02-10 16:29:34', 5, 37, 'CASHIER', 'CASHIER', 'CASHIER', 'CASHIER'),
(37, 'BUDGET', '', 'BUDGET', '', '+639000000000', 'budget@gmail.com', '1739176219.jpg', '$2y$10$u997nI022mRcaTHfBE.7ZOzbw38rb7sQsGHXMhEB/uzfkL0s/rKse', 'coordinator', 1, '', 0, '2025-02-10 16:30:19', 5, 38, 'BUDGET', 'BUDGET', 'BUDGET', 'BUDGET'),
(38, 'BILLING', '', 'BILLING', '', '+639000000000', 'billing@gmail.com', '1739176324.jpg', '$2y$10$Cl.3pYkttS14lII4FjaRHOLIDEZB/0HRVETEDqwELEIzbRmoBicdS', 'coordinator', 1, '', 0, '2025-02-10 16:32:04', 5, 39, 'BILLING', 'BILLING', 'BILLING', 'BILLING'),
(39, 'ACCOUNTING', '', 'ACCOUNTING', '', '+639000000000', 'accounting@gmail.com', '1739176390.jpg', '$2y$10$XeU4F5B2tYA3nOtvBLlJ7.HIpyJ5ridHMJ5uopEezOcl6a67sosN.', 'coordinator', 1, '', 0, '2025-02-10 16:33:10', 5, 40, 'ACCOUNTING', 'ACCOUNTING', 'ACCOUNTING', 'ACCOUNTING'),
(40, 'PHILHEALTH', '', 'PHILHEALTH', '', '+639000000000', 'philhealth@gmail.com', '1739176460.jpg', '$2y$10$9FBGVj4l.otlK3mykfdawOuO4wa2RU5EEPwyE9fvu0id2KdJgVqEq', 'coordinator', 1, '', 0, '2025-02-10 16:34:20', 5, 41, 'PHILHEALTH', 'PHILHEALTH', 'PHILHEALTH', 'PHILHEALTH'),
(41, 'ANESTHESIA', '', 'ANESTHESIA', '', '+639000000000', 'anesthesia@gmail.com', '1739176602.jpg', '$2y$10$7X5XAK5oxXNPNkTNa4rcZOXxU.1bOpTGHKUaQ9IJ/S4.ilNF6nOJq', 'coordinator', 1, '', 0, '2025-02-10 16:36:42', 6, 18, 'ANESTHESIA', 'ANESTHESIA', 'ANESTHESIA', 'ANESTHESIA'),
(42, 'DENTAL', '', 'DENTAL', '', '+639000000000', 'dental@gmail.com', '1739176675.jpg', '$2y$10$ShYgb0.PrcdknhI1dNW13u.dVkjJMN/PDKEfaoN3LIYEnwciH3UK2', 'coordinator', 1, '', 0, '2025-02-10 16:37:55', 6, 19, 'DENTAL', 'DENTAL', 'DENTAL', 'DENTAL'),
(43, 'DERMATOLOGY', '', 'DERMATOLOGY', '', '+639000000000', 'dermatology@gmail.com', '1739176802.jpg', '$2y$10$EohFqSA/JKOHFz/OOlV5P.xKOfY7rXKJnArXR8Iu8urZZ7Rhzo.UO', 'coordinator', 1, '', 0, '2025-02-10 16:40:02', 6, 20, 'DERMATOLOGY', 'DERMATOLOGY', 'DERMATOLOGY', 'DERMATOLOGY'),
(44, 'EMD', '', 'EMD', '', '+639000000000', 'emd@gmail.com', '1739176855.jpg', '$2y$10$8rhTmwibMSx0NAR8PYmZu.LQfdTGvBnKvrHRHtoL57irWvCNZ6bIm', 'coordinator', 1, '', 0, '2025-02-10 16:40:55', 6, 21, 'EMD', 'EMD', 'EMD', 'EMD'),
(45, 'ENT', '', 'ENT', '', '+639000000000', 'ent@gmail.com', '1739176973.jpg', '$2y$10$w7QvobGoNzcChpUEsMnF.OBzwwsgej1/uvOxzl15UnPdVNT0q4wTq', 'coordinator', 1, '', 0, '2025-02-10 16:42:53', 6, 22, 'ENT', 'ENT', 'ENT', 'ENT'),
(46, 'FAMILY AND COMMUNITY MEDICINE', '', 'FAMILY AND COMMUNITY MEDICINE', '', '+639000000000', 'fammed@gmail.com', '1739177076.jpg', '$2y$10$NVJtvhQiqVhKFyaiYixtzeFvgDYMZAUongX/jffw6xEAjoaHmohhS', 'coordinator', 1, '', 0, '2025-02-10 16:44:36', 6, 23, 'FAMILY AND COMMUNITY MEDICINE', 'FAMILY AND COMMUNITY MEDICINE', 'FAMILY AND COMMUNITY MEDICINE', 'FAMILY AND COMMUNITY MEDICINE'),
(47, 'INTERNAL MEDICINE', '', 'INTERNAL MEDICINE', '', '+639000000000', 'iInternalmedicine@gmail.com', '1739177208.jpg', '$2y$10$rdQCG.xZ4SQdYBASp3d.E.wkN5d23D/HTlLchyee1v9iW7rfnC4t6', 'coordinator', 1, '', 0, '2025-02-10 16:46:48', 6, 42, 'INTERNAL MEDICINE', 'INTERNAL MEDICINE', 'INTERNAL MEDICINE', 'INTERNAL MEDICINE'),
(48, 'SURGERY', '', 'SURGERY', '', '+639000000000', 'surgery@gmail.com', '1739177258.jpg', '$2y$10$I2ZfzagkH.3PnNSFa.089Op0Rscl0mdYRIj0ss4G2ImXuz7fy4NEy', 'coordinator', 1, '', 0, '2025-02-10 16:47:38', 6, 43, 'SURGERY', 'SURGERY', 'SURGERY', 'SURGERY'),
(49, 'RADIOLOGY', '', 'RADIOLOGY', '', '+639000000000', 'radiology@gmail.com', '1739177310.jpg', '$2y$10$MpfcfuvDXUH74iL5bsspLOlYjOUZJR0FVz6v3h6g.PJuJD/04Emhu', 'coordinator', 1, '', 0, '2025-02-10 16:48:30', 6, 44, 'RADIOLOGY', 'RADIOLOGY', 'RADIOLOGY', 'RADIOLOGY'),
(50, 'PULMONOLOGY', '', 'PULMONOLOGY', '', '+639000000000', 'pulmonology@gmail.com', '1739177364.jpg', '$2y$10$3uaAKZqQlv2qsAaAx8VXe.HZd6EuU5U3TwOJSzsrXjVzXONZlbue.', 'coordinator', 1, '', 0, '2025-02-10 16:49:24', 6, 45, 'PULMONOLOGY', 'PULMONOLOGY', 'PULMONOLOGY', 'PULMONOLOGY'),
(51, 'PT REHAB', '', 'PT/REHAB', '', '+639000000000', 'ptrehab@gmail.com', '1739177633.jpg', '$2y$10$bBvoi9PNDL.zBDtINy.yYuQBrr9UfeWnhm8P54xcNcP/lUZVrepcG', 'coordinator', 1, '', 0, '2025-02-10 16:53:53', 6, 46, 'PT/REHAB', 'PT/REHAB', 'PT/REHAB', 'PT/REHAB'),
(52, 'PEDIATRICS', '', 'PEDIATRICS', '', '+639000000000', 'pediatrics@gmail.com', '1739177704.jpg', '$2y$10$upIYfGUWHzUbLWJNSPgZuunI5gEE.cMjkw1MS6B4QcI03qrp6SHhO', 'coordinator', 1, '', 0, '2025-02-10 16:55:04', 6, 47, 'PEDIATRICS', 'PEDIATRICS', 'PEDIATRICS', 'PEDIATRICS'),
(53, 'ORTHOPAEDIC SURGERY', '', 'ORTHOPAEDIC SURGERY', '', '+639000000000', 'orthopaedicsurgery@gmail.com', '1739178136.jpg', '$2y$10$bMjP4O.ogjlrj9Gu4iWJHeo986KdpEOkAtiK7k6/eExIfa51TlL0.', 'coordinator', 1, '', 0, '2025-02-10 17:02:15', 6, 48, 'ORTHOPAEDIC SURGERY', 'ORTHOPAEDIC SURGERY', 'ORTHOPAEDIC SURGERY', 'ORTHOPAEDIC SURGERY'),
(54, 'OPTHALMOLOGY', '', 'OPTHALMOLOGY', '', '+639000000000', 'opthalmology@gmail.com', '1739178189.jpg', '$2y$10$n/TQfrwdP7A/1PshF/T.menR5gyb.Si9UX.43G.LTXVqzQ1Q9lslO', 'coordinator', 1, '', 0, '2025-02-10 17:03:09', 6, 49, 'OPTHALMOLOGY', 'OPTHALMOLOGY', 'OPTHALMOLOGY', 'OPTHALMOLOGY'),
(55, 'OPD', '', 'OPD', '', '+639000000000', 'opd@gmail.com', '1739178291.jpg', '$2y$10$vByWs3ywvr/ZxJLItQ0dY.7ZCneJJ32A34xznPybeRqEZw.2gk8u6', 'coordinator', 1, '', 0, '2025-02-10 17:04:50', 6, 50, 'OPD', 'OPD', 'OPD', 'OPD'),
(56, 'OB', '', 'OB', '', '+639000000000', 'ob@gmail.com', '1739178353.jpg', '$2y$10$cEO.5NX1mHujeCOA1wDPEOciJpuv5sp.mCpudoFa2IGhjW21MuexK', 'coordinator', 1, '', 0, '2025-02-10 17:05:53', 6, 51, 'OB', 'OB', 'OB', 'OB'),
(57, 'MENTAL HEALTH', '', 'MENTAL HEALTH', '', '+639000000000', 'mentalhealth@gmail.com', '1739178420.jpg', '$2y$10$w4GdKQ08Xyq44YDquafzI.IkgPnA8oCN4K6xeDNyOdh1.SHS5XamS', 'coordinator', 1, '', 0, '2025-02-10 17:07:00', 6, 52, 'MENTAL HEALTH', 'MENTAL HEALTH', 'MENTAL HEALTH', 'MENTAL HEALTH'),
(58, 'LABORATORY', '', 'LABORATORY', '', '+639000000000', 'laboratory@gmail.com', '1739178511.jpg', '$2y$10$tJBN37.kc8Hd7fGNE/.VKe/lXZpieqiqhMS3dDaSktiV9aHBc6zSu', 'coordinator', 1, '', 0, '2025-02-10 17:08:31', 6, 53, 'LABORATORY', 'LABORATORY', 'LABORATORY', 'LABORATORY'),
(59, 'CARDIOVASCULAR UNIT', '', 'CARDIOVASCULAR UNIT', '', '+639000000000', 'cardiovascular@gmail.com', '1739178590.jpg', '$2y$10$n2ugtG0J80IOafIm3GC7/ucGzmfapOJVSq76WLdOWEtuWF8G2BDi2', 'coordinator', 1, '', 0, '2025-02-10 17:09:50', 6, 54, 'CARDIOVASCULAR UNIT', 'CARDIOVASCULAR UNIT', 'CARDIOVASCULAR UNIT', 'CARDIOVASCULAR UNIT');

-- --------------------------------------------------------

--
-- Table structure for table `tblemployee`
--

CREATE TABLE `tblemployee` (
  `id` int(11) NOT NULL,
  `EmployeeNumber` varchar(50) DEFAULT NULL,
  `Lastname` varchar(100) DEFAULT NULL,
  `Firstname` varchar(100) DEFAULT NULL,
  `Middlename` varchar(100) DEFAULT NULL,
  `Suffix` varchar(10) DEFAULT NULL,
  `Birthday` date DEFAULT NULL,
  `ContactNumber` varchar(20) DEFAULT NULL,
  `Sex` char(1) DEFAULT NULL,
  `Position` varchar(100) DEFAULT NULL,
  `Department` varchar(100) DEFAULT NULL,
  `UnitSection` varchar(100) DEFAULT NULL,
  `Status` tinyint(1) DEFAULT NULL,
  `coordinator_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblemployee`
--

INSERT INTO `tblemployee` (`id`, `EmployeeNumber`, `Lastname`, `Firstname`, `Middlename`, `Suffix`, `Birthday`, `ContactNumber`, `Sex`, `Position`, `Department`, `UnitSection`, `Status`, `coordinator_id`, `created_at`) VALUES
(14, '1234-1234', 'Sample', 'User', '', '', '1995-09-22', '09363007584', 'M', 'Medical', '1', '24', 0, 4, '2025-02-08 15:35:40'),
(15, '1234-1235', 'Macayan', 'Vergel', 'Ocado', '', '2001-08-31', '09054621457', 'M', 'INTERN', '1', '24', 1, 4, '2025-02-10 01:04:23'),
(16, '2025-0001', 'MANAID', 'REVELINO', 'ALUTAYA', '', '2001-09-20', '09000000001', 'M', 'INTERN', '1', '24', 1, 4, '2025-02-10 06:43:29'),
(17, '2025-0002', 'ABELLA', 'KIANNA CASSEY', 'TUPIG', '', '2002-09-30', '09000000002', 'F', 'INTERN', '1', '24', 1, 4, '2025-02-10 06:45:36'),
(18, '2025-0003', 'PERLIN', 'JENELYN', 'MAGAT', '', '2003-11-07', '09000000003', 'F', 'INTERN', '1', '24', 1, 4, '2025-02-10 06:46:51'),
(19, '2025-0004', 'ORDONIO', 'ANGELO', 'FRANCISCO', '', '2001-11-21', '09000000004', 'M', 'INTERN', '1', '24', 1, 4, '2025-02-10 06:49:20'),
(20, '2025-0005', 'BATOTO', 'CARLO', 'BORJA', '', '2002-08-31', '09000000005', 'M', 'INTERN', '1', '24', 1, 4, '2025-02-10 06:50:55'),
(21, '2025-0006', 'HERMOSA', 'GABRYELLE', 'TEAÑO', '', '2003-04-08', '09000000006', 'M', 'INTERN', '1', '24', 1, 4, '2025-02-10 06:52:29'),
(22, '2025-0007', 'PUNZAL', 'MARJORIE JOY', 'REBALLOS', '', '2003-09-04', '09000000007', 'F', 'INTERN', '1', '24', 1, 4, '2025-02-10 07:45:50'),
(23, '2025-1000', 'Batumbakal', 'Maria Leonora', 'Dela cruz', 'III', '2025-02-08', '09000000010', 'F', 'INTERN', '2', '31', 1, 23, '2025-02-10 09:15:15');

--
-- Triggers `tblemployee`
--
DELIMITER $$
CREATE TRIGGER `after_employee_insert` AFTER INSERT ON `tblemployee` FOR EACH ROW BEGIN
    INSERT INTO tblemployeeremarks (EmployeeNumber, Year, Remarks)
    VALUES (NEW.EmployeeNumber, YEAR(CURRENT_DATE), 0);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tblemployeeremarks`
--

CREATE TABLE `tblemployeeremarks` (
  `id` int(11) NOT NULL,
  `EmployeeNumber` varchar(50) DEFAULT NULL,
  `Year` int(11) DEFAULT year(curdate()),
  `Remarks` tinyint(1) DEFAULT 0,
  `Title` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblemployeeremarks`
--

INSERT INTO `tblemployeeremarks` (`id`, `EmployeeNumber`, `Year`, `Remarks`, `Title`) VALUES
(30, '1234-1234', 2025, 0, ''),
(31, '1234-1235', 2025, 1, 'Certified C Programming (10/02/2025)'),
(32, '2025-0001', 2025, 1, 'MENTAL HOSPITAL ESCAPEE(FEBRUARY 14, 2025)'),
(33, '2025-0002', 2025, 1, 'ML WARRIOR RANK TRAINING(FEBRUARY 05, 2025)'),
(34, '2025-0003', 2025, 1, 'ARGUMENT TOP CONTENDER(FEBRUARY 10, 2025)'),
(35, '2025-0004', 2025, 1, 'LAPTOP TOP SELLER COMPETITION(FEBRUARY 09, 2025)'),
(36, '2025-0005', 2025, 1, 'TOP 5 CREEPIEST VIDEOS(FEBRUARY 11, 2025)'),
(37, '2025-0006', 2025, 1, 'MOST HANDSOME 2025(FEBRUARY 10, 2025)'),
(38, '2025-0007', 2025, 1, 'TOP 10 AMV(FEBRUARY 10, 2025)'),
(39, '2025-1000', 2025, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblemployeeseminar`
--

CREATE TABLE `tblemployeeseminar` (
  `id` int(11) NOT NULL,
  `EmployeeNumber` varchar(50) DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `CertificateImage` varchar(255) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `Title` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblemployeeseminar`
--

INSERT INTO `tblemployeeseminar` (`id`, `EmployeeNumber`, `Date`, `CertificateImage`, `year`, `Title`) VALUES
(13, '1234-1234', '2025-02-08', '1739029112.png', 2025, 'Foundation in Christian Theology (March 6, 2012)'),
(15, '1234-1234', '2025-02-10', '1739149190.jpg', 2025, 'Sample Certificate dsadasdasd\n'),
(16, '1234-1234', '2025-02-10', '1739149311.jpg', 2025, 'Sample Certificate'),
(17, '1234-1235', '2025-02-10', '1739149736.jpg', 2025, 'Certified C Programming (10/02/2025)'),
(18, '1234-1235', '2025-02-10', '1739166901.jpg', 2025, 'Medical (02/10/2025)'),
(19, '1234-1235', '2025-02-10', '1739170476.jpg', 2025, 'VALENTINE SINGLE ANNIVERSARY(AUGUST 01, 2001)'),
(20, '2025-0001', '2025-02-10', '1739170600.jpg', 2025, 'MENTAL HOSPITAL ESCAPEE(FEBRUARY 14, 2025)'),
(21, '2025-0002', '2025-02-10', '1739170744.jpg', 2025, 'ML WARRIOR RANK TRAINING(FEBRUARY 05, 2025)'),
(22, '2025-0003', '2025-02-10', '1739170903.jpg', 2025, 'ARGUMENT TOP CONTENDER(FEBRUARY 10, 2025)'),
(23, '2025-0004', '2025-02-10', '1739170994.jpg', 2025, 'LAPTOP TOP SELLER COMPETITION(FEBRUARY 09, 2025)'),
(24, '2025-0005', '2025-02-10', '1739171051.jpg', 2025, 'TOP 5 CREEPIEST VIDEOS(FEBRUARY 11, 2025)'),
(25, '2025-0006', '2025-02-10', '1739171108.jpg', 2025, 'MOST HANDSOME 2025(FEBRUARY 10, 2025)'),
(26, '2025-0007', '2025-02-10', '1739173594.jpg', 2025, 'TOP 10 AMV(FEBRUARY 10, 2025)'),
(27, '1234-1235', '2025-02-11', '1739244843.jpg', 2026, 'sadadasdasd');

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `id` int(11) NOT NULL,
  `department_id` int(11) DEFAULT NULL,
  `unit_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`id`, `department_id`, `unit_name`) VALUES
(1, 1, 'MCC OFFICE'),
(2, 1, 'HESU'),
(3, 1, 'SQMS'),
(4, 2, 'IHOMS'),
(5, 1, 'PHU'),
(6, 1, 'LEGAL'),
(7, 1, 'PACU'),
(8, 1, 'HEMS'),
(9, 3, 'DIETARY'),
(10, 3, 'HIMD-ADU'),
(11, 3, 'HIMD-MAIN'),
(12, 3, 'HIMD-ER'),
(13, 3, 'HIMD-STATISTICS'),
(15, 3, 'HIMD-OPD'),
(16, 3, 'MSWD'),
(17, 3, 'PHARMACY'),
(18, 6, 'ANESTHESIA'),
(19, 6, 'DENTAL'),
(20, 6, 'DERMATOLOGY'),
(21, 6, 'EMD'),
(22, 6, 'ENT'),
(23, 6, 'FAMILY AND COMMUNITY MEDICINE'),
(24, 1, 'PETRU'),
(26, 2, 'TIMEKEEPING UNIT'),
(27, 2, 'PROCUREMENT'),
(28, 2, 'MATERIAL MANAGEMENT'),
(29, 2, 'HRMO'),
(30, 2, 'EMPS'),
(31, 2, 'COA'),
(32, 2, 'CAO'),
(33, 2, 'ADMIN RECORDS'),
(34, 1, 'IREB'),
(35, 1, 'IHOMP'),
(36, 5, 'FINANCE'),
(37, 5, 'CASHIER'),
(38, 5, 'BUDGET'),
(39, 5, 'BILLING'),
(40, 5, 'ACCOUNTING'),
(41, 5, 'PHILHEALTH'),
(42, 6, 'INTERNAL MEDICINE'),
(43, 6, 'SURGERY'),
(44, 6, 'RADIOLOGY'),
(45, 6, 'PULMONOLOGY UNIT'),
(46, 6, 'PT/REHAB'),
(47, 6, 'PEDIATRICS'),
(48, 6, 'ORTHOPAEDIC SURGERY'),
(49, 6, 'OPTHALMOLOGY'),
(50, 6, 'OPD'),
(51, 6, 'OB'),
(52, 6, 'MENTAL HEALTH'),
(53, 6, 'LABORATORY'),
(54, 6, 'CARDIOVASCULAR UNIT'),
(55, 2, 'PAYROLL');

-- --------------------------------------------------------

--
-- Stand-in structure for view `users`
-- (See below for the actual view)
--
CREATE TABLE `users` (
`id` int(11)
,`name` varchar(255)
,`email` varchar(255)
,`role` varchar(255)
,`status` tinyint(4)
,`password` varchar(255)
,`verify_token` varchar(255)
);

-- --------------------------------------------------------

--
-- Structure for view `users`
--
DROP TABLE IF EXISTS `users`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `users`  AS SELECT `tbladmin`.`id` AS `id`, `tbladmin`.`name` AS `name`, `tbladmin`.`email` AS `email`, `tbladmin`.`role` AS `role`, `tbladmin`.`status` AS `status`, `tbladmin`.`password` AS `password`, `tbladmin`.`verify_token` AS `verify_token` FROM `tbladmin`union all select `tblcoordinator`.`id` AS `id`,`tblcoordinator`.`name` AS `name`,`tblcoordinator`.`email` AS `email`,`tblcoordinator`.`role` AS `role`,`tblcoordinator`.`status` AS `status`,`tblcoordinator`.`password` AS `password`,`tblcoordinator`.`verify_token` AS `verify_token` from `tblcoordinator`  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mail_settings`
--
ALTER TABLE `mail_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notif_patient_id_foreign` (`patient_id`),
  ADD KEY `notif_doc_id_foreign` (`doc_id`);

--
-- Indexes for table `system_details`
--
ALTER TABLE `system_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblcoordinator`
--
ALTER TABLE `tblcoordinator`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblemployee`
--
ALTER TABLE `tblemployee`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `EmployeeNumber` (`EmployeeNumber`);

--
-- Indexes for table `tblemployeeremarks`
--
ALTER TABLE `tblemployeeremarks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `EmployeeNumber` (`EmployeeNumber`);

--
-- Indexes for table `tblemployeeseminar`
--
ALTER TABLE `tblemployeeseminar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `EmployeeNumber` (`EmployeeNumber`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `mail_settings`
--
ALTER TABLE `mail_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `system_details`
--
ALTER TABLE `system_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblcoordinator`
--
ALTER TABLE `tblcoordinator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `tblemployee`
--
ALTER TABLE `tblemployee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tblemployeeremarks`
--
ALTER TABLE `tblemployeeremarks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `tblemployeeseminar`
--
ALTER TABLE `tblemployeeseminar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
