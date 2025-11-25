<?php include('header.php') ?>

<?php include('topbar.php') ?>

<div class="content-wrapper">

  <!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">

    <!-- Hoverable Table rows -->
    <div class="card">
      <h5 class="card-header d-flex justify-content-between align-items-center">
        Regular Program List
        <a href="<?php echo base_url('regularProgram/buyRequestList'); ?>" class="btn btn-sm btn-primary">
          <i class="bx bx-list-ul me-1"></i> My Buy Requests
        </a>
      </h5>
      <div class="table-responsive text-nowrap">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Regular Program</th>
              <th>Main Price</th>
              <th>Offer Price</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0">

            <?php if (empty($programs)) { ?>
              <tr>
                <td colspan="4" class="text-center">No regular programs available</td>
              </tr>
            <?php } else { ?>
              <?php foreach ($programs as $program) { ?>
                <tr>
                  <td>
                    <span class="fw-medium"><?php echo $program['title'] ?></span>
                  </td>
                  <td><?php echo $program['old_price'] . ' ৳'; ?></td>
                  <td><?php echo $program['price'] . ' ৳'; ?></td>
                  <td>
                    <a href="<?php echo base_url('regularProgram/buyProgram/' . $program['un_id']); ?>"
                       class="btn btn-sm btn-success">
                      <i class="bx bx-cart me-1"></i> Buy Regular Program
                    </a>
                  </td>
                </tr>
              <?php } ?>
            <?php } ?>

          </tbody>
        </table>
      </div>
    </div>
    <!--/ Hoverable Table rows -->

  </div>
  <!-- / Content -->

  <?php include('footer.php') ?>
