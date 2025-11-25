# Quick Setup - Regular Program Bonus System

## 3-Step Database Setup

### Step 1: Fix Collation (CRITICAL)
```sql
ALTER TABLE `regular_program_packages` 
MODIFY `un_id` VARCHAR(111) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;
```

### Step 2: Create Bonus Table
Run file: `db/regular_program_refer_bonus.sql`

### Step 3: Update Customers Table
Run file: `db/update_customers_regular_program_fields.sql`

---

## How Bonuses Work

When agent **accepts** customer order, system automatically sends:

### 1. Direct Referral Bonus (5%)
- To: Customer's direct referrer
- Amount: 10% ÷ 2 = **5% of price × quantity**
- Condition: Referrer must have a regular program package

### 2. Generation Bonuses (0.5% each)
- To: 9 levels up in referral chain
- Amount: 1% ÷ 2 = **0.5% of price × quantity** per level
- Condition: Each upline must have a regular program package

### 3. Royalty Bonus (30% total)
- To: All users with regular program packages (except buyer)
- Amount: **30% of price × quantity** divided equally
- Special: If buyer has ≥7 packages, only users with ≥7 packages get royalty

---

## Example Calculation

**Package**: 1000 TK  
**Quantity**: 2  
**Total**: 2000 TK

### Direct Referral
- (1000 × 10% ÷ 2) × 2 = **100 TK**

### Generation (per level)
- (1000 × 1% ÷ 2) × 2 = **10 TK**

### Royalty (10 eligible users)
- Total: 1000 × 30% × 2 = 600 TK
- Per user: 600 ÷ 10 = **60 TK each**

---

## Test It

1. Collation fix: Run Step 1 SQL
2. Create tables: Run Step 2 & 3 files
3. Agent approves any pending order
4. Check `regular_program_refer_bonus` table for bonus records
5. Check `customers` table for updated balance fields

---

## Balance Fields in `customers` Table

- `current_regular_program_update_amount` - Can use for features
- `current_regular_program_withdraw_amount` - Can withdraw as cash
- `total_regular_program_update_amount` - Lifetime update earnings
- `total_regular_program_withdraw_amount` - Lifetime withdrawable earnings

---

## Important Notes

✅ All bonuses split 50/50 between update amount and withdrawable amount  
✅ Bonuses only go to users who have `current_regular_program_package_id` set  
✅ First-time buyers upgraded from 'open' to 'premium' type  
✅ All balance updates are atomic (thread-safe)  

📖 For detailed documentation, see: `BONUS_SYSTEM_SETUP.md`
