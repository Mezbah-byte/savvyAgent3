# sendRoyality Function - Complete Documentation

## Purpose
Distributes a 30% royalty bonus from a package purchase to all eligible users in the system. The distribution is weighted by the number of packages each user owns.

## Function Signature
```php
private function sendRoyality($sender, $packageId, $packageQuantity)
```

## Parameters
- **`$sender`** (string): The user_un_id who made the purchase
- **`$packageId`** (string): The regular_program_package un_id that was purchased
- **`$packageQuantity`** (int): The quantity of packages purchased

## Return Value
- Returns `true` on successful distribution
- Returns `false` if package details or sender details are missing
- Catches exceptions and logs errors, then returns `false`

---

## Core Logic Flow

### Step 1: Fetch Package & Sender Details
```php
$packageDetails = $this->RegularProgram_model->packageDetails($packageId);
$senderDetails = $this->Basic_model->getUserDetails($sender);

if (!$packageDetails || !$senderDetails) {
    return false;
}
```
**Purpose:**
- Get package price and details
- Get sender's user information
- Validate that both exist before proceeding

---

### Step 2: Calculate Sender's Total Package Count
```php
$senderCurrentPackageCount = $packageQuantity;
$senderPackages = $this->RegularProgram_model->userRegularPackagesList($sender);

foreach ($senderPackages as $pkg) {
    $senderCurrentPackageCount += (int)$pkg['quantity'];
}
```
**Purpose:**
- Start with current purchase quantity
- Add all previously purchased packages (status=1 only)
- This total determines eligibility criteria for receivers

**Example:**
- Current purchase: 2 packages
- Previous purchases: 3 + 2 = 5 packages
- Total: 2 + 5 = **7 packages**

---

### Step 3: Determine Eligible Users Based on Sender's Total
```php
if ($senderCurrentPackageCount >= 7) {
    $allRegularProgramUsers = $this->RegularProgram_model->getAllsevenAboveUsers();
} else {
    $allRegularProgramUsers = $this->RegularProgram_model->getAllRegularProgramIds();
}
```
**Logic:**
- **If sender has ≥7 total packages:** Only users with ≥7 packages are eligible
- **If sender has <7 total packages:** All users with any packages are eligible

**Why this matters:**
- Creates tiered reward system
- Incentivizes users to buy more packages (≥7) to get higher rewards
- Prevents dilution of royalty pool among too many small holders

---

### Step 4: Calculate Total Package Count Across All Eligible Users
```php
$totalSharesToDistribute = $packageDetails['price'] * 0.30 * $packageQuantity;

$totalUsers = 0;
foreach ($allRegularProgramUsers as $user) {
    $userPackages = $this->RegularProgram_model->userRegularPackagesList($user['un_id']);
    foreach ($userPackages as $pkg) {
        $totalUsers = $totalUsers + $pkg['quantity'];
    }
}
```
**CRITICAL NOTE:** The variable name `$totalUsers` is misleading - it's actually the **total package count** across all eligible users, NOT the user count!

**Example:**
- User A has 3 packages
- User B has 5 packages  
- User C has 2 packages
- User D has 8 packages
- **`$totalUsers = 18`** (sum of all packages, not 4 users!)

**Royalty Pool Calculation:**
```
$totalSharesToDistribute = Package Price × 30% × Purchase Quantity
```

**Example:**
- Package price: 1000 TK
- Purchase quantity: 2
- Royalty pool: 1000 × 0.30 × 2 = **600 TK**

---

### Step 5: Calculate Per-Package Royalty Amount
```php
if ($totalUsers <= 0) {
    return true; // No distribution needed
}

$amountPerUser = $totalSharesToDistribute / $totalUsers;
```
**Formula:** 
```
Per-Package Amount = Royalty Pool ÷ Total Package Count
```

**Example:**
- Royalty pool: 600 TK
- Total packages in system: 18
- Per-package amount: 600 ÷ 18 = **33.33 TK**

**Early Exit:**
- If no eligible users exist (totalUsers = 0), function returns true without errors

---

### Step 6: Distribute to Each Eligible User (Weighted by Package Count)
```php
foreach ($allRegularProgramUsers as $user) {
    if ($user['un_id'] == $sender) {
        continue; // Skip the sender themselves
    }

    $upd = (float)($amountPerUser / 2);
    $wd  = (float)($amountPerUser / 2);

    $userPackagess = $this->RegularProgram_model->userRegularPackagesList($user['un_id']);
    $userPackageCount = 0;
    foreach ($userPackagess as $pkg) {
        $userPackageCount = $userPackageCount + (int)$pkg['quantity'];
    }

    if($userPackageCount >= 7) {
        $upd = $upd * $userPackageCount;
        $wd = $wd * $userPackageCount;
    }
    
    // Insert bonus record and update balances...
}
```

**Distribution Rules:**

1. **Skip sender** - They don't receive royalty from their own purchase
   ```php
   if ($user['un_id'] == $sender) {
       continue;
   }
   ```

2. **Base amount** - Split 50/50 between update_amount and withdrawable_amount
   ```php
   $upd = (float)($amountPerUser / 2);  // Update amount
   $wd  = (float)($amountPerUser / 2);  // Withdrawable amount
   ```

3. **Special multiplier for users with ≥7 packages**
   ```php
   if($userPackageCount >= 7) {
       $upd = $upd * $userPackageCount;
       $wd = $wd * $userPackageCount;
   }
   ```
   **Important:** Users with <7 packages get base amount (no multiplication)
   **Important:** Users with ≥7 packages get base amount × their package count

---

### Step 7: Save Bonus Records and Update User Balances
```php
$royalityBonusForm = array(
    'sender_un_id' => $sender,
    'receiver_un_id' => $user['un_id'],
    'update_amount' => $upd, 
    'withdrawable_amount' => $wd,
    'package_id' => $packageId,
    'status' => '1',
    'source' => 'royalty',
    'level' => 100,
    'created_at' => date('Y-m-d H:i:s')
);

$this->RegularProgram_model->addRegularProgramReferBonus($royalityBonusForm);
$this->RegularProgram_model->incrementUserRegularProgramAmounts($user['un_id'], $upd, $wd);
```

**Two Database Operations:**
1. **Insert bonus record** in `regular_program_refer_bonus` table for tracking
2. **Atomically increment** user balances in `customers` table

---

## Complete Calculation Example

### Scenario Setup
- **Purchase**: User D buys 2 packages @ 1000 TK each
- **Royalty Pool**: 1000 × 30% × 2 = **600 TK**
- **Eligible Users**: 
  - User A: 3 packages (has <7)
  - User B: 8 packages (has ≥7)
  - User C: 2 packages (has <7)
  - User D: 2 packages (sender - excluded from royalty)
- **Total Package Count**: 3 + 8 + 2 = **13 packages** (excluding sender's packages)

### Step-by-Step Calculation

**Per-package amount:**
```
600 TK ÷ 13 packages = 46.15 TK per package
```

**Base split (50/50):**
```
Update amount per package = 46.15 ÷ 2 = 23.08 TK
Withdrawable amount per package = 46.15 ÷ 2 = 23.08 TK
```

### Distribution Breakdown

**User A (3 packages, <7 threshold):**
```
Package count: 3
Meets ≥7 threshold: NO

Calculation:
- Base update: 23.08 TK (no multiplication)
- Base withdrawable: 23.08 TK (no multiplication)

Final bonus:
- Update amount: 23.08 TK
- Withdrawable amount: 23.08 TK
- Total: 46.16 TK
```

**User B (8 packages, ≥7 threshold):**
```
Package count: 8
Meets ≥7 threshold: YES

Calculation:
- Base update: 23.08 TK
- Multiplied: 23.08 × 8 = 184.64 TK
- Base withdrawable: 23.08 TK  
- Multiplied: 23.08 × 8 = 184.64 TK

Final bonus:
- Update amount: 184.64 TK
- Withdrawable amount: 184.64 TK
- Total: 369.28 TK
```

**User C (2 packages, <7 threshold):**
```
Package count: 2
Meets ≥7 threshold: NO

Calculation:
- Base update: 23.08 TK (no multiplication)
- Base withdrawable: 23.08 TK (no multiplication)

Final bonus:
- Update amount: 23.08 TK
- Withdrawable amount: 23.08 TK
- Total: 46.16 TK
```

**User D (sender):**
```
Status: SENDER (excluded)
Bonus: 0 TK
```

### Total Verification
```
User A: 46.16 TK
User B: 369.28 TK
User C: 46.16 TK
User D: 0 TK (sender excluded)
─────────────────
Total: 461.60 TK

Note: Total is less than 600 TK because sender's packages (2) 
are excluded from the distribution pool.
```

---

## Required Model Methods

### 1. `packageDetails($packageId)`
**Returns:** Package details array

**Required Fields:**
- `price` (float) - Package price

**Example:**
```php
array(
    'un_id' => 'pkg_123',
    'title' => 'Basic Package',
    'price' => 1000.00,
    'vat' => 50.00
)
```

---

### 2. `userRegularPackagesList($un_id)`
**Returns:** Array of user's approved packages

**Required Fields per package:**
- `quantity` (int) - Number of packages
- `status` (int) - Must filter for status=1 (approved)

**Example:**
```php
array(
    array('quantity' => 2, 'status' => 1, 'created_at' => '2025-01-15'),
    array('quantity' => 3, 'status' => 1, 'created_at' => '2025-02-20')
)
```

**Implementation Hint:**
```php
public function userRegularPackagesList($un_id) {
    $this->db->where('user_un_id', $un_id);
    $this->db->where('status', 1); // Only approved
    return $this->db->get('regular_program_package_update')->result_array();
}
```

---

### 3. `getAllsevenAboveUsers()`
**Returns:** Array of users who have ≥7 total packages

**Required Fields per user:**
- `un_id` (string) - User unique ID

**Example:**
```php
array(
    array('un_id' => 'user_001', 'username' => 'john'),
    array('un_id' => 'user_002', 'username' => 'jane')
)
```

**Implementation Logic:**
```php
public function getAllsevenAboveUsers() {
    $this->db->where('current_regular_program_package_id !=', '');
    $users = $this->db->get('customers')->result_array();
    
    $qualifiedUsers = [];
    foreach ($users as $user) {
        $packages = $this->userRegularPackagesList($user['un_id']);
        $total = 0;
        foreach ($packages as $pkg) {
            $total += (int)$pkg['quantity'];
        }
        if ($total >= 7) {
            $qualifiedUsers[] = $user;
        }
    }
    return $qualifiedUsers;
}
```

---

### 4. `getAllRegularProgramIds()`
**Returns:** Array of all users who have any packages

**Required Fields per user:**
- `un_id` (string) - User unique ID

**Example:**
```php
array(
    array('un_id' => 'user_001'),
    array('un_id' => 'user_003'),
    array('un_id' => 'user_005')
)
```

**Implementation:**
```php
public function getAllRegularProgramIds() {
    $this->db->where('current_regular_program_package_id !=', '');
    return $this->db->get('customers')->result_array();
}
```

---

### 5. `addRegularProgramReferBonus($form)`
**Purpose:** Insert bonus record into tracking table

**Parameter:** Array with bonus details

**Required Fields:**
```php
array(
    'sender_un_id' => 'user_123',
    'receiver_un_id' => 'user_456',
    'update_amount' => 100.50,
    'withdrawable_amount' => 100.50,
    'package_id' => 'pkg_789',
    'status' => '1',
    'source' => 'royalty',
    'level' => 100,
    'created_at' => '2025-12-01 10:30:00'
)
```

**Implementation:**
```php
public function addRegularProgramReferBonus($form) {
    $this->db->insert('regular_program_refer_bonus', $form);
}
```

---

### 6. `incrementUserRegularProgramAmounts($un_id, $updateAmount, $withdrawableAmount)`
**Purpose:** Atomically update user balance fields

**Critical:** Must use SQL SET increment to prevent race conditions

**Implementation:**
```php
public function incrementUserRegularProgramAmounts($un_id, $updateAmount, $withdrawableAmount) {
    $this->db->set('current_regular_program_update_amount', 
                   'current_regular_program_update_amount + ' . (float)$updateAmount, FALSE);
    $this->db->set('total_regular_program_update_amount', 
                   'total_regular_program_update_amount + ' . (float)$updateAmount, FALSE);
    $this->db->set('current_regular_program_withdraw_amount', 
                   'current_regular_program_withdraw_amount + ' . (float)$withdrawableAmount, FALSE);
    $this->db->set('total_regular_program_withdraw_amount', 
                   'total_regular_program_withdraw_amount + ' . (float)$withdrawableAmount, FALSE);
    $this->db->where('un_id', $un_id);
    $this->db->update('customers');
}
```

**SQL Equivalent:**
```sql
UPDATE customers SET
  current_regular_program_update_amount = current_regular_program_update_amount + 100.50,
  total_regular_program_update_amount = total_regular_program_update_amount + 100.50,
  current_regular_program_withdraw_amount = current_regular_program_withdraw_amount + 100.50,
  total_regular_program_withdraw_amount = total_regular_program_withdraw_amount + 100.50
WHERE un_id = 'user_123'
```

---

## Database Schema Required

### Table: `regular_program_refer_bonus`
Tracks all bonus distributions

```sql
CREATE TABLE `regular_program_refer_bonus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_un_id` varchar(111) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'User who made purchase',
  `receiver_un_id` varchar(111) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'User receiving bonus',
  `update_amount` decimal(10,2) NOT NULL DEFAULT 0.00 COMMENT 'Amount for updates/features',
  `withdrawable_amount` decimal(10,2) NOT NULL DEFAULT 0.00 COMMENT 'Amount for cash withdrawal',
  `package_id` varchar(111) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Package un_id',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=Active, 0=Inactive',
  `source` enum('referal','generation','royalty') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'referal',
  `level` int(11) NOT NULL DEFAULT 0 COMMENT '0=Direct, 1-9=Generation, 100=Royalty',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `sender_un_id` (`sender_un_id`),
  KEY `receiver_un_id` (`receiver_un_id`),
  KEY `package_id` (`package_id`),
  KEY `source` (`source`),
  KEY `level` (`level`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

---

### Table: `customers` (updated fields)
User balance tracking

```sql
ALTER TABLE `customers` 
ADD COLUMN `current_regular_program_package_id` varchar(111) DEFAULT '' COMMENT 'Current active package',
ADD COLUMN `current_regular_program_update_amount` decimal(10,2) NOT NULL DEFAULT 0.00 COMMENT 'Current update balance',
ADD COLUMN `total_regular_program_update_amount` decimal(10,2) NOT NULL DEFAULT 0.00 COMMENT 'Lifetime update earnings',
ADD COLUMN `current_regular_program_withdraw_amount` decimal(10,2) NOT NULL DEFAULT 0.00 COMMENT 'Current withdrawable balance',
ADD COLUMN `total_regular_program_withdraw_amount` decimal(10,2) NOT NULL DEFAULT 0.00 COMMENT 'Lifetime withdrawable earnings',
ADD COLUMN `regular_program_wallet` decimal(10,2) NOT NULL DEFAULT 0.00 COMMENT 'Wallet for direct purchases',
ADD COLUMN `refered_by` varchar(111) DEFAULT '' COMMENT 'Referrer user ID',
ADD COLUMN `placement_id` varchar(111) DEFAULT '' COMMENT 'Binary tree placement';
```

**Field Purposes:**
- `current_*_amount` - Available now (can decrease with usage/withdrawal)
- `total_*_amount` - Lifetime total (only increases, never decreases)
- `update_amount` - Can be used for features, upgrades, etc.
- `withdraw_amount` - Can be withdrawn as real cash

---

## Key Points and Best Practices

### 1. 30% Royalty Pool
- **Fixed percentage:** Always 30% of package price × quantity
- **Not configurable** in current implementation
- Consider making this a database setting for flexibility

### 2. Weighted Distribution
- Distribution is **based on package count**, not equal per user
- Users with more packages get proportionally more royalty
- Creates incentive to accumulate packages

### 3. 50/50 Split on All Bonuses
- Every bonus splits evenly:
  - 50% → update_amount (for features)
  - 50% → withdrawable_amount (for cash)
- This split happens BEFORE the ≥7 multiplier

### 4. 7-Package Threshold Special Treatment
- **If sender has ≥7 packages:** Only distribute to users with ≥7 packages
  - Creates exclusive "premium club" reward
  - Smaller pool = larger individual shares
- **If sender has <7 packages:** Distribute to all users
  - Larger pool = smaller individual shares
- **Recipient bonus multiplier:** Users with ≥7 packages get base × their package count

### 5. Sender Exclusion Rule
- **Always exclude sender** from receiving royalty
- Prevents self-referencing bonus loops
- Sender gets value from:
  - The package itself
  - Potential referral bonus (different function)
  - Generation bonuses (different function)

### 6. Atomic Database Updates
- **CRITICAL:** Use SQL `SET field = field + value` syntax
- Prevents race conditions when multiple purchases occur simultaneously
- Never use `UPDATE customers SET amount = 150` (absolute value)
- Always use `UPDATE customers SET amount = amount + 50` (increment)

### 7. Error Handling
```php
try {
    // Distribution logic
    return true;
} catch (Exception $e) {
    log_message('error', 'Error in sendRoyality: ' . $e->getMessage());
    return false;
}
```
- Catches all exceptions
- Logs to CodeIgniter error log
- Returns false to indicate failure
- Calling function can handle failure appropriately

### 8. Performance Considerations
**Current Complexity:**
- O(U) for fetching all eligible users
- O(U × P) for counting each user's packages (U users, P packages per user)
- O(U) for inserting bonus records
- Total: **O(U × P)** complexity

**Optimization Recommendations for Large Scale:**
1. **Cache package counts** in `customers` table
   ```sql
   ALTER TABLE customers ADD COLUMN total_packages int DEFAULT 0;
   ```
2. **Index critical fields:**
   ```sql
   CREATE INDEX idx_package_count ON customers(current_regular_program_package_id, total_packages);
   ```
3. **Use background job queue** for >1000 users
4. **Batch insert** bonus records instead of one-by-one
5. **Consider materialized view** for eligible users

---

## Testing Scenarios

### Test Case 1: Basic Distribution
```
Setup:
- Sender: User A (5 packages total)
- Purchase: 1 package @ 1000 TK
- Eligible users: All users (sender has <7)
  - User B: 2 packages
  - User C: 3 packages
  - User D: 4 packages
- Total packages: 2 + 3 + 4 = 9

Expected:
- Royalty pool: 1000 × 0.30 × 1 = 300 TK
- Per package: 300 ÷ 9 = 33.33 TK
- User B: 16.67 update + 16.67 withdraw = 33.34 TK
- User C: 16.67 update + 16.67 withdraw = 33.34 TK  
- User D: 16.67 update + 16.67 withdraw = 33.34 TK
- User A: 0 (sender excluded)
```

### Test Case 2: Premium Tier (≥7 packages)
```
Setup:
- Sender: User A (8 packages total - qualifies for ≥7)
- Purchase: 2 packages @ 1000 TK
- Eligible users: Only users with ≥7 packages
  - User B: 7 packages (≥7 - eligible)
  - User C: 10 packages (≥7 - eligible)
  - User D: 5 packages (<7 - NOT eligible)
- Total packages: 7 + 10 = 17

Expected:
- Royalty pool: 1000 × 0.30 × 2 = 600 TK
- Base per package: 600 ÷ 17 = 35.29 TK
- Base split: 35.29 ÷ 2 = 17.65 TK each

User B (7 packages, ≥7):
- Update: 17.65 × 7 = 123.55 TK
- Withdraw: 17.65 × 7 = 123.55 TK
- Total: 247.10 TK

User C (10 packages, ≥7):
- Update: 17.65 × 10 = 176.50 TK
- Withdraw: 17.65 × 10 = 176.50 TK
- Total: 353.00 TK

User D (5 packages):
- Not eligible (sender has ≥7, User D has <7)
- Total: 0 TK

User A (sender):
- Excluded
- Total: 0 TK
```

### Test Case 3: No Eligible Users
```
Setup:
- Sender: User A (only user with packages)
- Purchase: 1 package @ 1000 TK
- Eligible users: None (only sender exists)

Expected:
- Function returns true (no error)
- No bonus records created
- No balance updates
- Royalty pool goes undistributed
```

### Test Case 4: Mixed Eligibility
```
Setup:
- Sender: User A (3 packages - less than 7)
- Purchase: 1 package @ 1000 TK
- Eligible users: All users with packages
  - User B: 2 packages (<7 - no multiplier)
  - User C: 8 packages (≥7 - gets multiplier)
  - User D: 5 packages (<7 - no multiplier)
- Total packages: 2 + 8 + 5 = 15

Expected:
- Royalty pool: 1000 × 0.30 × 1 = 300 TK
- Base per package: 300 ÷ 15 = 20 TK
- Base split: 20 ÷ 2 = 10 TK each

User B (2 packages, <7):
- Update: 10 TK (no multiplier)
- Withdraw: 10 TK (no multiplier)
- Total: 20 TK

User C (8 packages, ≥7):
- Update: 10 × 8 = 80 TK (with multiplier)
- Withdraw: 10 × 8 = 80 TK (with multiplier)
- Total: 160 TK

User D (5 packages, <7):
- Update: 10 TK (no multiplier)
- Withdraw: 10 TK (no multiplier)
- Total: 20 TK
```

---

## Troubleshooting Guide

### Problem: No bonuses being distributed
**Check:**
1. Are there eligible users with `current_regular_program_package_id` set?
2. Is sender being correctly excluded from distribution?
3. Check `$totalUsers` calculation - is it > 0?
4. Verify `userRegularPackagesList()` returns approved packages (status=1)

### Problem: Bonus amounts don't match expected
**Check:**
1. Verify package price is correct (including VAT if applicable)
2. Confirm 30% calculation: `price × 0.30 × quantity`
3. Check if ≥7 multiplier is being applied correctly
4. Ensure 50/50 split happens before multiplication

### Problem: Database balance not updating
**Check:**
1. Verify `incrementUserRegularProgramAmounts()` uses SQL increment syntax
2. Check database permissions for UPDATE operations
3. Look for database errors in CodeIgniter logs
4. Ensure column names match exactly (case-sensitive)

### Problem: Wrong users getting bonuses
**Check:**
1. Sender's total package count calculation
2. If sender has ≥7, verify `getAllsevenAboveUsers()` filtering
3. Confirm sender is being excluded in the loop
4. Check `current_regular_program_package_id` is not empty for eligible users

### Problem: Performance issues with many users
**Solutions:**
1. Add database indexes on frequently queried fields
2. Implement caching for package counts
3. Use background job queue for async processing
4. Batch database inserts instead of individual queries
5. Consider Redis/Memcached for temporary calculations

---

## Integration Checklist

When implementing this in another system:

- [ ] Create `regular_program_refer_bonus` table with proper schema
- [ ] Add required fields to `customers` table
- [ ] Implement all 6 required model methods
- [ ] Set up proper database indexes for performance
- [ ] Configure error logging
- [ ] Test with small dataset first (3-5 users)
- [ ] Test edge cases (sender only, no users, mixed eligibility)
- [ ] Verify atomic updates work under concurrent load
- [ ] Document any custom business logic changes
- [ ] Set up monitoring/alerts for bonus distribution failures

---

## Customization Options

### Make royalty percentage configurable:
```php
// Instead of hardcoded 30%
$royaltyPercentage = $this->config->item('royalty_percentage') ?? 0.30;
$totalSharesToDistribute = $packageDetails['price'] * $royaltyPercentage * $packageQuantity;
```

### Change the 7-package threshold:
```php
// Instead of hardcoded 7
$premiumThreshold = $this->config->item('premium_threshold') ?? 7;
if ($senderCurrentPackageCount >= $premiumThreshold) {
    // Premium logic
}
```

### Adjust the 50/50 split:
```php
// Instead of hardcoded 50/50
$updatePercentage = $this->config->item('update_split') ?? 0.50;
$upd = (float)($amountPerUser * $updatePercentage);
$wd  = (float)($amountPerUser * (1 - $updatePercentage));
```

### Add minimum purchase requirement:
```php
// Only distribute if purchase quantity meets minimum
$minQuantityForRoyalty = 5;
if ($packageQuantity < $minQuantityForRoyalty) {
    return true; // Skip royalty for small purchases
}
```

---

## Summary

The `sendRoyality` function implements a sophisticated weighted royalty distribution system that:
- Distributes 30% of purchase value as royalty
- Weights distribution by package ownership
- Creates tiered rewards (≥7 packages gets multiplier)
- Excludes sender from receiving own royalty
- Splits bonuses 50/50 between update and withdrawable amounts
- Uses atomic database operations for data integrity
- Handles edge cases gracefully (no users, sender only, etc.)

This creates a powerful incentive system that rewards long-term package accumulation while maintaining fairness through proportional distribution.
