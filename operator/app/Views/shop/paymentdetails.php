<?php include(APPPATH . 'Views/templates/config.php'); ?>

<?= $this->extend('templates/layout') ?>
<?= $this->section('content') ?>

<?php if (session()->getFlashdata('success')): ?>
    <div class="flash-popup alert alert-success" style="text-transform: capitalize;">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>
<div class="container payment-container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card shadow-sm payment-card">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">
                        <i class="fas fa-map-marked-alt me-2"></i>
                        Add Payment Details
                    </h3>
                </div>

                <div class="card-body payment-form-body">
                    <form action="<?= base_url('shop/' . $shop_id . '/addPaymentDetails') ?>" method="POST"
                        enctype="multipart/form-data">
                        <!-- Payment Details Section -->
                        <div class="mb-4 payment-section">
                            <h5 class="border-bottom pb-2">
                                <i class="fas fa-location-dot me-2"></i>
                                Payment Details
                            </h5>

                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label for="inputMobile" class="form-label">Mobile Number *</label>
                                    <input type="text" class="form-control payment-mobile" id="inputMobile"
                                        name="mobile_number" required placeholder="e.g. 9876543210" maxlength="10">
                                </div>
                                <div class="col-md-4">
                                    <label for="inputQR" class="form-label">Upi Id *</label>
                                    <div class="input-group">
                                         <input type="text" class="form-control payment-upi" id="upiId"
                                        name="upi_id" required placeholder="e.g. example@upi" maxlength="60">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <label for="inputQR" class="form-label">QR Code *</label>
                                    <div class="input-group">
                                        <input type="file" class="form-control payment-qr" name="qrcode" id="inputQR"
                                            accept="image/*" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex justify-content-between mt-4 payment-buttons">
                            <button type="submit" id="submitPaymentBtn" class="btn btn-primary">
                                <i class="fa fa-save me-2"></i> Save
                            </button>
                            <a type="button" class="btn btn-secondary  text-white"
                                href="<?= base_url('shop/' . $shop_id . '/payment_detail_list') ?> ">
                                Back
                            </a>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>