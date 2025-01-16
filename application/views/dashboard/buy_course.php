<?php include('header.php') ?>

<?php include('topbar.php') ?>




<?php include('flashdata.php') ?>


<div class="content-wrapper">

    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">


        <h4 class="py-3 breadcrumb-wrapper mb-4">
            <span class="text-muted fw-light">Checkout /</span> <?php echo $courseDetails['title'] ?>
        </h4>

        <!-- Checkout Wizard -->
        <div id="wizard-checkout" class="bs-stepper wizard-icons wizard-icons-example mt-2">

            <div class="bs-stepper-content border-top">
                <form id="wizard-checkout-form" onSubmit="return false">

                    <!-- Cart -->
                    <div id="checkout-cart" class="content">
                        <div class="row">
                            <!-- Cart left -->
                            <div class="col-xl-8 mb-3 mb-xl-0">



                                <!-- Shopping bag -->
                                <h5>My Shopping Bag </h5>
                                <ul class="list-group mb-3">
                                    <li class="list-group-item p-4">
                                        <div class="d-flex gap-3">
                                            <div class="flex-shrink-0">
                                                <img src="<?php echo $courseDetails['img_path'] . $courseDetails['img'] ?>"
                                                    alt="google home" class="w-px-100">
                                            </div>
                                            <div class="flex-grow-1">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <h6 class="me-3"><a href="javascript:void(0)"
                                                                class="text-body"><?php echo $courseDetails['title'] ?></a>
                                                        </h6>
                                                        <div class="text-muted mb-1 d-flex flex-wrap"> <span
                                                                class="badge bg-label-success">In Stock</span></div>
                                                        <div class="read-only-ratings mb-2"
                                                            data-rateyo-read-only="true"></div>
                                                        <input type="number"
                                                            class="form-control form-control-sm w-px-75" value="1"
                                                            min="1" max="500" name="quantity" />
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="text-md-end">
                                                            <button type="button" class="btn-close btn-pinned"
                                                                aria-label="Close"></button>
                                                            <div class="my-2 my-md-4"><span
                                                                    class="text-primary"><?php echo $courseDetails['price'] ?>
                                                                    ৳/</span><s
                                                                    class="text-muted"><?php echo $courseDetails['full_price'] ?>
                                                                    ৳</s></div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>

                                </ul>


                            </div>

                            <!-- Cart right -->
                            <div class="col-xl-4">
                                <div class="border rounded p-3 mb-3">


                                    <h6>Price Details</h6>
                                    <dl class="row mb-0">
                                        <dt class="col-6 fw-normal">Bag Total</dt>
                                        <dd class="col-6 text-end">$1198.00</dd>

                                        <dt class="col-6 fw-normal">Coupon Discount</dt>
                                        <dd class="col-6 text-success text-end"> -$98.00</dd>

                                        <dt class="col-6 fw-normal">Order Total</dt>
                                        <dd class="col-6 text-end">$1100.00</dd>

                                        <dt class="col-6 fw-normal">Delivery Charges</dt>
                                        <dd class="col-6 text-end"><s>$5.00</s> <span
                                                class="badge bg-label-success">Free</span></dd>

                                    </dl>
                                    <hr class="mx-n3 mt-0">
                                    <dl class="row mb-0">
                                        <dt class="col-6">Total</dt>
                                        <dd class="col-6 fw-medium text-end mb-0">$1100.00</dd>
                                    </dl>
                                </div>
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label class="form-label w-100" for="paymentCard">Card
                                            Number</label>
                                        <div class="input-group input-group-merge">
                                            <input id="paymentCard" name="paymentCard"
                                                class="form-control credit-card-mask" type="text"
                                                placeholder="1356 3215 6548 7898" aria-describedby="paymentCard2" />
                                            <span class="input-group-text cursor-pointer p-1" id="paymentCard2"><span
                                                    class="card-type"></span></span>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="form-label" for="paymentCardName">Name</label>
                                        <input type="text" id="paymentCardName" class="form-control"
                                            placeholder="John Doe" />
                                    </div>
                                    <div class="col-6 col-md-3">
                                        <label class="form-label" for="paymentCardExpiryDate">Exp.
                                            Date</label>
                                        <input type="text" id="paymentCardExpiryDate"
                                            class="form-control expiry-date-mask" placeholder="MM/YY" />
                                    </div>
                                    <div class="col-6 col-md-3">
                                        <label class="form-label" for="paymentCardCvv">CVV Code</label>
                                        <div class="input-group input-group-merge">
                                            <input type="text" id="paymentCardCvv" class="form-control cvv-code-mask"
                                                maxlength="3" placeholder="654" />
                                            <span class="input-group-text cursor-pointer" id="paymentCardCvv2"><i
                                                    class="bx bx-help-circle text-muted" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="Card Verification Value"></i></span>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label class="switch">
                                            <input type="checkbox" class="switch-input">
                                            <span class="switch-toggle-slider">
                                                <span class="switch-on"></span>
                                                <span class="switch-off"></span>
                                            </span>
                                            <span class="switch-label">Save card for future billing?</span>
                                        </label>
                                    </div>
                                    <div class="col-12">
                                        <button type="button"
                                            class="btn btn-primary btn-next me-sm-3 me-1">Submit</button>
                                        <button type="reset" class="btn btn-label-secondary">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                    <!-- Payment -->
                    <div id="checkout-payment" class="content">
                        <div class="row">
                            <!-- Payment left -->
                            <div class="col-xl-9 mb-3 mb-xl-0">
                                <!-- Offer alert -->
                                <div class="alert alert-success" role="alert">
                                    <div class="d-flex gap-3">
                                        <div class="flex-shrink-0">
                                            <i class="bx bx-sm bx-purchase-tag"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="fw-medium">Bank Offers</div>
                                            <ul class="list-unstyled mb-0">
                                                <li> - 0% Instant Discount on Bank of America Corp Bank Debit and Credit
                                                    cards</li>
                                                <li> - 50% Cashback Voucher of up to $60 on first ever PayPal
                                                    transaction. TCA</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <button type="button" class="btn-close btn-pinned" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>

                                <!-- Payment Tabs -->
                                <div class="col-xxl-6 col-lg-8">
                                    <ul class="nav nav-pills mb-3" id="paymentTabs" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="pills-cc-tab" data-bs-toggle="pill"
                                                data-bs-target="#pills-cc" type="button" role="tab"
                                                aria-controls="pills-cc" aria-selected="true">Card</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="pills-cod-tab" data-bs-toggle="pill"
                                                data-bs-target="#pills-cod" type="button" role="tab"
                                                aria-controls="pills-cod" aria-selected="false">Cash On
                                                Delivery</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="pills-gift-card-tab" data-bs-toggle="pill"
                                                data-bs-target="#pills-gift-card" type="button" role="tab"
                                                aria-controls="pills-gift-card" aria-selected="false">Gift Card</button>
                                        </li>
                                    </ul>
                                    <div class="tab-content px-0" id="paymentTabsContent">
                                        <!-- Credit card -->
                                        <div class="tab-pane fade show active" id="pills-cc" role="tabpanel"
                                            aria-labelledby="pills-cc-tab">
                                            <div class="row g-3">
                                                <div class="col-12">
                                                    <label class="form-label w-100" for="paymentCard">Card
                                                        Number</label>
                                                    <div class="input-group input-group-merge">
                                                        <input id="paymentCard" name="paymentCard"
                                                            class="form-control credit-card-mask" type="text"
                                                            placeholder="1356 3215 6548 7898"
                                                            aria-describedby="paymentCard2" />
                                                        <span class="input-group-text cursor-pointer p-1"
                                                            id="paymentCard2"><span class="card-type"></span></span>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <label class="form-label" for="paymentCardName">Name</label>
                                                    <input type="text" id="paymentCardName" class="form-control"
                                                        placeholder="John Doe" />
                                                </div>
                                                <div class="col-6 col-md-3">
                                                    <label class="form-label" for="paymentCardExpiryDate">Exp.
                                                        Date</label>
                                                    <input type="text" id="paymentCardExpiryDate"
                                                        class="form-control expiry-date-mask" placeholder="MM/YY" />
                                                </div>
                                                <div class="col-6 col-md-3">
                                                    <label class="form-label" for="paymentCardCvv">CVV Code</label>
                                                    <div class="input-group input-group-merge">
                                                        <input type="text" id="paymentCardCvv"
                                                            class="form-control cvv-code-mask" maxlength="3"
                                                            placeholder="654" />
                                                        <span class="input-group-text cursor-pointer"
                                                            id="paymentCardCvv2"><i class="bx bx-help-circle text-muted"
                                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="Card Verification Value"></i></span>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <label class="switch">
                                                        <input type="checkbox" class="switch-input">
                                                        <span class="switch-toggle-slider">
                                                            <span class="switch-on"></span>
                                                            <span class="switch-off"></span>
                                                        </span>
                                                        <span class="switch-label">Save card for future billing?</span>
                                                    </label>
                                                </div>
                                                <div class="col-12">
                                                    <button type="button"
                                                        class="btn btn-primary btn-next me-sm-3 me-1">Submit</button>
                                                    <button type="reset" class="btn btn-label-secondary">Cancel</button>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- COD -->
                                        <div class="tab-pane fade" id="pills-cod" role="tabpanel"
                                            aria-labelledby="pills-cod-tab">
                                            <p>Cash on Delivery is a type of payment method where the recipient make
                                                payment for the order at the time of delivery rather than in advance.
                                            </p>
                                            <button type="button" class="btn btn-primary btn-next">Pay On
                                                Delivery</button>
                                        </div>

                                        <!-- Gift card -->
                                        <div class="tab-pane fade" id="pills-gift-card" role="tabpanel"
                                            aria-labelledby="pills-gift-card-tab">
                                            <h6>Enter Gift Card Details</h6>
                                            <div class="row g-3">
                                                <div class="col-12">
                                                    <label for="giftCardNumber" class="form-label">Gift card
                                                        number</label>
                                                    <input type="number" class="form-control" id="giftCardNumber"
                                                        placeholder="Gift card number">
                                                </div>
                                                <div class="col-12">
                                                    <label for="giftCardPin" class="form-label">Gift card pin</label>
                                                    <input type="number" class="form-control" id="giftCardPin"
                                                        placeholder="Gift card pin">
                                                </div>
                                                <div class="col-12">
                                                    <button type="button" class="btn btn-primary btn-next">Redeem Gift
                                                        Card</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- Address right -->
                            <div class="col-xl-3">
                                <div class="border rounded p-3">

                                    <!-- Price Details -->
                                    <h6>Price Details</h6>
                                    <dl class="row mb-0">

                                        <dt class="col-6 fw-normal">Order Total</dt>
                                        <dd class="col-6 text-end">$1100.00</dd>

                                        <dt class="col-6 fw-normal">Delivery Charges</dt>
                                        <dd class="col-6 text-end"><s>$5.00</s> <span
                                                class="badge bg-label-success">Free</span></dd>

                                    </dl>
                                    <hr class="mx-n3 mt-1">
                                    <dl class="row">
                                        <dt class="col-6">Total</dt>
                                        <dd class="col-6 fw-medium text-end mb-0">$1100.00</dd>

                                        <dt class="col-6">Deliver to:</dt>
                                        <dd class="col-6 fw-medium text-end mb-0"><span
                                                class="badge bg-label-primary">Home</span></dd>
                                    </dl>
                                    <!-- Address Details -->
                                    <address>
                                        <span class="fw-medium"> John Doe (Default),</span><br />
                                        4135 Parkway Street, <br />
                                        Los Angeles, CA, 90017. <br />
                                        Mobile : +1 906 568 2332
                                    </address>
                                    <a href="javascript:void(0)">Change address</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Confirmation -->
                    <div id="checkout-confirmation" class="content">
                        <div class="row mb-3">
                            <div class="col-12 col-lg-8 mx-auto text-center mb-3">
                                <h4 class="mt-2">Thank You! 😇</h4>
                                <p>Your order <a href="javascript:void(0)">#1536548131</a> has been placed!</p>
                                <p>We sent an email to <a href="mailto:john.doe@example.com">john.doe@example.com</a>
                                    with your order confirmation and receipt. If the email hasn't arrived within two
                                    minutes, please check your spam folder to see if the email was routed there.</p>
                                <p><span class="fw-medium"><i class="bx bx-time-five"></i> Time placed:</span>
                                    25/05/2020 13:35pm</p>
                            </div>
                            <!-- Confirmation details -->
                            <div class="col-12">
                                <ul class="list-group list-group-horizontal-md">
                                    <li class="list-group-item flex-fill">
                                        <h6><i class="bx bx-map"></i> Shipping</h6>
                                        <address>
                                            John Doe <br />
                                            4135 Parkway Street,<br />
                                            Los Angeles, CA 90017,<br />
                                            USA <br />
                                            +123456789
                                        </address>
                                    </li>
                                    <li class="list-group-item flex-fill">
                                        <h6><i class="bx bx-credit-card"></i> Billing Address</h6>
                                        <address>
                                            John Doe <br />
                                            4135 Parkway Street,<br />
                                            Los Angeles, CA 90017,<br />
                                            USA <br />
                                            +123456789
                                        </address>
                                    </li>
                                    <li class="list-group-item flex-fill">
                                        <h6><i class="bx bx-train"></i> Shipping Method</h6>
                                        <span class="fw-medium">Preferred Method:</span><br />
                                        Standard Delivery<br />
                                        (Normally 3-4 business days)
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Confirmation items -->
                            <div class="col-xl-9 mb-3 mb-xl-0">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <div class="d-flex gap-3">
                                            <div class="flex-shrink-0">
                                                <img src="../../assets/img/products/1.png" alt="google home"
                                                    class="w-px-75">
                                            </div>
                                            <div class="flex-grow-1">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <a href="javascript:void(0)" class="text-body">
                                                            <h6>Google - Google Home - White</h6>
                                                        </a>
                                                        <div class="text-muted mb-1 d-flex flex-wrap"><span
                                                                class="me-1">Sold by:</span> <a
                                                                href="javascript:void(0)" class="me-1">Apple</a> <span
                                                                class="badge bg-label-success">In Stock</span></div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="text-md-end">
                                                            <div class="my-2 my-lg-4"><span
                                                                    class="text-primary">$299/</span><s
                                                                    class="text-muted">$359</s></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="d-flex gap-3">
                                            <div class="flex-shrink-0">
                                                <img src="../../assets/img/products/2.png" alt="google home"
                                                    class="w-px-75">
                                            </div>
                                            <div class="flex-grow-1">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <a href="javascript:void(0)" class="text-body">
                                                            <h6>Apple iPhone 11 (64GB, Black)</h6>
                                                        </a>
                                                        <div class="text-muted mb-1 d-flex flex-wrap"><span
                                                                class="me-1">Sold by:</span> <a
                                                                href="javascript:void(0)" class="me-1">Apple</a> <span
                                                                class="badge bg-label-success">In Stock</span></div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="text-md-end">
                                                            <div class="my-2 my-lg-4"><span
                                                                    class="text-primary">$299/</span><s
                                                                    class="text-muted">$359</s></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <!-- Confirmation total -->
                            <div class="col-xl-3">
                                <div class="border rounded p-3">
                                    <!-- Price Details -->
                                    <h6>Price Details</h6>
                                    <dl class="row mb-0">

                                        <dt class="col-6 fw-normal">Order Total</dt>
                                        <dd class="col-6 text-end">$1100.00</dd>

                                        <dt class="col-6 fw-normal">Delivery Charges</dt>
                                        <dd class="col-6 text-end"><s>$5.00</s> <span
                                                class="badge bg-label-success">Free</span></dd>

                                    </dl>
                                    <hr class="mx-n3 mt-1">
                                    <dl class="row mb-0">
                                        <dt class="col-6">Total</dt>
                                        <dd class="col-6 fw-medium text-end mb-0">$1100.00</dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!--/ Checkout Wizard -->


        <!-- Add new address modal -->
        <!-- Add New Address Modal -->
        <div class="modal fade" id="addNewAddress" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-simple modal-add-new-address">
                <div class="modal-content p-3 p-md-5">
                    <div class="modal-body">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="text-center mb-4">
                            <h3 class="address-title">Add New Address</h3>
                            <p class="address-subtitle">Add new address for express delivery</p>
                        </div>
                        <form id="addNewAddressForm" class="row g-3" onsubmit="return false">

                            <div class="col-12">
                                <div class="row">
                                    <div class="col-md mb-md-2 mb-3">
                                        <div class="form-check custom-option custom-option-icon">
                                            <label class="form-check-label custom-option-content" for="customRadioHome">
                                                <span class="custom-option-body">
                                                    <i class="bx bx-home"></i>
                                                    <span class="custom-option-title my-2">Home</span>
                                                    <span> Delivery time (9am – 9pm) </span>
                                                </span>
                                                <input name="customRadioIcon" class="form-check-input" type="radio"
                                                    value="" id="customRadioHome" checked />
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md mb-md-2 mb-3">
                                        <div class="form-check custom-option custom-option-icon">
                                            <label class="form-check-label custom-option-content"
                                                for="customRadioOffice">
                                                <span class="custom-option-body">
                                                    <i class='bx bx-briefcase'></i>
                                                    <span class="custom-option-title my-2"> Office </span>
                                                    <span> Delivery time (9am – 5pm) </span>
                                                </span>
                                                <input name="customRadioIcon" class="form-check-input" type="radio"
                                                    value="" id="customRadioOffice" />
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label" for="modalAddressFirstName">First Name</label>
                                <input type="text" id="modalAddressFirstName" name="modalAddressFirstName"
                                    class="form-control" placeholder="John" />
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label" for="modalAddressLastName">Last Name</label>
                                <input type="text" id="modalAddressLastName" name="modalAddressLastName"
                                    class="form-control" placeholder="Doe" />
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="modalAddressCountry">Country</label>
                                <select id="modalAddressCountry" name="modalAddressCountry" class="select2 form-select"
                                    data-allow-clear="true">
                                    <option value="">Select</option>
                                    <option value="Australia">Australia</option>
                                    <option value="Bangladesh">Bangladesh</option>
                                    <option value="Belarus">Belarus</option>
                                    <option value="Brazil">Brazil</option>
                                    <option value="Canada">Canada</option>
                                    <option value="China">China</option>
                                    <option value="France">France</option>
                                    <option value="Germany">Germany</option>
                                    <option value="India">India</option>
                                    <option value="Indonesia">Indonesia</option>
                                    <option value="Israel">Israel</option>
                                    <option value="Italy">Italy</option>
                                    <option value="Japan">Japan</option>
                                    <option value="Korea">Korea, Republic of</option>
                                    <option value="Mexico">Mexico</option>
                                    <option value="Philippines">Philippines</option>
                                    <option value="Russia">Russian Federation</option>
                                    <option value="South Africa">South Africa</option>
                                    <option value="Thailand">Thailand</option>
                                    <option value="Turkey">Turkey</option>
                                    <option value="Ukraine">Ukraine</option>
                                    <option value="United Arab Emirates">United Arab Emirates</option>
                                    <option value="United Kingdom">United Kingdom</option>
                                    <option value="United States">United States</option>
                                </select>
                            </div>
                            <div class="col-12 ">
                                <label class="form-label" for="modalAddressAddress1">Address Line 1</label>
                                <input type="text" id="modalAddressAddress1" name="modalAddressAddress1"
                                    class="form-control" placeholder="12, Business Park" />
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="modalAddressAddress2">Address Line 2</label>
                                <input type="text" id="modalAddressAddress2" name="modalAddressAddress2"
                                    class="form-control" placeholder="Mall Road" />
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label" for="modalAddressLandmark">Landmark</label>
                                <input type="text" id="modalAddressLandmark" name="modalAddressLandmark"
                                    class="form-control" placeholder="Nr. Hard Rock Cafe" />
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label" for="modalAddressCity">City</label>
                                <input type="text" id="modalAddressCity" name="modalAddressCity" class="form-control"
                                    placeholder="Los Angeles" />
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label" for="modalAddressLandmark">State</label>
                                <input type="text" id="modalAddressState" name="modalAddressState" class="form-control"
                                    placeholder="California" />
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label" for="modalAddressZipCode">Zip Code</label>
                                <input type="text" id="modalAddressZipCode" name="modalAddressZipCode"
                                    class="form-control" placeholder="99950" />
                            </div>
                            <div class="col-12">
                                <label class="switch">
                                    <input type="checkbox" class="switch-input" checked>
                                    <span class="switch-toggle-slider">
                                        <span class="switch-on">
                                            <i class="bx bx-check"></i>
                                        </span>
                                        <span class="switch-off">
                                            <i class="bx bx-x"></i>
                                        </span>
                                    </span>
                                    <span class="switch-label">Use as a billing address?</span>
                                </label>
                            </div>
                            <div class="col-12 text-center mt-4">
                                <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                                <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal"
                                    aria-label="Close">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Add New Address Modal -->


    </div>
    <!-- / Content -->




    <!-- / Footer -->


    <div class="content-backdrop fade"></div>
</div>
<?php include('footer.php') ?>