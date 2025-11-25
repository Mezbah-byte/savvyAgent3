<?php include('header.php') ?>
<?php include('topbar.php') ?>
<?php include('flashdata.php') ?>

<div class="content-wrapper">
  <div class="container-xxl flex-grow-1 container-p-y">

    <div class="card">
      <h5 class="card-header">Request Details #<?= $request['id'] ?></h5>
      
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <h6>Regular Program Information</h6>
            <table class="table table-borderless">
              <tr>
                <td><strong>Regular Program:</strong></td>
                <td><?= htmlspecialchars($programDetails['title']) ?></td>
              </tr>
              <tr>
                <td><strong>Price per Unit:</strong></td>
                <td><?= number_format($request['price_per_unit'], 2) ?> ৳</td>
              </tr>
              <tr>
                <td><strong>Quantity:</strong></td>
                <td><?= $request['quantity'] ?></td>
              </tr>
              <tr>
                <td><strong>Commission per Unit:</strong></td>
                <td><?= number_format($request['commission_per_unit'], 2) ?> ৳</td>
              </tr>
              <tr>
                <td><strong>Commission Amount:</strong></td>
                <td class="text-success"><?= number_format($request['commission_amount'], 2) ?> ৳</td>
              </tr>
              <tr>
                <td><strong>Total Amount:</strong></td>
                <td><strong><?= number_format($request['total_amount'], 2) ?> ৳</strong></td>
              </tr>
            </table>
          </div>

          <div class="col-md-6">
            <h6>Payment Information</h6>
            <table class="table table-borderless">
              <tr>
                <td><strong>Gateway ID:</strong></td>
                <td><?= $request['gateway_id'] ?></td>
              </tr>
              <tr>
                <td><strong>Transaction ID:</strong></td>
                <td><?= htmlspecialchars($request['trx']) ?></td>
              </tr>
              <tr>
                <td><strong>Status:</strong></td>
                <td>
                  <?php if ($request['status'] == 0) { ?>
                    <span class="badge bg-warning">Pending</span>
                  <?php } elseif ($request['status'] == 1) { ?>
                    <span class="badge bg-success">Approved</span>
                  <?php } else { ?>
                    <span class="badge bg-danger">Rejected</span>
                  <?php } ?>
                </td>
              </tr>
              <tr>
                <td><strong>Request Date:</strong></td>
                <td><?= date('M d, Y H:i', strtotime($request['created_at'])) ?></td>
              </tr>
              <?php if ($request['status'] != 0) { ?>
              <tr>
                <td><strong>Updated Date:</strong></td>
                <td><?= date('M d, Y H:i', strtotime($request['updated_at'])) ?></td>
              </tr>
              <?php } ?>
              <?php if ($request['status'] == 2 && !empty($request['rejection_reason'])) { ?>
              <tr>
                <td><strong>Rejection Reason:</strong></td>
                <td class="text-danger"><?= htmlspecialchars($request['rejection_reason']) ?></td>
              </tr>
              <?php } ?>
            </table>
          </div>
        </div>

        <?php if (!empty($request['ssLink'])) { ?>
        <div class="row mt-3">
          <div class="col-12">
            <h6>Payment Screenshot</h6>
            <img src="<?= $request['ssLink'] ?>" alt="Payment Screenshot" class="img-fluid" style="max-width: 500px;">
          </div>
        </div>
        <?php } ?>

        <div class="mt-4">
          <a href="<?= base_url('regularProgram/buyRequestList') ?>" class="btn btn-secondary">
            <i class="bx bx-arrow-back"></i> Back to List
          </a>
        </div>
      </div>
    </div>

  </div>
</div>

<?php include('footer.php') ?>
