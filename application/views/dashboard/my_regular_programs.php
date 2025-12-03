<?php include('header.php') ?>
<?php include('topbar.php') ?>
<?php include('flashdata.php') ?>

<div class="content-wrapper">
  <div class="container-xxl flex-grow-1 container-p-y">

    <div class="card">
      <h5 class="card-header d-flex justify-content-between align-items-center">
        My Regular Programs Inventory
        <a href="<?= base_url('regularPrograms') ?>" class="btn btn-sm btn-primary">
          <i class="bx bx-plus"></i> Buy More Regular Programs
        </a>
      </h5>
      
      <div class="card-body">
        <?php if (!empty($myPrograms)) { 
          $total = count($myPrograms);
          $available = count(array_filter($myPrograms, function($p) { return $p['status'] == 1; }));
          $sold = count(array_filter($myPrograms, function($p) { return $p['status'] == 2; }));
        ?>
        <div class="mt-4">
          <div class="row">
            <div class="col-md-4">
              <div class="card bg-primary text-white">
                <div class="card-body">
                  <h5 class="text-white">Total Regular Programs</h5>
                  <h2 class="text-white"><?= $total ?></h2>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card bg-success text-white">
                <div class="card-body">
                  <h5 class="text-white">Available</h5>
                  <h2 class="text-white"><?= $available ?></h2>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card bg-info text-white">
                <div class="card-body">
                  <h5 class="text-white">Sold</h5>
                  <h2 class="text-white"><?= $sold ?></h2>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php } ?>
        
        <div class="table-responsive text-nowrap">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>ID</th>
                <th>Regular Program</th>
                <th>Price</th>
                <th>Status</th>
                <th>Customer</th>
                <th>Sold Date</th>
                <th>Purchase Date</th>
              </tr>
            </thead>
            <tbody>
              <?php if (empty($myPrograms)) { ?>
                <tr>
                  <td colspan="7" class="text-center">No regular programs in inventory</td>
                </tr>
              <?php } else { ?>
                <?php
                $n = 1;
                   foreach ($myPrograms as $prog) { ?>
                  <tr>
                    <td><?= $n++ ?></td>
                    <td><?= htmlspecialchars($prog['title']) ?></td>
                    <td><?= number_format($prog['price'], 2) ?> ৳</td>
                    <td>
                      <?php if ($prog['status'] == 0) { ?>
                        <span class="badge bg-secondary">Pending</span>
                      <?php } elseif ($prog['status'] == 1) { ?>
                        <span class="badge bg-success">Available</span>
                      <?php } else { ?>
                        <span class="badge bg-info">Sold</span>
                      <?php } ?>
                    </td>
                    <td>
                      <?php if (!empty($prog['customer_un_id'])) { ?>
                        <?= $prog['customer_un_id'] ?>
                      <?php } else { ?>
                        <span class="text-muted">-</span>
                      <?php } ?>
                    </td>
                    <td>
                      <?php if (!empty($prog['sold_at'])) { ?>
                        <?= date('M d, Y', strtotime($prog['sold_at'])) ?>
                      <?php } else { ?>
                        <span class="text-muted">-</span>
                      <?php } ?>
                    </td>
                    <td><?= date('M d, Y', strtotime($prog['created_at'])) ?></td>
                  </tr>
                <?php } ?>
              <?php } ?>
            </tbody>
          </table>
        </div>

        <?php if (!empty($pagination)) { ?>
        <div class="d-flex justify-content-center mt-4">
          <?= $pagination ?>
        </div>
        <?php } ?>
        
      </div>
    </div>

  </div>
</div>

<?php include('footer.php') ?>
