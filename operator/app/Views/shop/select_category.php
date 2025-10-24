<?php include(APPPATH . 'Views/templates/config.php'); ?>
<?= $this->extend('templates/layout') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-list-check me-2"></i>
                        Select Categories
                    </h4>
                </div>
                <div class="card-body p-3">
                    <?php if (session()->getFlashdata('success')): ?>
                    <div class="flash-popup alert alert-success">
                        <?= session()->getFlashdata('success') ?>
                    </div>
                    <?php endif; ?>

                    <form action="<?= base_url('shop/'.$shop_id.'/categories') ?>" method="POST">
                        <?= csrf_field() ?>

                        <div class="row mb-2">
                            <div class="col-12">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-muted small">
                                        <!-- Select categories for Shop ID: <strong><?= $shop_id ?? '757137' ?></strong> -->
                                    </span>
                                    <div>
                                        <button type="button" class="btn btn-outline-secondary btn-sm me-1"
                                            onclick="selectAll()">
                                            <i class="fas fa-check-double me-1"></i>Select All
                                        </button>
                                        <button type="button" class="btn btn-outline-secondary btn-sm"
                                            onclick="deselectAll()">
                                            <i class="fas fa-times me-1"></i>Deselect All
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <?php 
                            // Create array of selected category IDs for easy lookup
                            $selectedIds = array_column($sel_categories, 'category_id');
                            
                            foreach ($categories as $category): 
                                $isSelected = in_array($category['category_id'], $selectedIds);
                            ?>
                            <div class="col-lg-4 col-md-6 col-sm-12 mb-2">
                                <div class="card category-card <?= $isSelected ? 'selected' : '' ?>"
                                    data-category-id="<?= $category['category_id'] ?>" onclick="toggleCategory(this)">
                                    <div class="card-body p-2">
                                        <div class="form-check mb-0">
                                            <input class="form-check-input category-checkbox" type="checkbox"
                                                name="categories[]" value="<?= $category['category_id'] ?>"
                                                id="category_<?= $category['category_id'] ?>"
                                                <?= $isSelected ? 'checked' : '' ?>>
                                            <label class="form-check-label w-100 user-select-none"
                                                for="category_<?= $category['category_id'] ?>">
                                                <div class="d-flex align-items-center">
                                                    <div class="category-image me-2">
                                                        <img src="<?= $img_url. $category['category_image'] ?>"
                                                            alt="<?= $category['category_name'] ?>" class="rounded"
                                                            style="width: 40px; height: 40px; object-fit: cover;">
                                                    </div>
                                                    <div class="category-info flex-grow-1">
                                                        <h6 class="mb-0 fw-bold text-truncate"
                                                            style="font-size: 0.9rem;"><?= $category['category_name'] ?>
                                                        </h6>
                                                        <small class="text-muted d-block text-truncate"
                                                            style="font-size: 0.75rem;"><?= $category['category_subtitle'] ?></small>
                                                        <div class="mt-1">
                                                            <span
                                                                class="badge bg-<?= $category['status'] == 1 ? 'success' : 'danger' ?>"
                                                                style="font-size: 0.65rem;">
                                                                <?= $category['status'] == 1 ? 'Active' : 'Inactive' ?>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <span class="text-muted small">
                                            Selected: <span id="selectedCount"><?= count($selectedIds) ?></span> /
                                            <?= count($categories) ?>
                                        </span>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-secondary btn-sm me-2"
                                            onclick="window.history.back()">
                                            <i class="fas fa-arrow-left me-1"></i>Back
                                        </button>
                                        <button type="submit" class="btn btn-success btn-sm">
                                            <i class="fas fa-save me-1"></i>Save Selection
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.category-card {
    transition: all 0.2s ease;
    cursor: pointer;
    border: 2px solid #dee2e6;
    user-select: none;
}

.category-card:hover {
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
    transform: translateY(-1px);
    border-color: #007bff;
}

.category-card.selected {
    border-color: #198754 !important;
    background-color: rgba(25, 135, 84, 0.05);
    box-shadow: 0 0 0 0.1rem rgba(25, 135, 84, 0.25);
}

.form-check-input:checked {
    background-color: #198754;
    border-color: #198754;
}

.category-image img {
    transition: transform 0.2s ease;
}

.category-card:hover .category-image img {
    transform: scale(1.05);
}

.user-select-none {
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}

/* Compact spacing */
.card-body {
    padding: 0.75rem !important;
}

@media (max-width: 768px) {
    .category-card {
        margin-bottom: 0.5rem;
    }

    .category-image img {
        width: 35px;
        height: 35px;
    }
}
</style>

<script>
// Toggle category selection when card is clicked
function toggleCategory(card) {
    const checkbox = card.querySelector('.category-checkbox');

    // Prevent double-toggling when clicking directly on checkbox
    if (event.target.type === 'checkbox') {
        updateCardStyle(card, event.target.checked);
        updateSelectedCount();
        return;
    }

    // Toggle checkbox state
    checkbox.checked = !checkbox.checked;
    updateCardStyle(card, checkbox.checked);
    updateSelectedCount();
}

// Update card visual style based on selection state
function updateCardStyle(card, isSelected) {
    if (isSelected) {
        card.classList.add('selected');
    } else {
        card.classList.remove('selected');
    }
}

// Select all categories
function selectAll() {
    const cards = document.querySelectorAll('.category-card');
    cards.forEach(card => {
        const checkbox = card.querySelector('.category-checkbox');
        checkbox.checked = true;
        updateCardStyle(card, true);
    });
    updateSelectedCount();
}

// Deselect all categories
function deselectAll() {
    const cards = document.querySelectorAll('.category-card');
    cards.forEach(card => {
        const checkbox = card.querySelector('.category-checkbox');
        checkbox.checked = false;
        updateCardStyle(card, false);
    });
    updateSelectedCount();
}

// Update selected count display
function updateSelectedCount() {
    const selectedCount = document.querySelectorAll('.category-checkbox:checked').length;
    document.getElementById('selectedCount').textContent = selectedCount;
}

// Initialize card states on page load
document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.category-card');
    cards.forEach(card => {
        const checkbox = card.querySelector('.category-checkbox');
        updateCardStyle(card, checkbox.checked);
    });

    // Prevent text selection on rapid clicking
    cards.forEach(card => {
        card.addEventListener('selectstart', function(e) {
            e.preventDefault();
        });
    });
});
</script>

<?= $this->endSection() ?>