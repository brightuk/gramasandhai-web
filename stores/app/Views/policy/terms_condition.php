<?= $this->extend('templates/layout') ?>
<?= $this->section('content') ?>

<title>Terms & Conditions - Bright Technologies</title>

<section class="container mt-4 hero-section py-5 mb-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
    <div class="container text-center">
        <h1 class="display-4 fw-bold mb-3">Terms & Conditions</h1>
        <p class="lead mb-0">Please read these terms carefully before using our services</p>
    </div>
</section>

<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-0 py-4">
                    <h1 class="card-title text-center mb-2 text-dark">Terms and Conditions</h1>
                    <p class="text-center text-muted mb-0"><strong>Effective date:</strong> <?= date('F j, Y') ?></p>
                </div>
                <div class="card-body p-4 p-md-5">
                    <div class="terms-content">
                        <div class="terms-section mb-5">
                            <h3 class="text-primary mb-3">
                                <i class="fas fa-file-contract text-primary me-2"></i>1. Agreement to Terms
                            </h3>
                            <p class="text-muted mb-0">
                                By using Bright Technologies you agree to these Terms. We operate a marketplace connecting customers and independent sellers/vendors. We are not a delivery partner unless explicitly stated. Sellers are independent businesses and are responsible for their own products, pricing, fulfillment, and compliance with local laws.
                            </p>
                        </div>

                        <div class="terms-section mb-5">
                            <h3 class="text-primary mb-3">
                                <i class="fas fa-user-check text-success me-2"></i>2. Buyer Obligations
                            </h3>
                            <ul class="list-unstyled">
                                <li class="mb-2 d-flex align-items-start">
                                    <i class="fas fa-check-circle text-success mt-1 me-3"></i>
                                    <span class="text-muted">Provide accurate delivery details.</span>
                                </li>
                                <li class="mb-2 d-flex align-items-start">
                                    <i class="fas fa-check-circle text-success mt-1 me-3"></i>
                                    <span class="text-muted">Comply with local laws regarding age-restricted items.</span>
                                </li>
                                <li class="mb-2 d-flex align-items-start">
                                    <i class="fas fa-check-circle text-success mt-1 me-3"></i>
                                    <span class="text-muted">Inspect the order at delivery and notify support of issues within the timeframes in our Refund Policy.</span>
                                </li>
                            </ul>
                        </div>

                        <div class="terms-section mb-5">
                            <h3 class="text-primary mb-3">
                                <i class="fas fa-store-alt text-warning me-2"></i>3. Seller Obligations
                            </h3>
                            <ul class="list-unstyled">
                                <li class="mb-2 d-flex align-items-start">
                                    <i class="fas fa-clipboard-check text-warning mt-1 me-3"></i>
                                    <span class="text-muted">Ensure product descriptions are accurate.</span>
                                </li>
                                <li class="mb-2 d-flex align-items-start">
                                    <i class="fas fa-certificate text-warning mt-1 me-3"></i>
                                    <span class="text-muted">Maintain required licenses and food safety standards.</span>
                                </li>
                                <li class="mb-2 d-flex align-items-start">
                                    <i class="fas fa-shipping-fast text-warning mt-1 me-3"></i>
                                    <span class="text-muted">Complete orders promptly or notify us if unable to fulfill.</span>
                                </li>
                            </ul>
                        </div>

                        <div class="terms-section mb-5">
                            <h3 class="text-primary mb-3">
                                <i class="fas fa-credit-card text-info me-2"></i>4. Payments & Razorpay
                            </h3>
                            <p class="text-muted mb-0">
                                Payments are processed via third-party payment processors (such as Razorpay). We do not store full card data on our servers. For details on payments, settlement timelines, fees, and refunds see our Refund Policy and the payment processor terms.
                            </p>
                        </div>

                        <div class="terms-section mb-5">
                            <h3 class="text-primary mb-3">
                                <i class="fas fa-balance-scale text-secondary me-2"></i>5. Liability & Disclaimers
                            </h3>
                            <p class="text-muted mb-0">
                                To the maximum extent permitted by law, we are not liable for indirect or consequential loss arising from marketplace transactions. Vendors are responsible for product quality, delivery and any statutory compliance regarding food safety.
                            </p>
                        </div>

                        <div class="terms-section mb-5">
                            <h3 class="text-primary mb-3">
                                <i class="fas fa-gavel text-dark me-2"></i>6. Governing Law
                            </h3>
                            <p class="text-muted mb-0">
                                These Terms are governed by the laws of India.
                            </p>
                        </div>

                        <div class="terms-section">
                            <h3 class="text-primary mb-3">
                                <i class="fas fa-envelope text-primary me-2"></i>7. Contact
                            </h3>
                            <p class="text-muted mb-0">
                                For questions: <a href="mailto:support@gramasandhai.in" class="text-decoration-none">support@gramasandhai.in</a>
                            </p>
                        </div>

                        <div class="alert alert-info mt-5">
                            <i class="fas fa-info-circle me-2"></i>
                            <strong>Important:</strong> By using our platform, you acknowledge that you have read, understood, and agree to be bound by these Terms and Conditions.
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
                    <p class="text-muted mb-4">We're here to help and provide clarity on any aspect of our terms, privacy policy, or services.</p>
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

.terms-section {
    border-left: 4px solid #667eea;
    padding-left: 1.5rem;
}

.terms-content ul li {
    padding: 0.25rem 0;
}

@media (max-width: 768px) {
    .hero-section {
        padding: 3rem 0 !important;
    }
    
    .display-4 {
        font-size: 2rem !important;
    }
    
    .terms-section {
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