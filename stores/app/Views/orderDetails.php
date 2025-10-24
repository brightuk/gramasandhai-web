<?php include(APPPATH . 'Views/templates/config.php'); ?>
<?= $this->extend('templates/page') ?>
<?= $this->section('index') ?>


<style>
/* Responsive spacing */
.empty-spacer {
    height: 60px;
}

@media screen and (min-width: 768px) {
    .empty-spacer {
        height: 100px;
    }
}

/* Address card styling */
.address-card {
    cursor: pointer;
    transition: all 0.3s ease;
    margin-bottom: 15px;
    border: 1px solid #dee2e6;
    border-radius: 8px;
}

.address-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.selected-address {
    border-left: 4px solid #28a745;
    background-color: #f8f9fa;
}

/* Product item styling */
.product-item {
    border: 1px solid #dee2e6;
    border-radius: 8px;
    padding: 15px;
    margin-bottom: 15px;
    display: flex;
    flex-direction: column;
}

@media screen and (min-width: 576px) {
    .product-item {
        flex-direction: row;
        align-items: center;
    }

    .empty-spacer {
        height: 10px;
    }

    .product-image {
        margin-right: 15px;
        margin-bottom: 0;
    }

    .action-buttons {
        flex-direction: row;
        justify-content: space-between;
    }

    .empty-div {
        height: 50px;
    }
}

.product-image {
    width: 80px;
    height: 80px;
    object-fit: contain;
    border-radius: 8px;
    margin-right: 0;
    margin-bottom: 10px;
}

/* Login alert styling */
.login-alert {
    margin-top: 20px;
}

/* Button adjustments for mobile */
.action-buttons {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

/* Address container adjustments */
#addresses-container {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

@media screen and (min-width: 768px) {
    #addresses-container {
        flex-direction: row;
        flex-wrap: wrap;
    }

    .address-col {
        flex: 0 0 calc(50% - 8px);
    }
}

/* Form input sizing */
.form-control,
.form-select {
    padding: 10px 15px;
}

/* Card adjustments */
.card {
    border-radius: 10px;
    overflow: hidden;
}

.card-header {
    padding: 15px 20px;
    cursor: pointer;
}

.card-body {
    padding: 20px;
}

/* Dropdown transition */
#addressCardBody,
#paymentCardBody {
    transition: all 0.3s ease;
    overflow: hidden;
}

.toggle-icon {
    transition: transform 0.3s ease;
}

/* Payment method styling */
.payment-option {
    padding: 10px 15px;
    border-radius: 5px;
    margin-bottom: 10px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.payment-option:hover {
    background-color: #f8f9fa;
}

.payment-option.selected {
    background-color: #e9f7ef;
    border-left: 4px solid #28a745;
}

.payment-option input[type="radio"] {
    margin-right: 10px;
}

/* QR code section */
#qrCodeSection {
    display: none;
    margin-top: 20px;
    text-align: center;
}

#qrCodeImage {
    max-width: 200px;
    margin: 0 auto 15px;
}

/* Transaction ID input */
#transactionIdGroup {
    margin-top: 15px;
}

/* No address alert */
#noAddressAlert {
    display: none;
}
</style>

<style>
.fee-container {
    background: white;
    border-radius: 12px;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    max-width: 800px;
    margin: 2rem auto;
}

.fee-header {
    background: linear-gradient(135deg, #6c5ce7, #8e44ad);
    color: white;
    padding: 20px;
}

.fee-content {
    padding: 25px;
}

.fee-item {
    padding: 16px;
    border-bottom: 1px solid #f1f1f1;
    display: flex;
    justify-content: space-between;
    align-items: center;
    transition: background-color 0.2s;
}

.fee-item:last-child {
    border-bottom: none;
}

.fee-item:hover {
    background-color: #f9faff;
}

.fee-label {
    font-weight: 500;
    color: #2d3436;
    display: flex;
    align-items: center;
}

.fee-value {
    font-weight: 600;
    color: #6c5ce7;
}

.discount-badge {
    background-color: #00b894;
    color: white;
    padding: 3px 10px;
    border-radius: 15px;
    font-size: 0.75rem;
    margin-left: 10px;
}

.fee-icon {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: #f1f3ff;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 12px;
    color: #6c5ce7;
}

.fee-total {
    background-color: #e8f4fc;
    border-top: 2px dashed #74b9ff;
    font-weight: 700;
    font-size: 1.1rem;
    color: #2d3436;
    margin-top: 15px;
    border-radius: 8px;
}

.text-danger {
    color: #e84118 !important;
}

.currency-symbol {
    font-size: 0.9em;
    margin-right: 2px;
}

.fee-table-header {
    display: grid;
    grid-template-columns: 2fr 1fr 1fr;
    padding: 12px 20px;
    background-color: #f8f9fa;
    border-radius: 8px;
    margin-bottom: 10px;
    font-weight: 600;
    color: #495057;
}

@media (max-width: 576px) {
    .fee-item {
        flex-direction: column;
        align-items: flex-start;
    }

    .fee-value {
        margin-top: 8px;
        margin-left: 48px;
    }

    .fee-table-header {
        display: none;
    }
}

/* Time Slot Option Styling */
.time-slot-option {
    padding: 15px;
    border: 2px solid #e0e0e0;
    border-radius: 8px;
    margin-bottom: 12px;
    cursor: pointer;
    transition: all 0.3s ease;
    background-color: #fff;
}

.time-slot-option:hover {
    border-color: #6c5ce7;
    background-color: #f9f9ff;
    transform: translateX(5px);
}

.time-slot-option.selected {
    background-color: #e8f4fc;
    border-color: #6c5ce7;
    border-width: 2px;
    box-shadow: 0 2px 8px rgba(108, 92, 231, 0.2);
}

.time-slot-option input[type="radio"] {
    display: none;
}

.time-slot-option label {
    cursor: pointer;
    margin: 0;
    user-select: none;
}

.time-slot-option .check-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: #f1f3ff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    color: #6c5ce7;
    transition: all 0.3s ease;
}

.time-slot-option.selected .check-icon {
    background: #6c5ce7;
    color: white;
}

.time-slot-option .fw-bold {
    color: #2d3436;
    font-size: 1rem;
}

.time-slot-option .text-muted {
    color: #636e72 !important;
    font-size: 0.875rem;
}

@media (max-width: 576px) {
    .time-slot-option {
        padding: 12px;
    }
    
    .time-slot-option .check-icon {
        width: 35px;
        height: 35px;
        font-size: 1rem;
    }
}
</style>

<div class="empty-spacer"></div>

<div class="container my-4 my-md-5" style="max-width: 700px;">
    <!-- Login Alert (shown when user is not logged in) -->
    <div id="loginAlert" class="alert alert-danger login-alert" style="display: none;">
        <h4 class="h5"><i class="bi bi-exclamation-triangle"></i> Please Login First</h4>
        <p>You need to be logged in to place an order. Please login or create an account.</p>
        <a href="#" data-bs-toggle="modal" data-bs-target="#accountModal" class="btn btn-danger btn-sm">Go to Login
            Page</a>
    </div>

    <!-- Order Content (hidden when not logged in) -->
    <div id="orderContent">
        <h2 class="h4 mb-3 mb-md-4">Order Summary</h2>

        <!-- Shipping Address Section with Dropdown -->
        <div class="card mb-3 mb-md-4">
            <div class="card-header bg-primary text-white" onclick="toggleAddressSection()">
                <h5 class="h6 mb-0 d-flex justify-content-between align-items-center overflow-y-hidden">
                    Shipping Address
                    <i class="bi bi-chevron-down toggle-icon" id="addressToggleIcon"></i>
                </h5>
            </div>
            <div class="card-body" id="">
                <div id="addresses-container" class="row"></div>
                <div id="selected-address" class="mt-3"></div>
                <div id="noAddressAlert" class="alert alert-warning" style="display: none;">
                    <i class="bi bi-exclamation-triangle"></i> No address found. Please add a shipping address to
                    continue.
                </div>
                <div class="text-center mt-3" id="addAddressButton">
                    <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal"
                        data-bs-target="#addressModal">
                        <i class="bi bi-plus-circle"></i> Add New Address
                    </button>
                </div>
            </div>
        </div>



        <!-- Order Summary Section -->
        <div class="card mb-3 mb-md-4">
            <div class="card-header bg-primary text-white">
                <h5 class="h6 mb-0">Order Items</h5>
            </div>
            <div class="card-body p-0 p-md-2">
                <!-- Added padding adjustments -->
                <div id="order-summary" class="table-responsive">
                    <!-- Wrapped in responsive container -->
                    <!-- Content will be inserted here by JavaScript -->
                </div>
                <div class="fee-container">
                    <div class="fee-header">
                        <h5 class="m-0"><i class="fas fa-receipt me-2"></i>Fee Breakdown</h5>
                        <p class="m-0 mt-2 opacity-75">Detailed overview of all applicable fees</p>
                    </div>

                    <div class="fee-content">
                        <!-- Table Header (Desktop) -->
                        <!-- <div class="fee-table-header d-none d-md-grid">
                            <div>Fee Name</div>
                            <div class="ms-5 text-end">Amount</div>
                            <div>Percentage</div>
                        </div> -->

                        <!-- Fee Items -->
                        <?php
                        // Check if $fees is set and is an array
                        if (isset($fees) && is_array($fees)):
                            ?>

                        <?php if (!empty($fees[0]['code']) && $fees[0]['code'] == 'DLFE' && $fees[0]['status'] == '1'):
                                $prv = $fees[0]['amount'];
                                ?>
                        <div class="fee-item">
                            <div class="fee-label">
                                <div class="fee-icon">
                                    <i class="fas fa-truck"></i>
                                </div>
                                <span>Delivery Fee </span>
                            </div>
                            <div class="fee-value">
                                <span class="currency-symbol" id="delivery_fee" data-set1="<?= $fees[2]['op_select'] ?>"
                                    data-set="<?= $prv ?>">₹0.00</span>
                            </div>
                        </div>
                        <?php endif; ?>

                        <?php if (!empty($fees[1]['code']) && $fees[1]['code'] === 'PLFE' && $fees[1]['status'] == '1'):
                                $platfValue = $fees[1]['op_select'] == '1' ? $fees[1]['amount'] : $fees[1]['percentage'];
                                ?>
                        <div class="fee-item">
                            <div class="fee-label">
                                <div class="fee-icon">
                                    <i class="fas fa-laptop"></i>
                                </div>
                                <span>Platform Fee </span>
                            </div>
                            <div class="fee-value">
                                <span class="currency-symbol" id="platform_fee" data-set1="<?= $fees[2]['op_select'] ?>"
                                    data-set="<?= $platfValue ?>">₹0.00</span>
                            </div>
                        </div>
                        <?php endif; ?>

                        <?php if (!empty($fees[2]['code']) && $fees[2]['code'] === 'OTCH' && $fees[2]['status'] == '1'):
                                $discountValue = $fees[2]['op_select'] == '1' ? $fees[2]['amount'] : $fees[2]['percentage'];
                                ?>
                        <div class="fee-item">
                            <div class="fee-label">
                                <div class="fee-icon">
                                    <i class="fas fa-tag"></i>
                                </div>
                                <span>Discount</span>
                                <span class="discount-badge ms-2">SAVING</span>
                            </div>
                            <div class="fee-value text-danger">
                                <span class="currency-symbol" id="discount_fee" data-set1="<?= $fees[2]['op_select'] ?>"
                                    data-set="<?= $discountValue ?>">₹0.00</span>
                            </div>
                        </div>
                        <?php endif; ?>

                        <?php if (!empty($fees[3]['code']) && $fees[3]['code'] === 'GSTCH' && $fees[3]['status'] == '1'):
                                $gstch = $fees[3]['percentage'];
                                ?>
                        <div class="fee-item">
                            <div class="fee-label">
                                <div class="fee-icon">
                                    <i class="fas fa-receipt"></i>
                                </div>
                                <span>GST Charge </span>
                            </div>
                            <div class="fee-value">
                                <span class="currency-symbol" id="gst_fee" data-set1="<?= $fees[2]['op_select'] ?>"
                                    data-set="<?= $gstch ?>">₹0.00</span>
                            </div>
                        </div>
                        <?php endif; ?>

                        <!-- Total -->
                        <div class="fee-item fee-total">
                            <div class="fee-label">
                                <div class="fee-icon">
                                    <i class="fas fa-file-invoice-dollar"></i>
                                </div>
                                <span>Total </span>
                            </div>
                            <div class="fee-value">
                                <span class="currency-symbol">₹</span>0.00
                            </div>
                        </div>

                        <?php
                        endif;
                        ?>


                    </div>
                </div>


                <div
                    class="d-flex justify-content-between align-items-center mt-3 py-2 mt-md-4 border-top pt-3 px-2 px-md-3">
                    <!-- Added horizontal padding -->

                    <h4 class="h5 mb-0">Total:</h4>
                    <h4 id="order-total" class="h5 mb-0 text-success">₹0.00</h4>
                </div>
            </div>
        </div>



        <div class="card mb-3 mb-md-4">
            <div class="card-header bg-primary text-white" onclick="toggleDeliverySlots()">
                <h5 class="h6 mb-0 d-flex justify-content-between align-items-center">
                    <span><i class="bi bi-clock-history me-2"></i>Delivery Time Slots</span>
                    <i class="bi bi-chevron-down toggle-icon" id="deliveryToggleIcon"></i>
                </h5>
            </div>
            <div class="card-body" id="deliverySlots" style="display: none;">
                <p class="text-muted small mb-3"><i class="bi bi-info-circle me-1"></i>Select your preferred delivery
                    time slot</p>

                <div class="time-slot-option" onclick="selectTimeSlot('slot1')">
                    <input type="radio" name="deliverySlot" id="slot1" value="8:00-12:00">
                    <label for="slot1" class="d-flex align-items-center w-100">

                        <div class="flex-grow-1">
                            <div class="fw-bold">Morning Slot</div>
                            <div class="text-muted small">8:00 AM - 12:00 PM</div>
                        </div>
                        <div class="check-icon">
                            <i class="bi bi-sunrise"></i>

                        </div>
                    </label>
                </div>

                <div class="time-slot-option" onclick="selectTimeSlot('slot2')">
                    <input type="radio" name="deliverySlot" id="slot2" value="13:00-16:00">
                    <label for="slot2" class="d-flex align-items-center w-100">

                        <div class="flex-grow-1">
                            <div class="fw-bold">Afternoon Slot</div>
                            <div class="text-muted small">1:00 PM - 4:00 PM</div>
                        </div>
                        <div class="check-icon">
                            <i class="bi bi-sun"></i>

                        </div>
                    </label>
                </div>

                <div class="time-slot-option" onclick="selectTimeSlot('slot3')">
                    <input type="radio" name="deliverySlot" id="slot3" value="16-22">
                    <label for="slot3" class="d-flex align-items-center w-100">

                        <div class="flex-grow-1">
                            <div class="fw-bold">Evening Slot</div>
                            <div class="text-muted small">4:00 PM - 10:00 PM</div>
                        </div>
                        <div class="check-icon">
                            <i class="bi bi-moon-stars"></i>
                        </div>
                    </label>
                </div>
            </div>
        </div>
        <!-- Payment Method Section with Dropdown 
         -->
        <div class="card mb-3 mb-md-4">
            <div class="card-header bg-primary text-white" onclick="togglePaymentSection()">
                <h5 class="h6 mb-0 d-flex justify-content-between align-items-center overflow-y-hidden">
                    Payment Method
                    <i class="bi bi-chevron-down toggle-icon" id="paymentToggleIcon"></i>
                </h5>
            </div>
            <div class="card-body" id="paymentCardBody" style="display: none;">
                <div class="payment-option" onclick="selectPaymentMethod('cod')">
                    <input type="radio" name="paymentMethod" id="codRadio" value="cod">
                    <label for="codRadio" class="fw-bold">Cash on Delivery (COD)</label>
                    <p class="mb-0 small text-muted">Pay in cash when your order is delivered</p>
                </div>
                <div class="payment-option" onclick="selectPaymentMethod('spu')">
                    <input type="radio" name="paymentMethod" id="storePickup" value="spu">
                    <label for="storePickup" class="fw-bold">Store Pickup</label>
                    <p class="mb-0 small text-muted">Pay in cash when your order is Store</p>
                </div>

                <div class="payment-option d-none" onclick="selectPaymentMethod('online')">
                    <input type="radio" name="paymentMethod" id="onlineRadio" value="online">
                    <label for="onlineRadio" class="fw-bold">Online Payment</label>
                    <p class="mb-0 small text-muted">Pay securely online via UPI, Card, or Net Banking</p>
                </div>

                <!-- QR Code Section (shown when online payment selected) -->
                <div id="qrCodeSection">
                    <h6 class="h6 mb-3 overflow-y-hidden">Scan QR Code to Pay</h6>

                    <?php if (isset($paymentInfo)): ?>
                    <img src="<?= $image_url . $paymentInfo['pay_qrcode'] ?>" alt="QR Code" id="qrCodeImage">
                    <?php endif; ?>

                    <p class="small text-muted mb-2">Scan the QR code using any UPI app to make payment</p>
                    <p class="small text-muted">UPI ID: example@upi</p>

                    <div id="transactionIdGroup" class="mt-3">
                        <label for="transactionId" class="form-label">Transaction ID/Reference Number*</label>
                        <input type="text" class="form-control" id="transactionId"
                            placeholder="Enter transaction ID from your payment">
                        <div class="invalid-feedback">Please enter a valid transaction ID</div>
                    </div>
                </div>
            </div>
        </div>


        <script>
        function toggleDeliverySlots() {
            const slotDiv = document.getElementById('deliverySlots');
            const icon = document.getElementById('deliveryToggleIcon');

            if (slotDiv.style.display === "none") {
                slotDiv.style.display = "block";
                icon.classList.remove('bi-chevron-down');
                icon.classList.add('bi-chevron-up');
            } else {
                slotDiv.style.display = "none";
                icon.classList.remove('bi-chevron-up');
                icon.classList.add('bi-chevron-down');
            }
        }
        </script>

        <!-- Action Buttons -->
        <div class="action-buttons mt-3 mb-5 mt-md-4 d-flex justify-content-end">
            <button type="button" class="btn btn-primary" id="submitOrderBtn" disabled>
                <i class="bi bi-check-circle"></i> Place Order
            </button>
        </div>

        <div class="empty-spacer"></div>

        <!-- Hidden form for submission -->
        <form id="orderForm" method="POST" style="display: none;">
            <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
            <input type="hidden" name="order_data" id="orderData">
            <input type="hidden" name="address_data" id="addressData">
            <input type="hidden" name="total_amount" id="totalAmount">
            <input type="hidden" name="payment_method" id="paymentMethod">
            <input type="hidden" name="gstfeeAmount" id="gstfeeAmount">
            <input type="hidden" name="platformfeeAmount" id="platformfeeAmount">
            <input type="hidden" name="discountAmount" id="discountAmount">
            <input type="hidden" name="deliveryFeeAmount" id="deliveryFeeAmount">
            <input type="hidden" name="transaction_id" id="transactionIdField">
            <input type="hidden" name="delivery_slot" id="deliverySlotField">
        </form>
    </div>
</div>


<script>
// Order Summary Rendering
function renderOrderSummary() {
    if (!checkLogin()) return;

    const cart = getCart();
    const orderSummaryDiv = document.getElementById('order-summary');
    orderSummaryDiv.innerHTML = '';

    if (cart.length === 0) {
        orderSummaryDiv.innerHTML = '<div class="alert alert-info py-2 small m-2">Your cart is empty.</div>';
        document.getElementById('order-total').textContent = '₹0.00';
        updateOrderButtonState();
        return;
    }

    let total = 0;

    // Mobile-first approach - stack items on small screens
    if (window.innerWidth < 768) {
        let mobileHtml = `<div class="list-group list-group-flush">`;

        cart.forEach(item => {
            try {
                const price = typeof item.price === 'string' ? parseFloat(item.price) : item.price;
                const quantity = parseInt(item.quantity);
                const subtotal = price * quantity;
                total += subtotal;

                mobileHtml += `
            <div class="list-group-item">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="mb-1 text-capitalize">${item.name}</h6>
                        <small class="text-muted">${item.measure} • ${quantity} × ₹${price.toFixed(2)}</small>
                    </div>
                    <div class="text-end">
                        <strong>₹${subtotal.toFixed(2)}</strong>
                    </div>
                </div>
            </div>
            `;
            } catch (e) {
                console.error("Error rendering cart item:", item, e);
            }
        });

        mobileHtml += `</div>`;
        orderSummaryDiv.innerHTML = mobileHtml;
    }
    // Desktop view - table layout
    else {
        let tableHtml = `
        <table class="table table-sm mb-0">
            <thead class="table-light">
                <tr>
                    <th>Product</th>
                    <th>Measure</th>
                    <th>Qty</th>
                    <th class="text-end">Price</th>
                    <th class="text-end">Subtotal</th>
                </tr>
            </thead>
            <tbody>
        `;

        cart.forEach(item => {
            try {
                const price = typeof item.price === 'string' ? parseFloat(item.price) : item.price;
                const quantity = parseInt(item.quantity);
                const subtotal = price * quantity;
                total += subtotal;

                tableHtml += `
            <tr>
                <td class="text-capitalize">${item.name}</td>
                <td>${item.measure}</td>
                <td>${quantity}</td>
                <td class="text-end">₹${price.toFixed(2)}</td>
                <td class="text-end fw-bold">₹${subtotal.toFixed(2)}</td>
            </tr>
            `;
            } catch (e) {
                console.error("Error rendering cart item:", item, e);
            }
        });

        tableHtml += `
        </tbody>
    </table>
    `;
        orderSummaryDiv.innerHTML = tableHtml;
    }

    const baseAmount = total;

    // Initialize fee variables with default values
    let deliveryFeeAmount = 0;
    let platformFeeAmount = 0;
    let discountAmount = 0;
    let gstAmount = 0;

    // Delivery Fee - Check if element exists and status is active
    const deliveryFeeElem = document.getElementById('delivery_fee');
    if (deliveryFeeElem) {
        const delSetValue = Number(deliveryFeeElem.getAttribute('data-set')) || 0;
        const pf_del = Number(deliveryFeeElem.getAttribute('data-set1')) || 0;
        deliveryFeeAmount = pf_del === 1 ? delSetValue : (baseAmount * delSetValue / 100);
    }

    // Platform Fee - Check if element exists and status is active
    const platformFeeElem = document.getElementById('platform_fee');
    if (platformFeeElem) {
        const platfSetValue = Number(platformFeeElem.getAttribute('data-set')) || 0;
        const pf_pform = Number(platformFeeElem.getAttribute('data-set1')) || 0;
        platformFeeAmount = pf_pform === 1 ? platfSetValue : (baseAmount * platfSetValue / 100);
    }

    // Discount Fee - Check if element exists and status is active
    const discountFeeElem = document.getElementById('discount_fee');
    if (discountFeeElem) {
        const discSetValue = Number(discountFeeElem.getAttribute('data-set')) || 0;
        const pf_dis = Number(discountFeeElem.getAttribute('data-set1')) || 0;
        discountAmount = pf_dis === 1 ? discSetValue : (baseAmount * discSetValue / 100);
    }

    // GST Fee - Check if element exists and status is active
    const gstFeeElem = document.getElementById('gst_fee');
    if (gstFeeElem) {
        const gstSetValue = Number(gstFeeElem.getAttribute('data-set')) || 0;
        const pf_gst = Number(gstFeeElem.getAttribute('data-set1')) || 0;
        gstAmount = pf_gst === 1 ? gstSetValue : (baseAmount * gstSetValue / 100);
    }

    // Calculate total fees
    let totalFees = deliveryFeeAmount + platformFeeAmount + gstAmount - discountAmount;

    // Store fees in localStorage
    localStorage.setItem('fees', totalFees);
    localStorage.setItem('deliveryfee', deliveryFeeAmount);
    localStorage.setItem('platformfee', platformFeeAmount);
    localStorage.setItem('gstfee', gstAmount);
    localStorage.setItem('discount', discountAmount);

    let grandTotal = totalFees + total;

    // Update UI with calculated values - only if elements exist
    if (deliveryFeeElem) {
        deliveryFeeElem.textContent = `₹${deliveryFeeAmount.toFixed(2)}`;
    }

    if (platformFeeElem) {
        platformFeeElem.textContent = `₹${platformFeeAmount.toFixed(2)}`;
    }

    if (discountFeeElem) {
        discountFeeElem.textContent = `-₹${discountAmount.toFixed(2)}`;
    }

    if (gstFeeElem) {
        gstFeeElem.textContent = `₹${gstAmount.toFixed(2)}`;
    }

    // Update subtotal in fee summary (cart total before fees)
    const totalFeeElem = document.querySelector('.fee-total .fee-value');
    if (totalFeeElem) {
        totalFeeElem.innerHTML = `<span class="currency-symbol">₹</span>${grandTotal.toFixed(2)}`;
    }

    // Update final order total
    const orderTotalElem = document.getElementById('order-total');
    if (orderTotalElem) {
        orderTotalElem.textContent = `₹${grandTotal.toFixed(2)}`;
    }

    updateOrderButtonState();
}
</script>




<!-- Address Modal -->
<div class="modal fade" id="addressModal" tabindex="-1" aria-labelledby="addressModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form id="addressForm" class="modal-content" method="POST">
            <input type="hidden" id="addressId" />
            <div class="modal-header">
                <h5 class="modal-title h6" id="addressModalLabel">Enter Delivery Address</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="fullName" class="form-label">Full Name*</label>
                    <input type="text" class="form-control" id="fullName" required>
                    <input type="hidden" class="form-control" id="customerId" value="0">
                </div>
                <div class="mb-3">
                    <label for="street" class="form-label">Street Address*</label>
                    <input type="text" class="form-control" id="street" required>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone No*</label>
                    <input type="tel" class="form-control" id="phone" required pattern="[0-9]{10}">
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="city" class="form-label">City*</label>
                        <input type="text" class="form-control" id="city" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="state" class="form-label">State*</label>
                        <input type="text" class="form-control" id="state" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="zip" class="form-label">Zip Code*</label>
                        <input type="text" class="form-control" id="zip" required pattern="\d{6}" maxlength="6">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="country" class="form-label">Country*</label>
                        <input type="text" class="form-control" id="country" disabled value="India">
                    </div>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="defaultAddress">
                    <label class="form-check-label" for="defaultAddress">Set as default address</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btn-sm">Save Address</button>
            </div>
        </form>
    </div>
</div>


<script>
    // Order Summary Rendering
function renderOrderSummary() {
    if (!checkLogin()) return;

    const cart = getCart();
    const orderSummaryDiv = document.getElementById('order-summary');
    orderSummaryDiv.innerHTML = '';

    if (cart.length === 0) {
        orderSummaryDiv.innerHTML = '<div class="alert alert-info py-2 small m-2">Your cart is empty.</div>';
        document.getElementById('order-total').textContent = '₹0.00';
        updateOrderButtonState();
        return;
    }

    let total = 0;

    // Mobile-first approach - stack items on small screens
    if (window.innerWidth < 768) {
        let mobileHtml = `<div class="list-group list-group-flush">`;

        cart.forEach(item => {
            try {
                const price = typeof item.price === 'string' ? parseFloat(item.price) : item.price;
                const quantity = parseInt(item.quantity);
                const subtotal = price * quantity;
                total += subtotal;

                mobileHtml += `
            <div class="list-group-item">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="mb-1 text-capitalize">${item.name}</h6>
                        <small class="text-muted">${item.measure} • ${quantity} × ₹${price.toFixed(2)}</small>
                    </div>
                    <div class="text-end">
                        <strong>₹${subtotal.toFixed(2)}</strong>
                    </div>
                </div>
            </div>
            `;
            } catch (e) {
                console.error("Error rendering cart item:", item, e);
            }
        });

        mobileHtml += `</div>`;
        orderSummaryDiv.innerHTML = mobileHtml;
    }
    // Desktop view - table layout
    else {
        let tableHtml = `
        <table class="table table-sm mb-0">
            <thead class="table-light">
                <tr>
                    <th>Product</th>
                    <th>Measure</th>
                    <th>Qty</th>
                    <th class="text-end">Price</th>
                    <th class="text-end">Subtotal</th>
                </tr>
            </thead>
            <tbody>
        `;

        cart.forEach(item => {
            try {
                const price = typeof item.price === 'string' ? parseFloat(item.price) : item.price;
                const quantity = parseInt(item.quantity);
                const subtotal = price * quantity;
                total += subtotal;

                tableHtml += `
            <tr>
                <td class="text-capitalize">${item.name}</td>
                <td>${item.measure}</td>
                <td>${quantity}</td>
                <td class="text-end">₹${price.toFixed(2)}</td>
                <td class="text-end fw-bold">₹${subtotal.toFixed(2)}</td>
            </tr>
            `;
            } catch (e) {
                console.error("Error rendering cart item:", item, e);
            }
        });

        tableHtml += `
        </tbody>
    </table>
    `;
        orderSummaryDiv.innerHTML = tableHtml;
    }

    const baseAmount = total;

    // Initialize fee variables with default values
    let deliveryFeeAmount = 0;
    let platformFeeAmount = 0;
    let discountAmount = 0;
    let gstAmount = 0;

    // Delivery Fee - Check if element exists and status is active
    const deliveryFeeElem = document.getElementById('delivery_fee');
    if (deliveryFeeElem) {
        const delSetValue = Number(deliveryFeeElem.getAttribute('data-set')) || 0;
        const pf_del = Number(deliveryFeeElem.getAttribute('data-set1')) || 0;
        deliveryFeeAmount = pf_del === 1 ? delSetValue : (baseAmount * delSetValue / 100);
    }

    // Platform Fee - Check if element exists and status is active
    const platformFeeElem = document.getElementById('platform_fee');
    if (platformFeeElem) {
        const platfSetValue = Number(platformFeeElem.getAttribute('data-set')) || 0;
        const pf_pform = Number(platformFeeElem.getAttribute('data-set1')) || 0;
        platformFeeAmount = pf_pform === 1 ? platfSetValue : (baseAmount * platfSetValue / 100);
    }

    // Discount Fee - Check if element exists and status is active
    const discountFeeElem = document.getElementById('discount_fee');
    if (discountFeeElem) {
        const discSetValue = Number(discountFeeElem.getAttribute('data-set')) || 0;
        const pf_dis = Number(discountFeeElem.getAttribute('data-set1')) || 0;
        discountAmount = pf_dis === 1 ? discSetValue : (baseAmount * discSetValue / 100);
    }

    // GST Fee - Check if element exists and status is active
    const gstFeeElem = document.getElementById('gst_fee');
    if (gstFeeElem) {
        const gstSetValue = Number(gstFeeElem.getAttribute('data-set')) || 0;
        const pf_gst = Number(gstFeeElem.getAttribute('data-set1')) || 0;
        gstAmount = pf_gst === 1 ? gstSetValue : (baseAmount * gstSetValue / 100);
    }

    // Calculate total fees
    let totalFees = deliveryFeeAmount + platformFeeAmount + gstAmount - discountAmount;

    // Store fees in localStorage
    localStorage.setItem('fees', totalFees);
    localStorage.setItem('deliveryfee', deliveryFeeAmount);
    localStorage.setItem('platformfee', platformFeeAmount);
    localStorage.setItem('gstfee', gstAmount);
    localStorage.setItem('discount', discountAmount);

    let grandTotal = totalFees + total;

    // Update UI with calculated values - only if elements exist
    if (deliveryFeeElem) {
        deliveryFeeElem.textContent = `₹${deliveryFeeAmount.toFixed(2)}`;
    }

    if (platformFeeElem) {
        platformFeeElem.textContent = `₹${platformFeeAmount.toFixed(2)}`;
    }

    if (discountFeeElem) {
        discountFeeElem.textContent = `-₹${discountAmount.toFixed(2)}`;
    }

    if (gstFeeElem) {
        gstFeeElem.textContent = `₹${gstAmount.toFixed(2)}`;
    }

    // Update subtotal in fee summary (cart total before fees)
    const totalFeeElem = document.querySelector('.fee-total .fee-value');
    if (totalFeeElem) {
        totalFeeElem.innerHTML = `<span class="currency-symbol">₹</span>${grandTotal.toFixed(2)}`;
    }

    // Update final order total
    const orderTotalElem = document.getElementById('order-total');
    if (orderTotalElem) {
        orderTotalElem.textContent = `₹${grandTotal.toFixed(2)}`;
    }

    updateOrderButtonState();
}

// Toggle address section visibility
function toggleAddressSection() {
    const cardBody = document.getElementById('addressCardBody');
    const icon = document.getElementById('addressToggleIcon');

    if (cardBody.style.display === 'none') {
        cardBody.style.display = 'block';
        icon.classList.remove('bi-chevron-down');
        icon.classList.add('bi-chevron-up');
        // Load addresses if not already loaded
        if (document.getElementById('addresses-container').innerHTML === '') {
            renderAddresses();
        }
    } else {
        cardBody.style.display = 'block';
        icon.classList.remove('bi-chevron-up');
        icon.classList.add('bi-chevron-down');
    }
}

// Check if user is logged in
function checkLogin() {
    const userId = localStorage.getItem('userId');
    const loginAlert = document.getElementById('loginAlert');
    const orderContent = document.getElementById('orderContent');

    if (!userId) {
        loginAlert.style.display = 'block';
        orderContent.style.display = 'none';
        return false;
    }
    loginAlert.style.display = 'none';
    orderContent.style.display = 'block';
    return true;
}

// Cart Management Functions
function getCart() {
    try {
        const cartData = localStorage.getItem('cart');
        if (!cartData) return [];

        const cart = JSON.parse(cartData);

        return cart.map(item => {
            return {
                ...item,
                price: typeof item.price === 'string' ? parseFloat(item.price) : item.price,
                quantity: parseInt(item.quantity)
            };
        });
    } catch (e) {
        console.error("Error reading cart data:", e);
        return [];
    }
}

function calculateTotal(cart) {
    // Parse the fees as a float or integer
    let getfees = parseFloat(localStorage.getItem('fees')) || 0;

    // Calculate the total for the cart items
    let cartTotal = cart.reduce((total, item) => total + (item.price * item.quantity), 0);

    // Add the fee once to the total
    return (cartTotal + getfees).toFixed(2);
}

// Address Management Functions
function renderAddresses() {
    if (!checkLogin()) return;

    const container = document.getElementById('addresses-container');
    const addAddressBtn = document.getElementById('addAddressButton');
    const noAddressAlert = document.getElementById('noAddressAlert');
    const selectedAddressDiv = document.getElementById('selected-address');
    const custId = localStorage.getItem("userId");

    container.innerHTML = `
        <div class="text-center">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    `;

    fetch("<?= base_url() ?>getaddress/" + custId)
        .then(response => {
            if (!response.ok) throw response;
            return response.json();
        })
        .then(data => {
            try {
                let addresses = [];

                console.log('Addresses fetched:', data);

                if (data && Array.isArray(data.address)) {
                    addresses = data.address;
                }

                console.log('addresses:', addresses, 'length:', addresses.length);

                const selectedAddressId = localStorage.getItem('selectedAddressId');
                container.innerHTML = '';
                addAddressBtn.style.display = 'block';
                noAddressAlert.style.display = 'none';
                selectedAddressDiv.innerHTML = '';

                if (addresses.length === 0) {
                    addAddressBtn.style.display = 'block';
                    noAddressAlert.style.display = 'block';
                    localStorage.removeItem('selectedAddressId');
                } else {
                    addresses.forEach(address => {
                        const isSelected = selectedAddressId === address.address_id.toString();
                        const isDefault = address.pr_address == 1;

                        const colDiv = document.createElement('div');
                        colDiv.className = 'col-12 col-md-6 mb-3 address-col';
                        colDiv.innerHTML = `
                    <div class="card address-card ${isSelected ? 'selected-address' : ''}"
                         onclick="selectAddress('${address.address_id}')">
                        <div class="card-body">
                            <h5 class="card-title h6">${address.name}</h5>
                            <p class="card-text mb-1 small">
                                ${address.street_address}<br>
                                ${address.city}, ${address.state}<br>
                                ${address.pincode}, ${address.country}<br>
                                Phone: ${address.phone_no}
                            </p>
                            ${isDefault ? '<span class="badge bg-success">Primary</span>' : ''}
                            <div class="mt-2 d-flex justify-content-between">
                                <button class="btn btn-sm btn-outline-primary" 
                                        onclick="event.stopPropagation(); editAddress('${address.address_id}')">
                                    Edit
                                </button>
                                ${!isDefault ? `
                                    <button class="btn btn-sm btn-outline-danger" 
                                            onclick="event.stopPropagation(); deleteAddress('${address.address_id}')">
                                        Delete
                                    </button>` : ''
                                }
                            </div>
                        </div>
                    </div>
                `;
                        container.appendChild(colDiv);
                    });

                    if (selectedAddressId) {
                        const selectedAddress = addresses.find(
                            addr => addr.address_id.toString() === selectedAddressId
                        );
                        if (selectedAddress) {
                            showSelectedAddress(selectedAddress);
                        }
                    } else if (addresses.length > 0) {
                        selectAddress(addresses[0].address_id);
                    }
                }

                updateOrderButtonState();
            } catch (err) {
                console.error('Rendering error:', err);
                container.innerHTML = `
            <div class="alert alert-danger">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                An error occurred while displaying addresses.
                <button class="btn btn-sm btn-outline-danger ms-3" onclick="renderAddresses()">
                    <i class="bi bi-arrow-clockwise"></i> Retry
                </button>
            </div>
        `;
                updateOrderButtonState();
            }
        })
        .catch(error => {
            console.error('Error fetching addresses:', error);

            let errorMessage = 'Unable to load addresses. Please try again later.';

            if (error instanceof TypeError && error.message.includes('Failed to fetch')) {
                errorMessage = 'Network error: Please check your internet connection and try again.';
            } else if (error.status === 401) {
                errorMessage = 'Session expired: Please login again.';
            } else if (error.status === 404) {
                errorMessage = 'Address service unavailable. Please contact support.';
            }

            container.innerHTML = `
                <div class="alert alert-danger">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    ${errorMessage}
                    <button class="btn btn-sm btn-outline-danger ms-3" onclick="renderAddresses()">
                        <i class="bi bi-arrow-clockwise"></i> Retry
                    </button>
                </div>
            `;
            updateOrderButtonState();
        });
}

// Toggle delivery slots section visibility
function toggleDeliverySlots() {
    const slotDiv = document.getElementById('deliverySlots');
    const icon = document.getElementById('deliveryToggleIcon');

    if (slotDiv.style.display === "none" || slotDiv.style.display === "") {
        slotDiv.style.display = "block";
        icon.classList.remove('bi-chevron-down');
        icon.classList.add('bi-chevron-up');
    } else {
        slotDiv.style.display = "none";
        icon.classList.remove('bi-chevron-up');
        icon.classList.add('bi-chevron-down');
    }
}

// Select time slot and update UI
function selectTimeSlot(slotId) {
    // Update radio button
    const radioBtn = document.getElementById(slotId);
    if (radioBtn) {
        radioBtn.checked = true;
    }

    // Remove selected class from all options
    document.querySelectorAll('.time-slot-option').forEach(option => {
        option.classList.remove('selected');
    });

    // Add selected class to clicked option
    const selectedOption = document.querySelector(`#${slotId}`).closest('.time-slot-option');
    if (selectedOption) {
        selectedOption.classList.add('selected');
    }

    // Store selected slot in localStorage
    const slotValue = radioBtn.value;
    localStorage.setItem('selectedDeliverySlot', slotValue);

    // Update order button state
    updateOrderButtonState();
}

// Toggle the visibility of the payment method section
function togglePaymentSection() {
    const cardBody = document.getElementById('paymentCardBody');
    const icon = document.getElementById('paymentToggleIcon');
    if (cardBody.style.display === 'none' || cardBody.style.display === '') {
        cardBody.style.display = 'block';
        icon.classList.remove('bi-chevron-down');
        icon.classList.add('bi-chevron-up');
    } else {
        cardBody.style.display = 'none';
        icon.classList.remove('bi-chevron-up');
        icon.classList.add('bi-chevron-down');
    }
}

// Select a payment method option and update UI accordingly
function selectPaymentMethod(method) {
    // Update radio button checked state
    document.querySelectorAll('input[name="paymentMethod"]').forEach(input => {
        input.checked = (input.value === method);
    });

    // Update UI highlight and show/hide QR code section
    document.querySelectorAll('.payment-option').forEach(option => {
        option.classList.remove('selected');
    });

    const selectedOption = [...document.querySelectorAll('.payment-option')]
        .find(option => option.querySelector('input').value === method);
    if (selectedOption) {
        selectedOption.classList.add('selected');
    }

    // Show QR code section only if 'online' payment selected
    const qrCodeSection = document.getElementById('qrCodeSection');
    if (method === 'online') {
        qrCodeSection.style.display = 'block';
    } else {
        qrCodeSection.style.display = 'none';
    }

    updateOrderButtonState();
}

// Disable or enable the submit button based on validation
function updateOrderButtonState() {
    const cart = getCart();
    const paymentMethod = document.querySelector('input[name="paymentMethod"]:checked');
    const deliverySlot = document.querySelector('input[name="deliverySlot"]:checked');
    const transactionId = document.getElementById('transactionId');
    const submitBtn = document.getElementById('submitOrderBtn');
    const selectedAddressId = localStorage.getItem('selectedAddressId');

    let isValid = (cart && cart.length > 0) && 
                  paymentMethod && 
                  deliverySlot && 
                  selectedAddressId;

    if (paymentMethod && paymentMethod.value === 'online') {
        isValid = isValid && transactionId && transactionId.value.trim().length > 0;
        if (transactionId) {
            if (transactionId.value.trim().length === 0) {
                transactionId.classList.add('is-invalid');
            } else {
                transactionId.classList.remove('is-invalid');
            }
        }
    }

    submitBtn.disabled = !isValid;
}

function showSelectedAddress(address) {
    // Optional: display selected address details if needed
}

window.selectAddress = function(addressId) {
    localStorage.setItem('selectedAddressId', addressId);
    renderAddresses();
    updateOrderButtonState();
};

window.editAddress = function(addressId) {
    fetch("<?= base_url() ?>edit/getaddress/" + addressId, {
            method: "GET",
        })
        .then(response => response.json())
        .then(data => {
            console.log('Fetching address details for ID:', data);
            if (data.status === "success") {
                const address = data.data;
                const User_id = localStorage.getItem('userId') || 0;
                document.getElementById('customerId').value = User_id || 0;
                document.getElementById('addressId').value = address.address_id || '';
                document.getElementById('fullName').value = address.name || '';
                document.getElementById('street').value = address.street_address || '';
                document.getElementById('city').value = address.city || '';
                document.getElementById('phone').value = address.phone_no || '';
                document.getElementById('state').value = address.state || '';
                document.getElementById('zip').value = address.pincode || '';
                document.getElementById('country').value = address.country || '';
                document.getElementById('defaultAddress').checked = address.pr_address == 1;

                const modal = new bootstrap.Modal(document.getElementById('addressModal'));
                modal.show();
            } else {
                console.log('Error data:', data);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
};

window.deleteAddress = function(addressId) {
    if (!confirm('Are you sure you want to delete this address?')) return;
    console.log('Deleting address:', addressId);

    fetch("<?= base_url() ?>address/delete/" + addressId, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === "success") {
                alert("Address deleted successfully.");
                renderAddresses();
            } else {
                alert("Failed to delete address: " + (data.message || "Unknown error"));
                console.log('Error:', data);
            }
        })
        .catch(error => {
            alert("Error deleting address. Please try again.");
            console.error(error);
        });
};

// Address Form Submission
document.getElementById('addressForm').addEventListener('submit', (e) => {
    e.preventDefault();

    // Validate required fields
    const requiredFields = ['customerId', 'fullName', 'street', 'phone', 'city', 'state', 'zip', 'country'];
    let isValid = true;
    requiredFields.forEach(field => {
        const element = document.getElementById(field);
        if (!element.value.trim()) {
            element.classList.add('is-invalid');
            isValid = false;
        } else {
            element.classList.remove('is-invalid');
        }
    });
    if (!isValid) return;

    // Get User ID from localStorage
    const User_id = localStorage.getItem('userId') || 0;

    // Build the address object
    const address = {
        userId: User_id,
        id: document.getElementById('addressId').value.trim(),
        name: document.getElementById('fullName').value.trim(),
        street_address: document.getElementById('street').value.trim(),
        city: document.getElementById('city').value.trim(),
        phone_no: document.getElementById('phone').value.trim(),
        state: document.getElementById('state').value.trim(),
        pincode: document.getElementById('zip').value.trim(),
        country: document.getElementById('country').value.trim(),
        pr_address: document.getElementById('defaultAddress').checked ? 1 : 0
    };

    const url = "<?= base_url() ?>customer/address/";

    setCookie('address', JSON.stringify(address), 1);

    console.log('Sending address:', getCookie('address'));

    fetch(url, {
            method: 'POST',
        })
        .then(response => response.json())
        .then(data => {
            console.log('Response:', data);
            if (data.status === "success") {
                const modal = bootstrap.Modal.getInstance(document.getElementById('addressModal'));
                modal.hide();
                document.getElementById('addressForm').reset();
                document.getElementById('addressId').value = "";
                renderAddresses();
                location.reload();
                if (address.pr_address === 1) {
                    localStorage.setItem('selectedAddressId', data.addressId || address.id);
                }
            } else {
                console.error('Failed to save address:', data.message || 'Unknown error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert("Error saving address. Please try again.");
        });
});

function setCookie(name, value, days) {
    let expires = "";
    if (days) {
        let date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=/";
}

function getCookie(name) {
    const nameEQ = name + "=";
    const ca = document.cookie.split(';');
    for(let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}

// Make sure to call renderOrderSummary when window is resized
window.addEventListener('resize', function() {
    renderOrderSummary();
});

// Order Submission
document.getElementById('submitOrderBtn').addEventListener('click', function() {
    if (!checkLogin()) return;

    const cart = getCart();
    const selectedAddressId = localStorage.getItem('selectedAddressId');
    const paymentMethod = document.querySelector('input[name="paymentMethod"]:checked');
    const deliverySlot = document.querySelector('input[name="deliverySlot"]:checked');
    const transactionId = document.getElementById('transactionId');

    if (cart.length === 0) {
        alert('Your cart is empty!');
        return;
    }

    if (!selectedAddressId) {
        alert('Please select a delivery address!');
        return;
    }

    if (!deliverySlot) {
        alert('Please select a delivery time slot!');
        toggleDeliverySlots();
        return;
    }

    if (!paymentMethod) {
        alert('Please select a payment method!');
        return;
    }

    // Additional validation for online payment
    if (paymentMethod.value === 'online' && !transactionId.value.trim()) {
        transactionId.classList.add('is-invalid');
        alert('Please enter your transaction ID for online payment!');
        return;
    }

    // Get the selected address details
    fetch("<?= base_url(); ?>edit/getaddress/" + selectedAddressId, {
            method: "GET",
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok: ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            console.log('Fetched address data:', data);

            const selectedAddress = selectedAddressId;
            const totalAmount = calculateTotal(cart);
            const deliveryFeeAmount = localStorage.getItem('deliveryfee');
            const discountAmount = localStorage.getItem('discount');
            const gstfeeAmount = localStorage.getItem('gstfee');
            const platformfeeAmount = localStorage.getItem('platformfee');
            const selectedDeliverySlot = deliverySlot.value;

            // Prepare form data
            document.getElementById('orderData').value = JSON.stringify(cart);
            document.getElementById('addressData').value = JSON.stringify(selectedAddress);
            document.getElementById('totalAmount').value = totalAmount;
            document.getElementById('deliveryFeeAmount').value = deliveryFeeAmount;
            document.getElementById('discountAmount').value = discountAmount;
            document.getElementById('gstfeeAmount').value = gstfeeAmount;
            document.getElementById('platformfeeAmount').value = platformfeeAmount;
            document.getElementById('paymentMethod').value = paymentMethod.value;
            document.getElementById('transactionIdField').value = paymentMethod.value === 'online' ?
                transactionId.value.trim() : '';

            // Add delivery slot to form
            let deliverySlotInput = document.getElementById('deliverySlotField');
            if (!deliverySlotInput) {
                deliverySlotInput = document.createElement('input');
                deliverySlotInput.type = 'hidden';
                deliverySlotInput.name = 'delivery_slot';
                deliverySlotInput.id = 'deliverySlotField';
                document.getElementById('orderForm').appendChild(deliverySlotInput);
            }
            deliverySlotInput.value = selectedDeliverySlot;

            // Clear the cart and delivery slot
            localStorage.removeItem('cart');
            localStorage.removeItem('selectedDeliverySlot');

            // Submit the form
            const userId = localStorage.getItem('userId') || 0;
            document.getElementById('orderForm').action =
                "<?= base_url($shop_url_name . '/' . 'orderplaced/') ?>" + userId;
            document.getElementById('orderForm').submit();
        })
        .catch(error => {
            console.error('Error in order placement:', error);
            alert("Error processing your order. Please try again.");
        });
});

// Initialize page
document.addEventListener('DOMContentLoaded', function() {
    if (!checkLogin()) {
        document.getElementById('loginAlert').style.display = 'block';
        document.getElementById('orderContent').style.display = 'none';
        return;
    }

    // Initialize dropdowns as closed by default
    document.getElementById('addressToggleIcon').classList.add('bi-chevron-down');
    document.getElementById('paymentCardBody').style.display = 'none';
    document.getElementById('paymentToggleIcon').classList.add('bi-chevron-down');
    document.getElementById('deliverySlots').style.display = 'none';
    document.getElementById('deliveryToggleIcon').classList.add('bi-chevron-down');

    // Load addresses and order summary
    renderAddresses();
    renderOrderSummary();

    // Set up event listeners for payment method selection
    document.querySelectorAll('input[name="paymentMethod"]').forEach(radio => {
        radio.addEventListener('change', function() {
            selectPaymentMethod(this.value);
        });
    });

    // Set up event listeners for delivery slots
    document.querySelectorAll('input[name="deliverySlot"]').forEach(radio => {
        radio.addEventListener('change', function() {
            selectTimeSlot(this.id);
        });
    });

    // Check if there's a previously selected slot
    const savedSlot = localStorage.getItem('selectedDeliverySlot');
    if (savedSlot) {
        const slotRadio = document.querySelector(`input[name="deliverySlot"][value="${savedSlot}"]`);
        if (slotRadio) {
            selectTimeSlot(slotRadio.id);
        }
    }

    // Set up event listener for transaction ID input
    document.getElementById('transactionId').addEventListener('input', function() {
        this.classList.remove('is-invalid');
        updateOrderButtonState();
    });
});
</script>

<?= $this->endSection() ?>