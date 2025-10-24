<?php include(APPPATH . 'Views/templates/config.php'); ?>
<?= $this->extend('templates/page') ?>

<?= $this->section('index') ?>

<style>
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

<div class="container-fluid center-cont spacerm">
    <div class="head-noresults">
        <h2 class="heading-product text-center mb-4">
            <?= isset($title) ? esc($title) : "" ?> Products
            <?php if (!empty($offershow)): ?>
                <span class="badge bg-primary ms-2"><?= esc($offername) ?></span>
            <?php endif; ?>
        </h2>

        <!-- No Results Message -->
        <div class="no-results d-none text-center py-5" id="noResults">
            <i class="bi bi-search display-4 text-muted mb-3"></i>
            <h4 class="mb-2">No products found</h4>
            <p class="text-muted">Try adjusting your filters or search terms</p>
        </div>
    </div>

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
                    <select class="form-select filter-search" id="priceFilter" onchange="filterProducts()">
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
                        <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mb-3 product-item"
                            data-product-id="<?= $product['id'] ?>" data-category-id="<?= $product['category_id'] ?>"
                            data-subcategory-id="<?= $product['subcategory_id'] ?>"
                            data-product-name="<?= strtolower(esc($product['prod_name'])) ?>"
                            data-price="<?= $lowestVariant ? $lowestVariant['price'] : 0 ?>">
                            <!-- Mobile Card -->
                            <div
                                class="card product-card smallview-prod mobile-only shadow-sm border-0 rounded-3 p-2 bg-white position-relative">
                                <div class="d-flex align-items-start">
                                    <div class="me-2 flex-shrink-0 d-flex align-items-center justify-content-center"
                                        style="width:90px;height:90px;">
                                        <img src="<?= $img_url . $product['main_image'] ?>" class="img-fluid rounded border"
                                            data-bs-toggle="modal" data-bs-target="#imagemodel"
                                            alt="<?= esc($product['prod_name']) ?>"
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
                                            <?php if ($variant['disc_price'] > 0): ?>

                                                <div class="product_offer" data-measure="<?= $variant['measure'] ?>"
                                                    style="<?= $variant === $productVariants[0] ? '' : 'display:none;' ?>">
                                                    <?= $variant['disc_type'] == 1 ? '-₹' : '' ?>
                                                    <?= $variant['disc_price'] ?><?= $variant['disc_type'] == 2 ? '%' : '' ?>
                                                </div>
                                        <?php endif;
                                        endforeach; ?>
                                        <?php if ($product['is_variant'] == 1): ?>

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
                                        <?php endif; ?>
                                        <div class="mb-2 prodprice mb-lg-4">
                                            <?php
                                            // Show final price of first/default variant
                                            $firstVariant = $productVariants[0] ?? null;
                                            if ($firstVariant) {
                                            $originalPrice =  $product['is_variant'] == 1 ? $firstVariant['price'] : $product['prod_price'];

                                            $firstVariant['disc_price'] =  $product['is_variant'] == 1 ? $firstVariant['disc_price'] : $product['disc_value'];
                                            $firstVariant['disc_type'] =  $product['is_variant'] == 1 ? $firstVariant['disc_type'] : $product['disc_type'];
                                                
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
                                    <img src="<?= $img_url . $product['main_image'] ?>" class="card-img-top"
                                        alt="<?= esc($product['prod_name']) ?>"
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
                                        <div class="product_offer" data-measure="<?= $variant['measure'] ?>"
                                            style="<?= $variant === $productVariants[0] ? '' : 'display:none;' ?>">
                                            <?= $variant['disc_type'] == 1 ? '-₹' : '' ?>
                                            <?= $variant['disc_price'] ?><?= $variant['disc_type'] == 2 ? '%' : '' ?>
                                        </div>
                                    <?php endforeach; ?>

                                    <?php if ($product['is_variant'] == 1): ?>

                                        <div class="mb-3 text-center">

                                            <select class="form-select  qty-select rounded-pill bg-light border-0 px-2 mx-auto"
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
                                                    <option value="<?= $finalPrice ?>" data-measure="<?= esc($variant['measure']) ?>"
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
                                        <!-- <div class="text-center">
                                    <span class="fw-semibold">
                                        <= esc($productVariants[0]['measure']) ?>
                                    </span>  -->


                                    <?php endif; ?>

                                    <div class="mb-2 text-center prodprice mb-lg-4">
                                        <?php
                                        // Show final price of first/default variant
                                        $firstVariant = $productVariants[0] ?? null;
                                        if ($firstVariant) {
                                            $originalPrice =  $product['is_variant'] == 1 ? $firstVariant['price'] : $product['prod_price'];

                                            $firstVariant['disc_price'] =  $product['is_variant'] == 1 ? $firstVariant['disc_price'] : $product['disc_value'];
                                            $firstVariant['disc_type'] =  $product['is_variant'] == 1 ? $firstVariant['disc_type'] : $product['disc_type'];
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



<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sliderWrapper = document.getElementById('subcategoryContainer');
        const prevBtn = document.getElementById('prevBtn4');
        const nextBtn = document.getElementById('nextBtn4');

        const scrollAmount = 250; // pixels to scroll each click

        nextBtn.addEventListener('click', () => {
            sliderWrapper.scrollBy({
                left: scrollAmount,
                behavior: 'smooth'
            });
        });

        prevBtn.addEventListener('click', () => {
            sliderWrapper.scrollBy({
                left: -scrollAmount,
                behavior: 'smooth'
            });
        });
    });
</script>

<script>
    let currentCategoryFilter = 'all';
    let currentSubcategoryFilter = 'all';
    let currentSearchTerm = '';
    let currentPriceFilter = '';

    // Initialize filter system
    document.addEventListener('DOMContentLoaded', function() {
        updateProductCount();

        // Add event listeners for add to cart buttons
        document.querySelectorAll('.add-to-cart-btn').forEach(button => {
            button.addEventListener('click', function() {
                const card = this.closest('.product-item');
                const productId = card.dataset.productId;
                const productName = card.querySelector('.product-name, .product-name-s')
                    .textContent;
                const select = card.querySelector('.qty-select');
                const selectedOption = select.options[select.selectedIndex];
                const price = selectedOption.value;
                const measure = selectedOption.dataset.measure;

                addToCart(productId, productName, price, measure);
            });
        });
    });

    // Subcategory filtering
    function filterBySubcategory(subcategoryId, buttonElement = null) {
        currentSubcategoryFilter = subcategoryId;

        // Update button states
        if (buttonElement) {
            document.querySelectorAll('.subcategory-filter-btn').forEach(btn => btn.classList.remove('active'));
            buttonElement.classList.add('active');
        }

        // Filter products
        filterProducts();
    }

    // Category filtering
    function filterByCategory(categoryId) {
        currentCategoryFilter = categoryId;
        filterProducts();
        updateSubcategoryVisibility(categoryId);
    }

    // Update subcategory visibility based on selected category
    function updateSubcategoryVisibility(categoryId) {
        // Get category name from categories data (this would need to be implemented)
        // For now, we'll just show all subcategories when a category is selected
        document.querySelectorAll('.subcategory-filter-btn').forEach(btn => {
            if (categoryId === 'all' || btn.dataset.subcategory === 'all') {
                btn.style.display = 'inline-block';
            } else {
                // In a real implementation, you would check if the subcategory belongs to the category
                btn.style.display = 'inline-block';
            }
        });
    }

    // Main product filtering function
    function filterProducts() {
        const searchTerm = document.getElementById('productSearch')?.value.toLowerCase() || '';
        const priceFilter = document.getElementById('priceFilter').value;

        currentSearchTerm = searchTerm;
        currentPriceFilter = priceFilter;

        const productItems = document.querySelectorAll('.product-item');
        let visibleCount = 0;

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

            // Show/hide item
            if (showItem) {
                item.style.display = '';
                visibleCount++;
            } else {
                item.style.display = 'none';
            }
        });

        // Show/hide no results message
        const noResults = document.getElementById('noResults');
        const sidebar = document.getElementById('sidebar');
        if (visibleCount === 0) {
            noResults.classList.remove('d-none');
            sidebar.classList.add('d-none');
        } else {
            noResults.classList.add('d-none');
            sidebar.classList.remove('d-none');
        }

        updateProductCount();
    }

    // Check if price matches filter
    function matchesPriceFilter(price, filter) {
        switch (filter) {
            case '0-50':
                return price >= 0 && price <= 50;
            case '50-100':
                return price > 50 && price <= 100;
            case '100-200':
                return price > 100 && price <= 200;
            case '200-500':
                return price > 200 && price <= 500;
            case '500+':
                return price > 500;
            default:
                return true;
        }
    }





    // Initialize cart on page load
    document.addEventListener('DOMContentLoaded', function() {
        initializeCart();

        // Add event listeners for variant selection changes
        document.querySelectorAll('#variantSelect, .qty-select').forEach(select => {
            select.addEventListener('change', function() {
                updatePriceDisplay(this);
            });
        });
    });

    // Update price display when variant is changed
    function updatePriceDisplay(selectElement) {
        const card = selectElement.closest('.product-item');
        const selectedOption = selectElement.options[selectElement.selectedIndex];
        const originalPrice = parseFloat(selectedOption.dataset.originalPrice);
        const discAmount = parseFloat(selectedOption.dataset.disc || 0);
        const discType = selectedOption.dataset.discType;

        // Calculate final price based on discount
        let finalPrice = originalPrice;
        if (discAmount > 0) {
            if (discType == 1) { // Fixed amount discount
                finalPrice = originalPrice - discAmount;
            } else { // Percentage discount
                finalPrice = originalPrice - (discAmount * originalPrice / 100);
            }
        }

        // Update the select option value with calculated price
        selectedOption.value = finalPrice;

        // Update price display in the card
        const priceElement = card.querySelector('.prodprice');
        if (priceElement) {
            if (discAmount > 0) {
                // Show strikethrough original price and discounted price
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
                // Just show the regular price
                priceElement.innerHTML = `
                <span class="product-price fw-bold fs-6 text-success">
                    ₹${finalPrice.toFixed(2)}
                </span>
            `;
            }
        }

        // Update offer label
        const offerLabel = card.querySelector('.product_offer');
        if (offerLabel) {
            if (discAmount > 0) {
                // Show offer label with discount
                if (discType == 1) {
                    offerLabel.textContent = `-₹${discAmount}`;
                } else {
                    offerLabel.textContent = `${discAmount}% OFF`;
                }
                offerLabel.style.display = 'block';
            } else {
                // Hide offer label if no discount
                offerLabel.style.display = 'none';
            }
        }

        // Update data-price attribute for filtering
        card.dataset.price = finalPrice;
    }

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        // Add event listeners for variant selection changes
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
    });
</script>

<script>
    // --- CART STORAGE HELPERS ---
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
        const totalItems = cart.reduce((total, item) => total + item.quantity, 0);
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
        const select = card.querySelector('.qty-select');
        const selectedOption = select.options[select.selectedIndex];
        const price = parseFloat(selectedOption.value);
        const measure = selectedOption.getAttribute('data-measure');
        const image = card.querySelector('img')?.src || '';
        const imageName = card.querySelector('#image_name')?.value || '';

        let cart = getCart();
        const existingItemIndex = cart.findIndex(item => item.id === productId && item.measure === measure);

        if (existingItemIndex !== -1) {
            // Keep quantity as-is; UI will reveal current quantity
        } else {
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

        const toastEl = document.getElementById('cart-toast');
        if (toastEl && window.bootstrap?.Toast) {
            const toast = new bootstrap.Toast(toastEl);
            const toastBody = toastEl.querySelector('.toast-body');
            if (toastBody) toastBody.textContent = `${productName} (${measure}) added to cart`;
            toast.show();
        }

        toggleCartUI(card, true, existingItemIndex !== -1 ? cart[existingItemIndex].quantity : 1);
    }

    // --- ADD TO CART helper (used by multiple listeners) ---
    function addToCart(productId, productName, price, measure, image) {
        let cart = getCart();
        const priceNum = parseFloat(price);
        const index = cart.findIndex(item => item.id === productId && item.measure === measure && item.price === priceNum);

        if (index !== -1) {
            cart[index].quantity += 1;
        } else {
            cart.push({
                id: productId,
                name: productName,
                price: priceNum,
                measure,
                image,
                quantity: 1
            });
        }

        saveCart(cart);
        updateCartCount();
    }

    // --- MAIN ADD TO CART FUNCTION ---
    // --- INCREMENT / DECREMENT ---
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

            // Reflect change in cart storage immediately
            const card = this.closest('.product-item');
            const productId = card.dataset.productId;
            const productName = card.querySelector('.product-name, .product-name-s').textContent.trim();
            const select = card.querySelector('.qty-select');
            const selectedOption = select.options[select.selectedIndex];
            const price = parseFloat(selectedOption.value);
            const measure = selectedOption.dataset.measure;
            const image = card.querySelector('img').src;

            let cart = getCart();
            const idx = cart.findIndex(item => item.id === productId && item.measure === measure && item
                .price === price);
            if (idx !== -1) {
                cart[idx].quantity = parseInt(qtyInput.value);
                saveCart(cart);
                updateCartCount();
            } else {
                // If somehow not in cart yet (e.g., user clicked +/- before add), add it now with shown qty
                cart.push({
                    id: productId,
                    name: productName,
                    price,
                    measure,
                    image,
                    quantity: parseInt(qtyInput.value)
                });
                saveCart(cart);
                updateCartCount();
            }
        });
    });

    // --- ADD TO CART ---
    document.querySelectorAll('.add-to-cart-btn').forEach(button => {
        button.addEventListener('click', function() {
            handleAddToCart(this);
        });
    });

    // --- OPTIONAL: Update cart when quantity changes ---
    document.querySelectorAll('.qty-number').forEach(input => {
        input.addEventListener('change', function() {
            const card = this.closest('.product-item');
            const productId = card.dataset.productId;
            const productName = card.querySelector('.product-name, .product-name-s').textContent.trim();
            const select = card.querySelector('.qty-select');
            const selectedOption = select.options[select.selectedIndex];
            const price = selectedOption.value;
            const measure = selectedOption.dataset.measure;
            const image = card.querySelector('img').src;

            // Update cart quantity (overwrite existing)
            let cart = getCart();
            const index = cart.findIndex(item => item.id === productId && item.measure === measure);
            if (index !== -1) {
                cart[index].quantity = parseInt(this.value);
                saveCart(cart);
                updateCartCount();
            }
        });
    });




    const shop_cart = "<?= $shop_url_name ?>";

    document.querySelectorAll(".add-to-cart-btn").forEach(button => {
        button.addEventListener("click", () => {
            localStorage.setItem("shop_cart", shop_cart);
        });
    });

    // console.log("shop:", localStorage.getItem("shop_cart"));
    // console.log("shop:", shop_cart);

    document.querySelectorAll('.qty-select').forEach(function(select) {
        select.addEventListener('change', function() {
            var selected = this.options[this.selectedIndex];
            var originalPrice = parseFloat(selected.getAttribute('data-original-price')) || 0;
            var disc = parseFloat(selected.getAttribute('data-disc')) || 0;
            var discType = selected.getAttribute('data-disc-type');
            var displayDiv = this.closest('.product-card').querySelector('.selected-price-display');

            var finalPrice = originalPrice;
            if (disc > 0) {
                if (discType === '1') {
                    finalPrice = originalPrice - disc;
                } else if (discType === '2') {
                    finalPrice = originalPrice - (originalPrice * disc / 100);
                }
            }

            if (disc > 0) {
                displayDiv.innerHTML = `
                <span class="text-muted" style="text-decoration: line-through;">
                    ₹${originalPrice.toFixed(2)}
                </span>
                &nbsp;
                <span class="product-price fw-bold fs-6 text-success">
                    ₹${finalPrice.toFixed(2)}
                </span>
            `;
            } else {
                displayDiv.innerHTML = `
                <span class="product-price fw-bold fs-6 text-success">
                    ₹${finalPrice.toFixed(2)}
                </span>
            `;
            }

            const card = this.closest('.product-card');
            if (!card) return;

            const selectedMeasure = selected.getAttribute('data-measure');

            // Hide all offers first
            card.querySelectorAll('.product_offer').forEach(function(offerDiv) {
                offerDiv.style.display = 'none';
            });

            // Show only the offer for selected measure, if present
            const offerDiv = card.querySelector('.product_offer[data-measure="' + selectedMeasure + '"]');
            if (offerDiv) {
                offerDiv.style.display = '';
            }
        });
    });
</script>



<?= $this->endSection() ?>