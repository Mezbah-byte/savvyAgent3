<?php include('header.php'); ?>
<?php include('topbar.php'); ?>
<?php include('flashdata.php'); ?>

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header d-flex align-items-center bg-primary text-white">
                        <i class="fa-solid fa-bolt me-2"></i>
                        <h5 class="mb-0">Mobile Recharge</h5>
                    </div>
                    <div class="card-body">
                        <form method="post" action="<?php echo base_url('recharge/process'); ?>">
                            <div class="mb-3">
                                <label for="phone" class="form-label">Mobile Number</label>
                                <input type="text" id="phone" name="phone" class="form-control" required placeholder="01XXXXXXXXX">
                            </div>
                            <div class="mb-3">
                                <label for="operator" class="form-label">Operator</label>
                                <div class="mb-2 operator-logos d-flex gap-2" style="flex-wrap:wrap;">
                                    <img src="https://f005.backblazeb2.com/file/savvy-data/mobileOperator/grameenphone-logo-png_seeklogo-611778.png" alt="GP" title="Grameenphone" style="width:32px;height:32px;object-fit:contain;border-radius:6px;background:#f7faff;border:1px solid #e0e7ef;padding:2px;">
                                    <img src="https://f005.backblazeb2.com/file/savvy-data/mobileOperator/robi-logo-png_seeklogo-454716.png" alt="Robi" title="Robi" style="width:32px;height:32px;object-fit:contain;border-radius:6px;background:#f7faff;border:1px solid #e0e7ef;padding:2px;">
                                    <img src="https://f005.backblazeb2.com/file/savvy-data/mobileOperator/airtel-logo-png_seeklogo-305383.png" alt="Airtel" title="Airtel" style="width:32px;height:32px;object-fit:contain;border-radius:6px;background:#f7faff;border:1px solid #e0e7ef;padding:2px;">
                                    <img src="https://f005.backblazeb2.com/file/savvy-data/mobileOperator/banglalink-logo-png_seeklogo-611779.png" alt="Banglalink" title="Banglalink" style="width:32px;height:32px;object-fit:contain;border-radius:6px;background:#f7faff;border:1px solid #e0e7ef;padding:2px;">
                                    <img src="https://f005.backblazeb2.com/file/savvy-data/mobileOperator/teletalk-sim-operator-logo-png_seeklogo-388669.png" alt="Teletalk" title="Teletalk" style="width:32px;height:32px;object-fit:contain;border-radius:6px;background:#f7faff;border:1px solid #e0e7ef;padding:2px;">
                                    <img src="https://f005.backblazeb2.com/file/savvy-data/mobileOperator/skitto-sim-logo-png_seeklogo-500507.png" alt="Skitto" title="Skitto" style="width:32px;height:32px;object-fit:contain;border-radius:6px;background:#f7faff;border:1px solid #e0e7ef;padding:2px;">
                                </div>
                                <select id="operator" name="operator" class="form-select" required>
                                    <option value="">Select Operator</option>
                                    <option value="GP">Grameenphone</option>
                                    <option value="RB">Robi</option>
                                    <option value="AT">Airtel</option>
                                    <option value="BL">Banglalink</option>
                                    <option value="TT">Teletalk</option>
                                    <option value="SK">Skitto</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="type" class="form-label">Connection Type</label>
                                <select id="type" name="type" class="form-select" required>
                                    <option value="1">Prepaid</option>
                                    <option value="2">Postpaid</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="amount" class="form-label">Amount</label>
                                <input type="number" id="amount" name="amount" class="form-control" min="20" required placeholder="Minimum 20 BDT">
                            </div>
                            <button type="submit" class="btn btn-primary w-100"><i class="fa-solid fa-paper-plane me-1"></i> Recharge Now</button>
                        </form>
                        <div class="note text-center mt-3 text-muted small">Minimum recharge amount is 20 BDT. All transactions are secure.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('footer.php'); ?>
