# Regular Program Bonus Flow Diagram

## Complete Purchase & Approval Flow

```
┌─────────────────────────────────────────────────────────────────────┐
│                    CUSTOMER PURCHASE REQUEST                         │
└─────────────────────────────────────────────────────────────────────┘
                                  │
                                  ▼
                    ┌──────────────────────────┐
                    │  Customer Browses        │
                    │  Regular Programs        │
                    └──────────────────────────┘
                                  │
                                  ▼
                    ┌──────────────────────────┐
                    │  Selects Agent Payment   │
                    │  Uploads Screenshot      │
                    └──────────────────────────┘
                                  │
                                  ▼
                    ┌──────────────────────────┐
                    │  Order Created           │
                    │  Status = 0 (Pending)    │
                    └──────────────────────────┘
                                  │
                                  ▼
┌─────────────────────────────────────────────────────────────────────┐
│                       AGENT APPROVAL                                 │
└─────────────────────────────────────────────────────────────────────┘
                                  │
                                  ▼
                    ┌──────────────────────────┐
                    │  Agent Views Order       │
                    │  Clicks "Accept"         │
                    └──────────────────────────┘
                                  │
                                  ▼
┌─────────────────────────────────────────────────────────────────────┐
│                    SYSTEM AUTO-PROCESSES                             │
└─────────────────────────────────────────────────────────────────────┘
                                  │
                    ┌─────────────┴─────────────┐
                    ▼                           ▼
        ┌──────────────────────┐    ┌──────────────────────┐
        │  Update Order        │    │  Update Agent        │
        │  Status = 1          │    │  Inventory (-qty)    │
        └──────────────────────┘    └──────────────────────┘
                    │
                    ▼
        ┌──────────────────────┐
        │  Update Customer     │
        │  - Set Package ID    │
        │  - Upgrade Type      │
        └──────────────────────┘
                    │
                    ▼
┌─────────────────────────────────────────────────────────────────────┐
│                     BONUS DISTRIBUTION                               │
└─────────────────────────────────────────────────────────────────────┘
                                  │
        ┌─────────────────────────┼─────────────────────────┐
        ▼                         ▼                         ▼
┌───────────────┐      ┌───────────────┐      ┌───────────────┐
│   REFERRAL    │      │  GENERATION   │      │   ROYALTY     │
│    BONUS      │      │    BONUS      │      │    BONUS      │
│   Level 0     │      │  Level 1-9    │      │   Level 100   │
└───────────────┘      └───────────────┘      └───────────────┘
        │                      │                      │
        │                      │                      │
┌───────┴────────┐     ┌───────┴────────┐     ┌──────┴───────┐
│  Direct        │     │  9 Levels Up   │     │  All Users   │
│  Referrer      │     │  in Chain      │     │  (Eligible)  │
│                │     │                │     │              │
│  5% of Price   │     │  0.5% each     │     │  30% Split   │
│  × Quantity    │     │  × Quantity    │     │  Equally     │
└────────────────┘     └────────────────┘     └──────────────┘
        │                      │                      │
        └──────────────────────┴──────────────────────┘
                               │
                               ▼
        ┌──────────────────────────────────────────┐
        │  Insert records in                       │
        │  regular_program_refer_bonus             │
        │                                          │
        │  Update customer balances:               │
        │  - current_regular_program_update_amount │
        │  - current_regular_program_withdraw_amt  │
        └──────────────────────────────────────────┘
                               │
                               ▼
                    ┌──────────────────┐
                    │   COMPLETED!     │
                    └──────────────────┘
```

## Bonus Calculation Example

### Scenario
- **Buyer**: User C (un_id: user_c)
- **Referrer**: User B (un_id: user_b)  
- **Upline 1**: User A (un_id: user_a)
- **Package**: 1000 TK
- **Quantity**: 2
- **Total Eligible Users**: 10 (including A, B, but excluding C)

### Distribution Breakdown

```
┌─────────────────────────────────────────────────────────────────┐
│                    DIRECT REFERRAL BONUS                         │
├─────────────────────────────────────────────────────────────────┤
│  Receiver: User B (direct referrer)                            │
│  Level: 0                                                       │
│  Source: 'referal'                                              │
│                                                                 │
│  Calculation:                                                   │
│  (1000 × 10% ÷ 2) × 2 = 100 TK                                 │
│                                                                 │
│  Split:                                                         │
│  - Update Amount: 100 TK                                        │
│  - Withdrawable Amount: 100 TK                                  │
└─────────────────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────────────────┐
│                    GENERATION BONUS                              │
├─────────────────────────────────────────────────────────────────┤
│  Receiver: User A (1 level up from B)                          │
│  Level: 1                                                       │
│  Source: 'generation'                                           │
│                                                                 │
│  Calculation:                                                   │
│  (1000 × 1% ÷ 2) × 2 = 10 TK                                   │
│                                                                 │
│  Split:                                                         │
│  - Update Amount: 10 TK                                         │
│  - Withdrawable Amount: 10 TK                                   │
│                                                                 │
│  Note: Continues up to level 9 or until no more referrers      │
└─────────────────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────────────────┐
│                      ROYALTY BONUS                               │
├─────────────────────────────────────────────────────────────────┤
│  Receivers: All 10 eligible users (excluding User C)           │
│  Level: 100                                                     │
│  Source: 'royalty'                                              │
│                                                                 │
│  Total Royalty Pool:                                            │
│  1000 × 30% × 2 = 600 TK                                        │
│                                                                 │
│  Per User:                                                      │
│  600 ÷ 10 = 60 TK                                               │
│                                                                 │
│  Split (per user):                                              │
│  - Update Amount: 30 TK                                         │
│  - Withdrawable Amount: 30 TK                                   │
└─────────────────────────────────────────────────────────────────┘
```

### Final Balances

```
User A (Upline 1):
├─ Generation Bonus:  10 TK (update) + 10 TK (withdrawable)
├─ Royalty Bonus:     30 TK (update) + 30 TK (withdrawable)
└─ Total:             40 TK (update) + 40 TK (withdrawable)

User B (Direct Referrer):
├─ Referral Bonus:    100 TK (update) + 100 TK (withdrawable)
├─ Royalty Bonus:      30 TK (update) +  30 TK (withdrawable)
└─ Total:             130 TK (update) + 130 TK (withdrawable)

User C (Buyer):
├─ Package Assigned: ✓
├─ Type Upgraded:    'open' → 'premium'
└─ Bonus Received:   None (is the sender)

Each Other User (8 users):
├─ Royalty Bonus:     30 TK (update) + 30 TK (withdrawable)
└─ Total:             30 TK (update) + 30 TK (withdrawable)
```

## Database Records Created

### regular_program_refer_bonus table
```
┌─────┬────────────┬─────────────┬────────┬──────────────┬─────────┬───────────────┐
│ ID  │ Sender     │ Receiver    │ Amount │ Withdrawable │ Level   │ Source        │
├─────┼────────────┼─────────────┼────────┼──────────────┼─────────┼───────────────┤
│  1  │ user_c     │ user_b      │ 100.00 │    100.00    │   0     │ referal       │
│  2  │ user_b     │ user_a      │  10.00 │     10.00    │   1     │ generation    │
│  3  │ user_c     │ user_a      │  30.00 │     30.00    │  100    │ royalty       │
│  4  │ user_c     │ user_b      │  30.00 │     30.00    │  100    │ royalty       │
│  5  │ user_c     │ user_d      │  30.00 │     30.00    │  100    │ royalty       │
│ ... │ ...        │ ...         │  ...   │     ...      │  ...    │ ...           │
│ 12  │ user_c     │ user_j      │  30.00 │     30.00    │  100    │ royalty       │
└─────┴────────────┴─────────────┴────────┴──────────────┴─────────┴───────────────┘
```

### customers table (updated fields)
```
┌──────────┬────────────────────┬───────────────────┬─────────────┐
│ un_id    │ current_update_amt │ current_withdraw  │ package_id  │
├──────────┼────────────────────┼───────────────────┼─────────────┤
│ user_a   │      40.00         │      40.00        │  (existing) │
│ user_b   │     130.00         │     130.00        │  (existing) │
│ user_c   │       0.00         │       0.00        │  pkg_xyz    │
│ user_d   │      30.00         │      30.00        │  (existing) │
└──────────┴────────────────────┴───────────────────┴─────────────┘
```

## Eligibility Rules

### For Referral & Generation Bonuses
✅ Receiver must have `current_regular_program_package_id` set (not empty)  
✅ Referral chain must be valid (refered_by field populated)  
✅ Generation stops at level 9 or when no more upline exists  

### For Royalty Bonus
✅ All users with `current_regular_program_package_id` (not empty)  
❌ EXCEPT the buyer (sender) themselves  

**Special Case**: If buyer has ≥7 total packages
→ Only users with ≥7 total packages receive royalty

## Performance Notes

```
Referral Bonus:     1 database query + 1 insert + 1 update
Generation Bonus:   9 database queries + 9 inserts + 9 updates (max)
Royalty Bonus:      1 query (all users) + N inserts + N updates
                    (N = number of eligible users)
```

**Recommendation**: For systems with 1000+ users, consider:
- Implementing background job processing
- Adding queue system for bonus distribution
- Caching eligible user lists
