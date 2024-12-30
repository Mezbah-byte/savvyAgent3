<?php include('header.php') ?>

<?php include('topbar.php') ?>




<?php include('flashdata.php') ?>





<!-- <div class="content-wrapper">

  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
      <h5 class="card-header">Course List</h5>
      <div class="table-responsive text-nowrap">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>User Image</th>
              <th>User Name</th>
              <th>Phone Number</th>
              <th>Course Name</th>


              <th>Course Type</th>
              <th>Course Price</th>
              <th>Course Quantity</th>
              <th>Total Amount</th>

              <th>Requested at</th>
              <th>Worked at</th>


              <th>Payment Method</th>
              <th>TRX</th>
              <th>Screen Shot</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0">

            <?php foreach ($datas as $data) { ?>
              <tr>

                <td><img src="<?php echo $data['userImg']; ?>" class="rounded-circle" height="50px" width="50px" /> <span
                    class="fw-medium"><?php echo $data['name'] ?></span></td>
                <td><?php echo $data['name'] . ' (' . $data['username'] . ')'; ?></td>
                <td><?php echo $data['phoneNumber']; ?></td>
                <td><?php echo $data['courseName']; ?></td>


                <td><?php echo $data['courseType']; ?></td>
                <td><?php echo $data['amount']; ?></td>
                <td><?php echo $data['quantity']; ?></td>
                <td><?php echo $data['amount'] * $data['quantity']; ?></td>


                <td><?php echo $data['created_at']; ?></td>
                <td><?php echo $data['updated_at']; ?></td>


                <td><img src="<?php echo $data['paymentMethodIcon']; ?>" height="30px"
                    width="30px" /><?php echo $data['paymentMethod']; ?></td>
                <td><?php echo $data['trx']; ?></td>
                <td>
                  <img src="<?php echo $data['ss']; ?>" height="50px" width="50px"
                    onclick="showImageModal('<?php echo $data['ss']; ?>')" style="cursor: pointer;" alt="Thumbnail" />
                </td>
                <td>
                  <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i
                        class="bx bx-dots-vertical-rounded"></i></button>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="<?php echo base_url() . 'acceptOrder/' . $data['id'] ?>"><i
                          class="bx bx-edit-alt me-1"></i> Accept</a>
                      <a class="dropdown-item" href="<?php echo base_url() . 'cancelOrder/' . $data['id'] ?>"><i
                          class="bx bx-trash me-1"></i> Cancel</a>
                    </div>
                  </div>
                </td>
              </tr>
            <?php } ?>

          </tbody>
        </table>
      </div>
    </div>



  </div>


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
  </script> -->




<div class="content-wrapper">
  <div class="container-xxl flex-grow-1 container-p-y">

    <div class="card">
      <h5 class="card-header">Course List</h5>
      <div class="table-responsive text-nowrap">
        <table id="courseTable" class="table table-hover">
          <thead>
            <tr>
              <th>User Image</th>
              <th>User Name</th>
              <th>Phone Number</th>
              <th>Course Name</th>
              <th>Course Type</th>
              <th>Course Price</th>
              <th>Course Quantity</th>
              <th>Total Amount</th>
              <th>Requested at</th>
              <th>Worked at</th>
              <th>Payment Method</th>
              <th>TRX</th>
              <th>Screen Shot</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0">

            <?php foreach ($datas as $data) { ?>
              <tr>
                <td>
                  <img src="<?php echo $data['userImg']; ?>" class="rounded-circle" height="50px" width="50px" />
                  <span class="fw-medium"><?php echo $data['name'] ?></span>
                </td>
                <td><?php echo $data['name'] . ' (' . $data['username'] . ')'; ?></td>
                <td><?php echo $data['phoneNumber']; ?></td>
                <td><?php echo $data['courseName']; ?></td>
                <td><?php echo $data['courseType']; ?></td>
                <td><?php echo $data['amount']; ?></td>
                <td><?php echo $data['quantity']; ?></td>
                <td><?php echo $data['amount'] * $data['quantity']; ?></td>
                <td><?php echo $data['created_at']; ?></td>
                <td><?php echo $data['updated_at']; ?></td>
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
                  <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                      <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu">
                      <?php if ($data['status'] == 0) { ?>
                        <a class="dropdown-item" href="<?php echo base_url() . 'acceptOrder/' . $data['id'] ?>">
                          <i class="bx bx-edit-alt me-1"></i> Accept
                        </a>
                        <a class="dropdown-item" href="<?php echo base_url() . 'cancelOrder/' . $data['id'] ?>">
                          <i class="bx bx-trash me-1"></i> Cancel
                        </a>
                      <?php } ?>

                    </div>
                  </div>
                </td>
              </tr>
            <?php } ?>

          </tbody>
        </table>
      </div>
    </div>

  </div>
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

  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>

  <script>
    $(document).ready(function () {
      $('#courseTable').DataTable({
        paging: true,
        searching: true,
        ordering: true,
        lengthChange: true,
        pageLength: 10,
        responsive: true,
        language: {
          search: "_INPUT_",
          searchPlaceholder: "Search courses..."
        }
      });
    });
  </script>
</div>























<?php include('footer.php') ?>