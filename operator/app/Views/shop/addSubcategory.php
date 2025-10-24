<?php include(APPPATH . 'Views/templates/config.php'); ?>
<?= $this->extend('templates/layout') ?>


<?= $this->section('content') ?>

<?php if (session()->getFlashdata('success')) : ?>
<div class="flash-popup alert alert-success">
    <?= session()->getFlashdata('success') ?>
</div>
<?php endif; ?>


<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0"><?= isset($subcategory) ? 'Edit SubCategory' : 'Add New Subcategory' ?></h5>
    </div>
    <div class="card-body">
        <form id="subCategory_Form" enctype="multipart/form-data">
            <?= csrf_field() ?>

            <?php if (isset($subcategory)): ?>
            <input type="hidden" name="subCategoryId" value="<?= esc($subcategory['id']) ?>">
            <?php endif; ?>

            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="subCategoryName" class="form-label">Main Category</label>
                        <select name="category_id" id="category_id" class="form-select">
                            <option value="">Select Main Category</option>
                            <?php foreach ($categories as $category) : ?>
                            <option value="<?= $category['category_id']; ?>"
                                <?= (isset($subcategory) && $category['category_id'] == $subcategory['category_id']) ? 'selected' : '' ?>>
                                <?= $category['category_name']; ?>
                            </option>
                            <?php endforeach; ?>
                        </select>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="categoryName" class="form-label">Subcategory Name <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="subCategory" name="subCategory" placeholder="Enter Subcategory Name"
                            value="<?= isset($subcategory) ? esc($subcategory['sub_category_name']) : '' ?>" required>
                        <div class="invalid-feedback">Please provide a category name.</div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="subCategorySubtitle" class="form-label">Subcategory Subtitle</label>
                        <input type="text" class="form-control" id="subCategorySubtitle" name="subCategorySubtitle" placeholder="Enter Subcategory Subtitle"
                            value="<?= isset($subcategory) ? esc($subcategory['sub_category_subtitle']) : '' ?>">
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="subCategoryImage" class="form-label">Subcategory Image</label>
                <input type="file" class="form-control" id="subCategoryImage" name="subCategoryImage" accept="image/*"   <?= isset($subcategory) ? '' : 'required' ?>>
                <small class="text-muted">
                    *Recommended: Square image (350×350px to 550×550px), JPG/PNG format, max 2MB.
                </small>
                <div class="mt-2">
                    <?php if (isset($subcategory) && !empty($subcategory['sub_category_image'])): ?>
                    <img id="previewImage" src="<?= $img_url.$subcategory['sub_category_image'] ?>"
                        alt="Current Category Image" class="img-thumbnail" style="max-height: 150px;">

                    <?php endif; ?>
                </div>
                <div class="invalid-feedback" id="imageFeedback"></div>
            </div>

            <div class=" col-md-6 d-flex justify-content-between">
                <button type="reset" class="btn btn-secondary">Reset</button>
                <a type="button" class="btn btn-secondary  text-white"
                    href="<?= previous_url() ?> ">
                     Back
                </a>
                <button type="submit" class="btn btn-primary">
                    <?= isset($subcategory) ? 'Update Subcategory' : 'Add Subcategory' ?>
                </button>
            </div>
        </form>
    </div>
</div>


<!-- <div id="response"></div> -->


<script>
const subCategory_Form = document.getElementById('subCategory_Form');
const API_KEY = '<?= $api_key ?>';

subCategory_Form.addEventListener('submit', async function(e) {
    e.preventDefault();

    const formData2 = new FormData(subCategory_Form);

    try {
        const response = await fetch(API_URL + 'addSubCategory', {
            method: 'POST',
            headers: {
                'X-Api': 'Bearer ' + API_KEY
            },
            body: formData2
        });

        const data = await response.json();

            console.log(data);

        if (data.status === 'success') {
            window.location.href = data.redirect;
        }
        document.getElementById('response').innerText =
            JSON.stringify(data, null, 2);

    } catch (error) {
        // console.error('Error:', error);
    }
});
</script>



<!-- <script src="<?= base_url('public/js/scripts/sp.js')?>"></script> -->
<?= $this->endSection() ?>