<?php include(APPPATH . 'Views/templates/config.php'); ?>
<?= $this->extend('templates/page') ?>
<?= $this->section('index') ?>
<?php
$image_url = $img_url;
?>

<style>
    /* .shop-categories {
        padding: 40px 16px 50px;
        text-align: center;
    } */

    .shop-categories h3 {
        margin-top: 16px !important;
        margin-bottom: 16px !important;
        font-size: 20px;
    }

    .category-grid {
        display: flex;
        justify-content: space-around;
        flex-wrap: wrap;
        gap: 10px;
    }

    .category-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin: 10px;
        font-size: 14px;
        cursor: pointer;
    }

    .category-item img {
        width: 90px;
        height: 90px;
        border-radius: 50%;
        border: 1px solid rgb(46, 228, 143);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        background: #f0f0f0;
        object-fit: cover;
    }


    .category-item span {
        margin-top: 6px;
    }

    .product-name {

        white-space: nowrap;
        /* Prevents the text from wrapping to the next line */
        overflow: hidden;
        /* Hides the part of the text that doesn't fit */
        text-overflow: ellipsis;
        /* Adds "..." at the end of truncated text */
        max-width: 200px;
        /* Set a suitable fixed or max width for truncation */
        display: block;
        /* Ensures proper behavior of ellipsis */

    }


    @keyframes fadeOut {
        0% {
            opacity: 1;
        }

        80% {
            opacity: 1;
        }

        100% {
            opacity: 0;
            display: none;
        }
    }


    .qty-select {
        max-width: 120px;
        text-align: center !important;
    }


    @media (max-width: 576px) {
        .mobile-bottom {
            margin-bottom: 100px !important;
        }

        .mobile-topp {
            margin-top: 100px !important;
        }

        .shop_name {
            left: 20% !important;
        }
    }

    .ct-add {
        position: absolute !important;
        top: 70% !important;
        right: 10%;

    }

    .shop_name {
        position: absolute;
        top: 10%;
        left: 40%;
        color: #fad506ff;
        /* use white for contrast */
        font-size: 38px;
        /* slightly bigger for visibility */
        font-weight: 900;
        text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.6);
        z-index: 800;
        letter-spacing: 1px;
    }

    .prodprice {
        position: absolute;
        bottom: 5% !important;
        left: 5% !important;

    }

    #addCart2,
    .addCart2 {
        position: absolute;
        bottom: 5% !important;
        right: 5% !important;
        width: 25% !important;

    }
</style>

<?php
// echo "<pre>", print_r($variants, true), "</pre>"; die;
?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="flash-popup-error alert alert-error" style="text-transform: capitalize;">
        <?= session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>
<!-- Carousel -->
<div id="carouselExampleAutoplaying" class="carousel slide mx-auto mt-2 mobile-topp" data-bs-ride="carousel"
    style="width: 95%; margin-top: 20px;">
    <div class="shop_name">
        <h1><?= $shop_name ?></h1>
    </div>
    <div class="carousel-inner">
        <?php if (isset($banner) && !empty($banner)):
            foreach ($banner as $index => $b): ?>
                <div class="carousel-item <?= $index == 0 ? 'active' : '' ?>">
                    <a href="<?= $b['banner_link'] ?>">
                        <img src="<?= $img_url . $b['image'] ?>" class="d-block w-100" alt="Banner <?= $index + 1 ?>">
                    </a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <a href="javascript:void(0)">
                <img src="<?= $site_url . 'public/images/imgc4e72180b95ad248e349.jpeg' ?>" class="d-block w-100"
                    alt="Banner ">
            </a>

        <?php endif; ?>
    </div>

    <!-- Only show controls if there are multiple banners -->
    <?php if (isset($banner) && count($banner) > 1): ?>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    <?php endif; ?>
</div>

<!-- Offer Cards Section -->

<div class="container my-5" style="max-width: 95%;">
    <!-- Enhanced Header -->
    <div class="offers-header">
        <h2 class="mb-0">
            <a href="#offers-page"> Special Offers</a>
        </h2>
    </div>

    <!-- Offers Grid -->
    <div class="row g-4">
        <!-- Offer 1: Buy 1 Get 1 -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="offer-card p-4 text-white rounded-3 bg-gradient-success position-relative"
                onclick="handleOfferClick('nandhini-bogo')" role="button" tabindex="0"
                aria-label="Buy 1 Get 1 offer on Nandhini products">
                <div class="offer-badge">B1G1</div>
                <h5>Buy 1 Get 1</h5>
                <p>On all Nandhini products</p>
            </div>
        </div>

        <!-- Offer 2: Fruits & Veggies -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="offer-card p-4 text-white rounded-3 bg-gradient-info position-relative"
                onclick="handleOfferClick('fresh-produce-20')" role="button" tabindex="0"
                aria-label="20% off on fresh fruits and vegetables">
                <div class="offer-badge">20%</div>
                <h5>Flat 20% Off</h5>
                <p>Fresh Fruits & Veggies</p>
            </div>
        </div>

        <!-- Offer 3: Tea Offer -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="offer-card p-4 rounded-3 bg-gradient-warning position-relative"
                onclick="handleOfferClick('tea-combo')" role="button" tabindex="0"
                aria-label="Buy 2 get 1 free tea offer">
                <div class="offer-badge">B2G1</div>
                <h5>Tea Offer</h5>
                <p>Buy 2 get 1 free</p>
            </div>
        </div>

        <!-- Offer 4: Ghee Combo -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="offer-card p-4 text-white rounded-3 bg-gradient-danger position-relative"
                onclick="handleOfferClick('ghee-combo')" role="button" tabindex="0"
                aria-label="Ghee combo offer up to 100 rupees off">
                <div class="offer-badge">₹100</div>
                <h5>Ghee Combo</h5>
                <p>Up to ₹100 off</p>
            </div>
        </div>
    </div>

    <!-- Call to Action -->
    <div class="text-center mt-4">
        <a href="<?= $shop_url ?>/offers/products" class="btn blink-btn  btn-lg">
            View All Offers →
        </a>
    </div>
</div>

<!-- Toast for Cart Feedback -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1100">
    <div id="cart-toast" class="toast align-items-center text-bg-primary border-0" role="alert" aria-live="assertive"
        aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body"></div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                aria-label="Close"></button>
        </div>
    </div>
</div>


<div class="shop-categories container" style="background-color: #f8f9fa; padding: 20px; border-radius: 10px; ">
    <h3 class="category-header">Shop by Category</h3>
    <div class="category-grid">

        <?php if (!empty($categories)): ?>
            <?php foreach ($categories as $category): ?>
                <a class="text-decoration-none text-dark"
                    href="<?= base_url($shop_url_name . '/category/' . $category['category_id']) ?>">
                    <div class="category-item">
                        <img src="<?= esc($image_url . $category['category_image']) ?>"
                            alt="<?= esc($category['category_name']) ?>" width="100" height="100" />

                        <span><?= esc($category['category_name']) ?></span>
                    </div>
                </a>
            <?php endforeach; ?>
        <?php else: ?>
            No Categories Found

        <?php endif; ?>
    </div>
</div>


<!-- Product Section -->
<div class="h2 text-center mt-3">Products</div>
<div class="container-lg  products-container">
    <div class="row g-4">
        <!-- Product Card -->
        <?php foreach ($products as $product): ?>
            <!-- Info Modal -->
            <div class="modal fade" id="infoModal<?= $product['id'] ?>" tabindex="-1"
                aria-labelledby="infoModalLabel<?= $product['id'] ?>" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="card-product-names" id="infoModalLabel<?= $product['id'] ?>">
                                <?= $product['prod_name'] ?>
                            </h6>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <?= $product['description'] ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Image Modal -->
            <div class="modal fade" id="imageModal<?= $product['id'] ?>" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="card-product-names modal-title"><?= $product['prod_name'] ?></h6>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center">
                            <img src="<?= $image_url . $product['main_image'] ?>" class="img-fluid"
                                alt="<?= $product['prod_name'] ?>" style="max-height: 70vh;"
                                onerror="this.onerror=null;this.src='<?= $img_sat ?>no-image.jpg';">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="product-item" data-product-id="<?= $product['id'] ?>">
                    <div
                        class="card product-card smallview-prod shadow-sm border-0 rounded-4 p-3  bg-white position-relative">
                        <div class="d-flex align-items-start h-100">
                            <!-- Image triggers modal -->
                            <div class="me-3 flex-shrink-0 d-flex align-items-center justify-content-center"
                                style="width: 100px; height: 100px;">
                                <img src="<?= $image_url . $product['main_image'] ?>"
                                    class="card-img-top img-fluid rounded border" alt="<?= $product['prod_name'] ?>"
                                    style="width: 100%; height: 100%; object-fit: contain; padding: 8px; background: #f8f9fa; cursor:pointer;"
                                    data-bs-toggle="modal" data-bs-target="#imageModal<?= $product['id'] ?>"
                                    data-id="<?= $product['id'] ?>"
                                    onerror="this.onerror=null;this.src='<?= $img_sat ?>no-image.jpg';">
                                <input type="hidden" id="image_name" name="image_name"
                                    value="<?= $product['main_image'] ?>">
                            </div>
                            <div class="flex-grow-1 d-flex flex-column h-100">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <button class="btn btn-link p-0 ms-2 infom2" data-bs-toggle="modal"
                                        data-bs-target="#infoModal<?= $product['id'] ?>">
                                        <i class="bi bi-info-circle-fill text-primary" style="font-size: 1.2rem;"></i>
                                    </button>
                                    <strong class="product-name text-truncate "
                                        style="font-size:0.8rem;"><?= $product['prod_name'] ?></strong>
                                </div>


                                        <?php if ($product['is_variant'] == 1): ?>

                                <div class="mb-2">
                                    <select class="form-select form-select qty-select rounded-pill bg-light border-0 px-2"
                                        style="font-size: 0.98rem;">
                                        <?php
                                        $lowestVariant = null;
                                        $productVariants = [];

                                        // Extract variants for current product from the nested structure
                                        foreach ($variants as $variantGroup) {
                                            if (is_array($variantGroup)) {
                                                foreach ($variantGroup as $variant) {
                                                    if (isset($variant['prod_id']) && $variant['prod_id'] == $product['id']) {
                                                        $productVariants[] = $variant;
                                                        if ($lowestVariant === null || $variant['price'] < $lowestVariant['price']) {
                                                            $lowestVariant = $variant;
                                                        }
                                                    }
                                                }
                                            }
                                        }

                                        // Generate options for the current product
                                        foreach ($productVariants as $variant):
                                            // Calculate final price with discount
                                            $originalPrice = $variant['price'];
                                            $finalPrice = $originalPrice;

                                            if (!empty($variant['disc_price']) && $variant['disc_price'] > 0) {
                                                if ($variant['disc_type'] == 1) { // Fixed amount discount
                                                    $finalPrice -= $variant['disc_price'];
                                                } else { // Percentage discount
                                                    $finalPrice -= ($variant['disc_price'] * $originalPrice / 100);
                                                }
                                            }
                                        ?>
                                            <option value="<?= $finalPrice ?>" data-measure="<?= $variant['measure'] ?>"
                                                data-id="<?= $product['id'] ?>" data-original-price="<?= $originalPrice ?>"
                                                data-disc="<?= !empty($variant['disc_price']) ? $variant['disc_price'] : 0 ?>"
                                                data-disc-type="<?= $variant['disc_type'] ?>">
                                                <?= $variant['measure'] ?>
                                                <!-- - ₹<= number_format($finalPrice, 2) ?> -->
                                            </option>
                                        <?php endforeach; ?>
                                    </select>

                                </div>
                                        <?php endif; ?>

                                <?php foreach ($productVariants as $variant): ?>
                                    <?php if ($variant['disc_price'] > 0): ?>
                                        <div class="product_offer" data-measure="<?= $variant['measure'] ?>"
                                            style="<?= $variant === $productVariants[0] ? '' : 'display:none;' ?>">
                                            <?= $variant['disc_type'] == 1 ? '-₹' : '' ?>
                                            <?= $variant['disc_price'] ?><?= $variant['disc_type'] == 2 ? '%' : '' ?>
                                        </div>
                                <?php endif;
                                endforeach; ?>
                            </div>
                            <div class="mb-2 prodpriceh">
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



                                <div class=" selected-price-display">
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
                            <div class="mt-auto d-flex align-items-center gap-2 ct-add ">
                                <button class="btn btnadd btn-sm add-to-cart-btn  fw-semibold text-white" id="addCart3"
                                    style="width: 80px; font-size:0.9rem;">
                                    Add
                                </button>
                                <div class="input-group input-group-sm qty-group d-none" style="max-width: 110px;">
                                    <button class="btn btn-outline-secondary qty-btn rounded-start-pill" type="button"
                                        data-action="decrement">-</button>
                                    <input type="text" class="form-control text-center qty-number border-0 bg-light"
                                        value="1">
                                    <button class="btn btn-outline-secondary qty-btn rounded-end-pill" type="button"
                                        data-action="increment">+</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- end product-item -->
            </div>
        <?php endforeach; ?>
    </div>

</div>

<div class="mb-sm-5 mobile-bottom"></div>
<div class="space"></div>



<script>
    const shop_cart = "<?= $shop_url_name ?>";

    document.querySelectorAll(".add-to-cart-btn").forEach(button => {
        button.addEventListener("click", () => {
            localStorage.setItem("shop_cart", shop_cart);
        });
    });

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
                quantity: 0,
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
        const index = cart.findIndex(item => item.id === productId && item.measure === measure && item.price ===
            priceNum);

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
    document.querySelectorAll('.qty-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const action = this.dataset.action;
            const qtyInput = this.closest('.qty-group').querySelector('.qty-number');
            let currentQty = parseInt(qtyInput.value) || 1;

            if (action === 'increment') {
                qtyInput.value = currentQty + 0;
            } else if (action === 'decrement' && currentQty > 1) {
                qtyInput.value = currentQty - 0;
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

    // --- VARIANT PRICE UPDATE ---
    document.querySelectorAll('.qty-select').forEach(select => {
        select.addEventListener('change', function() {
            const card = this.closest('.product-card');
            const selectedOption = this.options[this.selectedIndex];
            const finalPrice = parseFloat(selectedOption.value);
            const originalPrice = parseFloat(selectedOption.dataset.originalPrice || selectedOption.value);
            const discAmount = parseFloat(selectedOption.dataset.disc || 0);
            const discType = selectedOption.dataset.discType;

            const priceEl = card.querySelector('.product-price');
            if (priceEl) {
                // Check if there's a discount
                if (discAmount > 0) {
                    // Create price display with strikethrough original price
                    priceEl.innerHTML = `
                        <span class="text-muted" style="text-decoration: line-through;">
                            ₹${originalPrice.toFixed(2)}
                        </span>
                        &nbsp;
                        <span class="fw-bold fs-6 text-success">
                            ₹${finalPrice.toFixed(2)}
                        </span>
                    `;
                } else {
                    // Just show the regular price
                    priceEl.innerHTML =
                        `<span class="fw-bold fs-6 text-success">₹${finalPrice.toFixed(2)}</span>`;
                }
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
            const price = parseFloat(selectedOption.value);
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
</script>


<script>
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