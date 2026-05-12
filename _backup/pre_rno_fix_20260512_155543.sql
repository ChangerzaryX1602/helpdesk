-- MySQL dump 10.13  Distrib 9.6.0, for macos26.2 (arm64)
--
-- Host: localhost    Database: helpdeskv1
-- ------------------------------------------------------
-- Server version	9.6.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
SET @MYSQLDUMP_TEMP_LOG_BIN = @@SESSION.SQL_LOG_BIN;
SET @@SESSION.SQL_LOG_BIN= 0;

--
-- GTID state at the beginning of the backup 
--

SET @@GLOBAL.GTID_PURGED=/*!80000 '+'*/ '7b1b882e-443f-11f1-bddf-196bcbb839f4:1-73';

--
-- Table structure for table `tb_repair`
--

DROP TABLE IF EXISTS `tb_repair`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_repair` (
  `r_no` varchar(7) NOT NULL COMMENT 'เลขที่แจ้งซ่อม',
  `u_idcard` varchar(13) NOT NULL COMMENT 'ผู้แจ้งซ่อม',
  `eq_id` int NOT NULL COMMENT 'อุปกรณ์',
  `comp_id` int DEFAULT NULL COMMENT 'อ้างอิงทะเบียนคอมพิวเตอร์',
  `r_name` varchar(200) NOT NULL COMMENT 'ชื่ออุปกรณ์',
  `r_serialnumber` varchar(150) NOT NULL COMMENT 'หมายเลขเครื่อง',
  `r_detail` text NOT NULL COMMENT 'อาการหรือสาเหตุ',
  `symptom_summary` varchar(255) DEFAULT NULL,
  `resolution_text` text,
  `repair_cost` decimal(10,2) NOT NULL DEFAULT '0.00',
  `build_id` int NOT NULL COMMENT 'อาคารหรือตึก',
  `floor` varchar(100) NOT NULL COMMENT 'ชั้นอาคาร',
  `room` varchar(100) NOT NULL COMMENT 'ห้อง',
  `no` int NOT NULL AUTO_INCREMENT,
  `s_id` char(1) NOT NULL COMMENT 'สถานะ',
  `head_id` varchar(13) NOT NULL COMMENT 'หัวหน้างาน',
  `technician_id` varchar(13) NOT NULL COMMENT 'ช่าง',
  `r_save` datetime NOT NULL COMMENT 'วันที่แจ้งซ่อม',
  `accepted_at` datetime DEFAULT NULL,
  `started_at` datetime DEFAULT NULL,
  `completed_at` datetime DEFAULT NULL,
  `closed_at` datetime DEFAULT NULL,
  `sla_due_at` datetime DEFAULT NULL,
  `wl_id` char(1) NOT NULL COMMENT 'ระดับความสำคัญงาน',
  PRIMARY KEY (`no`,`r_no`),
  KEY `idx_tb_repair_r_save` (`r_save`),
  KEY `idx_tb_repair_s_id` (`s_id`),
  KEY `idx_tb_repair_u_idcard` (`u_idcard`),
  KEY `idx_tb_repair_technician_id` (`technician_id`),
  KEY `idx_tb_repair_eq_id` (`eq_id`),
  KEY `idx_tb_repair_build_id` (`build_id`),
  KEY `idx_tb_repair_wl_id` (`wl_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_repair`
--

LOCK TABLES `tb_repair` WRITE;
/*!40000 ALTER TABLE `tb_repair` DISABLE KEYS */;
INSERT INTO `tb_repair` VALUES ('R1','1234567891234',1,NULL,'Dell inspiron 3501','xxx-xxxx-xx-xx-x','No Internet ',NULL,NULL,0.00,1,'3','301',1,'3','4444444444444','2222222222222','2021-11-10 22:30:43',NULL,NULL,NULL,NULL,NULL,'1'),('R2','6666666666666',2,NULL,'Canon G3000','123-1234-11-11-1','Print Error',NULL,NULL,0.00,3,'2','202',2,'4','4444444444444','2222222222222','2021-11-10 22:33:54',NULL,NULL,NULL,NULL,NULL,'2'),('R3','6666666666666',5,NULL,'Acer 1234','123-1234-11-11-1','won\'t turn on',NULL,NULL,0.00,3,'2','202',3,'4','4444444444444','2222222222222','2021-11-10 22:34:01','2026-03-17 13:52:55','2026-03-17 13:52:55','2026-03-17 13:52:55','2026-03-17 13:52:55',NULL,'3'),('R4','3333333333333',1,NULL,'ssssssssssss','s21223212','sadsadasd',NULL,NULL,0.00,2,'1','310',4,'1','22','22','2024-11-14 04:43:25',NULL,NULL,NULL,NULL,NULL,'1'),('R5','3333333333333',1,NULL,'macbook 2022','s21223212','sssss',NULL,NULL,0.00,1,'10','310',5,'1','22','22','2025-02-04 06:20:56',NULL,NULL,NULL,NULL,NULL,'1'),('R6','3333333333333',3,NULL,'macbook 2022','s21223212','xxss',NULL,NULL,0.00,2,'10','310',6,'1','22','22','2025-02-04 06:21:20',NULL,NULL,NULL,NULL,NULL,'1'),('R7','1234567891234',1,NULL,'macbook 2022','s21223212','test','test',NULL,0.00,2,'10','310',7,'1','','','2026-03-17 06:54:13',NULL,NULL,NULL,NULL,'2026-03-17 14:54:13','3'),('R8','1234567891234',1,NULL,'macbook 2022','s21223212','test','test',NULL,0.00,2,'10','310',8,'2','1234567891234','2222222222222','2026-03-17 06:55:26',NULL,NULL,NULL,NULL,'2026-03-17 14:55:26','3');
/*!40000 ALTER TABLE `tb_repair` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_repair_log`
--

DROP TABLE IF EXISTS `tb_repair_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_repair_log` (
  `rlog_id` bigint NOT NULL AUTO_INCREMENT,
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
  `rlog_save` datetime NOT NULL,
  PRIMARY KEY (`rlog_id`),
  KEY `idx_tb_repair_log_r_no` (`r_no`),
  KEY `idx_tb_repair_log_s_id` (`s_id`),
  KEY `idx_tb_repair_log_user_id` (`user_id`),
  KEY `idx_tb_repair_log_technician_id` (`technician_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_repair_log`
--

LOCK TABLES `tb_repair_log` WRITE;
/*!40000 ALTER TABLE `tb_repair_log` DISABLE KEYS */;
INSERT INTO `tb_repair_log` VALUES (1,'R1',NULL,NULL,NULL,'2','2222222222222','4444444444444','DESKTOP-KD8O937','::1','Chrome','2021-11-10 22:37:50'),(2,'R2',NULL,NULL,NULL,'2','2222222222222','4444444444444','DESKTOP-KD8O937','::1','Chrome','2021-11-10 22:37:57'),(3,'R3',NULL,NULL,NULL,'2','2222222222222','4444444444444','DESKTOP-KD8O937','::1','Chrome','2021-11-10 22:38:06'),(4,'R1',NULL,NULL,NULL,'2','2222222222222','4444444444444','DESKTOP-KD8O937','::1','Chrome','2021-11-10 23:00:47'),(5,'R2',NULL,NULL,NULL,'2','2222222222222','4444444444444','DESKTOP-KD8O937','::1','Chrome','2021-11-10 23:00:56'),(6,'R3',NULL,NULL,NULL,'2','2222222222222','4444444444444','DESKTOP-KD8O937','::1','Chrome','2021-11-10 23:01:05'),(7,'R1',NULL,NULL,NULL,'3','2222222222222','2222222222222','DESKTOP-KD8O937','::1','Chrome','2021-11-10 23:10:03'),(8,'R2',NULL,NULL,NULL,'4','2222222222222','2222222222222','DESKTOP-KD8O937','::1','Chrome','2021-11-10 23:10:13'),(9,'R3','status_update','2','อัปเดตสถานะเป็น Successfully','4','2222222222222','2222222222222','LAPTOP-POOLFJIT','::1','Chrome','2026-03-17 06:52:55'),(10,'R8','create',NULL,'เจ้าหน้าที่สร้างรายการแจ้งซ่อมแทนผู้ใช้','1','','4444444444444','LAPTOP-POOLFJIT','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Sa','2026-03-17 06:55:26'),(11,'R8','assign','1','มอบหมายงานให้ช่างผู้รับผิดชอบ','2','2222222222222','1234567891234','LAPTOP-POOLFJIT','::1','Chrome','2026-03-17 07:00:04'),(12,'R8','comment','2','เพิ่มหมายเหตุในงานซ่อม','2','2222222222222','1234567891234','LAPTOP-POOLFJIT','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Sa','2026-03-17 11:17:55');
/*!40000 ALTER TABLE `tb_repair_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_repair_comment`
--

DROP TABLE IF EXISTS `tb_repair_comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_repair_comment` (
  `comment_id` bigint NOT NULL AUTO_INCREMENT,
  `r_no` varchar(7) COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `comment_text` text COLLATE utf8mb4_general_ci NOT NULL,
  `comment_type` varchar(30) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'comment',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`comment_id`),
  KEY `idx_tb_repair_comment_r_no` (`r_no`),
  KEY `idx_tb_repair_comment_user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_repair_comment`
--

LOCK TABLES `tb_repair_comment` WRITE;
/*!40000 ALTER TABLE `tb_repair_comment` DISABLE KEYS */;
INSERT INTO `tb_repair_comment` VALUES (1,'R3','2222222222222','อัปเดตสถานะเป็น Successfully','status','2026-03-17 13:52:55'),(2,'R7','1234567891234','สร้างรายการแจ้งซ่อมโดยเจ้าหน้าที่: test','create','2026-03-17 13:54:13'),(3,'R8','1234567891234','สร้างรายการแจ้งซ่อมโดยเจ้าหน้าที่: test','create','2026-03-17 13:55:26'),(4,'R8','1234567891234','มอบหมายงานให้ช่างเรียบร้อยแล้ว','assignment','2026-03-17 14:00:04'),(5,'R8','1234567891234','test','comment','2026-03-17 18:17:55');
/*!40000 ALTER TABLE `tb_repair_comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_assignment_history`
--

DROP TABLE IF EXISTS `tb_assignment_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_assignment_history` (
  `assign_id` bigint NOT NULL AUTO_INCREMENT,
  `r_no` varchar(7) COLLATE utf8mb4_general_ci NOT NULL,
  `from_user_id` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `to_user_id` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `assigned_by` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `assign_note` text COLLATE utf8mb4_general_ci,
  `assigned_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`assign_id`),
  KEY `idx_tb_assignment_history_r_no` (`r_no`),
  KEY `idx_tb_assignment_history_to_user_id` (`to_user_id`),
  KEY `idx_tb_assignment_history_assigned_by` (`assigned_by`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_assignment_history`
--

LOCK TABLES `tb_assignment_history` WRITE;
/*!40000 ALTER TABLE `tb_assignment_history` DISABLE KEYS */;
INSERT INTO `tb_assignment_history` VALUES (1,'R8',NULL,'2222222222222','1234567891234','มอบหมายงานซ่อม','2026-03-17 14:00:04');
/*!40000 ALTER TABLE `tb_assignment_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_notification`
--

DROP TABLE IF EXISTS `tb_notification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_notification` (
  `notify_id` bigint NOT NULL AUTO_INCREMENT,
  `user_id` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `r_no` varchar(7) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `message` text COLLATE utf8mb4_general_ci NOT NULL,
  `is_read` char(1) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`notify_id`),
  KEY `idx_tb_notification_user_id` (`user_id`),
  KEY `idx_tb_notification_r_no` (`r_no`),
  KEY `idx_tb_notification_is_read` (`is_read`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_notification`
--

LOCK TABLES `tb_notification` WRITE;
/*!40000 ALTER TABLE `tb_notification` DISABLE KEYS */;
INSERT INTO `tb_notification` VALUES (1,'6666666666666','R3','สถานะงานซ่อมมีการเปลี่ยนแปลง','อัปเดตสถานะเป็น Successfully','0','2026-03-17 13:52:55'),(2,'2222222222222','R8','คุณได้รับมอบหมายงานซ่อม','มีการมอบหมายงานเลขที่ R8 ให้คุณดำเนินการ','1','2026-03-17 14:00:04');
/*!40000 ALTER TABLE `tb_notification` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_repair_attachment`
--

DROP TABLE IF EXISTS `tb_repair_attachment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_repair_attachment` (
  `attachment_id` bigint NOT NULL AUTO_INCREMENT,
  `r_no` varchar(7) COLLATE utf8mb4_general_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `file_ext` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `file_size` int DEFAULT NULL,
  `uploaded_by` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `uploaded_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`attachment_id`),
  KEY `idx_tb_repair_attachment_r_no` (`r_no`),
  KEY `idx_tb_repair_attachment_uploaded_by` (`uploaded_by`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_repair_attachment`
--

LOCK TABLES `tb_repair_attachment` WRITE;
/*!40000 ALTER TABLE `tb_repair_attachment` DISABLE KEYS */;
INSERT INTO `tb_repair_attachment` VALUES (1,'R8','logo2.png','uploads/repair_attachments/R8_20260317111755_8999_logo2.png','png',170384,'1234567891234','2026-03-17 18:17:55');
/*!40000 ALTER TABLE `tb_repair_attachment` ENABLE KEYS */;
UNLOCK TABLES;
SET @@SESSION.SQL_LOG_BIN = @MYSQLDUMP_TEMP_LOG_BIN;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-05-12 15:55:44
