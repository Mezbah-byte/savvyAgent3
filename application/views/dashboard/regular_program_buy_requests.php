<?php include('header.php') ?>
<?php include('topbar.php') ?>
<?php include('flashdata.php') ?>

<div class="content-wrapper">
  <div class="container-xxl flex-grow-1 container-p-y">

    <div class="card">
      <h5 class="card-header">
        <?php 
        if ($status == 'all') echo 'All';
        elseif ($status == '0') echo 'Pending';
        elseif ($status == '1') echo 'Approved';
        elseif ($status == '2') echo 'Rejected';
        else echo 'All';
        ?> Regular Program Buy Requests
      </h5>
      
      <div class="card-body">
        <ul class="nav nav-pills mb-3" role="tablist">
          <li class="nav-item">
            <a class="nav-link <?= $status == 'all' ? 'active' : '' ?>" 
               href="<?= base_url('regularProgram/buyRequestList/all') ?>">
              All
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= $status == '0' ? 'active' : '' ?>" 
               href="<?= base_url('regularProgram/buyRequestList/0') ?>">
              Pending
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= $status == '1' ? 'active' : '' ?>" 
               href="<?= base_url('regularProgram/buyRequestList/1') ?>">
              Approved
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= $status == '2' ? 'active' : '' ?>" 
               href="<?= base_url('regularProgram/buyRequestList/2') ?>">
              Rejected
            </a>
          </li>
        </ul>

        <div class="table-responsive text-nowrap">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>ID</th>
                <th>Regular Program</th>
                <th>Quantity</th>
                <th>Total Amount</th>
                <th>Status</th>
                <th>Date</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php if (empty($requests)) { ?>
                <tr>
                  <td colspan="7" class="text-center">No requests found</td>
                </tr>
              <?php } else { ?>
                <?php foreach ($requests as $req) { ?>
                  <tr>
                    <td><?= $req['id'] ?></td>
                    <td><?= htmlspecialchars($req['title']) ?></td>
                    <td><?= $req['quantity'] ?></td>
                    <td><?= number_format($req['total_amount'], 2) ?> ৳</td>
                    <td>
                      <?php if ($req['status'] == 0) { ?>
                        <span class="badge bg-warning">Pending</span>
                      <?php } elseif ($req['status'] == 1) { ?>
                        <span class="badge bg-success">Approved</span>
                      <?php } else { ?>
                        <span class="badge bg-danger">Rejected</span>
                      <?php } ?>
                    </td>
                    <td><?= date('M d, Y', strtotime($req['created_at'])) ?></td>
                    <td>
                      <a href="<?= base_url('regularProgram/viewRequest/' . $req['id']) ?>" 
                         class="btn btn-sm btn-info">
                        <i class="bx bx-show"></i> View
                      </a>
                    </td>
                  </tr>
                <?php } ?>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>
</div>

<?php include('footer.php') ?>
