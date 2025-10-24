<?php include(APPPATH . 'Views/templates/config.php'); ?>
<?= $this->extend('templates/layout') ?>
<?= $this->section('content') ?>
<title>Add category</title>

<?php if (session()->getFlashdata('success')): ?>
    <div class="flash-popup alert alert-success">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0"><?= isset($category) ? 'Edit Category' : 'Add New Category' ?></h5>
    </div>
    <div class="card-body">
        <form id="categoryForm" method="post" enctype="multipart/form-data">
         

            <?php if (isset($category)): ?>
                <input type="hidden" name="categoryId" value="<?= esc($category['category_id']) ?>">
            <?php endif; ?>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="categoryName" class="form-label">Category Name <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="categoryName" name="categoryName"
                            placeholder="Enter category name"
                            value="<?= isset($category) ? esc($category['category_name']) : '' ?>" required>
                        <div class="invalid-feedback">Please provide a category name.</div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="categorySubtitle" class="form-label">Category Subtitle</label>
                        <input type="text" class="form-control" id="categorySubtitle" name="categorySubtitle"
                            placeholder="Enter category subtitle"
                            value="<?= isset($category) ? esc($category['category_subtitle']) : '' ?>">
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="categoryImage" class="form-label">Category Image</label>
                <input type="file" class="form-control" id="categoryImage" name="categoryImage" accept="image/*">
                <small class="text-muted">
                    *Recommended: Square image (350×350px to 550×550px), JPG/PNG format, max 2MB.
                </small>
                <div class="mt-2">
                    <?php if (isset($category) && !empty($category['category_image'])): ?>
                        <img id="previewImage" src="<?= $img_url .  $category['category_image'] ?>"
                            alt="Current Category Image" class="img-thumbnail" style="max-height: 150px;">

                    <?php endif; ?>
                </div>
                <div class="invalid-feedback" id="imageFeedback"></div>
            </div>

            <div class=" col-md-6 d-flex justify-content-between">
                <button type="reset" class="btn btn-secondary">Reset</button>
                <a type="button" class="btn btn-secondary  text-white" href="<?= previous_url() ?> ">
                    Back
                </a>
                <button type="submit" class="btn btn-primary">
                    <?= isset($category) ? 'Update Category' : 'Add Category' ?>
                </button>
            </div>
        </form>
    </div>
</div>


<div id="response"></div>

<!-- <style>
.flash-popup {
    position: fixed;
    top: 10%;
    left: 55%;
    transform: translate(-50%, -50%);
    background-color: #d4edda; 
    color: #155724; 
    padding: 15px 25px;
    border-radius: 8px;
    box-shadow: 0 0 15px rgba(0,0,0,0.2);
    z-index: 9999;
    text-align: center;
    min-width: 250px;
    max-width: 80%;
    animation: fadeOut 5s forwards;
}
@keyframes fadeOut {
    0%   { opacity: 1; }
    80%  { opacity: 1; }
    100% { opacity: 0; display: none; }
}
</style> -->


<script>
    const API_KEY = '<?= $api_key ?>';

</script>

<?= $this->endSection() ?>