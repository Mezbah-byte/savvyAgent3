<?php include('header.php') ?>

<?php include('topbar.php') ?>




<?php include('flashdata.php') ?>





<div class="content-wrapper">

  <!-- Content -->

  <div class="container-xxl flex-grow-1 container-p-y">


    <!-- Hoverable Table rows -->
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


              <th>Course Price</th>
              <th>Course Type</th>
              <th>Course Quantity</th>
              <th>Total Amount</th>



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


                <td><?php echo $data['amount']; ?></td>
                <td><?php echo $data['courseType']; ?></td>
                <td><?php echo $data['quantity']; ?></td>
                <td><?php echo $data['amount'] * $data['quantity']; ?></td>




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
    <!--/ Hoverable Table rows -->



  </div>
  <!-- / Content -->


  <!-- Modal Structure -->
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

  <!-- JavaScript -->
  <script>
    function showImageModal(imageSrc) {
      // Set the modal image source
      document.getElementById('modalImage').src = imageSrc;
      // Display the modal
      document.getElementById('imageModal').style.display = 'block';
    }

    function closeModal() {
      // Hide the modal
      document.getElementById('imageModal').style.display = 'none';
    }
  </script>























  <?php include('footer.php') ?>