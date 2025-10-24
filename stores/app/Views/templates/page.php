<!DOCTYPE html>
<html lang="en">

<?php
include(APPPATH . 'Views/templates/config.php');
include(APPPATH . 'Views/templates/shopcheck.php');
include(APPPATH . 'Views/base.php'); ?>



<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gramasandhai</title>
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?= esc($site_url) . 'public/css/styles.css' ?>">
    <link rel="stylesheet" href="<?= esc($site_url) . 'public/css/style2.css' ?>">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?= esc($site_url) . 'public/css/shop_mediaquery.css' ?>">



    <style>
    body {
        /* background-color: #f8f9fa; */
    }

    .offer-card {
        transition: all 0.3s ease;
        cursor: pointer;
        border: none;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        min-height: 140px;
    }

    .offer-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

    .offer-card h5 {
        font-weight: bold;
        margin-bottom: 0.5rem;
        font-size: 1.25rem;
    }

    .offer-card p {
        margin-bottom: 0;
        opacity: 0.9;
        font-size: 0.95rem;
    }

    .offers-header {
        /* border-bottom: 3px solid #007bff; */
        display: flex;
        justify-content: center;
        align-items: center;
        padding-bottom: 4px;
        margin-bottom: 1.2rem;
    }

    .offers-header a {
        color: #333;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .offers-header a:hover {
        color: #007bff;
    }

    .category-header {
        align-items: center;
        padding-bottom: 4px;
        margin-bottom: 1.2rem;
    }

    .category-header {
        color: #333;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .category-header:hover {
        color: #007bff;
    }

    .bg-gradient-success {
        background: linear-gradient(135deg, #28a745, #20c997);
    }

    .bg-gradient-info {
        background: linear-gradient(135deg, #17a2b8, #007bff);
    }

    .bg-gradient-warning {
        background: linear-gradient(135deg, #ffc107, #fd7e14);
        color: #000;
    }

    .bg-gradient-danger {
        background: linear-gradient(135deg, #dc3545, #e83e8c);
    }

    .offer-badge {
        position: absolute;
        top: -10px;
        right: -10px;
        background: #fff;
        color: #333;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 0.8rem;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }

    .position-relative {
        position: relative;
    }

    @media (max-width: 768px) {
        .offer-card {
            min-height: 120px;
        }

        .offer-card h5 {
            font-size: 1.1rem;
        }

        .offer-card p {
            font-size: 0.9rem;
        }
    }

    /* Hide all dropdown menus by default */

    .space {
        height: 50px !important;
    }

    .offcanvas {
        max-height: 100vh !important;
    }

    .offcanvas-body {
        overflow-y: auto;
    }

    .product-card-mobile {
        border-radius: 12px !important;
        transition: all 0.3s ease;
        overflow: hidden;
        padding: 10px;
    }

    .product-card-mobile:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1) !important;
    }

    .product-image:hover {
        transform: scale(1.05);
    }

    .info-btn:hover {
        transform: rotate(90deg);
    }

    .variant-select {
        transition: border-color 0.3s, box-shadow 0.3s;
    }

    .variant-select:focus {
        border-color: #0d6efd !important;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.15) !important;
    }

    .add-to-cart-btn:hover {
        background-color: #ffff !important;
        transform: translateY(-2px);
        color: #E95F62;
        border-color: #E95F62 !important;

    }

    .favorite-btn:hover i {
        color: #dc3545 !important;
        transform: scale(1.1);
    }

    .qty-btn {
        transition: all 0.2s;
    }

    .qty-btn:hover {
        background-color: #E95F62 !important;
        color: white !important;
    }

    /* Super Small Devices (≤350px) */
    @media (max-width: 350px) {
        .product-card-mobile {
            padding: 8px;
        }

        .product-image-container {
            width: 80px !important;
            min-width: 80px !important;
        }

        .product-image {
            height: 80px !important;
        }

        .product-name {
            font-size: 0.85rem !important;
        }

        .variant-select {
            font-size: 0.75rem !important;
            height: 28px !important;
        }

        .variant-label {
            font-size: 0.6rem !important;
            top: -7px !important;
        }

        .product-price {
            font-size: 0.9rem !important;
            margin-top: 10px !important;
        }

        .add-to-cart-btn {
            font-size: 0.8rem !important;
            padding: 0.3rem !important;
        }
    }

    .container-xl.contens.container-fluid {
        flex: 1 0 auto;
    }

    .nutras-footer {
        flex-shrink: 0;
    }

    .btnadd {
        background: rgb(43, 190, 249);
        color: white;
        transition: color 0.3s ease, background 0.3s ease;
        /* 0.3s = 300ms delay */
    }

    .btnadd:hover {
        color: rgb(43, 190, 249) !important;
        background: white;
    }




    .proimg {
        width: 100px;
        height: 100px;
    }

    .main-dropdown,
    .sub-dropdown {
        display: none;
        position: absolute;
        left: 100%;
        top: 0;
        min-width: 200px;
        z-index: 1000;
        background: #fff;
        box-shadow: 0 8px 32px rgba(60, 60, 90, 0.1);
        border-radius: 8px;
    }

    /* Show main dropdown on parent hover */
    .nav-item.dropdown:hover>.main-dropdown {
        display: block;
        left: 0;
        top: 100%;
        min-width: 220px;
    }

    /* Show sub-dropdown on submenu hover */
    .dropdown-submenu:hover>.sub-dropdown {
        display: block;
        left: 100%;
        top: 0;
    }

    /* Style for dropdown items */
    .dropdown-item {
        padding: 0.5rem 1rem;
        transition: background 0.2s;
        border-radius: 6px;
    }

    .dropdown-item:hover {
        background: #f0f4ff;
        color: #0056b3;
    }

    .navs {
        display: none;
    }

    .main-header {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        z-index: 1050;
        background:
            <?=esc($color) ?> !important;
        color: <?=esc($tcolor) ?> !important;

        /* Ensure it's above other content */
    }

    .nutras-footer {
        background:
            <?=esc($color) ?> !important;
    }

    .mobile-bottom-nav {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        z-index: 1050;
        /* Above main content */
        background:
            <?=esc($color) ?> !important;
        box-shadow: 0 -2px 8px rgba(0, 0, 0, 0.08);
    }

    .mobile-bottom-nav div a {
        color: rgb(211, 235, 239) !important;
    }

    .cartcon {
        position: relative;
        right: 0;
        left: 0;
        top: 0;
        padding: 10px;


    }

    .categories-header,
    .sidebar-header {
        background:
            <?=esc($color) ?>;
    }


    .countcart {
        position: absolute;
        top: 0;
        right: 0;
        overflow-y: hidden;
        padding: 20px;

        background-color: red;
        color: white;
        border-radius: 50%;

        font-size: 0.75rem;
    }







    @media (max-width: 991.98px) {

        /* Hide desktop navbar on mobile */
        /* .scroll-container {
        overflow-x: scroll;
      }

      * {
        overflow-x: hidden;
      } */



        .navs {
            display: block;
        }

        /* Mobile only */
        body {
            /* Height of your header */
            padding-bottom: 60px;

            /* Height of your bottom nav */
        }

        .cartcon {
            position: relative;
            right: 0;
            left: 0;
            top: 0;
            padding: 10px;
        }

        .countcart {
            position: absolute;
            top: 0;
            right: 0;
            overflow-y: hidden;
            padding: 20px;

            background-color: red;
            color: white;
            border-radius: 50%;

            font-size: 0.75rem;
        }
    }

    .scroll-container {
        scroll-behavior: smooth;
        /* Makes scrolling smooth */
        white-space: nowrap;
        /* Prevents wrapping of items */
    }

    .scroll-button {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        z-index: 1;
        background: rgba(255, 255, 255, 0.7);
        border: none;
        border-radius: 50%;
        width: 30px;
        height: 30px;
        cursor: pointer;
    }

    .scroll-button.left {
        left: 0;
    }

    .scroll-button.right {
        right: 0;
    }

    #orderHistoryDropdown {
        display: none;
    }

    /* Search Modal Styles */
    #searchModal .modal-dialog {
        max-width: 500px;
    }


    .search-bar {
        position: relative;
        width: 100%;
    }

    .search-input-group {
        position: relative;
        display: flex;
        align-items: center;
    }

    .search-input-group .form-control {
        flex: 1;
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
        border-right: 0;
    }

    .search-btn {
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
        padding: 0.375rem 0.75rem;
    }


    .autocomplete-suggestions {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: white;
        border: 1px solid #ced4da;
        border-top: none;
        border-radius: 0 0 0.375rem 0.375rem;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        z-index: 2000;
        max-height: 300px;
        overflow-y: auto;
        display: none;
    }

    /* Ensure suggestions are not clipped by the input wrapper */
    .search-bar .position-relative {
        overflow: visible;
    }

    /* Ensure dropdown can overflow modal bounds if needed */
    #searchModal .modal-dialog,
    #searchModal .modal-content,
    #searchModal .modal-body {
        overflow: visible;
    }

    .suggestion-header {
        padding: 0.5rem 1rem;
        font-weight: 600;
        font-size: 0.875rem;
        color: #6c757d;
        background-color: #f8f9fa;
        border-bottom: 1px solid #dee2e6;
    }

    .autocomplete-suggestion {
        display: flex;
        align-items: center;
        padding: 0.75rem 1rem;
        cursor: pointer;
        border-bottom: 1px solid #f1f3f4;
        transition: background-color 0.15s ease-in-out;
    }

    .autocomplete-suggestion:last-child {
        border-bottom: none;
    }

    .autocomplete-suggestion:hover,
    .autocomplete-suggestion:focus {
        background-color: #f8f9fa;
        outline: none;
    }

    .autocomplete-suggestion img {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 0.25rem;
        margin-right: 0.75rem;
        border: 1px solid #dee2e6;
    }

    .suggestion-text {
        flex: 1;
    }

    .suggestion-text>div:first-child {
        font-weight: 500;
        color: #212529;
        line-height: 1.4;
        margin-bottom: 0.25rem;
    }

    .suggestion-category {
        font-size: 0.875rem;
        color: #6c757d;
    }

    /* Modal adjustments */
    .modal-dialog {
        margin: 2rem auto;
    }

    .modal-content {
        border-radius: 0.5rem;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }

    .modal-body {
        padding: 2rem;
    }

    /* Responsive adjustments */
    @media (max-width: 576px) {
        .modal-dialog {
            margin: 1rem;
        }

        .modal-body {
            padding: 1.5rem;
        }

        .autocomplete-suggestion {
            padding: 0.5rem;
        }

        .autocomplete-suggestion img {
            width: 40px;
            height: 40px;
            margin-right: 0.5rem;
        }
    }


    /* Add padding to body so content is not hidden behind header/footer */
    .flash-popup-error {
        position: fixed;
        top: 20%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: rgb(241, 135, 158);
        color: rgb(244, 248, 245);
        padding: 15px 25px;
        border-radius: 8px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        z-index: 9999;
        text-align: center;
        min-width: 250px;
        max-width: 80%;
        animation: fadeOut 5s forwards;
    }
    </style>

    <style>
    @media (max-width: 767px) {
        .p_spacer {
            margin-bottom: 100px !important;
        }

        .product-name {
            max-width: 140px !important;

        }
    }

    .position-relative {
        position: relative;
    }

    .scroll-container {
        scroll-behavior: smooth;
        -webkit-overflow-scrolling: touch;
        scrollbar-width: none;
        /* Hide scrollbar for Firefox */
        -ms-overflow-style: none;
        /* Hide scrollbar for IE/Edge */
        padding: 10px 40px;
        /* Add padding to prevent content from being hidden behind buttons */
    }

    .scroll-container::-webkit-scrollbar {
        display: none;
        /* Hide scrollbar for Chrome/Safari */
    }

    .scroll-button {
        transition: opacity 0.3s;
    }

    .scroll-button:hover {
        background: #f8f9fa !important;
    }

    /* Tab button styles */
    .tab-btn {
        border: 1px solid #ccc;
        border-radius: 10px;
        padding: 6px 16px;
        white-space: nowrap;
        font-size: 14px;
        background-color: white;
        color: #444;
        transition: all 0.3s;
    }

    .tab-btn:hover {
        border-color: #28a745;
        color: #28a745;
    }

    .tab-btn.active {
        border-color: #28a745;
        color: #28a745;
        background-color: #f0fff4;
        font-weight: 600;
    }


    .main-content {
        margin-bottom: 0;
        /* Adjust to your footer height */
    }


    /* categories container start */
    .search-header {
        background: white !important;
    }

    .position-relative {
        position: relative;
    }

    .scroll-button {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: white;
        border: 1px solid #ddd;
        border-radius: 50%;
        width: 36px;
        height: 36px;
        font-size: 16px;
        cursor: pointer;
        z-index: 10;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .scroll-button:hover {
        /* background: #f8f9fa; */
    }

    .scroll-button.left {
        left: -18px;
    }

    .scroll-button.right {
        right: -18px;
    }

    .scroll-container {
        scroll-behavior: smooth;
        -webkit-overflow-scrolling: touch;
        scrollbar-width: none;
        /* Hide scrollbar for Firefox */
        -ms-overflow-style: none;
        /* Hide scrollbar for IE/Edge */
    }

    .scroll-container::-webkit-scrollbar {
        display: none;
        /* Hide scrollbar for Chrome/Safari */
    }

    .headerd {
        background:
            <?=esc($color) ?> !important;
    }


    .infom {
        position: absolute;
        top: 40%;
        right: 7%;
        z-index: 499;
        color: rgb(43, 190, 249);
    }

    .infom2 {
        position: absolute;
        top: 0.5% !important;
        right: 0.5% !important;
        z-index: 499;
        color: rgb(43, 190, 249);

    }

    .infom3 {
        position: absolute;
        top: 1% !important;
        right: 20% !important;
        z-index: 499;
        color: rgb(43, 190, 249);
    }


    .product-name-s {
        font-size: 0.9rem;
        max-width: 170px;
        line-height: 1.3;
        display: -webkit-box !important;
        -webkit-line-clamp: 2 !important;
        /* show only 2 lines */
        -webkit-box-orient: vertical;
        overflow: hidden;
        white-space: normal;
        /* allow wrapping */
    }

    .product-name {
        font-size: 0.9rem;
        margin-top: 10px;
        max-width: 170px;
        line-height: 1.3;
        display: -webkit-box !important;
        -webkit-line-clamp: 2 !important;
        -webkit-box-orient: vertical;
        overflow: hidden;
        white-space: nowrap !important;
    }

    .mobile-bottom-nav a:hover {
        color: #ffb300 !important;
    }

    .mobile-bottom-nav a.active {
        color: #ffb300 !important;
    }

    .products-container {
        background-color: #f8f9fa;
        padding: 10px;
        border-radius: 10px;
    }
    </style>
    <?php include(APPPATH . 'Views/templates/css.php'); ?>


</head>

<?php

$main_url = $burl;

$page = $request->getUri()->getSegment(2,'home');
// print_r($page);die;

?>


<body class="d-flex flex-column  w-100">
    <header class="main-header d-flex navbars align-items-center sticky-top">
        <div class="container-xl  headerd d-flex justify-content-between align-items-center ">
            <div class="d-flex align-items-center">
                <!-- 
                <button data-bs-toggle="offcanvas" data-bs-target="#sidebarmenu" aria-controls="sidebarmenu"
                    class=" d-lg-none navbar-toggler-icon icon-btn">☰</button> -->
                <button data-bs-toggle="offcanvas" href="#offcanvasCategories" role="button"
                    class=" d-lg-none navbar-toggler-icon icon-btn">☰</button>
                <a href="<?= $base ?>">
                    <img src="<?= esc($site_url) . 'public/images/logo.png' ?>" alt="Gramasandhai Logo" width="86"
                        height="49" />
                </a>
            </div>
            <div class="flex-grow-1 text-left">
                <a href="<?= $shop_url ?> " class="text-decoration-none text-white">
                    <span class="fw-bold fs-4">Gramasandhai</span>
                </a>
            </div>
            <div class="d-flex flex-grow-1 justify-content-between align-items-center d-none d-lg-block">
                <ul class="d-block d-lg-flex  align-items-center  list-unstyled mb-0 text-start gap-5">
                    <li class="d-flex align-items-center nav-item dropdown  position-relative">
                        <a class="nav-link  dropdown-toggle" href="#" id="categoryDropdownDesktop" role="button">
                            Shop by Category
                        </a>
                        <br>
                        <ul class="dropdown-menu main-dropdown">
                            <?php foreach ($categories as $category): ?>
                            <li class="dropdown-submenu position-relative">
                                <a class="dropdown-item" href="#">
                                    <?= esc($category['category_name']) ?>
                                </a>
                                <ul class="dropdown-menu sub-dropdown">
                                    <?php foreach ($subcategories as $subcategory): ?>
                                    <?php if ($subcategory['main_category'] == $category['category_name']): ?>
                                    <li>
                                        <a class="dropdown-item"
                                            href="<?= base_url($shop_url_name . '/products/' . $category['category_id'] . '/' . $subcategory['subcategory_id']) ?>">
                                            <?= esc($subcategory['sub_category_name']) ?>
                                        </a>
                                    </li>
                                    <?php endif; ?>
                                    <?php endforeach; ?>
                                </ul>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                    <li class="nav-item list-group-item"><a class="nav-link" href="<?= $shop_url ?>">Home</a></li>
                    <li class="nav-item list-group-item"><a class="nav-link"
                            href="<?= $shop_url . '/products' ?>">Products</a></li>
                    <li class="nav-item list-group-item">
                        <a href="#" class="text-white text-center text-decoration-none" data-bs-toggle="modal"
                            data-bs-target="#searchModal">
                            <i class="fa fa-search"></i> Search...
                        </a>
                    </li>
                    <li class="nav-item dropdown position-relative d-none" id="orderHistoryDropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="orderHistoryDropdownLink" role="button">
                            Others
                        </a>
                        <ul class="dropdown-menu main-dropdown">
                            <input type="hidden" id="userIdInput">
                            <li class="dropdown-submenu position-relative">
                                <a class="dropdown-item" id="orderHistoryLink">
                                    Order History
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- <li class="nav-item list-group-item">
                        <a href="#" class="text-center text-decoration-none" data-bs-toggle="modal"
                            data-bs-target="#accountModal">
                            <div class="text-white">Account</div>
                        </a>
                    </li> -->
                </ul>
            </div>
            <div class="carts">
                <a href="<?= $shop_url . '/cart' ?>" class="text-decoration-none">
                    <div class="cart-container cartcon" style="cursor:pointer;">
                        <span class="countcart cart-count" id="cart-count">0</span>
                        <i class="text-white bi bi-cart fs-4"></i>
                    </div>
                </a>
            </div>
        </div>

    </header>


    <?php
    if (!empty($isProductShow)):
        // Get subcategory ID from the current URI
        $uri = service('uri');

        $currentFirurl = $uri->getTotalSegments() >= 1 ? $uri->getSegment(1) : '';
        $currentcutId = $uri->getTotalSegments() >= 2 ? $uri->getSegment(2) : '';
        $currentSubId = $uri->getTotalSegments() >= 3 ? $uri->getSegment(3) : '';

        function findCategoryById($array, $id)
        {
            foreach ($array as $item) {
                if ($item['category_name'] == $id) {
                    return $item;
                }
            }
            return null;
        }
        ?>

    <style>
    .main-header.second-header {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        z-index: 999;
    }



    .second-header {
        position: sticky;
        top: 76px;
        z-index: 998;
        background-color: #fff;
        /* optional for visibility */
    }

    @media (max-width: 676px) {
        .search-header {
            background: white !important;
        }
    }
    </style>
    <div class="second-header">
        <div class="container" id="products">
            <div class=" subcat-container py-2">
                <!-- Scroll container with horizontal padding to make space for buttons -->
                <div class="d-flex overflow-auto scroll-container px-4"
                    style="gap: 10px; scroll-behavior: smooth; margin-left: 10px; margin-right: 10px;"
                    id="scrollContainer">
                    <!-- All your tab buttons should be direct children of this container -->
                    <button class="subcategory-filter-btn active" data-subcategory="all"
                        onclick="filterBySubcategory('all', this)">
                        All Subcategories
                    </button>
                    <?php foreach ($subcategories as $subcategory): ?>
                    <button class="subcategory-filter-btn" data-subcategory="<?= $subcategory['subcategory_id'] ?>"
                        data-main-category="<?= $subcategory['main_category'] ?>"
                        onclick="filterBySubcategory('<?= $subcategory['subcategory_id'] ?>', this)">
                        <?= esc($subcategory['sub_category_name']) ?>
                    </button>
                    <?php endforeach; ?>

                </div>

                <!-- Scroll buttons - positioned absolutely on either side -->
                <button class="scroll-button left" onclick="scrollContainer('left')"
                    style="position: absolute; left: 0; top: 50%; transform: translateY(-50%); z-index: 10; background: white; border: 1px solid #ddd; border-radius: 50%; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                    <span class="bi bi-chevron-left"></span>
                </button>

                <button class="scroll-button right" onclick="scrollContainer('right')"
                    style="position: absolute; right: 0; top: 50%; transform: translateY(-50%); z-index: 10; background: white; border: 1px solid #ddd; border-radius: 50%; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 5px rgba(0,0,0,0.1); ">
                    <span class="bi bi-chevron-right"></span>
                </button>
            </div>
        </div>
    </div>
    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="modaloffer" tabindex="-1" aria-labelledby="modalofferLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="background-color: #f8f9fa;">
                <!-- Background color added here -->
                <div class="modal-header" style="border-bottom: 1px solid #e9ecef;">
                    <h5 class="modal-title" id="modalofferLabel">Current Offers</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="no-offers-container text-center p-5 my-3 rounded-3 shadow-sm"
                        style="background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%); border: 1px solid rgba(0,0,0,0.05);">
                        <div class="icon-wrapper mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="#6c757d"
                                class="bi bi-tags" viewBox="0 0 16 16">
                                <path
                                    d="M3 2v4.586l7 7L14.586 9l-7-7H3zM2 2a1 1 0 0 1 1-1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 2 6.586V2z" />
                                <path
                                    d="M5.5 5a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm0 1a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3zM1 7.086a1 1 0 0 0 .293.707L8.75 15.25l-.043.043a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 0 7.586V3a1 1 0 0 1 1-1v5.086z" />
                            </svg>
                        </div>
                        <h2 class="text-muted mb-3 fw-semibold">No Offers Available At This Time</h2>
                        <p class="text-secondary mb-4">We're currently updating our deals. Check back soon for exciting
                            discounts and special promotions!</p>

                        <div class="d-flex justify-content-center gap-3">
                            <button class="btn btn-outline-primary" onclick="location.reload()">
                                <i class="bi bi-arrow-repeat me-2"></i>Refresh
                            </button>
                            <button class="btn btn-primary" onclick="subscribeToNewsletter()">
                                <i class="bi bi-envelope-plus me-2"></i>Notify Me
                            </button>
                        </div>

                        <div class="mt-4 text-muted small">
                            <i class="bi bi-info-circle me-1"></i> New offers are typically added every Tuesday and
                            Friday.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    function subscribeToNewsletter() {
        // Add your newsletter subscription logic here
        alert('You will be notified when new offers are available!');
    }
    </script>

    <style>
    .no-offers-container {
        transition: all 0.3s ease;
    }

    .no-offers-container:hover {
        transform: translateY(-2px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1) !important;
    }

    .icon-wrapper {
        opacity: 0.7;
    }
    </style>

    <script>
    function scrollContainer(direction) {
        const container = document.getElementById('scrollContainer');
        const scrollAmount = 200; // Adjust this value as needed

        if (direction === 'left') {
            container.scrollBy({
                left: -scrollAmount,
                behavior: 'smooth'
            });
        } else {
            container.scrollBy({
                left: scrollAmount,
                behavior: 'smooth'
            });
        }

        // Update button visibility after scrolling
        setTimeout(updateButtonVisibility, 300);
    }

    function updateButtonVisibility() {
        const container = document.getElementById('scrollContainer');
        const leftBtn = document.querySelector('.scroll-button.left');
        const rightBtn = document.querySelector('.scroll-button.right');

        // Check if content is scrollable
        const canScroll = container.scrollWidth > container.clientWidth;

        // Update left button
        if (container.scrollLeft <= 0) {
            leftBtn.style.display = 'none';
        } else {
            leftBtn.style.display = canScroll ? 'flex' : 'none';
        }

        // Update right button
        if (container.scrollLeft + container.clientWidth >= container.scrollWidth) {
            rightBtn.style.display = 'none';
        } else {
            rightBtn.style.display = canScroll ? 'flex' : 'none';
        }
    }

    // Initialize on load and on resize
    document.addEventListener('DOMContentLoaded', function() {
        updateButtonVisibility();
        window.addEventListener('resize', updateButtonVisibility);

        const container = document.getElementById('scrollContainer');
        container.addEventListener('scroll', updateButtonVisibility);
    });
    </script>


    <?php endif ?>



    <div class="modal fade overflow-x-hidden" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body p-3">
                    <div class="search-bar d-flex flex-column flex-md-row gap-2">
                        <div class="d-flex flex-grow-1 position-relative">
                            <input type="text" id="liveSearch" class="form-control"
                                placeholder="Search for products or categories..." autocomplete="off">
                            <button type="button" class="btn btn-primary ms-2"><i class="fas fa-search"></i></button>
                            <div id="searchSuggestions" class="autocomplete-suggestions"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="container-xl overflow-x-hidden contens">

        <div class="main-content container-xl">
            <?= $this->renderSection('index') ?>
        </div>

    </div>

    <div id="overlay"></div>





    <div class="offcanvas offcanvas-start" tabindex="-1" id="sidebarmenu" aria-labelledby="sidebarmenuLabel">
        <div class="top-bar d-flex justify-content-between align-items-center sidebar-header ">
            <h2 class="text-white"> Gramasandhai </h2>
            <button type="button" class="btn-close text-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="menu-items">

                <a class="nav-link" data-bs-toggle="offcanvas" href="#offcanvasCategories" role="button">
                    Shop by Category
                </a>
                <a class="nav-link" href="javascript:void(0)" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasCompanyInfo" aria-controls="offcanvasCompanyInfo">Abouts</a>
                <a class="nav-link" href="javascript:void(0)" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasDataPolicy" aria-controls="offcanvasDataPolicy">Privacy</a>
                <a class="nav-link" href="#about">Contacts</a>


                <a class="nav-link" id="orderHistoryLinkside">
                    Order History
                </a>

            </div>
        </div>
    </div>

    <!-- Company Info Offcanvas -->
    <div class="offcanvas offcanvas-start aboubsoffcanvas" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1"
        id="offcanvasCompanyInfo" aria-labelledby="offcanvasCompanyInfoLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasCompanyInfoLabel">Company Info</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <p>We are a company committed to delivering innovative solutions and exceptional customer service. Our
                journey began with a vision to lead and inspire through technology.</p>
        </div>
    </div>



    <!-- Button to trigger Data Policy offcanvas -->


    <!-- Data Policy Offcanvas -->
    <div class="offcanvas offcanvas-start policyoffcanvas " data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1"
        id="offcanvasDataPolicy" aria-labelledby="offcanvasDataPolicyLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title text-white" id="offcanvasDataPolicyLabel">Data Policy</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>

        <div class="privacy-box">
            <h2>Your Privacy Matters</h2>
            <p>
                We respect your privacy and are committed to protecting your personal data.
                Learn more by reading our .
            </p>
        </div>

    </div>

    <div class="modal fade" id="imagemodel" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-transparent border-0 shadow-none">
                <div class="modal-body text-center">
                    <img src="<?= $img_sat ?>no-image.jpg" class="img-fluid rounded" id="modalImage" alt="Product Image"
                        onerror="this.onerror=null;this.src='<?= $img_sat ?>no-image.jpg';"
                        style="max-height:600px; max-width:800px; object-fit:contain;">
                </div>
            </div>
        </div>
    </div>



    <!-- Info Modal -->
    <div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title" id="infoModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body" id="infoModalBody">
                    <!-- Product description will be loaded here -->
                </div>

            </div>
        </div>
    </div>

    <script>
    document.cookie = "userId=" + encodeURIComponent(localStorage.getItem('userId')) + "; path=/";
    </script>


    <!-- Script -->
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        var imageModal = document.getElementById('imagemodel');
        var modalImg = document.getElementById('modalImage');

        imageModal.addEventListener('show.bs.modal', function(event) {
            var trigger = event.relatedTarget; // The clicked thumbnail
            if (trigger) {
                var imgSrc = trigger.getAttribute('data-image');
                modalImg.src = imgSrc;
            }
        });
    });

    document.addEventListener("DOMContentLoaded", function() {
        var infoModal = document.getElementById('infoModal');
        var modalTitle = document.getElementById('infoModalLabel');
        var modalBody = document.getElementById('infoModalBody');

        infoModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget; // Button that triggered the modal
            var productName = button.getAttribute('data-product-name');
            var description = button.getAttribute('data-description');

            modalTitle.textContent = productName;
            modalBody.textContent = description || "No description available.";
        });
    });
    </script>





    <!-- Offcanvas -->
    <div class="offcanvas offcanvas-start   shophycategory" tabindex="-1" id="offcanvasCategories" style="width: 100%;"
        aria-labelledby="offcanvasCategoriesLabel">
        <div class="offcanvas-header  text-white categories-header  ">
            <h3 class="offcanvas-title" id="offcanvasCategoriesLabel">Categories</h3>
            <button type="button" class="btn-close text-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>

        <div class="myoffcanvas-menu">
            <ul class="myoffcanvas-main-menu">
                <?php foreach ($categories as $category): ?>

                <li class="myoffcanvas-menu-item myoffcanvas-has-submenu">
                    <a href="#" class="myoffcanvas-menu-link">
                        <?= esc($category['category_name']) ?>
                        <span class="myoffcanvas-menu-icon">+</span>
                    </a>
                    <ul class="myoffcanvas-submenu">
                        <?php foreach ($subcategories as $subcategory): ?>
                        <?php if ($subcategory['main_category'] == $category['category_name']): ?>
                        <li class="myoffcanvas-submenu-item">
                            <a href="<?= base_url($shop_url_name . '/products/' . $category['category_id'] . '/' . $subcategory['subcategory_id']) ?>"
                                class="myoffcanvas-submenu-link"> <?= esc($subcategory['sub_category_name']) ?></a>
                        </li>


                        <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </li>
                <?php endforeach; ?>


            </ul>
        </div>
    </div>


    <style>
    #sidebarmenu {
        font-family: Arial, sans-serif;
        font-weight: bold;
        /* width: 90%; */
    }

    .shophycategory,
    .policyoffcanvas,
    .aboubsoffcanvas {
        z-index: 10999 !important;
        overflow-y: auto;
    }

    .myoffcanvas-menu {
        font-family: Arial, sans-serif;
        width: 100%;
        background: #fff;
        border: 1px solid #ddd;
        padding: 0;
        /* margin: 40px auto; */
    }

    .myoffcanvas-main-menu,
    .myoffcanvas-submenu {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .myoffcanvas-menu-link {
        font-weight: bold;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 14px 24px;
        color: #222;
        text-decoration: none;
        border-bottom: 1px solid #f2f2f2;
        background: #fff;
        cursor: pointer;
        transition: background 0.2s, color 0.2s;
    }

    .myoffcanvas-menu-link:hover {
        background: #f3f6fa;
        color: #0056b3;
    }

    .myoffcanvas-menu-icon {
        font-size: 1.2em;
        margin-left: 12px;
        transition: transform 0.3s;
    }

    .myoffcanvas-submenu {
        display: none;
        margin-top: 10px;
        background: #f7f8fa;
        padding-left: 10px;
        border-left: 3px solid #e2e6ea;
        border-radius: 0 0 6px 6px;
    }

    .myoffcanvas-menu-item.active>.myoffcanvas-submenu {
        display: block;
    }

    .myoffcanvas-menu-item.active>.myoffcanvas-menu-link .myoffcanvas-menu-icon {
        transform: rotate(45deg);
        color: #007bff;
    }

    .myoffcanvas-submenu-link {
        display: block;
        padding: 11px 20px;
        color: #444;
        text-decoration: none;
        border-radius: 4px;
        margin: 3px 0;
        transition: background 0.2s, color 0.2s;
        font-weight: 500;
    }

    .myoffcanvas-submenu-link:hover {
        background: #e2e6ea;
        color: #0056b3;
    }

    .policyoffcanvas,
    .aboubsoffcanvas {
        background-color: #689F38;

    }

    .privacy-box {
        background-color: #689F38;
        color: white;
        padding: 20px;
        border-radius: 8px;
        font-family: Arial, sans-serif;
        max-width: 600px;
        margin: 40px auto;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .privacy-box h2 {
        margin-top: 0;
    }

    .privacy-box a {
        color: #d4ffc0;
        text-decoration: underline;
    }

    .privacy-box a:hover {
        text-decoration: none;
    }
    </style>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.myoffcanvas-menu-link').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const parent = this.closest('.myoffcanvas-menu-item');
                const submenu = parent.querySelector('.myoffcanvas-submenu');
                // Close other open menus
                document.querySelectorAll(
                    '.myoffcanvas-menu-item.myoffcanvas-has-submenu').forEach(
                    item => {
                        if (item !== parent) {
                            item.classList.remove('active');
                            const sub = item.querySelector('.myoffcanvas-submenu');
                            if (sub) sub.classList.remove('active');
                        }
                    });
                // Toggle current
                parent.classList.toggle('active');
                if (submenu) submenu.classList.toggle('active');
            });
        });
    });
    </script>



    <div class="nutras-footer nutras-footer-bottom text-center d-none d-lg-block">
        <span>&copy; 2025 Gramasandhai. All Rights Reserved.</span>
        <span class="footer-bottom-links ms-3">
            <a href="#">Terms of Service</a> &nbsp;|&nbsp;
            <a href="#">Privacy Policy</a>
        </span>
    </div>



    <!-- Overlay -->
    <div id="overlay"></div>

    <!-- Side Menu -->
    <div id="side-menu">
        <div class="menu-header">
            <span>Categories</span>
            <button id="close-btn">×</button>
        </div>
        <a href="#" class="menu-item">Home</a>
        <a href="#" class="menu-item">Profile</a>
        <a href="#" class="menu-item">Settings</a>
        <a href="#" class="menu-item">Offers</a>
        <a href="#" class="menu-item">Logout</a>
    </div>

    <div class="d-block d-lg-none mobile-bottom-nav">
        <div class="d-flex justify-content-around py-2 mt-2">
            <a href="<?= base_url($shop_url_name) ?>"
                class="text-center text-decoration-none   <?= $page == 'home' ? 'active' : ''?>">
                <i class="bi bi-house-door fs-4"></i>
                <div class="small">Home</div>
            </a>

            <a href="<?= base_url($shop_url_name . '/products') ?>"
                class="text-center text-decoration-none  <?= $page == 'products' ? 'active' : ''?>">
                <i class="bi bi-basket fs-4"></i>
                <div class="small">Products</div>
            </a>
            <a href="#" class="text-center text-decoration-none" data-bs-toggle="modal" data-bs-target="#searchModal">
                <i class="bi bi-search fs-4"></i>
                <div class="small">Search</div>
            </a>


            <a class="text-center text-decoration-none <?= $page == 'offers' ? 'active' : ''?>"
                href="<?= base_url($shop_url_name) ?>/offers/products">
                <i class="bi bi-gift fs-4"></i>
                <div class="small">Offers</div>
            </a>
            <a href="#" class="text-center text-decoration-none" data-bs-toggle="modal" data-bs-target="#accountModal">
                <i class="bi bi-person fs-4"></i>
                <div class="small">Account</div>
            </a>
        </div>
    </div>

    <style>
    .fixed-bottom {
        border-top: 1px solid #eee;
        z-index: 1100;
    }

    .fixed-bottom a {
        color: #666;
        padding: 5px 10px;
        position: relative;
    }

    .fixed-bottom a.active {
        color: #0d6efd;
    }

    #cart-count {
        top: 5px;
        /* right: 18%; */
        font-size: 10px;
    }

    @media (min-width: 992px) {
        .fixed-bottom {
            display: none !important;
        }

        .navbars {
            position: sticky;
            top: 0;
            z-index: 1100;
        }
    }

    #accountModal .modal-content {
        border-radius: 10px;
    }

    #accountModal .modal-header {
        border-bottom: 1px solid #eee;
    }

    #accountModal .modal-body {
        padding: 1.5rem;
    }

    #accountModal .form-control {
        padding: 0.75rem;
        border-radius: 8px;
        border: 1px solid #ddd;
    }

    #accountModal .btn-primary {
        padding: 0.75rem;
        border-radius: 8px;
        font-weight: 500;
    }

    #accountModal .btn-link {
        text-decoration: none;
        color: #666;

    }

    #mobileNumberDisplay {
        font-weight: 500;
        color: #333;
    }

    .product-card {
        transition: transform 0.2s;
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .offer-card {
        transition: transform 0.2s;
        height: 100%;
    }

    .offer-card:hover {
        transform: scale(1.03);
    }

    @media (max-width: 576px) {
        .mobile-bottom {
            margin-bottom: 100px !important;
        }
    }

    .modal-header {
        background-color: rgb(43, 190, 249) !important;
    }
    </style>

    <?php
    if (!empty($allproducts)) {
        $newModel = $allproducts;
    } else {
        $newModel = $products;
    }
    ?>
    <script>
    const baseURL = "<?= base_url() ?>";
    const userIdInput = document.querySelector("#userIdInput");
    const orderHistoryLink = document.querySelector("#orderHistoryLink");
    const orderHistoryLinkside = document.querySelector("#orderHistoryLinkside"); // FIXED
    const userId = JSON.parse(localStorage.getItem("userId"));

    if (userId && orderHistoryLink) {
        orderHistoryLink.href = baseURL + "<?= $shop_url_name ?>/orderHistoryPage/" + userId;
    }

    if (userId && orderHistoryLinkside) {
        orderHistoryLinkside.href = baseURL + "<?= $shop_url_name ?>/orderHistoryPage/" + userId;
    }
    </script>

    <!-- Bootstrap JS at end of body for proper functionality -->

    <script src="<?= esc($site_url) . 'public/js/script.js' ?>"></script>
    <script src="<?= esc($site_url) . 'public/js/script2.js' ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function()



    // Account Modal Functionality
    const accountModal = document.getElementById('accountModal');
    const loginForm = document.getElementById('loginForm');
    const otpForm = document.getElementById('otpForm');
    const userInfo = document.getElementById('userInfo');
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

    // Cart Functions
    // function getCart() {
    //     try {
    //         const cartData = localStorage.getItem('cart');
    //         return cartData ? JSON.parse(cartData) : [];
    //     } catch (e) {
    //         console.error("Error reading cart from localStorage:", e);
    //         return [];
    //     }
    // }

    // function saveCart(cart) {
    //     localStorage.setItem('cart', JSON.stringify(cart));
    // }

    // function updateCartCount() {
    //     const cart = getCart();
    //     const totalItems = cart.reduce((total, item) => total + item.quantity, 0);
    //     document.querySelectorAll('.cart-count').forEach(el => el.textContent = totalItems);
    // }

    // function initializeCart() {
    //     updateCartCount();
    //     initializeQuantityControls();
    // }

    // function initializeQuantityControls() {
    //     const cart = getCart();

    //     document.querySelectorAll('.product-card').forEach(card => {
    //         const productId = card.querySelector('img').getAttribute('data-id');
    //         const select = card.querySelector('.qty-select');
    //         if (!select) return;

    //         const selectedOption = select.options[select.selectedIndex];
    //         const measure = selectedOption.getAttribute('data-measure');
    //         const cartItem = cart.find(item => item.id === productId && item.measure === measure);

    //         if (cartItem) {
    //             toggleCartUI(card, true, cartItem.quantity);
    //         } else {
    //             toggleCartUI(card, false);
    //         }
    //     });
    // }

    // function toggleCartUI(card, isInCart, quantity = 1) {
    //     const addButton = card.querySelector('.add-to-cart-btn');
    //     const qtyGroup = card.querySelector('.qty-group');
    //     const qtyInput = card.querySelector('.qty-number');

    //     if (isInCart) {
    //         if (addButton) addButton.classList.add('d-none');
    //         if (qtyGroup) {
    //             qtyGroup.classList.remove('d-none');
    //             if (qtyInput) qtyInput.value = quantity;
    //         }
    //     } else {
    //         if (addButton) addButton.classList.remove('d-none');
    //         if (qtyGroup) qtyGroup.classList.add('d-none');
    //     }
    // }

    // // Event Handlers
    // function handleAddToCart(button) {
    //     const card = button.closest('.product-card');
    //     if (!card) return;

    //     const productId = card.querySelector('img').getAttribute('data-id');
    //     const productName = card.querySelector('.product-name').textContent;
    //     const select = card.querySelector('.qty-select');
    //     const selectedOption = select.options[select.selectedIndex];
    //     const price = parseFloat(selectedOption.value);
    //     const measure = selectedOption.getAttribute('data-measure');
    //     const image = card.querySelector('img').src;
    //     const imageName = card.querySelector('#image_name')?.value || '';

    //     let cart = getCart();
    //     const existingItemIndex = cart.findIndex(item =>
    //         item.id === productId && item.measure === measure
    //     );

    //     if (existingItemIndex !== -1) {
    //         cart[existingItemIndex].quantity += 0;
    //     } else {
    //         cart.push({
    //             id: productId,
    //             name: productName,
    //             price: price,
    //             measure: measure,
    //             quantity: 1,
    //             image: image,
    //             image_name: imageName
    //         });
    //     }


    //     saveCart(cart);
    //     updateCartCount();

    //     // Show toast notification
    //     const toast = new bootstrap.Toast(document.getElementById('cart-toast'));
    //     const toastBody = document.querySelector('#cart-toast .toast-body');
    //     if (toastBody) toastBody.textContent = `${productName} (${measure}) added to cart`;
    //     toast.show();

    //     // Update UI immediately
    //     toggleCartUI(card, true, existingItemIndex !== -1 ? cart[existingItemIndex].quantity : 0);
    // }




    });
    </script>


    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('liveSearch');
        const suggestionsDiv = document.getElementById('searchSuggestions');
        let searchTimeout;

        // Product data from PHP
        const products = <?= json_encode($newModel) ?>;

        const categories = <?= json_encode(array_column($categories, null, 'id')) ?>;

        // Function to show suggestions
        function showSuggestions(searchTerm) {
            suggestionsDiv.innerHTML = '';

            if (searchTerm.length < 2) {
                suggestionsDiv.style.display = 'none';
                return;
            }

            const searchTermLower = searchTerm.toLowerCase();

            // Filter categories
            const filteredCategories = Object.values(categories).filter(cat => {
                return cat.category_name.toLowerCase().includes(searchTermLower);
            });

            // Filter products
            const filteredProducts = products.filter(product => {
                return product.prod_name.toLowerCase().includes(searchTermLower);
            });

            if (filteredCategories.length > 0 || filteredProducts.length > 0) {
                // Add categories section
                if (filteredCategories.length > 0) {
                    const header = document.createElement('div');
                    header.className = 'suggestion-header';
                    header.textContent = 'Categories';
                    suggestionsDiv.appendChild(header);

                    filteredCategories.slice(0, 3).forEach(category => {
                        const div = document.createElement('div');
                        div.className = 'category-suggestion';
                        div.innerHTML = `
                            <i class="fas fa-folder-open me-2"></i>
                            ${category.category_name}
                        `;
                        div.addEventListener('click', function() {
                            window.location.href =
                                '<?= base_url($shop_url_name . '/category/') ?>' +
                                category.id;
                        });
                        suggestionsDiv.appendChild(div);
                    });
                }

                // Add products section
                if (filteredProducts.length > 0) {
                    const header = document.createElement('div');
                    header.className = 'suggestion-header';
                    header.textContent = 'Products';
                    suggestionsDiv.appendChild(header);

                    filteredProducts.slice(0, 5).forEach(product => {
                        const div = document.createElement('div');
                        div.className = 'autocomplete-suggestion';
                        div.dataset.id = product.id;

                        // Create suggestion content
                        div.innerHTML = `
                            ${product.main_image ? `<img src="<?= $img_url ?>${product.main_image}" alt="${product.prod_name.replace(/"/g, '&quot;')}">` : '<div class="img-placeholder"></div>'}
                            <div class="suggestion-text">
                                <div>${product.prod_name.replace(/</g, '&lt;').replace(/>/g, '&gt;')}</div>
                                <div class="suggestion-category">${(categories[product.category_id]?.category_name || '').replace(/</g, '&lt;').replace(/>/g, '&gt;')}</div>
                            </div>
                        `;

                        div.addEventListener('click', function() {
                            window.location.href =
                                '<?= base_url($shop_url_name . '/search-products') ?>' + '/' +
                                product.subcategory_id + '/' + product.id;
                        });

                        suggestionsDiv.appendChild(div);
                    });
                }

                suggestionsDiv.style.display = 'block';
            } else {
                const noResults = document.createElement('div');
                noResults.className = 'autocomplete-suggestion';
                noResults.textContent = 'No results found';
                suggestionsDiv.appendChild(noResults);
                suggestionsDiv.style.display = 'block';
            }
        }

        // Debounced input handler
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            const searchTerm = this.value.trim();

            searchTimeout = setTimeout(() => {
                showSuggestions(searchTerm);
            }, 300);
        });

        // Hide suggestions when clicking elsewhere
        document.addEventListener('click', function(e) {
            if (!searchInput.contains(e.target) && !suggestionsDiv.contains(e.target)) {
                suggestionsDiv.style.display = 'none';
            }
        });

        // Keyboard navigation
        searchInput.addEventListener('keydown', function(e) {
            if (e.key === 'ArrowDown' || e.key === 'ArrowUp' || e.key === 'Enter') {
                const suggestions = suggestionsDiv.querySelectorAll(
                    '.autocomplete-suggestion, .category-suggestion');
                const active = document.querySelector(
                    '.autocomplete-suggestion.active, .category-suggestion.active');

                if (suggestions.length === 0) return;

                let index = Array.from(suggestions).indexOf(active);

                if (e.key === 'ArrowDown') {
                    e.preventDefault();
                    index = (index + 1) % suggestions.length;
                } else if (e.key === 'ArrowUp') {
                    e.preventDefault();
                    index = (index - 1 + suggestions.length) % suggestions.length;
                } else if (e.key === 'Enter' && active) {
                    if (active.classList.contains('autocomplete-suggestion')) {
                        window.location.href = '<?= base_url('index.php/productShow/') ?>' + active
                            .dataset.id;
                    } else {
                        active.click();
                    }
                    return;
                }

                suggestions.forEach(s => s.classList.remove('active'));
                suggestions[index].classList.add('active');
                suggestions[index].scrollIntoView({
                    block: 'nearest'
                });
            }
        });
    });
    // Enhanced interactivity for the super design
    document.addEventListener('DOMContentLoaded', function() {
        // Add hover effects


        const productCards = document.querySelectorAll('.product-card-mobile');
        productCards.forEach(card => {
            // Favorite button toggle
            const favBtn = card.querySelector('.favorite-btn');
            if (favBtn) {
                favBtn.addEventListener('click', function() {
                    const icon = this.querySelector('i');
                    icon.classList.toggle('bi-heart');
                    icon.classList.toggle('bi-heart-fill');
                    icon.classList.toggle('text-danger');
                });
            }

            // Add to cart button animation
            const addBtn = card.querySelector('.add-to-cart-btn');
            if (addBtn) {
                addBtn.addEventListener('click', function() {
                    const addText = this.querySelector('.add-text');
                    const addedText = this.querySelector('.added-text');

                    addText.classList.add('d-none');
                    addedText.classList.remove('d-none');


                    // Revert after 2 seconds
                    setTimeout(() => {
                        addText.classList.remove('d-none');
                        addedText.classList.add('d-none');
                    }, 2000);
                });
            }
        });
    });


    function setCookie(name, value, days) {
        let expires = "";
        if (days) {
            let date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + (value || "") + expires + "; path=/";
    }

    // Simple cookie get function
    function getCookie(name) {
        let nameEQ = name + "=";
        let ca = document.cookie.split(';');
        for (let i = 0; i < ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) == ' ') c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
        }
        return null;
    }
    </script>

    <script>
    function handleOfferClick(offerType) {
        // Track offer interaction
        console.log(`Offer clicked: ${offerType}`);

        // You can replace this with your actual navigation logic
        // switch (offerType) {
        //     case 'nandhini-bogo':
        //         // window.location.href = 'offers/nandhini-bogo';
        //         alert('Redirecting to Nandhini Buy 1 Get 1 offer...');
        //         break;
        //     case 'fresh-produce-20':
        //         // window.location.href = 'offers/AEDSW';
        //         alert('Redirecting to Fresh Produce 20% off...');
        //         break;
        //     case 'tea-combo':
        //         // window.location.href = 'offers/tea-combo';
        //         alert('Redirecting to Tea combo offer...');
        //         break;
        //     case 'ghee-combo':
        //         // window.location.href = 'offers/ghee-combo';
        //         alert('Redirecting to Ghee combo offer...');
        //         break;
        //     default:
        //         console.log('Unknown offer type');
        // }
    }

    // Keyboard navigation support
    document.addEventListener('keydown', function(e) {
        if (e.target.classList.contains('offer-card') && (e.key === 'Enter' || e.key === ' ')) {
            e.preventDefault();
            e.target.click();
        }
    });

    // Optional: Add loading animation
    document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.offer-card');
        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';

            setTimeout(() => {
                card.style.transition = 'all 0.5s ease';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 100);
        });
    });
    </script>

    <script>
    // const cart_shop = "<?= $shop_url_name ?>";

    

    // // Attach click event to multiple IDs
    // ["addCart1", "addCart2", "addCart3","addCart4"].forEach(id => {
    //     const cart_add_btn = document.getElementById(id);
    //     if (cart_add_btn) {
    //         cart_add_btn.addEventListener("click", () => {
    //             localStorage.setItem("cart_shop", cart_shop);
    //             console.log("Cart shop set:", cart_shop);
    //         });
    //     }
    // });

    // console.log("shop:", localStorage.getItem("cart_shop"));
    // console.log("shop (PHP value):", cart_shop);
    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>