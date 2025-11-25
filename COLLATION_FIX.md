# Quick Fix for Collation Error

## The Problem
The `regular_program_packages` table uses `utf8mb4_general_ci` collation, while the new tables use `utf8mb4_unicode_ci`. This causes the JOIN error.

## Solution

Run this SQL command in your database:

```sql
ALTER TABLE `regular_program_packages` 
  CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

Or run the complete fix file:
```sql
SOURCE db/fix_collation.sql;
```

## What This Does
- Converts the `regular_program_packages` table to use `utf8mb4_unicode_ci`
- Makes it match the collation of all other tables
- Fixes the JOIN error immediately

## After Running
Refresh your page and the error should be gone!
