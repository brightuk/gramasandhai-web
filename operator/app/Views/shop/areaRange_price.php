<?= $this->extend('index') ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">
                        <i class="fas fa-map-marked-alt me-2"></i>
                        Area Price Range Entry Form
                    </h3>
                </div>
                
                <div class="card-body">
                    <form method="post" action="<?= site_url('price-ranges/save') ?>">
                        <!-- Area Information -->
                        <div class="mb-4">
                            <h5 class="border-bottom pb-2">
                                <i class="fas fa-location-dot me-2"></i>
                                Area Details
                            </h5>
                            
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="area_name" class="form-label">Area Name*</label>
                                    <input type="text" class="form-control" id="area_name" name="area_name" required
                                           placeholder="e.g. Ramapuram">
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="postal_code" class="form-label">Postal Code</label>
                                    <input type="text" class="form-control" id="postal_code" name="postal_code"
                                           placeholder="Optional postal code">
                                </div>
                            </div>
                        </div>

                        <!-- Price Range Information -->
                        <div class="mb-4">
                            <h5 class="border-bottom pb-2">
                                <i class="fa fa-tags me-2"></i>
                                Price Range
                            </h5>
                            
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label for="min_price" class="form-label">Minimum Price*</label>
                                    <div class="input-group">
                                        <span class="input-group-text">₹</span>
                                        <input type="number" class="form-control" id="min_price" name="min_price" required
                                               min="0" step="1000" placeholder="e.g. 100">
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <label for="avg_price" class="form-label">Average Price*</label>
                                    <div class="input-group">
                                        <span class="input-group-text">₹</span>
                                        <input type="number" class="form-control" id="avg_price" name="avg_price" required
                                               min="0" step="1000" placeholder="e.g. 200">
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <label for="max_price" class="form-label">Maximum Price*</label>
                                    <div class="input-group">
                                        <span class="input-group-text">₹</span>
                                        <input type="number" class="form-control" id="max_price" name="max_price" required
                                               min="0" step="1000" placeholder="e.g. 500">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Coverage Radius -->
                        <div class="mb-4">
                            <h5 class="border-bottom pb-2">
                                <i class="fa fa-ruler-combined me-2"></i>
                                Coverage Details
                            </h5>
                            
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="radius_km" class="form-label">Radius (km)*</label>
                                    <input type="number" class="form-control" id="radius_km" name="radius_km" required
                                           min="1" max="50" placeholder="1-50 km">
                                </div>
                                
                              
                            </div>
                        </div>

                        <!-- Additional Notes -->
                        <div class="mb-4">
                            <label for="notes" class="form-label">Additional Notes</label>
                            <textarea class="form-control" id="notes" name="notes" rows="3"
                                      placeholder="Any special considerations about this area..."></textarea>
                        </div>

                        <!-- Form Actions -->
                        <div class="d-flex justify-content-between mt-4">
                            <button type="reset" class="btn btn-outline-secondary">
                                <i class="fa fa-eraser me-2"></i> Clear Form
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-save me-2"></i> Save Price Range
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