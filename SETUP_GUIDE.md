# Regular Program System - Quick Setup Guide

## ✅ COMPLETED FILES

### Database Tables (in `db/` folder)
- ✅ `agentregularprogrambuyrequest.sql`
- ✅ `agentregularprograms.sql`
- ✅ `user_regular_programs.sql`

### Controller & Model
- ✅ `application/controllers/RegularProgram.php`
- ✅ `application/models/RegularProgram_model.php`

### Views (in `application/views/dashboard/`)
- ✅ `regular_program_list.php` - Browse available programs
- ✅ `buy_regular_program.php` - Buy program form
- ✅ `regular_program_buy_requests.php` - Agent's buy requests
- ✅ `view_regular_program_request.php` - View request details
- ✅ `my_regular_programs.php` - Agent's inventory
- ✅ `regular_program_order_list.php` - Customer orders

### Configuration
- ✅ Routes added to `application/config/routes.php`
- ✅ Navigation menu updated in `application/views/dashboard/navbar.php`

---

## 🚀 INSTALLATION STEPS

### Step 1: Run SQL Files
Execute these SQL files in your database in order:

```sql
-- 1. First (if not exists)
SOURCE db/regular_program_packages.sql;

-- 2. Agent buy requests table
SOURCE db/agentregularprogrambuyrequest.sql;

-- 3. Agent inventory table
SOURCE db/agentregularprograms.sql;

-- 4. Customer orders table
SOURCE db/user_regular_programs.sql;
```

### Step 2: Add Sample Program (Optional)
```sql
INSERT INTO `regular_program_packages` (`un_id`, `title`, `details`, `price`, `old_price`, `status`, `created_at`) 
VALUES 
('rpp001', 'Premium Regular Program', 'This is a premium regular program package with full access', 1000.00, 1500.00, 1, NOW());
```

### Step 3: Test the System
1. Login to your agent account
2. Navigate to "Regular Programs" in sidebar
3. Click "Buy Program" on any program
4. Fill form and submit
5. Check "Buy Requests" to see your request
6. Admin approves → Programs appear in "My Programs"

---

## 📋 AVAILABLE ROUTES

### Agent Routes:
- `/regularPrograms` - View all programs
- `/regularProgram/buyProgram/{program_id}` - Buy a program
- `/regularProgram/myPrograms` - View inventory
- `/regularProgram/buyRequestList` - View buy requests
- `/regularProgram/viewRequest/{id}` - View request details

### Order Management Routes:
- `/regularProgram/orderList/0` - Pending orders
- `/regularProgram/orderList/1` - Approved orders
- `/regularProgram/orderList/2` - Rejected orders
- `/regularProgram/acceptOrder/{id}` - Accept customer order
- `/regularProgram/rejectOrder/{id}` - Reject customer order

---

## 🎯 NAVIGATION MENU

The sidebar now has:

```
📚 Courses
💼 Regular Programs
📋 Course Orders
   └─ Pending Orders
   └─ Approved Orders
   └─ Rejected Orders
📄 Program Orders
   └─ Pending Orders
   └─ Approved Orders
   └─ Rejected Orders
🛍️ My Inventory
   └─ My Programs
   └─ Buy Requests
💳 My Payment Gateways
```

---

## 🔄 WORKFLOW SUMMARY

### Agent Buying Programs (Wholesale):
1. Agent → Regular Programs → Select Program → Buy Program
2. Fill quantity, payment gateway, trx ID, upload screenshot
3. Submit → Request saved (status=0, pending)
4. **Admin reviews and approves**
5. System creates inventory entries in `agentregularprograms`
6. Agent can now see programs in "My Programs"

### Customer Buying from Agent (Retail):
1. Customer orders program from agent's gateway
2. Order appears in "Program Orders" → "Pending Orders"
3. Agent reviews payment screenshot
4. Agent clicks "Accept" or "Reject"
5. On accept: Programs marked as sold (status=2)
6. Customer gets access to program

---

## 🔧 COMMISSION SETTINGS

Default commission is set to **50 ৳ per program** in:
- `RegularProgram::buyProgram()` method
- Line: `$commissionPerUnit = 50;`

**To change commission:**
Edit `application/controllers/RegularProgram.php` line 237:
```php
$commissionPerUnit = 50; // Change this value
```

---

## 📊 DATABASE STATUS CODES

### Buy Request Status (`agentregularprogrambuyrequest.status`):
- `0` = Pending (waiting for admin)
- `1` = Approved (inventory created)
- `2` = Rejected (with reason)

### Inventory Status (`agentregularprograms.status`):
- `0` = Pending
- `1` = Active/Available (can sell)
- `2` = Sold (assigned to customer)

### Customer Order Status (`user_regular_programs.status`):
- `0` = Pending (waiting for agent)
- `1` = Approved (order completed)
- `2` = Rejected (order denied)

---

## ✅ TESTING CHECKLIST

- [ ] Database tables created
- [ ] Sample program added
- [ ] Can view program list
- [ ] Can submit buy request
- [ ] Buy request appears in list
- [ ] Can view request details
- [ ] Navigation menu shows all items
- [ ] All routes accessible
- [ ] Screenshot upload works
- [ ] Price calculation works

---

## 🐛 TROUBLESHOOTING

### "Page not found" error:
- Check routes in `application/config/routes.php`
- Clear browser cache
- Check `.htaccess` if using Apache

### "Call to undefined method":
- Make sure model is loaded in controller constructor
- Check model file name matches class name

### Screenshot not uploading:
- Check `uploads/tmp/` folder exists and writable
- Check B2 library configuration
- Check file upload settings in `php.ini`

### Commission not calculating:
- Check agent's commission settings in database
- Verify commission value in controller

---

## 🎉 SYSTEM IS READY!

All files created, routes added, navigation updated. You can now:
1. Run the SQL files
2. Login to your agent panel
3. Start testing the regular program system

The system mirrors your course management exactly!
