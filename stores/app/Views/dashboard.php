<?php include(APPPATH . 'Views/templates/config.php'); ?>
<?= $this->extend('templates/layout') ?>
<?= $this->section('content') ?>
<title>Shops</title>


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

    .shop-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 6px 16px rgba(2, 6, 23, 0.06);
        display: flex;
        flex-direction: column;
        max-width: 300px;
    }

    .shop-card__thumb {
        position: relative;
        height: 140px;
        background: #e5e7eb;
    }

    .shop-card__thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .shop-card__chip {
        position: absolute;
        left: 10px;
        top: 10px;
        background: #fff;
        border-radius: 999px;
        padding: 6px 10px;
        font-size: 0.8rem;
        font-weight: bold;
        box-shadow: 0 6px 16px rgba(2, 6, 23, 0.12);
    }

    .shop-card__body {
        padding: 12px;
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .shop-card__title {
        font-weight: 800;
        color: #1f2937;
    }

    .shop-card__meta {
        font-size: 0.9rem;
        color: #6b7280;
        display: flex;
        justify-content: space-between;
        gap: 10px;
    }

    @media (max-width: 480px) {
        .all-shops {
            margin-top: -100px !important;
            left: 75% !important;
            width: 70px !important;
            height: 40px !important;
            font-size: 10px !important;
        }
    }

    .scroll-spacer {
        height: 50px;
        /* height of sticky header */
        margin-top: -50px;
        /* pull the section up so top aligns nicely */
    }
</style>
<section class="banner-container slidercontainer container" id="banner">
    <div class="slider-wrapper">
        <!-- <div class="loading">
                <div class="spinner"></div>
            </div> -->

        <div class="slides-container" id="slidesContainer">
            <!-- Slide  -->
            <?php if (isset($banners)):
                foreach ($banners as $key => $slide): ?>
                    <div class="slide">
                        <a href="<?= $slide['banner_link'] ?>" class="slide-link">
                            <img src="<?= $img_url . $slide['image'] ?>" alt="<?= $slide['label_name'] ?>" class="slide-image"
                                loading="eager">
                            <div class="slide-overlay">
                                <div class="slide-text"><?= $slide['label_name'] ?></div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- Navigation arrows -->
        <button class="nav-arrow prev" id="prevBtn">❮</button>
        <button class="nav-arrow next" id="nextBtn">❯</button>

        <!-- Pagination dots -->
        <div class="pagination" id="pagination"></div>

        <!-- Progress bar -->
        <!-- <div class="progress-bar" id="progressBar"></div> -->
    </div>

</section>
<div id="category">
    <div class="scroll-spacer"></div>
    <!-- Shop content here -->
</div>

<section class="container" id="categories">
    <div class="shop-category-container">
        <div class="v1-container">
            <h1 class="v1-title">Categories</h1>
            <div class="category-slider" id="categorySlider">

                <div class="slider-wrapper_2" id="sliderWrapper_2">
                    <?php if (isset($categories)):
                        foreach ($categories as $key => $cy): ?>
                            <div class="category-slide">
                                <a href="<?= base_url() . '?category=' . $cy['url_name'] ?>" class="category-link">
                                    <div class="category-card">
                                        <img src="<?= $img_sat . $cy['icon'] ?>" alt="<?= esc($cy['label_name']) ?>"
                                            class="category-icon" loading="lazy"
                                            onerror="this.onerror=null;this.src='<?= $img_sat ?>no-image.jpg';" />

                                        <div class="category-text"><?= $cy['label_name'] ?></div>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>

                </div>


                <!-- Navigation Buttons -->
                <button class="nav-button prev" id="prevBtn2">‹</button>
                <button class="nav-button next" id="nextBtn2">›</button>
            </div>

            <div class="scroll-indicator">← Swipe to see more categories →</div>
        </div>
    </div>

</section>

<div id="shoplist">
    <div class="scroll-spacer"></div>
    <!-- Shop content here -->
</div>


<script>
    // Scroll to #shoplist
    document.querySelector('a[href="#shoplist"]').addEventListener('click', function (e) {
        e.preventDefault();
        const shopsDiv = document.getElementById('shoplist');
        const headerOffset = 50; // sticky header height
        const elementPosition = shopsDiv.getBoundingClientRect().top + window.pageYOffset;
        const offsetPosition = elementPosition - headerOffset;

        window.scrollTo({
            top: offsetPosition,
            behavior: "smooth"
        });
    });

    // Scroll to #categories
    document.querySelector('a[href="#category"]').addEventListener('click', function (e) {
        e.preventDefault();
        const categoriesDiv = document.getElementById('category');
        const headerOffset = 50; // sticky header height
        const elementPosition = categoriesDiv.getBoundingClientRect().top + window.pageYOffset;
        const offsetPosition = elementPosition - headerOffset;

        window.scrollTo({
            top: offsetPosition,
            behavior: "smooth"
        });
    });


</script>



<section class="container allshops" id="allshops">
    <div class="shop-list">
        <?php
        $name = isset($_GET['category']) ? $_GET['category'] . ' by ' : 'All';
        $name = isset($place) && !empty($place) ? $place : $name;

        $showAllShops = (!isset($_GET['category']) && !isset($place));
        $placeJs = isset($place) ? json_encode($place) : 'null';

        ?>
        <h2 class="shop-list-title"><?= ucwords($name) ?> Shops</h2>


        <!-- <button class="all-shops btn btn-outline-primary <?= $showAllShops ? '' : 'd-none' ?>" id="allShopsBtn">
            <a href="<?= base_url() ?>" class="back-btn">All Shop</a>
        </button> -->

        <div class="shop-grid" id="shopGrid">
            <?php
            $colors = ['#f88585ff', '#96DED1', '#E1C16E', '#808000', '#097969'];
            ?>

            <?php if (isset($shop_list) && !empty($shop_list)): ?>
                <?php foreach ($shop_list as $key => $shop):
                    $i = $key + 1;
                    $color = $colors[$key % count($colors)];
                    ?>
                    <div class="shop-card" id="shopCard<?php echo $i; ?>">
                        <a href="<?= $base.$shop['url_name']  ?>" class="shop-link text-decoration-none" rel="noopener noreferrer">

                            <div class="shop-card__thumb">
                                <img src="<?= $img_url . $shop['image'] ?>" alt="<?= $shop['shop_name'] ?>" loading="lazy" />
                                <div class="shop-card__chip"><?= $shop['category_name'] ?></div>
                            </div>
                            <div class="shop-card__body ">
                                <div class="shop-card__title"><?= $shop['shop_name'] ?></div>
                                <div class="shop-card__meta">
                                    <span>📍<?= $shop['place'] ?></span>
                                    <span class="distance" data-longitude="<?= $shop['longitude'] ?>"
                                        data-latitude="<?= $shop['latitude'] ?>"><strong></strong></span>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>



                <div class="shop-card" id="shopCard2" style="display: block;">
                    <a href="https://Gramasandhai.in/shop2" class="shop-link text-decoration-none" rel="noopener noreferrer">

                        <div class="shop-card__thumb">
                            <img src="https://Gramasandhai.in/uploads/staticimage/Sweets.jpeg" alt="Shop2" loading="lazy">
                            <div class="shop-card__chip">Foods</div>
                        </div>
                        <div class="shop-card__body ">
                            <div class="shop-card__title">Sweets Shop</div>
                            <div class="shop-card__meta">
                                <span>📍Chennai, Ramapuram</span>
                                <!-- <span><strong>2.5 km</strong></span> -->
                            </div>
                        </div>
                    </a>
                </div>

                <div class="shop-card" id="shopCard2" style="display: block;">
                    <a href="https://Gramasandhai.in/shop2" class="shop-link text-decoration-none" rel="noopener noreferrer">

                        <div class="shop-card__thumb">
                            <img src="https://Gramasandhai.in/uploads/staticimage/bananas-698608_1280.jpg" alt="Shop2"
                                loading="lazy">
                            <div class="shop-card__chip">Foods</div>
                        </div>
                        <div class="shop-card__body ">
                            <div class="shop-card__title">Banana Shop</div>
                            <div class="shop-card__meta">
                                <span>📍Chennai, Guindy</span>
                                <!-- <span><strong>2.5 km</strong></span> -->
                            </div>
                        </div>
                    </a>
                </div>

                <div class="shop-card" id="shopCard2" style="display: block;">
                    <a href="https://Gramasandhai.in/shop2" class="shop-link text-decoration-none" rel="noopener noreferrer">

                        <div class="shop-card__thumb">
                            <img src="https://Gramasandhai.in/uploads/staticimage/market-7094635_1280.jpg" alt="Shop2"
                                loading="lazy">
                            <div class="shop-card__chip">Foods</div>
                        </div>
                        <div class="shop-card__body ">
                            <div class="shop-card__title">Vegetables Shop</div>
                            <div class="shop-card__meta">
                                <span>📍Chennai, Velachery</span>
                                <!-- <span><strong>2.5 km</strong></span> -->
                            </div>
                        </div>
                    </a>
                </div>

            <?php else: ?>
                <p class="noshop">No shops found.</p>


            <?php endif; ?>
        </div>

        <div class="load-more d-none  mb-lg-5" id="loadMoreContainer">
            <button id="loadMoreBtn">Load More</button>
        </div>
    </div>
</section>




<style>
    .shop-card-header {
        background: #42A5F5;
    }
</style>


<script>
    // Client-side fallback in case page state changes without reload
    document.addEventListener('DOMContentLoaded', function () {
        const loadMoreCont = document.getElementById('loadMoreContainer');
        const allShopsBtn = document.querySelector('.all-shops');
        const place = <?= $placeJs ?>;

        function updateButtonVisibility() {
            const urlParams = new URLSearchParams(window.location.search);
            const category = urlParams.get('category');

            if (!category && !place) {
                // Show "All Shop" button, hide "Load More"
                allShopsBtn.classList.add('d-none');
                loadMoreCont.classList.remove('d-none');

            } else {
                // Show "Load More" button, hide "All Shop"
                allShopsBtn.classList.remove('d-none');
                loadMoreCont.classList.add('d-none');
            }
        }

        updateButtonVisibility();
        window.addEventListener('popstate', updateButtonVisibility);
    });
</script>
<script>
    function getDistanceFromLatLon(lat1, lon1, lat2, lon2) {
        const R = 6371; // Earth's radius in KM
        const dLat = (lat2 - lat1) * Math.PI / 180;
        const dLon = (lon2 - lon1) * Math.PI / 180;
        const a =
            Math.sin(dLat / 2) * Math.sin(dLat / 2) +
            Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
            Math.sin(dLon / 2) * Math.sin(dLon / 2);
        const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
        return R * c;
    }

    document.addEventListener("DOMContentLoaded", function () {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                const userLat = position.coords.latitude;
                const userLon = position.coords.longitude;

                document.querySelectorAll(".distance").forEach(function (el) {
                    const shopLat = parseFloat(el.getAttribute("data-latitude"));
                    const shopLon = parseFloat(el.getAttribute("data-longitude"));
                    const distance = getDistanceFromLatLon(userLat, userLon, shopLat, shopLon);
                    el.innerHTML = `<strong>${distance.toFixed(2)} km</strong>`;
                });
            }, function (error) {
                console.error("Error getting location:", error);
                document.querySelectorAll(".distance").forEach(el => {
                    el.innerHTML = "<strong>Location unavailable</strong>";
                });
            });
        } else {
            document.querySelectorAll(".distance").forEach(el => {
                el.innerHTML = "<strong>Geolocation not supported</strong>";
            });
        }
    });
</script>


<script src="<?= base_url() ?>public/assets/javascript/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous">
    </script>



<style>
    @media screen and (max-width: 580px) {
        .allshops {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
        }

        .shop-card {
            width: 100%;
            margin-bottom: 10px;
        }

        .banner-container {
            width: 90% !important;
        }
    }
</style>
<?= $this->endSection() ?>