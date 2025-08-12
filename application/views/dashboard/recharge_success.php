<?php include('header.php'); ?>
<?php include('topbar.php'); ?>
<?php include('flashdata.php'); ?>
<div class="content-wrapper">
  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="row justify-content-center">
      <div class="col-lg-6 col-md-8">
        <div class="card shadow-sm text-center">
          <div class="card-body py-5">
            <div class="mb-4">
              <i class="fa-solid fa-circle-check fa-3x text-success mb-3"></i>
              <h3 class="mb-2">Recharge Successful!</h3>
              <p class="text-muted">Your mobile recharge was completed successfully.</p>
            </div>
            <a href="<?php echo base_url('recharge/history'); ?>" class="btn btn-outline-primary">View Recharge History</a>
            <a href="<?php echo base_url('dashboard'); ?>" class="btn btn-link ms-2">Back to Dashboard</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include('footer.php'); ?>
