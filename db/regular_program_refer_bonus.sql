-- phpMyAdmin SQL Dump
-- Table structure for table `regular_program_refer_bonus`
-- This table stores referral, generation, and royalty bonuses for regular program purchases

CREATE TABLE IF NOT EXISTS `regular_program_refer_bonus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_un_id` varchar(111) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'User who made the purchase',
  `receiver_un_id` varchar(111) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'User receiving the bonus',
  `update_amount` decimal(10,2) NOT NULL DEFAULT 0.00 COMMENT 'Amount added to update balance',
  `withdrawable_amount` decimal(10,2) NOT NULL DEFAULT 0.00 COMMENT 'Amount added to withdrawable balance',
  `package_id` varchar(111) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Regular program package ID',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=Active, 0=Inactive',
  `level` int(11) NOT NULL DEFAULT 0 COMMENT '0=Direct referral, 1-9=Generation levels, 100=Royalty',
  `source` enum('referal','generation','royalty') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'referal' COMMENT 'Bonus source type',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `sender_un_id` (`sender_un_id`),
  KEY `receiver_un_id` (`receiver_un_id`),
  KEY `package_id` (`package_id`),
  KEY `source` (`source`),
  KEY `level` (`level`),
  KEY `created_at` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Add indexes for faster queries
ALTER TABLE `regular_program_refer_bonus`
  ADD INDEX `idx_receiver_source` (`receiver_un_id`, `source`),
  ADD INDEX `idx_receiver_level` (`receiver_un_id`, `level`),
  ADD INDEX `idx_sender_created` (`sender_un_id`, `created_at`);
