<?php include('header.php'); ?>
<?php include('topbar.php'); ?>
<?php include('flashdata.php'); ?>
<div class="content-wrapper">
  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="row justify-content-center">
      <div class="col-lg-10 col-md-12">
        <div class="card shadow-sm">
          <div class="card-header bg-primary text-white d-flex align-items-center">
            <i class="fa-solid fa-clock-rotate-left me-2"></i>
            <h5 class="mb-0">Recharge History</h5>
          </div>
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table table-hover mb-0">
                <thead class="table-light">
                  <tr>
                    <th>Date</th>
                    <th>Mobile Number</th>
                    <th>Operator</th>
                    <th>Type</th>
                    <th>Amount</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (!empty($history)) { foreach ($history as $row) { ?>
                  <tr>
                    <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                    <td><?php echo htmlspecialchars($row['number']); ?></td>
                    <td><?php echo htmlspecialchars($row['operator']); ?></td>
                    <td><?php echo $row['type'] == 1 ? 'Prepaid' : 'Postpaid'; ?></td>
                    <td><?php echo number_format($row['amount'],2); ?> f3</td>
                    <td>
                      <?php if ($row['status'] == 1): ?>
                        <span class="badge bg-success">Success</span>
                      <?php elseif ($row['status'] == 2): ?>
                        <span class="badge bg-danger">Failed</span>
                      <?php else: ?>
                        <span class="badge bg-warning text-dark">Pending</span>
                      <?php endif; ?>
                    </td>
                  </tr>
                  <?php }} else { ?>
                  <tr><td colspan="6" class="text-center text-muted">No recharge history found.</td></tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include('footer.php'); ?>
