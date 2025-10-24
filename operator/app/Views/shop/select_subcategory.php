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
                        Select Subcategories
                    </h4>
                </div>
                <div class="card-body p-3">
                    <?php if (session()->getFlashdata('success')): ?>
                    <div class="flash-popup alert alert-success">
                        <?= session()->getFlashdata('success') ?>
                    </div>
                    <?php endif; ?>

                    <form action="<?= base_url('shop/'.$shop_id.'/subcategories') ?>" method="POST">

                        <div class="row mb-2">
                            <div class="col-12">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-muted small">
                                        Select subcategories for Shop ID: <strong><?= $shop_id ?? '757137' ?></strong>
                                    </span>
                                    <div>
                                        <button type="button" class="btn btn-outline-secondary btn-sm me-1"
                                            onclick="selectAll()">
                                            <i class="fas fa-check-double me-1"></i>Select All
                                        </button>
                                        <button type="button" class="btn btn-outline-secondary btn-sm me-1"
                                            onclick="deselectAll()">
                                            <i class="fas fa-times me-1"></i>Deselect All
                                        </button>
                                        <button type="button" class="btn btn-outline-info btn-sm"
                                            onclick="groupByCategory()">
                                            <i class="fas fa-layer-group me-1"></i>Group by Category
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php 
                        // Get selected category IDs from sel_categories
                        $selectedCategoryIds = array_column($sel_categories, 'category_id');
                        
                        // Filter subcategories to only show those belonging to selected categories
                        $filteredSubcategories = [];
                        foreach ($subcategories as $subcategory) {
                            if (in_array($subcategory['category_id'], $selectedCategoryIds)) {
                                $filteredSubcategories[] = $subcategory;
                            }
                        }
                        
                        // If no subcategories match selected categories, show a message
                        if (empty($filteredSubcategories)): ?>
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle me-2"></i>
                                No subcategories available for the selected categories.
                            </div>
                        <?php else: ?>

                        <!-- Filter by Category -->
                        <div class="row mb-2">
                            <div class="col-md-4">
                                <select class="form-select form-select-sm" id="categoryFilter"
                                    onchange="filterByCategory()">
                                    <option value="">All Categories</option>
                                    <?php 
                                    // Get unique categories from filtered subcategories
                                    $uniqueCategories = [];
                                    foreach ($filteredSubcategories as $subcategory) {
                                        if (!in_array($subcategory['main_category'], $uniqueCategories)) {
                                            $uniqueCategories[] = $subcategory['main_category'];
                                        }
                                    }
                                    foreach ($uniqueCategories as $category): ?>
                                    <option value="<?= $category ?>"><?= $category ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-8">
                                <div class="text-muted small">
                                    <span id="filteredCount"><?= count($filteredSubcategories) ?></span> subcategories shown
                                    <span class="text-info">(filtered from selected categories)</span>
                                </div>
                            </div>
                        </div>

                        <!-- Hidden inputs for selected category IDs -->
                        <?php foreach ($selectedCategoryIds as $categoryId): ?>
                            <input type="hidden" name="selected_categories[]" value="<?= $categoryId ?>">
                        <?php endforeach; ?>

                        <div class="row" id="subcategoriesContainer">
                            <?php 
                            // Create array of selected subcategory IDs for easy lookup
                            $selectedSubcategoryIds = array_column($sel_subcategories, 'subcategory_id');
                            
                            foreach ($filteredSubcategories as $subcategory): 
                                $isSelected = in_array($subcategory['id'], $selectedSubcategoryIds);
                            ?>
                            <div class="col-lg-4 col-md-6 col-sm-12 mb-2 subcategory-item"
                                data-category="<?= $subcategory['main_category'] ?>">
                                <div class="card subcategory-card <?= $isSelected ? 'selected' : '' ?>"
                                    data-subcategory-id="<?= $subcategory['id'] ?>"
                                    data-category-id="<?= $subcategory['category_id'] ?>" onclick="toggleSubcategory(this)">
                                    <div class="card-body p-2">
                                        <div class="form-check mb-0">
                                            <input class="form-check-input subcategory-checkbox" type="checkbox"
                                                name="subcategories[]" value="<?= $subcategory['id'] ?>"
                                                id="subcategory_<?= $subcategory['id'] ?>"
                                                <?= $isSelected ? 'checked' : '' ?>>
                                                
                                            <label class="form-check-label w-100 user-select-none"
                                                for="subcategory_<?= $subcategory['id'] ?>">
                                                <div class="d-flex align-items-center">
                                                    <div class="subcategory-image me-2">
                                                        <?php if (!empty($subcategory['sub_category_image'])): ?>
                                                            <img src="<?= $img_url . $subcategory['sub_category_image'] ?>"
                                                                alt="<?= $subcategory['sub_category_name'] ?>"
                                                                class="rounded"
                                                                style="width: 40px; height: 40px; object-fit: cover;">
                                                        <?php else: ?>
                                                            <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                                                style="width: 40px; height: 40px;">
                                                                <i class="fas fa-image text-muted"></i>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="subcategory-info flex-grow-1">
                                                        <div class="d-flex justify-content-between align-items-start">
                                                            <div class="flex-grow-1">
                                                                <h6 class="mb-0 fw-bold text-truncate"
                                                                    style="font-size: 0.9rem;">
                                                                    <?= $subcategory['sub_category_name'] ?>
                                                                </h6>
                                                                <small class="text-muted d-block text-truncate"
                                                                    style="font-size: 0.75rem;">
                                                                    <?= $subcategory['sub_category_subtitle'] ?>
                                                                </small>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="mt-1 d-flex justify-content-between align-items-center">
                                                            <small class="text-primary fw-medium"
                                                                style="font-size: 0.7rem;">
                                                                <?= $subcategory['main_category'] ?>
                                                            </small>
                                                            <span
                                                                class="badge bg-<?= $subcategory['status'] == 1 ? 'success' : 'danger' ?>"
                                                                style="font-size: 0.65rem;">
                                                                <?= $subcategory['status'] == 1 ? 'Active' : 'Inactive' ?>
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
                                            Selected: <span id="selectedCount"><?= count($selectedSubcategoryIds) ?></span> /
                                            <span id="totalCount"><?= count($filteredSubcategories) ?></span>
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

                        <?php endif; ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.subcategory-card {
    transition: all 0.2s ease;
    cursor: pointer;
    border: 2px solid #dee2e6;
    user-select: none;
}

.subcategory-card:hover {
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
    transform: translateY(-1px);
    border-color: #007bff;
}

.subcategory-card.selected {
    border-color: #198754 !important;
    background-color: rgba(25, 135, 84, 0.05);
    box-shadow: 0 0 0 0.1rem rgba(25, 135, 84, 0.25);
}

.form-check-input:checked {
    background-color: #198754;
    border-color: #198754;
}

.subcategory-image img {
    transition: transform 0.2s ease;
}

.subcategory-card:hover .subcategory-image img {
    transform: scale(1.05);
}

.user-select-none {
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}

.subcategory-item.hidden {
    display: none !important;
}

/* Group by category styling */
.category-group {
    border-left: 3px solid #007bff;
    padding-left: 15px;
    margin-bottom: 20px;
}

.category-group-title {
    background-color: #f8f9fa;
    padding: 10px 15px;
    margin: -15px -15px 15px -15px;
    border-radius: 5px;
    font-weight: bold;
    color: #495057;
}

@media (max-width: 768px) {
    .subcategory-card {
        margin-bottom: 0.5rem;
    }

    .subcategory-image img {
        width: 35px;
        height: 35px;
    }
}
</style>

<script>
let isGrouped = false;

// Toggle subcategory selection when card is clicked
function toggleSubcategory(card) {
    const checkbox = card.querySelector('.subcategory-checkbox');

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

// Select all visible subcategories
function selectAll() {
    const visibleCards = document.querySelectorAll('.subcategory-item:not(.hidden) .subcategory-card');
    visibleCards.forEach(card => {
        const checkbox = card.querySelector('.subcategory-checkbox');
        checkbox.checked = true;
        updateCardStyle(card, true);
    });
    updateSelectedCount();
}

// Deselect all visible subcategories
function deselectAll() {
    const visibleCards = document.querySelectorAll('.subcategory-item:not(.hidden) .subcategory-card');
    visibleCards.forEach(card => {
        const checkbox = card.querySelector('.subcategory-checkbox');
        checkbox.checked = false;
        updateCardStyle(card, false);
    });
    updateSelectedCount();
}

// Filter subcategories by category
function filterByCategory() {
    const selectedCategory = document.getElementById('categoryFilter').value;
    const subcategoryItems = document.querySelectorAll('.subcategory-item');
    let visibleCount = 0;

    subcategoryItems.forEach(item => {
        const itemCategory = item.getAttribute('data-category');
        if (selectedCategory === '' || itemCategory === selectedCategory) {
            item.classList.remove('hidden');
            visibleCount++;
        } else {
            item.classList.add('hidden');
        }
    });

    document.getElementById('filteredCount').textContent = visibleCount;
    updateSelectedCount();
}

// Group subcategories by category
function groupByCategory() {
    const container = document.getElementById('subcategoriesContainer');
    const items = Array.from(document.querySelectorAll('.subcategory-item'));

    if (isGrouped) {
        // Ungroup - restore original order
        container.innerHTML = '';
        items.sort((a, b) => {
            const aId = parseInt(a.querySelector('[data-subcategory-id]').getAttribute('data-subcategory-id'));
            const bId = parseInt(b.querySelector('[data-subcategory-id]').getAttribute('data-subcategory-id'));
            return aId - bId;
        });
        items.forEach(item => container.appendChild(item));
        isGrouped = false;
        document.querySelector('[onclick="groupByCategory()"]').innerHTML =
            '<i class="fas fa-layer-group me-1"></i>Group by Category';
    } else {
        // Group by category
        const groupedItems = {};
        items.forEach(item => {
            const category = item.getAttribute('data-category');
            if (!groupedItems[category]) {
                groupedItems[category] = [];
            }
            groupedItems[category].push(item);
        });

        container.innerHTML = '';
        Object.keys(groupedItems).sort().forEach(category => {
            // Create category group
            const groupDiv = document.createElement('div');
            groupDiv.className = 'col-12 category-group';
            groupDiv.innerHTML = `<div class="category-group-title">${category}</div><div class="row"></div>`;

            const rowDiv = groupDiv.querySelector('.row');
            groupedItems[category].forEach(item => {
                // Reset column classes for grouped view
                item.className = 'col-lg-4 col-md-6 col-sm-12 mb-2 subcategory-item';
                rowDiv.appendChild(item);
            });

            container.appendChild(groupDiv);
        });

        isGrouped = true;
        document.querySelector('[onclick="groupByCategory()"]').innerHTML = '<i class="fas fa-list me-1"></i>Ungroup';
    }

    // Re-apply current filter
    filterByCategory();
}

// Update selected count display
function updateSelectedCount() {
    const selectedCount = document.querySelectorAll('.subcategory-checkbox:checked').length;
    const visibleCount = document.querySelectorAll('.subcategory-item:not(.hidden)').length;
    document.getElementById('selectedCount').textContent = selectedCount;
    document.getElementById('totalCount').textContent = visibleCount;
}

// Initialize card states on page load
document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.subcategory-card');
    cards.forEach(card => {
        const checkbox = card.querySelector('.subcategory-checkbox');
        updateCardStyle(card, checkbox.checked);
    });

    // Prevent text selection on rapid clicking
    cards.forEach(card => {
        card.addEventListener('selectstart', function(e) {
            e.preventDefault();
        });
    });

    updateSelectedCount();
});


</script>

<?= $this->endSection() ?>