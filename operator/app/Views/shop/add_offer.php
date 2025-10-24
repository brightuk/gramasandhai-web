<?php include(APPPATH . 'Views/templates/config.php'); ?>

<?= $this->extend('templates/layout') ?>
<?= $this->section('content') ?>

<?php if (session()->getFlashdata('success')): ?>
<div class="flash-popup alert alert-success" style="text-transform: capitalize;">
    <?= session()->getFlashdata('success') ?>
</div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
<div class="flash-popup alert alert-danger" style="text-transform: capitalize;">
    <?= session()->getFlashdata('error') ?>
</div>
<?php endif; ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">
                        <i class="fas fa-map-marked-alt me-2"></i>
                        Offers Form
                    </h3>
                </div>

                <div class="card-body">
                    <form method="post" action="<?= base_url('shop/' . $shop_id . '/addoffer') ?>"
                        enctype="multipart/form-data">
                        <!-- Offer Information -->
                        <div class="mb-4">
                            <h5 class="border-bottom pb-2">
                                <i class="fas fa-location-dot me-2"></i>
                                Add Offer Details
                            </h5>

                            <?php if (isset($offer)): ?>
                            <input type="hidden" name="offerid" value="<?= esc($offer['id']) ?>">
                            <?php endif; ?>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label for="offer_name" class="form-label">Offer Name*</label>
                                    <input type="text" class="form-control" id="offer_name" name="offer_name" required
                                        value="<?= isset($offer) ? esc($offer['name']) : '' ?>"
                                        placeholder="e.g. Summer Sale - 30% Off">
                                </div>

                                <div class="col-md-4">
                                    <label for="offer_label" class="form-label">Label Name</label>
                                    <input type="text" class="form-control" id="offer_label" name="offer_label"
                                        value="<?= isset($offer) ? esc($offer['label']) : '' ?>"
                                        placeholder="e.g. New, Popular, etc">
                                </div>
                                <div class="col-md-4">
                                    <label for="offer_label" class="form-label">Offer Image</label>
                                    <input type="file" class="form-control" id="offer_image" name="offer_image"
                                        <?= isset($offer) ? '' : 'required' ?>>
                                </div>
                                <?php if (isset($offer)): ?>

                                <div class="col-md-12">
                                    <div class="d-flex justify-content-end align-items-center" style="height: 100px; margin-right: 80px;">
                                        <img src="<?= $img_url. $offer['image'] ?>" width="100px" height="100px" alt="">
                                    </div>

                                </div>

                                <?php endif; ?>

                            </div>
                        </div>

                        <!-- Pricing Information -->
                        <div class="mb-4">
                            <h5 class="border-bottom pb-2">
                                <i class="fa fa-tags me-2"></i>
                                Pricing Details
                            </h5>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="offertype" class="form-label">Offer Type*</label>
                                    <div class="input-group">
                                        <span class="input-group-text">₹</span>
                                        <select name="offertype" id="offertype" class="form-select" required>
                                            <option value="1"
                                                <?= (isset($offer) && $offer['type'] == 1) ? 'selected' : '' ?>>
                                                Percentage</option>
                                            <option value="2"
                                                <?= (isset($offer) && $offer['type'] == 2) ? 'selected' : '' ?>>Flat
                                            </option>
                                            <option value="3"
                                                <?= (isset($offer) && $offer['type'] == 3) ? 'selected' : '' ?>>Buy One
                                                Get One</option>
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="discount_price" class="form-label">Discount or Price *</label>
                                    <div class="input-group">
                                        <span class="input-group-text">%/₹</span>
                                        <input type="number" class="form-control" id="discount_precentage"
                                            value="<?= isset($offer) ? esc($offer['offer_value']) : '' ?>"
                                            name="discount_precentage" required value="0" placeholder="e.g. 100">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="original_price" class="form-label">Original Price*</label>
                                    <div class="input-group">
                                        <span class="input-group-text">₹</span>
                                        <input type="number" class="form-control" id="original_price"
                                            value="<?= isset($offer) ? esc($offer['org_price']) : '' ?>"
                                            name="original_price" required placeholder="e.g. 200">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="discount_price" class="form-label">Discount Price*</label>
                                    <div class="input-group">
                                        <span class="input-group-text">₹</span>
                                        <input type="number" class="form-control" id="discount_price"
                                            value="<?= isset($offer) ? esc($offer['disc_price']) : '' ?>"
                                            name="discount_price" required value="0" placeholder="e.g. 100">
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- Offer Duration -->
                        <div class="mb-4">
                            <h5 class="border-bottom pb-2">
                                <i class="fa fa-calendar me-2"></i>
                                Offer Duration
                            </h5>

                            <div class="row g-3">
                                <div class="col-md-3">
                                    <label for="end_date" class="form-label">Offer End Date*</label>
                                    <input type="date" class="form-control" id="end_date" name="end_date" required
                                        value="<?= isset($offer) ? date('Y-m-d', strtotime($offer['endoffer'])) : '' ?>">
                                </div>

                                <div class="col-md-3">
                                    <label for="end_time" class="form-label">Offer End Time*</label>
                                    <input type="time" class="form-control" id="end_time" name="end_time" required
                                        value="<?= isset($offer) ? date('H:i', strtotime($offer['endoffer'])) : '' ?>">
                                </div>

                            </div>

                        </div>

                        <!-- Additional Notes -->
                        <div class="mb-4">
                            <label for="offer_notes" class="form-label">Additional Notes</label>
                            <textarea class="form-control" id="offer_notes" name="offer_notes" rows="3"
                                placeholder="Any special conditions or details about this offer..."><?= isset($offer) ? esc($offer['offer_notes']) : '' ?>
                            </textarea>
                        </div>

                        <!-- Form Actions -->
                        <div class="d-flex justify-content-between mt-4">
                            <button type="reset" class="btn btn-outline-secondary">
                                <i class="fa fa-eraser me-2"></i> Clear Form
                            </button>


                            <a class="btn btn-outline-secondary" href="<?= base_url('shop/' . $shop_id . '/offers') ?>">
                                <i class="fa fa-list me-2"></i> Offers

                            </a>

                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-save me-2"></i> Save Offer
                            </button>
                        </div>
                    </form>
                </div>

                <div class="card-footer text-muted small">
                    <i class="fa fa-info-circle me-2"></i>
                    Fields marked with * are required
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>