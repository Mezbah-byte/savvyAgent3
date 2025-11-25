# Regular Program Management System

This document explains the complete regular program management system, similar to the course management system.

## Database Structure

### 1. `regular_program_packages`
Stores the available regular program packages.
- `id` - Primary key
- `un_id` - Unique identifier
- `title` - Program title
- `details` - Program description
- `price` - Program price
- `old_price` - Original price (for discount display)
- `status` - 1=active, 0=inactive
- `created_at` - Creation timestamp

### 2. `agentregularprogrambuyrequest`
Stores agent's buy requests for regular programs (pending admin approval).
- `id` - Primary key
- `agent_un_id` - Agent's unique ID
- `program_un_id` - Program package unique ID
- `quantity` - Number of programs requested
- `price_per_unit` - Price per program
- `commission_per_unit` - Commission per program
- `commission_amount` - Total commission
- `balance_used` - Agent balance used
- `total_amount` - Final amount to pay
- `gateway_id` - Payment gateway ID
- `trx` - Transaction ID
- `ssLink` - Payment screenshot URL
- `status` - 0=pending, 1=approved, 2=rejected
- `rejection_reason` - Admin's rejection reason
- `created_at` - Request creation time
- `updated_at` - Last update time

### 3. `agentregularprograms`
Stores the actual program slots/inventory owned by agents.
- `id` - Primary key
- `agent_un_id` - Agent's unique ID
- `program_un_id` - Program package unique ID
- `status` - 0=pending, 1=active/available, 2=sold
- `customer_un_id` - Customer ID (when sold)
- `sold_at` - Sale timestamp
- `created_at` - Creation timestamp

### 4. `user_regular_programs`
Stores customer orders for regular programs from agents.
- `id` - Primary key
- `user_un_id` - Customer's unique ID
- `program_id` - Program package unique ID
- `gateway_id` - Agent's payment gateway ID
- `quantity` - Number of programs
- `amount` - Total amount paid
- `trx` - Transaction ID
- `ssLink` - Payment screenshot
- `status` - 0=pending, 1=approved, 2=rejected
- `created_at` - Order creation time
- `updated_at` - Last update time

## Complete Workflow

### Phase 1: Agent Buys Programs (Wholesale)
1. **Agent browses available programs**
   - Controller: `RegularProgram::programList()`
   - View: Shows all active regular programs
   
2. **Agent submits buy request**
   - Controller: `RegularProgram::buyProgram($programId)`
   - Process:
     - Agent fills form (quantity, payment gateway, transaction ID)
     - Uploads payment screenshot
     - Screenshot uploaded to B2 cloud storage
     - Commission calculated based on quantity
     - Request saved to `agentregularprogrambuyrequest` with status=0 (pending)
   
3. **Admin reviews request**
   - Admin sees the request in their dashboard
   - Can view payment screenshot
   - Options:
     - **Approve**: Updates status to 1, creates entries in `agentregularprograms`
     - **Reject**: Updates status to 2, adds rejection reason

4. **System creates inventory (on approval)**
   - Model: `RegularProgram_model::createAgentPrograms()`
   - Creates X entries in `agentregularprograms` (where X = quantity)
   - Each entry has status=1 (active/available for sale)

### Phase 2: Customer Buys from Agent (Retail)
1. **Customer places order**
   - Customer selects program and agent's payment gateway
   - Submits payment proof
   - Order saved to `user_regular_programs` with status=0 (pending)

2. **Agent reviews customer order**
   - Controller: `RegularProgram::orderList($type)`
   - Shows all customer orders filtered by status
   - Options:
     - **Accept**: `RegularProgram::acceptOrder($id)`
     - **Reject**: `RegularProgram::rejectOrder($id)`

3. **On acceptance**
   - Updates `user_regular_programs` status to 1
   - Updates `agentregularprograms` entries from status 1 (active) to 2 (sold)
   - Marks exactly X programs as sold (where X = order quantity)
   - Model: `RegularProgram_model::update_status_requests()`

## Controller Methods

### RegularProgram Controller (`application/controllers/RegularProgram.php`)

#### Public Methods:
- `programList()` - Display all active programs to agent
- `orderList($type)` - Display customer orders by status (0=pending, 1=approved, 2=rejected, 'all')
- `acceptOrder($id)` - Accept customer order and mark programs as sold
- `rejectOrder($id)` - Reject customer order
- `buyProgram($programId)` - Agent submits buy request for programs
- `myPrograms()` - Display agent's program inventory
- `buyRequestList($status)` - Display agent's buy requests
- `viewRequest($id)` - View specific buy request details

## Model Methods

### RegularProgram_model (`application/models/RegularProgram_model.php`)

#### Core Methods:
- `getActivePrograms()` - Get all active program packages
- `getProgramDetails($unId)` - Get specific program details
- `buyProgramRequest($data)` - Insert buy request
- `createAgentPrograms($agentUnId, $programUnId, $quantity)` - Create program inventory
- `update_status_requests($agent_un_id, $program_un_id, $new_status, $quantity)` - Update program status
- `getAgentPrograms($agentUnId, $status)` - Get agent's inventory
- `getAgentBuyRequests($agentUnId, $status)` - Get agent's buy requests
- `approveBuyRequest($requestId)` - Approve request and create inventory
- `rejectBuyRequest($requestId, $reason)` - Reject request with reason
- `getAgentProgramsCount($agentUnId)` - Get inventory counts by status

## Status Codes

### Buy Request Status (`agentregularprogrambuyrequest.status`)
- `0` - Pending (waiting for admin approval)
- `1` - Approved (agent can now sell these programs)
- `2` - Rejected (request denied by admin)

### Program Inventory Status (`agentregularprograms.status`)
- `0` - Pending
- `1` - Active/Available (agent can sell to customers)
- `2` - Sold (assigned to a customer)

### Customer Order Status (`user_regular_programs.status`)
- `0` - Pending (waiting for agent approval)
- `1` - Approved (order completed)
- `2` - Rejected (order denied by agent)

## Key Features

### Commission System
- Agents get commission when buying programs
- Commission deducted from total amount
- Formula: `total_amount = (price × quantity) - commission_amount`

### Screenshot Upload
- Uses B2 (Backblaze) cloud storage
- Temporary upload to `uploads/tmp/`
- Then pushed to B2 bucket
- Local file deleted after upload
- URL stored in database

### Inventory Management
- Each program purchase creates individual entries
- Allows precise tracking of sold vs available
- FIFO method (First In, First Out) when selling
- Oldest available programs sold first

### Error Handling
- Login validation on all methods
- Order ownership verification
- Status verification before updates
- Flash messages for user feedback

## Example Usage Flow

```
1. Admin creates program package "Premium Course - 2025"
   ↓
2. Agent "John" requests 50 programs
   - Pays $45,000 (after $5,000 commission)
   - Status: Pending
   ↓
3. Admin approves request
   - 50 entries created in agentregularprograms
   - Each with status=1 (active)
   ↓
4. Customer "Alice" orders 2 programs from John
   - Pays $2,000
   - Order status: Pending
   ↓
5. John approves Alice's order
   - 2 programs marked as sold (status=2)
   - John has 48 active programs remaining
   - Alice receives access to programs
```

## Views Required (to be created)

1. `dashboard/regular_program_list.php` - Browse programs
2. `dashboard/buy_regular_program.php` - Buy request form
3. `dashboard/my_regular_programs.php` - Agent's inventory
4. `dashboard/regular_program_buy_requests.php` - Agent's buy requests list
5. `dashboard/view_regular_program_request.php` - View request details
6. `dashboard/regular_program_order_list.php` - Customer orders list

## Routes to Add (in `application/config/routes.php`)

```php
$route['regularProgram/programList'] = 'RegularProgram/programList';
$route['regularProgram/orderList/(:any)'] = 'RegularProgram/orderList/$1';
$route['regularProgram/acceptOrder/(:num)'] = 'RegularProgram/acceptOrder/$1';
$route['regularProgram/rejectOrder/(:num)'] = 'RegularProgram/rejectOrder/$1';
$route['regularProgram/buyProgram/(:any)'] = 'RegularProgram/buyProgram/$1';
$route['regularProgram/myPrograms'] = 'RegularProgram/myPrograms';
$route['regularProgram/buyRequestList'] = 'RegularProgram/buyRequestList';
$route['regularProgram/buyRequestList/(:any)'] = 'RegularProgram/buyRequestList/$1';
$route['regularProgram/viewRequest/(:num)'] = 'RegularProgram/viewRequest/$1';
```

## Database Installation

Run these SQL files in order:
1. `db/regular_program_packages.sql` (if not already exists)
2. `db/agentregularprogrambuyrequest.sql`
3. `db/agentregularprograms.sql`
4. `db/user_regular_programs.sql`

## Security Considerations

- All methods check login status
- CSRF protection via CodeIgniter form validation
- File upload validation (size, type)
- SQL injection prevention via Query Builder
- XSS prevention via proper output escaping in views

## Future Enhancements

1. **Email Notifications**
   - Notify agent when buy request approved/rejected
   - Notify customer when order approved/rejected

2. **Analytics Dashboard**
   - Total programs bought
   - Total programs sold
   - Revenue tracking
   - Commission earned

3. **Bulk Operations**
   - Approve multiple requests at once
   - Export reports to Excel/PDF

4. **Advanced Filtering**
   - Date range filters
   - Program type filters
   - Amount range filters
