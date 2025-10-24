<?= $this->extend('templates/layout') ?>
<?= $this->section('content') ?>

<title>About & Privacy</title>
<section class="container mt-4 hero-section py-5 mb-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
    <div class="container text-center">
        <h1 class="display-4 fw-bold mb-3">About Us & Your Privacy</h1>
        <p class="lead mb-0">Transparency and trust are at the heart of everything we do</p>
    </div>
</section>

<div class="container mb-5">
    <div class="row">
        <!-- About Section -->
        <div class="col-lg-4 mb-4">
            <div class="card h-100 shadow-sm border-0" style="transition: transform 0.3s ease;">
                <div class="card-header bg-primary text-white text-center py-4">
                    <div class="mb-3">
                        <i class="fas fa-info-circle fa-3x"></i>
                    </div>
                    <h3 class="mb-0">About Us</h3>
                </div>
                <div class="card-body p-4">
                    <p class="text-muted mb-4">
                        We are committed to providing exceptional service while maintaining the highest standards of 
                        transparency and user experience. Our mission is to create meaningful connections through 
                        innovative solutions.
                    </p>
                    <div class="highlight-box p-3 mb-3" style="background-color: #f8f9fa; border-left: 4px solid #007bff; border-radius: 0.5rem;">
                        <h6 class="fw-bold text-primary mb-2">Our Vision</h6>
                        <p class="mb-0 small">Building a platform that puts users first, with security, reliability, and innovation at our core.</p>
                    </div>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>User-centric design</li>
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Continuous innovation</li>
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Community focused</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Privacy Section -->
        <div class="col-lg-4 mb-4">
            <div class="card h-100 shadow-sm border-0" style="transition: transform 0.3s ease;">
                <div class="card-header bg-success text-white text-center py-4">
                    <div class="mb-3">
                        <i class="fas fa-shield-alt fa-3x"></i>
                    </div>
                    <h3 class="mb-0">Privacy Policy</h3>
                </div>
                <div class="card-body p-4">
                    <p class="text-muted mb-4">
                        Your privacy is paramount to us. We implement robust security measures and follow industry 
                        best practices to protect your personal information and ensure your data remains secure.
                    </p>
                    <div class="privacy-highlights">
                        <div class="privacy-item mb-3 p-3" style="background-color: #e8f5e8; border-radius: 0.5rem;">
                            <h6 class="fw-bold text-success mb-2">
                                <i class="fas fa-lock me-2"></i>Data Protection
                            </h6>
                            <p class="mb-0 small">End-to-end encryption and secure data storage protocols.</p>
                        </div>
                        <div class="privacy-item mb-3 p-3" style="background-color: #e3f2fd; border-radius: 0.5rem;">
                            <h6 class="fw-bold text-info mb-2">
                                <i class="fas fa-user-shield me-2"></i>Your Rights
                            </h6>
                            <p class="mb-0 small">Full control over your data with easy access, modification, and deletion options.</p>
                        </div>
                        <div class="privacy-item p-3" style="background-color: #fff3e0; border-radius: 0.5rem;">
                            <h6 class="fw-bold text-warning mb-2">
                                <i class="fas fa-eye-slash me-2"></i>No Tracking
                            </h6>
                            <p class="mb-0 small">We don't sell your data or use invasive tracking technologies.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Terms & Conditions Section -->
        <div class="col-lg-4 mb-4">
            <div class="card h-100 shadow-sm border-0" style="transition: transform 0.3s ease;">
                <div class="card-header bg-warning text-white text-center py-4">
                    <div class="mb-3">
                        <i class="fas fa-file-contract fa-3x"></i>
                    </div>
                    <h3 class="mb-0">Terms & Conditions</h3>
                </div>
                <div class="card-body p-4">
                    <p class="text-muted mb-4">
                        Our terms are designed to be fair, transparent, and easy to understand. We believe in 
                        creating a positive environment for all users while maintaining necessary guidelines.
                    </p>
                    <div class="terms-section">
                        <div class="mb-4">
                            <h6 class="fw-bold text-dark mb-2">
                                <i class="fas fa-handshake text-primary me-2"></i>Fair Usage
                            </h6>
                            <p class="small text-muted mb-3">
                                We encourage responsible use of our platform that respects all community members.
                            </p>
                        </div>
                        <div class="mb-4">
                            <h6 class="fw-bold text-dark mb-2">
                                <i class="fas fa-balance-scale text-primary me-2"></i>User Rights
                            </h6>
                            <p class="small text-muted mb-3">
                                Clear guidelines on what you can expect from us and what we expect from you.
                            </p>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-download me-2"></i>Download Full Terms
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Section -->
    <div class="row mt-5" style="">
        <div class="col-12">
            <div class="card bg-light border-0">
                <div class="card-body text-center py-5">
                    <h4 class="mb-3">Questions About Our Policies?</h4>
                    <p class="text-muted mb-4">We're here to help and provide clarity on any aspect of our terms, privacy policy, or services.</p>
                    <div class="row justify-content-center">
                        <div class="col-md-3 col-sm-6 mb-3">
                            <a href="#" class="btn btn-outline-primary w-100">
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

@media (max-width: 768px) {
    .hero-section {
        padding: 3rem 0 !important;
    }
    
    .display-4 {
        font-size: 2rem !important;
    }
}

#footer{
    display: none;
}
</style>

<!-- Add Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<?= $this->endSection() ?>