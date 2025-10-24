<?php include(APPPATH . 'Views/templates/config.php'); ?>

<?= $this->extend('templates/layout') ?>
<?= $this->section('content') ?>

<?php if (session()->getFlashdata('success')): ?>
    <div class="flash-popup alert alert-success">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<form id="addShopForm" action="<?= base_url() ?>/shop/add" method="post" enctype="multipart/form-data">
    <div class="container-fluid">
        <h3><?= isset($shop) ? 'Edit' : 'Add' ?> Shop</h3>

        <!-- Shop Basic Information -->
        <div class="row">
            <!-- Shop Name -->
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="shop_name" class="form-label">Shop Name <span class="text-danger">*</span></label>
                    <input type="text" name="shop_name" id="shop_name" class="form-control"
                        value="<?= isset($shop) ? esc($shop['shop_name']) : '' ?>" placeholder="Enter shop name"
                        required maxlength="100">
                    <div class="invalid-feedback">Please enter a shop name.</div>
                </div>
            </div>
            <?php if (isset($shop)): ?>
                <input type="hidden" name="shop_id" value="<?= esc($shop['id']) ?>">
                <input type="hidden" name="old_shop_images" value="<?= esc($shop['shop_images']) ?>">
            <?php endif; ?>
            <!-- Owner Name -->
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="owner_name" class="form-label">Owner Name <span class="text-danger">*</span></label>
                    <input type="text" name="owner_name" id="owner_name" class="form-control"
                        value="<?= isset($shop) ? esc($shop['owner_name']) : '' ?>" placeholder="Enter owner name"
                        required maxlength="50">
                    <div class="invalid-feedback">Please enter owner name.</div>
                </div>
            </div>

            <!-- Email -->
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" id="email" class="form-control"
                        value="<?= isset($shop) ? esc($shop['email']) : '' ?>" placeholder="Enter email" required
                        maxlength="50">
                    <div class="invalid-feedback">Please enter email.</div>
                </div>
            </div>
        </div>

        <!-- Image Upload Section -->
        <div class="row">
            <!-- Shop Logo -->
            <div class="col-md-3">
                <div class="mb-3">
                    <label for="shop_logo" class="form-label">Shop Logo</label>
                    <input type="file" name="shop_logo" id="shop_logo" class="form-control" accept="image/*"
                        onchange="previewImage(this, 'logo_preview')">
                    <div class="mt-2">
                        <img id="logo_preview"
                            src="<?= isset($shop) && $shop['shop_logo'] ? $img_url . $shop['shop_logo'] : '#' ?>"
                            alt="Logo Preview"
                            style="<?= isset($shop['shop_logo']) ? '' : 'display:none;' ?> max-width:100px; max-height:100px; object-fit:cover; border:1px solid #ddd;">
                    </div>
                </div>
            </div>

            <!-- Other Images -->
            <div class="col-md-3">
                <div class="mb-3">
                    <label for="shop_images" class="form-label">Shop Images</label>
                    <input type="file" name="shop_images[]" id="shop_images" class="form-control" accept="image/*"
                        multiple onchange="previewMultipleImages(this, 'images_preview')">
                    <div id="images_preview" class="mt-2 d-flex flex-wrap gap-2">
                        <?php if (isset($shop) && !empty($shop['shop_images'])):
                            $imgs = json_decode($shop['shop_images'], true);
                            if ($imgs):
                                foreach ($imgs as $img): ?>
                                    <img src="<?= $img_url . $img ?>"
                                        style="width:80px; height:80px; object-fit:cover; border:1px solid #ddd; border-radius:4px;">
                                <?php endforeach; endif;
                        endif; ?>
                    </div>
                </div>
            </div>

            <!-- QR Code Image -->
            <div class="col-md-3">
                <div class="mb-3">
                    <label for="qr_image" class="form-label">QR Code Image</label>
                    <input type="file" name="qr_image" id="qr_image" class="form-control" accept="image/*"
                        onchange="previewImage(this, 'qr_preview')">
                    <div class="mt-2">
                        <img id="qr_preview"
                            src="<?= isset($shop) && $shop['qr_img'] ? $img_url . $shop['qr_img'] : '#' ?>"
                            alt="QR Preview"
                            style="<?= isset($shop['qr_img']) ? '' : 'display:none;' ?> max-width:100px; max-height:100px; object-fit:cover; border:1px solid #ddd;">
                    </div>
                </div>
            </div>

            <!-- Generate QR Button -->
            <div class="col-md-3">
                <div class="mb-3">
                    <label class="form-label">&nbsp;</label>
                    <div>
                        <button type="button" class="btn btn-outline-primary btn-sm" onclick="generateQR()">
                            <i class="fas fa-qrcode"></i> Generate QR
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Category & Discount -->
        <div class="row">
            <!-- Category -->
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="shop_category" class="form-label">Shop Category <span
                            class="text-danger">*</span></label>
                    <select id="shop_category" name="shop_category" class="form-control" required>
                        <option value="">-- Select Category --</option>
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?= $cat['id'] ?>" <?= isset($shop) && $shop['category_id'] == $cat['id'] ? 'selected' : '' ?>>
                                <?= esc($cat['label_name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <!-- Discount -->
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="discount" class="form-label">Discount</label>
                    <input type="text" name="discount" id="discount" class="form-control"
                        value="<?= isset($shop) ? esc($shop['discount']) : '' ?>" placeholder="Enter discount"
                        maxlength="10">
                </div>
            </div>

            <?php if (isset($shop)): ?>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="urlname" class="form-label">Url name</label>
                        <input type="text" name="urlname" id="urlname" class="form-control"
                            value="<?= isset($shop) ? esc($shop['url_name']) : '' ?>" placeholder="Enter url name">
                    </div>
                </div>
            <?php endif; ?>

        </div>

        <!-- Location -->
        <div class="row">
            <!-- State -->
            <div class="col-md-2">
                <div class="mb-3">
                    <label for="state_id" class="form-label">State <span class="text-danger">*</span></label>
                    <select name="state_id" id="state_id" class="form-control" required>
                        <option value="">Select State</option>
                        <?php foreach ($states as $state): ?>
                            <option value="<?= $state['id']; ?>" <?= isset($shop) && $shop['state_id'] == $state['id'] ? 'selected' : '' ?>>
                                <?= esc($state['state']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <!-- District -->
            <div class="col-md-2">
                <div class="mb-3">
                    <label class="form-label">District <span class="text-danger">*</span></label>
                    <select name="district_id" id="district_id" class="form-control" required>
                        <option value="">Select District</option>
                        <?php foreach ($districts as $district): ?>
                            <option value="<?= $district['id']; ?>" <?= isset($shop) && $shop['district_id'] == $district['id'] ? 'selected' : '' ?>>
                                <?= esc($district['district_name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <!-- City -->
            <div class="col-md-2">
                <div class="mb-3">
                    <label class="form-label">Area</label>
                    <select name="city_id" id="city_id" class="form-control">
                        <option value="">Select area</option>
                        <?php foreach ($citylist as $city): ?>
                            <option value="<?= $city['id']; ?>" <?= isset($shop) && $shop['city_id'] == $city['id'] ? 'selected' : '' ?>>
                                <?= esc($city['city_name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <!-- Lat/Long -->
            <div class="col-md-2">
                <label class="form-label">Latitude</label>
                <input type="text" name="latitude" id="latitude" class="form-control"
                    value="<?= isset($shop) ? esc($shop['latitude']) : '' ?>" placeholder="00.000000" maxlength="25">
            </div>

            <div class="col-md-2">
                <label class="form-label">Longitude</label>
                <input type="text" name="longitude" id="longitude" class="form-control"
                    value="<?= isset($shop) ? esc($shop['longitude']) : '' ?>" placeholder="00.000000" maxlength="25">
            </div>
        </div>

        <!-- Address, Pincode, Phone -->
        <div class="row">
            <div class="col-md-5">
                <label for="shop_address" class="form-label">Shop Address</label>
                <textarea name="shop_address" id="shop_address" class="form-control" rows="3"
                    placeholder="Enter shop address"
                    maxlength="500"><?= isset($shop) ? esc($shop['shop_address']) : '' ?></textarea>
            </div>
            <div class="col-md-3">
                <label for="pincode" class="form-label">Pincode</label>
                <input type="text" name="pincode" id="pincode" class="form-control"
                    value="<?= isset($shop) ? esc($shop['pincode']) : '' ?>" placeholder="Enter pincode" maxlength="6">
            </div>
            <div class="col-md-2">
                <label for="shop_phone" class="form-label">Contact Number</label>
                <input type="tel" name="shop_phone" id="shop_phone" class="form-control"
                    value="<?= isset($shop) ? esc($shop['shop_phone']) : '' ?>" placeholder="Enter contact number"
                    maxlength="13">
            </div>
        </div>

        <!-- Buttons -->
        <div class="row mt-3">
            <div class="col-md-6">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> <?= isset($shop) ? 'Update Shop' : 'Add Shop' ?>
                </button>
                <button type="reset" class="btn btn-secondary ms-2">
                    <i class="fas fa-undo"></i> Reset
                </button>
                <a href="<?= base_url('shop/list') ?>" class="btn btn-outline-secondary ms-2">
                    <i class="fas fa-arrow-left"></i> Back to List
                </a>
            </div>
        </div>
    </div>
</form>

<div id="toast-container" class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 1055;"></div>
<?php if(isset($shop)): ?>
<script>
    // Pass otherShops data to JavaScript
    const otherShops = <?= json_encode($otherShops) ?>;

    // URL name validation script
    document.addEventListener('DOMContentLoaded', function () {
        const urlnameInput = document.getElementById('urlname');
        if (!urlnameInput) return;

        const form = urlnameInput.closest('form');
        const currentShopId = <?= isset($shop) ? $shop['id'] : 'null' ?>;

        // Create error message element
        const errorDiv = document.createElement('div');
        errorDiv.className = 'text-danger mt-1 small';
        errorDiv.id = 'urlname-error';
        errorDiv.style.display = 'none';
        urlnameInput.parentNode.appendChild(errorDiv);

        // Real-time validation
        urlnameInput.addEventListener('input', validateUrlName);
        urlnameInput.addEventListener('blur', validateUrlName);

        // Form submission validation
        if (form) {
            form.addEventListener('submit', function (e) {
                if (!validateUrlName()) {
                    e.preventDefault();
                    urlnameInput.focus();
                }
            });
        }

        function validateUrlName() {
            const inputValue = urlnameInput.value.trim().toLowerCase();
            const errorElement = document.getElementById('urlname-error');

            // Clear previous error
            errorElement.style.display = 'none';
            errorElement.textContent = '';
            urlnameInput.classList.remove('is-invalid', 'border-danger');

            if (inputValue === '') {
                return true; // Let server handle empty validation
            }

            // Check for duplicates (excluding current shop if editing)
            const isDuplicate = otherShops.some(shop =>
                shop.url_name.toLowerCase() === inputValue &&
                shop.id !== currentShopId
            );

            if (isDuplicate) {
                const conflictShop = otherShops.find(shop =>
                    shop.url_name.toLowerCase() === inputValue
                );

                errorElement.textContent = `URL name already taken by "${conflictShop.shop_name}"`;
                errorElement.style.display = 'block';
                urlnameInput.classList.add('is-invalid', 'border-danger');
                return false;
            }

            // Valid URL name
            urlnameInput.classList.remove('is-invalid', 'border-danger');
            urlnameInput.classList.add('border-success');
            return true;
        }
    });

</script>
<?php endif; ?>


<script>
    
    // Pass PHP arrays into JavaScript
    const locationData = {
        districts: <?= json_encode($districts) ?>,
        citylist: <?= json_encode($citylist) ?>
    };

    // Filter districts when state changes
    document.getElementById('state_id').addEventListener('change', function () {
        const stateId = this.value;
        const districtSelect = document.getElementById('district_id');
        const citySelect = document.getElementById('city_id');

        // Reset dropdowns
        districtSelect.innerHTML = '<option value="">Select District</option>';
        citySelect.innerHTML = '<option value="">Select City</option>';

        if (!stateId) return;

        const filteredDistricts = locationData.districts.filter(d => d.state_id === stateId);

        filteredDistricts.forEach(district => {
            const option = document.createElement('option');
            option.value = district.id;
            option.textContent = district.district_name;
            districtSelect.appendChild(option);
        });
    });

    // Filter cities when district changes
    document.getElementById('district_id').addEventListener('change', function () {
        const districtId = this.value;
        const citySelect = document.getElementById('city_id');

        // Reset cities
        citySelect.innerHTML = '<option value="">Select City</option>';

        if (!districtId) return;

        const filteredCities = locationData.citylist.filter(c => c.district_id === districtId);

        filteredCities.forEach(city => {
            const option = document.createElement('option');
            option.value = city.id;
            option.textContent = city.city_name;
            citySelect.appendChild(option);
        });
    });
</script>

<script>
    // Toast function
    function showToast(message, type = 'info') {
        const bgClass = type === 'success' ? 'bg-success' :
            type === 'error' ? 'bg-danger' :
                type === 'warning' ? 'bg-warning text-dark' :
                    'bg-info';

        const toastId = 'toast-' + Date.now();
        const toastHtml = `
        <div id="${toastId}" class="toast align-items-center text-white ${bgClass} border-0 mb-2" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">${message}</div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    `;

        const toastContainer = document.getElementById('toast-container');
        toastContainer.insertAdjacentHTML('beforeend', toastHtml);

        const toastElement = document.getElementById(toastId);
        const toast = new bootstrap.Toast(toastElement, {
            delay: 3000
        });
        toast.show();

        toastElement.addEventListener('hidden.bs.toast', () => {
            toastElement.remove();
        });
    }

    // Single image preview
    function previewImage(input, previewId) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                const preview = document.getElementById(previewId);
                preview.src = e.target.result;
                preview.style.display = 'block';
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Multiple image preview
    function previewMultipleImages(input, previewContainerId) {
        const container = document.getElementById(previewContainerId);
        container.innerHTML = '';

        if (input.files) {
            Array.from(input.files).forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const imgDiv = document.createElement('div');
                    imgDiv.innerHTML = `
                    <img src="${e.target.result}" alt="Preview ${index + 1}" 
                         style="width: 80px; height: 80px; object-fit: cover; border: 1px solid #ddd; border-radius: 4px;">
                `;
                    container.appendChild(imgDiv);
                }
                reader.readAsDataURL(file);
            });
        }
    }

    // QR generator
    function generateQR() {
        const shopName = document.getElementById('shop_name').value;

        if (!shopName) {
            showToast('Please enter shop name first to generate QR code', 'warning');
            return;
        }

        const baseUrl = window.location.origin;
        const shopSlug = shopName.replace(/\s+/g, '_').toLowerCase();
        const shopUrl = `${baseUrl}/${shopSlug}`;
        const qrApiUrl =
            `https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=${encodeURIComponent(shopUrl)}&format=png`;

        fetch(qrApiUrl)
            .then(response => response.blob())
            .then(blob => {
                const file = new File([blob], `${shopSlug}_qr.png`, {
                    type: 'image/png'
                });
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);

                const qrInput = document.getElementById('qr_image');
                qrInput.files = dataTransfer.files;
                previewImage(qrInput, 'qr_preview');

                showToast('QR code generated successfully! URL: ' + shopUrl, 'success');
            })
            .catch(error => {
                console.error('QR generation failed:', error);
                showToast('Failed to generate QR code. Please check your internet connection.', 'error');
            });
    }

    // Form validation
    document.getElementById('addShopForm').addEventListener('submit', function (e) {
        const shopName = document.getElementById('shop_name').value.trim();
        const ownerName = document.getElementById('owner_name').value.trim();
        const stateId = document.getElementById('state_id').value;
        const districtId = document.getElementById('district_id').value;

        if (!shopName || !ownerName || !stateId || !districtId) {
            e.preventDefault();
            showToast('Please fill in all required fields', 'warning');
            return false;
        }
    });

    // State change (load districts dynamically)
    document.getElementById('state_id').addEventListener('change', function () {
        const stateId = this.value;
        if (stateId) {
            console.log('Loading districts for state ID:', stateId);
        }
    });

    // District change (load cities dynamically)
    document.getElementById('district_id').addEventListener('change', function () {
        const districtId = this.value;
        if (districtId) {
            console.log('Loading cities for district ID:', districtId);
        }
    });
</script>

<?= $this->endSection() ?>