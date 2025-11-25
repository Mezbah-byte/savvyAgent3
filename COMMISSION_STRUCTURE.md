# Commission Structure Update

## ✅ Changes Made

### Commission Breakdown:
- **Agent Commission**: 2% of program price
- **Marketing Commission**: 3% of program price  
- **Total Commission**: 5% of program price

### Example Calculation:
If program price = 1000 ৳
- Agent Commission (2%): 20 ৳
- Marketing Commission (3%): 30 ৳
- Total Discount: 50 ৳
- Agent Pays: 950 ৳

---

## 📋 Files Updated

### 1. Controller (`RegularProgram.php`)
- ✅ Commission calculation with 2% + 3% breakdown
- ✅ Saves both commission types to database

### 2. View (`buy_regular_program.php`)
- ✅ Shows commission breakdown in alert
- ✅ Price details show both commissions separately
- ✅ Live JavaScript calculation updated

### 3. Database Enhancement (`add_commission_fields.sql`)
New fields added to track commission breakdown:
- `agent_commission_per_unit` - 2% per unit
- `marketing_commission_per_unit` - 3% per unit
- `agent_commission_amount` - Total agent commission
- `marketing_commission_amount` - Total marketing commission

---

## 🚀 Installation Steps

### Step 1: Fix Collation (If not done)
```sql
ALTER TABLE `regular_program_packages` 
MODIFY `un_id` VARCHAR(111) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;
```

### Step 2: Add Commission Fields
```sql
SOURCE db/add_commission_fields.sql;
```

### Step 3: Test
1. Go to Regular Programs
2. Click "Buy Program"
3. You should see commission breakdown:
   - Agent (2%): XX ৳
   - Marketing (3%): XX ৳
   - Total (5%): XX ৳

---

## 📊 Price Display

The buy form now shows:

```
Price Details
─────────────────────────────
Bag Total:                1000.00
  Agent Commission (2%):   -20.00
  Marketing Commission (3%): -30.00
Total Commission (5%):     -50.00
─────────────────────────────
Order Total:               950.00
Total Payable:             950.00
```

---

## 🎯 What's Tracked

Every buy request now stores:
1. Total commission (5%)
2. Agent commission breakdown (2%)
3. Marketing commission breakdown (3%)

This allows for:
- Detailed reporting
- Commission tracking per type
- Transparency in calculations

---

## ⚡ Live Calculation

When you change quantity, the JavaScript automatically recalculates:
- Bag total
- Agent commission (2%)
- Marketing commission (3%)
- Total commission (5%)
- Final payable amount

All in real-time! 🎉
