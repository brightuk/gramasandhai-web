<?php $shop_url_name = $request->getUri()->getSegment(1); ?>

<!-- Static Modal - Cannot be dismissed without user action -->
<div class="modal fade" id="shopCheckModal" tabindex="-1" aria-labelledby="shopCheckModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-warning text-dark">
                <h1 class="modal-title fs-5" id="shopCheckModalLabel">
                    <i class="fas fa-shopping-cart me-2"></i>Cart Notice
                </h1>
                <!-- Close button removed for static behavior -->
            </div>
            <div class="modal-body">
                <div class="text-center mb-3">
                    <i class="fas fa-exclamation-triangle text-warning fs-1"></i>
                </div>
                <p class="text-center mb-3">
                    <strong>You have items from a different shop in your cart.</strong>
                </p>
                <p class="text-muted text-center">
                    Would you like to clear your current cart and start shopping from this shop,
                    or go back to continue with your existing cart?
                </p>
                <div class="alert alert-info mt-3">
                    <small>
                        <strong>Note:</strong> You can only checkout items from one shop at a time.
                    </small>
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <a class="btn btn-outline-secondary" href="<?= base_url() ?>" onclick="goBackToCart()">
                    <i class="fas fa-arrow-left me-1"></i>Go Back to Cart
                </a>
                <button type="button" class="btn btn-primary" onclick="clearCartAndSwitchShop()">
                    <i class="fas fa-trash me-1"></i>Clear Cart & Start Fresh
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    // Get current shop from PHP
    let current_shop = "<?= $shop_url_name ?>";
    
    // Function to safely get and decode shop from localStorage
    function getStoredShop() {
        try {
            let shop_url_name = localStorage.getItem("shop_cart");
            if (!shop_url_name) {
                console.log("No shop stored in cart");
                return null;
            }
            return shop_url_name;
        } catch (error) {
            console.error("Error decoding shop name:", error);
            return null;
        }
    }
    
    // Function to check if cart exists and has items
    function hasCartItems() {
        try {
            let cart = localStorage.getItem("cart");
            if (!cart) return false;
            
            let parsedCart = JSON.parse(cart);
            return parsedCart && Object.keys(parsedCart).length > 0;
        } catch (error) {
            console.error("Error parsing cart:", error);
            return false;
        }
    }
    
    // Function to show the static modal
    function showStaticShopModal() {
        const modalElement = document.getElementById('shopCheckModal');
        if (modalElement) {
            const modal = new bootstrap.Modal(modalElement, {
                backdrop: 'static',  // Prevent closing by clicking backdrop
                keyboard: false      // Prevent closing with ESC key
            });
            modal.show();
        } else {
            console.error("Modal element not found");
        }
    }
    
    // Function to go back to cart (with existing cart)
    function goBackToCart() {
        console.log("User chose to go back to existing cart");
        // The href attribute will handle the navigation
        // Optional: Add tracking or analytics here
    }
    
    // Function to clear cart and switch to current shop
    function clearCartAndSwitchShop() {
        try {
            // Clear the cart
            localStorage.removeItem("cart");
            
            // Set the new shop
            if (current_shop) {
                localStorage.setItem("shop_cart", current_shop);
            }
            
            // Hide the modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('shopCheckModal'));
            if (modal) {
                modal.hide();
            }
            
            console.log("Cart cleared and switched to current shop:", current_shop);
            
            // Optional: Show success message
            showSuccessMessage("Cart cleared! You can now start shopping from this shop.");
            
        } catch (error) {
            console.error("Error clearing cart:", error);
            alert("There was an error clearing your cart. Please try again.");
        }
    }
    
    // Optional: Function to show success message
    function showSuccessMessage(message) {
        // Create a temporary success alert
        const alertDiv = document.createElement('div');
        alertDiv.className = 'alert alert-success alert-dismissible fade show position-fixed';
        alertDiv.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
        alertDiv.innerHTML = `
            <i class="fas fa-check-circle me-2"></i>${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        
        document.body.appendChild(alertDiv);
        
        // Auto remove after 5 seconds
        setTimeout(() => {
            if (alertDiv.parentNode) {
                alertDiv.remove();
            }
        }, 5000);
    }
    
    // Main logic to check shop and display modal
    function checkShopAndDisplayModal() {
        let decoded_shop_url_name = getStoredShop();
        let hasCart = hasCartItems();
        
        // console.log("Current shop:", current_shop);
        // console.log("Stored shop:", decoded_shop_url_name);
        // console.log("Has cart items:", hasCart);
        
        // Only proceed if we have a stored shop and current shop
        if (!decoded_shop_url_name || !current_shop) {
            console.log("Missing shop information - no modal needed");
            return;
        }
        
        // Show modal only if there are cart items and shops are different
        if (hasCart && decoded_shop_url_name !== current_shop) {
            console.log("Different shop with existing cart - showing modal");
            showStaticShopModal();
        } else if (hasCart && decoded_shop_url_name === current_shop) {
            console.log("Same shop with existing cart - no modal needed");
        } else {
            console.log("No cart items - no modal needed");
        }
    }
    
    // Wait for DOM to be ready before executing
    document.addEventListener('DOMContentLoaded', function() {
        // Small delay to ensure everything is loaded
        setTimeout(() => {
            checkShopAndDisplayModal();
        }, 100);
    });
    
    // Optional: Add event listener for storage changes (if user has multiple tabs)
    window.addEventListener('storage', function(e) {
        if (e.key === 'cart' || e.key === 'shop_cart') {
            console.log("Cart storage changed in another tab");
            // Optionally recheck conditions
            checkShopAndDisplayModal();
        }
    });
    
    // Debug function (remove in production)
    function debugCartInfo() {
        console.log("=== CART DEBUG INFO ===");
        // console.log("Current Shop:", current_shop);
        // console.log("Stored Shop:", getStoredShop());
        // console.log("Has Cart Items:", hasCartItems());
        // console.log("Raw Cart:", localStorage.getItem("cart"));
        // console.log("Raw Shop:", localStorage.getItem("shop_cart"));
        console.log("=====================");
    }
    
    // Call debug in console: debugCartInfo()
</script>

<style>
    /* Enhanced styling for static modal */
    .modal-dialog-centered {
        display: flex;
        align-items: center;
        min-height: calc(100% - 1rem);
    }
    
    .modal-content {
        border: none;
        border-radius: 15px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
        overflow: hidden;
    }
    
    .modal-header {
        border-radius: 15px 15px 0 0;
        border-bottom: 2px solid #ffc107;
        padding: 1.5rem;
    }
    
    .modal-body {
        padding: 2rem;
    }
    
    .modal-footer {
        border-radius: 0 0 15px 15px;
        background-color: #f8f9fa;
        border-top: 1px solid #dee2e6;
        padding: 1.5rem;
    }
    
    /* Ensure buttons have proper spacing */
    .modal-footer .btn {
        margin: 0 8px;
        min-width: 160px;
        padding: 12px 20px;
        font-weight: 500;
        border-radius: 8px;
        transition: all 0.3s ease;
    }
    
    /* Add hover effects for better UX */
    .modal-footer .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }
    
    .modal-footer .btn-outline-secondary:hover {
        background-color: #6c757d;
        border-color: #6c757d;
        color: white;
    }
    
    .modal-footer .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }
    
    /* Style the warning icon */
    .fs-1 {
        font-size: 4rem !important;
        margin-bottom: 1rem;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    
    /* Enhanced alert styling */
    .alert-info {
        border-left: 4px solid #0dcaf0;
        background-color: #e7f3ff;
        border-color: #b8daff;
    }
    
    /* Success message styling */
    .alert-success.position-fixed {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        border-radius: 8px;
    }
    
    /* Modal title styling */
    .modal-title {
        font-weight: 600;
        display: flex;
        align-items: center;
    }
    
    /* Responsive adjustments */
    @media (max-width: 576px) {
        .modal-dialog {
            margin: 10px;
        }
        
        .modal-footer .btn {
            min-width: 140px;
            margin: 5px 0;
        }
        
        .modal-footer {
            flex-direction: column;
        }
        
        .fs-1 {
            font-size: 3rem !important;
        }
    }
    
    /* Loading animation for buttons */
    .btn.loading {
        pointer-events: none;
        opacity: 0.6;
    }
    
    .btn.loading::after {
        content: "";
        display: inline-block;
        width: 16px;
        height: 16px;
        margin-left: 8px;
        border: 2px solid currentColor;
        border-radius: 50%;
        border-top-color: transparent;
        animation: spin 1s linear infinite;
    }
    
    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }
</style>


<?php
// die;

?>