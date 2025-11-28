<?php include('header.php') ?>
<?php include('topbar.php') ?>
<?php include('flashdata.php') ?>

<div class="content-wrapper">
  <div class="container-xxl flex-grow-1 container-p-y">

    <div class="card">
      <h5 class="card-header">Regular Program Customer Orders</h5>
      <div class="table-responsive text-nowrap">
        <table id="programOrderTable" class="table table-hover">
          <thead>
            <tr>
              <th>User Image</th>
              <th>User Name</th>
              <th>Phone Number</th>
              <th>Regular Program Name</th>
              <th>Total Amount</th>
              <th>Quantity</th>
              <th>Program Price</th>
              <th>Requested at</th>
              <th>Worked at</th>
              <th>Payment Method</th>
              <th>TRX</th>
              <th>Screen Shot</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0">

            <?php if (empty($datas)) { ?>
              <tr>
                <td colspan="13" class="text-center">No orders found</td>
              </tr>
            <?php } else { ?>
              <?php foreach ($datas as $data) { ?>
                <tr>
                  <td>
                    <img src="<?php echo $data['userImg']; ?>" class="rounded-circle" height="50px" width="50px" />
                  </td>
                  <td><?php echo $data['name'] . ' (' . $data['username'] . ')'; ?></td>
                  <td><?php echo $data['phoneNumber']; ?></td>
                  <td><?php echo $data['programName']; ?></td>
                  <td><?php echo number_format($data['amount'], 2); ?> ৳</td>
                  <td><?php echo $data['quantity']; ?></td>
                  <td><?php echo number_format($data['amount'] / $data['quantity'], 2); ?> ৳</td>
                  <td><?php echo date('M d, Y H:i', strtotime($data['created_at'])); ?></td>
                  <td><?php echo date('M d, Y H:i', strtotime($data['updated_at'])); ?></td>
                  <td>
                    <img src="<?php echo $data['paymentMethodIcon']; ?>" height="30px" width="30px" />
                    <?php echo $data['paymentMethod']; ?>
                  </td>
                  <td><?php echo $data['trx']; ?></td>
                  <td>
                    <img src="<?php echo $data['ss']; ?>" height="50px" width="50px"
                      onclick="showImageModal('<?php echo $data['ss']; ?>')" style="cursor: pointer;" alt="Thumbnail" />
                  </td>
                  <td>
                    <?php if ($data['status'] == 0) { ?>
                      <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                          <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="<?php echo base_url() . 'regularProgram/acceptOrder/' . $data['id'] ?>">
                            <i class="bx bx-check me-1"></i> Accept
                          </a>
                          <a class="dropdown-item" href="<?php echo base_url() . 'regularProgram/rejectOrder/' . $data['id'] ?>">
                            <i class="bx bx-x me-1"></i> Reject
                          </a>
                        </div>
                      </div>
                    <?php } elseif ($data['status'] == 1) { ?>
                      <span class="badge bg-success">Approved</span>
                    <?php } else { ?>
                      <span class="badge bg-danger">Rejected</span>
                    <?php } ?>
                  </td>
                </tr>
              <?php } ?>
            <?php } ?>

          </tbody>
        </table>
      </div>
    </div>

  </div>

  <!-- Image Modal -->
  <div id="imageModal"
    style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.8); z-index: 1000;">
    <div
      style="position: relative; margin: auto; top: 50%; transform: translateY(-50%); max-width: 90%; text-align: center;">
      <img id="modalImage" src="" style="max-width: 100%; max-height: 90vh;" alt="Large View" />
      <button onclick="closeModal()"
        style="position: absolute; top: 5%; right: 5%; background: white; border: none; font-size: 16px; padding: 5px; cursor: pointer;">
        Close
      </button>
    </div>
  </div>

  <script>
    function showImageModal(imageSrc) {
      document.getElementById('modalImage').src = imageSrc;
      document.getElementById('imageModal').style.display = 'block';
    }

    function closeModal() {
      document.getElementById('imageModal').style.display = 'none';
    }
  </script>

  <?php include('footer.php') ?>
</div>
