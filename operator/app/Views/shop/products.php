<?php include(APPPATH . 'Views/templates/config.php'); ?>

<?= $this->extend('templates/layout') ?>
<?= $this->section('content') ?>
<?php
$db = \Config\Database::connect();
?>
<style>
.table-wrapper {
    overflow-x: auto;
    max-width: 100%;
}

.action-tab {
    width: 600px !important;
}
</style>

<?php if (session()->getFlashdata('success')): ?>
<div class="flash-popup alert alert-success" style="text-transform: capitalize;">
    <?= session()->getFlashdata('success') ?>
</div>
<?php endif; ?>

<div class="container">
    <div class="row">
        <div class="col align-items-center mb-3">
            <h5>Products </h5>
        </div>
        <div class="col  d-flex justify-content-end">
            <a href="<?= base_url('shop/' . $shop_id . '/product/add') ?>">

                <button class="btn btn-outline-primary"><i class="bi bi-plus-square"></i> Add New Product</button>
            </a>
        </div>
    </div>



    <!-- Table -->
    <div class="table-wrapper">
        <table id="datatable" class="table table-bordered table-striped align-middle">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Product ID</th>
                    <th class="action-tab">Action</th>

                    <th>Tax ID</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Subcategory</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Disc.Price</th>
                    <th>Measurement</th>
                    <th>Stock</th>
                    <th>Availability</th>
                    <th>Indicator</th>
                    <th>Ratings</th>
                    <th>Return</th>
                    <th>Cancellation</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($products)): ?>
                <?php $sno = 0;
                    foreach ($products as $prod):
                        $prod_var = $db->table('product_variants')
                            ->where('prod_id', $prod['id'])
                            ->orderBy('price', 'asc')
                            ->get()
                            ->getResultArray();
                        ?>
                <tr data-category="<?= esc($prod['category_id']) ?>"
                    data-subcategory="<?= esc($prod['subcategory_id']) ?>" data-status="<?= esc($prod['status']) ?>">
                    <td><?= esc(++$sno) ?></td>
                    <td><?= esc($prod['id']) ?></td>
                    <td class="text-center gap-2">
                        <a href="<?= base_url('shop/' . $shop_id . '/' . 'editProduct/' . $prod['id']) ?>"
                            class="p-1 btn-primary rounded text-white p-2 me-2" title="Edit">
                            <i class="fa fa-pencil "></i>
                        </a>
                        <a href="<?= base_url('product/delete/' . $prod['id']) ?>"
                            class="p-1 btn-danger rounded p-2 ms-2" title="Delete">
                            <i class="fa fa-trash"></i>
                        </a>
                    </td>
                    <td><?= esc($prod['tax_id']) ?></td>
                    <td><?= esc($prod['prod_name']) ?></td>
                    <td><?= esc($prod['category_id']) ?></td>
                    <td><?= esc($prod['subcategory_id']) ?></td>
                    <td>
                        <img src="<?= $img_url . $prod['main_image'] ?>" class="product-image" alt="product image"
                            height="30px" width="50px">
                    </td>
                    <td><?= esc($prod_var[0]['price'] ?? '-') ?></td>
                    <td><?= esc($prod_var[0]['disc_price'] ?? '-') ?></td>
                    <td><?= esc($prod_var[0]['measure'] ?? '-') ?></td>
                    <?php
                            $stockStr = $prod_var[0]['stock'] ?? 0;
                            $valch = floatval($stockStr);
                            if ($valch > 1): ?>
                    <td><?= esc($stockStr) ?></td>
                    <?php else: ?>
                    <td><span class="badge bg-warning text-white p-1">Out of Stock</span></td>
                    <?php endif; ?>

                    <?php $badge = ($prod['status'] == 1) ? 'bg-success' : 'bg-danger'; ?>
                    <td>
                        <span class="badge <?= $badge ?> status-badge">
                            <?= $prod['status'] == 1 ? 'Available' : 'Unavailable' ?>
                        </span>
                    </td>

                    <?php
                            $type = (int) $prod['prod_type'];
                            $typeText = $type === 1 ? 'Veg' : ($type === 2 ? 'Non-veg' : 'None');
                            $typeBadge = $type === 1 ? 'bg-success' : ($type === 2 ? 'bg-warning' : 'bg-danger');
                            ?>
                    <td><span class="badge <?= $typeBadge ?> text-dark status-badge"><?= $typeText ?></span></td>

                    <?php
                            $rating = $prod['ratings'] ?? 0;
                            $filledStars = str_repeat('★', $rating);
                            $emptyStars = str_repeat('☆', 5 - $rating);

                            $returnBadgeClass = ($prod['return_status'] == 1) ? 'bg-success' : 'bg-danger';
                            $returnText = ($prod['return_status'] == 1) ? 'Allowed' : 'Not Allowed';

                            $cancelBadgeClass = ($prod['cancelable_status'] == 1) ? 'bg-success' : 'bg-danger';
                            $cancelText = ($prod['cancelable_status'] == 1) ? 'Allowed' : 'Not Allowed';
                            ?>
                    <td>
                        <span class="text-warning"><?= $filledStars ?><span
                                class="text-muted"><?= $emptyStars ?></span></span>
                    </td>
                    <td><span class="badge <?= $returnBadgeClass ?> status-badge"><?= $returnText ?></span></td>
                    <td><span class="badge <?= $cancelBadgeClass ?> status-badge"><?= $cancelText ?></span></td>

                </tr>
                <?php endforeach; ?>
                <?php else: ?>
        
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?= $this->endSection() ?>