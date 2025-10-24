<?php include(APPPATH . 'Views/templates/config.php'); ?>
<?= $this->extend('templates/page') ?>
<?= $this->section('index') ?>

<style>
/* Desktop spacer */
@media screen and (min-width: 768px) {
    .empty-spacer {
        height: 50px;

    }

    .spacer {
        margin-bottom: 100px !important;
    }
}

.cart-item-container {
    gap: 15px;
    padding: 10px 0;
    /* border-bottom: 1px solid #eee; */
}

.product-image-container {
    width: 80px;
    min-width: 80px;
    height: 80px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.product-image {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
}

.product-title {
    font-weight: 500;
    font-size: 1rem;
    margin-bottom: 0.25rem;
}

.product-measure {
    color: #6c757d;
    font-size: 0.85rem;
}

.quantity-control {
    width: auto;
    max-width: 140px;
}

.qty-number {
    width: 40px;
    flex: none;
}

.price-info {

    min-width: 100px;
}

.unit-price {
    font-size: 0.85rem;
    color: #6c757d;
}

.subtotal {
    font-size: 1.1rem;
}

/* Responsive adjustments */
@media (max-width: 576px) {
    .product-image-container {
        width: 70px;
        min-width: 70px;
        height: 70px;
    }

    .btn-text {
        display: none;
    }

    .delete-btn {
        padding: 0.25rem 0.5rem;
    }

    .quantity-control {
        max-width: 120px;
    }
}

@media (min-width: 577px) and (max-width: 768px) {
    .product-image-container {
        width: 90px;
        min-width: 90px;
        height: 90px;
    }
}

/* Cart item styling */
.cart-item {
    transition: all 0.3s ease;
    padding: 20px;
    margin-bottom: 20px;
    border-radius: 10px;
}

.product-image {
    width: 100px;
    height: 100px;
    object-fit: contain;
    border-radius: 8px;
    margin-right: 20px;
    border: 1px solid #eee;
    padding: 5px;
}

.quantity-control {
    width: 120px;
}

.product-details {
    flex-grow: 1;
}

.product-title {
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 5px;
}

.product-measure {
    color: #6c757d;
    font-size: 0.9rem;
    margin-bottom: 10px;
}

.price-info {
    text-align: center;

}

.unit-price {
    font-size: 0.9rem;
    color: #6c757d;
}

.subtotal {
    font-weight: 600;
    font-size: 1.1rem;
}

/* Empty cart message */
.empty-cart-message {
    min-height: 300px;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
}

/* Optional additional styling */
.btns {
    padding: 0.5rem 1rem;
    min-width: 120px;
    transition: all 0.3s ease;
}

@media (max-width: 576px) {
    .btns {
        width: 100%;
        padding: 0.6rem 1rem;
    }
}

@media (min-width: 577px) and (max-width: 768px) {
    .btns {
        min-width: 160px;
    }

    .spacer {
        margin-top: 100px !important;
    }
}

@media (max-width: 576px) {
    .delete-btn {
        padding: 0.25rem 0.5rem;
    }

    .btn-text {
        display: none;
    }

    .spacer {
        margin-top: 100px !important;
        margin-bottom: 100px !important;

    }

}

@media (max-width: 576px) {
    .cart-item-container {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
    }

    .product-image-container {
        width: 100%;
        height: auto;
        justify-content: flex-start;
    }

    .product-image {
        width: 80px;
        height: 80px;
        margin: 0;
    }

    .product-details {
        width: 100%;
    }

    .product-title {
        font-size: 1rem;
    }

    .unit-price,
    .product-measure {
        font-size: 0.85rem;
    }

    .subtotal {
        font-size: 1rem;
        margin-top: 5px;
    }

    .quantity-control {
        width: 100%;
        max-width: 100%;
    }

    .input-group {
        width: 100%;
    }

    .fix-top {
        position: static !important;
        align-self: flex-end;
        margin-top: 10px;
    }

    .product-info {
        width: 100%;
    }

    .del-btn {
        position: absolute;
        top: 0;
        right: 0;
        margin: 16px;
        /* Optional: for spacing from the edge */
    }

}

.nutras-footer {
    display: none !important;
}
</style>

<div class="empty-spacer "></div>

<div class="spacer" id="cartpage">

    <div class="container my-5" style="max-width: 800px;">
        <h2 class="mb-4  overflow-y-hidden">Your Shopping Cart</h2>

        <!-- Cart Items Container -->
        <div id="cart-items" class="mb-4"></div>

        <!-- Total Section -->
        <div id="cart-total-section" class="card p-4 mb-4" style="display: none;">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Order Total:</h4>
                <h4 id="cart-total" class="mb-0 text-success">₹0.00</h4>
            </div>
        </div>

        <!-- Buttons -->
        <div
            class="d-flex flex-column flex-sm-row justify-content-between align-items-stretch align-items-sm-center gap-2 gap-sm-0 mt-4">
            <a href="<?= base_url($shop_url_name) ?>"
                class="btn btns btn-outline-secondary flex-grow-1 flex-sm-grow-0 text-center">
                <i class="bi bi-arrow-left"></i>
                <span class="d-none d-sm-inline">Continue Shopping</span>
                <span class="d-inline d-sm-none">Continue</span>
            </a>

            <a href="<?= base_url($shop_url_name . '/checkout') ?>"
                class="btn btns btn-primary flex-grow-1 flex-sm-grow-0 text-center" id="checkout-btn"
                style="display: none;">
                <span class="d-none d-sm-inline">Proceed to Checkout</span>
                <span class="d-inline d-sm-none">Checkout</span>
                <i class="bi bi-arrow-right"></i>
            </a>



        </div>
    </div>

</div>

<div id="login-alert" style="display:none; margin-top:15px; min-height: 300px;">
    <div class="alert alert-danger">
        <i class="bi bi-exclamation-triangle"></i> <b>Please Login First</b><br>
        You need to be logged in to place an order. Please login or create an account.
        <br>
        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#accountModal"
            class="btn btn-danger mt-2">Go to Login Page</a>
    </div>
</div>

<script>
document.getElementById("checkout-btn").addEventListener("click", function(e) {
    const isLoggedIn = localStorage.getItem("isLoggedIn");

    if (isLoggedIn !== "true") {
        e.preventDefault(); // stop navigation
        document.getElementById("login-alert").style.display = "block";
        document.getElementById("cartpage").style.display = "none";
    } else {
        // Let user go to checkout, hide login alert just in case
        document.getElementById("login-alert").style.display = "none";
    }
});
</script>


<script>
// Enhanced Cart Management Functions
function getCart() {
    try {
        const cartData = localStorage.getItem('cart');
        if (!cartData) return [];

        const cart = JSON.parse(cartData);

        // Convert string prices to numbers if needed
        return cart.map(item => {
            return {
                ...item,
                price: typeof item.price === 'string' ? parseFloat(item.price) : item.price,
                quantity: parseInt(item.quantity)
            };
        });
    } catch (e) {
        console.error("Error reading cart data:", e);
        return [];
    }
}

function saveCart(cart) {
    try {
        localStorage.setItem('cart', JSON.stringify(cart));
        updateCartCount();
    } catch (e) {
        console.error("Error saving cart:", e);
    }
}

function updateCartCount() {
    const cart = getCart();
    const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);

    // Update cart count in header/navigation if exists
    document.querySelectorAll('.cart-count').forEach(el => {
        el.textContent = totalItems;
    });
}

function renderCart() {
    const cart = getCart();
    const cartItemsDiv = document.getElementById('cart-items');
    const cartTotalSection = document.getElementById('cart-total-section');
    const checkoutBtn = document.getElementById('checkout-btn');

    cartItemsDiv.innerHTML = '';
    let total = 0;

    console.log("Current cart items:", cart); // Debugging

    if (cart.length === 0) {
        cartItemsDiv.innerHTML = `
                <div class="empty-cart-message">
                    <div>
                        <i class="bi bi-cart-x" style="font-size: 3rem; color: #6c757d;"></i>
                        <h4 class="mt-3">Your cart is empty</h4>
                        <p class="text-muted">Start shopping to add items to your cart</p>
                    </div>
                </div>
            `;
        cartTotalSection.style.display = 'none';
        checkoutBtn.style.display = 'none';
        return;
    }

    // Show elements when cart has items
    cartTotalSection.style.display = 'block';
    checkoutBtn.style.display = 'block';

    // Render each cart item
    cart.forEach((item, idx) => {
        try {
            // Ensure price is treated as number
            const price = typeof item.price === 'string' ? parseFloat(item.price) : item.price;
            const quantity = parseInt(item.quantity);
            const subtotal = price * quantity;
            total += subtotal;

            const itemDiv = document.createElement('div');
            itemDiv.className = 'card cart-item';

            // Check if item has discount
            const hasDiscount = item.originalPrice && item.originalPrice > price;
            const originalPriceDisplay = hasDiscount ? `
                    <span class="text-muted" style="text-decoration: line-through; font-size: 0.85rem;">
                        ₹${item.originalPrice.toFixed(2)}
                    </span> 
                ` : '';

            itemDiv.innerHTML = `
    <div class="d-flex align-items-stretch cart-item-container">
        <div class="product-image-container">
            <img src="${item.image}" alt="${item.name}" class="product-image"      >
            <button class="btn btn-sm btn-outline-danger  del-btn delete-btn  d-md-none position-absolute" 
                type="button" data-idx="${idx}">
                    <i class="bi bi-trash"></i> <span class="btn-text"></span>
                </button>
        </div>
        
        <div class="product-details flex-grow-1">
            <div class="d-flex flex-column flex-md-row justify-content-between">
                <div class="product-info  w-100">
                    <div class="product-title">${item.name}</div>
                    <div class="product-measure">
                        ${item.measure} - 
                        ${originalPriceDisplay}
                        <span class="unit-price ${hasDiscount ? 'text-success fw-bold' : ''}">₹${price.toFixed(2)} each</span>
                    </div>
                   
                    <div class="subtotal float-right fw-bold text-success">₹${subtotal.toFixed(2)}</div>

                </div>
                <button class="btn btn-sm btn-outline-danger delete-btn fix-top d-none d-md-block position-absolute top-0 end-0 mt-2 me-2 mt-md-1 me-md-2" 
                        type="button" data-idx="${idx}">
                    <i class="bi bi-trash"></i> <span class="btn-text"></span>
                </button>
            </div>
              
            <div class="d-flex flex-row  justify-content-between align-items-end align-items-sm-center mt-2 mt-md-3">
                <div class="input-group quantity-control me-sm-3 mb-2 mb-sm-0">
                    <button class="btn btn-outline-secondary btn-sm qty-btn" 
                            type="button" data-action="decrement" data-idx="${idx}">
                        <i class="bi bi-dash"></i>
                    </button>
                    <input type="text" class="form-control text-center qty-number px-1" 
                           value="${quantity}" readonly>
                    <button class="btn btn-outline-secondary btn-sm qty-btn" 
                            type="button" data-action="increment" data-idx="${idx}">
                        <i class="bi bi-plus"></i>
                    </button>
                    <div class="price-info  text-sm-start">
                       
                    </div>
                </div>
                
       
            </div>
        </div>
    </div>
`;

            cartItemsDiv.appendChild(itemDiv);
        } catch (e) {
            console.error("Error rendering cart item:", item, e);
        }
    });

    // Update total
    document.getElementById('cart-total').textContent = `₹${total.toFixed(2)}`;

    // Add event listeners
    addCartEventListeners();
}

function addCartEventListeners() {
    // Quantity button handlers
    document.querySelectorAll('.qty-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const idx = parseInt(this.getAttribute('data-idx'));
            const action = this.getAttribute('data-action');
            let cart = getCart();

            if (action === 'increment') {
                cart[idx].quantity += 1;
            } else if (action === 'decrement') {
                cart[idx].quantity = Math.max(1, cart[idx].quantity - 1);
            }

            saveCart(cart);
            renderCart();
        });
    });

    // Delete button handlers
    document.querySelectorAll('.delete-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            if (!confirm('Remove this item from your cart?')) return;

            const idx = parseInt(this.getAttribute('data-idx'));
            let cart = getCart();
            cart.splice(idx, 1);
            saveCart(cart);
            renderCart();
            updateCartCount();
        });
    });
}

// Initialize cart on page load
document.addEventListener('DOMContentLoaded', function() {
    renderCart();
    updateCartCount();
});

function updateCartCount() {
    const cart = getCart();
    const totalItems = cart.reduce((total, item) => total + item.quantity, 0);
    document.querySelectorAll('.cart-count').forEach(el => el.textContent = totalItems);
}
</script>

<?= $this->endSection() ?>