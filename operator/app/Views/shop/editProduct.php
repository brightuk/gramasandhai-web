<?= $this->extend('index') ?>

<?= $this->section('content') ?>
<div id="response"></div>
<?php if (session()->getFlashdata('message')) : ?>
    <div class="flash-popup alert alert-success">
        <?= session()->getFlashdata('message') ?>
    </div>
<?php endif; ?>
<h3><?= isset($product) ? 'Edit Product' : 'Add New Product' ?></h3>
<form action="<?= base_url('index.php/saveProduct') ?>" method="post" enctype="multipart/form-data">
    <?= csrf_field() ?>
    
    <?php if (isset($product)): ?>
    <input type="hidden" name="productid" value="<?= esc($product['id']) ?>">
    <?php endif; ?>
    
    <div class="row mb-3">
        <div class="col-md-6">
            <label class="form-label">Product Name <span class="text-danger fs-5">*</span></label>
            <input type="text" class="form-control" name="product_name" required placeholder="Product Name" 
                   value="<?= isset($product) ? esc($product['prod_name']) : '' ?>">
        </div>
        <div class="col-md-3 mt-3">
            <label class="form-label">Type</label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="qtytype" value="1" 
                    <?= (isset($product) && $product['qty_type'] == 1) ? 'checked' : 'checked' ?>>
                <label class="form-check-label">Packet</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="qtytype" value="2"
                    <?= (isset($product) && $product['qty_type'] == 2) ? 'checked' : '' ?>>
                <label class="form-check-label">Loose</label>
            </div>
        </div>
        <div class="col-md-3 mt-3">
            <label class="form-label">Tax</label>
            <select class="form-select" name="tax">
                <option>Select Tax</option>
                <option value="14" <?= (isset($product) && $product['tax_id'] == 14 ? 'selected' : '') ?>>IGST - 18%</option>
                <option value="15" <?= (isset($product) && $product['tax_id'] == 15 ? 'selected' : 'selected') ?>>CGST + SGST - 18%</option>
                <option value="16" <?= (isset($product) && $product['tax_id'] == 16 ? 'selected' : '' )?>>SGST - 9%</option>
                <option value="17" <?= (isset($product) && $product['tax_id'] == 17 ? 'selected' : '') ?>>CGST - 9%</option>
            </select>
        </div>
    </div>

    <div id="variantContainer">
        <?php if (isset($product_variants) && !empty($product_variants)): ?>
            <?php foreach ($product_variants as $key => $variant): ?>
            <div class="row mb-5 variant-row">
                <input type="hidden" name="variantexist[]" value="<?= esc($variant['id']) ?>">
                
                <div class="col-md-2">
                    <label class="form-label">Measurement <span class="text-danger fs-5">*</span></label>
                    <?php $measure_value = filter_var($variant['measure'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION); ?>
                    <input type="number" class="form-control" name="measurement[]" required 
                           value="<?= esc($measure_value) ?>" placeholder="Enter (e.g., 1.5)" step="0.01">
                </div>

                <div class="col-md-1 mt-2">
                    <label class="form-label">Unit</label>
                    <select class="form-select" name="measureUnit[]">
                        <?php
                        $units = ['kg', 'gm', 'ltr', 'ml', 'pack', 'pcs', 'cm', 's', 'M', 'L', 'XL', 'XS', 'XXL', 'XXXL'];
                        $meas_unit = preg_replace('/[^a-zA-Z]/', '', $variant['measure']);
                        foreach ($units as $unit): ?>
                        <option value="<?= $unit ?>" <?= (strtolower($meas_unit) === strtolower($unit)) ? 'selected' : '' ?>>
                            <?= esc($unit) ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="col-md-2">
                    <label class="form-label">Price <span class="text-danger fs-5">*</span></label>
                    <input type="number" class="form-control" name="prices[]" placeholder="₹" 
                           value="<?= esc($variant['price']) ?>" step="0.01" required>
                </div>
                
                <div class="col-md-2 mt-2">
                    <label class="form-label">Discount type:</label>
                    <select name="discount_type[]" class="form-select">
                        <option value="1" <?= $variant['disc_type'] == 1 ? 'selected' : '' ?>>Flat</option>
                        <option value="2" <?= $variant['disc_type'] == 2 ? 'selected' : '' ?>>Percentage</option>
                        <option value="0" <?= $variant['disc_type'] == 0 ? 'selected' : 'selected' ?>>No discount</option>
                    </select>
                </div>
                
                <div class="col-md-2 mt-2">
                    <label class="form-label">Discounted Price (₹):</label>
                    <input type="number" class="form-control" name="discount_price[]" 
                           value="<?= esc($variant['disc_price']) ?>" step="0.01">
                </div>
                
                <div class="col-md-1">
                    <label class="form-label">Stock <span class="text-danger fs-5">*</span></label>
                    <?php $stock_value = filter_var($variant['stock'], FILTER_SANITIZE_NUMBER_INT); ?>
                    <input type="number" class="form-control" name="stock[]" value="<?= $stock_value ?>" required>
                </div>
                
                <div class="col-md-1 mt-2">
                    <label class="form-label">Unit</label>
                    <select class="form-select" name="stock_unit[]">
                        <?php 
                        $stock_unit = preg_replace('/[^a-zA-Z]/', '', $variant['stock']);
                        foreach ($units as $unit): ?>
                        <option value="<?= $unit ?>" <?= (strtolower($stock_unit) === strtolower($unit)) ? 'selected' : '' ?>>
                            <?= esc($unit) ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <?php if ($key === 0): ?>
                <div class="col-md-1 add-button mt-2">
                    <label class="form-label">Variation</label>
                    <div class="ms-2">
                        <button type="button" id="addVariantBtn" class="btn btn-outline-primary">+</button>
                    </div>
                </div>
                <?php else: ?>
                <div class="col-md-1 d-flex align-items-end">
                    <button type="button" class="btn btn-outline-danger remove-btn rounded-circle"><i class="bi bi-x"></i></button>
                </div>
                <?php endif; ?>
                
                <div class="col-md-2 mt-2">
                    <label class="form-label">SKU</label>
                    <input type="text" class="form-control" name="sku_code[]" placeholder="Enter SKU" 
                           value="<?= esc($variant['sku_code']) ?>">
                </div>
                
                <div class="col-md-2 mt-2">
                    <label class="form-label">HSN Code</label>
                    <input type="text" class="form-control" name="hsn_code[]" placeholder="Enter HSN" 
                           value="<?= esc($variant['hsn_code']) ?>">
                </div>
                
                <div class="col-md-2 mt-2">
                    <label class="form-label">Status</label>
                    <select class="form-select" name="status[]">
                        <option value="1" <?= $variant['status'] == 1 ? 'selected' : '' ?>>Available</option>
                        <option value="0" <?= $variant['status'] == 0 ? 'selected' : '' ?>>Unavailable</option>
                    </select>
                </div>
                
                <div class="col-md-5 mt-2">
                    <label class="form-label">Variant Image</label>
                    <input type="file" class="form-control" name="variant_images[]">
                    <?php if (!empty($variant['image'])): ?>
                    <img src="<?= base_url('uploads/variants/' . $variant['image']) ?>" width="50" height="50">
                    <input type="hidden" name="existing_variant_images[]" value="<?= $variant['image'] ?>">
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        <?php else: ?>
            <!-- Default variant row when adding new product -->
            <div class="row mb-5 variant-row">
                <div class="col-md-2">
                    <label class="form-label">Measurement <span class="text-danger fs-5">*</span></label>
                    <input type="number" class="form-control" name="measurement[]" required placeholder="Enter (e.g., 1.5)" step="0.01">
                </div>
                
                <div class="col-md-1 mt-2">
                    <label class="form-label">Unit</label>
                    <select class="form-select" name="measureUnit[]">
                        <option value="kg">kg</option>
                        <option value="gm">gm</option>
                        <option value="ltr">ltr</option>
                        <option value="ml">ml</option>
                        <option value="pack">pack</option>
                        <option value="pcs">pcs</option>
                        <option value="cm">cm</option>
                        <option value="s">s</option>
                        <option value="M">M</option>
                        <option value="L">L</option>
                        <option value="XL">XL</option>
                        <option value="XS">XS</option>
                        <option value="XXL">XXL</option>
                        <option value="XXXL">XXXL</option>
                    </select>
                </div>
                
                <div class="col-md-2">
                    <label class="form-label">Price <span class="text-danger fs-5">*</span></label>
                    <input type="number" class="form-control" name="prices[]" placeholder="₹" step="0.01" required>
                </div>
                
                <div class="col-md-2 mt-2">
                    <label class="form-label">Discount type:</label>
                    <select name="discount_type[]" class="form-select">
                        <option value="1">Flat</option>
                        <option value="2">Percentage</option>
                        <option value="0" selected>No discount</option>
                    </select>
                </div>
                
                <div class="col-md-2 mt-2">
                    <label class="form-label">Discounted Price (₹):</label>
                    <input type="number" class="form-control" name="discount_price[]" step="0.01">
                </div>
                
                <div class="col-md-1">
                    <label class="form-label">Stock <span class="text-danger fs-5">*</span></label>
                    <input type="number" class="form-control" name="stock[]" value="0" required>
                </div>
                
                <div class="col-md-1 mt-2">
                    <label class="form-label">Unit</label>
                    <select class="form-select" name="stock_unit[]">
                        <option value="kg">kg</option>
                        <option value="gm">gm</option>
                        <option value="ltr">ltr</option>
                        <option value="ml">ml</option>
                        <option value="pack">pack</option>
                        <option value="pcs">pcs</option>
                        <option value="cm">cm</option>
                        <option value="s">s</option>
                        <option value="M">M</option>
                        <option value="L">L</option>
                        <option value="XL">XL</option>
                        <option value="XS">XS</option>
                        <option value="XXL">XXL</option>
                        <option value="XXXL">XXXL</option>
                    </select>
                </div>
                
                <div class="col-md-1 add-button mt-2">
                    <label class="form-label">Variation</label>
                    <div class="ms-2">
                        <button type="button" id="addVariantBtn" class="btn btn-outline-primary">+</button>
                    </div>
                </div>
                
                <div class="col-md-2 mt-2">
                    <label class="form-label">SKU</label>
                    <input type="text" class="form-control" name="sku_code[]" placeholder="Enter SKU">
                </div>
                
                <div class="col-md-2 mt-2">
                    <label class="form-label">HSN Code</label>
                    <input type="text" class="form-control" name="hsn_code[]" placeholder="Enter HSN">
                </div>
                
                <div class="col-md-2 mt-2">
                    <label class="form-label">Status</label>
                    <select class="form-select" name="status[]">
                        <option value="1" selected>Available</option>
                        <option value="0">Unavailable</option>
                    </select>
                </div>
                
                <div class="col-md-5 mt-2">
                    <label class="form-label">Variant Image</label>
                    <input type="file" class="form-control" name="variant_images[]">
                </div>
            </div>
        <?php endif; ?>
        
        <div id="variantRowsContainer"></div>
    </div>

    <hr>

    <div class="mb-4">
        <label class="form-label">FSSAI Lic. No.</label>
        <input type="text" class="form-control" name="fssai_no" placeholder="Enter no." 
               value="<?= isset($product) ? esc($product['fssai_no']) : '' ?>">
    </div>

    <div class="row mb-3">
        <div class="col-md-4">
            <label class="form-label">Category</label>
            <select class="form-select" name="category" id="mainCategory">
                <option>--Select Category--</option>
                <?php foreach ($categories as $category) : ?>
                <option value="<?= $category['id'] ?>" 
                    <?= (isset($product) && $product['category_id'] == $category['id'] ? 'selected' : '' )?>>
                    <?= esc($category['category_name']) ?>
                </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-4">
            <label class="form-label">Sub Category</label>
            <select class="form-select" name="sub_category" id="subCategory">
                <option value="">--Select Sub Category--</option>
                <?php foreach ($subcategories as $subcategory) : ?>
                <option value="<?= $subcategory['id'] ?>" 
                    data-main-category="<?= esc($subcategory['main_category']) ?>"
                    <?= (isset($product) && $product['subcategory_id'] == $subcategory['id'] ? 'selected' : '' )?>
                    style="display:none;">
                    <?= esc($subcategory['sub_category_name']) ?>
                </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-4">
            <label class="form-label">Product Type</label>
            <select class="form-select" name="productType">
                <option>--Select Type--</option>
                <option value="1" <?= (isset($product) && $product['prod_type'] == 1 ? 'selected' : 'selected' )?>>Veg</option>
                <option value="2" <?= (isset($product) && $product['prod_type'] == 2 ? 'selected' : '' )?>>Non-Veg</option>
                <option value="0" <?= (isset($product) && $product['prod_type'] == 0 ? 'selected' : '' )?>>No type</option>
            </select>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <label class="form-label">Manufacturer</label>
            <input type="text" class="form-control" name="manufacturer" 
                   value="<?= isset($product) ? esc($product['manufacturer']) : '' ?>">
        </div>
        <div class="col-md-6">
            <label class="form-label">Made In</label>
            <input type="text" class="form-control" name="made_in" 
                   value="<?= isset($product) ? esc($product['made_in']) : 'India' ?>">
        </div>
    </div>

    <div class="row mb-3 ms-4">
        <div class="col-md-3 form-check form-switch">
            <input class="form-check-input" type="checkbox" name="returnable" value="1"
                <?= (isset($product) && $product['return_status'] == 1) ? 'checked' : 'checked' ?>>
            <label class="form-check-label">Is Returnable?</label>
        </div>
        <div class="col-md-3 form-check form-switch">
            <input class="form-check-input" type="checkbox" name="cancelable" value="1"
                <?= (isset($product) && $product['cancelable_status'] == 1) ? 'checked' : 'checked' ?>>
            <label class="form-check-label">Is Cancel-able?</label>
        </div>
        <div class="col-md-3 form-check form-switch">
            <input class="form-check-input" type="checkbox" name="cod_allowed" value="1"
                <?= (isset($product) && $product['cod_allowed'] == 1) ? 'checked' : 'checked' ?>>
            <label class="form-check-label">Is COD Allowed?</label>
        </div>
        <div class="col-md-3">
            <label class="form-label">Total Allowed Quantity</label>
            <input type="number" class="form-control" name="total_quantity" 
                   value="<?= isset($product['total_allowed_quantity']) ? esc($product['total_allowed_quantity']) : '' ?>" 
                   placeholder="Leave blank if unlimited">
        </div>
    </div>

    <div class="mb-3 col-md-6">
        <div class="col-md-4">
            <label class="form-label">Main Image</label><br>
            <img id="preview_main" src="<?= isset($product) ? base_url('uploads/products/' . $product['main_image']) : '' ?>" 
                 width="150" height="80" alt="Main Image">
        </div>
        <div class="col-md-8">
            <label>Change Image</label>
            <label for="main_image"
                style="border: 2px dotted #ccc; padding: 20px; text-align: center; display: block; border-radius: 10px; cursor: pointer;">
                <strong>Click to Upload</strong><br>
                <span class="text-muted">Main Image (jpg, png, etc.)</span>
            </label>
            <input type="file" class="form-control mt-2" name="main_image" id="main_image" hidden accept="image/*"
                onchange="showPreview(event, 'preview_main')">
            <?php if (isset($product) && !empty($product['main_image'])): ?>
            <input type="hidden" name="existing_main_image" value="<?= $product['main_image'] ?>">
            <?php endif; ?>
        </div>
    </div>

    <div class="mb-3 col-md-6">
        <div class="col-md-4">
            <label class="form-label">Other Images of the Product</label><br>
            <?php if (isset($product) && !empty($product['other_images'])): ?>
                <?php 
                $other_images = explode(',', $product['other_images']);
                foreach ($other_images as $image): ?>
                    <img src="<?= base_url('uploads/products/' . $image) ?>" width="50" height="50" class="me-2">
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div class="col-md-8">
            <label>Change Image</label>
            <label for="other_images"
                style="border: 2px dotted #ccc; padding: 20px; text-align: center; display: block; border-radius: 10px; cursor: pointer;">
                <strong>Click to Upload</strong><br>
                <span class="text-muted">Other Image (jpg, png, etc.)</span>
            </label>
            <input type="file" class="form-control mt-2" name="other_images[]" id="other_images" hidden accept="image/*"
                onchange="showPreview(event, 'preview_other')" multiple>
            <?php if (isset($product) && !empty($product['other_images'])): ?>
            <input type="hidden" name="existing_other_images" value="<?= $product['other_images'] ?>">
            <?php endif; ?>
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Size Chart</label>
        <input type="file" class="form-control" name="size_chart">
        <?php if (isset($product) && !empty($product['size_chart'])): ?>
            <a href="<?= base_url('uploads/size_charts/' . $product['size_chart']) ?>" target="_blank">View Current Size Chart</a>
            <input type="hidden" name="existing_size_chart" value="<?= $product['size_chart'] ?>">
        <?php endif; ?>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Description :</label>
        <textarea class="form-control" id="description" rows="3" name="product_description"><?= isset($product) ? esc($product['description']) : '' ?></textarea>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Shipping Policy :</label>
        <textarea class="form-control" id="description" rows="3" name="shippingPolicy"><?= isset($product) ? esc($product['shipping_policy']) : '' ?></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>
<div id="response"></div>

<script>
document.getElementById('mainCategory').addEventListener('change', function() {
    var selectedText = this.options[this.selectedIndex].text;
    var subCategorySelect = document.getElementById('subCategory');
    var options = subCategorySelect.options;

    // Show all options first
    for (var i = 0; i < options.length; i++) {
        options[i].style.display = 'none';
    }

    // Show only relevant options
    for (var i = 0; i < options.length; i++) {
        var option = options[i];
        if (option.dataset.mainCategory && option.dataset.mainCategory === selectedText) {
            option.style.display = 'block';
        }
    }
    
    // Trigger the change event to update the display
    subCategorySelect.value = '';
});

// Initialize the subcategory display on page load
document.addEventListener('DOMContentLoaded', function() {
    var mainCategory = document.getElementById('mainCategory');
    if (mainCategory) {
        mainCategory.dispatchEvent(new Event('change'));
    }
});

function showPreview(event, previewId) {
    const input = event.target;
    const reader = new FileReader();
    reader.onload = function() {
        const preview = document.getElementById(previewId);
        preview.src = reader.result;
    };
    if (input.files && input.files[0]) {
        reader.readAsDataURL(input.files[0]);
    }
}

const variantRowsContainer = document.getElementById('variantRowsContainer');
const addVariantRowBtn = document.getElementById('addVariantBtn');

function createVariantRow() {
    const row = document.createElement('div');
    row.classList.add('row', 'mb-5', 'variant-row');

    row.innerHTML = `
        <div class="col-md-2">
            <label class="form-label">Measurement <span class="text-danger fs-5">*</span></label>
            <input type="number" class="form-control" name="measurement[]" placeholder="Enter (e.g., 1.5)" step="0.01" required>
        </div>
        <div class="col-md-1 mt-2">
            <label class="form-label">Unit</label>
            <select class="form-select" name="measureUnit[]">
                ${getUnitOptions()}
            </select>
        </div>
        <div class="col-md-2">
            <label class="form-label">Price <span class="text-danger fs-5">*</span></label>
            <input type="number" class="form-control" name="prices[]" placeholder="₹" step="0.01" required>
        </div>
        <div class="col-md-2 mt-2">
            <label class="form-label">Discount type:</label>
            <select name="discount_type[]" class="form-select">
                <option value="1">Flat</option>
                <option value="2">Percentage</option>
                <option selected value="0">No discount</option>
            </select>
        </div>
        <div class="col-md-2 mt-2">
            <label class="form-label">Discounted Price (₹):</label>
            <input type="number" class="form-control" name="discount_price[]" placeholder="" step="0.01">
        </div>
        <div class="col-md-1">
            <label class="form-label">Stock <span class="text-danger fs-5">*</span></label>
            <input type="number" class="form-control" name="stock[]" value="0" required>
        </div>
        <div class="col-md-1 mt-2">
            <label class="form-label">Unit</label>
            <select class="form-select" name="stock_unit[]">
                ${getUnitOptions()}
            </select>
        </div>
        <div class="col-md-2 mt-2">
            <label class="form-label">SKU</label>
            <input type="text" class="form-control" name="sku_code[]" placeholder="Enter SKU">
        </div>
        <div class="col-md-2 mt-2">
            <label class="form-label">HSN Code</label>
            <input type="text" class="form-control" name="hsn_code[]" placeholder="Enter HSN">
        </div>
        <div class="col-md-2 mt-2">
            <label class="form-label">Status</label>
            <select class="form-select" name="status[]">
                <option value="1">Available</option>
                <option value="0">Unavailable</option>
            </select>
        </div>
        <div class="col-md-5 mt-2">
            <label class="form-label">Variant Image</label>
            <input type="file" class="form-control" name="variant_images[]">
        </div>
        <div class="col-md-1 d-flex align-items-end">
            <button type="button" class="btn btn-outline-danger remove-btn rounded-circle"><i class="bi bi-x"></i></button>
        </div>
    `;

    variantRowsContainer.appendChild(row);
}

function getUnitOptions() {
    const units = ["kg", "gm", "ltr", "ml", "pack", "pcs", "cm", "s", "M", "L", "XL", "XS", "XXL", "XXXL"];
    return units.map(u => `<option value="${u}">${u}</option>`).join('');
}

addVariantRowBtn?.addEventListener('click', () => {
    createVariantRow();
});

// Handle remove button clicks for both existing and new variant rows
document.getElementById('variantContainer').addEventListener('click', function(e) {
    if (e.target.classList.contains('remove-btn') || e.target.closest('.remove-btn')) {
        const row = e.target.closest('.variant-row');
        
        // If this is an existing variant, add a hidden field to mark it for deletion
        const variantIdInput = row.querySelector('input[name="variantexist[]"]');
        if (variantIdInput) {
            const deletedFlag = document.createElement('input');
            deletedFlag.type = 'hidden';
            deletedFlag.name = 'deleted_variants[]';
            deletedFlag.value = variantIdInput.value;
            row.appendChild(deletedFlag);
            row.style.display = 'none'; // Hide instead of remove to preserve data
        } else {
            row.remove(); // For new rows that weren't saved yet
        }
    }
});
</script>

<?= $this->endSection() ?>