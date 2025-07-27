<?php include('header.php') ?>

<?php include('topbar.php') ?>

<div class="content-wrapper">

  <!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">

    <!-- Hoverable Table rows -->
    <div class="card">
      <h5 class="card-header d-flex justify-content-between align-items-center">
  Course List
  <a href="<?php echo base_url('buyCourses'); ?>" class="btn btn-sm btn-success">
    <i class="bx bx-cart me-1"></i> Buy Courses
  </a>
</h5>
      <div class="table-responsive text-nowrap">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Product</th>
              <th>Main Price</th>
              <th>Offer Price</th>
              <!-- <th>Actions</th> -->
            </tr>
          </thead>
          <tbody class="table-border-bottom-0">

            <?php foreach ($courses as $course) { ?>
              <tr>
                <td>
                  <img src="<?php echo $course['img_path'] . $course['img']; ?>" height="50" width="50" />
                  <span class="fw-medium"><?php echo $course['title'] ?></span>
                </td>
                <td><?php echo $course['full_price'] . ' ৳'; ?></td>
                <td><?php echo $course['price'] . ' ৳'; ?></td>
                <!-- <td>
                  <a href="<?php echo base_url('buyCourse/' . $course['un_id']); ?>"
                     class="btn btn-sm btn-success">
                    <i class="bx bx-cart me-1"></i> Buy Course
                  </a>
                </td> -->
              </tr>
            <?php } ?>

          </tbody>
        </table>
      </div>
    </div>
    <!--/ Hoverable Table rows -->

  </div>
  <!-- / Content -->

  <?php include('footer.php') ?>
