<?php include('header.php') ?>

<?php include('topbar.php') ?>










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
                            <th>Gateway</th>
                            <th>Receiver Address</th>
                            <th>Description</th>
                            <!-- <th>Unit</th> -->
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">

                        <?php foreach ($myGatewayList as $gateway) { ?>
                            <tr>
                                <td><img src="<?php echo $gateway['image']; ?>" height="50px" width="50px" /> <span
                                        class="fw-medium"><?php echo $gateway['name'] ?></span></td>
                                <td><?php echo $gateway['receiver_address'] . ' ৳'; ?></td>
                                <td><?php echo $gateway['description'] . ' ৳'; ?></td>
                                <!-- <td><?php echo $course['stock']; ?></td> -->
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item"
                                                href="<?php echo base_url() . 'acceptOrder/' . $gateway['id'] ?>"><i
                                                    class="bx bx-edit-alt me-1"></i> Accept</a>
                                            <a class="dropdown-item"
                                                href="<?php echo base_url() . 'cancelOrder/' . $gateway['id'] ?>"><i
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























    <?php include('footer.php') ?>