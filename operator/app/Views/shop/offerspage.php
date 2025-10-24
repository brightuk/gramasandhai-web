<?php include(APPPATH . 'Views/templates/config.php'); ?>
<?= $this->extend('templates/layout') ?>
<?= $this->section('content') ?>

<!-- Flash Messages -->
<?php if (session()->getFlashdata('success')): ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="fa fa-check-circle me-2"></i>
    <?= session()->getFlashdata('success') ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <i class="fa fa-exclamation-circle me-2"></i>
    <?= session()->getFlashdata('error') ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif; ?>

<!-- Page Header -->
<div class="page-header mb-4">
    <div class="d-flex justify-content-between align-items-center">
   
        <div class="page-actions">
            <a href="<?= base_url('shop/' . $shop_id . '/addoffer') ?>" class="btn btn-primary btn-lg">
                <i class="fa fa-plus me-2"></i>Add New Offer
            </a>
        </div>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h4 class="mb-1"><?= count($offers ?? []) ?></h4>
                        <p class="mb-0">Total Offers</p>
                    </div>
                    <i class="fa fa-gift fa-2x opacity-75"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-success text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h4 class="mb-1">
                            <?php 
                            $activeOffers = 0;
                            if (!empty($offers)) {
                                foreach ($offers as $offer) {
                                    if ($offer['enable_status'] == 1 && strtotime($offer['endoffer']) > time()) {
                                        $activeOffers++;
                                    }
                                }
                            }
                            echo $activeOffers;
                            ?>
                        </h4>
                        <p class="mb-0">Active Offers</p>
                    </div>
                    <i class="fa fa-check-circle fa-2x opacity-75"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-warning text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h4 class="mb-1">
                            <?php 
                            $expiringSoon = 0;
                            if (!empty($offers)) {
                                $threeDaysFromNow = time() + (3 * 24 * 60 * 60);
                                foreach ($offers as $offer) {
                                    if ($offer['enable_status'] == 1 && 
                                        strtotime($offer['endoffer']) > time() && 
                                        strtotime($offer['endoffer']) <= $threeDaysFromNow) {
                                        $expiringSoon++;
                                    }
                                }
                            }
                            echo $expiringSoon;
                            ?>
                        </h4>
                        <p class="mb-0">Expiring Soon</p>
                    </div>
                    <i class="fa fa-clock-o fa-2x opacity-75"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-danger text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h4 class="mb-1">
                            <?php 
                            $expiredOffers = 0;
                            if (!empty($offers)) {
                                foreach ($offers as $offer) {
                                    if (strtotime($offer['endoffer']) < time()) {
                                        $expiredOffers++;
                                    }
                                }
                            }
                            echo $expiredOffers;
                            ?>
                        </h4>
                        <p class="mb-0">Expired</p>
                    </div>
                    <i class="fa fa-times-circle fa-2x opacity-75"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Filters -->
<div class="card mb-4">
    <div class="card-body">
        <div class="row">
            <div class="col-md-3">
                <label class="form-label">Filter by Status:</label>
                <select class="form-select" id="statusFilter">
                    <option value="">All Offers</option>
                    <option value="active">Active Only</option>
                    <option value="expired">Expired Only</option>
                    <option value="expiring">Expiring Soon</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">Search:</label>
                <input type="text" class="form-control" id="searchInput" placeholder="Search offers...">
            </div>
            <div class="col-md-3">
                <label class="form-label">Sort by:</label>
                <select class="form-select" id="sortFilter">
                    <option value="">Default</option>
                    <option value="name">Name</option>
                    <option value="price">Price</option>
                    <option value="discount">Discount</option>
                    <option value="enddate">End Date</option>
                </select>
            </div>
            <div class="col-md-3 d-flex align-items-end">
                <button class="btn btn-outline-secondary me-2" onclick="clearFilters()">
                    <i class="fa fa-refresh me-1"></i>Clear Filters
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Data Table -->
<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">
            <i class="fa fa-list me-2"></i>Offers List
        </h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="offersTable" class="table table-striped table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th style="width:50px;">#</th>
                        <th style="width:200px;">Offer Name</th>
                        <th style="width:100px;">Image</th>
                        <th style="width:100px;">Label</th>
                        <th style="width:100px;">Original Price</th>
                        <th style="width:100px;">Discounted Price</th>
                        <th style="width:80px;">Discount %</th>
                        <th style="width:150px;">Notes</th>
                        <th style="width:150px;">End Date</th>
                        <th style="width:100px;">Status</th>
                        <th style="width:120px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($offers)): ?>
                        <?php 
                        $sno = 1;
                        foreach ($offers as $row): 
                            // Calculate offer status
                            $now = time();
                            $endTime = strtotime($row['endoffer']);
                            $threeDaysFromNow = $now + (3 * 24 * 60 * 60);
                            
                            $statusClass = '';
                            $statusText = '';
                            $statusIcon = '';
                            
                            if ($endTime < $now) {
                                $statusClass = 'danger';
                                $statusText = 'Expired';
                                $statusIcon = 'fa-times-circle';
                            } elseif ($row['enable_status'] == 0) {
                                $statusClass = 'secondary';
                                $statusText = 'Disabled';
                                $statusIcon = 'fa-pause-circle';
                            } elseif ($endTime <= $threeDaysFromNow) {
                                $statusClass = 'warning';
                                $statusText = 'Expiring Soon';
                                $statusIcon = 'fa-clock-o';
                            } else {
                                $statusClass = 'success';
                                $statusText = 'Active';
                                $statusIcon = 'fa-check-circle';
                            }
                        ?>
                        <tr data-status="<?= strtolower($statusText) ?>" data-name="<?= strtolower($row['name']) ?>" 
                            data-price="<?= $row['org_price'] ?>" data-discount="<?= $row['offer_value'] ?>" 
                            data-enddate="<?= strtotime($row['endoffer']) ?>">
                            <td class="text-center fw-bold"><?= $sno++; ?></td>
                            <td>
                                <div class="fw-bold text-primary"><?= htmlspecialchars($row['name']); ?></div>
                                <?php if (!empty($row['label'])): ?>
                                    <small class="text-muted"><?= htmlspecialchars($row['label']); ?></small>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php if (!empty($row['image'])): ?>
                                    <img src="<?= $img_url . $row['image']; ?>" 
                                         alt="<?= htmlspecialchars($row['name']); ?>" 
                                         class="img-thumbnail offer-image" 
                                         style="height: 50px; width: 70px; object-fit: cover;"
                                         data-bs-toggle="modal" data-bs-target="#imageModal<?= $row['id'] ?>">
                                <?php else: ?>
                                    <div class="bg-light d-flex align-items-center justify-content-center" 
                                         style="height: 50px; width: 70px; border-radius: 4px;">
                                        <i class="fa fa-image text-muted"></i>
                                    </div>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if (!empty($row['label'])): ?>
                                    <span class="badge bg-info"><?= htmlspecialchars($row['label']); ?></span>
                                <?php else: ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-end">
                                <span class="fw-bold">₹<?= number_format($row['org_price'], 2); ?></span>
                            </td>
                            <td class="text-end">
                                <span class="fw-bold text-success">₹<?= number_format($row['disc_price'], 2); ?></span>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-primary"><?= $row['offer_value']; ?>%</span>
                            </td>
                            <td>
                                <?php if (!empty($row['offer_notes'])): ?>
                                    <span title="<?= htmlspecialchars($row['offer_notes']); ?>">
                                        <?= strlen($row['offer_notes']) > 30 ? 
                                            htmlspecialchars(substr($row['offer_notes'], 0, 30)) . '...' : 
                                            htmlspecialchars($row['offer_notes']); ?>
                                    </span>
                                <?php else: ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="small">
                                    <i class="fa fa-calendar text-primary me-1"></i>
                                    <?= date('M j, Y', strtotime($row['endoffer'])) ?>
                                    <br>
                                    <i class="fa fa-clock-o text-primary me-1"></i>
                                    <?= date('g:i A', strtotime($row['endoffer'])) ?>
                                </div>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-<?= $statusClass ?>">
                                    <i class="fa <?= $statusIcon ?> me-1"></i><?= $statusText ?>
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <?php if ($row['enable_status'] == 1): ?>
                                        <a href="<?= base_url('action/offer/disable/' . $row['id']) ?>" 
                                           class="btn btn-sm btn-warning" 
                                           title="Disable Offer"
                                           onclick="return confirm('Are you sure you want to disable this offer?')">
                                            <i class="fa fa-pause"></i>
                                        </a>
                                    <?php else: ?>
                                        <a href="<?= base_url('action/offer/enable/' . $row['id']) ?>" 
                                           class="btn btn-sm btn-success" 
                                           title="Enable Offer"
                                           onclick="return confirm('Are you sure you want to enable this offer?')">
                                            <i class="fa fa-play"></i>
                                        </a>
                                    <?php endif; ?>
                                    
                                    <a href="<?= base_url('shop/'.$shop_id.'/offer/edit/' . $row['id']) ?>" 
                                       class="btn btn-sm btn-primary" 
                                       title="Edit Offer">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    
                                    <a href="<?= base_url('offer/delete/' . $row['id']) ?>" 
                                       class="btn btn-sm btn-danger" 
                                       title="Delete Offer"
                                       onclick="return confirm('Are you sure you want to delete this offer? This action cannot be undone.')">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>

                        <!-- Image Modal -->
                        <?php if (!empty($row['image'])): ?>
                        <div class="modal fade" id="imageModal<?= $row['id'] ?>" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title"><?= htmlspecialchars($row['name']); ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <img src="<?= $img_url . $row['image']; ?>" 
                                             alt="<?= htmlspecialchars($row['name']); ?>" 
                                             class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                        
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="11" class="text-center py-5">
                                <div class="text-muted">
                                    <i class="fa fa-gift fa-3x mb-3"></i>
                                    <h5>No Offers Found</h5>
                                    <p>Start by creating your first offer to display here.</p>
                                    <a href="<?= base_url('shop/' . $shop_id . '/addoffer') ?>" class="btn btn-primary">
                                        <i class="fa fa-plus me-2"></i>Create First Offer
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Custom Styles -->
<style>
.offer-image {
    cursor: pointer;
    transition: transform 0.2s;
}
.offer-image:hover {
    transform: scale(1.1);
}

.badge {
    font-size: 0.75em;
}

.card {
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    border: 1px solid rgba(0, 0, 0, 0.125);
}

.page-header {
    border-bottom: 1px solid #dee2e6;
    padding-bottom: 1rem;
}

.table th {
    background-color: #87b3dfff;
    font-weight: 600;
    border-top: 1px solid #dee2e6;
}

.btn-group .btn {
    margin: 0 1px;
}

.alert {
    border: 0;
    border-radius: 0.5rem;
}

@media (max-width: 768px) {
    .page-header .d-flex {
        flex-direction: column;
        gap: 1rem;
    }
    
    .page-actions {
        align-self: stretch;
    }
    
    .btn-group {
        flex-direction: column;
    }
    
    .btn-group .btn {
        margin: 1px 0;
        border-radius: 0.25rem !important;
    }
}
</style>

<!-- JavaScript for Enhanced Functionality -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const table = document.getElementById('offersTable');
    const tbody = table.querySelector('tbody');
    const rows = Array.from(tbody.querySelectorAll('tr[data-status]'));
    
    // Search functionality
    document.getElementById('searchInput').addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        filterTable();
    });
    
    // Status filter
    document.getElementById('statusFilter').addEventListener('change', function() {
        filterTable();
    });
    
    // Sort functionality
    document.getElementById('sortFilter').addEventListener('change', function() {
        sortTable(this.value);
    });
    
    function filterTable() {
        const searchTerm = document.getElementById('searchInput').value.toLowerCase();
        const statusFilter = document.getElementById('statusFilter').value.toLowerCase();
        
        rows.forEach(row => {
            const name = row.dataset.name;
            const status = row.dataset.status;
            
            let showRow = true;
            
            // Search filter
            if (searchTerm && !name.includes(searchTerm)) {
                showRow = false;
            }
            
            // Status filter
            if (statusFilter) {
                if (statusFilter === 'active' && status !== 'active') {
                    showRow = false;
                } else if (statusFilter === 'expired' && status !== 'expired') {
                    showRow = false;
                } else if (statusFilter === 'expiring' && status !== 'expiring soon') {
                    showRow = false;
                }
            }
            
            row.style.display = showRow ? '' : 'none';
        });
        
        updateRowNumbers();
    }
    
    function sortTable(criteria) {
        if (!criteria) return;
        
        const sortedRows = rows.sort((a, b) => {
            switch (criteria) {
                case 'name':
                    return a.dataset.name.localeCompare(b.dataset.name);
                case 'price':
                    return parseFloat(a.dataset.price) - parseFloat(b.dataset.price);
                case 'discount':
                    return parseFloat(a.dataset.discount) - parseFloat(b.dataset.discount);
                case 'enddate':
                    return parseInt(a.dataset.enddate) - parseInt(b.dataset.enddate);
                default:
                    return 0;
            }
        });
        
        sortedRows.forEach(row => tbody.appendChild(row));
        updateRowNumbers();
    }
    
    function updateRowNumbers() {
        const visibleRows = rows.filter(row => row.style.display !== 'none');
        visibleRows.forEach((row, index) => {
            const numberCell = row.querySelector('td:first-child');
            numberCell.textContent = index + 1;
        });
    }
    
    window.clearFilters = function() {
        document.getElementById('searchInput').value = '';
        document.getElementById('statusFilter').value = '';
        document.getElementById('sortFilter').value = '';
        
        rows.forEach(row => {
            row.style.display = '';
        });
        
        updateRowNumbers();
    };
    
    // Auto-hide alerts after 5 seconds
    const alerts = document.querySelectorAll('.alert:not(.alert-permanent)');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.classList.add('fade');
            setTimeout(() => alert.remove(), 150);
        }, 5000);
    });
});
</script>

<?= $this->endSection() ?>