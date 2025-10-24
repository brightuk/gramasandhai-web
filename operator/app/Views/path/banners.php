<?php include(APPPATH . 'Views/templates/config.php'); ?>

<?= $this->extend('templates/layout') ?>
<?= $this->section('content') ?>
<title>Slider List</title>


<?php if (session()->getFlashdata('success')): ?>
    <div class="flash-popup  success">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="flash-popup  error">
        <?= session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>
<!-- CSS Just for demo purpose, don't include it in your project -->
<link rel="stylesheet" href="<?= base_url() ?>public/assets/css/demo.css" />
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <h4 class="card-title">Banners</h4>
                <a href="<?= base_url() ?>banner/add" class="btn btn-primary btn-round ms-auto">
                    <i class="fa fa-plus"></i>
                    Banner
                </a>
            </div>
        </div>
        <div class="card-body">
            <!-- Modal -->

            <div class="table-responsive">
                <table id="add-row" class="display table table-striped table-hover">
                    <thead>
                        <tr>
                            <th style="width: 5%">#</th>
                            <th>Image</th>
                            <th>Label</th>
                            <th>Shop</th>
                            <th>Location</th>

                            <th style="width: 40%">Action</th>
                        </tr>

                    </thead>

                    <tbody>
                        <?php if (isset($banners)):
                            foreach ($banners as $key => $slide): ?>
                                <tr>
                                    <td> <?= esc($key + 1) ?></td>
                                    <td> <img src="<?= $img_url . $slide['image'] ?>" style="width:80px; height:50px" ;></td>
                                    <td> <a href="<?= $slide['banner_link'] ?>">
                                            <?= esc($slide['label_name']) ?>
                                        </a>
                                    </td>
                                    <td> <?= esc($slide['shop_name']) ?></td>

                                    <td> <?= esc($slide['city'].', '.$slide['district']) ?></td>

                                    <td>
                                        <div class="form-button-action">
                                            <a href="<?= base_url() ?>banner_edit/<?= $slide['id'] ?>"
                                                class="btn btn-link btn-primary btn-lg">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="<?= base_url() ?>action/banner/enable/<?= $slide['id'] ?>"
                                                class="btn btn-link btn-primary btn-lg">
                                                <i
                                                    class="bi <?= $slide['enable_status'] == '0' ? 'bi-toggle2-off text-danger' : 'bi-toggle-on text-success' ?> fs-4 "></i>
                                            </a>
                                            <a href="<?= base_url() ?>banner/hide/<?= $slide['id'] ?>"
                                                class="btn btn-link btn-danger  btn-lg">
                                                <i class="fa fa-times"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url() ?>public/assets/js/core/jquery-3.7.1.min.js"></script>


<!-- jQuery Scrollbar -->
<script src="<?= base_url() ?>public/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<!-- Datatables -->
<script src="<?= base_url() ?>assets/js/plugin/datatables/datatables.min.js"></script>
<!-- Kaiadmin JS -->


<?= $this->endSection() ?>