-- Add agent and marketing commission breakdown fields
-- Run this to add the new columns to track both commission types

ALTER TABLE `agentregularprogrambuyrequest` 
ADD COLUMN `agent_commission_per_unit` DECIMAL(11,2) NOT NULL DEFAULT 0 COMMENT '2% agent commission per unit' AFTER `commission_per_unit`,
ADD COLUMN `marketing_commission_per_unit` DECIMAL(11,2) NOT NULL DEFAULT 0 COMMENT '3% marketing commission per unit' AFTER `agent_commission_per_unit`,
ADD COLUMN `agent_commission_amount` DECIMAL(11,2) NOT NULL DEFAULT 0 COMMENT 'Total agent commission' AFTER `commission_amount`,
ADD COLUMN `marketing_commission_amount` DECIMAL(11,2) NOT NULL DEFAULT 0 COMMENT 'Total marketing commission' AFTER `agent_commission_amount`;
