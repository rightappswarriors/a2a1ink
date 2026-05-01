-- 1. Add logo column to accounts table (for organization logo)
ALTER TABLE `accounts` 
ADD COLUMN `logo` VARCHAR(255) NULL AFTER `email`;

-- 2. Add photo column to consumers table (for consumer photo)
ALTER TABLE `consumers` 
ADD COLUMN `photo` VARCHAR(255) NULL AFTER `mobileno`;