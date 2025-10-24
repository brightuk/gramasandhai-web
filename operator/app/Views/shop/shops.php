<?php include(APPPATH . 'Views/templates/config.php'); ?>
<?= $this->extend('templates/layout') ?>
<?= $this->section('content') ?>
<title>Shop List</title>

<!-- Flash Messages -->
<?php if (session()->getFlashdata('success')): ?>
    <div class="flash-popup success">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="flash-popup error">
        <?= session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>

<div class="col-md-12">
    <div class="card">
        <!-- <div class="card-header">
            <div class="d-flex align-items-center justify-content-between">
                <h4 class="card-title">Shops Management</h4>
                <a href="<?= base_url() ?>shop/add" class="btn btn-primary btn-round">
                    <i class="fa fa-plus"></i> Add New Shop
                </a>
            </div>
        </div> -->
        <div class="card-body">
            <!-- Search and Filter Section -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Search Shops</label>
                        <input type="text" id="shopSearch" class="form-control"
                            placeholder="Search by shop name, owner, phone...">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Filter by Category</label>
                        <select id="categoryFilter" class="form-control">
                            <option value="">All Categories</option>
                            <?php if (isset($categories)): ?>
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?= $category['id'] ?>"><?= $category['category_name'] ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Filter by Status</label>
                        <select id="statusFilter" class="form-control">
                            <option value="">All Status</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>&nbsp;</label>
                        <button type="button" id="clearFilters" class="btn btn-secondary form-control">
                            <i class="fa fa-refresh"></i> Clear
                        </button>
                    </div>
                </div>
            </div>

            <!-- Cards Section -->
            <div class="row" id="shopCardsContainer">
                <?php if (isset($shoplist) && !empty($shoplist)): ?>
                    <?php foreach ($shoplist as $key => $shop): ?>
                        <div class="col-lg-4 col-md-6 col-sm-12 mb-4 shop-card" data-category="<?= $shop['category_id'] ?>"
                            data-status="<?= $shop['status'] ?>"
                            data-search="<?= strtolower($shop['shop_name'] . ' ' . $shop['owner_name'] . ' ' . $shop['shop_phone']) ?>">
                            <div class="card shadow-sm h-100">
                                <!-- Card Header with Logo -->
                                <div class="card-header bg-white text-center position-relative">
                                    <!-- Status Badge -->
                                    <div class="position-absolute" style="top: 10px; right: 10px;">
                                        <?php if ($shop['status'] == '1'): ?>
                                            <span class="badge badge-success">Active</span>
                                        <?php else: ?>
                                            <span class="badge badge-danger">Inactive</span>
                                        <?php endif; ?>
                                    </div>

                                    <!-- Shop Logo -->
                                    <div class="mb-2">
                                        <?php if (!empty($shop['shop_logo'])): ?>
                                            <img src="<?= $img_url . $shop['shop_logo'] ?>" alt="<?= esc($shop['shop_name']) ?>"
                                                style="width:80px; height:80px; object-fit: cover; border-radius: 50%; border: 3px solid #f8f9fa;"
                                                onerror="this.src='<?= base_url() ?>assets/img/default-shop.png'">
                                        <?php else: ?>
                                            <div
                                                style="width:80px; height:80px; background-color: #f8f9fa; display: flex; align-items: center; justify-content: center; border-radius: 50%; margin: 0 auto; border: 3px solid #e9ecef;">
                                                <i class="fa fa-store" style="color: #6c757d; font-size: 24px;"></i>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <!-- Shop Name -->
                                    <h5 class="card-title mb-1"><?= esc($shop['shop_name']) ?></h5>
                                    <small class="text-muted">ID: <?= esc($shop['shop_id']) ?></small>
                                </div>

                                <!-- Card Body -->
                                <div class="card-body">
                                    <!-- Owner Information -->
                                    <!-- <div class="row mb-2">
                                    <div class="col-12">
                                        <i class="fa fa-user text-primary"></i>
                                        <strong>Owner:</strong> <= esc($shop['owner_name']) ?>
                                    </div>
                                </div> -->

                                    <!-- Contact Information -->
                                    <!-- <div class="row mb-2">
                                    <div class="col-12">
                                        <i class="fa fa-phone text-success"></i>
                                        <strong>Phone:</strong> <= esc($shop['shop_phone']) ?>
                                    </div>
                                </div> -->

                                    <!-- Email -->
                                    <!-- <div class="row mb-2">
                                    <div class="col-12">
                                        <i class="fa fa-envelope text-info"></i>
                                        <strong>Email:</strong> 
                                        <small><= esc($shop['email']) ?></small>
                                    </div>
                                </div> -->

                                    <!-- Address -->
                                    <!-- <div class="row mb-2">
                                    <div class="col-12">
                                        <i class="fa fa-map-marker text-danger"></i>
                                        <strong>Address:</strong> 
                                        <small><= esc($shop['shop_address']) ?>, <= esc($shop['pincode']) ?></small>
                                    </div>
                                </div> -->

                                    <!-- Category and Discount -->
                                    <!-- <div class="row mb-3">
                                    <div class="col-6">
                                        <php if (isset($shop['category_name'])): ?>
                                            <span class="badge badge-info"><= esc($shop['category_name']) ?></span>
                                        <php else: ?>
                                            <span class="badge badge-secondary">Uncategorized</span>
                                        <php endif; ?>
                                    </div>
                                    <div class="col-6 text-right">
                                        <php if (!empty($shop['discount'])): ?>
                                            <span class="badge badge-warning"><= esc($shop['discount']) ?>% OFF</span>
                                        <php endif; ?>
                                    </div>
                                </div> -->

                                    <!-- Shop URL -->
                                    <div class="row mb-3">
                                        <div class="col-6">
                                            <a href="<?= base_url().'shop/'.$shop['shop_id'] ?>"
                                                class="btn btn-sm btn-success btn-block">
                                                <i class="fa fa-external-link"></i> Shop 
                                            </a>
                                        </div>
                                        <?php if (!empty($shop['url_name'])): ?>
                                            <div class="col-4">
                                                <a href="<?= esc($b_url.$shop['url_name']) ?>" target="_blank"
                                                    class="btn btn-sm btn-outline-primary btn-block">
                                                    <i class="fa fa-external-link"></i> Visit Shop
                                                </a>
                                            </div>
                                        <?php endif; ?>

                                    </div>


                                    <!-- Card Footer with Actions -->
                                    <!-- <div class="card-footer bg-white">
                                <div class="row">
                                     <div class="col-3">
                                        <a href="<?= base_url() ?>shop/view/<?= $shop['id'] ?>" 
                                           class="btn btn-info btn-sm btn-block" 
                                           title="View Details">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </div>
                                    <div class="col-3">
                                        <a href="<?= base_url() ?>shop/edit/<?= $shop['id'] ?>" 
                                           class="btn btn-warning btn-sm btn-block" 
                                           title="Edit Shop">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </div>
                                    <div class="col-3">
                                        <a href="<?= base_url() ?>shop/qr/<?= $shop['id'] ?>" 
                                           class="btn btn-success btn-sm btn-block" 
                                           title="Download QR">
                                            <i class="fa fa-qrcode"></i>
                                        </a>
                                    </div>
                                    <div class="col-3">
                                        <a href="<?= base_url() ?>shop/delete/<?= $shop['id'] ?>" 
                                           class="btn btn-danger btn-sm btn-block" 
                                           title="Delete Shop"
                                           onclick="return confirm('Are you sure you want to delete this shop?')">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </div> 
                                </div> -->
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12">
                        <div class="text-center py-5">
                            <i class="fa fa-store" style="font-size: 64px; color: #dee2e6;"></i>
                            <h4 class="mt-3 text-muted">No Shops Found</h4>
                            <p class="text-muted">Start by adding your first shop.</p>
                            <a href="<?= base_url() ?>shop/add" class="btn btn-primary">
                                <i class="fa fa-plus"></i> Add New Shop
                            </a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <!-- No Results Message (Hidden by default) -->
            <div id="noResults" class="text-center py-5" style="display: none;">
                <i class="fa fa-search" style="font-size: 64px; color: #dee2e6;"></i>
                <h4 class="mt-3 text-muted">No Shops Match Your Search</h4>
                <p class="text-muted">Try adjusting your search criteria or filters.</p>
            </div>
        </div>
    </div>
</div>

<style>
    .shop-card {
        transition: all 0.3s ease;
    }

    .shop-card:hover {
        transform: translateY(-5px);
    }

    .card {
        border: 1px solid #e3e6f0;
        transition: box-shadow 0.3s ease;
    }

    .card:hover {
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    }

    .badge {
        font-size: 0.75em;
    }



</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const shopSearch = document.getElementById('shopSearch');
        const categoryFilter = document.getElementById('categoryFilter');
        const statusFilter = document.getElementById('statusFilter');
        const clearFilters = document.getElementById('clearFilters');
        const shopCards = document.querySelectorAll('.shop-card');
        const noResults = document.getElementById('noResults');

        function filterShops() {
            const searchTerm = shopSearch.value.toLowerCase();
            const selectedCategory = categoryFilter.value;
            const selectedStatus = statusFilter.value;
            let visibleCount = 0;

            shopCards.forEach(card => {
                const searchData = card.getAttribute('data-search');
                const cardCategory = card.getAttribute('data-category');
                const cardStatus = card.getAttribute('data-status');

                const matchesSearch = searchData.includes(searchTerm);
                const matchesCategory = !selectedCategory || cardCategory === selectedCategory;
                const matchesStatus = !selectedStatus || cardStatus === selectedStatus;

                if (matchesSearch && matchesCategory && matchesStatus) {
                    card.style.display = 'block';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            // Show/hide no results message
            noResults.style.display = visibleCount === 0 ? 'block' : 'none';
        }

        // Event listeners
        shopSearch.addEventListener('input', filterShops);
        categoryFilter.addEventListener('change', filterShops);
        statusFilter.addEventListener('change', filterShops);

        clearFilters.addEventListener('click', function () {
            shopSearch.value = '';
            categoryFilter.value = '';
            statusFilter.value = '';
            filterShops();
        });

        // Auto-hide flash messages
        const flashPopups = document.querySelectorAll('.flash-popup');
        flashPopups.forEach(popup => {
            setTimeout(() => {
                popup.style.animation = 'slideOut 0.5s ease forwards';
                setTimeout(() => popup.remove(), 500);
            }, 5000);
        });
    });
</script>

<style>
    @keyframes slideOut {
        from {
            transform: translateX(0);
        }

        to {
            transform: translateX(100%);
        }
    }
</style>

<?= $this->endSection() ?>