-- Schema for agent_mobile_recharge table used by Recharge_model
CREATE TABLE IF NOT EXISTS `agent_mobile_recharge` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_un_id` VARCHAR(64) NOT NULL,
  `tran_id` VARCHAR(64) NOT NULL,
  `number` VARCHAR(20) NOT NULL,
  `operator` VARCHAR(16) NOT NULL,
  `type` TINYINT(1) NOT NULL COMMENT '1=Prepaid, 2=Postpaid',
  `amount` DECIMAL(10,2) NOT NULL,
  `status` TINYINT(1) NOT NULL DEFAULT 0 COMMENT '0=Pending,1=Success,2=Failed',
  `http_code` INT NULL,
  `message` VARCHAR(255) NULL,
  `api_response` MEDIUMTEXT NULL,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_tran_id` (`tran_id`),
  KEY `idx_user_date` (`user_un_id`, `created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
