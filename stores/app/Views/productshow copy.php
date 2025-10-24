<?php include(APPPATH . 'Views/templates/config.php'); ?>
<?= $this->extend('templates/page') ?>

<?= $this->section('index') ?>

<style>
    .sidebar {
        width: 320px !important;
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
        background: #E95F62;
        color: white;
        transition: color 0.3s ease, background 0.3s ease;
        border: 1px solid #E95F62;
        padding: 0.25rem 0.75rem;
        border-radius: 0.375rem;
        white-space: nowrap;
    }

    .btnadd:hover {
        color: #E95F62 !important;
        background: white;
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
        background-color: #E95F62;
        color: white;
        border-color: #E95F62;
    }

    /* Product card layout improvements */
    .desktop-card-content {
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .desktop-card-img-container {
        flex: 0 0 auto;
        height: 180px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 15px;
        background: #f8f9fa;
        border-radius: 8px 8px 0 0;
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
        #productContainer {
            padding-left: 1px;
        }

        #productContainer {
            margin-left: 800px !important;

            padding-left: 200px !important;

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
        position: absolute !important;
        top: 25% !important;
        left: 50%;
    }

    .heading-product {
        position: relative !important;
        top: 50% !important;
        left: 11%;
    }
</style>
<style>
    /* Base styles */
    * {
        box-sizing: border-box;
    }

    /* Sidebar styles */
    .sidebar {
        width: 320px !important;
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
        background: #E95F62;
        color: white;
        transition: all 0.3s ease;
        border: 1px solid #E95F62;
        padding: 0.375rem 0.75rem;
        border-radius: 0.375rem;
        white-space: nowrap;
        font-weight: 500;
    }

    .btnadd:hover {
        color: #E95F62 !important;
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
        height: 200px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 15px;
        background: #f8f9fa;
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
            padding-left: 8px;
            padding-right: 8px;
        }

        #productContainer1 {
            margin-left: 0 !important;
            margin-top: 20px;
        }

        .sidebar {
            position: relative;
            top: 0;
            max-height: none;
            margin-bottom: 20px;
            width: 100% !important;
            padding: 15px;
        }

        .sidebar {
            display: none;
        }

        .cat {
            max-width: 100% !important;
            margin-bottom: 1rem;
        }

        .heading-product {
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        /* Mobile card adjustments */
        .product-item {
            margin-bottom: 0.75rem;
        }

        .card.desktopd {
            padding: 10px;
            margin-bottom: 15px;
        }

        .card.desktopd .d-flex {
            gap: 10px;
        }

        .card.desktopd img {
            width: 80px;
            height: 80px;
        }

        .product-name-s {
            font-size: 0.9rem;
            line-height: 1.2;
            margin-bottom: 0.5rem;
        }

        .qty-select {
            font-size: 0.8rem;
            padding: 0.25rem 0.5rem;
        }

        .btnadd {
            padding: 0.25rem 0.5rem;
            font-size: 0.8rem;
        }

        .product-price {
            font-size: 0.9rem;
        }

        .spacerm {
            margin-top: 40%;
        }

        .head-noresults {

            top: 25% !important;
            left: 35% !important;

        }
    }

    /* Small devices (landscape phones, 576px and up) */
    @media (min-width: 576px) and (max-width: 767.98px) {
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

        .card-img-top {
            height: 130px;
        }

        .desktop-card-img-container {
            height: 160px;
        }
    }




    /* Medium devices (tablets, 768px and up) */
    @media (min-width: 768px) and (max-width: 991.98px) {
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
        }

        .desktop-card-img-container {
            height: 180px;
        }
    }

    /* Large devices (desktops, 992px and up) */
    @media (min-width: 992px) and (max-width: 1199.98px) {
        .sidebar {
            position: sticky;
            top: 20px;
            max-height: calc(100vh - 40px);
        }

        #productContainer1 {
            margin-left: 20px;
        }

        .desktop-card-img-container {
            height: 170px;
        }

        .spacerm {
            margin-top: 200px;
        }
    }

    /* Extra large devices (large desktops, 1200px and up) */
    @media (min-width: 1200px) {
        .sidebar {
            position: sticky;
            top: 20px;
            max-height: calc(100vh - 40px);
        }

        /* #productContainer1 {
            margin-left: 40px;
        } */

        .desktop-card-img-container {
            height: 200px;
        }

        .spacerm {
            margin-top: 58px;
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
            font-size: 0.8rem;
            padding: 0.375rem 0.5rem;
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
            --bs-gutter-x: 0.5rem;
            --bs-gutter-y: 0.75rem;
        }
    }

    .head-noresults {

        position: absolute;
        top: 22%;
        left: 53%;

    }
</style>

<div class="container-fluid center-cont spacerm">
    <div class="head-noresults">
        <h2 class="heading-product text-center mb-4 overflow-hidden">
            Products
            <?php if (!empty($offershow)): ?>
                <span class="badge bg-primary"><?= esc($offername) ?></span>
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
            <div class="sidebar">
                <label class="form-label fw-bold ps-2">Categories</label>
                <ul class="list-unstyled">
                    <?php foreach ($categories as $category): ?>
                        <li class="myoffcanvas-menu-item myoffcanvas-has-submenu">
                            <a href="#" class="myoffcanvas-menu-link d-flex justify-content-between align-items-center"
                                onclick="filterByCategory('<?= $category['category_id'] ?>')">
                                <span><?= esc($category['category_name']) ?></span>
                                <span class="plus-menu">+</span>
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
        if (!empty($prodAll)) {
            $products = $allproducts;
            $variants = $allvariants;
        } else {
            $products = $product;
            $variants = $variant;
        }
        ?>

        <!-- Product area -->
        <div class="col-12 col-lg-9 col-xl-9" style="min-height:30vh;">
            <div class="row gx-3 gy-4" id="productContainer1">
                <?php if (!empty($products)): ?>
                    <?php foreach ($products as $product): ?>
                        <?php
                        // Find lowest variant price for product
                        $lowestPrice = null;
                        if (isset($allvariants) && is_array($allvariants)) {
                            foreach ($allvariants as $variant) {
                                if (isset($variant['prod_id']) && $variant['prod_id'] == $product['id']) {
                                    if ($lowestPrice === null || $variant['price'] < $lowestPrice) {
                                        $lowestPrice = $variant['price'];
                                    }
                                }
                            }
                        }
                        ?>

                        <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mb-3 product-item"
                            data-product-id="<?= $product['id'] ?>" data-category-id="<?= $product['category_id'] ?>"
                            data-subcategory-id="<?= $product['subcategory_id'] ?>"
                            data-product-name="<?= strtolower(esc($product['prod_name'])) ?>"
                            data-price="<?= $lowestPrice ?? 0 ?>">

                            <!-- Mobile Card -->
                            <div
                                class="card product-card mobile-only shadow-sm border-0 rounded-3 p-2 bg-white position-relative">
                                <div class="d-flex align-items-start">
                                    <div class="me-2 flex-shrink-0 d-flex align-items-center justify-content-center"
                                        style="width:90px;height:90px;">
                                        <img src="<?= $img_url . $product['main_image'] ?>" class="img-fluid rounded border"
                                            alt="<?= esc($product['prod_name']) ?>"
                                            style="object-fit:contain; cursor:pointer; background:#f8f9fa; max-width:100%; max-height:100%;">
                                    </div>
                                    <div class="flex-grow-1 d-flex flex-column">
                                        <div class="mb-2">
                                            <strong class="product-name-s d-block" style="font-size:0.9rem; line-height:1.3;">
                                                <?= esc($product['prod_name']) ?>
                                            </strong>
                                        </div>
                                        <div class="mb-2">
                                            <select class="form-select-sm qty-select w-100 rounded-pill bg-light border-0 px-2"
                                                style="font-size:0.8rem;">
                                                <?php
                                                $lowestVariant = null;
                                                if (isset($allvariants) && is_array($allvariants)) {
                                                    foreach ($allvariants as $variant) {
                                                        if (isset($variant['prod_id']) && $variant['prod_id'] == $product['id']) {
                                                            if ($lowestVariant === null || $variant['price'] < $lowestVariant['price']) {
                                                                $lowestVariant = $variant;
                                                            }
                                                            ?>
                                                            <option value="<?= $variant['price'] ?>"
                                                                data-measure="<?= esc($variant['measure']) ?>">
                                                                <?= esc($variant['measure']) ?> - ₹<?= $variant['price'] ?>
                                                            </option>
                                                            <?php
                                                        }
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="product-price fw-bold text-success" style="font-size:0.9rem;">
                                                ₹<?= $lowestVariant ? $lowestVariant['price'] : 'N/A' ?>
                                            </span>
                                            <button class="btn btnadd btn-sm add-to-cart-btn fw-semibold"
                                                id="addCart2">Add</button>
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
                                        style="max-height: 100%; max-width: 100%; object-fit: contain;">
                                </div>
                                <div class="desktop-card-body">
                                    <h6 class="product-name mb-3 text-center"
                                        style="min-height: 2.5rem; font-size:0.95rem; line-height:1.3;">
                                        <?= esc($product['prod_name']) ?>
                                    </h6>
                                    <div class="mb-3 text-center">
                                        <select
                                            class="form-select form-select-sm qty-select rounded-pill bg-light border-0 px-2 mx-auto"
                                            style="width: fit-content; min-width:120px; font-size:0.8rem;">
                                            <?php foreach ($allvariants as $variant):
                                                if (isset($variant['prod_id']) && $variant['prod_id'] == $product['id']): ?>
                                                    <option value="<?= $variant['price'] ?>"
                                                        data-measure="<?= esc($variant['measure']) ?>">
                                                        <?= esc($variant['measure']) ?> - ₹<?= $variant['price'] ?>
                                                    </option>
                                                <?php endif;
                                            endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="mb-3 text-center">
                                        <span class="product-price fw-bold fs-6 text-success">
                                            ₹<?= $lowestVariant ? $lowestVariant['price'] : 'N/A' ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="desktop-card-footer">
                                    <button class="btn btnadd add-to-cart-btn w-75" id="addCart1">Add to Cart</button>
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
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
    document.addEventListener('DOMContentLoaded', function () {
        updateProductCount();

        // Add event listeners for add to cart buttons
        document.querySelectorAll('.add-to-cart-btn').forEach(button => {
            button.addEventListener('click', function () {
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
        if (visibleCount === 0) {
            noResults.classList.remove('d-none');
        } else {
            noResults.classList.add('d-none');
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
    document.addEventListener('DOMContentLoaded', function () {
        initializeCart();
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

    // --- MAIN ADD TO CART FUNCTION ---
    function addToCart(productId, productName, price, measure, image) {
        let cart = getCart();
        let encodedShop = btoa("<?= $shop_url_name ?>");


        const existingIndex = cart.findIndex(item =>
            item.id === productId && item.measure === measure
        );

        if (existingIndex !== -1) {
            cart[existingIndex].quantity += 1; // ✅ increment properly
        } else {
            cart.push({
                id: productId,
                name: productName,
                price: parseFloat(price),
                measure: measure,
                quantity: 1,
                image: image
            });
        }
        localStorage.setItem("cart_shop", encodedShop);

        saveCart(cart);
        updateCartCount();

        // ✅ Show bootstrap toast if exists
        const toastEl = document.getElementById('cart-toast');
        if (toastEl) {
            const toast = new bootstrap.Toast(toastEl);
            const toastBody = toastEl.querySelector('.toast-body');
            if (toastBody) {
                toastBody.textContent = `${productName} (${measure}) added to cart`;
            }
            toast.show();
        }
    }

    // --- INITIALIZE BUTTON EVENTS ---
    document.addEventListener('DOMContentLoaded', function () {
        updateCartCount();

        document.querySelectorAll('.add-to-cart-btn').forEach(button => {
            button.addEventListener('click', function () {
                const card = this.closest('.product-item');
                const productId = card.dataset.productId;
                const productName = card.querySelector('.product-name, .product-name-s').textContent.trim();
                const select = card.querySelector('.qty-select');
                const selectedOption = select.options[select.selectedIndex];
                const price = selectedOption.value;
                const measure = selectedOption.dataset.measure;
                const image = card.querySelector('img').src;

                addToCart(productId, productName, price, measure, image);
            });
        });
    });
</script>

<?= $this->endSection() ?>


