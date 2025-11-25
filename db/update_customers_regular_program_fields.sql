-- Add regular program balance fields to customers table
-- These fields track update amounts and withdrawable amounts for regular program bonuses

-- Check if columns exist before adding them
-- If they don't exist, add them with default values

ALTER TABLE `customers` 
ADD COLUMN IF NOT EXISTS `current_regular_program_package_id` varchar(111) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT 'Current active regular program package',
ADD COLUMN IF NOT EXISTS `current_regular_program_update_amount` decimal(10,2) NOT NULL DEFAULT 0.00 COMMENT 'Current update balance',
ADD COLUMN IF NOT EXISTS `total_regular_program_update_amount` decimal(10,2) NOT NULL DEFAULT 0.00 COMMENT 'Total update balance received',
ADD COLUMN IF NOT EXISTS `current_regular_program_withdraw_amount` decimal(10,2) NOT NULL DEFAULT 0.00 COMMENT 'Current withdrawable balance',
ADD COLUMN IF NOT EXISTS `total_regular_program_withdraw_amount` decimal(10,2) NOT NULL DEFAULT 0.00 COMMENT 'Total withdrawable balance received',
ADD COLUMN IF NOT EXISTS `regular_program_wallet` decimal(10,2) NOT NULL DEFAULT 0.00 COMMENT 'Regular program wallet balance',
ADD COLUMN IF NOT EXISTS `refered_by` varchar(111) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT 'Referrer user ID',
ADD COLUMN IF NOT EXISTS `placement_id` varchar(111) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT 'Placement user ID in binary tree';

-- Add indexes for better performance
ALTER TABLE `customers`
ADD INDEX IF NOT EXISTS `idx_current_package` (`current_regular_program_package_id`),
ADD INDEX IF NOT EXISTS `idx_refered_by` (`refered_by`),
ADD INDEX IF NOT EXISTS `idx_placement` (`placement_id`);
