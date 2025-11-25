<?php include('header.php'); ?>
<?php include('topbar.php'); ?>
<?php include('flashdata.php'); ?>

<?php
$unitPrice      = floatval($programDetails['price']);
$deliveryCharge = 0;
$minQty         = 1;

// Commission: Fixed 50 taka per package
$commissionPerUnit = 50;

$initialQty       = $minQty;
$bagTotal         = $unitPrice * $initialQty;
$commissionAmount = $commissionPerUnit * $initialQty;
$orderTotal       = $bagTotal - $commissionAmount;
$totalPay         = $orderTotal + $deliveryCharge;
?>

<div class="content-wrapper">
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Buy Regular Program /</span> <?= htmlspecialchars($programDetails['title']); ?></h4>

    <div class="alert alert-success">
      <strong>Agent Commission:</strong> ৳50 per regular program package
    </div>

    <form method="post" action="" enctype="multipart/form-data">
      <div class="row">
        <div class="col-xl-8 mb-3 mb-xl-0">
          <h5>Regular Program Details</h5>
          <ul class="list-group mb-3">
            <li class="list-group-item p-4">
              <div class="flex-grow-1">
                <h6><?= htmlspecialchars($programDetails['title']); ?></h6>
                <p class="text-muted"><?= nl2br(htmlspecialchars($programDetails['details'])); ?></p>
                <span class="badge bg-success mb-2">Available</span>
                <div class="mb-2">
                  <label for="quantity" class="form-label">Quantity (min <?= $minQty ?>)</label>
                  <input type="number"
                         id="quantity"
                         name="quantity"
                         class="form-control form-control-sm"
                         value="<?= $initialQty ?>"
                         min="<?= $minQty ?>"
                         max="50000"
                         style="width:100px;">
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

              <dt class="col-6">Agent Commission</dt>
              <dd id="commissionAmt" class="col-6 text-end text-success">-<?= number_format($commissionAmount,2); ?></dd>

              <dt class="col-6">Order Total</dt>
              <dd id="orderTotal" class="col-6 text-end"><?= number_format($orderTotal,2); ?></dd>

              <dt class="col-6 fw-bold">Total Payable</dt>
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

          <button type="submit" class="btn btn-primary w-100">Submit Buy Request</button>
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

        bagEl.textContent   = bag.toFixed(2);
        commEl.textContent  = '-' + commission.toFixed(2);
        orderEl.textContent = order.toFixed(2);
        totalEl.textContent = total.toFixed(2);
    }

    qtyInput.addEventListener('input', function() {
        let q = parseInt(qtyInput.value) || minQty;
        q = Math.max(minQty, Math.min(q, 50000));
        qtyInput.value = q;
        recalc(q);
    });
});
</script>

<?php include('footer.php'); ?>
