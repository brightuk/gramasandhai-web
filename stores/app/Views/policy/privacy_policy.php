<?= $this->extend('templates/layout') ?>
<?= $this->section('content') ?>



<title>Privacy Policy - <?= config('AccessProperties')->company_name ?? 'Our Platform' ?></title>

<section class="container mt-4 hero-section py-5 mb-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
    <div class="container text-center">
        <h1 class="display-4 fw-bold mb-3">Privacy Policy</h1>
        <p class="lead mb-0">Your privacy and data security are our top priorities</p>
    </div>
</section>

<div class="container mb-5">
    <div class="row">
        <!-- Quick Overview Card -->


        <!-- Detailed Privacy Policy Content -->
        <div class="col-lg-12 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white border-0 py-4">
                    <h3 class="card-title mb-0 text-center text-dark">Complete Privacy Policy</h3>
                    <p class="text-muted mb-0 text-center mt-2"><strong>Effective date:</strong> <?= date('F j, Y') ?></p>
                </div>
                <div class="card-body p-4">
                    <div class="privacy-content">
                        <p class="mb-4">
                            This Privacy Policy describes how <strong><?= config('AccessProperties')->company_name ?? 'Our Platform' ?></strong> ("we", "us", "our") collects, uses, shares, and protects personal information when you use our website and related services. We operate a multivendor marketplace for grocery and food ordering. We are not a delivery partner — sellers/vendors are independently responsible for order fulfillment and deliveries unless otherwise stated.
                        </p>

                        <div class="privacy-section mb-4">
                            <h4 class="text-primary mb-3">1. Information We Collect</h4>
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="fas fa-user-circle text-primary me-2"></i><strong>Customer-provided information:</strong> name, email, phone number, delivery address, order details, payment information (processed by our payment provider), reviews, and communications with support.</li>
                                <li class="mb-2"><i class="fas fa-store text-primary me-2"></i><strong>Vendor-provided information:</strong> business name, contact details, bank/settlement details, menu/product listings, tax IDs, and operational hours.</li>
                                <li class="mb-2"><i class="fas fa-laptop-code text-primary me-2"></i><strong>Automatically collected:</strong> device info, IP address, browser user agent, cookies and similar tracking technologies, usage logs.</li>
                            </ul>
                        </div>

                        <div class="privacy-section mb-4">
                            <h4 class="text-primary mb-3">2. How We Use Information</h4>
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="fas fa-shopping-basket text-success me-2"></i>To process and fulfill orders and to route orders to the appropriate vendor.</li>
                                <li class="mb-2"><i class="fas fa-credit-card text-success me-2"></i>To manage payments and refunds in coordination with our payment processor.</li>
                                <li class="mb-2"><i class="fas fa-comments text-success me-2"></i>To communicate order status, promotions, and account notices.</li>
                                <li class="mb-2"><i class="fas fa-shield-alt text-success me-2"></i>To detect and prevent fraud and abuse and to comply with legal obligations.</li>
                            </ul>
                        </div>

                        <div class="privacy-section mb-4">
                            <h4 class="text-primary mb-3">3. Sharing Information</h4>
                            <p>We share personal information as follows:</p>
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="fas fa-truck text-info me-2"></i>With the vendor fulfilling the order — vendors receive the customer name, delivery address, order details and phone number as is necessary to fulfill and deliver the order.</li>
                                <li class="mb-2"><i class="fas fa-money-bill-wave text-info me-2"></i>With payment processors and banks to collect payments, process refunds and reconcile settlements.</li>
                                <li class="mb-2"><i class="fas fa-cogs text-info me-2"></i>With service providers that support our platform (e.g., analytics, email providers, customer support tools).</li>
                                <li class="mb-2"><i class="fas fa-gavel text-info me-2"></i>When required by law or to respond to legal process.</li>
                            </ul>
                        </div>

                        <div class="privacy-section mb-4">
                            <h4 class="text-primary mb-3">4. Cookies & Tracking</h4>
                            <p><i class="fas fa-cookie-bite text-warning me-2"></i>We and our partners use cookies and similar technologies for security, analytics, and personalization. See our <a href="<?= base_url('content/cookies-policy') ?>" class="text-decoration-none">Cookies Policy</a> for details and how to opt out where applicable.</p>
                        </div>

                        <div class="privacy-section mb-4">
                            <h4 class="text-primary mb-3">5. Data Retention & Security</h4>
                            <p><i class="fas fa-database text-secondary me-2"></i>We retain personal data as long as necessary for the purposes described (e.g., transaction records, dispute resolution, legal compliance). We implement reasonable administrative, technical, and physical safeguards to protect data, but no system is completely secure.</p>
                        </div>

                        <div class="privacy-section mb-4">
                            <h4 class="text-primary mb-3">6. Your Rights</h4>
                            <p><i class="fas fa-user-check text-success me-2"></i>Depending on your jurisdiction, you may have rights to access, correct, delete, or port your personal data and to object to certain processing. Contact us at <a href="mailto:<?= config('AccessProperties')->supportEmail ?? 'support@example.com' ?>" class="text-decoration-none"><?= config('AccessProperties')->supportEmail ?? 'support@example.com' ?></a> to exercise these rights.</p>
                        </div>

                        <div class="privacy-section mb-4">
                            <h4 class="text-primary mb-3">7. Changes to This Policy</h4>
                            <p><i class="fas fa-sync-alt text-info me-2"></i>We may update this policy from time to time. The "Effective date" at the top will change when we publish material updates.</p>
                        </div>

                        <div class="privacy-section">
                            <h4 class="text-primary mb-3">8. Contact</h4>
                            <p><i class="fas fa-envelope text-primary me-2"></i>Questions? Contact: <a href="mailto:<?= config('AccessProperties')->supportEmail ?? 'support@example.com' ?>" class="text-decoration-none"><?= config('AccessProperties')->supportEmail ?? 'support@example.com' ?></a> — <?= config('AccessProperties')->company_name ?? 'Our Platform' ?></p>
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

.card-header {
    border: none !important;
}

.privacy-section {
    border-left: 4px solid #667eea;
    padding-left: 1rem;
}

.privacy-content ul li {
    padding: 0.25rem 0;
}

@media (max-width: 768px) {
    .hero-section {
        padding: 3rem 0 !important;
    }
    
    .display-4 {
        font-size: 2rem !important;
    }
    
    .privacy-section {
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