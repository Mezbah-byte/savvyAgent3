-- Fix collation mismatch for regular program tables
-- Run this SQL to fix the collation error

-- Update regular_program_packages table to use utf8mb4_unicode_ci
ALTER TABLE `regular_program_packages` 
  CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Update specific columns to ensure consistency
ALTER TABLE `regular_program_packages` 
  MODIFY `un_id` varchar(111) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  MODIFY `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  MODIFY `details` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;

-- Verify the changes
SELECT 
    TABLE_NAME,
    COLUMN_NAME,
    COLLATION_NAME
FROM 
    INFORMATION_SCHEMA.COLUMNS
WHERE 
    TABLE_SCHEMA = DATABASE()
    AND TABLE_NAME IN ('regular_program_packages', 'agentregularprogrambuyrequest', 'agentregularprograms', 'user_regular_programs')
    AND COLLATION_NAME IS NOT NULL
ORDER BY 
    TABLE_NAME, COLUMN_NAME;
