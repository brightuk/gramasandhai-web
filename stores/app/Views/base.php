<?php 
$myConfig = config('AccessProperties');
$base = $myConfig->base_url; 
?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css"
    rel="stylesheet">

<link rel="manifest" href="<?= $base ?>firebase/manifest.json">


<style>
:root {
    --primary-color: #6366f1;
    --primary-hover: #4f46e5;
    --success-color: #10b981;
    --danger-color: #ef4444;
    --text-dark: #1f2937;
    --text-muted: #6b7280;
    --border-color: #e5e7eb;
    --bg-light: #f9fafb;
    --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
    --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1);
}

/* Enhanced Modal Styling */
#accountModal .modal-content {
    border-radius: 16px;
    border: none;
    box-shadow: var(--shadow-md);
    overflow: hidden;
}

#accountModal .modal-header {
    background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
    color: white;
    border-bottom: none;
    padding: 1.5rem 2rem;
    position: relative;
}

#accountModal .modal-title {
    font-weight: 600;
    font-size: 1.25rem;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
}

#accountModal .btn-close {
    filter: brightness(0) invert(1);
    opacity: 0.8;
    position: absolute;
    right: 1rem;
    top: 50%;
    transform: translateY(-50%);
}

#accountModal .btn-close:hover {
    opacity: 1;
}

#accountModal .modal-body {
    padding: 2rem;
    background: white;
}

/* Form Styling */
.form-label {
    font-weight: 500;
    color: var(--text-dark);
    margin-bottom: 0.5rem;
}

.form-control {
    padding: 0.875rem 1rem;
    border-radius: 12px;
    border: 2px solid var(--border-color);
    font-size: 0.95rem;
    transition: all 0.2s ease;
    background: var(--bg-light);
}

.form-control:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
    background: white;
}

.form-control.error {
    border-color: var(--danger-color);
    background: #fef2f2;
}

/* Button Styling */
.btn {
    padding: 0.875rem 1.5rem;
    border-radius: 12px;
    font-weight: 500;
    transition: all 0.2s ease;
    border: none;
}

.btn-primary {
    background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
    color: white;
    box-shadow: var(--shadow-sm);
}

.btn-primary:hover {
    background: linear-gradient(135deg, var(--primary-hover), #3730a3);
    transform: translateY(-1px);
    box-shadow: var(--shadow-md);
}

.btn-primary:disabled {
    background: var(--text-muted);
    transform: none;
    box-shadow: none;
}

.btn-link {
    color: var(--primary-color);
    text-decoration: none;
    font-weight: 500;
}

.btn-link:hover {
    color: var(--primary-hover);
    text-decoration: underline;
}

.btn-danger {
    background: linear-gradient(135deg, var(--danger-color), #dc2626);
    color: white;
}

.btn-danger:hover {
    background: linear-gradient(135deg, #dc2626, #b91c1c);
    transform: translateY(-1px);
}

/* User Info Styling */
.user-profile {
    text-align: center;
    padding: 1.5rem 0;
}

.user-avatar {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1rem;
    color: white;
    font-size: 2rem;
}

.user-info h5 {
    color: var(--text-dark);
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.user-detail {
    background: var(--bg-light);
    padding: 0.75rem 1rem;
    border-radius: 8px;
    margin: 0.5rem 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.user-detail-label {
    color: var(--text-muted);
    font-size: 0.875rem;
    font-weight: 500;
}

.user-detail-value {
    color: var(--text-dark);
    font-weight: 600;
}

/* OTP Section */
.otp-section {
    text-align: center;
}

.otp-sent-message {
    background: linear-gradient(135deg, #ecfdf5, #d1fae5);
    color: var(--success-color);
    padding: 1rem;
    border-radius: 12px;
    margin-bottom: 1.5rem;
    border: 1px solid #a7f3d0;
}

/* Loading States */
.loading {
    position: relative;
    overflow: hidden;
}

.loading::after {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
    animation: loading 1.5s infinite;
}

@keyframes loading {
    0% {
        left: -100%;
    }

    100% {
        left: 100%;
    }
}

/* Toast Styling */
.toast {
    position: fixed;
    top: 20%;
    right: 50%;
    transform: translate(50%, -50%);
    z-index: 200;
    border: none;
    border-radius: 12px;
    box-shadow: var(--shadow-md);
}

.toast-info {
    background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
    color: white;
}

.toast-warning {
    z-index: 200;
    border: none;
    border-radius: 12px;
    box-shadow: var(--shadow-md);
}

.toast-success {
    background: linear-gradient(135deg, var(--success-color), #059669);
    color: white;
}

.toast-error {
    background: linear-gradient(135deg, var(--danger-color), #dc2626);
    color: white;
}

/* Cart Toast */
#cart-toast {
    border-radius: 12px;
    background: var(--success-color);
    color: white;
    border: none;
}

/* Responsive */
@media (max-width: 576px) {
    #accountModal .modal-body {
        padding: 1.5rem;
    }
}

/* Animation */
.fade-in {
    animation: fadeIn 0.3s ease-in-out;
}

/* @keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
} */

/* Order History Dropdown */
#orderHistoryDropdown {
    display: none;
}

/* Product Card Styles */
.product-card {
    border-radius: 12px;
    box-shadow: var(--shadow-sm);
    transition: all 0.2s ease;
}

.product-card:hover {
    box-shadow: var(--shadow-md);
    transform: translateY(-2px);
}

.qty-group {
    background: var(--bg-light);
    border-radius: 8px;
    padding: 0.25rem;
}

.qty-btn {
    width: 32px;
    height: 32px;
    border-radius: 6px;
    font-size: 0.875rem;
    display: flex;
    align-items: center;
    justify-content: center;
}

.qty-number {
    border: none;
    background: transparent;
    text-align: center;
    font-weight: 500;
    width: 40px;
}
</style>

<!-- Trigger Button -->
<!-- <div class="container mt-5">

Order History Dropdown (for demonstration) 
    <div id="orderHistoryDropdown" class="mt-3">
        <div class="card">
            <div class="card-body">
                <h6>Order History Available</h6>
                <p class="text-muted mb-0">You can now view your order history.</p>
            </div>
        </div>
    </div>
</div> -->

<!-- Enhanced Account Modal -->
<div class="modal fade overflow-x-hidden" id="accountModal" tabindex="-1" aria-labelledby="accountModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title w-100 text-center" id="accountModalLabel">
                    <i class="bi bi-person-circle me-2"></i>Account
                </h5>
                <button type="button" class="btn-close position-absolute end-0 me-3" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Login Form -->
                <div id="loginForm" class="fade-in">
                    <div class="text-center mb-4">
                        <h6 class="text-muted">Welcome! Please sign in to continue</h6>
                    </div>
                    <div class="mb-3">
                        <label for="mobileNumber" class="form-label">
                            <i class="bi bi-phone me-1"></i>Mobile Number
                        </label>
                        <input type="tel" class="form-control" id="mobileNumber"
                            placeholder="Enter 10-digit mobile number" maxlength="10">
                        <div class="invalid-feedback" id="mobileError"></div>

                    </div>
                    <button id="sendOtpBtn" class="btn btn-primary w-100">
                        <i class="bi bi-send me-2"></i>Send OTP
                    </button>
                </div>

                <!-- OTP Verification Form -->
                <div id="otpForm" style="display: none;" class="fade-in">
                    <div class="otp-section">
                        <div class="otp-sent-message">
                            <i class="bi bi-check-circle me-2"></i>
                            OTP sent to <strong id="mobileNumberDisplay"></strong>
                        </div>
                        <div class="mb-3">
                            <label for="otpInput" class="form-label">
                                <i class="bi bi-shield-lock me-1"></i>Enter OTP (4 digits)
                            </label>
                            <input type="text" class="form-control text-center" id="otpInput" placeholder="Enter OTP"
                                maxlength="4" style="letter-spacing: 0.5rem; font-size: 1.5rem;">
                            <div class="invalid-feedback" id="otpError"></div>
                            <input type="hidden" name="devicetoken" id="tokenInput" readonly>


                        </div>
                        <button id="verifyOtpBtn" class="btn btn-primary w-100 mb-2">
                            <i class="bi bi-check-lg me-2"></i>Verify OTP
                        </button>
                        <!-- <button id="resendOtpBtn" class="btn btn-link w-100">
                            <i class="bi bi-arrow-clockwise me-1"></i>Resend OTP
                        </button> -->
                    </div>
                </div>

                <!-- User Info -->
                <div id="userInfo" style="display: none;" class="fade-in">
                    <div class="user-profile">
                        <div class="user-avatar">
                            <i class="bi bi-person-check"></i>
                        </div>
                        <h5>Welcome!</h5>
                        <div class="user-detail">
                            <span class="user-detail-label">User ID</span>
                            <span class="user-detail-value" id="displayUserId">N/A</span>
                        </div>
                        <div class="user-detail">
                            <span class="user-detail-label">Mobile</span>
                            <span class="user-detail-value" id="displayUserMobile">N/A</span>
                        </div>
                    </div>
                    <button id="logoutBtn" class="btn btn-danger w-100">
                        <i class="bi bi-box-arrow-right me-2"></i>Logout
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Toast Notifications -->
<div class="toast-container position-fixed top-0 end-0 p-3">
    <div id="cart-toast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-body d-flex align-items-center text-white">
            <i class="bi bi-cart-plus me-2"></i>
            <span>Item added to cart</span>
        </div>
    </div>
</div>
<!-- Display token here -->
<pre id="tokenDisplay" hidden></pre>

<script type="module">
import {
    requestFcmToken
} from './app.js';
requestFcmToken();
</script>
<script type="module" src="<?= $base ?>firebase/app.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Essential elements
    const accountModal = document.getElementById('accountModal');
    const loginForm = document.getElementById('loginForm');
    const otpForm = document.getElementById('otpForm');
    const userInfo = document.getElementById('userInfo');
    const devicetokenInput = document.getElementById('tokenInput');
    const mobileNumberInput = document.getElementById('mobileNumber');
    const mobileNumberDisplay = document.getElementById('mobileNumberDisplay');
    const otpInput = document.getElementById('otpInput');
    const sendOtpBtn = document.getElementById('sendOtpBtn');
    const verifyOtpBtn = document.getElementById('verifyOtpBtn');
    const resendOtpBtn = document.getElementById('resendOtpBtn');
    const displayUserId = document.getElementById('displayUserId');
    const displayUserMobile = document.getElementById('displayUserMobile');
    const logoutBtn = document.getElementById('logoutBtn');
    const orderHistoryDropdown = document.getElementById('orderHistoryDropdown');

    // Utility functions
    function scrollContainer(direction) {
        const container = document.getElementById('scrollContainer');
        if (container) {
            const scrollAmount = 200;
            if (direction === 'left') {
                container.scrollLeft -= scrollAmount;
            } else {
                container.scrollLeft += scrollAmount;
            }
        }
    }

    function showToast(message, type = 'success') {
        const toast = new bootstrap.Toast(document.getElementById('cart-toast'));
        const toastBody = document.querySelector('#cart-toast .toast-body span');
        if (toastBody) toastBody.textContent = message;
        toast.show();
    }

    function showForm(formType) {
        // Hide all forms
        loginForm.style.display = 'none';
        otpForm.style.display = 'none';
        userInfo.style.display = 'none';

        // Show selected form with animation
        setTimeout(() => {
            switch (formType) {
                case 'login':
                    loginForm.style.display = 'block';
                    loginForm.classList.add('fade-in');
                    break;
                case 'otp':
                    otpForm.style.display = 'block';
                    otpForm.classList.add('fade-in');
                    setTimeout(() => otpInput.focus(), 100);
                    break;
                case 'userInfo':
                    userInfo.style.display = 'block';
                    userInfo.classList.add('fade-in');
                    break;
            }
        }, 100);
    }

    // Check login status and update UI
    function checkLoginStatus() {
        const isLoggedIn = localStorage.getItem('isLoggedIn') === 'true';
        if (isLoggedIn) {
            showUserInfo();
            if (orderHistoryDropdown) {
                orderHistoryDropdown.style.display = 'block';
            }
        } else {
            showForm('login');
            if (orderHistoryDropdown) {
                orderHistoryDropdown.style.display = 'none';
            }
        }
    }

    function showUserInfo() {
        const userId = localStorage.getItem('userId');
        const mobileNumber = localStorage.getItem('mobileNumber');

        if (displayUserId) displayUserId.textContent = userId || 'N/A';
        if (displayUserMobile) displayUserMobile.textContent = mobileNumber || 'N/A';

        showForm('userInfo');
        updateLoginState(true);
    }

    function updateLoginState(isLoggedIn) {
        const accountIcon = document.querySelector('[data-bs-target="#accountModal"] i');
        if (accountIcon) {
            if (isLoggedIn) {
                accountIcon.classList.remove('bi-person');
                accountIcon.classList.add('bi-person-check');
            } else {
                accountIcon.classList.remove('bi-person-check');
                accountIcon.classList.add('bi-person');
            }
        }
    }

    // Event listeners
    if (accountModal) {
        accountModal.addEventListener('show.bs.modal', checkLoginStatus);
    }

    if (mobileNumberInput) {
        mobileNumberInput.addEventListener('input', function() {
            this.value = this.value.replace(/\D/g, '');
        });
    }
        if (devicetokenInput) {
        devicetokenInput.addEventListener('input', function() {
            this.value = this.value.replace(/\D/g, '');
        });
    }

    if (otpInput) {
        otpInput.addEventListener('input', function() {
            this.value = this.value.replace(/\D/g, '');
        });
    }

    if (sendOtpBtn) {
        sendOtpBtn.addEventListener('click', function() {
            const mobileNumber = mobileNumberInput ? mobileNumberInput.value.trim() : '';

            if (mobileNumber.length !== 10 || !/^\d+$/.test(mobileNumber)) {
                alert('Please enter a valid 10-digit mobile number');
                return;
            }

            sendOtpBtn.disabled = true;
            sendOtpBtn.innerHTML =
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Sending...';

            // Replace with your actual base URL
            const baseUrl = '<?= base_url("account/registaration") ?>';

            fetch(baseUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: 'mobile=' + encodeURIComponent(mobileNumber)
                })
                .then(response => response.json())
                .then(data => {
                    // console.log(data);
                    if (data.status === 'success') {
                        if (mobileNumberDisplay) mobileNumberDisplay.textContent = mobileNumber;
                        showForm('otp');
                        showToast('OTP sent successfully!');
                        // if (data.otp) alert('OTP for testing: ' + data.otp);
                    } else {
                        // alert(data.message || 'Failed to send OTP');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while sending OTP');
                })
                .finally(() => {
                    sendOtpBtn.disabled = false;
                    sendOtpBtn.innerHTML = '<i class="bi bi-send me-2"></i>Send OTP';
                });
        });
    }

    if (verifyOtpBtn) {
        verifyOtpBtn.addEventListener('click', function() {
            const otp = otpInput ? otpInput.value.trim() : '';
            const mobileNumber = mobileNumberInput ? mobileNumberInput.value.trim() : '';
            const devicetoken = devicetokenInput ? devicetokenInput.value.trim() : '';

            if (otp.length !== 4 || !/^\d+$/.test(otp)) {
                alert('Please enter a valid 4-digit OTP');
                return;
            }

            verifyOtpBtn.disabled = true;
            verifyOtpBtn.innerHTML =
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Verifying...';

            // Replace with your actual base URL
            const baseUrl = '<?= base_url("account/regVerify") ?>';

            fetch(baseUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: 'mobile=' + encodeURIComponent(mobileNumber) + '&otp=' +
                        encodeURIComponent(otp) +'&devicetoken=' +
                        encodeURIComponent(devicetoken)
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log(data);
                    if (data.status === 'success') {
                        localStorage.setItem('isLoggedIn', 'true');
                        localStorage.setItem('userId', data.user_id);
                        localStorage.setItem('mobileNumber', mobileNumber);

                        // showUserInfo();
                        showToast('Login successful!');

                        // Reload page after short delay

                        setTimeout(() => {
                            window.location.reload();
                        }, 150);
                    } else {
                        // throw new Error(data.message || 'OTP verification failed');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    // alert(error.message ||
                    //     'An error occurred while verifying OTP. Please try again.');
                })
                .finally(() => {
                    verifyOtpBtn.disabled = false;
                    verifyOtpBtn.innerHTML = '<i class="bi bi-check-lg me-2"></i>Verify OTP';
                });
        });
    }

    if (resendOtpBtn) {
        resendOtpBtn.addEventListener('click', function() {
            const mobileNumber = mobileNumberInput ? mobileNumberInput.value.trim() : '';

            resendOtpBtn.disabled = true;
            resendOtpBtn.innerHTML =
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Sending...';

            // Replace with your actual base URL
            const baseUrl = '<?= base_url("account/registaration") ?>';

            fetch(baseUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: 'mobile=' + encodeURIComponent(mobileNumber)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        showToast('OTP resent successfully!');
                        // if (data.otp) alert('New OTP for testing: ' + data.otp);
                    } else {
                        alert(data.message || 'Failed to resend OTP');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while resending OTP');
                })
                .finally(() => {
                    resendOtpBtn.disabled = false;
                    resendOtpBtn.innerHTML = '<i class="bi bi-arrow-clockwise me-1"></i>Resend OTP';
                });
        });
    }

    if (logoutBtn) {
        logoutBtn.addEventListener('click', function() {
            localStorage.removeItem('isLoggedIn');
            localStorage.removeItem('userId');
            localStorage.removeItem('mobileNumber');

            showForm('login');
            updateLoginState(false);

            // Clear inputs
            if (mobileNumberInput) mobileNumberInput.value = '';
            if (otpInput) otpInput.value = '';

            try {
                const modal = bootstrap.Modal.getInstance(accountModal);
                if (modal) modal.hide();
            } catch (e) {
                console.error('Error hiding modal:', e);
            }

            showToast('You have been logged out');

            setTimeout(() => {
                window.location.reload();
            }, 1000);
        });
    }

    // Cart Functions (keeping your original logic)
    function getCart() {
        try {
            const cartData = localStorage.getItem('cart');
            return cartData ? JSON.parse(cartData) : [];
        } catch (e) {
            console.error("Error reading cart from localStorage:", e);
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
            const productId = card.querySelector('img')?.getAttribute('data-id');
            const select = card.querySelector('.qty-select');
            if (!select || !productId) return;

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

    // Event Handlers (keeping your original logic)
    function handleAddToCart(button) {
        const card = button.closest('.product-card');
        if (!card) return;

        const productId = card.querySelector('img')?.getAttribute('data-id');
        const productName = card.querySelector('.product-name')?.textContent;
        const select = card.querySelector('.qty-select');
        if (!select || !productId || !productName) return;

        const selectedOption = select.options[select.selectedIndex];
        const price = parseFloat(selectedOption.value);
        const measure = selectedOption.getAttribute('data-measure');
        const image = card.querySelector('img')?.src;
        const imageName = card.querySelector('#image_name')?.value || '';

        let cart = getCart();
        const existingItemIndex = cart.findIndex(item =>
            item.id === productId && item.measure === measure
        );

        if (existingItemIndex !== -1) {
            cart[existingItemIndex].quantity += 1;
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

        // Show toast notification
        showToast(`${productName} (${measure}) added to cart`);

        // Update UI immediately
        toggleCartUI(card, true, existingItemIndex !== -1 ? cart[existingItemIndex].quantity : 1);
    }

    function handleQuantityChange(button) {
        const action = button.getAttribute('data-action');
        const qtyGroup = button.closest('.qty-group');
        if (!qtyGroup) return;

        const input = qtyGroup.querySelector('.qty-number');
        let qty = parseInt(input.value) || 1;

        if (action === 'increment') {
            qty++;
        } else if (action === 'decrement') {
            qty--;
        }

        // Prevent quantity going below 1
        if (qty <= 1) {
            qty = 1;
            qtyGroup.classList.add('d-none');
            const card = qtyGroup.closest('.product-card');
            const addBtn = card.querySelector('.add-to-cart-btn');
            if (addBtn) addBtn.classList.remove('d-none');

            // Remove from cart
            const productId = card.querySelector('img')?.getAttribute('data-id');
            const select = card.querySelector('.qty-select');
            if (productId && select) {
                const measure = select.options[select.selectedIndex].getAttribute('data-measure');

                let cart = getCart();
                cart = cart.filter(item => !(item.id === productId && item.measure === measure));
                saveCart(cart);
                updateCartCount();
            }

            input.value = 1; // Reset
            return;
        }

        input.value = qty;

        const card = qtyGroup.closest('.product-card');
        const addBtn = card.querySelector('.add-to-cart-btn');

        qtyGroup.classList.remove('d-none');
        if (addBtn) addBtn.classList.add('d-none');

        const productId = card.querySelector('img')?.getAttribute('data-id');
        const select = card.querySelector('.qty-select');
        if (productId && select) {
            const measure = select.options[select.selectedIndex].getAttribute('data-measure');

            let cart = getCart();
            const itemIndex = cart.findIndex(item =>
                item.id === productId && item.measure === measure
            );
            if (itemIndex !== -1) {
                cart[itemIndex].quantity = qty;
                saveCart(cart);
                updateCartCount();
            }
        }
    }

    function handleVariantChange(select) {
        const card = select.closest('.product-card');
        const productId = card.querySelector('img')?.getAttribute('data-id');
        const selectedOption = select.options[select.selectedIndex];
        const price = parseFloat(selectedOption.value);
        const measure = selectedOption.getAttribute('data-measure');

        // Update displayed price
        const priceElement = card.querySelector('.product-price');
        if (priceElement) priceElement.textContent = `₹${price.toFixed(2)}`;

        // Check cart status and update UI
        const cart = getCart();
        const cartItem = cart.find(item =>
            item.id === productId && item.measure === measure
        );

        toggleCartUI(card, !!cartItem, cartItem?.quantity);
    }

    // Event listeners for cart functionality
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('add-to-cart-btn')) {
            handleAddToCart(e.target);
        }

        if (e.target.classList.contains('qty-btn')) {
            handleQuantityChange(e.target);
        }
    });

    document.addEventListener('change', function(e) {
        if (e.target.classList.contains('qty-select')) {
            handleVariantChange(e.target);
        }
    });

    // Initialize everything when page loads
    checkLoginStatus();
    updateCartCount();
    initializeQuantityControls();
});
</script>