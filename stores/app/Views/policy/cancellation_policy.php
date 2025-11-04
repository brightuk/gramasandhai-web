<?= $this->extend('templates/layout') ?>
<?= $this->section('content') ?>

<title>Cancellation Policy - <?= config('AccessProperties')->company_name ?? 'Our Platform' ?></title>

<section class="container mt-4 hero-section py-5 mb-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
    <div class="container text-center">
        <h1 class="display-4 fw-bold mb-3">Cancellation Policy</h1>
        <p class="lead mb-0">Clear guidelines for order cancellations</p>
    </div>
</section>

<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-0 py-4">
                    <h1 class="card-title text-center mb-2 text-dark">Cancellation Policy</h1>
                    <p class="text-center text-muted mb-0"><strong>Effective date:</strong> <?= date('F j, Y') ?></p>
                </div>
                <div class="card-body p-4 p-md-5">
                    <div class="policy-content">
                        <div class="policy-section mb-5">
                            <h3 class="text-primary mb-3">
                                <i class="fas fa-user-times text-danger me-2"></i>Customer Cancellations
                            </h3>
                            <p class="text-muted mb-0">
                                Customers may cancel orders that have not yet been accepted or prepared by the seller. If the seller has already accepted and started preparing the order, cancellation may not be possible and will be subject to the seller's policies.
                            </p>
                        </div>

                        <div class="policy-section mb-5">
                            <h3 class="text-primary mb-3">
                                <i class="fas fa-store-alt text-warning me-2"></i>Seller Cancellations
                            </h3>
                            <p class="text-muted mb-0">
                                Sellers may cancel orders due to stock issues, operational constraints, or other valid reasons. When a seller cancels an order, the customer will be notified and a refund will be initiated where applicable.
                            </p>
                        </div>

                        <div class="policy-section mb-5">
                            <h3 class="text-primary mb-3">
                                <i class="fas fa-clock text-info me-2"></i>Timing & Refunds
                            </h3>
                            <ul class="list-unstyled">
                                <li class="mb-2 d-flex align-items-start">
                                    <i class="fas fa-check-circle text-success mt-1 me-3"></i>
                                    <span class="text-muted">If a cancellation occurs before order acceptance, a full refund is typically issued.</span>
                                </li>
                                <li class="mb-2 d-flex align-items-start">
                                    <i class="fas fa-exclamation-circle text-warning mt-1 me-3"></i>
                                    <span class="text-muted">If a cancellation occurs after acceptance/preparation, a partial refund or no refund may apply depending on vendor policy — we will mediate disputes.</span>
                                </li>
                            </ul>
                        </div>

                        <div class="policy-section mb-5">
                            <h3 class="text-primary mb-3">
                                <i class="fas fa-list-ol text-success me-2"></i>How to Cancel
                            </h3>
                            <ol class="list-group list-group-numbered">
                                <li class="list-group-item border-0 px-0 bg-transparent">
                                    <span class="text-muted">Use the app/website "Cancel Order" flow before the seller accepts.</span>
                                </li>
                                <li class="list-group-item border-0 px-0 bg-transparent">
                                    <span class="text-muted">If you cannot cancel through the app, contact support at <a href="mailto:<?= config('AccessProperties')->support_email ?? 'support@gramasandhai.in' ?>" class="text-decoration-none"><?= config('AccessProperties')->support_email ?? 'support@gramasandhai.in' ?></a> immediately with your order ID.</span>
                                </li>
                            </ol>
                        </div>

                        <div class="alert alert-warning mt-4">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <strong>Note:</strong> We are a marketplace platform and not the delivery partner. Delivery-related cancellations or claims should be coordinated with the seller and the delivery agent if one is used.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Section -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="card bg-light border-0">
                <div class="card-body text-center py-5">
                    <h4 class="mb-3">Questions About Our Policies?</h4>
                    <p class="text-muted mb-4">We're here to help and provide clarity on any aspect of our terms, cancellation policy, or services.</p>
                    <div class="row justify-content-center">
                        <div class="col-md-3 col-sm-6 mb-3">
                            <a href="mailto:<?= config('AccessProperties')->supportEmail ?? 'support@example.com' ?>" class="btn btn-outline-primary w-100">
                                <i class="fas fa-envelope me-2"></i>Email Support
                            </a>
                        </div>
                        <div class="col-md-3 col-sm-6 mb-3">
                            <a href="#" class="btn btn-outline-success w-100">
                                <i class="fas fa-comments me-2"></i>Live Chat
                            </a>
                        </div>
                        <div class="col-md-3 col-sm-6 mb-3">
                            <a href="#" class="btn btn-outline-info w-100">
                                <i class="fas fa-question-circle me-2"></i>FAQ
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;
}

.hero-section {
    position: relative;
    overflow: hidden;
}

.hero-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" fill="white" opacity="0.1"><polygon points="0,100 0,0 1000,0 1000,80"/></svg>');
    background-size: cover;
}

.policy-section {
    border-left: 4px solid #667eea;
    padding-left: 1.5rem;
}

.list-group-item {
    background: transparent;
    padding: 0.5rem 0;
}

@media (max-width: 768px) {
    .hero-section {
        padding: 3rem 0 !important;
    }
    
    .display-4 {
        font-size: 2rem !important;
    }
    
    .policy-section {
        padding-left: 1rem;
        margin-left: 0.5rem;
    }
}

#footer{
    display: none;
}
</style>

<!-- Add Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<?= $this->endSection() ?>