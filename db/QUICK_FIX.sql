-- QUICK FIX: Run this single command in phpMyAdmin or MySQL console
-- This will fix the collation mismatch immediately

ALTER TABLE `regular_program_packages` 
MODIFY `un_id` VARCHAR(111) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;
