<?php include(APPPATH . 'Views/templates/config.php'); ?>
<?= $this->extend('templates/layout') ?>

<?= $this->section('content') ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
:root {
    --primary-color: #233a95;
    --secondary-color: rgb(43, 190, 249);
    --accent-color: rgb(211, 235, 239);
    --success-color: #28a745;
    --warning-color: #ffc107;
    --danger-color: #dc3545;
    --light-bg: #f8f9fa;
    --dark-text: #2b3445;
}

/* Container and Title */
.custom-order-container {
    background: linear-gradient(135deg, #ffffff 0%, var(--accent-color) 100%);
    border-radius: 20px;
    padding: 2.5rem 2rem;
    box-shadow: 0 10px 30px rgba(35, 58, 149, 0.08);
    margin: 2rem auto;
    max-width: 1400px;
    border: 1px solid var(--accent-color);
}

.custom-order-title {
    color: var(--primary-color);
    font-weight: 800;
    font-size: 2.2rem;
    margin-bottom: 1.5rem;
    position: relative;
    display: inline-block;
}

.custom-order-title::after {
    content: '';
    position: absolute;
    bottom: -8px;
    left: 0;
    width: 80px;
    height: 4px;
    background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
    border-radius: 2px;
}

/* Accordion Styles */
.custom-accordion {
    border-radius: 16px;
    background: #fff;
    border: 1px solid var(--accent-color);
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(35, 58, 149, 0.08);
}

.custom-accordion-item+.custom-accordion-item {
    border-top: 1px solid var(--accent-color);
}

.custom-accordion-header {
    background: linear-gradient(135deg, #ffffff 0%, var(--accent-color) 100%);
    border-radius: 0;
    transition: all 0.3s ease;
}

.custom-accordion-header:hover {
    background: linear-gradient(135deg, var(--accent-color) 0%, rgba(43, 190, 249, 0.2) 100%);
}

.custom-accordion-button {
    font-size: 1.15rem;
    font-weight: 700;
    background: transparent;
    color: var(--primary-color);
    border: none;
    border-radius: 0;
    padding: 1.25rem 1.5rem;
    transition: all 0.3s ease;
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 100%;
    text-align: left;
}

.custom-accordion-button:not(.collapsed) {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
    color: #fff;
    box-shadow: 0 4px 12px rgba(35, 58, 149, 0.2);
}

.custom-accordion-button::after {
    content: '\f078';
    font-family: 'Font Awesome 6 Free';
    font-weight: 900;
    background-image: none;
    transform: rotate(0deg);
    transition: transform 0.3s ease;
    font-size: 0.9rem;
}

.custom-accordion-button:not(.collapsed)::after {
    transform: rotate(180deg);
    color: #fff;
}

.custom-accordion-collapse {
    background: #fff;
}

.custom-accordion-body {
    padding: 1.8rem 2rem;
}

/* Product Card Styles */
.custom-product-list {
    margin-top: 1.5rem;
}

.custom-product-card {
    border: 1px solid var(--accent-color);
    border-radius: 12px;
    background: #fff;
    transition: all 0.3s ease;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(35, 58, 149, 0.04);
    height: 100%;
}

.custom-product-card:hover {
    box-shadow: 0 6px 20px rgba(35, 58, 149, 0.12);
    transform: translateY(-3px);
    border-color: var(--secondary-color);
}

.custom-product-card-body {
    padding: 1.5rem;
}

.custom-product-name {
    color: var(--primary-color);
    font-weight: 700;
    font-size: 1.1rem;
    margin-bottom: 0.75rem;
}

.custom-product-info {
    color: var(--dark-text);
    font-size: 0.95rem;
    line-height: 1.5;
}

.custom-product-title {
    margin-top: 2rem;
    color: var(--primary-color);
    font-weight: 700;
    font-size: 1.3rem;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid var(--accent-color);
}

/* Alerts */
.custom-no-product-alert,
.custom-no-order-alert {
    background: #fff3cd;
    color: #856404;
    border-color: #ffeeba;
    font-size: 1rem;
    border-radius: 10px;
    margin-top: 1.5rem;
    padding: 1.25rem;
    border-left: 4px solid var(--warning-color);
}

.custom-no-order-alert {
    background: var(--accent-color);
    color: var(--primary-color);
    border-color: var(--secondary-color);
    border-left: 4px solid var(--secondary-color);
    text-align: center;
    padding: 2rem;
    font-size: 1.1rem;
}

/* Order Status Styles */
.order-status-container {
    padding: 2rem;
    background: linear-gradient(135deg, #ffffff 0%, var(--accent-color) 100%);
    border-radius: 16px;
    box-shadow: 0 4px 12px rgba(35, 58, 149, 0.05);
    height: 100%;
    border: 1px solid var(--accent-color);
}

.order-status-title {
    color: var(--primary-color);
    font-weight: 700;
    font-size: 1rem;
    letter-spacing: 0.5px;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    gap: 8px;
}

.order-status-title i {
    font-size: 1.2rem;
}

/* Order Timeline Styles */
.order-timeline {
    padding: 2rem 0;
    position: relative;
}

.timeline-container {
    position: relative;
}

.timeline-line {
    position: absolute;
    top: 20px;
    left: 0;
    right: 0;
    height: 4px;
    background: var(--accent-color);
    border-radius: 2px;
    z-index: 1;
}

.timeline-step {
    position: relative;
    display: inline-block;
    width: 25%;
    text-align: center;
    z-index: 2;
}

.timeline-icon {
    width: 44px;
    height: 44px;
    background: var(--accent-color);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 12px;
    position: relative;
    color: var(--primary-color);
    transition: all 0.4s ease;
    font-size: 1.1rem;
    border: 2px solid transparent;
}

.timeline-step.active .timeline-icon {
    background: linear-gradient(135deg, var(--secondary-color) 0%, var(--primary-color) 100%);
    color: white;
    box-shadow: 0 4px 12px rgba(43, 190, 249, 0.3);
    transform: scale(1.1);
    border-color: var(--primary-color);
}

.timeline-step.active .timeline-icon::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 56px;
    height: 56px;
    background: rgba(43, 190, 249, 0.2);
    border-radius: 50%;
    z-index: -1;
}

.timeline-progress {
    position: absolute;
    top: 20px;
    left: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--secondary-color), var(--primary-color));
    border-radius: 2px;
    z-index: 1;
    transition: width 0.5s ease;
}

.timeline-label {
    font-size: 0.8rem;
}

.timeline-label strong {
    display: block;
    color: var(--dark-text);
    font-weight: 600;
    margin-bottom: 4px;
}

.timeline-label small {
    color: #666;
    font-size: 0.75rem;
}

.timeline-step.active .timeline-label strong {
    color: var(--primary-color);
    font-weight: 700;
}

.status-info-item {
    padding: 1rem 0;
    border-bottom: 1px solid var(--accent-color);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.status-info-item:last-child {
    border-bottom: none;
}

.status-info-label {
    font-weight: 600;
    color: var(--primary-color);
    display: flex;
    align-items: center;
    gap: 8px;
}

.status-info-value {
    color: var(--dark-text);
    font-weight: 500;
}

.status-badge {
    padding: 0.4rem 0.8rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
}

.status-processing {
    background: #ffeeba !important;
    color: #856404;
    border: 1px solid rgba(255, 193, 7, 0.3);
}

.status-completed {
    background: rgba(130, 224, 152, 0.15);
    color: #155724;
    border: 1px solid rgba(40, 167, 69, 0.3);
}

.status-cancelled {
    background: rgba(220, 53, 69, 0.15);
    color: #721c24;
    border: 1px solid rgba(220, 53, 69, 0.3);
}

.status-pending {
    background: #dda222ff;
    color: #383d41;
    border: 1px solid rgba(108, 117, 125, 0.3);
}

.delivery-delivered {
    background: rgba(40, 167, 69, 0.15);
    color: #155724;
    border: 1px solid rgba(40, 167, 69, 0.3);
}

.delivery-pending {
    background: rgb(204, 238, 186);
    color: #856404;
    border: 1px solid rgba(255, 193, 7, 0.3);
}

.order-amount {
    font-size: 1.3rem;
    font-weight: 700;
    color: var(--primary-color);
}

.order-date {
    color: #6c757d;
    font-size: 0.9rem;
}

.order-header-info {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    gap: 5px;
}

.order-header-status {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-top: 5px;
    flex-wrap: wrap;
}

.order-actions {
    margin-top: 1.5rem;
    display: flex;
    gap: 10px;
}

.btn-action {
    padding: 0.5rem 1rem;
    border-radius: 8px;
    font-weight: 600;
    font-size: 0.85rem;
    transition: all 0.3s ease;
}

.btn-track {
    background: var(--primary-color);
    color: white;
    border: none;
}

.btn-track:hover {
    background: #1a2b7a;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(35, 58, 149, 0.3);
}

.btn-invoice {
    background: transparent;
    color: var(--primary-color);
    border: 1px solid var(--primary-color);
}

.btn-invoice:hover {
    background: var(--primary-color);
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(35, 58, 149, 0.3);
}

.amount-highlight {
    background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

#footer {
    display: none;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .custom-order-container {
        padding: 1.5rem 1rem;
        border-radius: 16px;
    }

    .custom-order-title {
        font-size: 1.8rem;
    }

    .custom-accordion-body {
        padding: 1.5rem 1rem;
    }

    .order-status-container {
        padding: 1.5rem;
        margin-top: 1.5rem;
    }

    .timeline-step {
        width: 25%;
    }

    .timeline-icon {
        width: 36px;
        height: 36px;
        font-size: 0.9rem;
    }

    .timeline-label {
        font-size: 0.7rem;
    }

    .order-header-info {
        width: 100%;
    }

    .order-actions {
        flex-direction: column;
    }

    .order-header-status {
        flex-direction: column;
        align-items: flex-start;
        gap: 5px;
    }
}

/* Animation for accordion */
.custom-accordion-collapse.collapsing {
    transition: height 0.35s ease;
}

/* Hover effects for product cards */
.custom-product-card .card-hover-effect {
    transition: all 0.3s ease;
}

.custom-product-card:hover .card-hover-effect {
    transform: scale(1.02);
}

/* Status icons */
.status-icon {
    width: 20px;
    height: 20px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    margin-right: 8px;
    font-size: 0.7rem;
}

/* Enhanced timeline progress */
.timeline-step.completed .timeline-icon {
    background: var(--secondary-color);
    color: white;
}

.timeline-step.completed~.timeline-step .timeline-line-segment {
    background: var(--secondary-color);
}

/* Additional styling for better visual hierarchy */
.order-meta-info {
    background: rgba(43, 190, 249, 0.05);
    border-radius: 10px;
    padding: 1rem;
    margin-bottom: 1.5rem;
    border: 1px solid var(--accent-color);
}

.product-feature {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 5px;
}

.product-feature i {
    color: var(--secondary-color);
    width: 16px;
}

/* Fix for expanded accordion text colors */
.custom-accordion-button:not(.collapsed) .order-amount.amount-highlight {
    background: transparent !important;
    -webkit-background-clip: unset !important;
    -webkit-text-fill-color: white !important;
    background-clip: unset !important;
    color: white !important;
}

.custom-accordion-button:not(.collapsed) .order-date {
    color: rgba(255, 255, 255, 0.9) !important;
}

.custom-accordion-button:not(.collapsed) .order-date i {
    color: rgba(255, 255, 255, 0.9) !important;
}
#shopCartWarningModal{
    z-index: 9200 !important;
}
</style>

<div class="container custom-order-container my-5">
    <h1 class="custom-order-title">Order History</h1>

    <?php if (!empty($orders)): ?>
    <div class="custom-accordion" id="customOrderAccordion">
        <?php foreach ($orders as $index => $order):
                $collapseId = 'customCollapse' . $order['order_id'];
                $headingId = 'customHeading' . $order['order_id'];
                
                // Decode order status
                $orderStatusText = '';
                $orderStatusClass = '';
                switch($order['order_status']) {
                    case 'PRS':
                        $orderStatusText = 'Processing';
                        $orderStatusClass = 'status-processing';
                        break;
                    case 'COM':
                        $orderStatusText = 'Completed';
                        $orderStatusClass = 'status-completed';
                        break;
                    case 'CNL':
                        $orderStatusText = 'Cancelled';
                        $orderStatusClass = 'status-cancelled';
                        break;
                    default:
                        $orderStatusText = 'Pending';
                        $orderStatusClass = 'status-pending';
                }
                
                // Decode delivery status
                $deliveryStatusText = $order['delivery_status'] == 1 ? 'Delivered' : 'Pending';
                $deliveryStatusClass = $order['delivery_status'] == 1 ? 'delivery-delivered' : 'delivery-pending';
                
                // Calculate timeline progress
                $timelineProgress = 0;
                if ($order['order_status'] == 'COM') {
                    $timelineProgress = 100;
                } elseif ($order['order_status'] == 'PRS') {
                    $timelineProgress = $order['delivery_status'] == 1 ? 75 : 50;
                } else {
                    $timelineProgress = 25;
                }
            ?>
        <div class="custom-accordion-item">
            <h2 class="custom-accordion-header" id="<?= $headingId ?>" style="cursor:pointer;">
                <button class="custom-accordion-button <?= ($index !== 0) ? 'collapsed' : '' ?> btn btn-link"
                    type="button" data-bs-toggle="collapse" data-bs-target="#<?= $collapseId ?>"
                    aria-expanded="<?= ($index === 0) ? 'true' : 'false' ?>" aria-controls="<?= $collapseId ?>">
                    <div class="order-header-info">
                        <div class="d-flex justify-content-between w-100 align-items-start">
                            <span class="fw-bold">Order #<?= $order['order_id'] ?></span>
                            <span
                                class="order-amount amount-highlight">₹<?= number_format($order['amount'], 2) ?></span>
                        </div>
                        <div class="order-header-status">
                            <span class="status-badge <?= $orderStatusClass ?>">
                                <i class="fas fa-circle status-icon"></i><?= $orderStatusText ?>
                            </span>
                            <span class="status-badge <?= $deliveryStatusClass ?>">
                                <i class="fas fa-truck status-icon"></i><?= $deliveryStatusText ?>
                            </span>
                            <span class="order-date">
                                <i
                                    class="far fa-calendar-alt me-1"></i><?= date('d M Y', strtotime($order['ordered_date'])) ?>
                            </span>
                        </div>
                    </div>
                </button>
            </h2>
            <div id="<?= $collapseId ?>" class="custom-accordion-collapse collapse <?= ($index === 0) ? 'show' : '' ?>"
                aria-labelledby="<?= $headingId ?>">
                <div class="d-flex row">
                    <div class="col-lg-6 col-md-12 custom-accordion-body">
                        <div class="order-meta-info">
                            <h5 class="d-flex align-items-center mb-3">
                                <i class="fas fa-receipt me-2" style="color: var(--primary-color);"></i> Order Details
                            </h5>
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <strong>Invoice No:</strong> <?= htmlspecialchars($order['invoice_no']) ?>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <strong>Invoice Date:</strong> <?= htmlspecialchars($order['invoice_date']) ?>
                                </div>
                                <div class="col-12 mb-2">
                                    <strong>Shipping Address:</strong>
                                    <?= htmlspecialchars($order['shipping_address']) ?>,
                                    <?= htmlspecialchars($order['city']) ?>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <strong>Receiver Phone:</strong>
                                    <?= htmlspecialchars($order['receiver_phone_no']) ?>
                                </div>
                            </div>
                        </div>

                        <h5 class="custom-product-title d-flex align-items-center">
                            <i class="fas fa-boxes me-2" style="color: var(--primary-color);"></i> Products
                        </h5>
                        <button class="btn btn-outline-primary repeat-order-btn" data-bs-toggle="modal"
                            data-bs-target="#repeatedOrders"
                            data-repeat-order='<?= htmlspecialchars($order['repeat'], ENT_QUOTES, 'UTF-8') ?>'
                            data-shop-url="<?= htmlspecialchars($order['url_name']) ?>">
                            Buy Again
                        </button>
                        <a href="<?= $base.$order['url_name'] ?>" class="btn btn-outline-info">Shop</a>
                        <div class="row custom-product-list">
                            <?php if (!empty($order_details[$order['order_id']])): ?>
                            <?php foreach ($order_details[$order['order_id']] as $product): ?>
                            <div class="col-md-6 mb-3 custom-product-col">
                                <div class="custom-product-card card h-100">
                                    <div class="custom-product-card-body card-body card-hover-effect">
                                        <h6 class="custom-product-name card-title">
                                            <?= htmlspecialchars($product['prod_name']) ?>
                                        </h6>
                                        <div class="custom-product-info">
                                            <div class="product-feature">
                                                <i class="fas fa-sort-amount-up-alt"></i>
                                                <span>Quantity: <?= htmlspecialchars($product['prod_qty']) ?></span>
                                            </div>
                                            <div class="product-feature">
                                                <i class="fas fa-tag"></i>
                                                <span>Price: ₹<?= number_format($product['prod_price'], 2) ?></span>
                                            </div>
                                            <div class="product-feature">
                                                <i class="fas fa-Variant-hanging"></i>
                                                <span>Variant: <?= htmlspecialchars($product['weight']) ?> kg</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                            <?php else: ?>
                            <div class="col-12">
                                <div class="alert alert-warning custom-no-product-alert d-flex align-items-center">
                                    <i class="fas fa-exclamation-triangle me-2"></i>
                                    <div>No products found for this order.</div>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-12">
                        <div class="order-status-container">
                            <h5 class="order-status-title">
                                <i class="fas fa-shipping-fast"></i> ORDER #<?= $order['order_id'] ?>
                            </h5>
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div>
                                    <small class="text-muted d-block">Expected Arrival</small>
                                    <strong
                                        class="fs-6"><?= !empty($order['delivery_date']) ? date('d M Y', strtotime($order['delivery_date'])) : 'TBD' ?></strong>
                                </div>
                                <div class="text-end">
                                    <small class="text-muted d-block">Total Amount</small>
                                    <strong
                                        class="fs-5 amount-highlight">₹<?= number_format($order['amount'], 2) ?></strong>
                                </div>
                            </div>

                            <!-- Order Status Timeline -->
                            <div class="order-timeline mb-4">
                                <div class="timeline-container">
                                    <div class="timeline-line"></div>
                                    <div class="timeline-progress" style="width: <?= $timelineProgress ?>%;"></div>

                                    <div
                                        class="timeline-step <?= in_array($order['order_status'], ['PRS', 'COM']) ? 'active' : '' ?>">
                                        <div class="timeline-icon">
                                            <i class="fas fa-clipboard-check"></i>
                                        </div>
                                        <div class="timeline-label">
                                            <strong>Order Processed</strong>
                                            <small class="d-block text-muted">Confirmed</small>
                                        </div>
                                    </div>

                                    <div
                                        class="timeline-step <?= in_array($order['order_status'], ['PRS', 'COM']) ? 'active' : '' ?>">
                                        <div class="timeline-icon">
                                            <i class="fas fa-shipping-fast"></i>
                                        </div>
                                        <div class="timeline-label">
                                            <strong>Order Shipped</strong>
                                            <small class="d-block text-muted">In Transit</small>
                                        </div>
                                    </div>

                                    <div class="timeline-step <?= $order['delivery_status'] == 1 ? 'active' : '' ?>">
                                        <div class="timeline-icon">
                                            <i class="fas fa-truck"></i>
                                        </div>
                                        <div class="timeline-label">
                                            <strong>Out for Delivery</strong>
                                            <small class="d-block text-muted">On the way</small>
                                        </div>
                                    </div>

                                    <div
                                        class="timeline-step <?= $order['delivery_status'] == 1 && $order['order_status'] == 'COM' ? 'active' : '' ?>">
                                        <div class="timeline-icon">
                                            <i class="fas fa-home"></i>
                                        </div>
                                        <div class="timeline-label">
                                            <strong>Order Arrived</strong>
                                            <small class="d-block text-muted">Delivered</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php 
                                $timeRange = $order['time_slot'] ?? '';

                                if (strpos($timeRange, '-') !== false) {
                                    list($start, $end) = explode('-', $timeRange);

                                    $startFormatted = date("g:i A", strtotime(trim($start)));
                                    $endFormatted = date("g:i A", strtotime(trim($end)));

                                    $deliveryTime = $startFormatted . ' - ' . $endFormatted;
                                } else {
                                    // Fallback if no valid range
                                    $deliveryTime = $timeRange ?: 'No Time Slot';
                                }
                                ?>

                            <!-- Order Details -->
                            <div class="status-info-item">
                                <span class="status-info-label">
                                    <i class="fas fa-credit-card"></i> Delivery Time
                                </span>
                                <span class="status-info-value">
                                    <?= esc($deliveryTime); ?>
                                </span>
                            </div>


                            <div class="status-info-item">
                                <span class="status-info-label">
                                    <i class="far fa-calendar-alt"></i> Ordered Date
                                </span>
                                <span
                                    class="status-info-value"><?= date('d M Y', strtotime($order['ordered_date'])) ?></span>
                            </div>

                            <div class="status-info-item">
                                <span class="status-info-label">
                                    <i class="fas fa-map-marker-alt"></i> Shipping Address
                                </span>
                                <span
                                    class="status-info-value text-end"><?= htmlspecialchars($order['shipping_address']) ?>,
                                    <?= htmlspecialchars($order['city']) ?></span>
                            </div>

                            <div class="order-actions">
                                <button class="btn btn-action btn-track">
                                    <i class="fas fa-map-marked-alt me-1"></i> Track Order
                                </button>
                                <button class="btn btn-action btn-invoice">
                                    <i class="fas fa-file-invoice me-1"></i> Download Invoice
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php else: ?>
    <div class="alert alert-info custom-no-order-alert">
        <i class="fas fa-info-circle me-2 fa-lg"></i>
        <div>
            <h4 class="alert-heading">No orders found</h4>
            <p class="mb-0">You haven't placed any orders yet. Start shopping to see your order history here.</p>
        </div>
    </div>
    <?php endif; ?>
</div>
<!-- Add this anywhere in your HTML (preferably at the bottom of the body) -->
<div class="modal fade" id="shopCartWarningModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-warning text-dark">
        <h5 class="modal-title">Different Shop Detected</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        You already have products from <strong id="currentShopName"></strong> in your cart.
        Do you want to clear the cart and switch to <strong id="newShopName"></strong>?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="confirmShopSwitch">Yes, Switch Shop</button>
      </div>
    </div>
  </div>
</div>


<!-- Repeat Orders Modal -->
<div class="modal fade" id="repeatedOrders" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="repeatedOrdersLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="repeatedOrdersLabel">Repeat Order - Buy Again</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="repeatOrderProducts">
                <!-- Products will be dynamically loaded here -->
                <div class="text-center py-4">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-2">Loading products...</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary   " data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary add-to-cart-btn" id="addAllToCart">Add All to Cart</button>
            </div>
        </div>
    </div>
</div>





<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
// Make the entire header clickable with auto-close behavior
document.querySelectorAll('.custom-accordion-header').forEach(function(header) {
    header.addEventListener('click', function(e) {
        // Prevent double toggle if the button itself was clicked
        if (e.target.closest('button')) return;

        var btn = header.querySelector('button[data-bs-toggle="collapse"]');
        if (btn) {
            var targetSelector = btn.getAttribute('data-bs-target');
            var target = document.querySelector(targetSelector);
            if (target) {
                var isShown = target.classList.contains('show');

                // Close all other accordion items first
                document.querySelectorAll('.custom-accordion-collapse').forEach(function(collapse) {
                    if (collapse !== target && collapse.classList.contains('show')) {
                        var collapseInstance = bootstrap.Collapse.getInstance(collapse);
                        if (collapseInstance) {
                            collapseInstance.hide();
                        } else {
                            bootstrap.Collapse.getOrCreateInstance(collapse).hide();
                        }

                        // Update button state for closed accordion
                        var closedBtn = collapse.previousElementSibling.querySelector('button');
                        if (closedBtn) {
                            closedBtn.classList.add('collapsed');
                            closedBtn.setAttribute('aria-expanded', 'false');
                        }
                    }
                });

                // Toggle the clicked accordion
                var collapse = bootstrap.Collapse.getOrCreateInstance(target);
                if (isShown) {
                    collapse.hide();
                    btn.classList.add('collapsed');
                    btn.setAttribute('aria-expanded', 'false');
                } else {
                    collapse.show();
                    btn.classList.remove('collapsed');
                    btn.setAttribute('aria-expanded', 'true');
                }
            }
        }
    });
});

// Also handle button clicks with the same behavior
document.querySelectorAll('.custom-accordion-button').forEach(function(button) {
    button.addEventListener('click', function(e) {
        var targetSelector = this.getAttribute('data-bs-target');
        var target = document.querySelector(targetSelector);

        if (target) {
            var isShown = target.classList.contains('show');

            // Close all other accordion items
            document.querySelectorAll('.custom-accordion-collapse').forEach(function(collapse) {
                if (collapse !== target && collapse.classList.contains('show')) {
                    var collapseInstance = bootstrap.Collapse.getInstance(collapse);
                    if (collapseInstance) {
                        collapseInstance.hide();
                    } else {
                        bootstrap.Collapse.getOrCreateInstance(collapse).hide();
                    }

                    // Update button state for closed accordion
                    var closedBtn = collapse.previousElementSibling.querySelector('button');
                    if (closedBtn) {
                        closedBtn.classList.add('collapsed');
                        closedBtn.setAttribute('aria-expanded', 'false');
                    }
                }
            });

            // Update current button state
            if (!isShown) {
                this.classList.remove('collapsed');
                this.setAttribute('aria-expanded', 'true');
            }
        }
    });
});

// Add animation to product cards on page load
document.addEventListener('DOMContentLoaded', function() {
    const productCards = document.querySelectorAll('.custom-product-card');
    productCards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';

        setTimeout(() => {
            card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 100);
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const repeatOrderModal = document.getElementById('repeatedOrders');
    const repeatProductsContainer = document.getElementById('repeatOrderProducts');

    // Store current shop URL for the modal session
    let currentModalShopUrl = '';

    // Initialize main cart functionality
    initializeCart();

    if (repeatOrderModal) {
        repeatOrderModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const repeatOrderData = button.getAttribute('data-repeat-order');
            const shopUrl = button.getAttribute('data-shop-url');

            // Store the shop URL for this modal session
            currentModalShopUrl = shopUrl;

            // Clear previous content
            repeatProductsContainer.innerHTML =
                '<div class="text-center py-4"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div><p class="mt-2">Loading products...</p></div>';

            try {
                // Parse the JSON data
                const products = JSON.parse(repeatOrderData);
                console.log('Parsed products:', products); // Debug log
                displayRepeatOrderProducts(products, shopUrl);
            } catch (error) {
                console.error('Error parsing repeat order data:', error);
                repeatProductsContainer.innerHTML = `
                    <div class="alert alert-danger text-center">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        Error loading products. Please try again.
                    </div>
                `;
            }
        });

        // Clear modal content when hidden
        repeatOrderModal.addEventListener('hidden.bs.modal', function() {
            repeatProductsContainer.innerHTML =
                '<div class="text-center py-4"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div><p class="mt-2">Loading products...</p></div>';
            currentModalShopUrl = '';
        });
    }

    // Function to display products in the modal
    function displayRepeatOrderProducts(products, shopUrl) {
        if (!products || products.length === 0) {
            repeatProductsContainer.innerHTML = `
                <div class="alert alert-info text-center">
                    <i class="fas fa-info-circle me-2"></i>
                    No products found in this order.
                </div>
            `;
            return;
        }

        let html = '<div class="row">';
        let validProductCount = 0;

        products.forEach((item, index) => {
            const product = item.product;

            // Validate product data
            if (!product || !product.id) {
                console.warn('Invalid product data at index', index, item);
                return;
            }

            // Check if product has a valid name
            const productName = product.prod_name || 'Unknown Product';

            // Validate variants array
            if (!item.variants || item.variants.length === 0 || !item.variants[0].id) {
                console.warn('No valid variants for product:', productName);
                return;
            }

            const variant = item.variants[0];

            // Validate variant has required data
            if (!variant.measure || !variant.price) {
                console.warn('Incomplete variant data for product:', productName, variant);
                return;
            }

            validProductCount++;

            // Calculate final price
            let originalPrice = parseFloat(variant.price) || 0;
            let finalPrice = originalPrice;
            let discountText = '';

            if (variant.disc_price && parseFloat(variant.disc_price) > 0) {
                if (variant.disc_type == 1) {
                    // Fixed discount
                    finalPrice = originalPrice - parseFloat(variant.disc_price);
                    discountText = `-₹${variant.disc_price}`;
                } else {
                    // Percentage discount
                    const discountAmount = (originalPrice * parseFloat(variant.disc_price)) / 100;
                    finalPrice = originalPrice - discountAmount;
                    discountText = `-${variant.disc_price}%`;
                }
            }

            // Ensure final price is not negative
            if (finalPrice < 0) finalPrice = 0;

            // Check if this product is already in cart
            const cart = getCart();
            const cartItem = cart.find(item =>
                item.id === product.id && item.measure === variant.measure
            );
            const initialQuantity = cartItem ? cartItem.quantity : 1;
            const isInCart = !!cartItem;

            html += `
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card product-card h-100 border-0 shadow-sm" data-product-id="${product.id}">
                        <div class="card-body">
                            <h6 class="card-title text-primary fw-bold">${productName}</h6>
                            
                            <div class="product-details mb-3">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-muted">Variant:</span>
                                    <span class="fw-semibold">${variant.measure}</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-muted">Price:</span>
                                    <div class="text-end">
                                        ${originalPrice !== finalPrice ? 
                                            `<span class="text-muted text-decoration-line-through me-2">₹${originalPrice.toFixed(2)}</span>` : 
                                            ''
                                        }
                                        <span class="fw-bold text-success">₹${finalPrice.toFixed(2)}</span>
                                    </div>
                                </div>
                                ${discountText ? 
                                    `<div class="badge bg-warning text-dark">${discountText} OFF</div>` : 
                                    ''
                                }
                            </div>
                            
                            <div class="product-actions">
                                <div class="input-group input-group-sm mb-2 ${isInCart ? '' : 'd-none'} qty-group">
                                    <button class="btn btn-outline-secondary qty-btn" type="button" data-action="decrement">-</button>
                                    <input type="number" class="form-control text-center qty-input" value="${initialQuantity}" min="1" 
                                           data-product-id="${product.id}" 
                                           data-variant-id="${variant.id}" 
                                           data-price="${finalPrice}"
                                           data-measure="${variant.measure}">
                                    <button class="btn btn-outline-secondary qty-btn" type="button" data-action="increment">+</button>
                                </div>
                                <button class="btn btn-primary btn-sm w-100 add-to-cart-btn ${isInCart ? 'd-none' : ''}" 
                                        data-product-id="${product.id}"
                                        data-variant-id="${variant.id}"
                                        data-product-name="${productName}"
                                        data-variant-measure="${variant.measure}"
                                        data-price="${finalPrice}"
                                        data-image="${product.main_image || 'no-image.jpg'}"
                                        data-shop-url="${shopUrl}">
                                    <i class="fas fa-cart-plus me-1"></i> Add to Cart
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        });

        html += '</div>';

        // Check if any valid products were found
        if (validProductCount === 0) {
            repeatProductsContainer.innerHTML = `
                <div class="alert alert-warning text-center">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    No valid products available to repeat this order.
                </div>
            `;
            return;
        }

        repeatProductsContainer.innerHTML = html;

        // Add event listeners for the modal products
        attachModalEventListeners();
    }

    function attachModalEventListeners() {
        // Add to cart buttons in modal
        document.querySelectorAll('#repeatOrderProducts .add-to-cart-btn').forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.getAttribute('data-product-id');
                const variantId = this.getAttribute('data-variant-id');
                const productName = this.getAttribute('data-product-name');
                const measure = this.getAttribute('data-variant-measure');
                const price = parseFloat(this.getAttribute('data-price'));
                const image = this.getAttribute('data-image');
                const shopUrl = this.getAttribute('data-shop-url');

                // Check shop cart condition before adding
                if (canAddToCart(shopUrl)) {
                    // Add to cart using existing cart logic
                    addProductToCart({
                        id: productId,
                        name: productName,
                        price: price,
                        measure: measure,
                        quantity: 1,
                        image: image,
                        variantId: variantId,
                        shopUrl: shopUrl
                    });

                    // Update UI for this specific product
                    const card = this.closest('.product-card');
                    toggleCartUI(card, true, 1);

                    showToast(`${productName} (${measure}) added to cart`, 'success');
                }
            });
        });

        // Quantity buttons in modal
        document.querySelectorAll('#repeatOrderProducts .qty-btn').forEach(button => {
            button.addEventListener('click', function() {
                const action = this.getAttribute('data-action');
                const qtyGroup = this.closest('.qty-group');
                const input = qtyGroup.querySelector('.qty-input');
                let qty = parseInt(input.value) || 1;

                if (action === 'increment') {
                    qty++;
                } else if (action === 'decrement') {
                    qty--;
                }

                // Update quantity in cart
                const productId = input.getAttribute('data-product-id');
                const measure = input.getAttribute('data-measure');

                if (qty <= 0) {
                    // Remove from cart if quantity is 0 or less
                    removeProductFromCart(productId, measure);
                    const card = qtyGroup.closest('.product-card');
                    toggleCartUI(card, false);
                    showToast('Product removed from cart', 'info');
                } else {
                    input.value = qty;
                    updateCartQuantity(productId, measure, qty);
                    showToast('Cart quantity updated', 'info');
                }

                updateCartCount();
            });
        });

        // Quantity input changes in modal
        document.querySelectorAll('#repeatOrderProducts .qty-input').forEach(input => {
            input.addEventListener('change', function() {
                const qty = parseInt(this.value) || 1;
                const productId = this.getAttribute('data-product-id');
                const measure = this.getAttribute('data-measure');

                if (qty <= 0) {
                    removeProductFromCart(productId, measure);
                    const card = this.closest('.product-card');
                    toggleCartUI(card, false);
                    showToast('Product removed from cart', 'info');
                } else {
                    updateCartQuantity(productId, measure, qty);
                    showToast('Cart quantity updated', 'info');
                }

                updateCartCount();
            });
        });

        // Add All to Cart button
        const addAllButton = document.getElementById('addAllToCart');
        if (addAllButton) {
            // Remove existing listeners by cloning
            const newAddAllButton = addAllButton.cloneNode(true);
            addAllButton.parentNode.replaceChild(newAddAllButton, addAllButton);

            // Add new listener
            newAddAllButton.addEventListener('click', function() {
                // Use the stored modal shop URL
                if (!canAddToCart(currentModalShopUrl)) {
                    return; // Stop execution if cart condition fails
                }

                const products = document.querySelectorAll('#repeatOrderProducts .product-card');
                let addedCount = 0;
                let skippedCount = 0;

                products.forEach(card => {
                    const addButton = card.querySelector('.add-to-cart-btn');

                    // Only add products that aren't already in cart
                    if (addButton && !addButton.classList.contains('d-none')) {
                        const productId = addButton.getAttribute('data-product-id');
                        const variantId = addButton.getAttribute('data-variant-id');
                        const productName = addButton.getAttribute('data-product-name');
                        const measure = addButton.getAttribute('data-variant-measure');
                        const price = parseFloat(addButton.getAttribute('data-price'));
                        const image = addButton.getAttribute('data-image');
                        const shopUrl = addButton.getAttribute('data-shop-url');

                        // Add to cart
                        addProductToCart({
                            id: productId,
                            name: productName,
                            price: price,
                            measure: measure,
                            quantity: 1,
                            image: image,
                            variantId: variantId,
                            shopUrl: shopUrl
                        });

                        // Update UI
                        toggleCartUI(card, true, 1);
                        addedCount++;
                    } else {
                        skippedCount++;
                    }
                });

                updateCartCount();

                let message = '';
                if (addedCount > 0 && skippedCount > 0) {
                    message =
                        `Added ${addedCount} new products to cart (${skippedCount} already in cart)`;
                } else if (addedCount > 0) {
                    message = `Successfully added ${addedCount} products to cart!`;
                } else {
                    message = 'All products are already in your cart!';
                }

                showToast(message, addedCount > 0 ? 'success' : 'info');
            });
        }
    }

    // Shop Cart Condition Functions
    function canAddToCart(targetShopUrl) {
        const current_cart_shop = localStorage.getItem("shop_cart");
        const currentCart = getCart();

        // If cart is empty, allow adding and set shop
        if (currentCart.length === 0) {
            localStorage.setItem("shop_cart", targetShopUrl);
            return true;
        }

        // If same shop, allow adding
        if (current_cart_shop === targetShopUrl) {
            return true;
        }

        // Different shop - show warning
        showShopCartWarning(current_cart_shop, targetShopUrl);
        return false;
    }

    function showShopCartWarning(currentShopUrl, targetShopUrl) {
        document.getElementById("currentShopName").textContent = currentShopUrl;
        document.getElementById("newShopName").textContent = targetShopUrl;

        var modal = new bootstrap.Modal(document.getElementById("shopCartWarningModal"));
        modal.show();

        // Remove any existing event listeners by replacing the button
        const confirmButton = document.getElementById("confirmShopSwitch");
        const newConfirmButton = confirmButton.cloneNode(true);
        confirmButton.parentNode.replaceChild(newConfirmButton, confirmButton);

        // Handle confirmation click
        newConfirmButton.onclick = function() {
            // Clear current cart and set new shop
            clearCartAndSetShop(targetShopUrl);
            
            // Close the modal
            modal.hide();
            
            // Show success message
            showToast(`Switched to ${targetShopUrl} and cleared cart`, 'success');
        };
    }

    function clearCartAndSetShop(newShopUrl) {
        // Clear the cart from localStorage
        localStorage.removeItem('cart');
        
        // Set the new shop
        localStorage.setItem('shop_cart', newShopUrl);
        
        // Update cart count display
        updateCartCount();
    }

    // Cart Functions
    function getCart() {
        try {
            const cartData = localStorage.getItem('cart');
            return cartData ? JSON.parse(cartData) : [];
        } catch (e) {
            console.error("Error reading cart from localStorage:", e);
            return [];
        }
    }

    function saveCart(cart) {
        localStorage.setItem('cart', JSON.stringify(cart));
    }

    function updateCartCount() {
        const cart = getCart();
        const totalItems = cart.reduce((total, item) => total + item.quantity, 0);
        document.querySelectorAll('.cart-count').forEach(el => {
            if (el) el.textContent = totalItems;
        });
    }

    function initializeCart() {
        updateCartCount();
    }

    function toggleCartUI(card, isInCart, quantity = 1) {
        const addButton = card.querySelector('.add-to-cart-btn');
        const qtyGroup = card.querySelector('.qty-group');
        const qtyInput = card.querySelector('.qty-input');

        if (isInCart) {
            if (addButton) addButton.classList.add('d-none');
            if (qtyGroup) {
                qtyGroup.classList.remove('d-none');
                if (qtyInput) qtyInput.value = quantity;
            }
        } else {
            if (addButton) addButton.classList.remove('d-none');
            if (qtyGroup) qtyGroup.classList.add('d-none');
        }
    }

    function addProductToCart(productData) {
        let cart = getCart();
        const existingItemIndex = cart.findIndex(item =>
            item.id === productData.id && item.measure === productData.measure
        );

        if (existingItemIndex !== -1) {
            cart[existingItemIndex].quantity += productData.quantity;
        } else {
            cart.push({
                id: productData.id,
                name: productData.name,
                price: productData.price,
                measure: productData.measure,
                quantity: productData.quantity,
                image: productData.image,
                variantId: productData.variantId,
                shopUrl: productData.shopUrl
            });
        }

        saveCart(cart);
        updateCartCount();
        return true;
    }

    function removeProductFromCart(productId, measure) {
        let cart = getCart();
        cart = cart.filter(item => !(item.id === productId && item.measure === measure));
        saveCart(cart);
        updateCartCount();
    }

    function updateCartQuantity(productId, measure, quantity) {
        let cart = getCart();
        const itemIndex = cart.findIndex(item =>
            item.id === productId && item.measure === measure
        );

        if (itemIndex !== -1) {
            if (quantity <= 0) {
                cart.splice(itemIndex, 1);
            } else {
                cart[itemIndex].quantity = quantity;
            }
            saveCart(cart);
            updateCartCount();
        }
    }

    // Toast notification function
    function showToast(message, type = 'info') {
        const existingToasts = document.querySelectorAll('.custom-toast');
        existingToasts.forEach(toast => toast.remove());

        const toastClass = {
            'success': 'bg-success text-white',
            'error': 'bg-danger text-white',
            'info': 'bg-info text-white',
            'warning': 'bg-warning text-dark'
        }[type] || 'bg-info text-white';

        const toastHtml = `
            <div class="custom-toast position-fixed top-0 end-0 m-3 ${toastClass} p-3 rounded shadow-lg" 
                 style="z-index: 9999; min-width: 300px; animation: slideInRight 0.3s ease-out;">
                <div class="d-flex align-items-center">
                    <i class="fas ${type === 'success' ? 'fa-check-circle' : type === 'error' ? 'fa-exclamation-circle' : 'fa-info-circle'} me-2"></i>
                    <span>${message}</span>
                </div>
            </div>
        `;

        document.body.insertAdjacentHTML('beforeend', toastHtml);

        setTimeout(() => {
            const toast = document.querySelector('.custom-toast');
            if (toast) {
                toast.style.animation = 'slideOutRight 0.3s ease-in';
                setTimeout(() => toast.remove(), 300);
            }
        }, 3000);
    }

    // Add CSS for toast animations
    const style = document.createElement('style');
    style.textContent = `
        @keyframes slideInRight {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        @keyframes slideOutRight {
            from { transform: translateX(0); opacity: 1; }
            to { transform: translateX(100%); opacity: 0; }
        }
        .custom-toast {
            backdrop-filter: blur(10px);
        }
    `;
    document.head.appendChild(style);
});
</script>
<?= $this->endSection() ?>