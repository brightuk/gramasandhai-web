<?php include(APPPATH . 'Views/templates/config.php'); ?>
<?= $this->extend('templates/layout') ?>
<?= $this->section('content') ?>
<title><?= isset($slider) ? 'Edit Banner' : 'Add Banner' ?></title>

<?php if (session()->getFlashdata('success')): ?>
    <div class="flash-popup success">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')): ?>
    <div class="flash-popup error">
        <?= session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>
<style>
    .flash-popup {
        position: fixed;
        top: 40px;
        left: 56%;
        transform: translateX(-50%);
        padding: 15px 25px;
        border-radius: 8px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        z-index: 9999;
        text-align: center;
        min-width: 250px;
        max-width: 80%;
        animation: fadeOut 4s forwards;
        display: flex;
        align-items: center;
        gap: 10px;
    }
</style>



<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0"><?= isset($banners) ? 'Edit Banner' : 'Add Banner' ?></h5>
    </div>
    <div class="card-body">
        <form action="<?= base_url() ?>banner/add" method="post" enctype="multipart/form-data">
            <?php if (isset($banners)): ?>
                <input type="hidden" name="id" value="<?= esc($banners['id']) ?>">
            <?php endif; ?>

            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="shop_id" class="form-label">Choose Shop <span class="text-danger">*</span></label>
                        <select name="shop_id" id="shop_id" class="form-control" required <?= isset($banners) ? '' : '' ?> >
                            <option value="">Select Shop</option>
                            <?php foreach ($shoplist as $shop): ?>
                                <option value="<?= $shop['id']; ?>" <?= (isset($banners) && $banners['shop_id'] == $shop['id']) ? 'selected' : '' ?>>
                                    <?= esc($shop['shop_name'] ?? $shop['shop_name']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">Please select a state.</div>
                    </div>
                </div>

                <div class="col-md-12 col-lg-4">
                    <div class="mb-3">
                        <label for="labelname" class="form-label">Label name</label>
                        <input type="text" class="form-control" id="labelname" name="labelname"
                            placeholder="Enter Label name"
                            value="<?= isset($banners) ? esc($banners['label_name']) : '' ?>">
                    </div>
                </div>

                <div class="col-md-12 col-lg-4">
                    <div class="mb-3">
                        <label for="banner_image" class="form-label">Banner Image</label>
                        <input type="file" class="form-control" id="banner_image" name="banner_image" accept="image/*"<?= isset($banners) ? '' : 'required' ?> >
                        <small class="text-muted">
                            *Recommended: JPG/PNG format, max 2MB.
                        </small>
                        <div class="mt-2">
                            <?php if (isset($banners) && !empty($banners['image'])): ?>
                                <img id="previewImage" style ="position: absolute;right: 10%;bottom: 20px; height: 120px; width: 200px;" 
                                    src="<?= $img_url. $banners['image'] ?>"
                                    alt="Current slide Image" class="img-thumbnail" style="max-height: 150px;">
                            <?php endif; ?>
                        </div>
                        <div class="invalid-feedback" id="imageFeedback"></div>
                    </div>
                </div>
                <div class="mb-3 col-md-12 col-lg-8">
                    <label for="link" class="form-label">Link</label>
                    <input type="url" class="form-control" id="link" name="banner_link"
                        placeholder="Enter URL (e.g., https://example.com)" pattern="https?://.+"
                        value="<?= isset($banners) ? esc($banners['banner_link']) : '' ?>"
                        title="Please enter a valid URL including http:// or https://">
                    <div class="invalid-feedback">Please enter a valid URL (must start with http:// or https://)</div>
                </div>


                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary">
                        <?= isset($slider) ? 'Update' : 'Submit' ?>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const urlInput = document.getElementById('link');

        urlInput.addEventListener('input', function () {
            if (urlInput.validity.typeMismatch) {
                urlInput.setCustomValidity('Please enter a valid URL (e.g., https://example.com)');
            } else {
                urlInput.setCustomValidity('');
            }
        });

        // Optional: Add validation on form submission
        const form = urlInput.closest('form');
        if (form) {
            form.addEventListener('submit', function (e) {
                if (!urlInput.checkValidity()) {
                    e.preventDefault();
                    urlInput.classList.add('is-invalid');
                }
            });
        }
    });
</script>


<?= $this->endSection() ?>