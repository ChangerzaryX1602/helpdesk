-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 17, 2026 at 02:23 PM
-- Server version: 8.0.30
-- PHP Version: 8.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `helpdeskv1`
--
CREATE DATABASE IF NOT EXISTS `helpdeskv1` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `helpdeskv1`;

-- --------------------------------------------------------

--
-- Table structure for table `tb_assignment_history`
--

CREATE TABLE `tb_assignment_history` (
  `assign_id` bigint NOT NULL,
  `r_no` varchar(7) NOT NULL,
  `from_user_id` varchar(30) DEFAULT NULL,
  `to_user_id` varchar(30) NOT NULL,
  `assigned_by` varchar(30) NOT NULL,
  `assign_note` text,
  `assigned_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_assignment_history`
--

INSERT INTO `tb_assignment_history` (`assign_id`, `r_no`, `from_user_id`, `to_user_id`, `assigned_by`, `assign_note`, `assigned_at`) VALUES
(1, 'R8', NULL, '2222222222222', '1234567891234', 'มอบหมายงานซ่อม', '2026-03-17 14:00:04');

-- --------------------------------------------------------

--
-- Table structure for table `tb_building`
--

CREATE TABLE `tb_building` (
  `build_id` int NOT NULL,
  `build_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_building`
--

INSERT INTO `tb_building` (`build_id`, `build_name`) VALUES
(1, 'Building 1'),
(2, 'Building 2'),
(3, 'Building 3'),
(4, 'Building 4'),
(5, 'Building 5');

-- --------------------------------------------------------

--
-- Table structure for table `tb_company`
--

CREATE TABLE `tb_company` (
  `cmp_id` varchar(2) NOT NULL,
  `cmp_name` varchar(200) NOT NULL,
  `cmp_software` varchar(200) NOT NULL,
  `cmp_token_line` varchar(250) NOT NULL,
  `cmp_email` varchar(250) NOT NULL,
  `cmp_password_email` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_company`
--

INSERT INTO `tb_company` (`cmp_id`, `cmp_name`, `cmp_software`, `cmp_token_line`, `cmp_email`, `cmp_password_email`) VALUES
('1', 'DevtaiX', 'HelpDesk ', 'test', 'devtai.com', '123456789');

-- --------------------------------------------------------

--
-- Table structure for table `tb_department`
--

CREATE TABLE `tb_department` (
  `dep_id` int NOT NULL,
  `dep_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_department`
--

INSERT INTO `tb_department` (`dep_id`, `dep_name`) VALUES
(1, 'IT Helpdesk'),
(2, 'Account'),
(3, 'HR'),
(4, 'Management');

-- --------------------------------------------------------

--
-- Table structure for table `tb_equipment`
--

CREATE TABLE `tb_equipment` (
  `eq_id` int NOT NULL,
  `eq_name` varchar(255) NOT NULL,
  `eq_status` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_equipment`
--

INSERT INTO `tb_equipment` (`eq_id`, `eq_name`, `eq_status`) VALUES
(1, 'Computer', ''),
(2, 'Printer', ''),
(3, 'Notebook', ''),
(4, 'Projector', ''),
(5, 'WiFi', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_login_log`
--

CREATE TABLE `tb_login_log` (
  `log_id` bigint NOT NULL,
  `u_idcard` varchar(13) NOT NULL,
  `log_host` varchar(100) NOT NULL,
  `log_ip` varchar(100) NOT NULL,
  `log_browser` varchar(100) NOT NULL,
  `log_save` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_login_log`
--

INSERT INTO `tb_login_log` (`log_id`, `u_idcard`, `log_host`, `log_ip`, `log_browser`, `log_save`) VALUES
(1, '1234567891234', 'DESKTOP-KD8O937', '::1', 'Chrome', '2021-11-10 22:22:49'),
(2, '6666666666666', 'DESKTOP-KD8O937', '::1', 'Chrome', '2021-11-10 22:33:08'),
(3, '1234567891234', 'DESKTOP-KD8O937', '::1', 'Chrome', '2021-11-10 22:36:52'),
(4, '4444444444444', 'DESKTOP-KD8O937', '::1', 'Chrome', '2021-11-10 22:37:41'),
(5, '2222222222222', 'DESKTOP-KD8O937', '::1', 'Chrome', '2021-11-10 23:01:17'),
(6, '2222222222222', 'DESKTOP-KD8O937', '::1', 'Chrome', '2021-11-10 23:08:59'),
(7, '1234567891234', 'DESKTOP-KD8O937', '::1', 'Chrome', '2021-11-10 23:15:11'),
(8, '3333333333333', 'DESKTOP-KD8O937', '::1', 'Chrome', '2021-11-10 23:15:25'),
(9, '4444444444444', 'DESKTOP-KD8O937', '::1', 'Chrome', '2021-11-10 23:15:41'),
(10, '1234567891234', 'localhost', '::1', 'Chrome', '2023-02-08 15:07:25'),
(11, '3333333333333', 'localhost', '::1', 'Chrome', '2023-02-08 15:11:08'),
(12, '1234567891234', 'localhost', '::1', 'Chrome', '2023-02-08 15:13:10'),
(13, '1234567891234', 'localhost', '::1', 'Chrome', '2023-02-10 09:08:11'),
(14, '1234567891234', 'localhost', '::1', 'Chrome', '2023-04-05 07:46:19'),
(15, '1234567891234', 'LAPTOP-POOLFJIT', '::1', 'Chrome', '2024-08-01 09:53:21'),
(16, '4444444444444', 'LAPTOP-POOLFJIT', '::1', 'Chrome', '2024-08-01 09:55:43'),
(17, '3333333333333', 'LAPTOP-POOLFJIT', '::1', 'Chrome', '2024-10-30 07:40:04'),
(18, '3333333333333', 'LAPTOP-POOLFJIT', '::1', 'Chrome', '2024-11-14 04:35:23'),
(19, '4444444444444', 'LAPTOP-POOLFJIT', '::1', 'Chrome', '2024-11-22 06:50:24'),
(20, '1234567891234', 'LAPTOP-POOLFJIT', '::1', 'Chrome', '2025-01-17 08:47:46'),
(21, '2222222222222', 'LAPTOP-POOLFJIT', '::1', 'Chrome', '2025-01-17 08:49:50'),
(22, '4444444444444', 'LAPTOP-POOLFJIT', '::1', 'Chrome', '2025-02-04 06:10:39'),
(23, '1234567891234', 'LAPTOP-POOLFJIT', '::1', 'Chrome', '2025-02-04 06:11:02'),
(24, '2222222222222', 'LAPTOP-POOLFJIT', '::1', 'Chrome', '2025-02-04 06:13:20'),
(25, '1234567891234', 'LAPTOP-POOLFJIT', '::1', 'Chrome', '2025-02-04 06:20:09'),
(26, '3333333333333', 'LAPTOP-POOLFJIT', '::1', 'Chrome', '2025-02-04 06:20:39'),
(27, '4444444444444', 'LAPTOP-POOLFJIT', '::1', 'Chrome', '2025-02-04 06:21:35'),
(28, '1234567891234', 'LAPTOP-POOLFJIT', '::1', 'Chrome', '2025-02-22 16:03:08'),
(29, '1234567891234', 'LAPTOP-POOLFJIT', '::1', 'Chrome', '2025-02-24 11:09:18'),
(30, '1234567891234', 'LAPTOP-POOLFJIT', '::1', 'Chrome', '2026-03-17 03:59:14'),
(31, '1234567891234', 'LAPTOP-POOLFJIT', '::1', 'Chrome', '2026-03-17 04:31:15'),
(32, '2222222222222', 'LAPTOP-POOLFJIT', '::1', 'Chrome', '2026-03-17 06:52:26'),
(33, '4444444444444', 'LAPTOP-POOLFJIT', '::1', 'Chrome', '2026-03-17 06:53:38'),
(34, '1234567891234', 'LAPTOP-POOLFJIT', '::1', 'Chrome', '2026-03-17 06:56:49'),
(35, '3333333333333', 'LAPTOP-POOLFJIT', '::1', 'Chrome', '2026-03-17 06:58:25'),
(36, '2222222222222', 'LAPTOP-POOLFJIT', '::1', 'Chrome', '2026-03-17 06:58:47'),
(37, '1234567891234', 'LAPTOP-POOLFJIT', '::1', 'Chrome', '2026-03-17 06:59:47'),
(38, '2222222222222', 'LAPTOP-POOLFJIT', '::1', 'Chrome', '2026-03-17 07:00:41'),
(39, '1234567891234', 'LAPTOP-POOLFJIT', '::1', 'Chrome', '2026-03-17 11:16:23');

-- --------------------------------------------------------

--
-- Table structure for table `tb_notification`
--

CREATE TABLE `tb_notification` (
  `notify_id` bigint NOT NULL,
  `user_id` varchar(30) NOT NULL,
  `r_no` varchar(7) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `is_read` char(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_notification`
--

INSERT INTO `tb_notification` (`notify_id`, `user_id`, `r_no`, `title`, `message`, `is_read`, `created_at`) VALUES
(1, '6666666666666', 'R3', 'สถานะงานซ่อมมีการเปลี่ยนแปลง', 'อัปเดตสถานะเป็น Successfully', '0', '2026-03-17 13:52:55'),
(2, '2222222222222', 'R8', 'คุณได้รับมอบหมายงานซ่อม', 'มีการมอบหมายงานเลขที่ R8 ให้คุณดำเนินการ', '1', '2026-03-17 14:00:04');

-- --------------------------------------------------------

--
-- Table structure for table `tb_position`
--

CREATE TABLE `tb_position` (
  `p_id` int NOT NULL,
  `p_position` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_position`
--

INSERT INTO `tb_position` (`p_id`, `p_position`) VALUES
(1, 'Systems Analyst'),
(2, 'Chief Executive Officer'),
(3, 'Engineering Technician');

-- --------------------------------------------------------

--
-- Table structure for table `tb_repair`
--

CREATE TABLE `tb_repair` (
  `r_no` varchar(7) NOT NULL COMMENT 'เลขที่แจ้งซ่อม',
  `u_idcard` varchar(13) NOT NULL COMMENT 'ผู้แจ้งซ่อม',
  `eq_id` int NOT NULL COMMENT 'อุปกรณ์',
  `r_name` varchar(200) NOT NULL COMMENT 'ชื่ออุปกรณ์',
  `r_serialnumber` varchar(150) NOT NULL COMMENT 'หมายเลขเครื่อง',
  `r_detail` text NOT NULL COMMENT 'อาการหรือสาเหตุ',
  `symptom_summary` varchar(255) DEFAULT NULL,
  `resolution_text` text,
  `repair_cost` decimal(10,2) NOT NULL DEFAULT '0.00',
  `build_id` int NOT NULL COMMENT 'อาคารหรือตึก',
  `floor` varchar(100) NOT NULL COMMENT 'ชั้นอาคาร',
  `room` varchar(100) NOT NULL COMMENT 'ห้อง',
  `no` int NOT NULL,
  `s_id` char(1) NOT NULL COMMENT 'สถานะ',
  `head_id` varchar(13) NOT NULL COMMENT 'หัวหน้างาน',
  `technician_id` varchar(13) NOT NULL COMMENT 'ช่าง',
  `r_save` datetime NOT NULL COMMENT 'วันที่แจ้งซ่อม',
  `accepted_at` datetime DEFAULT NULL,
  `started_at` datetime DEFAULT NULL,
  `completed_at` datetime DEFAULT NULL,
  `closed_at` datetime DEFAULT NULL,
  `sla_due_at` datetime DEFAULT NULL,
  `wl_id` char(1) NOT NULL COMMENT 'ระดับความสำคัญงาน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_repair`
--

INSERT INTO `tb_repair` (`r_no`, `u_idcard`, `eq_id`, `r_name`, `r_serialnumber`, `r_detail`, `symptom_summary`, `resolution_text`, `repair_cost`, `build_id`, `floor`, `room`, `no`, `s_id`, `head_id`, `technician_id`, `r_save`, `accepted_at`, `started_at`, `completed_at`, `closed_at`, `sla_due_at`, `wl_id`) VALUES
('R1', '1234567891234', 1, 'Dell inspiron 3501', 'xxx-xxxx-xx-xx-x', 'No Internet ', NULL, NULL, 0.00, 1, '3', '301', 1, '3', '4444444444444', '2222222222222', '2021-11-10 22:30:43', NULL, NULL, NULL, NULL, NULL, '1'),
('R2', '6666666666666', 2, 'Canon G3000', '123-1234-11-11-1', 'Print Error', NULL, NULL, 0.00, 3, '2', '202', 2, '4', '4444444444444', '2222222222222', '2021-11-10 22:33:54', NULL, NULL, NULL, NULL, NULL, '2'),
('R3', '6666666666666', 5, 'Acer 1234', '123-1234-11-11-1', 'won\'t turn on', NULL, NULL, 0.00, 3, '2', '202', 3, '4', '4444444444444', '2222222222222', '2021-11-10 22:34:01', '2026-03-17 13:52:55', '2026-03-17 13:52:55', '2026-03-17 13:52:55', '2026-03-17 13:52:55', NULL, '3'),
('R4', '3333333333333', 1, 'ssssssssssss', 's21223212', 'sadsadasd', NULL, NULL, 0.00, 2, '1', '310', 4, '1', '22', '22', '2024-11-14 04:43:25', NULL, NULL, NULL, NULL, NULL, '1'),
('R5', '3333333333333', 1, 'macbook 2022', 's21223212', 'sssss', NULL, NULL, 0.00, 1, '10', '310', 5, '1', '22', '22', '2025-02-04 06:20:56', NULL, NULL, NULL, NULL, NULL, '1'),
('R6', '3333333333333', 3, 'macbook 2022', 's21223212', 'xxss', NULL, NULL, 0.00, 2, '10', '310', 6, '1', '22', '22', '2025-02-04 06:21:20', NULL, NULL, NULL, NULL, NULL, '1'),
('R7', '1234567891234', 1, 'macbook 2022', 's21223212', 'test', 'test', NULL, 0.00, 2, '10', '310', 7, '1', '', '', '2026-03-17 06:54:13', NULL, NULL, NULL, NULL, '2026-03-17 14:54:13', '3'),
('R8', '1234567891234', 1, 'macbook 2022', 's21223212', 'test', 'test', NULL, 0.00, 2, '10', '310', 8, '2', '1234567891234', '2222222222222', '2026-03-17 06:55:26', NULL, NULL, NULL, NULL, '2026-03-17 14:55:26', '3');

-- --------------------------------------------------------

--
-- Table structure for table `tb_repair_attachment`
--

CREATE TABLE `tb_repair_attachment` (
  `attachment_id` bigint NOT NULL,
  `r_no` varchar(7) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `file_ext` varchar(20) DEFAULT NULL,
  `file_size` int DEFAULT NULL,
  `uploaded_by` varchar(30) NOT NULL,
  `uploaded_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_repair_attachment`
--

INSERT INTO `tb_repair_attachment` (`attachment_id`, `r_no`, `file_name`, `file_path`, `file_ext`, `file_size`, `uploaded_by`, `uploaded_at`) VALUES
(1, 'R8', 'logo2.png', 'uploads/repair_attachments/R8_20260317111755_8999_logo2.png', 'png', 170384, '1234567891234', '2026-03-17 18:17:55');

-- --------------------------------------------------------

--
-- Table structure for table `tb_repair_comment`
--

CREATE TABLE `tb_repair_comment` (
  `comment_id` bigint NOT NULL,
  `r_no` varchar(7) NOT NULL,
  `user_id` varchar(30) NOT NULL,
  `comment_text` text NOT NULL,
  `comment_type` varchar(30) NOT NULL DEFAULT 'comment',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_repair_comment`
--

INSERT INTO `tb_repair_comment` (`comment_id`, `r_no`, `user_id`, `comment_text`, `comment_type`, `created_at`) VALUES
(1, 'R3', '2222222222222', 'อัปเดตสถานะเป็น Successfully', 'status', '2026-03-17 13:52:55'),
(2, 'R7', '1234567891234', 'สร้างรายการแจ้งซ่อมโดยเจ้าหน้าที่: test', 'create', '2026-03-17 13:54:13'),
(3, 'R8', '1234567891234', 'สร้างรายการแจ้งซ่อมโดยเจ้าหน้าที่: test', 'create', '2026-03-17 13:55:26'),
(4, 'R8', '1234567891234', 'มอบหมายงานให้ช่างเรียบร้อยแล้ว', 'assignment', '2026-03-17 14:00:04'),
(5, 'R8', '1234567891234', 'test', 'comment', '2026-03-17 18:17:55');

-- --------------------------------------------------------

--
-- Table structure for table `tb_repair_log`
--

CREATE TABLE `tb_repair_log` (
  `rlog_id` bigint NOT NULL,
  `r_no` varchar(7) NOT NULL,
  `action_type` varchar(50) DEFAULT NULL,
  `old_s_id` char(1) DEFAULT NULL,
  `note` text,
  `s_id` char(1) NOT NULL,
  `technician_id` varchar(13) NOT NULL,
  `user_id` varchar(13) NOT NULL,
  `rlog_host` varchar(100) NOT NULL,
  `rlog_ip` varchar(100) NOT NULL,
  `rlog_browser` varchar(100) NOT NULL,
  `rlog_save` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_repair_log`
--

INSERT INTO `tb_repair_log` (`rlog_id`, `r_no`, `action_type`, `old_s_id`, `note`, `s_id`, `technician_id`, `user_id`, `rlog_host`, `rlog_ip`, `rlog_browser`, `rlog_save`) VALUES
(1, 'R1', NULL, NULL, NULL, '2', '2222222222222', '4444444444444', 'DESKTOP-KD8O937', '::1', 'Chrome', '2021-11-10 22:37:50'),
(2, 'R2', NULL, NULL, NULL, '2', '2222222222222', '4444444444444', 'DESKTOP-KD8O937', '::1', 'Chrome', '2021-11-10 22:37:57'),
(3, 'R3', NULL, NULL, NULL, '2', '2222222222222', '4444444444444', 'DESKTOP-KD8O937', '::1', 'Chrome', '2021-11-10 22:38:06'),
(4, 'R1', NULL, NULL, NULL, '2', '2222222222222', '4444444444444', 'DESKTOP-KD8O937', '::1', 'Chrome', '2021-11-10 23:00:47'),
(5, 'R2', NULL, NULL, NULL, '2', '2222222222222', '4444444444444', 'DESKTOP-KD8O937', '::1', 'Chrome', '2021-11-10 23:00:56'),
(6, 'R3', NULL, NULL, NULL, '2', '2222222222222', '4444444444444', 'DESKTOP-KD8O937', '::1', 'Chrome', '2021-11-10 23:01:05'),
(7, 'R1', NULL, NULL, NULL, '3', '2222222222222', '2222222222222', 'DESKTOP-KD8O937', '::1', 'Chrome', '2021-11-10 23:10:03'),
(8, 'R2', NULL, NULL, NULL, '4', '2222222222222', '2222222222222', 'DESKTOP-KD8O937', '::1', 'Chrome', '2021-11-10 23:10:13'),
(9, 'R3', 'status_update', '2', 'อัปเดตสถานะเป็น Successfully', '4', '2222222222222', '2222222222222', 'LAPTOP-POOLFJIT', '::1', 'Chrome', '2026-03-17 06:52:55'),
(10, 'R8', 'create', NULL, 'เจ้าหน้าที่สร้างรายการแจ้งซ่อมแทนผู้ใช้', '1', '', '4444444444444', 'LAPTOP-POOLFJIT', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Sa', '2026-03-17 06:55:26'),
(11, 'R8', 'assign', '1', 'มอบหมายงานให้ช่างผู้รับผิดชอบ', '2', '2222222222222', '1234567891234', 'LAPTOP-POOLFJIT', '::1', 'Chrome', '2026-03-17 07:00:04'),
(12, 'R8', 'comment', '2', 'เพิ่มหมายเหตุในงานซ่อม', '2', '2222222222222', '1234567891234', 'LAPTOP-POOLFJIT', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Sa', '2026-03-17 11:17:55');

-- --------------------------------------------------------

--
-- Table structure for table `tb_sla_rule`
--

CREATE TABLE `tb_sla_rule` (
  `sla_id` int NOT NULL,
  `eq_id` int NOT NULL,
  `wl_id` char(1) NOT NULL,
  `response_hours` int NOT NULL DEFAULT '4',
  `resolve_hours` int NOT NULL DEFAULT '24',
  `is_active` char(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_sla_rule`
--

INSERT INTO `tb_sla_rule` (`sla_id`, `eq_id`, `wl_id`, `response_hours`, `resolve_hours`, `is_active`, `created_at`) VALUES
(1, 1, '1', 8, 48, '1', '2026-03-17 13:33:53'),
(2, 2, '1', 8, 48, '1', '2026-03-17 13:33:53'),
(3, 3, '1', 8, 48, '1', '2026-03-17 13:33:53'),
(4, 4, '1', 8, 48, '1', '2026-03-17 13:33:53'),
(5, 5, '1', 8, 48, '1', '2026-03-17 13:33:53'),
(8, 1, '2', 4, 24, '1', '2026-03-17 13:33:53'),
(9, 2, '2', 4, 24, '1', '2026-03-17 13:33:53'),
(10, 3, '2', 4, 24, '1', '2026-03-17 13:33:53'),
(11, 4, '2', 4, 24, '1', '2026-03-17 13:33:53'),
(12, 5, '2', 4, 24, '1', '2026-03-17 13:33:53'),
(15, 1, '3', 2, 8, '1', '2026-03-17 13:33:53'),
(16, 2, '3', 2, 8, '1', '2026-03-17 13:33:53'),
(17, 3, '3', 2, 8, '1', '2026-03-17 13:33:53'),
(18, 4, '3', 2, 8, '1', '2026-03-17 13:33:53'),
(19, 5, '3', 2, 8, '1', '2026-03-17 13:33:53');

-- --------------------------------------------------------

--
-- Table structure for table `tb_status`
--

CREATE TABLE `tb_status` (
  `s_id` char(1) NOT NULL,
  `s_status` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_status`
--

INSERT INTO `tb_status` (`s_id`, `s_status`) VALUES
('1', 'Waiting '),
('2', 'Task Assigned'),
('3', 'Repair in Progress'),
('4', 'Successfully'),
('5', 'Cancel');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `u_prefix` varchar(30) NOT NULL,
  `u_fname` varchar(100) NOT NULL,
  `u_lname` varchar(100) NOT NULL,
  `u_idcard` varchar(30) NOT NULL,
  `u_mobile` varchar(30) NOT NULL,
  `u_tel` varchar(30) NOT NULL,
  `u_email` varchar(100) NOT NULL,
  `p_id` int NOT NULL,
  `dep_id` int NOT NULL,
  `u_username` varchar(50) NOT NULL,
  `u_password` varchar(100) NOT NULL,
  `level_id` varchar(2) NOT NULL,
  `u_status` char(1) NOT NULL COMMENT '0=เปิดใช้งาน, 1=ยกเลิก',
  `u_save` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`u_prefix`, `u_fname`, `u_lname`, `u_idcard`, `u_mobile`, `u_tel`, `u_email`, `p_id`, `dep_id`, `u_username`, `u_password`, `level_id`, `u_status`, `u_save`) VALUES
('Mr.', 'Waiyawut', 'Cmpk', '1234567891234', '0999999999', '9999', 'admin@gmail.com', 2, 4, 'admin', '81dc9bdb52d04dc20036dbd8313ed055', '01', '1', '2021-11-10 22:22:40'),
('Mr.', 'Technician', 'Helpdesk', '2222222222222', '0888888888', '8888', 'technician@gmail.com', 3, 1, 'technician', '81dc9bdb52d04dc20036dbd8313ed055', '04', '1', '2021-11-10 22:27:35'),
('Mr.', 'User', 'Helpdesk', '3333333333333', '0333333333', '3333', 'user@gmail.com', 1, 1, 'user', '81dc9bdb52d04dc20036dbd8313ed055', '03', '1', '2021-11-10 22:28:30'),
('Mr.', 'Staff', 'Helpdesk', '4444444444444', '0444444444', '4444', 'staff@gmail.com', 1, 3, 'staff', '81dc9bdb52d04dc20036dbd8313ed055', '02', '1', '2021-11-10 22:29:44'),
('Miss', 'User2', 'Test', '6666666666666', '0666666666', '6666', 'user2@gmail.com', 1, 2, 'user2', '81dc9bdb52d04dc20036dbd8313ed055', '03', '1', '2021-11-10 22:32:51');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user_level`
--

CREATE TABLE `tb_user_level` (
  `level_id` varchar(2) NOT NULL,
  `level_name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_user_level`
--

INSERT INTO `tb_user_level` (`level_id`, `level_name`) VALUES
('01', 'Admin'),
('02', 'Manager'),
('03', 'Employee'),
('04', 'Technician');

-- --------------------------------------------------------

--
-- Table structure for table `tb_work_level`
--

CREATE TABLE `tb_work_level` (
  `wl_id` char(1) NOT NULL,
  `wl_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_work_level`
--

INSERT INTO `tb_work_level` (`wl_id`, `wl_name`) VALUES
('1', 'Normal'),
('2', 'Medium'),
('3', 'Very');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_assignment_history`
--
ALTER TABLE `tb_assignment_history`
  ADD PRIMARY KEY (`assign_id`),
  ADD KEY `idx_tb_assignment_history_r_no` (`r_no`),
  ADD KEY `idx_tb_assignment_history_to_user_id` (`to_user_id`),
  ADD KEY `idx_tb_assignment_history_assigned_by` (`assigned_by`);

--
-- Indexes for table `tb_building`
--
ALTER TABLE `tb_building`
  ADD PRIMARY KEY (`build_id`);

--
-- Indexes for table `tb_company`
--
ALTER TABLE `tb_company`
  ADD PRIMARY KEY (`cmp_id`);

--
-- Indexes for table `tb_department`
--
ALTER TABLE `tb_department`
  ADD PRIMARY KEY (`dep_id`);

--
-- Indexes for table `tb_equipment`
--
ALTER TABLE `tb_equipment`
  ADD PRIMARY KEY (`eq_id`);

--
-- Indexes for table `tb_login_log`
--
ALTER TABLE `tb_login_log`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `tb_notification`
--
ALTER TABLE `tb_notification`
  ADD PRIMARY KEY (`notify_id`),
  ADD KEY `idx_tb_notification_user_id` (`user_id`),
  ADD KEY `idx_tb_notification_r_no` (`r_no`),
  ADD KEY `idx_tb_notification_is_read` (`is_read`);

--
-- Indexes for table `tb_position`
--
ALTER TABLE `tb_position`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `tb_repair`
--
ALTER TABLE `tb_repair`
  ADD PRIMARY KEY (`no`,`r_no`),
  ADD KEY `idx_tb_repair_r_save` (`r_save`),
  ADD KEY `idx_tb_repair_s_id` (`s_id`),
  ADD KEY `idx_tb_repair_u_idcard` (`u_idcard`),
  ADD KEY `idx_tb_repair_technician_id` (`technician_id`),
  ADD KEY `idx_tb_repair_eq_id` (`eq_id`),
  ADD KEY `idx_tb_repair_build_id` (`build_id`),
  ADD KEY `idx_tb_repair_wl_id` (`wl_id`);

--
-- Indexes for table `tb_repair_attachment`
--
ALTER TABLE `tb_repair_attachment`
  ADD PRIMARY KEY (`attachment_id`),
  ADD KEY `idx_tb_repair_attachment_r_no` (`r_no`),
  ADD KEY `idx_tb_repair_attachment_uploaded_by` (`uploaded_by`);

--
-- Indexes for table `tb_repair_comment`
--
ALTER TABLE `tb_repair_comment`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `idx_tb_repair_comment_r_no` (`r_no`),
  ADD KEY `idx_tb_repair_comment_user_id` (`user_id`);

--
-- Indexes for table `tb_repair_log`
--
ALTER TABLE `tb_repair_log`
  ADD PRIMARY KEY (`rlog_id`),
  ADD KEY `idx_tb_repair_log_r_no` (`r_no`),
  ADD KEY `idx_tb_repair_log_s_id` (`s_id`),
  ADD KEY `idx_tb_repair_log_user_id` (`user_id`),
  ADD KEY `idx_tb_repair_log_technician_id` (`technician_id`);

--
-- Indexes for table `tb_sla_rule`
--
ALTER TABLE `tb_sla_rule`
  ADD PRIMARY KEY (`sla_id`),
  ADD KEY `idx_tb_sla_rule_eq_id` (`eq_id`),
  ADD KEY `idx_tb_sla_rule_wl_id` (`wl_id`);

--
-- Indexes for table `tb_status`
--
ALTER TABLE `tb_status`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`u_idcard`);

--
-- Indexes for table `tb_user_level`
--
ALTER TABLE `tb_user_level`
  ADD PRIMARY KEY (`level_id`);

--
-- Indexes for table `tb_work_level`
--
ALTER TABLE `tb_work_level`
  ADD PRIMARY KEY (`wl_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_assignment_history`
--
ALTER TABLE `tb_assignment_history`
  MODIFY `assign_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_login_log`
--
ALTER TABLE `tb_login_log`
  MODIFY `log_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `tb_notification`
--
ALTER TABLE `tb_notification`
  MODIFY `notify_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_repair`
--
ALTER TABLE `tb_repair`
  MODIFY `no` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_repair_attachment`
--
ALTER TABLE `tb_repair_attachment`
  MODIFY `attachment_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_repair_comment`
--
ALTER TABLE `tb_repair_comment`
  MODIFY `comment_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_repair_log`
--
ALTER TABLE `tb_repair_log`
  MODIFY `rlog_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tb_sla_rule`
--
ALTER TABLE `tb_sla_rule`
  MODIFY `sla_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
