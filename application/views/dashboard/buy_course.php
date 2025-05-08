<?php include('header.php'); ?>
<?php include('topbar.php'); ?>
<?php include('flashdata.php'); ?>

<?php
// Pricing & Commission Setup
$unitPrice      = floatval($courseDetails['price']);
$deliveryCharge = 0;
$minQty         = 20;

// Commission types mapping to flat discount amounts (৳ per unit)
if($courseDetails['type'] == 'premium'){
    $map = [
        'onlineAgent'   => 100,  // ৳50 off per unit for online agents
        'officeSupport' => 100, // ৳100 off per unit for office support agents
        'paymentGateway'=> 100,  // ৳70 off per unit for payment gateway type
        // add more mappings as needed
    ];
} else{
    $map = [
        'onlineAgent'   => 20,  // ৳50 off per unit for online agents
        'officeSupport' => 20, // ৳100 off per unit for office support agents
        'paymentGateway'=> 20,  // ৳70 off per unit for payment gateway type
        // add more mappings as needed
    ];
}

// Parse 'comission' field to determine total flat discount per unit
$commissionPerUnit = 0;
$hasCommission = false;
if (!empty($agentData['comission'])) {
    preg_match_all('/"([^"]+)"/', $agentData['comission'], $matches);
    $types = $matches[1] ?? [];
    foreach ($types as $type) {
        if (isset($map[$type])) {
            $commissionPerUnit += $map[$type];
            $hasCommission = true;
        }
    }
}

// Initial calculations
$initialQty         = $minQty;
$bagTotal           = $unitPrice * $initialQty;
$commissionAmount   = $commissionPerUnit * $initialQty;
$orderTotal         = $bagTotal - $commissionAmount;
$totalPay           = $orderTotal + $deliveryCharge;
?>

<div class="content-wrapper">
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Checkout /</span> <?php echo htmlspecialchars($courseDetails['title']); ?></h4>

    <!-- Show commission info -->
    <?php if ($hasCommission): ?>
      <div class="alert alert-success">You have a flat ৳<?php echo number_format($commissionPerUnit,2); ?> discount per unit.</div>
    <?php else: ?>
      <div class="alert alert-warning">No agent commission discount available.</div>
    <?php endif; ?>

    <form method="post" action="">
      <div class="row">
        <!-- Shopping Bag -->
        <div class="col-xl-8 mb-3 mb-xl-0">
          <h5>My Shopping Bag</h5>
          <ul class="list-group mb-3">
            <li class="list-group-item p-4 d-flex gap-3">
              <div class="flex-shrink-0">
                <img src="<?php echo $courseDetails['img_path'] . $courseDetails['img']; ?>" alt="" style="width:100px;">
              </div>
              <div class="flex-grow-1">
                <h6><?php echo htmlspecialchars($courseDetails['title']); ?></h6>
                <span class="badge bg-success mb-2">In Stock</span>
                <div class="mb-2">
                  <label for="quantity" class="form-label">Quantity (min <?php echo $minQty; ?>)</label>
                  <input type="number" id="quantity" name="quantity" class="form-control form-control-sm" value="<?php echo $initialQty; ?>" min="<?php echo $minQty; ?>" max="50000" style="width:80px;">
                </div>
                <div>Unit Price: <strong><?php echo number_format($unitPrice,2); ?> ৳</strong></div>
              </div>
            </li>
          </ul>
        </div>

        <!-- Price Details -->
        <div class="col-xl-4">
          <div class="border rounded p-3 mb-3">
            <h6>Price Details</h6>
            <dl class="row mb-0">
              <dt class="col-6">Bag Total</dt>
              <dd class="col-6 text-end" id="bagTotal"><?php echo number_format($bagTotal,2); ?></dd>

              <dt class="col-6">Commission Discount</dt>
              <dd class="col-6 text-end text-danger" id="commissionAmt">-<?php echo number_format($commissionAmount,2); ?></dd>

              <dt class="col-6">Order Total</dt>
              <dd class="col-6 text-end" id="orderTotal"><?php echo number_format($orderTotal,2); ?></dd>

              <!-- <dt class="col-6">Delivery Charges</dt>
              <dd class="col-6 text-end" id="deliveryCharge"><?php echo $deliveryCharge===0?'<span class="badge bg-success">Free</span>':number_format($deliveryCharge,2); ?></dd> -->

              <dt class="col-6">Total Payable</dt>
              <dd class="col-6 fw-bold text-end" id="totalPay"><?php echo number_format($totalPay,2); ?></dd>
            </dl>
          </div>

          <div class="card">
          <h5 class="card-header">Custom Option Radios With SVG Icons</h5>
            
            <div class="card-body">
        <div class="row">
            <?php foreach($gatewayList as $gateway){ ?>
                <div class="col-md mb-md-0 mb-2">
                <div class="form-check custom-option custom-option-icon checked">
                  <label class="form-check-label custom-option-content" for="customRadioSvg1">
                    <span class="custom-option-body">
                      <img src="<?= $gateway['image']?>" class="w-px-40 mb-2" alt="<?= $gateway['name']?>">
                      <span class="custom-option-title"> <?= $gateway['name']?> </span>
                      <small><?= $gateway['description']?></small>
                    </span>
                    <input name="customRadioSvg" class="form-check-input" type="radio" value="<?= $gateway['id']?>" id="customRadioSvg1" checked="" required>
                  </label>
                </div>
              </div>
            <?php }?>
          


        </div>
      </div>

      <h5 class="card-header">Transaction ID</h5>
            <div class="card-body">
                <div class="mb-3">
                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                </div>
            </div>
      <h5 class="card-header">Upload Payment Screenshot</h5>
            <div class="card-body">
                <div class="mb-3">
                <input class="form-control" type="file" id="formFile">
                </div>
            </div>
            </div>
            <br>
          <button type="submit" class="btn btn-primary w-100">Proceed to Checkout</button>
        </div>
      </div>
    </form>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const unitPrice         = <?php echo json_encode($unitPrice); ?>;
    const commissionPerUnit = <?php echo json_encode($commissionPerUnit); ?>;
    const deliveryCharge    = <?php echo json_encode($deliveryCharge); ?>;
    const minQty            = <?php echo json_encode($minQty); ?>;

    const qtyInput     = document.getElementById('quantity');
    const bagEl        = document.getElementById('bagTotal');
    const commEl       = document.getElementById('commissionAmt');
    const orderEl      = document.getElementById('orderTotal');
    const totalEl      = document.getElementById('totalPay');

    function recalc(qty) {
        const bag          = qty * unitPrice;
        const commission   = qty * commissionPerUnit;
        const order        = bag - commission;
        const total        = order + deliveryCharge;

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