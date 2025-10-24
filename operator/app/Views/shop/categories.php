<?php include(APPPATH . 'Views/templates/config.php'); ?>
<?= $this->extend('templates/layout') ?>
<?= $this->section('content') ?>

<?php if (session()->getFlashdata('success')): ?>
    <div class="flash-popup alert alert-success">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<style>
    .loader {
        margin: 200px auto;
        height: 50px;
        width: 50px;
        border-radius: 50%;
        border: 5px solid gray;
        border-top-color: #79cbda;
        animation: rotate 1s infinite linear;
        display: none;
        /* Hide initially */
    }

    @keyframes rotate {
        100% {
            transform: rotate(360deg);
        }
    }
</style>
<!-- Trigger Button -->
<a href="<?= base_url('product/category/add') ?>" class="btn btn-primary" id="addCategoryButton">
    <i class="fa fa-plus  "></i> Add Category
</a>

<div class="x_content">
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box table-responsive">

                <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th style="width:10px;">ID</th>
                            <th style="width:100px;">Name</th>
                            <th>Subtitle</th>
                            <th>Image</th>
                            <th>Position</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $sno = 1;
                        foreach ($categories as $category): ?>
                            <tr>
                                <td><?= $sno++; ?></td>
                                <td><?= $category['category_name']; ?></td>
                                <td><?= $category['category_subtitle']; ?></td>
                                <td><img src="<?= $img_url . $category['category_image']; ?>" alt="No Image" height="30px"
                                        width="50px"></td>
                                <td>
                                    <a href="<?= base_url('product_category/position/previous/' . $category['category_id']) ?>"
                                        class="edit-category-btn fs-4 ">
                                        <i class="bi bi-caret-up-square"></i>
                                    </a>
                                    <a href="<?= base_url('product_category/position/next/' . $category['category_id']) ?>"
                                        style='margin-top:-5px' ; class=" btn text-success fs-4 "><i
                                            class="bi bi-caret-down-square"></i></a>
                                </td>
                                <td class=" g-3">
                                    <a href="<?= base_url('product/editCategory/' . $category['category_id']) ?>"
                                        class="edit-category-btn fs-5 text-info mt-1">
                                        <i class="fa fa-pencil "></i>
                                    </a>

                                    <a href="<?= base_url('product_category/delete/' . $category['category_id']) ?>"
                                        style='margin-top:-10px' ; class=" btn text-danger fs-4 "><i
                                            class="fa fa-trash"></i></a>

                                </td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>






<script src="<?= $site_url . 'public/js/scripts/sp.js' ?>"></script>

<?= $this->endSection() ?>



