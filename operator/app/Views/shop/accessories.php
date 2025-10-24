<?php include(APPPATH . 'Views/templates/config.php'); ?>

<?= $this->extend('templates/layout') ?>

<?= $this->section('content') ?>
<style>
    .btn-group-gap {
        display: flex;
        gap: 20px;
        justify-content: center;
        align-items: end;
    }
</style>

<div class="container-fluid py-4">


    <!-- First Row - Products Management -->
    <div class="row g-4 mb-4">
        <!-- Products Section -->
        <div class="col-lg-4 col-md-6">
            <div class="card h-100 text-center shadow-sm">
                <div class="card-body d-flex flex-column">

                    <h4 class="card-title text-dark">Products</h4>
                    <p class="text-muted mb-4">Product - Weight, </p>
                    <div class="mt-auto btn-group-gap">
                        <a href="<?= base_url('shop/' . $shop_id . '/product/add') ?>"
                            class="btn btn-primary px-4 py-2">
                            Add Products
                        </a>

                        <a href="<?= base_url('shop/' . $shop_id . '/products') ?>" class="btn btn-primary px-4 py-2">
                            View Products
                        </a>
                    </div>
                </div>
            </div>
        </div>



        <!-- Category Section -->
        <div class="col-lg-4 col-md-6 ">
            <div class="card h-100 text-center shadow-sm">
                <div class="card-body d-flex flex-column">

                    <h4 class="card-title text-dark">Category</h4>
                    <p class="text-muted mb-4">Delivery, Platform, etc</p>

                    <div class="mt-auto gap-2 btn-group-gap">
                        <a href="<?= base_url('shop/' . $shop_id . '/categories') ?>" class="btn btn-primary px-4 py-2">
                            Category
                        </a>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 ">
            <div class="card h-100 text-center shadow-sm">
                <div class="card-body d-flex flex-column">

                    <h4 class="card-title text-dark">SubCategory</h4>
                    <p class="text-muted mb-4">Delivery, Platform, etc</p>

                    <div class="mt-auto gap-2 btn-group-gap">
                        <a href="<?= base_url('shop/' . $shop_id . '/subcategories') ?>"
                            class="btn btn-primary px-4 py-2">
                            SubCategory
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">

        <div class="col-lg-4 col-md-6">
            <div class="card h-100 text-center shadow-sm">
                <div class="card-body d-flex flex-column">

                    <h4 class="card-title text-dark">Fee-manage</h4>
                    <p class="text-muted mb-4">Delivery, Platform, etc</p>
                    <div class="btn-group-gap">
                        <a href="<?= base_url('shop/' . $shop_id . '/fee-manage') ?>" class="btn btn-primary px-4 py-2">
                            Manage
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card h-100 text-center shadow-sm">
                <div class="card-body d-flex flex-column">

                    <h4 class="card-title text-dark">Offers</h4>
                    <p class="text-muted mb-4"> Summer Sale, Deal, etc</p>
                    <div class="btn-group-gap">
                        <a href="<?= base_url('shop/' . $shop_id . '/offers') ?>" class="btn btn-primary px-4 py-2">
                            Offers
                        </a>

                        <a href="<?= base_url('shop/' . $shop_id . '/addoffer') ?>" class="btn btn-primary px-4 py-2">
                            Add
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card h-100 text-center shadow-sm">
                <div class="card-body d-flex flex-column">

                    <h4 class="card-title text-dark">Payment</h4>
                    <p class="text-muted mb-4"> Qr Code , Phone, etc</p>
                    <div class="btn-group-gap">
                        <a href="<?= base_url('shop/' . $shop_id . '/payment_detail_list') ?>"
                            class="btn btn-primary px-4 py-2">
                            Payment
                        </a>

                        <a href="<?= base_url('shop/' . $shop_id . '/addPaymentDetails') ?>"
                            class="btn btn-primary px-4 py-2">
                            Add
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 text-center shadow-sm">
                    <div class="card-body d-flex flex-column">

                        <h4 class="card-title text-dark">Shop Banner</h4>
                        <p class="text-muted mb-4">Shop home page, etc</p>
                        <div class="btn-group-gap">
                            <a href="<?= base_url('shop/' . $shop_id . '/shopBanner') ?>"
                                class="btn btn-primary px-4 py-2">
                                Bannar
                            </a>

                            <a href="<?= base_url('shop/' . $shop_id . '/shopBannerAdd') ?>"
                                class="btn btn-primary px-4 py-2">
                                Add
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 text-center shadow-sm">
                    <div class="card-body d-flex flex-column">

                        <h4 class="card-title text-dark">Bulk Upload</h4>
                        <p class="text-muted mb-4">Products , Variants, etc</p>
                        <div class="btn-group-gap">
                            <!-- <a href="<?= base_url('shop/' . $shop_id . '/shopBanner') ?>"
                                class="btn btn-primary px-4 py-2">
                                Bannar
                            </a> -->

                            <a href="<?= base_url('shop/' . $shop_id . '/bulk-upload') ?>"
                                class="btn btn-primary px-4 py-2">
                                Upload
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div>

    <!-- Second Row - Store Operations -->
    <div class="row g-4 d-none">
        <!-- Delivery Fee Section -->
        <div class="col-lg-4 col-md-6d-none ">
            <div class="card h-100 text-center shadow-sm">
                <div class="card-body d-flex flex-column">
                    <div class="mb-3">
                        <div class="d-flex justify-content-center">
                            <div style="width: 80px; height: 80px;">
                                <i class="fas fa-truck text-success" style="font-size: 40px;"></i>
                                <div class="text-success fw-bold mt-1" style="font-size: 14px;">
                                    DELIVERY<br>FEE
                                </div>
                            </div>
                        </div>
                    </div>
                    <h4 class="card-title text-dark">Fees</h4>
                    <p class="text-muted mb-4">Delivery charges </p>
                    <div class="mt-auto">
                        <a href="<?= base_url('shop/' . $shop_id . '/delivery/fee') ?>"
                            class="btn btn-primary px-4 py-2">
                            Update Delivery Fee
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Custom Styles -->
<style>
    .card {
        border: none;
        border-radius: 15px;
        transition: transform 0.2s ease-in-out;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .btn-primary {
        background-color: #6c5ce7;
        border-color: #6c5ce7;
        border-radius: 8px;
        font-weight: 500;
    }

    .btn-primary:hover {
        background-color: #5a4fcf;
        border-color: #5a4fcf;
    }

    .card-title {
        font-weight: 600;
        color: #2d3436;
    }

    .text-muted {
        color: #636e72 !important;
    }

    .shadow-sm {
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important;
    }
</style>

<?= $this->endSection() ?>