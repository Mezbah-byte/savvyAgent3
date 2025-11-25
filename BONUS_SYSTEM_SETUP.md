# Regular Program Bonus System Setup Guide

## Overview
This system implements a complete bonus distribution mechanism for regular program purchases made through agent payment. When an agent approves a customer's order, the system automatically distributes:
- **Direct Referral Bonus**: 5% (10% split in half)
- **Generation Bonuses**: 0.5% (1% split in half) for 9 levels up
- **Royalty Bonus**: 30% distributed equally among all eligible users

## Database Setup

### 1. Fix Collation Error (REQUIRED)
Run this first to fix the JOIN error:
```sql
ALTER TABLE `regular_program_packages` 
MODIFY `un_id` VARCHAR(111) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;
```

### 2. Create Bonus Tracking Table
Run: `db/regular_program_refer_bonus.sql`

This creates the table that stores all bonus records with:
- Sender and receiver tracking
- Bonus amounts (update + withdrawable)
- Bonus type (referral/generation/royalty)
- Level tracking

### 3. Update Customers Table
Run: `db/update_customers_regular_program_fields.sql`

This adds fields to `customers` table:
- `current_regular_program_package_id` - Current active package
- `current_regular_program_update_amount` - Current update balance
- `total_regular_program_update_amount` - Total update balance
- `current_regular_program_withdraw_amount` - Current withdrawable balance
- `total_regular_program_withdraw_amount` - Total withdrawable balance
- `regular_program_wallet` - Wallet balance for direct purchases
- `refered_by` - Referrer's un_id
- `placement_id` - Placement in binary tree

## How It Works

### Customer Purchase Flow
1. Customer browses regular programs
2. Customer selects agent payment method
3. Customer uploads payment screenshot and submits order
4. Order status = 0 (Pending)

### Agent Approval Flow (NEW - WITH BONUSES)
1. Agent views pending orders
2. Agent clicks "Accept Order"
3. **System automatically executes:**
   - Updates order status to 1 (Approved)
   - Updates agent inventory (reduces available programs)
   - Sets customer's `current_regular_program_package_id`
   - Upgrades customer from 'open' to 'premium' type (if applicable)
   - **Sends Direct Referral Bonus** (5% to referrer)
   - **Sends Generation Bonuses** (0.5% to 9 levels up)
   - **Sends Royalty Bonus** (30% distributed to all eligible users)
4. All bonuses recorded in `regular_program_refer_bonus` table
5. User balances updated atomically in `customers` table

## Bonus Calculation Details

### Direct Referral Bonus (Level 0)
- **Amount**: 10% / 2 = 5% of package price × quantity
- **Condition**: Referrer must have `current_regular_program_package_id` set
- **Example**: If package = 1000 TK, quantity = 2
  - Bonus = (1000 × 10% / 2) × 2 = 100 TK
  - Update amount = 100 TK
  - Withdrawable amount = 100 TK

### Generation Bonuses (Level 1-9)
- **Amount**: 1% / 2 = 0.5% of package price × quantity
- **Levels**: Goes up 9 levels in referral chain
- **Condition**: Each upline must have `current_regular_program_package_id` set
- **Example**: Same package (1000 TK × 2)
  - Each level bonus = (1000 × 1% / 2) × 2 = 10 TK
  - Distributed to up to 9 upline members

### Royalty Bonus (Level 100)
- **Amount**: 30% of package price × quantity
- **Distribution**: Split equally among all eligible users (excluding sender)
- **Eligibility**: 
  - If sender has < 7 total packages: All users with packages
  - If sender has ≥ 7 total packages: Only users with ≥ 7 packages
- **Example**: If package = 1000 TK × 2, and 10 eligible users exist
  - Total royalty = 1000 × 30% × 2 = 600 TK
  - Per user = 600 / 10 = 60 TK
  - Update amount = 30 TK per user
  - Withdrawable amount = 30 TK per user

## Database Fields Explanation

### Bonus Tracking (`regular_program_refer_bonus`)
```
- sender_un_id: User who made the purchase
- receiver_un_id: User receiving the bonus
- update_amount: Added to current_regular_program_update_amount
- withdrawable_amount: Added to current_regular_program_withdraw_amount
- level: 0=Direct referral, 1-9=Generation, 100=Royalty
- source: 'referal', 'generation', or 'royalty'
```

### Customer Balances (`customers`)
```
- current_regular_program_update_amount: Can be used for upgrades/features
- current_regular_program_withdraw_amount: Can be withdrawn as cash
- total_regular_program_update_amount: Lifetime earnings (update)
- total_regular_program_withdraw_amount: Lifetime earnings (withdrawable)
```

## Testing the System

### Test Scenario
1. Create 3 test users (A, B, C)
2. Set B's `refered_by` = A's un_id
3. Set C's `refered_by` = B's un_id
4. Give A and B a `current_regular_program_package_id`
5. Create agent buy request and get it approved by admin
6. Customer C buys regular program through agent
7. Agent approves C's order

### Expected Results
- **User A** (2 levels up): 
  - Generation bonus (level 2): 0.5% of package price
  - Royalty bonus: Share of 30%
  
- **User B** (direct referrer):
  - Direct referral bonus (level 0): 5% of package price
  - Royalty bonus: Share of 30%
  
- **User C** (buyer):
  - Gets package assigned
  - Upgraded to 'premium' type
  - No bonus (is the sender)
  
- **All other users with packages**:
  - Royalty bonus: Equal share of 30%

### Verify in Database
```sql
-- Check bonuses distributed
SELECT * FROM regular_program_refer_bonus 
WHERE sender_un_id = 'C_un_id' 
ORDER BY level, created_at;

-- Check user balances
SELECT un_id, 
       current_regular_program_update_amount,
       current_regular_program_withdraw_amount
FROM customers 
WHERE un_id IN ('A_un_id', 'B_un_id', 'C_un_id');
```

## Important Notes

1. **Atomic Updates**: All balance increments use SQL `SET field = field + amount` to prevent race conditions

2. **Error Handling**: Bonus functions return true/false and log errors to CodeIgniter logs

3. **Performance**: Royalty calculation can be expensive with many users - consider caching or background processing for large user bases

4. **Referral Chain**: Generation bonuses stop at level 9 or when no more upline referrers exist

5. **Type Upgrade**: Only 'open' type users are upgraded to 'premium' on first purchase

## Files Modified

### Controller
- `application/controllers/RegularProgram.php`
  - Added `sendReferBonus()` method
  - Added `sendRoyality()` method
  - Enhanced `acceptOrder()` to trigger bonus distribution

### Model
- `application/models/RegularProgram_model.php`
  - Added `userRegularPackagesList()`
  - Added `updateUserWallet()`
  - Added `addRegularProgramReferBonus()`
  - Added `incrementUserRegularProgramAmounts()`
  - Added `getAllRegularProgramIds()`
  - Added `getAllsevenAboveUsers()`

### Database
- `db/regular_program_refer_bonus.sql` - Bonus tracking table
- `db/update_customers_regular_program_fields.sql` - Customer balance fields

## Troubleshooting

### Bonuses Not Being Distributed
1. Check if order status changed to 1
2. Verify customer has `refered_by` set
3. Check if referrers have `current_regular_program_package_id`
4. Check CodeIgniter logs for errors: `application/logs/`

### Collation Errors
1. Run the QUICK_FIX.sql again
2. Verify all tables use `utf8mb4_unicode_ci`

### Balance Not Updating
1. Check if `regular_program_refer_bonus` records exist
2. Verify SQL syntax in `incrementUserRegularProgramAmounts()`
3. Check database permissions for UPDATE operations
