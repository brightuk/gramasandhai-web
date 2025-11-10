<?php include(APPPATH . 'Views/templates/config.php'); ?>
<?= $this->extend('templates/page') ?>

<?= $this->section('index') ?>

<style>
.page-loader {
    position: fixed;
    inset: 0;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(2px);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2em;
    z-index: 2000;
}

body.loaded .page-loader {
    display: none;
}

body:not(.loaded) {
    overflow: hidden;
}

.sidebar {
    width: 320px;
    /* Increased sidebar width */
    height: 100%;
    padding: 20px;
    margin-bottom: 20px;
    border-radius: 10px;
    border: 1px solid #ddd;
    position: sticky;
    top: 20px;
    /* overflow-y: auto; */
    max-height: calc(100vh - 40px);
}



.plus-menu {
    float: right;
}

.cat {
    max-width: 280px !important;
    /* Adjusted to match sidebar */
}

.sidebar a {
    display: block;
    padding: 8px 16px;
    color: #000;
    text-decoration: none;
    transition: all 0.2s ease;
}

.sidebar a:hover {
    background-color: #e9ecef;
}

.center-cont {
    padding-left: 15px;
    padding-right: 15px;
}

.mat {
    margin-top: 150px !important;
}

.product-card {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    height: 100%;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
}

.card-img-top {
    object-fit: contain;
    height: 150px;
    width: 100%;
    padding: 10px;
}

.btnadd {
    background: rgb(43, 190, 249);
    color: white;
    transition: color 0.3s ease, background 0.3s ease;
    border: 1px solid rgb(43, 190, 249);
    padding: 0.25rem 0.75rem;
    border-radius: 0.375rem;
    white-space: nowrap;

}

.btnadd:hover {
    color: rgb(43, 190, 249) !important;
    background: white;
    transform: translateY(-1px);
}

/* Subcategory filter buttons */
.subcategory-filter-container {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-bottom: 20px;
    justify-content: center;
}

.subcategory-filter-btn {
    padding: 6px 12px;
    background-color: #f8f9fa;
    border: 1px solid #dee2e6;
    border-radius: 20px;
    cursor: pointer;
    transition: all 0.2s ease;
    font-size: 0.9rem;
}

.subcategory-filter-btn.active,
.subcategory-filter-btn:hover {
    background-color: rgb(43, 190, 249);
    color: white;
    border-color: rgb(43, 190, 249);
}

/* Product card layout improvements */
.desktop-card-content {
    display: flex;
    flex-direction: column;
    height: 100%;
}



.desktop-card-body {
    flex: 1 0 auto;
    display: flex;
    flex-direction: column;
    padding: 15px;
}

.desktop-card-footer {
    flex: 0 0 auto;
    padding: 0 15px 15px;
}

@media (max-width:800px) {
    #productContainer1 {
        margin-left: 0 !important;
        padding-left: 0 !important;
        padding-right: 0 !important;
    }
}

@media (max-width:1199.98px) {
    .sidebar {
        position: relative;
        top: 0;
        max-height: none;
        margin-bottom: 30px;
        width: 100% !important;
    }

    .cat {
        min-height: 40vh;
        max-width: 100% !important;
    }

    .mat {
        margin-top: 80px !important;
    }
}

@media (max-width:767.98px) {
    .center-cont {
        padding-left: 10px;
        padding-right: 10px;
    }

    .desktopd {
        display: block;
    }

    .cat {
        min-height: auto;
    }

    .mat {
        margin-top: 10px !important;
    }

    .card-img-top {
        height: 120px;
    }

    .subcategory-filter-container {
        justify-content: flex-start;
        overflow-x: auto;
        padding-bottom: 10px;
    }

    .subcategory-filter-btn {
        flex: 0 0 auto;
    }
}

#noResults {
    position: static !important;
    top: auto !important;
    left: auto !important;
    margin: 2rem auto;
    text-align: center;
}

.heading-product {
    position: static !important;
    top: auto !important;
    left: auto !important;
    text-align: center;
    margin-bottom: 1.5rem;
}
</style>
<style>
/* Base styles */
* {
    box-sizing: border-box;
}

/* Sidebar styles */
.sidebar {
    width: 320px;
    height: 100%;
    padding: 20px;
    margin-bottom: 20px;
    border-radius: 10px;
    border: 1px solid #ddd;
    position: sticky;
    top: 20px;
    max-height: calc(100vh - 40px);
    overflow-y: auto;
}

.sidebar a {
    display: block;
    padding: 8px 16px;
    color: #000;
    text-decoration: none;
    transition: all 0.2s ease;
    word-wrap: break-word;
}

.sidebar a:hover {
    background-color: #e9ecef;
}

/* Main container */
.center-cont {
    padding-left: 15px;
    padding-right: 15px;
}

/* Product container */
#productContainer1 {
    margin-left: 0;
}

/* Category section */
.cat {
    max-width: 320px !important;
}

.plus-menu {
    float: right;
    transition: transform 0.2s ease;
}

.plus-menu:hover {
    transform: rotate(90deg);
}

/* Product cards */
.product-card {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    height: 100%;
    border: 1px solid #e9ecef !important;
}

.product-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
}

.card-img-top {
    object-fit: contain;
    height: 150px;
    width: 100%;
    padding: 10px;
}

/* Button styles */
.btnadd {
    background: rgb(43, 190, 249);
    color: white;
    transition: all 0.3s ease;
    border: 1px solid rgb(43, 190, 249);
    padding: 0.375rem 0.75rem;
    border-radius: 0.375rem;
    white-space: nowrap;
    font-weight: 500;
}

.btnadd:hover {
    color: rgb(43, 190, 249) !important;
    background: white;
    transform: translateY(-1px);
}

/* Desktop card layout */
.desktop-card-content {
    display: flex;
    flex-direction: column;
    height: 100%;
}

.desktop-card-img-container {
    flex: 0 0 auto;
    /* height: 200px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 15px;
        background: #f8f9fa; */
    border-radius: 8px 8px 0 0;
}

.desktop-card-body {
    flex: 1 0 auto;
    display: flex;
    flex-direction: column;
    padding: 15px;
    text-align: center;
}

.desktop-card-footer {
    flex: 0 0 auto;
    padding: 0 15px 15px;
    text-align: center;
}

/* Price filter */
.filter-search {
    font-size: 0.9rem;
}

/* No results */
#noResults {
    position: static !important;
    top: auto !important;
    left: auto !important;
    margin: 2rem auto;
    text-align: center;
}

.heading-product {
    position: static !important;
    top: auto !important;
    left: auto !important;
    margin-bottom: 2rem;
}

/* Mobile-first responsive design */


/* Extra small devices (phones, less than 576px) */
@media (max-width: 575.98px) {
    .center-cont {
        padding-left: 10px;
        padding-right: 10px;
    }

    #productContainer1 {
        margin-left: 0 !important;
        margin-top: 10px;
        padding: 0;
    }

    .sidebar {
        display: none;
    }

    .cat {
        max-width: 100% !important;
        margin-bottom: 1rem;
    }

    .heading-product {
        font-size: 1.4rem;
        margin-bottom: 1.5rem;
        text-align: center;
    }

    /* Mobile card adjustments */
    .product-item {
        margin-bottom: 1rem;
        padding: 0 5px;
    }

    .card.product-card.mobile-only {
        padding: 15px;
        margin-bottom: 15px;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .card.product-card.mobile-only .d-flex {
        gap: 12px;
        align-items: flex-start;
    }

    .card.product-card.mobile-only img {
        width: 85px;
        height: 85px;
        border-radius: 8px;
        object-fit: contain;
    }

    .product-name-s {
        font-size: 0.95rem;
        line-height: 1.3;
        margin-bottom: 0.75rem;
        font-weight: 600;
    }

    .qty-select {
        font-size: 0.85rem;
        padding: 0.4rem 0.6rem;
        border-radius: 8px;
        width: 100%;
    }

    .btnadd {
        padding: 0.4rem 0.8rem;
        font-size: 0.85rem;
        border-radius: 8px;
        min-width: 70px;
        width: 100%;
    }

    .product-price {
        font-size: 0.95rem;
        font-weight: 600;
    }

    .spacerm {
        margin-top: 20px;
    }

    .head-noresults {
        position: static;
        top: auto;
        left: auto;
        text-align: center;
        margin: 1rem 0;
    }

    /* Better mobile layout for product info */
    .card.product-card.mobile-only .flex-grow-1 {
        min-width: 0;
        width: 100%;
    }

    .card.product-card.mobile-only .d-flex.justify-content-between {
        flex-direction: column;
        gap: 10px;
        align-items: stretch;
    }

    .card.product-card.mobile-only .prodprice {
        text-align: left;
        margin-bottom: 0.5rem;
    }

    /* Info button positioning */
    .infom2 {
        position: absolute;
        top: 10px;
        right: 10px;
        z-index: 10;
    }

    /* Mobile image container */
    .card.product-card.mobile-only .me-2 {
        flex-shrink: 0;
    }
}

/* Small devices (landscape phones, 576px and up) */
@media (min-width: 576px) and (max-width: 767.98px) {
    .center-cont {
        padding-left: 15px;
        padding-right: 15px;
    }

    .sidebar {
        position: relative;
        top: 0;
        max-height: none;
        margin-bottom: 25px;
        width: 100% !important;
    }

    .cat {
        max-width: 100% !important;
    }

    #productContainer1 {
        margin-left: 0 !important;
        padding: 0;
    }

    .card-img-top {
        height: 130px;
    }

    .desktop-card-img-container {
        height: 160px;
    }

    .heading-product {
        text-align: center;
        margin-bottom: 1.5rem;
    }

    .spacerm {
        margin-top: 20px;
    }
}




/* Medium devices (tablets, 768px and up) */
@media (min-width: 768px) and (max-width: 991.98px) {
    .center-cont {
        padding-left: 20px;
        padding-right: 20px;
    }

    .sidebar {
        position: relative;
        top: 0;
        max-height: none;
        margin-bottom: 30px;
        width: 100% !important;
    }

    .cat {
        max-width: 100% !important;
    }

    #productContainer1 {
        margin-left: 0 !important;
        padding: 0;
    }

    .desktop-card-img-container {
        height: 180px;
    }

    .heading-product {
        text-align: center;
        margin-bottom: 2rem;
    }

    .spacerm {
        margin-top: 30px;
    }

    .head-noresults {
        text-align: center;
        margin: 2rem 0;
    }
}

/* Large devices (desktops, 992px and up) */
@media (min-width: 992px) and (max-width: 1199.98px) {
    .center-cont {
        padding-left: 15px;
        padding-right: 15px;
    }

    .sidebar {
        position: sticky;
        top: 20px;
        max-height: calc(100vh - 40px);
    }

    #productContainer1 {
        margin-left: 20px;
        padding: 0;
    }

    .desktop-card-img-container {
        height: 170px;
    }

    .spacerm {
        margin-top: 40px;
    }

    .head-noresults {
        text-align: center;
        margin: 2rem 0;
    }
}

/* Extra large devices (large desktops, 1200px and up) */
@media (min-width: 1200px) {
    .center-cont {
        padding-left: 15px;
        padding-right: 15px;
    }

    .sidebar {
        position: sticky;
        top: 20px;
        max-height: calc(100vh - 40px);
    }

    #productContainer1 {
        margin-left: 0;
        padding: 0;
    }

    .desktop-card-img-container {
        height: 150px;
    }

    .spacerm {
        margin-top: 20px;
    }

    .head-noresults {
        text-align: center;
        margin: 2rem 0;
    }
}



/* Utility classes for better responsive control */
.mobile-only {
    display: block !important;
}

.desktop-only {
    display: none !important;
}

@media (min-width: 768px) {
    .mobile-only {
        display: none !important;
    }

    .desktop-only {
        display: block !important;
    }
}

/* Form controls responsive */
.form-select,
.form-control {
    font-size: 0.9rem;
}

@media (max-width: 575.98px) {

    .form-select,
    .form-control {
        font-size: 0.85rem;
        padding: 0.4rem 0.6rem;
    }

    /* Mobile button improvements */
    .btnadd {
        white-space: nowrap;
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Mobile price alignment */
    .prodprice {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    /* Mobile quantity select improvements */
    .qty-select {
        border: 1px solid #dee2e6;
        background-color: #f8f9fa;
    }
}

/* Badge responsive */
.badge {
    font-size: 0.8em;
}

@media (max-width: 575.98px) {
    .badge {
        font-size: 0.7em;
    }
}

/* Improved grid system */
.row.gx-3.gy-4 {
    --bs-gutter-x: 1rem;
    --bs-gutter-y: 1rem;
}

@media (max-width: 575.98px) {
    .row.gx-3.gy-4 {
        --bs-gutter-x: 0.75rem;
        --bs-gutter-y: 1rem;
    }

    /* Mobile container improvements */
    .container-fluid.center-cont {
        padding-left: 10px;
        padding-right: 10px;
    }
}


.head-noresults {
    position: static;
    top: auto;
    left: auto;
    text-align: center;
    margin-bottom: 2rem;
}
</style>

<div id="loader" class="page-loader">
    <div class="text-center">
        <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;">
            <span class="visually-hidden">Loading...</span>
        </div>
        <div class="mt-2 text-muted">Loading...</div>
    </div>
</div>

<?php if (isset($category_id)) : ?>
<div class="category_id d-none" id="category_id"> <?= esc($category_id) ?></div>
<?php endif; ?>

<?php if (isset($subcategory_id)) : ?>
<div class="subcategory_id d-none" id="subcategory_id"> <?= esc($subcategory_id) ?></div>
<?php endif; ?>


<div class="container-fluid center-cont spacerm">
    <!-- <div class="head-noresults">
   
        <div class="no-results d-none text-center py-5" id="noResults">
            <i class="bi bi-search display-4 text-muted mb-3"></i>
            <h4 class="mb-2">No products found</h4>
            <p class="text-muted">Try adjusting your filters or search terms</p>
        </div>
    </div> -->

    <div class="row">
        <!-- Sidebar -->
        <div class="col-12 col-lg-3 col-xl-3 cat mb-3">
            <div class="sidebar" id="sidebar">
                <label class="form-label fw-bold ps-2">Categories</label>
                <ul class="list-unstyled">
                    <?php foreach ($categories as $category): ?>
                    <li class="myoffcanvas-menu-item myoffcanvas-has-submenu">
                        <a href="#" class="myoffcanvas-menu-link d-flex justify-content-between align-items-center"
                            onclick="filterByCategory('<?= $category['category_id'] ?>')">
                            <span><?= esc($category['category_name']) ?></span>
                            <span class="category-plus plus-menu ">+</span>
                        </a>
                        <ul class="myoffcanvas-submenu">
                            <?php foreach ($subcategories as $subcategory): ?>
                            <?php if ($subcategory['main_category'] == $category['category_name']): ?>
                            <li class="myoffcanvas-submenu-item">
                                <a href="#" class="myoffcanvas-submenu-link"
                                    onclick="filterBySubcategory('<?= $subcategory['subcategory_id'] ?>')">
                                    <?= esc($subcategory['sub_category_name']) ?>
                                </a>
                            </li>
                            <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                    <?php endforeach; ?>
                </ul>

                <label class="form-label fw-bold ps-2 mt-4">Filter by price</label>
                <div class="mb-3">
                    <select class="form-select filter-search" id="priceFilter" onchange="handlePriceFilterChange()">
                        <option value="">All Prices</option>
                        <option value="0-50">₹0 - ₹50</option>
                        <option value="50-100">₹50 - ₹100</option>
                        <option value="100-200">₹100 - ₹200</option>
                        <option value="200-500">₹200 - ₹500</option>
                        <option value="500+">₹500+</option>
                    </select>
                </div>
            </div>
        </div>

        <?php

        $products = $allproducts;
        $variants = $allvariants;
        $finalPrice = 0;

        ?>

        <!-- Product area -->
        <div class="col-12 col-lg-9 col-xl-9" style="min-height:30vh;">
            <h2 class="heading-product text-center mb-4">
                <?= isset($title) ? esc($title) : "" ?> Products
                <?php if (!empty($offershow)): ?>
                <span class="badge bg-primary ms-2"><?= esc($offername) ?></span>
                <?php endif; ?>
            </h2>
            <div class="row gx-3 gy-4" id="productContainer1">
                <?php if (!empty($products)): ?>
                <?php foreach ($products as $product): ?>
                <?php
                        // Reset productVariants container for this product
                        $productVariants = [];

                        // Flatten nested variant arrays and filter for current product
                        if (isset($allvariants) && is_array($allvariants)) {
                            foreach ($allvariants as $variantGroup) {
                                if (is_array($variantGroup)) {
                                    foreach ($variantGroup as $variant) {
                                        if (isset($variant['prod_id']) && $variant['prod_id'] == $product['id']) {
                                            $productVariants[] = $variant;
                                        }
                                    }
                                }
                            }
                        }

                        // Find lowest price variant
                        $lowestVariant = null;
                        foreach ($productVariants as $variant) {
                            if ($lowestVariant === null || $variant['price'] < $lowestVariant['price']) {
                                $lowestVariant = $variant;
                            }
                        }
                        ?>
                <?php
                            // Determine a price for filtering: use lowest variant price if variant, else non-variant price with discount applied
                            $filterPrice = 0;
                            if (!empty($product['is_variant']) && $product['is_variant'] == 1) {
                                if ($lowestVariant) {
                                    $filterPrice = (float) $lowestVariant['price'];
                                    if (!empty($lowestVariant['disc_price']) && $lowestVariant['disc_price'] > 0) {
                                        if (!empty($lowestVariant['disc_type']) && $lowestVariant['disc_type'] == 1) {
                                            $filterPrice -= (float) $lowestVariant['disc_price'];
                                        } else {
                                            $filterPrice -= ((float) $lowestVariant['disc_price'] * (float) $lowestVariant['price'] / 100);
                                        }
                                    }
                                }
                            } else {
                                $filterPrice = (float) ($product['prod_price'] ?? 0);
                                $discVal = (float) ($product['disc_value'] ?? 0);
                                $discType = (int) ($product['disc_type'] ?? 0);
                                if ($discVal > 0) {
                                    if ($discType === 1) {
                                        $filterPrice -= $discVal;
                                    } else if ($discType === 2) {
                                        $filterPrice -= ($discVal * $filterPrice / 100);
                                    }
                                }
                            }
                        ?>
                <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mb-3 product-item"
                    data-product-id="<?= $product['id'] ?>" data-category-id="<?= $product['category_id'] ?>"
                    data-subcategory-id="<?= $product['subcategory_id'] ?>"
                    data-product-name="<?= strtolower(esc($product['prod_name'])) ?>"
                    data-price="<?= htmlspecialchars(number_format($filterPrice, 2, '.', ''), ENT_QUOTES, 'UTF-8') ?>">
                    <!-- Mobile Card -->
                    <div
                        class="card product-card smallview-prod mobile-only shadow-sm border-0 rounded-3 p-2 bg-white position-relative">
                        <div class="d-flex align-items-start">
                            <div class="me-2 flex-shrink-0 d-flex align-items-center justify-content-center"
                                style="width:90px;height:90px;">
                                <img src="<?= $img_url . $product['main_image'] ?>" class="img-fluid rounded border"
                                    loading="lazy" decoding="async" fetchpriority="low" data-bs-toggle="modal"
                                    data-bs-target="#imagemodel" alt="<?= esc($product['prod_name']) ?>"
                                    style="object-fit:contain; cursor:pointer; background:#f8f9fa; max-width:100%; max-height:100%;"
                                    data-image="<?= $img_url . $product['main_image'] ?>"
                                    onerror="this.onerror=null;this.src='<?= $img_sat ?>no-image.jpg';">
                            </div>
                            <div class="flex-grow-1 d-flex flex-column">
                                <div class="mb-0">
                                    <!-- Info Button -->
                                    <button class="btn btn-link p-0 ms-2 infom2" data-bs-toggle="modal"
                                        data-bs-target="#infoModal"
                                        data-product-name="<?= esc($product['prod_name']) ?>"
                                        data-description="<?= esc($product['description'] ?? '') ?>">
                                        <i class="bi bi-info-circle-fill text-primary" style="font-size: 1.2rem;"></i>
                                    </button>
                                    <strong class="product-name-s d-block text-truncate"
                                        style="font-size:0.9rem; line-height:1.3;">
                                        <?= esc($product['prod_name']) ?>
                                    </strong>
                                </div>
                                <?php foreach ($productVariants as $variant): ?>
                                <?php if ($variant['disc_price'] > 0 && $variant['disc_type'] > 0): ?>

                                <div class="product_offer" data-measure="<?= $variant['measure'] ?>"
                                    style="<?= $variant === $productVariants[0] ? '' : 'display:none;' ?>">
                                    <?= $variant['disc_type'] == 1 ? '-₹' : '' ?>
                                    <?= $variant['disc_price'] ?><?= $variant['disc_type'] == 2 ? '%' : '' ?>
                                </div>
                                <?php endif;
                                        endforeach; ?>
                                <?php $prodVarCo = count($productVariants);?>
                                <?php if (!empty($product['is_variant']) && $product['is_variant'] == 1  && is_array($productVariants) && $prodVarCo > 0): ?>


                                <div class="mb-2">
                                    <select class="form-select-sm qty-select w-100 rounded-pill bg-light border-0 px-2"
                                        style="font-size:0.8rem;">
                                        <?php foreach ($productVariants as $index => $variant): ?>
                                        <?php
                                                        // Calculate final price after discount for mobile
                                                $finalPrice = $variant['price'];
                                                if (!empty($variant['disc_price']) && $variant['disc_price'] > 0) {
                                                    if ($variant['disc_type'] == 1) { // Fixed amount discount
                                                        $finalPrice -= $variant['disc_price'];
                                                    } else { // Percentage discount
                                                        $finalPrice -= ($variant['disc_price'] * $variant['price'] / 100);
                                                    }
                                                }
                                                ?>
                                        <option value="<?= $finalPrice ?>"
                                            data-measure="<?= esc($variant['measure']) ?>"
                                            data-original-price="<?= $variant['price'] ?>"
                                            data-disc="<?= !empty($variant['disc_price']) ? $variant['disc_price'] : 0 ?>"
                                            data-disc-type="<?= $variant['disc_type'] ?>"
                                            <?= $index === 0 ? 'selected' : '' ?>>
                                            <?= esc($variant['measure']) ?>
                                        </option>

                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <?php else: ?>
                                <div class="text-center mb-3">
                                    <span class="fw-semibold rounded-pill bg-light px-4 py-1 d-inline-block"
                                        style="font-size:0.8rem;">
                                        <?= esc($productVariants[0]['measure'] ?? '') ?>
                                    </span>
                                </div>
                                <?php endif; ?>
                                <div class="mb-2 prodprice mb-lg-4">
                                    <?php
                                            // Show final price of first/default variant
                                        $firstVariant = $productVariants[0] ?? null;
                                        if ($firstVariant || $product['is_variant'] == 0) {
                                             $originalPrice =  $firstVariant['price'] ;
                                     

                                            $finalPrice = $originalPrice;

                                            if (!empty($firstVariant['disc_price']) && $firstVariant['disc_price'] > 0) {
                                                if ($firstVariant['disc_type'] == 1) { 
                                                    $finalPrice -= $firstVariant['disc_price'];
                                                } else { 
                                                    $finalPrice -= ($firstVariant['disc_price'] * $originalPrice / 100);
                                                }
                                            }
                                        }
                                            ?>
                                    <div class="mb-2 prodprice mb-lg-4 selected-price-display">
                                        <?php if (isset($firstVariant) && !empty($firstVariant['disc_price']) && $firstVariant['disc_price'] > 0): ?>
                                        <span class="text-muted" style="text-decoration: line-through;">
                                            ₹<?= number_format($originalPrice, 2) ?>
                                        </span>
                                        &nbsp;
                                        <span class="product-price fw-bold fs-6 text-success">
                                            ₹<?= number_format($finalPrice, 2) ?>
                                        </span>
                                        <?php else: ?>
                                        <span class="product-price fw-bold fs-6 text-success">
                                            ₹<?= number_format($finalPrice, 2) ?>
                                        </span>
                                        <?php endif; ?>
                                    </div>

                                </div>
                                <div class="d-flex mt-3 justify-content-between align-items-center">

                                    <button class="btn btnadd btn-sm  w-50 add-to-cart-btn fw-semibold"
                                        id="addCart2">Add
                                    </button>

                                    <!-- Quantity Selector (hidden initially) -->
                                    <div class="input-group input-group-sm  addCart2 qty-group d-none"
                                        style="max-width: 130px;">
                                        <button class="btn btn-outline-secondary qty-btn1 rounded-start-pill"
                                            type="button" data-action="decrement">-</button>
                                        <input type="text" class="form-control text-center qty-number border-0 bg-light"
                                            value="1" readonly>
                                        <button class="btn btn-outline-secondary qty-btn1 rounded-end-pill"
                                            type="button" data-action="increment">+</button>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Desktop Card -->
                    <div
                        class="card product-card desktop-only d-flex flex-column h-100 shadow-sm border-0 rounded-3 overflow-hidden">
                        <div class="desktop-card-img-container">
                            <img src="<?= $img_url . $product['main_image'] ?>" class="card-img-top" loading="lazy"
                                decoding="async" fetchpriority="low" alt="<?= esc($product['prod_name']) ?>"
                                style="max-height: 100%; max-width: 100%; object-fit: contain;"
                                data-image="<?= $img_url . $product['main_image'] ?>" data-bs-toggle="modal"
                                data-bs-target="#imagemodel"
                                onerror="this.onerror=null;this.src='<?= $img_sat ?>no-image.jpg';">
                        </div>
                        <div class="desktop-card-body">
                            <div class="mb-2">
                                <!-- Info Button -->
                                <button class="btn btn-link p-0 ms-2 infom" data-bs-toggle="modal"
                                    data-bs-target="#infoModal" data-product-name="<?= esc($product['prod_name']) ?>"
                                    data-description="<?= esc($product['description'] ?? '') ?>">
                                    <i class="bi bi-info-circle-fill text-primary" style="font-size: 1.2rem;"></i>
                                </button>
                                <strong class="product-name-s d-block" style="font-size:0.9rem; line-height:1.3;">
                                    <?= esc($product['prod_name']) ?>
                                </strong>
                            </div>

                            <?php foreach ($productVariants as $variant): ?>
                            <?php if ($variant['disc_price'] > 0  && $variant['disc_type'] > 0): ?>
                            <div class="product_offer" data-measure="<?= $variant['measure'] ?>"
                                style="<?= $variant === $productVariants[0] ? '' : 'display:none;' ?>">
                                <?= $variant['disc_type'] == 1 ? '-₹' : '' ?>
                                <?= $variant['disc_price'] ?><?= $variant['disc_type'] == 2 ? '%' : '' ?>
                            </div>
                            <?php endif; ?>
                            <?php endforeach; ?>

                            <?php $prodVarCo = count($productVariants);?>
                            <?php if (!empty($product['is_variant']) && $product['is_variant'] == 1  && is_array($productVariants) && $prodVarCo > 0): ?>

                            <div class="mb-3 text-center">
                                <select class="form-select qty-select rounded-pill bg-light border-0 px-2 mx-auto"
                                    style="font-size:0.8rem;" id="variantSelect">
                                    <?php foreach ($productVariants as $index => $variant): ?>
                                    <?php
                                            // Calculate final price after discount
                                            $finalPrice = $variant['price'];
                                            if (!empty($variant['disc_price']) && $variant['disc_price'] > 0) {
                                                if ($variant['disc_type'] == 1) { // Fixed amount discount
                                                    $finalPrice -= $variant['disc_price'];
                                                } else { // Percentage discount
                                                    $finalPrice -= ($variant['disc_price'] * $variant['price'] / 100);
                                                }
                                            }
                                        ?>
                                    <option value="<?= esc($finalPrice) ?>"
                                        data-measure="<?= esc($variant['measure']) ?>"
                                        data-original-price="<?= esc($variant['price']) ?>"
                                        data-disc="<?= esc(!empty($variant['disc_price']) ? $variant['disc_price'] : 0) ?>"
                                        data-disc-type="<?= esc($variant['disc_type']) ?>"
                                        <?= $index === 0 ? 'selected' : '' ?>>
                                        <?= esc($variant['measure']) ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>



                            <?php else: ?>

                            <div class="text-center mb-3">
                                <span class="fw-semibold rounded-pill bg-light px-3 py-1 d-inline-block"
                                    style="font-size:0.8rem;">
                                    <?= esc($productVariants[0]['measure'] ?? '') ?>
                                </span>
                            </div>



                            <?php endif; ?>



                            <div class="mb-2 text-center prodprice mb-lg-4">
                                <?php
                                        // Show final price of first/default variant
                                        $firstVariant = $productVariants[0] ?? null;
                                        if ($firstVariant || $product['is_variant'] == 0) {
                                            $originalPrice = $firstVariant['price'] ;
                             
                                            $finalPrice = $originalPrice;

                                            if (!empty($firstVariant['disc_price']) && $firstVariant['disc_price'] > 0) {
                                                if ($firstVariant['disc_type'] == 1) { // Fixed amount discount
                                                    $finalPrice -= $firstVariant['disc_price'];
                                                } else { // Percentage discount
                                                    $finalPrice -= ($firstVariant['disc_price'] * $originalPrice / 100);
                                                }
                                            }
                                        }
                                        ?>
                                <div class=" prodprice  selected-price-display">
                                    <?php if (isset($firstVariant) && !empty($firstVariant['disc_price']) && $firstVariant['disc_price'] > 0): ?>
                                    <span class="text-muted" style="text-decoration: line-through;">
                                        ₹<?= number_format($originalPrice, 2) ?>
                                    </span>
                                    &nbsp;
                                    <span class="product-price fw-bold fs-6 text-success">
                                        ₹<?= number_format($finalPrice, 2) ?>
                                    </span>
                                    <?php else: ?>
                                    <span class="product-price fw-bold fs-6 text-success">
                                        ₹<?= number_format($finalPrice, 2) ?>
                                    </span>
                                    <?php endif; ?>
                                </div>

                            </div>
                        </div>
                        <div class="mt-auto d-flex align-items-center gap-2 ct-add addCart1">
                            <!-- Add to Cart Button -->
                            <button class="btn btnadd add-to-cart-btn fw-semibold text-white"
                                style="width: 150px; font-size:0.9rem; " id="addCart1">
                                Add
                            </button>

                            <!-- Quantity Selector (hidden initially) -->
                            <div class="input-group input-group-sm qty-group d-none" style="max-width: 110px;">
                                <button class="btn btn-outline-secondary qty-btn1 rounded-start-pill" type="button"
                                    data-action="decrement">-</button>
                                <input type="text" class="form-control text-center qty-number border-0 bg-light"
                                    value="1" readonly>
                                <button class="btn btn-outline-secondary qty-btn1 rounded-end-pill" type="button"
                                    data-action="increment">+</button>
                            </div>
                        </div>

                    </div>
                </div>
                <?php endforeach; ?>
                <div class="text-center my-4 " id="loadproducts">
                    <!-- <button id="loadMoreBtn" class="btn btn-primary mx-auto d-inline-block"
                        onclick="loadMoreProducts()">
                        Load More Products
                    </button> -->
                </div>

                <!-- No results content (shown when no products match) -->
                <div id="noResults" class="d-none text-center py-5">
                    <div class="fs-5 text-muted">No more products</div>
                </div>

                <?php else: ?>
                <div class="col-12">
                    <div class="alert alert-info rounded-3">
                        <i class="bi bi-info-circle me-2"></i>
                        No products found in this category.
                    </div>
                </div>
                <?php endif; ?>
            </div>

        </div>

    </div>
</div>



<div class="p_spacer"></div>




<style>
.img-skeleton {
    background-color: #f0f0f0 !important;
}
</style>

<script>
window.addEventListener('load', () => {
    document.body.classList.add('loaded');
});
</script>

<script>
    // ========== LAZY LOADING IMPLEMENTATION ==========
const PRODUCTS_PER_PAGE = 16;
let currentPage = 1;
let allProductElements = [];
let isLoading = false;
let lazyLoadObserver = null;
let firstBatchBoostCount = 4;

// Initialize lazy loading on page load
document.addEventListener('DOMContentLoaded', function() {
    initializeLazyLoading();
});

function initializeLazyLoading() {
    const productContainer = document.getElementById('productContainer1');
    if (!productContainer) return;

    allProductElements = Array.from(productContainer.querySelectorAll('.product-item'));
    allProductElements.forEach(el => el.style.display = 'none');
    loadMoreProducts();
    setupInfiniteScroll();
}

function loadMoreProducts() {
    if (isLoading) return;
    isLoading = true;

    const start = (currentPage - 1) * PRODUCTS_PER_PAGE;
    const end = start + PRODUCTS_PER_PAGE;

    const visibleProducts = allProductElements.filter(el => {
        return el.style.display === 'none' && !el.classList.contains('filtered-out');
    });

    const productsToLoad = visibleProducts.slice(0, PRODUCTS_PER_PAGE);

    productsToLoad.forEach((el, idx) => {
        el.style.display = '';
        const img = el.querySelector('img');
        if (img) {
            img.classList.add('img-skeleton');
            if (img.complete) {
                img.classList.remove('img-skeleton');
            } else {
                img.addEventListener('load', () => img.classList.remove('img-skeleton'), { once: true });
                img.addEventListener('error', () => img.classList.remove('img-skeleton'), { once: true });
            }
            if (currentPage === 1 && idx < firstBatchBoostCount) {
                try { img.setAttribute('fetchpriority', 'high'); } catch (e) {}
            }
        }
    });

    const hasMore = visibleProducts.length > PRODUCTS_PER_PAGE;
    toggleLoadingIndicator(hasMore);

    if (productsToLoad.length > 0) {
        currentPage++;
    }

    isLoading = false;
    updateNoResultsMessage();
    preloadNextImages();
}

function setupInfiniteScroll() {
    let loadingIndicator = document.getElementById('loadingIndicator');

    if (!loadingIndicator) {
        loadingIndicator = document.createElement('div');
        loadingIndicator.id = 'loadingIndicator';
        loadingIndicator.className = 'text-center py-4';
        loadingIndicator.innerHTML = `
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-2 text-muted">Loading more products...</p>
        `;
        loadingIndicator.style.display = 'none';

        const productContainer = document.getElementById('productContainer1');
        productContainer.parentElement.appendChild(loadingIndicator);
    }

    if (lazyLoadObserver) {
        lazyLoadObserver.disconnect();
    }

    lazyLoadObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting && !isLoading) {
                loadMoreProducts();
            }
        });
    }, { rootMargin: '200px' });

    lazyLoadObserver.observe(loadingIndicator);
}

function toggleLoadingIndicator(show) {
    const indicator = document.getElementById('loadingIndicator');
    if (indicator) {
        indicator.style.display = show ? 'block' : 'none';
    }
}

function updateNoResultsMessage() {
    const displayedProducts = allProductElements.filter(el => el.style.display !== 'none');
    const noResults = document.getElementById('noResults');
    const sidebar = document.getElementById('sidebar');

    if (displayedProducts.length === 0 && !isLoading) {
        if (noResults) noResults.classList.remove('d-none');
        // if (sidebar) sidebar.classList.add('d-none');
    } else {
        if (noResults) noResults.classList.add('d-none');
        // if (sidebar) sidebar.classList.remove('d-none');
    }
}

function resetLazyLoading() {
    currentPage = 1;
    allProductElements.forEach(el => {
        if (!el.classList.contains('filtered-out')) {
            el.style.display = 'none';
        }
    });
    loadMoreProducts();
}

function preloadNextImages() {
    const upcoming = allProductElements
        .filter(el => el.style.display === 'none' && !el.classList.contains('filtered-out'))
        .slice(0, PRODUCTS_PER_PAGE * 2);

    const urls = [];
    upcoming.forEach(el => {
        const img = el.querySelector('img');
        if (img && img.dataset && img.dataset.image) {
            const url = img.dataset.image;
            urls.push(url);
            const preImg = new Image();
            preImg.decoding = 'async';
            preImg.loading = 'eager';
            preImg.src = url;
        }
    });

    urls.slice(0, 8).forEach(url => {
        const link = document.createElement('link');
        link.rel = 'prefetch';
        link.as = 'image';
        link.href = url;
        document.head.appendChild(link);
        setTimeout(() => link.remove(), 10000);
    });
}

// ========== FILTER SYSTEM ==========
let currentCategoryFilter = 'all';
let currentSubcategoryFilter = 'all';
let currentSearchTerm = '';
let currentPriceFilter = '';

// Main product filtering function
function filterProducts() {
    const searchTerm = document.getElementById('productSearch')?.value.toLowerCase() || '';
    const priceFilter = document.getElementById('priceFilter')?.value || '';

    currentSearchTerm = searchTerm;
    currentPriceFilter = priceFilter;

    const productItems = document.querySelectorAll('.product-item');

    productItems.forEach(item => {
        let showItem = true;

        // Category filter
        if (currentCategoryFilter !== 'all') {
            const itemCategoryId = item.dataset.categoryId;
            if (itemCategoryId !== currentCategoryFilter) {
                showItem = false;
            }
        }

        // Subcategory filter
        if (showItem && currentSubcategoryFilter !== 'all') {
            const itemSubcategoryId = item.dataset.subcategoryId;
            if (itemSubcategoryId !== currentSubcategoryFilter) {
                showItem = false;
            }
        }

        // Search filter
        if (showItem && searchTerm) {
            const productName = item.dataset.productName;
            if (!productName.includes(searchTerm)) {
                showItem = false;
            }
        }

        // Price filter
        if (showItem && priceFilter) {
            const itemPrice = parseFloat(item.dataset.price);
            showItem = matchesPriceFilter(itemPrice, priceFilter);
        }

        // Mark items as filtered or not
        if (showItem) {
            item.classList.remove('filtered-out');
        } else {
            item.classList.add('filtered-out');
            item.style.display = 'none';
        }
    });

    // Reset lazy loading to show first batch of filtered products
    resetLazyLoading();
}

function scrollToProductList() {
    const productContainer = document.getElementById('productContainer1');
    if (!productContainer) return;

    setTimeout(() => {
        try {
            productContainer.scrollIntoView({ behavior: 'smooth', block: 'start' });
        } catch (err) {
            productContainer.scrollIntoView();
        }
    }, 100);
}

function handlePriceFilterChange() {
    filterProducts();
    scrollToProductList();
}

function matchesPriceFilter(price, filter) {
    switch (filter) {
        case '0-50': return price >= 0 && price <= 50;
        case '50-100': return price > 50 && price <= 100;
        case '100-200': return price > 100 && price <= 200;
        case '200-500': return price > 200 && price <= 500;
        case '500+': return price > 500;
        default: return true;
    }
}

// Category filtering with proper reset
function filterByCategory(categoryId) {
    console.log('Filtering by category:', categoryId);
    
    // CRITICAL: Reset subcategory filter first
    currentCategoryFilter = categoryId;
    currentSubcategoryFilter = 'all';
    
    // Clear active subcategory chips
    const chipContainer = document.getElementById('scrollContainer') || document.getElementById('subcategoryContainer');
    if (chipContainer) {
        chipContainer.querySelectorAll('.subcategory-filter-btn').forEach(btn => {
            btn.classList.remove('active');
        });
    }
    
    // Update which subcategories are visible
    updateSubcategoryVisibility(categoryId);
    
    // Expand sidebar category
    expandSidebarCategoryById(categoryId);
    
    // Apply filters
    filterProducts();
    
    // Scroll to products
    scrollToProductList();
}

// Subcategory filtering
function filterBySubcategory(subcategoryId, buttonElement = null) {
    console.log('Filtering by subcategory:', subcategoryId);
    
    currentSubcategoryFilter = subcategoryId;

    // Update chip button states
    const chipContainer = document.getElementById('scrollContainer') || document.getElementById('subcategoryContainer');
    if (chipContainer) {
        chipContainer.querySelectorAll('.subcategory-filter-btn').forEach(btn => {
            btn.classList.remove('active');
        });
    }
    
    if (buttonElement) {
        buttonElement.classList.add('active');
    } else {
        // Find and activate the chip
        const chip = chipContainer?.querySelector(`.subcategory-filter-btn[data-subcategory="${subcategoryId}"]`);
        if (chip) {
            chip.classList.add('active');
            try {
                chip.scrollIntoView({ behavior: 'smooth', inline: 'center', block: 'nearest' });
            } catch (e) {}
        }
    }

    // Highlight in sidebar
    highlightSidebarSubcategory(subcategoryId);
    
    // Apply filters
    filterProducts();
    
    // Scroll to products
    scrollToProductList();
}

// Update subcategory chip visibility based on selected category
function updateSubcategoryVisibility(categoryId) {
    const container = document.getElementById('scrollContainer') || document.getElementById('subcategoryContainer');
    if (!container) return;
    
    const chips = Array.from(container.querySelectorAll('.subcategory-filter-btn'));

    if (!categoryId || categoryId === 'all') {
        chips.forEach(c => c.style.display = '');
        updateScrollButtons(container);
        return;
    }

    // Get allowed subcategories for this category
    let allowed = new Set();
    
    // Strategy 1: From sidebar structure
    const sidebar = document.getElementById('sidebar');
    if (sidebar) {
        const catItems = Array.from(sidebar.querySelectorAll('.myoffcanvas-menu-item'));
        for (const li of catItems) {
            const link = li.querySelector('.myoffcanvas-menu-link');
            if (!link) continue;
            const onclick = link.getAttribute('onclick') || '';
            if (onclick.includes(`filterByCategory('${categoryId}')`)) {
                const subLinks = li.querySelectorAll('.myoffcanvas-submenu-link');
                subLinks.forEach(a => {
                    const subOnclick = a.getAttribute('onclick') || '';
                    const match = subOnclick.match(/filterBySubcategory\('([^']+)'\)/);
                    if (match && match[1]) allowed.add(match[1]);
                });
                break;
            }
        }
    }

    // Strategy 2: From product data
    if (allowed.size === 0) {
        allowed = new Set(
            Array.from(document.querySelectorAll('.product-item'))
                .filter(el => el.dataset.categoryId === categoryId)
                .map(el => el.dataset.subcategoryId)
        );
    }

    // Show/hide chips
    chips.forEach(c => {
        const subcatId = c.getAttribute('data-subcategory');
        c.style.display = (subcatId === 'all' || allowed.has(subcatId)) ? '' : 'none';
    });

    updateScrollButtons(container);
}

function updateScrollButtons(container) {
    const leftBtn = document.querySelector('.scroll-button.left');
    const rightBtn = document.querySelector('.scroll-button.right');
    if (!leftBtn || !rightBtn || !container) return;
    
    const visibleChips = Array.from(container.querySelectorAll('.subcategory-filter-btn'))
        .filter(b => b.style.display !== 'none');
    const hasOverflow = visibleChips.length > 1 && container.scrollWidth > container.clientWidth + 1;
    
    leftBtn.style.display = hasOverflow ? 'flex' : 'none';
    rightBtn.style.display = hasOverflow ? 'flex' : 'none';
}

// Expand sidebar category
function expandSidebarCategoryById(categoryId) {
    const sidebar = document.getElementById('sidebar');
    if (!sidebar || !categoryId) return;
    
    const items = Array.from(sidebar.querySelectorAll('.myoffcanvas-menu-item'));
    items.forEach(li => {
        const link = li.querySelector('.myoffcanvas-menu-link');
        const submenu = li.querySelector('.myoffcanvas-submenu');
        if (!link) return;
        
        const onclick = link.getAttribute('onclick') || '';
        const isMatch = onclick.includes(`filterByCategory('${categoryId}')`);
        
        // Collapse all first
        if (submenu) submenu.style.display = 'none';
        link.classList.remove('active');
        
        // Expand matched category
        if (isMatch) {
            if (submenu) submenu.style.display = '';
            link.classList.add('active');
        }
    });
}

// Highlight sidebar subcategory
function highlightSidebarSubcategory(subcategoryId) {
    const sidebar = document.getElementById('sidebar');
    if (!sidebar || !subcategoryId) return;
    
    const items = Array.from(sidebar.querySelectorAll('.myoffcanvas-menu-item'));
    items.forEach(li => {
        const link = li.querySelector('.myoffcanvas-menu-link');
        const submenu = li.querySelector('.myoffcanvas-submenu');
        const subLinks = li.querySelectorAll('.myoffcanvas-submenu-link');
        
        subLinks.forEach(a => {
            const onclick = a.getAttribute('onclick') || '';
            if (onclick.includes(`filterBySubcategory('${subcategoryId}')`)) {
                if (submenu) submenu.style.display = '';
                if (link) link.classList.add('active');
                a.classList.add('active');
            } else {
                a.classList.remove('active');
            }
        });
    });
}

// ========== CART FUNCTIONS ==========
function getCart() {
    try {
        const cartData = localStorage.getItem('cart');
        return cartData ? JSON.parse(cartData) : [];
    } catch (e) {
        console.error("Error reading cart:", e);
        return [];
    }
}

function saveCart(cart) {
    localStorage.setItem('cart', JSON.stringify(cart));
}

function updateCartCount() {
    const cart = getCart();
    const totalItems = cart.length;
    document.querySelectorAll('.cart-count').forEach(el => el.textContent = totalItems);
}

function initializeCart() {
    updateCartCount();
    initializeQuantityControls();
}

function initializeQuantityControls() {
    const cart = getCart();
    document.querySelectorAll('.product-card').forEach(card => {
        const productItem = card.closest('.product-item');
        if (!productItem) return;
        const productId = productItem.dataset.productId;
        const select = card.querySelector('.qty-select');
        if (!select) return;

        const selectedOption = select.options[select.selectedIndex];
        const measure = selectedOption.getAttribute('data-measure');
        const cartItem = cart.find(item => item.id === productId && item.measure === measure);

        if (cartItem) {
            toggleCartUI(card, true, cartItem.quantity);
        } else {
            toggleCartUI(card, false);
        }
    });
}

function toggleCartUI(card, isInCart, quantity = 1) {
    const addButton = card.querySelector('.add-to-cart-btn');
    const qtyGroup = card.querySelector('.qty-group');
    const qtyInput = card.querySelector('.qty-number');

    if (isInCart) {
        if (addButton) addButton.classList.add('d-none');
        if (qtyGroup) {
            qtyGroup.classList.remove('d-none');
            if (qtyInput) qtyInput.value = quantity;
        }
    } else {
        if (addButton) addButton.classList.remove('d-none');
        if (qtyGroup) qtyGroup.classList.add('d-none');
    }
}

function handleAddToCart(button) {
    const card = button.closest('.product-card');
    if (!card) return;

    const productItem = card.closest('.product-item');
    if (!productItem) return;

    const productId = productItem.dataset.productId;
    const productName = (card.querySelector('.product-name, .product-name-s')?.textContent || '').trim();
    const image = card.querySelector('img')?.src || '';
    const imageName = card.querySelector('#image_name')?.value || '';

    const select = card.querySelector('.qty-select');
    let price = 0;
    let measure = '';

    if (select) {
        const selectedOption = select.options[select.selectedIndex];
        price = parseFloat(selectedOption.value) || 0;
        measure = selectedOption.getAttribute('data-measure') || '';
    } else {
        measure = (card.querySelector('.fw-semibold')?.textContent || '').trim();
        price = parseFloat(card.querySelector('.product-price')?.textContent.replace(/[₹,]/g, '')) || 0;
    }

    let cart = getCart();
    const existingItemIndex = cart.findIndex(item => item.id === productId && item.measure === measure);

    if (existingItemIndex === -1) {
        cart.push({
            id: productId,
            name: productName,
            price: price,
            measure: measure,
            quantity: 1,
            image: image,
            image_name: imageName
        });
    }

    saveCart(cart);
    updateCartCount();
    toggleCartUI(card, true, 1);
}

function updatePriceDisplay(selectElement) {
    const card = selectElement.closest('.product-item');
    const selectedOption = selectElement.options[selectElement.selectedIndex];
    const originalPrice = parseFloat(selectedOption.dataset.originalPrice);
    const discAmount = parseFloat(selectedOption.dataset.disc || 0);
    const discType = selectedOption.dataset.discType;

    let finalPrice = originalPrice;
    if (discAmount > 0) {
        if (discType == 1) {
            finalPrice = originalPrice - discAmount;
        } else {
            finalPrice = originalPrice - (discAmount * originalPrice / 100);
        }
    }

    selectedOption.value = finalPrice;

    const priceElement = card.querySelector('.prodprice');
    if (priceElement) {
        if (discAmount > 0) {
            priceElement.innerHTML = `
                <span class="text-muted" style="text-decoration: line-through;">
                    ₹${originalPrice.toFixed(2)}
                </span>
                &nbsp;
                <span class="product-price fw-bold fs-6 text-success">
                    ₹${finalPrice.toFixed(2)}
                </span>
            `;
        } else {
            priceElement.innerHTML = `
                <span class="product-price fw-bold fs-6 text-success">
                    ₹${finalPrice.toFixed(2)}
                </span>
            `;
        }
    }

    const offerLabel = card.querySelector('.product_offer');
    if (offerLabel) {
        if (discAmount > 0) {
            if (discType == 1) {
                offerLabel.textContent = `-₹${discAmount}`;
            } else {
                offerLabel.textContent = `${discAmount}% OFF`;
            }
            offerLabel.style.display = 'block';
        } else {
            offerLabel.style.display = 'none';
        }
    }

    card.dataset.price = finalPrice;
}

// ========== EVENT LISTENERS ==========
document.addEventListener('DOMContentLoaded', function() {
    // Initialize cart
    initializeCart();

    // Add to cart buttons
    document.querySelectorAll('.add-to-cart-btn').forEach(button => {
        button.addEventListener('click', function() {
            handleAddToCart(this);
        });
    });

    // Quantity buttons
    document.querySelectorAll('.qty-btn1').forEach(btn => {
        btn.addEventListener('click', function() {
            const action = this.dataset.action;
            const qtyInput = this.closest('.qty-group').querySelector('.qty-number');
            let currentQty = parseInt(qtyInput.value) || 1;

            if (action === 'increment') {
                qtyInput.value = currentQty + 1;
            } else if (action === 'decrement' && currentQty > 1) {
                qtyInput.value = currentQty - 1;
            }

            const card = this.closest('.product-item');
            const productId = card.dataset.productId;
            const select = card.querySelector('.qty-select');
            const selectedOption = select.options[select.selectedIndex];
            const price = parseFloat(selectedOption.value);
            const measure = selectedOption.dataset.measure;

            let cart = getCart();
            const idx = cart.findIndex(item => item.id === productId && item.measure === measure && item.price === price);
            if (idx !== -1) {
                cart[idx].quantity = parseInt(qtyInput.value);
                saveCart(cart);
                updateCartCount();
            }
        });
    });

    // Variant selection changes
    document.querySelectorAll('#variantSelect, .qty-select').forEach(select => {
        select.addEventListener('change', function() {
            updatePriceDisplay(this);
        });
    });

    // Initialize all product cards with default variant prices
    document.querySelectorAll('.product-item').forEach(item => {
        const select = item.querySelector('#variantSelect, .qty-select');
        if (select) {
            updatePriceDisplay(select);
        }
    });

    // Subcategory chip clicks
    const chipContainer = document.getElementById('scrollContainer') || document.getElementById('subcategoryContainer');
    if (chipContainer) {
        chipContainer.addEventListener('click', function(e) {
            const btn = e.target.closest('.subcategory-filter-btn');
            if (!btn) return;
            e.preventDefault();
            const subId = btn.getAttribute('data-subcategory') || 'all';
            filterBySubcategory(subId, btn);
        });
    }

    // Sidebar category clicks
    const sidebar = document.getElementById('sidebar');
    if (sidebar) {
        sidebar.querySelectorAll('.myoffcanvas-menu-link').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const onclick = this.getAttribute('onclick') || '';
                const match = onclick.match(/filterByCategory\('([^']+)'\)/);
                if (match && match[1]) {
                    filterByCategory(match[1]);
                }
            });
        });

        sidebar.querySelectorAll('.myoffcanvas-submenu-link').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const onclick = this.getAttribute('onclick') || '';
                const match = onclick.match(/filterBySubcategory\('([^']+)'\)/);
                if (match && match[1]) {
                    filterBySubcategory(match[1]);
                }
            });
        });
    }

    // Scroll buttons for chips
    const prevBtn = document.getElementById('prevBtn4');
    const nextBtn = document.getElementById('nextBtn4');
    if (prevBtn && nextBtn && chipContainer) {
        nextBtn.addEventListener('click', () => {
            chipContainer.scrollBy({ left: 250, behavior: 'smooth' });
        });
        prevBtn.addEventListener('click', () => {
            chipContainer.scrollBy({ left: -250, behavior: 'smooth' });
        });
    }

    // Initialize with category/subcategory from page
    setTimeout(function() {
        const catEl = document.getElementById('category_id');
        const subEl = document.getElementById('subcategory_id');
        const categoryId = catEl ? catEl.textContent.trim() : '';
        const subcategoryId = subEl ? subEl.textContent.trim() : '';

        if (subcategoryId) {
            filterBySubcategory(subcategoryId);
        } else if (categoryId) {
            filterByCategory(categoryId);
        } else {
            // Default to first category or "Fruits"
            const firstCatLink = sidebar?.querySelector('.myoffcanvas-menu-link');
            if (firstCatLink) {
                const onclick = firstCatLink.getAttribute('onclick') || '';
                const match = onclick.match(/filterByCategory\('([^']+)'\)/);
                if (match && match[1]) {
                    filterByCategory(match[1]);
                }
            }
        }
    }, 100);
});
</script>

<?= $this->endSection() ?>