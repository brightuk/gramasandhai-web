<?php include(APPPATH . 'Views/templates/config.php'); ?>

<?= $this->extend('templates/layout') ?>
<?= $this->section('content') ?>
<style>
    .holder {
        max-width: 600px;
        margin-top: 100px !important;
        margin: 20px auto;
        padding: 30px;
        background-color: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        display: none;
    }

    h2, h3 {
        color: #2c3e50;
        margin-bottom: 25px;
        text-align: center;
        font-weight: 600;
    }

    label {
        display: block;
        margin: 15px 0 8px;
        color: #34495e;
        font-weight: 500;
    }

    select, input[type="file"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
        margin-bottom: 5px;
        box-sizing: border-box;
    }

    select:focus {
        outline: none;
        border-color: #3498db;
        box-shadow: 0 0 0 2px rgba(52, 152, 219, 0.2);
    }

    .file-upload {
        width: 100%;
        margin-bottom: 20px;
    }

    .file-upload-area {
        border: 2px dashed #3498db;
        border-radius: 6px;
        padding: 30px;
        text-align: center;
        transition: all 0.3s;
        margin-bottom: 10px;
        background-color: #f8fafc;
        cursor: pointer;
    }

    .file-upload-area:hover {
        background-color: #f0f7fd;
        border-color: #2980b9;
    }

    .file-upload-area.active {
        background-color: #e3f2fd;
        border-color: #1a73e8;
    }

    .file-upload-area i {
        font-size: 48px;
        color: #3498db;
        margin-bottom: 15px;
    }

    .file-upload-area p {
        margin: 0;
        color: #555;
    }

    .file-upload-area p.small {
        font-size: 12px;
        color: #888;
        margin-top: 10px;
    }

    .file-name {
        margin-top: 10px;
        font-size: 14px;
        color: #2c3e50;
        font-weight: 500;
    }

    button {
        background-color: #3498db;
        color: white;
        border: none;
        padding: 12px 20px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
        width: 100%;
        margin-top: 15px;
        transition: background-color 0.3s;
    }

    button:hover {
        background-color: #2980b9;
    }

    .flash-message {
        padding: 10px;
        border-radius: 4px;
        text-align: center;
        margin-bottom: 20px;
    }

    .flash-success {
        background-color: #e8f5e9;
        border: 1px solid #a5d6a7;
        color: green;
    }

    .flash-error {
        background-color: #ffebee;
        border: 1px solid #ef9a9a;
        color: red;
    }

    .download-section {
        margin-top: 10px !important;
        max-width: 600px;
        margin: 20px auto;
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        text-align: center;
        transition: all 0.3s ease;
    }

    .download-btn {
        display: inline-block;
        background-color: #2ecc71;
        color: white;
        padding: 10px 15px;
        margin: 10px 5px;
        border-radius: 4px;
        text-decoration: none;
        transition: background-color 0.3s;
    }

    .download-btn:hover {
        background-color: #27ae60;
    }

    .show-form-btn {
        display: block;
        max-width: 600px;
        margin: 20px auto;
        background-color: #3498db;
        color: white;
        border: none;
        padding: 12px 20px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
        font-weight: bold;
        transition: background-color 0.3s;
    }

    .show-form-btn:hover {
        background-color: #2980b9;
    }

    .close-btn {
        position: relative;
        top: 20px;
        left: 500px;
        background-color: rgb(252, 250, 249);
        color: #c0392b;
        font-size: 24px;
        cursor: pointer;
        padding: 0 12px 8px 12px;
        line-height: 1;
        transition: background-color 0.5s, color 0.5s;
    }

    .close-btn:hover {
        background: #c0392b;
        color: rgb(252, 250, 249);
    }

    /* Filter and Search Styles */
    .filter-controls {
        max-width: 1200px;
        margin: 20px auto;
        padding: 20px;
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        margin-bottom: 30px;
    }

    .filter-row {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        gap: 20px;
        margin-bottom: 15px;
    }

    .filter-group {
        display: flex;
        flex-direction: column;
    }

    .filter-group label {
        margin-bottom: 5px;
        font-weight: 500;
        color: #2c3e50;
    }

    .search-input, .filter-select {
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
        transition: border-color 0.3s;
    }

    .search-input:focus, .filter-select:focus {
        outline: none;
        border-color: #3498db;
        box-shadow: 0 0 0 2px rgba(52, 152, 219, 0.2);
    }

    .clear-filters-btn {
        background-color: #95a5a6;
        color: white;
        border: none;
        padding: 10px 15px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 14px;
        transition: background-color 0.3s;
        align-self: end;
        width: fit-content;
    }

    .clear-filters-btn:hover {
        background-color: #7f8c8d;
    }

    .results-summary {
        text-align: center;
        margin-bottom: 20px;
        color: #6c757d;
        font-style: italic;
    }

    /* Category and Subcategory Styles */
    .category-item, .subcategory-item {
        background: white;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 15px;
        transition: all 0.3s ease;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .category-item:hover, .subcategory-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        border-color: #3498db;
    }

    .category-info, .subcategory-info {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .category-name, .subcategory-name {
        font-size: 18px;
        font-weight: 600;
        margin: 0;
        color: #2c3e50;
    }

    .category-id, .subcategory-id {
        background-color: #e3f2fd;
        color: #1565c0;
        padding: 4px 12px;
        border-radius: 12px;
        font-size: 12px;
        font-weight: 500;
    }

    .parent-info {
        font-size: 12px;
        color: #6c757d;
        margin-top: 8px;
        font-style: italic;
    }

    .no-results {
        text-align: center;
        color: #6c757d;
        font-style: italic;
        padding: 40px;
        background-color: #f8f9fa;
        border-radius: 8px;
        margin: 20px 0;
    }

    .categories-section {
        max-width: 1200px;
        margin: 0 auto 40px;
        padding: 0 20px;
    }

    .categories-section h3 {
        text-align: left;
        border-bottom: 2px solid #3498db;
        padding-bottom: 10px;
        margin-bottom: 25px;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .filter-row {
            grid-template-columns: 1fr;
            gap: 15px;
        }
        
        .close-btn {
            left: calc(100% - 50px);
        }
        
        .filter-controls {
            margin: 10px;
            padding: 15px;
        }
        
        .categories-section {
            padding: 0 10px;
        }
    }
</style>

<?php if (session()->getFlashdata('success')): ?>
    <div class="flash-message flash-success"><?= session()->getFlashdata('success') ?></div>
<?php elseif (session()->getFlashdata('error')): ?>
    <div class="flash-message flash-error"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>

<!-- Download Section -->
<div class="download-section" id="downloadSection">
    <h3>Download Template Files:</h3>
    <a href="<?= $site_url.'public/file/Products_template.xlsx' ?>" class="download-btn text-white"
        download="products_template.xlsx">
        Products Template
    </a>
    <a href="<?= $site_url.'public/file/Product_variants_template.xlsx' ?>" class="download-btn text-white"
        download="Products_Variant_template.xlsx">
        Products Variant Template
    </a>
</div>

<button class="show-form-btn" id="showFormBtn">Show Upload Form</button>

<!-- Upload Form -->
<div class="holder" id="uploadForm">
    <span class="close-btn rounded-circle" id="btn-close">&times;</span>
    <h2>Upload Excel or CSV File</h2>
    <form action="<?= base_url('shop/'.$shop_id.'/bulk-upload') ?>" method="post" enctype="multipart/form-data">
        <input type="text" name="table_name" value="products" hidden>
        
        <div class="file-upload">
            <label>Main Excel File:</label>
            <div class="file-upload-area" id="mainUploadArea">
                <i class="fas fa-cloud-upload-alt"></i>
                <p>Drag & drop your file here or click to browse</p>
                <p class="small">Supports: .xlsx, .xls, .csv</p>
                <div class="file-name" id="mainFileName"></div>
                <input type="file" name="main_excel" id="main_excel" accept=".xlsx,.xls,.csv" required hidden>
            </div>
        </div>

        <div class="file-upload">
            <label>Variant Excel/CSV File (Optional):</label>
            <div class="file-upload-area" id="variantUploadArea">
                <i class="fas fa-cloud-upload-alt"></i>
                <p>Drag & drop your variant file here or click to browse</p>
                <p class="small">Supports: .xlsx, .xls, .csv</p>
                <div class="file-name" id="variantFileName"></div>
                <input type="file" name="variant_excel" id="variant_excel" accept=".xlsx,.xls,.csv" hidden>
            </div>
        </div>

        <button type="submit">Upload</button>
    </form>
</div>

<!-- Filter Controls -->
<div class="filter-controls">
    <div class="filter-row">
        <div class="filter-group">
            <label for="searchInput">Search Categories & Subcategories:</label>
            <input type="text" id="searchInput" class="search-input" placeholder="Search by name or ID...">
        </div>
        
        <div class="filter-group">
            <label for="categoryFilter">Filter by Parent Category:</label>
            <select id="categoryFilter" class="filter-select">
                <option value="">All Categories</option>
                <?php if (!empty($categories)): ?>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= $category['category_id'] ?>"><?= esc($category['category_name']) ?></option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>
        
        <div class="filter-group">
            <label for="typeFilter">Show:</label>
            <select id="typeFilter" class="filter-select">
                <option value="all">Categories & Subcategories</option>
                <option value="categories">Categories Only</option>
                <option value="subcategories">Subcategories Only</option>
            </select>
        </div>
    </div>
    
    <div class="filter-row">
        <div class="filter-group">
            <button type="button" class="clear-filters-btn" id="clearFilters">Clear All Filters</button>
        </div>
    </div>
    
    <div class="results-summary" id="resultsSummary"></div>
</div>

<!-- Categories Section -->
<div class="categories-section" id="categoriesSection">
    <h3>All Categories</h3>
    <div id="categoriesList">
        <?php if (empty($categories)): ?>
            <div class="no-results">No categories found.</div>
        <?php else: ?>
            <?php foreach ($categories as $category): ?>
                <div class="category-item" data-type="category" data-category-id="<?= $category['category_id'] ?>" data-search-text="<?= strtolower(esc($category['category_name']) . ' ' . $category['category_id']) ?>">
                    <div class="category-info">
                        <span class="category-name"><?= esc($category['category_name']) ?></span>
                        <span class="category-id">ID: <?= $category['category_id'] ?></span>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<!-- Subcategories Section -->
<div class="categories-section" id="subcategoriesSection">
    <h3>All Subcategories</h3>
    <div id="subcategoriesList">
        <?php if (empty($subcategories)): ?>
            <div class="no-results">No subcategories found.</div>
        <?php else: ?>
            <?php foreach ($subcategories as $subcategory): ?>
                <div class="subcategory-item" data-type="subcategory" data-category-id="<?= $subcategory['category_id'] ?>" data-search-text="<?= strtolower(esc($subcategory['sub_category_name']) . ' ' . $subcategory['subcategory_id'] . ' ' . esc($subcategory['main_category'])) ?>">
                    <div class="subcategory-info">
                        <span class="subcategory-name"><?= esc($subcategory['sub_category_name']) ?></span>
                        <span class="subcategory-id">ID: <?= $subcategory['subcategory_id'] ?></span>
                    </div>
                    <div class="parent-info">
                        Parent: <?= esc($subcategory['main_category']) ?> (ID: <?= $subcategory['category_id'] ?>)
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<script>
    // Drag and drop functionality
    function setupDragAndDrop(areaId, inputId, fileNameId) {
        const uploadArea = document.getElementById(areaId);
        const fileInput = document.getElementById(inputId);
        const fileNameDisplay = document.getElementById(fileNameId);

        uploadArea.addEventListener('click', () => fileInput.click());
        fileInput.addEventListener('change', () => {
            if (fileInput.files.length) {
                fileNameDisplay.textContent = fileInput.files[0].name;
                uploadArea.classList.add('active');
            }
        });
        uploadArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            uploadArea.classList.add('active');
        });
        uploadArea.addEventListener('dragleave', () => {
            uploadArea.classList.remove('active');
        });
        uploadArea.addEventListener('drop', (e) => {
            e.preventDefault();
            uploadArea.classList.remove('active');
            if (e.dataTransfer.files.length) {
                fileInput.files = e.dataTransfer.files;
                fileNameDisplay.textContent = e.dataTransfer.files[0].name;
            }
        });
    }

    // Filter and search functionality
    function filterItems() {
        const searchTerm = document.getElementById('searchInput').value.toLowerCase();
        const categoryFilter = document.getElementById('categoryFilter').value;
        const typeFilter = document.getElementById('typeFilter').value;
        
        const categoryItems = document.querySelectorAll('.category-item');
        const subcategoryItems = document.querySelectorAll('.subcategory-item');
        const categoriesSection = document.getElementById('categoriesSection');
        const subcategoriesSection = document.getElementById('subcategoriesSection');
        
        let visibleCategories = 0;
        let visibleSubcategories = 0;
        
        // Filter categories
        categoryItems.forEach(item => {
            const searchText = item.dataset.searchText;
            const matchesSearch = searchTerm === '' || searchText.includes(searchTerm);
            const matchesType = typeFilter === 'all' || typeFilter === 'categories';
            
            if (matchesSearch && matchesType) {
                item.style.display = 'block';
                visibleCategories++;
            } else {
                item.style.display = 'none';
            }
        });
        
        // Filter subcategories
        subcategoryItems.forEach(item => {
            const searchText = item.dataset.searchText;
            const categoryId = item.dataset.categoryId;
            const matchesSearch = searchTerm === '' || searchText.includes(searchTerm);
            const matchesCategory = categoryFilter === '' || categoryFilter === categoryId;
            const matchesType = typeFilter === 'all' || typeFilter === 'subcategories';
            
            if (matchesSearch && matchesCategory && matchesType) {
                item.style.display = 'block';
                visibleSubcategories++;
            } else {
                item.style.display = 'none';
            }
        });
        
        // Show/hide sections based on type filter
        if (typeFilter === 'categories') {
            categoriesSection.style.display = 'block';
            subcategoriesSection.style.display = 'none';
        } else if (typeFilter === 'subcategories') {
            categoriesSection.style.display = 'none';
            subcategoriesSection.style.display = 'block';
        } else {
            categoriesSection.style.display = 'block';
            subcategoriesSection.style.display = 'block';
        }
        
        // Update results summary
        updateResultsSummary(visibleCategories, visibleSubcategories, typeFilter);
    }

    function updateResultsSummary(categories, subcategories, typeFilter) {
        const summary = document.getElementById('resultsSummary');
        let text = '';
        
        if (typeFilter === 'categories') {
            text = `Showing ${categories} categories`;
        } else if (typeFilter === 'subcategories') {
            text = `Showing ${subcategories} subcategories`;
        } else {
            text = `Showing ${categories} categories and ${subcategories} subcategories`;
        }
        
        summary.textContent = text;
    }

    function clearFilters() {
        document.getElementById('searchInput').value = '';
        document.getElementById('categoryFilter').value = '';
        document.getElementById('typeFilter').value = 'all';
        filterItems();
    }

    // Initialize when DOM is loaded
    document.addEventListener('DOMContentLoaded', () => {
        // Setup drag and drop
        setupDragAndDrop('mainUploadArea', 'main_excel', 'mainFileName');
        setupDragAndDrop('variantUploadArea', 'variant_excel', 'variantFileName');

        // Setup form toggle
        const showFormBtn = document.getElementById('showFormBtn');
        const uploadForm = document.getElementById('uploadForm');
        const downloadSection = document.getElementById('downloadSection');
        const closeBtn = document.getElementById('btn-close');

        showFormBtn.addEventListener('click', () => {
            uploadForm.style.display = 'block';
            downloadSection.style.display = 'none';
            showFormBtn.style.display = 'none';
        });

        closeBtn.addEventListener('click', () => {
            uploadForm.style.display = 'none';
            downloadSection.style.display = 'block';
            showFormBtn.style.display = 'block';
            showFormBtn.textContent = 'Import Data';
        });

        // Setup filter functionality
        document.getElementById('searchInput').addEventListener('input', filterItems);
        document.getElementById('categoryFilter').addEventListener('change', filterItems);
        document.getElementById('typeFilter').addEventListener('change', filterItems);
        document.getElementById('clearFilters').addEventListener('click', clearFilters);

        // Initial filter to show summary
        filterItems();
    });
</script>

<?= $this->endSection() ?>