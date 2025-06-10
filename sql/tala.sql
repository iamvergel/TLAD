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

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `id` int(11) NOT NULL,
  `department_id` int(11) DEFAULT NULL,
  `unit_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
