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


<link rel="stylesheet" href="<?= base_url() ?>public/assets/css/demo.css" />


<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <h4 class="card-title">Shops </h4>
                <a href="<?= base_url() ?>shop/add" class="btn btn-primary btn-round ms-auto">
                    Add Shop
                </a>
            </div>
        </div>
        <div class="card-body">
            <!-- Modal -->

            <div class="table-responsive">
                <table id="add-row" class="display table table-striped table-hover">
                    <thead>
                        <tr>
                            <th style="width: 4%">#</th>
                            <th>Logo</th>
                            <th>Shop Name</th>

                            <th style="width: 40%">Action</th>
                        </tr>

                    </thead>

                    <tbody>
                        <?php if (isset($shoplist)):
                            foreach ($shoplist as $key => $shop): ?>
                                <tr>
                                    <td> <?= esc($key + 1) ?></td>
                                    <td> <img src="<?= $img_url . $shop['shop_logo'] ?>" style="width:80px; height:50px" ;></td>
                                    <td> <?= $shop['shop_name'] ?></td>

                                    <td>
                                        <div class="form-button-action">
                                            <a href="<?= base_url('shop/edit/') . $shop['id'] ?>"
                                                class="btn btn-link btn-primary btn-lg">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="<?= base_url() ?>shop/hide/<?= $shop['id'] ?>"
                                                class="btn btn-link btn-primary btn-lg">
                                                <i class="bi <?= $shop['status'] == '0' ? 'bi-toggle2-off text-danger' : 'bi-toggle-on text-success' ?> fs-4 "></i>
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