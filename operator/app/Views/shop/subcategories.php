<?php include(APPPATH . 'Views/templates/config.php'); ?>
<?= $this->extend('templates/layout') ?>


<?= $this->section('content') ?>
<?php if (session()->getFlashdata('success')) : ?>
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
      display: none; /* Hide initially */
    }

    @keyframes rotate {
      100% {
        transform: rotate(360deg);
      }
    }
  </style>
<!-- Trigger Button -->
<a type="button" class="btn btn-secondary  text-white"  href="<?= base_url('product/subcategory/add') ?> ">
    <i class="fa fa-plus  "></i> Add SubCategory
</a>

<div class="loader"></div>

<div class="x_content">
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box table-responsive">

                <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                    <tr>
                            <th style="width:10px;">ID</th>
                            <th style="width:100px;">Main Category </th>
                            <th style="width:100px;">Sub Category</th>
                            <th>Sub Category title</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php $sno = 1; foreach ($subcategories as $subcategory) :?>
                        <tr>
                            <td><?= $sno++; ?></td>
                            <td><?= $subcategory['main_category']; ?></td>
                            <td><?= $subcategory['sub_category_name']; ?></td>
                            <td><?= $subcategory['sub_category_subtitle']; ?></td>
                            <td><img src="<?= $img_url. $subcategory['sub_category_image']; ?>"    alt="No Image" height="30px" width="50px"></td>
                            <td class="g-3">
                                   <a href="<?= base_url('product/editSubategory/' . $subcategory['id']) ?>" class="edit-category-btn fs-5 text-info">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                
                                    <a href="<?= base_url('product_subcategory/delete/' . $subcategory['id']) ?>"style= 'margin-top:-10px';
                                        class=" btn text-danger fs-4 "><i class="fa fa-trash"></i></a>

                            </td>
                        </tr>
                        
                        <?php endforeach; ?>

                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>








<script src="<?= base_url('js/scripts/sp.js')?>"></script>

<?= $this->endSection() ?>