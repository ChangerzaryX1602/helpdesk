-- ระบบทะเบียนอุปกรณ์ (Equipment Registry)
-- Run this on the `helpdeskv1` database

CREATE TABLE IF NOT EXISTS `tb_equipment_registry` (
  `reg_id` INT NOT NULL AUTO_INCREMENT,
  `dep_id` INT NOT NULL,
  `eq_id` INT NOT NULL,
  `reg_brand_model` VARCHAR(255) NOT NULL DEFAULT '',
  `com_num1` VARCHAR(50) NULL,
  `com_num2` VARCHAR(20) NULL,
  `reg_computer_name` VARCHAR(150) NOT NULL DEFAULT '',
  `reg_user_name` VARCHAR(255) NOT NULL DEFAULT '',
  `reg_cpu` VARCHAR(150) NOT NULL DEFAULT '',
  `reg_ram` VARCHAR(100) NOT NULL DEFAULT '',
  `reg_harddisk` VARCHAR(150) NOT NULL DEFAULT '',
  `reg_monitor` VARCHAR(150) NOT NULL DEFAULT '',
  `reg_os` VARCHAR(150) NOT NULL DEFAULT '',
  `reg_ip` VARCHAR(50) NOT NULL DEFAULT '',
  `reg_subnet` VARCHAR(50) NOT NULL DEFAULT '',
  `reg_gateway` VARCHAR(50) NOT NULL DEFAULT '',
  `reg_peripherals` VARCHAR(255) NOT NULL DEFAULT '',
  `reg_switch_port` VARCHAR(150) NOT NULL DEFAULT '',
  `reg_save` DATETIME NOT NULL,
  PRIMARY KEY (`reg_id`),
  KEY `idx_dep_id` (`dep_id`),
  KEY `idx_eq_id` (`eq_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
