<?php include(APPPATH . 'Views/templates/config.php'); ?>
<?= $this->extend('templates/layout') ?>

<?= $this->section('content') ?>
<div id="response"></div>
<?php if (session()->getFlashdata('message')): ?>
    <div class="flash-popup alert alert-success">
        <?= session()->getFlashdata('message') ?>
    </div>
<?php endif; ?>
<h3> <?= isset($product) ? 'Edit Product' : 'Add New Product' ?> </h3>

<form action="<?= base_url('shop/' . $shop_id . '/saveProduct') ?>" method="Post" enctype="multipart/form-data">
    <?= csrf_field() ?>

    <?php if (isset($product)): ?>
        <input type="hidden" name="productid" value="<?= esc($product['id']) ?>">

    <?php endif; ?>
    <div class="row mb-3">
        <div class="col-md-6">
            <label class="form-label">Product Name <span class="text-danger fs-5">*</span></label>
            <input type="text" class="form-control" name="product_name" required placeholder="Product Name" value="">
        </div>
        <div class="col-md-3 mt-3">
            <label class="form-label">Is Variant</label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="is_variant" value="1" checked>
                <label class="form-check-label">Yes</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="is_variant" value="0">
                <label class="form-check-label">No</label>
            </div>
        </div>
        <div class="col-md-3 mt-3">
            <label class="form-label">Type</label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="qtytype" value="1" checked>
                <label class="form-check-label">Packet</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="qtytype" value="2">
                <label class="form-check-label">Loose</label>
            </div>
        </div>

        <div class="col-md-3 mt-3 d-none">
            <label class="form-label">Tax</label>
            <select class="form-select" name="tax">
                <option>Select Tax</option>
                <option value="14">IGST - 18%</option>
                <option selected value="15">CGST + SGST - 18%</option>
                <option value="16">SGST - 9%</option>
                <option value="17">CGST - 9%</option>
            </select>
        </div>
    </div>
    <h4 class="text-muted variantplace " id="variantplace">Variants</h4>
    <div id="variantContainer">
        <div class="row mb-5 variant-row">
            <div class="col-md-2">
                <label class="form-label">Measurement <span class="text-danger fs-5">*</span></label>
                <input type="number" class="form-control" name="measurement[]" value="" placeholder="Enter (e.g., 1.5)">
            </div>
            <?php if (isset($product)): ?>
                <input type="hidden" name="variantexist[]" value="<?= esc($product['id']) ?>">

            <?php endif; ?>
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

                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label">Price <span class="text-danger fs-5">*</span></label>
                <input type="number" class="form-control" name="prices[]" placeholder="₹" value="">
            </div>

            <div class="col-md-2 mt-2">
                <label class="form-label">SKU</label>
                <input type="text" class="form-control" name="sku_code[]" placeholder="Enter SKU" value="">
            </div>
            <div class="col-md-2 mt-2">
                <label class="form-label">HSN Code</label>
                <input type="text" class="form-control" name="hsn_code[]" placeholder="Enter HSN" value="">
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

                </select>
            </div>
            <div class="col-md-1 add-button mt-2">
                <label class="form-label">Variation</label>
                <div class="ms-2">
                    <button type="button" id="addVariantBtn" class="btn btn-outline-primary">+</button>
                </div>
            </div>
            <div class="col-md-2 mt-2">
                <label class="form-label">Discount type:</label>
                <select name="discount_type[]" class="form-select discount-type">
                    <option value="1">Flat</option>
                    <option value="2">Percentage</option>
                    <option value="0">No discount</option>

                </select>
            </div>
            <div class="col-md-2 mt-2 discount-price-wrapper">
                <label class="form-label">Discounted Price (₹):</label>
                <input type="number" class="form-control discount-price" name="discount_pricehide[]" placeholder=""
                    value="" />
            </div>

            <div class="col-md-2 mt-2">
                <label class="form-label">Status</label>
                <select class="form-select" name="status[]">
                    <option value="1">Available</option>
                    <option value="0">Unavailable</option>
                </select>
            </div>
            <div class="col-md-5 mt-2">
                <label class="form-label">Image (Use a square image between 350×350 and 550×550 pixels)</label>
                <input type="file" class="form-control" name="variant_images[]">
            </div>
            <div class="col-md-1 d-flex align-items-end">
                <button type="button" class="btn btn-danger remove-btn d-none">-</button>
            </div>
        </div>
    </div>

    <hr>

    <div class="mb-4">
        <label class="form-label">FSSAI Lic. No.</label>
        <input type="text" class="form-control" name="fssai_no" placeholder="Enter no." value="">
    </div>

    <div class="row mb-3">
        <div class="col-md-4">
            <label class="form-label">Category</label>
            <select class="form-select" name="category" id="mainCategory" required>
                <option>--Select Category--</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category['category_id'] ?>"><?= $category['category_name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-4">
            <label class="form-label">Sub Category</label>
            <select class="form-select" name="sub_category" id="subCategory" required>
                <option value="">--Select Sub Category--</option>
                <?php foreach ($subcategories as $subcategory): ?>
                    <option value="<?= $subcategory['subcategory_id'] ?>" data-main-category="<?= $subcategory['main_category'] ?>"
                        style="display:none;">
                        <?= $subcategory['sub_category_name'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-4">
            <label class="form-label">Product Type</label>
            <select class="form-select" name="productType">
                <option>--Select Type--</option>
                <option selected value="1">Veg</option>
                <option value="2">Non-Veg</option>
                <option value="0">No type</option>
            </select>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <label class="form-label">Manufacturer</label>
            <input type="text" class="form-control" name="manufacturer" value="">
        </div>
        <div class="col-md-6">
            <label class="form-label">Made In</label>
            <input type="text" class="form-control" name="made_in" value="India">
        </div>
    </div>

    <div class="row mb-3 ms-4">
        <div class="col-md-3 form-check form-switch">
            <input class="form-check-input" type="checkbox" name="returnable" value="1" checked>
            <label class="form-check-label">Is Returnable?</label>
        </div>
        <div class="col-md-3 form-check form-switch">
            <input class="form-check-input" type="checkbox" name="cancelable" value="1" checked>
            <label class="form-check-label">Is Cancel-able?</label>
        </div>
        <div class="col-md-3 form-check form-switch">
            <input class="form-check-input" type="checkbox" name="cod_allowed" value="1" checked>
            <label class="form-check-label">Is COD Allowed?</label>
        </div>
        <div class="col-md-3">
            <label class="form-label">Total Allowed Quantity</label>
            <input type="number" class="form-control" name="total_quantity" placeholder="Leave blank if unlimited">
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Main Image *</label>
        <input type="file" class="form-control" name="main_image">
    </div>

    <div class="mb-3">
        <label class="form-label">Other Images of the Product</label>
        <input type="file" class="form-control" name="other_images[]" multiple>
    </div>

    <div class="mb-3">
        <label class="form-label">Size Chart</label>
        <input type="file" class="form-control" name="size_chart">
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Description :</label>
        <textarea class="form-control" id="description" rows="3" name="product_description"></textarea>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Shipping Policy :</label>
        <textarea class="form-control" id="description" rows="3" name="shippingPolicy"></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>
<div id="response"></div>



<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.addEventListener("change", function(e) {
            if (e.target && e.target.classList.contains("discount-type")) {
                const discountSelect = e.target;
                // locate the related price input in the same row
                const discountPriceWrapper = discountSelect.closest(".row").querySelector(
                    ".discount-price-wrapper");
                const discountPriceInput = discountPriceWrapper.querySelector(".discount-price");

                if (discountSelect.value === "0") {
                    discountPriceWrapper.style.display = "none";
                    discountPriceInput.name = "discount_pricehide[]";
                } else {
                    discountPriceWrapper.style.display = "block";
                    discountPriceInput.name = "discount_price[]";
                }
            }
        });

        // run once for existing items
        document.querySelectorAll(".discount-type").forEach(function(select) {
            const discountPriceWrapper = select.closest(".row").querySelector(".discount-price-wrapper");
            const discountPriceInput = discountPriceWrapper.querySelector(".discount-price");
            if (select.value === "0") {
                discountPriceWrapper.style.display = "none";
                discountPriceInput.name = "discount_pricehide[]";
            } else {
                discountPriceWrapper.style.display = "block";
                discountPriceInput.name = "discount_price[]";
            }
        });
    });


    document.getElementById('mainCategory').addEventListener('change', function() {
        var selectedText = this.options[this.selectedIndex].text;
        var subCategorySelect = document.getElementById('subCategory');
        var options = subCategorySelect.options;

        subCategorySelect.value = '';
        for (var i = 0; i < options.length; i++) {
            var option = options[i];
            if (!option.dataset.mainCategory) continue;

            if (option.dataset.mainCategory === selectedText) {
                option.style.display = 'block';
            } else {
                option.style.display = 'none';
            }
        }
    });

    const variantContainer = document.getElementById('variantContainer');
    const addVariantBtn = document.getElementById('addVariantBtn');

    addVariantBtn.addEventListener('click', () => {
        const lastRow = variantContainer.querySelector('.variant-row:last-of-type');
        const newRow = lastRow.cloneNode(true);

        newRow.querySelectorAll('input').forEach(input => {
            input.value = '';
        });

        newRow.querySelectorAll('select').forEach(select => {
            select.selectedIndex = 0;
        });

        newRow.querySelector('.remove-btn').classList.remove('d-none');
        const addBtn = newRow.querySelector('.add-button');
        if (addBtn) addBtn.classList.add('d-none');

        variantContainer.appendChild(newRow);
    });

    variantContainer.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-btn') || e.target.closest('.remove-btn')) {
            e.target.closest('.variant-row').remove();
        }
    });

    // Handle hide/show when selecting Yes/No for Variant
    document.addEventListener("change", function(e) {
        if (e.target && e.target.name === "is_variant") {
            const isVariant = e.target.value;
            const addButtonColumn = document.querySelector(".add-button");
            const removeButtons = document.querySelectorAll(".remove-btn");

            const variantplace = document.querySelector(".variantplace");

            if (isVariant === "0") {
                // hide + button and remove buttons
                addButtonColumn.classList.add("d-none");
                variantplace.classList.add("d-none");
                // removeButtons.forEach(btn => btn.classList.add("d-none"));

                // Optional: If No variant -> keep only ONE variant row
                const rows = document.querySelectorAll(".variant-row");
                rows.forEach((row, index) => {
                    if (index > 0) row.remove(); // remove extra variants
                });
            } else {
                // show + button
                addButtonColumn.classList.remove("d-none");
                variantplace.classList.remove("d-none");

                // removeButtons.forEach(btn => btn.classList.remove("d-none"));
            }
        }
    });








    // const subCategory_Form = document.getElementById('subCategory_Form');
    // const API_KEY = 'SEC195C79FC4CCB09B48AA8';
    // const API_URL = 'https://brighttechnologies.co.in/gofreshaapi/index.php/';
    // subCategory_Form.addEventListener('submit', async function (e) {
    //     e.preventDefault();

    //     const formData2 = new FormData(subCategory_Form);

    //     try {
    //         const response = await fetch(API_URL + 'addSubCategory', {
    //             method: 'POST',
    //             headers: {
    //                 'X-Api': 'Bearer ' + API_KEY
    //             },
    //             body: formData2
    //         });

    //         const data = await response.json();


    //         if (data.status === 'success') {
    //             console.log(data);
    //             window.location.href = data.redirect;
    //         }


    //     } catch (error) {
    //         console.error('Error:', error);
    //     }
    // });
</script>

<?= $this->endSection() ?>