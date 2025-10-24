<!DOCTYPE html>
<html lang="en">
<?php include(APPPATH . 'Views/templates/config.php');
include(APPPATH . 'Views/base.php');
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- <title>Gramasandhai</title> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">

    <link rel="stylesheet" href="<?= esc($site_url) ?>public/assets/css/style.css">
    <link rel="stylesheet" href="<?= esc($site_url) ?>public/assets/css/media.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <style>
    a {
        text-decoration: none;
    }

    .all-shops {
        position: relative;
        margin-top: -40px;
        left: 90%;
    }

    .all-shops:hover .back-btn {
        color: white !important;
    }

    .account-user {
        position: relative;
        top: 10%;
        left: 32%;
        z-index: 10000;
    }

    .lheaher {
        background:
            <?=$lColor ?>;
    }

    .brand-logo {
        color:
            <?=$tcolor ?>;
    }

    .btn-secondary {
        color:
            <?=$tcolor ?>;
    }

    .address-btn,
    .address-btn svg {
        color:
            <?=$tcolor ?>;
    }

    .address-btn:hover {
        background-color: #f0f0f0;
        color:
            <?=$label ?>;
    }

    .btn-secondary:hover {
        color:
            <?=$label ?>;
    }

    #main-footer {
        background:
            <?=$lColor ?> !important;
        color: <?=$tcolor ?> !important;
    }

    .footer-nav-link {
        color:
            <?=$tcolor ?>;
    }

    .footer-legal-link {
        color:
            <?=$label ?>;
    }

    .footer-copyright {
        color:
            <?=$label ?>;
    }

    .mobile-bottom-nav a {
        flex: 1;
        /* Make links take equal width */
    }

    .mobile-bottom-nav i {
        display: block;
    }

    @media screen and (max-width: 568px) {
        #orderHistoryLink {
            display: none !important;
        }

    }

    .siderbar-header {
        background:
            <?=$lColor ?> !important;
        color: rgb(211, 235, 239) !important;
    }

    .mobile-bottom-nav {
        background:
            <?=$lColor ?> !important;
        color: rgb(211, 235, 239) !important;
        font-weight: 500;

    }

    .mobile-bottom-nav1 a {
        color: rgb(211, 235, 239) !important;
    }

    .mobile-bottom-nav1 a:hover {
        color: #ffb300 !important;
    }

    .menu-btn i {
        color: rgb(211, 235, 239) !important;
        font-weight: 500;
        font-size: 20px;
    }
    </style>
</head>


<body>
    <header class=" header lheaher" id="header">
        <div class="container">
            <div class="  nav-container">
                <div class="left-section">
                    <button class="menu-btn" aria-label="Menu" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">
                        <i class="bi bi-list"></i>
                    </button>
                    <a href="/" class="brand-logo">Gramasandhai</a>
                </div>

                <!-- <div class="search-container">
                <input type="text" class="search-input" placeholder="Search on Gramasandhai">
            </div> -->


                <div class="right-section">

                    <button class="icon-btn btn-secondary  d-none d-lg-block" data-bs-toggle="modal"
                        data-bs-target="#accountModal"><i class="bi bi-person-fill fs-4"></i>
                    </button>
                    <a href="<?= base_url() ?>orderhistory" id="orderHistoryLink"
                        class="orderHistory icon-btn btn-secondary text-decoration-none  d-none">
                        <i class="bi bi-clock-history"></i>
                        <span>Orders</span>
                    </a>

                    <button class="address-btn " aria-label="Delivery address" data-bs-toggle="modal"
                        data-bs-target="#locationModal">
                        <svg class="address-icon" viewBox="0 0 24 24">
                            <path
                                d="M18.364 17.364L12 23.728l-6.364-6.364a9 9 0 1 1 12.728 0zM12 13a2 2 0 1 0 0-4 2 2 0 0 0 0 4z" />
                        </svg>
                        Locator
                    </button>

                    <!-- <button class="icon-btn" aria-label="Notifications">
                    <svg class="notification-icon" viewBox="0 0 24 24">
                        <path
                            d="M22 20H2v-2h1v-6.969C3 6.043 7.03 2 12 2s9 4.043 9 9.031V18h1v2zM5 18h14v-6.969C19 7.148 15.866 4 12 4s-7 3.148-7 7.031V18zm4.5 3h5a2.5 2.5 0 1 1-5 0z" />
                    </svg>
                </button> -->
                </div>
            </div>
        </div>

    </header>

    <script>
    document.cookie = "userId=" + encodeURIComponent(localStorage.getItem('userId')) + "; path=/";
    </script>



    <section>
        <?= $this->renderSection('content') ?>
    </section>




    <div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1"
        id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
        <div class="offcanvas-header  siderbar-header">
            <h5 class="offcanvas-title text-white" id="offcanvasScrollingLabel"> Gramasandhai</h5>
            <button type="button" class="btn btn-white text-reset" data-bs-dismiss="offcanvas" aria-label="Close">
                <i class="bi bi-x-lg"></i>
            </button>

        </div>
        <div class="offcanvas-body">
            <div class="app-drawer">
                <div class="app-drawer-links">
                    <div class="search-container-m mb-5 d-none">
                        <input type="text" class="search-input" placeholder="Search on Gramasandhai">
                    </div>
                    <div class="app-drawer-divider dnone"></div>
                    <a href="<?= base_url() ?>" class="app-drawer-link">
                        <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M21 13.242V20h1v2H2v-2h1v-6.758A4.496 4.496 0 0 1 1 9.5c0-.827.224-1.624.633-2.303L4.345 2.5a1 1 0 0 1 .866-.5H18.79a1 1 0 0 1 .866.5l2.702 4.682A4.496 4.496 0 0 1 21 13.242zm-2 .73a4.496 4.496 0 0 1-3.75-1.36A4.496 4.496 0 0 1 12 14.001a4.496 4.496 0 0 1-3.25-1.387A4.496 4.496 0 0 1 5 13.973V20h14v-6.027zM5.789 4L3.356 8.213a2.5 2.5 0 0 0 4.466 2.216c.335-.837 1.52-.837 1.856 0a2.5 2.5 0 0 0 4.644 0c.335-.837 1.52-.837 1.856 0a2.5 2.5 0 1 0 4.457-2.232L18.21 4H5.79z">
                            </path>
                        </svg>
                        <span>Home</span>
                    </a>
                    <div class="app-drawer-divider"></div>

                    <!-- Shops -->
                    <a href="#shoplist" class="app-drawer-link">
                        <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M21 13.242V20h1v2H2v-2h1v-6.758A4.496 4.496 0 0 1 1 9.5c0-.827.224-1.624.633-2.303L4.345 2.5a1 1 0 0 1 .866-.5H18.79a1 1 0 0 1 .866.5l2.702 4.682A4.496 4.496 0 0 1 21 13.242zm-2 .73a4.496 4.496 0 0 1-3.75-1.36A4.496 4.496 0 0 1 12 14.001a4.496 4.496 0 0 1-3.25-1.387A4.496 4.496 0 0 1 5 13.973V20h14v-6.027zM5.789 4L3.356 8.213a2.5 2.5 0 0 0 4.466 2.216c.335-.837 1.52-.837 1.856 0a2.5 2.5 0 0 0 4.644 0c.335-.837 1.52-.837 1.856 0a2.5 2.5 0 1 0 4.457-2.232L18.21 4H5.79z">
                            </path>
                        </svg>
                        <span>Shops</span>
                    </a>


                    <div class="app-drawer-divider"></div>

                    <a id="orderHistoryLink2" href="<?= base_url() ?>orderhistory" class="app-drawer-link d-none">
                        <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M21 13.242V20h1v2H2v-2h1v-6.758A4.496 4.496 0 0 1 1 9.5c0-.827.224-1.624.633-2.303L4.345 2.5a1 1 0 0 1 .866-.5H18.79a1 1 0 0 1 .866.5l2.702 4.682A4.496 4.496 0 0 1 21 13.242zm-2 .73a4.496 4.496 0 0 1-3.75-1.36A4.496 4.496 0 0 1 12 14.001a4.496 4.496 0 0 1-3.25-1.387A4.496 4.496 0 0 1 5 13.973V20h14v-6.027zM5.789 4L3.356 8.213a2.5 2.5 0 0 0 4.466 2.216c.335-.837 1.52-.837 1.856 0a2.5 2.5 0 0 0 4.644 0c.335-.837 1.52-.837 1.856 0a2.5 2.5 0 1 0 4.457-2.232L18.21 4H5.79z">
                            </path>
                        </svg>
                        <span>Order History</span>
                    </a>
                    <div class="app-drawer-divider  d-none" id="ord-label"></div>

                    <!-- Saved Shops -->
                    <a href="#category" class="app-drawer-link">
                        <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M21 11.646V21a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1v-9.354A3.985 3.985 0 0 1 2 9V3a1 1 0 0 1 1-1h18a1 1 0 0 1 1 1v6c0 1.014-.378 1.94-1 2.646zm-2 1.228a4.007 4.007 0 0 1-4-1.228A3.99 3.99 0 0 1 12 13a3.99 3.99 0 0 1-3-1.354 3.99 3.99 0 0 1-4 1.228V20h14v-7.126zM14 9a1 1 0 0 1 2 0 2 2 0 1 0 4 0V4H4v5a2 2 0 1 0 4 0 1 1 0 1 1 2 0 2 2 0 1 0 4 0z">
                            </path>
                        </svg>
                        <span>Categories </span>
                    </a>


                    <div class="app-drawer-divider"></div>

                    <!-- Viewed Products -->
                    <a href="<?= $burl ?>/about-us-privacy-policy" class="app-drawer-link">
                        <i class="bi bi-telephone fs-4"></i>
                        <span>Contacts</span>
                    </a>

                    <div class="app-drawer-divider"></div>

                    <!-- Viewed Products -->
                    <a href="<?= $burl ?>/about-us-privacy-policy" class="app-drawer-link">
                        <i class="bi bi-newspaper"></i>
                        <span>Privacy policy</span>
                    </a>
                    <div class="app-drawer-divider"></div>
                </div>
            </div>
        </div>
    </div>




    <!-- <div style="height: 50vh;"></div> -->
    <div class="d-block d-lg-none mobile-bottom-nav fixed-bottom border-top">
        <div class="d-flex justify-content-around py-2 mobile-bottom-nav1" style="color: rgb(211, 235, 239);">
            <a href="<?= base_url() ?>" class="text-center text-decoration-none ">
                <i class="bi bi-house-door fs-4"></i>
                <div class="small">Home</div>
            </a>

            <a href="#shoplist" class="text-center text-decoration-none ">
                <i class="bi bi-basket fs-4"></i>
                <div class="small">Shop</div>
            </a>

            <a href="#category" class="text-center text-decoration-none ">
                <i class="bi bi-tags fs-4"></i>
                <div class="small">Category</div>
            </a>

            <a href="#" class="text-center text-decoration-none " data-bs-toggle="modal" data-bs-target="#accountModal">
                <i class="bi bi-person fs-4"></i>
                <div class="small">Account</div>
            </a>
        </div>
    </div>



    <!-- Recreated Footer with improved class names and IDs -->
    <div class=" d-none d-md-block mt-5 pt-xl-5 " id="footer">
        <!--  footer-container -->
        <footer id="main-footer">
            <div class="nutras-footer nutras-footer-bottom text-center ">
                <span>&copy; 2025 Gramasandhai. All Rights Reserved.</span>
                <span class="footer-bottom-links ms-3 hfooter">
                    <a href="#">Terms of Service</a> &nbsp;|&nbsp;
                    <a href="#">Privacy Policy</a>
                </span>
            </div>
        </footer>
    </div>

    <style>
    .shop-card-header {
        background: #42A5F5;
    }



    </style>
    <div class="modal fade" id="locationModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static"
        aria-labelledby="locationModalLabel">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <form id="locationForm" method="Get" action="<?= $burl ?>">

                    <div class="modal-header location-header">
                        <h5 class="modal-title" id="locationModalLabel">Specify Your Location</h5>
                        <button type="button" id="btnCloseModallocation" class="btn-close d-none" 
                            data-bs-dismiss="modal"><i class="bi bi-x-lg"></i></button>
                    </div>

                    <div class="modal-body">
                        <!-- 
                        <div class="mb-3">
                            <div class="d-flex gap-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="orderType" id="delivery"
                                        value="delivery" checked>
                                    <label class="form-check-label" for="delivery">Delivery</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="orderType" id="pickup"
                                        value="pickup">
                                    <label class="form-check-label" for="pickup">Pickup</label>
                                </div>
                            </div>
                        </div> -->

                        <p class="small text-muted">
                            Enter your Address to find the nearest Pickup location to see products at nearby store
                        </p>

                        <!-- Search & current location -->
                        <div class="input-group mb-3">
                            <input type="text" id="searchLocation" name="search" class="form-control"
                                placeholder="Search area or district name" autocomplete="off">
                            <button class="btn btn-outline-secondary" type="button" id="btnClearSearch">
                                <i class="bi bi-x"></i>
                            </button>
                        </div>

                        <!-- Search Results -->
                        <div id="searchResults" class="list-group mb-3"
                            style="display: none; max-height: 200px; overflow-y: auto;">
                            <!-- Search results will appear here -->
                        </div>

                        <!-- State -->
                        <div class="mb-2">
                            <select id="stateSelect" class="form-select" required>
                                <option value="">Select State</option>
                            </select>
                        </div>

                        <!-- District -->
                        <div class="mb-2">
                            <select id="districtSelect" name="district" class="form-select" required>
                                <option value="">Select District</option>
                            </select>
                        </div>

                        <!-- Area -->
                        <div class="mb-3">
                            <select id="citySelect" name="area" class="form-select">
                                <option value="">Select Area</option>
                            </select>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary  d-none" id="location_close"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-warning" id="btnConfirm">Confirm</button>
                    </div>

                </form>

            </div>
        </div>
    </div>































    <script>
    ['orderHistoryLink2', 'orderHistoryLink', 'ord-label'].forEach(function(id) {
        const orderLink = document.getElementById(id);
        const userId = localStorage.getItem('userId'); // replace 'userId' with your key

        if (orderLink && userId) {
            orderLink.classList.remove('d-none'); // show link if userId exists
        }
    });


    const responseData = {
        "states": <?php echo json_encode($location['states']); ?>,

        "districts": <?php echo json_encode($location['districts']); ?>,

        "citylist": <?php echo json_encode($location['citylist']); ?>,

    };

    // DOM elements
    const stateSelect = document.getElementById('stateSelect');
    const districtSelect = document.getElementById('districtSelect');
    const citySelect = document.getElementById('citySelect');
    const locationForm = document.getElementById('locationForm');
    const searchLocation = document.getElementById('searchLocation');
    const searchResults = document.getElementById('searchResults');
    const btnClearSearch = document.getElementById('btnClearSearch');

    // Populate states
    responseData.states.forEach(state => {
        const opt = document.createElement('option');
        opt.value = state.id;
        opt.textContent = state.state;
        stateSelect.appendChild(opt);
    });

    // On state change → populate districts
    stateSelect.addEventListener('change', () => {
        districtSelect.innerHTML = '<option value="">Select District</option>';
        citySelect.innerHTML = '<option value="">Select City</option>';
        const districts = responseData.districts.filter(d => d.state_id === stateSelect.value);
        districts.forEach(dist => {
            const opt = document.createElement('option');
            opt.value = dist.id;
            opt.textContent = dist.district_name;
            districtSelect.appendChild(opt);
        });
    });

    // On district change → populate areas
    districtSelect.addEventListener('change', () => {
        citySelect.innerHTML = '<option value="">Select Area</option>';
        const cities = responseData.citylist.filter(c => c.district_id === districtSelect.value);
        cities.forEach(city => {
            const opt = document.createElement('option');
            opt.value = city.id;
            opt.textContent = city.city_name;
            citySelect.appendChild(opt);
        });
    });

    // Search functionality
    searchLocation.addEventListener('input', (e) => {
        const searchTerm = e.target.value.trim().toLowerCase();

        if (searchTerm.length < 2) {
            searchResults.style.display = 'none';
            return;
        }

        // Search in areas and districts
        const cities = responseData.citylist.filter(city =>
            city.city_name.toLowerCase().includes(searchTerm)
        );

        const districts = responseData.districts.filter(district =>
            district.district_name.toLowerCase().includes(searchTerm)
        );

        // Clear previous results
        searchResults.innerHTML = '';

        if (cities.length === 0 && districts.length === 0) {
            searchResults.innerHTML = '<div class="list-group-item text-muted">No results found</div>';
            searchResults.style.display = 'block';
            return;
        }

        // Add district results
        districts.forEach(district => {
            const state = responseData.states.find(s => s.id === district.state_id);
            const item = document.createElement('div');
            item.className = 'list-group-item list-group-item-action';
            item.innerHTML = `
            <div class="fw-bold">${district.district_name}</div>
            <small class="text-muted">District in ${state ? state.state : 'Unknown State'}</small>
        `;
            item.addEventListener('click', () => selectFromSearch('district', district.id, district
                .state_id));
            searchResults.appendChild(item);
        });

        // Add area results
        cities.forEach(city => {
            const district = responseData.districts.find(d => d.id === city.district_id);
            const state = responseData.states.find(s => s.id === district?.state_id);
            const item = document.createElement('div');
            item.className = 'list-group-item list-group-item-action';
            item.innerHTML = `
            <div class="fw-bold">${city.city_name}</div>
            <small class="text-muted">Area in ${district ? district.district_name : 'Unknown District'}, ${state ? state.state : 'Unknown State'}</small>
        `;
            item.addEventListener('click', () => selectFromSearch('city', city.id, city.district_id,
                district?.state_id));
            searchResults.appendChild(item);
        });

        searchResults.style.display = 'block';
    });

    // Function to handle selection from search results
    function selectFromSearch(type, id, parentId, grandParentId) {
        if (type === 'district') {
            // Set state first
            stateSelect.value = parentId;
            stateSelect.dispatchEvent(new Event('change'));

            // Then set district
            setTimeout(() => {
                districtSelect.value = id;
                districtSelect.dispatchEvent(new Event('change'));
            }, 100);
        } else if (type === 'city') {
            // Set state first
            stateSelect.value = grandParentId;
            stateSelect.dispatchEvent(new Event('change'));

            // Then set district
            setTimeout(() => {
                districtSelect.value = parentId;
                districtSelect.dispatchEvent(new Event('change'));

                // Finally set area
                setTimeout(() => {
                    citySelect.value = id;
                }, 100);
            }, 100);
        }

        // Clear search
        searchLocation.value = '';
        searchResults.style.display = 'none';
    }

    // Clear search button
    btnClearSearch.addEventListener('click', () => {
        searchLocation.value = '';
        searchResults.style.display = 'none';
    });

    // Hide search results when clicking outside
    document.addEventListener('click', (e) => {
        if (!searchLocation.contains(e.target) && !searchResults.contains(e.target)) {
            searchResults.style.display = 'none';
        }
    });

    // Form submission
    locationForm.addEventListener('submit', (e) => {
        e.preventDefault();
        // Validate selections
        if (!stateSelect.value || !districtSelect.value || !citySelect.value) {
            alert('Please select State, District, and Area');
            return;
        }
        locationForm.submit();


    });



    // --- Cookie helpers ---
    function setCookie(name, value, days) {
        const d = new Date();
        d.setTime(d.getTime() + (days * 24 * 60 * 60 * 1000));
        let expires = "expires=" + d.toUTCString();
        document.cookie = name + "=" + value + ";" + expires + ";path=/";
    }

    function getCookie(name) {
        let cname = name + "=";
        let decodedCookie = decodeURIComponent(document.cookie);
        let ca = decodedCookie.split(';');
        for (let i = 0; i < ca.length; i++) {
            let c = ca[i].trim();
            if (c.indexOf(cname) == 0) return c.substring(cname.length, c.length);
        }
        return "";
    }

    // --- Modal auto open ---
    document.addEventListener("DOMContentLoaded", function() {
        // Check cookie
        if (!getCookie("locationModalClosed")) {
            var myModal = new bootstrap.Modal(document.getElementById('locationModal'));
            myModal.show();
        } else {
            ['location_close', 'btnCloseModallocation'].forEach(function(id) {
                const el = document.getElementById(id);
                if (el) el.classList.remove('d-none');
            });
        }

        // When close button clicked → save cookie
        // Array of button IDs to attach the same action
        ['btnCloseModallocation', 'btnConfirm'].forEach(function(id) {
            const btn = document.getElementById(id);

            if (btn) {
                btn.addEventListener('click', function() {
                    setCookie('locationModalClosed', 'yes', 7); // valid for 7 days
                });
            }
        });


    });
    </script>




    <script src="<?= esc($site_url) ?>public/assets/javascript/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous">
    </script>
</body>

</html>