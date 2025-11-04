<?= $this->extend('templates/layout') ?>
<?= $this->section('content') ?>

<title>Refund Policy - <?= config('AccessProperties')->company_name ?? 'Our Platform' ?></title>

<section class="container mt-4 hero-section py-5 mb-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
    <div class="container text-center">
        <h1 class="display-4 fw-bold mb-3">Refund Policy</h1>
        <p class="lead mb-0">Clear and transparent refund process for your peace of mind</p>
    </div>
</section>

<div class="container mb-5">
    <div class="row">
 

        <!-- Detailed Refund Policy Content -->
        <div class="col-lg-12 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white border-0 py-4">
                    <h3 class="card-title mb-0 text-center text-dark">Complete Refund Policy</h3>
                    <p class="text-muted mb-0 mt-2"><strong>Effective date:</strong> <?= date('F j, Y') ?></p>

                </div>
                <div class="card-body p-4">
                    <div class="refund-content">
                        <p class="mb-4">
                            As a marketplace, we facilitate transactions between customers and independent vendors. We are not the delivery partner unless explicitly specified. Refunds are processed according to the reason for refund and the vendor's own policies; however, we will assist in coordination and, where applicable, process refunds via our payment processor.
                        </p>

                        <div class="refund-section mb-4">
                            <h4 class="text-primary mb-3">
                                <i class="fas fa-check-circle text-success me-2"></i>When Refunds Are Available
                            </h4>
                            <ul class="list-unstyled">
                                <li class="mb-3">
                                    <strong class="text-dark">Incorrect or missing items:</strong>
                                    <p class="mb-0 text-muted">If items are missing or the order is materially incorrect, contact us within 24 hours with photos or evidence.</p>
                                </li>
                                <li class="mb-3">
                                    <strong class="text-dark">Quality issues:</strong>
                                    <p class="mb-0 text-muted">If food is spoiled or unfit for consumption, contact support within 24 hours with supporting photos.</p>
                                </li>
                                <li class="mb-3">
                                    <strong class="text-dark">Cancelled orders:</strong>
                                    <p class="mb-0 text-muted">If an order is cancelled before the vendor confirms or prepares it, a full refund may be issued.</p>
                                </li>
                            </ul>
                        </div>

                        <div class="refund-section mb-4">
                            <h4 class="text-primary mb-3">
                                <i class="fas fa-cogs text-info me-2"></i>How Refunds Are Processed
                            </h4>
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <i class="fas fa-search text-info me-2"></i>Refunds are initiated after verification. We may request evidence.
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-credit-card text-info me-2"></i>Refunds will be issued to the original payment method where possible. The timing depends on the payment processor and bank (typically 5–10 business days).
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-store text-info me-2"></i>In some cases, a vendor may issue a store credit instead of a monetary refund; this will be made explicit during the resolution.
                                </li>
                            </ul>
                        </div>

                        <div class="refund-section mb-4">
                            <h4 class="text-primary mb-3">
                                <i class="fas fa-exclamation-triangle text-warning me-2"></i>Exceptions
                            </h4>
                            <p class="text-muted">
                                Refunds will not generally be available for customer change-of-mind after delivery, unless the seller agrees. Specific categories (perishable promotional items) may have different rules — refer to the product page and the vendor's terms.
                            </p>
                        </div>

                        <div class="refund-section mb-4">
                            <h4 class="text-primary mb-3">
                                <i class="fas fa-list-ol text-success me-2"></i>How to Request a Refund
                            </h4>
                            <ol class="list-group list-group-numbered">
                                <li class="list-group-item border-0 px-0">
                                    <strong>Contact support:</strong> <a href="mailto:<?= config('AccessProperties')->supportEmail ?? 'support@example.com' ?>" class="text-decoration-none"><?= config('AccessProperties')->supportEmail ?? 'support@example.com' ?></a> or use the in-app help flow.
                                </li>
                                <li class="list-group-item border-0 px-0">
                                    <strong>Provide details:</strong> Order ID, photos and a short description.
                                </li>
                                <li class="list-group-item border-0 px-0">
                                    <strong>Coordination:</strong> We will coordinate with the vendor and update you by email/phone.
                                </li>
                            </ol>
                        </div>

                        <div class="alert alert-info mt-4">
                            <i class="fas fa-info-circle me-2"></i>
                            <strong>Need help?</strong> If you have questions about our refund policy, contact: 
                            <a href="mailto:<?= config('AccessProperties')->supportEmail ?? 'support@example.com' ?>" class="alert-link"><?= config('AccessProperties')->supportEmail ?? 'support@example.com' ?></a>
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
                    <p class="text-muted mb-4">We're here to help and provide clarity on any aspect of our terms, refund policy, or services.</p>
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

.card-header {
    border: none !important;
}

.refund-section {
    border-left: 4px solid #ffc107;
    padding-left: 1rem;
}

.refund-content ul li {
    padding: 0.25rem 0;
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
    
    .refund-section {
        padding-left: 0.5rem;
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