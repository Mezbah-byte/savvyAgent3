<!-- application/views/dashboard/buy_courses.php -->
<?php include('header.php'); ?>
<?php include('topbar.php'); ?>
<?php include('flashdata.php'); ?>

<div class="content-wrapper">
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4">
      <span class="text-muted fw-light">Dashboard /</span> Buy Courses
    </h4>

    <form method="post" action="<?php echo base_url('buyCourses'); ?>" enctype="multipart/form-data">
      <div class="row">

        <!-- Left: Course List -->
        <div class="col-xl-8 mb-4">
          <h5>Select Courses</h5>
          <ul class="list-group">
            <?php foreach($courseList as $idx => $course): 
              $unitPrice = floatval($course['price']);
              $allRates = json_decode($course['agentComission'], true);
              $commissionPerUnit = 0;
              foreach(['onlineAgent','officeSupport'] as $type){
                if(!empty($allRates[$type])) $commissionPerUnit += floatval($allRates[$type]);
              }
            ?>
            <li class="list-group-item p-3 d-flex align-items-center">
              <div class="form-check me-3">
                <input class="form-check-input course-checkbox"
                       type="checkbox"
                       id="select_<?= $idx ?>"
                       name="selected[]"
                       value="<?= $course['un_id'] ?>"
                       data-idx="<?= $idx ?>"
                       data-unit="<?= $unitPrice ?>"
                       data-comm="<?= $commissionPerUnit ?>">
              </div>
              <div class="flex-grow-1 d-flex align-items-center">
                <img src="<?= $course['img_path'] . $course['img'] ?>"
                     alt="" style="width:80px; height:auto;">
                <div class="ms-3 flex-grow-1">
                  <h6 class="mb-1"><?= htmlspecialchars($course['title']) ?></h6>
                  <small>Price: <?= number_format($unitPrice,2) ?> ৳
                    <?php if($commissionPerUnit>0): ?>
                      &nbsp;|&nbsp; Discount: <?= number_format($commissionPerUnit,2) ?>/unit
                    <?php endif; ?>
                  </small>
                  <div class="mt-2" style="max-width:120px;">
                    <label for="qty_<?= $idx ?>" class="form-label mb-0 small">Qty</label>
                    <input type="number"
                           id="qty_<?= $idx ?>"
                           name="quantity[<?= $course['un_id'] ?>]"
                           class="form-control form-control-sm qty-input"
                           value="1"
                           min="1" max="50000"
                           disabled>
                  </div>
                </div>
              </div>
              <div class="text-end ms-3" style="min-width:120px;">
                <div>Sub: <span id="sub_<?= $idx ?>">0.00</span></div>
                <div class="text-danger">Disc: <span id="dis_<?= $idx ?>">0.00</span></div>
                <div class="fw-bold">Tot: <span id="tot_<?= $idx ?>">0.00</span></div>
              </div>
            </li>
            <?php endforeach; ?>
          </ul>
        </div>

        <!-- Right: Summary, Balance & Payment -->
        <div class="col-xl-4">
          <!-- Order Summary -->
          <div class="border rounded p-3 mb-4">
            <h6>Order Summary</h6>
            <dl class="row mb-0">
              <dt class="col-6">Total Qty</dt>
              <dd class="col-6 text-end fw-bold" id="grandQty">0</dd>
              <dt class="col-6">Grand Total</dt>
              <dd class="col-6 text-end fw-bold" id="grandTotal">0.00 ৳</dd>
            </dl>
          </div>

          <!-- Agent Balance Deduction -->
          <div class="card mb-4">
            <h6 class="card-header">Agent Balance</h6>
            <div class="card-body">
              <div class="form-check mb-2">
                <input
                    class="form-check-input"
                    type="checkbox"
                    id="useBalance"
                    name="useBalance"
                    value="1">
                <label class="form-check-label" for="useBalance">
                  Use Balance (Current: ৳<?= number_format($agentData['current_balance'],2) ?>)
                </label>
              </div>
              <div class="mb-2">
                <label for="balanceAmt" class="form-label small">Amount to Use</label>
                <input type="number"
                       id="balanceAmt"
                       name="balance_amt"
                       class="form-control form-control-sm"
                       value="0"
                       min="0"
                       max="<?= floatval($agentData['current_balance']) ?>"
                       disabled>
              </div>
              <div>
                Final Total: <strong id="finalTotal">0.00 ৳</strong>
              </div>
            </div>
          </div>

          <!-- Single Payment Section -->
          <div class="card mb-4">
            <h5 class="card-header">Payment</h5>
            <div class="card-body">
              <div class="mb-3">
                <label class="form-label">Gateway</label>
                <div class="row">
                  <?php foreach($gatewayList as $gw): ?>
                    <div class="col-auto">
                      <div class="form-check">
                        <input class="form-check-input"
                               type="radio"
                               name="gateway_id"
                               id="gw_<?= $gw['id'] ?>"
                               value="<?= $gw['id'] ?>"
                               required>
                        <label class="form-check-label" for="gw_<?= $gw['id'] ?>">
                          <img src="<?= $gw['image'] ?>" style="width:24px;" alt="">
                          <?= htmlspecialchars($gw['name']) ?>
                        </label>
                      </div>
                    </div>
                  <?php endforeach; ?>
                </div>
              </div>
              <div class="mb-3">
                <label for="trx" class="form-label">Transaction ID</label>
                <input type="text" id="trx" name="trx" class="form-control" required>
              </div>
              <div class="mb-3">
                <label for="ssLink" class="form-label">Upload Payment Screenshot</label>
                <input type="file" id="ssLink" name="ssLink" class="form-control" accept="image/*" required>
              </div>
              <button type="submit"
                      id="proceedBtn"
                      class="btn btn-primary w-100"
                      disabled>
                Complete Purchase
              </button>
            </div>
          </div>
        </div>

      </div>
    </form>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const grandEl    = document.getElementById('grandTotal');
  const grandQtyE  = document.getElementById('grandQty');
  const finalEl    = document.getElementById('finalTotal');
  const proceed    = document.getElementById('proceedBtn');
  const useBalChk  = document.getElementById('useBalance');
  const balInput   = document.getElementById('balanceAmt');
  const agentMax   = parseFloat(balInput.max) || 0;

  // রিক্যালক + আপডেট থ্রেশহোল্ড চেক
  function updateSummary() {
    let totalAmt = 0, totalQty = 0;
    document.querySelectorAll('.course-checkbox:checked').forEach(chk => {
      const idx = chk.dataset.idx;
      const qty = parseInt(document.getElementById('qty_' + idx).value) || 0;
      const tot = parseFloat(document.getElementById('tot_' + idx).textContent) || 0;
      totalQty += qty;
      totalAmt += tot;
    });

    // Grand totals
    grandQtyE.textContent = totalQty;
    grandEl.textContent   = totalAmt.toFixed(2) + ' ৳';

    // Balance deduction
    let balanceUse = 0;
    if (useBalChk.checked) {
      balanceUse = Math.min(agentMax, parseFloat(balInput.value) || 0);
      // নিরাপদ রাখতে একটু চেক
      if (balanceUse < 0) balanceUse = 0;
    }
    const finalTotal = Math.max(0, totalAmt - balanceUse);
    finalEl.textContent = finalTotal.toFixed(2) + ' ৳';

    // Button enable logic: Qty>=10 and FinalTotal>0
    proceed.disabled = totalQty < 10 || finalTotal <= 0;
  }

  // course-checkbox handling (same যেমন before)
  document.querySelectorAll('.course-checkbox').forEach(chk => {
    const idx  = chk.dataset.idx;
    const unit = parseFloat(chk.dataset.unit);
    const comm = parseFloat(chk.dataset.comm);
    const qty  = document.getElementById('qty_' + idx);

    function recalc() {
      const q   = parseInt(qty.value) || 1;
      const sub = q * unit;
      const dis = q * comm;
      const tot = sub - dis;
      document.getElementById('sub_' + idx).textContent = sub.toFixed(2);
      document.getElementById('dis_' + idx).textContent = dis.toFixed(2);
      document.getElementById('tot_' + idx).textContent = tot.toFixed(2);
      updateSummary();
    }

    chk.addEventListener('change', () => {
      qty.disabled = !chk.checked;
      if (chk.checked) recalc();
      else {
        document.getElementById('sub_' + idx).textContent = '0.00';
        document.getElementById('dis_' + idx).textContent = '0.00';
        document.getElementById('tot_' + idx).textContent = '0.00';
        updateSummary();
      }
    });

    qty.addEventListener('input', () => {
      if (chk.checked) recalc();
    });
  });

  // balance checkbox & input
  useBalChk.addEventListener('change', () => {
    balInput.disabled = !useBalChk.checked;
    if (!useBalChk.checked) {
      balInput.value = 0;
    }
    updateSummary();
  });
  balInput.addEventListener('input', () => {
    // ensure <= max
    if (parseFloat(balInput.value) > agentMax) {
      balInput.value = agentMax;
    }
    updateSummary();
  });
});
</script>

<?php include('footer.php'); ?>
