<?php include('header.php'); ?>
<?php include('topbar.php'); ?>
<?php include('flashdata.php'); ?>

<?php
// Pricing & Commission Setup
$unitPrice      = floatval($courseDetails['price']);
$deliveryCharge = 0;
$minQty         = 20;

// Commission rates from course JSON (agentComission column)
$allRates = json_decode($courseDetails['agentComission'], true);
// শুধুমাত্র onlineAgent ও officeSupport
$map = [
    'onlineAgent'   => isset($allRates['onlineAgent']) ? floatval($allRates['onlineAgent']) : 0,
    'officeSupport' => isset($allRates['officeSupport']) ? floatval($allRates['officeSupport']) : 0,
];

// Parse which commission-types agent-এর আছে
$commissionPerUnit = 0;
$hasCommission     = false;
preg_match_all('/"([^"]+)"/', $agentData['comission'], $m);
$types = $m[1] ?? [];
foreach ($types as $t) {
    if (isset($map[$t])) {
        $commissionPerUnit += $map[$t];
        $hasCommission = true;
    }
}

// Initial totals
$initialQty       = $minQty;
$bagTotal         = $unitPrice * $initialQty;
$commissionAmount = $commissionPerUnit * $initialQty;
$orderTotal       = $bagTotal - $commissionAmount;
$totalPay         = $orderTotal + $deliveryCharge;
?>


<div class="content-wrapper">
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Checkout /</span> <?= htmlspecialchars($courseDetails['title']); ?></h4>

    <!-- Commission Info -->
    <?php if ($hasCommission): ?>
      <div class="alert alert-success">Flat discount: ৳<?= number_format($commissionPerUnit,2); ?> per unit.</div>
    <?php else: ?>
      <div class="alert alert-warning">No agent commission discount available.</div>
    <?php endif; ?>

    <form method="post" action="" enctype="multipart/form-data">
      <div class="row">
        <div class="col-xl-8 mb-3 mb-xl-0">
          <h5>My Shopping Bag</h5>
          <ul class="list-group mb-3">
            <li class="list-group-item p-4 d-flex gap-3">
              <div class="flex-shrink-0">
                <img src="<?= $courseDetails['img_path'] . $courseDetails['img']; ?>" style="width:100px;" alt="">
              </div>
              <div class="flex-grow-1">
                <h6><?= htmlspecialchars($courseDetails['title']); ?></h6>
                <span class="badge bg-success mb-2">In Stock</span>
                <div class="mb-2">
                  <label for="quantity" class="form-label">Quantity (min <?= $minQty ?>)</label>
                  <input type="number"
                         id="quantity"
                         name="quantity"
                         class="form-control form-control-sm"
                         value="<?= $initialQty ?>"
                         min="<?= $minQty ?>"
                         max="50000"
                         style="width:80px;">
                </div>
                <div>Unit Price: <strong><?= number_format($unitPrice,2); ?> ৳</strong></div>
              </div>
            </li>
          </ul>
        </div>

        <div class="col-xl-4">
          <div class="border rounded p-3 mb-3">
            <h6>Price Details</h6>
            <dl class="row mb-0">
              <dt class="col-6">Bag Total</dt>
              <dd id="bagTotal" class="col-6 text-end"><?= number_format($bagTotal,2); ?></dd>

              <dt class="col-6">Commission Discount</dt>
              <dd id="commissionAmt" class="col-6 text-end text-danger">-<?= number_format($commissionAmount,2); ?></dd>

              <dt class="col-6">Order Total</dt>
              <dd id="orderTotal" class="col-6 text-end"><?= number_format($orderTotal,2); ?></dd>

              <dt class="col-6">Total Payable</dt>
              <dd id="totalPay" class="col-6 fw-bold text-end"><?= number_format($totalPay,2); ?></dd>
            </dl>
          </div>

          <div class="card mb-3">
            <h5 class="card-header">Payment Gateway</h5>
            <div class="card-body">
              <div class="row">
                <?php foreach ($gatewayList as $gw): ?>
                  <div class="col-md-4 mb-2">
                    <div class="form-check custom-option custom-option-icon">
                      <label class="form-check-label custom-option-content" for="gateway_<?= $gw['id'] ?>">
                        <span class="custom-option-body text-center">
                          <img src="<?= $gw['image'] ?>" style="width:40px;" alt="">
                          <div><?= htmlspecialchars($gw['name']); ?></div>
                        </span>
                        <input type="radio"
                               id="gateway_<?= $gw['id'] ?>"
                               name="gateway_id"
                               value="<?= $gw['id'] ?>"
                               class="form-check-input"
                               required>
                      </label>
                    </div>
                  </div>
                <?php endforeach; ?>
              </div>
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

          <button type="submit" class="btn btn-primary w-100">Proceed to Checkout</button>
        </div>
      </div>
    </form>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const unitPrice         = <?= json_encode($unitPrice); ?>;
    const commissionPerUnit = <?= json_encode($commissionPerUnit); ?>;
    const deliveryCharge    = <?= json_encode($deliveryCharge); ?>;
    const minQty            = <?= json_encode($minQty); ?>;

    const qtyInput = document.getElementById('quantity');
    const bagEl    = document.getElementById('bagTotal');
    const commEl   = document.getElementById('commissionAmt');
    const orderEl  = document.getElementById('orderTotal');
    const totalEl  = document.getElementById('totalPay');

    function recalc(qty) {
        const bag        = qty * unitPrice;
        const commission = qty * commissionPerUnit;
        const order      = bag - commission;
        const total      = order + deliveryCharge;

        bagEl.textContent      = bag.toFixed(2);
        commEl.textContent     = '-' + commission.toFixed(2);
        orderEl.textContent    = order.toFixed(2);
        totalEl.textContent    = total.toFixed(2);
    }

    qtyInput.addEventListener('input', function() {
        let q = parseInt(qtyInput.value) || minQty;
        q = Math.max(minQty, Math.min(q, 50000));
        qtyInput.value = q;
        recalc(q);
    });
});
</script>