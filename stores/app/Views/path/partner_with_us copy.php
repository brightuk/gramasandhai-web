<?= $this->extend('templates/layout') ?>
<?= $this->section('content') ?>

<style>
    .partner-us{
        display: none;
    }
</style>

<section class="partner-with-us-section py-5" style="background: linear-gradient(135deg, #f5f9fc 60%, #e8f0ff 40%);">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Partner with Gramasandhai</h2>
            <p class="text-muted">Grow your reach. Empower your business. Join our trusted marketplace today.</p>
        </div>

        <!-- Benefits Section -->
        <div class="row mb-5">
            <div class="col-12">
                <div class="text-center mb-4">
                    <h3 class="fw-bold text-primary">Why Partner With Us?</h3>
                    <p class="text-muted">Discover the benefits of joining Gramasandhai's growing network</p>
                </div>

                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center p-4">
                                <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                    <i class="bi bi-people-fill fs-2 text-white"></i>

                                </div>
                                <h5 class="fw-bold">Wide Customer Base</h5>
                                <p class="text-muted">Access thousands of potential customers actively looking for local products and services.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center p-4">
                                <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                    <i class="bi bi-bar-chart-line-fill fs-2 text-success"></i>
                                </div>
                                <h5 class="fw-bold">Business Growth</h5>
                                <p class="text-muted">Increase your sales and visibility with our marketing support and promotional campaigns.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center p-4">
                                <div class="bg-warning bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                    <i class="bi bi-shield-lock-fill fs-2 text-warning"></i>
                                </div>
                                <h5 class="fw-bold">Secure Platform</h5>
                                <p class="text-muted">Trust in our secure payment system and reliable customer support for your business.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- How It Works Section -->
        <div class="row mb-5">
            <div class="col-12">
                <div class="text-center mb-4">
                    <h3 class="fw-bold text-primary">How It Works</h3>
                    <p class="text-muted">Simple steps to start your partnership with Gramasandhai</p>
                </div>

                <div class="row g-4">
                    <div class="col-md-3">
                        <div class="text-center">
                            <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                                <span class="fw-bold">1</span>
                            </div>
                            <h6 class="fw-bold">Apply Online</h6>
                            <p class="text-muted small">Fill out the partnership application form with your business details</p>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="text-center">
                            <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                                <span class="fw-bold">2</span>
                            </div>
                            <h6 class="fw-bold">Document Verification</h6>
                            <p class="text-muted small">Submit required documents for quick verification process</p>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="text-center">
                            <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                                <span class="fw-bold">3</span>
                            </div>
                            <h6 class="fw-bold">Onboarding</h6>
                            <p class="text-muted small">Get onboarded to our platform with training support</p>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="text-center">
                            <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                                <span class="fw-bold">4</span>
                            </div>
                            <h6 class="fw-bold">Go Live</h6>
                            <p class="text-muted small">Start selling and growing your business with Gramasandhai</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Required Documents Section -->
        <div class="row mb-5">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h4 class="fw-bold text-primary mb-4">Required Documents</h4>
                        <p class="text-muted mb-4">For an easy form filling process, keep these documents handy:</p>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="d-flex align-items-start">
                                    <i class="fas fa-file-alt text-primary mt-1 me-3"></i>
                                    <div>
                                        <h6 class="fw-bold mb-1">FSSAI License Copy</h6>
                                        <p class="text-muted small mb-0">Required for food-related businesses</p>
                                        <a href="https://golegalindia.com/fssai-registration" target="_blank" class="text-decoration-none small">Apply Here</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="d-flex align-items-start">
                                    <i class="fas fa-utensils text-primary mt-1 me-3"></i>
                                    <div>
                                        <h6 class="fw-bold mb-1">Restaurant Menu</h6>
                                        <p class="text-muted small mb-0">Current menu with prices</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="d-flex align-items-start">
                                    <i class="fas fa-university text-primary mt-1 me-3"></i>
                                    <div>
                                        <h6 class="fw-bold mb-1">Bank Details</h6>
                                        <p class="text-muted small mb-0">For seamless payments and settlements</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="d-flex align-items-start">
                                    <i class="fas fa-receipt text-primary mt-1 me-3"></i>
                                    <div>
                                        <h6 class="fw-bold mb-1">GSTIN Certificate</h6>
                                        <p class="text-muted small mb-0">Goods and Services Tax Identification Number</p>
                                        <a href="https://www.inditab.com/gst/gst-registration-online" target="_blank" class="text-decoration-none small">Apply Here</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="d-flex align-items-start">
                                    <i class="fas fa-id-card text-primary mt-1 me-3"></i>
                                    <div>
                                        <h6 class="fw-bold mb-1">PAN Card Copy</h6>
                                        <p class="text-muted small mb-0">Permanent Account Number document</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="d-flex align-items-start">
                                    <i class="fas fa-camera text-primary mt-1 me-3"></i>
                                    <div>
                                        <h6 class="fw-bold mb-1">Business Photos</h6>
                                        <p class="text-muted small mb-0">High-quality images of your establishment</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Application Form -->
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-body p-4">
                        <!-- Step 1: Phone Verification -->
                        <div id="step1">
                            <h4 class="mb-3 text-primary">Ready to Get Started?</h4>
                            <p class="text-muted mb-4">Enter your mobile number to begin your partnership journey with Gramasandhai</p>

                            <form id="phoneForm">
                                <div class="mb-3">
                                    <label for="mobile" class="form-label fw-semibold">Mobile Number</label>
                                    <input type="tel" class="form-control" id="mobile" name="mobile" placeholder="Enter your 10-digit phone number" required>
                                    <div class="form-text">We'll send a verification code to this number</div>
                                </div>
                                <button type="button" class="btn btn-primary w-100 py-2 rounded-3" onclick="verifyPhone()">Continue to Application</button>
                            </form>
                        </div>

                        <!-- Step 2: Full Form (Initially Hidden) -->
                        <div id="step2" style="display: none;">
                            <h4 class="mb-3 text-primary">Complete Your Partnership Application</h4>
                            <p class="text-muted mb-4">Fill in your business details to move forward with the verification process</p>

                            <form id="businessForm">
                                <input type="hidden" id="verified_mobile" name="mobile">

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="name" class="form-label fw-semibold">Full Name</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter your full name" required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="form-label fw-semibold">Email Address</label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your business email" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="business_name" class="form-label fw-semibold">Business Name</label>
                                        <input type="text" class="form-control" id="business_name" name="business_name" placeholder="Your business/restaurant name" required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="business_type" class="form-label fw-semibold">Business Type</label>
                                        <select class="form-select" id="business_type" name="business_type" required>
                                            <option value="">Select business type</option>
                                            <?php foreach ($categories as $category): ?>
                                                <option value="<?= esc($category['id']) ?>"><?= esc($category['label_name']) ?></option>
                                            <?php endforeach; ?>

                                            <option value="other">Other</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">

                                    <!-- FSSAI License Number -->
                                    <div class="col-md-6 mb-3">
                                        <label for="fssai_license_number" class="form-label fw-semibold">
                                            FSSAI License Number
                                        </label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="fssai_license_number"
                                            name="fssai_license_number"
                                            placeholder="Enter your 14-digit FSSAI License Number"
                                            pattern="^[0-9]{14}$"
                                            title="FSSAI License Number must be exactly 14 digits"
                                            maxlength="14"
                                            required>
                                    </div>

                                    <!-- GSTIN Certificate -->
                                    <div class="col-md-6 mb-3">
                                        <label for="gstin_number" class="form-label fw-semibold">
                                            GSTIN Certificate
                                        </label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="gstin_number"
                                            name="gstin_number"
                                            placeholder="Enter your 15-character GSTIN"
                                            pattern="^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$"
                                            title="Enter a valid 15-character GSTIN (e.g., 22AAAAA0000A1Z5)"
                                            maxlength="15"
                                            required>
                                    </div>

                                    <!-- PAN Card -->
                                    <div class="col-md-6 mb-3">
                                        <label for="pancard" class="form-label fw-semibold">
                                            PAN Card
                                        </label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="pancard"
                                            name="pancard"
                                            placeholder="Enter your PAN Card Number"
                                            pattern="^[A-Z]{5}[0-9]{4}[A-Z]{1}$"
                                            title="Enter a valid PAN Number (e.g., ABCDE1234F)"
                                            maxlength="12"
                                            required>
                                    </div>


                                    <div class="col-md-6 mb-3">
                                        <label for="app_login_pass" class="form-label fw-semibold">App Login Password</label>
                                        <input type="password" class="form-control" id="app_login_pass" name="password" placeholder="Enter your app login password" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label fw-semibold">About Your Business</label>
                                    <textarea class="form-control" id="description" name="description" rows="4" placeholder="Tell us about your business, specialties, target customers, etc."></textarea>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <label for="state" class="form-label fw-semibold">State</label>
                                        <select class="form-select" id="state" name="state" required>
                                            <option value="">Select state</option>
                                            <?php foreach ($location['states'] as $state): ?>
                                                <option value="<?= esc($state['id']) ?>"><?= esc($state['state']) ?></option>
                                            <?php endforeach; ?>
                                            <option value="other">Other</option>
                                        </select>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <label for="city" class="form-label fw-semibold">City</label>
                                        <select class="form-select" id="city" name="city" required>
                                            <option value="">Select city</option>
                                            <option value="other">Other</option>
                                        </select>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <label for="area" class="form-label fw-semibold">Area</label>
                                        <select class="form-select" id="area" name="area" required>
                                            <option value="">Select area</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="pincode" class="form-label fw-semibold">Pincode</label>
                                        <input type="text" class="form-control" id="pincode" name="pincode" maxlength="6" minlength="6" placeholder="Enter your pincode" required>
                                    </div>

                                </div>
                                <div class="mb-3">
                                    <label for="Business address" class="form-label fw-semibold">Business address</label>
                                    <textarea class="form-control" id="business_address" name="business_address" rows="4" placeholder="Enter your business address"></textarea>
                                </div>


                                <div class="d-flex gap-2">
                                    <button type="button" class="btn btn-outline-secondary flex-fill py-2 rounded-3" onclick="goBackToStep1()">
                                        <i class="fas fa-arrow-left me-2"></i>Back
                                    </button>
                                    <button type="button" class="btn btn-primary flex-fill py-2 rounded-3" onclick="goToStep3()">
                                        Continue to Documents<i class="fas fa-arrow-right ms-2"></i>
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Step 3: Document Upload (Initially Hidden) -->
                        <div id="step3" style="display: none;">
                            <h4 class="mb-3 text-primary">Upload Required Documents</h4>
                            <p class="text-muted mb-4">Please upload clear copies of the following documents for verification</p>

                            <form action="<?= base_url('join/partner-with-us') ?>" method="post" enctype="multipart/form-data" id="mainForm">
                                <!-- Hidden fields from previous steps -->
                                 
                                <input type="hidden" id="shop_id" name="shop_id">
                                <input type="hidden" id="final_mobile" name="mobile">
                                <input type="hidden" id="final_name" name="name">
                                <input type="hidden" id="final_email" name="email">
                                <input type="hidden" id="final_business_name" name="business_name">
                                <input type="hidden" id="final_business_type" name="business_type">
                                <input type="hidden" id="final_description" name="description">
                                <input type="hidden" id="final_fssai_license_number" name="fssai_license_number">
                                <input type="hidden" id="final_gstin_number" name="gstin_number">
                                <input type="hidden" id="final_app_login_pass" name="password">
                                <input type="hidden" id="final_pancard" name="pancard">
                                <input type="hidden" name="state" id="final_state">
                                <input type="hidden" name="city" id="final_city">
                                <input type="hidden" name="area" id="final_area">
                                <input type="hidden" id="final_business_address" name="business_address">
                                <input type="hidden" id="final_pincode" name="pincode">

                                <div class="mb-4">
                                    <div class="alert alert-info">
                                        <i class="fas fa-info-circle me-2"></i>
                                        <strong>File Requirements:</strong> PDF, JPG, or PNG files only. Maximum file size: 5MB per file.
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- FSSAI License -->
                                    <div class="col-md-6 col-lg-4 mb-4">
                                        <div class="document-upload-card">
                                            <label for="fssai_license_file" class="form-label fw-semibold">FSSAI License Copy <span class="text-danger">*</span></label>
                                            <div class="file-upload-area" data-target="fssai_license_file">
                                                <div class="file-upload-placeholder">
                                                    <i class="fas fa-cloud-upload-alt fa-2x text-muted mb-2"></i>
                                                    <p class="mb-1">Click or drag FSSAI License</p>
                                                    <small class="text-muted">PDF, JPG, PNG (Max 5MB)</small>
                                                </div>
                                                <div class="file-preview" style="display: none;"></div>
                                            </div>
                                            <input type="file" class="form-control d-none" id="fssai_license_file" name="fssai_license_file" accept=".pdf,.jpg,.jpeg,.png" required>
                                            <div class="form-text">Upload clear copy of your FSSAI license certificate</div>
                                        </div>
                                    </div>

                                    <!-- GSTIN Certificate -->
                                    <div class="col-md-6 col-lg-4 mb-4">
                                        <div class="document-upload-card">
                                            <label for="gstin_certificate_file" class="form-label fw-semibold">GSTIN Certificate <span class="text-danger">*</span></label>
                                            <div class="file-upload-area" data-target="gstin_certificate_file">
                                                <div class="file-upload-placeholder">
                                                    <i class="fas fa-cloud-upload-alt fa-2x text-muted mb-2"></i>
                                                    <p class="mb-1">Click or drag GSTIN Certificate</p>
                                                    <small class="text-muted">PDF, JPG, PNG (Max 5MB)</small>
                                                </div>
                                                <div class="file-preview" style="display: none;"></div>
                                            </div>
                                            <input type="file" class="form-control d-none" id="gstin_certificate_file" name="gstin_certificate_file" accept=".pdf,.jpg,.jpeg,.png" required>
                                            <div class="form-text">Upload your GST registration certificate</div>
                                        </div>
                                    </div>

                                    <!-- PAN Card -->
                                    <div class="col-md-6 col-lg-4 mb-4">
                                        <div class="document-upload-card">
                                            <label for="pan_card_file" class="form-label fw-semibold">PAN Card Copy <span class="text-danger">*</span></label>
                                            <div class="file-upload-area" data-target="pan_card_file">
                                                <div class="file-upload-placeholder">
                                                    <i class="fas fa-cloud-upload-alt fa-2x text-muted mb-2"></i>
                                                    <p class="mb-1">Click or drag PAN Card</p>
                                                    <small class="text-muted">PDF, JPG, PNG (Max 5MB)</small>
                                                </div>
                                                <div class="file-preview" style="display: none;"></div>
                                            </div>
                                            <input type="file" class="form-control d-none" id="pan_card_file" name="pan_card_file" accept=".pdf,.jpg,.jpeg,.png" required>
                                            <div class="form-text">Upload front side copy of your PAN card</div>
                                        </div>
                                    </div>

                                    <!-- Restaurant Menu -->
                                    <div class="col-md-6 col-lg-4 mb-4">
                                        <div class="document-upload-card">
                                            <label for="shopping_products_file" class="form-label fw-semibold">Shop Products</label>
                                            <div class="file-upload-area" data-target="shopping_products_file">
                                                <div class="file-upload-placeholder">
                                                    <i class="fas fa-cloud-upload-alt fa-2x text-muted mb-2"></i>
                                                    <p class="mb-1">Click or drag Shop Products</p>
                                                    <small class="text-muted">PDF, JPG, PNG (Max 5MB)</small>
                                                </div>
                                                <div class="file-preview" style="display: none;"></div>
                                            </div>
                                            <input type="file" class="form-control d-none" id="shopping_products_file" name="shopping_products_file" accept=".pdf,.jpg,.jpeg,.png">
                                            <div class="form-text">Upload your current menu with prices</div>
                                        </div>
                                    </div>

                                    <!-- Bank Details -->
                                    <div class="col-md-6 col-lg-4 mb-4">
                                        <div class="document-upload-card">
                                            <label for="bank_details_file" class="form-label fw-semibold">Bank Account Proof</label>
                                            <div class="file-upload-area" data-target="bank_details_file">
                                                <div class="file-upload-placeholder">
                                                    <i class="fas fa-cloud-upload-alt fa-2x text-muted mb-2"></i>
                                                    <p class="mb-1">Click or drag Bank Proof</p>
                                                    <small class="text-muted">PDF, JPG, PNG (Max 5MB)</small>
                                                </div>
                                                <div class="file-preview" style="display: none;"></div>
                                            </div>
                                            <input type="file" class="form-control d-none" id="bank_details_file" name="bank_details_file" accept=".pdf,.jpg,.jpeg,.png">
                                            <div class="form-text">Cancelled cheque or bank statement</div>
                                        </div>
                                    </div>

                                    <!-- Business Photos -->
                                    <div class="col-md-6 col-lg-4 mb-4">
                                        <div class="document-upload-card">
                                            <label for="business_photos_file" class="form-label fw-semibold">Business Photos</label>
                                            <div class="file-upload-area" data-target="business_photos_file" data-multiple="true">
                                                <div class="file-upload-placeholder">
                                                    <i class="fas fa-cloud-upload-alt fa-2x text-muted mb-2"></i>
                                                    <p class="mb-1">Click or drag Business Photos</p>
                                                    <small class="text-muted">JPG, PNG (Max 5MB each)</small>
                                                </div>
                                                <div class="file-preview" style="display: none;"></div>
                                            </div>
                                            <input type="file" class="form-control d-none" id="business_photos_file" name="business_photos_file[]" accept=".jpg,.jpeg,.png" multiple>
                                            <div class="form-text">Upload photos of your establishment</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-check mb-4">
                                    <input class="form-check-input" type="checkbox" id="terms_agreement" name="terms_agreement" required>
                                    <label class="form-check-label" for="terms_agreement">
                                        I agree to Gramasandhai's <a href="<?= base_url() ?>content/terms-of-service" class="text-decoration-none">Terms & Conditions</a> and <a href="<?= base_url() ?>content/privacy-policy" class="text-decoration-none">Privacy Policy</a>
                                    </label>
                                </div>

                                <div class="d-flex gap-2">
                                    <button type="button" class="btn btn-outline-secondary flex-fill py-2 rounded-3" onclick="goBackToStep2()">
                                        <i class="fas fa-arrow-left me-2"></i>Back
                                    </button>
                                    <button type="submit" class="btn btn-success flex-fill py-2 rounded-3">
                                        <i class="fas fa-paper-plane me-2"></i>Submit Application
                                    </button>
                                </div>
                            </form>


                        </div>
                    </div>
                </div>

                <!-- Support Section -->
                <div class="text-center mt-4">
                    <div class="card border-0 bg-light">
                        <div class="card-body py-3">
                            <h6 class="fw-bold mb-2">Need Help?</h6>
                            <p class="text-muted small mb-2">Our partnership team is here to assist you</p>
                            <div class="d-flex justify-content-center gap-3">
                                <small><i class="fas fa-phone text-primary me-1"></i> +91-XXXXXX-XXXX</small>
                                <small><i class="fas fa-envelope text-primary me-1"></i> partners@gramasandhai.com</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .accordion-button:not(.collapsed) {
        background-color: #e3f2fd;
        color: #0d6efd;
    }

    .card {
        transition: transform 0.2s ease-in-out;
    }

    .card:hover {
        transform: translateY(-2px);
    }

    .bg-primary {
        background-color: #0d6efd !important;
    }

    .step-progress {
        display: flex;
        justify-content: space-between;
        margin-bottom: 2rem;
    }

    .step {
        text-align: center;
        flex: 1;
    }

    .step-circle {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: #dee2e6;
        color: #6c757d;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 0.5rem;
        font-weight: bold;
    }

    .step.active .step-circle {
        background-color: #0d6efd;
        color: white;
    }

    .step-line {
        flex: 1;
        height: 2px;
        background-color: #dee2e6;
        margin: 20px 10px 0;
    }

    .document-upload-card {
        border: 2px dashed #dee2e6;
        border-radius: 12px;
        padding: 1.5rem;
        transition: all 0.3s ease;
        background: #f8f9fa;
    }

    .document-upload-card:hover {
        border-color: #0d6efd;
        background: #f0f8ff;
    }

    .document-upload-card.drag-over {
        border-color: #0d6efd;
        background: #e3f2fd;
    }

    .file-upload-area {
        position: relative;
        cursor: pointer;
        min-height: 120px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }

    .file-upload-placeholder {
        color: #6c757d;
    }

    .file-preview {
        width: 100%;
    }

    .preview-item {
        background: white;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        padding: 0.75rem;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .preview-info {
        flex: 1;
        margin-right: 1rem;
    }

    .preview-name {
        font-weight: 500;
        margin-bottom: 0.25rem;
        word-break: break-word;
    }

    .preview-size {
        font-size: 0.875rem;
        color: #6c757d;
    }

    .preview-remove {
        color: #dc3545;
        cursor: pointer;
        padding: 0.25rem;
        border: none;
        background: none;
    }

    .preview-remove:hover {
        color: #b02a37;
    }

    .file-status {
        font-size: 0.875rem;
        margin-top: 0.5rem;
    }

    .file-status.success {
        color: #198754;
    }

    .file-status.error {
        color: #dc3545;
    }
</style>

<script>
    // ==================== LOCATION CASCADE (State -> City -> Area) ====================
// Convert PHP arrays into JavaScript
const districts = <?= json_encode($location['districts']) ?>;
const citylist = <?= json_encode($location['citylist']) ?>;

// Elements
const stateSelect = document.getElementById('state');
const citySelect = document.getElementById('city');
const areaSelect = document.getElementById('area');

// Update cities when state changes
stateSelect.addEventListener('change', () => {
    const stateId = stateSelect.value;

    // Reset city and area
    citySelect.innerHTML = '<option value="">Select city</option>';
    areaSelect.innerHTML = '<option value="">Select area</option>';

    if (!stateId || stateId === 'other') {
        citySelect.insertAdjacentHTML('beforeend', '<option value="other">Other</option>');
        return;
    }

    // Filter cities belonging to this state
    const filteredCities = districts.filter(city => city.state_id == stateId);

    filteredCities.forEach(city => {
        const option = document.createElement('option');
        option.value = city.id;
        option.textContent = city.district_name;
        citySelect.appendChild(option);
    });

    citySelect.insertAdjacentHTML('beforeend', '<option value="other">Other</option>');
});

// Update areas when city changes
citySelect.addEventListener('change', () => {
    const cityId = citySelect.value;

    // Reset area
    areaSelect.innerHTML = '<option value="">Select area</option>';

    if (!cityId || cityId === 'other') return;

    // Filter areas belonging to this city
    const filteredAreas = citylist.filter(area => area.district_id == cityId);

    filteredAreas.forEach(area => {
        const option = document.createElement('option');
        option.value = area.id;
        option.textContent = area.city_name;
        areaSelect.appendChild(option);
    });
});

// ==================== FILE UPLOAD HANDLING ====================
document.addEventListener('DOMContentLoaded', function() {
    // Initialize all file upload areas
    document.querySelectorAll('.file-upload-area').forEach(area => {
        const targetId = area.getAttribute('data-target');
        const fileInput = document.getElementById(targetId);
        const isMultiple = area.getAttribute('data-multiple') === 'true';
        const placeholder = area.querySelector('.file-upload-placeholder');
        const preview = area.querySelector('.file-preview');

        // Click event
        area.addEventListener('click', function(e) {
            if (!e.target.closest('.preview-remove')) {
                fileInput.click();
            }
        });

        // Drag and drop events
        area.addEventListener('dragover', function(e) {
            e.preventDefault();
            area.closest('.document-upload-card').classList.add('drag-over');
        });

        area.addEventListener('dragleave', function(e) {
            e.preventDefault();
            area.closest('.document-upload-card').classList.remove('drag-over');
        });

        area.addEventListener('drop', function(e) {
            e.preventDefault();
            area.closest('.document-upload-card').classList.remove('drag-over');

            const files = e.dataTransfer.files;
            if (files.length > 0) {
                if (isMultiple) {
                    handleMultipleFiles(files, fileInput);
                } else {
                    handleSingleFile(files[0], fileInput);
                }
                updatePreview(fileInput, preview, placeholder);
            }
        });

        // File input change event
        fileInput.addEventListener('change', function(e) {
            updatePreview(fileInput, preview, placeholder);
        });

        // Initialize preview if files already selected
        if (fileInput.files.length > 0) {
            updatePreview(fileInput, preview, placeholder);
        }
    });

    // Add input formatting for mobile number
    const mobileInput = document.getElementById('mobile');
    if (mobileInput) {
        mobileInput.addEventListener('input', function(e) {
            this.value = this.value.replace(/\D/g, '').slice(0, 10);
        });
    }
});

function handleSingleFile(file, fileInput) {
    if (validateFile(file)) {
        const dataTransfer = new DataTransfer();
        dataTransfer.items.add(file);
        fileInput.files = dataTransfer.files;
        return true;
    }
    return false;
}

function handleMultipleFiles(files, fileInput) {
    const dataTransfer = new DataTransfer();

    // Add existing files first
    for (let i = 0; i < fileInput.files.length; i++) {
        dataTransfer.items.add(fileInput.files[i]);
    }

    // Add new valid files (limit to 10 total)
    for (let file of files) {
        if (validateFile(file) && dataTransfer.items.length < 10) {
            dataTransfer.items.add(file);
        }
    }

    fileInput.files = dataTransfer.files;
}

function validateFile(file) {
    const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'application/pdf'];
    const maxSize = 5 * 1024 * 1024; // 5MB

    if (!allowedTypes.includes(file.type)) {
        alert(`Invalid file type: ${file.name}. Please upload only PDF, JPG, or PNG files.`);
        return false;
    }

    if (file.size > maxSize) {
        alert(`File too large: ${file.name}. File size must be less than 5MB.`);
        return false;
    }

    return true;
}

function updatePreview(fileInput, preview, placeholder) {
    const files = fileInput.files;

    if (files.length === 0) {
        preview.style.display = 'none';
        placeholder.style.display = 'block';
        return;
    }

    placeholder.style.display = 'none';
    preview.style.display = 'block';
    preview.innerHTML = '';

    for (let i = 0; i < files.length; i++) {
        const file = files[i];
        const previewItem = document.createElement('div');
        previewItem.className = 'preview-item';

        const fileSize = (file.size / (1024 * 1024)).toFixed(2);
        const fileExtension = file.name.split('.').pop().toUpperCase();

        previewItem.innerHTML = `
            <div class="preview-info">
                <div class="preview-name">${file.name}</div>
                <div class="preview-size">${fileSize} MB • ${fileExtension}</div>
            </div>
            <button type="button" class="preview-remove" data-index="${i}">
                <i class="fas fa-times"></i>
            </button>
        `;

        preview.appendChild(previewItem);
    }

    // Add remove event listeners
    preview.querySelectorAll('.preview-remove').forEach(button => {
        button.addEventListener('click', function(e) {
            e.stopPropagation();
            const index = parseInt(this.getAttribute('data-index'));
            removeFile(fileInput, index);
            updatePreview(fileInput, preview, placeholder);
        });
    });
}

function removeFile(fileInput, index) {
    const dataTransfer = new DataTransfer();

    for (let i = 0; i < fileInput.files.length; i++) {
        if (i !== index) {
            dataTransfer.items.add(fileInput.files[i]);
        }
    }

    fileInput.files = dataTransfer.files;
    fileInput.dispatchEvent(new Event('change', { bubbles: true }));
}

function highlightRequiredField(fieldId) {
    const area = document.querySelector(`[data-target="${fieldId}"]`);
    if (!area) return;

    const card = area.closest('.document-upload-card');
    if (!card) return;

    card.style.borderColor = '#dc3545';
    card.style.background = '#f8d7da';

    setTimeout(() => {
        card.style.borderColor = '';
        card.style.background = '';
    }, 3000);
}

// ==================== PHONE VERIFICATION & EXISTING SHOPS ====================
const existingPhone = <?= $existing_shops ?>;

function verifyPhone() {
    const mobileInput = document.getElementById('mobile');
    const mobile = mobileInput.value.trim();

    if (!mobile) {
        alert('Please enter your mobile number');
        mobileInput.focus();
        return;
    }

    const mobileRegex = /^[6-9]\d{9}$/;
    if (!mobileRegex.test(mobile)) {
        alert('Please enter a valid 10-digit Indian mobile number');
        mobileInput.focus();
        return;
    }

    // Check if phone number already exists (approved shops)
    const phoneExists = existingPhone.some(shop => shop.shop_phone === mobile);
    if (phoneExists) {
        alert('This mobile number is already registered with an active shop. Please use a different number or contact support.');
        mobileInput.focus();
        return;
    }

    checkPendingShop(mobile);
}

function checkPendingShop(mobile) {
    const continueBtn = document.querySelector('button[onclick="verifyPhone()"]');
    const originalBtnText = continueBtn.innerHTML;
    continueBtn.disabled = true;
    continueBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Verifying...';

    fetch('<?= base_url("join/check-pending-shop") ?>', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify({ mobile: mobile })
    })
    .then(response => response.json())
    .then(data => {
        continueBtn.disabled = false;
        continueBtn.innerHTML = originalBtnText;

        if (data.success) {
            // Store the verified mobile number
            document.getElementById('verified_mobile').value = mobile;

            // Show step 2
            document.getElementById('step1').style.display = 'none';
            document.getElementById('step2').style.display = 'block';

            // Fill form with pending data if exists
            if (data.pending === 'yes' && data.shop) {
                setTimeout(() => {
                    fillFormWithPendingData(data.shop);
                    showNotification('We found your previous application. Please review and update if needed.', 'info');
                }, 100);
            }

            document.getElementById('step2').scrollIntoView({ behavior: 'smooth' });
        } else {
            alert(data.message || 'Error verifying phone number');
        }
    })
    .catch(error => {
        continueBtn.disabled = false;
        continueBtn.innerHTML = originalBtnText;
        console.error('Error:', error);
        alert('An error occurred while verifying your phone number. Please try again.');
    });
}

function fillFormWithPendingData(shop) {
    console.log('Filling form with:', shop);

    const fields = {
        name: document.getElementById('name'),
        shop_id: document.getElementById('shop_id'),
        email: document.getElementById('email'),
        business_name: document.getElementById('business_name'),
        business_type: document.getElementById('business_type'),
        description: document.getElementById('description'),
        fssai_license_number: document.getElementById('fssai_license_number'),
        gstin_number: document.getElementById('gstin_number'),
        pancard: document.getElementById('pancard'),
        state: document.getElementById('state'),
        city: document.getElementById('city'),
        area: document.getElementById('area'),
        pincode: document.getElementById('pincode'),
        business_address: document.getElementById('business_address'),
        app_login_pass: document.getElementById('app_login_pass')
    };

    // Fill basic fields
    if (fields.shop_id && shop.id) fields.shop_id.value = shop.id;
    if (fields.name && shop.owner_name) fields.name.value = shop.owner_name;
    if (fields.email && shop.email) fields.email.value = shop.email;
    if (fields.business_name && shop.shop_name) fields.business_name.value = shop.shop_name;
    if (fields.business_type && shop.category_id) fields.business_type.value = shop.category_id;
    if (fields.description && shop.description) fields.description.value = shop.description;
    if (fields.fssai_license_number && shop.fssai_license_number) fields.fssai_license_number.value = shop.fssai_license_number;
    if (fields.gstin_number && shop.gstin_certificate_no) fields.gstin_number.value = shop.gstin_certificate_no;
    if (fields.pancard && shop.pancard_no) fields.pancard.value = shop.pancard_no;
    if (fields.pincode && shop.pincode) fields.pincode.value = shop.pincode;
    if (fields.business_address && shop.shop_address) fields.business_address.value = shop.shop_address;
    if (fields.app_login_pass && shop.password) fields.app_login_pass.value = shop.password;

    // Handle cascading dropdowns
    if (fields.state && shop.state_id) {
        fields.state.value = shop.state_id;
        fields.state.dispatchEvent(new Event('change'));

        setTimeout(() => {
            if (fields.city && shop.city_id) {
                fields.city.value = shop.city_id;
                fields.city.dispatchEvent(new Event('change'));

                setTimeout(() => {
                    if (fields.area && shop.area_id) {
                        fields.area.value = shop.area_id;
                    }
                }, 600);
            }
        }, 600);
    }
}

function showNotification(message, type = 'info') {
    const alertClass = type === 'info' ? 'alert-info' : 
                      type === 'success' ? 'alert-success' : 
                      type === 'warning' ? 'alert-warning' : 'alert-danger';
    
    const notification = document.createElement('div');
    notification.className = `alert ${alertClass} alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3`;
    notification.style.zIndex = '9999';
    notification.style.minWidth = '400px';
    notification.style.maxWidth = '600px';
    notification.innerHTML = `
        <i class="fas fa-info-circle me-2"></i>${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    document.body.appendChild(notification);
    
    setTimeout(() => notification.remove(), 5000);
}

// ==================== STEP NAVIGATION ====================
function goToStep3() {
    const businessForm = document.getElementById('businessForm');
    if (!businessForm) {
        console.error('Business form not found');
        return;
    }
    
    if (!businessForm.checkValidity()) {
        businessForm.reportValidity();
        return;
    }

    // Transfer data from Step 2 to hidden fields in Step 3
    transferDataToStep3();

    // Show step 3
    document.getElementById('step2').style.display = 'none';
    document.getElementById('step3').style.display = 'block';
    document.getElementById('step3').scrollIntoView({ behavior: 'smooth' });
}

function transferDataToStep3() {
    // Get all values from Step 2 form
    const formData = {
        mobile: document.getElementById('verified_mobile').value,
        shop_id: document.getElementById('shop_id') ? document.getElementById('shop_id').value : '',
        name: document.getElementById('name').value,
        email: document.getElementById('email').value,
        business_name: document.getElementById('business_name').value,
        business_type: document.getElementById('business_type').value,
        description: document.getElementById('description').value,
        fssai_license_number: document.getElementById('fssai_license_number').value,
        gstin_number: document.getElementById('gstin_number').value,
        pancard: document.getElementById('pancard').value,
        password: document.getElementById('app_login_pass').value,
        state: document.getElementById('state').value,
        city: document.getElementById('city').value,
        area: document.getElementById('area').value,
        pincode: document.getElementById('pincode').value,
        business_address: document.getElementById('business_address').value
    };

    // Set hidden fields in Step 3
    document.getElementById('final_mobile').value = formData.mobile;
    document.getElementById('shop_id').value = formData.shop_id;
    document.getElementById('final_name').value = formData.name;
    document.getElementById('final_email').value = formData.email;
    document.getElementById('final_business_name').value = formData.business_name;
    document.getElementById('final_business_type').value = formData.business_type;
    document.getElementById('final_description').value = formData.description;
    document.getElementById('final_fssai_license_number').value = formData.fssai_license_number;
    document.getElementById('final_gstin_number').value = formData.gstin_number;
    document.getElementById('final_pancard').value = formData.pancard;
    document.getElementById('final_app_login_pass').value = formData.password;
    document.getElementById('final_state').value = formData.state;
    document.getElementById('final_city').value = formData.city;
    document.getElementById('final_area').value = formData.area;
    document.getElementById('final_pincode').value = formData.pincode;
    document.getElementById('final_business_address').value = formData.business_address;

    console.log('Data transferred to Step 3:', formData);
}

function goBackToStep1() {
    document.getElementById('step1').style.display = 'block';
    document.getElementById('step2').style.display = 'none';
    document.getElementById('step1').scrollIntoView({ behavior: 'smooth' });
}

function goBackToStep2() {
    document.getElementById('step2').style.display = 'block';
    document.getElementById('step3').style.display = 'none';
    document.getElementById('step2').scrollIntoView({ behavior: 'smooth' });
}

// ==================== FINAL FORM SUBMISSION ====================
function handleFinalSubmit(event) {
    event.preventDefault();
    
    const mainForm = document.getElementById('mainForm');
    if (!mainForm) {
        console.error('Main form not found');
        return false;
    }

    // Validate file uploads
    const requiredFiles = ['fssai_license_file', 'gstin_certificate_file', 'pan_card_file'];
    let missingFiles = [];

    requiredFiles.forEach(fieldId => {
        const fileInput = document.getElementById(fieldId);
        if (fileInput && fileInput.files.length === 0) {
            missingFiles.push(fieldId.replace(/_/g, ' ').replace('file', '').toUpperCase());
            highlightRequiredField(fieldId);
        }
    });

    if (missingFiles.length > 0) {
        alert('Please upload all required documents:\n- ' + missingFiles.join('\n- '));
        return false;
    }

    // Check terms agreement
    const termsAgreement = document.getElementById('terms_agreement');
    if (termsAgreement && !termsAgreement.checked) {
        alert('Please agree to the Terms & Conditions and Privacy Policy');
        termsAgreement.focus();
        return false;
    }

    // Show loading state
    const submitBtn = mainForm.querySelector('button[type="submit"]');
    if (submitBtn) {
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Submitting...';
    }

    // Submit the form
    mainForm.submit();
    return true;
}

// Attach submit handler when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    const mainForm = document.getElementById('mainForm');
    if (mainForm) {
        mainForm.addEventListener('submit', handleFinalSubmit);
    }
});
</script>








<?= $this->endSection() ?>