<?= $this->extend('templates/layout') ?>
<?= $this->section('content') ?>

<style>
    .partner-us{
        display: none;
    }

</style>


<?php if (session()->getFlashdata('success')) : ?>
<?php 
    $successData = json_decode(session()->getFlashdata('success'), true);
    $business_name = session()->getFlashdata('business_name') ?? ($successData['business_name'] ?? '');
    $application_id = $successData['application_id'] ?? '';
?>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var applicationId = "<?= $application_id ?>";
        var businessName = "<?= $business_name ?>";
        
        console.log("Application submitted successfully!");
        console.log("Application ID: " + applicationId);
        console.log("Business Name: " + businessName);
        
        // Set cookie via JavaScript (alternative method)
        function setCookie(name, value, days) {
            var expires = "";
            if (days) {
                var date = new Date();
                date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                expires = "; expires=" + date.toUTCString();
            }
            document.cookie = name + "=" + encodeURIComponent(value) + expires + "; path=/; SameSite=Lax";
        }
        
        // Set the cookie with all data
        var cookieData = {
            application_id: applicationId,
            business_name: businessName,
            timestamp: Date.now()
        };
        
        setCookie('registration_success', JSON.stringify(cookieData), 1);
        
        // Update UI with the data
        updateApplicationDetails(cookieData);
    });
    
    function updateApplicationDetails(data) {
        // Update application ID display
        var appIdElements = document.querySelectorAll('.app-id-display');
        appIdElements.forEach(function(el) {
            el.textContent = data.application_id;
        });
        
        // Update business name display
        var businessElements = document.querySelectorAll('.business-display');
        businessElements.forEach(function(el) {
            el.textContent = data.business_name || 'Not provided';
        });
        
        // Show tracking section
        var trackingSection = document.getElementById('trackingSection');
        if (trackingSection) {
            trackingSection.style.display = 'block';
        }
    }
</script>

<?php endif; ?>


<section class="success-section py-5" style="background: linear-gradient(135deg, #f5f9fc 60%, #e8f0ff 40%); min-height: 80vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <!-- Success Icon -->
                <div class="success-icon mb-4">
                    <div class="checkmark-circle">
                        <div class="checkmark draw"></div>
                    </div>
                </div>

                <!-- Success Message -->
                <h1 class="display-5 fw-bold text-success mb-3">Application Submitted Successfully!</h1>
                <p class="lead text-muted mb-4">Thank you for choosing to partner with Gramasandhai. Our team will contact you within 24-48 hours.</p>

                <!-- Personalized Application Details from Cookie -->
                <div id="applicationDetails" class="card border-0 shadow-sm mb-5 " style="display: none;">
                    <div class="card-body p-4">
                        <h4 class="fw-bold text-primary mb-4">Your Application Details</h4>
                        <div class="row  d-flex justify-content-center">
                            <div class="col-md-6 mb-3 ">
                                <strong class="text-muted">Application ID:</strong>
                                <p class="fw-bold" id="appId">GS<?= date('YmdHis') ?></p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong class="text-muted">Business Name:</strong>
                                <p class="fw-bold text-capitalize" id="businessName">-</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong class="text-muted">Submission Date:</strong>
                                <p class="fw-bold"><?= date('F j, Y') ?></p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong class="text-muted">Expected Response:</strong>
                                <p class="fw-bold">Within 48 hours</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Next Steps -->
                <div class="card border-0 shadow-sm mb-5">
                    <div class="card-body p-4">
                        <h4 class="fw-bold text-primary mb-4">What Happens Next?</h4>
                        <div class="row g-4">
                            <div class="col-md-4">
                                <div class="text-center">
                                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                        <i class="bi bi-telephone-fill fs-2 text-primary"></i>
                                    </div>
                                    <h6 class="fw-bold">Verification Call</h6>
                                    <p class="text-muted small">Our team will call you to verify details and answer questions</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="text-center">
                                    <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                        <i class="bi bi-file-earmark-check fs-2 text-success"></i>
                                    </div>
                                    <h6 class="fw-bold">Document Review</h6>
                                    <p class="text-muted small">We'll review your documents and complete background checks</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="text-center">
                                    <div class="bg-warning bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                        <i class="bi bi-person-check fs-2 text-warning"></i>
                                    </div>
                                    <h6 class="fw-bold">Onboarding</h6>
                                    <p class="text-muted small">Get onboarded and start selling on our platform</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="row g-3 mb-5 justify-content-center">
                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center p-4">
                                <i class="fas fa-download fa-2x text-primary mb-3"></i>
                                <h6 class="fw-bold">Download Checklist</h6>
                                <p class="text-muted small mb-3">Get ready for the verification process</p>
                                <button class="btn btn-outline-primary btn-sm">Download PDF</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center p-4">
                                <i class="fas fa-question-circle fa-2x text-primary mb-3"></i>
                                <h6 class="fw-bold">Need Help?</h6>
                                <p class="text-muted small mb-3">Check our FAQ section</p>
                                <a href="<?= base_url() ?>faq" class="btn btn-outline-primary btn-sm">View FAQs</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center p-4">
                                <i class="fas fa-store fa-2x text-primary mb-3"></i>
                                <h6 class="fw-bold">Explore Platform</h6>
                                <p class="text-muted small mb-3">See how Gramasandhai works</p>
                                <a href="<?= base_url() ?>how-it-works" class="btn btn-outline-primary btn-sm">Learn More</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="card border-0 bg-light">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-3">Have Questions?</h5>
                        <p class="text-muted mb-3">Our partnership team is available to assist you</p>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-phone text-primary me-3"></i>
                                    <div>
                                        <small class="text-muted">Call Us</small>
                                        <p class="fw-bold mb-0">+91-XXXXXX-XXXX</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-envelope text-primary me-3"></i>
                                    <div>
                                        <small class="text-muted">Email Us</small>
                                        <p class="fw-bold mb-0">partners@gramasandhai.com</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <div class="d-flex align-items-center justify-content-center">
                                <i class="fas fa-clock text-primary me-2"></i>
                                <small class="text-muted">Available Monday - Saturday, 9:00 AM - 6:00 PM</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- CTA Buttons -->
                <div class="mt-5">
                    <a href="<?= base_url() ?>" class="btn btn-primary btn-lg me-3">
                        <i class="fas fa-home me-2"></i>Back to Home
                    </a>
                    <button id="trackApplication" class="btn btn-outline-primary btn-lg" style="display: none;">
                        <i class="fas fa-tachometer-alt me-2"></i>Track Application
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Function to get cookie value
    function getCookie(name) {
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if (parts.length === 2) return parts.pop().split(';').shift();
    }

    // Check for registration success cookie
    const registrationCookie = getCookie('registration_success');
    
    if (registrationCookie) {
        try {
            const registrationData = JSON.parse(decodeURIComponent(registrationCookie));
            
            // Display personalized application details
            document.getElementById('applicationDetails').style.display = 'block';
            
            // Update application details with cookie data
            if (registrationData.application_id) {
                document.getElementById('appId').textContent = registrationData.application_id;
            }
            
            if (registrationData.business_name) {
                document.getElementById('businessName').textContent = registrationData.business_name;
            }
            
            // Show track application button
            document.getElementById('trackApplication').style.display = 'inline-block';
            document.getElementById('trackApplication').onclick = function() {
                // You can redirect to tracking page or show tracking modal
                window.location.href = '<?= base_url() ?>track-application/' + registrationData.application_id;
            };
            
            // Clear the cookie after displaying (optional)
            // document.cookie = 'registration_success=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
            
        } catch (e) {
            console.error('Error parsing registration cookie:', e);
        }
    }

    // Add some interactive animations
    const cards = document.querySelectorAll('.card');
    cards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
            card.style.transition = 'all 0.5s ease-out';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, 300 + (index * 100));
    });

    // Add confetti effect on page load
    setTimeout(createConfetti, 500);
});

function createConfetti() {
    const colors = ['#28a745', '#0d6efd', '#ffc107', '#dc3545', '#6f42c1'];
    const container = document.querySelector('.success-section');
    
    for (let i = 0; i < 50; i++) {
        const confetti = document.createElement('div');
        confetti.className = 'confetti';
        confetti.style.cssText = `
            position: absolute;
            width: 10px;
            height: 10px;
            background: ${colors[Math.floor(Math.random() * colors.length)]};
            top: -20px;
            left: ${Math.random() * 100}%;
            opacity: 0.7;
            border-radius: 2px;
            animation: fall linear forwards;
            animation-duration: ${Math.random() * 3 + 2}s;
        `;
        
        const style = document.createElement('style');
        style.textContent = `
            @keyframes fall {
                to {
                    transform: translateY(100vh) rotate(${Math.random() * 360}deg);
                    opacity: 0;
                }
            }
        `;
        
        document.head.appendChild(style);
        container.appendChild(confetti);
        
        // Remove confetti after animation
        setTimeout(() => {
            confetti.remove();
            style.remove();
        }, 5000);
    }
}
</script>

<style>
.success-icon {
    display: flex;
    justify-content: center;
    align-items: center;
}

.checkmark-circle {
    width: 120px;
    height: 120px;
    background: #28a745;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    animation: scaleIn 0.5s ease-out;
}

.checkmark {
    width: 60px;
    height: 30px;
    border-left: 4px solid white;
    border-bottom: 4px solid white;
    transform: rotate(-45deg);
    animation: drawCheckmark 0.5s ease-out 0.3s both;
}

@keyframes scaleIn {
    from {
        transform: scale(0);
        opacity: 0;
    }
    to {
        transform: scale(1);
        opacity: 1;
    }
}

@keyframes drawCheckmark {
    from {
        width: 0;
        height: 0;
        opacity: 0;
    }
    to {
        width: 60px;
        height: 30px;
        opacity: 1;
    }
}

.card {
    transition: transform 0.2s ease-in-out;
}

.card:hover {
    transform: translateY(-2px);
}

.btn {
    border-radius: 8px;
    padding: 12px 30px;
    font-weight: 600;
}
</style>

<?= $this->endSection() ?>