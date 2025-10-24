<?php include(APPPATH . 'Views/templates/config.php'); ?>

<?= $this->extend('templates/layout') ?>
<?= $this->section('content') ?>
<?php if (session()->getFlashdata('success')): ?>
    <div class="flash-popup alert alert-success">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>


<!-- Trigger Button -->
<a href="<?= base_url('shop/'.$shop_id.'/addPaymentDetails') ?>" class="btn btn-primary">
    <i class="fa fa-plus  "></i> Add
</a>

<div class="x_content">
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box table-responsive">

                <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th style="width:10px;">ID</th>
                            <th style="width:200px;">Phone Number</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php if (!empty($details)):
                            $sno = 1;
                            foreach ($details as $row): ?>
                                <tr>
                                    <td><?= $sno++; ?></td>
                                    <td><?= $row['pay_phoneno']; ?></td>
                                    <td><img src="<?= $img_url . $row['pay_qrcode']; ?>" alt="No Image"
                                            height="30px" width="50px"></td>
                                    <td class=" g-5">
                                        <?php if ($row['enable_status'] == 0): ?>
                                            <a href="<?= base_url('action/showpayment/enabled/' . $row['id']) ?>"
                                                class="edit-category-btn fs-4 mt-1">
                                                <i class="fa fa-check"></i>
                                            </a>
                                        <?php else: ?>
                                            <a href="javascript:void(0)" class="text-success  rounded  fs-4"
                                                style="margin-top:-10px"> <i class="bi bi-cash-stack"></i></a> 
                                        <?php endif; ?>
                                        <a href="<?= base_url('showpayment/delete/' . $row['id']) ?>"
                                            style='margin-top:-10px' ; class=" btn text-danger fs-4 "><i
                                                class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                      
                        <?php endif; ?>


                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection() ?>

