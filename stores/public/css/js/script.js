// --- Search bar event ---
document.getElementById("search-bar").addEventListener("input", (e) => {
  console.log("Searching for:", e.target.value);
});

// --- Bootstrap carousel (optional, as data-bs-ride handles it) ---
const myCarousel = document.querySelector("#carouselExampleAutoplaying");

if (myCarousel) {
  new bootstrap.Carousel(myCarousel, {
    interval: 3000,
    ride: "carousel",
  });
}


// --- Cart Helpers ---
function getCart() {
  return JSON.parse(localStorage.getItem("cart")) || [];
}

function saveCart(cart) {
  localStorage.setItem("cart", JSON.stringify(cart));
}
function updateCartCount() {
  const cart = getCart();
  document.querySelector(".cart-count").textContent = cart.reduce(
    (sum, p) => sum + p.quantity,
    0
  );
  document.querySelector(".cart-counts").textContent = cart.reduce(
    (sum, p) => sum + p.quantity,
    0
  );
}

// --- Toast function (Bootstrap Toast) ---
function showCartToast(message) {
  const toastEl = document.getElementById("cart-toast");
  toastEl.querySelector(".toast-body").textContent = message;
  new bootstrap.Toast(toastEl).show();
}

// --- Cart Icon Click ---
document.querySelector(".cart-container").addEventListener("click", () => {
  window.location.href = "cart.html";
});

document.addEventListener("DOMContentLoaded", () => {
  // Enable Bootstrap tooltips
  var tooltipTriggerList = [].slice.call(
    document.querySelectorAll('[data-bs-toggle="tooltip"]')
  );
  tooltipTriggerList.forEach(function (tooltipTriggerEl) {
    new bootstrap.Tooltip(tooltipTriggerEl);
  });
  


  updateCartCount();

  document.querySelectorAll(".product-card").forEach((card) => {
    const qtySelect = card.querySelector(".qty-select");
    const qtyNumber = card.querySelector(".qty-number");
    const productPrice = card.querySelector(".product-price");
    const qtyButtons = card.querySelectorAll(".qty-btn");
    const addToCartBtn = card.querySelector(".add-to-cart-btn");
    const qtyGroup = card.querySelector(".qty-group");
    const productName = card.querySelector(".product-name").textContent.trim();
    const productImg = card.querySelector("img").src;

    let quantity = 1;
    // Update price
    function updatePrice() {
      const unitPrice = parseFloat(qtySelect.value);
      const totalPrice = (unitPrice * quantity).toFixed(2);
      productPrice.textContent = `₹${totalPrice}`;
    }

    // Helper: Find item in cart
    function findCartItem(cart, name, price) {
      return cart.find((item) => item.name === name && item.price === price);
    }

    // Quantity +/- buttons
    qtyButtons.forEach((btn) => {
      btn.addEventListener("click", () => {
        if (btn.dataset.action === "increment") {
          quantity++;
        } else if (btn.dataset.action === "decrement") {
          if (quantity > 1) {
            quantity--;
          } else {
            // Hide qty controls, show Add to Cart, remove from cart
            qtyGroup.classList.add("d-none");
            addToCartBtn.classList.remove("d-none");
            // Remove from cart
            const price = parseFloat(qtySelect.value);
            let cart = getCart();
            cart = cart.filter(
              (item) => !(item.name === productName && item.price === price)
            );
            saveCart(cart);
            updateCartCount();
            quantity = 1;
            qtyNumber.value = quantity;
            updatePrice();
            return;
          }
        }
        qtyNumber.value = quantity;
        updatePrice();

        // Update cart with new quantity
        const price = parseFloat(qtySelect.value);
        let cart = getCart();
        let item = findCartItem(cart, productName, price);
        if (item) {
          item.quantity = quantity;
          saveCart(cart);
          updateCartCount();
        }
      });
    });



    // Price change via dropdown
    qtySelect.addEventListener("change", () => {
      quantity = 1;
      qtyNumber.value = quantity;
      updatePrice();

      // Remove old item with previous price
      let cart = getCart();
      cart = cart.filter((item) => !(item.name === productName));
      saveCart(cart);
      updateCartCount();

      qtyGroup.classList.add("d-none");
      addToCartBtn.classList.remove("d-none");
    });

    // Add to cart
    addToCartBtn.addEventListener("click", () => {
      const selectedOption = qtySelect.options[qtySelect.selectedIndex];
      const price = parseFloat(selectedOption.value);
      const measure = selectedOption.getAttribute("data-measure");
      const productId = qtySelect.options[qtySelect.selectedIndex];
      const id = productId.getAttribute("data-id");
      console.log(id);
      let cart = getCart();

      // Find if the product with the same name and price exists
      let item = findCartItem(cart, productName, price,measure,id);
      if (item) {
        item.quantity += quantity; // SUM the quantities!
      } else {
        cart.push({
          
          name: productName,
          price: price,
          quantity: quantity,
          image: productImg,
          measure: measure,
          id: id,
          // image: productImg
        });
      }

      saveCart(cart);
      updateCartCount();
      showCartToast(`${productName} added to cart`);

      // Show qty controls, hide Add to Cart
      addToCartBtn.classList.add("d-none");
      qtyGroup.classList.remove("d-none");
      qtyNumber.value = item ? item.quantity : quantity; // Show total in UI

      // Always reset local quantity to 1 for next add
      quantity = 1;
    });

    updatePrice();
  });
});
